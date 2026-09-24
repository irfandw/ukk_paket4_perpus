@extends('layouts.app')
@section('title', 'Transaksi')
@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
  <div>
    <h4 class="fw-bold mb-0">
      @if(auth()->user()->isStaf()) Meja Transaksi
      @else Peminjaman Saya
      @endif
    </h4>
    <small class="text-muted">Kelola pinjam, pengembalian, dan denda</small>
  </div>
  @if(auth()->user()->isStaf())
  <a href="{{ route('borrowings.create') }}" class="btn btn-brand btn-sm rounded-pill"><i class="bi bi-plus-lg"></i> Pinjam Walk-in</a>
  @endif
</div>

{{-- Tabs --}}
<ul class="nav nav-pills flex-wrap gap-1 mb-3">
  <li class="nav-item">
    <a class="nav-link {{ ($tab ?? 'semua') === 'semua' ? 'active' : '' }}" href="{{ route('borrowings.index', ['tab' => 'semua']) }}">Semua</a>
  </li>
  @if(auth()->user()->isStaf())
  <li class="nav-item">
    <a class="nav-link {{ ($tab ?? '') === 'menunggu_pinjam' ? 'active' : '' }}" href="{{ route('borrowings.index', ['tab' => 'menunggu_pinjam']) }}">
      Pengajuan Pinjam @if(($counts['menunggu_pinjam'] ?? 0) > 0)<span class="badge text-bg-light text-dark">{{ $counts['menunggu_pinjam'] }}</span>@endif
    </a>
  </li>
  @endif
  <li class="nav-item">
    <a class="nav-link {{ ($tab ?? '') === 'dipinjam' ? 'active' : '' }}" href="{{ route('borrowings.index', ['tab' => 'dipinjam']) }}">
      Dipinjam @if(isset($counts['dipinjam']))<span class="badge text-bg-light text-dark">{{ $counts['dipinjam'] }}</span>@endif
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ ($tab ?? '') === 'menunggu_verifikasi' ? 'active' : '' }}" href="{{ route('borrowings.index', ['tab' => 'menunggu_verifikasi']) }}">
      Menunggu Kembali @if(($counts['menunggu_verifikasi'] ?? 0) > 0)<span class="badge text-bg-warning text-dark">{{ $counts['menunggu_verifikasi'] }}</span>@endif
    </a>
  </li>
  @if(auth()->user()->isStaf())
  <li class="nav-item">
    <a class="nav-link {{ ($tab ?? '') === 'terlambat' ? 'active' : '' }}" href="{{ route('borrowings.index', ['tab' => 'terlambat']) }}">
      Terlambat @if(($counts['terlambat'] ?? 0) > 0)<span class="badge text-bg-danger">{{ $counts['terlambat'] }}</span>@endif
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ ($tab ?? '') === 'denda' ? 'active' : '' }}" href="{{ route('borrowings.index', ['tab' => 'denda']) }}">
      Denda @if(($counts['denda'] ?? 0) > 0)<span class="badge text-bg-warning text-dark">{{ $counts['denda'] }}</span>@endif
    </a>
  </li>
  @else
  <li class="nav-item">
    <a class="nav-link {{ ($tab ?? '') === 'dikembalikan' ? 'active' : '' }}" href="{{ route('borrowings.index', ['tab' => 'dikembalikan']) }}">Riwayat</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ ($tab ?? '') === 'menunggu_pinjam' ? 'active' : '' }}" href="{{ route('borrowings.index', ['tab' => 'menunggu_pinjam']) }}">Pengajuan</a>
  </li>
  @endif
</ul>

<form method="GET" class="mb-3">
  <input type="hidden" name="tab" value="{{ $tab ?? 'semua' }}">
  <div class="input-group" style="max-width:420px">
    <input type="text" name="q" class="form-control" placeholder="Cari kode / nama / judul..." value="{{ request('q') }}">
    <button class="btn btn-outline-primary">Cari</button>
  </div>
</form>

<div class="card-soft">
  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
      <thead class="table-light">
        <tr>
          <th class="ps-3">Kode</th>
          @if(auth()->user()->isStaf())<th>Anggota</th>@endif
          <th>Buku</th>
          <th>Pinjam</th>
          <th>Jatuh Tempo</th>
          <th>Status</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      @forelse($borrowings as $b)
        <tr>
          <td class="ps-3"><code class="small">{{ $b->kode_transaksi ?? ('#'.$b->id) }}</code></td>
          @if(auth()->user()->isStaf())
          <td>
            <div class="fw-semibold">{{ $b->user->name ?? '-' }}</div>
            <small class="text-muted">{{ $b->user->nis ?? $b->user->email ?? '' }}</small>
          </td>
          @endif
          <td>{{ Str::limit($b->book->title ?? '-', 28) }}</td>
          <td>{{ $b->tgl('pinjam') }}</td>
          <td class="{{ $b->isOverdue() ? 'text-danger fw-semibold' : '' }}">{{ $b->tgl('tempo') }}</td>
          <td>
            @php $st = $b->status; @endphp
            @if($st === 'menunggu_pinjam') <span class="badge bg-primary">Pengajuan</span>
            @elseif($st === 'dipinjam' && $b->isOverdue()) <span class="badge bg-danger">Terlambat</span>
            @elseif($st === 'dipinjam') <span class="badge bg-warning text-dark">Dipinjam</span>
            @elseif($st === 'menunggu_verifikasi') <span class="badge bg-info">Menunggu kembali</span>
            @elseif($st === 'dikembalikan') <span class="badge bg-success">Dikembalikan</span>
            @elseif($st === 'ditolak') <span class="badge bg-dark">Ditolak</span>
            @else <span class="badge bg-secondary">{{ $st }}</span>
            @endif
            @if($b->denda > 0 && !$b->denda_lunas)
              <span class="badge bg-warning text-dark">Denda</span>
            @endif
          </td>
          <td class="text-end pe-3">
            <a href="{{ route('borrowings.show', $b) }}" class="btn btn-sm btn-outline-primary rounded-pill">Proses</a>
            @if($b->status === 'menunggu_pinjam' && (auth()->user()->isStaf() || (int)($b->pengguna_id ?? $b->user_id) === (int)auth()->id()))
            <form action="{{ route('borrowings.cancel', $b) }}" method="POST" class="d-inline" onsubmit="return confirm('Batalkan pengajuan ini?')">
              @csrf
              <button class="btn btn-sm btn-outline-danger rounded-pill">Batal</button>
            </form>
            @endif
          </td>
        </tr>
      @empty
        <tr><td colspan="7" class="text-center text-muted py-4">Tidak ada data.</td></tr>
      @endforelse
      </tbody>
    </table>
  </div>
</div>
@if($borrowings->hasPages())
<div class="mt-3">{{ $borrowings->links() }}</div>
@endif
@endsection
