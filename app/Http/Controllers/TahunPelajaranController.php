<?php

namespace App\Http\Controllers;

use App\Models\TahunPelajaran;
use Illuminate\Http\Request;

class TahunPelajaranController extends Controller
{
    public function index()
    {
        $data = TahunPelajaran::all();
        return view('tahun.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|string|max:255',
            'active' => 'required|boolean',
        ]);

        TahunPelajaran::create($request->all());
        return redirect()->back()->with('success', 'Tahun Pelajaran berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tahun' => 'required|string|max:255',
            'active' => 'required|boolean',
        ]);

        $tp = TahunPelajaran::findOrFail($id);
        $tp->update($request->all());
        return redirect()->back()->with('success', 'Tahun Pelajaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        TahunPelajaran::destroy($id);
        return redirect()->back()->with('success', 'Tahun Pelajaran berhasil dihapus.');
    }
}
