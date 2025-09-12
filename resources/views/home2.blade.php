<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Senara Guest House</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
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

    header nav {
      display: flex;
      align-items: center;
      gap: 5px;
      /* jarak antar menu */
      margin-left: auto;
      /* otomatis dorong nav ke kanan */
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

    .profile-wrapper {
      margin-left: 30px;
      /* atur sesuai kebutuhan */
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

    /* Footer Styling */
    .footer {
      background-color: #543310;
      color: white;
      padding: 50px 0 30px;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px;
    }

    .footer-content {
      display: grid;
      grid-template-columns: 1fr 1fr 1fr 2fr;
      gap: 40px;
      margin-bottom: 40px;
    }

    .footer-section h3 {
      color: #AF8F6F;
      font-size: 22px;
      margin-bottom: 20px;
      font-weight: 600;
    }

    .footer-section h3::after {
      content: '';
      display: block;
      width: 30px;
      height: 2px;
      background: #AF8F6F;
      margin-top: 8px;
    }

    .footer-section p {
      line-height: 1.6;
      margin-bottom: 15px;
      color: rgba(255, 255, 255, 0.8);
      font-size: 16px;
    }

    .footer-section ul {
      list-style: none;
    }

    .footer-section ul li {
      margin-bottom: 10px;
    }

    .footer-section ul li a {
      color: rgba(255, 255, 255, 0.8);
      text-decoration: none;
      font-size: 16px;
      transition: color 0.3s ease;
    }

    .footer-section ul li a:hover {
      color: #AF8F6F;
    }

    .footer-section ul li a i {
      margin-right: 8px;
      width: 15px;
    }

    /* Contact Info Styling */
    .contact-item {
      margin-bottom: 15px;
      display: flex;
      align-items: flex-start;
      gap: 10px;
    }

    .contact-item i {
      color: #AF8F6F;
      font-size: 16px;
      margin-top: 2px;
      width: 18px;
    }

    .contact-item div {
      flex: 1;
    }

    .contact-item h4 {
      font-size: 16px;
      color: #AF8F6F;
      margin-bottom: 5px;
    }

    .contact-item p {
      font-size: 16px;
      color: rgba(255, 255, 255, 0.8);
      margin: 0;
      line-height: 1.4;
    }

    /* Maps Section */
    .maps-section {
      margin-top: 20px;
    }

    .map-container {
      width: 100%;
      height: 200px;
      border-radius: 8px;
      overflow: hidden;
      border: 2px solid #74512D;
    }

    .map-container iframe {
      width: 100%;
      height: 100%;
      border: none;
      filter: sepia(20%) hue-rotate(15deg) saturate(0.8);
    }

    /* Social Media */
    .social-links {
      display: flex;
      gap: 15px;
      margin-top: 20px;
    }

    .social-link {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 40px;
      height: 40px;
      background-color: #74512D;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      transition: all 0.3s ease;
    }

    .social-link:hover {
      background-color: #AF8F6F;
      transform: translateY(-2px);
    }

    /* Newsletter */
    .newsletter-form {
      display: flex;
      margin-top: 15px;
      gap: 10px;
    }

    .newsletter-input {
      flex: 1;
      padding: 12px 15px;
      border: 1px solid #74512D;
      border-radius: 5px;
      background: rgba(255, 255, 255, 0.1);
      color: white;
      outline: none;
      font-size: 16px;
    }

    .newsletter-input::placeholder {
      color: rgba(255, 255, 255, 0.6);
    }

    .newsletter-input:focus {
      border-color: #AF8F6F;
    }

    .newsletter-btn {
      padding: 12px 20px;
      background-color: #AF8F6F;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      transition: background-color 0.3s ease;
    }

    /* CSS untuk efek hover tanpa JS */
    .newsletter-btn:hover {
      background-color: #74512D;
      transform: translateY(-1px);
    }

    .newsletter-btn:active {
      transform: translateY(0);
    }

    /* Smooth scroll dengan CSS */
    html {
      scroll-behavior: smooth;
    }

    /* Efek fokus untuk form */
    .newsletter-input:focus {
      border-color: #AF8F6F;
      box-shadow: 0 0 5px rgba(175, 143, 111, 0.3);
    }

    /* Footer Bottom */
    .footer-bottom {
      border-top: 1px solid #74512D;
      padding-top: 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 20px;
    }

    .footer-bottom p {
      color: rgba(255, 255, 255, 0.7);
      font-size: 16px;
      margin: 0;
    }

    .footer-links {
      display: flex;
      gap: 25px;
      flex-wrap: wrap;
    }

    .footer-links a {
      color: rgba(255, 255, 255, 0.7);
      text-decoration: none;
      font-size: 16px;
      transition: color 0.3s ease;
    }

    .footer-links a:hover {
      color: #AF8F6F;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .footer-content {
        grid-template-columns: 1fr;
        gap: 30px;
      }

      .newsletter-form {
        flex-direction: column;
      }

      .footer-bottom {
        flex-direction: column;
        text-align: center;
      }

      .footer-links {
        justify-content: center;
      }

      .main-content h1 {
        font-size: 2rem;
      }

      .map-container {
        height: 150px;
      }
    }

    @media (max-width: 480px) {
      .social-links {
        justify-content: center;
      }

      .contact-item {
        flex-direction: column;
        text-align: center;
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
    <div class="profile-wrapper">
      <a href="{{ route('profile') }}">
        <img src="{{ asset('images/profile.jpg') }}" alt="Profile" class="profile-avatar">
      </a>
    </div>
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
  <footer class="footer">
    <div class="container">
      <div class="footer-content">
        <!-- Tentang Hotel -->
        <div class="footer-section">
          <h3>Tentang Kami</h3>
          <p>{{ config('hotel.description', 'Grand Hotel Elysium adalah hotel bintang 4 yang berlokasi strategis di pusat kota Jakarta. Kami menawarkan pelayanan terbaik dengan fasilitas modern untuk kenyamanan Anda.') }}</p>

          <div class="social-links">
            <a href="{{ config('hotel.social.facebook', '#') }}" class="social-link" title="Facebook" target="_blank">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="{{ config('hotel.social.instagram', '#') }}" class="social-link" title="Instagram" target="_blank">
              <i class="fab fa-instagram"></i>
            </a>
            <a href="{{ config('hotel.social.twitter', '#') }}" class="social-link" title="Twitter" target="_blank">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="{{ config('hotel.social.tiktok', '#') }}" class="social-link" title="TikTok" target="_blank">
              <i class="fab fa-tiktok"></i>
            </a>
          </div>
        </div>

        <!-- Fasilitas -->
        <div class="footer-section">
          <h3>Fasilitas</h3>
          <ul>
            <li><a href="{{ route('facilities', []) ?? '#' }}"><i class="fas fa-utensils"></i>Restaurant</a></li>
            <li><a href="{{ route('facilities', []) ?? '#' }}"><i class="fas fa-swimming-pool"></i>Kolam Renang</a></li>
            <li><a href="{{ route('facilities', []) ?? '#' }}"><i class="fas fa-spa"></i>Spa & Wellness</a></li>
            <li><a href="{{ route('facilities', []) ?? '#' }}"><i class="fas fa-dumbbell"></i>Fitness Center</a></li>
            <li><a href="{{ route('facilities', []) ?? '#' }}"><i class="fas fa-users"></i>Meeting Room</a></li>
            <li><a href="{{ route('facilities', []) ?? '#' }}"><i class="fas fa-car"></i>Parkir Gratis</a></li>
            <li><a href="{{ route('facilities', []) ?? '#' }}"><i class="fas fa-wifi"></i>WiFi Gratis</a></li>
          </ul>
        </div>

        <!-- Layanan -->
        <div class="footer-section">
          <h3>Layanan</h3>
          <ul>
            <li><a href="{{ route('booking', []) ?? '#' }}">Reservasi Online</a></li>
            <li><a href="{{ route('rooms2', []) ?? '#' }}">Room Service</a></li>
            <li><a href="{{ route('facilities', []) ?? '#' }}">Laundry Service</a></li>
            <li><a href="{{ route('payment', []) ?? '#' }}">Airport Transfer</a></li>
            <li><a href="{{ route('facilities', []) ?? '#' }}">Concierge</a></li>
            <li><a href="{{ route('facilities', []) ?? '#' }}">Event & Meeting</a></li>
            <li><a href="{{ route('facilities', []) ?? '#' }}">Tour & Travel</a></li>
          </ul>

          <!-- Newsletter -->
          <div style="margin-top: 25px;">
            <h4 style="color: #AF8F6F; font-size: 18px; margin-bottom: 10px;">Newsletter</h4>
            <p style="font-size: 15px; margin-bottom: 10px;">Dapatkan penawaran terbaru</p>

            @if(session('newsletter_success'))
            <div style="background: #4CAF50; color: white; padding: 10px; border-radius: 5px; margin-bottom: 10px; font-size: 14px;">
              {{ session('newsletter_success') }}
            </div>
            @endif

            @if($errors->has('email'))
            <div style="background: #f44336; color: white; padding: 10px; border-radius: 5px; margin-bottom: 10px; font-size: 14px;">
              {{ $errors->first('email') }}
            </div>
            @endif

            <form class="newsletter-form" method="POST" action="{{ route('booking', []) ?? '#' }}">
              @csrf
              <input type="email" name="email" class="newsletter-input" placeholder="Email Anda" value="{{ old('email') }}" required>
              <button type="submit" class="newsletter-btn">Subscribe</button>
            </form>
          </div>
        </div>

        <!-- Kontak & Maps -->
        <div class="footer-section">
          <h3>Kontak & Lokasi</h3>

          <div class="contact-item">
            <i class="fas fa-map-marker-alt"></i>
            <div>
              <h4>Alamat</h4>
              <p>{{ config('hotel.address', 'Jl. Sudirman Kav. 88') }}<br>{{ config('hotel.city', 'Jakarta Pusat, 10220') }}</p>
            </div>
          </div>

          <div class="contact-item">
            <i class="fas fa-phone"></i>
            <div>
              <h4>Telepon</h4>
              <p>{{ config('hotel.phone', '+62 21 2345 6789') }}</p>
            </div>
          </div>

          <div class="contact-item">
            <i class="fas fa-envelope"></i>
            <div>
              <h4>Email</h4>
              <p>{{ config('hotel.email', 'info@grandelysium.com') }}</p>
            </div>
          </div>

          <div class="maps-section">
            <h4 style="color: #AF8F6F; font-size: 18px; margin-bottom: 10px;">Lokasi Kami</h4>
            <div class="map-container">
              <iframe
                src="{{ config('hotel.maps_embed', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322283!2d106.8195613!3d-6.1944901!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5d2e764b12d%3A0x3d2ad6e1e0e9bcc8!2sJl.%20Jenderal%20Sudirman%2C%20Jakarta!5e0!3m2!1sen!2sid!4v1703123456789!5m2!1sen!2sid') }}"
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
              </iframe>
            </div>
          </div>
        </div>
      </div>

      <!-- Footer Bottom -->
      <div class="footer-bottom">
        <p>&copy; {{ date('Y') }} {{ config('hotel.name', 'Grand Hotel Elysium') }}. All rights reserved.</p>
        <div class="footer-links">
          <a href="{{ route('facilities', []) ?? '#' }}">Privacy Policy</a>
          <a href="{{ route('facilities', []) ?? '#' }}">Terms & Conditions</a>
          <a href="{{ route('facilities', []) ?? '#' }}">Cancellation Policy</a>
          <a href="{{ route('facilities', []) ?? '#' }}">FAQ</a>
        </div>
      </div>
    </div>
  </footer>
</body>

</html>