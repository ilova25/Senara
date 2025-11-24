@extends('admin.layout.app')

@section('title', 'Fasilitas Unit')

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

@php
    // karena pakai AJAX, form search di navbar tidak perlu benar-benar submit ke route manapun
    $searchAction = ''; 
    $searchPlaceholder = 'Cari fasilitas...';
@endphp

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
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="table-fasilitas">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 60px;">No</th>
                                <th>Nama Fasilitas</th>
                                <th style="width: 150px;">Gambar</th>
                                <th style="width: 180px;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-fasilitas">
                            {{-- akan diisi via AJAX --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        const unitId    = {{ $unit->id_unit }};
        const csrfToken = '{{ csrf_token() }}';

        // ========== RENDER TABLE ==========
        function renderTable(data) {
            let rows = '';

            if (!data || data.length === 0) {
                rows = `
                    <tr>
                        <td colspan="4" class="text-center text-muted">
                            Tidak ada fasilitas untuk unit ini.
                        </td>
                    </tr>
                `;
            } else {
                data.forEach((f, index) => {
                    const urlEdit    = `/admin/fasilitas/${f.id_fasilitas}/edit?unit_id=${unitId}`;
                    const urlDestroy = `/unit/${unitId}/fasilitas/${f.id_fasilitas}`;

                    rows += `
                        <tr>
                            <td class="text-muted">${index + 1}</td>

                            <td>
                                <div class="d-flex flex-column">
                                    <span class="fw-semibold">${f.nama ?? ''}</span>
                                </div>
                            </td>

                            <td>
                                ${
                                    f.gambar
                                        ? `
                                            <div class="rounded-3 overflow-hidden border" style="width: 110px; height: 70px;">
                                                <img src="/storage/${f.gambar}"
                                                     alt="${f.nama ?? ''}"
                                                     class="w-100 h-100"
                                                     style="object-fit: cover;">
                                            </div>
                                          `
                                        : `<span class="text-muted small">Tidak ada gambar</span>`
                                }
                            </td>

                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="${urlEdit}"
                                       class="btn btn-sm btn-outline-primary"
                                       title="Edit Fasilitas">
                                        <i class='bx bxs-edit-alt'></i>
                                    </a>

                                    <form action="${urlDestroy}"
                                          method="POST"
                                          class="form-delete-fasilitas"
                                          onsubmit="return confirm('Hapus fasilitas ini dari unit?');">
                                        <input type="hidden" name="_token" value="${csrfToken}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit"
                                                class="btn btn-sm btn-outline-danger"
                                                title="Hapus dari Unit">
                                            <i class='bx bxs-trash-alt'></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    `;
                });
            }

            $('#tbody-fasilitas').html(rows);
        }

        // ========== LOAD DATA AWAL ==========
        function loadFasilitas() {
            $.ajax({
                url: "{{ route('unit.fasilitas.data', $unit->id_unit) }}",
                method: "GET",
                data: { q: '' },
                success: function(response) {
                    renderTable(response);
                },
                error: function() {
                    console.error('Gagal memuat data fasilitas.');
                }
            });
        }

        // ========== SEARCH FASILITAS PER UNIT ==========
        function searchFasilitas(keyword) {
            $.ajax({
                url: "{{ route('unit.fasilitas.data', $unit->id_unit) }}",
                method: "GET",
                data: { q: keyword },
                success: function(response) {
                    renderTable(response);
                },
                error: function() {
                    console.error('Gagal mencari data fasilitas.');
                }
            });
        }

        // ========== PAKAI NAVBAR SEARCH (#search-unit) ==========
        const $navbarSearch = $('#search-unit');
        const $navbarForm   = $navbarSearch.closest('form');

        // cegah form submit pindah halaman
        if ($navbarForm.length) {
            $navbarForm.on('submit', function(e) {
                e.preventDefault();
            });
        }

        // reset nilai search saat halaman ini dibuka
        if ($navbarSearch.length) {
            $navbarSearch.val('');
        }

        // realtime search
        if ($navbarSearch.length) {
            $navbarSearch.on('keyup', function() {
                const keyword = $(this).val().trim();
                if (keyword.length > 0) {
                    searchFasilitas(keyword);
                } else {
                    loadFasilitas();
                }
            });
        } else {
            console.warn('Input #search-unit tidak ditemukan di navbar.');
        }

        // initial load
        loadFasilitas();
    });
</script>
@endpush
