<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        // Nonaktifkan foreign key checks untuk pembersihan total
        Schema::disableForeignKeyConstraints();
        
        // Hapus semua data peserta dan event lama menggunakan DB query builder
        DB::table('event_participants')->truncate();
        Event::truncate();
        
        // Aktifkan kembali foreign key checks
        Schema::enableForeignKeyConstraints();

        $events = [
            // ==========================================
            // EVENT DENGAN PENDAFTARAN BUKA (3 EVENT)
            // ==========================================
            [
                'name' => 'Kejuaraan Nasional Skateboard Street 2026',
                'name_en' => 'National Skateboarding Championship Street 2026',
                'start_date' => '2026-05-22',
                'end_date' => '2026-05-24',
                'venue' => 'Skatepark GBK Senayan',
                'venue_en' => 'GBK Senayan Skatepark',
                'city' => 'Jakarta',
                'city_en' => 'Jakarta',
                'country' => 'Indonesia',
                'country_en' => 'Indonesia',
                'organizer' => 'PB PORSEROSI',
                'organizer_en' => 'PB PORSEROSI',
                'description' => 'Kejuaraan Nasional Skateboard kategori Street untuk tingkat Junior dan Pro se-Indonesia. Kumpulkan poin kualifikasi nasional.',
                'description_en' => 'National Skateboarding Championship Street category for Junior and Pro levels across Indonesia. Gather national qualification points.',
                'category' => 'kompetisi',
                'sport_type' => 'skateboard',
                'status' => 'upcoming',
                'is_registration_open' => true,
                'registration_url' => 'https://docs.google.com/forms/d/e/1FAIpQLSeuNtMt0tXGi56TrPQisr1QxpHEvNxd3SmLULv_GMLvAys-Og/viewform',
                'is_published' => true,
            ],
            [
                'name' => 'Seleksi Daerah Sepatu Roda Jabar',
                'name_en' => 'West Java Inline Speed Skating Selection',
                'start_date' => '2026-05-25',
                'end_date' => '2026-05-26',
                'venue' => 'Saparua Skatepark',
                'venue_en' => 'Saparua Skatepark',
                'city' => 'Bandung',
                'city_en' => 'Bandung',
                'country' => 'Indonesia',
                'country_en' => 'Indonesia',
                'organizer' => 'Pengprov PORSEROSI Jabar',
                'organizer_en' => 'West Java PORSEROSI Regional Association',
                'description' => 'Seleksi atlet sepatu roda Jawa Barat untuk persiapan Pekan Olahraga Nasional (PON). Terbuka untuk klub terdaftar di Jabar.',
                'description_en' => 'West Java inline speed skating athlete selection for National Sports Week (PON) preparation. Open for registered clubs in West Java.',
                'category' => 'seleksi',
                'sport_type' => 'inline_skate',
                'status' => 'upcoming',
                'is_registration_open' => true,
                'registration_url' => 'https://docs.google.com/forms/d/e/1FAIpQLSeuNtMt0tXGi56TrPQisr1QxpHEvNxd3SmLULv_GMLvAys-Og/viewform',
                'is_published' => true,
            ],
            [
                'name' => 'Scooter Freestyle Challenge Yogyakarta',
                'name_en' => 'Yogyakarta Freestyle Scooter Challenge',
                'start_date' => '2026-05-28',
                'end_date' => '2026-05-29',
                'venue' => 'Taman Pintar Skatepark',
                'venue_en' => 'Taman Pintar Skatepark',
                'city' => 'Yogyakarta',
                'city_en' => 'Yogyakarta',
                'country' => 'Indonesia',
                'country_en' => 'Indonesia',
                'organizer' => 'PB PORSEROSI',
                'organizer_en' => 'PB PORSEROSI',
                'description' => 'Kompetisi scooter freestyle paling bergengsi di Yogyakarta. Menampilkan kategori Best Line dan Best Trick.',
                'description_en' => 'The most prestigious freestyle scooter competition in Yogyakarta. Featuring Best Line and Best Trick categories.',
                'category' => 'kompetisi',
                'sport_type' => 'scooter',
                'status' => 'upcoming',
                'is_registration_open' => true,
                'registration_url' => 'https://docs.google.com/forms/d/e/1FAIpQLSeuNtMt0tXGi56TrPQisr1QxpHEvNxd3SmLULv_GMLvAys-Og/viewform',
                'is_published' => true,
            ],

            // ==========================================
            // EVENT DENGAN PENDAFTARAN TUTUP (5 EVENT)
            // ==========================================
            [
                'name' => 'Sertifikasi Pelatih Sepatu Roda Tingkat Nasional',
                'name_en' => 'National Inline Skate Coach Certification',
                'start_date' => '2026-05-20',
                'end_date' => '2026-05-21',
                'venue' => 'Hotel Grand Mercure',
                'venue_en' => 'Grand Mercure Hotel',
                'city' => 'Bandung',
                'city_en' => 'Bandung',
                'country' => 'Indonesia',
                'country_en' => 'Indonesia',
                'organizer' => 'PB PORSEROSI',
                'organizer_en' => 'PB PORSEROSI',
                'description' => 'Program sertifikasi resmi bagi pelatih sepatu roda tingkat nasional. Pendaftaran ditutup karena kuota peserta telah terpenuhi.',
                'description_en' => 'Official certification program for national inline skate coaches. Registration is closed because the participant quota is full.',
                'category' => 'pelatihan',
                'sport_type' => 'inline_skate',
                'status' => 'upcoming',
                'is_registration_open' => false,
                'is_published' => true,
            ],
            [
                'name' => 'Workshop Skateboard Park Setup',
                'name_en' => 'Skatepark Park Setup Workshop',
                'start_date' => '2026-05-27',
                'end_date' => '2026-05-27',
                'venue' => 'Hotel Ibis Styles',
                'venue_en' => 'Ibis Styles Hotel',
                'city' => 'Jakarta',
                'city_en' => 'Jakarta',
                'country' => 'Indonesia',
                'country_en' => 'Indonesia',
                'organizer' => 'PB PORSEROSI',
                'organizer_en' => 'PB PORSEROSI',
                'description' => 'Seminar mendalam mengenai tata cara pembangunan dan standardisasi setup arena skatepark bertaraf internasional.',
                'description_en' => 'An in-depth seminar on the construction and standardization of international-grade skatepark setups.',
                'category' => 'seminar',
                'sport_type' => 'skateboard',
                'status' => 'upcoming',
                'is_registration_open' => false,
                'is_published' => true,
            ],
            [
                'name' => 'Liga Roller Hockey Indonesia Seri 1',
                'name_en' => 'Indonesia Roller Hockey League Series 1',
                'start_date' => '2026-05-18',
                'end_date' => '2026-05-20',
                'venue' => 'GOR Rawamangun',
                'venue_en' => 'Rawamangun Indoor Stadium',
                'city' => 'Jakarta',
                'city_en' => 'Jakarta',
                'country' => 'Indonesia',
                'country_en' => 'Indonesia',
                'organizer' => 'PB PORSEROSI',
                'organizer_en' => 'PB PORSEROSI',
                'description' => 'Putaran pembuka liga resmi roller hockey se-Indonesia. Kompetisi saat ini sedang berlangsung dengan seru.',
                'description_en' => 'The opening round of the official roller hockey league across Indonesia. The competition is currently ongoing.',
                'category' => 'kompetisi',
                'sport_type' => 'roller_hockey',
                'status' => 'ongoing',
                'is_registration_open' => false,
                'is_published' => true,
            ],
            [
                'name' => 'Kejuaraan Skateboard Junior Jatim',
                'name_en' => 'East Java Junior Skateboarding Championship',
                'start_date' => '2026-05-08',
                'end_date' => '2026-05-09',
                'venue' => 'Skatepark Kenjeran',
                'venue_en' => 'Kenjeran Skatepark',
                'city' => 'Surabaya',
                'city_en' => 'Surabaya',
                'country' => 'Indonesia',
                'country_en' => 'Indonesia',
                'organizer' => 'Pengprov PORSEROSI Jatim',
                'organizer_en' => 'East Java PORSEROSI Regional Association',
                'description' => 'Ajang tahunan pencarian bakat muda skateboarder Jawa Timur. Event telah diselesaikan dengan sukses.',
                'description_en' => 'The annual scouting event for East Java\'s young skateboarding talents. The event has been successfully completed.',
                'category' => 'kompetisi',
                'sport_type' => 'skateboard',
                'status' => 'completed',
                'is_registration_open' => false,
                'is_published' => true,
            ],
            [
                'name' => 'Scooter Exhibition Dago',
                'name_en' => 'Dago Scooter Exhibition',
                'start_date' => '2026-05-12',
                'end_date' => '2026-05-13',
                'venue' => 'Skatepark Pasupati',
                'venue_en' => 'Pasupati Skatepark',
                'city' => 'Bandung',
                'city_en' => 'Bandung',
                'country' => 'Indonesia',
                'country_en' => 'Indonesia',
                'organizer' => 'Bandung Scooter Crew',
                'organizer_en' => 'Bandung Scooter Crew',
                'description' => 'Pameran freestyle scooter yang menampilkan aksi-aksi ekstrem dari rider andalan kota Bandung.',
                'description_en' => 'A freestyle scooter exhibition showcasing extreme actions from Bandung\'s flagship riders.',
                'category' => 'exhibition',
                'sport_type' => 'scooter',
                'status' => 'completed',
                'is_registration_open' => false,
                'is_published' => true,
            ],
        ];

        foreach ($events as $eventData) {
            Event::create($eventData);
        }
    }
}
