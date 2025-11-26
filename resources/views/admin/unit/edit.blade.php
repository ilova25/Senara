@extends('admin.layout.app')

@section('content')
<div class="container-fluid py-4">

    {{-- Wrapper supaya header & form sejajar --}}
    <div class="mx-auto" style="max-width: 960px;">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-0 fw-bold text-brown">Edit Unit</h4>
                <small class="text-muted">Perbarui informasi unit yang sudah ada.</small>
            </div>

            <a href="{{ route('unit.index') }}" class="btn btn-outline-secondary">
                Kembali ke Daftar Unit
            </a>
        </div>

        {{-- Card Form --}}
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">

                <form action="{{ route('unit.update', $unit->id_unit) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- GAMBAR --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Gambar Unit</label>

                        {{-- Preview gambar lama --}}
                        @if($unit->gambar)
                            <div class="mb-2">
                                <img src="{{ asset('storage/'.$unit->gambar) }}"
                                     alt="Gambar Unit"
                                     class="rounded" style="width: 150px; object-fit: cover;">
                            </div>
                        @endif

                        {{-- Input file baru --}}
                        <input type="file"
                               class="form-control @error('gambar') is-invalid @enderror"
                               name="gambar" accept="image/*">

                        @error('gambar')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar.</small>
                    </div>

                    {{-- NAMA --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Unit</label>
                        <input type="text"
                               class="form-control @error('nama') is-invalid @enderror"
                               name="nama"
                               value="{{ old('nama', $unit->nama_unit) }}"
                               placeholder="Masukkan Nama Unit">
                        @error('nama')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- DESKRIPSI --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                  name="deskripsi"
                                  rows="4"
                                  placeholder="Masukkan Deskripsi Unit">{{ old('deskripsi', $unit->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- HARGA --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Harga per Malam (Rp)</label>
                        <input type="number"
                               class="form-control @error('harga') is-invalid @enderror"
                               name="harga"
                               value="{{ old('harga', $unit->harga) }}"
                               placeholder="Masukkan Harga Unit">
                        @error('harga')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- ACTION BUTTONS --}}
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="reset" class="btn btn-outline-secondary">Reset</button>
                        <button type="submit" class="btn btn-coklat">Update Unit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .text-brown { color:#6d4c41; }
    .btn-coklat {
        background-color:#6d4c41;
        color:#fff;
        border:none;
    }
    .btn-coklat:hover {
        background-color:#5d4037;
        color:#fff;
    }
</style>
@endpush
@endsection
