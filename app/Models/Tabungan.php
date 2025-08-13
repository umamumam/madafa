<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tabungan extends Model
{
    use HasFactory;

    protected $table = 'tabungans';

    protected $fillable = [
        'siswa_nis',
        'petugas',
        'tgl_setor',
        'jumlah_setor',
    ];

    protected $casts = [
        'tgl_setor' => 'date',
        'jumlah_setor' => 'integer',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_nis', 'nis');
    }

    public function getTotalSaldoAttribute()
    {
        return $this->where('siswa_id', $this->siswa_id)->sum('jumlah_setor');
    }
}
