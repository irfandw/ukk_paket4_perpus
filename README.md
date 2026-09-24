# Aplikasi Perpustakaan Digital SDN 1 Kalidadap

**UKK RPL 2026** — Project berbasis **Laravel 10 + MySQL**

---

## Identitas Project

| Item              | Keterangan                                      |
|-------------------|-------------------------------------------------|
| **Nama Peserta**  | [irfan dwi ariyanto]                         |
| **Kelas**         | [XII RPL 2]                  |
| **Judul Project** | Aplikasi Perpustakaan Digital SDN 1 Kalidadap   |
| **Studi Kasus**   | Sistem peminjaman, pengembalian, denda, katalog, notifikasi, dan laporan perpustakaan sekolah |
| **Paket Soal**    | [Sesuaikan, contoh: P4 – Perpustakaan]          |

---

## Teknologi

- **Frontend**  : Blade Template, HTML5, CSS3, JavaScript, Bootstrap Icons, Chart.js
- **Backend**   : Laravel 10.48+ (PHP 8.1+)
- **Database**  : MySQL
- **Lainnya**   : Middleware Role (Admin / Petugas / Anggota), Flash Notification, Web Push (opsional), Service Worker

---

## Fitur Utama

### Autentikasi & Role
- Register & Login (Anggota)
- Login Admin & Petugas/Staf
- Middleware pembatasan akses berdasarkan role (admin, staf, auth)
- Logout aman

### Modul Buku & Katalog
- Katalog buku publik & internal
- Pencarian buku
- Detail buku + cover
- CRUD Buku (Admin)
- CRUD Kategori
- Status ketersediaan stok

### Transaksi Peminjaman
- Pinjam buku (dengan validasi stok & batas lama pinjam)
- Pengajuan pengembalian oleh anggota
- Verifikasi pengembalian oleh Petugas/Admin
- Perhitungan denda otomatis (keterlambatan)
- Perpanjangan peminjaman
- Pembayaran denda
- Cetak slip peminjaman
- Transaksi database (COMMIT / ROLLBACK)

### Ulasan & Favorit
- Rating 1–5 + komentar
- Favorit buku

### Notifikasi
- Flash notification (sukses/gagal)
- Polling notifikasi (anggota & staf)
- Web Push (opsional, memerlukan konfigurasi browser)

### Laporan & Dashboard
- Dashboard terpisah: Admin, Petugas, Anggota
- Statistik & grafik (Chart.js)
- Export laporan CSV
- Log stok

### Pengaturan
- Atur tarif denda
- Batas lama peminjaman
- Konfigurasi aplikasi

---

## Cara Menjalankan (Lokal)

### Prasyarat
- PHP 8.1 atau lebih tinggi
- Composer
- MySQL / MariaDB
- Node.js (opsional, jika perlu build asset)

### Langkah Instalasi

1. **Clone repository**
   ```bash
   git clone https://github.com/[username]/[nama-repo].git
   cd [nama-repo]
   ```

2. **Install dependency**
   ```bash
   composer install
   ```

3. **Salin file environment**
   ```bash
   cp .env.example .env
   ```
   > **PENTING:** Jangan commit file `.env`. File ini sudah diabaikan di `.gitignore`.

4. **Generate application key**
   ```bash
   php artisan key:generate
   ```

5. **Konfigurasi database di `.env`**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=perpustakaan_digital
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. **Import database**
   ```bash
   # Cara 1: Import file SQL
   mysql -u root -p perpustakaan_digital < database/database.sql

   # Cara 2: Migration + Seeder (jika tersedia)
   php artisan migrate --seed
   ```

7. **Jalankan server lokal**
   ```bash
   php artisan serve
   ```
   Buka browser: [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## Database

Lokasi file database:

```
database/
└── database.sql          # Dump struktur + data demo (siap import)
```

**Catatan khusus:**
- Relasi antar tabel sudah diterapkan (foreign key)
- Terdapat stored procedure / function / trigger sesuai kebutuhan soal (jika paket mewajibkan)
- Transaksi database (COMMIT & ROLLBACK) digunakan pada proses peminjaman dan pengembalian

---

## Dokumentasi

Semua dokumen UKK tersedia di folder `docs/`:

```
docs/
├── 01-analisis-kebutuhan.pdf      # Analisis kebutuhan, requirement, aktor
├── 02-perancangan.pdf             # ERD, Flowchart, Activity, Use Case, Wireframe
├── 03-dokumentasi-program.pdf     # Struktur aplikasi, modul, fungsi/method
├── 04-pengujian.pdf               # Test case, expected vs actual result
├── 05-debugging.pdf               # Identifikasi error & solusi
└── 06-evaluasi.pdf                # Fitur berjalan, bug, rencana pengembangan
```

Tambahan (jika ada):
- `docs/manual-pengguna.pdf`
- `docs/checklist-ukk.pdf`
- Folder `screenshots/` berisi bukti pengujian UI

---

## Akun Pengujian (Demo)

Gunakan akun berikut untuk pengujian oleh asesor:

| Role          | Username / Email          | Password     |
|---------------|---------------------------|--------------|
| **Admin**     | admin@perpustakaan.test   | admin123     |
| **Petugas**   | petugas@perpustakaan.test | petugas123   |
| **Anggota**   | anggota@perpustakaan.test | user123      |

> Password di atas hanya untuk keperluan demo/asesmen.  
> Jangan gunakan credential produksi di repository.

---

## Demo / Hosting

- **Local**     : `php artisan serve` → http://127.0.0.1:8000
- **Hosting**   : [https://perpustakaan-sdnkldp1.infinityfreeapp.com/](https://perpustakaan-sdnkldp1.infinityfreeapp.com/)
- **QR Code**   : Arahkan ke URL di atas → https://perpustakaan-sdnkldp1.infinityfreeapp.com/

---

## Struktur Repository (Laravel)

```
.
├── README.md
├── app/
│   ├── Http/Controllers/     # Auth, Book, Borrowing, Report, dll.
│   ├── Models/               # User, Book, Borrowing, Category, Review, ...
│   └── Http/Middleware/      # auth, admin, staf
├── database/
│   ├── migrations/
│   ├── seeders/
│   └── database.sql
├── docs/                     # Dokumentasi UKK (PDF)
├── public/
├── resources/views/          # Blade templates
├── routes/web.php
├── screenshots/              # Bukti pengujian (opsional)
└── tests/                    # File pengujian (jika ada)
```

Struktur Laravel bawaan **dipertahankan** (tidak dipaksa masuk folder `src/`).

---

## Known Issues / Catatan

- Web Push memerlukan HTTPS + konfigurasi VAPID key (opsional, tidak wajib untuk asesmen dasar).
- Fitur notifikasi polling berjalan tanpa konfigurasi tambahan.
- Screenshot hasil pengujian final perlu dilampirkan di folder `screenshots/` setelah aplikasi dijalankan.
- Pastikan file `.env`, API key, password, dan token **tidak** ter-upload (sudah diatur di `.gitignore`).

---

## Alur Pemeriksaan Asesor

1. Buka repository ini
2. Baca `README.md` (halaman ini)
3. Periksa dokumentasi di folder `docs/`
4. Import `database/database.sql` dan jalankan aplikasi
5. Uji fitur menggunakan akun demo di atas
6. Lakukan source code inspection pada controller/model relevan
7. Verifikasi database & relasi
8. Konfirmasi kepada peserta jika diperlukan

---

## Catatan Keamanan (Penting)

File berikut **tidak boleh** masuk ke repository:

- `.env`
- `API_KEY`, `SECRET_KEY`, `TOKEN`, password produksi
- File credential lain

Pastikan `.gitignore` sudah mencakup:

```
.env
.env.*
/vendor
/node_modules
```

---

**Dibuat untuk keperluan Uji Kompetensi Keahlian (UKK) RPL 2026**  
Repository bersifat **public** agar dapat diakses langsung oleh asesor.
