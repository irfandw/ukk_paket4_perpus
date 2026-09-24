-- Tambah kolom foto profil di tabel pengguna
-- Jalankan sekali di phpMyAdmin jika kolom belum ada
ALTER TABLE pengguna
  ADD COLUMN foto VARCHAR(500) NULL DEFAULT NULL AFTER alamat;
