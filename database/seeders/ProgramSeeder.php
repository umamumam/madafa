<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('programs')->insert([
            [
                'program' => 'Keagamaan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'program' => 'MIPA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'program' => 'IPS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
