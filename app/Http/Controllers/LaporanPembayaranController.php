<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Siswa;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanPembayaranExport;

class LaporanPembayaranController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->format('Y-m-d'));
        $status = $request->input('status', 'all');
        $siswaId = $request->input('siswa_id');

        $query = Pembayaran::with(['siswa'])
            ->whereBetween('tgl_bayar', [$startDate, $endDate])
            ->orderBy('tgl_bayar', 'desc');

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        if ($siswaId) {
            $query->where('siswa_id', $siswaId);
        }

        $pembayarans = $query->get();
        $siswas = Siswa::all();

        // Hitung total keseluruhan untuk tampilan jika dibutuhkan
        $totalAll = $pembayarans->sum(function ($item) {
            return
                $item->nominal_beasiswa +
                $item->nominal_spp +
                $item->nominal_dana_abadi +
                $item->nominal_bop_smt1 +
                $item->nominal_bop_smt2 +
                $item->nominal_buku_lks +
                $item->nominal_kitab +
                $item->nominal_seragam +
                $item->nominal_infaq_madrasah +
                $item->nominal_infaq_kalender +
                $item->nominal_outing_class +
                $item->nominal_lainlain;
        });

        return view('laporan.index', compact(
            'pembayarans',
            'siswas',
            'startDate',
            'endDate',
            'status',
            'siswaId',
            'totalAll'
        ));
    }

    public function cetak(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $status = $request->input('status', 'all');
        $siswaId = $request->input('siswa_id');

        $query = Pembayaran::with(['siswa'])
            ->whereBetween('tgl_bayar', [$startDate, $endDate])
            ->orderBy('tgl_bayar', 'desc');

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        if ($siswaId) {
            $query->where('siswa_id', $siswaId);
        }

        $pembayarans = $query->get();

        $totals = [
            'spp' => $pembayarans->sum('nominal_spp'),
            'dana_abadi' => $pembayarans->sum('nominal_dana_abadi'),
            'bop_smt1' => $pembayarans->sum('nominal_bop_smt1'),
            'bop_smt2' => $pembayarans->sum('nominal_bop_smt2'),
            'buku_lks' => $pembayarans->sum('nominal_buku_lks'),
            'kitab' => $pembayarans->sum('nominal_kitab'),
            'seragam' => $pembayarans->sum('nominal_seragam'),
            'infaq_madrasah' => $pembayarans->sum('nominal_infaq_madrasah'),
            'infaq_kalender' => $pembayarans->sum('nominal_infaq_kalender'),
            'outing_class' => $pembayarans->sum('nominal_outing_class'),
            'lainlain' => $pembayarans->sum('nominal_lainlain'),
        ];
        $totalAll = array_sum($totals);

        $data = [
            'pembayarans' => $pembayarans,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'totals' => $totals,
            'totalAll' => $totalAll,
        ];

        $pdf = Pdf::loadView('laporan.cetak', $data)
            ->setPaper([0, 0, 595.28, 935.43], 'landscape');

        return $pdf->stream('laporan-pembayaran.pdf');
    }

    public function exportExcel(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->format('Y-m-d'));
        $status = $request->input('status', 'all');
        $siswaId = $request->input('siswa_id');

        $query = Pembayaran::with(['siswa'])
            ->whereBetween('tgl_bayar', [$startDate, $endDate])
            ->orderBy('tgl_bayar', 'desc');

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        if ($siswaId) {
            $query->where('siswa_id', $siswaId);
        }

        $pembayarans = $query->get();

        $totals = [
            'spp' => $pembayarans->sum('nominal_spp'),
            'dana_abadi' => $pembayarans->sum('nominal_dana_abadi'),
            'bop_smt1' => $pembayarans->sum('nominal_bop_smt1'),
            'bop_smt2' => $pembayarans->sum('nominal_bop_smt2'),
            'buku_lks' => $pembayarans->sum('nominal_buku_lks'),
            'kitab' => $pembayarans->sum('nominal_kitab'),
            'seragam' => $pembayarans->sum('nominal_seragam'),
            'infaq_madrasah' => $pembayarans->sum('nominal_infaq_madrasah'),
            'infaq_kalender' => $pembayarans->sum('nominal_infaq_kalender'),
            'outing_class' => $pembayarans->sum('nominal_outing_class'),
            'lainlain' => $pembayarans->sum('nominal_lainlain'),
        ];
        $totalAll = array_sum($totals);

        $data = [
            'pembayarans' => $pembayarans,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'totals' => $totals,
            'totalAll' => $totalAll,
        ];

        return Excel::download(new LaporanPembayaranExport($data), 'laporan-pembayaran.xlsx');
    }
}
