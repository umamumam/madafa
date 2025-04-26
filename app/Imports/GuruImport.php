<?php

namespace App\Imports;

use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Jabatan;
use App\Models\Pendidikan;
use App\Models\StatusGuru;
use App\Models\JenisKelamin;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GuruImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $validator = Validator::make($row, [
            'tgl_lahir' => 'nullable|date_format:Y-m-d',
        ]);

        if ($validator->fails()) {
            return null;
        }

        return new Guru([
            'idguru' => $row['idguru'],
            'nama_guru' => $row['nama_guru'],
            'niy_nip' => $row['niy_nip'],
            'npk_nuptk_pegid' => $row['npk_nuptk_pegid'],
            'nik' => $row['nik'],
            'tempat_lahir' => $row['tempat_lahir'],
            'tgl_lahir' => $row['tgl_lahir'],
            'jeniskelamin_id' => $this->getJenisKelaminId($row['jenis_kelamin']),
            'pendidikan_terakhir_id' => $this->getPendidikanId($row['pendidikan_terakhir']),
            'inst_pend_terakhir' => $row['inst_pend_terakhir'],
            'alamat' => $row['alamat'],
            'no_hp' => $row['no_hp'],
            'tmt_sk_awal' => $row['tmt_sk_awal'],
            'status_guru_id' => $this->getStatusGuruId($row['status_guru']),
            'masa_kerja' => $row['masa_kerja'],
            'mapel_1_id' => $this->getMapelId($row['mapel_1']),
            'mapel_2_id' => $this->getMapelId($row['mapel_2']),
            'mapel_3_id' => $this->getMapelId($row['mapel_3']),
            'jabatan_1_id' => $this->getJabatanId($row['jabatan_1']),
            'jabatan_2_id' => $this->getJabatanId($row['jabatan_2']),
            'jabatan_3_id' => $this->getJabatanId($row['jabatan_3']),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    private function getJenisKelaminId($text)
    {
        return JenisKelamin::whereRaw('LOWER(jeniskelamin) = ?', [strtolower($text)])->value('id');
    }

    private function getPendidikanId($text)
    {
        return Pendidikan::whereRaw('LOWER(pendidikan) = ?', [strtolower($text)])->value('id');
    }

    private function getMapelId($text)
    {
        return Mapel::whereRaw('LOWER(mapel) = ?', [strtolower($text)])->value('id');
    }

    private function getJabatanId($text)
    {
        return Jabatan::whereRaw('LOWER(jabatan) = ?', [strtolower($text)])->value('id');
    }

    private function getStatusGuruId($text)
    {
        return StatusGuru::whereRaw('LOWER(status) = ?', [strtolower($text)])->value('id');
    }
}
