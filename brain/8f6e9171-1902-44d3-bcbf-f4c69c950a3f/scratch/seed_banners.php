<?php

require __DIR__ . '/../../../vendor/autoload.php';
$app = require_once __DIR__ . '/../../../bootstrap/app.php';

use App\Models\BannerAdvertisement;
use Illuminate\Contracts\Console\Kernel;

$app->make(Kernel::class)->bootstrap();

// Clear existing dummy banner records if they exist to avoid duplicates
BannerAdvertisement::where('thumbnail', 'banners/dummy_banner1.png')->delete();
BannerAdvertisement::where('thumbnail', 'banners/dummy_banner2.png')->delete();

// Create banner 1 (horizontal)
BannerAdvertisement::create([
    'link' => 'https://www.youtube.com/@PBPORSEROSI',
    'type' => 'banner',
    'thumbnail' => 'banners/dummy_banner1.png',
    'is_active' => 'active',
]);

// Create banner 2 (square)
BannerAdvertisement::create([
    'link' => 'https://www.instagram.com/pb.porserosi/',
    'type' => 'banner',
    'thumbnail' => 'banners/dummy_banner2.png',
    'is_active' => 'active',
]);

echo "Banner ads seeded successfully.\n";
