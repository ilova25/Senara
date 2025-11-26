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
                            <th class="small text-muted text-uppercase fw-semibold">Bukti Bayar</th>
                            <th class="small text-muted text-uppercase fw-semibold">Status Menginap</th>
                            <th class="small text-muted text-uppercase fw-semibold">Aksi Menginap</th>
                            <th class="small text-muted text-uppercase fw-semibold">Status Bayar</th>
                            <th class="small text-muted text-uppercase fw-semibold">Aksi Bayar</th>
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
<div class="modal fade" id="buktiModal" tabindex="-1" aria-hidden="true">
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
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        const csrfToken = '{{ csrf_token() }}';

        // fungsi render tabel
        function renderTable(data) {
            let rows = '';

            if (!data || data.length === 0) {
                rows = `
                    <tr>
                        <td colspan="13" class="text-center py-4 text-muted">
                            Belum ada data booking.
                        </td>
                    </tr>
                `;
            } else {
                data.forEach((item, index) => {
                    const unitName   = item.unit ? item.unit.nama_unit : 'Tidak ada unit';
                    const kode       = item.kode_booking ?? '';
                    const email      = item.email ?? '';
                    const nama       = item.nama ?? '';
                    const checkin    = item.checkin ?? '';
                    const checkout   = item.checkout ?? '';
                    const totalHarga = item.total_harga ?? 0;
                    const payment    = item.payment;

                    let statusBayarBadge = `
                        <span class="badge bg-secondary bg-opacity-10 text-secondary">
                            Belum ada pembayaran
                        </span>
                    `;
                    if (payment) {
                        const status = payment.status_pembayaran;
                        if (status === 'pending') {
                            statusBayarBadge = `
                                <span class="badge bg-warning bg-opacity-10 text-warning">
                                    <i class="bi bi-circle-fill me-1" style="font-size:6px;"></i> Pending
                                </span>
                            `;
                        } else if (status === 'paid') {
                            statusBayarBadge = `
                                <span class="badge bg-success bg-opacity-10 text-success">
                                    <i class="bi bi-circle-fill me-1" style="font-size:6px;"></i> Paid
                                </span>
                            `;
                        } else if (status === 'canceled') {
                            statusBayarBadge = `
                                <span class="badge bg-danger bg-opacity-10 text-danger">
                                    <i class="bi bi-circle-fill me-1" style="font-size:6px;"></i> Canceled
                                </span>
                            `;
                        }
                    }

                    let buktiBayarHtml = `
                        <span class="badge bg-secondary bg-opacity-25 text-danger">
                            Belum upload
                        </span>
                    `;
                    if (payment && payment.bukti_pembayaran) {
                        const buktiUrl = `/storage/bukti/${payment.bukti_pembayaran}`;
                        buktiBayarHtml = `
                            <a href="javascript:void(0);"
                               onclick="showBukti('${buktiUrl}', '${nama.replace(/'/g, "\\'")}')"
                               class="small text-decoration-none">
                                <i class="bi bi-file-earmark-text me-1"></i> Lihat Bukti
                            </a>
                        `;
                    }

                    const statusMenginap = item.status_menginap ?? 'pending';
                    let statusMenginapBadge = `
                        <span class="badge bg-secondary bg-opacity-10 text-secondary">
                            Pending
                        </span>
                    `;
                    if (statusMenginap === 'ongoing') {
                        statusMenginapBadge = `
                            <span class="badge bg-warning bg-opacity-10 text-warning">
                                <i class="bi bi-circle-fill me-1" style="font-size:6px;"></i> Ongoing
                            </span>
                        `;
                    } else if (statusMenginap === 'completed') {
                        statusMenginapBadge = `
                            <span class="badge bg-success bg-opacity-10 text-success">
                                <i class="bi bi-circle-fill me-1" style="font-size:6px;"></i> Completed
                            </span>
                        `;
                    } else if (statusMenginap === 'canceled') {
                        statusMenginapBadge = `
                            <span class="badge bg-danger bg-opacity-10 text-danger">
                                <i class="bi bi-circle-fill me-1" style="font-size:6px;"></i> Canceled
                            </span>
                        `;
                    }

                    const urlUpdateStatusBayar = `/admin/booking/${item.id}/status`;
                    const urlUpdateStatusPesan = `/admin/booking/${item.id}/status_pemesanan`;

                    rows += `
                        <tr>
                            <td>${index + 1}</td>

                            <td class="fw-semibold text-brown">
                                ${nama}
                            </td>

                            <td>
                                ${
                                    kode
                                        ? `<span class="badge bg-brown-soft text-brown fw-semibold">${kode}</span>`
                                        : `<span class="text-muted small">—</span>`
                                }
                            </td>

                            <td>${email}</td>

                            <td>
                                ${
                                    unitName === 'Tidak ada unit'
                                        ? `<span class="badge bg-secondary bg-opacity-25 text-secondary">${unitName}</span>`
                                        : `<span class="fw-semibold">${unitName}</span>`
                                }
                            </td>

                            <td>${checkin || '-'}</td>
                            <td>${checkout || '-'}</td>

                            <td><strong>Rp ${Number(totalHarga).toLocaleString('id-ID')}</strong></td>

                            <td>
                                ${buktiBayarHtml}
                            </td>

                            <td>
                                ${statusMenginapBadge}
                            </td>

                            <td>
                                <form action="${urlUpdateStatusPesan}" method="POST" class="mb-0 form-update-menginap">
                                    <input type="hidden" name="_token" value="${csrfToken}">
                                    <input type="hidden" name="_method" value="PUT">
                                    <select name="status_pemesanan" class="form-select form-select-sm">
                                        <option value="ongoing"   ${statusMenginap === 'ongoing' ? 'selected' : ''}>Check In</option>
                                        <option value="completed" ${statusMenginap === 'completed' ? 'selected' : ''}>Check Out</option>
                                        <option value="canceled"  ${statusMenginap === 'canceled' ? 'selected' : ''}>Canceled</option>
                                    </select>
                                </form>
                            </td>

                            <td>
                                ${statusBayarBadge}
                            </td>

                            <td>
                                ${
                                    payment
                                        ? `
                                            <form action="${urlUpdateStatusBayar}" method="POST" class="mb-0 form-update-bayar">
                                                <input type="hidden" name="_token" value="${csrfToken}">
                                                <input type="hidden" name="_method" value="PUT">
                                                <select name="status_pembayaran"
                                                        class="form-select form-select-sm">
                                                    <option value="pending"  ${payment.status_pembayaran === 'pending' ? 'selected' : ''}>Pending</option>
                                                    <option value="paid"     ${payment.status_pembayaran === 'paid' ? 'selected' : ''}>Paid</option>
                                                    <option value="canceled" ${payment.status_pembayaran === 'canceled' ? 'selected' : ''}>Canceled</option>
                                                </select>
                                            </form>
                                          `
                                        : `<span class="text-muted small">—</span>`
                                }
                            </td>

                            
                        </tr>
                    `;
                });
            }

            $('#tbody-booking').html(rows);
            bindFormAutoSubmit();
        }

        function bindFormAutoSubmit() {
            $('.form-update-bayar select').off('change').on('change', function() {
                $(this).closest('form')[0].submit();
            });

            $('.form-update-menginap select').off('change').on('change', function() {
                $(this).closest('form')[0].submit();
            });
        }

        function loadBooking() {
            $.ajax({
                url: "{{ route('booking.data') }}",
                method: "GET",
                data: { q: '' },
                success: function(response) {
                    renderTable(response);
                },
                error: function() {
                    console.error('Gagal memuat data booking.');
                }
            });
        }

        function searchBooking(keyword) {
            $.ajax({
                url: "{{ route('booking.data') }}",
                method: "GET",
                data: { q: keyword },
                success: function(response) {
                    renderTable(response);
                },
                error: function() {
                    console.error('Gagal mencari data booking.');
                }
            });
        }

        const $navbarSearchInput = $('#search-unit');
        $navbarSearchInput.closest('form').on('submit', function(e) {
            e.preventDefault();
        });

        $navbarSearchInput.on('keyup', function() {
            const keyword = $(this).val().trim();
            if (keyword.length > 0) {
                searchBooking(keyword);
            } else {
                loadBooking();
            }
        });

        loadBooking();
    });

    // fungsi global untuk pop up bukti pembayaran
    function showBukti(url, nama) {
        const img   = document.getElementById('buktiImage');
        const label = document.getElementById('buktiNama');

        img.src = url;
        label.textContent = 'Atas nama: ' + (nama || '-');

        const modalEl = document.getElementById('buktiModal');
        const modal   = new bootstrap.Modal(modalEl);
        modal.show();
    }
</script>
@endpush
