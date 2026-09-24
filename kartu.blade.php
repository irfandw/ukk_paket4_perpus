<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kartu Anggota - {{ $meta['nama_perpustakaan'] }}</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
<style>
  :root { --accent: {{ $meta['warna'] ?? '#2563eb' }}; }
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; background: #e2e8f0; padding: 1.5rem; color: #0f172a; }
  .toolbar { max-width: 960px; margin: 0 auto 1.25rem; display: flex; gap: .75rem; flex-wrap: wrap; align-items: center; justify-content: space-between; }
  .toolbar .btn {
    border: none; border-radius: 999px; padding: .55rem 1.25rem; font-weight: 600;
    cursor: pointer; font-size: .9rem; text-decoration: none; display: inline-flex;
    align-items: center; gap: .35rem; line-height: 1.2;
  }
  .btn-print { background: var(--accent); color: #fff; }
  .btn-print:hover { filter: brightness(1.06); color: #fff; }
  .btn-back { background: #fff; color: #334155; border: 1px solid #cbd5e1 !important; }
  .btn-back:hover { background: #f8fafc; color: #0f172a; }
  .cards { display: flex; flex-wrap: wrap; gap: 1.75rem; justify-content: center; }
  /* Kartu identitas lebih lengkap — setara ID card sekolah */
  .member-card {
    width: 95mm; min-height: 60mm;
    background: #fff; border-radius: 12px; overflow: hidden;
    box-shadow: 0 8px 24px rgba(15,23,42,.12);
    display: flex; flex-direction: column; position: relative;
    page-break-inside: avoid; border: 1px solid #e2e8f0;
  }
  .card-header {
    background: linear-gradient(135deg, var(--accent), #0ea5e9);
    color: #fff; padding: 8px 12px; display: flex; align-items: center; gap: 10px;
  }
  .card-header .logo {
    width: 32px; height: 32px; border-radius: 8px; background: rgba(255,255,255,.2);
    display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 15px; flex-shrink: 0;
  }
  .card-header .lib-name { font-size: 11px; font-weight: 800; line-height: 1.25; flex: 1; }
  .card-header .lib-sub { font-size: 8px; opacity: .92; font-weight: 500; letter-spacing: .02em; }
  .card-body { flex: 1; display: flex; padding: 10px 12px; gap: 12px; }
  .photo {
    width: 58px; height: 72px; border-radius: 8px; background: #f1f5f9;
    border: 1.5px solid #e2e8f0; display: flex; align-items: center; justify-content: center;
    color: #94a3b8; font-size: 22px; flex-shrink: 0; overflow: hidden;
    position: relative;
  }
  .photo img {
    width: 100% !important;
    height: 100% !important;
    object-fit: cover !important;
    object-position: center top;
    display: block;
    border-radius: 6px;
  }
  .info { flex: 1; min-width: 0; }
  .info .nama { font-size: 13px; font-weight: 800; line-height: 1.25; margin-bottom: 4px; }
  .info .row { font-size: 9.5px; color: #475569; display: flex; gap: 6px; margin-bottom: 2px; line-height: 1.35; }
  .info .row span.label { color: #94a3b8; min-width: 42px; flex-shrink: 0; }
  .info .row span.val { font-weight: 600; color: #0f172a; word-break: break-word; }
  .side { display: flex; flex-direction: column; align-items: center; gap: 4px; flex-shrink: 0; }
  .qr-wrap { width: 48px; height: 48px; }
  .qr-wrap img { width: 100%; height: 100%; image-rendering: pixelated; }
  .id-code { font-size: 8px; font-weight: 700; color: #64748b; letter-spacing: .04em; }
  .card-footer {
    background: #f8fafc; border-top: 1px solid #e2e8f0;
    padding: 4px 12px; font-size: 8px; color: #64748b; text-align: center;
  }
  .badge-status {
    position: absolute; top: 42px; right: 10px;
    font-size: 8px; font-weight: 800; padding: 2px 7px; border-radius: 5px;
    background: #dcfce7; color: #166534;
  }
  .badge-status.nonaktif { background: #fee2e2; color: #991b1b; }
  @media print {
    body { background: #fff; padding: 0; }
    .toolbar { display: none !important; }
    .member-card { box-shadow: none; border: 1px solid #cbd5e1; margin: 0 3mm 5mm 0; }
    .cards { gap: 4mm; justify-content: flex-start; }
    @page { margin: 8mm; size: A4; }
  }
</style>
</head>
<body>
<div class="toolbar">
  <div>
    <strong>{{ $members->count() }}</strong> kartu anggota
    <span style="color:#64748b;font-size:.85rem"> · {{ $meta['nama_perpustakaan'] }}</span>
  </div>
  <div style="display:flex;gap:.5rem">
    @php
      if (auth()->check() && auth()->user()->isStaf()) {
        $backUrl = route('members.index');
      } elseif (auth()->check() && auth()->user()->isAnggota()) {
        $backUrl = route('dashboard');
      } else {
        $backUrl = url('/');
      }
    @endphp
    <a href="{{ $backUrl }}" class="btn btn-back" id="btnKembali">← Kembali</a>
    <button type="button" class="btn btn-print" onclick="window.print()">🖨 Cetak Kartu</button>
  </div>
</div>

<div class="cards">
@foreach($members as $m)
  @php
    $nis = $m->nis ?: ('AG-' . str_pad((string)$m->id, 4, '0', STR_PAD_LEFT));
    $phone = $m->phone ?? $m->telepon ?? null;
    $addr = $m->address ?? $m->alamat ?? null;
    $qrPayload = $nis . '|' . $m->name . '|' . ($m->kelas ?: '-') . '|' . $m->email;
    $qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=96x96&data=' . urlencode($qrPayload);
  @endphp
  <div class="member-card">
    <div class="card-header">
      <div class="logo">📚</div>
      <div class="lib-name">
        {{ $meta['nama_perpustakaan'] }}
        <div class="lib-sub">KARTU IDENTITAS ANGGOTA PERPUSTAKAAN</div>
      </div>
    </div>
    <div class="card-body">
      <div class="photo">
        @php $ava = method_exists($m, 'avatarUrl') ? $m->avatarUrl() : null; @endphp
        @if($ava)
          <img src="{{ $ava }}" alt="{{ $m->name }}" width="58" height="72"
               style="width:100%;height:100%;object-fit:cover;object-position:center top;display:block;"
               onerror="this.style.display='none';this.parentNode.querySelector('.ph-fallback').style.display='flex';">
          <span class="ph-fallback" style="display:none;font-size:22px;width:100%;height:100%;align-items:center;justify-content:center;">👤</span>
        @else
          <span>👤</span>
        @endif
      </div>
      <div class="info">
        <div class="nama" title="{{ $m->name }}">{{ $m->name }}</div>
        <div class="row"><span class="label">NIS</span><span class="val">{{ $nis }}</span></div>
        <div class="row"><span class="label">Kelas</span><span class="val">{{ $m->kelas ?: '-' }}</span></div>
        <div class="row"><span class="label">Email</span><span class="val">{{ $m->email }}</span></div>
        @if($phone)
        <div class="row"><span class="label">Telepon</span><span class="val">{{ $phone }}</span></div>
        @endif
        @if($addr)
        <div class="row"><span class="label">Alamat</span><span class="val">{{ \Illuminate\Support\Str::limit($addr, 48) }}</span></div>
        @endif
        <div class="row"><span class="label">Berlaku</span><span class="val">{{ $meta['tahun_cetak'] }} – {{ $meta['berlaku_sampai'] }}</span></div>
      </div>
      <div class="side">
        @if($meta['tampilkan_qr'])
        <div class="qr-wrap"><img src="{{ $qrUrl }}" alt="QR" loading="lazy"></div>
        @endif
        <div class="id-code">ID {{ $m->id }}</div>
      </div>
    </div>
    <div class="badge-status {{ ($m->status ?? 'aktif') !== 'aktif' ? 'nonaktif' : '' }}">
      {{ strtoupper($m->status ?? 'aktif') }}
    </div>
    <div class="card-footer">{{ $meta['footer'] }} · {{ $meta['alamat'] }}</div>
  </div>
@endforeach
</div>

@if($members->isEmpty())
  <p style="text-align:center;color:#64748b;margin-top:3rem">Tidak ada anggota untuk dicetak.</p>
@endif

<script>
  if (new URLSearchParams(location.search).get('print') === '1') {
    window.addEventListener('load', () => setTimeout(() => window.print(), 400));
  }
</script>
</body>
</html>
