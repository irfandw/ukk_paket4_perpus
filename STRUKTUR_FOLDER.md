# Struktur Folder

```
app/
  Http/Controllers/   - Controller utama (Book, Borrowing, User, Report, ...)
  Http/Middleware/    - AdminMiddleware, StafMiddleware
  Models/             - User, Book, Borrowing, Review, Favorite, Setting, ...
database/
  migrations/         - Migrasi tabel
  perpustakaan_digital.sql
  ukk_sql_objects.sql - Function & Trigger
resources/views/      - Blade templates (auth, books, dashboard, ...)
routes/web.php        - Routing aplikasi
public/               - Entry point (index.php)
storage/              - Session, cache, upload cover
docs/                 - Dokumentasi UKK
```
