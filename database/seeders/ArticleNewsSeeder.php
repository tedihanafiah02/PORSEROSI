<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ArticleNews;
use App\Models\Category;
use App\Models\Author;

class ArticleNewsSeeder extends Seeder
{
    public function run()
    {
        // Buat 5 kategori dummy
        $categories = Category::factory()->count(5)->create();

        // Buat 3 penulis dummy
        $authors = Author::factory()->count(3)->create();

        // Buat 50 artikel dengan kategori dan penulis yang berbeda
        ArticleNews::factory()->count(50)->create([
            'category_id' => function () use ($categories) {
                return $categories->random()->id; // Ambil kategori secara acak
            },
            'author_id' => function () use ($authors) {
                return $authors->random()->id; // Ambil penulis secara acak
            },
        ]);
    }
}