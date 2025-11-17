@push('styles')
<style>
    .topbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        background-color: #fff;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        padding: 10px 20px;
    }

    /* Kotak pencarian */
    .topbar .search-box {
        display: flex;
        align-items: center;
        background: #f8f9fa;
        border-radius: 8px;
        padding: 6px 12px;
        width: 280px;
    }

    .topbar .search-box input {
        border: none;
        background: transparent;
        outline: none;
        width: 100%;
    }

    .topbar .search-box i {
        color: #6c757d;
        margin-right: 8px;
    }

    /* Bagian kanan navbar */
    .topbar .nav-icons {
        display: flex;
        align-items: center;
        gap: 18px;
    }

    /* Notifikasi */
    .topbar .nav-icons .icon {
        position: relative;
        background: #f8f9fa;
        border-radius: 50%;
        padding: 8px;
        cursor: pointer;
        transition: background 0.2s;
    }

    .topbar .nav-icons .icon:hover {
        background: #e9ecef;
    }

    .topbar .nav-icons .icon i {
        font-size: 18px;
        color: #212529;
    }

    .topbar .nav-icons .icon .badge {
        position: absolute;
        top: 5px;
        right: 6px;
        width: 8px;
        height: 8px;
        background-color: #dc3545;
        border-radius: 50%;
    }

    /* Profil user */
    .profile-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .profile-info .avatar {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        background: #543310;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 14px;
    }

    .profile-info .text {
        display: flex;
        flex-direction: column; /* email di bawah nama */
        line-height: 1.2;
    }

    .profile-info .text strong {
        color: #212529;
        font-size: 14px;
        font-weight: 600;
    }

    .profile-info .text small {
        color: #6c757d;
        font-size: 12px;
    }
</style>
@endpush

<div class="topbar">
    <!-- Judul kiri -->
    <h5 class="mb-0 fw-bold">@yield('title', 'Dashboard')</h5>

    <!-- Kotak pencarian -->
    <div class="search-box">
        <i class='bx bx-search'></i>
        <input type="text" placeholder="Cari..." />
    </div>

    <!-- Ikon kanan -->
    <div class="nav-icons">
        <!-- Notifikasi -->
        <div class="icon position-relative">
            <i class='bx bx-bell'></i>
            <span class="badge"></span>
        </div>

        <!-- Profil (tanpa dropdown) -->
        <div class="profile-info">
            <div class="avatar">AD</div>
            <div class="text">
                <strong>Admin User</strong>
                <small>admin@example.com</small>
            </div>
        </div>
    </div>
</div>
