@extends('layouts.app')
@section('title', 'Edit Profil')
@section('content')
<div class="mb-3">
  <h4 class="fw-bold mb-1">Edit Profil</h4>
  <p class="text-muted mb-0">Perbarui data identitas & foto profil. Dipakai di kartu anggota dan sistem.</p>
</div>

{{-- Alert sukses sudah ditampilkan oleh layouts/app — jangan dobel --}}

@if($errors->any())
<div class="alert alert-danger border-0 rounded-3">
  <ul class="mb-0 ps-3">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
</div>
@endif

<div class="row g-3">
  <div class="col-lg-8">
    <div class="card-soft p-4">
      <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="d-flex flex-wrap align-items-center gap-3 mb-4 p-3 rounded-3 border bg-light">
          <div class="flex-shrink-0">
            @php $avatar = $user->avatarUrl(); @endphp
            @if($avatar)
              <img src="{{ $avatar }}" alt="Foto profil" id="avatarPreview"
                   class="rounded-circle border bg-white"
                   style="width:88px;height:88px;object-fit:cover;display:block;"
                   onerror="this.style.display='none';document.getElementById('avatarFallback').style.display='flex';">
              <div id="avatarFallback" class="rounded-circle bg-primary bg-opacity-10 text-primary align-items-center justify-content-center border"
                   style="width:88px;height:88px;font-size:2.2rem;display:none">
                <i class="bi bi-person-fill"></i>
              </div>
            @else
              <div id="avatarPreview" class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center border"
                   style="width:88px;height:88px;font-size:2.2rem">
                <i class="bi bi-person-fill"></i>
              </div>
            @endif
          </div>
          <div class="flex-grow-1" style="min-width:200px">
            <label class="form-label fw-semibold mb-1">Foto profil</label>
            <input type="file" name="foto" id="fotoInput" class="form-control form-control-sm" accept="image/jpeg,image/png,image/webp,image/jpg">
            <div class="form-text">JPG, PNG, atau WebP · maks. 10 MB</div>
            @if($user->hasAvatar())
            <div class="form-check mt-2">
              <input class="form-check-input" type="checkbox" name="hapus_foto" value="1" id="hapusFoto">
              <label class="form-check-label small text-danger" for="hapusFoto">Hapus foto saat ini</label>
            </div>
            @endif
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Nama lengkap</label>
          <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Email</label>
          <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Telepon / WA</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}" placeholder="08…">
          </div>
          @if($user->isAnggota())
          <div class="col-md-3 mb-3">
            <label class="form-label fw-semibold">NIS</label>
            <input type="text" name="nis" class="form-control" value="{{ old('nis', $user->nis) }}">
          </div>
          <div class="col-md-3 mb-3">
            <label class="form-label fw-semibold">Kelas</label>
            <input type="text" name="kelas" class="form-control" value="{{ old('kelas', $user->kelas) }}" placeholder="Contoh: 5A">
          </div>
          @endif
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Alamat</label>
          <textarea name="address" class="form-control" rows="2" placeholder="Alamat lengkap">{{ old('address', $user->address) }}</textarea>
        </div>

        <hr class="my-4">
        <h6 class="fw-bold mb-3">Ganti password <span class="text-muted fw-normal small">(opsional)</span></h6>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label">Password baru</label>
            <input type="password" name="password" class="form-control" autocomplete="new-password" placeholder="Minimal 6 karakter">
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Konfirmasi password</label>
            <input type="password" name="password_confirmation" class="form-control" autocomplete="new-password">
          </div>
        </div>

        <div class="d-flex flex-wrap gap-2 mt-2">
          <button type="submit" class="btn btn-brand rounded-pill px-4">Simpan perubahan</button>
          <a href="{{ url()->previous() }}" class="btn btn-outline-secondary rounded-pill">Batal</a>
          @if($user->isAnggota())
            <a href="{{ route('members.kartu.saya') }}" class="btn btn-outline-primary rounded-pill" target="_blank">
              <i class="bi bi-person-vcard"></i> Lihat kartu saya
            </a>
          @endif
        </div>
      </form>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="card-soft p-4">
      <div class="text-center mb-3">
        @php $avatar2 = $user->avatarUrl(); @endphp
        @if($avatar2)
          <img src="{{ $avatar2 }}" alt="" class="rounded-circle border bg-white"
               style="width:72px;height:72px;object-fit:cover"
               onerror="this.outerHTML='<div class=\'rounded-circle bg-primary bg-opacity-10 text-primary d-inline-flex align-items-center justify-content-center\' style=\'width:72px;height:72px;font-size:2rem\'><i class=\'bi bi-person-fill\'></i></div>'">
        @else
          <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-inline-flex align-items-center justify-content-center" style="width:72px;height:72px;font-size:2rem">
            <i class="bi bi-person-fill"></i>
          </div>
        @endif
        <h5 class="fw-bold mt-2 mb-0">{{ $user->name }}</h5>
        <div class="small text-muted">{{ $user->email }}</div>
      </div>
      <ul class="list-unstyled small mb-0">
        <li class="d-flex justify-content-between py-2 border-bottom">
          <span class="text-muted">Peran</span>
          <strong class="text-capitalize">{{ $user->role }}</strong>
        </li>
        <li class="d-flex justify-content-between py-2 border-bottom">
          <span class="text-muted">Status</span>
          <strong class="text-capitalize">{{ $user->status ?? 'aktif' }}</strong>
        </li>
        @if($user->isAnggota())
        <li class="d-flex justify-content-between py-2 border-bottom">
          <span class="text-muted">NIS</span>
          <strong>{{ $user->nis ?: '—' }}</strong>
        </li>
        <li class="d-flex justify-content-between py-2 border-bottom">
          <span class="text-muted">Kelas</span>
          <strong>{{ $user->kelas ?: '—' }}</strong>
        </li>
        @endif
        <li class="d-flex justify-content-between py-2">
          <span class="text-muted">Telepon</span>
          <strong>{{ $user->phone ?: '—' }}</strong>
        </li>
      </ul>
    </div>
  </div>
</div>

@push('scripts')
<script>
(function(){
  var input = document.getElementById('fotoInput');
  if (!input) return;
  input.addEventListener('change', function(){
    var f = this.files && this.files[0];
    if (!f) return;
    var url = URL.createObjectURL(f);
    var prev = document.getElementById('avatarPreview');
    var fb = document.getElementById('avatarFallback');
    if (fb) fb.style.display = 'none';
    if (prev && prev.tagName === 'IMG') {
      prev.style.display = 'block';
      prev.src = url;
    } else if (prev) {
      var img = document.createElement('img');
      img.id = 'avatarPreview';
      img.src = url;
      img.alt = 'Foto profil';
      img.className = 'rounded-circle border bg-white';
      img.style.cssText = 'width:88px;height:88px;object-fit:cover;display:block';
      prev.replaceWith(img);
    }
  });
})();
</script>
@endpush
@endsection
