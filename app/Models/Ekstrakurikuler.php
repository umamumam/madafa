<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekstrakurikuler extends Model
{
    use HasFactory;

    protected $table = 'ekstrakurikulers';

    protected $fillable = ['ekskul'];
    public function raporLokals()
    {
        return $this->hasMany(RaporLokal::class);
    }
}
