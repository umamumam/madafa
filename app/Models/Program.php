<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $table = 'programs';

    protected $fillable = [
        'program',
    ];
    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'program_id');
    }
    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }
}
