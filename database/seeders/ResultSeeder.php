<?php

namespace Database\Seeders;

use App\Models\ResultFolder;
use App\Models\ResultFile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create a dummy file in storage
        Storage::put('public/results/dummy.pdf', 'DUMMY PDF CONTENT FOR RESULT');

        // 2. Define the 7 main disciplines
        $disciplines = [
            ['name' => 'Speed Skating', 'name_en' => 'Speed Skating', 'slug' => 'speed', 'order' => 1],
            ['name' => 'Inline Freestyle', 'name_en' => 'Inline Freestyle', 'slug' => 'inline-freestyle', 'order' => 2],
            ['name' => 'Artistic Skating', 'name_en' => 'Artistic Skating', 'slug' => 'artistic', 'order' => 3],
            ['name' => 'Inline Hockey', 'name_en' => 'Inline Hockey', 'slug' => 'inline-hockey', 'order' => 4],
            ['name' => 'Roller Freestyle', 'name_en' => 'Roller Freestyle', 'slug' => 'roller-freestyle', 'order' => 5],
            ['name' => 'Skateboard', 'name_en' => 'Skateboard', 'slug' => 'skateboard', 'order' => 6],
            ['name' => 'Scooter', 'name_en' => 'Scooter', 'slug' => 'scooter', 'order' => 7],
        ];

        $rootFolders = [];
        foreach ($disciplines as $disc) {
            $rootFolders[$disc['slug']] = ResultFolder::create([
                'parent_id' => null,
                'name' => $disc['name'],
                'name_en' => $disc['name_en'],
                'slug' => $disc['slug'],
                'order' => $disc['order'],
            ]);
        }

        // 3. Sub-folders for Speed Skating (inline-speed)
        $speed = $rootFolders['speed'];
        
        $kejurnasSpeed = ResultFolder::create([
            'parent_id' => $speed->id,
            'name' => 'Kejurnas 2025',
            'name_en' => 'National Championship 2025',
            'order' => 1,
        ]);

        $pialaPresidenSpeed = ResultFolder::create([
            'parent_id' => $speed->id,
            'name' => 'Piala Presiden 2026',
            'name_en' => 'President Cup 2026',
            'order' => 2,
        ]);

        // Sub-sub-folders under Kejurnas 2025
        $kuSenior = ResultFolder::create([
            'parent_id' => $kejurnasSpeed->id,
            'name' => 'Kategori Umur A (Senior)',
            'name_en' => 'Age Category A (Senior)',
            'order' => 1,
        ]);

        $kuJunior = ResultFolder::create([
            'parent_id' => $kejurnasSpeed->id,
            'name' => 'Kategori Umur B (Junior)',
            'name_en' => 'Age Category B (Junior)',
            'order' => 2,
        ]);

        // Seed files for Senior
        ResultFile::create([
            'result_folder_id' => $kuSenior->id,
            'title' => 'Hasil Final 1000m Senior Putra',
            'title_en' => 'Final Results 1000m Senior Men',
            'file_path' => 'results/dummy.pdf',
            'order' => 1,
        ]);

        ResultFile::create([
            'result_folder_id' => $kuSenior->id,
            'title' => 'Hasil Final 1000m Senior Putri',
            'title_en' => 'Final Results 1000m Senior Women',
            'file_path' => 'results/dummy.pdf',
            'order' => 2,
        ]);

        // Seed files for Junior
        ResultFile::create([
            'result_folder_id' => $kuJunior->id,
            'title' => 'Hasil Final 500m Junior Putra & Putri',
            'title_en' => 'Final Results 500m Junior Men & Women',
            'file_path' => 'results/dummy.pdf',
            'order' => 1,
        ]);

        // Seed file in Piala Presiden
        ResultFile::create([
            'result_folder_id' => $pialaPresidenSpeed->id,
            'title' => 'Rekapitulasi Medali Keseluruhan',
            'title_en' => 'Overall Medal Standings',
            'file_path' => 'results/dummy.pdf',
            'order' => 1,
        ]);

        // 4. Sub-folders for Inline Freestyle
        $freestyle = $rootFolders['inline-freestyle'];
        
        $praPonFreestyle = ResultFolder::create([
            'parent_id' => $freestyle->id,
            'name' => 'Pra-PON 2025',
            'name_en' => 'Pre-PON 2025',
            'order' => 1,
        ]);

        $classicSlalom = ResultFolder::create([
            'parent_id' => $praPonFreestyle->id,
            'name' => 'Classic Slalom',
            'name_en' => 'Classic Slalom',
            'order' => 1,
        ]);

        $speedSlalom = ResultFolder::create([
            'parent_id' => $praPonFreestyle->id,
            'name' => 'Speed Slalom',
            'name_en' => 'Speed Slalom',
            'order' => 2,
        ]);

        ResultFile::create([
            'result_folder_id' => $classicSlalom->id,
            'title' => 'Hasil Kualifikasi Classic Slalom',
            'title_en' => 'Qualification Results Classic Slalom',
            'file_path' => 'results/dummy.pdf',
            'order' => 1,
        ]);

        ResultFile::create([
            'result_folder_id' => $speedSlalom->id,
            'title' => 'Hasil Final Kategori Speed Slalom',
            'title_en' => 'Final Results Speed Slalom Category',
            'file_path' => 'results/dummy.pdf',
            'order' => 1,
        ]);

        // 5. Sub-folders for Inline Hockey
        $hockey = $rootFolders['inline-hockey'];
        
        $ligaNasionalHockey = ResultFolder::create([
            'parent_id' => $hockey->id,
            'name' => 'Liga Nasional Hockey 2025',
            'name_en' => 'National Hockey League 2025',
            'order' => 1,
        ]);

        ResultFile::create([
            'result_folder_id' => $ligaNasionalHockey->id,
            'title' => 'Jadwal & Hasil Klasemen Grup A',
            'title_en' => 'Schedule & Standings Group A',
            'file_path' => 'results/dummy.pdf',
            'order' => 1,
        ]);
    }
}
