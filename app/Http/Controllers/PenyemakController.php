<?php

namespace App\Http\Controllers;

use App\Models\Penyemak;
use App\Models\Guru;
use Illuminate\Http\Request;

class PenyemakController extends Controller
{
    public function index()
    {
        $data = Penyemak::with('guru')->get();
        $gurus = Guru::all();
        return view('penyemak.index', compact('data', 'gurus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'guru_id' => 'required|exists:gurus,id',
        ]);

        Penyemak::create($request->all());
        return redirect()->back()->with('success', 'Data penyemak berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'guru_id' => 'required|exists:gurus,id',
        ]);

        $penyemak = Penyemak::findOrFail($id);
        $penyemak->update($request->all());

        return redirect()->back()->with('success', 'Data penyemak berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Penyemak::destroy($id);
        return redirect()->back()->with('success', 'Data penyemak berhasil dihapus.');
    }
}
