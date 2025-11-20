<?php

namespace App\Http\Controllers;

use App\Models\fasilitas;
use App\Models\unit;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Throwable;

class UnitController extends Controller
{
    // unit index admin
    public function index(): View
    {
        $unit = unit::with('fasilitas')->latest()->paginate(5);
        return view('admin.unit', compact('unit'));
    }

    // unit index user
    public function UnitUser(): View
    {
        $unit = unit::latest()->paginate(5);
        return view('unit', compact('unit'));
    }

    // unit create
    public function create(): View
    {
        return view('admin.unit.create');
    }

    // unit store
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            // 'gambar'      => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'nama'        => 'required|min:5',
            'deskripsi'   => 'required|min:10',
            'harga'      => 'required|numeric',

            'fasilitas' => 'required|array|min:1',
            'fasilitas.*.nama' => 'required|string|max:255',
            'fasilitas.*.gambar' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        // $gambar = $request->file('gambar');
        // $gambar->storeAs('unit', $gambar->hashName());



        DB::beginTransaction();

        try {
            $unit = unit::create([
                // 'gambar'      => $gambar->hashName(),
                'nama_unit'        => $request->nama,
                'deskripsi'   => $request->deskripsi,
                'harga'      => $request->harga,
            ]);

            $fasilitasIds = [];

            foreach ($request->fasilitas as $fasilitasInput) {
                $path = $fasilitasInput['gambar']->store('fasilitas','public');

                $fasilitas = fasilitas::create([
                    'nama' => $fasilitasInput['nama'],
                    'gambar' => $path,
                ]);

                $fasilitasIds[] = $fasilitas->id_fasilitas;
            }

            $unit->fasilitas()->sync($fasilitasIds);

            DB::commit();

            return redirect()->route('unit.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()])->withInput();
        }
    }

    // unit show
    public function show(string $id): View
    {
        $unit = unit::with('fasilitas')->findOrFail($id);
        return view('admin.unit.show', compact('unit'));
    }

    // unit edit
    public function edit(string $id_unit): View
    {
        $unit = unit::findOrFail($id_unit);
        return view('admin.unit.edit', compact('unit'));
    }

    // unit update
    public function update(Request $request, $id_unit): RedirectResponse
    {
        //validate form
        $request->validate([
            // 'gambar'      => 'image|mimes:jpeg,jpg,png|max:2048',
            'nama'        => 'required|min:5',
            'deskripsi'   => 'required|min:10',
            'harga'      => 'required|numeric',
        ]);

        //get product by ID
        $unit = unit::findOrFail($id_unit);

        //check if image is uploaded
        if ($request->hasFile('gambar')) {

            // //delete old image
            // Storage::delete('unit/' . $unit->gambar);

            // //upload new image
            // $gambar = $request->file('gambar');
            // $gambar->storeAs('unit', $gambar->hashName());

            //update product with new image
            $unit->update([
                // 'gambar'         => $gambar->hashName(),
                'nama_unit'         => $request->nama,
                'deskripsi'   => $request->deskripsi,
                'harga'         => $request->harga,
            ]);
        } else {

            //update product without image
            $unit->update([
                'nama_unit'         => $request->nama,
                'deskripsi'   => $request->deskripsi,
                'harga'         => $request->harga
            ]);
        }

        //redirect to index
        return redirect()->route('unit.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    // unit destroy
    public function destroy(unit $unit): RedirectResponse
    {
        // Storage::delete('unit/' . $unit->gambar);
        $unit->delete();
        return redirect()->route('unit.index')->with(['success' => 'Data Berhasil dihapus']);
    }

    public function fasilitasIndex($id): View
    {
        $unit = unit::with('fasilitas')->findOrFail($id);
        return view('admin.unit.fasilitas.index', compact('unit'));
    }

    public function destroyFasilitas($unitId, $fasilitasId): RedirectResponse
    {
        $unit = unit::findOrFail($unitId);
        $unit->fasilitas()->detach($fasilitasId);
        return redirect()->route('unit.fasilitas.index', $unitId)->with(['success' => 'Fasilitas berhasil dihapus dari unit.']);
    }

}
