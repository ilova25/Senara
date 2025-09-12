<style>
    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 10%;
      border-bottom: 1px solid #ccc;
    }
    
    .login-btn {
      background-color: #5A3B1F;
      color: white;
      padding: 10px 20px;
      border-radius: 10px;
      transition: all 0.3s ease;
    }

    header nav {
      display: flex;
      align-items: center;
      gap: 5px;
      /* jarak antar menu */
      margin-left: auto;
      /* otomatis dorong nav ke kanan */
    }

    header nav a {
      margin-left: 20px;
      text-decoration: none;
      color: #333;
    }

    header nav a:hover {
      color: #AF8F6F;
    }

    .profile-avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid #5A3B1F;
      transition: transform 0.3s ease;
    }

    .profile-avatar:hover {
      transform: scale(1.1);
    }

    .profile-wrapper {
      margin-left: 30px;
      /* atur sesuai kebutuhan */
    }
</style>

<header>
  <div>Senara Guest House</div>
  <nav>
    <a href="{{ route('home') }}">Home</a>
    <a href="{{ route('rooms') }}">Rooms</a>
    <a href="{{ route('facilities') }}">Facilities</a>

    @if (Auth::check())
    <a href="{{ route('booking') }}">Booking</a>

    {{-- <form action="{{ route('logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="login-btn">Logout</button>
    </form> --}}

    <div class="profile-wrapper">
      <a href="{{ route('profile') }}">
        <img src="{{ asset('images/profile.jpg') }}" alt="Profile" class="profile-avatar">
      </a>
    </div>
    
    @else
        <a href="{{ route('login') }}" class="login-btn">Login</a>
    @endif



  </nav>
</header>