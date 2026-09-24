USE perpustakaan_digital;
CREATE TABLE IF NOT EXISTS settings (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `key` VARCHAR(255) NOT NULL UNIQUE,
  value TEXT NULL,
  label VARCHAR(255) NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
);
INSERT IGNORE INTO settings (`key`, value, label, created_at, updated_at) VALUES
('denda_per_hari', '2000', 'Tarif denda per hari (Rp)', NOW(), NOW()),
('maks_hari_pinjam', '14', 'Maksimal hari pinjam', NOW(), NOW()),
('maks_buku_aktif', '3', 'Maksimal buku aktif per anggota', NOW(), NOW()),
('nama_perpus', 'Perpustakaan Digital SDN 1 Kalidadap', 'Nama perpustakaan', NOW(), NOW());
