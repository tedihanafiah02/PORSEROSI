<?php

namespace Database\Seeders;

use App\Models\RegulationFolder;
use App\Models\Regulation;
use Illuminate\Database\Seeder;

class RegulationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Seed Folders
        $folders = [
            [
                'id' => 1,
                'name' => 'AD / ART',
                'name_en' => 'Constitution / Bylaws',
                'order' => 1,
            ],
            [
                'id' => 2,
                'name' => 'Peraturan Organisasi',
                'name_en' => 'Organizational Regulations',
                'order' => 2,
            ],
            [
                'id' => 3,
                'name' => 'Peraturan Perlombaan',
                'name_en' => 'Competition Rules',
                'order' => 3,
            ],
            [
                'id' => 4,
                'name' => 'Peraturan Disiplin',
                'name_en' => 'Disciplinary Regulations',
                'order' => 4,
            ],
        ];

        foreach ($folders as $folder) {
            RegulationFolder::create($folder);
        }

        // 2. Seed Regulations
        $regulations = [
            // Inside AD / ART
            [
                'title' => 'Anggaran Dasar PB PORSEROSI 2026',
                'title_en' => 'PB PORSEROSI Constitution 2026',
                'file_path' => 'regulations/dummy.pdf',
                'regulation_folder_id' => 1,
                'order' => 1,
            ],
            [
                'title' => 'Anggaran Rumah Tangga PB PORSEROSI 2026',
                'title_en' => 'PB PORSEROSI Bylaws 2026',
                'file_path' => 'regulations/dummy.pdf',
                'regulation_folder_id' => 1,
                'order' => 2,
            ],
            // Inside Peraturan Organisasi
            [
                'title' => 'PO No. 01 Tentang Keanggotaan Pengprov',
                'title_en' => 'OR No. 01 Concerning Regional Membership',
                'file_path' => 'regulations/dummy.pdf',
                'regulation_folder_id' => 2,
                'order' => 1,
            ],
            [
                'title' => 'PO No. 02 Tentang Penyelenggaraan Kejuaraan Nasional',
                'title_en' => 'OR No. 02 Concerning National Championship Management',
                'file_path' => 'regulations/dummy.pdf',
                'regulation_folder_id' => 2,
                'order' => 2,
            ],
            // Inside Peraturan Perlombaan
            [
                'title' => 'Aturan Lomba Sepatu Roda Kecepatan (Speed) 2026',
                'title_en' => 'Speed Roller Skating Competition Rules 2026',
                'file_path' => 'regulations/dummy.pdf',
                'regulation_folder_id' => 3,
                'order' => 1,
            ],
            [
                'title' => 'Aturan Lomba Skateboard Street & Park 2026',
                'title_en' => 'Skateboard Street & Park Competition Rules 2026',
                'file_path' => 'regulations/dummy.pdf',
                'regulation_folder_id' => 3,
                'order' => 2,
            ],
            // Inside Peraturan Disiplin
            [
                'title' => 'Kode Etik dan Disiplin Atlet PB PORSEROSI',
                'title_en' => 'PB PORSEROSI Athlete Code of Conduct and Discipline',
                'file_path' => 'regulations/dummy.pdf',
                'regulation_folder_id' => 4,
                'order' => 1,
            ],
            // Root Level (No Folder)
            [
                'title' => 'Undang-Undang Sistem Keolahragaan Nasional No. 11 Tahun 2022',
                'title_en' => 'National Sports System Law No. 11 of 2022',
                'file_path' => 'regulations/dummy.pdf',
                'regulation_folder_id' => null,
                'order' => 1,
            ],
        ];

        foreach ($regulations as $regulation) {
            Regulation::create($regulation);
        }
    }
}
