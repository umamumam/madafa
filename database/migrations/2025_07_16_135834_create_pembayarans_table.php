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
            // $table->foreignId('siswa_id')->constrained()->cascadeOnDelete();
            $table->string('siswa_nis')->nullable();
            $table->foreign('siswa_nis')->references('nis')->on('siswas')->onDelete('cascade');
            $table->enum('petugas', ['Anis Maimanah', 'M. Fahruddin', 'Lainnya', '-'])->default('-');
            $table->string('jenis_pembayaran')->nullable();
            // tagihan
            $table->integer('tagihan_spp')->nullable();
            $table->integer('tagihan_dana_abadi')->nullable();
            $table->integer('tagihan_bop_smt1')->nullable();
            $table->integer('tagihan_bop_smt2')->nullable();
            $table->integer('tagihan_buku_lks')->nullable();
            $table->integer('tagihan_kitab')->nullable();
            $table->integer('tagihan_seragam')->nullable();
            $table->integer('tagihan_infaq_madrasah')->nullable();
            $table->integer('tagihan_infaq_kalender')->nullable();
            $table->integer('tagihan_outing_class')->nullable();
            $table->integer('tagihan_lainlain')->nullable();
            // bayar
            $table->Integer('nominal_beasiswa')->nullable();
            $table->Integer('nominal_spp')->nullable();
            $table->Integer('nominal_dana_abadi')->nullable();
            $table->Integer('nominal_bop_smt1')->nullable();
            $table->Integer('nominal_bop_smt2')->nullable();
            $table->Integer('nominal_buku_lks')->nullable();
            $table->Integer('nominal_kitab')->nullable();
            $table->Integer('nominal_seragam')->nullable();
            $table->Integer('nominal_infaq_madrasah')->nullable();
            $table->Integer('nominal_infaq_kalender')->nullable();
            $table->Integer('nominal_outing_class')->nullable();
            $table->Integer('nominal_lainlain')->nullable();

            $table->date('tgl_bayar')->nullable();
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
