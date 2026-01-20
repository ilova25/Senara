<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bukti Booking</title>
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
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            color: #2c3e50;
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
            color: rgba(0, 200, 0, 0.1);
            z-index: -1;
        }
    </style>
</head>
<body>
    <div class="watermark">CONFIRMED</div>
    
    <div class="header">
        <h1>BUKTI BOOKING GUESTHOUSE</h1>
        <p>{{ config('app.name') }}</p>
    </div>

    <div class="info-section">
        <h3>Informasi Booking</h3>
        <table>
            <tr>
                <td>Nomor Booking</td>
                <td>: {{ $booking->kode_booking }}</td>
            </tr>
            <tr>
                <td>Tanggal Booking</td>
                <td>: {{ $booking->created_at->format('d F Y H:i') }}</td>
            </tr>
            <tr>
                <td>Status</td>
                <td>: <strong>{{ strtoupper($booking->status) }}</strong></td>
            </tr>
        </table>
    </div>

    <div class="info-section">
        <h3>Data Tamu</h3>
        <table>
            <tr>
                <td>Nama</td>
                <td>: {{ $booking->nama }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>: {{ $booking->user->email ?? '-' }}</td>
            </tr>
            <tr>
                <td>Telepon</td>
                <td>: {{ $booking->user->no_hp ?? '-' }}</td>
            </tr>
        </table>
    </div>

    <div class="info-section">
        <h3>Detail Kamar</h3>
        <table>
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
                <td>Jumlah Malam</td>
                <td>: {{ $booking->nights }} malam</td>
            </tr>
            <tr>
                <td>Jumlah Tamu</td>
                <td>: {{ $booking->guests }} orang</td>
            </tr> --}}
        </table>
    </div>

    <div class="info-section">
        <h3>Total Pembayaran</h3>
        <table>
            <tr>
                <td>Total</td>
                <td>: <strong style="font-size: 16px;">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</strong></td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>Dokumen ini digenerate secara otomatis pada {{ now()->format('d F Y H:i:s') }}</p>
        <p>Terima kasih telah mempercayai {{ config('app.name') }}</p>
    </div>
</body>
</html>