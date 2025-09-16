<?php

namespace App\Http\Controllers;

use App\Models\unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SesiController extends Controller
{
    public function home()
    {
        $unit = unit::take(3)->get();
        return view('home', compact('unit'));
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
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password wajib diisi',
        ]);

        $infologin = [
            'email' => $request->email,
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
            'email'=> 'required|string|email|unique:users,email',
            'password'=> 'required|string|min:8',
            'alamat'=> 'required|string|max:250',
            'no_hp'=> 'required|integer|min:10'
        ]);

        User::create([
            'username' => $request->username,
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
