<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Pengguna</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 24px; }
        table { border-collapse: collapse; width: 100%; margin-top: 16px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #0f172a; color: #fff; }
        input, select { padding: 6px; margin: 4px 8px 4px 0; }
        .ok { color: green; margin: 10px 0; }
        .err { color: #e11d48; }
        .aksi { display: flex; gap: 6px; }
    </style>
</head>
<body>
    <h2>Manajemen Pengguna</h2>
    <a href="{{ route('dashboard') }}">← Dashboard</a>

    @if(session('success')) <p class="ok">{{ session('success') }}</p> @endif
    @foreach($errors->all() as $e) <p class="err">{{ $e }}</p> @endforeach

    <form method="POST" action="{{ route('users.store') }}" style="margin-top:16px;">
        @csrf
        <input type="text" name="name" placeholder="Nama" value="{{ old('name') }}" required>
        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
        <input type="password" name="password" placeholder="Password (min 6)" required>
        <select name="role" required>
            <option value="admin">admin</option>
            <option value="dosen">dosen</option>
            <option value="mahasiswa" selected>mahasiswa</option>
        </select>
        <button type="submit">Tambah Pengguna</button>
    </form>

    <table>
        <tr><th>Nama</th><th>Email</th><th>Role</th><th>Aksi</th></tr>
        @foreach($users as $u)
            <tr>
                <td>{{ $u->name }}</td>
                <td>{{ $u->email }}</td>
                <td>{{ $u->role }}</td>
                <td>
                    <div class="aksi">
                        <a href="{{ route('users.edit', $u) }}"><button type="button">Edit</button></a>
                        <form method="POST" action="{{ route('users.destroy', $u) }}">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Hapus pengguna ini?')">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
</body>
</html>