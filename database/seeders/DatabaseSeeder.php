<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\AchievementSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Panggil seeder untuk kategori, penulis, dan artikel
        $this->call([CategorySeeder::class, AuthorSeeder::class, ArticleNewsSeeder::class, AchievementSeeder::class, OfficerSeeder::class, RegulationSeeder::class, DataSubmenuSeeder::class, ResultSeeder::class]);
        
    }
}