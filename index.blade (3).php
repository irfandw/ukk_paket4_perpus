@extends('layouts.app')
@section('title', 'Laporan')
@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
  <div>
    <h4 class="fw-bold mb-0">Laporan Peminjaman & Pengembalian</h4>
    <small class="text-muted">Harian · Mingguan · Bulanan · Cetak struk laporan</small>
  </div>
  <div class="d-flex flex-wrap gap-2">
    <a href="{{ route('reports.print', request()->query()) }}" class="btn btn-brand rounded-pill" target="_blank">
      <i class="bi bi-printer"></i> Cetak laporan
    </a>
    <a href="{{ route('reports.export', array_merge(request()->query(), ['type' => 'transaksi'])) }}" class="btn btn-outline-primary rounded-pill">CSV Transaksi</a>
    @if(auth()->user()->isAdmin())
    <a href="{{ route('reports.export', ['type' => 'anggota']) }}" class="btn btn-outline-secondary rounded-pill">CSV Anggota</a>
    @endif
  </div>
</div>

{{-- Periode cepat --}}
<div class="d-flex flex-wrap gap-2 mb-3">
  @foreach(['harian' => 'Hari ini', 'mingguan' => '7 hari', 'bulanan' => 'Bulan ini', 'custom' => 'Kustom'] as $key => $label)
    <a href="{{ route('reports.index', ['period' => $key] + ($key==='custom' ? ['from'=>$from,'to'=>$to] : [])) }}"
       class="btn btn-sm rounded-pill {{ ($period ?? '') === $key ? 'btn-brand' : 'btn-outline-primary' }}">{{ $label }}</a>
  @endforeach
</div>

<form method="GET" class="card-soft p-3 mb-4">
  <input type="hidden" name="period" value="custom">
  <div class="row g-2 align-items-end">
    <div class="col-md-4">
      <label class="form-label small text-muted">Dari</label>
      <input type="date" name="from" class="form-control" value="{{ $from }}">
    </div>
    <div class="col-md-4">
      <label class="form-label small text-muted">Sampai</label>
      <input type="date" name="to" class="form-control" value="{{ $to }}">
    </div>
    <div class="col-md-4">
      <button class="btn btn-primary w-100">Filter rentang</button>
    </div>
  </div>
</form>

<div class="row g-3 mb-4">
  <div class="col-6 col-md-3"><div class="stat-tile p-3"><div class="small text-muted">Total Pinjam</div><div class="fs-3 fw-bold">{{ $stats['total_pinjam'] }}</div></div></div>
  <div class="col-6 col-md-3"><div class="stat-tile success p-3"><div class="small text-muted">Dikembalikan</div><div class="fs-3 fw-bold">{{ $stats['total_kembali'] }}</div></div></div>
  <div class="col-6 col-md-3"><div class="stat-tile warning p-3"><div class="small text-muted">Total Denda</div><div class="fs-5 fw-bold">Rp {{ number_format($stats['total_denda'],0,',','.') }}</div></div></div>
  <div class="col-6 col-md-3"><div class="stat-tile info p-3"><div class="small text-muted">Pengunjung</div><div class="fs-3 fw-bold">{{ $stats['pengunjung'] ?? 0 }}</div></div></div>
</div>

<div class="card-soft p-3 mb-4">
  <h6 class="fw-bold mb-3">Grafik pinjam vs kembali ({{ $from }} s/d {{ $to }})</h6>
  <canvas id="chartLaporan" height="100"></canvas>
</div>

<div class="row g-4 mb-4">
  <div class="col-lg-5">
    <div class="card-soft p-3">
      <h6 class="fw-bold mb-3">Top Buku Dipinjam</h6>
      <div class="list-group list-group-flush">
        @forelse($topBooks as $i => $row)
          <div class="list-group-item px-0 d-flex justify-content-between">
            <span class="small">{{ $i+1 }}. {{ Str::limit(optional($row->book)->title ?? '—', 36) }}</span>
            <span class="badge text-bg-primary">{{ $row->total }}x</span>
          </div>
        @empty
          <div class="text-muted small">Belum ada data.</div>
        @endforelse
      </div>
    </div>
  </div>
  <div class="col-lg-7">
    <div class="card-soft p-3">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h6 class="fw-bold mb-0">Transaksi pinjam</h6>
        <span class="small text-muted">{{ $recent->count() }} terbaru</span>
      </div>
      <div class="table-responsive">
        <table class="table table-sm table-hover align-middle mb-0">
          <thead class="table-light"><tr><th>#</th><th>Anggota</th><th>Buku</th><th>Tgl</th><th>Status</th><th></th></tr></thead>
          <tbody>
          @forelse($recent as $b)
            <tr>
              <td class="small">{{ $b->id }}</td>
              <td class="small">{{ optional($b->user)->name }}</td>
              <td class="small">{{ Str::limit(optional($b->book)->title, 28) }}</td>
              <td class="small">{{ $b->tgl('pinjam', 'd/m/Y') }}</td>
              <td><span class="badge text-bg-secondary">{{ $b->status }}</span></td>
              <td>
                <a href="{{ route('borrowings.print', $b) }}" class="btn btn-sm btn-outline-primary" target="_blank" title="Cetak struk">
                  <i class="bi bi-receipt"></i>
                </a>
              </td>
            </tr>
          @empty
            <tr><td colspan="6" class="text-muted text-center py-3">Tidak ada transaksi</td></tr>
          @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="card-soft p-3 mb-4">
  <h6 class="fw-bold mb-2">Pengembalian pada periode ini</h6>
  <div class="table-responsive">
    <table class="table table-sm table-hover align-middle mb-0">
      <thead class="table-light"><tr><th>#</th><th>Anggota</th><th>Buku</th><th>Tgl kembali</th><th>Denda</th><th></th></tr></thead>
      <tbody>
      @forelse($returns as $b)
        <tr>
          <td class="small">{{ $b->id }}</td>
          <td class="small">{{ optional($b->user)->name }}</td>
          <td class="small">{{ Str::limit(optional($b->book)->title, 28) }}</td>
          <td class="small">{{ $b->tgl('kembali', 'd/m/Y') }}</td>
          <td class="small">Rp {{ number_format($b->denda ?? 0, 0, ',', '.') }}</td>
          <td>
            <a href="{{ route('borrowings.print', $b) }}" class="btn btn-sm btn-outline-primary" target="_blank"><i class="bi bi-receipt"></i></a>
          </td>
        </tr>
      @empty
        <tr><td colspan="6" class="text-muted text-center py-3">Tidak ada pengembalian</td></tr>
      @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
(function(){
  var el = document.getElementById('chartLaporan');
  if (!el || !window.Chart) return;
  new Chart(el, {
    type: 'bar',
    data: {
      labels: @json($chartLabels ?? []),
      datasets: [
        { label: 'Pinjam', data: @json($chartPinjam ?? []), backgroundColor: 'rgba(37,99,235,.75)', borderRadius: 6 },
        { label: 'Kembali', data: @json($chartKembali ?? []), backgroundColor: 'rgba(16,185,129,.75)', borderRadius: 6 }
      ]
    },
    options: {
      responsive: true,
      plugins: { legend: { position: 'bottom' } },
      scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
    }
  });
})();
</script>
@endpush
