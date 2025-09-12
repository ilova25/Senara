@extends('layout.app')

@section('content')
<style>
.upload-form-container {
  max-width: 500px; margin: 40px auto;
  background: #fff; padding: 25px;
  border-radius: 12px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}
.upload-form-title { text-align: center; margin-bottom: 20px; }
.form-group { margin-bottom: 15px; }
label { display: block; margin-bottom: 5px; color: #333; }
input[type="text"], input[type="tel"], input[type="file"] {
  width: 100%; padding: 10px; border: 1px solid #ccc;
  border-radius: 8px;
}
.submit-btn {
  display: block; width: 100%; padding: 12px;
  background: #28a745; border: none;
  color: #fff; border-radius: 8px; cursor: pointer;
}
.submit-btn:hover { background: #218838; }
</style>

<div class="upload-form-container">
  <h2 class="upload-form-title">Upload Bukti Pembayaran</h2>
  <form method="POST" action="{{ route('payment.store') }}" enctype="multipart/form-data">
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
