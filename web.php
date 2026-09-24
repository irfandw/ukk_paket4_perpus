<?php

// Diagnosis cepat (hapus setelah stabil)
Route::get('/cek-sistem', function () {
    $out = [];
    try {
        $out['db'] = \Illuminate\Support\Facades\DB::connection()->getDatabaseName();
        $out['tables'] = \Illuminate\Support\Facades\DB::select('SHOW TABLES');
    } catch (\Throwable $e) {
        $out['db_error'] = $e->getMessage();
    }
    foreach (['pengguna','buku','kategori','transaksi','pengaturan','notifikasi'] as $tbl) {
        try {
            $out['count_'.$tbl] = \Illuminate\Support\Facades\DB::table($tbl)->count();
        } catch (\Throwable $e) {
            $out['count_'.$tbl] = 'ERR: '.$e->getMessage();
        }
    }
    try {
        $u = \App\Models\User::first();
        $out['user_model'] = $u ? ($u->email.' / '.$u->role.' / nama='.$u->name) : 'empty';
    } catch (\Throwable $e) {
        $out['user_model'] = 'ERR: '.$e->getMessage();
    }
    try {
        $b = \App\Models\Book::first();
        $out['book_model'] = $b ? ($b->title.' stok='.$b->stock) : 'empty';
    } catch (\Throwable $e) {
        $out['book_model'] = 'ERR: '.$e->getMessage();
    }
    try {
        $out['setting_wa'] = \App\Models\Setting::kontakWhatsapp();
    } catch (\Throwable $e) {
        $out['setting_wa'] = 'ERR: '.$e->getMessage();
    }
    try {
        $out['dashboard_admin_ok'] = class_exists(\App\Http\Controllers\DashboardController::class);
    } catch (\Throwable $e) {}
    $out['php'] = PHP_VERSION;
    $out['laravel'] = app()->version();
    return response()->json($out, 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
});


use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BacaController;
use App\Http\Controllers\CleanupController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaffNotificationController;
use App\Http\Controllers\PushController;
use App\Http\Controllers\Api\NotificationPollController;
use Illuminate\Support\Facades\Route;

// ===== PUBLIK =====
Route::get('/', [BookController::class, 'index'])->name('home');
Route::get('/katalog', [BookController::class, 'index'])->name('books.index');
Route::get('/katalog/{book}', [BookController::class, 'show'])->name('books.show');
Route::get('/baca/{book}', [BacaController::class, 'show'])->name('books.baca');
Route::get('/baca/{book}/stream', [BacaController::class, 'stream'])->name('books.baca.stream');
Route::get('/bantuan', fn () => view('help'))->name('help');
Route::get('/kontak', [ContactController::class, 'create'])->name('contacts.create');
Route::post('/kontak', [ContactController::class, 'store'])->name('contacts.store');
Route::get('/books', fn () => redirect()->route('books.index'));
Route::get('/books/{book}', fn ($book) => redirect()->route('books.show', $book));

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::get('/login/anggota', [AuthController::class, 'showAnggotaLogin'])->name('login.anggota');
    Route::get('/login/petugas', [AuthController::class, 'showPetugasLogin'])->name('login.petugas');
    Route::get('/login/admin', [AuthController::class, 'showAdminLogin'])->name('login.admin');
    Route::get('/staf-login', [AuthController::class, 'showStafLogin'])->name('staf.login');
    Route::get('/admin-login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Web Push
Route::get('/api/push/vapid', [PushController::class, 'vapid'])->name('push.vapid');
Route::post('/api/push/subscribe', [PushController::class, 'subscribe'])->middleware('auth')->name('push.subscribe');
Route::post('/api/push/test', [PushController::class, 'test'])->middleware('auth')->name('push.test');
Route::get('/api/notifikasi/poll', [NotificationPollController::class, 'anggota'])->middleware('auth')->name('api.notif.poll');
Route::get('/api/notifikasi-staf/poll', [NotificationPollController::class, 'staf'])->middleware('auth')->name('api.notif.staf.poll');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/notifikasi', [NotificationController::class, 'index'])->name('notifications.index');

    Route::match(['get', 'post'], '/katalog/{book}/pinjam', [BorrowingController::class, 'quickBorrow'])->name('books.pinjam');
    // Alternatif aman (hindari 405 di shared hosting)
    Route::post('/pinjam-buku/{book}', [BorrowingController::class, 'quickBorrow'])->name('books.pinjam.alt');

    Route::get('/borrowings', [BorrowingController::class, 'index'])->name('borrowings.index');
    Route::get('/borrowings/create', [BorrowingController::class, 'create'])->name('borrowings.create');
    Route::post('/borrowings', [BorrowingController::class, 'store'])->name('borrowings.store');
    Route::get('/borrowings/{borrowing}', [BorrowingController::class, 'show'])->name('borrowings.show');
    Route::post('/borrowings/{borrowing}/return', [BorrowingController::class, 'requestReturn'])->name('borrowings.return');
    Route::post('/borrowings/{borrowing}/batal', [BorrowingController::class, 'cancelPinjam'])->name('borrowings.cancel');
    Route::get('/borrowings/{borrowing}/cetak', [BorrowingController::class, 'printSlip'])->name('borrowings.print');

    Route::post('/katalog/{book}/ulasan', [ReviewController::class, 'store'])->name('reviews.store');
    Route::delete('/ulasan/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    Route::get('/favorit', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/katalog/{book}/favorit', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
    Route::get('/kartu-saya', [MemberController::class, 'kartuSaya'])->name('members.kartu.saya');
    Route::get('/profil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profil', [ProfileController::class, 'update'])->name('profile.update');

    Route::middleware('staf')->group(function () {
        Route::post('/borrowings/{borrowing}/verify', [BorrowingController::class, 'verifyReturn'])->name('borrowings.verify');
        Route::post('/borrowings/{borrowing}/perpanjang', [BorrowingController::class, 'extend'])->name('borrowings.extend');
        Route::post('/borrowings/{borrowing}/denda-lunas', [BorrowingController::class, 'payFine'])->name('borrowings.payFine');
        Route::post('/borrowings/{borrowing}/setujui-pinjam', [BorrowingController::class, 'approvePinjam'])->name('borrowings.approvePinjam');
        Route::post('/borrowings/{borrowing}/tolak-pinjam', [BorrowingController::class, 'rejectPinjam'])->name('borrowings.rejectPinjam');
        Route::post('/borrowings/{borrowing}/ingatkan', [BorrowingController::class, 'remind'])->name('borrowings.remind');
        Route::get('/anggota-cari', [MemberController::class, 'index'])->name('members.index');
        Route::get('/anggota-kartu', [MemberController::class, 'kartu'])->name('members.kartu');
        Route::get('/anggota-kartu/{id}', [MemberController::class, 'kartu'])->name('members.kartu.id')->whereNumber('id');
        Route::get('/notifikasi-staf', [StaffNotificationController::class, 'index'])->name('staff.notifications');
        Route::get('/laporan', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/laporan/cetak', [ReportController::class, 'print'])->name('reports.print');
        Route::get('/laporan/export', [ReportController::class, 'export'])->name('reports.export');
    });

    Route::middleware('admin')->group(function () {
        Route::resource('categories', CategoryController::class)->except(['show']);
        Route::get('/books-create', [BookController::class, 'create'])->name('books.create');
        Route::post('/books', [BookController::class, 'store'])->name('books.store');
        Route::get('/katalog/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
        Route::put('/katalog/{book}', [BookController::class, 'update'])->name('books.update');
        Route::delete('/katalog/{book}', [BookController::class, 'destroy'])->name('books.destroy');
        Route::resource('users', UserController::class)->except(['show']);
        Route::get('/pengaturan', [SettingController::class, 'index'])->name('settings.index');
        Route::post('/pengaturan', [SettingController::class, 'update'])->name('settings.update');
        Route::get('/pesan-kontak', [ContactController::class, 'index'])->name('contacts.index');
        Route::get('/pesan-kontak/{contact}', [ContactController::class, 'show'])->name('contacts.show');
        Route::post('/pesan-kontak/{contact}/balas', [ContactController::class, 'reply'])->name('contacts.reply');
        Route::get('/pembersihan', [CleanupController::class, 'index'])->name('cleanup.index');
        Route::post('/pembersihan', [CleanupController::class, 'run'])->name('cleanup.run');
    });
});
