@extends('admin.layout.app')

@section('title', 'Manajemen Booking')

@push('styles')
<style>
    .text-brown { color:#6d4c41; }
    .bg-brown-soft { background:#fff3e0; color:#6d4c41; }
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

    <h4 class="fw-semibold text-brown mb-3">Manajemen Booking</h4>

    {{-- FILTER --}}
    <div class="row g-2 mb-3">
        <div class="col-md-3">
            <input type="text" id="filter-search" class="form-control form-control-sm" placeholder="Cari booking...">
        </div>
        <div class="col-md-3">
            <select id="filter-range" class="form-select form-select-sm">
                <option value="">Semua</option>
                <option value="1month">1 Bulan</option>
                <option value="3month">3 Bulan</option>
                <option value="6month">6 Bulan</option>
            </select>
        </div>
        <div class="col-md-3">
            <select id="filter-status" class="form-select form-select-sm">
                <option value="">Semua</option>
                <option value="pending">Pending</option>
                <option value="ongoing">Ongoing</option>
                <option value="completed">Completed</option>
            </select>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="card shadow-sm rounded-4">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kode</th>
                        <th>Email</th>
                        <th>Unit</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="tbody-booking"></tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL EDIT --}}
<div class="modal fade" id="editStatusModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <form id="formEditStatus" method="POST">
        @csrf
        @method('PUT')

        <div class="modal-header">
            <h5>Edit Check In & Check Out</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
            <div class="mb-3" id="group-checkin">
                <label>Check In</label>
                <input type="datetime-local" name="checkin_time" class="form-control">
            </div>

            <div class="mb-3" id="group-checkout">
                <label>Check Out</label>
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
$(document).ready(function () {

    const isResepsionis = true;
    const modal = new bootstrap.Modal(document.getElementById('editStatusModal'));

    function formatDateTime(value) {
        if (!value) return '';
        return value.substring(0, 16).replace(' ', 'T');
    }

    function loadBooking() {
        $.ajax({
            url: "{{ route('booking.data') }}",
            method: "GET",
            data: {
                q: $("#filter-search").val(),
                status: $("#filter-status").val(),
                range: $("#filter-range").val()
            },
            success: renderTable,
            error: () => console.error("Gagal memuat data booking")
        });
    }

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

                // BADGE STATUS (VERSI ASLI KAMU)
                const statusBadge = {
                    'pending': `<span class="badge bg-secondary bg-opacity-10 text-secondary">Pending</span>`,

                    'ongoing': `<span class="badge bg-warning bg-opacity-10 text-warning">
                                    Check In<br>
                                    <small>${item.checkin ?? ''}</small>
                                </span>`,

                    'completed': `<span class="badge bg-success bg-opacity-10 text-success">
                                    Check Out<br>
                                    <small>${item.checkout ?? ''}</small>
                                </span>`,

                    'canceled': `<span class="badge bg-danger bg-opacity-10 text-danger">Canceled</span>`
                }[status] || status;

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

                        <td>
                            <button class="btn btn-sm btn-link text-brown btn-edit-status"
                                data-id="${item.id}"
                                data-checkin="${item.checkin ?? ''}"
                                data-checkout="${item.checkout ?? ''}"
                                data-status="${item.status}">
                                <i class="bx bxs-pen"></i>
                            </button>
                        </td>
                    </tr>
                `;
            });
        }

        $("#tbody-booking").html(rows);
    }

    // OPEN MODAL EDIT
    $(document).on("click", ".btn-edit-status", function () {

        const id = $(this).data("id");
        const checkin = $(this).data("checkin");
        const checkout = $(this).data("checkout");
        const status = $(this).data("status");

        $("#formEditStatus").attr("action", `/admin/booking/${id}/update_waktu`);

        // Reset
        $("#group-checkin, #group-checkout").show();
        $("input[name='checkin_time'], input[name='checkout_time']")
        .prop("readonly", false)
        .val('');

        // Atur visibilitas input berdasarkan status
        if (status === 'pending') {
            // Tampilkan checkin, sembunyikan checkout
            $("#group-checkout").hide();
            $("input[name='checkin_time']").val(formatDateTime(checkin));
        } else if (status === 'ongoing') {
            // Sembunyikan input check-in
            $("input[name='checkin_time']")
                .prop("readonly", true)
                .val(formatDateTime(checkin));

            $("input[name='checkout_time']")
                .val('');
        } else if (status === 'completed') {
            // Sembunyikan kedua input
            $("#group-checkin, #group-checkout").hide();
        }

        modal.show();
    });

    // FILTER EVENT
    $("#filter-search").on("keyup", function () {
        clearTimeout(window.delay);
        window.delay = setTimeout(loadBooking, 300);
    });

    $("#filter-range, #filter-status").on("change", loadBooking);

    loadBooking();
});
</script>
@endpush

