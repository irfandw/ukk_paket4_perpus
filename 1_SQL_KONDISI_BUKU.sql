-- =============================================
-- WAJIB DIJALANKAN di phpMyAdmin
-- Database: yang dipakai situs perpustakaan
-- =============================================

-- 1) Kondisi buku
ALTER TABLE `buku`
  ADD COLUMN `kondisi` VARCHAR(30) NOT NULL DEFAULT 'Baik' AFTER `status`;

-- 2) Keterangan kerusakan (contoh: halaman 10 hilang/sobek)
ALTER TABLE `buku`
  ADD COLUMN `keterangan_kondisi` VARCHAR(500) NULL DEFAULT NULL AFTER `kondisi`;

-- Jika muncul error "Duplicate column name 'kondisi'"
-- artinya kolom kondisi sudah ada → lanjut jalankan HANYA perintah ke-2.

-- Jika muncul error "Duplicate column name 'keterangan_kondisi'"
-- artinya keduanya sudah ada → selesai, refresh katalog.
