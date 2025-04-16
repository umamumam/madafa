<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\TahunPelajaran;
use App\Models\RiwayatKelasSiswa;
use Illuminate\Http\Request;

class RiwayatKelasSiswaController extends Controller
{
    public function create()
    {
        $siswas = Siswa::all();
        $kelas = Kelas::all();
        $tahunPelajarans = TahunPelajaran::where('active', true)->get();

        return view('riwayat_kelas_siswa.create', compact('siswas', 'kelas', 'tahunPelajarans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'kelas_id' => 'required|exists:kelas,id',
            'tahun_pelajaran_id' => 'required|exists:tahun_pelajarans,id',
            'semester' => 'required|in:1,2',
        ]);

        $riwayat = new RiwayatKelasSiswa();
        $riwayat->siswa_id = $request->siswa_id;
        $riwayat->kelas_id = $request->kelas_id;
        $riwayat->tahun_pelajaran_id = $request->tahun_pelajaran_id;
        $riwayat->semester = $request->semester;
        $riwayat->save();

        Siswa::where('id', $request->siswa_id)->update([
            'kelas_id' => $request->kelas_id,
        ]);

        return redirect()->route('siswas.index')->with('success', 'Riwayat kelas berhasil ditambahkan dan kelas siswa diperbarui.');
    }

    public function massUpdate()
    {
        $kelas = Kelas::all();
        $tahunPelajarans = TahunPelajaran::where('active', true)->get();

        return view('riwayat_kelas_siswa.mass-update', compact('kelas', 'tahunPelajarans'));
    }

    // RiwayatKelasSiswaController.php

    public function massStore(Request $request)
    {
        $request->validate([
            'kelas_asal_id' => 'required|exists:kelas,id',
            'kelas_tujuan_id' => 'required|exists:kelas,id',
            'tahun_pelajaran_id' => 'required|exists:tahun_pelajarans,id',
            'semester' => 'required|in:1,2',
        ]);
        $siswaList = Siswa::where('kelas_id', $request->kelas_asal_id)->get();
        foreach ($siswaList as $siswa) {
            $exists = RiwayatKelasSiswa::where('siswa_id', $siswa->id)
                ->where('kelas_id', $request->kelas_tujuan_id)
                ->where('tahun_pelajaran_id', $request->tahun_pelajaran_id)
                ->where('semester', $request->semester)
                ->exists();
            if (!$exists) {
                RiwayatKelasSiswa::create([
                    'siswa_id' => $siswa->id,
                    'kelas_id' => $request->kelas_tujuan_id,
                    'tahun_pelajaran_id' => $request->tahun_pelajaran_id,
                    'semester' => $request->semester
                ]);
            }
            $siswa->update(['kelas_id' => $request->kelas_tujuan_id]);
        }

        return redirect()->route('siswas.index')->with('success', 'Semua siswa berhasil dipindah dan riwayat ditambahkan.');
    }
    public function naikKelas(Request $request)
    {
        $request->validate([
            'kelas_asal_id' => 'required|exists:kelas,id',
            'kelas_tujuan_id' => 'required|exists:kelas,id',
            'tahun_pelajaran_id' => 'required|exists:tahun_pelajarans,id',
            'semester' => 'required|in:1,2',
        ]);

        $siswas = Siswa::where('kelas_id', $request->kelas_asal_id)->get();

        foreach ($siswas as $siswa) {
            $siswa->update(['kelas_id' => $request->kelas_tujuan_id]);
            RiwayatKelasSiswa::create([
                'siswa_id' => $siswa->id,
                'kelas_id' => $request->kelas_tujuan_id,
                'tahun_pelajaran_id' => $request->tahun_pelajaran_id,
                'semester' => $request->semester,
            ]);
            $siswa->createRaporLokal();
        }

        return redirect()->route('siswas.index')->with('success', 'Naik kelas berhasil dan rapor lokal sudah dibuat.');
    }
}
