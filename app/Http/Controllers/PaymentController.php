<?php

namespace App\Http\Controllers;

use App\Models\booking;
use App\Models\payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create($id){
        $booking = booking::findOrFail($id);
        return view('payment_upload', compact('booking'));
    }

    public function store(Request $request, $id){
        $request->validate([
            'bukti' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        $booking = booking::findOrFail($id);

        $bukti_pembayaran = $request->file('bukti');
        $bukti_pembayaran->storeAs('bukti', $bukti_pembayaran->hashName());

        payment::create([
            'kode_booking' => $booking->kode_booking,
            'bukti_pembayaran' => $bukti_pembayaran->hashName(),
            'booking_id' => $booking->id,
            'status_pembayaran' => 'pending',
            'batas_pembayaran' => now()->addDays(1),
        ]);

        return redirect()->route('barqode')->with(['success' => 'Data berhasil disimpan']);
    }
}
