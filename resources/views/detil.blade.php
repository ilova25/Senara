@extends('layout.app')

@section('content')
<style>
.container {
  display: flex;
  gap: 20px;
  padding: 20px;
}
.card, .side-card {
  background: #fff;
  padding: 20px;
  border-radius: 12px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}
.card { flex: 2; }
.side-card { flex: 1; }
.details div { margin-bottom: 15px; }
small { color: #666; display: block; margin-bottom: 5px; }
.status { color: red; font-weight: bold; }
.upload-section { margin-top: 20px; text-align: center; }
.upload-btn {
  background: #007bff; color: #fff;
  padding: 12px 20px; border: none;
  border-radius: 8px; cursor: pointer;
}
.upload-btn:hover { background: #0056b3; }
</style>

<div class="container">
  <!-- LEFT BOX -->
  <div class="card">
    <h3>Booking Details</h3>
    <div class="details">
      <div><small>Guest</small><p>Lorem Ipsum Dolor</p></div>
      <div><small>Check In</small><p>Sun, 4 Sept 2025<br><span style="font-size:13px;color:#666;">from 13.00</span></p></div>
      <div><small>Check Out</small><p>Wed, 7 Sept 2025<br><span style="font-size:13px;color:#666;">by 12.00</span></p></div>
      <div><small>Your Reservation</small><p>3 Nights, 2 Unit</p></div>
      <div><small>Phone</small><p>081234567891</p></div>
      <div><small>Email</small><p>User@gmail.com</p></div>
      <div><small>Booking Number</small><p>#1234567890</p></div>
    </div>
  </div>

  <!-- RIGHT BOX -->
  <div class="side-card">
    <h3>Payment Details</h3>
    <div class="payment-info">
      <small>Date</small><p>Wed, 7 Sept 2025</p>
      <small>Payment Method</small><p>Direct Bank Transfer</p>
      <small>Total</small><p>Rp1.125.000</p>
      <small>Status</small><p class="status">PENDING</p>
    </div>
  </div>
</div>

<div class="upload-section">
  <a href="{{ route('payment.upload') }}">
    <button class="upload-btn">Upload Bukti Pembayaran</button>
  </a>
</div>
@endsection
