@extends('layouts.app')
@section('title', 'Bantuan')
@section('content')
@php $wa = \App\Models\Setting::kontakWhatsapp(); @endphp
<div class="{{ auth()->check() ? '' : 'container py-4' }}">
  <h4 class="fw-bold mb-3">Bantuan Penggunaan</h4>
  <div class="row g-3">
    <div class="col-md-6">
      <div class="card-soft p-4 h-100">
        <h6 class="fw-bold">Untuk Anggota</h6>
        <ol class="small mb-0">
          <li>Daftar akun atau login</li>
          <li>Cari buku di katalog</li>
          <li>Ajukan pinjam (menunggu persetujuan petugas)</li>
          <li>Ambil buku di perpustakaan</li>
          <li>Ajukan pengembalian lewat aplikasi</li>
          <li>Serahkan buku fisik ke petugas</li>
        </ol>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card-soft p-4 h-100">
        <h6 class="fw-bold">Untuk Petugas / Admin</h6>
        <ol class="small mb-0">
          <li>Login di <a href="{{ route('staf.login') }}">/staf-login</a></li>
          <li>Setujui/tolak pengajuan pinjam</li>
          <li>Verifikasi pengembalian + kondisi buku</li>
          <li>Perpanjang / tandai denda lunas</li>
          <li>Admin: kelola buku, user, laporan, pengaturan</li>
        </ol>
      </div>
    </div>
  </div>
  <div class="card-soft p-4 mt-3">
    <h6 class="fw-bold">Kontak</h6>
    <p class="mb-2 small text-muted">Butuh bantuan? Hubungi admin perpustakaan.</p>
    <a class="btn btn-success rounded-pill" href="https://wa.me/{{ $wa }}" target="_blank">
      <i class="bi bi-whatsapp"></i> Chat WhatsApp
    </a>
    <a class="btn btn-outline-primary rounded-pill" href="{{ route('contacts.create') }}">Kirim pesan</a>
  </div>
</div>
@endsection
