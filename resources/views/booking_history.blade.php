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
        width: 80%;
        margin: 0 auto;
        padding-top: 30px;
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
        overflow-x: auto; /* supaya bisa scroll ke samping */
    }

    .booking-item {
        padding: 1.5rem;
        border-bottom: 1px solid #f1f5f9;
        transition: background-color 0.3s ease;
        min-width: 600px; /* kasih lebar minimum biar tidak sempit */
    }

    .booking-item:hover {
        background: #f8f9fa;
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

    /* Status */
    .status-completed {
        background: #d1fae5;
        color: #065f46;
    }
    .status-ongoing {
        background: #dbeafe;
        color: #1e40af;
    }
    .status-canceled {
        background: #fee2e2;
        color: #991b1b;
    }
    .status-pending {
        background: #fef3c7;
        color: #b45309;
    }

    .status-waiting {
        background: #feecc7;
        color: orange;
    }

    .status-paid {
        background: #d1fae5;
        color: green;
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

    <!-- Statistik -->
    <div class="stats-cards">
        <div class="stat-card">
            <div class="stat-icon">📊</div>
            <span class="stat-number">{{ $totalBooking }}</span>
            <span class="stat-label">Total Booking</span>
        </div>
        <div class="stat-card">
            <div class="stat-icon">✅</div>
            <span class="stat-number">{{ $completed }}</span>
            <span class="stat-label">Completed</span>
        </div>
        <div class="stat-card">
            <div class="stat-icon">⏳</div>
            <span class="stat-number">{{ $pending }}</span>
            <span class="stat-label">Pending</span>
        </div>
        <div class="stat-card">
            <div class="stat-icon">🏨</div>
            <span class="stat-number">{{ $ongoing }}</span>
            <span class="stat-label">Ongoing</span>
        </div>
    </div>

    <!-- Daftar Booking -->
    <div class="bookings-section">
        <div class="section-header">
            <h2 class="section-title">Daftar Booking</h2>
            <span class="total-bookings">{{ $totalBooking }} Total Booking</span>
        </div>

        <div class="bookings-list">
            @forelse ($booking as $item)
            {{-- {{ dd($item->masukan) }} --}}
                <div class="booking-item">
                    <div class="booking-header">
                        <div class="booking-info">
                            <div class="booking-number">{{ $item->kode_booking }}</div>
                            <div class="booking-date">Dibuat pada {{ $item->created_at->format('d M Y H:i') }}</div>
                        </div>

                        {{-- Status Booking --}}
                        @if ($item->status_menginap === 'completed')
                            <div class="booking-status status-completed">Completed</div>
                        @elseif ($item->status_menginap === 'ongoing')
                            <div class="booking-status status-ongoing">Ongoing</div>
                        @elseif ($item->status_menginap === 'canceled')
                            <div class="booking-status status-canceled">Canceled</div>
                        @elseif ($item->payment && $item->payment->status_pembayaran === 'pending')
                            <div class="booking-status status-pending">Pending</div>
                        @elseif ($item->payment && $item->payment->status_pembayaran === 'paid')
                            <div class="booking-status status-paid">Paid</div>
                        @elseif ($item->payment && $item->payment->status_pembayaran === 'waiting')
                            <div class="booking-status status-waiting">Waiting</div>
                        @else
                            <div class="booking-status status-pending">Pending</div>
                        @endif
                    </div>

                    <div class="booking-details">
                        <div class="detail-item">
                            <span class="detail-label">Jenis Unit</span>
                            <span class="detail-value">{{ $item->unit->nama_unit }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Check-in</span>
                            <span class="detail-value">{{ $item->checkin }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Check-out</span>
                            <span class="detail-value">{{ $item->checkout }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Total Harga</span>
                            <span class="detail-value">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="booking-actions">
                        {{-- Tombol sesuai status --}}
                        @if ($item->payment && $item->payment->status_pembayaran === 'pending')
                            {{-- <a href="{{ route('payment.create', $item->id) }}" class="action-btn btn-secondary">Bayar</a> --}}
                        @elseif ($item->status_menginap === 'completed')
                            <a href="{{ route('booking.create') }}" class="action-btn btn-primary">Book Lagi</a>
                            <a href="{{ route('detil', $item->id) }}" class="action-btn btn-primary">Lihat Detail</a>

                            @if ($item->masukan)
                                <a href="{{ route('ulasan.show', $item->id) }}" class="action-btn btn-secondary">Lihat Ulasan</a>
                            @else
                                <a href="{{ route('ulasan.create', $item->id) }}" class="action-btn btn-primary">Beri Ulasan</a>
                            @endif
        
                        @elseif ($item->payment && $item->payment->status_pembayaran === 'paid')
                            <a href="{{ route('booking.pdf', $item->id) }}" class="action-btn btn-primary">Unduh Invoice</a>
                        @elseif ($item->payment && $item->payment->status_pembayaran === 'waiting')
                            <a href="{{ route('detil', $item->id) }}" class="action-btn btn-primary">Lihat Detail</a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <div class="empty-icon">📭</div>
                    <div class="empty-title">Belum Ada Booking</div>
                    <p class="empty-text">Anda belum memiliki riwayat booking.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
