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
        Schema::create('userss', function (Blueprint $table) {
            $table->id('id_user');
            $table->unsignedBigInteger('id_siswa')->nullable();
            $table->unsignedBigInteger('id_guru')->nullable();
            $table->unsignedBigInteger('id_pembina')->nullable();
            $table->string('username')->unique();
            $table->string('password');
            $table->enum('role', ['siswa', 'guru', 'pembina']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('userss');
    }
};
