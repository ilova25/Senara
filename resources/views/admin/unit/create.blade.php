@extends('admin.layout.app')

@section('content')
<div class="container-fluid py-4">

    {{-- Wrapper agar header & form sejajar --}}
    <div class="mx-auto" style="max-width: 960px;">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-0 fw-bold text-brown">Tambah Unit Baru</h4>
                <small class="text-muted">Lengkapi informasi unit dan fasilitasnya.</small>
            </div>

            <a href="{{ route('unit.index') }}" class="btn btn-outline-secondary">
                Kembali ke Daftar Unit
            </a>
        </div>

        {{-- Card Form --}}
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">

                {{-- Judul section
                <div class="d-flex align-items-center mb-3">
                    <span class="badge rounded-pill bg-brown-soft me-2">Step 1</span>
                    <h5 class="mb-0 fw-semibold text-brown">Informasi Unit</h5>
                </div> --}}

                <form action="{{ route('unit.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- GAMBAR UNIT --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Gambar Unit</label>
                        <input type="file"
                               class="form-control @error('gambar') is-invalid @enderror"
                               name="gambar" accept="image/*">
                        @error('gambar')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- NAMA --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Unit</label>
                        <input type="text"
                               class="form-control @error('nama') is-invalid @enderror"
                               name="nama"
                               value="{{ old('nama') }}">
                        @error('nama')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- DESKRIPSI --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                  name="deskripsi"
                                  rows="4">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- HARGA --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Harga per Malam (Rp)</label>
                        <input type="number"
                               class="form-control @error('harga') is-invalid @enderror"
                               name="harga"
                               value="{{ old('harga') }}">
                        @error('harga')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- FASILITAS --}}
                    <div class="border-top pt-3 mt-2 mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="mb-0 fw-semibold text-brown">Fasilitas Unit</h6>
                            <small class="text-muted">Minimal 1 fasilitas</small>
                        </div>

                        <div id="fasilitas-wrapper">
                            <div class="row g-3 fasilitas-item mb-2">
                                <div class="col-md-5">
                                    <label class="form-label">Nama Fasilitas</label>
                                    <input type="text" name="fasilitas[0][nama]" class="form-control" required>
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label">Gambar Fasilitas</label>
                                    <input type="file" name="fasilitas[0][gambar]" class="form-control" accept="image/*" required>
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="button"
                                            class="btn btn-outline-danger w-100 btn-remove-fasilitas d-none">
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </div>

                        <button type="button" id="btn-add-fasilitas" class="btn btn-sm btn-outline-secondary mt-1">
                            + Tambah Fasilitas
                        </button>
                    </div>

                    {{-- ACTION BUTTONS --}}
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="reset" class="btn btn-outline-secondary">Reset</button>
                        <button type="submit" class="btn btn-coklat">Simpan Unit</button>
                    </div>
                </form>
            </div>
        </div>
    </div> {{-- /max-width wrapper --}}
</div>

@push('styles')
<style>
    .text-brown { color:#6d4c41; }
    .btn-coklat {
        background-color:#6d4c41;
        color:#fff;
        border:none;
    }
    .btn-coklat:hover {
        background-color:#5d4037;
        color:#fff;
    }
    .bg-brown-soft {
        background:#fff3e0;
        color:#6d4c41;
    }
</style>
@endpush

@push('scripts')
<script>
    let fasilitasIndex = 1;

    document.getElementById('btn-add-fasilitas').addEventListener('click', function () {
        const wrapper = document.getElementById('fasilitas-wrapper');

        const item = document.createElement('div');
        item.classList.add('row', 'g-3', 'fasilitas-item', 'mb-2');
        item.innerHTML = `
            <div class="col-md-5">
                <label class="form-label">Nama Fasilitas</label>
                <input type="text" name="fasilitas[${fasilitasIndex}][nama]" class="form-control" required>
            </div>
            <div class="col-md-5">
                <label class="form-label">Gambar Fasilitas</label>
                <input type="file" name="fasilitas[${fasilitasIndex}][gambar]" class="form-control" accept="image/*" required>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="button" class="btn btn-outline-danger w-100 btn-remove-fasilitas">
                    Hapus
                </button>
            </div>
        `;
        wrapper.appendChild(item);
        fasilitasIndex++;
    });

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('btn-remove-fasilitas')) {
            const item = e.target.closest('.fasilitas-item');
            item.remove();
        }
    });
</script>
@endpush
@endsection
