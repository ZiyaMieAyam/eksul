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
        Schema::create('prestasis', function (Blueprint $table) {
            $table->id('id_prestasi');
            $table->unsignedBigInteger('id_siswa');
            $table->unsignedBigInteger('id_eskul');
            $table->string('nama_prestasi', 100);
            $table->date('tanggal_diraih');
            $table->string('tingkat', 50);
            $table->string('bukti', 100)->nullable();
            $table->enum('status', ['Pending', 'Diverifikasi', 'Ditolak'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasis');
    }
};
