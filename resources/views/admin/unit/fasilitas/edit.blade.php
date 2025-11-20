@extends('admin.layout.app')

@section('title', 'Edit Fasilitas')

@section('content')
<div class="container-fluid py-4">

    {{-- WRAPPER TENGAH --}}
    <div class="mx-auto" style="max-width: 700px;">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-1 fw-bold text-brown">
                    <i class="fa-solid fa-pen-to-square me-2"></i>
                    Edit Fasilitas
                </h4>

                @if(request('unit_id'))
                    <small class="text-muted">
                        Mengedit fasilitas untuk unit ID: {{ request('unit_id') }}
                    </small>
                @else
                    <small class="text-muted">
                        Ubah data fasilitas yang sudah terdaftar.
                    </small>
                @endif
            </div>

            {{-- Tombol kembali (dinamis) --}}
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
                <form action="{{ route('fasilitas.update', $fasilitas->id_fasilitas) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Hidden unit_id jika datang dari halaman fasilitas per unit --}}
                    @if(request('unit_id'))
                        <input type="hidden" name="unit_id" value="{{ request('unit_id') }}">
                    @endif

                    {{-- GAMBAR --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Gambar Fasilitas</label>

                        @if($fasilitas->gambar)
                            <div class="mb-2">
                                <div class="rounded overflow-hidden border" style="width: 150px; height: 100px;">
                                    <img src="{{ asset('storage/'.$fasilitas->gambar) }}"
                                         alt="Gambar Fasilitas"
                                         class="w-100 h-100"
                                         style="object-fit: cover;">
                                </div>
                            </div>
                        @endif

                        <input type="file"
                               class="form-control @error('gambar') is-invalid @enderror"
                               name="gambar"
                               accept="image/*">

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
                               value="{{ old('nama', $fasilitas->nama) }}"
                               placeholder="Masukkan Nama Fasilitas">

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
                            Update Fasilitas
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
