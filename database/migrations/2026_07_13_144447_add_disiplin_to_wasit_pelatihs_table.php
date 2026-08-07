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
        Schema::table('wasit_pelatihs', function (Blueprint $table) {
            $table->string('disiplin')->nullable()->after('lisensi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wasit_pelatihs', function (Blueprint $table) {
            $table->dropColumn('disiplin');
        });
    }
};
