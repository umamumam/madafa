<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\StatusGuru;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            JenisKelaminSeeder::class,
            ProgramSeeder::class,
            PendidikanSeeder::class,
            StatusGuruSeeder::class,
            KetSeeder::class,
            NilaiSeeder::class,
            KompetensiSeeder::class,
            MapelSeeder::class
        ]);
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'super admin',
            'nisn' => null,
            'nis' => null,
            'idguru' => null,
        ]);
    }
}
