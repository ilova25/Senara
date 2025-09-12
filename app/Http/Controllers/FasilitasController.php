<?php

namespace App\Http\Controllers;

use App\Models\fasilitas;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage as FacadesStorage;

class FasilitasController extends Controller
{
    public function index(): View
    {
        $fasilitas = fasilitas::latest()->paginate(5);
        return view('admin.fasilitas', compact('fasilitas'));
    }

    public function create(): View
    {
        return view('admin.fasilitas.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'gambar'      => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'nama'        => 'required|min:5',
            'deskripsi'   => 'required|min:10',
            'jumlah'      => 'required|numeric'
        ]);

        $gambar = $request->file('gambar');
        $gambar->storeAs('fasilitas', $gambar->hashName());

        fasilitas::create([
            'gambar'      => $gambar->hashName(),
            'nama'        => $request->nama,
            'deskripsi'   => $request->deskripsi,
            'jumlah'      => $request->jumlah
        ]);

        //redirect to index
        return redirect()->route('fasilitas.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show(string $id): View
    {
        $fasilitas = fasilitas::findOrFail($id);
        return view('admin.fasilitas.show', compact('fasilitas'));
    }

    public function edit(string $id): View
    {
        $fasilitas = fasilitas::findOrFail($id);
        return view('admin.fasilitas.edit', compact('fasilitas'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $request->validate([
            'gambar'      => 'image|mimes:jpeg,jpg,png|max:2048',
            'nama'        => 'required|min:5',
            'deskripsi'   => 'required|min:10',
            'jumlah'      => 'required|numeric'
        ]);

        //get product by ID
        $fasilitas = fasilitas::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('gambar')) {

            //delete old image
            FacadesStorage::delete('fasilitas/' . $fasilitas->gambar);

            //upload new image
            $gambar = $request->file('gambar');
            $gambar->storeAs('fasilitas', $gambar->hashName());

            //update product with new image
            $fasilitas->update([
                'gambar'         => $gambar->hashName(),
                'nama'         => $request->nama,
                'deskripsi'   => $request->deskripsi,
                'jumlah'         => $request->jumlah
            ]);
        } else {

            //update product without image
            $fasilitas->update([
                'nama'         => $request->nama,
                'deskripsi'   => $request->deskripsi,
                'jumlah'         => $request->jumlah
            ]);
        }

        //redirect to index
        return redirect()->route('fasilitas.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id): RedirectResponse
    {
        $fasilitas = fasilitas::findOrFail($id);
        FacadesStorage::delete('/fasilitas' . $fasilitas->gambar);
        $fasilitas->delete();
        return redirect()->route('fasilitas.index')->with(['success' => 'Data Berhasil dihapus']);
    }
}
