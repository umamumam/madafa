<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RaporLokal extends Model
{
    protected $fillable = [
        'siswa_id',
        'kelas_id',
        'semester',
        'tahun_pelajaran_id',
        'nilai_spiritual_id',
        'deskripsi_spiritual',
        'nilai_sosial_id',
        'deskripsi_sosial',
        'ekstrakurikuler_id',
        'nilai_ekstra_id',
        'sakit',
        'izin',
        'tanpa_keterangan',
        'catatan',
        'ket_id',
        'walikelas_id',
        'kepala_madrasah_id'
    ];

    protected static function booted()
    {
        static::created(function ($raporLokal) {
            $mapels = Mapel::all();

            foreach ($mapels as $mapel) {
                RaporLokalDetail::create([
                    'rapor_lokal_id' => $raporLokal->id,
                    'mapel_id' => $mapel->id,
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

    public function ekstrakurikuler()
    {
        return $this->belongsTo(Ekstrakurikuler::class);
    }

    public function ket()
    {
        return $this->belongsTo(Ket::class);
    }

    public function walikelas()
    {
        return $this->belongsTo(Guru::class, 'walikelas_id');
    }

    public function kepalaMadrasah()
    {
        return $this->belongsTo(Guru::class, 'kepala_madrasah_id');
    }

    public function details()
    {
        return $this->hasMany(RaporLokalDetail::class);
    }

    public function nilaiSpiritual()
    {
        return $this->belongsTo(Nilai::class, 'nilai_spiritual_id');
    }

    public function nilaiSosial()
    {
        return $this->belongsTo(Nilai::class, 'nilai_sosial_id');
    }

    public function nilaiEkstra()
    {
        return $this->belongsTo(Nilai::class, 'nilai_ekstra_id');
    }
    public function getSpiritualKeteranganAttribute()
    {
        return $this->nilaiSpiritual?->keterangan;
    }

    public function getSosialKeteranganAttribute()
    {
        return $this->nilaiSosial?->keterangan;
    }

    public function getEkstraAbjadAttribute()
    {
        return $this->nilaiEkstra?->abjad;
    }
}
