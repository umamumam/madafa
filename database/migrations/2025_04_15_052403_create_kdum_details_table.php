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
        Schema::create('kdum_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kdum_id');
            $table->unsignedBigInteger('kompetensi_id');
            $table->unsignedBigInteger('nilai_id')->nullable();
            $table->unsignedBigInteger('penyemak_id')->nullable();
            $table->timestamps();

            $table->foreign('kdum_id')->references('id')->on('kdums')->onDelete('cascade');
            $table->foreign('kompetensi_id')->references('id')->on('kompetensis')->onDelete('cascade');
            $table->foreign('nilai_id')->references('id')->on('nilais')->onDelete('set null');
            $table->foreign('penyemak_id')->references('id')->on('penyemaks')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kdum_details');
    }
};
