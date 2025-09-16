@extends('admin.layout.app')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('unit.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf

                            {{-- gambar --}}
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">GAMBAR</label>
                                <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                                    name="gambar">

                                <!-- error message untuk gambar -->
                                @error('gambar')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- nama --}}
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">NAMA</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    name="nama" value="{{ old('nama') }}" placeholder="Masukkan Nama Fasilitas">

                                <!-- error message untuk nama -->
                                @error('nama')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- available --}}
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Available For</label>
                                <input type="text" class="form-control @error('available') is-invalid @enderror"
                                    name="available" value="{{ old('available') }}" placeholder="Masukkan ketentuan jumlah customer">

                                <!-- error message untuk nama -->
                                @error('available')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- deskripsi --}}
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">DESKRIPSI</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="5"
                                    placeholder="Masukkan Deskripsi Fasilitas">{{ old('deskripsi') }}</textarea>

                                <!-- error message untuk deskripsi -->
                                @error('deskripsi')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- harga --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">HARGA</label>
                                        <input type="number" class="form-control @error('harga') is-invalid @enderror"
                                            name="harga" value="{{ old('harga') }}"
                                            placeholder="Masukkan Harga Unit">

                                        <!-- error message untuk harga -->
                                        @error('harga')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-md btn-coklat me-3 ">Save</button>
                            <button type="reset" class="btn btn-md btn-danger">Reset</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
    

    
