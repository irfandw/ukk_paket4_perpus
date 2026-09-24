# Debug & Identifikasi Error

## Syntax Error
Pesan parse error di PHP — perbaiki tanda kutip/kurung pada baris yang ditunjuk.

## Logic Error
Contoh: denda muncul padahal belum jatuh tempo.
Perbaikan: hitung hanya jika due_date < hari ini.

## Runtime Error
Contoh: file_put_contents session failed — buat folder storage/framework/sessions.

## Database Related Error
Contoh: Class Pdo\Mysql / connection refused — cek MySQL XAMPP, DB name di .env.

## Notifikasi TRUE/FALSE
- Sukses: session flash success (alert hijau + bunyi notif)
- Gagal: session flash error / validation errors (alert merah)
