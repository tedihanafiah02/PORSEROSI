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
        Schema::table('achievements', function (Blueprint $table) {
            $table->string('tournament_name_en')->nullable()->after('tournament_name');
            $table->string('tournament_level_en')->nullable()->after('tournament_level');
            $table->string('discipline_en')->nullable()->after('discipline');
        });

        Schema::table('authors', function (Blueprint $table) {
            $table->string('occupation_en')->nullable()->after('occupation');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->string('name_en')->nullable()->after('name');
            $table->string('venue_en')->nullable()->after('venue');
            $table->string('city_en')->nullable()->after('city');
            $table->string('country_en')->nullable()->after('country');
            $table->string('organizer_en')->nullable()->after('organizer');
            $table->text('description_en')->nullable()->after('description');
        });

        Schema::table('galleries', function (Blueprint $table) {
            $table->string('alt_text_en')->nullable()->after('alt_text');
        });

        Schema::table('live_streamings', function (Blueprint $table) {
            $table->string('title_en')->nullable()->after('title');
            $table->text('description_en')->nullable()->after('description');
        });

        Schema::table('partners', function (Blueprint $table) {
            $table->string('alt_text_en')->nullable()->after('alt_text');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('achievements', function (Blueprint $table) {
            $table->dropColumn(['tournament_name_en', 'tournament_level_en', 'discipline_en']);
        });

        Schema::table('authors', function (Blueprint $table) {
            $table->dropColumn(['occupation_en']);
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['name_en', 'venue_en', 'city_en', 'country_en', 'organizer_en', 'description_en']);
        });

        Schema::table('galleries', function (Blueprint $table) {
            $table->dropColumn(['alt_text_en']);
        });

        Schema::table('live_streamings', function (Blueprint $table) {
            $table->dropColumn(['title_en', 'description_en']);
        });

        Schema::table('partners', function (Blueprint $table) {
            $table->dropColumn(['alt_text_en']);
        });
    }
};
