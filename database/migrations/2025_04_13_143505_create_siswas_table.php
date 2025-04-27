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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nis')->nullable()->unique();
            $table->string('nisn')->nullable()->unique();
            $table->string('nik_siswa')->nullable();
            $table->string('nama_siswa');
            $table->string('foto')->nullable();
            $table->unsignedBigInteger('jeniskelamin_id')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->unsignedBigInteger('kelas_id')->nullable();
            $table->unsignedBigInteger('program_id')->nullable();
            $table->integer('anak_ke')->nullable();
            $table->string('no_kk')->nullable();
            $table->string('nik_ayah')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->unsignedBigInteger('pendidikan_ayah_id')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('nik_ibu')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->unsignedBigInteger('pendidikan_ibu_id')->nullable();
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

            // Foreign key constraints
            $table->foreign('jeniskelamin_id')->references('id')->on('jenis_kelamins')->onDelete('set null');
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('set null');
            $table->foreign('program_id')->references('id')->on('programs')->onDelete('set null');
            $table->foreign('pendidikan_ayah_id')->references('id')->on('pendidikans')->onDelete('set null');
            $table->foreign('pendidikan_ibu_id')->references('id')->on('pendidikans')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
