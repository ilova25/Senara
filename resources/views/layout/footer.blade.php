<style>
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
            <li><a href="{{ route('rooms', []) ?? '#' }}">Room Service</a></li>
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