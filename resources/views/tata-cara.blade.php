@extends('layout.app')

@section('content')
<style>
  .tata-cara-section {
    padding: 60px 0;
    background: #ffff;
  }

  .tata-cara-container {
    max-width: 1450px;
    margin: 0 auto;
    padding: 0 20px;
    padding-left: 60px;
  }

  .tata-cara-header {
    text-align: center;
    margin-bottom: 50px;
  }

  .tata-cara-header h1 {
    font-size: 36px;
    font-weight: bold;
    color: #5A3B1F;
    margin-bottom: 15px;
  }

  .tata-cara-header p {
    font-size: 18px;
    color: #666;
  }

  .info-card {
    background: white;
    border-radius: 15px;
    padding: 35px;
    margin-bottom: 30px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .info-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.12);
  }

  .info-card h2 {
    font-size: 24px;
    font-weight: bold;
    color: #5A3B1F;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .info-card h2 i {
    color: #AF8F6F;
    font-size: 28px;
  }

  .step-list {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .step-list li {
    padding: 15px 0;
    border-bottom: 1px solid #eee;
    display: flex;
    align-items: flex-start;
    gap: 15px;
  }

  .step-list li:last-child {
    border-bottom: none;
  }

  .step-number {
    background: #5A3B1F;
    color: white;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    flex-shrink: 0;
  }

  .step-content {
    flex: 1;
  }

  .step-content h4 {
    font-size: 18px;
    font-weight: 600;
    color: #333;
    margin-bottom: 5px;
  }

  .step-content p {
    color: #666;
    margin: 0;
    line-height: 1.6;
  }

  .info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-top: 20px;
  }

  .info-item {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 10px;
    border-left: 4px solid #5A3B1F;
  }

  .info-item h4 {
    font-size: 16px;
    font-weight: 600;
    color: #5A3B1F;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .info-item p {
    color: #666;
    margin: 0;
    font-size: 14px;
  }

  .ketentuan-list {
    list-style: none;
    padding: 0;
    margin: 20px 0 0 0;
  }

  .ketentuan-list li {
    padding: 12px 0;
    color: #555;
    display: flex;
    align-items: flex-start;
    gap: 10px;
  }

  .ketentuan-list li i {
    color: #AF8F6F;
    margin-top: 3px;
  }

  .cta-section {
    background: linear-gradient(135deg, #5A3B1F 0%, #AF8F6F 100%);
    color: white;
    padding: 40px;
    border-radius: 15px;
    text-align: center;
    margin-top: 30px;
  }

  .cta-section h3 {
    font-size: 28px;
    margin-bottom: 15px;
  }

  .cta-section p {
    font-size: 16px;
    margin-bottom: 25px;
    opacity: 0.95;
  }

  .btn-pesan {
    background: white;
    color: #5A3B1F;
    padding: 12px 35px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    display: inline-block;
    transition: all 0.3s ease;
  }

  .btn-pesan:hover {
    background: #f8f9fa;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    color: #5A3B1F;
    text-decoration: none;
  }

  .highlight-box {
    background: #fff3cd;
    border-left: 4px solid #ffc107;
    padding: 15px 20px;
    border-radius: 8px;
    margin: 20px 0;
  }

  .highlight-box strong {
    color: #856404;
  }

  @media (max-width: 768px) {
    .tata-cara-header h1 {
      font-size: 28px;
    }

    .info-card {
      padding: 25px;
    }

    .info-grid {
      grid-template-columns: 1fr;
    }
  }
</style>

<section class="tata-cara-section">
  <div class="tata-cara-container">
    <!-- Header -->
    <div class="tata-cara-header">
      <h1>Tata Cara Pemesanan Homestay</h1>
      <p>Ikuti langkah-langkah berikut untuk memesan homestay dengan mudah</p>
    </div>

    <!-- Langkah Pemesanan -->
    <div class="info-card">
      <h2><i class="fas fa-clipboard-list"></i> Cara Memesan</h2>
      <ol class="step-list">
        <li>
          <div class="step-number">1</div>
          <div class="step-content">
            <h4>Buat Akun / Login</h4>
            <p>Daftar atau masuk ke akun Anda untuk melanjutkan pemesanan</p>
          </div>
        </li>
        <li>
          <div class="step-number">2</div>
          <div class="step-content">
            <h4>Pilih Unit Homestay</h4>
            <p>Kunjungi halaman "Unit" dan pilih homestay yang sesuai dengan kebutuhan Anda</p>
          </div>
        </li>
        <li>
          <div class="step-number">3</div>
          <div class="step-content">
            <h4>Isi Form Pemesanan</h4>
            <p>Lengkapi data pemesanan termasuk tanggal check-in, check-out, dan jumlah tamu</p>
          </div>
        </li>
        <li>
          <div class="step-number">4</div>
          <div class="step-content">
            <h4>Lakukan Pembayaran</h4>
            <p>Transfer sesuai nominal yang tertera ke rekening yang disediakan</p>
          </div>
        </li>
        <li>
          <div class="step-number">5</div>
          <div class="step-content">
            <h4>Upload Bukti Transfer</h4>
            <p>Kirim bukti pembayaran melalui sistem untuk verifikasi</p>
          </div>
        </li>
        <li>
          <div class="step-number">6</div>
          <div class="step-content">
            <h4>Konfirmasi Pemesanan</h4>
            <p>Tunggu konfirmasi dari admin, Anda akan menerima notifikasi via email</p>
          </div>
        </li>
      </ol>
    </div>

    <!-- Ketentuan Check-in & Check-out -->
    <div class="info-card">
      <h2><i class="fas fa-clock"></i> Ketentuan Check-in & Check-out</h2>
      
      <div class="info-grid">
        <div class="info-item">
          <h4><i class="fas fa-sign-in-alt"></i> Check-in</h4>
          <p><strong>Pukul 14:00 WIB</strong></p>
          <p style="margin-top: 8px;">Tamu dapat melakukan check-in mulai pukul 14:00 siang</p>
        </div>
        
        <div class="info-item">
          <h4><i class="fas fa-sign-out-alt"></i> Check-out</h4>
          <p><strong>Pukul 12:00 WIB</strong></p>
          <p style="margin-top: 8px;">Tamu diharapkan check-out maksimal pukul 12:00 siang</p>
        </div>
      </div>

      <div class="highlight-box">
        <strong><i class="fas fa-info-circle"></i> Catatan:</strong> Early check-in atau late check-out dapat diatur dengan menghubungi admin terlebih dahulu (tergantung ketersediaan)
      </div>
    </div>

    <!-- Ketentuan Umum -->
    <div class="info-card">
      <h2><i class="fas fa-file-alt"></i> Ketentuan Umum</h2>
      <ul class="ketentuan-list">
        <li>
          <i class="fas fa-check-circle"></i>
          <span>Minimum pemesanan adalah 1 malam</span>
        </li>
        <li>
          <i class="fas fa-check-circle"></i>
          <span>Pembayaran harus dilunasi maksimal H-1 sebelum check-in</span>
        </li>
        <li>
          <i class="fas fa-check-circle"></i>
          <span>Tamu wajib membawa kartu identitas (KTP/SIM/Paspor)</span>
        </li>
        <li>
          <i class="fas fa-check-circle"></i>
          <span>Kapasitas tamu sesuai dengan yang tercantum di unit</span>
        </li>
        <li>
          <i class="fas fa-check-circle"></i>
          <span>Dilarang membawa hewan peliharaan tanpa persetujuan</span>
        </li>
        <li>
          <i class="fas fa-check-circle"></i>
          <span>Menjaga kebersihan dan fasilitas homestay</span>
        </li>
        <li>
          <i class="fas fa-check-circle"></i>
          <span>Kerusakan atau kehilangan fasilitas menjadi tanggung jawab tamu</span>
        </li>
        <li>
          <i class="fas fa-check-circle"></i>
          <span>Dilarang melakukan aktivitas yang mengganggu tamu lain</span>
        </li>
      </ul>
    </div>

    <!-- Kebijakan Pembatalan -->
    <div class="info-card">
      <h2><i class="fas fa-ban"></i> Kebijakan Pembatalan</h2>
      <ul class="ketentuan-list">
        <li>
          <i class="fas fa-check-circle"></i>
          <span>Pembatalan lebih dari 7 hari sebelum check-in: Pengembalian 80% dari total pembayaran</span>
        </li>
        <li>
          <i class="fas fa-check-circle"></i>
          <span>Pembatalan 3-7 hari sebelum check-in: Pengembalian 50% dari total pembayaran</span>
        </li>
        <li>
          <i class="fas fa-check-circle"></i>
          <span>Pembatalan kurang dari 3 hari: Tidak ada pengembalian dana</span>
        </li>
        <li>
          <i class="fas fa-check-circle"></i>
          <span>No show (tidak datang tanpa pemberitahuan): Tidak ada pengembalian dana</span>
        </li>
      </ul>
    </div>

    <!-- Kontak Darurat -->
    <div class="info-card">
      <h2><i class="fas fa-phone-alt"></i> Butuh Bantuan?</h2>
      <p style="color: #666; margin-bottom: 15px;">Hubungi kami untuk pertanyaan lebih lanjut:</p>
      <div class="info-grid">
        <div class="info-item">
          <h4><i class="fas fa-envelope"></i> Email</h4>
          <p>info@manembahhomestay.com</p>
        </div>
        <div class="info-item">
          <h4><i class="fab fa-whatsapp"></i> WhatsApp</h4>
          <p>+62 812-3456-7890</p>
        </div>
      </div>
    </div>

    <!-- CTA Section -->
    <div class="cta-section">
      <h3>Siap Memesan Homestay?</h3>
      <p>Pilih unit homestay favorit Anda dan nikmati pengalaman menginap yang nyaman</p>
      @if(Auth::check())
        <a href="{{ route('unit') }}" class="btn-pesan">
          <i class="fas fa-home"></i> Lihat Unit Tersedia
        </a>
      @else
        <a href="{{ route('login') }}" class="btn-pesan">
          <i class="fas fa-sign-in-alt"></i> Login untuk Memesan
        </a>
      @endif
    </div>
  </div>
</section>
@endsection