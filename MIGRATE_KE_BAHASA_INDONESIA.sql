-- Migrasi tabel & kolom Inggris → Indonesia (jalankan di DB yang sudah ada)
-- Backup dulu! Lalu import file ini di phpMyAdmin.

SET FOREIGN_KEY_CHECKS=0;

-- users → pengguna
RENAME TABLE users TO pengguna;
ALTER TABLE pengguna
  CHANGE name nama VARCHAR(255) NOT NULL,
  CHANGE phone telepon VARCHAR(50) NULL,
  CHANGE address alamat TEXT NULL;

-- categories → kategori
RENAME TABLE categories TO kategori;
ALTER TABLE kategori
  CHANGE name nama VARCHAR(255) NOT NULL,
  CHANGE description deskripsi TEXT NULL;

-- books → buku
RENAME TABLE books TO buku;
ALTER TABLE buku
  CHANGE title judul VARCHAR(255) NOT NULL,
  CHANGE author pengarang VARCHAR(255) NOT NULL,
  CHANGE category_id kategori_id BIGINT UNSIGNED NOT NULL,
  CHANGE stock stok INT NOT NULL DEFAULT 0,
  CHANGE available tersedia INT NOT NULL DEFAULT 0,
  CHANGE description deskripsi TEXT NULL,
  CHANGE cover gambar VARCHAR(500) NULL;
-- merge publisher/year if needed
UPDATE buku SET penerbit = COALESCE(NULLIF(penerbit,''), publisher) WHERE publisher IS NOT NULL;
UPDATE buku SET tahun_terbit = COALESCE(tahun_terbit, year_published) WHERE year_published IS NOT NULL;

-- borrowings → transaksi
RENAME TABLE borrowings TO transaksi;
ALTER TABLE transaksi
  CHANGE user_id pengguna_id BIGINT UNSIGNED NOT NULL,
  CHANGE book_id buku_id BIGINT UNSIGNED NOT NULL,
  CHANGE borrow_date tgl_pinjam DATE NOT NULL,
  CHANGE due_date tgl_jatuh_tempo DATE NOT NULL,
  CHANGE return_date tgl_kembali DATE NULL,
  CHANGE perpanjang_count jumlah_perpanjang TINYINT UNSIGNED NOT NULL DEFAULT 0,
  CHANGE notes catatan TEXT NULL;

-- favorites → favorit
RENAME TABLE favorites TO favorit;
ALTER TABLE favorit
  CHANGE user_id pengguna_id BIGINT UNSIGNED NOT NULL,
  CHANGE book_id buku_id BIGINT UNSIGNED NOT NULL;

-- reviews → ulasan
RENAME TABLE reviews TO ulasan;
ALTER TABLE ulasan
  CHANGE user_id pengguna_id BIGINT UNSIGNED NOT NULL,
  CHANGE book_id buku_id BIGINT UNSIGNED NOT NULL,
  CHANGE comment komentar TEXT NULL;

-- notifications → notifikasi
RENAME TABLE notifications TO notifikasi;
ALTER TABLE notifikasi
  CHANGE user_id pengguna_id BIGINT UNSIGNED NOT NULL,
  CHANGE title judul VARCHAR(255) NOT NULL,
  CHANGE message pesan TEXT NULL,
  CHANGE type tipe VARCHAR(50) NOT NULL DEFAULT 'info',
  CHANGE is_read sudah_dibaca TINYINT(1) NOT NULL DEFAULT 0;

-- staff_notifications → notifikasi_staf
RENAME TABLE staff_notifications TO notifikasi_staf;
ALTER TABLE notifikasi_staf
  CHANGE title judul VARCHAR(150) NOT NULL,
  CHANGE message pesan TEXT NOT NULL,
  CHANGE type tipe VARCHAR(30) NOT NULL DEFAULT 'info',
  CHANGE is_read sudah_dibaca TINYINT(1) NOT NULL DEFAULT 0;

-- contacts → pesan_kontak
RENAME TABLE contacts TO pesan_kontak;
ALTER TABLE pesan_kontak
  CHANGE name nama VARCHAR(255) NOT NULL,
  CHANGE subject subjek VARCHAR(255) NULL,
  CHANGE message pesan TEXT NOT NULL,
  CHANGE is_read sudah_dibaca TINYINT(1) NOT NULL DEFAULT 0,
  CHANGE reply balasan TEXT NULL;

-- settings → pengaturan
RENAME TABLE settings TO pengaturan;
ALTER TABLE pengaturan
  CHANGE `key` kunci VARCHAR(100) NOT NULL,
  CHANGE value nilai TEXT NULL,
  CHANGE label keterangan VARCHAR(255) NULL;

-- visitor_logs → log_pengunjung
RENAME TABLE visitor_logs TO log_pengunjung;

-- stock_logs → log_stok (jika ada)
-- RENAME TABLE stock_logs TO log_stok;

-- push_subscriptions → push_subscription
-- RENAME TABLE push_subscriptions TO push_subscription;

SET FOREIGN_KEY_CHECKS=1;
