<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\Unit;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;

class BookingController extends Controller
{
    // create booking
    public function create(Request $request)
    {
        $unitId = $request->unit;
        $unit = Unit::all();
        return view('booking', compact('unit','unitId'));
    }

    // store booking
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:50',
            'email' => 'required|email',
            'id_unit' => 'required|exists:unit,id_unit',
            'checkin' => 'required|date',
            'checkout' => 'required|date|after:checkin',
            'adult' => 'required|integer|min:1',
            'children' => 'required|integer|min:0'
        ]);

        $unit = Unit::findOrFail($request->id_unit);

        $checkin = new \DateTime($request->checkin);
        $checkout = new \DateTime($request->checkout);
        $days = $checkin->diff($checkout)->days ?: 1; // minimal 1 hari

        $total_harga = $days * $unit->harga;
        $kode_booking = 'BK-' . date('Ymd') . '-' . rand(1000, 9999);

        $booking = Booking::create([
            'id_user' => Auth::id(),
            'nama' => $request->nama,
            'email' => $request->email,
            'id_unit' => $request->id_unit,
            'checkin' => $request->checkin,
            'checkout' => $request->checkout,
            'total_harga' => $total_harga,
            'adult' => $request->adult,
            'children' => $request->children,
            'kode_booking' => $kode_booking,
        ]);

        // otomatis buat payment pending
        $booking->payment()->create([
            'status_pembayaran' => 'pending',
            'batas_pembayaran' => now()->addDay(), // contoh 1 hari
        ]);

        return redirect()->route('payment', $booking->id)->with('success', 'Booking berhasil!');
    }

    /**
     * Halaman admin booking dengan pagination biasa (server-side).
     */
    public function admin()
    {
        $booking = Booking::with(['unit', 'payment'])
            ->orderByDesc('created_at')
            ->paginate(10); // 10 data per halaman

        return view('admin.booking', compact('booking'));
    }

    /**
     * Endpoint JSON untuk AJAX (kalau nanti mau dipakai search live).
     * Boleh kamu biarkan atau hapus, pagination Blade tetap jalan.
     */
    public function data(Request $request)
    {
        $query = Booking::with(['unit', 'payment']);

        // SEARCH
        if ($request->q) {
            $q = $request->q;
            $query->where(function ($x) use ($q) {
                $x->where('nama', 'like', "%$q%")
                ->orWhere('email', 'like', "%$q%")
                ->orWhere('kode_booking', 'like', "%$q%")
                ->orWhereHas('unit', function ($u) use ($q) {
                        $u->where('nama_unit', 'like', "%$q%");
                });
            });
        }

        // QUICK RANGE (1-3-6-12 bulan)
        if ($request->range) {
            $ranges = [
                '1month' => now()->subMonth(),
                '3month' => now()->subMonths(3),
                '6month' => now()->subMonths(6),
                '1year'  => now()->subYear(),
            ];

            if (isset($ranges[$request->range])) {
                $query->where('checkin', '>=', $ranges[$request->range]);
            }
        }

        

        // FILTER STATUS (SESUIAI DATABASE KAMU)
        if ($request->status) {
            $query->where('status', $request->status);
        }

        return response()->json(
            $query->orderBy('checkin', 'desc')->get()
        );
    }

    // show payment page
    public function payment($id): View
    {
        $booking = Booking::with('unit', 'user', 'payment')->findOrFail($id);
        return view('payment', compact('booking'));
    }

    public function paymentMidtrans($id)
    {
        $booking = Booking::with('unit','user')->findOrFail($id);

         // Midtrans Config
        Config::$serverKey = config('midtrans.server_key');
        Config::$clientKey = config('midtrans.client_key');
        Config::$isProduction = false; // sandbox
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . $booking->id . '-' . time(),
                'gross_amount' => $booking->total_harga,
            ],
            'customer_details' => [
                'first_name' => $booking->nama,
                'email' => $booking->email,
            ]
        ];

        $snapToken = Snap::getSnapToken($params);

        return response()->json(['token' => $snapToken]);
    }

    // show detail page
    public function detail($id): View
    {
        $booking = Booking::with('unit', 'user','payment')->findOrFail($id);

        if ($booking->payment && $booking->payment->snap_token) {
            $snapToken = $booking->payment->snap_token;
        } else {

            // Midtrans Config
            Config::$serverKey = config('midtrans.server_key');
            Config::$clientKey = config('midtrans.client_key');
            Config::$isProduction = false; // sandbox
            Config::$isSanitized = true;
            Config::$is3ds = true;

            $orderId = $booking->id . '-' . time();

            $params = [
                'transaction_details' => [
                    'order_id' => 'ORDER-' . $orderId,
                    'gross_amount' => $booking->total_harga
                ],
                'customer_details' => [
                    'first_name' => $booking->nama,
                    'email' => $booking->email,
                ]
            ];

            $snapToken = Snap::getSnapToken($params);

            // Simpan token & order id ke payment
            $booking->payment()->update([
                'snap_token' => $snapToken,
                'order_id'   => $params['transaction_details']['order_id']
            ]);
        }

        return view('detil', compact('booking', 'snapToken'));
    }

    // check availability
    public function checkAvailability(Request $request)
    {
        $request->validate([
            'id_unit' => 'required|exists:unit,id_unit',
            'checkin' => 'required|date',
            'checkout' => 'required|date|after:checkin'
        ]);

        $exists = Booking::where('id_unit', $request->id_unit)
            ->where(function ($query) use ($request) {
                $query->whereBetween('checkin', [$request->checkin, $request->checkout])
                    ->orWhereBetween('checkout', [$request->checkin, $request->checkout])
                    ->orWhere(function ($q) use ($request) {
                        $q->where('checkin', '<=', $request->checkin)
                            ->where('checkout', '>=', $request->checkout);
                    });
            })
            ->exists();

        return response()->json([
            'available' => !$exists
        ]);
    }

    // update payment status
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_pembayaran' => 'required|in:pending,paid,canceled'
        ]);

        $booking = Booking::with('payment')->findOrFail($id);

        if ($booking->payment) {
            $booking->payment->update([
                'status_pembayaran' => $request->status_pembayaran
            ]);
        }

        return back()->with('success', 'Status pembayaran diperbarui');
    }

    // export detail booking to PDF
    public function exportPdf($id)
    {
        $booking = Booking::with('unit', 'payment')->findOrFail($id);

        $pdf = Pdf::loadView('booking_pdf', compact('booking'));
        return $pdf->download('booking.pdf');
    }

    public function exportPdfAdmin(Request $request)
    {
        $query = Booking::with(['unit', 'payment']);

        // FILTER SEARCH
        if ($request->q) {
            $q = $request->q;
            $query->where(function ($x) use ($q) {
                $x->where('nama', 'like', "%$q%")
                    ->orWhere('email', 'like', "%$q%")
                    ->orWhere('kode_booking', 'like', "%$q%")
                    ->orWhereHas('unit', function ($u) use ($q) {
                        $u->where('nama_unit', 'like', "%$q%");
                    });
            });
        }

        // FILTER RANGE BULAN
        if ($request->range) {
            $ranges = [
                '1month' => now()->subMonth(),
                '3month' => now()->subMonths(3),
                '6month' => now()->subMonths(6),
                '1year'  => now()->subYear(),
            ];

            if (isset($ranges[$request->range])) {
                $query->where('checkin', '>=', $ranges[$request->range]);
            }
        }

        // FILTER STATUS
        if ($request->status) {
            $query->where('status', $request->status);
        }

        $booking = $query->orderBy('checkin', 'desc')->get();

        $pdf = Pdf::loadView('admin.booking_pdf', compact('booking'))
                ->setPaper('a4', 'landscape');

        return $pdf->download('Laporan-Booking.pdf');
    }


    // histori booking user
    public function history()
    {
        $booking = Booking::with('unit', 'payment', 'masukan')
            ->where('id_user', Auth::id())
            ->get();

        $totalBooking = $booking->count();
        $totalSpent   = $booking->sum('total_harga');
        $pending      = $booking->filter(fn($b) => $b->payment && $b->payment->status_pembayaran === 'pending')->count();
        $booked       = $booking->filter(fn($b) => $b->payment && $b->payment->status_pembayaran === 'confirmed')->count();
        $completed    = $booking->filter(fn($b) => $b->status_menginap === 'completed')->count();
        $ongoing      = $booking->filter(fn($b) => $b->status_menginap === 'ongoing')->count();
        $canceled     = $booking->filter(fn($b) => $b->payment && $b->payment->status_pembayaran === 'canceled')->count();

        return view('booking_history', compact(
            'booking',
            'totalBooking',
            'totalSpent',
            'pending',
            'booked',
            'canceled',
            'completed',
            'ongoing'
        ));
    }

    // update status booking (admin)
    public function updatePesanan(Request $request, $id)
    {
        $request->validate([
            'status_pemesanan' => 'required|in:ongoing,completed,canceled'
        ]);

        $booking = Booking::findOrFail($id);

        $booking->update([
            'status_menginap' => $request->status_pemesanan
        ]);

        return back()->with('success', 'Status pemesanan diperbarui');
    }

    public function updateWaktu(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        // Jika check-in diubah
        if ($request->filled('checkin_time')) {
            $booking->checkin = $request->checkin_time;
            $booking->status = 'ongoing';
        }

        // Jika check-out diisi
        if ($request->filled('checkout_time')) {
            $booking->checkout = $request->checkout_time;
            $booking->status = 'completed';
        }

        $booking->save();

        return back()->with('success', 'Waktu Check In & Check Out berhasil diperbarui.');
    }

}
