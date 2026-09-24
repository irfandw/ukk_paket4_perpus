@extends('layouts.app')
@section('title', 'Cari Anggota')
@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-start gap-2 mb-3">
  <div>
    <h4 class="fw-bold mb-1">Cari Anggota</h4>
    <p class="text-muted mb-0">Referensi data anggota untuk pelayanan meja · Cetak kartu anggota</p>
  </div>
  <div class="d-flex gap-2">
    <a href="{{ route('members.kartu') }}" class="btn btn-outline-primary btn-sm rounded-pill" target="_blank">
      <i class="bi bi-printer"></i> Cetak Semua Aktif
    </a>
  </div>
</div>

<form method="GET" class="card-soft p-3 mb-3">
  <div class="row g-2">
    <div class="col-md-6">
      <input type="text" name="q" class="form-control" placeholder="Nama / NIS / email / kelas..." value="{{ request('q') }}">
    </div>
    <div class="col-md-3">
      <select name="status" class="form-select">
        <option value="">Semua status</option>
        <option value="aktif" {{ request('status')==='aktif'?'selected':'' }}>Aktif</option>
        <option value="nonaktif" {{ request('status')==='nonaktif'?'selected':'' }}>Nonaktif</option>
      </select>
    </div>
    <div class="col-md-3">
      <button class="btn btn-brand w-100">Cari</button>
    </div>
  </div>
</form>

<div class="card-soft">
  <div class="table-responsive">
    <table class="table table-hover mb-0 align-middle">
      <thead class="table-light">
        <tr>
          <th class="ps-3">Nama</th>
          <th>NIS</th>
          <th>Kelas</th>
          <th>Email</th>
          <th>Telepon</th>
          <th>Status</th>
          <th class="text-end pe-3">Kartu</th>
        </tr>
      </thead>
      <tbody>
      @forelse($members as $m)
        <tr>
          <td class="ps-3 fw-semibold">{{ $m->name }}</td>
          <td>{{ $m->nis ?? '-' }}</td>
          <td>{{ $m->kelas ?? '-' }}</td>
          <td>{{ $m->email }}</td>
          <td>{{ $m->phone ?? '-' }}</td>
          <td>
            @if(($m->status ?? 'aktif') === 'aktif')
              <span class="badge bg-success">Aktif</span>
            @else
              <span class="badge bg-secondary">Nonaktif</span>
            @endif
          </td>
          <td class="text-end pe-3">
            <a href="{{ route('members.kartu.id', $m->id) }}" class="btn btn-sm btn-outline-primary rounded-pill" target="_blank" title="Cetak kartu">
              <i class="bi bi-person-vcard"></i> Cetak
            </a>
          </td>
        </tr>
      @empty
        <tr><td colspan="7" class="text-center text-muted py-4">Tidak ditemukan</td></tr>
      @endforelse
      </tbody>
    </table>
  </div>
</div>
{{ $members->links() }}
@endsection
