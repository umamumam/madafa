<?php

namespace App\Exports;

use App\Models\Alumni;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AlumniExport implements FromCollection, WithHeadings
{
    protected $selectedIds;

    public function __construct(array $selectedIds)
    {
        $this->selectedIds = $selectedIds;
    }

    public function collection()
    {
        return Alumni::whereIn('id', $this->selectedIds)->get([
            'nama_siswa',
            'nis',
            'nisn',
            'nik_siswa',
            'foto',
            'jeniskelamin',
            'tempat_lahir',
            'tgl_lahir',
            'kelas',
            'program',
            'anak_ke',
            'no_kk',
            'nik_ayah',
            'nama_ayah',
            'pendidikan_ayah',
            'pekerjaan_ayah',
            'nik_ibu',
            'nama_ibu',
            'pendidikan_ibu',
            'pekerjaan_ibu',
            'hp_siswa',
            'hp_ortu',
            'alamat',
            'kode_pos',
            'asal_sekolah',
            'npsn',
            'nsm',
            'alamat_sekolah',
            'no_kip',
            'no_kks',
            'no_pkh'
        ]);
    }

    public function headings(): array
    {
        return [
            'Nama Siswa',
            'NIS',
            'NISN',
            'NIK Siswa',
            'Foto',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Kelas',
            'Program',
            'Anak ke',
            'No KK',
            'NIK Ayah',
            'Nama Ayah',
            'Pendidikan Ayah',
            'Pekerjaan Ayah',
            'NIK Ibu',
            'Nama Ibu',
            'Pendidikan Ibu',
            'Pekerjaan Ibu',
            'HP Siswa',
            'HP Orang Tua',
            'Alamat',
            'Kode Pos',
            'Asal Sekolah',
            'NPSN',
            'NSM',
            'Alamat Sekolah',
            'No KIP',
            'No KKS',
            'No PKH'
        ];
    }
}
