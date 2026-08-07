<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    public function run()
    {
        // Buat 3 penulis dummy
        Author::factory()->count(3)->create();
    }
}