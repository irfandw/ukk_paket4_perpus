@extends('layouts.app')
@section('title', 'Pengaturan')
@section('content')
<h4 class="fw-bold mb-1">Pengaturan</h4>
<p class="text-muted mb-4">Konfigurasi sistem perpustakaan</p>
<div class="card-soft p-4 col-lg-7">
<form method="POST" action="{{ route('settings.update') }}">@csrf
  <div class="mb-3">
    <label class="form-label">Nama Perpustakaan</label>
    <input type="text" name="nama_perpustakaan" class="form-control" value="{{ $settings['nama_perpustakaan'] }}">
  </div>
  <div class="mb-3">
    <label class="form-label">Alamat</label>
    <input type="text" name="alamat_perpus" class="form-control" value="{{ $settings['alamat_perpus'] ?? 'SDN 1 Kalidadap, Selopamioro, Imogiri, Bantul, DIY' }}">
  </div>
  <div class="mb-3">
    <label class="form-label">Denda per hari (Rp)</label>
    <input type="number" name="denda_per_hari" class="form-control" value="{{ $settings['denda_per_hari'] }}" min="0" required>
  </div>
  <div class="row">
    <div class="col-md-6 mb-3">
      <label class="form-label">Maks buku aktif / anggota</label>
      <input type="number" name="maks_buku_aktif" class="form-control" value="{{ $settings['maks_buku_aktif'] }}" min="1" max="20" required>
    </div>
    <div class="col-md-6 mb-3">
      <label class="form-label">Maks hari pinjam</label>
      <input type="number" name="maks_hari_pinjam" class="form-control" value="{{ $settings['maks_hari_pinjam'] }}" min="1" max="60" required>
    </div>
  </div>
  <div class="mb-3">
    <label class="form-label">WhatsApp Admin (format 62...)</label>
    <input type="text" name="kontak_whatsapp" class="form-control" value="{{ $settings['kontak_whatsapp'] }}" placeholder="62812...">
    <div class="form-text">Dipakai untuk tombol kontak WA & notifikasi staf</div>
  </div>

  <hr class="my-4">
  <h6 class="fw-bold mb-3">Notifikasi WhatsApp (Gateway)</h6>
  <div class="row">
    <div class="col-md-6 mb-3">
      <label class="form-label">Kirim WA ke staf</label>
      <select name="notif_wa_staf" class="form-select">
        <option value="0" @selected(($settings['notif_wa_staf'] ?? '0') == '0')>Nonaktif</option>
        <option value="1" @selected(($settings['notif_wa_staf'] ?? '0') == '1')>Aktif</option>
      </select>
    </div>
    <div class="col-md-6 mb-3">
      <label class="form-label">Kirim WA ke anggota</label>
      <select name="notif_wa_anggota" class="form-select">
        <option value="0" @selected(($settings['notif_wa_anggota'] ?? '0') == '0')>Nonaktif</option>
        <option value="1" @selected(($settings['notif_wa_anggota'] ?? '0') == '1')>Aktif</option>
      </select>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 mb-3">
      <label class="form-label">Gateway</label>
      <select name="wa_gateway" class="form-select">
        <option value="fonnte" @selected(($settings['wa_gateway'] ?? 'fonnte') == 'fonnte')>Fonnte</option>
        <option value="generic" @selected(($settings['wa_gateway'] ?? '') == 'generic')>Generic URL</option>
      </select>
    </div>
    <div class="col-md-6 mb-3">
      <label class="form-label">API Token</label>
      <input type="text" name="wa_api_token" class="form-control" value="{{ $settings['wa_api_token'] ?? '' }}" placeholder="Token Fonnte / Bearer">
    </div>
  </div>
  <div class="mb-3">
    <label class="form-label">API URL (opsional)</label>
    <input type="text" name="wa_api_url" class="form-control" value="{{ $settings['wa_api_url'] ?? '' }}" placeholder="Kosong = default Fonnte">
  </div>

  <hr class="my-4">
  <h6 class="fw-bold mb-3"><i class="bi bi-person-vcard"></i> Kartu Anggota</h6>
  <p class="text-muted small mb-3">Pengaturan ini dipakai saat mencetak kartu anggota.</p>
  <div class="row">
    <div class="col-md-4 mb-3">
      <label class="form-label">Masa berlaku (tahun)</label>
      <input type="number" name="kartu_masa_berlaku_tahun" class="form-control" value="{{ $settings['kartu_masa_berlaku_tahun'] ?? 1 }}" min="1" max="5">
    </div>
    <div class="col-md-4 mb-3">
      <label class="form-label">Warna kartu</label>
      <input type="color" name="kartu_warna" class="form-control form-control-color w-100" value="{{ $settings['kartu_warna'] ?? '#2563eb' }}">
    </div>
    <div class="col-md-4 mb-3">
      <label class="form-label">Tampilkan QR Code</label>
      <select name="kartu_tampilkan_qr" class="form-select">
        <option value="1" @selected(($settings['kartu_tampilkan_qr'] ?? '1') == '1')>Ya</option>
        <option value="0" @selected(($settings['kartu_tampilkan_qr'] ?? '1') == '0')>Tidak</option>
      </select>
    </div>
  </div>
  <div class="mb-3">
    <label class="form-label">Teks footer kartu</label>
    <input type="text" name="kartu_footer" class="form-control" value="{{ $settings['kartu_footer'] ?? '' }}" placeholder="Kartu ini berlaku untuk meminjam buku...">
  </div>

  <button class="btn btn-brand rounded-pill">Simpan</button>
</form>
</div>
@endsection
