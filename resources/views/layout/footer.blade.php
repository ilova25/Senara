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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <!-- Kolom 1 -->
            <div class="footer-section">
                <h3>Tentang Kami</h3>
                <p>Senara Guest House adalah penginapan nyaman dengan fasilitas modern dan layanan terbaik.</p>
            </div>

            <!-- Kolom 2 -->
            <div class="footer-section">
                <h3>Navigasi</h3>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('unit') }}">Unit</a></li>
                    <li><a href="{{ route('facilities') }}">Facility</a></li>
                    @auth
                        <li><a href="{{ route('booking.create') }}">Reservasi Online</a></li>
                    @else
                        <li><a href="{{ route('login') }}">Reservasi Online</a></li>
                    @endauth
                </ul>
            </div>

            <!-- Kolom 3 -->
            <div class="footer-section">
                <h3>Kontak</h3>
                <div class="contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <div>Jl. Mawar No. 123, Jakarta</div>
                </div>
                <div class="contact-item">
                    <i class="fas fa-phone"></i>
                    <div>+62 812-3456-7890</div>
                </div>
                <div class="contact-item">
                    <i class="fas fa-envelope"></i>
                    <div>info@senaraguesthouse.com</div>
                </div>
            </div>

            <!-- Kolom 4 -->
            <div class="footer-section">
                <h3>Ikuti Kami</h3>
                <div class="social-links">
                    <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                </div>

                <h3>Newsletter</h3>
                <form class="newsletter-form" method="POST" action="{{ route('newsletter.subscribe') }}">
                    @csrf
                    <input type="email" name="email" class="newsletter-input"
                           placeholder="Email Anda" value="{{ old('email') }}" required>
                    <button type="submit" class="newsletter-btn">Subscribe</button>
                </form>

                @if(session('newsletter_success'))
                    <p class="newsletter-success">{{ session('newsletter_success') }}</p>
                @endif
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Senara Guest House. All rights reserved.</p>
        </div>
    </div>
</footer>
