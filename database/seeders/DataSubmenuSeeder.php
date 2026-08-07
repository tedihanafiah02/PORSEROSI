<?php

namespace Database\Seeders;

use App\Models\Provinsi;
use App\Models\Club;
use App\Models\WasitPelatih;
use Illuminate\Database\Seeder;

class DataSubmenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Seed Provinsis (Pengprov)
        $provinsis = [
            [
                'name' => 'DKI Jakarta',
                'leader' => 'Muhammad Al-Mulk, S.E.',
                'period' => '2024 - 2028',
                'cities' => ['Jakarta Pusat', 'Jakarta Selatan', 'Jakarta Barat', 'Jakarta Timur', 'Jakarta Utara'],
                'order' => 1,
            ],
            [
                'name' => 'Jawa Barat',
                'leader' => 'Drs. H. Ahmad Heryawan, Lc., M.Si.',
                'period' => '2025 - 2029',
                'cities' => ['Bandung', 'Bogor', 'Bekasi', 'Depok', 'Sukabumi', 'Cirebon', 'Sumedang'],
                'order' => 2,
            ],
            [
                'name' => 'Jawa Timur',
                'leader' => 'Dr. Emil Elestianto Dardak, M.Sc.',
                'period' => '2024 - 2028',
                'cities' => ['Surabaya', 'Malang', 'Sidoarjo', 'Gresik', 'Kediri', 'Madiun', 'Banyuwangi'],
                'order' => 3,
            ],
            [
                'name' => 'Jawa Tengah',
                'leader' => 'Ganjar Pranowo, S.H., M.I.P.',
                'period' => '2023 - 2027',
                'cities' => ['Semarang', 'Surakarta', 'Magelang', 'Banyumas', 'Salatiga', 'Kudus'],
                'order' => 4,
            ],
            [
                'name' => 'Sumatera Utara',
                'leader' => 'Letjen. TNI (Purn.) Edy Rahmayadi',
                'period' => '2025 - 2029',
                'cities' => ['Medan', 'Binjai', 'Deli Serdang', 'Langkat', 'Karo', 'Simalungun'],
                'order' => 5,
            ],
            [
                'name' => 'Sulawesi Selatan',
                'leader' => 'Andi Sudirman Sulaiman, S.T.',
                'period' => '2024 - 2028',
                'cities' => ['Makassar', 'Gowa', 'Maros', 'Pangkep', 'Bone', 'Parepare'],
                'order' => 6,
            ],
        ];

        foreach ($provinsis as $provinsi) {
            Provinsi::create($provinsi);
        }

        // 2. Seed Clubs
        $clubs = [
            [
                'name' => 'Jakarta Rolling Stars',
                'city' => 'Jakarta Selatan',
                'province' => 'DKI Jakarta',
                'discipline' => 'Speed, Freestyle',
            ],
            [
                'name' => 'Bandung Skate Society',
                'city' => 'Bandung',
                'province' => 'Jawa Barat',
                'discipline' => 'Skateboard, Scooter',
            ],
            [
                'name' => 'Surabaya Inline Club',
                'city' => 'Surabaya',
                'province' => 'Jawa Timur',
                'discipline' => 'Speed, Inline Hockey',
            ],
            [
                'name' => 'Semarang Wheelerz',
                'city' => 'Semarang',
                'province' => 'Jawa Tengah',
                'discipline' => 'Freestyle, Speed',
            ],
            [
                'name' => 'Medan Roller Skaters',
                'city' => 'Medan',
                'province' => 'Sumatera Utara',
                'discipline' => 'Speed',
            ],
            [
                'name' => 'Makassar Skate Arena',
                'city' => 'Makassar',
                'province' => 'Sulawesi Selatan',
                'discipline' => 'Skateboard, Scooter',
            ],
            [
                'name' => 'Depok Inline Kids',
                'city' => 'Depok',
                'province' => 'Jawa Barat',
                'discipline' => 'Speed, Freestyle',
            ],
            [
                'name' => 'Solo Skate Team',
                'city' => 'Surakarta',
                'province' => 'Jawa Tengah',
                'discipline' => 'Skateboard',
            ],
            [
                'name' => 'Malang Inline Hockey',
                'city' => 'Malang',
                'province' => 'Jawa Timur',
                'discipline' => 'Inline Hockey',
            ],
            [
                'name' => 'Bekasi Roller Derby',
                'city' => 'Bekasi',
                'province' => 'Jawa Barat',
                'discipline' => 'Speed, Roller Freestyle',
            ],
        ];

        foreach ($clubs as $club) {
            Club::create($club);
        }

        // 3. Seed Wasit & Pelatih
        $wasitPelatih = [
            // Wasit (Referees)
            [
                'nama_lengkap' => 'Rian Kurniawan, S.Pd.',
                'nik' => '3273010203040005',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '1990-05-15',
                'jenis_kelamin' => 'Laki-laki',
                'no_wa' => '081234567890',
                'email' => 'rian@gmail.com',
                'provinsi' => 'Jawa Barat',
                'kabupaten_kota' => 'Bandung',
                'klub_asal' => 'Bandung Skate Society',
                'kategori' => 'Wasit',
                'lisensi' => 'Nasional',
                'disiplin' => 'Speed',
                'foto_path' => 'test-dummy.png',
                'status' => 'selesai',
            ],
            [
                'nama_lengkap' => 'Diana Lestari',
                'nik' => '3171020304050006',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1992-08-20',
                'jenis_kelamin' => 'Perempuan',
                'no_wa' => '081234567891',
                'email' => 'diana@gmail.com',
                'provinsi' => 'DKI Jakarta',
                'kabupaten_kota' => 'Jakarta Selatan',
                'klub_asal' => 'Jakarta Rolling Stars',
                'kategori' => 'Wasit',
                'lisensi' => 'Internasional',
                'disiplin' => 'Freestyle',
                'foto_path' => 'test-dummy.png',
                'status' => 'selesai',
            ],
            [
                'nama_lengkap' => 'Bambang Trianto',
                'nik' => '3578030405060007',
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => '1988-11-10',
                'jenis_kelamin' => 'Laki-laki',
                'no_wa' => '081234567892',
                'email' => 'bambang@gmail.com',
                'provinsi' => 'Jawa Timur',
                'kabupaten_kota' => 'Surabaya',
                'klub_asal' => 'Surabaya Inline Club',
                'kategori' => 'Wasit',
                'lisensi' => 'Daerah',
                'disiplin' => 'Inline Hockey',
                'foto_path' => 'test-dummy.png',
                'status' => 'selesai',
            ],
            [
                'nama_lengkap' => 'Ahmad Fauzi',
                'nik' => '3374040506070008',
                'tempat_lahir' => 'Semarang',
                'tanggal_lahir' => '1995-02-25',
                'jenis_kelamin' => 'Laki-laki',
                'no_wa' => '081234567893',
                'email' => 'fauzi@gmail.com',
                'provinsi' => 'Jawa Tengah',
                'kabupaten_kota' => 'Semarang',
                'klub_asal' => 'Semarang Wheelerz',
                'kategori' => 'Wasit',
                'lisensi' => 'Nasional',
                'disiplin' => 'Skateboard',
                'foto_path' => 'test-dummy.png',
                'status' => 'selesai',
            ],

            // Pelatih (Coaches)
            [
                'nama_lengkap' => 'Coach Hendra Wijaya',
                'nik' => '3273010203040009',
                'tempat_lahir' => 'Bogor',
                'tanggal_lahir' => '1985-04-12',
                'jenis_kelamin' => 'Laki-laki',
                'no_wa' => '081234567894',
                'email' => 'hendra@gmail.com',
                'provinsi' => 'Jawa Barat',
                'kabupaten_kota' => 'Bogor',
                'klub_asal' => 'Depok Inline Kids',
                'kategori' => 'Pelatih',
                'lisensi' => 'Internasional',
                'disiplin' => 'Speed',
                'foto_path' => 'test-dummy.png',
                'status' => 'selesai',
            ],
            [
                'nama_lengkap' => 'Coach Susi Susanti',
                'nik' => '3171020304050010',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1987-09-05',
                'jenis_kelamin' => 'Perempuan',
                'no_wa' => '081234567895',
                'email' => 'susi@gmail.com',
                'provinsi' => 'DKI Jakarta',
                'kabupaten_kota' => 'Jakarta Barat',
                'klub_asal' => 'Jakarta Rolling Stars',
                'kategori' => 'Pelatih',
                'lisensi' => 'Nasional',
                'disiplin' => 'Freestyle',
                'foto_path' => 'test-dummy.png',
                'status' => 'selesai',
            ],
            [
                'nama_lengkap' => 'Coach Tommy Kurniawan',
                'nik' => '3578030405060011',
                'tempat_lahir' => 'Malang',
                'tanggal_lahir' => '1983-12-30',
                'jenis_kelamin' => 'Laki-laki',
                'no_wa' => '081234567896',
                'email' => 'tommy@gmail.com',
                'provinsi' => 'Jawa Timur',
                'kabupaten_kota' => 'Malang',
                'klub_asal' => 'Malang Inline Hockey',
                'kategori' => 'Pelatih',
                'lisensi' => 'Nasional',
                'disiplin' => 'Inline Hockey',
                'foto_path' => 'test-dummy.png',
                'status' => 'selesai',
            ],
            [
                'nama_lengkap' => 'Coach Eko Yuli',
                'nik' => '7371040506070012',
                'tempat_lahir' => 'Makassar',
                'tanggal_lahir' => '1989-07-14',
                'jenis_kelamin' => 'Laki-laki',
                'no_wa' => '081234567897',
                'email' => 'eko@gmail.com',
                'provinsi' => 'Sulawesi Selatan',
                'kabupaten_kota' => 'Makassar',
                'klub_asal' => 'Makassar Skate Arena',
                'kategori' => 'Pelatih',
                'lisensi' => 'Daerah',
                'disiplin' => 'Skateboard',
                'foto_path' => 'test-dummy.png',
                'status' => 'selesai',
            ],
        ];

        foreach ($wasitPelatih as $wp) {
            WasitPelatih::create($wp);
        }
    }
}
