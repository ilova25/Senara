@extends('admin.layout.app')
@section('title', 'Ulasan Pengguna')

@push('styles')
<style>
    .text-brown { color:#6d4c41; }
    .bg-brown-soft {
        background:#fff3e0;
        color:#6d4c41;
    }
    .btn-coklat {
        background-color:#6d4c41;
        color:#fff;
        border:none;
    }
    .btn-coklat:hover {
        background-color:#5d4037;
        color:#fff;
    }
</style>
@endpush

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kritik dan Saran</h1>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Masukan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($masukan as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->user->username }}</td>
                    <td>{{ $item->user->email }}</td>
                    <td>{{ $item->masukan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection