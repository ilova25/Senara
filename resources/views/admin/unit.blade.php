@extends('admin.layout.app')

@section('title', 'Data Unit')

@push('styles')
<style>
    .btn-coklat {
        background-color: #6d4c41;
        color: #fff;
        transition: 0.2s;
    }
    .btn-coklat:hover {
        background-color: #5d4037;
        color: #fff;
    }
    .text-brown {
        color: #6d4c41;
    }
    .badge-fasilitas {
        background-color: #efebe9;
        color: #5d4037;
        font-weight: 500;
    }

    /* --- Extra styling modern untuk tabel --- */
    .card-table-wrapper {
        background: #f9f6f1;
        border-radius: 20px;
        padding: 18px;
    }

    .table-modern thead tr {
        border-bottom: none;
    }

    .table-modern thead th {
        border-bottom: none !important;
        font-size: 0.78rem;
        text-transform: uppercase;
        letter-spacing: .06em;
        font-weight: 700;
        color: #9e9e9e;
        background-color: transparent !important;
    }

    .table-modern tbody tr {
        border-radius: 12px;
        transition: background-color .15s ease, transform .1s ease;
    }

    .table-modern tbody tr:hover {
        background-color: #f3e9df;
        transform: translateY(-1px);
    }

    .table-modern td {
        border-top: none !important;
        padding-top: 0.85rem;
        padding-bottom: 0.85rem;
        vertical-align: middle;
    }

    .badge-price {
        background: #fff3e0;
        color: #e65100;
        font-weight: 600;
        border-radius: 999px;
        padding: 0.25rem 0.75rem;
        font-size: 0.8rem;
    }

    .badge-empty {
        border-radius: 999px;
        padding: 0.2rem 0.75rem;
        font-size: 0.8rem;
        border: 1px dashed #bdbdbd;
    }

    .btn-icon {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 999px;
    }

    .btn-icon i {
        font-size: 1rem;
    }

    @media (max-width: 768px) {
        .header-actions {
            flex-direction: column;
            align-items: flex-start !important;
            gap: .75rem;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4 header-actions">
        <div>
            <h4 class="mb-1 fw-bold text-brown">Data Unit</h4>
            <small class="text-muted">Kelola daftar unit dan fasilitas guesthouse</small>
        </div>

        <div class="d-flex gap-2">
            {{-- contoh search kecil, kalau belum dipakai bisa dihapus --}}
            {{-- 
            <form action="{{ route('unit.index') }}" method="GET" class="d-none d-md-block">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bx bx-search"></i>
                    </span>
                    <input type="text" name="q" class="form-control border-start-0" placeholder="Cari unit...">
                </div>
            </form>
            --}}

            <a href="{{ route('unit.create') }}" class="btn btn-coklat">
                <i class="fa-solid fa-plus me-1"></i> Tambah Unit
            </a>
        </div>
    </div>

    {{-- Alert pesan sukses / error --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Tabel Unit --}}
    <div class="card shadow-sm border-0">
        <div class="card-body card-table-wrapper">
            @if($unit->isEmpty())
                <div class="text-center py-4">
                    <p class="text-muted mb-2">Belum ada data unit.</p>
                    <a href="{{ route('unit.create') }}" class="btn btn-coklat btn-sm">
                        <i class="fa-solid fa-plus me-1"></i> Tambah Unit Pertama
                    </a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-modern align-middle">
                        <thead>
                            <tr>
                                <th style="width: 60px;">No</th>
                                <th>Unit</th>
                                <th>Deskripsi</th>
                                <th>Harga</th>
                                <th>Fasilitas</th>
                                <th style="width: 140px;" class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($unit as $index => $u)
                                <tr>
                                    <td class="text-muted">
                                        {{ $loop->iteration + ($unit->currentPage() - 1) * $unit->perPage() }}
                                    </td>

                                    {{-- Nama + mungkin kecilkan ID --}}
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="fw-semibold">{{ $u->nama_unit }}</span>
                                        </div>
                                    </td>

                                    {{-- Deskripsi singkat --}}
                                    <td>
                                        <small class="text-muted">
                                            {{ \Illuminate\Support\Str::limit(strip_tags($u->deskripsi), 60) }}
                                        </small>
                                    </td>

                                    {{-- Harga --}}
                                    <td>
                                        <span class="badge-price">
                                            Rp {{ number_format($u->harga, 0, ',', '.') }}
                                        </span>
                                    </td>

                                    {{-- Fasilitas --}}
                                    <td>
                                        @php
                                            $count = $u->fasilitas->count();
                                        @endphp

                                        @if ($count > 0)
                                            <a href="{{ route('unit.fasilitas.index', $u->id_unit) }}" class="text-decoration-none">
                                                <span class="badge rounded-pill badge-fasilitas">
                                                    {{ $count }} fasilitas
                                                </span>
                                            </a>
                                        @else
                                            <a href="{{ route('unit.fasilitas.index', $u->id_unit) }}" class="text-muted small text-decoration-none">
                                                <span class="badge-empty">
                                                    + Tambah fasilitas
                                                </span>
                                            </a>
                                        @endif
                                    </td>

                                    {{-- Aksi --}}
                                    <td class="text-end">
                                        <div class="d-inline-flex gap-1">
                                            {{-- Detail --}}
                                            <a href="{{ route('unit.show', $u->id_unit) }}" 
                                               class="btn btn-sm btn-outline-secondary btn-icon"
                                               title="Detail">
                                                <i class="bx bxs-show"></i>
                                            </a>

                                            {{-- Edit --}}
                                            <a href="{{ route('unit.edit', $u->id_unit) }}" 
                                               class="btn btn-sm btn-outline-primary btn-icon"
                                               title="Edit">
                                                <i class="bx bxs-pen"></i>
                                            </a>

                                            {{-- Hapus --}}
                                            <form action="{{ route('unit.destroy', $u->id_unit) }}" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Yakin ingin menghapus unit ini? Semua relasi fasilitas dan booking yang terkait juga akan terhapus.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger btn-icon" title="Hapus">
                                                    <i class="bx bxs-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if(method_exists($unit, 'links'))
                    <div class="mt-3 d-flex justify-content-end">
                        {{ $unit->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection
