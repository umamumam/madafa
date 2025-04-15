<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunPelajaran extends Model
{
    use HasFactory;

    protected $table = 'tahun_pelajarans';

    protected $fillable = [
        'tahun',
        'active',
    ];
    public function kdums()
    {
        return $this->hasMany(Kdum::class, 'tahun_pelajaran_id');
    }
    public function raporLokals()
    {
        return $this->hasMany(RaporLokal::class);
    }
}
