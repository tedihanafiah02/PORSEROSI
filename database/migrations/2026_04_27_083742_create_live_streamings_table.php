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
        Schema::create('live_streamings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('thumbnail')->nullable();
            $table->string('platform')->default('youtube'); // youtube, instagram, tiktok, tv, custom
            $table->text('embed_url');
            $table->dateTime('start_datetime');
            $table->dateTime('end_datetime')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->default('upcoming'); // upcoming, live, finished
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('live_streamings');
    }
};
