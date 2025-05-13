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
        Schema::create('dokumen_siswas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id');
            $table->string('kk')->nullable();
            $table->string('akte')->nullable();
            $table->string('surat_keterangan_lulus')->nullable();
            $table->string('kip')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('siswa_id')
                ->references('id')
                ->on('siswas')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_siswas');
    }
};
