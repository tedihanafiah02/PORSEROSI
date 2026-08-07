<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Buat 5 kategori dummy
        Category::factory()->count(5)->create();
    }
}