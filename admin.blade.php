@extends('layouts.app')
@section('title', 'Dashboard Admin')
@section('content')
<div class="mb-1"><span class="badge text-bg-danger">Administrator</span></div>
<h4 class="fw-bold mb-1">Dashboard Admin</h4>
<p class="text-muted mb-4">Master data, laporan, dan pengaturan sistem</p>

<div class="row g-3 mb-4">
    <div class="col-6 col-md-3"><div class="stat-tile p-3"><div class="small text-muted">Judul Buku</div><div class="fs-3 fw-bold">{{ $stats['total_books'] }}</div><small class="text-muted">Stok: {{ $stats['total_stock'] }}</small></div></div>
    <div class="col-6 col-md-3"><div class="stat-tile success p-3"><div class="small text-muted">Anggota</div><div class="fs-3 fw-bold">{{ $stats['total_members'] }}</div><small class="text-muted">+{{ $stats['anggota_baru'] }} minggu ini</small></div></div>
    <div class="col-6 col-md-3"><div class="stat-tile warning p-3"><div class="small text-muted">Sedang Dipinjam</div><div class="fs-3 fw-bold">{{ $stats['active_borrowings'] }}</div></div></div>
    <div class="col-6 col-md-3"><div class="stat-tile danger p-3"><div class="small text-muted">Terlambat</div><div class="fs-3 fw-bold">{{ $stats['overdue'] }}</div></div></div>
    <div class="col-6 col-md-3"><div class="stat-tile info p-3"><div class="small text-muted">Menunggu Kembali</div><div class="fs-3 fw-bold">{{ $stats['pending_return'] }}</div></div></div>
    <div class="col-6 col-md-3"><div class="stat-tile warning p-3"><div class="small text-muted">Denda Belum Lunas</div><div class="fs-4 fw-bold">{{ $stats['denda_belum'] }}</div><small class="text-muted">Rp {{ number_format($stats['total_denda_belum'],0,',','.') }}</small></div></div>
    <div class="col-6 col-md-3"><div class="stat-tile p-3"><div class="small text-muted">Petugas</div><div class="fs-3 fw-bold">{{ $stats['total_petugas'] }}</div></div></div>
    <div class="col-6 col-md-3"><div class="stat-tile info p-3"><div class="small text-muted">Pesan Baru</div><div class="fs-3 fw-bold">{{ $stats['pesan_baru'] }}</div>
    </div></div>
    <div class="col-6 col-md-3"><div class="stat-tile p-3"><div class="small text-muted">Pengunjung hari ini</div><div class="fs-3 fw-bold">{{ $stats['pengunjung_hari_ini'] ?? 0 }}</div></div></div>
    <div class="col-6 col-md-3"><div class="stat-tile info p-3"><div class="small text-muted">Total pengunjung</div><div class="fs-3 fw-bold">{{ $stats['pengunjung_total'] ?? 0 }}</div>
        @if($stats['pesan_baru']>0)<a href="{{ route('contacts.index') }}" class="small">Lihat</a>@endif
    </div></div>
</div>

<div class="row g-4 mb-4">
    <div class="col-lg-7">
        <div class="card-soft p-3">
            <h6 class="fw-bold mb-3"><i class="bi bi-bar-chart"></i> Grafik Peminjaman 7 Hari</h6>
            <canvas id="chartPinjam" height="120"></canvas>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card-soft p-3">
            <h6 class="fw-bold mb-3">Buku Paling Sering Dipinjam</h6>
            <ul class="list-group list-group-flush">
                @forelse($topBooks as $t)
                <li class="list-group-item d-flex justify-content-between px-0">
                    <span>{{ Str::limit(optional($t->book)->title ?? '-', 30) }}</span>
                    <span class="badge text-bg-primary rounded-pill">{{ $t->total }}x</span>
                </li>
                @empty
                <li class="list-group-item text-muted px-0">Belum ada data</li>
                @endforelse
            </ul>
            <div class="mt-3 d-flex gap-2 flex-wrap">
                <a href="{{ route('reports.index') }}" class="btn btn-sm btn-outline-primary rounded-pill">Laporan</a>
                <a href="{{ route('users.index', ['role'=>'anggota']) }}" class="btn btn-sm btn-outline-secondary rounded-pill">Anggota</a>
                <a href="{{ route('users.index', ['role'=>'petugas']) }}" class="btn btn-sm btn-outline-secondary rounded-pill">Petugas</a>
            </div>
        </div>
    </div>
</div>

<div class="card-soft">
    <div class="card-header bg-white fw-semibold">Transaksi Terbaru</div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light"><tr><th class="ps-3">Anggota</th><th>Buku</th><th>Tanggal</th><th>Status</th></tr></thead>
            <tbody>
            @foreach($recent_borrowings as $b)
            <tr>
                <td class="ps-3">{{ optional($b->user)->name ?? '-' }}</td>
                <td>{{ Str::limit(optional($b->book)->title ?? '-', 30) }}</td>
                <td>{{ $b->tgl('pinjam') }}</td>
                <td><span class="badge bg-secondary">{{ $b->status }}</span></td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
new Chart(document.getElementById('chartPinjam'), {
    type: 'bar',
    data: {
        labels: @json($chartLabels),
        datasets: [{ label: 'Pinjam', data: @json($chartData), backgroundColor: 'rgba(37, 99, 235, 0.7)', borderRadius: 6 }]
    },
    options: { responsive: true, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } } }
});
</script>
@endpush
