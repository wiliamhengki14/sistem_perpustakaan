<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
</head>
<body>
    <h1>Profile</h1>
    <p>Nama : {{ $user->name }}</p>
    <p>Email : {{ $user->email }}</p>
    @if ($user->is_admin)
        <p>Role : Admin</p>
    @else
        <p>Role : Pembeli</p>
    @endif
    <a href="{{ route('index_book') }}">Kembali</a>
    <a href="{{ route('edit_profile') }}">Edit Profile</a>
</body>
</html>