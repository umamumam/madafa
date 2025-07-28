<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Tabungan;
use App\Models\Pembayaran;
use App\Models\Guru; // Import model Guru
use Illuminate\Http\Request;
use App\Models\TahunPelajaran;
use Barryvdh\DomPDF\Facade\Pdf;
// use Illuminate\Support\Facades\Auth; // Tidak diperlukan lagi jika guru_id dipilih manual

class TabunganController extends Controller
{
    public function index($siswa_id)
    {
        $siswa = Siswa::with('kelas')->findOrFail($siswa_id);

        $tahunPelajaran = TahunPelajaran::where('active', true)->first();

        $pembayaran = Pembayaran::where('siswa_id', $siswa_id)->first();

        $tabungans = Tabungan::where('siswa_id', $siswa_id)
            ->orderBy('tgl_setor', 'asc')
            ->get();

        $totalSaldo = $tabungans->sum('jumlah_setor');

        $gurus = Guru::orderBy('nama_guru', 'asc')->get(); // Ambil semua data guru

        return view('tabungan.index', [
            'siswa' => $siswa,
            'tabungans' => $tabungans,
            'totalSaldo' => $totalSaldo,
            'tahunPelajaran' => $tahunPelajaran,
            'pembayaran' => $pembayaran,
            'gurus' => $gurus, // Kirim data guru ke view
        ]);
    }

    public function store(Request $request, $siswa_id)
    {
        $request->validate([
            'tgl_setor'    => 'required|date',
            'jumlah_setor' => 'required|integer|min:0',
            'guru_id'      => 'nullable|exists:gurus,id', // Validasi guru_id dari input form
        ]);

        // $guruId = Auth::check() ? Auth::id() : null; // Baris ini dihapus/dinonaktifkan

        Tabungan::create([
            'siswa_id'     => $siswa_id,
            'guru_id'      => $request->guru_id, // Ambil guru_id langsung dari request
            'tgl_setor'    => $request->tgl_setor,
            'jumlah_setor' => $request->jumlah_setor,
        ]);

        return redirect()->route('tabungan.index', $siswa_id)
            ->with('success', 'Setoran berhasil ditambahkan.');
    }

    public function destroy($siswa_id, $tabungan_id)
    {
        $tabungan = Tabungan::where('siswa_id', $siswa_id)->findOrFail($tabungan_id);
        $tabungan->delete();

        return redirect()->route('tabungan.index', $siswa_id)
            ->with('success', 'Data tabungan berhasil dihapus.');
    }

    public function cetakLaporan($siswa_id)
    {
        $siswa = Siswa::with('kelas')->findOrFail($siswa_id);
        $tahunPelajaran = TahunPelajaran::where('active', true)->first();
        $pembayaran = Pembayaran::where('siswa_id', $siswa_id)->first();
        $tabungans = Tabungan::where('siswa_id', $siswa_id)
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
    public function cetakKwitansi($siswa_id, $tabungan_id)
    {
        $siswa = Siswa::with('kelas')->findOrFail($siswa_id);
        $tabungan = Tabungan::with('guru')->where('siswa_id', $siswa_id)->findOrFail($tabungan_id);
        $saldoSebelumnya = Tabungan::where('siswa_id', $siswa_id)
            ->where('tgl_setor', '<', $tabungan->tgl_setor)
            ->sum('jumlah_setor');
        $saldoSebelumnya += Tabungan::where('siswa_id', $siswa_id)
            ->where('tgl_setor', $tabungan->tgl_setor)
            ->where('id', '<', $tabungan->id)
            ->sum('jumlah_setor');
        $saldoSetelahSetorIni = $saldoSebelumnya + $tabungan->jumlah_setor;
        $data = [
            'siswa' => $siswa,
            'tabungan' => $tabungan,
            'saldoSetelahSetorIni' => $saldoSetelahSetorIni,
            'tanggalCetak' => now()->translatedFormat('d F Y H:i:s'),
            'guruPencatat' => $tabungan->guru ? $tabungan->guru->nama_guru : 'Tidak Diketahui',
        ];
        $pdf = Pdf::loadView('tabungan.kwitansi', $data)
            ->setPaper('a4', 'portrait');
        return $pdf->stream('kwitansi-tabungan-' . $siswa->nis . '-' . $tabungan->id . '.pdf');
    }
}
