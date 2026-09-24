@extends('layouts.app')
@section('title', 'Edit Buku')
@section('content')
<h4 class="mb-4">Edit Buku</h4>
<div class="card-soft p-4">
    <form method="POST" action="{{ route('books.update', $book) }}" enctype="multipart/form-data">
        @csrf @method('PUT')

        <h6 class="fw-bold text-secondary mb-3">Data utama</h6>
        <div class="row">
            <div class="col-md-8 mb-3">
                <label class="form-label">Judul Buku *</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $book->title) }}" required>
                @error('title')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Kategori *</label>
                <select name="category_id" class="form-select" required>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id', $book->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Penulis *</label>
                <input type="text" name="author" class="form-control" value="{{ old('author', $book->author) }}" required>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label">ISBN</label>
                <input type="text" name="isbn" class="form-control" value="{{ old('isbn', $book->isbn) }}">
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label">Stok *</label>
                <input type="number" name="stock" class="form-control" value="{{ old('stock', $book->stock) }}" min="0" required>
                @error('stock')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-3">
                <label class="form-label">Kode Buku</label>
                <input type="text" name="kode_buku" class="form-control" value="{{ old('kode_buku', $book->kode_buku) }}" placeholder="BK001">
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label">Penerbit</label>
                <input type="text" name="penerbit" class="form-control" value="{{ old('penerbit', $book->penerbit ?? $book->publisher) }}">
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label">Tahun Terbit</label>
                <input type="number" name="tahun_terbit" class="form-control" value="{{ old('tahun_terbit', $book->tahun_terbit ?? $book->year_published) }}" min="1900" max="2100">
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label">Rak</label>
                <input type="text" name="rak" class="form-control" value="{{ old('rak', $book->rak) }}" placeholder="A-1">
            </div>
        </div>

        <hr class="my-3">
        <h6 class="fw-bold text-secondary mb-3">Kondisi fisik buku</h6>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Kondisi Buku *</label>
                <select name="kondisi" class="form-select" required>
                    @foreach(['Baik','Cukup Baik','Rusak Ringan','Rusak Berat'] as $k)
                    <option value="{{ $k }}" {{ old('kondisi', $book->kondisi ?? 'Baik') == $k ? 'selected' : '' }}>{{ $k }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-8 mb-3">
                <label class="form-label">Keterangan Kondisi</label>
                <input type="text" name="keterangan_kondisi" class="form-control"
                       value="{{ old('keterangan_kondisi', $book->keterangan_kondisi ?? '') }}"
                       placeholder="Contoh: halaman 10 hilang/sobek, cover lecet, jilid longgar">
                <div class="form-text">Isi detail kerusakan. Contoh: <em>halaman 10 hilang/sobek</em></div>
                @error('keterangan_kondisi')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
        </div>

        <hr class="my-3">
        <h6 class="fw-bold text-secondary mb-3">Sinopsis</h6>
        <div class="mb-3">
            <label class="form-label">Deskripsi / Sinopsis</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description', $book->description) }}</textarea>
        </div>

        <hr class="my-3">
        <h6 class="fw-bold text-secondary mb-3">Cover &amp; PDF baca online</h6>
        <div class="mb-3">
            <label class="form-label">Cover Buku</label>
            @if($book->cover)
                <div class="mb-2"><img src="{{ $book->coverUrl() }}" height="80" class="rounded" alt="cover"></div>
                @if($book->isExternalCover())
                  <div class="small text-muted mb-1">URL: {{ Str::limit($book->cover, 60) }}</div>
                @endif
            @endif
            <input type="file" name="cover" class="form-control" accept="image/*">
            <div class="form-text">Atau ganti dengan URL gambar</div>
            <input type="url" name="cover_url" class="form-control mt-2" placeholder="https://.../cover.jpg" value="{{ old('cover_url', $book->isExternalCover() ? $book->cover : '') }}">
            @error('cover_url')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">File PDF untuk Baca Online</label>
            <input type="file" name="file_pdf" class="form-control" accept="application/pdf">
            @if($book->file_pdf)
              <div class="form-text text-success">PDF saat ini: {{ Str::limit($book->file_pdf, 80) }}
                — <a href="{{ route('books.baca', $book) }}" target="_blank">Buka baca online</a>
              </div>
            @else
              <div class="form-text">Belum ada PDF. Upload file atau isi URL agar anggota bisa baca online.</div>
            @endif
            <input type="url" name="pdf_url" class="form-control mt-2" placeholder="https://.../laskar-pelangi.pdf" value="{{ old('pdf_url', $book->isExternalPdf() ? $book->file_pdf : '') }}">
            <div class="form-text">Upload PDF baru atau tempel URL PDF publik</div>
            @error('file_pdf')<div class="text-danger small">{{ $message }}</div>@enderror
            @error('pdf_url')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>

        <button type="submit" class="btn btn-brand rounded-pill px-4">Update Buku</button>
        <a href="{{ route('books.index') }}" class="btn btn-outline-secondary rounded-pill">Batal</a>
    </form>
</div>
@endsection
