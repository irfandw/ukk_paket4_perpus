# Algoritma (Pseudocode)

## Peminjaman Buku (sesuai sp_pinjam_buku)
```
MULAI
INPUT kode_transaksi, anggota_id, buku_id, tgl_pinjam, tgl_tempo
START TRANSACTION
BACA status anggota DARI tabel anggota
JIKA status anggota TIDAK 'aktif' MAKA
    ROLLBACK; TAMPILKAN 'anggota tidak aktif'; SELESAI
BACA stok buku DARI tabel buku (FOR UPDATE)
JIKA stok < 1 MAKA
    ROLLBACK; TAMPILKAN 'stok tidak tersedia'; SELESAI
SIMPAN baris baru KE tabel transaksi
UPDATE stok buku = stok buku - 1
COMMIT
TAMPILKAN 'peminjaman berhasil'
SELESAI
```

## Perhitungan Denda (sesuai fn_hitung_denda)
```
MULAI
INPUT tgl_jatuh_tempo, denda_per_hari
JIKA tgl_jatuh_tempo KOSONG ATAU tgl_jatuh_tempo >= tanggal_hari_ini MAKA
    KEMBALIKAN 0
hari_telat = SELISIH(tanggal_hari_ini, tgl_jatuh_tempo)
JIKA hari_telat < 0 MAKA hari_telat = 0
KEMBALIKAN hari_telat * denda_per_hari
SELESAI
```
