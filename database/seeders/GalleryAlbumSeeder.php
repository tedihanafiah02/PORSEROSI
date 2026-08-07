<?php

namespace Database\Seeders;

use App\Models\Gallery;
use App\Models\GalleryAlbum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GalleryAlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Safe truncate with foreign key constraints disabled
        \Schema::disableForeignKeyConstraints();
        Gallery::truncate();
        GalleryAlbum::truncate();
        \Schema::enableForeignKeyConstraints();

        $albums = [
            [
                'name' => 'Umum',
                'description' => 'Dokumentasi foto kegiatan umum dan arsip PB PORSEROSI.',
                'description_en' => 'General activities photo documentation and archives of PB PORSEROSI.',
                'cover_image' => 'assets/images/siapindo/cabor-sepaturoda.png',
                'dummy_images' => [
                    'assets/images/siapindo/cabor-sepaturoda.png',
                    'assets/images/siapindo/cabor-sepaturoda.png',
                    'assets/images/siapindo/cabor-sepaturoda.png',
                ]
            ],
            [
                'name' => 'Artistik',
                'description' => 'Dokumentasi foto kegiatan nomor indah Artistic Skating.',
                'description_en' => 'Photo documentation and activities of Artistic Skating categories.',
                'cover_image' => 'assets/images/siapindo/cabor-sepaturoda.png',
                'dummy_images' => [
                    'assets/images/siapindo/cabor-sepaturoda.png',
                    'assets/images/siapindo/cabor-sepaturoda.png',
                    'assets/images/siapindo/cabor-sepaturoda.png',
                ]
            ],
            [
                'name' => 'Inline Freestyle',
                'description' => 'Dokumentasi foto kegiatan nomor lomba Inline Freestyle.',
                'description_en' => 'Photo documentation and activities of Inline Freestyle competition categories.',
                'cover_image' => 'assets/images/siapindo/cabor-sepaturoda.png',
                'dummy_images' => [
                    'assets/images/siapindo/cabor-sepaturoda.png',
                    'assets/images/siapindo/cabor-sepaturoda.png',
                    'assets/images/siapindo/cabor-sepaturoda.png',
                ]
            ],
            [
                'name' => 'Inline Hockey',
                'description' => 'Dokumentasi foto kegiatan nomor hoki sepatu roda (Inline Hockey).',
                'description_en' => 'Photo documentation and activities of Inline Hockey matches and competitions.',
                'cover_image' => 'assets/images/siapindo/cabor-sepaturoda.png',
                'dummy_images' => [
                    'assets/images/siapindo/cabor-sepaturoda.png',
                    'assets/images/siapindo/cabor-sepaturoda.png',
                    'assets/images/siapindo/cabor-sepaturoda.png',
                ]
            ],
            [
                'name' => 'Roller Freestyle',
                'description' => 'Dokumentasi foto kegiatan nomor ekstrem Roller Freestyle.',
                'description_en' => 'Photo documentation and activities of extreme Roller Freestyle categories.',
                'cover_image' => 'assets/images/siapindo/cabor-sepaturoda.png',
                'dummy_images' => [
                    'assets/images/siapindo/cabor-sepaturoda.png',
                    'assets/images/siapindo/cabor-sepaturoda.png',
                    'assets/images/siapindo/cabor-sepaturoda.png',
                ]
            ],
            [
                'name' => 'Scooter',
                'description' => 'Dokumentasi foto kegiatan nomor Scooter Freestyle.',
                'description_en' => 'Photo documentation and activities of Scooter Freestyle competitions.',
                'cover_image' => 'assets/images/siapindo/cabor-scooter.png',
                'dummy_images' => [
                    'assets/images/siapindo/cabor-scooter.png',
                    'assets/images/siapindo/cabor-scooter.png',
                    'assets/images/siapindo/cabor-scooter.png',
                ]
            ],
            [
                'name' => 'Skateboard',
                'description' => 'Dokumentasi foto kegiatan nomor kompetisi papan luncur Skateboard.',
                'description_en' => 'Photo documentation and activities of Skateboard competition events.',
                'cover_image' => 'assets/images/siapindo/cabor-skateboard.png',
                'dummy_images' => [
                    'assets/images/siapindo/cabor-skateboard.png',
                    'assets/images/siapindo/cabor-skateboard.png',
                    'assets/images/siapindo/cabor-skateboard.png',
                ]
            ],
            [
                'name' => 'Speed',
                'description' => 'Dokumentasi foto kegiatan kompetisi balap sepatu roda Speed.',
                'description_en' => 'Photo documentation and activities of Speed inline skating races.',
                'cover_image' => 'assets/images/siapindo/cabor-sepaturoda.png',
                'dummy_images' => [
                    'assets/images/siapindo/cabor-sepaturoda.png',
                    'assets/images/siapindo/cabor-sepaturoda.png',
                    'assets/images/siapindo/cabor-sepaturoda.png',
                ]
            ],
        ];

        foreach ($albums as $album) {
            $createdAlbum = GalleryAlbum::create([
                'name' => $album['name'],
                'slug' => Str::slug($album['name']),
                'description' => $album['description'],
                'description_en' => $album['description_en'],
                'cover_image' => $album['cover_image'],
            ]);

            // Create 3 dummy images for this album
            foreach ($album['dummy_images'] as $index => $img_path) {
                Gallery::create([
                    'gallery_album_id' => $createdAlbum->id,
                    'image_path'       => $img_path,
                    'alt_text'         => 'Dokumentasi ' . $album['name'] . ' ' . ($index + 1),
                    'alt_text_en'      => 'Documentation for ' . $album['name'] . ' ' . ($index + 1),
                ]);
            }
        }
    }
}
