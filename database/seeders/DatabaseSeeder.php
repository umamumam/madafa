<?php

namespace Database\Seeders;

use App\Models\StatusGuru;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
