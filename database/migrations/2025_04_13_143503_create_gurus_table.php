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
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();
            $table->string('idguru')->unique();
            $table->string('niy_nip')->nullable();
            $table->string('npk_nuptk_pegid')->nullable();
            $table->string('nama_guru');
            $table->string('foto')->nullable();
            $table->string('nik')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->unsignedBigInteger('jeniskelamin_id')->nullable();
            $table->unsignedBigInteger('pendidikan_terakhir_id')->nullable();
            $table->string('inst_pend_terakhir')->nullable();
            $table->text('alamat')->nullable();
            $table->string('no_hp')->nullable();
            $table->date('tmt_sk_awal')->nullable();
            $table->unsignedBigInteger('status_guru_id')->nullable();
            $table->integer('masa_kerja')->nullable();
            $table->unsignedBigInteger('mapel_1_id')->nullable();
            $table->unsignedBigInteger('mapel_2_id')->nullable();
            $table->unsignedBigInteger('mapel_3_id')->nullable();
            $table->unsignedBigInteger('jabatan_1_id')->nullable();
            $table->unsignedBigInteger('jabatan_2_id')->nullable();
            $table->unsignedBigInteger('jabatan_3_id')->nullable();

            $table->timestamps();

            // Foreign key constraints
            $table->foreign('jeniskelamin_id')->references('id')->on('jenis_kelamins')->onDelete('set null');
            $table->foreign('pendidikan_terakhir_id')->references('id')->on('pendidikans')->onDelete('set null');
            $table->foreign('status_guru_id')->references('id')->on('status_gurus')->onDelete('set null');
            $table->foreign('mapel_1_id')->references('id')->on('mapels')->onDelete('set null');
            $table->foreign('mapel_2_id')->references('id')->on('mapels')->onDelete('set null');
            $table->foreign('mapel_3_id')->references('id')->on('mapels')->onDelete('set null');
            $table->foreign('jabatan_1_id')->references('id')->on('jabatans')->onDelete('set null');
            $table->foreign('jabatan_2_id')->references('id')->on('jabatans')->onDelete('set null');
            $table->foreign('jabatan_3_id')->references('id')->on('jabatans')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gurus');
    }
};
