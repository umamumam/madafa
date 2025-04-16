<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Program;
use App\Models\Pendidikan;
use App\Models\JenisKelamin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    // Menampilkan halaman index
    public function index()
    {
        $siswas = Siswa::with([
            'jeniskelamin',
            'kelas',
            'program',
            'pendidikanAyah',
            'pendidikanIbu'
        ])->get();

        return view('siswas.index', compact('siswas'));
    }

    // Menampilkan form tambah siswa
    public function create()
    {
        $jeniskelimans = JenisKelamin::all();
        $kelas = Kelas::all();
        $programs = Program::all();
        $pendidikans = Pendidikan::all();
        $pendidikanAyah = Pendidikan::all();
        $pendidikanIbu = Pendidikan::all();

        return view('siswas.create', compact('jeniskelimans', 'kelas', 'programs', 'pendidikans', 'pendidikanAyah', 'pendidikanIbu'));
    }

    // Menyimpan data siswa baru
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:siswas',
            'nisn' => 'nullable|unique:siswas',
            'nik_siswa' => 'nullable',
            'nama_siswa' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'jeniskelamin_id' => 'required|exists:jenis_kelamins,id',
            'tempat_lahir' => 'nullable|string|max:255',
            'tgl_lahir' => 'nullable|date',
            'kelas_id' => 'required|exists:kelas,id',
            'program_id' => 'required|exists:programs,id',
            'anak_ke' => 'nullable|integer',
            'no_kk' => 'nullable|string|max:20',
            'nik_ayah' => 'nullable|string|max:20',
            'nama_ayah' => 'nullable|string|max:255',
            'pendidikan_ayah_id' => 'nullable|exists:pendidikans,id',
            'pekerjaan_ayah' => 'nullable|string|max:255',
            'nik_ibu' => 'nullable|string|max:20',
            'nama_ibu' => 'nullable|string|max:255',
            'pendidikan_ibu_id' => 'nullable|exists:pendidikans,id',
            'pekerjaan_ibu' => 'nullable|string|max:255',
            'hp_siswa' => 'nullable|string|max:15',
            'hp_ortu' => 'nullable|string|max:15',
            'alamat' => 'nullable|string|max:500',
            'kode_pos' => 'nullable|string|max:10',
            'asal_sekolah' => 'nullable|string|max:255',
            'npsn' => 'nullable|string|max:15',
            'nsm' => 'nullable|string|max:15',
            'alamat_sekolah' => 'nullable|string|max:500',
            'no_kip' => 'nullable|string|max:20',
            'no_kks' => 'nullable|string|max:20',
            'no_pkh' => 'nullable|string|max:20',
        ]);

        // Menyimpan foto jika ada
        // $fotoPath = null;
        // if ($request->hasFile('foto')) {
        //     $fotoPath = $request->file('foto')->store('public/fotos');
        // }
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            // Menyimpan foto ke folder 'public/fotos' dan menggunakan store() untuk menangani penyimpanan
            $fotoPath = $foto->store('fotos', 'public');
        }

        // Menyimpan data siswa baru
        Siswa::create([
            'nis' => $request->nis,
            'nisn' => $request->nisn,
            'nik_siswa' => $request->nik_siswa,
            'nama_siswa' => $request->nama_siswa,
            'foto' => $fotoPath,
            'jeniskelamin_id' => $request->jeniskelamin_id,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'kelas_id' => $request->kelas_id,
            'program_id' => $request->program_id,
            'anak_ke' => $request->anak_ke,
            'no_kk' => $request->no_kk,
            'nik_ayah' => $request->nik_ayah,
            'nama_ayah' => $request->nama_ayah,
            'pendidikan_ayah_id' => $request->pendidikan_ayah_id,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'nik_ibu' => $request->nik_ibu,
            'nama_ibu' => $request->nama_ibu,
            'pendidikan_ibu_id' => $request->pendidikan_ibu_id,
            'pekerjaan_ibu' => $request->pekerjaan_ibu,
            'hp_siswa' => $request->hp_siswa,
            'hp_ortu' => $request->hp_ortu,
            'alamat' => $request->alamat,
            'kode_pos' => $request->kode_pos,
            'asal_sekolah' => $request->asal_sekolah,
            'npsn' => $request->npsn,
            'nsm' => $request->nsm,
            'alamat_sekolah' => $request->alamat_sekolah,
            'no_kip' => $request->no_kip,
            'no_kks' => $request->no_kks,
            'no_pkh' => $request->no_pkh,
        ]);

        return redirect()->route('siswas.index')->with('success', 'Data siswa berhasil ditambahkan');
    }

    // Menampilkan form edit siswa
    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        $jeniskelimans = JenisKelamin::all();
        $kelas = Kelas::all();
        $programs = Program::all();
        $pendidikans = Pendidikan::all();
        $pendidikanAyah = Pendidikan::all();
        $pendidikanIbu = Pendidikan::all();

        return view('siswas.edit', compact('siswa', 'jeniskelimans', 'kelas', 'programs', 'pendidikans', 'pendidikanAyah', 'pendidikanIbu'));
    }

    // Mengupdate data siswa
    public function update(Request $request, $id)
    {
        $request->validate([
            'nis' => 'required|unique:siswas,nis,' . $id,
            'nisn' => 'nullable|unique:siswas,nisn,' . $id,
            'nik_siswa' => 'nullable',
            'nama_siswa' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'jeniskelamin_id' => 'required|exists:jenis_kelamins,id',
            'tempat_lahir' => 'nullable|string|max:255',
            'tgl_lahir' => 'nullable|date',
            'kelas_id' => 'required|exists:kelas,id',
            'program_id' => 'required|exists:programs,id',
            'anak_ke' => 'nullable|integer',
            'no_kk' => 'nullable|string|max:20',
            'nik_ayah' => 'nullable|string|max:20',
            'nama_ayah' => 'nullable|string|max:255',
            'pendidikan_ayah_id' => 'nullable|exists:pendidikans,id',
            'pekerjaan_ayah' => 'nullable|string|max:255',
            'nik_ibu' => 'nullable|string|max:20',
            'nama_ibu' => 'nullable|string|max:255',
            'pendidikan_ibu_id' => 'nullable|exists:pendidikans,id',
            'pekerjaan_ibu' => 'nullable|string|max:255',
            'hp_siswa' => 'nullable|string|max:15',
            'hp_ortu' => 'nullable|string|max:15',
            'alamat' => 'nullable|string|max:500',
            'kode_pos' => 'nullable|string|max:10',
            'asal_sekolah' => 'nullable|string|max:255',
            'npsn' => 'nullable|string|max:15',
            'nsm' => 'nullable|string|max:15',
            'alamat_sekolah' => 'nullable|string|max:500',
            'no_kip' => 'nullable|string|max:20',
            'no_kks' => 'nullable|string|max:20',
            'no_pkh' => 'nullable|string|max:20',
        ]);

        $siswa = Siswa::findOrFail($id);

        // // Menyimpan foto baru jika ada
        // if ($request->hasFile('foto')) {
        //     // Hapus foto lama jika ada
        //     if ($siswa->foto && file_exists(storage_path('app/' . $siswa->foto))) {
        //         unlink(storage_path('app/' . $siswa->foto));
        //     }
        //     // Simpan foto baru
        //     $siswa->foto = $request->file('foto')->store('public/fotos');
        // }

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($siswa->foto && file_exists(public_path($siswa->foto))) {
                unlink(public_path($siswa->foto));
            }

            // Simpan foto baru langsung di public folder
            $fotoPath = $request->file('foto')->storeAs('fotos', $request->file('foto')->getClientOriginalName(), 'public');
            $siswa->foto = 'fotos/' . $request->file('foto')->getClientOriginalName();
        }

        // Perbarui data siswa
        $siswa->update($request->except(['foto']));

        return redirect()->route('siswas.index')->with('success', 'Data siswa berhasil diperbarui');
    }
    public function editSiswa($id)
    {
        $siswa = Siswa::findOrFail($id);
        $jeniskelimans = JenisKelamin::all();
        $kelas = Kelas::all();
        $programs = Program::all();

        return view('siswas.edit-siswa', compact('siswa', 'jeniskelimans', 'kelas', 'programs'));
    }

    public function updateSiswa(Request $request, $id)
    {
        $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'jeniskelamin_id' => 'required|exists:jenis_kelamins,id',
            'kelas_id' => 'required|exists:kelas,id',
            'program_id' => 'required|exists:programs,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $siswa = Siswa::findOrFail($id);
        $data = $request->except(['foto']);
        if ($request->hasFile('foto')) {
            if ($siswa->foto && Storage::disk('public')->exists($siswa->foto)) {
                Storage::disk('public')->delete($siswa->foto);
            }

            $data['foto'] = $request->file('foto')->store('fotos', 'public');
        }

        $siswa->nama_siswa = $request->nama_siswa;
        $siswa->jeniskelamin_id = $request->jeniskelamin_id;
        $siswa->kelas_id = $request->kelas_id;
        $siswa->program_id = $request->program_id;

        $siswa->save();

        return redirect()->route('profil')->with('success', 'Data siswa berhasil diperbarui.');
    }


    // Menghapus data siswa
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        // Hapus foto jika ada
        if ($siswa->foto && file_exists(storage_path('app/' . $siswa->foto))) {
            unlink(storage_path('app/' . $siswa->foto));
        }
        $siswa->delete();
        return redirect()->route('siswas.index')->with('success', 'Data siswa berhasil dihapus');
    }

    public function showRiwayatKelas($id)
    {
        $siswa = Siswa::with(['riwayatKelas.kelas', 'riwayatKelas.tahunPelajaran'])->findOrFail($id);

        return view('siswas.riwayat-kelas', compact('siswa'));
    }
}
