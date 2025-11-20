@extends('admin.layout.app')

@section('title', 'Fasilitas Unit')

@section('content')
<div class="container-fluid py-4">
    <div class="mx-auto" style="max-width: 1100px;">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-0 fw-bold text-brown">Fasilitas {{ $unit->nama_unit }}</h4>
                <small class="text-muted">Kelola fasilitas untuk unit ini.</small>
            </div>

            <a href="{{ route('unit.index') }}" class="btn btn-outline-secondary">
                Kembali ke Daftar Unit
            </a>
        </div>

        {{-- ALERT --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-3">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- CARD UTAMA --}}
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center px-4 pt-3 pb-2">
                <div>
                    <h6 class="mb-0 text-brown fw-semibold">Daftar Fasilitas</h6>
                    <small class="text-muted">
                        Total: {{ $unit->fasilitas->count() }} fasilitas
                    </small>
                </div>

                <a href="{{ route('fasilitas.create', ['unit_id' => $unit->id_unit]) }}" class="btn btn-coklat btn-sm">
                    <i class="fa-solid fa-plus me-1"></i> Tambah Fasilitas
                </a>
            </div>

            <div class="card-body pt-0 px-0 pb-3">
                @if ($unit->fasilitas->isEmpty())
                    <div class="px-4 py-4">
                        <p class="text-muted mb-1">Belum ada fasilitas untuk unit ini.</p>
                        <a href="{{ route('fasilitas.create', ['unit_id' => $unit->id_unit]) }}" class="btn btn-sm btn-outline-secondary mt-1">
                            Tambah fasilitas pertama
                        </a>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 60px;">No</th>
                                    <th>Nama Fasilitas</th>
                                    <th style="width: 150px;">Gambar</th>
                                    <th style="width: 180px;" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($unit->fasilitas as $f)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="fw-semibold">
                                            {{ $f->nama }}
                                        </td>
                                        <td>
                                            @if($f->gambar)
                                                <div class="rounded-3 overflow-hidden border" style="width: 110px; height: 70px;">
                                                    <img src="{{ asset('storage/'.$f->gambar) }}"
                                                         alt="{{ $f->nama }}"
                                                         class="w-100 h-100"
                                                         style="object-fit: cover;">
                                                </div>
                                            @else
                                                <span class="text-muted small">Tidak ada gambar</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                {{-- Edit fasilitas --}}
                                                <a href="{{ route('fasilitas.edit', ['fasilita' => $f->id_fasilitas, 'unit_id' => $unit->id_unit]) }}"
                                                   class="btn btn-sm btn-outline-primary"
                                                   title="Edit Fasilitas">
                                                    <i class='bx bxs-edit-alt'></i>
                                                </a>

                                                {{-- Hapus relasi fasilitas dari unit ini --}}
                                                <form action="{{ route('unit.fasilitas.destroy', [$unit->id_unit, $f->id_fasilitas]) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Hapus fasilitas ini dari unit?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="btn btn-sm btn-outline-danger"
                                                            title="Hapus dari Unit">
                                                        <i class='bx bxs-trash-alt'></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
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
