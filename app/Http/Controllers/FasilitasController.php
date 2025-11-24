<?php

namespace App\Http\Controllers;

use App\Models\fasilitas;
use App\Models\unit;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
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
            'gambar'  => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'nama'    => 'required|min:1',
            'unit_id' => 'required|exists:unit,id_unit',
        ]);

        $path = $request->file('gambar')->store('fasilitas', 'public');

        $fasilitas = fasilitas::create([
            'gambar' => $path,
            'nama'   => $request->nama,
        ]);

        $unit = unit::findOrFail($request->unit_id);
        $unit->fasilitas()->attach($fasilitas->id_fasilitas);

        return redirect()
            ->route('unit.fasilitas.index', $unit->id_unit)
            ->with(['success' => 'Data Berhasil Disimpan!']);
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

        return view('admin.unit.fasilitas.edit', compact('fasilitas', 'unitId'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'gambar'  => 'image|mimes:jpeg,jpg,png|max:2048',
            'nama'    => 'required|min:1',
            'unit_id' => 'nullable|exists:unit,id_unit',
        ]);

        $fasilitas = fasilitas::findOrFail($id);

        $dataUpdate = [
            'nama' => $request->nama,
        ];

        if ($request->hasFile('gambar')) {
            if ($fasilitas->gambar && Storage::disk('public')->exists($fasilitas->gambar)) {
                Storage::disk('public')->delete($fasilitas->gambar);
            }

            $path = $request->file('gambar')->store('fasilitas', 'public');
            $dataUpdate['gambar'] = $path;
        }

        $fasilitas->update($dataUpdate);

        // kalau unit_id dikirim, kembali ke halaman fasilitas unit
        if ($request->filled('unit_id')) {
            $unit = unit::findOrFail($request->unit_id);
            return redirect()
                ->route('unit.fasilitas.index', $unit->id_unit)
                ->with(['success' => 'Data Berhasil Diubah!']);
        }

        // fallback ke index fasilitas umum
        return redirect()
            ->route('fasilitas.index')
            ->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id): RedirectResponse
    {
        $fasilitas = fasilitas::findOrFail($id);

        if ($fasilitas->gambar && Storage::disk('public')->exists($fasilitas->gambar)) {
            Storage::disk('public')->delete($fasilitas->gambar);
        }

        $fasilitas->delete();

        return redirect()
            ->route('fasilitas.index')
            ->with(['success' => 'Data Berhasil dihapus']);
    }

    public function data(unit $unit, Request $request)
    {
        $search = strtolower($request->get('q', ''));

        $unit->load(['fasilitas' => function ($query) use ($search) {
            if ($search !== '') {
                $query->whereRaw('LOWER(nama) LIKE ?', ["%{$search}%"]);
            }
        }]);

        return response()->json($unit->fasilitas);
    }

}
