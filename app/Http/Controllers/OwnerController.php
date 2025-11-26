<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class OwnerController extends Controller
{
    // Halaman index pegawai
    public function index(): View
    {
        return view('admin.pegawai');
    }

    // Endpoint JSON untuk AJAX
    public function data(Request $request)
    {
        try {
            $q = strtolower($request->get('q', ''));

            $query = User::query()->where('role', 'resepsionis');

            if ($q !== '') {
                $query->where(function ($query) use ($q) {
                    $query->whereRaw('LOWER(username) LIKE ?', ["%{$q}%"])
                        ->orWhereRaw('LOWER(email) LIKE ?', ["%{$q}%"])
                        ->orWhereRaw('LOWER(alamat) LIKE ?', ["%{$q}%"]);
                });
            }

            $pegawai = $query->orderBy('username', 'asc')->get();

            return response()->json($pegawai);
        } catch (\Throwable $e) {
            Log::error('Error data pegawai: '.$e->getMessage());
            return response()->json(['error' => 'Gagal memuat data pegawai'], 500);
        }
    }

    // Form tambah pegawai
    public function create(): View
    {
        return view('admin.pegawai.create');
    }

    // Simpan pegawai baru
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'username'=> 'required|string|max:50|unique:users,username',
            'name'  => 'required|string|max:100',
            'email'=> 'required|string|email|unique:users,email',
            'password'=> 'required|string|min:8',
            'alamat' => 'required|string|max:250',
            'no_hp' => 'required|string|min:10'
        ]);

        User::create([
            'username'  => $request->username,
            'nama'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role'      => 'resepsionis',
            'alamat'    => $request->alamat,
            'no_hp'     => $request->no_hp
        ]);

        return redirect()->route('pegawai.index')->with('success', 'Data Berhasil Disimpan!');
    }

    // Form edit pegawai
    public function edit(string $id): View
    {
        $pegawai = User::findOrFail($id);
        return view('admin.pegawai.edit', compact('pegawai'));
    }

    // Update pegawai
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'username'=> 'required|string|max:50',
            'name'  => 'required|string|max:100',
            'email'=> 'required|string|email',
            'password'=> 'nullable|string|min:8', // password boleh kosong jika tidak diubah
            'alamat'=> 'required|string|max:250',
            'no_hp'=> 'required|string|min:10'
        ]);

        $pegawai = User::findOrFail($id);

        $data = [
            'username' => $request->username,
            'nama' => $request->name,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $pegawai->update($data);

        return redirect()->route('pegawai.index')->with('success', 'Data Berhasil Diubah!');
    }

    // Hapus pegawai
    public function destroy(string $id): RedirectResponse
    {
        $pegawai = User::findOrFail($id);
        $pegawai->delete();

        return redirect()->route('pegawai.index')->with('success', 'Data Berhasil Dihapus!');
    }

    public function show($id)
{
    // bisa redirect atau return JSON kosong
    return redirect()->route('pegawai.index');
}

}
