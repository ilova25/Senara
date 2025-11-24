@extends('admin.layout.app')

@section('title', )

@php
    // navbar form tetap submit ke booking.admin, tapi kita cegah submit pakai JS
    $searchAction = route('admin.dashboard');
    $searchPlaceholder = 'Cari nama tamu, kode, email, atau unit...';
@endphp

@section('content')
    <!-- Content Area -->
        <div class="p-4">
            <!-- Stats Grid - CARDS DIPERKECIL -->
            <div class="row g-3 mb-4">
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card border-0 shadow-sm stat-card-small">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="bg-brown bg-opacity-10 text-brown rounded-3 p-2" style="color: #6d4c41;">
                                    <i class="bi bi-people fs-4"></i>
                                </div>
                                <span class="badge bg-success bg-opacity-10 text-success">
                                    <i class="bi bi-arrow-up"></i> 12%
                                </span>
                            </div>
                            <h3 class="fs-4 fw-bold mb-1">{{ number_format($totalPengguna, 0, ',', '.') }}</h3>
                            <p class="text-muted small mb-0">Total Pengguna</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card border-0 shadow-sm stat-card-small">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-2">
                                    <i class="bi bi-cart3 fs-4"></i>
                                </div>
                                <span class="badge bg-success bg-opacity-10 text-success">
                                    <i class="bi bi-arrow-up"></i> 8%
                                </span>
                            </div>
                            <h3 class="fs-4 fw-bold mb-1">{{ number_format($totalBooking, 0, ',', '.') }}</h3>
                            <p class="text-muted small mb-0">Total Pesanan</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card border-0 shadow-sm stat-card-small">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="bg-success bg-opacity-10 text-success rounded-3 p-2">
                                    <i class="bi bi-currency-dollar fs-4"></i>
                                </div>
                                <span class="badge bg-success bg-opacity-10 text-success">
                                    <i class="bi bi-arrow-up"></i> 23%
                                </span>
                            </div>
                            <h3 class="fs-4 fw-bold mb-1">
                                Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}
                            </h3>
                            <p class="text-muted small mb-0">Total Pendapatan</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card border-0 shadow-sm stat-card-small">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-2">
                                    <i class="bi bi-box-seam fs-4"></i>
                                </div>
                                <span class="badge bg-danger bg-opacity-10 text-danger">
                                    <i class="bi bi-arrow-down"></i> 3%
                                </span>
                            </div>
                            <h3 class="fs-4 fw-bold mb-1">{{ number_format($totalProduk, 0, ',', '.') }}</h3>
                            <p class="text-muted small mb-0">Total Produk</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Orders Table -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center py-3">
                    <h5 class="mb-0 fw-semibold">Pesanan Terbaru</h5>
                    <button class="btn btn-link text-decoration-none text-brown" style="color: #6d4c41;">
                        Lihat Semua <i class="bi bi-arrow-right"></i>
                    </button>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="fw-semibold small text-muted text-uppercase">ID Pesanan</th>
                                    <th class="fw-semibold small text-muted text-uppercase">Pelanggan</th>
                                    <th class="fw-semibold small text-muted text-uppercase">Unit</th>
                                    <th class="fw-semibold small text-muted text-uppercase">Check-in</th>
                                    <th class="fw-semibold small text-muted text-uppercase">Check-out</th>
                                    <th class="fw-semibold small text-muted text-uppercase">Total</th>
                                    <th class="fw-semibold small text-muted text-uppercase">Status</th>
                                    <th class="fw-semibold small text-muted text-uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tbody-dashboard">
                                {{-- diisi ajax --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        function formatDate(dateStr) {
            if (!dateStr) return '-';
            const d = new Date(dateStr);
            if (isNaN(d.getTime())) return '-';
            return d.toLocaleDateString('id-ID', {
                day: '2-digit',
                month: 'short',
                year: 'numeric'
            });
        }

        function formatRupiah(nominal) {
            nominal = Number(nominal || 0);
            return 'Rp ' + nominal.toLocaleString('id-ID');
        }

        function renderDashboardTable(data) {
            console.log('DATA DASHBOARD:', data); // debug

            let rows = '';

            if (!data || data.length === 0) {
                rows = `
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">
                            Tidak ada pesanan untuk ditampilkan.
                        </td>
                    </tr>
                `;
            } else {
                data.forEach(function (b) {
                    rows += `
                        <tr>
                            <td>
                                <span class="fw-semibold text-brown" style="color:#6d4c41;">
                                    ${b.kode_booking ?? '-'}
                                </span>
                            </td>
                            <td>${b.nama ?? '-'}</td>
                            <td>${b.unit ? (b.unit.nama_unit ?? '-') : '-'}</td>
                            <td>${formatDate(b.checkin)}</td>
                            <td>${formatDate(b.checkout)}</td>
                            <td><strong>${formatRupiah(b.total_harga)}</strong></td>
                            <td>
                                <span class="badge bg-success bg-opacity-10 text-success">
                                    <i class="bi bi-circle-fill" style="font-size:6px;"></i> Selesai
                                </span>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        Update Status
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">
                                            <i class="bi bi-hourglass-split me-2"></i> Proses
                                        </a></li>
                                        <li><a class="dropdown-item" href="#">
                                            <i class="bi bi-check-circle me-2"></i> Selesai
                                        </a></li>
                                        <li><a class="dropdown-item" href="#">
                                            <i class="bi bi-x-circle me-2"></i> Batal
                                        </a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    `;
                });
            }

            $('#tbody-dashboard').html(rows);
        }

        function loadDashboardBooking(keyword = '') {
            $.ajax({
                url: "{{ route('admin.dashboard.data') }}",
                method: "GET",
                data: { q: keyword },
                success: function (response) {
                    renderDashboardTable(response);
                },
                error: function (xhr) {
                    console.error('Gagal memuat data pesanan dashboard', xhr);
                    $('#tbody-dashboard').html(`
                        <tr>
                            <td colspan="8" class="text-center text-danger py-4">
                                Terjadi kesalahan saat memuat data.
                            </td>
                        </tr>
                    `);
                }
            });
        }

        // cari booking
        function searchBookingDashboard(keyword) {
            $.ajax({
                url: "{{ route('admin.dashboard.data') }}",
                method: "GET",
                data: { q: keyword },
                success: function(response) {
                    renderDashboardTable(response);
                },
                error: function() {
                    console.error('Gagal mencari data booking.');
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
                searchBookingDashboard(keyword);
            } else {
                loadDashboardBooking();
            }
        });

        // load awal (tanpa keyword)
        loadDashboardBooking();
    });
</script>
@endpush

