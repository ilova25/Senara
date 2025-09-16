@extends('layout.app')

@section('content')
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
            width: 100%;
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
            align-items: flex-start;
            gap: 10px;
            padding: 12px;
            margin-bottom: 10px;
            cursor: pointer;
            border-radius: 8px;
            transition: background-color 0.3s;
        }

        .payment-option:hover {
            background-color: #f8f6f5;
            /* highlight lembut */
        }

        .payment-option input[type="radio"] {
            margin-top: 4px;
            accent-color: #5C3D2E;
            /* warna radio button */
        }

        .payment-title {
            font-weight: 500;
            /* medium */
            font-size: 15px;
            color: #333;
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
            margin-bottom: 30px;
        }

        .btn-book:hover {
            background-color: #4b3224;
        }

        /* ==== POPUP ==== */
        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.6);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .popup-overlay.show {
            display: flex;
        }

        .popup-content {
            background: white;
            border-radius: 20px;
            padding: 30px;
            max-width: 900px;
            width: 100%;
            max-height: 100vh;
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            position: relative;
            animation: popupSlideIn 0.3s ease-out;
            margin: auto;
        }

        @keyframes popupSlideIn {
            from {
                opacity: 0;
                transform: scale(0.8) translateY(-50px);
            }

            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .popup-title {
            font-size: 24px;
            font-weight: 600;
            color: #5C3D2E;
            margin-bottom: 20px;
            text-align: center;
        }

        .terms-content {
            margin-bottom: 25px;
        }

        .terms-content ul {
            list-style-position: inside;
            margin: 15px 0;
        }

        .terms-content li {
            margin: 8px 0;
            line-height: 1.6;
            color: #555;
        }

        .checkbox-container {
            display: flex;
            align-items: flex-start;
            margin: 20px 0;
            gap: 12px;
        }

        .checkbox-container input[type="checkbox"] {
            width: 18px;
            height: 18px;
            margin-top: 2px;
            accent-color: #5C3D2E;
        }

        .checkbox-container label {
            line-height: 1.5;
            color: #333;
            cursor: pointer;
            flex: 1;
        }

        .popup-buttons {
            display: flex;
            justify-content: center;
            margin-top: 25px;
        }

        .apply-btn {
            background: linear-gradient(135deg, #5C3D2E 0%, #4b3224 100%);
            color: white;
            border: none;
            padding: 12px 40px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            opacity: 0.5;
            pointer-events: none;
        }

        .apply-btn.enabled {
            opacity: 1;
            pointer-events: auto;
        }

        .apply-btn.enabled:hover {
            background: linear-gradient(135deg, #AF8F6F 0%, #8f6f4f 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(92, 61, 46, 0.3);
        }

        .popup-overlay.show {
            display: flex;
        }
    </style>

    <!-- ==== MAIN CONTENT ==== -->
    <div class="container">
        <h1>Payment</h1>
        <div class="room-card">
            <img src="{{ asset('storage/unit/'.$booking->unit->gambar) }}" alt="Room">
            <div class="room-info">
                <h2>{{ $booking->unit->nama_unit }}</h2>
                <p>👤 {{ $booking->nama }}</p>
                <p>👥 {{$booking->adult}} Adult & {{$booking->children}} Child</p>
                <p>📅 {{$booking->checkin}} - {{$booking->checkout}}</p>
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
                <strong>IDR {{ number_format($booking->total_harga, 0, ',', '.') }}</strong>
            </div>
        </div>

        <!-- Promo Box Full Width -->
        <div class="promo-container">
            <div class="promo-box">
                <input type="text" class="promo-input" placeholder="Promotion Code">
                <button class="promo-btn">Apply</button>
            </div>
        </div>

        <!-- Payment Method sesuai gambar -->
        <div class="payment-method">
            <h3>Payment Method</h3>

            <label class="payment-option">
                <input type="radio" name="payment" value="arrival">
                <div>
                    <span class="payment-title">Pay on Arrival</span><br>
                    <small>Pay with cash on arrival</small>
                </div>
            </label>

            <label class="payment-option">
                <input type="radio" name="payment" value="bank">
                <div>
                    <span class="payment-title">Direct Bank Transfer</span><br>
                    <small>Make your payment directly into our bank account.
                        Please use your Booking ID as the payment reference</small>
                </div>
            </label>
        </div>


        <div class="popup-overlay" id="termsPopup">
            <div class="popup-content">
                <h2 class="popup-title">Syarat dan Ketentuan</h2>

                <div class="terms-content">
                    <ul>
                        <li>Check in bisa dilakukan mulai pukul 13.00</li>
                        <li>Check out bisa dilakukan pukul 12.00</li>
                        <li>Jika tamu lebih dari 6 akan dikenakan denda sebesar Rp50.000 per orang.</li>
                    </ul>
                </div>

                <div class="checkbox-container">
                    <input type="checkbox" id="agreeTerms" onchange="toggleApplyButton()">
                    <label for="agreeTerms">Saya menyetujui syarat dan ketentuan yang berlaku</label>
                </div>

                <div class="popup-buttons">
                    <button class="apply-btn" id="applyBtn" onclick="acceptTerms()">Apply</button>
                </div>
            </div>
        </div>

        <button class="btn-book" onclick="showPopup()">Next</button>
    </div>

@endsection

@push('scripts')
    <script>
        function showPopup() {
            document.getElementById('termsPopup').classList.add('show');
        }

        function hidePopup() {
            document.getElementById('termsPopup').classList.remove('show');
        }

        function toggleApplyButton() {
            const checkbox = document.getElementById('agreeTerms');
            const applyBtn = document.getElementById('applyBtn');
            if (checkbox.checked) {
                applyBtn.classList.add('enabled');
            } else {
                applyBtn.classList.remove('enabled');
            }
        }

        function acceptTerms() {
            const checkbox = document.getElementById('agreeTerms');
            if (checkbox.checked) {
                hidePopup();
                window.location.href = "{{ route('detil', $booking->id) }}";
            }
        }

    </script>
@endpush