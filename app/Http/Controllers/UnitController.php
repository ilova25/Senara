<?php

namespace App\Http\Controllers;

use App\Models\unit;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UnitController extends Controller
{
    public function index(): View
    {
        $unit = unit::latest()->paginate(5);
        return view('admin.unit', compact('unit'));
    }

    public function create(): View
    {
        return view('admin.unit.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'gambar'      => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'nama'        => 'required|min:5',
            'deskripsi'   => 'required|min:10',
            'harga'      => 'required|numeric'
        ]);

        $gambar = $request->file('gambar');
        $gambar->storeAs('unit', $gambar->hashName());

        unit::create([
            'gambar'      => $gambar->hashName(),
            'nama_unit'        => $request->nama,
            'deskripsi'   => $request->deskripsi,
            'harga'      => $request->harga
        ]);

        //redirect to index
        return redirect()->route('unit.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show(string $id_unit): View
    {
        $unit = unit::findOrFail($id_unit);
        return view('admin.unit.show', compact('unit'));
    }

    public function edit(string $id_unit): View
    {
        $unit = unit::findOrFail($id_unit);
        return view('admin.unit.edit', compact('unit'));
    }

    public function update(Request $request, $id_unit): RedirectResponse
    {
        //validate form
        $request->validate([
            'gambar'      => 'image|mimes:jpeg,jpg,png|max:2048',
            'nama'        => 'required|min:5',
            'deskripsi'   => 'required|min:10',
            'harga'      => 'required|numeric'
        ]);

        //get product by ID
        $unit = unit::findOrFail($id_unit);

        //check if image is uploaded
        if ($request->hasFile('gambar')) {

            //delete old image
            Storage::delete('unit/' . $unit->gambar);

            //upload new image
            $gambar = $request->file('gambar');
            $gambar->storeAs('unit', $gambar->hashName());

            //update product with new image
            $unit->update([
                'gambar'         => $gambar->hashName(),
                'nama'         => $request->nama,
                'deskripsi'   => $request->deskripsi,
                'harga'         => $request->harga
            ]);
        } else {

            //update product without image
            $unit->update([
                'nama'         => $request->nama,
                'deskripsi'   => $request->deskripsi,
                'harga'         => $request->harga
            ]);
        }

        //redirect to index
        return redirect()->route('unit.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id_unit): RedirectResponse
    {
        $unit = unit::findOrFail($id_unit);
        Storage::delete('/unit' . $unit->gambar);
        $unit->delete();
        return redirect()->route('unit.index')->with(['success' => 'Data Berhasil dihapus']);
    }

}
