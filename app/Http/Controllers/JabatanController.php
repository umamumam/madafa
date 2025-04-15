<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function index()
    {
        $data = Jabatan::all();
        return view('jabatan.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jabatan' => 'required|string|max:255',
        ]);

        Jabatan::create($request->all());
        return redirect()->back()->with('success', 'Jabatan berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jabatan' => 'required|string|max:255',
        ]);

        $jabatan = Jabatan::findOrFail($id);
        $jabatan->update($request->all());
        return redirect()->back()->with('success', 'Jabatan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Jabatan::destroy($id);
        return redirect()->back()->with('success', 'Jabatan berhasil dihapus.');
    }
}
