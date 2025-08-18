<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Guru;
use App\Models\Kdum;
use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\KdumDetail;
use App\Models\Kompetensi;
use Illuminate\Http\Request;
use App\Models\TahunPelajaran;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class KdumController extends Controller
{
    public function index()
    {
        $kdums = Kdum::with(['siswa', 'kelas', 'tahunPelajaran'])->get();
        return view('kdum.index', compact('kdums'));
    }

    public function showDetail($id)
    {
        $kdum = Kdum::with(['siswa', 'kelas', 'tahunPelajaran', 'details.kompetensi', 'details.nilai', 'details.guru'])
            ->findOrFail($id);
        $gurus = Guru::all();
        return view('kdum.detail', compact('kdum', 'gurus'));
    }

    public function showBySiswa()
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
        $kdum = \App\Models\Kdum::with(['siswa.jenisKelamin', 'kelas.program', 'tahunPelajaran', 'details.kompetensi', 'details.nilai', 'details.guru'])
            ->where('siswa_id', $siswa->id)
            ->first();
        if (!$kdum) {
            return back()->with('error', 'KDUM belum dibuat untuk siswa ini.');
        }
        $gurus = Guru::all();
        return view('kdum.siswa-detail', compact('kdum', 'gurus'));
    }
    public function exportPdf($id)
    {
        $kdum = Kdum::with([
            'siswa.jenisKelamin',
            'kelas.program',
            'kelas.waliKelas',
            'tahunPelajaran',
            'details.kompetensi',
            'details.nilai',
            'details.guru',
        ])->findOrFail($id);

        $pdf = PDF::loadView('kdum.export-pdf', compact('kdum'));
        return $pdf->stream('KDUM_' . $kdum->siswa->nama_siswa . '.pdf');
    }
    public function exportAll()
    {
        $kdums = Kdum::with([
            'siswa.kelas.program',
            'raporTerbaru.tahunPelajaran',
            'details.kompetensi',
            'details.nilai',
            'details.guru'
        ])->get();

        $pdf = PDF::loadView('kdum.kdum-all', compact('kdums'))->setPaper('a4', 'portrait');
        return $pdf->stream('KDUM_Semua_Peserta.pdf');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        Excel::import(new \App\Imports\KdumImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data KDUM berhasil diimport.');
    }

    public function laporan(Request $request)
    {
        $kelas = Kelas::all();
        $selectedKelasId = $request->input('kelas_id');
        $siswasQuery = Siswa::with([
            'kdums' => function ($query) {
                $query->latest()->limit(1);
            },
            'kdums.details.kompetensi',
            'kdums.details.nilai',
            'kelas'
        ]);
        if ($selectedKelasId) {
            $siswasQuery->where('kelas_id', $selectedKelasId);
        }
        $siswas = $siswasQuery->get();
        $kompetensiList = Kompetensi::orderBy('urutan')->get();
        $tahunPelajaran = TahunPelajaran::where('active', true)->first();

        $data = [
            'siswas' => $siswas,
            'kompetensiList' => $kompetensiList,
            'tahunPelajaran' => $tahunPelajaran,
            'kelas' => $kelas,
            'selectedKelasId' => $selectedKelasId,
        ];

        return view('kdum.laporan', $data);
    }

    public function cetakLaporan(Request $request)
    {
        $selectedKelasId = $request->input('kelas_id');
        $siswasQuery = Siswa::with([
            'kdums' => function ($query) {
                $query->latest()->limit(1);
            },
            'kdums.details.kompetensi',
            'kdums.details.nilai',
            'kelas'
        ]);

        if ($selectedKelasId) {
            $siswasQuery->where('kelas_id', $selectedKelasId);
        }

        $siswas = $siswasQuery->get();

        $kompetensiList = Kompetensi::orderBy('urutan')->get();
        $tahunPelajaran = TahunPelajaran::where('active', true)->first();

        $data = [
            'siswas' => $siswas,
            'kompetensiList' => $kompetensiList,
            'tahunPelajaran' => $tahunPelajaran,
        ];

        $pdf = PDF::loadView('kdum.laporan_kdum', $data);
        return $pdf->stream('laporan_kdum_peserta.pdf');
    }
}
