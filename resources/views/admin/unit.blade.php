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

        .card-table-wrapper {
            /* background: #f9f6f1; */
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

        /* .table-modern tbody tr:hover {
            background-color: #f3e9df;
            transform: translateY(-1px);
        } */

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

        .pagination .page-link {
            border-radius: 999px !important;
            font-size: 0.8rem;
            padding: 0.25rem 0.6rem;
        }

        .pagination .page-item.active .page-link {
            color: #fff;
            background-color: #1e88e5;  /* kalau mau, bisa sesuaikan ke warna coklatmu */
            border-color: #1e88e5;
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
                    <table class="table table-modern align-middle" id="table-unit">
                        <thead>
                            <tr>
                                <th style="width: 60px;">No</th>
                                <th>Unit</th>
                                <th>Gambar</th>
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

                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="fw-semibold">{{ $u->nama_unit }}</span>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="rounded-3 overflow-hidden border" style="width: 110px; height: 70px;">
                                            @if($u->gambar)
                                                <img src="/storage/{{ $u->gambar }}"
                                                     alt="{{ $u->nama_unit ?? '' }}"
                                                     class="w-100 h-100"
                                                     style="object-fit: cover;">
                                            @endif
                                        </div>
                                    </td>

                                    <td>
                                        <small class="text-muted">
                                            {{ \Illuminate\Support\Str::limit(strip_tags($u->deskripsi), 60) }}
                                        </small>
                                    </td>

                                    <td>
                                        <span class="badge-price">
                                            Rp {{ number_format($u->harga, 0, ',', '.') }}
                                        </span>
                                    </td>

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

                {{-- Pagination custom --}}
                @if(method_exists($unit, 'links') && $unit->hasPages())
                    <div class="d-flex justify-content-between align-items-center mt-3" id="pagination-wrapper">
                        
                        {{-- Info halaman --}}
                        <div class="small text-muted">
                            Halaman <span class="fw-semibold">{{ $unit->currentPage() }}</span>
                            dari <span class="fw-semibold">{{ $unit->lastPage() }}</span>
                        </div>

                        {{-- Tombol pagination --}}
                        <nav>
                            <ul class="pagination mb-0">

                                {{-- Tombol Previous --}}
                                @if ($unit->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link">&laquo;</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $unit->previousPageUrl() }}" rel="prev">&laquo;</a>
                                    </li>
                                @endif

                                {{-- Nomor halaman --}}
                                @foreach ($unit->getUrlRange(1, $unit->lastPage()) as $page => $url)
                                    @if ($page == $unit->currentPage())
                                        <li class="page-item active">
                                            <span class="page-link">{{ $page }}</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endif
                                @endforeach

                                {{-- Tombol Next --}}
                                @if ($unit->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $unit->nextPageUrl() }}" rel="next">&raquo;</a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <span class="page-link">&raquo;</span>
                                    </li>
                                @endif

                            </ul>
                        </nav>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {

    // Render ulang tbody berdasarkan data JSON dari AJAX
    function renderTable(data) {
        let rows = '';

        if (!data || data.length === 0) {
            rows = `
                <tr>
                    <td colspan="7" class="text-center text-muted">
                        Tidak ada unit ditemukan
                    </td>
                </tr>
            `;
        } else {
            data.forEach((u, index) => {
                const urlShow = `/admin/unit/${u.id_unit}`;
                const urlEdit = `/admin/unit/${u.id_unit}/edit`;
                const urlFasilitas = `/admin/unit/${u.id_unit}/fasilitas`;

                const deskripsi = u.deskripsi 
                    ? u.deskripsi.substring(0, 60) + (u.deskripsi.length > 60 ? '...' : '')
                    : '';

                const harga = u.harga ?? 0;
                const fasilitasCount = u.fasilitas ? u.fasilitas.length : 0;

                rows += `
                    <tr>
                        <td class="text-muted">${index + 1}</td>
                        <td>
                            <div class="d-flex flex-column">
                                <span class="fw-semibold">${u.nama_unit ?? ''}</span>
                            </div>
                        </td>
                        <td>
                            <div class="rounded-3 overflow-hidden border" style="width: 110px; height: 70px;">
                                ${u.gambar 
                                    ? `<img src="/storage/${u.gambar}" alt="${u.nama_unit ?? ''}" class="w-100 h-100" style="object-fit: cover;">`
                                    : ''
                                }
                            </div>
                        </td>
                        <td>
                            <small class="text-muted">
                                ${deskripsi}
                            </small>
                        </td>
                        <td>
                            <span class="badge-price">
                                Rp ${new Intl.NumberFormat('id-ID').format(harga)}
                            </span>
                        </td>
                        <td>
                            ${fasilitasCount > 0
                                ? `<a href="${urlFasilitas}" class="text-decoration-none">
                                        <span class="badge rounded-pill badge-fasilitas">
                                            ${fasilitasCount} fasilitas
                                        </span>
                                   </a>`
                                : `<a href="${urlFasilitas}" class="text-muted small text-decoration-none">
                                        <span class="badge-empty">
                                            + Tambah fasilitas
                                        </span>
                                   </a>`
                            }
                        </td>
                        <td class="text-end">
                            <div class="d-inline-flex gap-1">
                                <a href="${urlShow}" 
                                   class="btn btn-sm btn-outline-secondary btn-icon"
                                   title="Detail">
                                    <i class="bx bxs-show"></i>
                                </a>
                                <a href="${urlEdit}" 
                                   class="btn btn-sm btn-outline-primary btn-icon"
                                   title="Edit">
                                    <i class="bx bxs-pen"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                `;
            });
        }

        $('#table-unit tbody').html(rows);
    }

    // Pencarian realtime (keyup) ke route unit.search yang return JSON
    function searchUnit(keyword) {
        $.ajax({
            url: "{{ route('unit.search') }}",
            method: "GET",
            data: { q: keyword },
            success: function(response) {
                // response diharapkan adalah JSON array unit
                renderTable(response);

                // saat search aktif, sembunyikan pagination HTML
                $('#pagination-wrapper').hide();
            },
            error: function() {
                console.error('Gagal mencari data unit.');
            }
        });
    }

    // Event input search di navbar (id: search-unit)
    $('#search-unit').on('keyup', function() {
        const keyword = $(this).val().trim();

        if (keyword.length > 0) {
            searchUnit(keyword);
        } else {
            // jika input kosong, reload halaman utama agar pagination normal lagi
            window.location.href = "{{ route('unit.index') }}";
            // kalau mau full AJAX bisa pakai:
            // $('#pagination-wrapper').show();
            // (biarkan data tetap dari server-side awal)
        }
    });

});
</script>
@endpush
