<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <!-- Font -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap');

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Outfit', serif;
            margin: 0;
            height: 100vh;
            overflow: hidden; /* supaya tidak scroll ke bawah berlebihan */
            background-color: #f8fafc;
        }

        a { text-decoration: none; }
        li { list-style: none; }

        /* Layout utama */
        .wrapper {
            display: flex;
            height: 100vh;
            width: 100%;
        }

        /* Sidebar */
        #sidebar {
            width: 80px;
            background-color: #fff;
            border-right: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }

        /* Bagian konten utama */
        #content-wrapper {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow: hidden;
        }

        /* Navbar */
        nav.navbar {
            background-color: #fff;
            height: 60px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            padding: 0 1rem;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        /* Main content */
        #main {
            flex-grow: 1;
            overflow-y: auto;
            padding: 1.5rem;
            background-color: #f8fafc;
        }

        /* Footer */
        footer {
            border-top: 1px solid #e5e7eb;
            background-color: #fff;
            padding: 0.8rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        {{-- Sidebar --}}
        @include('admin.layout.sidebar')

        {{-- Content Wrapper --}}
        <div id="content-wrapper">

            {{-- Navbar --}}
            @include('admin.layout.navbar')

            {{-- Main Content --}}
            <div id="main" class="container-fluid">
                @yield('content')
            </div>

            {{-- Footer --}}
            <footer>
                <span>Copyright &copy; RPL Grafika 2025</span>
            </footer>
        </div>
    </div>

    {{-- FORM LOGOUT TERSEMBUNYI --}}
    <form id="form-logout" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    {{-- MODAL LOGOUT --}}
    <div class="modal fade" id="logoutModal" tabindex="-1"
         aria-labelledby="logoutModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
          <div class="modal-header border-0">
            <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
            <button type="button" class="btn-close"
                    data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Apakah Anda yakin ingin keluar dari dashboard?
          </div>
          <div class="modal-footer border-0">
            <button type="button" class="btn btn-secondary btn-sm"
                    data-bs-dismiss="modal">
                Batal
            </button>
            <button type="button" class="btn btn-danger btn-sm" id="confirmLogout">
                Logout
            </button>
          </div>
        </div>
      </div>
    </div>

    {{-- JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Toggle sidebar (pakai code-mu)
            const hamburger = document.querySelector(".toggle-btn");
            const toggler   = document.querySelector("#icon");
            if (hamburger && toggler) {
                hamburger.addEventListener("click", function () {
                    document.querySelector("#sidebar").classList.toggle("expand");
                    toggler.classList.toggle("bx-chevrons-right");
                    toggler.classList.toggle("bx-chevrons-left");
                });
            }

            // Logout logic
            const btnLogout     = document.getElementById('btn-logout');
            const confirmLogout = document.getElementById('confirmLogout');
            const formLogout    = document.getElementById('form-logout');

            if (btnLogout) {
                btnLogout.addEventListener('click', function (e) {
                    e.preventDefault();
                    const modalEl = document.getElementById('logoutModal');
                    const modal   = new bootstrap.Modal(modalEl);
                    modal.show();
                });
            }

            if (confirmLogout && formLogout) {
                confirmLogout.addEventListener('click', function () {
                    formLogout.submit();
                });
            }
        });
    </script>

    @stack('styles')

    @stack('scripts')
</body>
</html>
