@extends('admin.layout.app')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Pegawai</h1>
    </div>

    <!-- Table -->
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <a href="{{ route('pegawai.create') }}" class="btn btn-md btn-coklat mb-3">Tambah Data</a>

                    @if ($pegawai->isEmpty())
                        <div class="alert alert-danger mb-0">
                            Data pegawai belum ada.
                        </div>
                    @else
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">No. Telepon</th>
                                    <th scope="col" style="width: 20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pegawai as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->username }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>{{ $item->no_hp }}</td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('pegawai.destroy', $item->id) }}" method="POST">
                                                <a href="{{ route('pegawai.edit', $item->id) }}" class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $pegawai->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
