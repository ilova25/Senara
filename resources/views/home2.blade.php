<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Senara Guest House</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
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
    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 10%;
      border-bottom: 1px solid #ccc;
    }
    .login-btn {
  background-color: #5A3B1F;
  color: white;
  padding: 10px 20px;
  border-radius: 10px;
  transition: all 0.3s ease;
}

.login-btn:hover {
  background-color: #AF8F6F;
  color: white;
}

header nav {
  margin-left: 950px;
}

    header nav a {
  margin-left: 20px;
  text-decoration: none;
  color: #333;
}

header nav a:hover {
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
    .hero {
      text-align: center;
      padding: 60px 10%;
    }
    .hero h1 {
      font-size: 64px;
      font-weight: 700;
      line-height: 1.2;
    }
    .left-text {
      display: block;
      text-align: left;
      transform: translateX(100px);
      font-size: 120px;
      font-weight: 90;
    }
    .right-text {
      display: block;
      text-align: right;
      transform: translateX(-60px);
      font-size: 100px;
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
      font-size: 18px;
      text-align: left;
      transform: translateX(165px);
    }
    .hero-row button {
      background-color: #5A3B1F;
      color: white;
      border: none;
      padding: 15px 30px;
      width: 320px;
      font-size: 18px;
      cursor: pointer;
      border-radius: 30px;
      white-space: nowrap;
      transform: translateX(170px);
    }
    .image-banner img {
      width: 100%;
      height: auto;
    }
    .section {
      padding: 40px 8%;
    }
    .section h2 {
      text-align: center;
      margin-bottom: 30px;
      font-size: 30px;
      transform: none;
    }
    .rooms, .facilities, .promotions {
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
      width: 360px;
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
      width: 260px;
      text-align: center;
      cursor: pointer;
      transition: all 0.3s ease;
    }
    .facility-card img {
      width: 90px;
      height: 90px;
      margin-bottom: 15px;
    }
    .facility-card h4 {
      font-size: 20px;
      margin-bottom: 8px;
    }
    .facility-card p {
      font-size: 16px;
    }
    .facility-card:hover {
      background-color: #5A3B1F;
      color: white;
    }
    .facility-card:hover h4,
    .facility-card:hover p {
      color: white;
    }
    .footer {
      text-align: center;
      padding: 20px;
      border-top: 1px solid #ccc;
      font-size: 14px;
      font-style: italic;
    }
    .package-section {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 40px 8%;
      gap: 40px;
    }
    .package-left {
      flex: 1;
      transform: translateX(235px);
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
    .package-gallery img {
      width: 200px;
      height: 300px;
      object-fit: cover;
      border-radius: 10px;
    }
    .arrow {
      font-size: 30px;
      cursor: pointer;
      color: #000;
      user-select: none;
    }
    @media (max-width: 768px) {
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
    }
    


  </style>
</head>
<body>
<header>
  <div>Senara Guest House</div>
  <nav>
    <a href="{{ route('home2') }}">Home</a>
    <a href="{{ route('rooms2') }}">Rooms</a>
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
<div class="hero">
  <h1>
    <span class="left-text">WELCOME TO</span>
    <span class="right-text">SENARA GUEST HOUSE</span>
  </h1>
  <div class="hero-row">
    <p>Welcome to Senara Guest House, a destination of elegance, comfort, and refined living.</p>
    <a href="{{ route('booking') }}">
    <button>Book Now</button>
  </a>
  </div>
</div>
<div class="image-banner">
  <img src="images/lobby.png" alt="Lobby"> 
</div>
<section class="section">
  <p style="text-align: left; font-size: 22px; color: #AF8F6F; margin-left: 30px; transform: translateX(600px);">Room</p>
  <h2>Our Exclusive Room</h2>
  <div class="rooms">
    <div class="card">
      <img src="images/room.png" alt="Room">
      <div class="info">
        <h3>Deluxe Room</h3>
        <p>Lorem ipsum dolor sit amet</p>
        <div class="button-group">
          <a href="{{ route('rooms2') }}">
  <button class="see-detail-btn">See Detail</button>
</a>
          <a href="{{ route('booking') }}">
    <button>Book Now</button>
  </a>
        </div>
      </div>
    </div>
    <div class="card">
      <img src="images/room.png" alt="Room">
      <div class="info">
        <h3>Deluxe Room</h3>
        <p>Lorem ipsum dolor sit amet</p>
        <div class="button-group">
          <a href="{{ route('rooms2') }}">
  <button class="see-detail-btn">See Detail</button>
</a>
          <a href="{{ route('booking') }}">
    <button>Book Now</button>
  </a>
        </div>
      </div>
    </div>
    <div class="card">
      <img src="images/room.png" alt="Room">
      <div class="info">
        <h3>Deluxe Room</h3>
        <p>Lorem ipsum dolor sit amet</p>
        <div class="button-group">
          <a href="{{ route('rooms2') }}">
  <button class="see-detail-btn">See Detail</button>
</a>
          <a href="{{ route('booking') }}">
    <button>Book Now</button>
  </a>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="section">
  <p style="text-align: left; font-size: 22px; color: #AF8F6F; margin-left: 30px; transform: translateX(500px);">Facilities</p>
  <h2>Luxury and Comfort, Redefined</h2>
  <div class="facilities">
    <div class="facility-card">
      <img src="images/pool.png" alt="Public Pool">
      <h4>Public Pool</h4>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
    </div>
    <div class="facility-card">
      <img src="images/gym.png" alt="Gym">
      <h4>Gym</h4>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
    </div>
    <div class="facility-card">
      <img src="images/laundry.png" alt="Laundry">
      <h4>Laundry</h4>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
    </div>
    <div class="facility-card">
      <img src="images/spa.png" alt="SPA">
      <h4>SPA</h4>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
    </div>
  </div>
</section>
<section class="package-section">
  <div class="package-left">
    <p>Packages</p>
    <h2>Make Your Memorable Moments</h2>
    <button>Book Now</button>
  </div>
  <div class="package-gallery">
    <div class="arrow">&#x276E;</div>
    <img src="images/wedding.png" alt="Wedding">
    <img src="images/birthday.png" alt="Birthday">
    <img src="images/event.png" alt="Event">
    <div class="arrow">&#x276F;</div>
  </div>
</section>
<section class="section">
  <div style="padding-left: 235px;">
    <p style="text-align: left; font-size: 22px; color: #AF8F6F;">Promotion</p>
    <h2 style="text-align: left;">Get Promo for a Cheaper Price</h2>
  </div>
  <div class="promotions">
    <img src="images/promo1.png" alt="Flash Sale" class="card" style="width: 540px;">
    <img src="images/promo2.png" alt="Long Stay" class="card" style="width: 540px;">
  </div>
</section>
<div class="footer">
  Copyright © RPL Grafika 2025
</div>
</body>
</html>
