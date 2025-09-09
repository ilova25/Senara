<ul class="navbar-nav bg-gradient-brown sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-text mx-2">Senara Guesthouse</div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-home"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">Tamu</div>

    <!-- Nav Item - Booking -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-calendar-check"></i>
            <span>Booking</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu Booking:</h6>
                <a class="collapse-item" href="buttons.html">Lihat Booking</a>
                <a class="collapse-item" href="cards.html">Kalender</a>
            </div>
        </div>
    </li>

    <!-- Comment -->
    <li class="nav-item {{ request()->routeIs('comment.*') ? 'active' : '' }}">
        <a class="nav-link" href="#">
            <i class="fas fa-comments"></i>
            <span>Comment</span>
        </a>
    </li>

    @if (Auth::check() && Auth::user()->role === 'owner')
        <hr class="sidebar-divider">
        <div class="sidebar-heading">Pengelolaan</div>

        <!-- Unit -->
        <li class="nav-item {{ request()->routeIs('unit.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('unit.index') }}">
                <i class="fas fa-building"></i>
                <span>Unit</span>
            </a>
        </li>

        <!-- Fasilitas -->
        <li class="nav-item {{ request()->routeIs('fasilitas.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('fasilitas.index') }}">
                <i class="fas fa-concierge-bell"></i>
                <span>Fasilitas</span>
            </a>
        </li>

        <!-- Pegawai -->
        <li class="nav-item {{ request()->routeIs('pegawai.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('pegawai.index') }}">
                <i class="fas fa-users"></i>
                <span>Pegawai</span>
            </a>
        </li>
    @endif

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
