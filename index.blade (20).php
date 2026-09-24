@extends('layouts.app')
@section('title', 'Notifikasi Staf')
@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
  <div>
    <h4 class="fw-bold mb-0">Notifikasi Staf</h4>
    <p class="text-muted small mb-0">Pengajuan pinjam, pengembalian, dan aktivitas meja</p>
  </div>
  <div class="d-flex gap-2">
    <button type="button" class="btn btn-warning btn-sm rounded-pill fw-semibold"
      onclick="if(window.enableWebPush){window.enableWebPush();}else{alert('Refresh halaman dulu');}">
      <i class="bi bi-bell"></i> Aktifkan Notif Chrome
    </button>
    <a href="{{ route('notifications.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill">Notifikasi saya</a>
  </div>
</div>

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
  @endphp
  <div class="border-bottom p-3 {{ $dibaca ? '' : 'bg-warning bg-opacity-10' }}">
    <div class="d-flex gap-3">
      <div class="fs-5 pt-1"><i class="bi {{ $icon }}"></i></div>
      <div class="flex-grow-1">
        <div class="d-flex justify-content-between gap-2">
          <strong>{{ $judul }}</strong>
          <small class="text-muted text-nowrap">{{ $n->created_at?->diffForHumans() ?? '' }}</small>
        </div>
        @if($pesan)
          <p class="mb-0 small text-secondary mt-1">{{ $pesan }}</p>
        @endif
      </div>
    </div>
  </div>
@empty
  <div class="p-5 text-center text-muted">Belum ada notifikasi staf.</div>
@endforelse
</div>
@if($items->hasPages())
<div class="mt-3">{{ $items->links() }}</div>
@endif
@endsection
