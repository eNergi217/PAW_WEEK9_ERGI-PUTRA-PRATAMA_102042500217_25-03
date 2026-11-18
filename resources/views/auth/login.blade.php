<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body { font-family: Arial, sans-serif; background:#f4f6f8; display:flex; justify-content:center; align-items:center; height:100vh; margin:0; }
        .card { background:#fff; padding:32px; border-radius:8px; width:320px; box-shadow:0 2px 8px rgba(0,0,0,.1); }
        input { width:100%; padding:8px; margin:6px 0 14px; box-sizing:border-box; }
        button { width:100%; padding:10px; background:#e11d48; color:#fff; border:0; border-radius:4px; cursor:pointer; }
        .error { color:#e11d48; font-size:14px; margin-bottom:10px; }
    </style>
</head>
<body>
<div class="card">
    <h2>Login Akademik</h2>

    @error('email')
        <div class="error">{{ $message }}</div>
    @enderror

    <form method="POST" action="{{ route('login.process') }}">
        @csrf
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit">Masuk</button>
    </form>
</div>
</body>
</html>