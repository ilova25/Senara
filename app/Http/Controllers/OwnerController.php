<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OwnerController extends Controller
{
    public function index(): View
    {
        $pegawai = User::where('role', 'resepsionis')->paginate(10);
        return view('admin.pegawai', compact('pegawai'));
    }

    public function create(): View
    {
        return view('admin.pegawai.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'username'=> 'required|string|max:50|unique:users,username',
            'email'=> 'required|string|email|unique:users,email',
            'password'=> 'required|string|min:8',
            'alamat' => 'required|string|max:250',
            'no_hp' => 'required|integer|min:10'
        ]);

        User::create([
            'username'  => $request->username,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role' => 'resepsionis',
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp
        ]);

        //redirect to index
        return redirect()->route('pegawai.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(string $id): View
    {
        $pegawai = User::findOrFail($id);
        return view('admin.pegawai.edit', compact('pegawai'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $request->validate([
            'username'=> 'required|string|max:50',
            'email'=> 'required|string|email',
            'password'=> 'required|string|min:8',
            'alamat'=> 'required|string|max:250',
            'no_hp'=> 'required|integer|min:10'
        ]);

        //get product by ID
        $pegawai = User::findOrFail($id);

        //update product without image
        $pegawai->update([
            'username'         => $request->username,
            'email'         => $request->email,
            'password'   => $request->password,
            'alamat'         => $request->alamat,
            'no_hp'         => $request->no_hp
        ]);
        

        //redirect to index
        return redirect()->route('pegawai.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

}
