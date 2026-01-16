<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); // menampilkan form login
    }

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        // Contoh login manual (hardcoded)
        if ($username === 'admin' && $password === '12345') {
            Session::put('user', $username);
            return redirect()->route('home'); // Arahkan ke home setelah login
        } else {
            return redirect()->route('login')->with('error', 'Email atau password salah');
        }
    }

    public function logout()
    {
        Session::forget('user');
        return redirect()->route('home'); // Kembali ke home setelah logout
    }
}
