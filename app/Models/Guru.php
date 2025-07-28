<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'gurus';

    protected $fillable = [
        'idguru',
        'niy_nip',
        'npk_nuptk_pegid',
        'nama_guru',
        'foto',
        'nik',
        'tempat_lahir',
        'tgl_lahir',
        'jeniskelamin_id',
        'pendidikan_terakhir_id',
        'inst_pend_terakhir',
        'alamat',
        'no_hp',
        'tmt_sk_awal',
        'status_guru_id',
        'masa_kerja',
        'mapel_1_id',
        'mapel_2_id',
        'mapel_3_id',
        'jabatan_1_id',
        'jabatan_2_id',
        'jabatan_3_id'
    ];

    protected static function booted()
    {
        static::created(function ($guru) {
            // Cek apakah idguru belum digunakan di users
            if (!\App\Models\User::where('idguru', $guru->idguru)->exists()) {
                \App\Models\User::create([
                    'name' => $guru->nama_guru,
                    'email' => strtolower(str_replace(' ', '', $guru->nama_guru)) . '@gmail.com',
                    'password' => bcrypt('password'),
                    'idguru' => $guru->idguru,
                    'role' => 'guru',
                ]);
            }
        });
    }


    // Defining relationships
    public function jenisKelamin()
    {
        return $this->belongsTo(JenisKelamin::class, 'jeniskelamin_id');
    }

    public function pendidikanTerakhir()
    {
        return $this->belongsTo(Pendidikan::class, 'pendidikan_terakhir_id');
    }

    public function statusGuru()
    {
        return $this->belongsTo(StatusGuru::class, 'status_guru_id');
    }

    public function mapel1()
    {
        return $this->belongsTo(Mapel::class, 'mapel_1_id');
    }

    public function mapel2()
    {
        return $this->belongsTo(Mapel::class, 'mapel_2_id');
    }

    public function mapel3()
    {
        return $this->belongsTo(Mapel::class, 'mapel_3_id');
    }

    public function jabatan1()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_1_id');
    }

    public function jabatan2()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_2_id');
    }

    public function jabatan3()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_3_id');
    }
    public function penyemaks()
    {
        return $this->hasMany(Penyemak::class, 'guru_id');
    }
    public function users()
    {
        return $this->hasMany(User::class, 'idguru', 'idguru');
    }
    public function kelasWali()
    {
        return $this->hasOne(Kelas::class, 'walikelas_id');
    }
    public function raporWalikelas()
    {
        return $this->hasMany(RaporLokal::class, 'walikelas_id');
    }

    public function raporKepalaMadrasah()
    {
        return $this->hasMany(RaporLokal::class, 'kepala_madrasah_id');
    }
    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class);
    }
    public function tabungans()
    {
        return $this->hasMany(Tabungan::class);
    }
}
