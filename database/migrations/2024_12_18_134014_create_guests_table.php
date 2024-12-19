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
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nomor_hp');
            $table->string('alamat');
            $table->string('keperluan');
            $table->string('datang')->nullable();
            $table->string('pulang')->nullable();
            $table->string('foto_datang')->nullable();
            $table->string('foto_pulang')->nullable();
            $table->string('lama_kunjungan')->nullable();
            $table->string('uuid')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
