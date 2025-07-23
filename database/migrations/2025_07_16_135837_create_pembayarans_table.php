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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained()->cascadeOnDelete();
            $table->foreignId('guru_id')->nullable()->constrained()->nullOnDelete();
            $table->string('jenis_pembayaran')->nullable();
            $table->Integer('nominal_spp')->nullable();
            $table->Integer('nominal_dana_abadi')->nullable();
            $table->Integer('nominal_bop_smt1')->nullable();
            $table->Integer('nominal_bop_smt2')->nullable();
            $table->Integer('nominal_buku_lks')->nullable();
            $table->Integer('nominal_kitab')->nullable();
            $table->Integer('nominal_seragam')->nullable();
            $table->Integer('nominal_infaq_madrasah')->nullable();
            $table->Integer('nominal_infaq_kelender')->nullable();
            $table->Integer('nominal_lainlain')->nullable();

            $table->date('tgl_bayar');
            $table->enum('status', ['Cash', 'Transfer'])->default('Cash');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
