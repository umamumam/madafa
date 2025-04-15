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
        ]);

        Mapel::create($request->all());
        return redirect()->back()->with('success', 'Mata Pelajaran berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'mapel' => 'required|string|max:255',
        ]);

        $mapel = Mapel::findOrFail($id);
        $mapel->update($request->all());
        return redirect()->back()->with('success', 'Mata Pelajaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Mapel::destroy($id);
        return redirect()->back()->with('success', 'Mata Pelajaran berhasil dihapus.');
    }
}
