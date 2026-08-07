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
        Schema::table('partners', function (Blueprint $table) {
            $table->text('description')->nullable()->after('name');
            $table->text('description_en')->nullable()->after('description');
            $table->string('contact_name')->nullable()->after('description_en');
            $table->string('whatsapp_number')->nullable()->after('contact_name');
            $table->string('status')->default('active')->after('whatsapp_number');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null')->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('partners', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['description', 'description_en', 'contact_name', 'whatsapp_number', 'status', 'user_id']);
        });
    }
};
