<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Materi</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 24px; }
        input, textarea { padding: 6px; margin: 4px 0; width: 320px; }
        .err { color: #e11d48; }
    </style>
</head>
<body>
    <h2>Edit Materi</h2>
    <a href="{{ route('materi.index') }}">← Kembali</a>

    @foreach($errors->all() as $e) <p class="err">{{ $e }}</p> @endforeach

    <form method="POST" action="{{ route('materi.update', $materi) }}" style="margin-top:16px;">
        @csrf @method('PUT')
        <input type="text" name="judul" value="{{ old('judul', $materi->judul) }}" required><br>
        <textarea name="deskripsi" rows="3">{{ old('deskripsi', $materi->deskripsi) }}</textarea><br>
        <button type="submit">Simpan Perubahan</button>
    </form>
</body>
</html>