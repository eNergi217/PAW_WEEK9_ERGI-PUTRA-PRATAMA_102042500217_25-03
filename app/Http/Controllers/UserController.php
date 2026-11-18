<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index', [
            'users' => User::orderBy('role')->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => ['required', 'string', 'max:100'],
            'email'    => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6'],
            'role'     => ['required', Rule::in(['admin', 'dosen', 'mahasiswa'])],
        ]);

        $data['password'] = Hash::make($data['password']);
        User::create($data);

        return back()->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'     => ['required', 'string', 'max:100'],
            'email'    => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:6'],
            'role'     => ['required', Rule::in(['admin', 'dosen', 'mahasiswa'])],
        ]);

        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil diubah.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->withErrors(['hapus' => 'Kamu tidak bisa menghapus akun sendiri.']);
        }

        $user->delete();

        return back()->with('success', 'Pengguna dihapus.');
    }
}