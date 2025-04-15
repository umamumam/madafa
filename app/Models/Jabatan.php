<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $table = 'jabatans';

    protected $fillable = ['jabatan'];
    public function gurus()
    {
        return $this->belongsToMany(Guru::class, 'guru_jabatan', 'jabatan_id', 'guru_id');
    }
}
