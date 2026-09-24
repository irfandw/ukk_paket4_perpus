@extends('layouts.app')
@section('title', 'Dashboard Anggota')
@section('content')
<div class="mb-1"><span class="badge text-bg-info">Anggota</span></div>
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
    <div>
        <small class="text-muted text-uppercase" style="letter-spacing:.06em;font-size:.7rem;">Selamat datang</small>
        <h4 class="fw-bold mb-0">{{ auth()->user()->name }}</h4>
    </div>
    <div class="d-flex gap-2 flex-wrap">
      <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary rounded-pill"><i class="bi bi-person-gear"></i> Edit Profil</a>
      <a href="{{ route('members.kartu.saya') }}" class="btn btn-outline-primary rounded-pill" target="_blank"><i class="bi bi-person-vcard"></i> Kartu Saya</a>
      <a href="{{ route('books.index') }}" class="btn btn-brand rounded-pill"><i class="bi bi-search"></i> Cari Buku</a>
    </div>
</div>

@if(!(auth()->user()->isAktif()))
<div class="alert alert-danger border-0 rounded-3">
    Akun keanggotaan Anda <strong>nonaktif</strong>. Anda tetap dapat mengembalikan buku, namun tidak dapat meminjam baru. Hubungi petugas bila ini keliru.
</div>
@endif

@if(isset($segeraTempo) && count($segeraTempo))
<div class="alert alert-warning border-0 rounded-3">
    <i class="bi bi-clock"></i>
    <strong>{{ count($segeraTempo) }} buku</strong> akan jatuh tempo dalam 2 hari.
    Segera kembalikan di menu <a href="{{ route('borrowings.index', ['status'=>'dipinjam']) }}">Pengembalian</a>.
</div>
@endif

<div class="row g-3 mb-4">
    <div class="col-6 col-md-3"><div class="stat-tile p-3"><div class="small text-muted">Sedang dipinjam</div><div class="fs-3 fw-bold">{{ $active }}</div></div></div>
    <div class="col-6 col-md-3"><div class="stat-tile danger p-3"><div class="small text-muted">Terlambat</div><div class="fs-3 fw-bold">{{ $terlambat }}</div></div></div>
    <div class="col-6 col-md-3"><div class="stat-tile success p-3"><div class="small text-muted">Total riwayat</div><div class="fs-3 fw-bold">{{ $totalRiwayat }}</div></div></div>
    <div class="col-6 col-md-3"><div class="stat-tile info p-3 h-100 d-flex align-items-center">
        <a href="{{ route('favorites.index') }}" class="text-decoration-none text-dark"><i class="bi bi-heart-fill text-danger"></i> Favorit saya</a>
    </div></div>
</div>

{{-- Notifikasi anggota (setara admin) --}}
<div class="card-soft mb-4">
  <div class="card-header bg-white d-flex justify-content-between align-items-center">
    <span class="fw-semibold"><i class="bi bi-bell"></i> Notifikasi
      @if(($unreadNotif ?? 0) > 0)
        <span class="badge text-bg-danger">{{ $unreadNotif }} baru</span>
      @endif
    </span>
    <a href="{{ route('notifications.index') }}" class="small text-decoration-none">Lihat semua</a>
  </div>
  <div class="list-group list-group-flush">
    @forelse(($notifPribadi ?? collect()) as $n)
    <div class="list-group-item px-3 py-2 {{ $n->is_read ? '' : 'bg-primary bg-opacity-10' }}">
      <div class="d-flex justify-content-between gap-2">
        <div>
          <strong class="small">{{ $n->title }}</strong>
          @if($n->message)<div class="small text-muted">{{ Str::limit($n->message, 80) }}</div>@endif
        </div>
        <small class="text-muted text-nowrap">{{ $n->created_at->diffForHumans() }}</small>
      </div>
    </div>
    @empty
    <div class="list-group-item text-muted small text-center py-3">Belum ada notifikasi.</div>
    @endforelse
  </div>
</div>

@if($activeList->count())
<div class="card-soft mb-4">
    <div class="card-header bg-white fw-semibold">Buku sedang dipinjam</div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light"><tr><th class="ps-3">Buku</th><th>Jatuh Tempo</th><th>Status</th><th></th></tr></thead>
            <tbody>
            @foreach($activeList as $b)
            <tr>
                <td class="ps-3">{{ Str::limit($b->book->title ?? '-', 40) }}</td>
                <td class="{{ $b->isOverdue() ? 'text-danger fw-semibold' : '' }}">{{ $b->tgl('tempo') }}</td>
                <td><span class="badge bg-warning text-dark">{{ $b->status }}</span></td>
                <td><a href="{{ route('borrowings.show', $b) }}" class="btn btn-sm btn-outline-primary">Detail</a></td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="card-soft p-3">
            <h6 class="fw-bold mb-3">Buku populer</h6>
            @foreach($populer as $book)
            <div class="d-flex justify-content-between border-bottom py-2">
                <a href="{{ route('books.show', $book) }}" class="text-decoration-none text-dark">{{ Str::limit($book->title, 35) }}</a>
                <span class="badge text-bg-light">{{ $book->borrowings_count }}x</span>
            </div>
            @endforeach
        </div>
    </div>
    <div class="col-md-6">
        <div class="card-soft p-3">
            <h6 class="fw-bold mb-3">Koleksi terbaru</h6>
            @foreach($terbaru as $book)
            <div class="border-bottom py-2">
                <a href="{{ route('books.show', $book) }}" class="text-decoration-none text-dark">{{ Str::limit($book->title, 40) }}</a>
                <div class="small text-muted">{{ $book->author }}</div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div class="card-soft">
    <div class="card-header bg-white fw-semibold">Riwayat singkat</div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light"><tr><th class="ps-3">Buku</th><th>Pinjam</th><th>Status</th><th></th></tr></thead>
            <tbody>
            @forelse($my_borrowings as $b)
            <tr>
                <td class="ps-3">{{ Str::limit($b->book->title ?? '-', 35) }}</td>
                <td>{{ $b->tgl('pinjam') }}</td>
                <td><span class="badge bg-secondary">{{ $b->status }}</span></td>
                <td><a href="{{ route('borrowings.show', $b) }}" class="btn btn-sm btn-outline-primary">Detail</a></td>
            </tr>
            @empty
            <tr><td colspan="4" class="text-center text-muted py-4">Belum ada peminjaman. <a href="{{ route('books.index') }}">Mulai pinjam</a></td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
