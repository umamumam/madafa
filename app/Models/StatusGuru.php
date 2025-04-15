<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusGuru extends Model
{
    use HasFactory;

    protected $table = 'status_gurus';

    protected $fillable = [
        'status',
    ];
    public function gurus()
    {
        return $this->hasMany(Guru::class, 'status_guru_id');
    }
}
