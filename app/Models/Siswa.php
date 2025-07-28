<?php

namespace App\Models;

use App\Models\Kdum;
use App\Models\RaporLokal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswas';

    protected $fillable = [
        'nis',
        'nisn',
        'nik_siswa',
        'nama_siswa',
        'foto',
        'jeniskelamin_id',
        'tempat_lahir',
        'tgl_lahir',
        'kelas_id',
        'program_id',
        'anak_ke',
        'no_kk',
        'nik_ayah',
        'nama_ayah',
        'pendidikan_ayah_id',
        'pekerjaan_ayah',
        'nik_ibu',
        'nama_ibu',
        'pendidikan_ibu_id',
        'pekerjaan_ibu',
        'hp_siswa',
        'hp_ortu',
        'alamat',
        'kode_pos',
        'asal_sekolah',
        'npsn',
        'nsm',
        'alamat_sekolah',
        'no_kip',
        'no_kks',
        'no_pkh'
    ];

    protected static function booted()
    {
        static::created(function ($siswa) {
            $tahunAktif = \App\Models\TahunPelajaran::where('active', true)->first();
            if ($tahunAktif) {
                \App\Models\RiwayatKelasSiswa::create([
                    'siswa_id' => $siswa->id,
                    'kelas_id' => $siswa->kelas_id,
                    'tahun_pelajaran_id' => $tahunAktif->id,
                    'semester' => 1,
                ]);

                \App\Models\Kdum::create([
                    'siswa_id' => $siswa->id,
                    'kelas_id' => $siswa->kelas_id,
                    'tahun_pelajaran_id' => $tahunAktif->id,
                ]);
            }

            if (!\App\Models\User::where('nisn', $siswa->nisn)->exists()) {
                \App\Models\User::create([
                    'name' => $siswa->nama_siswa,
                    'email' => strtolower(str_replace(' ', '', $siswa->nama_siswa)) . '@gmail.com',
                    'password' => bcrypt('password'), // default password
                    'nis' => $siswa->nis,
                    'nisn' => $siswa->nisn,
                    'role' => 'siswa',
                ]);
            }
        });
    }


    // Relasi
    public function jenisKelamin()
    {
        return $this->belongsTo(JenisKelamin::class, 'jeniskelamin_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function pendidikanAyah()
    {
        return $this->belongsTo(Pendidikan::class, 'pendidikan_ayah_id');
    }

    public function pendidikanIbu()
    {
        return $this->belongsTo(Pendidikan::class, 'pendidikan_ibu_id');
    }
    public function users()
    {
        return $this->hasMany(User::class, 'nisn', 'nisn');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function kdums()
    {
        return $this->hasMany(Kdum::class);
    }
    public function raporLokals()
    {
        return $this->hasMany(RaporLokal::class);
    }
    public function riwayatKelas()
    {
        return $this->hasMany(RiwayatKelasSiswa::class);
    }
    public function dokumen()
    {
        return $this->hasOne(DokumenSiswa::class);
    }

    public function createRaporLokal()
    {
        $tahunAktif = \App\Models\TahunPelajaran::where('active', true)->first();

        if ($tahunAktif) {
            RaporLokal::create([
                'siswa_id' => $this->id,
                'kelas_id' => $this->kelas_id,
                'tahun_pelajaran_id' => $tahunAktif->id,
            ]);
        }
    }
    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class);
    }
    public function tabungans()
    {
        return $this->hasMany(Tabungan::class);
    }
    public function getTotalTabunganSaldoAttribute()
    {
        return $this->tabungans()->sum('jumlah_setor');
    }
}
