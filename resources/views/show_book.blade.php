<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach        
    @endif
    <h1>Detail Buku {{ $book->title }}</h1>
    <p>Judul Buku : {{ $book->title }}</p>
    <p>Kategori : {{ $book->categorie->name }}</p>
    <p>Deskripsi : {{ $book->description }}</p>
    <p>Penulis : {{ $book->author }}</p>
    <p>Penerbit : {{ $book->publisher }}</p>
    <p>Tahun Terbit : {{ $book->publish_year }}</p>
    <p>Stock : {{ $book->stock }}</p>
    <p>ISBN : {{ $book->isbn }}</p>
    <img src="{{ url('storage/'. $book->cover_image) }}" alt="{{ $book->cover_image }}" height="100px">
    <br>
    <br>
    <form action="{{ route('add_to_queue', $book) }}" method="post">
        @csrf
        <input type="number" name="amount" id="amount" value="1" min=1 required>
        <button type="submit">Add To Queue</button>
    </form>
    <br>
    @if (!Auth::check() || Auth::user()->is_admin)
        <form action="{{ route('delete_book', $book) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit" onclick="return confirm('apakah ingin di hapus?')">Hapus Buku</button>
        </form>
        <a href="{{ route('edit_book', $book) }}">Edit Buku</a> |
    @endif

    <a href="{{ route('index_book') }}">Kembali</a>
</body>
</html>