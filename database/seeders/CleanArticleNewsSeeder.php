<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ArticleNews;
use App\Models\Category;
use App\Models\Author;
use Illuminate\Support\Str;

class CleanArticleNewsSeeder extends Seeder
{
    public function run()
    {
        // 1. Hapus semua data berita lama secara aman
        ArticleNews::query()->forceDelete();

        // 2. Dapatkan atau buat Author default
        $author = Author::first() ?? Author::create([
            'name' => 'Tedi Hanafiah',
            'occupation' => 'Admin PB PORSEROSI',
            'occupation_en' => 'PB PORSEROSI Admin',
            'avatar' => 'assets/images/porserosi/pb1.webp'
        ]);

        // 3. Dapatkan atau buat Kategori untuk 3 cabor
        $cSkateboard = Category::where('slug', 'skateboard')->first();
        if (!$cSkateboard) {
            $cSkateboard = Category::create([
                'name' => 'Skateboard',
                'name_en' => 'Skateboard',
            ]);
        }

        $cScooter = Category::where('slug', 'scooter')->first();
        if (!$cScooter) {
            $cScooter = Category::create([
                'name' => 'Scooter',
                'name_en' => 'Scooter',
            ]);
        }

        $cSepatuRoda = Category::where('slug', 'sepatu-roda')->first() ?? Category::where('slug', 'sepatu-roda-1')->first();
        if (!$cSepatuRoda) {
            $cSepatuRoda = Category::create([
                'name' => 'Sepatu Roda',
                'name_en' => 'Roller Skate',
            ]);
        }

        // 4. Siapkan data 6 artikel (2 per cabor, 2 diantaranya featured)
        $articles = [
            // SKATEBOARD
            [
                'name' => 'Perkembangan Cabor Skateboard Indonesia Menuju Olimpiade 2028',
                'title_en' => 'Development of Indonesian Skateboarding Towards the 2028 Olympics',
                'thumbnail' => 'assets/images/porserosi/pb5.webp',
                'content' => 'PB PORSEROSI terus berkomitmen mengembangkan bakat atlet muda skateboard Indonesia. Dengan penyediaan fasilitas skatepark berstandar internasional dan kompetisi berkala, kami optimis atlet Indonesia mampu bersaing dan meraih medali emas pada ajang Olimpiade Los Angeles 2028 mendatang.',
                'content_en' => 'PB PORSEROSI remains committed to developing the talents of young Indonesian skateboarders. By providing international standard skateparks and regular competitions, we are highly optimistic that Indonesian athletes will compete and secure gold medals at the upcoming Los Angeles 2028 Olympics.',
                'category_id' => $cSkateboard->id,
                'author_id' => $author->id,
                'is_featured' => 'featured',
            ],
            [
                'name' => 'Kejuaraan Nasional Skateboard 2026 Sukses Lahirkan Talenta Baru',
                'title_en' => 'National Skateboarding Championship 2026 Successfully Unveils New Talents',
                'thumbnail' => 'assets/images/porserosi/pb6.webp',
                'content' => 'Kejuaraan Nasional Skateboard yang digelar oleh PB PORSEROSI tahun ini sukses menarik ratusan peserta dari berbagai provinsi. Event ini menjadi wadah seleksi nasional untuk menjaring atlet-atlet potensial yang akan dibina dalam pemusatan latihan nasional (Pelatnas).',
                'content_en' => "The National Skateboarding Championship organized by PB PORSEROSI this year successfully attracted hundreds of participants from various provinces. This event serves as a national selection platform to scout potential athletes for the national training camp (Pelatnas).",
                'category_id' => $cSkateboard->id,
                'author_id' => $author->id,
                'is_featured' => 'not_featured',
            ],

            // SCOOTER
            [
                'name' => 'Ekspansi Disiplin Freestyle Scooter: PB PORSEROSI Siapkan Atlet Internasional',
                'title_en' => 'Expansion of Freestyle Scooter Discipline: PB PORSEROSI Prepares International Athletes',
                'thumbnail' => 'assets/images/porserosi/pb12.webp',
                'content' => 'Sebagai salah satu cabang olahraga ekstrem yang berkembang sangat pesat, disiplin Freestyle Scooter kini mendapatkan perhatian khusus dari PB PORSEROSI. Kami sedang menyiapkan kurikulum pelatihan terstandarisasi dan mengirimkan delegasi atlet untuk bertanding di seri kejuaraan dunia tahun ini.',
                'content_en' => 'As one of the fastest-growing extreme sports, the Freestyle Scooter discipline is now receiving special attention from PB PORSEROSI. We are preparing a standardized training curriculum and sending athlete delegations to compete in this year\'s world championship series.',
                'category_id' => $cScooter->id,
                'author_id' => $author->id,
                'is_featured' => 'featured',
            ],
            [
                'name' => 'Kompetisi Scooter Park & Street Nasional Menarik Minat Rider Muda',
                'title_en' => 'National Scooter Park & Street Competition Attracts Young Riders',
                'thumbnail' => 'assets/images/porserosi/pb15.webp',
                'content' => 'PB PORSEROSI sukses menyelenggarakan kompetisi Scooter berskala nasional untuk kategori Park dan Street. Kejuaraan ini diikuti oleh para rider muda berbakat yang menunjukkan trik-trik spektakuler, membuktikan bahwa regenerasi atlet scooter di Indonesia berjalan dengan sangat baik.',
                'content_en' => 'PB PORSEROSI successfully organized a national-scale Scooter competition for the Park and Street categories. The championship was attended by talented young riders who demonstrated spectacular tricks, proving that the regeneration of scooter athletes in Indonesia is progressing exceptionally well.',
                'category_id' => $cScooter->id,
                'author_id' => $author->id,
                'is_featured' => 'not_featured',
            ],

            // SEPATU RODA
            [
                'name' => 'Dominasi Tim Sepatu Roda Indonesia di Kancah Kejuaraan Asia',
                'title_en' => 'Dominance of Indonesian Roller Skate Team in the Asian Championship Arena',
                'thumbnail' => 'assets/images/porserosi/pb22.webp',
                'content' => 'Tim nasional sepatu roda Indonesia kembali menunjukkan dominasinya dengan memborong medali emas pada Kejuaraan Roller Sports Asia. Keberhasilan ini merupakan buah dari pembinaan jangka panjang dan latihan disiplin yang difasilitasi oleh PB PORSEROSI.',
                'content_en' => 'The Indonesian national roller skating team once again demonstrated its dominance by sweeping gold medals at the Asian Roller Sports Championship. This success is the result of long-term development and disciplined training facilitated by PB PORSEROSI.',
                'category_id' => $cSepatuRoda->id,
                'author_id' => $author->id,
                'is_featured' => 'not_featured',
            ],
            [
                'name' => 'PB PORSEROSI Gelar Pemusatan Latihan Nasional Sepatu Roda Speed',
                'title_en' => 'PB PORSEROSI Conducts National Speed Roller Skating Training Camp',
                'thumbnail' => 'assets/images/porserosi/pb10.webp',
                'content' => 'Pemusatan Latihan Nasional (Pelatnas) untuk disiplin Sepatu Roda Speed resmi dibuka hari ini oleh jajaran pengurus PB PORSEROSI. Program intensif ini memfokuskan pada peningkatan ketahanan fisik, teknik berbelok cepat, serta strategi taktis untuk menghadapi kompetisi internasional mendatang.',
                'content_en' => 'The National Training Camp (Pelatnas) for the Speed Roller Skating discipline was officially opened today by the board of PB PORSEROSI. This intensive program focuses on enhancing physical endurance, fast-cornering techniques, and tactical strategies to face upcoming international competitions.',
                'category_id' => $cSepatuRoda->id,
                'author_id' => $author->id,
                'is_featured' => 'not_featured',
            ],
        ];

        // 5. Simpan artikel ke database
        foreach ($articles as $data) {
            ArticleNews::create($data);
        }
    }
}
