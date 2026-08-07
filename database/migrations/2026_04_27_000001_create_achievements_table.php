<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('year');
            $table->string('tournament_name');
            $table->string('tournament_level')->default('Internasional'); // Internasional, Regional, Nasional
            $table->string('achievement_type'); // Winner, Runner-Up, Bronze, Juara 1, dll
            $table->string('discipline'); // Speed Skating, Artistic, Skateboard Street, dll
            $table->string('cabang_olahraga')->default('Sepatu Roda'); // Sepatu Roda, Skateboard, Scooter
            $table->text('athlete_names'); // Nama atlet, bisa lebih dari satu (dipisah koma)
            $table->boolean('is_published')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->index(['year', 'is_published']);
            $table->index('cabang_olahraga');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('achievements');
    }
};
