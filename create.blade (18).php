@extends('layouts.app')
@section('title', 'Pinjam Buku')
@section('content')
<h4 class="fw-bold mb-4">Form Peminjaman Buku</h4>
<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('borrowings.store') }}">
            @csrf
            @if(auth()->user()->isAdmin())
            <div class="mb-3">
                <label class="form-label">Anggota *</label>
                <select name="user_id" class="form-select" required>
                    <option value="">Pilih Anggota</option>
                    @foreach($users as $u)
                    <option value="{{ $u->id }}" {{ old('user_id') == $u->id ? 'selected' : '' }}>{{ $u->name }} ({{ $u->email }})</option>
                    @endforeach
                </select>
            </div>
            @else
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            @endif

            <div class="mb-3">
                <label class="form-label">Buku *</label>
                <select name="book_id" class="form-select" required>
                    <option value="">Pilih Buku</option>
                    @foreach($books as $book)
                    <option value="{{ $book->id }}" {{ old('book_id', $selectedBook->id ?? request('book_id')) == $book->id ? 'selected' : '' }}>
                        {{ $book->title }} — {{ $book->author }} (tersedia: {{ $book->available }})
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Lama Pinjam *</label>
                <select name="lama_hari" class="form-select" required>
                    <option value="3" {{ old('lama_hari') == 3 ? 'selected' : '' }}>3 hari</option>
                    <option value="7" {{ old('lama_hari', 7) == 7 ? 'selected' : '' }}>7 hari</option>
                    <option value="14" {{ old('lama_hari') == 14 ? 'selected' : '' }}>14 hari</option>
                </select>
                <div class="form-text">Denda keterlambatan: <strong>Rp 2.000 / hari</strong></div>
            </div>

            <div class="mb-3">
                <label class="form-label">Catatan</label>
                <textarea name="notes" class="form-control" rows="2">{{ old('notes') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Peminjaman</button>
            <a href="{{ route('borrowings.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
