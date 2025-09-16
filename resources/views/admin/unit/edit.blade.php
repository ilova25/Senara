@extends('admin.layout.app')

@section('content')
    
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('unit.update', $unit->id_unit) }}" method="POST" enctype="multipart/form-data">

                            @csrf
                            @method('PUT')

                            {{-- gambar --}}
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">GAMBAR</label>

                                <!-- Preview gambar lama -->
                                @if($unit->gambar)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/unit/'.$unit->gambar) }}" 
                                             alt="Gambar Unit" 
                                             class="rounded" style="width: 150px">
                                    </div>
                                @endif

                                <!-- Input file baru -->
                                <input type="file" class="form-control @error('gambar') is-invalid @enderror" name="gambar">

                                @error('gambar')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            {{-- nama --}}
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">NAMA</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', $unit->nama_unit) }}" placeholder="Masukkan Judul Product">

                                <!-- error message untuk title -->
                                @error('nama')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            {{-- available --}}
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Available For</label>
                                <input type="text" class="form-control @error('available') is-invalid @enderror" name="available" value="{{ old('available', $unit->available) }}" placeholder="Perbarui ketentuan jumlah customer">

                                <!-- error message untuk title -->
                                @error('available')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            {{-- deskripsi --}}
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">DESKRIPSI</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="5" placeholder="Masukkan Description Product">{{ old('deskripsi', $unit->deskripsi) }}</textarea>

                                <!-- error message untuk description -->
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
                                        <input type="number" class="form-control @error('harga') is-invalid @enderror" name="harga" value="{{ old('harga', $unit->harga) }}" placeholder="Masukkan Harga Unit">

                                        <!-- error message untuk price -->
                                        @error('harga')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-md btn-primary me-3">UPDATE</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

    
