<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\User;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    // Dosen: daftar + form input
    public function index()
    {
        return view('nilai.index', [
            'mahasiswa' => User::where('role', 'mahasiswa')->get(),
            'daftarNilai' => Nilai::with('mahasiswa')->latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'mahasiswa_id' => ['required', 'exists:users,id'],
            'mata_kuliah'  => ['required', 'string', 'max:100'],
            'nilai'        => ['required', 'integer', 'min:0', 'max:100'],
        ]);

        Nilai::create($data);

        return back()->with('success', 'Nilai berhasil disimpan.');
    }

    public function destroy(Nilai $nilai)
    {
        $nilai->delete();
        return back()->with('success', 'Nilai dihapus.');
    }

    // Mahasiswa: lihat nilai sendiri
    public function saya()
    {
        return view('nilai.saya', [
            'daftarNilai' => Nilai::where('mahasiswa_id', auth()->id())->get(),
        ]);
    }
}