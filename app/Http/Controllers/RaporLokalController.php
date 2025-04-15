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
        ])->findOrFail($id);

        return view('rapor-lokal.detail', compact('rapor'));
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

        $rapor = RaporLokal::with([
            'siswa.jenisKelamin',
            'kelas.program',
            'tahunPelajaran',
            'details.mapel',
            'details.nilai',
        ])
        ->where('siswa_id', $siswa->id)
        ->first();

        if (!$rapor) {
            return back()->with('error', 'Rapor Lokal belum tersedia untuk siswa ini.');
        }

        return view('rapor-lokal.siswa-detail', compact('rapor'));
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
