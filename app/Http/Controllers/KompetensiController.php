<?php

namespace App\Http\Controllers;

use App\Models\Kompetensi;
use Illuminate\Http\Request;

class KompetensiController extends Controller
{
    public function index()
    {
        $kompetensis = Kompetensi::orderBy('urutan')->get();
        return view('kompetensi.index', compact('kompetensis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'urutan' => 'required|integer|unique:kompetensis,urutan',
            'nama_kompetensi' => 'required|string|max:255',
        ]);

        Kompetensi::create([
            'urutan' => $request->urutan,
            'nama_kompetensi' => $request->nama_kompetensi,
        ]);

        return redirect()->back()->with('success', 'Kompetensi berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'urutan' => 'required|integer|unique:kompetensis,urutan,' . $id,
            'nama_kompetensi' => 'required|string|max:255',
        ]);

        $kompetensi = Kompetensi::findOrFail($id);
        $kompetensi->update([
            'urutan' => $request->urutan,
            'nama_kompetensi' => $request->nama_kompetensi,
        ]);

        return redirect()->back()->with('success', 'Kompetensi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Kompetensi::destroy($id);
        return redirect()->back()->with('success', 'Kompetensi berhasil dihapus.');
    }
}
