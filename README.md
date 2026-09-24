# Aplikasi Perpustakaan Digital SDN 1 Kalidadap

**UKK RPL 2026** — Project berbasis **Laravel 10 + MySQL**

---

## Identitas Project

| Item              | Keterangan                                                                                    |
|-------------------|-----------------------------------------------------------------------------------------------|
| **Nama Peserta**  | Irfan Dwi Ariyanto                                                                            |
| **Kelas**         | XII RPL 2                                                                                     |
| **Judul Project** | Aplikasi Perpustakaan Digital SDN 1 Kalidadap                                                 |
| **Studi Kasus**   | Sistem peminjaman, pengembalian, denda, katalog, notifikasi, dan laporan perpustakaan sekolah |
| **Paket Soal**    | P4 – Perpustakaan                                                                             |

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
