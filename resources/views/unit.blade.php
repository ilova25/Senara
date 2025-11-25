@extends('layout.app')

@section('content')
  <style>
    /* Reset dasar */
    /* * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    } */

    .container-fluid {
      padding-left: 0 !important;
      padding-right: 0 !important;
    }

    body {
      background-color: #fff;
      color: #333;
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
  padding-left: 50px; /* bisa diganti 5% juga */
  font-weight: 400;
}


    .room-list {
      display: flex;
      flex-direction: column;
      gap: 40px;
      padding: 20px 10%;
    }

    .room-card {
      display: flex;
      max-width: 1120px;
      width: 100%;
      gap: 40px;
      margin-bottom: 40px;
      align-items: center;
    }

    .room-card.reverse {
      flex-direction: row-reverse;
    }

    .room-card img {
      width: 50%;
      max-width: 500px;
      height: auto;
      max-height: 400px;
      border-radius: 10px;
      object-fit: cover;
    }

    .room-info {
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .room-info h3 {
      font-size: 36px;
      font-weight: 550;
      margin-bottom: 20px;
    }

    .room-info p {
      font-size: 18px;
      margin-bottom: 20px;
    }

    .room-info .price {
      font-weight: bold;
    }

    .book-btn {
      background-color: #5A3B1F;
      color: white;
      border: none;
      padding: 10px 20px;
      font-size: 16px;
      border-radius: 8px;
      cursor: pointer;
      width: fit-content;
      text-decoration: none;
      transition: background-color 0.3s ease;
    }

    .book-btn:hover {
      background-color: #AF8F6F;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .room-card {
        flex-direction: column !important;
        text-align: center;
      }

      .room-card img {
        width: 100%;
        max-width: none;
      }

      .room-info h3 {
        font-size: 28px;
      }

      .room-info p {
        font-size: 16px;
      }
    }
  </style>

  <h1 class="page-title">OUR UNIT</h1>
  <img src="{{ asset('images/kamar.png') }}" alt="Room Banner" class="banner">

  <div class="room-list">
    @foreach ($unit as $index => $item)
      <div class="room-card {{ $index % 2 == 1 ? 'reverse' : '' }}">
        <img src="{{ asset('storage/'.$item->gambar) }}" alt="{{ $item->nama_unit }}">
        <div class="room-info">
          <h3>{{ $item->nama_unit }}</h3>
          <p>{{ strip_tags($item->deskripsi) }}</p>
          <p class="price">Price : <strong>{{ number_format($item->harga, 0, ',', '.') }}</strong> / Night</p>
          <div>
          <a href="{{ route('booking.create') }}" class="book-btn">Book Now</a>
          <a href="{{ route('detail.unit', ['id' => $item->id_unit]) }}" class="book-btn">See Detail</a>
          </div>
        </div>
      </div> 
    @endforeach
  </div>
@endsection
