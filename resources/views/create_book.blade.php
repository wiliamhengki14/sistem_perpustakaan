<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Book</title>
</head>
<body>
    <h1>Tambah Buku</h1>
    <form action="{{ route('store_book') }}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="title">Judul : </label> <br>
        <input type="text" name="title" id="title" required placeholder="Masukkan Judul Buku"> <br>
        <label for="author">Penulis : </label> <br>
        <input type="text" name="author" id="author" placeholder="Penulis Buku"> <br>
        <label for="publisher">Penerbit : </label> <br>
        <input type="text" name="publisher" id="publisher" placeholder="Penerbit Buku" required> <br>
        <label for="publish_year">Tahun Terbit : </label> <br>
        <input type="number" name="publish_year" id="publish_year" required placeholder="Tahun Terbit Bukur"> <br>
        <label for="description">Deskripsi : </label> <br>
        <input type="text" name="description" id="description" required placeholder="Deskripsi"> <br>
        <label for="categorie_id">Katagori Buku : </label> <br>
        <select name="categorie_id" id="categorie_id">
            @foreach ($categories as $categorie)
                <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
            @endforeach
        </select> <br>
        <label for="stock">Stok : </label> <br>
        <input type="number" name="stock" id="stock" placeholder="Masukkan stok buku" required> <br>
        <label for="cover_image">Cover Buku : </label> <br>
        <input type="file" name="cover_image" id="cover_image"> <br>
        <br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>