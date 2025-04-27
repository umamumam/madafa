<?php

namespace App\Imports;

use App\Models\Kdum;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\TahunPelajaran;
use App\Models\Kompetensi;
use App\Models\KdumDetail;
use App\Models\Nilai;
use App\Models\Guru;
use App\Models\Penyemak;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KdumImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        \App\Models\Kdum::$disableBooted = true;

        foreach ($rows as $row) {
            $siswa = Siswa::where('nis', $row['nis'])->first();
            $kelas = Kelas::where('nama_kelas', $row['kelas'])->first();
            $tahunPelajaran = TahunPelajaran::where('tahun', $row['tahun_pelajaran'])->first();

            if (!$siswa || !$kelas || !$tahunPelajaran) {
                continue; // skip kalau tidak ketemu
            }

            Kdum::where('siswa_id', $siswa->id)->delete();

            $kdum = Kdum::create([
                'siswa_id' => $siswa->id,
                'kelas_id' => $kelas->id,
                'tahun_pelajaran_id' => $tahunPelajaran->id,
            ]);

            $kompetensis = Kompetensi::orderBy('urutan')->get();

            foreach ($kompetensis as $kompetensi) {
                $namaKolomNilai = 'kompetensi_' . $kompetensi->urutan;
                $namaKolomPenyemak = 'penyemak_' . $kompetensi->urutan;

                if (isset($row[$namaKolomNilai])) {
                    $nilaiId = $this->konversiNilai($row[$namaKolomNilai]);

                    $penyemakId = null;
                    if (isset($row[$namaKolomPenyemak])) {
                        $namaGuru = trim($row[$namaKolomPenyemak]);
                        $guru = Guru::where('nama_guru', $namaGuru)->first();
                        if ($guru) {
                            $penyemak = Penyemak::where('guru_id', $guru->id)->first();
                            if ($penyemak) {
                                $penyemakId = $penyemak->id;
                            }
                        }
                    }

                    KdumDetail::create([
                        'kdum_id' => $kdum->id,
                        'kompetensi_id' => $kompetensi->id,
                        'nilai_id' => $nilaiId,
                        'penyemak_id' => $penyemakId,
                    ]);
                }
            }
        }

        // <<< SETELAH IMPORT selesai, aktifkan lagi
        \App\Models\Kdum::$disableBooted = false;
    }

    private function konversiNilai($text)
    {
        $abjad = strtoupper(trim($text));
        $nilai = Nilai::where('abjad', $abjad)->first();
        return $nilai ? $nilai->id : null;
    }
}
