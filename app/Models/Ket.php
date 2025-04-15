<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ket extends Model
{
    use HasFactory;

    protected $table = 'kets';

    protected $fillable = ['ket'];
    public function raporLokals()
    {
        return $this->hasMany(RaporLokal::class);
    }
}
