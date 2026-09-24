@extends('layouts.app')
@section('title', 'Error Dashboard')
@section('content')
<div class="card-soft p-4">
  <h4 class="text-danger">Dashboard error</h4>
  <p class="mb-1"><strong>{{ $message ?? 'Terjadi kesalahan' }}</strong></p>
  <p class="small text-muted">{{ $file ?? '' }}:{{ $line ?? '' }}</p>
  <p class="small">Pastikan sudah import <code>DB_LENGKAP_DENGAN_ADMIN.sql</code> (tabel Bahasa Indonesia).</p>
  <a href="{{ route('home') }}" class="btn btn-brand rounded-pill">Ke Beranda</a>
  <form action="{{ route('logout') }}" method="POST" class="d-inline">@csrf
    <button class="btn btn-outline-secondary rounded-pill">Logout</button>
  </form>
</div>
@endsection
