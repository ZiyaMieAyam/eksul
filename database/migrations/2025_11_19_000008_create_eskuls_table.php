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
        Schema::create('eskuls', function (Blueprint $table) {
            $table->id('id_eskul')->unique();
            $table->foreignId('id_pembina')->constrained('pembinas', 'id_pembina');
            $table->string('nama_eskul', 50);
            $table->string('jadwal_eskul', 50); // atau 100 jika ingin lebih longgar
            $table->text('materi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eskuls');
    }
};
