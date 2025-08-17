<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayarans';

    protected $fillable = [
        // 'siswa_id',
        'siswa_nis',
        'petugas',
        'jenis_pembayaran',
        // Tagihan fields
        'tagihan_spp',
        'tagihan_dana_abadi',
        'tagihan_bop_smt1',
        'tagihan_bop_smt2',
        'tagihan_buku_lks',
        'tagihan_kitab',
        'tagihan_seragam',
        'tagihan_infaq_madrasah',
        'tagihan_infaq_kalender',
        'tagihan_outing_class',
        'tagihan_lainlain',
        // Pembayaran fields
        'nominal_beasiswa',
        'nominal_spp',
        'nominal_dana_abadi',
        'nominal_bop_smt1',
        'nominal_bop_smt2',
        'nominal_buku_lks',
        'nominal_kitab',
        'nominal_seragam',
        'nominal_infaq_madrasah',
        'nominal_infaq_kalender',
        'nominal_outing_class',
        'nominal_lainlain',
        'tgl_bayar',
        'status',
        'keterangan'
    ];

    protected $casts = [
        'tgl_bayar' => 'date',
        // Cast numeric fields to integer
        'tagihan_spp' => 'integer',
        'tagihan_dana_abadi' => 'integer',
        'tagihan_bop_smt1' => 'integer',
        'tagihan_bop_smt2' => 'integer',
        'tagihan_buku_lks' => 'integer',
        'tagihan_kitab' => 'integer',
        'tagihan_seragam' => 'integer',
        'tagihan_infaq_madrasah' => 'integer',
        'tagihan_infaq_kalender' => 'integer',
        'tagihan_outing_class' => 'integer',
        'tagihan_lainlain' => 'integer',
        'nominal_beasiswa' => 'integer',
        'nominal_spp' => 'integer',
        'nominal_dana_abadi' => 'integer',
        'nominal_bop_smt1' => 'integer',
        'nominal_bop_smt2' => 'integer',
        'nominal_buku_lks' => 'integer',
        'nominal_kitab' => 'integer',
        'nominal_seragam' => 'integer',
        'nominal_infaq_madrasah' => 'integer',
        'nominal_infaq_kalender' => 'integer',
        'nominal_outing_class' => 'integer',
        'nominal_lainlain' => 'integer',
    ];

    // protected static function boot()
    // {
    //     parent::boot();

    //     /**
    //      * Event 'saving' akan dipicu sebelum model disimpan (baik saat membuat atau memperbarui).
    //      * Di sini kita akan menghitung ulang nominal_spp.
    //      */
    //     static::saving(function ($model) {
    //         // Pastikan tagihan_spp dan nominal_beasiswa diperlakukan sebagai 0 jika null
    //         $tagihanSpp = $model->tagihan_spp ?? 0;
    //         $nominalBeasiswa = $model->nominal_beasiswa ?? 0;

    //         // Hitung nominal_spp dengan mengurangi nominal_beasiswa dari tagihan_spp.
    //         // Pastikan nominal_spp tidak kurang dari 0.
    //         $model->nominal_spp = max(0, $tagihanSpp - $nominalBeasiswa);
    //     });
    // }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_nis', 'nis');
    }


    // public function guru()
    // {
    //     return $this->belongsTo(Guru::class);
    // }

    public function getTotalAttribute()
    {
        return collect([
            $this->nominal_spp,
            $this->nominal_dana_abadi,
            $this->nominal_bop_smt1,
            $this->nominal_bop_smt2,
            $this->nominal_buku_lks,
            $this->nominal_kitab,
            $this->nominal_seragam,
            $this->nominal_infaq_madrasah,
            $this->nominal_infaq_kalender,
            $this->nominal_outing_class,
            $this->nominal_lainlain
        ])->sum();
    }

    public function getTotalTagihanAttribute()
    {
        return collect([
            $this->tagihan_spp,
            $this->tagihan_dana_abadi,
            $this->tagihan_bop_smt1,
            $this->tagihan_bop_smt2,
            $this->tagihan_buku_lks,
            $this->tagihan_kitab,
            $this->tagihan_seragam,
            $this->tagihan_infaq_madrasah,
            $this->tagihan_infaq_kalender,
            $this->tagihan_outing_class,
            $this->tagihan_lainlain
        ])->sum();
    }

    public function getSisaTagihanAttribute()
    {
        return $this->getTotalTagihanAttribute() - $this->getTotalAttribute();
    }
}
