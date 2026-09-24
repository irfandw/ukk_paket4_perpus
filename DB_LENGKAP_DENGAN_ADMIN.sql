-- =============================================================================
-- Perpustakaan Digital SDN 1 Kalidadap
-- Database LENGKAP (Bahasa Indonesia) + akun admin/petugas/anggota
-- Import di phpMyAdmin InfinityFree
-- =============================================================================
-- AKUN LOGIN (password semua sama):
--   Admin   : admin@sdn1kalidadap.sch.id   /  Admin123!
--   Petugas : petugas@sdn1kalidadap.sch.id /  Admin123!
--   Anggota : anggota@sdn1kalidadap.sch.id /  Admin123!
-- Ganti password setelah login pertama!
-- =============================================================================

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS log_stok;
DROP TABLE IF EXISTS ulasan;
DROP TABLE IF EXISTS favorit;
DROP TABLE IF EXISTS transaksi;
DROP TABLE IF EXISTS buku;
DROP TABLE IF EXISTS kategori;
DROP TABLE IF EXISTS pengaturan;
DROP TABLE IF EXISTS notifikasi;
DROP TABLE IF EXISTS notifikasi_staf;
DROP TABLE IF EXISTS pesan_kontak;
DROP TABLE IF EXISTS log_pengunjung;
DROP TABLE IF EXISTS pengunjung;
DROP TABLE IF EXISTS push_subscription;
DROP TABLE IF EXISTS stock_logs;
DROP TABLE IF EXISTS reviews;
DROP TABLE IF EXISTS favorites;
DROP TABLE IF EXISTS borrowings;
DROP TABLE IF EXISTS books;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS settings;
DROP TABLE IF EXISTS notifications;
DROP TABLE IF EXISTS staff_notifications;
DROP TABLE IF EXISTS contacts;
DROP TABLE IF EXISTS visitor_logs;
DROP TABLE IF EXISTS visitors;
DROP TABLE IF EXISTS push_subscriptions;
DROP TABLE IF EXISTS password_reset_tokens;
DROP TABLE IF EXISTS failed_jobs;
DROP TABLE IF EXISTS personal_access_tokens;
DROP TABLE IF EXISTS pengguna;
DROP TABLE IF EXISTS users;

SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE pengguna (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  nama VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  email_verified_at TIMESTAMP NULL DEFAULT NULL,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin','petugas','anggota') NOT NULL DEFAULT 'anggota',
  status ENUM('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
  telepon VARCHAR(50) DEFAULT NULL,
  nis VARCHAR(50) DEFAULT NULL,
  kelas VARCHAR(50) DEFAULT NULL,
  alamat TEXT DEFAULT NULL,
  foto VARCHAR(500) DEFAULT NULL,
  remember_token VARCHAR(100) DEFAULT NULL,
  created_at TIMESTAMP NULL DEFAULT NULL,
  updated_at TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY pengguna_email_unique (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE kategori (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  nama VARCHAR(255) NOT NULL,
  slug VARCHAR(255) NOT NULL,
  deskripsi TEXT DEFAULT NULL,
  created_at TIMESTAMP NULL DEFAULT NULL,
  updated_at TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY kategori_slug_unique (slug)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE buku (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  kode_buku VARCHAR(30) DEFAULT NULL,
  judul VARCHAR(255) NOT NULL,
  slug VARCHAR(255) NOT NULL,
  pengarang VARCHAR(255) NOT NULL,
  penerbit VARCHAR(150) DEFAULT NULL,
  tahun_terbit SMALLINT UNSIGNED DEFAULT NULL,
  rak VARCHAR(50) DEFAULT NULL,
  isbn VARCHAR(50) DEFAULT NULL,
  kategori_id BIGINT UNSIGNED NOT NULL,
  stok INT NOT NULL DEFAULT 0,
  tersedia INT NOT NULL DEFAULT 0,
  deskripsi TEXT DEFAULT NULL,
  gambar VARCHAR(500) DEFAULT NULL,
  file_pdf VARCHAR(500) DEFAULT NULL,
  status ENUM('tersedia','tidak_tersedia') NOT NULL DEFAULT 'tersedia',
  created_at TIMESTAMP NULL DEFAULT NULL,
  updated_at TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY buku_slug_unique (slug),
  KEY buku_kategori_id_foreign (kategori_id),
  CONSTRAINT buku_kategori_id_foreign FOREIGN KEY (kategori_id) REFERENCES kategori (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE transaksi (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  kode_transaksi VARCHAR(40) DEFAULT NULL,
  pengguna_id BIGINT UNSIGNED NOT NULL,
  buku_id BIGINT UNSIGNED NOT NULL,
  tgl_pinjam DATE NOT NULL,
  tgl_jatuh_tempo DATE NOT NULL,
  lama_hari SMALLINT UNSIGNED NOT NULL DEFAULT 7,
  jumlah_perpanjang TINYINT UNSIGNED NOT NULL DEFAULT 0,
  tgl_kembali DATE DEFAULT NULL,
  waktu_kembali DATETIME DEFAULT NULL,
  status VARCHAR(40) NOT NULL DEFAULT 'dipinjam',
  denda INT UNSIGNED NOT NULL DEFAULT 0,
  denda_lunas TINYINT(1) NOT NULL DEFAULT 0,
  kondisi_buku VARCHAR(50) DEFAULT NULL,
  catatan TEXT DEFAULT NULL,
  alasan_tolak VARCHAR(255) DEFAULT NULL,
  created_at TIMESTAMP NULL DEFAULT NULL,
  updated_at TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (id),
  KEY transaksi_pengguna_id_foreign (pengguna_id),
  KEY transaksi_buku_id_foreign (buku_id),
  CONSTRAINT transaksi_pengguna_id_foreign FOREIGN KEY (pengguna_id) REFERENCES pengguna (id) ON DELETE CASCADE,
  CONSTRAINT transaksi_buku_id_foreign FOREIGN KEY (buku_id) REFERENCES buku (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE favorit (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  pengguna_id BIGINT UNSIGNED NOT NULL,
  buku_id BIGINT UNSIGNED NOT NULL,
  created_at TIMESTAMP NULL DEFAULT NULL,
  updated_at TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY uniq_fav (pengguna_id, buku_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE ulasan (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  pengguna_id BIGINT UNSIGNED NOT NULL,
  buku_id BIGINT UNSIGNED NOT NULL,
  rating TINYINT UNSIGNED NOT NULL DEFAULT 5,
  komentar TEXT DEFAULT NULL,
  created_at TIMESTAMP NULL DEFAULT NULL,
  updated_at TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE notifikasi (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  pengguna_id BIGINT UNSIGNED NOT NULL,
  judul VARCHAR(255) NOT NULL,
  pesan TEXT DEFAULT NULL,
  tipe VARCHAR(50) NOT NULL DEFAULT 'info',
  sudah_dibaca TINYINT(1) NOT NULL DEFAULT 0,
  created_at TIMESTAMP NULL DEFAULT NULL,
  updated_at TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE notifikasi_staf (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  judul VARCHAR(150) NOT NULL,
  pesan TEXT NOT NULL,
  tipe VARCHAR(30) NOT NULL DEFAULT 'info',
  sudah_dibaca TINYINT(1) NOT NULL DEFAULT 0,
  created_at TIMESTAMP NULL DEFAULT NULL,
  updated_at TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE pesan_kontak (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  nama VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  subjek VARCHAR(255) DEFAULT NULL,
  pesan TEXT NOT NULL,
  sudah_dibaca TINYINT(1) NOT NULL DEFAULT 0,
  balasan TEXT DEFAULT NULL,
  created_at TIMESTAMP NULL DEFAULT NULL,
  updated_at TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE pengaturan (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  kunci VARCHAR(100) NOT NULL,
  nilai TEXT DEFAULT NULL,
  keterangan VARCHAR(255) DEFAULT NULL,
  created_at TIMESTAMP NULL DEFAULT NULL,
  updated_at TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY pengaturan_kunci_unique (kunci)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE log_pengunjung (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  path VARCHAR(150) DEFAULT NULL,
  ip VARCHAR(45) DEFAULT NULL,
  created_at TIMESTAMP NULL DEFAULT NULL,
  updated_at TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE log_stok (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  buku_id BIGINT UNSIGNED NOT NULL,
  perubahan INT NOT NULL,
  keterangan VARCHAR(255) DEFAULT NULL,
  created_at TIMESTAMP NULL DEFAULT NULL,
  updated_at TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE push_subscription (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  endpoint VARCHAR(500) NOT NULL,
  p256dh VARCHAR(255) NOT NULL,
  auth VARCHAR(255) NOT NULL,
  role VARCHAR(20) NOT NULL DEFAULT 'anggota',
  pengguna_id BIGINT UNSIGNED DEFAULT NULL,
  user_agent VARCHAR(255) DEFAULT NULL,
  created_at TIMESTAMP NULL DEFAULT NULL,
  updated_at TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE password_reset_tokens (
  email VARCHAR(255) NOT NULL,
  token VARCHAR(255) NOT NULL,
  created_at TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- AKUN (password semua = Admin123!)
INSERT INTO pengguna (id, nama, email, password, role, status, telepon, nis, kelas, alamat, created_at, updated_at) VALUES
(1, 'Administrator', 'admin@sdn1kalidadap.sch.id',
 '$2y$10$XwxvqL8NV49azyZALlpOXeOpEQQq4gpR3A0bjZtWUX3xrobzS/V/G',
 'admin', 'aktif', '081234567890', NULL, NULL, 'SDN 1 Kalidadap', NOW(), NOW()),
(2, 'Petugas Sirkulasi', 'petugas@sdn1kalidadap.sch.id',
 '$2y$10$XwxvqL8NV49azyZALlpOXeOpEQQq4gpR3A0bjZtWUX3xrobzS/V/G',
 'petugas', 'aktif', '081298765432', NULL, NULL, 'SDN 1 Kalidadap', NOW(), NOW()),
(3, 'Budi Santoso', 'anggota@sdn1kalidadap.sch.id',
 '$2y$10$XwxvqL8NV49azyZALlpOXeOpEQQq4gpR3A0bjZtWUX3xrobzS/V/G',
 'anggota', 'aktif', '08111222333', '2024001', '6A', 'Selopamioro, Imogiri', NOW(), NOW());

INSERT INTO kategori (id, nama, slug, deskripsi, created_at, updated_at) VALUES
(1, 'Fiksi', 'fiksi', 'Novel dan cerita fiksi', NOW(), NOW()),
(2, 'Non-Fiksi', 'non-fiksi', 'Pengetahuan umum', NOW(), NOW()),
(3, 'Teknologi', 'teknologi', 'Komputer dan teknologi', NOW(), NOW()),
(4, 'Sejarah', 'sejarah', 'Sejarah dan biografi', NOW(), NOW()),
(5, 'Pendidikan', 'pendidikan', 'Buku pelajaran', NOW(), NOW());

INSERT INTO buku (id, kode_buku, judul, slug, pengarang, penerbit, tahun_terbit, rak, isbn, kategori_id, stok, tersedia, deskripsi, status, created_at, updated_at) VALUES
(1, 'BK001', 'Laskar Pelangi', 'laskar-pelangi', 'Andrea Hirata', 'Bentang Pustaka', 2005, 'A-1', '9789793062792', 1, 5, 5, 'Novel inspiratif tentang anak-anak Belitung.', 'tersedia', NOW(), NOW()),
(2, 'BK002', 'Bumi Manusia', 'bumi-manusia', 'Pramoedya Ananta Toer', 'Hasta Mitra', 1980, 'A-2', '9789799731234', 1, 3, 3, 'Novel sejarah Indonesia.', 'tersedia', NOW(), NOW()),
(3, 'BK003', 'Clean Code', 'clean-code', 'Robert C. Martin', 'Prentice Hall', 2008, 'B-1', '9780132350884', 3, 4, 4, 'Panduan menulis kode yang bersih.', 'tersedia', NOW(), NOW()),
(4, 'BK004', 'Sejarah Indonesia Modern', 'sejarah-indonesia-modern', 'M.C. Ricklefs', 'UGM Press', 2008, 'C-1', '9789794201234', 4, 2, 2, 'Sejarah Indonesia masa kolonial hingga modern.', 'tersedia', NOW(), NOW()),
(5, 'BK005', 'Atomic Habits', 'atomic-habits', 'James Clear', 'Avery', 2018, 'D-1', '9780735211292', 2, 6, 6, 'Cara membangun kebiasaan baik.', 'tersedia', NOW(), NOW()),
(6, 'BK006', 'Laravel for Beginners', 'laravel-for-beginners', 'John Doe', 'Tech Press', 2023, 'B-2', '9781234567890', 3, 3, 3, 'Pengenalan framework Laravel.', 'tersedia', NOW(), NOW()),
(7, 'BK007', 'Matematika Dasar', 'matematika-dasar', 'Tim Edukasi', 'Erlangga', 2020, 'E-1', '9789791234567', 5, 10, 10, 'Buku pelajaran matematika SD.', 'tersedia', NOW(), NOW()),
(8, 'BK008', 'Negeri 5 Menara', 'negeri-5-menara', 'Ahmad Fuadi', 'Gramedia', 2009, 'A-3', '9789792248612', 1, 4, 4, 'Novel tentang pesantren dan mimpi.', 'tersedia', NOW(), NOW());

INSERT INTO pengaturan (kunci, nilai, keterangan, created_at, updated_at) VALUES
('denda_per_hari', '2000', 'Tarif denda per hari (Rp)', NOW(), NOW()),
('maks_hari_pinjam', '14', 'Maksimal hari pinjam', NOW(), NOW()),
('maks_buku_aktif', '3', 'Maksimal buku aktif per anggota', NOW(), NOW()),
('nama_perpustakaan', 'Perpustakaan Digital SDN 1 Kalidadap', 'Nama perpustakaan', NOW(), NOW()),
('alamat_perpus', 'SDN 1 Kalidadap, Selopamioro, Imogiri, Bantul, DIY', 'Alamat', NOW(), NOW()),
('kontak_whatsapp', '6281234567890', 'WhatsApp admin', NOW(), NOW()),
('notif_wa_staf', '0', 'Kirim WA ke staf', NOW(), NOW()),
('notif_wa_anggota', '0', 'Kirim WA ke anggota', NOW(), NOW());

SET FOREIGN_KEY_CHECKS = 1;
