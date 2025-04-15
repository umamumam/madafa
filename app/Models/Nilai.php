<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $table = 'nilais';

    protected $fillable = ['min', 'max', 'abjad', 'keterangan'];
    public function kdumDetails()
    {
        return $this->hasMany(KdumDetail::class);
    }
    public function raporSpiritual()
    {
        return $this->hasMany(RaporLokal::class, 'nilai_spiritual_id');
    }

    public function raporSosial()
    {
        return $this->hasMany(RaporLokal::class, 'nilai_sosial_id');
    }

    public function raporEkstra()
    {
        return $this->hasMany(RaporLokal::class, 'nilai_ekstra_id');
    }
}
