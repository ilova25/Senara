<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Our Room - Senara Guest House</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
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

    nav {
      font-family: sans-serif;
    }

    header {
      padding: 20px 10%;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 1px solid #ccc;
    }

    header nav {
  margin-left: 950px;
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

    .footer {
      text-align: center;
      padding: 20px;
      border-top: 1px solid #ccc;
      font-size: 14px;
      font-style: italic;
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
</head>
<body>

<header>
  <div>Senara Guest House</div>
  <nav>
    <a href="{{ route('home2') }}">Home</a>
    <a href="{{ route('rooms2') }}" class="active">Rooms</a>
    <a href="{{ route('facilities2') }}">Facilities</a>
    <a href="{{ route('booking') }}">Booking</a>
  </nav>
   @if (session('user'))
  <a href="{{ route('profile') }}">
    <img src="{{ asset('images/profile.jpg') }}" alt="Profile" class="profile-avatar">
  </a>
@else
  <a href="{{ route('profile') }}">
    <img src="{{ asset('images/profile.jpg') }}" alt="Profile" class="profile-avatar">
  </a>
@endif
</header>

<h1 class="page-title">OUR ROOM</h1>
<img src="{{ asset('images/kamar.png') }}" alt="Room Banner" class="banner">

<div class="room-list">
  @for ($i = 0; $i < 4; $i++)
  <div class="room-card {{ $i % 2 == 1 ? 'reverse' : '' }}">
    <img src="{{ asset('images/room.png') }}" alt="Deluxe Room">
    <div class="room-info">
      <h3>Deluxe Room</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
      <p class="price">Price : <strong>Rp 450.000</strong> / Night</p>
      <p>Available : 2 Adult | 1 Child</p>
      <a href="{{ route('booking') }}" class="book-btn">Book Now</a>
    </div>
  </div>
  @endfor
</div>

<div class="footer">
  Copyright &copy; RPL Grafika 2025
</div>

</body>
</html>
