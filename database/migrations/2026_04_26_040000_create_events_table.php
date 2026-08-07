<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');                         // Nama event
            $table->string('slug')->unique();               // URL slug
            $table->date('start_date');                      // Tanggal mulai
            $table->date('end_date')->nullable();            // Tanggal selesai (nullable jika 1 hari)
            $table->string('venue');                         // Tempat/lokasi
            $table->string('city')->nullable();              // Kota
            $table->string('country')->default('Indonesia'); // Negara
            $table->string('organizer');                     // Penyelenggara
            $table->text('description')->nullable();         // Deskripsi event
            $table->string('logo')->nullable();              // Logo event
            $table->string('category')->default('kompetisi'); // Kategori: kompetisi, pelatihan, seleksi, dll
            $table->string('sport_type')->default('all');    // Tipe cabor: skateboard, inline_skate, roller_hockey, all
            $table->enum('status', ['upcoming', 'ongoing', 'completed', 'cancelled'])->default('upcoming');
            $table->string('registration_url')->nullable();  // Link pendaftaran
            $table->string('contact_info')->nullable();      // Info kontak penyelenggara
            $table->boolean('is_published')->default(true);  // Publish status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
