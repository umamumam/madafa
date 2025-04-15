<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatusGuruSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['status' => 'Sertifikasi', 'created_at' => now(), 'updated_at' => now()],
            ['status' => '-', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('status_gurus')->insert($data);
    }
}
