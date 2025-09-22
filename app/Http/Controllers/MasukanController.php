<?php

namespace App\Http\Controllers;

use App\Models\masukan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MasukanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'masukan' => 'required|string|max:500',
        ]);

        masukan::create([
            'masukan' => $request->masukan,
            'user_id' => Auth::check() ? Auth::id() : null,
        ]);

        return redirect()->back()->with('newsletter_success', 'Terima kasih atas kritik dan saran Anda!');
    }

    public function admin(){
        $masukan = masukan::all();
        return view('admin.masukan', compact('masukan'));
    }
}
