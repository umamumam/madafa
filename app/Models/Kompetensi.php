<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kompetensi extends Model
{
    use HasFactory;

    protected $table = 'kompetensis';

    protected $fillable = [
        'urutan',
        'nama_kompetensi',
    ];

    // Relasi ke kdum_details
    public function kdumDetails()
    {
        return $this->hasMany(KdumDetail::class);
    }
}
