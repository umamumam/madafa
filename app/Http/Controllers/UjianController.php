<?php

namespace App\Http\Controllers;

use App\Models\Ujian;
use Illuminate\Http\Request;

class UjianController extends Controller
{
    public function index()
    {
        $ujians = Ujian::all();
        return view('ujian.index', compact('ujians'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'hari' => 'required',
            'tanggal' => 'required|date',
        ]);

        Ujian::create($request->all());

        return redirect()->back()->with('success', 'Ujian berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'hari' => 'required',
            'tanggal' => 'required|date',
        ]);

        $ujian = Ujian::findOrFail($id);
        $ujian->update($request->all());

        return redirect()->back()->with('success', 'Ujian berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $ujian = Ujian::findOrFail($id);
        $ujian->delete();

        return redirect()->back()->with('success', 'Ujian berhasil dihapus!');
    }
}
