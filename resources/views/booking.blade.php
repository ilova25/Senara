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
      font-family: 'Poppins', sans-serif;
      color: #333;
    }
    
    .page-title {
      font-size: 42px;
      margin: 40px 10% 20px;
      font-weight: 400;
    }
    .banner {
      width: 100%;
      height: auto;
      display: block;
    }
    .booking-form {
      max-width: 1550px; /* Lebih besar */
      margin: 40px auto;
      display: grid;
      grid-template-columns: 1fr 1fr; /* 2 kolom */
      gap: 20px 40px;
    }
    .form-group {
      display: flex;
      flex-direction: column;
      font-size: 14px;
    }
    .form-group label {
      margin-bottom: 6px;
      font-weight: 500;
    }
    .form-group input,
    .form-group select {
      padding: 35px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 20px;
      width: 100%;
    }
    /* Tambahan untuk Guests agar sama panjang */
    .guests-wrapper {
      display: flex;
      gap: 10px;
      width: 100%;
    }
    .guests-wrapper select {
      flex: 1;
    }
    .btn-book {
      grid-column: span 2; 
      display: block; 
      text-align: center; 
      padding: 16px;
      background-color: #5C3D2E;
      color: white;
      border: none;
      font-size: 18px;
      font-weight: bold;
      cursor: pointer;
      border-radius: 4px;
      text-decoration: none; 
    }

    .btn-book:hover {
      background-color: #4b3224;
    }

    
  </style>

  <h1 class="page-title">Booking</h1>
  <img src="{{ asset('images/banner-fasilitas.png') }}" alt="Booking Banner" class="banner">

  <form class="booking-form" action="{{ route('payment') }}" method="POST">
    @csrf
    <div class="form-group">
      <label>Name</label>
      <input type="text" name="name">
    </div>
    <div class="form-group">
      <label>Guests</label>
      <div class="guests-wrapper">
        <select name="adults">
          <option>1 Adult</option>
          <option>2 Adults</option>
          <option>3 Adults</option>
        </select>
        <select name="children">
          <option>1 Child</option>
          <option>2 Children</option>
          <option>3 Children</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label>Check in</label>
      <input type="date" name="checkin">
    </div>
    <div class="form-group">
      <label>Check out</label>
      <input type="date" name="checkout">
    </div>
    <div class="form-group">
      <label>Room</label>
      <select name="room">
        <option>Unit 1</option>
        <option>Unit 2</option>
        <option>Unit 3</option>
        <option>Unit 4</option>
        <option>Unit 5</option>
        <option>Unit 6</option>
      </select>
    </div>
    <div class="form-group">
      <label>Price</label>
      <input type="text" name="promo">
    </div>

    <button type="submit" class="btn-book">Booking</button>
  </form>

@endsection


