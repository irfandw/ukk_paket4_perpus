@extends('layouts.app')
@section('title', 'Dashboard Petugas')
@section('content')
<div class="mb-1"><span class="badge text-bg-warning text-dark">Petugas Sirkulasi</span></div>
<h4 class="fw-bold mb-1">Halo, {{ auth()->user()->name }}</h4>
<p class="text-muted mb-3">Meja sirkulasi — pinjam walk-in & setujui pengembalian</p>

<div class="alert alert-success border-0 shadow-sm rounded-3">
    <strong>Peran Anda: Petugas Sirkulasi</strong> — fokus melayani anggota di meja
    (pinjam walk-in & setujui pengembalian buku fisik).
    Master data buku/anggota dan laporan lengkap hanya untuk <strong>Admin</strong>.
</div>

<div class="mb-3 d-flex flex-wrap gap-2">
    <a href="{{ route('borrowings.create') }}" class="btn btn-brand rounded-pill btn-sm"><i class="bi bi-plus-lg"></i> Pinjam Walk-in</a>
    <a href="{{ route('borrowings.index', ['status'=>'menunggu_verifikasi']) }}" class="btn btn-outline-success rounded-pill btn-sm">Antrian Kembali</a>
    <a href="{{ route('borrowings.index') }}" class="btn btn-outline-primary rounded-pill btn-sm">Semua Transaksi</a>
</div>

<div class="row g-3 mb-4">
    <div class="col-6 col-md-4 col-lg-2"><div class="stat-tile p-3"><div class="small text-muted">Dipinjam</div><div class="fs-3 fw-bold">{{ $stats['aktif'] }}</div></div></div>
    <div class="col-6 col-md-4 col-lg-2"><div class="stat-tile danger p-3"><div class="small text-muted">Terlambat</div><div class="fs-3 fw-bold">{{ $stats['overdue'] }}</div></div></div>
    <div class="col-6 col-md-4 col-lg-2"><div class="stat-tile info p-3"><div class="small text-muted">Pinjam hari ini</div><div class="fs-3 fw-bold">{{ $stats['pinjam_hari_ini'] }}</div></div></div>
    <div class="col-6 col-md-4 col-lg-2"><div class="stat-tile success p-3"><div class="small text-muted">Kembali hari ini</div><div class="fs-3 fw-bold">{{ $stats['kembali_hari_ini'] }}</div></div></div>
    <div class="col-6 col-md-4 col-lg-2"><div class="stat-tile warning p-3"><div class="small text-muted">Denda belum lunas</div><div class="fs-3 fw-bold">{{ $stats['denda_belum'] }}</div></div></div>
    <div class="col-6 col-md-4 col-lg-2"><div class="stat-tile warning p-3"><div class="small text-muted">Menunggu kembali</div><div class="fs-3 fw-bold">{{ $stats['pending'] }}</div></div></div>
    <div class="col-6 col-md-4 col-lg-2"><div class="stat-tile info p-3"><div class="small text-muted">Pengajuan pinjam</div><div class="fs-3 fw-bold">{{ $stats['pengajuan_pinjam'] ?? 0 }}</div></div></div>
</div>


@if(isset($pengajuanPinjam) && $pengajuanPinjam->count())
{{-- Notifikasi petugas --}}
<div class="row g-3 mb-4">
  <div class="col-md-6">
    <div class="card-soft h-100">
      <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <span class="fw-semibold"><i class="bi bi-bell-fill text-warning"></i> Notif Staf
          @if(($unreadStaf ?? 0) > 0)<span class="badge text-bg-danger">{{ $unreadStaf }}</span>@endif
        </span>
        <a href="{{ route('staff.notifications') }}" class="small text-decoration-none">Semua</a>
      </div>
      <div class="list-group list-group-flush">
        @forelse(($notifStaf ?? collect()) as $n)
        <div class="list-group-item px-3 py-2 {{ ($n->is_read ?? true) ? '' : 'bg-warning bg-opacity-10' }}">
          <strong class="small">{{ $n->title }}</strong>
          @if($n->message)<div class="small text-muted">{{ Str::limit($n->message, 70) }}</div>@endif
          <div class="small text-muted">{{ $n->created_at?->diffForHumans() }}</div>
        </div>
        @empty
        <div class="list-group-item text-muted small text-center py-3">Belum ada notif staf.</div>
        @endforelse
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card-soft h-100">
      <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <span class="fw-semibold"><i class="bi bi-bell"></i> Notifikasi saya
          @if(($unreadPribadi ?? 0) > 0)<span class="badge text-bg-danger">{{ $unreadPribadi }}</span>@endif
        </span>
        <a href="{{ route('notifications.index') }}" class="small text-decoration-none">Semua</a>
      </div>
      <div class="list-group list-group-flush">
        @forelse(($notifPribadi ?? collect()) as $n)
        <div class="list-group-item px-3 py-2 {{ $n->is_read ? '' : 'bg-primary bg-opacity-10' }}">
          <strong class="small">{{ $n->title }}</strong>
          @if($n->message)<div class="small text-muted">{{ Str::limit($n->message, 70) }}</div>@endif
          <div class="small text-muted">{{ $n->created_at->diffForHumans() }}</div>
        </div>
        @empty
        <div class="list-group-item text-muted small text-center py-3">Belum ada notifikasi.</div>
        @endforelse
      </div>
    </div>
  </div>
</div>

<div class="card-soft mb-4">
    <div class="card-header bg-white fw-semibold"><i class="bi bi-inbox"></i> Pengajuan Pinjam (setujui / tolak)</div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light"><tr><th class="ps-3">Anggota</th><th>Buku</th><th>Lama</th><th></th></tr></thead>
            <tbody>
            @foreach($pengajuanPinjam as $b)
            <tr>
                <td class="ps-3">{{ $b->user->name ?? '-' }}</td>
                <td>{{ Str::limit($b->book->title ?? '-', 35) }}</td>
                <td>{{ $b->lama_hari }} hari</td>
                <td><a href="{{ route('borrowings.show', $b) }}" class="btn btn-sm btn-primary rounded-pill">Proses</a></td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
<div class="card-soft mb-4">
    <div class="card-header bg-white fw-semibold"><i class="bi bi-hourglass-split"></i> Antrian Pengembalian</div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light"><tr><th class="ps-3">Anggota</th><th>Buku</th><th>Jatuh Tempo</th><th></th></tr></thead>
            <tbody>
            @forelse($pending as $b)
            <tr>
                <td class="ps-3">{{ $b->user->name ?? '-' }}</td>
                <td>{{ Str::limit($b->book->title ?? '-', 35) }}</td>
                <td>{{ $b->tgl('tempo') }}</td>
                <td><a href="{{ route('borrowings.show', $b) }}" class="btn btn-sm btn-success rounded-pill">Proses</a></td>
            </tr>
            @empty
            <tr><td colspan="4" class="text-center text-muted py-4">Tidak ada antrian</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="card-soft">
    <div class="card-header bg-white fw-semibold">Jatuh Tempo Terdekat</div>
    <div class="table-responsive">
        <table class="table table-sm align-middle mb-0">
            <thead class="table-light"><tr><th class="ps-3">Anggota</th><th>Buku</th><th>Jatuh Tempo</th><th></th></tr></thead>
            <tbody>
            @forelse($segera as $b)
            <tr>
                <td class="ps-3">{{ $b->user->name ?? '-' }}</td>
                <td>{{ Str::limit($b->book->title ?? '-', 30) }}</td>
                <td class="{{ $b->isOverdue() ? 'text-danger fw-semibold' : '' }}">{{ $b->tgl('tempo') }}</td>
                <td><a href="{{ route('borrowings.show', $b) }}" class="btn btn-sm btn-outline-primary">Detail</a></td>
            </tr>
            @empty
            <tr><td colspan="4" class="text-center text-muted py-3">Kosong</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
