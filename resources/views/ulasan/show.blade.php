@extends('layout.app')

@section('content')
<style>
    .review-show-wrapper {
        max-width: 800px;
        margin: 40px auto;
        padding: 0 15px;
        font-family: 'Poppins', sans-serif;
        color: #2c1810;
    }

    .review-card {
        background: #ffffff;
        border-radius: 18px;
        padding: 24px 26px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.06);
        position: relative;
        overflow: hidden;
    }

    .review-card::before {
        content: '';
        position: absolute;
        top: -80px;
        right: -80px;
        width: 180px;
        height: 180px;
        background: rgba(175, 143, 111, 0.12);
        border-radius: 50%;
        z-index: 0;
    }

    .review-header {
        margin-bottom: 18px;
        position: relative;
        z-index: 1;
    }

    .review-title {
        font-size: 22px;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .review-subtitle {
        font-size: 13px;
        color: #6b7280;
    }

    .booking-chip {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #f9f5f1;
        border-radius: 999px;
        padding: 6px 14px;
        font-size: 12px;
        font-weight: 500;
        color: #5A3B1F;
        margin-top: 10px;
    }

    .booking-chip span.icon {
        font-size: 14px;
    }

    .review-body {
        margin-top: 14px;
        position: relative;
        z-index: 1;
    }

    .rating-row {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 6px;
    }

    .rating-label {
        font-size: 13px;
        font-weight: 600;
    }

    .rating-stars {
        display: inline-flex;
        gap: 3px;
        font-size: 20px;
    }

    .rating-stars .star {
        color: #e5e7eb;
    }

    .rating-stars .star.filled {
        color: #fbbf24;
    }

    .rating-score {
        font-size: 12px;
        color: #6b7280;
    }

    .comment-box {
        margin-top: 14px;
        padding: 14px 16px;
        background: #f9fafb;
        border-radius: 12px;
        font-size: 14px;
        line-height: 1.5;
    }

    .comment-label {
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 6px;
        color: #374151;
    }

    .comment-text {
        color: #4b5563;
        white-space: pre-line;
    }

    .meta-row {
        margin-top: 14px;
        display: flex;
        flex-wrap: wrap;
        gap: 10px 18px;
        font-size: 12px;
        color: #6b7280;
    }

    .meta-item span.label {
        font-weight: 600;
        color: #4b5563;
    }

    .empty-state {
        text-align: center;
        padding: 40px 24px;
        background: #ffffff;
        border-radius: 18px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.06);
    }

    .empty-icon {
        font-size: 38px;
        margin-bottom: 10px;
        opacity: 0.7;
    }

    .empty-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .empty-text {
        font-size: 13px;
        color: #6b7280;
        margin-bottom: 16px;
    }

    .btn-back-rounded {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border-radius: 999px;
        border: 1px solid #d1d5db;
        background: #ffffff;
        color: #374151;
        padding: 8px 16px;
        font-size: 13px;
        font-weight: 500;
        text-decoration: none;
        transition: background 0.2s, box-shadow 0.2s, transform 0.05s;
    }

    .btn-back-rounded:hover {
        background: #f3f4f6;
        box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        transform: translateY(-1px);
    }

    .btn-back-rounded span.icon {
        font-size: 14px;
    }

    @media (max-width: 576px) {
        .review-show-wrapper {
            margin: 24px auto;
        }

        .review-card {
            padding: 20px 18px;
        }
    }
</style>

<div class="review-show-wrapper">
    @if ($masukan)
        <div class="review-card">
            <div class="review-header">
                <h1 class="review-title">Ulasan Anda</h1>
                <p class="review-subtitle">
                    Terima kasih sudah berbagi pengalaman menginap di Senara Guest House.
                </p>

                @if($masukan->booking)
                    <div class="booking-chip">
                        <span>{{ $masukan->booking->kode_booking }}</span>
                    </div>
                @endif
            </div>

            <div class="review-body">
                {{-- Rating --}}
                <div class="rating-row">
                    <div class="rating-label">Rating</div>
                    <div class="rating-stars">
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="star {{ $i <= $masukan->rating ? 'filled' : '' }}">★</span>
                        @endfor
                    </div>
                    <div class="rating-score">
                        {{ $masukan->rating }} / 5
                    </div>
                </div>

                {{-- Komentar --}}
                <div class="comment-box">
                    <div class="comment-label">Komentar</div>
                    <div class="comment-text">
                        {{ $masukan->coment }}
                    </div>
                </div>

                {{-- Info tambahan --}}
                <div class="meta-row">
                    @if($masukan->booking && $masukan->booking->unit)
                        <div class="meta-item">
                            <span class="label">Unit:</span>
                            <span> {{ $masukan->booking->unit->nama_unit }}</span>
                        </div>
                    @endif
                    @if($masukan->created_at)
                        <div class="meta-item">
                            <span class="label">Diberikan pada:</span>
                            <span> {{ $masukan->created_at->format('d M Y H:i') }}</span>
                        </div>
                    @endif
                </div>

                {{-- Tombol kembali --}}
                <div class="mt-3" style="margin-top: 18px;">
                    <a href="{{ route('riwayat.booking') }}" class="btn-back-rounded">
                        <span class="icon">←</span>
                        <span>Kembali ke Riwayat</span>
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="empty-state">
            <div class="empty-icon">📝</div>
            <div class="empty-title">Belum Ada Ulasan</div>
            <p class="empty-text">
                Anda belum memberikan ulasan untuk booking ini.
            </p>
            <a href="{{ route('riwayat.booking') }}" class="btn-back-rounded">
                
                <span>Kembali ke Riwayat</span>
            </a>
        </div>
    @endif
</div>
@endsection
