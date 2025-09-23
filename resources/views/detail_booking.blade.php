@extends('layout.app')

@section('content')

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background: #f8f9fa;
        color: #2c1810;
        min-height: 100vh;
    }

    .main-container {
        width: 80%;
        margin: 0 auto;
        padding-top: 30px;
    }

    .page-header {
        background: linear-gradient(135deg, #5A3B1F, #AF8F6F);
        color: white;
        padding: 2rem;
        border-radius: 20px;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
        margin-top: 30px;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .header-content {
        position: relative;
        z-index: 1;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .header-left h1 {
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .header-left p {
        font-size: 1rem;
        opacity: 0.9;
    }

    .booking-number {
        background: rgba(255, 255, 255, 0.2);
        padding: 0.8rem 1.5rem;
        border-radius: 30px;
        font-size: 1.1rem;
        font-weight: 600;
        backdrop-filter: blur(10px);
    }

    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(255, 255, 255, 0.1);
        color: white;
        text-decoration: none;
        padding: 0.8rem 1.5rem;
        border-radius: 30px;
        transition: all 0.3s ease;
        margin-bottom: 1rem;
        backdrop-filter: blur(10px);
    }

    .back-btn:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateX(-5px);
    }

    .detail-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .main-details {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .detail-card {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease;
    }

    .detail-card:hover {
        transform: translateY(-2px);
    }

    .card-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #2c1810;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .card-title i {
        color: #5A3B1F;
        font-size: 1.1rem;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }

    .info-item {
        display: flex;
        flex-direction: column;
        gap: 0.3rem;
    }

    .info-label {
        font-size: 0.8rem;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 500;
    }

    .info-value {
        font-weight: 600;
        color: #2c1810;
        font-size: 1rem;
    }

    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-block;
        width: fit-content;
    }

    .status-completed { background: #d1fae5; color: #065f46; }
    .status-confirmed { background: #dbeafe; color: #1e40af; }
    .status-cancelled { background: #fee2e2; color: #991b1b; }
    .status-pending { background: #fef3c7; color: #92400e; }

    .room-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 10px;
        margin-bottom: 1rem;
    }

    .amenities-list {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-top: 1rem;
    }

    .amenity-tag {
        background: #f3f4f6;
        color: #374151;
        padding: 0.3rem 0.8rem;
        border-radius: 15px;
        font-size: 0.8rem;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .sidebar {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .price-summary {
        background: linear-gradient(135deg, #5A3B1F, #AF8F6F);
        color: white;
        padding: 1.5rem;
        border-radius: 15px;
    }

    .price-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.8rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    }

    .price-item:last-child {
        border-bottom: 2px solid rgba(255, 255, 255, 0.3);
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 1rem;
    }

    .action-buttons {
        display: flex;
        flex-direction: column;
        gap: 0.8rem;
    }

    .btn {
        padding: 0.8rem 1.5rem;
        border: none;
        border-radius: 8px;
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }

    .btn-primary {
        background: #5A3B1F;
        color: white;
    }

    .btn-secondary {
        background: white;
        color: #5A3B1F;
        border: 2px solid #5A3B1F;
    }

    .btn-danger {
        background: #ef4444;
        color: white;
    }

    .btn-success {
        background: #10b981;
        color: white;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .timeline {
        position: relative;
        padding-left: 2rem;
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: 0.75rem;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #e5e7eb;
    }

    .timeline-item {
        position: relative;
        margin-bottom: 1.5rem;
    }

    .timeline-item::before {
        content: '';
        position: absolute;
        left: -1.75rem;
        top: 0.3rem;
        width: 12px;
        height: 12px;
        background: #5A3B1F;
        border-radius: 50%;
        border: 3px solid white;
        box-shadow: 0 0 0 2px #5A3B1F;
    }

    .timeline-date {
        font-size: 0.8rem;
        color: #6b7280;
        margin-bottom: 0.3rem;
    }

    .timeline-content {
        font-weight: 600;
        color: #2c1810;
    }

    .special-requests {
        background: #fef3c7;
        border: 1px solid #f59e0b;
        border-radius: 10px;
        padding: 1rem;
        margin-top: 1rem;
    }

    .special-requests h4 {
        color: #92400e;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .contact-info {
        background: #f0f9ff;
        border: 1px solid #0ea5e9;
        border-radius: 10px;
        padding: 1rem;
    }

    .contact-info h4 {
        color: #0c4a6e;
        margin-bottom: 0.8rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .contact-item {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        margin-bottom: 0.5rem;
        color: #0c4a6e;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        animation: fadeIn 0.3s ease;
    }

    .modal-content {
        background: white;
        margin: 5% auto;
        padding: 2rem;
        border-radius: 15px;
        width: 90%;
        max-width: 500px;
        text-align: center;
        animation: slideIn 0.3s ease;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .close:hover {
        color: #5A3B1F;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideIn {
        from { opacity: 0; transform: translateY(-50px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 992px) {
        .main-container {
            width: 90%;
        }

        .detail-grid {
            grid-template-columns: 1fr;
        }

        .header-content {
            flex-direction: column;
            text-align: center;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 576px) {
        .main-container {
            width: 95%;
        }

        .header-left h1 {
            font-size: 1.8rem;
        }

        .detail-card {
            padding: 1rem;
        }

        .action-buttons {
            position: sticky;
            bottom: 1rem;
            background: white;
            padding: 1rem;
            border-radius: 15px;
            box-shadow: 0 -5px 15px rgba(0, 0, 0, 0.1);
        }
    }
</style>

<div class="main-container">
    <!-- Back Button -->
    <a href="#" class="back-btn" onclick="history.back()">
        <i class="fas fa-arrow-left"></i>
        Kembali ke Riwayat Booking
    </a>

    <!-- Page Header -->
    <div class="page-header">
        <div class="header-content">
            <div class="header-left">
                <h1>Detail Booking</h1>
                <p>Informasi lengkap tentang pemesanan Anda</p>
            </div>
            <div class="booking-number">#BK001</div>
        </div>
    </div>

    <!-- Detail Content -->
    <div class="detail-grid">
        <div class="main-details">
            <!-- Booking Information -->
            <div class="detail-card">
                <h3 class="card-title">
                    <i class="fas fa-info-circle"></i>
                    Informasi Booking
                </h3>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Status</span>
                        <span class="status-badge status-completed">Completed</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Tanggal Booking</span>
                        <span class="info-value">15 Maret 2024</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Check-in</span>
                        <span class="info-value">20 Maret 2024 (14:00)</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Check-out</span>
                        <span class="info-value">22 Maret 2024 (12:00)</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Lama Menginap</span>
                        <span class="info-value">2 Malam</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Jumlah Tamu</span>
                        <span class="info-value">2 Orang (2 Dewasa)</span>
                    </div>
                </div>
            </div>

            <!-- Room Details -->
            <div class="detail-card">
                <h3 class="card-title">
                    <i class="fas fa-bed"></i>
                    Detail Kamar
                </h3>
                <img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Deluxe Room" class="room-image">
                
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Tipe Kamar</span>
                        <span class="info-value">Deluxe Room</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Ukuran Kamar</span>
                        <span class="info-value">35 m²</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Tipe Kasur</span>
                        <span class="info-value">King Size Bed</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Pemandangan</span>
                        <span class="info-value">City View</span>
                    </div>
                </div>

                <div class="amenities-list">
                    <span class="amenity-tag">
                        <i class="fas fa-wifi"></i> Free WiFi
                    </span>
                    <span class="amenity-tag">
                        <i class="fas fa-snowflake"></i> AC
                    </span>
                    <span class="amenity-tag">
                        <i class="fas fa-tv"></i> LED TV 43"
                    </span>
                    <span class="amenity-tag">
                        <i class="fas fa-coffee"></i> Coffee Maker
                    </span>
                    <span class="amenity-tag">
                        <i class="fas fa-bath"></i> Private Bathroom
                    </span>
                    <span class="amenity-tag">
                        <i class="fas fa-door-open"></i> Balkon
                    </span>
                </div>
            </div>

            <!-- Guest Information -->
            <div class="detail-card">
                <h3 class="card-title">
                    <i class="fas fa-user"></i>
                    Informasi Tamu
                </h3>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Nama Lengkap</span>
                        <span class="info-value">Ahmad Syukur Rahman</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Email</span>
                        <span class="info-value">ahmad.rahman@email.com</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">No. Telepon</span>
                        <span class="info-value">+62 812-3456-7890</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Identitas</span>
                        <span class="info-value">KTP - 3201234567890123</span>
                    </div>
                </div>

                <div class="special-requests">
                    <h4>
                        <i class="fas fa-star"></i>
                        Permintaan Khusus
                    </h4>
                    <p>Mohon disiapkan extra towel dan late check-out jika memungkinkan. Terima kasih.</p>
                </div>
            </div>

            <!-- Booking Timeline -->
            <div class="detail-card">
                <h3 class="card-title">
                    <i class="fas fa-clock"></i>
                    Riwayat Booking
                </h3>
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-date">15 Mar 2024, 10:30</div>
                        <div class="timeline-content">Booking dibuat dan menunggu pembayaran</div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-date">15 Mar 2024, 11:45</div>
                        <div class="timeline-content">Pembayaran berhasil dikonfirmasi</div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-date">20 Mar 2024, 14:00</div>
                        <div class="timeline-content">Check-in berhasil dilakukan</div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-date">22 Mar 2024, 12:00</div>
                        <div class="timeline-content">Check-out selesai - Booking completed</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Price Summary -->
            <div class="price-summary">
                <h3 style="margin-bottom: 1rem;">
                    <i class="fas fa-calculator"></i>
                    Ringkasan Biaya
                </h3>
                
                <div class="price-item">
                    <span>Deluxe Room (2 malam)</span>
                    <span>Rp 500.000</span>
                </div>
                <div class="price-item">
                    <span>Pajak & Service (10%)</span>
                    <span>Rp 50.000</span>
                </div>
                <div class="price-item">
                    <span>Extra Towel</span>
                    <span>Rp 25.000</span>
                </div>
                <div class="price-item">
                    <span>Late Check-out</span>
                    <span>Rp 25.000</span>
                </div>
                <div class="price-item">
                    <span><strong>Total Pembayaran</strong></span>
                    <span><strong>Rp 600.000</strong></span>
                </div>

                <div class="action-buttons">
                    <button class="btn btn-secondary" onclick="downloadInvoice()">
                        <i class="fas fa-download"></i> Download Invoice
                    </button>
                    <button class="btn btn-primary" onclick="bookAgain()">
                        <i class="fas fa-repeat"></i> Book Lagi
                    </button>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="contact-info">
                <h4>
                    <i class="fas fa-phone"></i>
                    Butuh Bantuan?
                </h4>
                <div class="contact-item">
                    <i class="fas fa-phone-alt"></i>
                    <span>+62 812-3456-7890</span>
                </div>
                <div class="contact-item">
                    <i class="fas fa-envelope"></i>
                    <span>info@senaraguesthouse.com</span>
                </div>
                <div class="contact-item">
                    <i class="fab fa-whatsapp"></i>
                    <span>WhatsApp Customer Service</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for actions -->
<div id="actionModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h3 id="modalTitle">Konfirmasi</h3>
        <p id="modalMessage">Apakah Anda yakin?</p>
        <div style="margin-top: 1.5rem; display: flex; gap: 1rem; justify-content: center;">
            <button class="btn btn-secondary" onclick="closeModal()">Batal</button>
            <button class="btn btn-primary" id="confirmBtn" onclick="confirmAction()">Konfirmasi</button>
        </div>
    </div>
</div>

<script>
    let currentAction = '';

    // Modal functions
    function openModal(title, message, action) {
        document.getElementById('modalTitle').textContent = title;
        document.getElementById('modalMessage').textContent = message;
        document.getElementById('actionModal').style.display = 'block';
        currentAction = action;
    }

    function closeModal() {
        document.getElementById('actionModal').style.display = 'none';
        currentAction = '';
    }

    function confirmAction() {
        switch(currentAction) {
            case 'download':
                // Simulate download
                alert('Invoice sedang didownload...');
                break;
            case 'book-again':
                // Redirect to booking page
                alert('Mengarahkan ke halaman booking...');
                break;
        }
        closeModal();
    }

    // Action functions
    function downloadInvoice() {
        openModal('Download Invoice', 'Download invoice untuk booking #BK001?', 'download');
    }

    function bookAgain() {
        openModal('Book Lagi', 'Ingin membuat booking baru dengan preferensi yang sama?', 'book-again');
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('actionModal');
        if (event.target === modal) {
            closeModal();
        }
    }

    // Close modal with ESC key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeModal();
        }
    });

    // Add some interactive effects
    document.addEventListener('DOMContentLoaded', function() {
        // Animate timeline items
        const timelineItems = document.querySelectorAll('.timeline-item');
        timelineItems.forEach((item, index) => {
            item.style.opacity = '0';
            item.style.transform = 'translateX(-20px)';
            setTimeout(() => {
                item.style.transition = 'all 0.5s ease';
                item.style.opacity = '1';
                item.style.transform = 'translateX(0)';
            }, index * 200);
        });

        // Animate cards on scroll
        const cards = document.querySelectorAll('.detail-card');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animation = 'slideIn 0.6s ease forwards';
                }
            });
        });

        cards.forEach(card => {
            observer.observe(card);
        });
    });
</script>


@endsection