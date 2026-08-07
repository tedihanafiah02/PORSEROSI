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
        Schema::table('banner_advertisements', function (Blueprint $table) {
            $table->boolean('show_on_all_pages')->default(true)->after('thumbnail');
            $table->json('pages')->nullable()->after('show_on_all_pages');
            $table->dateTime('start_date')->nullable()->after('pages');
            $table->dateTime('end_date')->nullable()->after('start_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('banner_advertisements', function (Blueprint $table) {
            $table->dropColumn(['show_on_all_pages', 'pages', 'start_date', 'end_date']);
        });
    }
};
