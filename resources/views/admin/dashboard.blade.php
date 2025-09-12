@extends('admin.layout.app')

@section('content')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
  </div>

  <!-- Content Row -->
  <div class="row">

    <!-- Card Example -->
    <div class="col-xl-3 col-md-6 mb-4" style="width: 18rem;">
      <div class="card hover-card shadow">
        <div class="card-body">
          <div class="text-xs font-weight-bold text-coklat text-uppercase mb-1">
            Jumlah Customer
          </div>
          <div class="h5 mb-0 font-weight-bold text-dark">240 Orang</div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4" style="width: 18rem;">
      <div class="card hover-card shadow">
        <div class="card-body">
          <div class="text-xs font-weight-bold text-coklat text-uppercase mb-1">
            Customer Menginap
          </div>
          <div class="h5 mb-0 font-weight-bold text-dark">20 Orang</div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4" style="width: 18rem;">
      <div class="card hover-card shadow">
        <div class="card-body">
          <div class="text-xs font-weight-bold text-coklat text-uppercase mb-1">
            Jumlah Unit
          </div>
          <div class="h5 mb-0 font-weight-bold text-dark">3 Unit</div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4" style="width: 18rem;">
      <div class="card hover-card shadow">
        <div class="card-body">
          <div class="text-xs font-weight-bold text-coklat text-uppercase mb-1">
            Pendapatan
          </div>
          <div class="h5 mb-0 font-weight-bold text-dark">Rp 15.000.000</div>
        </div>
      </div>
    </div>

  </div>

  <div class="row">
    <!-- Chart -->
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Grafik Customer per Bulan</h6>
            </div>
            <div class="card-body">
                <canvas id="customerChart" style="height:300px;"></canvas>
            </div>
        </div>
    </div>

    <!-- Kalender Interaktif -->
    <div class="col-md-4">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Kalender</h6>
        </div>
        <div class="card-body p-2">
          <div id="mini-calendar"></div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- FullCalendar -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    // === Grafik Customer ===
    var ctx = document.getElementById("customerChart").getContext('2d');
    var customerChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul"],
        datasets: [{
          label: "Jumlah Customer",
          data: [45, 60, 75, 90, 120, 150, 180],
          backgroundColor: "#795548",
          borderColor: "#5D4037",
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            labels: {
              color: "#333"
            }
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              stepSize: 20
            }
          }
        }
      }
    });

    // === Kalender ===
    var calendarEl = document.getElementById('mini-calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      height: 'auto',
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: ''
      },
      dayMaxEventRows: 2,
      views: {
        dayGridMonth: { dayMaxEventRows: 2 }
      },
      events: [
        { title: 'B', start: '2025-09-02', color: '#28a745' },
        { title: 'C-I', start: '2025-09-08', color: '#007bff' },
        { title: 'C-O', start: '2025-09-10', color: '#dc3545' }
      ]
    });
    calendar.render();
  });
</script>
@endpush
