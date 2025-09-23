@extends('layout.app')

@section('content')
<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Roboto', sans-serif;
  }

  body {
    background: #fff;
    color: #333;
    line-height: 1.6;
    overflow-x: hidden;
  }

  /* === HERO SECTION === */
  .hero {
    text-align: center;
    padding: 60px 10%;
  }

  .hero h1 {
    font-size: 64px;
    font-weight: 500;
    line-height: 1.2;
  }

  .left-text {
    display: block;
    text-align: left;
    transform: translateX(-10px);
    font-size: 95px;
    font-weight: 300;
  }

  .right-text {
    display: block;
    text-align: right;
    transform: translateX(10px);
    font-size: 77px;
    font-weight: 200;
  }

  .hero-row {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 20px;
    margin-top: 20px;
    flex-wrap: wrap;
  }

  .hero-row p {
    margin: 0;
    font-size: 14px;
    text-align: left;
    transform: translateX(105px);
  }

  .hero-row button {
    background-color: #5A3B1F;
    color: white;
    border: none;
    padding: 15px 30px;
    width: 250px;
    font-size: 18px;
    cursor: pointer;
    border-radius: 30px;
    white-space: nowrap;
    transform: translateX(105px);
  }

  /* === SLIDER === */
  .image-banner {
    width: 100vw;
    margin-left: -15px;
    position: relative;
    overflow: hidden;
  }

  .slider {
    position: relative;
    width: 100%;
    overflow: hidden;
  }

  .slides {
    display: flex;
    transition: transform 0.5s ease-in-out;
    width: 100%;
  }

  .slides img {
    width: 100%;
    flex-shrink: 0;
  }

  .prev,
  .next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 50px;
    height: 50px;
    background: rgba(255, 255, 255, 0.8);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    color: #5A3B1F;
    font-weight: bold;
    cursor: pointer;
    user-select: none;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
  }

  .prev:hover,
  .next:hover {
    background: #5A3B1F;
    color: #fff;
    transform: translateY(-50%) scale(1.1);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
  }

  .prev {
    left: 20px;
  }

  .next {
    right: 20px;
  }

  /* === SECTION & CARD === */
  .section {
    padding: 40px 8%;
  }

  .section h2 {
    text-align: center;
    margin-bottom: 30px;
    font-size: 30px;
    transform: none;
  }

  .rooms,
  .facilities,
  .promotions {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 30px;
    max-width: 1200px;
    margin: 30px auto 0 auto;
  }

  .card {
    border: 1px solid #ccc;
    border-radius: 8px;
    overflow: hidden;
    width: 320px;
    text-align: center;
  }

  .card img {
    width: 100%;
    height: 280px;
    object-fit: cover;
  }

  .card .info {
    padding: 15px;
    text-align: left;
  }

  .card .info h3 {
    margin-bottom: 5px;
  }

  .card .info p {
    margin-bottom: 15px;
  }

  .card .info .button-group {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-top: 10px;
    margin-bottom: 10px;
  }

  .card .info button {
    background-color: transparent;
    color: #5A3B1F;
    border: 2px solid #5A3B1F;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    transition: all 0.3s ease;
  }

  .card .info button:hover {
    background-color: #5A3B1F;
    color: white;
  }

  .see-detail-btn:hover {
    background-color: transparent !important;
    color: #5A3B1F !important;
  }

  .facility-card {
    padding: 20px;
    border-radius: 8px;
    border: 1px solid #ccc;
    width: 230px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
  }

  .facility-card img {
    width: 90px;
    height: 90px;
    margin-bottom: 15px;
  }

  .facility-card:hover {
    background-color: #5A3B1F;
    color: white;
  }

  .facility-card:hover img {
    filter: brightness(0) invert(1);
    transition: all 0.3s ease;
  }

  .facility-card:hover h4,
  .facility-card:hover p {
    color: white;
  }

  /* === PACKAGE SECTION === */
  .package-section {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 40px 8%;
    gap: 40px;
  }

  .package-left {
    flex: 1;
    transform: translateX(20px);
  }

  .package-left p {
    font-size: 22px;
    color: #AF8F6F;
    margin-bottom: 10px;
  }

  .package-left h2 {
    font-size: 36px;
    margin: 0 0 20px 0;
  }

  .package-left button {
    background-color: #5A3B1F;
    color: white;
    border: none;
    padding: 12px 25px;
    font-size: 16px;
    border-radius: 25px;
    cursor: pointer;
  }

  .package-gallery {
    flex: 3;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 20px;
    transform: translateX(-5px);
  }

  .package-slider {
    width: 660px;
    overflow: hidden;
    position: relative;
  }

  .package-slides {
    display: flex;
    gap: 20px;
    transition: transform 0.5s ease-in-out;
    width: fit-content;
  }

  .package-slides img {
    width: 200px;
    height: 300px;
    object-fit: cover;
    border-radius: 10px;
    flex-shrink: 0;
  }

  .arrow {
    font-size: 30px;
    cursor: pointer;
    color: #5A3B1F;
    user-select: none;
    transition: all 0.3s ease;
    padding: 10px;
    border-radius: 50%;
    background: rgba(90, 59, 31, 0.1);
  }

  .arrow:hover {
    background: #5A3B1F;
    color: white;
    transform: scale(1.1);
  }

  /* === PROMO === */
  .promo-code {
    background: linear-gradient(135deg, #5A3B1F, #AF8F6F);
    color: white;
    padding: 20px;
    border-radius: 10px;
    margin: 20px 0;
    position: relative;
    overflow: hidden;
  }

  .promo-code::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
    animation: shine 2s infinite;
  }

  .promo-code h3 {
    font-size: 24px;
    margin-bottom: 10px;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
  }

  .promo-code p {
    font-size: 32px;
    font-weight: bold;
    letter-spacing: 3px;
    margin: 15px 0;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
  }

  .copy-btn {
    background: #fff;
    color: #5A3B1F;
    border: none;
    padding: 10px 20px;
    border-radius: 25px;
    cursor: pointer;
    font-weight: bold;
    transition: all 0.3s ease;
    margin-top: 10px;
  }

  .copy-btn:hover {
    background: #f0f0f0;
    transform: scale(1.05);
  }

  /* === ROOM SECTION RESPONSIVE === */
  .rooms .card {
    flex: 0 0 calc(33.333% - 20px);
  }

  @media (max-width: 992px) {
    .rooms .card {
      flex: 0 0 calc(50% - 20px);
    }
  }

  @media (max-width: 768px) {
    .rooms .card {
      flex: 0 0 100%;
    }

    .package-section {
      flex-direction: column;
      align-items: flex-start;
      padding: 30px;
    }

    .package-left {
      transform: none;
    }

    .package-gallery {
      flex-wrap: wrap;
      justify-content: flex-start;
    }

    .package-slider {
      width: 100%;
    }
  }

  @keyframes shine {
    0% {
      transform: translateX(-100%) translateY(-100%) rotate(45deg);
    }
    100% {
      transform: translateX(100%) translateY(100%) rotate(45deg);
    }
  }
</style>

{{-- HERO --}}
<div class="hero">
  <h1>
    <span class="left-text">WELCOME TO</span>
    <span class="right-text">SENARA GUEST HOUSE</span>
  </h1>
  <div class="hero-row">
    <p>Welcome to Senara Guest House, a destination of elegance, comfort, and refined living.</p>
    <a href="{{ route('booking.create') }}">
      <button>Book Now</button>
    </a>
  </div>
</div>

{{-- SLIDER --}}
<div class="image-banner">
  <div class="slider">
    <div class="slides">
      <img src="{{ asset('images/lobby.png') }}" alt="Lobby 1">
      <img src="{{ asset('images/lobby.png') }}" alt="Lobby 2">
      <img src="{{ asset('images/lobby.png') }}" alt="Lobby 3">
    </div>
    <span class="prev">&#10094;</span>
    <span class="next">&#10095;</span>
  </div>
</div>

{{-- ROOMS --}}
<section class="section">
  <p style="text-align:left; font-size:22px; color:#AF8F6F; margin-left:20px; transform:translateX(330px);">Room</p>
  <h2>Our Exclusive Room</h2>
  <div class="rooms">
    <div class="card">
      <img src="{{ asset('images/room.png') }}" alt="Room">
      <div class="info">
        <h3>Deluxe Room</h3>
        <p>Lorem ipsum dolor sit amet</p>
        <div class="button-group">
          <a href="{{ route('unit') }}"><button class="see-detail-btn">See Detail</button></a>
          <a href="{{ route('booking.create') }}"><button>Book Now</button></a>
        </div>
      </div>
    </div>
    <div class="card">
      <img src="{{ asset('images/room.png')}}" alt="Room">
      <div class="info">
        <h3>Deluxe Room</h3>
        <p>Lorem ipsum dolor sit amet</p>
        <div class="button-group">
          <a href="{{ route('unit') }}"><button class="see-detail-btn">See Detail</button></a>
          <a href="{{ route('booking.create') }}"><button>Book Now</button></a>
        </div>
      </div>
    </div>
    <div class="card">
      <img src="{{ asset('images/room.png')}}" alt="Room">
      <div class="info">
        <h3>Deluxe Room</h3>
        <p>Lorem ipsum dolor sit amet</p>
        <div class="button-group">
          <a href="{{ route('unit') }}"><button class="see-detail-btn">See Detail</button></a>
          <a href="{{ route('booking.create') }}"><button>Book Now</button></a>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- FACILITIES --}}
<section class="section">
  <p style="text-align:left; font-size:22px; color:#AF8F6F; margin-left:30px; transform:translateX(215px);">Facilities</p>
  <h2>Luxury and Comfort, Redefined</h2>
  <div class="facilities">
    <div class="facility-card">
      <img src="{{ asset('images/parking.png') }}" alt="Parking Area">
      <h4>Parking Area</h4>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
    </div>
    <div class="facility-card">
      <img src="{{ asset('images/bathroom.png') }}" alt="Bathroom">
      <h4>Bathroom</h4>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
    </div>
    <div class="facility-card">
      <img src="{{ asset('images/balcon.png') }}" alt="Laundry">
      <h4>Balcony</h4>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
    </div>
    <div class="facility-card">
      <img src="{{ asset('images/living room.png') }}" alt="SPA">
      <h4>Living Room</h4>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
    </div>
  </div>
</section>

{{-- PACKAGE --}}
<section class="package-section">
  <div class="package-left">
    <p>Packages</p>
    <h2>Make Your Memorable Moments</h2>
    <button>Book Now</button>
  </div>
  <div class="package-gallery">
    <div class="arrow package-prev">&#10094;</div>
    <div class="package-slider">
      <div class="package-slides">
        <img src="{{ asset('images/wedding.png') }}" alt="Wedding">
        <img src="{{ asset('images/birthday.png') }}" alt="Birthday">
        <img src="{{ asset('images/event.png') }}" alt="Event">
        <img src="{{ asset('images/wedding.png') }}" alt="Wedding 2">
        <img src="{{ asset('images/birthday.png') }}" alt="Birthday 2">
        <img src="{{ asset('images/event.png') }}" alt="Event 2">
      </div>
    </div>
    <div class="arrow package-next">&#10095;</div>
  </div>
</section>

{{-- PROMO --}}
<section class="section">
  <div style="padding-left:125px;">
    <p style="text-align:left; font-size:22px; color:#AF8F6F;">Promotion</p>
    <h2 style="text-align:left;">Get Promo for a Cheaper Price</h2>
  </div>
  <div class="promotions">
    <img src="{{ asset('images/promo1.png') }}" alt="Flash Sale" class="card promo-image" style="width:490px;" onclick="openModal('flashSaleModal')">
    <img src="{{ asset('images/promo2.png') }}" alt="Long Stay" class="card promo-image" style="width:490px;" onclick="openModal('longStayModal')">
  </div>
</section>

{{-- MODALS --}}
<!-- Flash Sale Modal -->
<div id="flashSaleModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal('flashSaleModal')">&times;</span>
    <h2 style="color:#5A3B1F; margin-bottom:20px;">🔥 Flash Sale Promo!</h2>
    <p style="margin-bottom:20px;">Get up to 50% off on selected rooms! Limited time offer.</p>
    <div class="promo-code">
      <h3>Use Code:</h3>
      <p id="flashSaleCode">FLASH50</p>
      <button class="copy-btn" onclick="copyCode('flashSaleCode')">Copy Code</button>
    </div>
  </div>
</div>

<!-- Long Stay Modal -->
<div id="longStayModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal('longStayModal')">&times;</span>
    <h2 style="color:#5A3B1F; margin-bottom:20px;">🛌 Long Stay Promo!</h2>
    <p style="margin-bottom:20px;">Stay for 7 nights or more and get 30% off!</p>
    <div class="promo-code">
      <h3>Use Code:</h3>
      <p id="longStayCode">LONG30</p>
      <button class="copy-btn" onclick="copyCode('longStayCode')">Copy Code</button>
    </div>
  </div>
</div>

{{-- SCRIPT --}}
<script>
  // Slider
  const slides = document.querySelector('.slides');
  const slideImages = document.querySelectorAll('.slides img');
  let currentIndex = 0;

  document.querySelector('.next').addEventListener('click', () => {
    currentIndex = (currentIndex + 1) % slideImages.length;
    slides.style.transform = `translateX(${-currentIndex * 100}%)`;
  });

  document.querySelector('.prev').addEventListener('click', () => {
    currentIndex = (currentIndex - 1 + slideImages.length) % slideImages.length;
    slides.style.transform = `translateX(${-currentIndex * 100}%)`;
  });

  // Package Slider
  const packageSlides = document.querySelector('.package-slides');
  const packageSlideItems = document.querySelectorAll('.package-slides img');
  let packageIndex = 0;

  document.querySelector('.package-next').addEventListener('click', () => {
    packageIndex = (packageIndex + 1) % packageSlideItems.length;
    packageSlides.style.transform = `translateX(${-packageIndex * 220}px)`;
  });

  document.querySelector('.package-prev').addEventListener('click', () => {
    packageIndex = (packageIndex - 1 + packageSlideItems.length) % packageSlideItems.length;
    packageSlides.style.transform = `translateX(${-packageIndex * 220}px)`;
  });

  // Modals
  function openModal(id) {
    document.getElementById(id).style.display = 'block';
  }

  function closeModal(id) {
    document.getElementById(id).style.display = 'none';
  }

  // Copy promo code
  function copyCode(id) {
    const code = document.getElementById(id).innerText;
    navigator.clipboard.writeText(code).then(() => alert('Promo code copied!'));
  }
</script>

@endsection
