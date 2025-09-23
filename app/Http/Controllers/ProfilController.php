<?php

namespace App\Http\Controllers;

use App\Models\booking;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function show($id)
    {
        $user = Auth::user();
        $name = $user->username;

        $initial = strtoupper(substr($name, 0, 1));

        return view('profile', compact('user', 'initial'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => 'required|string|max:50',
            'email' => 'required|string|email',
            'alamat' => 'required|string|max:250',
            'no_hp' => 'required|integer|min:10'
        ]);

        $user = User::findOrFail(Auth::id());

        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp
        ]);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::findOrFail(Auth::id());

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);
        $user->refresh();

        // dd($user->password);

        return back()->with('success', 'Password berhasil diperbarui!');
    }
}
