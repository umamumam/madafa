<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KdumDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'kdum_id',
        'kompetensi_id',
        'nilai_id',
        'penyemak_id',
    ];

    public function kdum()
    {
        return $this->belongsTo(Kdum::class);
    }

    public function nilai()
    {
        return $this->belongsTo(Nilai::class);
    }

    public function penyemak()
    {
        return $this->belongsTo(Penyemak::class);
    }
    public function kompetensi()
    {
        return $this->belongsTo(Kompetensi::class);
    }
}
