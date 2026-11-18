<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Materi</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 24px; }
        table { border-collapse: collapse; width: 100%; margin-top: 16px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #0f172a; color: #fff; }
        input, textarea { padding: 6px; margin: 4px 0; width: 320px; }
        .ok { color: green; margin: 10px 0; }
        .err { color: #e11d48; }
        .aksi { display: flex; gap: 6px; }
    </style>
</head>
<body>
    <h2>Manajemen Materi</h2>
    <a href="{{ route('dashboard') }}">← Dashboard</a>

    @if(session('success')) <p class="ok">{{ session('success') }}</p> @endif
    @foreach($errors->all() as $e) <p class="err">{{ $e }}</p> @endforeach

    <form method="POST" action="{{ route('materi.store') }}" style="margin-top:16px;">
        @csrf
        <input type="text" name="judul" placeholder="Judul materi" required><br>
        <textarea name="deskripsi" placeholder="Deskripsi (opsional)" rows="3"></textarea><br>
        <button type="submit">Tambah Materi</button>
    </form>

    <table>
        <tr><th>Judul</th><th>Deskripsi</th><th>Dibuat oleh</th><th>Aksi</th></tr>
        @forelse($daftarMateri as $m)
            <tr>
                <td>{{ $m->judul }}</td>
                <td>{{ $m->deskripsi }}</td>
                <td>{{ $m->pembuat->name }}</td>
                <td>
                    <div class="aksi">
                        <a href="{{ route('materi.edit', $m) }}"><button type="button">Edit</button></a>
                        <form method="POST" action="{{ route('materi.destroy', $m) }}">
                            @csrf @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr><td colspan="4">Belum ada materi.</td></tr>
        @endforelse
    </table>
</body>
</html>