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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" 
    crossorigin="anonymous"></script> 
    
    <script> 
    const hamburger = document.querySelector(".toggle-btn"); 
    const toggler = document.querySelector("#icon"); 
    hamburger.addEventListener("click",function(){ 
        document.querySelector("#sidebar").classList.toggle("expand"); 
        toggler.classList.toggle("bx-chevrons-right"); 
        toggler.classList.toggle("bx-chevrons-left"); 
    }); 
    </script>

    @stack('styles')
</body>
</html>
