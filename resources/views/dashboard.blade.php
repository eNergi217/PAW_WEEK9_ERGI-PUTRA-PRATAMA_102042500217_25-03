<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body style="font-family:Arial,sans-serif; padding:24px;">
    <h2>Dashboard</h2>
    <p>Halo, <b>{{ auth()->user()->name }}</b> (role: <b>{{ auth()->user()->role }}</b>)</p>

    <ul>
        @if(auth()->user()->role === 'admin')
            <li><a href="{{ route('users.index') }}">Manajemen Pengguna</a></li>
        @endif

        @if(in_array(auth()->user()->role, ['admin', 'dosen']))
            <li><a href="{{ route('materi.index') }}">Manajemen Materi</a></li>
        @endif

        @if(auth()->user()->role === 'dosen')
            <li><a href="{{ route('nilai.index') }}">Input Nilai</a></li>
        @endif

        @if(auth()->user()->role === 'mahasiswa')
            <li><a href="{{ route('nilai.saya') }}">Nilai Saya</a></li>
        @endif
    </ul>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>