<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Perpustakaan Digital')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --brand: #2563eb;
            --brand-2: #0ea5e9;
            --ink: #0f172a;
            --muted: #64748b;
            --bg: #f0f4f8;
            --surface: #ffffff;
            --radius: 1.1rem;
            --shadow: 0 1px 2px rgba(15,23,42,.04), 0 8px 24px rgba(15,23,42,.06);
            --shadow-lg: 0 12px 40px rgba(15,23,42,.12);
        }
        * { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; box-sizing: border-box; }
        body {
            background: var(--bg);
            color: var(--ink);
            min-height: 100vh;
            margin: 0;
            -webkit-font-smoothing: antialiased;
        }
        a { text-decoration: none; }
        .navbar-modern {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%) !important;
            backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255,255,255,.06);
            box-shadow: 0 4px 20px rgba(0,0,0,.15);
        }
        .navbar-brand { font-weight: 800; letter-spacing: -.03em; font-size: 1.15rem; }
        .navbar-brand span { color: #38bdf8; }
        .nav-link { font-weight: 500; font-size: .9rem; border-radius: .5rem; padding: .4rem .75rem !important; }
        .nav-link:hover { background: rgba(255,255,255,.08); }
        .nav-link.active { color: #38bdf8 !important; }
        .btn-brand {
            background: linear-gradient(135deg, var(--brand), var(--brand-2));
            border: none; color: #fff; font-weight: 600;
            box-shadow: 0 4px 14px rgba(37, 99, 235, .35);
            transition: transform .15s, box-shadow .15s, filter .15s;
        }
        .btn-brand:hover { color: #fff; filter: brightness(1.08); transform: translateY(-1px); box-shadow: 0 6px 20px rgba(37,99,235,.4); }
        .btn-brand:active { transform: translateY(0); }
        .card-soft {
            background: var(--surface); border: none; border-radius: var(--radius);
            box-shadow: var(--shadow);
            transition: box-shadow .2s;
        }
        .book-card {
            border: none; border-radius: var(--radius); overflow: hidden;
            background: var(--surface); transition: transform .25s cubic-bezier(.2,.8,.2,1), box-shadow .25s;
            box-shadow: var(--shadow); height: 100%;
        }
        .book-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-lg);
        }
        .book-cover {
            height: 210px; object-fit: cover; width: 100%;
            background: linear-gradient(145deg, #e2e8f0, #f8fafc);
        }
        .badge-soft {
            font-weight: 600; font-size: .7rem; padding: .35em .7em; border-radius: 999px;
        }
        .sidebar {
            width: 250px; min-height: calc(100vh - 56px);
            background: linear-gradient(180deg, #0f172a, #1e293b);
            position: sticky; top: 56px; flex-shrink: 0;
            border-right: 1px solid rgba(255,255,255,.04);
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,.65); border-radius: .85rem;
            padding: .65rem 1rem; margin: 3px 6px; font-size: .88rem; font-weight: 500;
            transition: all .15s;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: #fff; background: rgba(56, 189, 248, .18);
        }
        .sidebar .nav-link i { width: 1.5rem; display: inline-block; opacity: .9; }
        .stat-tile {
            border-radius: var(--radius); background: var(--surface);
            box-shadow: var(--shadow);
            border-left: 4px solid var(--brand);
            transition: transform .15s, box-shadow .15s;
        }
        .stat-tile:hover { transform: translateY(-2px); box-shadow: var(--shadow-lg); }
        .stat-tile.success { border-left-color: #22c55e; }
        .stat-tile.warning { border-left-color: #f59e0b; }
        .stat-tile.danger { border-left-color: #ef4444; }
        .stat-tile.info { border-left-color: #0ea5e9; }
        .search-box {
            border-radius: 999px; border: 1px solid #e2e8f0;
            padding-left: 2.5rem; height: 48px;
            box-shadow: 0 1px 2px rgba(15,23,42,.04);
        }
        .search-box:focus {
            border-color: #93c5fd;
            box-shadow: 0 0 0 4px rgba(37,99,235,.12);
        }
        .search-icon {
            position: absolute; left: .95rem; top: 50%; transform: translateY(-50%);
            color: var(--muted); pointer-events: none;
        }
        .footer-mini {
            border-top: 1px solid #e2e8f0; padding: 1.5rem 0; margin-top: 3rem;
            color: var(--muted); font-size: .85rem;
        }
        .page-wrap { max-width: 1180px; margin: 0 auto; }
        .table { --bs-table-bg: transparent; }
        .table thead th {
            font-size: .75rem; text-transform: uppercase; letter-spacing: .04em;
            color: var(--muted); font-weight: 700; border-bottom-width: 1px;
        }
        .table-hover tbody tr { transition: background .12s; }
        .form-control, .form-select {
            border-radius: .75rem; border-color: #e2e8f0;
            padding: .6rem .9rem;
        }
        .form-control:focus, .form-select:focus {
            border-color: #93c5fd;
            box-shadow: 0 0 0 4px rgba(37,99,235,.12);
        }
        .btn { border-radius: .75rem; font-weight: 600; }
        .btn-sm { border-radius: .6rem; }
        .rounded-pill { font-weight: 600; }
        .alert { border: none; border-radius: var(--radius); box-shadow: var(--shadow); }
        .page-title { font-weight: 800; letter-spacing: -.02em; }
        .section-label {
            font-size: .7rem; font-weight: 700; text-transform: uppercase;
            letter-spacing: .08em; color: var(--muted);
        }
        .empty-state {
            padding: 3rem 1.5rem; text-align: center; color: var(--muted);
        }
        .empty-state i { font-size: 2.5rem; opacity: .4; display: block; margin-bottom: .75rem; }
        main.flex-grow-1 { padding: 1.25rem 1rem 2rem; }
        @media (min-width: 768px) {
            main.flex-grow-1 { padding: 1.75rem 1.75rem 2.5rem; }
        }
        @media (max-width: 767.98px) {
            .sidebar { display: none !important; }
        }
        /* Soft scrollbar */
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 99px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        </style>
    <style>
html[data-theme="dark"] body { background:#0b1220; color:#e2e8f0; }
html[data-theme="dark"] .card-soft, html[data-theme="dark"] .book-card, html[data-theme="dark"] .stat-tile,
html[data-theme="dark"] .service-card, html[data-theme="dark"] .step-card { background:#1e293b; color:#e2e8f0; }
html[data-theme="dark"] .table { color:#e2e8f0; }
html[data-theme="dark"] .table-light { --bs-table-bg:#334155; color:#e2e8f0; }
html[data-theme="dark"] .form-control, html[data-theme="dark"] .form-select { background:#0f172a; color:#e2e8f0; border-color:#334155; }
html[data-theme="dark"] .footer-mini { border-color:#334155; color:#94a3b8; }
html[data-theme="dark"] .text-muted { color:#94a3b8 !important; }
</style>
    <link rel="manifest" href="{{ asset('manifest.webmanifest') }}">
    <meta name="theme-color" content="#0f172a">
    <link rel="stylesheet" href="{{ asset('assets/css/modern.css') }}?v=20260921">
    <style>
      @keyframes perpusNotifPulse { 0%,100%{transform:scale(1)} 50%{transform:scale(1.22)} }
      .notif-pulse { animation: perpusNotifPulse 1.1s ease-in-out infinite; }
    </style>
    @stack('styles')
</head>
<body data-auth="{{ auth()->check() ? 1 : 0 }}" data-staf="{{ (auth()->check() && auth()->user()->isStaf()) ? 1 : 0 }}">
<nav class="navbar navbar-expand-lg navbar-dark navbar-modern sticky-top">
    <div class="container-fluid px-3 px-lg-4">
        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="bi bi-book-half"></i> Perpus<span>Digital</span> <small class="opacity-75 d-none d-lg-inline" style="font-size:.7rem;font-weight:600">SDN 1 Kalidadap</small>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMain">
            <ul class="navbar-nav me-auto ms-lg-3 gap-lg-1">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home','books.*') ? 'active' : '' }}" href="{{ route('books.index') }}">Katalog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('help') }}">Bantuan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contacts.create') }}">Kontak</a>
                </li>
                @auth
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                @endauth
            </ul>
            <div class="d-flex align-items-center gap-2 mt-2 mt-lg-0">
                @auth
                    {{-- Bell notifikasi (semua role: admin / petugas / anggota) --}}
                    <button type="button" id="btnEnablePush" data-push-btn
                      class="btn btn-sm btn-warning rounded-pill px-3 fw-semibold"
                      style="pointer-events:auto;z-index:1050;position:relative;cursor:pointer;"
                      title="Aktifkan notifikasi Chrome"
                      onclick="if(window.enableWebPush){window.enableWebPush();}else{alert('Script push belum termuat. Refresh halaman.');}">
                      <i class="bi bi-bell"></i> Aktifkan Notif
                    </button>
                    <span data-push-ok class="badge text-bg-success d-none">Notif ON</span>
                    <a href="{{ route('notifications.index') }}" class="btn btn-sm btn-outline-light rounded-circle position-relative" title="Notifikasi">
                      <i class="bi bi-bell"></i>
                      <span class="notif-badge position-absolute top-0 start-100 translate-middle badge rounded-pill text-bg-danger d-none" style="font-size:.6rem;">0</span>
                    </a>
                    @if(auth()->user()->isStaf())
                    <a href="{{ route('staff.notifications') }}" class="btn btn-sm btn-outline-warning rounded-circle position-relative d-none d-md-inline-flex" title="Notif Staf">
                      <i class="bi bi-bell-fill"></i>
                      <span class="notif-staf-badge position-absolute top-0 start-100 translate-middle badge rounded-pill text-bg-danger d-none" style="font-size:.6rem;">0</span>
                    </a>
                    @endif
                    <span class="text-white-50 small d-none d-md-inline">{{ auth()->user()->name }}</span>
                    <span class="badge rounded-pill
                        @if(auth()->user()->isAdmin()) text-bg-danger
                        @elseif(auth()->user()->isPetugas()) text-bg-warning text-dark
                        @else text-bg-info @endif">{{ auth()->user()->role }}</span>
                    <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-outline-light rounded-pill" title="Edit profil"><i class="bi bi-person-gear"></i> Profil</a>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">@csrf
                        <button class="btn btn-sm btn-outline-light rounded-pill px-3">Logout</button>
                    </form>
                @else
                    <a href="{{ route('staf.login') }}" class="btn btn-sm btn-outline-info rounded-pill px-3 d-none d-md-inline">Login Staf</a>
                    <a href="{{ route('login') }}" class="btn btn-sm btn-outline-light rounded-pill px-3">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-sm btn-brand rounded-pill px-3">Daftar</a>
                @endauth
                <button type="button" class="btn btn-sm btn-outline-light rounded-circle" onclick="toggleTheme()" title="Mode gelap/terang"><i class="bi bi-moon-stars"></i></button>
                @php try { $wa = \App\Models\Setting::kontakWhatsapp(); } catch (\Throwable $e) { $wa = '6281234567890'; } @endphp
                <a href="https://wa.me/{{ $wa }}" target="_blank" class="btn btn-sm btn-success rounded-pill px-2" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
            </div>
        </div>
    </div>
</nav>

<div class="d-flex">
@auth
<nav class="sidebar d-none d-md-flex flex-column py-3 px-2">
    <div class="px-3 mb-2">
        <small class="text-white-50 text-uppercase" style="font-size:.65rem;letter-spacing:.08em;">
            @if(auth()->user()->isAdmin()) Administrator
            @elseif(auth()->user()->isPetugas()) Meja Sirkulasi
            @else Panel Anggota
            @endif
        </small>
    </div>
    <ul class="nav flex-column px-1">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </li>
        @if(auth()->user()->isAdmin())
            <li class="nav-item mt-2 px-3"><small class="text-white-50 text-uppercase" style="font-size:.65rem;">Master Data</small></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('books.index') }}"><i class="bi bi-book"></i> Kelola Buku</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('categories.index') }}"><i class="bi bi-tags"></i> Kategori</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('users.index', ['role'=>'anggota']) }}"><i class="bi bi-people"></i> Anggota</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('users.index', ['role'=>'petugas']) }}"><i class="bi bi-person-badge"></i> Petugas</a></li>
            <li class="nav-item mt-2 px-3"><small class="text-white-50 text-uppercase" style="font-size:.65rem;">Operasional</small></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('borrowings.index') }}"><i class="bi bi-arrow-left-right"></i> Transaksi</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('reports.index') }}"><i class="bi bi-bar-chart"></i> Laporan</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('profile.edit') }}"><i class="bi bi-person-gear"></i> Edit Profil</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('settings.index') }}"><i class="bi bi-gear"></i> Pengaturan</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('contacts.index') }}"><i class="bi bi-envelope"></i> Pesan Kontak</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('notifications.index') }}"><i class="bi bi-bell"></i> Notifikasi <span class="notif-badge badge rounded-pill text-bg-danger d-none ms-1">0</span></a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('staff.notifications') }}"><i class="bi bi-bell-fill"></i> Notif Staf <span class="notif-staf-badge badge rounded-pill text-bg-danger d-none ms-1">0</span></a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('reports.index') }}"><i class="bi bi-bar-chart"></i> Laporan</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('cleanup.index') }}"><i class="bi bi-trash"></i> Pembersihan</a></li>
        @elseif(auth()->user()->isPetugas())
            <li class="nav-item mt-2 px-3"><small class="text-white-50 text-uppercase" style="font-size:.65rem;">Sirkulasi</small></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('borrowings.index') }}"><i class="bi bi-arrow-left-right"></i> Meja Transaksi</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('borrowings.create') }}"><i class="bi bi-plus-circle"></i> Pinjam Walk-in</a></li>
            <li class="nav-item mt-2 px-3"><small class="text-white-50 text-uppercase" style="font-size:.65rem;">Referensi</small></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('books.index') }}"><i class="bi bi-search"></i> Cari Buku</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('members.index') }}"><i class="bi bi-people"></i> Cari Anggota</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('notifications.index') }}"><i class="bi bi-bell"></i> Notifikasi <span class="notif-badge badge rounded-pill text-bg-danger d-none ms-1">0</span></a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('staff.notifications') }}"><i class="bi bi-bell-fill"></i> Notif Staf <span class="notif-staf-badge badge rounded-pill text-bg-danger d-none ms-1">0</span></a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('reports.index') }}"><i class="bi bi-bar-chart"></i> Laporan</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('profile.edit') }}"><i class="bi bi-person-gear"></i> Edit Profil</a></li>
        @else
            <li class="nav-item mt-2 px-3"><small class="text-white-50 text-uppercase" style="font-size:.65rem;">Layanan</small></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('books.index') }}"><i class="bi bi-search"></i> Katalog</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('borrowings.index') }}"><i class="bi bi-journal-arrow-down"></i> Peminjaman</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('borrowings.index', ['status'=>'dipinjam']) }}"><i class="bi bi-journal-arrow-up"></i> Pengembalian</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('favorites.index') }}"><i class="bi bi-heart"></i> Favorit</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('notifications.index') }}"><i class="bi bi-bell"></i> Notifikasi <span class="notif-badge badge rounded-pill text-bg-danger d-none ms-1">0</span></a></li>
            <li class="nav-item mt-2 px-3"><small class="text-white-50 text-uppercase" style="font-size:.65rem;">Akun</small></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('profile.edit') }}"><i class="bi bi-person-gear"></i> Edit Profil</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('members.kartu.saya') }}" target="_blank"><i class="bi bi-person-vcard"></i> Kartu Anggota</a></li>
        @endif
    </ul>
</nav>
@endauth

<main class="flex-grow-1 {{ auth()->check() ? 'px-3 px-md-4 py-4' : '' }}" style="{{ auth()->check() ? '' : 'padding:0;width:100%;' }}">
    @if(session('success'))
        <div class="{{ auth()->check() ? '' : 'container pt-3' }}">
            <div class="alert alert-success border-0 shadow-sm rounded-3 alert-dismissible fade show">
                <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="{{ auth()->check() ? '' : 'container pt-3' }}">
            <div class="alert alert-danger border-0 shadow-sm rounded-3 alert-dismissible fade show">
                <i class="bi bi-exclamation-triangle-fill me-1"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif
    @if(isset($errors) && $errors->any())
        <div class="{{ auth()->check() ? '' : 'container pt-3' }}">
            <div class="alert alert-danger border-0 shadow-sm rounded-3">
                <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
        </div>
    @endif

    @yield('content')

    <div class="footer-mini {{ auth()->check() ? '' : 'container' }}">
        <div class="text-center">
          <div class="fw-semibold mb-1">Perpustakaan Digital SDN 1 Kalidadap</div>
          <div class="small mb-1"><i class="bi bi-geo-alt"></i> Selopamioro, Imogiri, Bantul, DIY</div>
          <div class="small">
            &copy; 2026 Sistem perpustakaan digital sdn kalidadap 1. All rights reserved by irfan dwi ariyanto XII RPL 2 SMK N 1 Sanden.
          </div>
        </div>
    </div>
</main>
</div>

@auth
<nav class="d-md-none position-fixed bottom-0 start-0 end-0 bg-white border-top shadow-lg" style="z-index:1070;padding:.45rem .35rem calc(.45rem + env(safe-area-inset-bottom));">
  <div class="d-flex justify-content-around text-center">
    <a href="{{ route('dashboard') }}" class="small {{ request()->routeIs('dashboard') ? 'text-primary fw-bold' : 'text-secondary' }}">
      <i class="bi bi-speedometer2 d-block fs-5"></i><span style="font-size:.68rem">Dashboard</span>
    </a>
    <a href="{{ route('books.index') }}" class="small {{ request()->routeIs('books.*') ? 'text-primary fw-bold' : 'text-secondary' }}">
      <i class="bi bi-book d-block fs-5"></i><span style="font-size:.68rem">Katalog</span>
    </a>
    <a href="{{ route('borrowings.index') }}" class="small {{ request()->routeIs('borrowings.*') ? 'text-primary fw-bold' : 'text-secondary' }}">
      <i class="bi bi-arrow-left-right d-block fs-5"></i><span style="font-size:.68rem">Transaksi</span>
    </a>
    <a href="{{ route('notifications.index') }}" class="small position-relative {{ request()->routeIs('notifications.*') ? 'text-primary fw-bold' : 'text-secondary' }}">
      <i class="bi bi-bell d-block fs-5"></i><span style="font-size:.68rem">Notif</span>
      <span class="notif-badge position-absolute top-0 start-50 translate-middle badge rounded-pill text-bg-danger d-none" style="font-size:.55rem">0</span>
    </a>
    <a href="{{ route('favorites.index') }}" class="small {{ request()->routeIs('favorites.*') ? 'text-primary fw-bold' : 'text-secondary' }}">
      <i class="bi bi-heart d-block fs-5"></i><span style="font-size:.68rem">Favorit</span>
    </a>
  </div>
</nav>
@endauth

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
function playNotif(ok) {
  try {
    const ctx = new (window.AudioContext || window.webkitAudioContext)();
    const o = ctx.createOscillator();
    const g = ctx.createGain();
    o.connect(g); g.connect(ctx.destination);
    o.frequency.value = ok ? 880 : 220;
    g.gain.value = 0.08;
    o.start();
    setTimeout(function(){ o.stop(); ctx.close(); }, ok ? 150 : 300);
  } catch(e) {}
}
@if(session('success')) playNotif(true); @endif
@if(session('error')) playNotif(false); @endif
</script>
<script>
function toggleTheme(){
  const html=document.documentElement;
  const next=html.dataset.theme==='dark'?'light':'dark';
  html.dataset.theme=next;
  try{localStorage.setItem('perpus_theme',next);}catch(e){}
  document.querySelectorAll('[title="Mode gelap/terang"] i').forEach(i=>{
    i.className=next==='dark'?'bi bi-sun':'bi bi-moon-stars';
  });
}
(function(){
  try{
    const saved=localStorage.getItem('perpus_theme');
    if(saved==='dark'){
      document.documentElement.dataset.theme='dark';
      document.addEventListener('DOMContentLoaded',function(){
        document.querySelectorAll('[title="Mode gelap/terang"] i').forEach(i=>i.className='bi bi-sun');
      });
    }
  }catch(e){}
})();
</script>
@stack('scripts')
@auth
<script src="/assets/js/webpush.js?v=20260921-20"></script>
<script src="/assets/js/notif-realtime.js?v=20260921-20" defer></script>
@endauth

@auth
{{-- Tombol notif mengambang (selalu bisa diklik) --}}
<button type="button" id="btnFloatingPush" data-push-btn
  class="btn btn-warning rounded-circle shadow-lg"
  style="position:fixed;bottom:24px;right:24px;width:56px;height:56px;z-index:1080;pointer-events:auto;cursor:pointer;"
  title="Aktifkan notifikasi browser"
  onclick="if(window.enableWebPush){window.enableWebPush();}else{alert('Script push belum termuat. Refresh halaman.');}">
  <i class="bi bi-bell-fill fs-5"></i>
</button>
@endauth

</body>
</html>
