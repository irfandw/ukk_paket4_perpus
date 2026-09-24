@extends('layouts.app')
@section('title', 'Favorit Saya')
@section('content')
<h4 class="fw-bold mb-1">Buku Favorit</h4>
<p class="text-muted mb-4">Koleksi yang kamu tandai</p>

<div class="row g-3">
    @forelse($favorites as $fav)
        @php $book = $fav->book; @endphp
        @if($book)
        <div class="col-6 col-md-4 col-xl-3">
            <div class="book-card h-100">
                <a href="{{ route('books.show', $book) }}" class="text-decoration-none text-dark">
                    @if($book->cover)
                        <img src="{{ asset('storage/' . $book->cover) }}" class="book-cover" alt="">
                    @else
                        <div class="book-cover d-flex align-items-center justify-content-center bg-light">
                            <i class="bi bi-book" style="font-size:2.5rem;color:#94a3b8;"></i>
                        </div>
                    @endif
                    <div class="p-3">
                        <h6 class="fw-bold mb-1" style="font-size:.92rem;">{{ Str::limit($book->title, 40) }}</h6>
                        <p class="small text-muted mb-0">{{ $book->author }}</p>
                    </div>
                </a>
                <div class="px-3 pb-3">
                    <form action="{{ route('favorites.toggle', $book) }}" method="POST">
                        @csrf
                        <button class="btn btn-outline-danger btn-sm w-100 rounded-pill">
                            <i class="bi bi-heart-fill"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endif
    @empty
    <div class="col-12">
        <div class="card-soft text-center py-5">
            <i class="bi bi-heart" style="font-size:2.5rem;color:#94a3b8;"></i>
            <p class="text-muted mt-3">Belum ada favorit. Tandai buku dari halaman detail.</p>
            <a href="{{ route('books.index') }}" class="btn btn-brand rounded-pill">Jelajahi Katalog</a>
        </div>
    </div>
    @endforelse
</div>
@if($favorites->hasPages())
<div class="mt-4">{{ $favorites->links() }}</div>
@endif
@endsection
