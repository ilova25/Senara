@extends('layout.app')

@section('content')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background: #f8f9fa;
        color: #2c1810;
        min-height: 100vh;
    }

    .main-container {
        width: 80%;         /* atur lebar konten */
        margin: 0 auto;     /* center horizontal */
        padding-top: 30px;  /* jarak dari navbar */
    }

    .page-header {
        background: linear-gradient(135deg, #5A3B1F, #AF8F6F);
        color: white;
        padding: 3rem 2rem;
        border-radius: 20px;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
        margin-top: 30px;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .page-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        position: relative;
        z-index: 1;
    }

    .page-subtitle {
        font-size: 1.1rem;
        opacity: 0.9;
        position: relative;
        z-index: 1;
    }

    .filters-section {
        background: white;
        padding: 1.5rem;
        border-radius: 15px;
        margin-bottom: 2rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .filters-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #2c1810;
        margin-bottom: 1rem;
    }

    .filters-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        align-items: end;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
    }

    .filter-label {
        font-size: 0.9rem;
        font-weight: 500;
        color: #5A3B1F;
        margin-bottom: 0.5rem;
    }

    .filter-select,
    .filter-input {
        padding: 0.8rem;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        font-family: inherit;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .filter-select:focus,
    .filter-input:focus {
        outline: none;
        border-color: #5A3B1F;
        box-shadow: 0 0 0 3px rgba(90, 59, 31, 0.1);
    }

    .filter-btn {
        background: #5A3B1F;
        color: white;
        padding: 0.8rem 1.5rem;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        height: fit-content;
    }

    .filter-btn:hover {
        background: #4a2f19;
        transform: translateY(-2px);
    }

    .stats-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: white;
        padding: 1.5rem;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        text-align: center;
        transition: transform 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-icon {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: #5A3B1F;
        display: block;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        color: #6b7280;
        font-size: 0.9rem;
    }

    .bookings-section {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
    }

    .section-header {
        padding: 1.5rem;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .section-title {
        font-size: 1.3rem;
        font-weight: 600;
        color: #2c1810;
    }

    .total-bookings {
        color: #6b7280;
        font-size: 0.9rem;
    }

    .bookings-list {
        padding: 0;
    }

    .booking-item {
        padding: 1.5rem;
        border-bottom: 1px solid #f1f5f9;
        transition: background-color 0.3s ease;
    }

    .booking-item:hover {
        background: #f8f9fa;
    }

    .booking-item:last-child {
        border-bottom: none;
    }

    .booking-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1rem;
    }

    .booking-info {
        flex: 1;
    }

    .booking-number {
        font-size: 1.1rem;
        font-weight: 600;
        color: #2c1810;
        margin-bottom: 0.3rem;
    }

    .booking-date {
        color: #6b7280;
        font-size: 0.9rem;
    }

    .booking-status {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-completed {
        background: #d1fae5;
        color: #065f46;
    }

    .status-confirmed {
        background: #dbeafe;
        color: #1e40af;
    }

    .status-cancelled {
        background: #fee2e2;
        color: #991b1b;
    }

    .status-pending {
        background: #fef3c7;
        color: #92400e;
    }

    .booking-details {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .detail-item {
        display: flex;
        flex-direction: column;
    }

    .detail-label {
        font-size: 0.8rem;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.3rem;
    }

    .detail-value {
        font-weight: 600;
        color: #2c1810;
    }

    .booking-actions {
        display: flex;
        gap: 0.5rem;
        justify-content: flex-end;
        margin-top: 1rem;
    }

    .action-btn {
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .btn-primary {
        background: #5A3B1F;
        color: white;
    }

    .btn-secondary {
        background: #e5e7eb;
        color: #374151;
    }

    .btn-danger {
        background: #ef4444;
        color: white;
    }

    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #6b7280;
    }

    .empty-icon {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    .empty-title {
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #374151;
    }

    .empty-text {
        margin-bottom: 2rem;
    }


    @media (max-width: 768px) {
        .container {
            padding: 1rem;
        }

        .page-title {
            font-size: 2rem;
        }

        .filters-grid {
            grid-template-columns: 1fr;
        }

        .stats-cards {
            grid-template-columns: repeat(2, 1fr);
        }

        .booking-header {
            flex-direction: column;
            gap: 1rem;
        }

        .booking-details {
            grid-template-columns: 1fr;
        }

        .booking-actions {
            justify-content: flex-start;
            flex-wrap: wrap;
        }
    }

     /* responsive biar tetap rapih */
    @media (max-width: 992px) {
        .main-container {
            width: 90%;
        }
    }

    @media (max-width: 576px) {
        .main-container {
            width: 95%;
        }
    }
</style>

<div class="main-container">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">Riwayat Booking</h1>
        <p class="page-subtitle">Lihat dan kelola semua riwayat pemesanan Anda</p>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-cards">
        <div class="stat-card">
            <div class="stat-icon">📊</div>
            <span class="stat-number">15</span>
            <span class="stat-label">Total Booking</span>
        </div>
        <div class="stat-card">
            <div class="stat-icon">✅</div>
            <span class="stat-number">12</span>
            <span class="stat-label">Completed</span>
        </div>
        <div class="stat-card">
            <div class="stat-icon">⏳</div>
            <span class="stat-number">2</span>
            <span class="stat-label">Pending</span>
        </div>
        <div class="stat-card">
            <div class="stat-icon">💰</div>
            <span class="stat-number">Rp 2.5M</span>
            <span class="stat-label">Total Spent</span>
        </div>
    </div>

    <!-- Bookings List -->
    <div class="bookings-section">
        <div class="section-header">
            <h2 class="section-title">Daftar Booking</h2>
            <span class="total-bookings">15 total bookings</span>
        </div>

        <div class="bookings-list">
            @foreach ($booking as $item)
            <!-- Booking Item 1 -->
            <div class="booking-item">
                <div class="booking-header">
                    <div class="booking-info">
                        <div class="booking-number">{{$item->kode_booking}}</div>
                        <div class="booking-date">Dibuat pada {{$item->created_at}}</div>
                    </div>
                    <div class="booking-status status-completed">{{ $item->status_pembayaran}}</div>
                </div>

                <div class="booking-details">
                    <div class="detail-item">
                        <span class="detail-label">Jenis Unit</span>
                        <span class="detail-value">{{$item->unit->nama_unit}}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Check-in</span>
                        <span class="detail-value">{{$item->checkin}}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Check-out</span>
                        <span class="detail-value">{{$item->checkout}}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Total Harga</span>
                        <span class="detail-value">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="booking-actions">
                    <a href="{{ route('detail_booking') }}" class="action-btn btn-primary">Lihat Detail</a>
                    <a href="{{ route('booking.create') }}" class="action-btn btn-primary">Book Lagi</a>
                </div>
            </div>
            @endforeach

            <!-- Booking Item 2 -->
            <div class="booking-item">
                <div class="booking-header">
                    <div class="booking-info">
                        <div class="booking-number">#BK002</div>
                        <div class="booking-date">Dibuat pada 10 Apr 2024</div>
                    </div>
                    <div class="booking-status status-confirmed">Confirmed</div>
                </div>

                <div class="booking-details">
                    <div class="detail-item">
                        <span class="detail-label">Tipe Kamar</span>
                        <span class="detail-value">Suite Room</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Check-in</span>
                        <span class="detail-value">25 Apr 2024</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Check-out</span>
                        <span class="detail-value">27 Apr 2024</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Total Harga</span>
                        <span class="detail-value">Rp 1.200.000</span>
                    </div>
                </div>

                <div class="booking-actions">
                    <a href="{{ route('detail_booking') }}" class="action-btn btn-primary">Lihat Detail</a>
                    <a href="{{ route('booking.create') }}" class="action-btn btn-secondary">Ubah Booking</a>
                    <a href="#" class="action-btn btn-danger">Cancel</a>
                </div>
            </div>

            <!-- Booking Item 3 -->
            <div class="booking-item">
                <div class="booking-header">
                    <div class="booking-info">
                        <div class="booking-number">#BK003</div>
                        <div class="booking-date">Dibuat pada 5 Mei 2024</div>
                    </div>
                    <div class="booking-status status-pending">Pending</div>
                </div>

                <div class="booking-details">
                    <div class="detail-item">
                        <span class="detail-label">Tipe Kamar</span>
                        <span class="detail-value">Standard Room</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Check-in</span>
                        <span class="detail-value">15 Mei 2024</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Check-out</span>
                        <span class="detail-value">17 Mei 2024</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Total Harga</span>
                        <span class="detail-value">Rp 400.000</span>
                    </div>
                </div>

                <div class="booking-actions">
                    <a href="#" class="action-btn btn-primary">Lihat Detail</a>
                    <a href="#" class="action-btn btn-primary">Bayar Sekarang</a>
                    <a href="#" class="action-btn btn-danger">Cancel</a>
                </div>
            </div>

            <!-- Booking Item 4 -->
            <div class="booking-item">
                <div class="booking-header">
                    <div class="booking-info">
                        <div class="booking-number">#BK004</div>
                        <div class="booking-date">Dibuat pada 1 Jun 2024</div>
                    </div>
                    <div class="booking-status status-cancelled">Cancelled</div>
                </div>

                <div class="booking-details">
                    <div class="detail-item">
                        <span class="detail-label">Tipe Kamar</span>
                        <span class="detail-value">Deluxe Room</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Check-in</span>
                        <span class="detail-value">10 Jun 2024</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Check-out</span>
                        <span class="detail-value">12 Jun 2024</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Alasan Cancel</span>
                        <span class="detail-value">Perubahan rencana</span>
                    </div>
                </div>

                <div class="booking-actions">
                    <a href="#" class="action-btn btn-secondary">Lihat Detail</a>
                    <a href="#" class="action-btn btn-primary">Book Lagi</a>
                </div>
            </div>
        </div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Filter functionality
        const filterForm = document.querySelector('.filters-grid');
        if (filterForm) {
            filterForm.addEventListener('submit', function(e) {
                e.preventDefault();

                // Get form data
                const formData = new FormData(filterForm);
                const status = formData.get('status');
                const dateFrom = formData.get('date_from');
                const dateTo = formData.get('date_to');

                // Here you can implement the actual filtering logic
                console.log('Filtering with:', {
                    status,
                    dateFrom,
                    dateTo
                });

                // For demo purposes, just show an alert
                alert('Filter applied! (This is a demo - implement actual filtering logic)');
            });
        }

        // Action button handlers
        document.querySelectorAll('.action-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                const action = this.textContent.trim();

                if (action === 'Cancel') {
                    e.preventDefault();
                    if (confirm('Apakah Anda yakin ingin membatalkan booking ini?')) {
                        alert('Booking dibatalkan (Demo)');
                    }
                } else if (action === 'Bayar Sekarang') {
                    e.preventDefault();
                    alert('Mengarahkan ke halaman pembayaran (Demo)');
                } else if (action === 'Download Invoice') {
                    e.preventDefault();
                    alert('Mengunduh invoice (Demo)');
                }
            });
        });

        // Status badge hover effects
        document.querySelectorAll('.booking-status').forEach(status => {
            status.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.05)';
            });

            status.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
            });
        });
    });
</script>
@endsection