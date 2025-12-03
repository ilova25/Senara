<?php

namespace App\Http\Controllers;

use App\Models\booking;
use App\Models\payment;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function index()
    {
        // Set konfigurasi Midtrans
        Config::$serverKey    = config('midtrans.server_key');
        Config::$clientKey    = config('midtrans.client_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized  = config('midtrans.is_sanitized');
        Config::$is3ds        = config('midtrans.is_3ds');

        // Data pembayaran (contoh)
        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . rand(1000,9999),
                'gross_amount' => 50000,
            ],
            'customer_details' => [
                'first_name' => 'Risky',
            ]
        ];

        // Generate token
        $snapToken = Snap::getSnapToken($params);

        return view('pay', compact('snapToken'));
    }

    // create
    public function create($id){
        $booking = booking::findOrFail($id);
        return view('payment_upload', compact('booking'));
    }

    //store
    public function store(Request $request, $id){
        $request->validate([
            'bukti' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        $booking = Booking::with('payment')->findOrFail($id);

        $bukti_pembayaran = $request->file('bukti');
        $bukti_pembayaran->storeAs('bukti', $bukti_pembayaran->hashName());

        // update record payment yang sudah ada
        if ($booking->payment) {
            $booking->payment->update([
                'bukti_pembayaran' => $bukti_pembayaran->hashName(),
                'status_pembayaran' => 'waiting', // ✅ setelah upload jadi waiting
            ]);
        } else {
            // fallback kalau entah kenapa tidak ada payment
            Payment::create([
                'booking_id' => $booking->id,
                'bukti_pembayaran' => $bukti_pembayaran->hashName(),
                'status_pembayaran' => 'waiting',
                'batas_pembayaran' => now()->addDay(),
            ]);
        }

        return redirect()->route('detil', $booking->id)
                        ->with('success', 'Bukti pembayaran berhasil diupload, menunggu konfirmasi admin.');
    }

}
