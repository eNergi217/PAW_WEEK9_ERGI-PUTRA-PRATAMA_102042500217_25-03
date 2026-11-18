<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pengguna</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 24px; }
        input, select { padding: 6px; margin: 4px 0; width: 280px; }
        .err { color: #e11d48; }
    </style>
</head>
<body>
    <h2>Edit Pengguna</h2>
    <a href="{{ route('users.index') }}">← Kembali</a>

    @foreach($errors->all() as $e) <p class="err">{{ $e }}</p> @endforeach

    <form method="POST" action="{{ route('users.update', $user) }}" style="margin-top:16px;">
        @csrf @method('PUT')
        <label>Nama</label><br>
        <input type="text" name="name" value="{{ old('name', $user->name) }}" required><br>

        <label>Email</label><br>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" required><br>

        <label>Password baru (kosongkan kalau tidak diubah)</label><br>
        <input type="password" name="password"><br>

        <label>Role</label><br>
        <select name="role" required>
            @foreach(['admin', 'dosen', 'mahasiswa'] as $r)
                <option value="{{ $r }}" @selected(old('role', $user->role) === $r)>{{ $r }}</option>
            @endforeach
        </select><br><br>

        <button type="submit">Simpan Perubahan</button>
    </form>
</body>
</html>