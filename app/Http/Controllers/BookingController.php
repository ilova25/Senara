<?php

namespace App\Http\Controllers;

use App\Models\booking;
use App\Models\unit;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function create(){
        $unit = unit::all();
        return view('booking', compact('unit'));
    }

    public function store(Request $request){
        $request->validate([
            'nama' => 'required|string|max:50',
            'email' => 'required|email',
            'id_unit' => 'required|exists:unit,id_unit',
            'checkin' => 'required|date',
            'checkout' => 'required|date',
            'adult' => 'required|integer|min:1',
            'children' => 'required|integer|min:0'
        ]);

        $unit = unit::findOrFail($request->id_unit);

        $checkin = new \DateTime($request->checkin);
        $checkout = new \DateTime($request->checkout);
        $days = $checkin->diff($checkout)->days;

        $total_harga = $days * $unit->harga;

        $kode_booking = 'BK-' . date('Ymd') . '-' . rand(1000, 9999);

        $booking = booking::create([
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

        return redirect()->route('payment', $booking->id)->with('success', 'Booking berhasil!');
    }

    public function admin(){
        $booking = booking::all();
        return view('admin.booking', compact('booking'));
    }

    public function payment($id): View
    {
        $booking = booking::with('unit', 'user')->findOrFail($id);
        return view('payment', compact('booking'));
    }

    public function detail($id): View
    {
        $booking = booking::with('unit', 'user')->findOrFail($id);
        return view('detil', compact('booking'));
    }

    
}
