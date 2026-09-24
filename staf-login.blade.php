<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Petugas · Perpustakaan Digital</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
*{font-family:'Plus Jakarta Sans',system-ui,sans-serif;box-sizing:border-box}
body{
  margin:0;min-height:100vh;color:#e2e8f0;
  background:
    radial-gradient(900px 500px at 15% 10%, rgba(245,158,11,.12), transparent 50%),
    radial-gradient(800px 480px at 90% 90%, rgba(37,99,235,.15), transparent 45%),
    #0b1220;
  display:flex;align-items:center;justify-content:center;padding:1.5rem;
}
.card-auth{
  width:100%;max-width:420px;background:rgba(15,23,42,.85);
  border:1px solid rgba(148,163,184,.15);border-radius:1.5rem;
  padding:2rem 1.75rem;backdrop-filter:blur(16px);
  box-shadow:0 25px 50px rgba(0,0,0,.45);
}
.badge-role{
  display:inline-flex;align-items:center;gap:.4rem;
  background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);
  border-radius:999px;padding:.3rem .75rem;font-size:.7rem;font-weight:700;
  letter-spacing:.06em;text-transform:uppercase;color:#94a3b8;margin-bottom:1rem;
}
.badge-role i{color:#f59e0b}
h1{font-size:1.55rem;font-weight:800;letter-spacing:-.02em;margin:0 0 .4rem;color:#f8fafc}
.sub{color:#94a3b8;font-size:.9rem;margin-bottom:1.5rem}
.form-label{font-weight:600;font-size:.82rem;color:#cbd5e1;margin-bottom:.35rem}
.form-control{
  background:#0f172a;border:1.5px solid #1e293b;color:#f1f5f9;
  border-radius:.85rem;padding:.8rem 1rem;font-size:.95rem;
}
.form-control:focus{background:#0f172a;border-color:#f59e0b;box-shadow:0 0 0 4px rgba(245,158,11,.15);color:#fff}
.form-control::placeholder{color:#475569}
.input-wrap{position:relative}
.input-wrap i{position:absolute;left:14px;top:50%;transform:translateY(-50%);color:#64748b}
.input-wrap .form-control{padding-left:2.55rem}
.btn-go{
  width:100%;border:none;border-radius:.85rem;padding:.9rem;font-weight:700;color:#0f172a;
  background:linear-gradient(135deg,#f59e0b,#d97706);
  box-shadow:0 8px 24px rgba(245,158,11,.25);transition:.2s;margin-top:.25rem;
}
.btn-go:hover{filter:brightness(1.08);transform:translateY(-1px);color:#0f172a}
.alert-err{
  background:rgba(239,68,68,.12);border:1px solid rgba(239,68,68,.25);color:#fecaca;
  border-radius:1rem;padding:.85rem 1rem;font-size:.875rem;display:flex;gap:10px;margin-bottom:1rem;
}
.links{display:flex;justify-content:space-between;flex-wrap:wrap;gap:.5rem;margin-top:1.25rem;font-size:.85rem}
.links a{color:#94a3b8;text-decoration:none;font-weight:500}
.links a:hover{color:#e2e8f0}
.top-brand{text-align:center;margin-bottom:1.5rem;color:#64748b;font-size:.8rem}
.top-brand strong{color:#cbd5e1}
</style>
</head>
<body>
<div style="width:100%;max-width:420px">
  <div class="top-brand"><strong>📚 Perpustakaan Digital</strong> · SDN 1 Kalidadap</div>
  <div class="card-auth">
    <div class="badge-role"><i class="bi bi-person-badge"></i> Area petugas</div>
    <h1>Portal sirkulasi</h1>
    <p class="sub">Verifikasi pinjam, pengembalian, dan pelayanan meja.</p>

    @if(session('error'))
    <div class="alert-err"><i class="bi bi-exclamation-triangle-fill"></i><div>{{ session('error') }}</div></div>
    @endif
    @if($errors->any())
    <div class="alert-err"><i class="bi bi-x-circle-fill"></i><div>@foreach($errors->all() as $e)<div>{{$e}}</div>@endforeach</div></div>
    @endif

    <form method="POST" action="{{ url('/login') }}" novalidate>
      @csrf
      <input type="hidden" name="role_expected" value="petugas">
      <div class="mb-3">
        <label class="form-label">Email</label>
        <div class="input-wrap">
          <i class="bi bi-envelope"></i>
          <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="email@sekolah.sch.id" required autofocus>
        </div>
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <div class="input-wrap">
          <i class="bi bi-lock"></i>
          <input type="password" name="password" class="form-control" placeholder="••••••••" required>
        </div>
      </div>
      <button type="submit" class="btn-go">Masuk <i class="bi bi-arrow-right-short"></i></button>
    </form>
    <div class="links">
      <a href="{{ route('login.anggota') }}">Login anggota</a>
      <a href="{{ route('home') }}">Beranda</a>
    </div>
  </div>
</div>
</body>
</html>
