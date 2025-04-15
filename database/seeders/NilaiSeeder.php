<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NilaiSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['min' => 91, 'max' => 100, 'abjad' => 'A', 'keterangan' => 'Baik Sekali', 'created_at' => now(), 'updated_at' => now()],
            ['min' => 81, 'max' => 90,  'abjad' => 'B', 'keterangan' => 'Baik',         'created_at' => now(), 'updated_at' => now()],
            ['min' => 70, 'max' => 80,  'abjad' => 'C', 'keterangan' => 'Cukup',        'created_at' => now(), 'updated_at' => now()],
            ['min' => 0,  'max' => 69,  'abjad' => 'D', 'keterangan' => 'Kurang',       'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('nilais')->insert($data);
    }
}
