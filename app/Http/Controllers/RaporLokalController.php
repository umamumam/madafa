<?php

namespace App\Http\Controllers;

use App\Models\RaporLokal;
use App\Models\Penyemak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class RaporLokalController extends Controller
{
    public function index()
    {
        $raporLokals = RaporLokal::with(['siswa', 'kelas', 'tahunPelajaran'])->get();
        return view('rapor-lokal.index', compact('raporLokals'));
    }

    public function showDetail($id)
    {
        $rapor = RaporLokal::with([
            'siswa',
            'kelas',
            'tahunPelajaran',
            'details.mapel',
            'details.nilai',
            'nilaiSpiritual',
            'nilaiSosial',
            'nilaiEkstra',
            'ekstrakurikuler',
            'ket',
            'waliKelas',
            'kepalaMadrasah',
        ])->findOrFail($id);

        $nilais = \App\Models\Nilai::all();
        $ekstras = \App\Models\Ekstrakurikuler::all();
        $keterangans = \App\Models\Ket::all();
        $gurus = \App\Models\Guru::all();
        return view('rapor-lokal.detail', compact('rapor', 'nilais', 'ekstras', 'keterangans', 'gurus'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nilai_spiritual_id' => 'nullable|exists:nilais,id',
            'deskripsi_spiritual' => 'nullable|string',
            'nilai_sosial_id' => 'nullable|exists:nilais,id',
            'deskripsi_sosial' => 'nullable|string',
            'ekstrakurikuler_id' => 'nullable|exists:ekstrakurikulers,id',
            'nilai_ekstra_id' => 'nullable|exists:nilais,id',
            'sakit' => 'nullable|integer',
            'izin' => 'nullable|integer',
            'tanpa_keterangan' => 'nullable|integer',
            'catatan' => 'nullable|string',
            'ket_id' => 'nullable|exists:kets,id',
            'walikelas_id' => 'nullable|exists:gurus,id',
            'kepala_madrasah_id' => 'nullable|exists:gurus,id',
        ]);

        $rapor = RaporLokal::findOrFail($id);
        $rapor->update($request->all());

        return redirect()->back()->with('success', 'Data rapor berhasil diperbarui.');
    }


    // public function showBySiswa(Request $request)
    // {
    //     $user = Auth::user();

    //     if ($user->role !== 'siswa') {
    //         return redirect()->route('dashboard')->with('error', 'Hanya siswa yang dapat mengakses halaman ini.');
    //     }

    //     $siswa = \App\Models\Siswa::where('nisn', $user->nisn)
    //         ->orWhere('nis', $user->nis)
    //         ->first();

    //     if (!$siswa) {
    //         return back()->with('error', 'Data siswa tidak ditemukan.');
    //     }

    //     // ambil semester dari query parameter (default ke 1)
    //     $semester = $request->query('semester', 1);

    //     $rapor = RaporLokal::with([
    //         'siswa.jenisKelamin',
    //         'kelas.program',
    //         'tahunPelajaran',
    //         'details.mapel',
    //         'details.nilai',
    //         'nilaiSpiritual',
    //         'nilaiSosial',
    //         'nilaiEkstra',
    //         'ekstrakurikuler',
    //         'ket',
    //         'waliKelas',
    //         'kepalaMadrasah',
    //     ])
    //         ->where('siswa_id', $siswa->id)
    //         ->where('semester', $semester)
    //         ->first();

    //     if (!$rapor) {
    //         return back()->with('error', "Rapor semester $semester belum tersedia untuk siswa ini.");
    //     }

    //     return view('rapor-lokal.siswa-detail', compact('rapor', 'semester'));
    // }
    // public function showBySiswa(Request $request)
    // {
    //     $user = Auth::user();

    //     if ($user->role !== 'siswa') {
    //         return redirect()->route('dashboard')->with('error', 'Hanya siswa yang dapat mengakses halaman ini.');
    //     }

    //     $siswa = \App\Models\Siswa::where('nisn', $user->nisn)
    //         ->orWhere('nis', $user->nis)
    //         ->first();

    //     if (!$siswa) {
    //         return back()->with('error', 'Data siswa tidak ditemukan.');
    //     }

    //     // ambil semester dan kelas dari query parameter (default ke 1 untuk semester, null untuk kelas)
    //     $semester = $request->query('semester', 1);
    //     $kelasId = $request->query('kelas_id', null);

    //     $raporQuery = RaporLokal::with([
    //         'siswa.jenisKelamin',
    //         'kelas.program',
    //         'tahunPelajaran',
    //         'details.mapel',
    //         'details.nilai',
    //         'nilaiSpiritual',
    //         'nilaiSosial',
    //         'nilaiEkstra',
    //         'ekstrakurikuler',
    //         'ket',
    //         'waliKelas',
    //         'kepalaMadrasah',
    //     ])
    //     ->where('siswa_id', $siswa->id)
    //     ->where('semester', $semester);

    //     // Tambahkan filter untuk kelas jika ada
    //     if ($kelasId) {
    //         $raporQuery->where('kelas_id', $kelasId);
    //     }

    //     $rapor = $raporQuery->first();

    //     if (!$rapor) {
    //         return back()->with('error', "Rapor semester $semester untuk kelas $kelasId belum tersedia untuk siswa ini.");
    //     }

    //     // Ambil daftar kelas yang tersedia untuk siswa
    //     $kelasList = \App\Models\Kelas::all();

    //     return view('rapor-lokal.siswa-detail', compact('rapor', 'semester', 'kelasList'));
    // }
    public function showBySiswa(Request $request)
    {
        $user = Auth::user();
        if ($user->role !== 'siswa') {
            return redirect()->route('dashboard')->with('error', 'Hanya siswa yang dapat mengakses halaman ini.');
        }
        $siswa = \App\Models\Siswa::where('nisn', $user->nisn)
            ->orWhere('nis', $user->nis)
            ->first();
        if (!$siswa) {
            return back()->with('error', 'Data siswa tidak ditemukan.');
        }
        $semester = $request->query('semester', 1);
        $kelasId = $request->query('kelas_id', null);
        $kelasList = RaporLokal::where('siswa_id', $siswa->id)
            ->where('semester', $semester)
            ->pluck('kelas_id');
        $raporQuery = RaporLokal::with([
            'siswa.jenisKelamin',
            'kelas.program',
            'tahunPelajaran',
            'details.mapel',
            'details.nilai',
            'nilaiSpiritual',
            'nilaiSosial',
            'nilaiEkstra',
            'ekstrakurikuler',
            'ket',
            'waliKelas',
            'kepalaMadrasah',
        ])
            ->where('siswa_id', $siswa->id)
            ->where('semester', $semester);
        if ($kelasId) {
            $raporQuery->where('kelas_id', $kelasId);
        }
        $rapor = $raporQuery->first();
        if (!$rapor) {
            return back()->with('error', "Rapor semester $semester untuk kelas $kelasId belum tersedia untuk siswa ini.");
        }
        $kelasList = \App\Models\Kelas::whereIn('id', $kelasList)->get();
        return view('rapor-lokal.siswa-detail', compact('rapor', 'semester', 'kelasList'));
    }



    public function exportPdf($id)
    {
        $rapor = RaporLokal::with([
            'siswa.jenisKelamin',
            'kelas.program',
            'kelas.waliKelas',
            'tahunPelajaran',
            'details.mapel',
            'details.nilai',
        ])->findOrFail($id);

        $pdf = PDF::loadView('rapor-lokal.export-pdf', compact('rapor'));
        return $pdf->stream('RaporLokal_' . $rapor->siswa->nama_siswa . '.pdf');
    }
}
