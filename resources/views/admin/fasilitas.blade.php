@extends('admin.layout.app')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Fasilitas</h1>
    </div>

    <!--Table-->
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <a href="{{ route('fasilitas.create') }}" class="btn btn-md btn-coklat mb-3">Tambah Data</a>

                    @if ($fasilitas->isEmpty())
                        <div class="alert alert-danger">
                            Data fasilitas belum ada.
                        </div>
                    @else
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Gambar</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col" style="width: 20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fasilitas as $item)
                                    <tr>
                                        <td class="text-center">
                                            <img src="{{ asset('/storage/fasilitas/'.$item->gambar) }}" class="rounded" style="width: 150px">
                                        </td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->jumlah }}</td>
                                        <td>{{ strip_tags($item->deskripsi) }}</td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('fasilitas.destroy', $item->id) }}" method="POST">
                                                <a href="{{ route('fasilitas.show', $item->id) }}" class="btn btn-sm btn-dark"><i class="bi bi-eye"></i></a>
                                                <a href="{{ route('fasilitas.edit', $item->id) }}" class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $fasilitas->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
