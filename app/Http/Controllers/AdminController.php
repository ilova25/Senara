<?php

namespace App\Http\Controllers;

use App\Models\booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $totalPengguna = User::count();
        $totalBooking = booking::count();
        $totalPendapatan = booking::sum('total_harga');
        $totalProduk = booking::distinct('id_unit')->count('id_unit');
        $booking = booking::with('unit', 'user')->take(5)->get();
        return view('admin.dashboard', compact('totalPengguna', 'totalBooking', 'totalPendapatan', 'totalProduk', 'booking'));
    }

    public function data(Request $request)
    {
        $q = strtolower($request->get('q', ''));

        $query = booking::with('unit', 'user');

        if ($q !== '') {
            $query->where(function ($sub) use ($q) {
                $sub->whereRaw('LOWER(kode_booking) LIKE ?', ["%{$q}%"])
                    ->orWhereRaw('LOWER(nama) LIKE ?', ["%{$q}%"])
                    ->orWhereRaw('LOWER(email) LIKE ?', ["%{$q}%"]);
            });
        }

        $booking = $query
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return response()->json($booking);
            
    }
    
}
