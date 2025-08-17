<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\TahunPelajaran;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PembayaranImport;

class PembayaranController extends Controller
{
    public function index($siswa_nis)
    {
        $siswa = Siswa::with(['pembayarans' => function ($query) {
            $query->orderBy('tgl_bayar', 'desc');
        }])->where('nis', $siswa_nis)->firstOrFail();

        return view('pembayaran.index', compact('siswa'));
    }

    public function daftar()
    {
        $siswas = Siswa::with(['pembayarans' => function ($query) {
            $query->orderBy('tgl_bayar', 'desc');
        }])->get();
        return view('pembayaran.daftar', compact('siswas'));
    }

    public function pembayaran()
    {
        $pembayarans = Pembayaran::with('siswa')
            ->orderBy('tgl_bayar', 'desc')
            ->get();
        return view('pembayaran.pembayaran', compact('pembayarans'));
    }
public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        try {
            Excel::import(new PembayaranImport, $request->file('file'));

            return redirect()->back()->with('success', 'Data pembayaran berhasil diimpor!');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $errors = [];
            foreach ($failures as $failure) {
                $errors[] = 'Baris ' . $failure->row() . ': ' . implode(', ', $failure->errors());
            }
            return redirect()->back()->with('error', 'Gagal mengimpor data. ' . implode(' | ', $errors));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengimpor data. Pastikan format file Anda benar. Error: ' . $e->getMessage());
        }
    }

    public function create($siswa_nis)
    {
        $siswa = Siswa::where('nis', $siswa_nis)->firstOrFail();
        $gurus = Guru::all();
        return view('pembayaran.create', compact('siswa', 'gurus'));
    }

    public function store(Request $request, $siswa_nis)
    {
        $validated = $request->validate([
            'petugas' => 'required|string',
            'jenis_pembayaran' => 'required|array|min:1',
            'jenis_pembayaran.*' => 'in:SPP,Infaq,Seragam,Kitab,Kolektif,Dana Abadi,BOP Semester 1,BOP Semester 2,Buku LKS,Infaq Madrasah,Infaq Kalender,Outing Class,Lain-lain',

            // Validasi tagihan
            'tagihan_spp' => 'nullable|numeric|min:0',
            'tagihan_dana_abadi' => 'nullable|numeric|min:0',
            'tagihan_bop_smt1' => 'nullable|numeric|min:0',
            'tagihan_bop_smt2' => 'nullable|numeric|min:0',
            'tagihan_buku_lks' => 'nullable|numeric|min:0',
            'tagihan_kitab' => 'nullable|numeric|min:0',
            'tagihan_seragam' => 'nullable|numeric|min:0',
            'tagihan_infaq_madrasah' => 'nullable|numeric|min:0',
            'tagihan_infaq_kalender' => 'nullable|numeric|min:0',
            'tagihan_outing_class' => 'nullable|numeric|min:0',
            'tagihan_lainlain' => 'nullable|numeric|min:0',

            // Validasi nominal beasiswa baru
            'nominal_beasiswa' => 'nullable|numeric|min:0',

            // Validasi pembayaran
            'nominal_spp' => 'nullable|required_if:jenis_pembayaran,SPP|numeric|min:0',
            'nominal_dana_abadi' => 'nullable|required_if:jenis_pembayaran,Dana Abadi|numeric|min:0|lte:tagihan_dana_abadi',
            'nominal_bop_smt1' => 'nullable|required_if:jenis_pembayaran,BOP Semester 1|numeric|min:0|lte:tagihan_bop_smt1',
            'nominal_bop_smt2' => 'nullable|required_if:jenis_pembayaran,BOP Semester 2|numeric|min:0|lte:tagihan_bop_smt2',
            'nominal_buku_lks' => 'nullable|required_if:jenis_pembayaran,Buku LKS|numeric|min:0|lte:tagihan_buku_lks',
            'nominal_kitab' => 'nullable|required_if:jenis_pembayaran,Kitab|numeric|min:0|lte:tagihan_kitab',
            'nominal_seragam' => 'nullable|required_if:jenis_pembayaran,Seragam|numeric|min:0|lte:tagihan_seragam',
            'nominal_infaq_madrasah' => 'nullable|required_if:jenis_pembayaran,Infaq Madrasah|numeric|min:0|lte:tagihan_infaq_madrasah',
            'nominal_infaq_kalender' => 'nullable|required_if:jenis_pembayaran,Infaq Kalender|numeric|min:0|lte:tagihan_infaq_kalender',
            'nominal_outing_class' => 'nullable|required_if:jenis_pembayaran,Outing Class|numeric|min:0|lte:tagihan_outing_class',
            'nominal_lainlain' => 'nullable|required_if:jenis_pembayaran,Lain-lain|numeric|min:0|lte:tagihan_lainlain',

            'tgl_bayar' => 'nullable|date',
            'status' => 'required|in:Cash,Transfer',
            'keterangan' => 'nullable|string|max:255',
        ]);

        Pembayaran::create([
            'siswa_nis' => $siswa_nis,
            'petugas' => $request->petugas,
            'jenis_pembayaran' => implode(', ', $request->jenis_pembayaran),

            // Tagihan
            'tagihan_spp' => $request->tagihan_spp ?? 0,
            'tagihan_dana_abadi' => $request->tagihan_dana_abadi ?? 0,
            'tagihan_bop_smt1' => $request->tagihan_bop_smt1 ?? 0,
            'tagihan_bop_smt2' => $request->tagihan_bop_smt2 ?? 0,
            'tagihan_buku_lks' => $request->tagihan_buku_lks ?? 0,
            'tagihan_kitab' => $request->tagihan_kitab ?? 0,
            'tagihan_seragam' => $request->tagihan_seragam ?? 0,
            'tagihan_infaq_madrasah' => $request->tagihan_infaq_madrasah ?? 0,
            'tagihan_infaq_kalender' => $request->tagihan_infaq_kalender ?? 0,
            'tagihan_outing_class' => $request->tagihan_outing_class ?? 0,
            'tagihan_lainlain' => $request->tagihan_lainlain ?? 0,

            // Pembayaran
            'nominal_beasiswa' => $request->nominal_beasiswa ?? 0,
            'nominal_spp' => $request->nominal_spp ?? 0,
            'nominal_dana_abadi' => $request->nominal_dana_abadi ?? 0,
            'nominal_bop_smt1' => $request->nominal_bop_smt1 ?? 0,
            'nominal_bop_smt2' => $request->nominal_bop_smt2 ?? 0,
            'nominal_buku_lks' => $request->nominal_buku_lks ?? 0,
            'nominal_kitab' => $request->nominal_kitab ?? 0,
            'nominal_seragam' => $request->nominal_seragam ?? 0,
            'nominal_infaq_madrasah' => $request->nominal_infaq_madrasah ?? 0,
            'nominal_infaq_kalender' => $request->nominal_infaq_kalender ?? 0,
            'nominal_outing_class' => $request->nominal_outing_class ?? 0,
            'nominal_lainlain' => $request->nominal_lainlain ?? 0,

            'tgl_bayar' => $request->tgl_bayar,
            'status' => $request->status,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('pembayaran.index', $siswa_nis)
            ->with('success', 'Pembayaran berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $siswa = $pembayaran->siswa;
        $selectedJenis = array_map('trim', explode(',', $pembayaran->jenis_pembayaran));
        $gurus = Guru::all();

        return view('pembayaran.edit', compact('pembayaran', 'siswa', 'selectedJenis', 'gurus'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'petugas' => 'required|string',
                'jenis_pembayaran' => 'required|array|min:1',
                'jenis_pembayaran.*' => 'in:SPP,Infaq,Seragam,Kitab,Kolektif,Dana Abadi,BOP Semester 1,BOP Semester 2,Buku LKS,Infaq Madrasah,Infaq Kalender,Outing Class,Lain-lain',

                // Validasi tagihan
                'tagihan_spp' => 'nullable|numeric|min:0',
                'tagihan_dana_abadi' => 'nullable|numeric|min:0',
                'tagihan_bop_smt1' => 'nullable|numeric|min:0',
                'tagihan_bop_smt2' => 'nullable|numeric|min:0',
                'tagihan_buku_lks' => 'nullable|numeric|min:0',
                'tagihan_kitab' => 'nullable|numeric|min:0',
                'tagihan_seragam' => 'nullable|numeric|min:0',
                'tagihan_infaq_madrasah' => 'nullable|numeric|min:0',
                'tagihan_infaq_kalender' => 'nullable|numeric|min:0',
                'tagihan_outing_class' => 'nullable|numeric|min:0',
                'tagihan_lainlain' => 'nullable|numeric|min:0',

                // Validasi nominal beasiswa
                'nominal_beasiswa' => 'nullable|numeric|min:0',

                // Validasi pembayaran
                'nominal_spp' => 'nullable|required_if:jenis_pembayaran,SPP|numeric|min:0',
                'nominal_dana_abadi' => 'nullable|required_if:jenis_pembayaran,Dana Abadi|numeric|min:0|lte:tagihan_dana_abadi',
                'nominal_bop_smt1' => 'nullable|required_if:jenis_pembayaran,BOP Semester 1|numeric|min:0|lte:tagihan_bop_smt1',
                'nominal_bop_smt2' => 'nullable|required_if:jenis_pembayaran,BOP Semester 2|numeric|min:0|lte:tagihan_bop_smt2',
                'nominal_buku_lks' => 'nullable|required_if:jenis_pembayaran,Buku LKS|numeric|min:0|lte:tagihan_buku_lks',
                'nominal_kitab' => 'nullable|required_if:jenis_pembayaran,Kitab|numeric|min:0|lte:tagihan_kitab',
                'nominal_seragam' => 'nullable|required_if:jenis_pembayaran,Seragam|numeric|min:0|lte:tagihan_seragam',
                'nominal_infaq_madrasah' => 'nullable|required_if:jenis_pembayaran,Infaq Madrasah|numeric|min:0|lte:tagihan_infaq_madrasah',
                'nominal_infaq_kalender' => 'nullable|required_if:jenis_pembayaran,Infaq Kalender|numeric|min:0|lte:tagihan_infaq_kalender',
                'nominal_outing_class' => 'nullable|required_if:jenis_pembayaran,Outing Class|numeric|min:0|lte:tagihan_outing_class',
                'nominal_lainlain' => 'nullable|required_if:jenis_pembayaran,Lain-lain|numeric|min:0|lte:tagihan_lainlain',

                'tgl_bayar' => 'nullable|date',
                'status' => 'required|in:Cash,Transfer',
                'keterangan' => 'nullable|string|max:255',
            ]);

            $pembayaran = Pembayaran::findOrFail($id);
            $siswa_nis = $pembayaran->siswa_nis;

            $pembayaran->update([
                'petugas' => $request->petugas,
                'jenis_pembayaran' => implode(', ', $request->jenis_pembayaran),

                // Tagihan
                'tagihan_spp' => $request->tagihan_spp ?? 0,
                'tagihan_dana_abadi' => $request->tagihan_dana_abadi ?? 0,
                'tagihan_bop_smt1' => $request->tagihan_bop_smt1 ?? 0,
                'tagihan_bop_smt2' => $request->tagihan_bop_smt2 ?? 0,
                'tagihan_buku_lks' => $request->tagihan_buku_lks ?? 0,
                'tagihan_kitab' => $request->tagihan_kitab ?? 0,
                'tagihan_seragam' => $request->tagihan_seragam ?? 0,
                'tagihan_infaq_madrasah' => $request->tagihan_infaq_madrasah ?? 0,
                'tagihan_infaq_kalender' => $request->tagihan_infaq_kalender ?? 0,
                'tagihan_outing_class' => $request->tagihan_outing_class ?? 0,
                'tagihan_lainlain' => $request->tagihan_lainlain ?? 0,

                // Pembayaran
                'nominal_beasiswa' => $request->nominal_beasiswa ?? 0,
                'nominal_spp' => $request->nominal_spp ?? 0,
                'nominal_dana_abadi' => $request->nominal_dana_abadi ?? 0,
                'nominal_bop_smt1' => $request->nominal_bop_smt1 ?? 0,
                'nominal_bop_smt2' => $request->nominal_bop_smt2 ?? 0,
                'nominal_buku_lks' => $request->nominal_buku_lks ?? 0,
                'nominal_kitab' => $request->nominal_kitab ?? 0,
                'nominal_seragam' => $request->nominal_seragam ?? 0,
                'nominal_infaq_madrasah' => $request->nominal_infaq_madrasah ?? 0,
                'nominal_infaq_kalender' => $request->nominal_infaq_kalender ?? 0,
                'nominal_outing_class' => $request->nominal_outing_class ?? 0,
                'nominal_lainlain' => $request->nominal_lainlain ?? 0,

                'tgl_bayar' => $request->tgl_bayar,
                'status' => $request->status,
                'keterangan' => $request->keterangan
            ]);

            return redirect()->route('pembayaran.index', $siswa_nis)
                ->with('success', 'Pembayaran berhasil diperbarui!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Gagal memperbarui pembayaran: ' . $e->getMessage());
        }
    }

    public function destroy($siswa_nis, $pembayaran_id)
    {
        Pembayaran::where('siswa_nis', $siswa_nis)
            ->findOrFail($pembayaran_id)
            ->delete();

        return redirect()->route('pembayaran.index', $siswa_nis)
            ->with('success', 'Pembayaran berhasil dihapus!');
    }

    public function cetakKuitansi(Request $request, $siswa_nis, $pembayaran_id)
    {
        Carbon::setLocale('id');
        $pembayaran = Pembayaran::with('siswa')
            ->where('siswa_nis', $siswa_nis)
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
            'Infaq Kalender' => $pembayaran->nominal_infaq_kalender,
            'Outing Class' => $pembayaran->nominal_outing_class,
            'Lain-lain' => $pembayaran->nominal_lainlain
        ];
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
            'petugas' => $pembayaran->petugas,
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

    public function show($siswa_nis, $pembayaran_id)
    {
        $tahunPelajaran = TahunPelajaran::where('active', true)->first();
        $pembayaran = Pembayaran::with(['siswa.kelas'])
            ->where('siswa_nis', $siswa_nis)
            ->findOrFail($pembayaran_id);
        return view('pembayaran.show', compact('pembayaran', 'tahunPelajaran'));
    }

    public function cetakRincian(Request $request, $siswa_nis, $pembayaran_id)
    {
        Carbon::setLocale('id');

        $tahunPelajaran = TahunPelajaran::where('active', true)->first();
        $pembayaran = Pembayaran::with(['siswa.kelas'])
            ->where('siswa_nis', $siswa_nis)
            ->findOrFail($pembayaran_id);

        $paymentItemsDefinition = [
            'Syahriyah' => ['tagihan_field' => 'tagihan_spp', 'nominal_field' => 'nominal_spp'],
            'Dana Abadi' => ['tagihan_field' => 'tagihan_dana_abadi', 'nominal_field' => 'nominal_dana_abadi'],
            'BOP Smt.1' => ['tagihan_field' => 'tagihan_bop_smt1', 'nominal_field' => 'nominal_bop_smt1'],
            'BOP Smt.2' => ['tagihan_field' => 'tagihan_bop_smt2', 'nominal_field' => 'nominal_bop_smt2'],
            'Buku Paket & LKS' => ['tagihan_field' => 'tagihan_buku_lks', 'nominal_field' => 'nominal_buku_lks'],
            'Kitab' => ['tagihan_field' => 'tagihan_kitab', 'nominal_field' => 'nominal_kitab'],
            'Seragam' => ['tagihan_field' => 'tagihan_seragam', 'nominal_field' => 'nominal_seragam'],
            'Infaq Madrasah' => ['tagihan_field' => 'tagihan_infaq_madrasah', 'nominal_field' => 'nominal_infaq_madrasah'],
            'Infaq Kalender' => ['tagihan_field' => 'tagihan_infaq_kalender', 'nominal_field' => 'nominal_infaq_kalender'],
            'Outing Class' => ['tagihan_field' => 'tagihan_outing_class', 'nominal_field' => 'nominal_outing_class'],
            'Lain-lain' => ['tagihan_field' => 'tagihan_lainlain', 'nominal_field' => 'nominal_lainlain'],
        ];

        $displayItems = [];
        $totalTagihanKeseluruhan = 0;
        $totalTerbayarKeseluruhan = 0;

        $nominalBeasiswa = $pembayaran->nominal_beasiswa ?? 0;

        foreach ($paymentItemsDefinition as $label => $fields) {
            $originalTagihan = $pembayaran->{$fields['tagihan_field']} ?? 0;
            $nominalDibayar = $pembayaran->{$fields['nominal_field']} ?? 0;

            $currentSisa = $originalTagihan - $nominalDibayar;

            if ($label === 'Syahriyah') {
                $effectiveTagihanSpp = max(0, $originalTagihan - $nominalBeasiswa);
                $currentSisa = $effectiveTagihanSpp - $nominalDibayar;

                if ($originalTagihan > 0 || $nominalDibayar > 0 || $nominalBeasiswa > 0) {
                    $displayItems[] = [
                        'label' => $label,
                        'tagihan' => $originalTagihan,
                        'terbayar' => $nominalDibayar,
                        'sisa' => $currentSisa,
                    ];
                    $totalTagihanKeseluruhan += $effectiveTagihanSpp;
                    $totalTerbayarKeseluruhan += $nominalDibayar;
                }
            } else {
                if ($originalTagihan > 0 || $nominalDibayar > 0) {
                    $displayItems[] = [
                        'label' => $label,
                        'tagihan' => $originalTagihan,
                        'terbayar' => $nominalDibayar,
                        'sisa' => $currentSisa,
                    ];
                    $totalTagihanKeseluruhan += $originalTagihan;
                    $totalTerbayarKeseluruhan += $nominalDibayar;
                }
            }
        }

        $totalSisaKeseluruhan = $totalTagihanKeseluruhan - $totalTerbayarKeseluruhan;

        $data = [
            'pembayaran' => $pembayaran,
            'tahunPelajaran' => $tahunPelajaran,
            'displayItems' => $displayItems,
            'totalTagihanKeseluruhan' => $totalTagihanKeseluruhan,
            'totalTerbayarKeseluruhan' => $totalTerbayarKeseluruhan,
            'totalSisaKeseluruhan' => $totalSisaKeseluruhan,
        ];

        $pdf = Pdf::loadView('pembayaran.rincian_laporan', $data)
            ->setPaper('a4', 'portrait')
            ->setOption('isRemoteEnabled', true)
            ->setOption('isHtml5ParserEnabled', true);

        $filename = 'Laporan_Pembayaran_' . $pembayaran->siswa->nama_siswa . '_' . $pembayaran->id . '.pdf';

        if ($request->has('download')) {
            return $pdf->download($filename);
        }

        return $pdf->stream($filename);
    }
}
