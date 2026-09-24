<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Laporan {{ ucfirst($period) }} · {{ $from }} – {{ $to }}</title>
<style>
  * { box-sizing: border-box; }
  body { font-family: Arial, Helvetica, sans-serif; color: #111; max-width: 800px; margin: 0 auto; padding: 20px; font-size: 13px; }
  h1 { font-size: 18px; margin: 0 0 4px; }
  h2 { font-size: 14px; margin: 18px 0 8px; border-bottom: 1px solid #ccc; padding-bottom: 4px; }
  .muted { color: #666; font-size: 12px; }
  .stats { display: flex; gap: 12px; margin: 12px 0 16px; flex-wrap: wrap; }
  .stats div { border: 1px solid #ddd; border-radius: 8px; padding: 10px 14px; min-width: 120px; }
  .stats strong { display: block; font-size: 18px; }
  table { width: 100%; border-collapse: collapse; margin-bottom: 12px; }
  th, td { border: 1px solid #ddd; padding: 6px 8px; text-align: left; }
  th { background: #f5f5f5; font-size: 12px; }
  td { font-size: 12px; }
  .no-print { margin-bottom: 16px; }
  @media print {
    .no-print { display: none !important; }
    body { padding: 0; }
    @page { margin: 12mm; }
  }
</style>
</head>
<body>
<div class="no-print">
  <button onclick="window.print()" style="padding:8px 16px;font-weight:600;cursor:pointer">🖨 Cetak</button>
  <a href="{{ route('reports.index', request()->query()) }}" style="margin-left:8px">← Kembali</a>
</div>

<h1>{{ $namaPerpus }}</h1>
<div class="muted">{{ $alamat }}</div>
<div class="muted">Laporan {{ strtoupper($period) }} · Periode {{ \Carbon\Carbon::parse($from)->format('d/m/Y') }} – {{ \Carbon\Carbon::parse($to)->format('d/m/Y') }}</div>
<div class="muted">Dicetak: {{ now()->format('d/m/Y H:i') }} · Oleh: {{ auth()->user()->name }}</div>

<div class="stats">
  <div><span class="muted">Pinjam</span><strong>{{ $stats['total_pinjam'] }}</strong></div>
  <div><span class="muted">Kembali</span><strong>{{ $stats['total_kembali'] }}</strong></div>
  <div><span class="muted">Denda</span><strong>Rp {{ number_format($stats['total_denda'], 0, ',', '.') }}</strong></div>
</div>

<h2>Daftar peminjaman</h2>
<table>
  <thead>
    <tr><th>No</th><th>Kode</th><th>Anggota</th><th>Buku</th><th>Tgl pinjam</th><th>Tempo</th><th>Status</th><th>Denda</th></tr>
  </thead>
  <tbody>
  @forelse($pinjam as $i => $b)
    <tr>
      <td>{{ $i+1 }}</td>
      <td>{{ $b->kode_transaksi ?? $b->id }}</td>
      <td>{{ optional($b->user)->name }}</td>
      <td>{{ optional($b->book)->title }}</td>
      <td>{{ $b->tgl('pinjam', 'd/m/Y') }}</td>
      <td>{{ $b->tgl('tempo', 'd/m/Y') }}</td>
      <td>{{ $b->status }}</td>
      <td>{{ number_format($b->denda ?? 0, 0, ',', '.') }}</td>
    </tr>
  @empty
    <tr><td colspan="8" style="text-align:center;color:#888">Tidak ada data pinjam</td></tr>
  @endforelse
  </tbody>
</table>

<h2>Daftar pengembalian</h2>
<table>
  <thead>
    <tr><th>No</th><th>Kode</th><th>Anggota</th><th>Buku</th><th>Tgl kembali</th><th>Denda</th></tr>
  </thead>
  <tbody>
  @forelse($kembali as $i => $b)
    <tr>
      <td>{{ $i+1 }}</td>
      <td>{{ $b->kode_transaksi ?? $b->id }}</td>
      <td>{{ optional($b->user)->name }}</td>
      <td>{{ optional($b->book)->title }}</td>
      <td>{{ $b->tgl('kembali', 'd/m/Y') }}</td>
      <td>{{ number_format($b->denda ?? 0, 0, ',', '.') }}</td>
    </tr>
  @empty
    <tr><td colspan="6" style="text-align:center;color:#888">Tidak ada data kembali</td></tr>
  @endforelse
  </tbody>
</table>

<p class="muted" style="margin-top:24px">Dokumen ini digenerate otomatis dari sistem Perpustakaan Digital.</p>
<script>if (new URLSearchParams(location.search).get('autoprint')==='1') window.print();</script>
</body>
</html>
