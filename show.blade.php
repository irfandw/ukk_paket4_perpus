@extends('layouts.app')
@section('title', $book->title)
@section('content')
<nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ route('books.index') }}" class="text-decoration-none">Katalog</a></li>
        <li class="breadcrumb-item active">{{ Str::limit($book->title, 40) }}</li>
    </ol>
</nav>

<div class="row g-4">
    <div class="col-md-4 col-lg-3">
        <div class="card-soft overflow-hidden">
            @if($book->cover)
                <img src="{{ $book->coverUrl() }}" class="w-100" style="height:340px;object-fit:cover;" alt="{{ $book->title }}">
            @else
                <div class="d-flex align-items-center justify-content-center bg-light" style="height:340px;">
                    <i class="bi bi-book" style="font-size:5rem;color:#94a3b8;"></i>
                </div>
            @endif
        </div>
        @auth
        <form action="{{ route('favorites.toggle', $book) }}" method="POST" class="mt-3">
            @csrf
            <button type="submit" class="btn w-100 rounded-pill {{ $isFavorite ? 'btn-danger' : 'btn-outline-danger' }}">
                <i class="bi {{ $isFavorite ? 'bi-heart-fill' : 'bi-heart' }}"></i>
                {{ $isFavorite ? 'Hapus dari Favorit' : 'Tambah ke Favorit' }}
            </button>
        </form>
        @endauth
    </div>
    <div class="col-md-8 col-lg-9">
        <div class="card-soft p-4">
            <div class="d-flex flex-wrap gap-2 mb-3">
                <span class="badge badge-soft text-bg-primary">{{ $book->category->name ?? 'Umum' }}</span>
                @if($book->isAvailable())
                    <span class="badge badge-soft text-bg-success"><i class="bi bi-check-circle"></i> Tersedia ({{ $book->available }})</span>
                @else
                    <span class="badge badge-soft text-bg-danger"><i class="bi bi-x-circle"></i> Habis</span>
                @endif
                @if(($ratingCount ?? 0) > 0)
                    <span class="badge badge-soft text-bg-warning text-dark">
                        {{ str_repeat('★', (int)round($avgRating)) }}{{ str_repeat('☆', 5-(int)round($avgRating)) }}
                        {{ number_format($avgRating, 1) }}/5 · {{ $ratingCount }} ulasan
                    </span>
                @else
                    <span class="badge badge-soft text-bg-light text-secondary">Belum ada rating</span>
                @endif
            </div>

            <h2 class="fw-bold mb-1" style="letter-spacing:-.03em;">{{ $book->title }}</h2>
            <p class="text-muted mb-2">oleh <strong class="text-dark">{{ $book->author }}</strong></p>
            @if($book->kode_buku ?? null)<div class="small text-muted mb-1">Kode: {{ $book->kode_buku }}</div>@endif
            @if($book->penerbit ?? null)<div class="small text-muted mb-1">{{ $book->penerbit }}@if($book->tahun_terbit) · {{ $book->tahun_terbit }}@endif</div>@endif
            @if($book->rak ?? null)<div class="small text-muted mb-3">Rak: {{ $book->rak }}</div>@endif

            <div class="row g-2 mb-4">
                @foreach([
                    ['Stok', $book->available.'/'.$book->stock],
                    ['Kondisi', $book->kondisi ?? 'Baik'],
                    ['Tahun', $book->year_published ?? '-'],
                    ['Penerbit', $book->publisher ?? '-'],
                    ['ISBN', $book->isbn ?? '-'],
                    ['Rak', $book->rak ?? '-'],
                ] as [$label, $val])
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="rounded-3 p-3 bg-light h-100">
                        <div class="small text-muted">{{ $label }}</div>
                        <div class="fw-bold @if($label==='Kondisi') {{ $book->kondisiBadgeClass() }} rounded-pill px-2 d-inline-block @endif">{{ $val }}</div>
                    </div>
                </div>
                @endforeach
            </div>

            @if(!empty($book->keterangan_kondisi))
            <div class="alert alert-warning d-flex align-items-start gap-2 py-2 px-3 mb-3" role="alert">
                <i class="bi bi-exclamation-triangle-fill mt-1"></i>
                <div>
                    <div class="fw-semibold">Catatan kondisi</div>
                    <div class="small mb-0">{{ $book->keterangan_kondisi }}</div>
                </div>
            </div>
            @endif

            @if($book->hasPdf())
            <div class="d-flex flex-wrap gap-2 mb-3">
              <a href="{{ route('books.baca', $book) }}" class="btn btn-danger rounded-pill">
                  <i class="bi bi-file-earmark-pdf"></i> Baca PDF Online
              </a>
              <a href="{{ route('books.baca', $book) }}" class="btn btn-outline-danger rounded-pill" target="_blank">
                  <i class="bi bi-box-arrow-up-right"></i> Buka di tab baru
              </a>
            </div>
            <div class="rounded-3 border overflow-hidden mb-3 d-none d-md-block" style="height:420px;background:#0f172a">
              <iframe src="{{ $book->isExternalPdf() ? $book->file_pdf : route('books.baca.stream', $book) }}#toolbar=0&view=FitH" style="width:100%;height:100%;border:0" title="Preview PDF"></iframe>
            </div>
            @else
            <div class="alert alert-light border mb-3 py-2 px-3 small text-muted">
                <i class="bi bi-file-earmark-pdf"></i> PDF digital belum diunggah untuk buku ini.
                @auth
                  @if(auth()->user()->isStaf())
                    <a href="{{ route('books.edit', $book) }}">Upload PDF di Edit Buku</a>
                  @endif
                @endauth
            </div>
            @endif

            @if($book->description)
            <h6 class="fw-bold">Sinopsis</h6>
            <p class="text-secondary mb-4">{{ $book->description }}</p>
            @endif

            <hr class="opacity-10">

            @if($book->isAvailable())
                @auth
                <form action="{{ route('borrowings.store') }}" method="POST" class="row g-3 align-items-end"
                      onsubmit="return confirm('Konfirmasi peminjaman buku ini?')">
                    @csrf
                    <input type="hidden" name="buku_id" value="{{ $book->id }}">
                    <input type="hidden" name="pengguna_id" value="{{ auth()->id() }}">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Lama pinjam</label>
                        <select name="lama_hari" class="form-select form-select-lg rounded-3" required>
                            <option value="3">3 hari</option>
                            <option value="7" selected>7 hari</option>
                            <option value="14">14 hari</option>
                        </select>
                        <div class="form-text">Denda terlambat: Rp {{ number_format(\App\Models\Setting::dendaPerHari(),0,',','.') }} / hari</div>
                    </div>
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-brand btn-lg rounded-pill px-4">
                            <i class="bi bi-journal-arrow-down"></i> Ajukan Pinjam
                        </button>
                        <a href="{{ route('books.index') }}" class="btn btn-outline-secondary btn-lg rounded-pill">Kembali</a>
                    </div>
                </form>
                @else
                <div class="rounded-3 p-4 d-flex flex-wrap align-items-center gap-3"
                     style="background:linear-gradient(135deg,#eff6ff,#f0f9ff);border:1px solid #bfdbfe;">
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3">
                        <i class="bi bi-lock-fill text-primary fs-4"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="fw-bold">Login diperlukan untuk meminjam</div>
                        <small class="text-muted">Daftar atau masuk sebagai anggota untuk melanjutkan.</small>
                    </div>
                    <a href="{{ route('login') }}?redirect={{ urlencode(route('books.show', $book)) }}" class="btn btn-brand rounded-pill px-4">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-primary rounded-pill px-3">Daftar</a>
                </div>
                @endauth
            @else
                <button class="btn btn-secondary btn-lg rounded-pill" disabled>Tidak Tersedia</button>
                <a href="{{ route('books.index') }}" class="btn btn-outline-secondary btn-lg rounded-pill">Kembali</a>
            @endif

            @auth
                @if(auth()->user()->isAdmin())
                <div class="mt-3">
                    <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-outline-primary rounded-pill">
                        <i class="bi bi-pencil"></i> Edit Buku
                    </a>
                </div>
                @endif
            @endauth
        </div>
    </div>
</div>

{{-- Rating & Ulasan --}}
<div class="card-soft p-4 mt-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <h5 class="fw-bold mb-0"><i class="bi bi-star-fill text-warning"></i> Rating & Ulasan</h5>
        <div>
            @if(($ratingCount ?? 0) > 0)
                <span class="text-warning fs-5">{{ str_repeat('★', (int)round($avgRating)) }}{{ str_repeat('☆', 5-(int)round($avgRating)) }}</span>
                <span class="text-muted">{{ number_format($avgRating, 1) }}/5 · {{ $ratingCount }} ulasan</span>
            @else
                <span class="text-muted">Belum ada rating</span>
            @endif
        </div>
    </div>

    @auth
    <div class="rounded-3 p-3 mb-4" style="background:#f8fafc;border:1px solid #e2e8f0;">
        <h6 class="fw-bold mb-2">{{ $myReview ? 'Edit ulasan Anda' : 'Tulis ulasan' }}</h6>
        <form action="{{ route('reviews.store', $book) }}" method="POST" class="row g-2 align-items-end">
            @csrf
            <div class="col-md-3">
                <label class="form-label small">Rating</label>
                <select name="rating" class="form-select" required>
                    @for($i=5;$i>=1;$i--)
                    <option value="{{ $i }}" @selected(old('rating', $myReview->rating ?? 5)==$i)>{{ str_repeat('★',$i) }} ({{ $i }})</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-7">
                <label class="form-label small">Komentar</label>
                <input type="text" name="comment" class="form-control" maxlength="1000"
                       value="{{ old('comment', $myReview->comment ?? '') }}" placeholder="Bagaimana buku ini?">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-brand w-100 rounded-pill">Simpan</button>
            </div>
        </form>
    </div>
    @else
    <p class="text-muted small mb-3">
        <a href="{{ route('login') }}?redirect={{ urlencode(route('books.show', $book)) }}">Masuk</a> untuk menulis ulasan.
    </p>
    @endauth

    @if(($ratingCount ?? 0) === 0)
      <div class="empty-state py-4">Belum ada ulasan. Jadilah yang pertama!</div>
    @else
      @foreach($book->reviews->sortByDesc('created_at') as $u)
      <div class="border-bottom py-3">
        <div class="d-flex justify-content-between">
          <div>
            <strong>{{ $u->user->name ?? 'Anonim' }}</strong>
            <span class="text-warning ms-2">{{ str_repeat('★', (int)$u->rating) }}{{ str_repeat('☆', 5-(int)$u->rating) }}</span>
          </div>
          <small class="text-muted">{{ $u->created_at?->diffForHumans() }}</small>
        </div>
        @if($u->comment ?? $u->komentar ?? null)
          <p class="mb-0 small text-secondary mt-1">{{ $u->comment ?? $u->komentar }}</p>
        @endif
      </div>
      @endforeach
    @endif
</div>
@endsection
