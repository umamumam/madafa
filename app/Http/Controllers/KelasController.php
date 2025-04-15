<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Program;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        // Load relasi program dan walikelas
        $data = Kelas::with(['program', 'walikelas'])->get();
        $programs = Program::all();
        $gurus = Guru::all();

        return view('kelas.index', compact('data', 'programs', 'gurus'));
    }

    public function store(Request $request)
    {
        // Validasi sederhana (optional)
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'program_id' => 'required|exists:programs,id',
            'walikelas_id' => 'nullable|exists:gurus,id',
            'active' => 'boolean',
        ]);

        Kelas::create($request->all());

        return redirect()->back()->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'program_id' => 'required|exists:programs,id',
            'walikelas_id' => 'nullable|exists:gurus,id',
            'active' => 'boolean',
        ]);

        $kelas = Kelas::findOrFail($id);
        $kelas->update($request->all());

        return redirect()->back()->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Kelas::destroy($id);
        return redirect()->back()->with('success', 'Kelas berhasil dihapus.');
    }
}
