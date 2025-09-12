@extends('layout.app')

@section('content')
<style>
.qr-code-section {
  display: flex; justify-content: center; align-items: center;
  min-height: 80vh; background: #f9f9f9;
}
.qr-code-box {
  background: #fff; padding: 30px;
  border-radius: 12px; text-align: center;
  box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}
.qr-code-box h3 { margin-bottom: 10px; }
.qr-code-box img {
  margin-top: 15px; width: 200px; height: 200px;
}
</style>

<div class="qr-code-section">
  <div class="qr-code-box">
    <h3>QR CODE</h3>
    <p>Please show this bar code to the receptionist.</p>
    <img src="{{ asset('images/qr-code.png') }}" alt="QR Code">
  </div>
</div>
@endsection
