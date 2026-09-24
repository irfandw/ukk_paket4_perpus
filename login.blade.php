<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Masuk · Perpustakaan Digital</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
*{font-family:'Plus Jakarta Sans',system-ui,sans-serif;box-sizing:border-box}
body{
  margin:0;min-height:100vh;color:#fff;
  background:
    radial-gradient(1000px 600px at 20% 0%, rgba(56,189,248,.25), transparent 50%),
    radial-gradient(800px 500px at 100% 100%, rgba(37,99,235,.3), transparent 45%),
    linear-gradient(165deg,#0f172a,#1e293b 60%,#0c4a6e);
  display:flex;align-items:center;justify-content:center;padding:2rem 1rem;
}
.wrap{width:100%;max-width:920px}
.header{text-align:center;margin-bottom:2rem}
.header .logo{
  width:56px;height:56px;border-radius:16px;margin:0 auto .75rem;
  background:linear-gradient(135deg,#2563eb,#0ea5e9);display:grid;place-items:center;font-size:1.5rem;
  box-shadow:0 12px 30px rgba(37,99,235,.4);
}
.header h1{font-weight:800;font-size:clamp(1.5rem,3vw,2rem);letter-spacing:-.03em;margin:0 0 .4rem}
.header p{color:rgba(255,255,255,.7);margin:0;font-size:.95rem}
.grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1rem}
@media(max-width:768px){.grid{grid-template-columns:1fr;max-width:380px;margin:0 auto}}
.role{
  background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);
  border-radius:1.25rem;padding:1.5rem 1.25rem;text-decoration:none;color:#fff;
  transition:.25s;display:block;height:100%;backdrop-filter:blur(12px);
}
.role:hover{background:rgba(255,255,255,.14);transform:translateY(-4px);color:#fff;border-color:rgba(255,255,255,.25);box-shadow:0 20px 40px rgba(0,0,0,.25)}
.role .ico{
  width:52px;height:52px;border-radius:14px;display:grid;place-items:center;font-size:1.4rem;margin-bottom:1rem;
}
.role.anggota .ico{background:rgba(37,99,235,.25);color:#93c5fd}
.role.petugas .ico{background:rgba(245,158,11,.2);color:#fcd34d}
.role.admin .ico{background:rgba(239,68,68,.2);color:#fca5a5}
.role h3{font-weight:800;font-size:1.15rem;margin:0 0 .35rem}
.role p{font-size:.85rem;color:rgba(255,255,255,.65);margin:0 0 1rem;line-height:1.45}
.role .go{font-size:.8rem;font-weight:700;color:#7dd3fc}
.footer{text-align:center;margin-top:2rem;font-size:.85rem;color:rgba(255,255,255,.55)}
.footer a{color:#fff;font-weight:600;text-decoration:none}
</style>
</head>
<body>
<div class="wrap">
  <div class="header">
    <div class="logo">📚</div>
    <h1>Perpustakaan Digital</h1>
    <p>SDN 1 Kalidadap · Pilih peran untuk masuk</p>
  </div>
  <div class="grid">
    <a href="{{ route('login.anggota') }}" class="role anggota">
      <div class="ico"><i class="bi bi-person-fill"></i></div>
      <h3>Anggota</h3>
      <p>Siswa & peminjam. Pinjam buku, baca PDF, simpan favorit.</p>
      <span class="go">Masuk anggota →</span>
    </a>
    <a href="{{ route('login.petugas') }}" class="role petugas">
      <div class="ico"><i class="bi bi-person-badge-fill"></i></div>
      <h3>Petugas</h3>
      <p>Sirkulasi meja: setujui pinjam, verifikasi pengembalian.</p>
      <span class="go">Masuk petugas →</span>
    </a>
    <a href="{{ route('login.admin') }}" class="role admin">
      <div class="ico"><i class="bi bi-shield-lock-fill"></i></div>
      <h3>Administrator</h3>
      <p>Kelola koleksi, pengguna, laporan, dan pengaturan.</p>
      <span class="go">Masuk admin →</span>
    </a>
  </div>
  <div class="footer">
    Belum punya akun? <a href="{{ route('register') }}">Daftar anggota</a>
    · <a href="{{ route('home') }}">Kembali ke beranda</a>
  </div>
</div>
</body>
</html>
