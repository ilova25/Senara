<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Booking</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #6d4c41;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table th {
            background: #f5e6d3;
            padding: 8px;
            border: 1px solid #ddd;
            font-size: 11px;
        }
        table td {
            padding: 7px;
            border: 1px solid #ddd;
            font-size: 11px;
        }
        .text-center { text-align: center; }
        .badge {
            padding: 3px 6px;
            border-radius: 4px;
            font-size: 10px;
            color: white;
        }
        .pending { background-color: #ff9800; }
        .paid { background-color: #4caf50; }
        .cancel { background-color: #f44336; }
    </style>
</head>
<body>

<h2>Laporan Data Booking</h2>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Tamu</th>
            <th>Kode Booking</th>
            <th>Email</th>
            <th>Unit</th>
            <th>Check-in</th>
            <th>Check-out</th>
            <th>Total</th>
            <th>Status Bayar</th>
            <th>Status Menginap</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($booking as $item)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->kode_booking }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->unit->nama_unit ?? '-' }}</td>
                <td>{{ $item->checkin }}</td>
                <td>{{ $item->checkout }}</td>
                <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>

                {{-- STATUS BAYAR --}}
                <td>
                    @if ($item->payment)
                        @if ($item->payment->status_pembayaran === 'pending')
                            <span class="badge pending">Pending</span>
                        @elseif ($item->payment->status_pembayaran === 'paid')
                            <span class="badge paid">Paid</span>
                        @else
                            <span class="badge cancel">Canceled</span>
                        @endif
                    @else
                        Belum ada
                    @endif
                </td>

                {{-- STATUS MENGINAP --}}
                <td>
                    @if ($item->status_menginap === 'ongoing')
                        <span class="badge pending">Ongoing</span>
                    @elseif ($item->status_menginap === 'completed')
                        <span class="badge paid">Completed</span>
                    @elseif ($item->status_menginap === 'canceled')
                        <span class="badge cancel">Canceled</span>
                    @else
                        Pending
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
