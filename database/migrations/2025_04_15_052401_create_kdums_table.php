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
        Schema::create('kdums', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id');
            $table->unsignedBigInteger('kelas_id')->nullable();
            $table->unsignedBigInteger('tahun_pelajaran_id')->nullable();
            $table->timestamps();

            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('set null');
            $table->foreign('tahun_pelajaran_id')->references('id')->on('tahun_pelajarans')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kdums');
    }
};
