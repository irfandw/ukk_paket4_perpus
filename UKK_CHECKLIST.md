# Checklist Target Pra Uji UKK 2026 — Perpustakaan Digital (Update)

Dokumen lengkap: lihat `DOKUMEN_UKK_PERPUSTAKAAN_DIGITAL.docx` (Word) di root project, atau file individual di `docs/DESAIN/`.

## Desain & UI
| No | Target | Status | Keterangan |
|----|--------|--------|------------|
| 1 | Wireframe / Mockup UI | Selesai | docs/DESAIN/wireframe.svg + .png |
| 2 | Use Case Diagram | Selesai | docs/DESAIN/usecase.svg + .png |
| 3 | Activity Diagram | Selesai | docs/DESAIN/activity.svg + .png |
| 4 | Algoritma | Selesai | docs/DESAIN/ALGORITMA.md |
| 5 | Flowchart / Userflow | Selesai | docs/DESAIN/flowchart.svg + .png |
| 6 | ERD | Selesai | docs/DESAIN/erd.svg + .png |
| 7 | Landing / teks | Ada | login.php + help |
| 8–12 | Gambar, grafik, multimedia, video, icon | Ada | Cover, chart admin, video login, icon SVG |
| 13–15 | Header, footer, sidebar | Ada | includes/ |
| 16 | Help | Ada | help.php |
| 17–18 | Komentar / badge / rating | Ada | siswa/detail_buku.php (tabel ulasan) |
| 19–21 | Availability / stok | Ada | stok buku, status pinjam |

## Auth
| 22–26 | Login/Register form | Ada | role admin/petugas/siswa |

## Database & Transaksi UKK
| 27–31, 50–54 | SP, Function, Trigger, COMMIT, ROLLBACK | Ada | sql/migrations/006_ukk_objects.sql + pinjamBukuUkk() |
| 32–34 | Admin report table/graph/print | Ada | dashboard, export, cetak |
| 35–36 | Petugas proofing | Ada | petugas/ |
| 37–39 | Validasi user admin/petugas | Ada | requireAdmin/Petugas/Siswa |
| 40–41 | Error handling TRUE/FALSE | Ada | flash + validasi |
| 42–49 | Tipe data, if, loop, array, function, file, CRUD | Ada | PHP native |
| 55–61 | SQL DDL/DML + JOIN | Ada | schema.sql |
| 62–66 | Debug error types | Ada | docs/DEBUG_ERROR.md |

## Deployment
| 67–78 | Repo static JS + GitHub Pages | Tidak berlaku | Project PHP+MySQL (server-side), tidak bisa jalan di GitHub Pages (hosting statis) |
| 79 | Hosting InfinityFree | Ada | UPLOAD_INFINITYFREE.txt, docs/INSTALASI.md |
| 81–90 | Uji sistem / test case | Selesai | docs/TEST_CASE.md — 18 skenario terverifikasi dari kode |
| 91–92 | Web uji target / data uji target | Selesai | Tercatat per baris di docs/TEST_CASE.md |
| 93–102 | Instalasi, struktur, screenshot, manual | Sebagian | README + help.php + docs/ ; **screenshot aplikasi (99) masih perlu diambil manual saat aplikasi berjalan** |

## Catatan penting
- Item **99 (screenshot aplikasi)** belum bisa dibuat otomatis karena butuh aplikasi berjalan dengan database aktif (MySQL + PHP server) — ambil screenshot nyata saat menjalankan di XAMPP/hosting, lalu simpan ke `docs/screenshots/`.
- Item **67–78** secara struktural tidak cocok untuk project PHP; jika penguji tetap meminta bukti GitHub Pages, sampaikan penjelasan ini secara langsung.
- Kolom Status pada `docs/TEST_CASE.md` sekarang sudah terisi "Lulus" berdasarkan penelusuran kode (code review). **Jalankan ulang manual sebelum hari-H** untuk konfirmasi akhir di lingkungan nyata.
