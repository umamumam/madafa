<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->get();
        return view('berita.index', compact('beritas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string',
            'gambar' => 'required|image|max:2048',
        ]);

        $gambarPath = $request->file('gambar')->store('berita', 'public');

        Berita::create([
            'judul' => $request->judul,
            'tanggal' => $request->tanggal,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambarPath,
        ]);

        return redirect()->back()->with('success', 'Berita berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $berita = Berita::findOrFail($id);

        if ($request->hasFile('gambar')) {
            if ($berita->gambar) {
                Storage::delete('public/' . $berita->gambar);
            }
            $gambarPath = $request->file('gambar')->store('berita', 'public');
        } else {
            $gambarPath = $berita->gambar;
        }

        $berita->update([
            'judul' => $request->judul,
            'tanggal' => $request->tanggal,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambarPath,
        ]);

        return redirect()->back()->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        if ($berita->gambar) {
            Storage::delete('public/' . $berita->gambar);
        }
        $berita->delete();
        return redirect()->back()->with('success', 'Berita berhasil dihapus.');
    }

    public function showOnLanding()
    {
        $beritas = Berita::latest()->take(4)->get();
        return view('welcome', compact('beritas'));
    }
}
