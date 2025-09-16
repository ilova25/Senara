@extends('layout.app')

@section('content')
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body {
      background-color: #fff;
      color: #333;
      font-family: 'Poppins', sans-serif;
    }

    .banner {
      width: 100%;
      height: auto;
    }

    .page-title {
      text-align: left;
      transform: translateX(-5px);
      font-size: 42px;
      margin: 40px 10% 20px;
      font-weight: 400;
    }

    .room-list {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 40px;
      padding: 20px 10%;
    }

    .room-card {
      display: flex;
      width: 100%;
      max-width: 1120px;
      gap: 170px;
      margin-bottom: 40px;
    }

    .room-card.reverse {
      flex-direction: row-reverse;
    }

    .room-card img {
      width: 60%;
      height: auto;
      border-radius: 10px;
      object-fit: cover;
    }

    .room-card:not(.reverse) img {
      margin-left: -200px;
    }

    .room-card.reverse img {
      margin-right: -200px;
    }

    .room-info {
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .room-info h3 {
      font-size: 45px;
      font-weight: 550;
      margin-bottom: 30px; /* jarak bawah dari judul */
    }

    .room-info p {
      font-size: 20px;
      margin-bottom: 30px; /* jarak antar paragraf */
    }

    .room-info .price {
      font-weight: bold;
    }

    .room-info p:last-of-type {
      margin-bottom: 30px; /* jarak sebelum tombol */
    }

    .book-btn {
      background-color: #5A3B1F;
      color: white;
      border: none;
      padding: 12px 24px;
      font-size: 16px;
      border-radius: 8px;
      cursor: pointer;
      width: fit-content;
      text-decoration: none;
    }

    .book-btn:hover {
      background-color: #AF8F6F;
    }

    @media (max-width: 768px) {
      .room-card {
        flex-direction: column !important;
        align-items: center;
      }

      .room-card img {
        width: 100%;
        margin: 0 !important; /* reset margin negatif di mobile */
      }
    }
  </style>

  <h1 class="page-title">OUR ROOM</h1>
  <img src="{{ asset('images/kamar.png') }}" alt="Room Banner" class="banner">

  <div class="room-list">
    @foreach ($unit as $item)
      <div class="room-card">
        <img src="{{ asset('storage/unit/'.$item->gambar) }}" alt="Deluxe Room">
        <div class="room-info">
          <h3>{{ $item->nama_unit }}</h3>
          <p>{{strip_tags($item->deskripsi)}}</p>
          <p class="price">Price : <strong>{{$item->harga}}</strong> / Night</p>
          <p>Available For : {{$item->available}}</p>
          <a href="{{ route('booking.create') }}" class="book-btn">Book Now</a>
        </div>
      </div> 
    @endforeach
  </div>
@endsection

