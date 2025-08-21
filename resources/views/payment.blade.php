<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Payment - Senara Guest House</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fff;
            color: #333;
        }

        /* ==== NAVBAR ==== */
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

        /* ==== PAYMENT PAGE ==== */
        .container {
            max-width: 900px;
            margin: auto;
            padding: 20px;
        }

        h1 {
            font-size: 28px;
            font-weight: 600;
            margin: 30px 0 20px;
        }

        .room-card {
            display: flex;
            align-items: stretch;
            background-color: #F8F6F5;
            border-radius: 15px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .room-card img {
            width: 40%;
            object-fit: cover;
        }

        .room-info {
            width: 60%;
            padding: 25px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .room-info h2 {
            color: #543310;
            font-size: 26px;
            margin: 0 0 20px 0;
        }

        .room-info p {
            margin: 8px 0;
        }

        .order-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .order-details strong {
            font-size: 18px;
            color: #5C3D2E;
        }

        /* Promo box full width */
        .promo-container {
            margin: 12px 0 25px;
            display: flex;
            justify-content: flex-start;
        }

        .promo-box {
            display: flex;
            background: #f8f8f8;
            border-radius: 8px;
            overflow: hidden;
            width: 100%; /* full width sejajar order-details */
        }

        .promo-input {
            flex: 1;
            border: none;
            padding: 10px 12px;
            font-size: 14px;
            outline: none;
            background: #f8f8f8;
        }

        .promo-btn {
            background: #5C3D2E;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-weight: 500;
            border-radius: 0 8px 8px 0;
            transition: background 0.3s ease;
        }

        .promo-btn:hover {
            background: #4b3224;
        }

        .payment-method {
            margin-bottom: 20px;
        }

        .payment-method h3 {
            font-size: 16px;
            font-weight: 600;
            color: #5C3D2E;
            margin-bottom: 10px;
        }

        .payment-option {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: border-color 0.3s;
        }

        .payment-option:hover {
            border-color: #5C3D2E;
        }

        .payment-option img {
            height: 24px;
        }

        .btn-book {
            width: 100%;
            padding: 14px;
            font-size: 18px;
            background-color: #5C3D2E;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-book:hover {
            background-color: #4b3224;
        }

        footer {
            text-align: center;
            font-size: 14px;
            font-style: italic;
            margin-top: 20px;
            padding: 10px;
            border-top: 1px solid #ccc;
        }
    </style>
</head>

<body>

    <!-- ==== NAVBAR ==== -->
    <header>
        <div>Senara Guest House</div>
        <nav>
            <a href="{{ route('home2') }}">Home</a>
            <a href="{{ route('rooms2') }}">Rooms</a>
            <a href="{{ route('facilities2') }}">Facilities</a>
            <a href="{{ route('booking') }}" class="active">Booking</a>
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

    <!-- ==== MAIN CONTENT ==== -->
    <div class="container">
        <h1>Payment</h1>
        <div class="room-card">
            <img src="{{ asset('images/room.png') }}" alt="Room">
            <div class="room-info">
                <h2>Deluxe Room</h2>
                <p>👤 Username</p>
                <p>👥 2 Adult & 1 Child</p>
                <p>📅 19/08/2025 - 20/08/2025</p>
            </div>
        </div>

        <!-- Order Details -->
        <div class="order-details">
            <div>
                <p>Order ID</p>
                <p>Total</p>
            </div>
            <div style="text-align:right;">
                <p>1234456678910</p>
                <strong>IDR 1.125.000</strong>
            </div>
        </div>

        <!-- Promo Box Full Width -->
        <div class="promo-container">
            <div class="promo-box">
                <input type="text" class="promo-input" placeholder="Promotion Code">
                <button class="promo-btn">Apply</button>
            </div>
        </div>

        <div class="payment-method">
            <h3>Payment Method</h3>
            <div class="payment-option"> <img src="{{ asset('images/dana.jpg') }}" alt="Dana"> Dana <span></span> </div>
            <div class="payment-option"> <img src="{{ asset('images/ovo.jpeg') }}" alt="OVO"> OVO <span></span> </div>
            <div class="payment-option" style="border: 1px solid orange;"> <img src="{{ asset('images/shopepay.jpeg') }}" alt="Shopee Pay"> Shopee Pay <span>›</span> </div>
            <div class="payment-option"> <img src="{{ asset('images/atm.jpeg') }}" alt="ATM"> ATM Card <span></span> </div>
            <div class="payment-option"> <img src="{{ asset('images/visa.jpeg') }}" alt="Visa"> International payments <span></span> </div>
        </div>

        <button class="btn-book">Booking</button>
        <footer> Copyright &copy; RPL Grafika 2025 </footer>
    </div>

</body>

</html>
