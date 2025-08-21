<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Our Facility - Senara Guest House</title>
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

    .footer {
      text-align: center;
      padding: 20px;
      border-top: 1px solid #ccc;
      font-size: 14px;
      font-style: italic;
    }
  </style>
</head>
<body>

<header>
  <div>Senara Guest House</div>
  <nav>
    <a href="{{ route('home2') }}">Home</a>
    <a href="{{ route('rooms2') }}">Rooms</a>
    <a href="{{ route('facilities2') }}" class="active">Facilities</a>
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

<h1 class="page-title">OUR FACILITY</h1>
<img src="{{ asset('images/banner-fasilitas.png') }}" alt="Facilities Banner" class="banner">

<div class="facility-list">
  @for ($i = 0; $i < 6; $i++)
  <div class="facility-card">
    <img src="{{ asset('images/fasilitas.png') }}" alt="Facility">
  </div>
  @endfor
</div>

<div class="footer">
  Copyright &copy; RPL Grafika 2025
</div>

</body>
</html>
