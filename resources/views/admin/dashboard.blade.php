@extends('admin.layout.app')

@section('title', )
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
                            <h3 class="fs-4 fw-bold mb-1">1,245</h3>
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
                            <h3 class="fs-4 fw-bold mb-1">856</h3>
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
                            <h3 class="fs-4 fw-bold mb-1">45.2M</h3>
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
                            <h3 class="fs-4 fw-bold mb-1">342</h3>
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
                                    <th class="fw-semibold small text-muted text-uppercase">Produk</th>
                                    <th class="fw-semibold small text-muted text-uppercase">Tanggal</th>
                                    <th class="fw-semibold small text-muted text-uppercase">Total</th>
                                    <th class="fw-semibold small text-muted text-uppercase">Status</th>
                                    <th class="fw-semibold small text-muted text-uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="fw-semibold text-brown" style="color: #6d4c41;">#ORD-001</span></td>
                                    <td>Budi Santoso</td>
                                    <td>Kopi Arabica Premium</td>
                                    <td>28 Okt 2025</td>
                                    <td><strong>Rp 250.000</strong></td>
                                    <td>
                                        <span class="badge bg-success bg-opacity-10 text-success" id="status-1">
                                            <i class="bi bi-circle-fill" style="font-size: 6px;"></i> Selesai
                                        </span>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                Update Status
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#" onclick="updateStatus(1, 'Proses', 'warning')">
                                                    <i class="bi bi-hourglass-split me-2"></i> Proses
                                                </a></li>
                                                <li><a class="dropdown-item" href="#" onclick="updateStatus(1, 'Selesai', 'success')">
                                                    <i class="bi bi-check-circle me-2"></i> Selesai
                                                </a></li>
                                                <li><a class="dropdown-item" href="#" onclick="updateStatus(1, 'Batal', 'danger')">
                                                    <i class="bi bi-x-circle me-2"></i> Batal
                                                </a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="fw-semibold text-brown" style="color: #6d4c41;">#ORD-002</span></td>
                                    <td>Siti Nurhaliza</td>
                                    <td>Coklat Premium</td>
                                    <td>28 Okt 2025</td>
                                    <td><strong>Rp 180.000</strong></td>
                                    <td>
                                        <span class="badge bg-warning bg-opacity-10 text-warning" id="status-2">
                                            <i class="bi bi-circle-fill" style="font-size: 6px;"></i> Proses
                                        </span>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                Update Status
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#" onclick="updateStatus(2, 'Proses', 'warning')">
                                                    <i class="bi bi-hourglass-split me-2"></i> Proses
                                                </a></li>
                                                <li><a class="dropdown-item" href="#" onclick="updateStatus(2, 'Selesai', 'success')">
                                                    <i class="bi bi-check-circle me-2"></i> Selesai
                                                </a></li>
                                                <li><a class="dropdown-item" href="#" onclick="updateStatus(2, 'Batal', 'danger')">
                                                    <i class="bi bi-x-circle me-2"></i> Batal
                                                </a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="fw-semibold text-brown" style="color: #6d4c41;">#ORD-003</span></td>
                                    <td>Ahmad Rizki</td>
                                    <td>Teh Herbal</td>
                                    <td>27 Okt 2025</td>
                                    <td><strong>Rp 150.000</strong></td>
                                    <td>
                                        <span class="badge bg-success bg-opacity-10 text-success" id="status-3">
                                            <i class="bi bi-circle-fill" style="font-size: 6px;"></i> Selesai
                                        </span>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                Update Status
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#" onclick="updateStatus(3, 'Proses', 'warning')">
                                                    <i class="bi bi-hourglass-split me-2"></i> Proses
                                                </a></li>
                                                <li><a class="dropdown-item" href="#" onclick="updateStatus(3, 'Selesai', 'success')">
                                                    <i class="bi bi-check-circle me-2"></i> Selesai
                                                </a></li>
                                                <li><a class="dropdown-item" href="#" onclick="updateStatus(3, 'Batal', 'danger')">
                                                    <i class="bi bi-x-circle me-2"></i> Batal
                                                </a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="fw-semibold text-brown" style="color: #6d4c41;">#ORD-004</span></td>
                                    <td>Dewi Lestari</td>
                                    <td>Gula Aren Organik</td>
                                    <td>27 Okt 2025</td>
                                    <td><strong>Rp 95.000</strong></td>
                                    <td>
                                        <span class="badge bg-danger bg-opacity-10 text-danger" id="status-4">
                                            <i class="bi bi-circle-fill" style="font-size: 6px;"></i> Batal
                                        </span>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                Update Status
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#" onclick="updateStatus(4, 'Proses', 'warning')">
                                                    <i class="bi bi-hourglass-split me-2"></i> Proses
                                                </a></li>
                                                <li><a class="dropdown-item" href="#" onclick="updateStatus(4, 'Selesai', 'success')">
                                                    <i class="bi bi-check-circle me-2"></i> Selesai
                                                </a></li>
                                                <li><a class="dropdown-item" href="#" onclick="updateStatus(4, 'Batal', 'danger')">
                                                    <i class="bi bi-x-circle me-2"></i> Batal
                                                </a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="fw-semibold text-brown" style="color: #6d4c41;">#ORD-005</span></td>
                                    <td>Rudi Hartono</td>
                                    <td>Madu Murni</td>
                                    <td>26 Okt 2025</td>
                                    <td><strong>Rp 320.000</strong></td>
                                    <td>
                                        <span class="badge bg-success bg-opacity-10 text-success" id="status-5">
                                            <i class="bi bi-circle-fill" style="font-size: 6px;"></i> Selesai
                                        </span>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                Update Status
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#" onclick="updateStatus(5, 'Proses', 'warning')">
                                                    <i class="bi bi-hourglass-split me-2"></i> Proses
                                                </a></li>
                                                <li><a class="dropdown-item" href="#" onclick="updateStatus(5, 'Selesai', 'success')">
                                                    <i class="bi bi-check-circle me-2"></i> Selesai
                                                </a></li>
                                                <li><a class="dropdown-item" href="#" onclick="updateStatus(5, 'Batal', 'danger')">
                                                    <i class="bi bi-x-circle me-2"></i> Batal
                                                </a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection
