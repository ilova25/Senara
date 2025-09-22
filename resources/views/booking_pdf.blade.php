<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Booking Detail</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Booking Details</h2>

    <table>
        <tr>
            <th>Guest</th>
            <td>{{ $booking->nama }}</td>
        </tr>
        <tr>
            <th>Check In</th>
            <td>{{ $booking->checkin }} (from 13:00)</td>
        </tr>
        <tr>
            <th>Check Out</th>
            <td>{{ $booking->checkout }} (by 12:00)</td>
        </tr>
        <tr>
            <th>Phone</th>
            <td>{{ $booking->user->no_hp }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $booking->email }}</td>
        </tr>
        <tr>
            <th>Booking Number</th>
            <td>{{ $booking->kode_booking }}</td>
        </tr>
    </table>

    <h3>Payment Details</h3>
    <table>
        <tr>
            <th>Date</th>
            <td>{{ now()->format('D, d M Y') }}</td>
        </tr>
        <tr>
            <th>Payment Method</th>
            <td>Direct Bank Transfer</td>
        </tr>
        <tr>
            <th>Total</th>
            <td>Rp{{ number_format($booking->total_harga, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ strtoupper($booking->status_pembayaran ?? 'PENDING') }}</td>
        </tr>
    </table>
</body>
</html>
