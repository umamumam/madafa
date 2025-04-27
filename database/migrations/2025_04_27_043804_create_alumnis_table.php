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
        Schema::create('alumnis', function (Blueprint $table) {
            $table->id();
            $table->string('nis')->nullable();
            $table->string('nisn')->nullable();
            $table->string('nik_siswa')->nullable();
            $table->string('nama_siswa');
            $table->string('foto')->nullable();
            $table->string('jeniskelamin')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('kelas')->nullable();
            $table->string('program')->nullable();
            $table->integer('anak_ke')->nullable();
            $table->string('no_kk')->nullable();
            $table->string('nik_ayah')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->string('pendidikan_ayah')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('nik_ibu')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('pendidikan_ibu')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('hp_siswa')->nullable();
            $table->string('hp_ortu')->nullable();
            $table->text('alamat')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('asal_sekolah')->nullable();
            $table->string('npsn')->nullable();
            $table->string('nsm')->nullable();
            $table->string('alamat_sekolah')->nullable();
            $table->string('no_kip')->nullable();
            $table->string('no_kks')->nullable();
            $table->string('no_pkh')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnis');
    }
};
