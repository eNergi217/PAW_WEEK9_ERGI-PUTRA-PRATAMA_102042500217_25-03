<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Nilai Saya</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 24px; }
        table { border-collapse: collapse; width: 100%; margin-top: 16px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #0f172a; color: #fff; }
    </style>
</head>
<body>
    <h2>Nilai Saya</h2>
    <a href="{{ route('dashboard') }}">← Dashboard</a>

    <table>
        <tr><th>Mata Kuliah</th><th>Nilai</th></tr>
        @forelse($daftarNilai as $n)
            <tr><td>{{ $n->mata_kuliah }}</td><td>{{ $n->nilai }}</td></tr>
        @empty
            <tr><td colspan="2">Belum ada nilai.</td></tr>
        @endforelse
    </table>
</body>
</html>