<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKelamin extends Model
{
    use HasFactory;

    protected $table = 'jenis_kelamins';

    protected $fillable = [
        'jeniskelamin',
    ];
    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'jeniskelamin_id');
    }
    public function gurus()
    {
        return $this->hasMany(Guru::class, 'jeniskelamin_id');
    }
}

