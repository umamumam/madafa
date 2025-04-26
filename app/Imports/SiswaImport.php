<?php

namespace App\Imports;

use App\Models\Siswa;
use App\Models\JenisKelamin;
use App\Models\Pendidikan;
use App\Models\Kelas;
use App\Models\Program;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Siswa([
            'nis' => $row['nis'],
            'nisn' => $row['nisn'],
            'nik_siswa' => $row['nik_siswa'],
            'nama_siswa' => $row['nama_siswa'],
            'jeniskelamin_id' => $this->getJenisKelaminId($row['jenis_kelamin']),
            'tempat_lahir' => $row['tempat_lahir'],
            'tgl_lahir' => $row['tgl_lahir'],
            'kelas_id' => $this->getKelasId($row['kelas']),
            'program_id' => $this->getProgramId($row['program']),
            'anak_ke' => $row['anak_ke'],
            'no_kk' => $row['no_kk'],
            'nik_ayah' => $row['nik_ayah'],
            'nama_ayah' => $row['nama_ayah'],
            'pendidikan_ayah_id' => $this->getPendidikanId($row['pendidikan_ayah']),
            'pekerjaan_ayah' => $row['pekerjaan_ayah'],
            'nik_ibu' => $row['nik_ibu'],
            'nama_ibu' => $row['nama_ibu'],
            'pendidikan_ibu_id' => $this->getPendidikanId($row['pendidikan_ibu']),
            'pekerjaan_ibu' => $row['pekerjaan_ibu'],
            'hp_siswa' => $row['hp_siswa'],
            'hp_ortu' => $row['hp_ortu'],
            'alamat' => $row['alamat'],
            'kode_pos' => $row['kode_pos'],
            'asal_sekolah' => $row['asal_sekolah'],
            'npsn' => $row['npsn'],
            'nsm' => $row['nsm'],
            'alamat_sekolah' => $row['alamat_sekolah'],
            'no_kip' => $row['no_kip'],
            'no_kks' => $row['no_kks'],
            'no_pkh' => $row['no_pkh'],
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

    private function getKelasId($text)
    {
        return Kelas::whereRaw('LOWER(nama_kelas) = ?', [strtolower($text)])->value('id');
    }

    private function getProgramId($text)
    {
        return Program::whereRaw('LOWER(program) = ?', [strtolower($text)])->value('id');
    }
}

