<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
    use HasFactory;

    protected $table = 'pendidikans';

    protected $fillable = [
        'pendidikan',
    ];
    public function siswasAyah()
    {
        return $this->hasMany(Siswa::class, 'pendidikan_ayah_id');
    }

    public function siswasIbu()
    {
        return $this->hasMany(Siswa::class, 'pendidikan_ibu_id');
    }
    public function gurus()
    {
        return $this->hasMany(Guru::class, 'pendidikan_terakhir_id');
    }
}
