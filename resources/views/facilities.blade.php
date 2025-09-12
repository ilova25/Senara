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
      display: block;
    }

    .page-title {
      font-size: 42px;
      margin: 40px 10% 20px;
      font-weight: 400;
    }

    .facility-list {
      display: grid;
      grid-template-columns: repeat(3, 1fr); /* 3 kolom */
      gap: 40px;
      padding: 20px 10%;
    }

    .facility-card img {
      width: 100%;
      border-radius: 10px;
      object-fit: cover;
    }

  </style>




  <h1 class="page-title">OUR FACILITY</h1>
  <img src="{{ asset('images/banner-fasilitas.png') }}" alt="Facilities Banner" class="banner">

  <div class="facility-list">
    @for ($i = 0; $i < 6; $i++)
    <div class="facility-card">
      <img src="{{ asset('images/fasilitas.png') }}" alt="Facility">
    </div>
    @endfor
  </div>

@endsection