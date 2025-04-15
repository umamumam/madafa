<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RaporLokalDetail extends Model
{
    protected $fillable = [
        'rapor_lokal_id', 'mapel_id', 'nilai_id',
        'predikat', 'jumlah', 'rata_rata'
    ];

    public function raporLokal() {
        return $this->belongsTo(RaporLokal::class);
    }

    public function mapel() {
        return $this->belongsTo(Mapel::class);
    }

    public function nilai() {
        return $this->belongsTo(Nilai::class);
    }
    public function getAbjadAttribute()
    {
        return $this->nilai?->abjad;
    }

    public function getKeteranganAttribute()
    {
        return $this->nilai?->keterangan;
    }
}

