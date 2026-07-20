<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Queue</title>
</head>
<body>
    <h1>Keranjang Buku</h1>
    @foreach ($queues as $queue)
        <img src="{{ url('storage/' . $queue->book->cover_image) }}" alt="{{ $queue->book->cover_image }}" height="100px">
        <p>Judul Buku : {{ $queue->book->title }}</p>
        <p>penulis : {{ $queue->book->author }}</p>
        <p>ISBN : {{ $queue->book->isbn }}</p>
        <form action="{{ route('update_queue', $queue) }}" method="post">
            @csrf
            @method('patch')
            <label for="amount">Jumlah : </label>
            <input type="number" name="amount" id="amount" value="{{ $queue->amount }}" required min="1">
            <button type="submit">Update</button>
        </form>
        <br>
        <form action="{{ route('delete_queue', $queue) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit" onclick="return confirm('Apakah Ingin Di Hapus?')">Hapus</button>
        </form>
        <hr>
    @endforeach
    <br>
    @if (!Auth::user()->is_admin)
        <form action="{{ route('pinjam') }}" method="post">
            @csrf
            <button type="submit">Pinjam</button>
        </form>
    @endif
    <br>
    <a href="{{ route('index_book') }}">Kembali</a>
</body>
</html>