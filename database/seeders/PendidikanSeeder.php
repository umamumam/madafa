<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PendidikanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['pendidikan' => 'SD/MI', 'created_at' => now(), 'updated_at' => now()],
            ['pendidikan' => 'SMP/MTS', 'created_at' => now(), 'updated_at' => now()],
            ['pendidikan' => 'SMA/MA', 'created_at' => now(), 'updated_at' => now()],
            ['pendidikan' => 'D3', 'created_at' => now(), 'updated_at' => now()],
            ['pendidikan' => 'S1', 'created_at' => now(), 'updated_at' => now()],
            ['pendidikan' => 'S2', 'created_at' => now(), 'updated_at' => now()],
            ['pendidikan' => 'S3', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('pendidikans')->insert($data);
    }
}
