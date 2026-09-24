@extends('layouts.app')
@section('title', 'Detail Pesan')
@section('content')
<div class="card-soft p-4 col-lg-8">
<p><strong>{{ $contact->name }}</strong> &lt;{{ $contact->email }}&gt;</p>
<p class="text-muted">{{ $contact->subject }} · {{ $contact->created_at->format('d M Y H:i') }}</p>
<hr>
<p>{{ $contact->message }}</p>
@if($contact->reply)
<div class="alert alert-info"><strong>Balasan:</strong> {{ $contact->reply }}</div>
@endif
<form method="POST" action="{{ route('contacts.reply', $contact) }}" class="mt-3">@csrf
<label class="form-label">Balas</label>
<textarea name="reply" class="form-control mb-2" rows="3" required>{{ old('reply', $contact->reply) }}</textarea>
<button class="btn btn-brand rounded-pill">Simpan Balasan</button>
<a href="{{ route('contacts.index') }}" class="btn btn-outline-secondary rounded-pill">Kembali</a>
</form>
</div>
@endsection
