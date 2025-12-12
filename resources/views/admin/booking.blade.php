@extends('admin.layout.app')

@section('title', 'Manajemen Booking')

@php
    $searchAction = route('booking.admin');
    $searchPlaceholder = 'Cari nama tamu, kode, email, atau unit...';
@endphp

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
<div class="container-fluid py-4">

    {{-- Header halaman --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-0 fw-semibold text-brown">Manajemen Booking</h4>
            <small class="text-muted">
                Lihat dan kelola pemesanan tamu, status pembayaran, dan status menginap.
            </small>
        </div>
        <div class="d-flex gap-2">
            <a href="#" id="btn-export-pdf" class="btn btn-coklat">
                <i class="fa-solid fa-file-pdf"></i> Export PDF
            </a>
        </div>
    </div>

    <div class="px-3 pb-3">

        <div class="row g-2">

            <!-- SEARCH TABLE -->
            <div class="col-md-3">
                <label class="small text-muted">Cari Booking</label>
                <input type="text" id="filter-search" class="form-control form-control-sm" placeholder="Cari nama / kode / email / unit...">
            </div>

            <div class="col-md-3">
                <label class="small text-muted">Rentang Waktu</label>
                <select id="filter-range" class="form-select form-select-sm">
                    <option value="">Semua</option>
                    <option value="1month">1 Bulan Terakhir</option>
                    <option value="3month">3 Bulan Terakhir</option>
                    <option value="6month">6 Bulan Terakhir</option>
                    <option value="1year">1 Tahun Terakhir</option>
                </select>
            </div>

            <!-- FILTER STATUS -->
            <div class="col-md-3">
                <label class="small text-muted">Status Menginap</label>
                <select id="filter-status" class="form-select form-select-sm">
                    <option value="">Semua</option>
                    <option value="pending">Pending</option>
                    <option value="ongoing">Ongoing</option>
                    <option value="completed">Completed</option>
                    <option value="canceled">Canceled</option>
                </select>
            </div>
        </div>

    </div>


    {{-- Card Tabel Booking --}}
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-semibold">Daftar Booking</h5>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="small text-muted text-uppercase fw-semibold" style="width: 60px;">No</th>
                            <th class="small text-muted text-uppercase fw-semibold">Nama Tamu</th>
                            <th class="small text-muted text-uppercase fw-semibold">Kode Booking</th>
                            <th class="small text-muted text-uppercase fw-semibold">Email</th>
                            <th class="small text-muted text-uppercase fw-semibold">Unit</th>
                            <th class="small text-muted text-uppercase fw-semibold">Check-in</th>
                            <th class="small text-muted text-uppercase fw-semibold">Check-out</th>
                            <th class="small text-muted text-uppercase fw-semibold">Total</th>
                            <th class="small text-muted text-uppercase fw-semibold">Status Menginap</th>
                            @if (Auth::check() && Auth::user()->role === 'resepsionis')
                                <th class="small text-muted text-uppercase fw-semibold">Aksi</th>
                                {{-- <th class="small text-muted text-uppercase fw-semibold">Bukti Bayar</th>
                                <th class="small text-muted text-uppercase fw-semibold">Status Bayar</th>
                                <th class="small text-muted text-uppercase fw-semibold">Aksi Bayar</th> --}}
                            @endif
                        </tr>
                    </thead>
                    <tbody id="tbody-booking">
                        {{-- akan diisi via AJAX --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Modal untuk bukti pembayaran --}}
{{-- <div class="modal fade" id="buktiModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Bukti Pembayaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <img id="buktiImage" src="" alt="Bukti pembayaran" class="img-fluid rounded shadow-sm">
        <p class="mt-2 mb-0 small text-muted" id="buktiNama"></p>
      </div>
    </div>
  </div>
</div> --}}

<!-- Modal Edit Check In & Check Out -->
<div class="modal fade" id="editStatusModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <form id="formEditStatus" method="POST">
        @csrf
        @method('PUT')

        <div class="modal-header">
            <h5 class="modal-title">Edit Check In & Check Out</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

            <div class="mb-3">
                <label class="form-label">Check In</label>
                <input type="datetime-local" name="checkin_time" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Check Out</label>
                <input type="datetime-local" name="checkout_time" class="form-control">
            </div>

        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-coklat">Simpan</button>
        </div>

      </form>

    </div>
  </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {

        const csrfToken = '{{ csrf_token() }}';
        const isResepsionis = @json(Auth::check() && Auth::user()->role === 'resepsionis');

        //
        // ============================
        //  RENDER TABLE
        // ============================
        //
        function renderTable(data) {
            let rows = "";

            if (!data || data.length === 0) {
                rows = `
                    <tr>
                        <td colspan="10" class="text-center py-4 text-muted">
                            Belum ada data booking.
                        </td>
                    </tr>
                `;
            } else {
                data.forEach((item, index) => {

                    const unitName = item.unit ? item.unit.nama_unit : "Tidak ada unit";
                    const status = item.status ?? "pending";
                    const total = Number(item.total_harga || 0).toLocaleString("id-ID");

                    //
                    // Badge Status Menginap
                    //
                    const statusBadge = {
                        'pending': `<span class="badge bg-secondary bg-opacity-10 text-secondary">Pending</span>`,

                        'ongoing': `<span class="badge bg-warning bg-opacity-10 text-warning">
                                        Check In<br><small>${item.checkin ?? ''}</small>
                                    </span>`,

                        'completed': `<span class="badge bg-success bg-opacity-10 text-success">
                                        Check Out<br><small>${item.checkout ?? ''}</small>
                                    </span>`,

                        'canceled': `<span class="badge bg-danger bg-opacity-10 text-danger">Canceled</span>`
                    }[status] || status;


                    //
                    // ROW TEMPLATE
                    //
                    rows += `
                        <tr>
                            <td>${index + 1}</td>
                            <td class="fw-semibold text-brown">${item.nama}</td>

                            <td>
                                ${item.kode_booking 
                                    ? `<span class="badge bg-brown-soft text-brown fw-semibold">${item.kode_booking}</span>`
                                    : `<span class="text-muted small">—</span>`}
                            </td>

                            <td>${item.email}</td>
                            <td>${unitName}</td>
                            <td>${item.checkin || '-'}</td>
                            <td>${item.checkout || '-'}</td>
                            <td><strong>Rp ${total}</strong></td>

                            <td>${statusBadge}</td>

                            ${
                                isResepsionis
                                ? `
                                    <td>
                                        <button class="btn btn-sm btn-link text-brown btn-edit-status" 
                                            data-id="${item.id}"
                                            data-checkin="${item.checkin_time ?? ''}"
                                            data-checkout="${item.checkout_time ?? ''}">
                                            <i class="bx bxs-pen"></i>
                                        </button>
                                    </td>
                                `
                                : ""
                            }
                        </tr>
                    `;
                });
            }

            $("#tbody-booking").html(rows);
            // bindAutoSubmit();
        }


        //
        // ============================
        //  AUTO SUBMIT STATUS UPDATE
        // ============================
        //
        function bindAutoSubmit() {
            $(".form-auto-submit select").off("change").on("change", function () {
                $(this).closest("form")[0].submit();
            });
        }


        //
        // ============================
        //  LOAD BOOKING (AJAX)
        // ============================
        //
        function loadBooking() {
            const params = {
                q: $("#filter-search").val(),
                status: $("#filter-status").val(),   // <-- sesuai database
                range: $("#filter-range").val()
            };

            $.ajax({
                url: "{{ route('booking.data') }}",
                method: "GET",
                data: params,
                success: renderTable,
                error: () => console.error("Gagal memuat data booking.")
            });
        }


        //
        // ============================
        //  EVENT FILTER
        
            $("#filter-range").on("change", loadBooking);
            $("#filter-status").on("change", loadBooking);
            $("#filter-start").on("change", loadBooking);
            $("#filter-end").on("change", loadBooking);

            $("#filter-search").on("keyup", function () {
                clearTimeout(window.searchDelay);
                window.searchDelay = setTimeout(loadBooking, 250);
            });
        // ============================
        //

        // Modal Edit
            const editStatusModal = new bootstrap.Modal(document.getElementById('editStatusModal'));

            $(document).on("click", ".btn-edit-status", function () {

                const id = $(this).data("id");
                const checkin = $(this).data("checkin") || "";
                const checkout = $(this).data("checkout") || "";

                // Set URL form
                $("#formEditStatus").attr("action", `/admin/booking/${id}/update_waktu`);

                // Set datetime value
                $("input[name='checkin_time']").val(checkin ? checkin.replace(" ", "T") : "");
                $("input[name='checkout_time']").val(checkout ? checkout.replace(" ", "T") : "");

                editStatusModal.show();
            });
        // end modal

        $("#btn-export-pdf").on("click", function () {

            const q = $("#filter-search").val();
            const range = $("#filter-range").val();
            const status = $("#filter-status").val();

            const url = `/admin/booking/export/pdf?`
                + `q=${encodeURIComponent(q)}`
                + `&range=${encodeURIComponent(range)}`
                + `&status=${encodeURIComponent(status)}`;

            window.open(url, "_blank");
        });


        loadBooking(); // initial load

    });
</script>
@endpush
