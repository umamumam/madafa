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
        Schema::create('rapor_lokal_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rapor_lokal_id')->constrained('rapor_lokals')->onDelete('cascade');
            $table->foreignId('mapel_id')->constrained('mapels')->onDelete('cascade');
            $table->foreignId('nilai_id')->nullable()->constrained('nilais')->onDelete('set null');
            $table->string('predikat')->nullable();
            $table->integer('jumlah')->nullable();
            $table->float('rata_rata')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rapor_lokal_details');
    }
};
