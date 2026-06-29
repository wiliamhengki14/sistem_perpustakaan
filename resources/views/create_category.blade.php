<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kategori</title>
</head>
<body>
    <h1>Tambah Kategori Buku</h1>
    <form action="{{ route('store_category') }}" method="post">
        @csrf
        <label for="name">Nama Kategori : </label> <br>
        <input type="text" name="name" id="name" required placeholder="Masukkan nama kategori buku"> <br>
        <button type="submit">Submit</button>
    </form>
    
</body>
</html>