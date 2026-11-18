<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    public function index()
    {
        return view('materi.index', [
            'daftarMateri' => Materi::with('pembuat')->latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul'     => ['required', 'string', 'max:150'],
            'deskripsi' => ['nullable', 'string'],
        ]);

        $data['user_id'] = auth()->id();
        Materi::create($data);

        return back()->with('success', 'Materi berhasil ditambahkan.');
    }

    public function edit(Materi $materi)
    {
        return view('materi.edit', ['materi' => $materi]);
    }

    public function update(Request $request, Materi $materi)
    {
        $data = $request->validate([
            'judul'     => ['required', 'string', 'max:150'],
            'deskripsi' => ['nullable', 'string'],
        ]);

        $materi->update($data);

        return redirect()->route('materi.index')->with('success', 'Materi berhasil diubah.');
    }

    public function destroy(Materi $materi)
    {
        $materi->delete();
        return back()->with('success', 'Materi dihapus.');
    }
}