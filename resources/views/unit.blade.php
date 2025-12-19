@extends('layout.app')

@section('content')
<style>
    body {
        /* background-color: #f6f2ec; */
        color: #2c1810;
        font-family: 'Poppins', sans-serif;
    }

    /* Banner full width */
    .banner {
      display: block;
      width: 100%;       /* penuh layar */
      height: auto;
    }

    .page-title {
      text-align: left;
      font-size: 42px;
      margin: 40px 0 20px;
      padding-left: 135px; /* bisa diganti 5% juga */
      font-weight: 400;
    }

    .unit-hero-overlay {
        position: absolute;
        inset: 0;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: center;
        padding-left: 9%;
        color: #fff;
    }

    .unit-hero-overlay h1 {
        font-size: 42px;
        letter-spacing: 3px;
        font-weight: 500;
        margin-bottom: 10px;
    }

    .unit-hero-overlay p {
        font-size: 16px;
        max-width: 480px;
        opacity: 0.9;
    }

    .room-section {
        padding: 10px 9% 60px 9%;
    }

    .room-section-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 25px;
        gap: 20px;
    }

    .room-section-title {
        font-size: 26px;
        font-weight: 500;
    }

    .room-section-subtitle {
        font-size: 14px;
        color: #7a5a44;
        max-width: 380px;
    }

    .room-list {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .room-card {
        display: flex;
        gap: 24px;
        background: #fff;
        border-radius: 18px;
        padding: 16px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.06);
        /* transition: transform 0.25s ease, box-shadow 0.25s ease; */
        align-items: stretch;
    }

    /* .room-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 14px 32px rgba(0,0,0,0.09);
    } */

    .room-card.reverse {
        flex-direction: row-reverse;
    }

    .room-card-img-wrapper {
        flex: 0 0 38%;
        border-radius: 14px;
        overflow: hidden;
        position: relative;
    }

    .room-card-img-wrapper img {
        width: 100%;
        height: 100%;
        max-height: 260px;
        object-fit: cover;
        transition: transform 0.35s ease;
    }

    .room-card:hover .room-card-img-wrapper img {
        transform: scale(1.05);
    }

    .room-tag {
        position: absolute;
        top: 12px;
        left: 12px;
        background: rgba(0,0,0,0.65);
        color: #fff;
        padding: 6px 10px;
        border-radius: 999px;
        font-size: 11px;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .room-info {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        gap: 12px;
    }

    .room-info-header {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        align-items: flex-start;
    }

    .room-info-title {
        font-size: 22px;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .room-capacity {
        font-size: 12px;
        padding: 4px 10px;
        background: #f3e1c9;
        border-radius: 999px;
        color: #5a3b1f;
        white-space: nowrap;
    }

    .room-desc {
        font-size: 14px;
        color: #5f4a3b;
        line-height: 1.6;
    }

    /* Paragraf pembuka */
    .room-desc p {
        margin-bottom: 6px;
    }

    /* List fasilitas */
    .room-desc ul {
        padding-left: 18px;
        margin: 0;
    }

    .room-desc li {
        list-style-type: disc;
    }


    .room-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        margin-top: 8px;
        flex-wrap: wrap;
    }

    .room-price {
        font-size: 16px;
        font-weight: 600;
        color: #5a3b1f;
    }

    .room-price small {
        display: block;
        font-size: 11px;
        font-weight: 400;
        color: #8f725a;
    }

    .room-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        justify-content: flex-end;
    }

    .btn-main,
    .btn-outline {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 9px 18px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 500;
        text-decoration: none;
        cursor: pointer;
        border: 1px solid transparent;
        transition: background-color 0.22s ease, color 0.22s ease, border-color 0.22s ease, transform 0.15s ease;
        white-space: nowrap;
    }

    .btn-main {
        background-color: #5a3b1f;
        color: #fff;
        border-color: #5a3b1f;
    }

    .btn-main:hover {
        background-color: #af8f6f;
        border-color: #af8f6f;
        text-decoration: none;
        color: #fff;
        transform: translateY(-1px);
    }

    .btn-outline {
        background-color: transparent;
        color: #5a3b1f;
        border-color: #d2b399;
    }

    .btn-outline:hover {
        background-color: #f3e5d2;
        text-decoration: none;
        color: #5a3b1f;
        transform: translateY(-1px);
    }

    @media (max-width: 992px) {
        .unit-hero-overlay {
            padding-left: 7%;
        }

        .unit-hero-overlay h1 {
            font-size: 34px;
        }

        .room-section {
            padding: 10px 6% 50px 6%;
        }
    }

    @media (max-width: 768px) {
        .unit-hero {
            height: 240px;
        }

        .unit-hero-overlay {
            padding-left: 6%;
        }

        .unit-hero-overlay h1 {
            font-size: 28px;
        }

        .room-section-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .room-card,
        .room-card.reverse {
            flex-direction: column;
        }

        .room-card-img-wrapper {
            flex: unset;
        }

        .room-meta {
            flex-direction: column;
            align-items: flex-start;
        }

        .room-actions {
            justify-content: flex-start;
        }
    }
</style>

  <h1 class="page-title">UNIT KAMI</h1>
  <img src="{{ asset('images/kamar.png') }}" alt="Room Banner" class="banner">

{{-- SECTION LIST UNIT --}}
<div class="room-section">

    <div class="room-list">
        @forelse ($unit as $index => $item)
            <div class="room-card {{ $index % 2 == 1 ? 'reverse' : '' }}">
                <div class="room-card-img-wrapper">
                    <img src="{{ asset('storage/'.$item->gambar) }}" alt="{{ $item->nama_unit }}">
                    <div class="room-tag">
                        {{-- contoh: bisa ganti dengan tipe kamar kalau ada field type --}}
                        {{ strtoupper($item->nama_unit) }}
                    </div>
                </div>

                <div class="room-info">
                    <div>
                        
                        <h2 class="room-info-title">{{ $item->nama_unit }}</h2>
                        <div class="room-desc">
                            @php
                                $lines = explode("\n", $item->deskripsi);
                            @endphp
                            <p>{{ $lines[0] }}</p>

                            @if(count($lines) > 1)
                                <ul>
                                    @foreach(array_slice($lines, 1) as $fasilitas)
                                        <li>{{ $fasilitas }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>

                    <div class="room-meta">
                        <div class="room-price">
                            Rp {{ number_format($item->harga, 0, ',', '.') }}
                            <small>per night</small>
                        </div>
                        <div class="room-actions">
                            <a href="{{ route('booking.create', ['unit' => $item->id_unit]) }}" class="btn-main">
                                Book Now
                            </a>
                            <a href="{{ route('detail.unit', ['id' => $item->id_unit]) }}" class="btn-outline">
                                See Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p>Tidak ada unit yang tersedia saat ini.</p>
        @endforelse
    </div>
</div>
@endsection
