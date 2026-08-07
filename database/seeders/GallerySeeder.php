<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        Gallery::truncate();

        $images = [
            [
                'image_path' => 'assets/images/siapindo/disiplin-street.png',
                'alt_text' => 'Skateboard Street Competition'
            ],
            [
                'image_path' => 'assets/images/siapindo/disiplin-park.png',
                'alt_text' => 'Skateboard Park Action'
            ],
            [
                'image_path' => 'assets/images/siapindo/disiplin-speed.png',
                'alt_text' => 'Inline Speed Skating'
            ],
            [
                'image_path' => 'assets/images/siapindo/disiplin-artistic.png',
                'alt_text' => 'Artistic Roller Skating'
            ],
            [
                'image_path' => 'assets/images/siapindo/disiplin-hockey.png',
                'alt_text' => 'Roller Hockey Match'
            ],
            [
                'image_path' => 'assets/images/siapindo/disiplin-downhill.png',
                'alt_text' => 'Downhill Inline Skating'
            ],
            [
                'image_path' => 'assets/images/siapindo/disiplin-scooter-street.png',
                'alt_text' => 'Freestyle Scooter Street'
            ],
            [
                'image_path' => 'assets/images/siapindo/disiplin-scooter-park.png',
                'alt_text' => 'Freestyle Scooter Park'
            ],
            [
                'image_path' => 'assets/images/siapindo/cabor-skateboard.png',
                'alt_text' => 'Tim Skateboard Nasional'
            ],
            [
                'image_path' => 'assets/images/siapindo/cabor-sepaturoda.png',
                'alt_text' => 'Tim Sepatu Roda Nasional'
            ],
            [
                'image_path' => 'assets/images/siapindo/cabor-scooter.png',
                'alt_text' => 'Tim Scooter Nasional'
            ],
            [
                'image_path' => 'assets/images/siapindo/hero-pbporserosi.webp',
                'alt_text' => 'Event PB PORSEROSI'
            ]
        ];

        foreach ($images as $img) {
            Gallery::create($img);
        }
    }
}
