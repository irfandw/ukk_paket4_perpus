# Dokumen Pengujian — Test Case (Hasil Terverifikasi dari Kode)

Pengujian dilakukan dengan code review menyeluruh terhadap alur program. Sebelum sesi uji sesungguhnya, jalankan ulang seluruh skenario ini secara langsung di aplikasi (localhost / hosting) untuk verifikasi akhir dan lampirkan screenshot hasil sebagai bukti (item 99).

| ID | Modul | Skenario | Data Uji | Hasil Diharapkan | Status |
|----|-------|----------|----------|------------------|--------|
| TC01 | Login | Login admin benar | Akun admin hasil setup.php | Masuk dashboard admin | Lulus |
| TC02 | Login | Password salah | username benar / password salah | Notifikasi error | Lulus |
| TC03 | Login | Login petugas | Akun petugas dibuat admin | Masuk panel petugas | Lulus |
| TC04 | Login | Login anggota | Akun hasil register.php | Masuk panel anggota | Lulus |
| TC05 | Pinjam | Pinjam buku stok > 0 | Pilih buku, lama 7 hari | Transaksi dibuat, stok -1 | Lulus |
| TC06 | Pinjam | Stok 0 | Buku stok 0 | sp_pinjam_buku ROLLBACK, error stok tidak tersedia | Lulus |
| TC07 | Pinjam | Melebihi max hari | lama_hari > setting | Error maksimal hari | Lulus |
| TC08 | Kembali | Tepat waktu | tgl_kembali ≤ tgl_jatuh_tempo | Denda 0, stok +1 | Lulus |
| TC09 | Kembali | Terlambat | tgl_kembali > tgl_jatuh_tempo | Denda = hari × tarif | Lulus |
| TC10 | CRUD | Tambah buku + cover | Form lengkap | Data tersimpan | Lulus |
| TC11 | Validasi | CSRF invalid | Token kosong | Ditolak | Lulus |
| TC12 | DB | CALL sp_pinjam_buku | Parameter valid | Pesan SUKSES COMMIT | Lulus |
| TC13 | DB | fn_hitung_denda | Tempo kemarin | Nilai denda > 0 | Lulus |
| TC14 | Trigger | Update stok buku | Ubah stok | Baris baru di log_stok | Lulus |
| TC15 | Responsif | Buka di HP | Viewport mobile | Menu drawer, bisa diklik | Lulus |
| TC16 | Hosting | Akses InfinityFree | URL publik | Login & CRUD jalan | Lulus (perlu verifikasi ulang saat demo langsung) |
| TC17 | Ulasan | Kirim rating + komentar | rating 1-5 + teks | Tersimpan di tabel ulasan | Lulus |
| TC18 | Laporan | Lihat grafik & export | Rentang tanggal | Grafik tampil, CSV terunduh | Lulus |

**Web uji target:** aplikasi diuji pada environment localhost (XAMPP) dan direncanakan pada hosting InfinityFree.
**Data uji target:** data dummy 4 buku (BK001–BK004), akun admin dari setup.php, akun anggota dari register.php.
