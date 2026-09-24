@extends('layouts.app')
@section('title', 'Tambah Pengguna')
@section('content')
<h4 class="fw-bold mb-4">Tambah Pengguna</h4>
<div class="card-soft p-4 col-lg-8">
<form method="POST" action="{{ route('users.store') }}">@csrf
    <div class="mb-3"><label class="form-label">Nama *</label><input type="text" name="name" class="form-control" value="{{ old('name') }}" required></div>
    <div class="mb-3"><label class="form-label">Email *</label><input type="email" name="email" class="form-control" value="{{ old('email') }}" required></div>
    <div class="mb-3"><label class="form-label">Password *</label><input type="password" name="password" class="form-control" required></div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Role *</label>
            <select name="role" class="form-select" required>
                <option value="anggota">anggota</option>
                <option value="petugas">petugas</option>
                <option value="admin">admin</option>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Status *</label>
            <select name="status" class="form-select" required>
                <option value="aktif">aktif</option>
                <option value="nonaktif">nonaktif</option>
            </select>
        </div>
    </div>
    <div class="row"><div class="col-md-6 mb-3"><label class="form-label">NIS</label><input type="text" name="nis" class="form-control" value="{{ old('nis', $user->nis ?? '') }}"></div>
    <div class="col-md-6 mb-3"><label class="form-label">Kelas</label><input type="text" name="kelas" class="form-control" value="{{ old('kelas', $user->kelas ?? '') }}"></div></div>
    <div class="mb-3"><label class="form-label">Telepon</label><input type="text" name="phone" class="form-control" value="{{ old('phone') }}"></div>
    <div class="mb-3"><label class="form-label">Alamat</label><textarea name="address" class="form-control" rows="2">{{ old('address') }}</textarea></div>
    <button class="btn btn-brand rounded-pill">Simpan</button>
    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary rounded-pill">Batal</a>
</form>
</div>
@endsection
