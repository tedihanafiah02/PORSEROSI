<?php

namespace Database\Seeders;
use App\Models\Partner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */ public function run()
    {
        Partner::create([
            'name' => 'Arsip Nasional',
            'logo_path' => 'partners/arsip-nasional.jpg', // Sesuaikan dengan path yang benar
            'alt_text' => 'Arsip Nasional Logo',
        ]);

        // Tambahkan data partner lainnya di sini
    }
}