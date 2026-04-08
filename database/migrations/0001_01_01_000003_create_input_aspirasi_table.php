<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('input_aspirasi', function (Blueprint $table) {
            $table->id('id_pelaporan');
            $table->string('nis');
            $table->unsignedBigInteger('id_kategori');
            $table->string('lokasi');
            $table->text('ket');
            $table->timestamps();

            $table->foreign('nis')->references('nis')->on('siswa')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori')->cascadeOnUpdate()->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('input_aspirasi');
    }
};
