@extends('admin.layout.app')

@section('title', 'Daftar Pegawai')

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

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center py-3">
                <div>
                    <h5 class="mb-0 fw-semibold text-brown">Data Informasi Guesthouse</h5>
                    <small class="text-muted">Kelola informasi Manembah Guesthouse</small>
                </div>
                @if ($informasi === null)
                    <a href="{{ route('informasi.create') }}" class="btn btn-coklat d-flex align-items-center">
                        <i class="bi bi-person-plus me-2"></i> Tambah Informasi
                    </a>
                @endif
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 60px;" class="text-center small text-muted text-uppercase">No</th>
                                <th class="small text-muted text-uppercase">Alamat</th>
                                <th class="small text-muted text-uppercase">No. Telepon</th>
                                <th class="small text-muted text-uppercase">Email</th>
                                <th style="width: 150px;" class="text-center small text-muted text-uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-informasi">
                            {{-- DIISI VIA AJAX --}}
                        </tbody>
                    </table>
                </div>

                {{-- TIDAK ADA {{ $pegawai->links() }} LAGI KALAU FULL AJAX --}}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            function renderTable(data) {
                let rows = '';

                if (!data || data.length === 0) {
                    rows = `
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                Belum ada data informasi.
                            </td>
                        </tr>
                    `;
                } else {
                    data.forEach((item, index) => {
                        rows += `
                            <tr>
                                <td class="text-center">${index + 1}</td>
                                <td>${item.alamat ?? '-'}</td>
                                <td>${item.no_hp ?? '-'}</td>
                                <td>${item.email ?? ''}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="/admin/informasi/${item.id}/edit"
                                        class="btn btn-sm btn-outline-primary"
                                        title="Edit Informasi">
                                            <i class="bx bxs-pen"></i>
                                        </a>

                                        <form action="/admin/informasi/${item.id}" 
                                            method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus informasi ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger"
                                                    title="Hapus Informasi">
                                                <i class="bx bxs-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        `;
                    });
                }

                $('#tbody-informasi').html(rows);
            }

            function loadInformasi() {
                $.ajax({
                    url: "{{ route('informasi.data') }}",
                    method: "GET",
                    data: { q: ''},
                    success: function (response) {
                        renderTable(response);
                    },
                    error: function () {
                        console.error('Gagal memuat data pegawai.');
                    }
                });
            }

            // cari pegawai
            function searchInformasi(keyword) {
                $.ajax({
                    url: "{{ route('informasi.data') }}",
                    method: "GET",
                    data: { q: keyword },
                    success: function(response) {
                        renderTable(response);
                    },
                    error: function() {
                        console.error('Gagal mencari data pegawai.');
                    }
                });
            }

            // cegah navbar form submit & pakai AJAX
            const $navbarSearchInput = $('#search-unit');
            $navbarSearchInput.closest('form').on('submit', function(e) {
                e.preventDefault();
            });

            // realtime search lewat navbar
            $navbarSearchInput.on('keyup', function() {
                const keyword = $(this).val().trim();
                if (keyword.length > 0) {
                    searchInformasi(keyword);
                } else {
                    loadInformasi();
                }
            });

            // panggil saat halaman pertama kali dibuka
            loadInformasi();
        });
    </script>
@endpush
