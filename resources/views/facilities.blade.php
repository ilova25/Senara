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

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .facility-list {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
      gap: 40px;
      padding: 0 10%;
      margin-bottom: 80px;
    }

    .facility-card {
      background: white;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      transition: all 0.4s ease;
      position: relative;
      cursor: pointer;
      margin-top: 50px;
    }

    .facility-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
    }

    .facility-card:nth-child(odd) {
      animation: slideInLeft 0.8s ease forwards;
    }

    .facility-card:nth-child(even) {
      animation: slideInRight 0.8s ease forwards;
    }

    @keyframes slideInLeft {
      from {
        opacity: 0;
        transform: translateX(-50px);
      }

      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    @keyframes slideInRight {
      from {
        opacity: 0;
        transform: translateX(50px);
      }

      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    .facility-card img {
      width: 100%;
      height: 250px;
      object-fit: cover;
      transition: transform 0.4s ease;
    }

    .facility-card:hover img {
      transform: scale(1.1);
    }

    .facility-card-content {
      padding: 25px;
      position: relative;
    }

    .facility-card-content::before {
      content: '';
      position: absolute;
      top: 0;
      left: 25px;
      right: 25px;
      height: 3px;
      background: linear-gradient(135deg, #AF8F6F 0%, #5A3B1F 100%);
      border-radius: 2px;
    }

    .facility-title {
      font-size: 24px;
      font-weight: 600;
      color: #5A3B1F;
      margin-bottom: 15px;
      margin-top: 10px;
    }

    .facility-description {
      color: #666;
      font-size: 16px;
      line-height: 1.6;
      margin-bottom: 20px;
    }

    .facility-features {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
    }

    .feature-tag {
      background: linear-gradient(135deg, #AF8F6F 0%, #C5A582 100%);
      color: white;
      padding: 8px 16px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 500;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .facility-card:hover .feature-tag {
      background: linear-gradient(135deg, #5A3B1F 0%, #AF8F6F 100%);
    }

    /* Special styling for different facility types */
    .facility-card:nth-child(1) {
      border-top: 4px solid #543310;
    }

    .facility-card:nth-child(2) {
      border-top: 4px solid #74512D;
    }

    .facility-card:nth-child(3) {
      border-top: 4px solid #AF8F6F;
    }

    .facility-card:nth-child(4) {
      border-top: 4px solid #543310;
    }

    .facility-card:nth-child(5) {
      border-top: 4px solid #74512D;
    }

    .facility-card:nth-child(6) {
      border-top: 4px solid #AF8F6F;
    }

    @media (max-width: 768px) {
      .page-title {
        font-size: 36px;
      }

      .facility-list {
        grid-template-columns: 1fr;
        padding: 0 5%;
        gap: 30px;
      }

      /* header {
        padding: 15px 5%;
      }

      nav a {
        margin-left: 15px;
      } */

      .stats-grid {
        grid-template-columns: repeat(2, 1fr);
      }
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
    <div class="facility-card">
      <img src="{{ asset('images/fasilitas.png') }}" alt="Swimming Pool">
      <div class="facility-card-content">
        <h3 class="facility-title">Infinity Swimming Pool</h3>
        <p class="facility-description">Dive into luxury with our stunning infinity pool offering breathtaking panoramic views. Perfect for morning laps or evening relaxation.</p>
        <div class="facility-features">
          <span class="feature-tag">Heated Pool</span>
          <span class="feature-tag">24/7 Access</span>
          <span class="feature-tag">Pool Bar</span>
        </div>
      </div>
    </div>

    <div class="facility-card">
      <img src="{{ asset('images/fasilitas.png') }}" alt="Spa & Wellness">
      <div class="facility-card-content">
        <h3 class="facility-title">Spa & Wellness Center</h3>
        <p class="facility-description">Rejuvenate your mind, body, and soul at our full-service spa featuring traditional treatments and modern wellness therapies.</p>
        <div class="facility-features">
          <span class="feature-tag">Massage</span>
          <span class="feature-tag">Sauna</span>
          <span class="feature-tag">Aromatherapy</span>
        </div>
      </div>
    </div>

    <div class="facility-card">
      <img src="{{ asset('images/fasilitas.png') }}" alt="Fitness Center">
      <div class="facility-card-content">
        <h3 class="facility-title">State-of-the-Art Gym</h3>
        <p class="facility-description">Stay fit during your stay with our fully equipped fitness center featuring the latest cardio and strength training equipment.</p>
        <div class="facility-features">
          <span class="feature-tag">24/7 Access</span>
          <span class="feature-tag">Personal Trainer</span>
          <span class="feature-tag">Yoga Classes</span>
        </div>
      </div>
    </div>

    <div class="facility-card">
      <img src="{{ asset('images/fasilitas.png') }}" alt="Fine Dining">
      <div class="facility-card-content">
        <h3 class="facility-title">Gourmet Restaurant</h3>
        <p class="facility-description">Indulge in culinary excellence at our award-winning restaurant, featuring international cuisine and local specialties.</p>
        <div class="facility-features">
          <span class="feature-tag">Fine Dining</span>
          <span class="feature-tag">Room Service</span>
          <span class="feature-tag">Wine Cellar</span>
        </div>
      </div>
    </div>

    <div class="facility-card">
      <img src="{{ asset('images/fasilitas.png') }}" alt="Conference Hall">
      <div class="facility-card-content">
        <h3 class="facility-title">Business Center</h3>
        <p class="facility-description">Host successful meetings and events in our modern conference facilities equipped with cutting-edge technology.</p>
        <div class="facility-features">
          <span class="feature-tag">High-Speed WiFi</span>
          <span class="feature-tag">AV Equipment</span>
          <span class="feature-tag">Catering</span>
        </div>
      </div>
    </div>

    <div class="facility-card">
      <img src="{{ asset('images/fasilitas.png') }}" alt="Garden Terrace">
      <div class="facility-card-content">
        <h3 class="facility-title">Rooftop Garden</h3>
        <p class="facility-description">Unwind in our beautiful rooftop garden terrace, perfect for sunset cocktails and intimate gatherings under the stars.</p>
        <div class="facility-features">
          <span class="feature-tag">City Views</span>
          <span class="feature-tag">Outdoor Bar</span>
          <span class="feature-tag">Events Space</span>
        </div>
      </div>
    </div>
  </div>


@endsection
  