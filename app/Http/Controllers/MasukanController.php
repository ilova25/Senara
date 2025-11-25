<?php

namespace App\Http\Controllers;

use App\Models\booking;
use App\Models\masukan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MasukanController extends Controller
{
    public function create(booking $booking)
    {
        return view('ulasan.create', compact('booking'));
    }

    public function store(Request $request, booking $booking)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'coment' => 'required|string|max:500',
        ]);

        masukan::create([
            'rating' => $request->rating,
            'coment' => $request->coment,
            'booking_id' => $booking->id,
            'user_id' => Auth::check() ? Auth::id() : null,
        ]);

        return redirect()->route('riwayat.booking')->with('success', 'Terima kasih! Ulasan Anda berhasil dikirim ');
    }

    public function show(booking $booking){
        $masukan = masukan::where('booking_id', $booking->id)->first();
        return view('ulasan.show', compact('masukan'));
    }

    public function admin(){
        $masukan = masukan::all();
        return view('admin.masukan', compact('masukan'));
    }
}
