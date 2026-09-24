# Perpustakaan Digital — Laravel 10 (Final UKK)

Siap **localhost (XAMPP)** dan **InfinityFree**.

## Fitur (setara referensi download.zip)
- 3 role: Admin, Petugas, Anggota + login staf terpisah
- Katalog publik, hero video, dark mode, WhatsApp
- Pengajuan pinjam → setujui/tolak, walk-in meja
- Pengembalian + verifikasi, perpanjang, denda lunas, kondisi buku
- Kode transaksi, NIS/kelas, kode buku, rak, penerbit, tahun
- Cover/PDF: upload file **atau URL**
- Baca PDF digital, favorit, ulasan
- Notifikasi user + notifikasi staf (broadcast)
- Laporan, grafik, export CSV, cetak bukti
- Pengaturan, pesan kontak, pembersihan DB, counter pengunjung
- Rate limit login, PWA manifest

## Tidak ada akun demo. Buat admin sendiri (lihat docs).


## Localhost
Lihat `CARA_PAKAI.txt` atau `docs/INSTALASI.md`

## InfinityFree
Lihat `docs/DEPLOY_INFINITYFREE.md`

## Database
Import **satu file**: `database/INSTALL_LENGKAP.sql`  
(Opsional UKK SP/Trigger: `database/ukk_sql_objects.sql`)
