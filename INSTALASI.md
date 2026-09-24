# Cara Instalasi (Localhost XAMPP)

1. Extract project ke `C:\xampp\htdocs\perpustakaan-digital`
2. Pastikan XAMPP Apache + MySQL aktif
3. `composer update` (jika folder vendor belum ada)
4. `copy .env.example .env` lalu `php artisan key:generate`
5. Buat folder:
   - storage\framework\sessions
   - storage\framework\views
   - storage\framework\cache\data
   - storage\logs
6. Import `database/INSTALL_LENGKAP.sql` via phpMyAdmin
7. (Opsional UKK) Import `database/ukk_sql_objects.sql`
8. `php artisan storage:link`
9. `php artisan serve` → http://localhost:8000

Buat akun admin sendiri lewat database atau seeder sesuai kebutuhan.
