<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DokumenSiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswa_id',
        'kk',
        'akte',
        'surat_keterangan_lulus',
        'kip'
    ];
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
