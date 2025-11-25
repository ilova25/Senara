<style>
  header {
    border-bottom: 1px solid #ccc;
    background-color: #fff;
    padding: 15px 0;
  }

  .header-container {
    max-width: 1200px;
    padding: 15px 20px; /* sama seperti footer */
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .brand {
    font-size: 20px;
    font-weight: bold;
    color: #5A3B1F;
  }

  header nav {
    display: flex;
    align-items: center;
    /* margin-bottom: 30px; */
  }

  header nav ul {
    margin: 0;
    padding: 0;
    list-style: none;
    display: flex;
    align-items: center;
  }

  header nav ul li {
    margin-left: 20px;
  }

  header nav a {
    text-decoration: none;
    color: #333;
    font-weight: 500;
    transition: color 0.3s ease;
  }

  header nav a:hover {
    color: #AF8F6F;
  }

  .login-btn {
    background-color: #5A3B1F;
    color: white !important;
    padding: 8px 16px;
    border-radius: 8px;
    font-size: 14px;
    transition: all 0.3s ease;
  }

  .login-btn:hover {
    background-color: #AF8F6F;
  }

  /* Avatar */
  .profile-avatar {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #5A3B1F;
    cursor: pointer;
  }

  /* Dropdown custom */
  .dropdown-menu {
    border-radius: 8px;
    margin-top: 10px;
    min-width: 180px;
  }
</style>

<header>
  <div class="container header-container">
    <div class="brand">Senara Guest House</div>
    <nav>
      <ul>
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('unit') }}">Unit</a></li>

        @if (Auth::check())
          <li><a href="{{ route('booking.create') }}">Booking</a></li>

          <!-- Dropdown User -->
          <li class="nav-item dropdown">
            <a class="nav-link p-0 dropdown-toggle" href="#" id="userDropdown" role="button"
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img class="profile-avatar" src="{{ asset('template/img/undraw_profile.svg') }}" alt="profile">
            </a>

            <div class="dropdown-menu dropdown-menu-right shadow" aria-labelledby="userDropdown">
              <a class="dropdown-item" href="{{ route('profile', Auth::id()) }}"><i class="fas fa-user fa-sm fa-fw mr-2"></i> Profile</a>
              <a class="dropdown-item" href="{{ route('riwayat.booking', Auth::id()) }}"><i class="fas fa-cog fa-sm fa-fw mr-2"></i> Riwayat Booking</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i> Logout
              </a>
            </div>
          </li>
        @else
          <li><a href="{{ route('login') }}" class="login-btn">Login</a></li>
        @endif
      </ul>
    </nav>
  </div>
</header>
