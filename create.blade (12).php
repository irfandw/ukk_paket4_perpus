@extends('layouts.app')
@section('title', 'Kontak')
@section('content')
<div class="col-lg-7 mx-auto">
<h4 class="fw-bold mb-3">Hubungi Kami</h4>
<div class="card-soft p-4">
<form method="POST" action="{{ route('contacts.store') }}">@csrf
    <div class="mb-3"><label class="form-label">Nama *</label><input type="text" name="name" class="form-control" value="{{ old('name', auth()->user()->name ?? '') }}" required></div>
    <div class="mb-3"><label class="form-label">Email *</label><input type="email" name="email" class="form-control" value="{{ old('email', auth()->user()->email ?? '') }}" required></div>
    <div class="mb-3"><label class="form-label">Subjek</label><input type="text" name="subject" class="form-control" value="{{ old('subject') }}"></div>
    <div class="mb-3"><label class="form-label">Pesan *</label><textarea name="message" class="form-control" rows="4" required>{{ old('message') }}</textarea></div>
    <button class="btn btn-brand rounded-pill">Kirim</button>
</form>
</div>
</div>
@endsection
