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
                                    <th scope="col" style="width: 5%">ID</th>
                                    <th scope="col" style="width: 20%">Username</th>
                                    <th scope="col" style="width: 25%">Email</th>
                                    <th scope="col" style="width: 20%">Password</th>
                                    <th scope="col" style="width: 20%">Alamat</th>
                                    <th scope="col" style="width: 20%">No. Telepon</th>
                                    <th scope="col" style="width: 30%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pegawai as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->username }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                            {{ $item->password }}
                                        </td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>{{ $item->no_hp }}</td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="{{ route('pegawai.edit', $item->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                <form onsubmit="return confirm('Apakah Anda Yakin ?');" 
                                                    action="{{ route('pegawai.destroy', $item->id) }}" 
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                                </form>
                                            </div>
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
