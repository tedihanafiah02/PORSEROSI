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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('location');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('scale');
            $table->string('discipline');
            $table->string('level')->nullable();
            $table->string('contact_name');
            $table->string('contact_wa');
            $table->string('nik_nisn', 20)->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }
};
