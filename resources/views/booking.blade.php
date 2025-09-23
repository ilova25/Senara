@extends('layout.app')

@section('content')
  <style>
    /* * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    } */

    .container-fluid {
      padding-left: 0 !important;
      padding-right: 0 !important;
    }

    body {
      background-color: #fff;
      font-family: 'Poppins', sans-serif;
      color: #333;
    }

    .page-title {
      font-size: 42px;
      margin: 40px 10% 20px;
      font-weight: 400;
    }

    .banner {
      width: 100%;
      height: auto;
      display: block;
    }

    /* Enhanced Booking Form Styles */
    .booking-container {
      background: linear-gradient(135deg, #f8f6f4 0%, #ffffff 100%);
      padding: 40px 0;
      min-height: calc(100vh - 400px);
    }

    .booking-form {
      width: 100%;
      max-width: none;
      margin: 0;
      background: #ffffff;
      padding: 50px 10%;
      border-radius: 0;
      box-shadow: 0 20px 60px rgba(90, 59, 31, 0.1);
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 40px;
      position: relative;
      overflow: hidden;
    }

    .booking-form::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(90deg, #5A3B1F, #AF8F6F, #5A3B1F);
    }

    .form-title {
      grid-column: span 2;
      text-align: center;
      font-size: 32px;
      font-weight: 600;
      color: #5A3B1F;
      margin-bottom: 20px;
      position: relative;
    }

    .form-title::after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: 3px;
      background: linear-gradient(90deg, #5A3B1F, #AF8F6F);
      border-radius: 2px;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      position: relative;
    }

    .form-group label {
      margin-bottom: 8px;
      font-weight: 600;
      font-size: 16px;
      color: #5A3B1F;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      font-size: 14px;
    }

    .form-group input,
    .form-group select {
      padding: 16px 20px;
      border: 2px solid #e8e8e8;
      border-radius: 12px;
      font-size: 16px;
      font-family: 'Poppins', sans-serif;
      width: 100%;
      transition: all 0.3s ease;
      background: #fafafa;
    }

    .form-group input:focus,
    .form-group select:focus {
      outline: none;
      border-color: #AF8F6F;
      background: #ffffff;
      box-shadow: 0 0 0 4px rgba(175, 143, 111, 0.1);
      transform: translateY(-1px);
    }

    .form-group input:hover,
    .form-group select:hover {
      border-color: #d0d0d0;
      background: #ffffff;
    }

    /* Enhanced Guests Section */
    .guests-wrapper {
      display: flex;
      gap: 15px;
      width: 100%;
    }

    .guests-wrapper select {
      flex: 1;
      background-image: linear-gradient(45deg, transparent 50%, #AF8F6F 50%),
        linear-gradient(135deg, #AF8F6F 50%, transparent 50%);
      background-position: right 15px center, right 10px center;
      background-size: 5px 5px, 5px 5px;
      background-repeat: no-repeat;
      padding-right: 40px;
    }

    /* Special styling for date inputs */
    .form-group input[type="date"] {
      position: relative;
      padding-right: 20px;
    }

    /* Enhanced Button */
    .btn-book {
      grid-column: span 2; 
      display: block; 
      text-align: center; 
      padding: 16px;
      background-color: #5C3D2E;
      color: white;
      border: none;
      font-size: 18px;
      font-weight: bold;
      cursor: pointer;
      border-radius: 4px;
      text-decoration: none; 
    }
      grid-column: span 2;
      display: block;
      text-align: center;
      padding: 20px;
      background: linear-gradient(135deg, #5A3B1F 0%, #4a2f1a 100%);
      color: white;
      border: none;
      font-size: 18px;
      font-weight: 600;
      cursor: pointer;
      border-radius: 15px;
      text-decoration: none;
      margin-top: 20px;
      position: relative;
      overflow: hidden;
      text-transform: uppercase;
      letter-spacing: 1px;
      transition: all 0.3s ease;
      box-shadow: 0 8px 25px rgba(90, 59, 31, 0.3);
    }

    .btn-book:hover {
      background-color: #4b3224;
    }
    .btn-book::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
      transition: left 0.5s;
    }

    .btn-book:active {
      transform: translateY(0);
      box-shadow: 0 4px 15px rgba(90, 59, 31, 0.3);
    }

    /* Form decorative elements */
    .form-group::before {
      content: '';
      position: absolute;
      left: 0;
      bottom: 0;
      height: 2px;
      width: 0;
      background: linear-gradient(90deg, #5A3B1F, #AF8F6F);
      transition: width 0.3s ease;
    }

    .form-group:focus-within::before {
      width: 100%;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .booking-form {
        grid-template-columns: 1fr;
        padding: 30px 20px;
        margin: 20px;
      }

      .form-title {
        grid-column: span 1;
        font-size: 28px;
      }

      .btn-book {
        grid-column: span 1;
      }

      .guests-wrapper {
        flex-direction: column;
        gap: 10px;
      }
    }
  </style>

  <h1 class="page-title">Booking</h1>
  <img src="{{ asset('images/banner-fasilitas.png') }}" alt="Booking Banner" class="banner">

  <form class="booking-form" action="{{ route('booking.store') }}" method="POST">
      @csrf
      <div class="form-group">
          <label>Name</label>
          <input type="text" name="nama" id="name" value="{{ old('nama', Auth::user()->username) }}" required>
      </div>

      <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}" required>
      </div>

      <div class="form-group">
          <label>Guests</label>
          <div class="guests-wrapper">
              <select name="adult" id="adults">
                  <option value="1">1 Adult</option>
                  <option value="2">2 Adults</option>
                  <option value="3">3 Adults</option>
              </select>
              <select name="children" id="children">
                  <option value="1">1 Child</option>
                  <option value="2">2 Children</option>
                  <option value="3">3 Children</option>
              </select>
          </div>
      </div>

      <div class="form-group">
          <label>Check in</label>
          <input type="date" name="checkin" id="checkin">
      </div>

      <div class="form-group">
          <label>Check out</label>
          <input type="date" name="checkout" id="checkout">
      </div>

      <div class="form-group">
        <label>Unit</label>
        <select name="id_unit" id="room_id">
            <option value="">-- Pilih unit --</option>
            @foreach ($unit as $item)
                <option value="{{ $item->id_unit }}" data-price="{{ $item->harga }}">
                    {{ $item->nama_unit }} - Rp {{ number_format($item->harga, 0, ',', '.') }} / malam
                </option>
            @endforeach
        </select>
        <p id="unit_status" style="margin-top:5px;font-weight:bold;"></p>
      </div>


      <div class="form-group">
          <label>Total Harga</label>
          <p id="total_harga">Rp 0</p>
      </div>

      <button type="submit" class="btn-book">Booking</button>
  </form>

@endsection

@push('scripts')
  <script>
    const roomSelect = document.getElementById('room_id');
    const checkinInput = document.getElementById('checkin');
    const checkoutInput = document.getElementById('checkout');
    const totalHargaEl = document.getElementById('total_harga');
    const statusMsg = document.getElementById('unit_status');

    function calculateTotal() {
        const roomOption = roomSelect.options[roomSelect.selectedIndex];
        const price = parseFloat(roomOption.getAttribute('data-price')) || 0;

        const checkin = new Date(checkinInput.value);
        const checkout = new Date(checkoutInput.value);

        let days = 0;
        if (checkin && checkout && checkout > checkin) {
            days = (checkout - checkin) / (1000 * 60 * 60 * 24);
        }

        const total = price * days;
        totalHargaEl.textContent = "Rp " + total.toLocaleString('id-ID');
    }

    // ✅ Cek ketersediaan unit via AJAX
    async function checkAvailability() {
        const id_unit = roomSelect.value;
        const checkin = checkinInput.value;
        const checkout = checkoutInput.value;

        if (!id_unit || !checkin || !checkout) {
            statusMsg.textContent = "";
            return;
        }

        try {
            const response = await fetch(`/check-availability?id_unit=${id_unit}&checkin=${checkin}&checkout=${checkout}`);
            const data = await response.json();

            if (data.available) {
                statusMsg.textContent = "Tersedia";
                statusMsg.style.color = "green";
            } else {
                statusMsg.textContent = "Tidak Tersedia";
                statusMsg.style.color = "red";
            }
        } catch (error) {xq
            console.error(error);
        }
    }

    // ✅ Event listener
    roomSelect.addEventListener('change', () => { calculateTotal(); checkAvailability(); });
    checkinInput.addEventListener('change', () => { calculateTotal(); checkAvailability(); });
    checkoutInput.addEventListener('change', () => { calculateTotal(); checkAvailability(); });
  </script>
@endpush