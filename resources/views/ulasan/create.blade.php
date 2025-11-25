@extends('layout.app')

@section('content')
<style>
    .review-container {
        max-width: 800px;
        margin: 40px auto;
        background: #ffffff;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.06);
        font-family: 'Poppins', sans-serif;
        color: #2c1810;
    }

    .review-header {
        margin-bottom: 25px;
    }

    .review-title {
        font-size: 26px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .review-subtitle {
        font-size: 14px;
        color: #6b7280;
    }

    .booking-summary {
        background: #f9f5f1;
        border-radius: 12px;
        padding: 15px 18px;
        margin-bottom: 20px;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 8px;
        font-size: 13px;
    }

    .booking-summary span.label {
        font-weight: 600;
        color: #5A3B1F;
        display: block;
        margin-bottom: 2px;
    }

    .booking-summary span.value {
        color: #374151;
    }

    .form-group {
        margin-bottom: 18px;
    }

    label {
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 6px;
        display: block;
        color: #2c1810;
    }

    .form-control, textarea {
        width: 100%;
        padding: 10px 12px;
        border-radius: 8px;
        border: 1px solid #d1d5db;
        font-size: 14px;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .form-control:focus, textarea:focus {
        border-color: #AF8F6F;
        box-shadow: 0 0 0 1px rgba(175, 143, 111, 0.3);
    }

    textarea {
        resize: vertical;
        min-height: 120px;
    }

    .text-danger {
        font-size: 12px;
        color: #dc2626;
        margin-top: 3px;
        display: block;
    }

    .rating-stars {
        display: flex;
        gap: 6px;
        font-size: 26px;
        cursor: pointer;
        color: #d1d5db;
        margin-bottom: 5px;
    }

    .rating-stars span.star.selected,
    .rating-stars span.star.hovered {
        color: #fbbf24; /* kuning */
    }

    .rating-text {
        font-size: 13px;
        color: #6b7280;
        margin-bottom: 5px;
    }

    .btn-submit {
        background: #5A3B1F;
        color: #ffffff;
        border: none;
        border-radius: 999px;
        padding: 10px 22px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s, transform 0.1s, box-shadow 0.2s;
    }

    .btn-submit:hover {
        background: #AF8F6F;
        transform: translateY(-1px);
        box-shadow: 0 6px 15px rgba(0,0,0,0.15);
    }

    .btn-back {
        border-radius: 999px;
        border: 1px solid #d1d5db;
        background: #ffffff;
        color: #374151;
        padding: 9px 18px;
        font-size: 13px;
        font-weight: 500;
        text-decoration: none;
        margin-right: 10px;
        transition: background 0.2s;
    }

    .btn-back:hover {
        background: #f3f4f6;
    }

    .actions {
        margin-top: 8px;
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }

    @media (max-width: 576px) {
        .review-container {
            margin: 20px;
            padding: 20px;
        }
    }
</style>

<div class="review-container">

    {{-- Header --}}
    <div class="review-header">
        <h1 class="review-title">Beri Ulasan</h1>
        <p class="review-subtitle">
            Terima kasih telah menginap di Senara Guest House. Ceritakan pengalaman menginap Anda.
        </p>
    </div>

    {{-- Ringkasan Booking --}}
    <div class="booking-summary">
        <div>
            <span class="label">Kode Booking</span>
            <span class="value">{{ $booking->kode_booking }}</span>
        </div>
        <div>
            <span class="label">Unit</span>
            <span class="value">{{ $booking->unit->nama_unit ?? '-' }}</span>
        </div>
        <div>
            <span class="label">Check-in</span>
            <span class="value">{{ $booking->checkin }}</span>
        </div>
        <div>
            <span class="label">Check-out</span>
            <span class="value">{{ $booking->checkout }}</span>
        </div>
    </div>

    {{-- Form Ulasan --}}
    <form action="{{ route('ulasan.store', $booking->id) }}" method="POST">
        {{-- Hidden unit_id jika datang dari halaman fasilitas per unit --}}
                    @if(request('booking_id'))
                        <input type="hidden" name="booking_id" value="{{ request('booking_id') }}">
                    @endif
        @csrf

        {{-- Rating --}}
        <div class="form-group">
            <label>Rating Anda</label>
            <div class="rating-stars" id="ratingStars">
                @for ($i = 1; $i <= 5; $i++)
                    <span class="star" data-value="{{ $i }}">★</span>
                @endfor
            </div>
            <div class="rating-text" id="ratingText">Pilih rating 1 - 5 bintang</div>
            <input type="hidden" name="rating" id="ratingInput" value="{{ old('rating') }}">
            @error('rating')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        {{-- Ulasan --}}
        <div class="form-group">
            <label>Ulasan</label>
            <textarea name="coment" placeholder="Ceritakan pengalaman menginap Anda di sini...">{{ old('coment') }}</textarea>
            @error('coment')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        {{-- Tombol --}}
        <div class="actions">
            <a href="{{ route('riwayat.booking') }}" class="btn-back">Kembali</a>
            <button type="submit" class="btn-submit">Kirim Ulasan</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const stars      = document.querySelectorAll('#ratingStars .star');
        const ratingInput = document.getElementById('ratingInput');
        const ratingText  = document.getElementById('ratingText');

        // kalau ada old('rating'), set awal
        let currentRating = parseInt(ratingInput.value || 0);

        function updateStars(rating) {
            stars.forEach(star => {
                const value = parseInt(star.getAttribute('data-value'));
                if (value <= rating) {
                    star.classList.add('selected');
                } else {
                    star.classList.remove('selected');
                }
            });

            if (rating === 0) {
                ratingText.textContent = 'Pilih rating 1 - 5 bintang';
            } else {
                ratingText.textContent = `Rating Anda: ${rating} bintang`;
            }
        }

        stars.forEach(star => {
            star.addEventListener('click', function () {
                const value = parseInt(this.getAttribute('data-value'));
                currentRating = value;
                ratingInput.value = value;
                updateStars(currentRating);
            });

            star.addEventListener('mouseover', function () {
                const value = parseInt(this.getAttribute('data-value'));
                updateStars(value);
            });
        });

        document.getElementById('ratingStars').addEventListener('mouseleave', function () {
            updateStars(currentRating);
        });

        // initial (kalau ada nilai lama)
        updateStars(currentRating);
    });
</script>
@endsection
