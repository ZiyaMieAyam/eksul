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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id("id_pendaftaran")->unique();
            $table->usnignedBigInteger('id_siswa');
            $table->usnignedBigInteger('id_eskul');
            $table->date('tanggal_daftar');
            $table->enum('status', ['Pending', 'Diterima', 'Ditolak'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
