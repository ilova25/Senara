<?php

namespace App\Http\Controllers;

use App\Models\fasilitas;
use App\Models\unit;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FasilitasController extends Controller
{
    public function index(): View
    {
        $fasilitas = fasilitas::latest()->paginate(5);
        return view('admin.fasilitas', compact('fasilitas'));
    }

    public function FasilitasUser(): View
    {
        $fasilitas = fasilitas::latest()->paginate(5);
        return view('facilities', compact('fasilitas'));
    }

    public function create(Request $request): View
    {
        $unitId = $request->get('unit_id');
        return view('admin.unit.fasilitas.create', compact('unitId'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'gambar'      => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'nama'        => 'required|min:1',
            'unit_id' => 'required|exists:unit,id_unit',
        ]);

        $path = $request->file('gambar')->store('fasilitas','public');

        $fasilitas = fasilitas::create([
            'gambar'      => $path,
            'nama'        => $request->nama,
        ]);

        // pasti ada unit_id karena divalidasi "required"
        $unit = unit::findOrFail($request->unit_id);
        $unit->fasilitas()->attach($fasilitas->id_fasilitas);

        //redirect to index
        return redirect()->route('unit.fasilitas.index', $unit->id_unit)->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show(string $id): View
    {
        $fasilitas = fasilitas::findOrFail($id);
        return view('admin.fasilitas.show', compact('fasilitas'));
    }

    public function edit(Request $request, string $id): View
    {
        $fasilitas = fasilitas::findOrFail($id);
        $unitId = $request->get('unit_id');

        return view('admin.unit.fasilitas.edit', compact('fasilitas','unitId'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $request->validate([
            'gambar'      => 'image|mimes:jpeg,jpg,png|max:2048',
            'nama'        => 'required|min:1',
            'unit_id' => 'nullable|exists:unit,id_unit',
        ]);

        //get product by ID
        $fasilitas = fasilitas::findOrFail($id);

        $dataUpdate = [
            'nama' => $request->nama,
        ];

        //check if image is uploaded
        if ($request->hasFile('gambar')) {

            //delete old image
            if ($fasilitas->gambar && Storage::disk('public')->exists($fasilitas->gambar)) {
                Storage::disk('public')->delete($fasilitas->gambar);
            }

            //upload new image
            $path = $request->file('gambar')->store('fasilitas','public');
            $dataUpdate['gambar'] = $path;
        } 

        $fasilitas->update($dataUpdate);

        $unit = unit::findOrFail($request->unit_id);

        //redirect to index
        return redirect()->route('unit.fasilitas.index', $unit->id_unit)->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id): RedirectResponse
    {
        $fasilitas = fasilitas::findOrFail($id);
        Storage::disk('public')->delete($fasilitas->gambar);
        $fasilitas->delete();
        return redirect()->route('fasilitas.index')->with(['success' => 'Data Berhasil dihapus']);
    }
}
