@extends('layout.app')

@section('content')
<style>
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
      margin-bottom: 30px;
    }

    .submit-btn:hover {
      background: #4a2f17;
    }

</style>

<div class="upload-form-container">
  <h2 class="upload-form-title">Upload Bukti Pembayaran</h2>
  <form method="POST" action="" enctype="multipart/form-data">
    @csrf
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

    <div class="form-group">
      <label for="fileInput">Upload Bukti</label>
      <input type="file" id="fileInput" name="bukti" accept="image/*,.pdf" required>
    </div>

    <button type="submit" class="submit-btn">Upload</button>
  </form>
</div>
@endsection
