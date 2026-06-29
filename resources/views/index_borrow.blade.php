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
        <p>Status : {{ $borrow->status }}</p>
        @if ($borrow->return_date)
            <p>Sudah Di kembalikan pada tanggal {{ $borrow->return_date }}, Silahkan di konfirmasi</p>
        @endif
        <br>
        <a href="{{ route('show_borow', $borrow) }}">Show Detail</a>
        <hr>
    @endforeach
</body>
</html>