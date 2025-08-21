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
        $email = $request->input('email');
        $password = $request->input('password');

        // Contoh login manual (hardcoded)
        if ($email === 'admin' && $password === '12345') {
            Session::put('user', $email);
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
