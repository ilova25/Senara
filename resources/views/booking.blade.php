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
    

    header {
      padding: 20px 10%;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 1px solid #ccc;
    }

    header nav {
      display: flex;
      align-items: center;
      gap: 5px;
      /* jarak antar menu */
      margin-left: auto;
      /* otomatis dorong nav ke kanan */
    }

    nav a {
      margin-left: 20px;
      text-decoration: none;
      color: #333;
      font-weight: 500;
    }

    nav a:hover,
    nav .active {
      color: #AF8F6F;
    }

    .profile-avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid #5A3B1F;
      transition: transform 0.3s ease;
    }

    .profile-avatar:hover {
      transform: scale(1.1);
    }

    .profile-wrapper {
      margin-left: 30px;
      /* atur sesuai kebutuhan */
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

    /* Enhanced Booking Form Styles */
    .booking-container {
      background: linear-gradient(135deg, #f8f6f4 0%, #ffffff 100%);
      padding: 40px 0;
      min-height: calc(100vh - 400px);
    }

    .booking-form {
      width: 100%;
      max-width: none;
      margin: 0;
      background: #ffffff;
      padding: 50px 10%;
      border-radius: 0;
      box-shadow: 0 20px 60px rgba(90, 59, 31, 0.1);
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 40px;
      position: relative;
      overflow: hidden;
    }

    .booking-form::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(90deg, #5A3B1F, #AF8F6F, #5A3B1F);
    }

    .form-title {
      grid-column: span 2;
      text-align: center;
      font-size: 32px;
      font-weight: 600;
      color: #5A3B1F;
      margin-bottom: 20px;
      position: relative;
    }

    .form-title::after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: 3px;
      background: linear-gradient(90deg, #5A3B1F, #AF8F6F);
      border-radius: 2px;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      position: relative;
    }

    .form-group label {
      margin-bottom: 8px;
      font-weight: 600;
      font-size: 16px;
      color: #5A3B1F;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      font-size: 14px;
    }

    .form-group input,
    .form-group select {
      padding: 16px 20px;
      border: 2px solid #e8e8e8;
      border-radius: 12px;
      font-size: 16px;
      font-family: 'Poppins', sans-serif;
      width: 100%;
      transition: all 0.3s ease;
      background: #fafafa;
    }

    .form-group input:focus,
    .form-group select:focus {
      outline: none;
      border-color: #AF8F6F;
      background: #ffffff;
      box-shadow: 0 0 0 4px rgba(175, 143, 111, 0.1);
      transform: translateY(-1px);
    }

    .form-group input:hover,
    .form-group select:hover {
      border-color: #d0d0d0;
      background: #ffffff;
    }

    /* Enhanced Guests Section */
    .guests-wrapper {
      display: flex;
      gap: 15px;
      width: 100%;
    }

    .guests-wrapper select {
      flex: 1;
      background-image: linear-gradient(45deg, transparent 50%, #AF8F6F 50%),
        linear-gradient(135deg, #AF8F6F 50%, transparent 50%);
      background-position: right 15px center, right 10px center;
      background-size: 5px 5px, 5px 5px;
      background-repeat: no-repeat;
      padding-right: 40px;
    }

    /* Special styling for date inputs */
    .form-group input[type="date"] {
      position: relative;
      padding-right: 20px;
    }

    /* Enhanced Button */
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
      grid-column: span 2;
      display: block;
      text-align: center;
      padding: 20px;
      background: linear-gradient(135deg, #5A3B1F 0%, #4a2f1a 100%);
      color: white;
      border: none;
      font-size: 18px;
      font-weight: 600;
      cursor: pointer;
      border-radius: 15px;
      text-decoration: none;
      margin-top: 20px;
      position: relative;
      overflow: hidden;
      text-transform: uppercase;
      letter-spacing: 1px;
      transition: all 0.3s ease;
      box-shadow: 0 8px 25px rgba(90, 59, 31, 0.3);
    }

    .btn-book:hover {
      background-color: #4b3224;
    }
    .btn-book::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
      transition: left 0.5s;
    }

    .btn-book:active {
      transform: translateY(0);
      box-shadow: 0 4px 15px rgba(90, 59, 31, 0.3);
    }

    /* Form decorative elements */
    .form-group::before {
      content: '';
      position: absolute;
      left: 0;
      bottom: 0;
      height: 2px;
      width: 0;
      background: linear-gradient(90deg, #5A3B1F, #AF8F6F);
      transition: width 0.3s ease;
    }

    .form-group:focus-within::before {
      width: 100%;
    }

    
    .footer {
      text-align: center;
      padding: 20px;
      border-top: 1px solid #ccc;
      font-size: 14px;
      font-style: italic;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .booking-form {
        grid-template-columns: 1fr;
        padding: 30px 20px;
        margin: 20px;
      }

      .form-title {
        grid-column: span 1;
        font-size: 28px;
      }

      .btn-book {
        grid-column: span 1;
      }

      .guests-wrapper {
        flex-direction: column;
        gap: 10px;
      }
    }
  </style>

  <h1 class="page-title">Booking</h1>
  <img src="{{ asset('images/banner-fasilitas.png') }}" alt="Booking Banner" class="banner">
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
  <div class="booking-container">
    <form class="booking-form" action="{{ route('payment') }}" method="POST">
      @csrf
      <div class="form-title">Booking Your Perfect Stay</div>

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
        <label>Check In</label>
        <input type="date" name="checkin">
      </div>

      <div class="form-group">
        <label>Check Out</label>
        <input type="date" name="checkout">
      </div>

      <div class="form-group">
        <label>Room</label>
        <select name="room" id="roomSelect">
          <option value="">Select Room</option>
          <option value="unit1">Unit 1 - Deluxe Room</option>
          <option value="unit2">Unit 2 - Deluxe Room</option>
          <option value="unit3">Unit 3 - Deluxe Room</option>
          <option value="unit4">Unit 4 - Deluxe Room</option>
          <option value="unit5">Unit 5 - Deluxe Room</option>
          <option value="unit6">Unit 6 - Deluxe Room</option>
        </select>
      </div>

      <div class="form-group">
        <label>Price</label>
        <input type="text" name="promo" id="priceInput" readonly>
      </div>

    <button type="submit" class="btn-book">Booking</button>
  </form>
      <button type="submit" class="btn-book">Booking</button>
    </form>
  </div>

@endsection



  {{-- <script>
    document.getElementById('roomSelect').addEventListener('change', function() {
      const priceInput = document.getElementById('priceInput');
      const roomPrices = {
        'unit1': 'Rp 500,000',
        'unit2': 'Rp 450,000',
        'unit3': 'Rp 550,000',
        'unit4': 'Rp 600,000',
        'unit5': 'Rp 475,000',
        'unit6': 'Rp 525,000'
      };
      
      if (this.value && roomPrices[this.value]) {
        priceInput.value = roomPrices[this.value];
      } else {
        priceInput.value = '';
      }
    });
  </script> --}}