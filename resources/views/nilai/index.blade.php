<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Input Nilai</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 24px; }
        table { border-collapse: collapse; width: 100%; margin-top: 16px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #0f172a; color: #fff; }
        input, select { padding: 6px; margin-right: 8px; }
        .ok { color: green; margin: 10px 0; }
        .err { color: #e11d48; }
    </style>
</head>
<body>
    <h2>Input Nilai Mahasiswa</h2>
    <a href="{{ route('dashboard') }}">← Dashboard</a>

    @if(session('success')) <p class="ok">{{ session('success') }}</p> @endif
    @foreach($errors->all() as $e) <p class="err">{{ $e }}</p> @endforeach

    <form method="POST" action="{{ route('nilai.store') }}" style="margin-top:16px;">
        @csrf
        <select name="mahasiswa_id" required>
            <option value="">-- Pilih Mahasiswa --</option>
            @foreach($mahasiswa as $m)
                <option value="{{ $m->id }}">{{ $m->name }}</option>
            @endforeach
        </select>
        <input type="text" name="mata_kuliah" placeholder="Mata kuliah" required>
        <input type="number" name="nilai" placeholder="0-100" min="0" max="100" required>
        <button type="submit">Simpan</button>
    </form>

    <table>
        <tr><th>Mahasiswa</th><th>Mata Kuliah</th><th>Nilai</th><th>Aksi</th></tr>
        @forelse($daftarNilai as $n)
            <tr>
                <td>{{ $n->mahasiswa->name }}</td>
                <td>{{ $n->mata_kuliah }}</td>
                <td>{{ $n->nilai }}</td>
                <td>
                    <form method="POST" action="{{ route('nilai.destroy', $n) }}">
                        @csrf @method('DELETE')
                        <button type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="4">Belum ada nilai.</td></tr>
        @endforelse
    </table>
</body>
</html>