<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Baca: {{ $book->title }}</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{background:#0b1220;color:#e2e8f0;font-family:'Plus Jakarta Sans',system-ui,sans-serif;height:100vh;display:flex;flex-direction:column;overflow:hidden}
.bar{
  display:flex;align-items:center;justify-content:space-between;gap:12px;
  padding:10px 16px;background:rgba(15,23,42,.95);border-bottom:1px solid #1e293b;
  backdrop-filter:blur(12px);flex-shrink:0;z-index:10;
}
.bar .meta{min-width:0;flex:1}
.bar .meta strong{display:block;font-size:.95rem;font-weight:700;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.bar .meta .sub{font-size:12px;color:#94a3b8;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.bar .actions{display:flex;gap:8px;flex-shrink:0;flex-wrap:wrap}
.bar a,.bar button{
  color:#f1f5f9;text-decoration:none;padding:8px 14px;border-radius:999px;
  background:#1e293b;border:1px solid #334155;font-size:13px;font-weight:600;
  cursor:pointer;display:inline-flex;align-items:center;gap:6px;font-family:inherit;
}
.bar a:hover,.bar button:hover{background:#334155}
.bar a.accent{background:linear-gradient(135deg,#2563eb,#0ea5e9);border:none;color:#fff}
.bar a.accent:hover{filter:brightness(1.08)}
.bar a.danger{background:rgba(239,68,68,.15);border-color:rgba(239,68,68,.35);color:#fecaca}
.viewer-wrap{flex:1;position:relative;background:#111;min-height:0}
.viewer{position:absolute;inset:0;width:100%;height:100%;border:0;background:#111}
.fallback{
  position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center;
  gap:12px;padding:2rem;text-align:center;color:#94a3b8;
}
.fallback a{color:#93c5fd;font-weight:600}
@media(max-width:640px){
  .bar{flex-direction:column;align-items:stretch}
  .bar .actions{justify-content:flex-end}
}
</style>
</head>
<body>
<div class="bar">
  <div class="meta">
    <strong title="{{ $book->title }}">{{ $book->title }}</strong>
    <div class="sub">{{ $book->author }}@if($book->category) · {{ $book->category->name ?? $book->category->nama ?? '' }}@endif · PDF digital</div>
  </div>
  <div class="actions">
    <a href="{{ route('books.show', $book) }}"><i class="bi bi-info-circle"></i> Detail</a>
    @if($book->isExternalPdf())
      <a href="{{ $book->file_pdf }}" target="_blank" rel="noopener"><i class="bi bi-box-arrow-up-right"></i> Buka tab baru</a>
    @else
      <a href="{{ route('books.baca.stream', $book) }}" target="_blank"><i class="bi bi-box-arrow-up-right"></i> Buka tab baru</a>
      <a href="{{ route('books.baca.stream', $book) }}" download><i class="bi bi-download"></i> Unduh</a>
    @endif
    @auth
      @if(auth()->user()->isAnggota() && $book->isAvailable())
        <a class="accent" href="{{ route('books.show', $book) }}"><i class="bi bi-journal-arrow-down"></i> Pinjam</a>
      @endif
    @else
      <a class="accent" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right"></i> Login untuk pinjam</a>
    @endauth
    <a href="{{ route('home') }}"><i class="bi bi-x-lg"></i> Tutup</a>
  </div>
</div>
<div class="viewer-wrap">
  @php
    $pdfSrc = $book->isExternalPdf() ? $book->file_pdf : route('books.baca.stream', $book);
  @endphp
  <iframe class="viewer" src="{{ $pdfSrc }}#toolbar=1&navpanes=1&view=FitH" title="PDF {{ $book->title }}" allowfullscreen></iframe>
  <noscript>
    <div class="fallback">
      <p>Browser memblokir PDF. <a href="{{ $pdfSrc }}" target="_blank">Buka file PDF di tab baru</a></p>
    </div>
  </noscript>
</div>
</body>
</html>
