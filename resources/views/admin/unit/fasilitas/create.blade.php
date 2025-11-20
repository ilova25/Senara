@extends('admin.layout.app')

@section('title', 'Tambah Fasilitas')

@section('content')
<div class="container-fluid py-4">

    {{-- WRAPPER BIAR RAPI TENGAH --}}
    <div class="mx-auto" style="max-width: 700px;">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-1 fw-bold text-brown">
                    <i class="fa-solid fa-circle-plus me-2"></i>
                    Tambah Fasilitas
                </h4>

                @if(request('unit_id'))
                    <small class="text-muted">
                        Fasilitas untuk unit ID: {{ request('unit_id') }}
                    </small>
                @else
                    <small class="text-muted">
                        Tambah fasilitas baru ke daftar fasilitas.
                    </small>
                @endif
            </div>

            <a href="{{ request('unit_id') 
                        ? route('unit.fasilitas.index', request('unit_id')) 
                        : route('fasilitas.index') }}" 
               class="btn btn-outline-secondary btn-sm">
                <i class="fa-solid fa-arrow-left me-1"></i> Kembali
            </a>
        </div>

        {{-- CARD FORM --}}
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <form action="{{ route('fasilitas.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Hidden unit_id jika datang dari halaman fasilitas per unit --}}
                    @if(request('unit_id'))
                        <input type="hidden" name="unit_id" value="{{ request('unit_id') }}">
                    @endif

                    {{-- GAMBAR --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Gambar Fasilitas</label>
                        <input type="file"
                               class="form-control @error('gambar') is-invalid @enderror"
                               name="gambar" accept="image/*">
                        @error('gambar')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- NAMA --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Fasilitas</label>
                        <input type="text"
                               class="form-control @error('nama') is-invalid @enderror"
                               name="nama"
                               value="{{ old('nama') }}"
                               placeholder="Masukkan nama fasilitas">
                        @error('nama')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- BUTTONS --}}
                    <div class="d-flex justify-content-end gap-2 mt-3">
                        <button type="reset" class="btn btn-outline-secondary">
                            Reset
                        </button>
                        <button type="submit" class="btn btn-coklat">
                            Simpan Fasilitas
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection

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
