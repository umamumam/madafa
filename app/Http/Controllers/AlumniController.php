<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AlumniExport;
use App\Imports\AlumniImport;

class AlumniController extends Controller
{
    public function index()
    {
        $alumnis = Alumni::all();
        return view('alumnis.index', compact('alumnis'));
    }
    public function data()
    {
        $alumnis = Alumni::all();
        return view('alumnis.data', compact('alumnis'));
    }

    public function create()
    {
        return view('alumnis.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nis' => 'nullable|string|max:50',
            'nisn' => 'nullable|string|max:50',
            'nik_siswa' => 'nullable|string|max:50',
            'nama_siswa' => 'required|string|max:255',
            'foto' => 'nullable|string|max:255',
            'jeniskelamin' => 'nullable|string|max:20',
            'tempat_lahir' => 'nullable|string|max:100',
            'tgl_lahir' => 'nullable|date',
            'kelas' => 'nullable|string|max:50',
            'program' => 'nullable|string|max:100',
            'anak_ke' => 'nullable|integer',
            'no_kk' => 'nullable|string|max:50',
            'nik_ayah' => 'nullable|string|max:50',
            'nama_ayah' => 'nullable|string|max:255',
            'pendidikan_ayah' => 'nullable|string|max:100',
            'pekerjaan_ayah' => 'nullable|string|max:100',
            'nik_ibu' => 'nullable|string|max:50',
            'nama_ibu' => 'nullable|string|max:255',
            'pendidikan_ibu' => 'nullable|string|max:100',
            'pekerjaan_ibu' => 'nullable|string|max:100',
            'hp_siswa' => 'nullable|string|max:20',
            'hp_ortu' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'kode_pos' => 'nullable|string|max:10',
            'asal_sekolah' => 'nullable|string|max:255',
            'npsn' => 'nullable|string|max:50',
            'nsm' => 'nullable|string|max:50',
            'alamat_sekolah' => 'nullable|string|max:255',
            'no_kip' => 'nullable|string|max:50',
            'no_kks' => 'nullable|string|max:50',
            'no_pkh' => 'nullable|string|max:50',
        ]);

        Alumni::create($validated);

        return redirect()->route('alumnis.index')->with('success', 'Data alumni berhasil ditambahkan.');
    }

    public function edit(Alumni $alumni)
    {
        return view('alumnis.edit', compact('alumni'));
    }

    public function update(Request $request, Alumni $alumni)
    {
        $validated = $request->validate([
            'nis' => 'nullable|string|max:50',
            'nisn' => 'nullable|string|max:50',
            'nik_siswa' => 'nullable|string|max:50',
            'nama_siswa' => 'required|string|max:255',
            'foto' => 'nullable|string|max:255',
            'jeniskelamin' => 'nullable|string|max:20',
            'tempat_lahir' => 'nullable|string|max:100',
            'tgl_lahir' => 'nullable|date',
            'kelas' => 'nullable|string|max:50',
            'program' => 'nullable|string|max:100',
            'anak_ke' => 'nullable|integer',
            'no_kk' => 'nullable|string|max:50',
            'nik_ayah' => 'nullable|string|max:50',
            'nama_ayah' => 'nullable|string|max:255',
            'pendidikan_ayah' => 'nullable|string|max:100',
            'pekerjaan_ayah' => 'nullable|string|max:100',
            'nik_ibu' => 'nullable|string|max:50',
            'nama_ibu' => 'nullable|string|max:255',
            'pendidikan_ibu' => 'nullable|string|max:100',
            'pekerjaan_ibu' => 'nullable|string|max:100',
            'hp_siswa' => 'nullable|string|max:20',
            'hp_ortu' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'kode_pos' => 'nullable|string|max:10',
            'asal_sekolah' => 'nullable|string|max:255',
            'npsn' => 'nullable|string|max:50',
            'nsm' => 'nullable|string|max:50',
            'alamat_sekolah' => 'nullable|string|max:255',
            'no_kip' => 'nullable|string|max:50',
            'no_kks' => 'nullable|string|max:50',
            'no_pkh' => 'nullable|string|max:50',
        ]);

        $alumni->update($validated);

        return redirect()->route('alumnis.index')->with('success', 'Data alumni berhasil diupdate.');
    }

    public function destroy(Alumni $alumni)
    {
        $alumni->delete();

        return redirect()->route('alumnis.index')->with('success', 'Data alumni berhasil dihapus.');
    }

    public function export(Request $request)
    {
        $selectedIds = $request->input('selected', []);

        if (empty($selectedIds)) {
            return back()->with('error', 'Silahkan pilih data yang ingin di-export.');
        }

        return Excel::download(new AlumniExport($selectedIds), 'alumni_selected.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv'
        ]);

        Excel::import(new AlumniImport, $request->file('file'));

        return redirect()->route('alumnis.index')->with('success', 'Data alumni berhasil diimport.');
    }
}
