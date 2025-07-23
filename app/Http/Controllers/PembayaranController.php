<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\TahunPelajaran;

class PembayaranController extends Controller
{
    // Menampilkan semua pembayaran untuk siswa tertentu
    public function index($siswa_id)
    {
        $siswa = Siswa::with(['pembayarans' => function ($query) {
            $query->orderBy('tgl_bayar', 'desc');
        }, 'pembayarans.guru'])->findOrFail($siswa_id);

        return view('pembayaran.index', compact('siswa'));
    }

    // Menampilkan form tambah pembayaran
    public function create($siswa_id)
    {
        $siswa = Siswa::findOrFail($siswa_id);
        $gurus = Guru::all();
        return view('pembayaran.create', compact('siswa', 'gurus'));
    }

    // Menyimpan pembayaran baru
    public function store(Request $request, $siswa_id)
    {
        $validated = $request->validate([
            'jenis_pembayaran' => 'required|array|min:1',
            'jenis_pembayaran.*' => 'in:SPP,Infaq,Seragam,Kitab,Kolektif,Dana Abadi,BOP Semester 1,BOP Semester 2,Buku LKS,Infaq Madrasah,Infaq Kalender,Lain-lain',
            'nominal_spp' => 'nullable|required_if:jenis_pembayaran,SPP|numeric|min:1000',
            'nominal_dana_abadi' => 'nullable|required_if:jenis_pembayaran,Dana Abadi|numeric|min:1000',
            'nominal_bop_smt1' => 'nullable|required_if:jenis_pembayaran,BOP Semester 1|numeric|min:1000',
            'nominal_bop_smt2' => 'nullable|required_if:jenis_pembayaran,BOP Semester 2|numeric|min:1000',
            'nominal_buku_lks' => 'nullable|required_if:jenis_pembayaran,Buku LKS|numeric|min:1000',
            'nominal_kitab' => 'nullable|required_if:jenis_pembayaran,Kitab|numeric|min:1000',
            'nominal_seragam' => 'nullable|required_if:jenis_pembayaran,Seragam|numeric|min:1000',
            'nominal_infaq_madrasah' => 'nullable|required_if:jenis_pembayaran,Infaq Madrasah|numeric|min:1000',
            'nominal_infaq_kelender' => 'nullable|required_if:jenis_pembayaran,Infaq Kalender|numeric|min:1000',
            'nominal_lainlain' => 'nullable|required_if:jenis_pembayaran,Lain-lain|numeric|min:1000',
            'tgl_bayar' => 'required|date',
            'status' => 'required|in:Cash,Transfer',
            'keterangan' => 'nullable|string|max:255',
            'guru_id' => 'nullable|exists:gurus,id'
        ]);

        // Create payment record
        Pembayaran::create([
            'siswa_id' => $siswa_id,
            'guru_id' => $request->guru_id,
            'jenis_pembayaran' => implode(', ', $request->jenis_pembayaran),
            'nominal_spp' => $request->nominal_spp,
            'nominal_dana_abadi' => $request->nominal_dana_abadi,
            'nominal_bop_smt1' => $request->nominal_bop_smt1,
            'nominal_bop_smt2' => $request->nominal_bop_smt2,
            'nominal_buku_lks' => $request->nominal_buku_lks,
            'nominal_kitab' => $request->nominal_kitab,
            'nominal_seragam' => $request->nominal_seragam,
            'nominal_infaq_madrasah' => $request->nominal_infaq_madrasah,
            'nominal_infaq_kelender' => $request->nominal_infaq_kelender,
            'nominal_lainlain' => $request->nominal_lainlain,
            'tgl_bayar' => $request->tgl_bayar,
            'status' => $request->status,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('pembayaran.index', $siswa_id)
            ->with('success', 'Pembayaran berhasil ditambahkan!');
    }

    // Menampilkan form edit pembayaran
    public function edit($siswa_id, $pembayaran_id)
    {
        $pembayaran = Pembayaran::where('siswa_id', $siswa_id)->findOrFail($pembayaran_id);
        $selectedJenis = array_map('trim', explode(',', $pembayaran->jenis_pembayaran));
        $gurus = Guru::all();
        $siswa = Siswa::findOrFail($siswa_id);
        return view('pembayaran.edit', compact('pembayaran', 'siswa', 'selectedJenis', 'gurus'));
    }

    // Update data pembayaran
    public function update(Request $request, $siswa_id, $pembayaran_id)
    {
        $validated = $request->validate([
            'jenis_pembayaran' => 'required|array|min:1',
            'jenis_pembayaran.*' => 'in:SPP,Infaq,Seragam,Kitab,Kolektif,Dana Abadi,BOP Semester 1,BOP Semester 2,Buku LKS,Infaq Madrasah,Infaq Kalender,Lain-lain',
            'nominal_spp' => 'nullable|required_if:jenis_pembayaran,SPP|numeric|min:1000',
            'nominal_dana_abadi' => 'nullable|required_if:jenis_pembayaran,Dana Abadi|numeric|min:1000',
            'nominal_bop_smt1' => 'nullable|required_if:jenis_pembayaran,BOP Semester 1|numeric|min:1000',
            'nominal_bop_smt2' => 'nullable|required_if:jenis_pembayaran,BOP Semester 2|numeric|min:1000',
            'nominal_buku_lks' => 'nullable|required_if:jenis_pembayaran,Buku LKS|numeric|min:1000',
            'nominal_kitab' => 'nullable|required_if:jenis_pembayaran,Kitab|numeric|min:1000',
            'nominal_seragam' => 'nullable|required_if:jenis_pembayaran,Seragam|numeric|min:1000',
            'nominal_infaq_madrasah' => 'nullable|required_if:jenis_pembayaran,Infaq Madrasah|numeric|min:1000',
            'nominal_infaq_kelender' => 'nullable|required_if:jenis_pembayaran,Infaq Kalender|numeric|min:1000',
            'nominal_lainlain' => 'nullable|required_if:jenis_pembayaran,Lain-lain|numeric|min:1000',
            'tgl_bayar' => 'required|date',
            'status' => 'required|in:Cash,Transfer',
            'keterangan' => 'nullable|string|max:255',
            'guru_id' => 'nullable|exists:gurus,id'
        ]);

        $pembayaran = Pembayaran::where('siswa_id', $siswa_id)
            ->findOrFail($pembayaran_id);

        $pembayaran->update([
            'jenis_pembayaran' => implode(', ', $request->jenis_pembayaran),
            'nominal_spp' => $request->nominal_spp,
            'nominal_dana_abadi' => $request->nominal_dana_abadi,
            'nominal_bop_smt1' => $request->nominal_bop_smt1,
            'nominal_bop_smt2' => $request->nominal_bop_smt2,
            'nominal_buku_lks' => $request->nominal_buku_lks,
            'nominal_kitab' => $request->nominal_kitab,
            'nominal_seragam' => $request->nominal_seragam,
            'nominal_infaq_madrasah' => $request->nominal_infaq_madrasah,
            'nominal_infaq_kelender' => $request->nominal_infaq_kelender,
            'nominal_lainlain' => $request->nominal_lainlain,
            'tgl_bayar' => $request->tgl_bayar,
            'status' => $request->status,
            'keterangan' => $request->keterangan,
            'guru_id' => $request->guru_id
        ]);

        return redirect()->route('pembayaran.index', $siswa_id)
            ->with('success', 'Pembayaran berhasil diperbarui!');
    }

    // Hapus pembayaran
    public function destroy($siswa_id, $pembayaran_id)
    {
        Pembayaran::where('siswa_id', $siswa_id)
            ->findOrFail($pembayaran_id)
            ->delete();

        return redirect()->route('pembayaran.index', $siswa_id)
            ->with('success', 'Pembayaran berhasil dihapus!');
    }

    // Cetak kuitansi
    public function cetakKuitansi(Request $request, $siswa_id, $pembayaran_id)
    {
        Carbon::setLocale('id');
        $pembayaran = Pembayaran::with(['siswa', 'guru'])
            ->where('siswa_id', $siswa_id)
            ->findOrFail($pembayaran_id);
        $tahunPelajaran = TahunPelajaran::where('active', true)->first();
        $jenis_pembayaran = [
            'SPP' => $pembayaran->nominal_spp,
            'Dana Abadi' => $pembayaran->nominal_dana_abadi,
            'BOP Semester 1' => $pembayaran->nominal_bop_smt1,
            'BOP Semester 2' => $pembayaran->nominal_bop_smt2,
            'Buku LKS' => $pembayaran->nominal_buku_lks,
            'Kitab' => $pembayaran->nominal_kitab,
            'Seragam' => $pembayaran->nominal_seragam,
            'Infaq Madrasah' => $pembayaran->nominal_infaq_madrasah,
            'Infaq Kalender' => $pembayaran->nominal_infaq_kelender,
            'Lain-lain' => $pembayaran->nominal_lainlain
        ];

        // Filter hanya jenis yang memiliki nilai
        $jenis_pembayaran = array_filter($jenis_pembayaran, function ($value) {
            return $value > 0;
        });

        $total = array_sum($jenis_pembayaran);

        $data = [
            'pembayaran' => $pembayaran,
            'jenis_pembayaran' => $jenis_pembayaran,
            'total' => $total,
            'tanggal' => now()->translatedFormat('d F Y H:i:s'),
            'kode_transaksi' => 'INV-' . str_pad($pembayaran->id, 5, '0', STR_PAD_LEFT),
            'petugas' => $pembayaran->guru ? $pembayaran->guru->nama_guru : 'Petugas Belum Dipilih',
            'tahun_pelajaran' => $tahunPelajaran?->tahun ?? '-'
        ];

        $pdf = Pdf::loadView('pembayaran.kuitansi', $data)
            ->setPaper('a4', 'portrait')
            ->setOption('isRemoteEnabled', true)
            ->setOption('isHtml5ParserEnabled', true);

        if ($request->has('preview')) {
            return $pdf->stream('kuitansi-pembayaran.pdf');
        }

        if ($request->has('download')) {
            $filename = 'Kuitansi-' . $pembayaran->siswa->nama_siswa . '-' . $pembayaran->id . '.pdf';
            return $pdf->download($filename);
        }

        return $pdf->stream('kuitansi-pembayaran.pdf');
    }
}
