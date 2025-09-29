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
        Schema::create('artikel_blogs', function (Blueprint $table) {
            $table->id('ArtikelID');
            $table->unsignedBigInteger('PenulisID')->comment('ID penulis dari tabel Tim');
            $table->string('Judul', 200)->comment('Judul artikel');
            $table->text('Konten')->comment('Isi lengkap artikel');
            $table->dateTime('TanggalPublikasi')->comment('Waktu artikel dipublikasikan');
            $table->timestamps();
            
            $table->foreign('PenulisID')->references('TimID')->on('tims')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artikel_blogs');
    }
};
