<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alumni extends Model
{
    use HasFactory;

    protected $fillable = [
        'nis', 'nisn', 'nik_siswa', 'nama_siswa', 'foto',
        'jeniskelamin', 'tempat_lahir', 'tgl_lahir', 'kelas', 'program',
        'anak_ke', 'no_kk', 'nik_ayah', 'nama_ayah', 'pendidikan_ayah',
        'pekerjaan_ayah', 'nik_ibu', 'nama_ibu', 'pendidikan_ibu',
        'pekerjaan_ibu', 'hp_siswa', 'hp_ortu', 'alamat', 'kode_pos',
        'asal_sekolah', 'npsn', 'nsm', 'alamat_sekolah',
        'no_kip', 'no_kks', 'no_pkh'
    ];
}
