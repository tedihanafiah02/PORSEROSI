<?php

namespace Database\Seeders;

use App\Models\Officer;
use Illuminate\Database\Seeder;

class OfficerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $officers = [
            [
                'name' => 'Komjen. Pol. (Purn.) Drs. Budi Waseso',
                'position' => 'Ketua Umum',
                'position_en' => 'General Chairman',
                'photo_path' => null,
                'order' => 1,
            ],
            [
                'name' => 'Drs. Sutrisno, M.Si.',
                'position' => 'Ketua Harian',
                'position_en' => 'Executive Chairman',
                'photo_path' => null,
                'order' => 2,
            ],
            [
                'name' => 'Dr. Velix Vernando Wanggai, S.I.P., M.P.A.',
                'position' => 'Sekretaris Jenderal',
                'position_en' => 'Secretary General',
                'photo_path' => null,
                'order' => 3,
            ],
            [
                'name' => 'H. Zulkarnaen, S.E., M.M.',
                'position' => 'Bendahara Umum',
                'position_en' => 'General Treasurer',
                'photo_path' => null,
                'order' => 4,
            ],
            [
                'name' => 'Ir. Mulyadi, M.T.',
                'position' => 'Ketua Bidang Organisasi',
                'position_en' => 'Head of Organization Division',
                'photo_path' => null,
                'order' => 5,
            ],
            [
                'name' => 'Jefri, S.Pd., M.Or.',
                'position' => 'Ketua Bidang Pembinaan Prestasi',
                'position_en' => 'Head of Achievement Development Division',
                'photo_path' => null,
                'order' => 6,
            ],
            [
                'name' => 'Hendrik, S.E.',
                'position' => 'Ketua Bidang Perwasitan',
                'position_en' => 'Head of Refereeing Division',
                'photo_path' => null,
                'order' => 7,
            ],
            [
                'name' => 'Imam Fauzi, S.I.Kom.',
                'position' => 'Ketua Bidang Hubungan Masyarakat',
                'position_en' => 'Head of Public Relations Division',
                'photo_path' => null,
                'order' => 8,
            ],
        ];

        foreach ($officers as $officer) {
            Officer::create($officer);
        }
    }
}
