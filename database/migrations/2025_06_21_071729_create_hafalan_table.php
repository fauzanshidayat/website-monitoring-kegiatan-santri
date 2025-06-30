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
        Schema::create('hafalan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('santri_id')->constrained('santri')->onDelete('cascade');
            $table->foreignId('data_kegiatan_id')->constrained('data_kegiatan')->onDelete('cascade');
            $table->enum('jenis_hafalan', ['surah', 'kitab', 'doa', 'lainnya']);
            $table->string('nama_kitab_surah');
            $table->string('bab_juz');
            $table->string('progres_belajar');
            $table->text('keterangan')->nullable();
            $table->date('tanggal_menghafal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hafalan');
    }
};
