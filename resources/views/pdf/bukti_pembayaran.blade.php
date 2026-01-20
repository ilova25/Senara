<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bukti Pembayaran</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #27ae60;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            color: #27ae60;
        }
        .status-paid {
            background: #27ae60;
            color: white;
            padding: 10px 20px;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin: 20px 0;
            border-radius: 5px;
        }
        .info-section {
            margin-bottom: 20px;
        }
        .info-section h3 {
            background: #ecf0f1;
            padding: 8px;
            margin: 0 0 10px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        table td:first-child {
            font-weight: bold;
            width: 40%;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 10px;
            color: #7f8c8d;
        }
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 80px;
            color: rgba(39, 174, 96, 0.1);
            z-index: -1;
        }
    </style>
</head>
<body>
    <div class="watermark">PAID</div>
    
    <div class="header">
        <h1>BUKTI PEMBAYARAN</h1>
        <p>{{ config('app.name') }}</p>
    </div>

    <div class="status-paid">
        ✓ PEMBAYARAN BERHASIL
    </div>

    <div class="info-section">
        <h3>Informasi Pembayaran</h3>
        <table>
            <tr>
                <td>Order ID</td>
                <td>: {{ $payment->order_id }}</td>
            </tr>
            <tr>
                <td>Transaction ID</td>
                <td>: {{ $payment->transaction_id ?? '-' }}</td>
            </tr>
            <tr>
                <td>Metode Pembayaran</td>
                <td>: {{ strtoupper($payment->metode_pembayaran ?? '-') }}</td>
            </tr>
            <tr>
                <td>Waktu Transaksi</td>
                <td>: {{ $payment->transaction_time ? $payment->transaction_time->format('d F Y H:i:s') : '-' }}</td>
            </tr>
            <tr>
                <td>Status</td>
                <td>: <strong style="color: #27ae60;">{{ strtoupper($payment->status_pembayaran) }}</strong></td>
            </tr>
        </table>
    </div>

    <div class="info-section">
        <h3>Detail Booking</h3>
        <table>
            <tr>
                <td>Nomor Booking</td>
                <td>: {{ $booking->kode_booking }}</td>
            </tr>
            <tr>
                <td>Nama Tamu</td>
                <td>: {{ $booking->nama }}</td>
            </tr>
            <tr>
                <td>Tipe Kamar</td>
                <td>: {{ $booking->unit->nama_unit ?? '-' }}</td>
            </tr>
            <tr>
                <td>Check-in</td>
                <td>: {{ \Carbon\Carbon::parse($booking->checkin)->format('d F Y') }}</td>
            </tr>
            <tr>
                <td>Check-out</td>
                <td>: {{ \Carbon\Carbon::parse($booking->checkout)->format('d F Y') }}</td>
            </tr>
            {{-- <tr>
                <td>Lama Menginap</td>
                <td>: {{ $booking->nights }} malam</td>
            </tr> --}}
        </table>
    </div>

    <div class="info-section">
        <h3>Rincian Pembayaran</h3>
        <table>
            <tr>
                <td>Jumlah Dibayar</td>
                <td>: <strong style="font-size: 18px; color: #27ae60;">Rp {{ number_format($payment->gross_amount, 0, ',', '.') }}</strong></td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>Dokumen ini adalah bukti pembayaran yang sah</p>
        <p>Digenerate secara otomatis pada {{ now()->format('d F Y H:i:s') }}</p>
        <p>Terima kasih telah melakukan pembayaran</p>
    </div>
</body>
</html>