@extends('admin.layout.app')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Booking</h1>
    </div>

    <!--Table-->
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Unit</th>
                <th>Checkin</th>
                <th>Checkout</th>
                <th>Total</th>
                <th>Bukti Pembayaran</th>
                <th>Status Pembayaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($booking as $item)
                <tr>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->unit->nama_unit }}</td>
                    <td>{{ $item->checkin }}</td>
                    <td>{{ $item->checkout }}</td>
                    <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                    <td>
                        @if ($item->payment && $item->payment->bukti_pembayaran)
                            <a href="javascript:void(0);" 
                                onclick="showBukti('{{ asset('storage/bukti/' . $item->payment->bukti_pembayaran) }}', '{{ $item->nama }}')">
                                Lihat Bukti
                            </a>
                        @else
                            <span class="text-danger">Belum upload</span>
                        @endif
                    </td>
                    <td>
                        @if($item->status_pembayaran == 'pending')
                            <span class="badge bg-warning">Pending</span>
                        @elseif($item->status_pembayaran == 'confirmed')
                            <span class="badge bg-success">Paid</span>
                        @else
                            <span class="badge bg-danger">Cancelled</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('booking.updateStatus', $item->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="status_pembayaran" onchange="this.form.submit()" class="form-select">
                                <option value="pending" {{ $item->status_pembayaran == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $item->status_pembayaran == 'confirmed' ? 'selected' : '' }}>Paid</option>
                                <option value="cancelled" {{ $item->status_pembayaran == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection