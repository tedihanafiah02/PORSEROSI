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
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('thumbnail'); // Gambar Event
            $table->string('title'); // Judul Event
            $table->text('short_description'); // Deskripsi Singkat
            $table->string('event_date'); // Tanggal Event
            $table->string('location'); // Lokasi Event
            $table->string('organizer'); // Penyelenggara
            $table->text('registration_link'); // Link Pendaftaran (Google Form)
            $table->boolean('is_active')->default(true); // Status buka/tutup
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
