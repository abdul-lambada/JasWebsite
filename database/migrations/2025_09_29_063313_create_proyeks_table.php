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
        Schema::create('proyeks', function (Blueprint $table) {
            $table->id('ProyekID');
            $table->unsignedBigInteger('PesananID')->comment('Referensi ke pesanan asal');
            $table->string('NamaProyek', 150)->comment('Nama proyek untuk portofolio');
            $table->string('URLGambar', 255)->comment('Link ke gambar screenshot');
            $table->string('URLWebsite', 255)->comment('Link ke website live');
            $table->timestamps();
            
            $table->foreign('PesananID')->references('PesananID')->on('pesanans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyeks');
    }
};
