@extends('admin.layout.app')

@section('content')
  {{-- Tambahan CSS biar lebih cantik --}}
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 20px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #4e73df;
        }
        #calendar {
            max-width: 1100px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .fc .fc-toolbar-title {
            font-size: 22px;
            font-weight: bold;
            color: #333;
        }
        .fc .fc-daygrid-event {
            border-radius: 6px;
            padding: 4px 6px;
            font-size: 14px;
        }
    </style>

  {{-- content header --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kalender</h1>
    </div>

    <div id='calendar'></div>
@endsection

@push('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: '{{ route('kalender.bookings') }}',
                eventClick: function(info) {
                    alert(
                        'Booking: ' + info.event.title +
                        '\nMulai: ' + info.event.start.toLocaleDateString() +
                        (info.event.end ? '\nSelesai: ' + info.event.end.toLocaleDateString() : '')
                    );
                }
            });
            calendar.render();
        });
    </script>
@endpush
