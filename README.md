# 🌿 Senara Guest House Website

Website **Senara Guest House** adalah aplikasi web berbasis **Laravel** yang menyediakan informasi penginapan sekaligus **sistem booking kamar**.  
Website ini memiliki **sistem autentikasi login** dengan beberapa peran pengguna (role).

Project ini dibuat sebagai website penginapan yang dapat digunakan oleh **tamu**, **resepsionis**, dan **owner**.

---

## 📌 Fitur Utama

### 🌐 Fitur Umum (Tamu)
- Melihat informasi Guest House
- Melihat daftar kamar & fasilitas
- Sistem booking kamar
- **Booking hanya bisa dilakukan setelah login**

### 👥 Sistem Login & Role
Website memiliki **3 jenis user**:
1. **Tamu**
2. **Resepsionis**
3. **Owner**

Setiap role memiliki hak akses berbeda.

### 🛠️ Fitur Admin
- Login admin
- Dashboard admin
- Manajemen booking
- Hak akses sesuai role (Owner & Resepsionis)

---

## 🔐 Akun Login Default

Gunakan akun berikut untuk mencoba sistem:

### 👤 Login Tamu
**Username:** tamu
**Password:** tamu

---

### 👨‍💼 Login Owner
**Username:** owner
**Password:** owner

---

### 🧑‍💻 Login Resepsionis
**Username:** resepsionis
**Password:** resepsionis

---

## 🛠️ Teknologi yang Digunakan

- **Backend** : PHP 8.2, Laravel 12
- **Frontend** : HTML, CSS, Blade Template
- **Database** : MySQL / SQLite
- **Authentication** : Laravel Auth
- **Tools** :
  - Composer
  - Artisan CLI
  - Laravel Vite

---

## 📂 Struktur Folder Penting
web_senara/
├── app/ # Controller, Model, Middleware
├── resources/
│ ├── views/ # Blade Template (UI)
│ └── css/ # Style
├── routes/
│ └── web.php # Routing aplikasi
├── public/ # Asset publik
├── database/
│ ├── migrations/ # Struktur database
│ └── seeders/ # Data awal (akun demo)
├── .env.example
├── composer.json
└── artisan

---


---

## ⚙️ Cara Menjalankan Project

**1️⃣ Clone Repository**
git clone https://github.com/username/web_senara.git
cd web_senara
**2️⃣ Install Dependency**
composer install
**3️⃣ Copy File Environment**
cp .env.example .env
**4️⃣ Generate App Key**
php artisan key:generate
**5️⃣ Konfigurasi Database**
Edit file .env:
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
**6️⃣ Migrasi & Seeder Database**
php artisan migrate --seed
**7️⃣ Jalankan Server**
php artisan serve
**Akses website melalui:**
http://127.0.0.1:8000

---
