-- 1) Pastikan kolom kondisi ada
ALTER TABLE `buku` ADD COLUMN `kondisi` VARCHAR(30) NOT NULL DEFAULT 'Baik' AFTER `status`;
ALTER TABLE `buku` ADD COLUMN `keterangan_kondisi` VARCHAR(500) NULL AFTER `kondisi`;

-- 2) Contoh PDF online untuk Laskar Pelangi (PDF publik sample)
-- Ganti URL ini dengan PDF buku asli jika sudah punya.
UPDATE `buku`
SET `file_pdf` = 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
    `kondisi` = 'Rusak Ringan',
    `keterangan_kondisi` = 'halaman 10 hilang/sobek'
WHERE `judul` LIKE '%Laskar Pelangi%';

-- 3) (Opsional) PDF sample untuk buku lain
UPDATE `buku`
SET `file_pdf` = 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf'
WHERE `file_pdf` IS NULL OR `file_pdf` = '';
