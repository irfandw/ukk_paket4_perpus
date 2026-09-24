# Deploy ke InfinityFree

## Persiapan di komputer (XAMPP) — WAJIB

1. Pastikan app jalan di localhost.
2. Generate key:
   ```
   php artisan key:generate
   ```
3. Buat symlink storage (opsional di hosting diganti manual):
   ```
   php artisan storage:link
   ```
4. Optimasi (opsional):
   ```
   php artisan config:clear
   php artisan route:clear
   php artisan view:clear
   ```

## Database InfinityFree

1. Login https://infinityfree.com → Control Panel
2. **MySQL Databases** → Create Database
3. Catat: **Host**, **Database name**, **Username**, **Password**
4. Buka **phpMyAdmin** InfinityFree → Import:
   - `database/INSTALL_LENGKAP.sql`
   - Opsional: `database/ukk_sql_objects.sql` (Function/Trigger kadang dibatasi hosting)

## Upload file

1. File Manager → folder `htdocs` (kosongkan isi default)
2. Upload **semua** isi project (termasuk `vendor`)
3. Pastikan di root htdocs ada:
   - `index.php`
   - `.htaccess`
   - folder `public`, `app`, `vendor`, dll.

## Konfigurasi .env di hosting

1. Edit `.env` (atau rename `.env.infinityfree` → `.env`)
2. Isi:
   ```
   APP_URL=https://namamu.infinityfreeapp.com
   APP_DEBUG=false
   APP_ENV=production
   DB_HOST=... (dari panel)
   DB_DATABASE=...
   DB_USERNAME=...
   DB_PASSWORD=...
   ```
3. **APP_KEY** harus diisi (copy dari `.env` lokal setelah `php artisan key:generate`)

## Storage

Pastikan writable:
- storage/
- storage/framework/sessions
- storage/framework/views
- storage/framework/cache/data
- storage/logs
- bootstrap/cache

Cover/PDF: `storage/app/public` dan `public/storage`  
Jika symlink gagal, buat folder `public/storage` manual dan unggah file ke sana.

## Buat akun admin

**Tidak ada akun demo** demi keamanan. Buat admin sendiri:

**Opsi A — lewat halaman Register** lalu ubah role jadi `admin` di phpMyAdmin (tabel `users`).

**Opsi B — SQL** (ganti email & hash password sendiri):

```sql
-- Buat hash di lokal: php artisan tinker → Hash::make('password_kuat_anda')
INSERT INTO users (name, email, password, role, status, created_at, updated_at)
VALUES (
  'Admin',
  'admin@sekolahanda.sch.id',
  'GANTI_DENGAN_HASH_BCRYPT',
  'admin',
  'aktif',
  NOW(),
  NOW()
);
```

Jika pernah import seeder lama, hapus akun demo dengan `database/HAPUS_AKUN_DEMO.sql`.

## Troubleshooting InfinityFree

| Masalah | Solusi |
|---------|--------|
| 500 Error | APP_KEY kosong / .env salah; set APP_DEBUG=true sementara |
| Halaman putih | Cek storage/logs/laravel.log |
| DB connection | Host InfinityFree biasanya sqlXXX.infinityfree.com, bukan localhost |
| CSS/asset hilang | APP_URL harus https://domain-yang-benar |
| Session error | Buat folder storage/framework/sessions |
| Function/Trigger error | Skip ukk_sql_objects.sql — app tetap jalan via Eloquent |
