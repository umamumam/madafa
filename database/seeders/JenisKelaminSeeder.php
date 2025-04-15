<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JenisKelaminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('jenis_kelamins')->insert([
            [
                'jeniskelamin' => 'Laki-laki',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jeniskelamin' => 'Perempuan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
