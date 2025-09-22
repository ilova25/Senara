@extends('layout.app')

@section('content')
<style>
  /* ==== MAIN CONTENT ==== */
  .container-detil {
    max-width: 1580px;
    margin: 50px auto;
    margin-top: 30px;
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
    margin-top: 30px;
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
    font-size: 15px;
  }

  .status.pending {
    color: red;
  }

  .status.confirmed {
    color: green;
  }

  /* ==== UPLOAD SECTION ==== */
  .upload-section {
    max-width: 1580px;
    margin: 30px auto 0;
    margin-bottom: 30px;
    display: flex;
    justify-content: center;
    padding: 0 20px;
    flex-direction: column;
    align-items: center;
    gap: 10px;
  }

  .upload-btn {
    background: #5A3B1F;
    color: #fff !important;
    padding: 16px 0;
    font-size: 16px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    width: 100%;
    max-width: 1580px;
    text-decoration: none;
    text-align: center;
  }

  .pdf-btn {
    background: #d9534f;
    color: #fff !important;
    padding: 16px 0;
    font-size: 16px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    width: 100%;
    max-width: 1580px;
    text-decoration: none;
    text-align: center;
  }
</style>

<!-- ==== MAIN CONTENT ==== -->
<div class="container-detil" id="mainContent">
  <!-- LEFT BOX -->
  <div class="card">
    <h3>Booking Details</h3>
    <div class="details">
      <div class="guest">
        <small>Guest</small>
        <p>{{ $booking->nama }}</p>
      </div>
      <div class="checkin">
        <small>Check In</small>
        <p>{{ $booking->checkin }}<br><span style="font-size: 13px; color:#666;">from 13.00</span></p>
      </div>
      <div class="checkout">
        <small>Check Out</small>
        <p>{{ $booking->checkout }}<br><span style="font-size: 13px; color:#666;">by 12.00</span></p>
      </div>
      <div class="reservation">
        <small>Your Reservation</small>
        <p>3 Nights, 2 Unit</p>
      </div>
      <div class="phone">
        <small>Phone</small>
        <p>{{ $booking->user->no_hp }}</p>
      </div>
      <div class="email">
        <small>Email</small>
        <p>{{ $booking->email }}</p>
      </div>
      <div class="booking-number">
        <small>Booking Number</small>
        <p>{{ $booking->kode_booking }}</p>
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
      <p class="status {{ strtolower($booking->status_pembayaran) }}">
        {{ strtoupper($booking->status_pembayaran) }}
      </p>
    </div>
  </div>
</div>

<!-- UPLOAD SECTION -->
<div class="upload-section">
  @if ($booking->status_pembayaran === 'pending')
    <a href="{{ route('payment.create', $booking->id)}}" class="upload-btn">
      Upload Bukti Pembayaran
    </a>

  @else
    <a href="{{ route('booking.pdf', $booking->id)}}" class="upload-btn">
      Unduh PDF
    </a>
  @endif
</div>
@endsection
