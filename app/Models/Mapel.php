<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    protected $table = 'mapels';

    protected $fillable = ['mapel'];
    public function gurus()
    {
        return $this->belongsToMany(Guru::class, 'guru_mapel', 'mapel_id', 'guru_id');
    }
    public function raporLokalDetails()
    {
        return $this->hasMany(RaporLokalDetail::class);
    }
}
