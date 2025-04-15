<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KetSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['ket' => 'Naik ke kelas 11', 'created_at' => now(), 'updated_at' => now()],
            ['ket' => 'Naik ke kelas 12', 'created_at' => now(), 'updated_at' => now()],
            ['ket' => 'Tamat', 'created_at' => now(), 'updated_at' => now()],
            ['ket' => 'Tidak Naik', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('kets')->insert($data);
    }
}
