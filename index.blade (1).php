@extends('layouts.app')
@section('title', 'Notifikasi')
@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
  <div>
    <h4 class="fw-bold mb-0">Notifikasi</h4>
    <p class="text-muted small mb-0">Pesan untuk akun Anda</p>
  </div>
  <div class="d-flex gap-2 flex-wrap">
    <button type="button" class="btn btn-warning btn-sm rounded-pill fw-semibold"
      onclick="if(window.enableWebPush){window.enableWebPush();}else{alert('Refresh halaman dulu');}">
      <i class="bi bi-bell"></i> Aktifkan Notif Chrome
    </button>
    @if(auth()->user()->isStaf())
    <a href="{{ route('staff.notifications') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
      <i class="bi bi-bell-fill"></i> Notif Staf
    </a>
    @endif
  </div>
</div>

<div id="webpush-panel" class="mb-3"></div>

<div class="card-soft overflow-hidden">
@forelse($items as $n)
  @php
    $type = $n->tipe ?? $n->type ?? 'info';
    $judul = $n->judul ?? $n->title ?? '(Tanpa judul)';
    $pesan = $n->pesan ?? $n->message ?? null;
    $dibaca = (bool)($n->sudah_dibaca ?? $n->is_read ?? false);
    $icon = match($type) {
      'success' => 'bi-check-circle-fill text-success',
      'warning' => 'bi-exclamation-triangle-fill text-warning',
      'danger'  => 'bi-x-circle-fill text-danger',
      default   => 'bi-info-circle-fill text-primary',
    };
    $bg = $dibaca ? '' : 'bg-primary bg-opacity-10';
  @endphp
  <div class="border-bottom p-3 {{ $bg }}">
    <div class="d-flex gap-3">
      <div class="fs-5 pt-1"><i class="bi {{ $icon }}"></i></div>
      <div class="flex-grow-1">
        <div class="d-flex justify-content-between gap-2">
          <strong class="{{ $dibaca ? '' : 'text-dark' }}">{{ $judul }}</strong>
          <small class="text-muted text-nowrap">{{ $n->created_at?->diffForHumans() ?? '' }}</small>
        </div>
        @if($pesan)
          <p class="mb-0 small text-secondary mt-1">{{ $pesan }}</p>
        @endif
        @if(!$dibaca)
          <span class="badge text-bg-primary mt-1" style="font-size:.65rem;">Baru</span>
        @endif
      </div>
    </div>
  </div>
@empty
  <div class="p-5 text-center text-muted">
    <i class="bi bi-bell-slash fs-2 d-block mb-2 opacity-50"></i>
    Belum ada notifikasi.
  </div>
@endforelse
</div>
@if($items->hasPages())
<div class="mt-3 d-flex justify-content-center">{{ $items->links() }}</div>
@endif
@endsection
