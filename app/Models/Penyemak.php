<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyemak extends Model
{
    use HasFactory;

    protected $table = 'penyemaks';

    protected $fillable = [
        'guru_id',
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }
    public function kdumDetails()
    {
        return $this->hasMany(KdumDetail::class);
    }
}
