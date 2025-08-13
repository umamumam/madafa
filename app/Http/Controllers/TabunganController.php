<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Tabungan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\Models\TahunPelajaran;
use Barryvdh\DomPDF\Facade\Pdf;

class TabunganController extends Controller
{
    public function index($siswa_nis)
    {
        $siswa = Siswa::with('kelas')->where('nis', $siswa_nis)->firstOrFail();
        $tahunPelajaran = TahunPelajaran::where('active', true)->first();
        $pembayaran = Pembayaran::where('siswa_nis', $siswa_nis)->first();

        $tabungans = Tabungan::where('siswa_nis', $siswa_nis)
            ->orderBy('tgl_setor', 'asc')
            ->get();

        $totalSaldo = $tabungans->sum('jumlah_setor');

        return view('tabungan.index', [
            'siswa' => $siswa,
            'tabungans' => $tabungans,
            'totalSaldo' => $totalSaldo,
            'tahunPelajaran' => $tahunPelajaran,
            'pembayaran' => $pembayaran,
        ]);
    }

    public function store(Request $request, $siswa_nis)
    {
        $request->validate([
            'tgl_setor'    => 'required|date',
            'jumlah_setor' => 'required|integer|min:0',
            'petugas'      => 'required|in:Anis Maimanah,M. Fahruddin,Lainnya',
        ]);

        Tabungan::create([
            'siswa_nis'    => $siswa_nis,
            'petugas'      => $request->petugas,
            'tgl_setor'    => $request->tgl_setor,
            'jumlah_setor' => $request->jumlah_setor,
        ]);

        return redirect()->route('tabungan.index', $siswa_nis)
            ->with('success', 'Setoran berhasil ditambahkan.');
    }

    public function destroy($siswa_nis, $tabungan_id)
    {
        $tabungan = Tabungan::where('siswa_nis', $siswa_nis)->findOrFail($tabungan_id);
        $tabungan->delete();

        return redirect()->route('tabungan.index', $siswa_nis)
            ->with('success', 'Data tabungan berhasil dihapus.');
    }

    public function cetakLaporan($siswa_nis)
    {
        $siswa = Siswa::with('kelas')->where('nis', $siswa_nis)->firstOrFail();
        $tahunPelajaran = TahunPelajaran::where('active', true)->first();
        $pembayaran = Pembayaran::where('siswa_nis', $siswa_nis)->first();
        $tabungans = Tabungan::where('siswa_nis', $siswa_nis)
            ->orderBy('tgl_setor', 'asc')
            ->get();
        $totalSaldo = $tabungans->sum('jumlah_setor');

        $data = [
            'siswa' => $siswa,
            'tabungans' => $tabungans,
            'totalSaldo' => $totalSaldo,
            'tahunPelajaran' => $tahunPelajaran,
            'pembayaran' => $pembayaran,
            'tanggalCetak' => now()->translatedFormat('d F Y H:i:s')
        ];

        $pdf = Pdf::loadView('tabungan.laporan', $data)
            ->setPaper('a4', 'portrait');
        return $pdf->stream('laporan-tabungan-' . $siswa->nis . '.pdf');
    }

    public function cetakKwitansi($siswa_nis, $tabungan_id)
    {
        $siswa = Siswa::with('kelas')->where('nis', $siswa_nis)->firstOrFail();
        $tabungan = Tabungan::where('siswa_nis', $siswa_nis)->findOrFail($tabungan_id);

        $saldoSebelumnya = Tabungan::where('siswa_nis', $siswa_nis)
            ->where('tgl_setor', '<', $tabungan->tgl_setor)
            ->sum('jumlah_setor');

        $saldoSebelumnya += Tabungan::where('siswa_nis', $siswa_nis)
            ->where('tgl_setor', $tabungan->tgl_setor)
            ->where('id', '<', $tabungan->id)
            ->sum('jumlah_setor');

        $saldoSetelahSetorIni = $saldoSebelumnya + $tabungan->jumlah_setor;

        $data = [
            'siswa' => $siswa,
            'tabungan' => $tabungan,
            'saldoSetelahSetorIni' => $saldoSetelahSetorIni,
            'tanggalCetak' => now()->translatedFormat('d F Y H:i:s'),
            'petugasPencatat' => $tabungan->petugas ?? 'Tidak Diketahui',
        ];

        $pdf = Pdf::loadView('tabungan.kwitansi', $data)
            ->setPaper('a4', 'portrait');
        return $pdf->stream('kwitansi-tabungan-' . $siswa->nis . '-' . $tabungan->id . '.pdf');
    }
}
