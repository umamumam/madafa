<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'nisn',
        'nis',
        'idguru',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi ke siswa berdasarkan nisn
    public function siswaByNISN()
    {
        return $this->belongsTo(Siswa::class, 'nisn', 'nisn');
    }

    // Relasi ke siswa berdasarkan nis
    public function siswaByNIS()
    {
        return $this->belongsTo(Siswa::class, 'nis', 'nis');
    }

    // Relasi ke guru berdasarkan idguru
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'idguru', 'idguru');
    }
    public function siswa()
    {
        return $this->hasOne(Siswa::class);
    }
}
