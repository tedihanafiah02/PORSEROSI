<?php

use App\Models\WasitPelatih;

// Hapus semua data WasitPelatih yang ada
WasitPelatih::truncate();

$data = [
    // Status: pending (Data Diterima, Sedang Diproses)
    [
        'nama_lengkap' => 'Ahmad Fauzi',
        'nik' => '1234567891011121',
        'tempat_lahir' => 'Jakarta',
        'tanggal_lahir' => '1990-01-01',
        'jenis_kelamin' => 'Laki-laki',
        'no_wa' => '081200000001',
        'email' => 'ahmad@example.com',
        'provinsi' => 'DKI Jakarta',
        'kabupaten_kota' => 'Jakarta Selatan',
        'klub_asal' => 'Tiger Skate',
        'kategori' => 'Pelatih',
        'lisensi' => 'Nasional',
        'foto_path' => 'wasit_pelatih/foto/dummy1.jpg',
        'status' => 'pending',
    ],
    [
        'nama_lengkap' => 'Siti Aminah',
        'nik' => '1234567891011122',
        'tempat_lahir' => 'Bandung',
        'tanggal_lahir' => '1992-02-02',
        'jenis_kelamin' => 'Perempuan',
        'no_wa' => '081200000002',
        'email' => 'siti@example.com',
        'provinsi' => 'Jawa Barat',
        'kabupaten_kota' => 'Bandung',
        'klub_asal' => 'Flower City Roller',
        'kategori' => 'Wasit',
        'lisensi' => 'Daerah',
        'foto_path' => 'wasit_pelatih/foto/dummy2.jpg',
        'status' => 'pending',
    ],
    // Status: selesai (Pendaftaran Berhasil)
    [
        'nama_lengkap' => 'Bambang Heru',
        'nik' => '1234567891011123',
        'tempat_lahir' => 'Surabaya',
        'tanggal_lahir' => '1988-03-03',
        'jenis_kelamin' => 'Laki-laki',
        'no_wa' => '081200000003',
        'email' => 'bambang@example.com',
        'provinsi' => 'Jawa Timur',
        'kabupaten_kota' => 'Surabaya',
        'klub_asal' => 'Suroboyo Skate',
        'kategori' => 'Pelatih',
        'lisensi' => 'Internasional',
        'foto_path' => 'wasit_pelatih/foto/dummy3.jpg',
        'status' => 'selesai',
    ],
    [
        'nama_lengkap' => 'Dewi Sartika',
        'nik' => '1234567891011124',
        'tempat_lahir' => 'Semarang',
        'tanggal_lahir' => '1995-04-04',
        'jenis_kelamin' => 'Perempuan',
        'no_wa' => '081200000004',
        'email' => 'dewi@example.com',
        'provinsi' => 'Jawa Tengah',
        'kabupaten_kota' => 'Semarang',
        'klub_asal' => 'Semarang Power',
        'kategori' => 'Wasit',
        'lisensi' => 'Nasional',
        'foto_path' => 'wasit_pelatih/foto/dummy4.jpg',
        'status' => 'selesai',
    ],
    // Status: ditolak (Data Ditolak)
    [
        'nama_lengkap' => 'Eko Prasetyo',
        'nik' => '1234567891011125',
        'tempat_lahir' => 'Medan',
        'tanggal_lahir' => '1985-05-05',
        'jenis_kelamin' => 'Laki-laki',
        'no_wa' => '081200000005',
        'email' => 'eko@example.com',
        'provinsi' => 'Sumatera Utara',
        'kabupaten_kota' => 'Medan',
        'klub_asal' => 'Medan Roller',
        'kategori' => 'Pelatih',
        'lisensi' => 'Belum Ada',
        'foto_path' => 'wasit_pelatih/foto/dummy5.jpg',
        'status' => 'ditolak',
    ],
    [
        'nama_lengkap' => 'Fitri Handayani',
        'nik' => '1234567891011126',
        'tempat_lahir' => 'Makassar',
        'tanggal_lahir' => '1993-06-06',
        'jenis_kelamin' => 'Perempuan',
        'no_wa' => '081200000006',
        'email' => 'fitri@example.com',
        'provinsi' => 'Sulawesi Selatan',
        'kabupaten_kota' => 'Makassar',
        'klub_asal' => 'Makassar Skate',
        'kategori' => 'Wasit',
        'lisensi' => 'Daerah',
        'foto_path' => 'wasit_pelatih/foto/dummy6.jpg',
        'status' => 'ditolak',
    ],
];

foreach ($data as $item) {
    WasitPelatih::create($item);
}

echo "Berhasil menghapus data lama dan menambahkan 6 data dummy baru dengan format NIK yang diminta.\n";
