<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Anggota · Perpustakaan Digital</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
:root{--brand:#2563eb;--brand2:#0ea5e9}
*{font-family:'Plus Jakarta Sans',system-ui,sans-serif;box-sizing:border-box}
body{margin:0;min-height:100vh;background:#0b1220;color:#0f172a}
.shell{min-height:100vh;display:grid;grid-template-columns:1.1fr 1fr}
@media(max-width:991px){.shell{grid-template-columns:1fr}}
.panel-left{
  position:relative;overflow:hidden;color:#fff;
  background:radial-gradient(1200px 600px at 10% 10%,rgba(56,189,248,.35),transparent 50%),
             radial-gradient(900px 500px at 90% 80%,rgba(37,99,235,.4),transparent 45%),
             linear-gradient(160deg,#0f172a 0%,#1e3a8a 55%,#0c4a6e 100%);
  padding:3rem 2.5rem;display:flex;flex-direction:column;justify-content:space-between;
}
@media(max-width:991px){.panel-left{display:none}}
.brand-mark{display:flex;align-items:center;gap:.75rem;font-weight:800;font-size:1.1rem;letter-spacing:-.02em}
.brand-mark .ico{width:42px;height:42px;border-radius:12px;background:rgba(255,255,255,.12);backdrop-filter:blur(8px);display:grid;place-items:center;font-size:1.25rem}
.hero-copy h1{font-size:clamp(1.8rem,3vw,2.4rem);font-weight:800;letter-spacing:-.03em;line-height:1.15;margin:0 0 1rem}
.hero-copy p{color:rgba(255,255,255,.78);font-size:1rem;max-width:28rem;line-height:1.6;margin:0}
.feature-list{margin-top:2rem;display:grid;gap:.85rem}
.feature-list .item{display:flex;gap:.85rem;align-items:flex-start}
.feature-list .item .dot{width:36px;height:36px;border-radius:10px;background:rgba(255,255,255,.1);display:grid;place-items:center;flex-shrink:0}
.feature-list .item strong{display:block;font-size:.92rem}
.feature-list .item span{font-size:.8rem;color:rgba(255,255,255,.65)}
.panel-right{background:#f8fafc;display:flex;align-items:center;justify-content:center;padding:2rem 1.25rem}
.auth-box{width:100%;max-width:420px;background:#fff;border-radius:1.5rem;padding:2rem 1.75rem;box-shadow:0 4px 6px rgba(15,23,42,.03),0 20px 40px rgba(15,23,42,.06);border:1px solid #e2e8f0}
.auth-box .eyebrow{font-size:.7rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:#64748b;margin-bottom:.35rem}
.auth-box h2{font-weight:800;letter-spacing:-.02em;font-size:1.55rem;margin:0 0 .35rem}
.auth-box .sub{color:#64748b;font-size:.9rem;margin-bottom:1.5rem}
.form-label{font-weight:600;font-size:.85rem;color:#334155;margin-bottom:.35rem}
.form-control{border-radius:.85rem;padding:.8rem 1rem;border:1.5px solid #e2e8f0;font-size:.95rem;transition:.15s}
.form-control:focus{border-color:var(--brand);box-shadow:0 0 0 4px rgba(37,99,235,.12)}
.input-group-icon{position:relative}
.input-group-icon i{position:absolute;left:14px;top:50%;transform:translateY(-50%);color:#94a3b8;font-size:1.05rem;pointer-events:none}
.input-group-icon .form-control{padding-left:2.6rem}
.btn-enter{
  width:100%;border:none;border-radius:.85rem;padding:.9rem 1rem;font-weight:700;font-size:.95rem;color:#fff;
  background:linear-gradient(135deg,var(--brand),var(--brand2));
  box-shadow:0 8px 20px rgba(37,99,235,.3);transition:.2s;
}
.btn-enter:hover{filter:brightness(1.06);transform:translateY(-1px);color:#fff;box-shadow:0 12px 28px rgba(37,99,235,.35)}
.alert-login{border:0;border-radius:1rem;display:flex;gap:10px;align-items:flex-start;background:#fef2f2;color:#991b1b;padding:.85rem 1rem;font-size:.875rem}
.links{display:flex;justify-content:space-between;flex-wrap:wrap;gap:.5rem;margin-top:1.25rem;font-size:.85rem}
.links a{color:#2563eb;font-weight:600;text-decoration:none}
.links a:hover{text-decoration:underline}
.mobile-brand{display:none;text-align:center;margin-bottom:1.25rem}
@media(max-width:991px){.mobile-brand{display:block}.mobile-brand .ico{width:48px;height:48px;border-radius:14px;background:linear-gradient(135deg,#2563eb,#0ea5e9);color:#fff;display:inline-grid;place-items:center;font-size:1.3rem;margin-bottom:.5rem}}
.footer-mini{text-align:center;margin-top:1.5rem;font-size:.75rem;color:#94a3b8}
</style>
</head>
<body>
<div class="shell">
  <div class="panel-left">
    <div class="brand-mark">
      <div class="ico">📚</div>
      <span>Perpustakaan Digital<br><small style="font-weight:500;opacity:.75;font-size:.75rem">SDN 1 Kalidadap</small></span>
    </div>
    <div class="hero-copy">
      <h1>Baca, pinjam, dan jelajahi koleksi sekolahmu.</h1>
      <p>Masuk sebagai anggota untuk mengajukan pinjaman, membaca PDF online, menyimpan favorit, dan melihat riwayat peminjaman.</p>
      <div class="feature-list">
        <div class="item"><div class="dot"><i class="bi bi-journal-bookmark"></i></div><div><strong>Pinjam online</strong><span>Ajukan pinjam kapan saja, ambil di meja petugas</span></div></div>
        <div class="item"><div class="dot"><i class="bi bi-file-earmark-pdf"></i></div><div><strong>Baca PDF</strong><span>Koleksi digital tersedia langsung di browser</span></div></div>
        <div class="item"><div class="dot"><i class="bi bi-bell"></i></div><div><strong>Notifikasi</strong><span>Pengingat jatuh tempo & status pinjaman</span></div></div>
      </div>
    </div>
    <div style="font-size:.8rem;opacity:.55">© {{ date('Y') }} Perpustakaan Digital SDN 1 Kalidadap</div>
  </div>

  <div class="panel-right">
    <div style="width:100%;max-width:420px">
      <div class="mobile-brand">
        <div class="ico">📚</div>
        <div class="fw-bold">Perpustakaan Digital</div>
        <div class="text-muted small">SDN 1 Kalidadap</div>
      </div>
      <div class="auth-box">
        <div class="eyebrow">Area anggota</div>
        <h2>Selamat datang kembali</h2>
        <p class="sub">Masuk dengan email & password akun anggota.</p>

        @if(session('error'))
        <div class="alert-login mb-3" role="alert">
          <i class="bi bi-exclamation-triangle-fill"></i>
          <div><strong>Gagal masuk</strong><div>{{ session('error') }}</div></div>
        </div>
        @endif
        @if($errors->any())
        <div class="alert-login mb-3">
          <i class="bi bi-x-circle-fill"></i>
          <div>@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>
        </div>
        @endif

        <form method="POST" action="{{ url('/login') }}" autocomplete="on">
          @csrf
          <input type="hidden" name="role_expected" value="anggota">
          <div class="mb-3">
            <label class="form-label">Email</label>
            <div class="input-group-icon">
              <i class="bi bi-envelope"></i>
              <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="nama@email.com" required autofocus>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <div class="input-group-icon">
              <i class="bi bi-lock"></i>
              <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>
          </div>
          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="remember" id="remember">
            <label class="form-check-label small text-muted" for="remember">Ingat saya</label>
          </div>
          <button type="submit" class="btn-enter">Masuk sebagai Anggota <i class="bi bi-arrow-right ms-1"></i></button>
        </form>

        <div class="links">
          <a href="{{ route('register') }}">Belum punya akun? Daftar</a>
          <a href="{{ route('home') }}">← Beranda</a>
        </div>
      </div>
      <div class="footer-mini">
        Staf? <a href="{{ route('staf.login') }}" style="color:#64748b;font-weight:600">Login petugas / admin</a>
      </div>
    </div>
  </div>
</div>
</body>
</html>
