<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatKelasSiswa extends Model
{
    protected $table = 'riwayat_kelas_siswas';

    protected $fillable = [
        'siswa_id',
        'kelas_id',
        'tahun_pelajaran_id',
        'semester',
    ];

    protected static function booted()
    {
        static::created(function ($riwayat) {
            $existingRapor = \App\Models\RaporLokal::where('siswa_id', $riwayat->siswa_id)
                ->where('kelas_id', $riwayat->kelas_id)
                ->where('tahun_pelajaran_id', $riwayat->tahun_pelajaran_id)
                ->where('semester', $riwayat->semester)
                ->first();

            if (!$existingRapor) {
                \App\Models\RaporLokal::create([
                    'siswa_id' => $riwayat->siswa_id,
                    'kelas_id' => $riwayat->kelas_id,
                    'tahun_pelajaran_id' => $riwayat->tahun_pelajaran_id,
                    'semester' => $riwayat->semester,
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
}
