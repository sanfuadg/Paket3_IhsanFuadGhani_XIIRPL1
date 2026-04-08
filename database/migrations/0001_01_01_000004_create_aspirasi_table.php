<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aspirasi', function (Blueprint $table) {
            $table->unsignedBigInteger('id_aspirasi')->primary();
            $table->enum('status', ['Menunggu', 'Proses', 'Selesai'])->default('Menunggu');
            $table->unsignedBigInteger('id_kategori');
            $table->string('admin_username')->nullable();
            $table->text('feedback')->nullable();
            $table->timestamps();

            $table->foreign('id_aspirasi')
                ->references('id_pelaporan')
                ->on('input_aspirasi')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('id_kategori')
                ->references('id_kategori')
                ->on('kategori')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreign('admin_username')
                ->references('username')
                ->on('admin')
                ->cascadeOnUpdate()
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aspirasi');
    }
};
