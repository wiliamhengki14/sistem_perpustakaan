<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Pinjaman</title>
</head>
<body>
    <h1>Daftar Pinjaman</h1>
    @foreach ($borrows as $borrow)
        <p>Peminjam : {{ $borrow->user->name }}</p>
        <p>Kode Pinjamam : {{ $borrow->borrow_code }}</p>
        <p>Tanggal Di Pinjam : {{ $borrow->borrow_date }}</p>
        @php
            $belumTerlambat = now()->lessThanOrEqualTo($borrow->dua_date);
        @endphp
        @if ($belumTerlambat)
            <p>Status : {{ $borrow->status }}</p>
        @else
            <p>Status : Terlambat (Pembayaran Di Denda)</p> <br>
            <form action="{{ route('denda_pembayaran', $borrow) }}" method="post">
                @csrf
                @method('patch')
                <button type="submit">Denda</button>
            </form>
        @endif
        @if ($borrow->return_date && $borrow->status == 'dipinjam')
            <p>Sudah Di kembalikan pada tanggal {{ $borrow->return_date }}, Silahkan di konfirmasi</p>
            <form action="{{ route('konfirmasi_kembalian', $borrow) }}" method="post">
                @method('patch')
                @csrf
                <button type="submit">Konfirmasi Kembalian</button>
            </form>
        @endif
        <br>
        <a href="{{ route('show_borow', $borrow) }}">Show Detail</a>
        <hr>
    @endforeach
</body>
</html>