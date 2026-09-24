@extends('layouts.app')
@section('title', 'Kelola Pengguna')
@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
    <div>
        <h4 class="fw-bold mb-0">Kelola Pengguna</h4>
        <small class="text-muted">Admin, petugas & anggota</small>
    </div>
    <a href="{{ route('users.create') }}" class="btn btn-brand rounded-pill"><i class="bi bi-plus-lg"></i> Tambah</a>
</div>
<form method="GET" class="card-soft p-3 mb-3">
    <div class="row g-2">
        <div class="col-md-5"><input type="text" name="search" class="form-control" placeholder="Cari nama/email..." value="{{ request('search') }}"></div>
        <div class="col-md-4">
            <select name="role" class="form-select">
                <option value="">Semua role</option>
                @foreach(['admin','petugas','anggota'] as $r)
                <option value="{{ $r }}" {{ request('role')==$r?'selected':'' }}>{{ $r }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3"><button class="btn btn-primary w-100">Filter</button></div>
    </div>
</form>
<div class="card-soft">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light"><tr><th class="ps-3">Nama</th><th>Email</th><th>Role</th><th>Status</th><th class="text-end pe-3">Aksi</th></tr></thead>
            <tbody>
            @foreach($users as $u)
            <tr>
                <td class="ps-3 fw-semibold">{{ $u->name }}</td>
                <td>{{ $u->email }}</td>
                <td><span class="badge bg-secondary">{{ $u->role }}</span></td>
                <td><span class="badge {{ ($u->status??'aktif')==='aktif'?'bg-success':'bg-danger' }}">{{ $u->status ?? 'aktif' }}</span></td>
                <td class="text-end pe-3">
                    <a href="{{ route('users.edit', $u) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                    @if($u->id !== auth()->id())
                    <form action="{{ route('users.destroy', $u) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus user?')">@csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @if($users->hasPages())<div class="p-3">{{ $users->links() }}</div>@endif
</div>
@endsection
