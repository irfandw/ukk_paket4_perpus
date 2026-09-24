CREATE DATABASE IF NOT EXISTS `perpustakaan_digital` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `perpustakaan_digital`;

SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS stock_logs;
DROP TABLE IF EXISTS reviews;
DROP TABLE IF EXISTS favorites;
DROP TABLE IF EXISTS borrowings;
DROP TABLE IF EXISTS books;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS settings;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS password_reset_tokens;
DROP TABLE IF EXISTS failed_jobs;
DROP TABLE IF EXISTS personal_access_tokens;
SET FOREIGN_KEY_CHECKS=1;

CREATE TABLE users (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE,
  email_verified_at TIMESTAMP NULL,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin','petugas','anggota') NOT NULL DEFAULT 'anggota',
  status ENUM('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
  phone VARCHAR(255) NULL,
  address TEXT NULL,
  remember_token VARCHAR(100) NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE categories (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  slug VARCHAR(255) NOT NULL UNIQUE,
  description TEXT NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE books (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  slug VARCHAR(255) NOT NULL UNIQUE,
  author VARCHAR(255) NOT NULL,
  publisher VARCHAR(255) NULL,
  year_published YEAR NULL,
  isbn VARCHAR(255) NULL,
  category_id BIGINT UNSIGNED NOT NULL,
  stock INT NOT NULL DEFAULT 0,
  available INT NOT NULL DEFAULT 0,
  description TEXT NULL,
  cover VARCHAR(255) NULL,
  status ENUM('tersedia','tidak_tersedia') NOT NULL DEFAULT 'tersedia',
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE borrowings (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id BIGINT UNSIGNED NOT NULL,
  book_id BIGINT UNSIGNED NOT NULL,
  borrow_date DATE NOT NULL,
  due_date DATE NOT NULL,
  lama_hari SMALLINT UNSIGNED NOT NULL DEFAULT 7,
  perpanjang_count TINYINT UNSIGNED NOT NULL DEFAULT 0,
  return_date DATE NULL,
  status ENUM('dipinjam','menunggu_verifikasi','dikembalikan','terlambat') NOT NULL DEFAULT 'dipinjam',
  denda INT UNSIGNED NOT NULL DEFAULT 0,
  denda_lunas TINYINT(1) NOT NULL DEFAULT 0,
  kondisi_buku VARCHAR(50) NULL,
  notes TEXT NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE stock_logs (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  book_id BIGINT UNSIGNED NOT NULL,
  user_id BIGINT UNSIGNED NULL,
  tipe ENUM('pinjam','kembali','tambah','kurang') NOT NULL DEFAULT 'pinjam',
  jumlah INT NOT NULL DEFAULT 1,
  stok_sebelum INT NOT NULL,
  stok_sesudah INT NOT NULL,
  keterangan VARCHAR(255) NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE reviews (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id BIGINT UNSIGNED NOT NULL,
  book_id BIGINT UNSIGNED NOT NULL,
  rating TINYINT UNSIGNED NOT NULL,
  comment TEXT NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  UNIQUE KEY reviews_user_book (user_id, book_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE favorites (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id BIGINT UNSIGNED NOT NULL,
  book_id BIGINT UNSIGNED NOT NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  UNIQUE KEY favorites_user_book (user_id, book_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE settings (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `key` VARCHAR(255) NOT NULL UNIQUE,
  value TEXT NULL,
  label VARCHAR(255) NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE password_reset_tokens (
  email VARCHAR(255) NOT NULL PRIMARY KEY,
  token VARCHAR(255) NOT NULL,
  created_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tidak ada akun demo. Buat admin sendiri.

INSERT INTO categories (id,name,slug,description,created_at,updated_at) VALUES
(1,'Fiksi','fiksi','Novel dan cerita fiksi',NOW(),NOW()),
(2,'Non-Fiksi','non-fiksi','Pengetahuan umum',NOW(),NOW()),
(3,'Teknologi','teknologi','Komputer dan teknologi',NOW(),NOW()),
(4,'Sejarah','sejarah','Sejarah dan biografi',NOW(),NOW()),
(5,'Pendidikan','pendidikan','Buku pelajaran',NOW(),NOW());

INSERT INTO books (id,title,slug,author,publisher,year_published,isbn,category_id,stock,available,description,status,created_at,updated_at) VALUES
(1,'Laskar Pelangi','laskar-pelangi','Andrea Hirata','Bentang Pustaka',2005,'9789793062792',1,5,5,'Novel inspiratif Belitung.','tersedia',NOW(),NOW()),
(2,'Bumi Manusia','bumi-manusia','Pramoedya Ananta Toer','Hasta Mitra',1980,'9789799731234',1,3,3,'Novel sejarah Indonesia.','tersedia',NOW(),NOW()),
(3,'Clean Code','clean-code','Robert C. Martin','Prentice Hall',2008,'9780132350884',3,4,4,'Panduan kode bersih.','tersedia',NOW(),NOW()),
(4,'Sejarah Indonesia Modern','sejarah-indonesia-modern','M.C. Ricklefs','UGM Press',2008,'9789794201234',4,2,2,'Sejarah kolonial.','tersedia',NOW(),NOW()),
(5,'Atomic Habits','atomic-habits','James Clear','Avery',2018,'9780735211292',2,6,5,'Membangun kebiasaan.','tersedia',NOW(),NOW()),
(6,'Laravel for Beginners','laravel-for-beginners','John Doe','Tech Press',2023,'9781234567890',3,3,3,'Pengenalan Laravel.','tersedia',NOW(),NOW()),
(7,'Matematika Dasar','matematika-dasar','Tim Edukasi','Erlangga',2020,'9789791234567',5,10,10,'Buku pelajaran.','tersedia',NOW(),NOW()),
(8,'Negeri 5 Menara','negeri-5-menara','Ahmad Fuadi','Gramedia',2009,'9789792248612',1,4,4,'Novel pesantren.','tersedia',NOW(),NOW());

-- (Tidak ada data pinjaman demo — buat lewat aplikasi)
INSERT INTO settings (`key`,value,label,created_at,updated_at) VALUES
('denda_per_hari','2000','Tarif denda per hari (Rp)',NOW(),NOW()),
('maks_hari_pinjam','14','Maksimal hari pinjam',NOW(),NOW()),
('maks_buku_aktif','3','Maksimal buku aktif per anggota',NOW(),NOW()),
('nama_perpus','Perpustakaan Digital SDN 1 Kalidadap','Nama perpustakaan',NOW(),NOW());

CREATE TABLE IF NOT EXISTS notifications (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id BIGINT UNSIGNED NOT NULL,
  title VARCHAR(255) NOT NULL,
  message TEXT NULL,
  type VARCHAR(50) NOT NULL DEFAULT 'info',
  is_read TINYINT(1) NOT NULL DEFAULT 0,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS contacts (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  subject VARCHAR(255) NULL,
  message TEXT NOT NULL,
  is_read TINYINT(1) NOT NULL DEFAULT 0,
  reply TEXT NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
