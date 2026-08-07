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
        Schema::create('result_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('result_folder_id');
            $table->string('title');
            $table->string('title_en')->nullable();
            $table->string('file_path');
            $table->integer('order')->default(1);
            $table->timestamps();

            $table->foreign('result_folder_id')->references('id')->on('result_folders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('result_files');
    }
};
