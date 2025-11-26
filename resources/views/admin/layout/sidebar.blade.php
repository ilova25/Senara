@push('styles')
    <style>
        #sidebar {
            width: 90px;
            min-width: 90px;
            transition: all 0.25s ease-in-out;
            background-color: #ffffff;
            display: flex;
            flex-direction: column;
        }

        #sidebar.expand {
            width: 260px;
            min-width: 260px;
        }

        #sidebar:not(.expand) .sidebar-logo,
        #sidebar:not(.expand) a.sidebar-link span {
            display: none;
        }

        .toggle-btn {
            width: 30px;
            height: 30px;
            color: #FFF;
            border-radius: 0.425rem;
            font-size: 18px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #543310;
        }

        .toggle-btn i {
            color: #FFF;
        }

        #sidebar.expand .sidebar-logo,
        #sidebar.expand .sidebar-link span {
            animation: fadeIn 0.25s ease;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        .sidebar-logo a {
            color: #543310;
            font-size: 1.15rem;
            font-weight: 600;
        }

        .sidebar-nav {
            padding: 0.7rem 0;
            flex: 11 auto;
            z-index: 10;
        }

        a.sidebar-link {
            padding: .625rem 1.625rem;
            color: #4b5563;
            display: block;
            white-space: nowrap;
            font-weight: 700;
            border-left: 3px solid transparent;
        }

        .sidebar-link i,
        .dropdown-item i {
            font-size: 1.1rem;
            margin-right: .75rem;
            color: #543310;
        }

        a.sidebar-link:hover {
            background-color: #eff6ff;
            border-left: 3px solid #543310;
        }

        .sidebar-item {
            position: relative;
        }

        #sidebar:not(.expand) .sidebar-item .sidebar-dropdown {
            position: absolute;
            top: 0;
            left: 90px;
            /* background-color: #0e2238; */
            padding: 0;
            min-width: 15rem;
            display: none;
        }

        #sidebar:not(.expand) .sidebar-item .sidebar-dropdown .sidebar-dropdown {
            left: 130px;
        }

        #sidebar.expand .sidebar-link[data-bs-toggle="collapse"]::after {
            border: solid;
            border-width: 0.075rem .075rem 0;
            content: "";
            display: inline-block;
            padding: 2px;
            position: absolute;
            right: 1.5rem;
            top: 1.4rem;
            transform: rotate(-135deg);
            transition: all .2s ease-out;
        }

        #sidebar.expand .sidebar-link[data-bs-toggle="collapse"].collapsed::after {
            transform: rotate(45deg);
            transition: all .2s ease-out;
        }

        .sidebar-dropdown .sidebar-link {
            position: relative;
            padding-left: 3rem;
            transition: all 0.5s;
        }

        .sidebar-dropdown a.sidebar-link::before {
            content: "";
            height: 0.125rem;
            width: 0.375rem;
            background-color: #FFFFFF80;
            position: absolute;
            left: 1.8rem;
            top: 50%;
            transform: translateY(-50%);
            transition: all 0.5s;
        }

        .sidebar-dropdown a.sidebar-link:hover {
            background: transparent;
            border-left: 3px solid transparent;
            padding-left: 3.8rem;
            color: #543310;
        }
    </style>
@endpush

<aside id="sidebar">
    <div class="d-flex justify-content-between p-4">
        <div class="sidebar-logo">
            <a href="#">Senara</a>
        </div>
        <button class="toggle-btn border-0" type="button">
            <i class='bx bx-chevrons-right'></i>
        </button>
    </div>
    <ul class="sidebar-nav">
        <li class="sidebar-item">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
                <i class='bx bxs-dashboard'></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('booking.admin') }}" class="sidebar-link">
                <i class='bx bxs-calendar-check'></i>
                <span>Booking</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('masukan.admin') }}" class="sidebar-link">
                <i class='bx bxs-message-rounded'></i>
                <span>Ulasan</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('unit.index') }}" class="sidebar-link">
                <i class='bx bxs-bell-ring'></i>
                <span>Unit</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('pegawai.index') }}" class="sidebar-link">
                <i class='bx bxs-user'></i>
                <span>Pegawai</span>
            </a>
        </li>
    </ul>
    <div class="sidebar-footer">
        <a href="javascript:void(0);" class="sidebar-link" id="btn-logout">
            <i class='bx bx-log-out'></i>
            <span>Logout</span>
        </a>
    </div>
</aside>
