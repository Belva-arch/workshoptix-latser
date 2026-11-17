# WORKSHOPTIX — Pendaftaran dan Tiket Digital Workshop IT

## Brief Proyek
> Panitia sekolah membuka beberapa workshop IT berbayar. Buat satu aplikasi Laravel agar peserta bisa memilih workshop, mendaftar, membayar, dan melihat tiket digital setelah pembayaran terverifikasi.

---

## Cara Menjalankan Aplikasi (Setup Petunjuk)

1. **Clone repositori dan masuk ke direktori:**
   ```bash
   git clone https://github.com/Belva-arch/workshoptix-latser
   cd workshop-sertikom
   ```

2. **Install Dependensi Composer & NPM:**
   ```bash
   composer install
   npm install
   ```

3. **Konfigurasi Environment:**
   Salin file `.env.example` menjadi `.env` lalu generate application key:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Koneksi Database & Konfigurasi Midtrans:**
   Pastikan MySQL di Laragon / XAMPP sudah menyala, lalu sesuaikan `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=workshop_sertikom
   DB_USERNAME=root
   DB_PASSWORD=

   # Kunci Sandbox Midtrans
   MIDTRANS_SERVER_KEY=SB-Mid-server-YOUR_SANDBOX_KEY
   MIDTRANS_CLIENT_KEY=SB-Mid-client-YOUR_SANDBOX_KEY
   MIDTRANS_IS_PRODUCTION=false
   ```

5. **Jalankan Migrasi & Data Seeder Awal:**
   ```bash
   php artisan migrate:fresh --seed
   ```

6. **Jalankan Aplikasi:**
   ```bash
   php artisan serve
   ```
   Akses via browser di: `http://127.0.0.1:8000` atau via Laragon `http://workshop-sertikom.test`