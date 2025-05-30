<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kdum extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswa_id',
        'kelas_id',
        'tahun_pelajaran_id'
    ];

    public static $disableBooted = false;

    protected static function booted()
    {
        static::created(function ($kdum) {
            // <<< CEK FLAG
            if (self::$disableBooted) {
                return; // kalau flag aktif, skip
            }
            $kompetensis = \App\Models\Kompetensi::all();

            foreach ($kompetensis as $kompetensi) {
                \App\Models\KdumDetail::create([
                    'kdum_id' => $kdum->id,
                    'kompetensi_id' => $kompetensi->id,
                ]);
            }
        });
    }


    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function tahunPelajaran()
    {
        return $this->belongsTo(TahunPelajaran::class);
    }

    public function details()
    {
        return $this->hasMany(KdumDetail::class);
    }
    public function raporTerbaru()
    {
        return $this->hasOne(RaporLokal::class, 'siswa_id', 'siswa_id')->latestOfMany();
    }
}
