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
        Schema::create('prestasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('santri_id')->constrained('santri')->onDelete('cascade');
            $table->string('jenis_prestasi'); // Akademik, Non-Akademik, Keagamaan, dll.
            $table->string('nama_prestasi'); // Nama lomba atau capaian
            $table->string('tingkat'); // Kecamatan, Kabupaten, Nasional, dll.
            $table->text('keterangan')->nullable();
            $table->date('tanggal_prestasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasi');
    }
};
