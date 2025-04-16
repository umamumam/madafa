<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatKelasSiswa extends Model
{
    protected $table = 'riwayat_kelas_siswas';

    protected $fillable = [
        'siswa_id',
        'kelas_id',
        'tahun_pelajaran_id',
        'semester',
    ];
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
    public function tahunPelajaran()
    {
        return $this->belongsTo(TahunPelajaran::class);
    }
}
