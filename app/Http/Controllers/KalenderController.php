<?php

namespace App\Http\Controllers;

use App\Models\booking;
use Illuminate\Http\Request;

class KalenderController extends Controller
{
    public function index(){
        return view('admin.calender');
    }

    public function getBookings(){
        $booking = booking::with('unit')->get();

        $events = $booking->map(function ($booking){
            return [
                'id' => $booking->id,
                'title' => $booking->nama . ' - ' . $booking->unit->nama_unit,
                'start' => $booking->checkin,
                'end' => $booking->checkout,
                'color' => $booking->status == 'confirmed' ? 'green' : ($booking->status == 'pending' ? 'orange' : 'red')
            ];
        });

        return response()->json($events);
    }
}
