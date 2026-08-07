<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;

$emails = ['pbporserosi2026@gmail.com', 'tedihanafi12@gmail.com'];

foreach ($emails as $email) {
    $user = User::where('email', $email)->first();
    if ($user) {
        $user->password = bcrypt('PB*porserosi*');
        $user->save();
        echo "Password reset OK untuk: " . $user->email . PHP_EOL;
    } else {
        echo "User tidak ditemukan: " . $email . PHP_EOL;
    }
}
