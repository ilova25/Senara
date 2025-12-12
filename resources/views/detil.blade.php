@extends('layout.app')

@section('content')
<style>
  .container-detil {
    max-width: 1580px;
    margin: 50px auto 30px;
    display: flex;
    gap: 30px;
    padding: 0 20px;
    min-height: 500px;
  }

  .card, .side-card {
    background: #fff;
    border: 1px solid #ccc;
    border-radius: 10px;
    padding: 30px;
    font-size: 16px;
    margin-top: 30px;
  }

  .card { flex: 2; }
  .side-card { flex: 1; }

  h3 {
    margin-bottom: 22px;
    font-size: 20px;
    font-weight: 600;
    color: #222;
  }

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

  .status {
    font-weight: bold;
    font-size: 15px;
    text-transform: uppercase;
  }
  .status.pending   { color: red; }
  .status.waiting   { color: orange; }
  .status.paid { color: green; }

  .upload-section {
    max-width: 1580px;
    margin: 30px auto;
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
      <p>{{ $booking->created_at->format('D, d M Y') }}</p>

      <small>Payment Method</small>
      <p>
        @if ($booking->payment)
          {{ ucfirst($booking->payment->metode_pembayaran ?? 'Midtrans') }}
        @else
          Belum dipilih
        @endif
      </p>

      <small>Total</small>
      <p>Rp{{ number_format($booking->total_harga, 0, ',', '.') }}</p>

      <small>Status</small>
      <p class="status {{ strtolower($booking->payment->status_pembayaran ?? 'pending') }}">
        {{ strtoupper($booking->payment->status_pembayaran ?? 'pending') }}
      </p>
      
       @if ($booking->payment)
        <small>Order ID</small>
        <p>{{ $booking->payment->order_id }}</p>

        <small>Transaction ID</small>
        <p>{{ $booking->payment->transaction_id ?? '-' }}</p>
      @endif

    </div>
  </div>
</div>

<!-- PAYMENT SECTION -->

<div class="upload-section">
  @if ($booking->payment )
    <a href="{{ route('booking.pdf', $booking->id)}}" class="upload-btn">Unduh PDF</a>
  @elseif (!$booking->payment)
    <button id="pay-button" class="upload-btn">Bayar Sekarang</button>
  @endif
</div>

@endsection

@push('script')
<script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}">
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const payBtn = document.getElementById('pay-button');

    if (payBtn) {
        payBtn.addEventListener('click', function () {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result){
                    window.location.reload();
                },
                onPending: function(result){
                    alert("Menunggu pembayaran...");
                },
                onError: function(result){
                    alert("Pembayaran gagal!");
                },
                onClose: function(){
                    alert("Anda menutup pembayaran.");
                }
            });
        });
    }
});
</script>
@endpush

