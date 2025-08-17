<?php

namespace App\Imports;

use App\Models\Pembayaran;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class PembayaranImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    public function model(array $row)
    {
        if (empty($row['siswa_nis'])) {
            return null;
        }

        $tgl_bayar = Carbon::now('Asia/Jakarta')->format('Y-m-d');

        if (!empty($row['tgl_bayar'])) {
            try {
                if (is_numeric($row['tgl_bayar'])) {
                    $tgl_bayar = Date::excelToDateTimeObject($row['tgl_bayar'])
                        ->format('Y-m-d');
                } else {
                    $tgl_bayar = Carbon::parse($row['tgl_bayar'])
                        ->format('Y-m-d');
                }
            } catch (\Exception $e) {
                $tgl_bayar = Carbon::now('Asia/Jakarta')->format('Y-m-d');
            }
        }

        return new Pembayaran([
            'siswa_nis' => $row['siswa_nis'],
            'petugas' => $row['petugas'] ?? 'Imported Data',
            'jenis_pembayaran' => $row['jenis_pembayaran'] ?? '-',

            'tagihan_spp' => $row['tagihan_spp'] ?? 0,
            'tagihan_dana_abadi' => $row['tagihan_dana_abadi'] ?? 0,
            'tagihan_bop_smt1' => $row['tagihan_bop_smt1'] ?? 0,
            'tagihan_bop_smt2' => $row['tagihan_bop_smt2'] ?? 0,
            'tagihan_buku_lks' => $row['tagihan_buku_lks'] ?? 0,
            'tagihan_kitab' => $row['tagihan_kitab'] ?? 0,
            'tagihan_seragam' => $row['tagihan_seragam'] ?? 0,
            'tagihan_infaq_madrasah' => $row['tagihan_infaq_madrasah'] ?? 0,
            'tagihan_infaq_kalender' => $row['tagihan_infaq_kalender'] ?? 0,
            'tagihan_outing_class' => $row['tagihan_outing_class'] ?? 0,
            'tagihan_lainlain' => $row['tagihan_lainlain'] ?? 0,

            'nominal_beasiswa' => $row['nominal_beasiswa'] ?? 0,
            'nominal_spp' => $row['nominal_spp'] ?? 0,
            'nominal_dana_abadi' => $row['nominal_dana_abadi'] ?? 0,
            'nominal_bop_smt1' => $row['nominal_bop_smt1'] ?? 0,
            'nominal_bop_smt2' => $row['nominal_bop_smt2'] ?? 0,
            'nominal_buku_lks' => $row['nominal_buku_lks'] ?? 0,
            'nominal_kitab' => $row['nominal_kitab'] ?? 0,
            'nominal_seragam' => $row['nominal_seragam'] ?? 0,
            'nominal_infaq_madrasah' => $row['nominal_infaq_madrasah'] ?? 0,
            'nominal_infaq_kalender' => $row['nominal_infaq_kalender'] ?? 0,
            'nominal_outing_class' => $row['nominal_outing_class'] ?? 0,
            'nominal_lainlain' => $row['nominal_lainlain'] ?? 0,

            'tgl_bayar' => $tgl_bayar,
            'status' => $row['status'] ?? 'Cash',
            'keterangan' => $row['keterangan'] ?? null,
        ]);
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
