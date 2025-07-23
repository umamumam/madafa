<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayarans';

    protected $fillable = [
        'siswa_id',
        'guru_id',
        'jenis_pembayaran',
        'nominal_spp',
        'nominal_dana_abadi',
        'nominal_bop_smt1',
        'nominal_bop_smt2',
        'nominal_buku_lks',
        'nominal_kitab',
        'nominal_seragam',
        'nominal_infaq_madrasah',
        'nominal_infaq_kelender',
        'nominal_lainlain',
        'tgl_bayar',
        'status',
        'keterangan'
    ];

    protected $casts = [
        'tgl_bayar' => 'date',
    ];
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    // Hitung total pembayaran
    public function getTotalAttribute()
    {
        return ($this->nominal_spp ?? 0) +
            ($this->nominal_dana_abadi ?? 0) +
            ($this->nominal_bop_smt1 ?? 0) +
            ($this->nominal_bop_smt2 ?? 0) +
            ($this->nominal_buku_lks ?? 0) +
            ($this->nominal_kitab ?? 0) +
            ($this->nominal_seragam ?? 0) +
            ($this->nominal_infaq_madrasah ?? 0) +
            ($this->nominal_infaq_kelender ?? 0) +
            ($this->nominal_lainlain ?? 0);
    }
}
