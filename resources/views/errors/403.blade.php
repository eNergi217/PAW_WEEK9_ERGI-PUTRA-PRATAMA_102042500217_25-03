<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><title>403</title></head>
<body style="font-family:Arial,sans-serif; text-align:center; padding-top:80px;">
    <h1>403</h1>
    <p>{{ $exception->getMessage() ?: 'Akses ditolak.' }}</p>
    <a href="{{ route('dashboard') }}">Kembali ke Dashboard</a>
</body>
</html>