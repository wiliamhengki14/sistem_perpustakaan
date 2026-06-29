<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @foreach ($books as $book)
        <p>Judul Buku : {{ $book->title }}</p>
        <p>Kategori : {{ $book->categorie->name }}</p>
        <img src="{{ url('storage/' . $book->cover_image) }}" alt="{{ $book->cover_image }}" height="100px"> <br>
        <br>
        <a href="{{ route('show_book', $book) }}">Show Detail</a>
        <hr>
    @endforeach
</body>
</html>