@extends('layouts.app')
@section('title', 'Katalog - Perpustakaan Digital')

@push('styles')
<style>
@guest
.home-wrap { width: 100%; margin: 0; }
.home-marquee {
  background: linear-gradient(90deg, #020617, #1e3a8a, #0c4a6e, #1e3a8a, #020617);
  color: #e0e7ff; overflow: hidden; white-space: nowrap;
  font-size: 13px; font-weight: 600; width: 100%;
  border-bottom: 1px solid rgba(255,255,255,.08);
}
.home-marquee-track {
  display: inline-block; padding: 11px 0;
  animation: hm 36s linear infinite;
}
.home-marquee-track span { margin: 0 2.2rem; display: inline-block; }
.home-marquee-track b { color: #fde68a; }
@keyframes hm { 0%{transform:translateX(0)} 100%{transform:translateX(-50%)} }

.hero-video {
  position: relative; width: 100%; min-height: 480px;
  display: flex; align-items: center; justify-content: center;
  background: #020617; color: #fff; overflow: hidden;
}
.hero-video::before {
  content: ''; position: absolute; inset: 0; z-index: 1;
  background:
    radial-gradient(ellipse 80% 60% at 20% 40%, rgba(37,99,235,.45), transparent 55%),
    radial-gradient(ellipse 70% 50% at 80% 20%, rgba(14,165,233,.35), transparent 50%),
    radial-gradient(ellipse 60% 40% at 60% 90%, rgba(99,102,241,.25), transparent 45%);
  pointer-events: none;
}
.hero-video video {
  position: absolute; inset: 0; width: 100%; height: 100%;
  object-fit: cover; z-index: 0; opacity: .35;
}
.hero-video .overlay {
  position: absolute; inset: 0; z-index: 1;
  background: linear-gradient(180deg, rgba(2,6,23,.55), rgba(2,6,23,.4) 40%, rgba(2,6,23,.92));
}
.hero-video .inner {
  position: relative; z-index: 2; text-align: center;
  padding: 3rem 1.25rem 3.5rem; max-width: 820px; margin: 0 auto; width: 100%;
}
.hero-video .badge-pill {
  display: inline-flex; align-items: center; gap: 6px;
  background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.2);
  border-radius: 999px; padding: .4rem 1.1rem; font-size: 12px; font-weight: 600; margin-bottom: 1.1rem;
  backdrop-filter: blur(8px);
}
.hero-video h1 {
  font-size: clamp(1.75rem, 4.5vw, 2.75rem); font-weight: 800;
  letter-spacing: -.035em; margin: 0 0 .85rem; line-height: 1.15;
}
.hero-video .lead { color: rgba(255,255,255,.88); font-size: 1.02rem; margin: 0 auto 1.5rem; max-width: 36rem; line-height: 1.55; }
.hero-stats {
  display: grid; grid-template-columns: repeat(3, minmax(0,1fr));
  gap: 10px; max-width: 720px; margin: 0 auto 1.75rem;
}
@media (min-width: 768px) {
  .hero-stats { grid-template-columns: repeat(6, minmax(0,1fr)); max-width: 960px; }
}
.hero-stats > div {
  background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.14);
  border-radius: 14px; padding: 14px 8px; backdrop-filter: blur(6px);
  transition: .2s;
}
.hero-stats > div:hover { background: rgba(255,255,255,.14); transform: translateY(-2px); }
.hero-stats strong { display: block; font-size: 1.35rem; font-weight: 800; letter-spacing: -.02em; }
.hero-stats span { font-size: 11px; opacity: .85; }
.hero-cta { display: flex; flex-wrap: wrap; gap: 12px; justify-content: center; }
.hero-cta a {
  display: inline-flex; align-items: center; gap: 8px;
  padding: 13px 24px; border-radius: 999px; font-weight: 700;
  font-size: 14px; text-decoration: none; transition: .2s;
}
.hero-cta .primary {
  background: linear-gradient(135deg, #2563eb, #0ea5e9); color: #fff;
  box-shadow: 0 8px 28px rgba(37,99,235,.45);
}
.hero-cta .primary:hover { filter: brightness(1.08); transform: translateY(-2px); color: #fff; }
.hero-cta .ghost {
  background: rgba(255,255,255,.08); color: #fff; border: 1px solid rgba(255,255,255,.25);
}
.hero-cta .ghost:hover { background: rgba(255,255,255,.16); color: #fff; }

.home-body { background: #f1f5f9; }
.home-inner { max-width: 1140px; margin: 0 auto; padding: 2rem 1rem 3rem; }

.section-head {
  display: flex; flex-wrap: wrap; justify-content: space-between; align-items: end;
  gap: .75rem; margin-bottom: 1.15rem;
}
.section-head h5 { font-weight: 800; letter-spacing: -.02em; margin: 0; font-size: 1.2rem; }
.section-head .sub { color: #64748b; font-size: .85rem; margin: .2rem 0 0; }

.service-grid {
  display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px; margin-bottom: 2rem;
}
@media (min-width: 768px) { .service-grid { grid-template-columns: repeat(4, 1fr); } }
.service-card {
  background: #fff; border: 1px solid #e2e8f0; border-radius: 1.1rem;
  padding: 1.15rem 1rem; text-decoration: none; color: inherit;
  transition: .2s; display: block; height: 100%;
  box-shadow: 0 1px 2px rgba(15,23,42,.04);
}
.service-card:hover {
  transform: translateY(-3px); box-shadow: 0 12px 28px rgba(15,23,42,.1);
  border-color: #bfdbfe; color: inherit;
}
.service-card .ico {
  width: 44px; height: 44px; border-radius: 12px; display: grid; place-items: center;
  font-size: 1.2rem; margin-bottom: .75rem;
}
.service-card:nth-child(1) .ico { background: #dbeafe; color: #1d4ed8; }
.service-card:nth-child(2) .ico { background: #dcfce7; color: #15803d; }
.service-card:nth-child(3) .ico { background: #fef3c7; color: #b45309; }
.service-card:nth-child(4) .ico { background: #f3e8ff; color: #7e22ce; }
.service-card h3 { font-size: .95rem; font-weight: 700; margin: 0 0 .25rem; }
.service-card p { font-size: .8rem; color: #64748b; margin: 0; }

.home-featured {
  background: linear-gradient(135deg, #fff 0%, #eff6ff 100%);
  border: 1px solid #bfdbfe; border-radius: 1.25rem; padding: 1.25rem;
  box-shadow: 0 4px 20px rgba(37,99,235,.08);
}
.chip-row { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 1.5rem; }
.chip {
  display: inline-flex; align-items: center; gap: 4px;
  padding: .4rem .9rem; border-radius: 999px; font-size: .8rem; font-weight: 600;
  background: #fff; border: 1px solid #e2e8f0; color: #334155; text-decoration: none;
  transition: .15s;
}
.chip:hover, .chip.active { background: #2563eb; color: #fff; border-color: #2563eb; }

.spark-box {
  background: #fff; border: 1px solid #e2e8f0; border-radius: 1.1rem; padding: 1rem 1.15rem;
  margin-bottom: 1.5rem;
}
@endguest

/* Katalog cards denser */
.book-card {
  border: 1px solid #e2e8f0; border-radius: 1rem; overflow: hidden; background: #fff;
  transition: .2s; height: 100%; display: flex; flex-direction: column;
  box-shadow: 0 1px 3px rgba(15,23,42,.04);
}
.book-card:hover {
  transform: translateY(-4px); box-shadow: 0 14px 32px rgba(15,23,42,.12);
  border-color: #bfdbfe;
}
.book-card .cover-wrap {
  aspect-ratio: 3/4; background: linear-gradient(145deg, #f1f5f9, #e2e8f0);
  position: relative; overflow: hidden;
}
.book-card .cover-wrap img { width: 100%; height: 100%; object-fit: cover; }
.book-card .badge-stok {
  position: absolute; top: 8px; left: 8px; font-size: 10px; font-weight: 700;
  padding: 3px 8px; border-radius: 6px; backdrop-filter: blur(6px);
}
</style>
@endpush


@section('content')

{{-- ========== PUBLIK (belum login) ========== --}}
@guest
<div class="home-wrap">
  <div class="home-marquee">
    <div class="home-marquee-track">
      <span>📚 <b>Perpustakaan Digital SDN 1 Kalidadap</b></span>
      <span>Selopamioro · Imogiri · Bantul · DIY</span>
      <span>Katalog <b>tanpa login</b></span>
      <span>Pinjam online · Verifikasi petugas</span>
      <span>Gratis untuk siswa SDN 1 Kalidadap</span>
      <span>📚 <b>Perpustakaan Digital SDN 1 Kalidadap</b></span>
      <span>Selopamioro · Imogiri · Bantul · DIY</span>
      <span>Katalog <b>tanpa login</b></span>
      <span>Pinjam online · Verifikasi petugas</span>
      <span>Gratis untuk siswa SDN 1 Kalidadap</span>
    </div>
  </div>

  <section class="hero-video">
    <video autoplay muted loop playsinline preload="metadata" id="heroVid">
      <source src="{{ asset('assets/video/rak_buku.mp4') }}" type="video/mp4">
    </video>
    <div class="overlay"></div>
    <div class="inner">
      <div class="badge-pill">✨ Portal perpustakaan digital · 24/7</div>
      <h1>Perpustakaan digital modern untuk siswa SDN 1 Kalidadap</h1>
      <p class="lead">Cari &amp; lihat koleksi <strong>tanpa login</strong>. Pinjam online untuk siswa. Selopamioro, Imogiri, Bantul.</p>
      <div class="hero-stats">
        <div><strong>{{ number_format($totalBuku ?? 0) }}</strong><span>Judul buku</span></div>
        <div><strong>{{ number_format($totalAnggota ?? 0) }}</strong><span>Anggota</span></div>
        <div><strong>{{ number_format($totalPinjam ?? 0) }}</strong><span>Total pinjam</span></div>
        <div><strong>{{ number_format($pinjamAktif ?? 0) }}</strong><span>Sedang dipinjam</span></div>
        <div><strong>{{ number_format($pengunjungHari ?? 0) }}</strong><span>Pengunjung hari ini</span></div>
        <div><strong>{{ number_format($pengunjungTotal ?? 0) }}</strong><span>Total pengunjung</span></div>
      </div>
      <p class="small mb-3" style="opacity:.9"><i class="bi bi-geo-alt-fill"></i> SDN 1 Kalidadap, Selopamioro, Imogiri, Bantul, DIY · Buka 24/7 katalog daring</p>
      <div class="hero-cta">
        <a class="primary" href="#katalog"><i class="bi bi-search"></i> Jelajahi katalog</a>
        <a class="ghost" href="{{ route('register') }}"><i class="bi bi-person-plus"></i> Daftar anggota</a>
        <a class="ghost" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right"></i> Masuk</a>
      </div>
    </div>
  </section>

  <div class="home-body">
    <div class="home-inner">
      <div class="section-head">
        <div>
          <h5>Layanan digital</h5>
          <p class="sub">Semua fitur perpustakaan sekolah dalam satu portal</p>
        </div>
      </div>
      <div class="service-grid">
        <a class="service-card" href="#katalog"><div class="ico"><i class="bi bi-journal-bookmark-fill"></i></div><h3>Katalog online</h3><p>Jelajahi seluruh koleksi</p></a>
        <a class="service-card" href="{{ route('login') }}"><div class="ico"><i class="bi bi-phone"></i></div><h3>Pinjam online</h3><p>Ajukan tanpa antri</p></a>
        <a class="service-card" href="{{ route('register') }}"><div class="ico"><i class="bi bi-person-plus-fill"></i></div><h3>Daftar anggota</h3><p>Akun gratis untuk siswa</p></a>
        <a class="service-card" href="{{ route('help') }}"><div class="ico"><i class="bi bi-lightning-charge-fill"></i></div><h3>Bantuan cepat</h3><p>Panduan & FAQ</p></a>
      </div>

      @if(($categories ?? collect())->count())
      <div class="section-head mt-2">
        <div>
          <h5>Kategori koleksi</h5>
          <p class="sub">Filter cepat berdasarkan kategori buku</p>
        </div>
      </div>
      <div class="chip-row">
        <a href="{{ route('home') }}#katalog" class="chip {{ !request('category') ? 'active' : '' }}">Semua</a>
        @foreach($categories->take(12) as $cat)
          <a href="{{ route('home', ['category' => $cat->id]) }}#katalog" class="chip {{ request('category') == $cat->id ? 'active' : '' }}">{{ $cat->name ?? $cat->nama }}</a>
        @endforeach
      </div>
      @endif

      <div class="section-head">
        <div>
          <h5>Cara memakai</h5>
          <p class="sub">Empat langkah sederhana</p>
        </div>
      </div>
      <div class="steps-grid mb-4" style="display:grid;grid-template-columns:repeat(2,1fr);gap:12px;">
        <div class="step-card" style="background:#fff;border:1px solid #e2e8f0;border-radius:1rem;padding:1rem;display:flex;gap:12px;align-items:flex-start;">
          <div class="step-num" style="width:32px;height:32px;border-radius:10px;background:#2563eb;color:#fff;font-weight:800;display:grid;place-items:center;flex-shrink:0;">1</div>
          <div><h3 style="font-size:.95rem;font-weight:700;margin:0 0 2px">Daftar / Masuk</h3><p style="font-size:.8rem;color:#64748b;margin:0">Buat akun anggota gratis</p></div>
        </div>
        <div class="step-card" style="background:#fff;border:1px solid #e2e8f0;border-radius:1rem;padding:1rem;display:flex;gap:12px;align-items:flex-start;">
          <div class="step-num" style="width:32px;height:32px;border-radius:10px;background:#0ea5e9;color:#fff;font-weight:800;display:grid;place-items:center;flex-shrink:0;">2</div>
          <div><h3 style="font-size:.95rem;font-weight:700;margin:0 0 2px">Cari buku</h3><p style="font-size:.8rem;color:#64748b;margin:0">Pilih dari katalog</p></div>
        </div>
        <div class="step-card" style="background:#fff;border:1px solid #e2e8f0;border-radius:1rem;padding:1rem;display:flex;gap:12px;align-items:flex-start;">
          <div class="step-num" style="width:32px;height:32px;border-radius:10px;background:#8b5cf6;color:#fff;font-weight:800;display:grid;place-items:center;flex-shrink:0;">3</div>
          <div><h3 style="font-size:.95rem;font-weight:700;margin:0 0 2px">Ajukan pinjam</h3><p style="font-size:.8rem;color:#64748b;margin:0">Petugas menyetujui</p></div>
        </div>
        <div class="step-card" style="background:#fff;border:1px solid #e2e8f0;border-radius:1rem;padding:1rem;display:flex;gap:12px;align-items:flex-start;">
          <div class="step-num" style="width:32px;height:32px;border-radius:10px;background:#10b981;color:#fff;font-weight:800;display:grid;place-items:center;flex-shrink:0;">4</div>
          <div><h3 style="font-size:.95rem;font-weight:700;margin:0 0 2px">Kembalikan</h3><p style="font-size:.8rem;color:#64748b;margin:0">Ajukan lewat aplikasi</p></div>
        </div>
      </div>
      <style>@media(min-width:768px){.steps-grid{grid-template-columns:repeat(4,1fr)!important}}</style>

      {{-- Buku unggulan --}}
      @if($featured ?? null)
      <div class="home-featured mt-4 mb-4">
        <div class="d-flex flex-wrap align-items-center gap-3 p-3 rounded-4" style="background:linear-gradient(135deg,#eff6ff,#f8fafc);border:1px solid #e2e8f0;">
          <div class="home-featured-cover" style="width:110px;flex-shrink:0;">
            @if($featured->cover)
              <img src="{{ $featured->coverUrl() }}" alt="" class="rounded-3 shadow-sm" style="width:100%;aspect-ratio:3/4;object-fit:cover;">
            @else
              <div class="rounded-3 d-flex align-items-center justify-content-center bg-white border" style="width:100%;aspect-ratio:3/4;">
                <i class="bi bi-book text-muted" style="font-size:2rem;"></i>
              </div>
            @endif
          </div>
          <div class="flex-grow-1">
            <span class="badge text-bg-warning mb-1">⭐ Buku unggulan</span>
            <h3 class="h5 fw-bold mb-1"><a href="{{ route('books.show', $featured) }}" class="text-decoration-none text-dark">{{ $featured->title }}</a></h3>
            <p class="small text-muted mb-2">{{ $featured->author }} · {{ $featured->category->name ?? '-' }}</p>
            <p class="small mb-2">{{ Str::limit($featured->description ?? 'Koleksi populer di perpustakaan.', 120) }}</p>
            <a href="{{ route('books.show', $featured) }}" class="btn btn-sm btn-brand rounded-pill">Lihat detail</a>
          </div>
        </div>
      </div>
      @endif

      {{-- Statistik & grafik (gaya dashboard perpustakaan modern) --}}
      <div class="section-head mb-2">
        <div>
          <h5>Statistik perpustakaan</h5>
          <p class="sub">Pengunjung, peminjaman & pengembalian — 7 hari terakhir</p>
        </div>
      </div>
      <div class="row g-2 mb-3">
        <div class="col-6 col-md-3">
          <div class="p-3 rounded-3 border bg-white h-100">
            <div class="small text-muted">Pengunjung hari ini</div>
            <div class="fs-3 fw-bold text-primary">{{ number_format($pengunjungHari ?? 0) }}</div>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="p-3 rounded-3 border bg-white h-100">
            <div class="small text-muted">Pinjam hari ini</div>
            <div class="fs-3 fw-bold" style="color:#2563eb">{{ number_format($pinjamHariIni ?? 0) }}</div>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="p-3 rounded-3 border bg-white h-100">
            <div class="small text-muted">Kembali hari ini</div>
            <div class="fs-3 fw-bold text-success">{{ number_format($kembaliHariIni ?? 0) }}</div>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="p-3 rounded-3 border bg-white h-100">
            <div class="small text-muted">Sedang dipinjam</div>
            <div class="fs-3 fw-bold text-warning">{{ number_format($pinjamAktif ?? 0) }}</div>
          </div>
        </div>
      </div>
      <div class="row g-3 mb-4">
        <div class="col-lg-8">
          <div class="p-3 rounded-4 border bg-white h-100">
            <div class="d-flex justify-content-between align-items-center mb-2">
              <h6 class="fw-bold mb-0">Pinjam vs Kembali (7 hari)</h6>
              <span class="small text-muted">{{ array_sum($sparkPinjam ?? []) }} pinjam · {{ array_sum($sparkKembali ?? []) }} kembali</span>
            </div>
            <canvas id="chartHomeAktivitas" height="120"></canvas>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="p-3 rounded-4 border bg-white h-100">
            <h6 class="fw-bold mb-2">Pengunjung 7 hari</h6>
            <canvas id="chartHomeVisit" height="120"></canvas>
            <div class="small text-muted mt-2 text-center">Total kunjungan: <strong>{{ number_format($pengunjungTotal ?? 0) }}</strong></div>
          </div>
        </div>
      </div>

      {{-- Ulasan terbaru --}}
      @if(($ulasanTerbaru ?? collect())->count())
      <div class="mb-4">
        <h5 class="fw-bold mb-2">💬 Ulasan pembaca</h5>
        <div class="row g-2">
          @foreach($ulasanTerbaru as $u)
          <div class="col-md-6">
            <div class="p-3 rounded-3 border bg-white h-100">
              <div class="d-flex justify-content-between small mb-1">
                <strong>{{ $u->user->name ?? 'Anggota' }}</strong>
                <span class="text-warning">{{ str_repeat('★', (int)$u->rating) }}{{ str_repeat('☆', 5-(int)$u->rating) }}</span>
              </div>
              <p class="small mb-1 text-muted">{{ Str::limit($u->comment ?? '', 80) }}</p>
              @if($u->book)
              <a href="{{ route('books.show', $u->book) }}" class="small text-decoration-none">{{ Str::limit($u->book->title, 35) }}</a>
              @endif
            </div>
          </div>
          @endforeach
        </div>
      </div>
      @endif

      {{-- Tips --}}
      <div class="mb-4 p-3 rounded-4" style="background:#fefce8;border:1px solid #fde68a;">
        <h6 class="fw-bold mb-2">💡 Tips & info penting</h6>
        <ul class="small mb-0 ps-3">
          <li>Pinjam online → tunggu persetujuan petugas sebelum ambil buku fisik.</li>
          <li>Kembalikan tepat waktu agar tidak kena denda keterlambatan.</li>
          <li>Buku bertanda PDF bisa dibaca online tanpa meminjam fisik.</li>
          <li>Butuh bantuan? Buka halaman <a href="{{ route('help') }}">Bantuan</a> atau hubungi admin.</li>
        </ul>
      </div>
@endguest

{{-- ========== KATALOG (semua: guest di dalam home-inner, auth di panel) ========== --}}
@auth
<div class="katalog-head d-flex flex-wrap justify-content-between align-items-start gap-2">
  <div>
    <h4>
      @if(auth()->user()->isAdmin()) Kelola Buku
      @elseif(auth()->user()->isPetugas()) Cari Buku
      @else Katalog Buku
      @endif
    </h4>
    <p>
      @if(auth()->user()->isAdmin()) Tambah, edit, dan kelola koleksi
      @elseif(auth()->user()->isPetugas()) Cari buku untuk pelayanan meja
      @else Temukan dan ajukan pinjam
      @endif
    </p>
  </div>
  @if(auth()->user()->isAdmin())
  <a href="{{ route('books.create') }}" class="btn btn-brand rounded-pill btn-sm">
    <i class="bi bi-plus-lg"></i> Tambah Buku
  </a>
  @endif
</div>
@endauth

@guest
      <div id="katalog" class="mb-3">
        <h5 class="fw-bold mb-0">Katalog Buku</h5>
        <small class="text-muted">Temukan koleksi favoritmu</small>
      </div>
@endguest

<div class="card-soft p-3 mb-4">
  <form method="GET" action="{{ route('books.index') }}">
    <div class="row g-2 align-items-center">
      <div class="col-md-6 position-relative">
        <i class="bi bi-search search-icon"></i>
        <input type="text" name="search" class="form-control search-box"
               placeholder="Cari judul, penulis, ISBN..." value="{{ request('search') }}">
      </div>
      <div class="col-md-4">
        <select name="category" class="form-select rounded-pill" style="height:46px;">
          <option value="">Semua Kategori</option>
          @foreach($categories as $cat)
          <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-2">
        <button class="btn btn-brand w-100 rounded-pill" style="height:46px;">Cari</button>
      </div>
    </div>
  </form>
</div>

<div class="row g-3">
  @forelse($books as $book)
  <div class="col-6 col-md-4 col-xl-3">
    <div class="book-card">
      <a href="{{ route('books.show', $book) }}" class="text-decoration-none text-dark">
        @if($book->cover)
          <img src="{{ $book->coverUrl() }}" class="book-cover" alt="">
        @else
          <div class="book-cover d-flex align-items-center justify-content-center">
            <i class="bi bi-book" style="font-size:2.5rem;color:#94a3b8;"></i>
          </div>
        @endif
        <div class="p-3">
          <h6 class="fw-bold mb-1" style="font-size:.9rem;min-height:2.4em;line-height:1.3;">
            {{ Str::limit($book->title, 45) }}
          </h6>
          <p class="small text-muted mb-1">{{ $book->author }}</p>
          @if(($book->reviews_avg_rating ?? null))
            <div class="small text-warning mb-2" style="letter-spacing:1px;">
              {{ str_repeat('★', (int)round($book->reviews_avg_rating)) }}{{ str_repeat('☆', 5-(int)round($book->reviews_avg_rating)) }}
              <span class="text-muted">{{ number_format($book->reviews_avg_rating, 1) }}</span>
            </div>
          @else
            <div class="small text-muted mb-2">Belum ada rating</div>
          @endif
          <div class="d-flex flex-wrap gap-1">
            <span class="badge badge-soft text-bg-light text-secondary">{{ $book->category->name ?? '-' }}</span>
            @if($book->available > 0)
              <span class="badge badge-soft text-bg-success">{{ $book->available }} tersedia</span>
            @else
              <span class="badge badge-soft text-bg-danger">Habis</span>
            @endif
            @if(!empty($book->kondisi))
              <span class="badge badge-soft {{ $book->kondisiBadgeClass() }}">{{ $book->kondisi }}</span>
            @endif
            @if($book->hasPdf())
              <a href="{{ route('books.baca', $book) }}" class="badge badge-soft text-bg-danger text-decoration-none" title="Baca PDF"><i class="bi bi-file-earmark-pdf"></i> PDF</a>
            @endif
          </div>
          @if(!empty($book->keterangan_kondisi))
            <div class="small text-danger mt-1" style="font-size:.75rem;line-height:1.3;">
              <i class="bi bi-exclamation-triangle"></i> {{ Str::limit($book->keterangan_kondisi, 60) }}
            </div>
          @endif
        </div>
      </a>
      <div class="px-3 pb-3">
        @auth
          @if(auth()->user()->isAdmin())
            <div class="d-grid gap-1">
              <a href="{{ route('books.show', $book) }}" class="btn btn-outline-primary btn-sm rounded-pill">Detail</a>
              <a href="{{ route('books.edit', $book) }}" class="btn btn-brand btn-sm rounded-pill">Edit</a>
            </div>
          @elseif(auth()->user()->isPetugas())
            <a href="{{ route('books.show', $book) }}" class="btn btn-outline-primary btn-sm w-100 rounded-pill">Lihat Detail</a>
          @else
            @if($book->isAvailable())
              <a href="{{ route('books.show', $book) }}" class="btn btn-brand btn-sm w-100 rounded-pill">Ajukan Pinjam</a>
            @else
              <button class="btn btn-outline-secondary btn-sm w-100 rounded-pill" disabled>Tidak Tersedia</button>
            @endif
          @endif
        @else
          @if($book->isAvailable())
            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm w-100 rounded-pill">Login untuk Pinjam</a>
          @else
            <button class="btn btn-outline-secondary btn-sm w-100 rounded-pill" disabled>Tidak Tersedia</button>
          @endif
        @endauth
      </div>
    </div>
  </div>
  @empty
  <div class="col-12">
    <div class="card-soft text-center py-5 text-muted">Tidak ada buku ditemukan.</div>
  </div>
  @endforelse
</div>

@if($books->hasPages())
<div class="mt-4 d-flex justify-content-center">{{ $books->links() }}</div>
@endif

@guest
    </div>{{-- home-inner --}}
  </div>{{-- home-body --}}
</div>{{-- home-wrap --}}
@endguest

@endsection

@push('scripts')
@guest
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
(function(){
  var v = document.getElementById('heroVid');
  if (v) {
    v.muted = true;
    var play = function(){ var p = v.play(); if (p && p.catch) p.catch(function(){}); };
    play();
    document.addEventListener('click', play, { once: true });
  }
  var labels = @json($sparkLabels ?? []);
  var pinjam = @json($sparkPinjam ?? []);
  var kembali = @json($sparkKembali ?? []);
  var visit = @json($sparkPengunjung ?? []);
  if (document.getElementById('chartHomeAktivitas') && window.Chart) {
    new Chart(document.getElementById('chartHomeAktivitas'), {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [
          { label: 'Pinjam', data: pinjam, backgroundColor: 'rgba(37,99,235,.75)', borderRadius: 6 },
          { label: 'Kembali', data: kembali, backgroundColor: 'rgba(16,185,129,.75)', borderRadius: 6 }
        ]
      },
      options: {
        responsive: true,
        plugins: { legend: { position: 'bottom' } },
        scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
      }
    });
  }
  if (document.getElementById('chartHomeVisit') && window.Chart) {
    new Chart(document.getElementById('chartHomeVisit'), {
      type: 'line',
      data: {
        labels: labels,
        datasets: [{
          label: 'Pengunjung',
          data: visit,
          borderColor: '#0ea5e9',
          backgroundColor: 'rgba(14,165,233,.15)',
          fill: true,
          tension: .35,
          pointRadius: 3
        }]
      },
      options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
      }
    });
  }
})();
</script>
@endguest
@endpush
