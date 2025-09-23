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
