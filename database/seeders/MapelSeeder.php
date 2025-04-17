<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MapelSeeder extends Seeder
{
    public function run()
    {
        $mapels = [
            ['mapel' => 'BTA / القرآن الكريم', 'kkm' => 65],
            ['mapel' => 'Tafsir / تفسير الجلا لين', 'kkm' => 70],
            ['mapel' => 'Hadits / بلوغ المرام', 'kkm' => 70],
            ['mapel' => 'Ahklak / تعليم المتعلم \\ كفاية الأتقياء', 'kkm' => 70],
            ['mapel' => 'Balagoh / الجوهرالمكنون', 'kkm' => 70],
            ['mapel' => 'Mantiq / ايضاح المبهم', 'kkm' => 70],
            ['mapel' => 'Qowaidul Fiqhiyah / الأشباه والنظا ئر', 'kkm' => 70],
            ['mapel' => 'Usul Fiqih / اللمع', 'kkm' => 70],
            ['mapel' => 'Fikih / تحفة الطلاب', 'kkm' => 70],
            ['mapel' => 'Tauhid / أم البراهين', 'kkm' => 70],
            ['mapel' => 'Faroid / الفرائد البهية', 'kkm' => 70],
        ];

        DB::table('mapels')->insert($mapels);
    }
}
