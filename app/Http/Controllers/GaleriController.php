<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $galeris = Galeri::latest()->get();
        return view('galeri.index', compact('galeris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'tahun' => 'required|digits:4',
            'foto' => 'required|image|max:2048',
        ]);

        $fotoPath = $request->file('foto')->store('galeri', 'public');

        Galeri::create([
            'judul' => $request->judul,
            'tahun' => $request->tahun,
            'foto' => $fotoPath,
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'tahun' => 'required|digits:4',
            'foto' => 'nullable|image|max:2048',
        ]);

        $galeri = Galeri::findOrFail($id);

        if ($request->hasFile('foto')) {
            if ($galeri->foto) {
                Storage::delete('public/' . $galeri->foto);
            }
            $fotoPath = $request->file('foto')->store('galeri', 'public');
        } else {
            $fotoPath = $galeri->foto;
        }

        $galeri->update([
            'judul' => $request->judul,
            'tahun' => $request->tahun,
            'foto' => $fotoPath,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);
        if ($galeri->foto) {
            Storage::delete('public/' . $galeri->foto);
        }
        $galeri->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

    public function showOnLanding()
    {
        $galeri = Galeri::latest()->take(10)->get();
        $beritas = Berita::latest()->take(4)->get();
        return view('welcome', compact('galeris', 'beritas'));
    }
}
