<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'nama_kelas',
        'program_id',
        'active',
        'walikelas_id',
    ];
    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'kelas_id');
    }
    public function program()
    {
        return $this->belongsTo(Program::class);
    }
    public function waliKelas()
    {
        return $this->belongsTo(Guru::class, 'walikelas_id');
    }
    public function kdums()
    {
        return $this->hasMany(Kdum::class);
    }
    public function raporLokals()
    {
        return $this->hasMany(RaporLokal::class);
    }
}
