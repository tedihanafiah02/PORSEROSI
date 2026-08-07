<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('event_registrations');
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('location');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('scale'); // provinsi, regional, nasional, internasional
            $table->string('discipline'); // Speed: Pemula, Speed: Standard, Speed, Inline Freestyle, Skateboard, Aggressive
            $table->string('level')->nullable(); // Rookie, 1-Star, 2-Stars, 3-Stars (khusus Inline Freestyle)
            $table->string('contact_name');
            $table->string('contact_wa');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_registrations');
    }
};
