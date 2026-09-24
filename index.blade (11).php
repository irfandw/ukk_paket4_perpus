@extends('layouts.app')
@section('title', 'Pesan Kontak')
@section('content')
<h4 class="fw-bold mb-4">Pesan Kontak</h4>
<div class="card-soft">
<table class="table mb-0">
<thead class="table-light"><tr><th>Nama</th><th>Email</th><th>Subjek</th><th>Status</th><th></th></tr></thead>
<tbody>
@foreach($contacts as $c)
<tr>
<td>{{ $c->name }}</td><td>{{ $c->email }}</td><td>{{ $c->subject }}</td>
<td>@if($c->is_read)<span class="badge bg-secondary">Dibaca</span>@else<span class="badge bg-primary">Baru</span>@endif</td>
<td><a href="{{ route('contacts.show', $c) }}" class="btn btn-sm btn-outline-primary">Lihat</a></td>
</tr>
@endforeach
</tbody>
</table>
</div>
{{ $contacts->links() }}
@endsection
