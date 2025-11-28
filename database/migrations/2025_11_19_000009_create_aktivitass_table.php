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
        Schema::create('aktivitass', function (Blueprint $table) {
            $table->id('id_aktivitas');
            $table->unsignedBigInteger('id_eskul');
            $table->unsignedBigInteger('id_pembina');
            $table->string('jenis_aktivitas', 50);
            $table->string('tempat');
            $table->time('jam');
            $table->date('tanggal_aktivitas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aktivitass');
    }
};
