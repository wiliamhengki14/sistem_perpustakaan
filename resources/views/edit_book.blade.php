<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Buku</title>
</head>
<body>
    <h1>Edit Buku</h1>
    <form action="{{ route('update_book', $book) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('patch')
    <label for="title">Judul : </label> <br>
    <input type="text" name="title" id="title" value="{{ $book->title }}" required> <br>
    <label for="author">Penulis : </label> <br>
    <input type="text" name="author" id="author" value="{{ $book->author }}" required> <br>
    <label for="publisher">Penerbit : </label> <br>
    <input type="text" name="publisher" id="publisher" value="{{ $book->publisher }}" required> <br>
    <label for="publish_year">Tahun Terbit : </label> <br>
    <input type="number" name="publish_year" id="publish_year" value="{{ $book->publish_year }}" required> <br>
    <label for="description">Deskripsi : </label> <br>
    <textarea name="description" id="description" cols="30" rows="5">{{ $book->description }}</textarea> <br>
    <label for="categorie_id">Kategori : </label> <br>
    <select name="categorie_id" id="categorie_id">
        <option value="{{ $book->categorie->id }}">{{ $book->categorie->name }}</option>
        @foreach ($categories as $categorie)
            <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
        @endforeach
    </select> <br>
    <label for="stock">Stock : </label> <br>
    <input type="number" name="stock" id="stock" value="{{ $book->stock }}" required> <br>
    <label for="cover_image">Cover Buku : </label> <br>
    <img src="{{ url('storage/' . $book->cover_image) }}" alt="{{ $book->cover_image }}" height="100px"> <br>
    <input type="file" name="cover_image" id="cover_image"> <br>
    <button type="submit">Update Buku</button> 
    </form>
    <br>
    <br>
    <a href="{{ route('index_book') }}">Kembali</a>
</body>
</html>