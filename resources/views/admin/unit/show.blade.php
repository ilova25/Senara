@extends('admin.layout.app')

@section('title', 'Detail Unit')

@section('content')
<div class="container py-4">

    {{-- Breadcrumb / Header sederhana --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-0 text-brown fw-bold">
                Detail Unit
            </h4>
        </div>

        <a href="{{ route('unit.index') }}" class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Daftar Unit
        </a>
    </div>

    <div class="row g-4">
        {{-- Kolom kiri: gambar unit --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded h-100">
                <div class="card-body p-2">
                    @if(!empty($unit->gambar))
                        <img src="{{ asset('storage/unit/'.$unit->gambar) }}" 
                             class="img-fluid rounded w-100"
                             alt="{{ $unit->nama_unit }}">
                    @else
                        <div class="d-flex flex-column justify-content-center align-items-center py-5 text-muted">
                            <i class="fa-solid fa-image fa-2x mb-2"></i>
                            <span>Tidak ada gambar unit</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Kolom kanan: detail unit --}}
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded mb-4">
                <div class="card-body">
                    <h3 class="mb-1">{{ $unit->nama_unit }}</h3>
                    <small class="text-muted d-block mb-3">
                        ID Unit: {{ $unit->id_unit }}
                    </small>

                    <h6 class="text-uppercase text-muted fw-bold mb-2">Deskripsi</h6>
                    <p class="mb-3">
                        {!! $unit->deskripsi !!}
                    </p>

                    <div class="row mb-3">

                        {{-- Harga --}}
                        <div class="col-md-6 mb-2">
                            <h6 class="text-uppercase text-muted fw-bold mb-1">Harga</h6>
                            <p class="mb-0 fw-semibold">
                                {{ 'Rp ' . number_format($unit->harga, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    <hr>

                    {{-- Fasilitas Unit --}}
                    <h5 class="mb-3">
                        <i class="fa-solid fa-wand-magic-sparkles me-1"></i>
                        Fasilitas Unit
                    </h5>

                    @if($unit->fasilitas->isEmpty())
                        <p class="text-muted mb-0">
                            Belum ada fasilitas yang terdaftar untuk unit ini.
                        </p>
                    @else
                        <div class="row g-3">
                            @foreach($unit->fasilitas as $f)
                                <div class="col-md-4 col-sm-6">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <div class="card-body p-2 d-flex flex-column align-items-center text-center">
                                            @if($f->gambar)
                                                <img src="{{ asset('storage/'.$f->gambar) }}" 
                                                    alt="{{ $f->nama }}" 
                                                    class="mb-2 rounded"
                                                    style="height: 60px; object-fit: cover;">
                                            @else
                                                <div class="d-flex flex-column justify-content-center align-items-center text-muted mb-2" style="height:60px;">
                                                    <i class="fa-solid fa-image-slash"></i>
                                                </div>
                                            @endif
                                            <span class="small fw-semibold">{{ $f->nama }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
