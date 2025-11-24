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
                    <h5 class="mb-0 fw-semibold text-brown">Data Pegawai</h5>
                    <small class="text-muted">Kelola akun pegawai Senara Guesthouse</small>
                </div>
                <a href="{{ route('pegawai.create') }}" class="btn btn-coklat d-flex align-items-center">
                    <i class="bi bi-person-plus me-2"></i> Tambah Pegawai
                </a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 60px;" class="text-center small text-muted text-uppercase">No</th>
                                <th class="small text-muted text-uppercase">Username</th>
                                <th class="small text-muted text-uppercase">Email</th>
                                <th class="small text-muted text-uppercase">Alamat</th>
                                <th class="small text-muted text-uppercase">No. Telepon</th>
                                <th style="width: 150px;" class="text-center small text-muted text-uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-pegawai">
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
                                Belum ada data pegawai.
                            </td>
                        </tr>
                    `;
                } else {
                    data.forEach((item, index) => {
                        rows += `
                            <tr>
                                <td class="text-center">${index + 1}</td>
                                <td class="fw-semibold">${item.username ?? ''}</td>
                                <td>${item.email ?? ''}</td>
                                <td>${item.alamat ?? '-'}</td>
                                <td>${item.no_hp ?? '-'}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="/admin/pegawai/${item.id}/edit"
                                        class="btn btn-sm btn-outline-primary"
                                        title="Edit Pegawai">
                                            <i class="bx bxs-pen"></i>
                                        </a>

                                        <form action="/admin/pegawai/${item.id}" 
                                            method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus pegawai ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger"
                                                    title="Hapus Pegawai">
                                                <i class="bx bxs-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        `;
                    });
                }

                $('#tbody-pegawai').html(rows);
            }

            function loadPegawai() {
                $.ajax({
                    url: "{{ route('pegawai.data') }}",
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
            function searchPegawai(keyword) {
                $.ajax({
                    url: "{{ route('pegawai.data') }}",
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
                    searchPegawai(keyword);
                } else {
                    loadPegawai();
                }
            });

            // panggil saat halaman pertama kali dibuka
            loadPegawai();
        });
    </script>
@endpush
