<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
      background: #fff;
      color: #111;
      font-size: 16px;
    }

    /* ==== NAVBAR ==== */
    header {
      padding: 24px 10%;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 1px solid #ccc;
      font-size: 16px;
    }

    header nav {
      display: flex;
      align-items: center;
      gap: 5px;
      margin-left: auto;
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
    }

    /* ==== MAIN CONTENT ==== */
    .container {
      max-width: 1580px;
      margin: 50px auto;
      display: flex;
      gap: 30px;
      padding: 0 20px;
      min-height: 500px;
    }

    .card,
    .side-card {
      background: #fff;
      border: 1px solid #ccc;
      border-radius: 10px;
      padding: 30px;
      font-size: 16px;
    }

    .card {
      flex: 2;
    }

    .side-card {
      flex: 1;
    }

    h3 {
      margin-bottom: 22px;
      font-size: 20px;
      font-weight: 600;
      color: #222;
    }

    /* ==== BOOKING DETAILS ==== */
    .details {
      display: grid;
      grid-template-columns: 1fr 1fr 1fr;
      gap: 50px;
      grid-template-areas:
        "guest checkin checkout"
        "reservation phone email"
        "booking . .";
    }

    .details small {
      display: block;
      font-size: 13px;
      color: #666;
      text-transform: uppercase;
      margin-bottom: 6px;
    }

    .details p {
      font-size: 15px;
      margin: 0;
      font-weight: 500;
    }

    .guest {
      grid-area: guest;
    }

    .checkin {
      grid-area: checkin;
    }

    .checkout {
      grid-area: checkout;
    }

    .reservation {
      grid-area: reservation;
    }

    .phone {
      grid-area: phone;
    }

    .email {
      grid-area: email;
    }

    .booking-number {
      grid-area: booking;
    }

    .booking-number p {
      font-weight: bold;
    }

    /* ==== PAYMENT INFO ==== */
    .payment-info small {
      display: block;
      font-size: 13px;
      color: #666;
      text-transform: uppercase;
      margin-bottom: 6px;
    }

    .payment-info p {
      font-size: 15px;
      margin: 0 0 18px;
      font-weight: 500;
    }

    .status {
      font-weight: bold;
      color: red;
      font-size: 15px;
    }

    /* ==== UPLOAD SECTION ==== */
    .upload-section {
      max-width: 1580px;
      margin: 30px auto 0;
      display: flex;
      justify-content: center;
      padding: 0 20px;
      flex-direction: column;
      align-items: center;
    }

    .upload-btn {
      background: #5A3B1F;
      color: #fff;
      padding: 16px 0;
      font-size: 16px;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      width: 100%;
      max-width: 1580px;
    }

    /* ==== UPLOAD FORM STYLES ==== */
    .upload-form-container {
      max-width: 1580px;
      margin: 50px auto 0;
      padding: 0 20px;
    }

    .upload-form-title {
      font-size: 36px;
      font-weight: 600;
      color: #222;
      margin-bottom: 40px;
      text-align: left;
    }

    .form-group {
      margin-bottom: 25px;
    }

    .form-group label {
      display: block;
      font-size: 18px;
      font-weight: 500;
      color: #222;
      margin-bottom: 10px;
    }

    .form-group input[type="text"],
    .form-group input[type="tel"] {
      width: 100%;
      padding: 12px 15px;
      border: 2px solid #ccc;
      border-radius: 8px;
      font-size: 16px;
      font-family: 'Poppins', sans-serif;
      background: #fff;
      transition: border-color 0.3s ease;
    }

    .form-group input[type="text"]:focus,
    .form-group input[type="tel"]:focus {
      outline: none;
      border-color: #5A3B1F;
    }

    .file-input-container {
      margin-bottom: 30px;
    }

    .file-input-btn {
      background: #5A3B1F;
      color: #fff;
      padding: 12px 24px;
      font-size: 16px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-family: 'Poppins', sans-serif;
      font-weight: 500;
      transition: background-color 0.3s ease;
    }

    .file-input-btn:hover {
      background: #4a2f17;
    }

    .file-input {
      display: none;
    }

    .file-name {
      margin-top: 10px;
      font-size: 14px;
      color: #666;
    }

    .submit-btn {
      background: #5A3B1F;
      color: #fff;
      padding: 16px 0;
      font-size: 18px;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      width: 100%;
      font-family: 'Poppins', sans-serif;
      font-weight: 600;
      transition: background-color 0.3s ease;
      margin-top: 20px;
    }

    .submit-btn:hover {
      background: #4a2f17;
    }

    /* ==== QR CODE SECTION ==== */
    .qr-code-section {
      display: none;
      text-align: center;
      margin: 50px auto;
    }

    .qr-code-box {
      background: #f7f7f8;
      padding: 40px;
      border-radius: 20px;
      display: inline-block;
    }

    .qr-code-box h3 {
      font-size: 22px;
      font-weight: 600;
      margin-bottom: 10px;
    }

    .qr-code-box p {
      font-size: 16px;
      margin-bottom: 20px;
    }

    .qr-code-box img {
      width: 300px;
      height: 300px;
    }

    /* ==== FOOTER ==== */
    footer {
      text-align: center;
      font-size: 15px;
      font-style: italic;
      margin-top: 50px;
      padding: 18px;
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
    <div class="profile-wrapper">
      <a href="{{ route('profile') }}">
        <img src="{{ asset('images/profile.jpg') }}" alt="Profile" class="profile-avatar">
      </a>
    </div>
  </header>

  <!-- ==== MAIN CONTENT ==== -->
  <div class="container" id="mainContent">
    <!-- LEFT BOX -->
    <div class="card">
      <h3>Booking Details</h3>
      <div class="details">
        <div class="guest">
          <small>Guest</small>
          <p>Lorem Ipsum Dolor</p>
        </div>
        <div class="checkin">
          <small>Check In</small>
          <p>Sun, 4 Sept 2025<br><span style="font-size: 13px; color:#666;">from 13.00</span></p>
        </div>
        <div class="checkout">
          <small>Check Out</small>
          <p>Wed, 7 Sept 2025<br><span style="font-size: 13px; color:#666;">by 12.00</span></p>
        </div>
        <div class="reservation">
          <small>Your Reservation</small>
          <p>3 Nights, 2 Unit</p>
        </div>
        <div class="phone">
          <small>Phone</small>
          <p>081234567891</p>
        </div>
        <div class="email">
          <small>Email</small>
          <p>User@gmail.com</p>
        </div>
        <div class="booking-number">
          <small>Booking Number</small>
          <p>#1234567890</p>
        </div>
      </div>
    </div>

    <!-- RIGHT BOX -->
    <div class="side-card">
      <h3>Payment Details</h3>
      <div class="payment-info">
        <small>Date</small>
        <p>Wed, 7 Sept 2025</p>

        <small>Payment Method</small>
        <p>Direct Bank Transfer</p>

        <small>Total</small>
        <p>Rp1.125.000</p>

        <small>Status</small>
        <p class="status">PENDING</p>
      </div>
    </div>
  </div>

  <!-- UPLOAD SECTION -->
  <div class="upload-section" id="uploadSection">
    <button class="upload-btn" onclick="showUploadForm()">Upload Bukti Pembayaran</button>
  </div>

  <!-- UPLOAD FORM (Hidden initially) -->
  <div class="upload-form-container" id="uploadFormContainer" style="display: none;">
    <h2 class="upload-form-title">Upload Bukti Pembayaran</h2>
    <form id="uploadForm" onsubmit="handleFormSubmit(event)">
      <div class="form-group">
        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" required>
      </div>

      <div class="form-group">
        <label for="telepon">No. Telepon</label>
        <input type="tel" id="telepon" name="telepon" required>
      </div>

      <div class="form-group">
        <label for="kodeBooking">Kode Booking</label>
        <input type="text" id="kodeBooking" name="kodeBooking" required>
      </div>

      <div class="file-input-container">
        <button type="button" class="file-input-btn" onclick="document.getElementById('fileInput').click()">
          Pilih File
        </button>
        <input type="file" id="fileInput" class="file-input" accept="image/*,.pdf" onchange="showFileName(this)">
        <div class="file-name" id="fileName"></div>
      </div>

      <button type="submit" class="submit-btn">Upload</button>
    </form>
  </div>

  <!-- QR CODE SECTION (Hidden initially) -->
  <div class="qr-code-section" id="qrCodeSection">
    <div class="qr-code-box">
      <h3>QR CODE</h3>
      <p>Please show this bar code to the receptionist.</p>
      <img src="{{ asset('images/qr-code.png') }}" alt="QR Code">
    </div>
  </div>

  <!-- ==== FOOTER ==== -->
  <footer>
    Copyright &copy; RPL Grafika 2025
  </footer>

  <script>
    function showUploadForm() {
      document.getElementById("mainContent").style.display = "none";
      document.getElementById("uploadSection").style.display = "none";
      document.getElementById("uploadFormContainer").style.display = "block";
    }

    function showFileName(input) {
      const fileName = document.getElementById('fileName');
      if (input.files && input.files[0]) {
        fileName.textContent = 'File dipilih: ' + input.files[0].name;
      } else {
        fileName.textContent = '';
      }
    }

    function handleFormSubmit(event) {
      event.preventDefault();

      const nama = document.getElementById('nama').value;
      const telepon = document.getElementById('telepon').value;
      const kodeBooking = document.getElementById('kodeBooking').value;
      const fileInput = document.getElementById('fileInput');

      if (!nama || !telepon || !kodeBooking) {
        alert('Mohon lengkapi semua field yang diperlukan');
        return;
      }

      if (!fileInput.files || !fileInput.files[0]) {
        alert('Mohon pilih file bukti pembayaran');
        return;
      }

      alert('Bukti pembayaran berhasil diupload!');

      document.getElementById('uploadForm').reset();
      document.getElementById('fileName').textContent = '';

      document.getElementById("uploadFormContainer").style.display = "none";
      document.getElementById("qrCodeSection").style.display = "block";
    }
  </script>
</body>

</html>