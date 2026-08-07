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
        Schema::table('article_news', function (Blueprint $table) {
            $table->index('is_featured');
            $table->index('created_at');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->index('is_published');
            $table->index('status');
            $table->index('sport_type');
            $table->index('start_date');
        });

        Schema::table('participants', function (Blueprint $table) {
            $table->index('status');
            $table->index('sport_type');
        });

        Schema::table('live_streamings', function (Blueprint $table) {
            $table->index('is_active');
            $table->index('status');
            $table->index('start_datetime');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('article_news', function (Blueprint $table) {
            $table->dropIndex(['is_featured']);
            $table->dropIndex(['created_at']);
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dropIndex(['is_published']);
            $table->dropIndex(['status']);
            $table->dropIndex(['sport_type']);
            $table->dropIndex(['start_date']);
        });

        Schema::table('participants', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['sport_type']);
        });

        Schema::table('live_streamings', function (Blueprint $table) {
            $table->dropIndex(['is_active']);
            $table->dropIndex(['status']);
            $table->dropIndex(['start_datetime']);
        });
    }
};
