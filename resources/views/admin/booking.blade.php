@extends('admin.layout.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Booking</h1>
</div>

{{-- @dd($booking) --}}

<div class="table-responsive">
<table class="table table-bordered">
    <thead class="table-light">
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Unit</th>
            <th>Checkin</th>
            <th>Checkout</th>
            <th>Total</th>
            <th>Bukti Pembayaran</th>
            <th>Status Pembayaran</th>
            <th>Aksi Pembayaran</th>
            <th>Status Pemesanan</th>
            <th>Aksi Pemesanan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($booking as $item)
            <tr>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->unit->nama_unit ?? '-' }}</td>
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
                    @if($item->payment)
                        @if($item->payment->status_pembayaran == 'pending')
                            <span class="badge bg-warning">Pending</span>
                        @elseif($item->payment->status_pembayaran == 'paid')
                            <span class="badge bg-success">Paid</span>
                        @elseif($item->payment->status_pembayaran == 'canceled')
                            <span class="badge bg-danger">Canceled</span>
                        @endif
                    @else
                        <span class="badge bg-secondary">Belum ada pembayaran</span>
                    @endif
                </td>
                <td>
                    @if($item->payment)
                        <form action="{{ route('booking.updateStatus', $item->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="status_pembayaran" onchange="this.form.submit()" class="form-select form-select-sm">
                                <option value="pending" {{ $item->payment->status_pembayaran == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="paid" {{ $item->payment->status_pembayaran == 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="canceled" {{ $item->payment->status_pembayaran == 'canceled' ? 'selected' : '' }}>Canceled</option>
                            </select>
                        </form>
                    @endif
                </td>
                <td>
                        @if($item->status_menginap == 'ongoing')
                            <span class="badge bg-warning">Ongoing</span>
                        @elseif($item->status_menginap == 'completed')
                            <span class="badge bg-success">Completed</span>
                        @elseif($item->status_menginap == 'canceled')
                            <span class="badge bg-danger">Canceled</span>
                        @else
                            <span class="badge bg-secondary">Pending</span>
                        @endif
                </td>
                <td>
                    @if($item)
                        <form action="{{ route('booking.updatePesanan', $item->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="status_pemesanan" onchange="this.form.submit()" class="form-select form-select-sm">
                                <option value="ongoing" {{ $item->status_menginap == 'ongoing' ? 'selected' : '' }}>Check In</option>
                                <option value="completed" {{ $item->status_menginap == 'completed' ? 'selected' : '' }}>Check Out</option>
                                <option value="canceled" {{ $item->status_menginap == 'canceled' ? 'selected' : '' }}>Canceled</option>
                            </select>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection
