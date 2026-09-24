@extends('layouts.app')
@section('title', 'Detail Peminjaman')
@section('content')
<h4 class="fw-bold mb-1">Detail Peminjaman</h4>
<p class="text-muted mb-4"><code>{{ $borrowing->kode_transaksi ?? ('#'.$borrowing->id) }}</code></p>
<div class="card-soft p-4">
<table class="table table-borderless">
<tr><th width="180">Anggota</th><td>{{ $borrowing->user->name }} ({{ $borrowing->user->email }})</td></tr>
<tr><th>Buku</th><td>{{ $borrowing->book->title }} — {{ $borrowing->book->author }}</td></tr>
<tr><th>Tanggal Pinjam</th><td>{{ $borrowing->tgl('pinjam', 'd F Y') }}</td></tr>
<tr><th>Lama / Perpanjang</th><td>{{ $borrowing->lama_hari ?? 7 }} hari · diperpanjang {{ $borrowing->perpanjang_count ?? 0 }}x</td></tr>
<tr><th>Jatuh Tempo</th><td>{{ $borrowing->tgl('tempo', 'd F Y') }}</td></tr>
<tr><th>Tanggal Kembali</th><td>{{ $borrowing->tgl('kembali', 'd F Y') }}</td></tr>
<tr><th>Status</th><td>
@if($borrowing->status === 'menunggu_pinjam')
<span class="badge bg-primary">Menunggu Persetujuan Pinjam</span>
@elseif($borrowing->status === 'ditolak')
<span class="badge bg-dark">Ditolak</span>
@elseif($borrowing->status === 'menunggu_verifikasi')
<span class="badge bg-info">Menunggu Verifikasi</span>
@elseif($borrowing->isOverdue() && $borrowing->status === 'dipinjam')
<span class="badge bg-danger">Terlambat ({{ $borrowing->hariTerlambat() }} hari)</span>
@elseif($borrowing->status === 'dipinjam')
<span class="badge bg-warning text-dark">Dipinjam</span>
@else
<span class="badge bg-success">Dikembalikan</span>
@endif
</td></tr>
<tr><th>Denda</th><td>
@if($borrowing->denda > 0)
<span class="text-danger fw-bold">Rp {{ number_format($borrowing->denda, 0, ',', '.') }}</span>
@if($borrowing->denda_lunas) <span class="badge bg-success">Lunas</span>
@else <span class="badge bg-warning text-dark">Belum lunas</span>@endif
@elseif($borrowing->status !== 'dikembalikan' && $dendaPerkiraan > 0)
<span class="text-warning">Perkiraan: Rp {{ number_format($dendaPerkiraan, 0, ',', '.') }}</span>
@else
<span class="text-success">Tidak ada denda</span>
@endif
</td></tr>
@if($borrowing->kondisi_buku)
<tr><th>Kondisi buku</th><td>{{ $borrowing->kondisi_buku }}</td></tr>
@endif
</table>

<div class="mt-3 d-flex flex-wrap gap-2">
@if($borrowing->status === 'menunggu_pinjam' && auth()->user()->isStaf())
<form action="{{ route('borrowings.approvePinjam', $borrowing) }}" method="POST" class="d-inline" onsubmit="return confirm('Setujui pengajuan pinjam? Stok akan berkurang.')">
  @csrf
  <button class="btn btn-success btn-sm"><i class="bi bi-check2"></i> Setujui Pinjam</button>
</form>
<form action="{{ route('borrowings.rejectPinjam', $borrowing) }}" method="POST" class="d-inline d-flex gap-1 align-items-center" onsubmit="return confirm('Tolak pengajuan?')">
  @csrf
  <input type="text" name="alasan" class="form-control form-control-sm" placeholder="Alasan tolak (opsional)" style="width:180px">
  <button class="btn btn-outline-danger btn-sm"><i class="bi bi-x"></i> Tolak</button>
</form>
@endif
@if($borrowing->status === 'ditolak' && $borrowing->alasan_tolak)
<div class="alert alert-warning py-2">Alasan ditolak: {{ $borrowing->alasan_tolak }}</div>
@endif

@if($borrowing->status === 'dipinjam')
  @if(auth()->user()->isStaf())
  <form action="{{ route('borrowings.verify', $borrowing) }}" method="POST" class="d-flex flex-wrap gap-2 align-items-end"
        onsubmit="return confirm('Verifikasi pengembalian?')">
    @csrf
    <div>
      <label class="form-label small mb-0">Kondisi buku</label>
      <select name="kondisi_buku" class="form-select form-select-sm">
        <option value="baik">Baik</option>
        <option value="rusak_ringan">Rusak ringan</option>
        <option value="rusak_berat">Rusak berat</option>
        <option value="hilang">Hilang</option>
      </select>
    </div>
    <button class="btn btn-success btn-sm"><i class="bi bi-check2"></i> Verifikasi Kembali</button>
  </form>
  <form action="{{ route('borrowings.extend', $borrowing) }}" method="POST" class="d-flex gap-1 align-items-end"
        onsubmit="return confirm('Perpanjang peminjaman?')">
    @csrf
    <select name="hari" class="form-select form-select-sm" style="width:auto">
      <option value="3">+3 hari</option>
      <option value="7" selected>+7 hari</option>
      <option value="14">+14 hari</option>
    </select>
    <button class="btn btn-outline-primary btn-sm"><i class="bi bi-calendar-plus"></i> Perpanjang</button>
  </form>
  @else
  <form action="{{ route('borrowings.return', $borrowing) }}" method="POST" onsubmit="return confirm('Ajukan pengembalian?')">
    @csrf
    <button class="btn btn-primary btn-sm"><i class="bi bi-box-arrow-in-left"></i> Ajukan Pengembalian</button>
  </form>
  @endif
@endif

@if($borrowing->status === 'menunggu_verifikasi' && auth()->user()->isStaf())
<form action="{{ route('borrowings.verify', $borrowing) }}" method="POST" class="d-flex flex-wrap gap-2 align-items-end"
      onsubmit="return confirm('Setujui pengembalian?')">
  @csrf
  <div>
    <label class="form-label small mb-0">Kondisi buku</label>
    <select name="kondisi_buku" class="form-select form-select-sm">
      <option value="baik">Baik</option>
      <option value="rusak_ringan">Rusak ringan</option>
      <option value="rusak_berat">Rusak berat</option>
      <option value="hilang">Hilang</option>
    </select>
  </div>
  <button class="btn btn-success btn-sm"><i class="bi bi-check2-all"></i> Setujui Kembali</button>
</form>
@endif

@if($borrowing->status === 'dipinjam' && auth()->user()->isStaf())
<form action="{{ route('borrowings.remind', $borrowing) }}" method="POST" class="d-inline">@csrf
  <button class="btn btn-outline-warning btn-sm"><i class="bi bi-bell"></i> Ingatkan</button>
</form>
@endif
@if($borrowing->denda > 0 && !$borrowing->denda_lunas && auth()->user()->isStaf())
<form action="{{ route('borrowings.payFine', $borrowing) }}" method="POST" onsubmit="return confirm('Tandai denda lunas?')">
  @csrf
  <button class="btn btn-warning btn-sm"><i class="bi bi-cash"></i> Tandai Denda Lunas</button>
</form>
@endif

<a href="{{ route('borrowings.print', $borrowing) }}" class="btn btn-outline-dark btn-sm" target="_blank"><i class="bi bi-printer"></i> Cetak</a>
<a href="{{ route('borrowings.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
</div>
</div>

@if($borrowing->status === 'menunggu_pinjam' && (auth()->user()->isStaf() || (int)$borrowing->pengguna_id === (int)auth()->id()))
<div class="mt-3">
  <form action="{{ route('borrowings.cancel', $borrowing) }}" method="POST" onsubmit="return confirm('Batalkan pengajuan pinjam?')">
    @csrf
    <button class="btn btn-outline-danger rounded-pill">Batalkan Pengajuan</button>
  </form>
</div>
@endif

@endsection
