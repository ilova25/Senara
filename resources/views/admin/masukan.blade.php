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
<div class="row">
    <div class="col-12">
        <!--Table-->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center py-3">
                <div>
                    <h5 class="mb-0 fw-semibold">Ulasan</h5>
                    <small class="text-muted">Lihat ulasan pelanggan Senara Guesthouse</small>
                </div>
            </div>

            <div class="card-body p-0">
                @if ($masukan->isEmpty())
                    <div class="alert alert-danger m-3">
                        Data ulasan belum ada
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="fw-semibold small text-muted text-uppercase">No</th>
                                    <th class="fw-semibold small text-muted text-uppercase">Nama</th>
                                    <th class="fw-semibold small text-muted text-uppercase">Kode Booking</th>
                                    <th class="fw-semibold small text-muted text-uppercase">Rating</th>
                                    <th class="fw-semibold small text-muted text-uppercase">Ulasan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($masukan as $i => $s)
                                    <tr>
                                        <td>{{$i + 1 }}</td>
                                        {{-- <td class="text-center">
                                            <img src="{{ asset('/storage/fasilitas/'.$s->gambar) }}" class="rounded" style="width: 150px">
                                        </td> --}}
                                        <td>{{ $s->user->nama }}</td>
                                        <td>{{ $s->booking->kode_booking }}</td>
                                        <td>{{ $s->rating }}</td>
                                        <td>{{ strip_tags($s->coment) }}</td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                {{-- <a href="{{ route('fasilitas.show', $s->id) }}" class="btn btn-sm btn-dark">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('fasilitas.edit', $s->id) }}" class="btn btn-sm btn-primary">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?');"
                                                    action="{{ route('fasilitas.destroy', $s->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form> --}}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- <div class="p-3">
                        {{ $pesanan->links() }}
                    </div> --}}
                @endif
            </div>
        </div>
    </div>
</div>
@endsection