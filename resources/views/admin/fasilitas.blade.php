@extends('admin.layout.app')
@section('title', 'Fasilitas')
@push('styles')
    <style>
    .btn-coklat {
        background-color: #543310;
        color: #fff;
        transition: 0.2s;
    }
    .btn-coklat:hover {
        background-color: #5d4037;
        color: #fff;
    }
    .text-brown {
        color: #6d4c41 !important;
    }
</style>
@endpush

@section('content')

    <!--Table-->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0 fw-semibold">Data Fasilitas</h5>
            <a href="{{ route('fasilitas.create') }}" class="btn btn-md btn-coklat">
                <i class="bi bi-plus-circle me-1"></i> Tambah Pesanan
            </a>
        </div>

        <div class="card-body p-0">
            @if ($fasilitas->isEmpty())
                <div class="alert alert-danger m-3">
                    Data pesanan belum ada.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="fw-semibold small text-muted text-uppercase">No</th>
                                {{-- <th class="fw-semibold small text-muted text-uppercase">Gambar</th> --}}
                                <th class="fw-semibold small text-muted text-uppercase">Nama</th>
                                {{-- <th class="fw-semibold small text-muted text-uppercase">Jumlah</th>
                                <th class="fw-semibold small text-muted text-uppercase">Deskripsi</th> --}}
                                <th class="fw-semibold small text-muted text-uppercase text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fasilitas as $i => $s)
                                <tr>
                                    <td>{{$i + 1 }}</td>
                                    {{-- <td class="text-center">
                                        <img src="{{ asset('/storage/fasilitas/'.$s->gambar) }}" class="rounded" style="width: 150px">
                                    </td> --}}
                                    <td>{{ $s->nama }}</td>
                                    {{-- <td>{{ $s->jumlah }}</td>
                                    <td>{{ strip_tags($s->deskripsi) }}</td> --}}
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

    
@endsection
