<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $borrow->borrow_code }}</title>
</head>
<body>
    @php
        $telatKembali = now()->lessThanOrEqualTo($borrow->dua_date);
    @endphp
    <p>Peminjam : {{ $borrow->user->name }}</p>
    <p>Kode Pinjam : {{ $borrow->borrow_code }}</p>
    <p>Tanggal Di Pinjam : {{ $borrow->borrow_date }}</p>
    <p>Batas Pinjaman : {{ $borrow->dua_date }}</p>
    @if ($borrow->status == 'pembayaran_denda')
        <p>Status : {{ $borrow->status }}</p>
        <p>Denda : Rp{{ number_format($borrow->fine_amount, 0, ',', '.') }}</p>
    @else
        <p>Status : {{ $borrow->status }}</p>
    @endif
    <p>Daftar Buku</p>
    @foreach ($borrow->borrow_details as $borrow_detail)
        <ul>
            <li>ID : {{ $borrow_detail->id }}</li>
            <li>Buku : {{ $borrow_detail->book->title }}</li>
            <li>Jumlah : {{ $borrow_detail->qty }}</li>
        </ul>
    @endforeach
    @if ($borrow->status == 'dipinjam' && $telatKembali)
        <form action="{{ route('kembalikan', $borrow) }}" method="post">
            @csrf
            <button type="submit">Kembalikan</button>
        </form>
    @elseif (!$telatKembali && !$borrow->status == 'dikembalikan')
        <p>Anda terlambat mengembalikan Buku, silahkan lakukan pembayaran di perpustakaan dengan jumlah {{ number_format($borrow->fine_amount, 0, ',', '.') }}</p>
    @endif
    <br>
    <a href="{{ route('index_borrow') }}">Kembali</a>
</body>
</html>