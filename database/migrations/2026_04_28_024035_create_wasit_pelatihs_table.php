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
        Schema::create('wasit_pelatihs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('nik', 20);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('no_wa');
            $table->string('email')->nullable();
            $table->string('provinsi');
            $table->string('kabupaten_kota');
            $table->string('klub_asal');
            $table->enum('kategori', ['Wasit', 'Pelatih']);
            $table->enum('lisensi', ['Daerah', 'Nasional', 'Internasional', 'Belum Ada']);
            $table->string('foto_path');
            $table->string('sertifikat_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wasit_pelatihs');
    }
};
