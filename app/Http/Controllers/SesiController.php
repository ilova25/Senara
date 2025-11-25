<?php

namespace App\Http\Controllers;

use App\Models\masukan;
use App\Models\unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SesiController extends Controller
{
    public function home()
    {
        $unit = unit::orderBy('created_at', 'desc')->take(3)->get();
        $ulasan = masukan::latest()->take(4)->get();
        return view('home', compact('unit','ulasan'));
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function tamu()
    {
        return view('home');
    }

    public function formLogin()
    {
        return view('login');
    }

    public function prosesLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => 'Username wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        $infologin = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($infologin)) {
            if (Auth::user()->role == 'tamu') {
                return redirect()->route('home');
            }
            if (Auth::user()->role == 'owner') {
                return redirect()->route('admin.dashboard');
            }
            if (Auth::user()->role == 'resepsionis') {
                return redirect()->route('admin.dashboard');
            }
        }else {
            return redirect('login')->withErrors('Username dan password yang dimasukkan tidak sesuai')->withInput();
        }
    }

    public function formRegister()
    {
        return view('register');
    }

    public function prosesRegister(Request $request)
    {
        $request->validate([
            'username'=> 'required|string|max:50|unique:users,username',
            'name'  => 'required|string|max:100',
            'email'=> 'required|string|email|unique:users,email',
            'password'=> 'required|string|min:3',
            'alamat'=> 'required|string|max:250',
            'no_hp'=> 'required|string|max:15'
        ]);

        User::create([
            'username' => $request->username,
            'nama'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'tamu',
            'alamat'   => $request->alamat,
            'no_hp'    => $request->no_hp
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login.');
    }

    public function logout(Request $request)
    {
        $request->session()->flush(); // hapus semua session
        return redirect()->route('home');
    }

    public function booking()
    {
        return view('booking');
    }
}
