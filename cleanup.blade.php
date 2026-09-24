@extends('layouts.app')
@section('title', 'Pembersihan DB')
@section('content')
<h4 class="fw-bold mb-1">Pembersihan Database</h4>
<p class="text-muted mb-4">Hapus data notifikasi lama (aman)</p>
<div class="row g-3 mb-4">
  <div class="col-md-4"><div class="stat-tile p-3"><div class="small text-muted">Notif sudah dibaca</div><div class="fs-3 fw-bold">{{ $stats['notif_read'] }}</div></div></div>
  <div class="col-md-4"><div class="stat-tile p-3"><div class="small text-muted">Notif > 30 hari</div><div class="fs-3 fw-bold">{{ $stats['notif_old'] }}</div></div></div>
  <div class="col-md-4"><div class="stat-tile p-3"><div class="small text-muted">Pesan kontak dibaca</div><div class="fs-3 fw-bold">{{ $stats['contacts_read'] }}</div></div></div>
</div>
<div class="card-soft p-4 col-lg-6">
<form method="POST" action="{{ route('cleanup.run') }}" onsubmit="return confirm('Jalankan pembersihan?')">@csrf
  <div class="form-check mb-2">
    <input class="form-check-input" type="checkbox" name="notif_old" value="1" id="n1" checked>
    <label class="form-check-label" for="n1">Hapus notifikasi lebih dari 30 hari</label>
  </div>
  <div class="form-check mb-3">
    <input class="form-check-input" type="checkbox" name="notif_read" value="1" id="n2">
    <label class="form-check-label" for="n2">Hapus notifikasi sudah dibaca (>7 hari)</label>
  </div>
  <button class="btn btn-brand rounded-pill">Jalankan</button>
</form>
</div>
@endsection
