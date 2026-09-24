# Dokumentasi Modul & Method

## AuthController
- showLogin, login, showRegister, register, logout

## BookController
- index (katalog publik + search), show, create/store/edit/update/destroy (admin)

## BorrowingController
- store / quickBorrow : transaksi pinjam (DB transaction COMMIT/ROLLBACK)
- requestReturn : anggota ajukan pengembalian
- verifyReturn : petugas/admin verifikasi + hitung denda
- printSlip : cetak bukti

## ReviewController / FavoriteController
- Ulasan rating 1-5, favorit toggle

## ReportController
- index statistik, export CSV

## UserController / SettingController
- CRUD pengguna, pengaturan denda & batas pinjam

## DashboardController
- Dashboard admin (grafik Chart.js), petugas (proofing), anggota
