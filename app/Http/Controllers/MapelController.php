<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function index()
    {
        $data = Mapel::all();
        return view('mapel.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mapel' => 'required|string|max:255',
            'kkm' => 'nullable|integer|min:0|max:100',
        ]);

        Mapel::create([
            'mapel' => $request->mapel,
            'kkm' => $request->kkm,
        ]);
        return redirect()->back()->with('success', 'Mata Pelajaran berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'mapel' => 'required|string|max:255',
            'kkm' => 'nullable|integer|min:0|max:100',
        ]);

        $mapel = Mapel::findOrFail($id);
        $mapel->update([
            'mapel' => $request->mapel,
            'kkm' => $request->kkm,
        ]);
        return redirect()->back()->with('success', 'Mata Pelajaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Mapel::destroy($id);
        return redirect()->back()->with('success', 'Mata Pelajaran berhasil dihapus.');
    }
}
