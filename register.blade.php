<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Perpustakaan Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; }
        body {
            min-height: 100vh; display: flex; align-items: center;
            background: linear-gradient(145deg, #0f172a 0%, #1e3a8a 50%, #0ea5e9 100%);
            padding: 2rem 0;
        }
        .auth-card { border: none; border-radius: 1.25rem; box-shadow: 0 25px 50px rgba(0,0,0,.25); }
        .btn-brand {
            background: linear-gradient(135deg, #2563eb, #0ea5e9);
            border: none; color: #fff; font-weight: 600;
        }
        .btn-brand:hover { color: #fff; filter: brightness(1.08); }
        .form-control { border-radius: .75rem; padding: .65rem 1rem; }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="text-center text-white mb-4">
                <h3 class="fw-bold" style="letter-spacing:-.03em;">Daftar Anggota</h3>
                <p class="opacity-75 small">Buat akun untuk mulai meminjam buku</p>
            </div>
            <div class="card auth-card">
                <div class="card-body p-4 p-md-5">
                    @if($errors->any())
                        <div class="alert alert-danger border-0 rounded-3">
                            <ul class="mb-0 small">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold small">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold small">Konfirmasi</label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold small">NIS</label>
                                <input type="text" name="nis" class="form-control" value="{{ old('nis') }}" placeholder="Nomor induk">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold small">Kelas</label>
                                <input type="text" name="kelas" class="form-control" value="{{ old('kelas') }}" placeholder="Contoh: 6A">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">No. Telepon</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold small">Alamat</label>
                            <textarea name="address" class="form-control" rows="2">{{ old('address') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-brand w-100 py-2 rounded-pill">Daftar</button>
                    </form>
                    <p class="text-center small mt-3 mb-0">
                        Sudah punya akun? <a href="{{ route('login') }}" class="fw-semibold text-decoration-none">Login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
