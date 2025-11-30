<?php

namespace App\Http\Controllers;

use App\Models\informasi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class InformasiController extends Controller
{
    public function index(Request $request): View
    {
        $informasi = informasi::get();
        return view('admin.informasi', compact('informasi'));
    }

    public function data(Request $request)
    {
        try {
            $q = strtolower($request->get('q', ''));

            $query = Informasi::query();

            if ($q !== '') {
                $query->where(function ($query) use ($q) {
                    $query->whereRaw('LOWER(alamat) LIKE ?', ["%{$q}%"])
                        ->orWhereRaw('LOWER(email) LIKE ?', ["%{$q}%"])
                        ->orWhereRaw('LOWER(no_hp) LIKE ?', ["%{$q}%"]);
                });
            }

            $informasi = $query->orderBy('alamat', 'asc')->get();

            return response()->json($informasi);
        } catch (\Throwable $e) {
            Log::error('Error data pegawai: '.$e->getMessage());
            return response()->json(['error' => 'Gagal memuat data informasi'], 500);
        }
    }

    public function create(): View
    {
        return view('admin.informasi.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'alamat' => 'required|string|max:255',
            'no_hp'  => 'required|string|max:20',
            'email'  => 'required|string|email|max:255',
        ]);

        informasi::create([
            'alamat' => $request->alamat,
            'no_hp'  => $request->no_hp,
            'email'     => $request->email,
        ]);

        return redirect()->route('informasi.index')->with('success', 'Data Berhasil Disimpan!');
    }

}
