<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KompetensiSeeder extends Seeder
{
    public function run(): void
    {
        $kompetensi = [
            "Menghafal ayat-ayat keimanan, ketakwaan",
            "Menghafal & menulis ayat kursi",
            "Menghafal Sholawat Nariyah",
            "Menghafal Sholawat Munjiyat",
            "Menghafal wirid & doa setelah sholat",
            "Membaca al-berzanji",
            "Mengaji sampai Juz ke-20",
            "Menyusun naskah pidato/ceramah agama",
            "Melaksanakan tata cara Sholat Jamak Qosor",
            "Melaksanakan tata cara sholat hajat & do'anya",
            "Menghafal Faroidul Bahiyyah 100 bet",
            "Menghafal & menulis ayat-ayat Sholat & puasa",
            "Menghafal & menulis surah Al-A'la & Al-Ghosiyah",
            "Menghafal tahlil & doanya",
            "Menyusun makalah tema keagamaan",
            "Melaksanakan tata cara sholat tahajjud & doanya",
            "Menyusun Karya Tulis",
            "Mengaji sampai Juz ke-25",
            "Menjadi bilal sholat tarawih, witir & doanya",
            "Menghafal asmaul husna",
            "Praktik tata cara pemulasaran jenazah",
            "Menghafal Faroidul Bahiyyah",
            "Menghafal ayat & hadis pendidikan",
            "Menyusun naskah khutbah (Pa) & MC (Pi)",
            "Mengaji sampai juz ke-30",
            "Melaksanakan tugas Amil Zakat",
            "Tampil menjadi, MC, tahlil & ceramah (Pi)",
            "Tampil menjadi bilal atau khatib (Pa)",
            "Tampil Mengajar mapel di MI",
            "Tartil Al-Qur'an 30 Juz",
            "Baca Kitab ( Matan Tahrir atau Matan Taqrib )"
        ];

        foreach ($kompetensi as $index => $nama) {
            DB::table('kompetensis')->insert([
                'urutan' => $index + 1,
                'nama_kompetensi' => $nama,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
