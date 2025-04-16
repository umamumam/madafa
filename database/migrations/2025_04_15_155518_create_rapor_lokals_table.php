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
        Schema::create('rapor_lokals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade');
            $table->foreignId('kelas_id')->constrained('kelas')->onDelete('cascade');
            $table->enum('semester', ['1', '2']);
            $table->foreignId('tahun_pelajaran_id')->constrained('tahun_pelajarans')->onDelete('cascade');
            $table->foreignId('nilai_spiritual_id')->nullable()->constrained('nilais')->onDelete('set null');
            $table->text('deskripsi_spiritual')->nullable();
            $table->foreignId('nilai_sosial_id')->nullable()->constrained('nilais')->onDelete('set null');
            $table->text('deskripsi_sosial')->nullable();
            $table->foreignId('ekstrakurikuler_id')->nullable()->constrained('ekstrakurikulers')->onDelete('set null');
            $table->foreignId('nilai_ekstra_id')->nullable()->constrained('nilais')->onDelete('set null');
            $table->integer('sakit')->nullable();
            $table->integer('izin')->nullable();
            $table->integer('tanpa_keterangan')->nullable();
            $table->text('catatan')->nullable();
            $table->foreignId('ket_id')->nullable()->constrained('kets')->onDelete('set null');
            $table->foreignId('walikelas_id')->nullable()->constrained('gurus')->onDelete('set null');
            $table->foreignId('kepala_madrasah_id')->nullable()->constrained('gurus')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rapor_lokals');
    }
};
