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
        Schema::create('tims', function (Blueprint $table) {
            $table->id('TimID');
            $table->string('Nama', 100)->comment('Nama anggota tim');
            $table->string('Jabatan', 50)->comment('Posisi dalam tim');
            $table->string('URLFoto', 255)->comment('Link ke foto profil');
            $table->string('LinkLinkedin', 255)->comment('URL profil LinkedIn');
            $table->text('Keahlian')->comment('Deskripsi keahlian');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tims');
    }
};
