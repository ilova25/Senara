@extends('admin.layout.app')

@section('content')
    <table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Unit</th>
            <th>Checkin</th>
            <th>Checkout</th>
            <th>Total</th>
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
            </tr>
        @endforeach
    </tbody>
</table>
@endsection