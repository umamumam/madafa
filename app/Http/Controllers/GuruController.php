<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Jabatan;
use App\Models\Pendidikan;
use App\Models\StatusGuru;
use App\Imports\GuruImport;
use App\Models\JenisKelamin;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    public function index()
    {
        $gurus = Guru::with([
            'jenisKelamin',
            'pendidikanTerakhir',
            'statusGuru',
            'mapel1',
            'mapel2',
            'mapel3',
            'jabatan1',
            'jabatan2',
            'jabatan3'
        ])->get();

        return view('gurus.index', compact('gurus'));
    }

    public function show($id)
    {
        $guru = Guru::with([
            'jeniskelamin',
            'statusGuru',
            'pendidikanTerakhir',
            'mapel1',
            'mapel2',
            'mapel3',
            'jabatan1',
            'jabatan2',
            'jabatan3',
        ])->findOrFail($id);

        $fotoPath = $guru->foto ? asset('storage/' . $guru->foto) : asset('mantis/assets/images/user/avatar-5.jpg');

        return view('gurus.show', [
            'guru' => $guru,
            'fotoPath' => $fotoPath,
        ]);
    }

    public function create()
    {
        $jeniskelimans = JenisKelamin::all();
        $pendidikans = Pendidikan::all();
        $statusgurus = StatusGuru::all();
        $mapels = Mapel::all();
        $jabatans = Jabatan::all();
        return view('gurus.create', compact('jeniskelimans', 'pendidikans', 'statusgurus', 'mapels', 'jabatans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idguru' => 'required|unique:gurus',
            'niy_nip' => 'nullable|string|max:255',
            'npk_nuptk_pegid' => 'nullable|string|max:255',
            'nama_guru' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nik' => 'nullable|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tgl_lahir' => 'nullable|date',
            'jeniskelamin_id' => 'required|exists:jenis_kelamins,id',
            'pendidikan_terakhir_id' => 'nullable|exists:pendidikans,id',
            'inst_pend_terakhir' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
            'tmt_sk_awal' => 'nullable|date',
            'status_guru_id' => 'nullable|exists:status_gurus,id',
            'masa_kerja' => 'nullable|integer',
            'mapel_1_id' => 'nullable|exists:mapels,id',
            'mapel_2_id' => 'nullable|exists:mapels,id',
            'mapel_3_id' => 'nullable|exists:mapels,id',
            'jabatan_1_id' => 'nullable|exists:jabatans,id',
            'jabatan_2_id' => 'nullable|exists:jabatans,id',
            'jabatan_3_id' => 'nullable|exists:jabatans,id',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoPath = $foto->store('fotos', 'public');
        }

        Guru::create([
            'idguru' => $request->idguru,
            'niy_nip' => $request->niy_nip,
            'npk_nuptk_pegid' => $request->npk_nuptk_pegid,
            'nama_guru' => $request->nama_guru,
            'foto' => $fotoPath,
            'nik' => $request->nik,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'jeniskelamin_id' => $request->jeniskelamin_id,
            'pendidikan_terakhir_id' => $request->pendidikan_terakhir_id,
            'inst_pend_terakhir' => $request->inst_pend_terakhir,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'tmt_sk_awal' => $request->tmt_sk_awal,
            'status_guru_id' => $request->status_guru_id,
            'masa_kerja' => $request->masa_kerja,
            'mapel_1_id' => $request->mapel_1_id,
            'mapel_2_id' => $request->mapel_2_id,
            'mapel_3_id' => $request->mapel_3_id,
            'jabatan_1_id' => $request->jabatan_1_id,
            'jabatan_2_id' => $request->jabatan_2_id,
            'jabatan_3_id' => $request->jabatan_3_id,
        ]);

        return redirect()->route('gurus.index')->with('success', 'Data guru berhasil ditambahkan');
    }

    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        $jeniskelimans = JenisKelamin::all();
        $pendidikans = Pendidikan::all();
        $statusgurus = StatusGuru::all();
        $mapels = Mapel::all();
        $jabatans = Jabatan::all();
        return view('gurus.edit', compact('guru', 'jeniskelimans', 'pendidikans', 'statusgurus', 'mapels', 'jabatans'));
    }

    public function update(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);

        $request->validate([
            'niy_nip' => 'nullable|string|max:255',
            'npk_nuptk_pegid' => 'nullable|string|max:255',
            'nama_guru' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nik' => 'nullable|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tgl_lahir' => 'nullable|date',
            'jeniskelamin_id' => 'required|exists:jenis_kelamins,id',
            'pendidikan_terakhir_id' => 'nullable|exists:pendidikans,id',
            'inst_pend_terakhir' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
            'tmt_sk_awal' => 'nullable|date',
            'status_guru_id' => 'nullable|exists:status_gurus,id',
            'masa_kerja' => 'nullable|integer',
            'mapel_1_id' => 'nullable|exists:mapels,id',
            'mapel_2_id' => 'nullable|exists:mapels,id',
            'mapel_3_id' => 'nullable|exists:mapels,id',
            'jabatan_1_id' => 'nullable|exists:jabatans,id',
            'jabatan_2_id' => 'nullable|exists:jabatans,id',
            'jabatan_3_id' => 'nullable|exists:jabatans,id',
        ]);

        if ($request->hasFile('foto')) {
            if ($guru->foto && Storage::exists('public/' . $guru->foto)) {
                Storage::delete('public/' . $guru->foto);
            }
            $foto = $request->file('foto');
            $fotoPath = $foto->store('fotos', 'public');
            $guru->foto = $fotoPath;
        }

        $guru->update([
            'niy_nip' => $request->niy_nip,
            'npk_nuptk_pegid' => $request->npk_nuptk_pegid,
            'nama_guru' => $request->nama_guru,
            'nik' => $request->nik,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'jeniskelamin_id' => $request->jeniskelamin_id,
            'pendidikan_terakhir_id' => $request->pendidikan_terakhir_id,
            'inst_pend_terakhir' => $request->inst_pend_terakhir,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'tmt_sk_awal' => $request->tmt_sk_awal,
            'status_guru_id' => $request->status_guru_id,
            'masa_kerja' => $request->masa_kerja,
            'mapel_1_id' => $request->mapel_1_id,
            'mapel_2_id' => $request->mapel_2_id,
            'mapel_3_id' => $request->mapel_3_id,
            'jabatan_1_id' => $request->jabatan_1_id,
            'jabatan_2_id' => $request->jabatan_2_id,
            'jabatan_3_id' => $request->jabatan_3_id,
        ]);

        return redirect()->route('gurus.index')->with('success', 'Data guru berhasil diupdate');
    }

    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);
        if ($guru->foto && Storage::exists('public/' . $guru->foto)) {
            Storage::delete('public/' . $guru->foto);
        }
        $guru->delete();

        return redirect()->route('gurus.index')->with('success', 'Data guru berhasil dihapus');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv' // Validasi file yang diupload
        ]);

        // Menggunakan import dengan kelas GuruImport
        Excel::import(new GuruImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data guru berhasil diimport.');
    }
}
