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
        Schema::create('data_pelanggaran', function (Blueprint $table) {
            $table->id();
            $table->string('pelanggaran');
            $table->enum('jenis_pelanggaran', ['ringan', 'sedang', 'berat']);
            $table->string('hukuman');
            $table->foreignId('pengasuh_id')->constrained('pengasuh')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pelanggaran');
    }
};
