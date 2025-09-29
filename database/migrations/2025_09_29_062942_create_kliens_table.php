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
        Schema::create('kliens', function (Blueprint $table) {
            $table->id('KlienID');
            $table->string('Nama', 100)->comment('Nama lengkap klien');
            $table->string('Email', 100)->unique()->comment('Alamat email (unik)');
            $table->string('NoTelepon', 20)->comment('Nomor telepon');
            $table->enum('JenisKlien', ['Perusahaan', 'Individu', 'Lembaga'])->comment('Kategori Klien');
            $table->dateTime('TanggalRegistrasi')->comment('Waktu registrasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kliens');
    }
};
