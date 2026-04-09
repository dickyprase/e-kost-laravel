# E-KOS

Aplikasi Manajemen Kos berbasis Web menggunakan Laravel & Filament.
Didesain dengan tampilan modern (Tailwind CSS) dan fitur manajemen lengkap.

## TEKNOLOGI
- **Backend**: Laravel 10 (PHP 8.1)
- **Admin Panel**: Filament PHP v3
- **Frontend**: Blade + Tailwind CSS + Alpine.js
- **Database**: MySQL

## FITUR APLIKASI

### Halaman Pengguna / User
1. **Autentikasi Modern**
   - Login & Register dengan tampilan split-screen & glassmorphism.
2. **Dashboard & Pencarian**
   - Menampilkan daftar kamar dengan filter kategori.
   - Tampilan kartu (card) modern dengan efek hover & zoom.
3. **Detail Kamar & Booking**
   - Informasi lengkap fasilitas & harga.
   - Modal booking interaktif (pilih durasi, otomatis hitung total).
4. **Manajemen Pesanan**
   - Upload bukti pembayaran.
   - Status pembayaran real-time (Menunggu, Valid, Ditolak).
   - Cetak Invoice otomatis jika pembayaran valid.
5. **Profil Pengguna**
   - Update biodata diri.

### Halaman Admin
Akses: `/admin`

1. **Dashboard Statistik**
2. **Manajemen Data Master**
   - Kamar (CRUD, Upload Foto, Status Ketersediaan).
   - Kategori Kamar.
   - Bank (Rekening Pembayaran).
   - User (Pengelola Data Pengguna).
3. **Transaksi**
   - Verifikasi Pembayaran (Approve/Reject).
   - Monitoring Status Pesanan.
   - Notifikasi WhatsApp (Simulasi link).
4. **Pengaturan Website**
   - Edit Kontak & Alamat.

## CARA MENJALANKAN APLIKASI
Pastikan sudah terinstall: `PHP >= 8.1`, `Composer`, `Node.js`, `MySQL`.

1. **Install Dependencies**
   Buka terminal di folder project:
   ```bash
   composer install
   npm install
   ```

2. **Konfigurasi Database**
   - Buat database baru di phpMyAdmin (misal: `kos_evanka`).
   - Atur koneksi database di file `.env`:
     ```env
     DB_DATABASE=kost
     DB_USERNAME=root
     DB_PASSWORD=
     ```

3. **Konfigurasi API WhatsApp**
   - Atur token API WhatsApp di file `.env` (dari https://wa.nux.my.id).

4. **Setup Aplikasi**
   ```bash
   php artisan key:generate
   php artisan migrate:fresh --seed
   php artisan storage:link
   ```
   *(PENTING: `storage:link` agar gambar/logo bukti bayar bisa muncul)*

5. **Compile Aset Frontend (Tailwind)**
   ```bash
   npm run build
   ```

6. **Jalankan Server**
   ```bash
   php artisan serve
   ```

7. **Akses Aplikasi** di http://localhost:8000

## AKUN ADMIN (Terbuat Otomatis Saat Migrate)
- **Email/username**: `admin@gmail.com`
- **Password**: `123`
