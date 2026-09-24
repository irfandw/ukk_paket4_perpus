<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Bukti Peminjaman #{{ $borrowing->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 480px; margin: 24px auto; color: #111; }
        h2 { margin: 0 0 4px; } .muted { color: #666; font-size: 13px; }
        table { width: 100%; border-collapse: collapse; margin-top: 16px; }
        td { padding: 6px 0; vertical-align: top; }
        td:first-child { width: 140px; color: #555; }
        hr { border: none; border-top: 1px dashed #ccc; margin: 16px 0; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body>
    <div class="no-print" style="margin-bottom:16px;">
        <button onclick="window.print()">Cetak</button>
        <a href="{{ route('borrowings.show', $borrowing) }}">Kembali</a>
    </div>
    <h2>Bukti Peminjaman</h2>
<p><strong>Kode:</strong> {{ $borrowing->kode_transaksi ?? $borrowing->id }}</p>
    <div class="muted">Perpustakaan Digital · No. {{ $borrowing->id }}</div>
    <hr>
    <table>
        <tr><td>Anggota</td><td><strong>{{ $borrowing->user->name }}</strong><br><span class="muted">{{ $borrowing->user->email }}</span></td></tr>
        <tr><td>Buku</td><td><strong>{{ $borrowing->book->title }}</strong><br><span class="muted">{{ $borrowing->book->author }}</span></td></tr>
        <tr><td>Kategori</td><td>{{ $borrowing->book->category->name ?? '-' }}</td></tr>
        <tr><td>Tanggal pinjam</td><td>{{ $borrowing->tgl('pinjam', 'd F Y') }}</td></tr>
        <tr><td>Lama pinjam</td><td>{{ $borrowing->lama_hari ?? 7 }} hari</td></tr>
        <tr><td>Jatuh tempo</td><td><strong>{{ $borrowing->tgl('tempo', 'd F Y') }}</strong></td></tr>
        <tr><td>Status</td><td>{{ $borrowing->status }}</td></tr>
        @if($borrowing->tgl('kembali'))
        <tr><td>Tanggal kembali</td><td>{{ $borrowing->tgl('kembali', 'd F Y') }}</td></tr>
        @endif
        @if($borrowing->denda > 0)
        <tr><td>Denda</td><td>Rp {{ number_format($borrowing->denda, 0, ',', '.') }}
          @if($borrowing->denda_lunas ?? false) (lunas) @endif
        </td></tr>
        @endif
    </table>
    <hr>
    <p class="muted">Denda keterlambatan berlaku sesuai ketentuan perpustakaan. Harap kembalikan tepat waktu.</p>
    <p class="muted">Dicetak: {{ now()->format('d/m/Y H:i') }}</p>
</body>
</html>
