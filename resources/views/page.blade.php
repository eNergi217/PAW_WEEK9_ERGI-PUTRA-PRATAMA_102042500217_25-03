<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
</head>
<body style="font-family:Arial,sans-serif; padding:24px;">
    <h2>{{ $title }}</h2>
    <p>Halaman ini hanya bisa diakses oleh role yang diizinkan.</p>
    <a href="{{ route('dashboard') }}">← Kembali ke Dashboard</a>
</body>
</html>