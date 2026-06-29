<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $borrow->borrow_code }}</title>
</head>
<body>
    <p>Peminjam : {{ $borrow->user->name }}</p>
    <p>Kode Pinjam : {{ $borrow->borrow_code }}</p>
    <p>Tanggal Di Pinjam : {{ $borrow->borrow_date }}</p>
    <p>Batas Pinjaman : {{ $borrow->dua_date }}</p>
    <p>Status : {{ $borrow->status }}</p>
    <p>Daftar Buku</p>
    @foreach ($borrow->borrow_details as $borrow_detail)
        <ul>
            <li>ID : {{ $borrow_detail->id }}</li>
            <li>Buku : {{ $borrow_detail->book->title }}</li>
            <li>Jumlah : {{ $borrow_detail->qty }}</li>
        </ul>
    @endforeach
    @if (!$borrow->return_date)
        <form action="{{ route('kembalikan', $borrow) }}" method="post">
            @csrf
            <button type="submit">Kembalikan</button>
        </form>
    @endif
</body>
</html>