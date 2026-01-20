<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #27ae60 0%, #229954 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .success-icon {
            font-size: 48px;
            margin-bottom: 10px;
        }
        .content {
            padding: 30px 20px;
        }
        .alert-success {
            background: #d4edda;
            border-left: 4px solid #27ae60;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .booking-card {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #e0e0e0;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .label {
            font-weight: bold;
            color: #555;
        }
        .value {
            color: #333;
            text-align: right;
        }
        .total-amount {
            background: #27ae60;
            color: white;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            margin: 20px 0;
        }
        .total-amount .amount {
            font-size: 28px;
            font-weight: bold;
            margin: 10px 0;
        }
        .attachment-info {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            background: #27ae60;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px 0;
        }
        .footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #777;
            font-size: 12px;
            border-top: 1px solid #e0e0e0;
        }
        .footer p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="success-icon">✓</div>
            <h1>Pembayaran Berhasil!</h1>
            <p>Booking Anda telah dikonfirmasi</p>
        </div>
        
        <div class="content">
            <div class="alert-success">
                <strong>Terima kasih, {{ $booking->nama }}!</strong><br>
                Pembayaran Anda telah berhasil diproses. Kami telah menerima konfirmasi pembayaran Anda untuk booking di {{ config('app.name') }}.
            </div>

            <div class="booking-card">
                <h3 style="margin-top: 0; color: #27ae60;">📋 Detail Booking</h3>
                
                <div class="detail-row">
                    <span class="label">Nomor Booking</span>
                    <span class="value">{{ $booking->kode_booking }}</span>
                </div>
                
                <div class="detail-row">
                    <span class="label">Tipe Kamar</span>
                    <span class="value">{{ $booking->unit->name }}</span>
                </div>
                
                <div class="detail-row">
                    <span class="label">Check-in</span>
                    <span class="value">{{ \Carbon\Carbon::parse($booking->checkin)->format('d F Y') }}</span>
                </div>
                
                <div class="detail-row">
                    <span class="label">Check-out</span>
                    <span class="value">{{ \Carbon\Carbon::parse($booking->checkout)->format('d F Y') }}</span>
                </div>
                
                <div class="detail-row">
                    <span class="label">Lama Menginap</span>
                    <span class="value">{{ $booking->nights }} malam</span>
                </div>
                
                <div class="detail-row">
                    <span class="label">Jumlah Tamu</span>
                    <span class="value">{{ $booking->guests }} orang</span>
                </div>
            </div>

            <div class="booking-card">
                <h3 style="margin-top: 0; color: #27ae60;">💳 Informasi Pembayaran</h3>
                
                <div class="detail-row">
                    <span class="label">Order ID</span>
                    <span class="value">{{ $payment->order_id }}</span>
                </div>
                
                <div class="detail-row">
                    <span class="label">Metode Pembayaran</span>
                    <span class="value">{{ strtoupper($payment->payment_type ?? '-') }}</span>
                </div>
                
                <div class="detail-row">
                    <span class="label">Waktu Transaksi</span>
                    <span class="value">{{ $payment->transaction_time ? $payment->transaction_time->format('d F Y, H:i') : '-' }}</span>
                </div>
                
                <div class="detail-row">
                    <span class="label">Status</span>
                    <span class="value" style="color: #27ae60; font-weight: bold;">{{ strtoupper($payment->transaction_status) }}</span>
                </div>
            </div>

            <div class="total-amount">
                <div>Total Pembayaran</div>
                <div class="amount">Rp {{ number_format($payment->gross_amount, 0, ',', '.') }}</div>
                <div style="font-size: 12px;">Sudah Dibayar</div>
            </div>

            <div class="attachment-info">
                <strong>📎 Lampiran Email</strong><br>
                Email ini dilengkapi dengan 2 file PDF:
                <ul style="margin: 10px 0 0 0; padding-left: 20px;">
                    <li><strong>Bukti Booking</strong> - Konfirmasi reservasi Anda</li>
                    <li><strong>Bukti Pembayaran</strong> - Bukti transaksi pembayaran</li>
                </ul>
                <p style="margin: 10px 0 0 0; font-size: 12px;">
                    Silakan simpan kedua file tersebut sebagai bukti booking dan pembayaran Anda.
                </p>
            </div>

            <h3>📝 Instruksi Check-in:</h3>
            <ul>
                <li>Tunjukkan bukti booking saat check-in</li>
                <li>Bawa kartu identitas asli (KTP/SIM/Paspor)</li>
                <li>Check-in dimulai pukul 14:00 WIB</li>
                <li>Check-out maksimal pukul 12:00 WIB</li>
            </ul>

            <p>Jika ada pertanyaan, jangan ragu untuk menghubungi kami.</p>
            
            <p style="margin-top: 30px;">
                Salam hangat,<br>
                <strong>{{ config('app.name') }} Team</strong>
            </p>
        </div>

        <div class="footer">
            <p><strong>{{ config('app.name') }}</strong></p>
            <p>Email ini dikirim secara otomatis, mohon tidak membalas email ini.</p>
            <p>© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>