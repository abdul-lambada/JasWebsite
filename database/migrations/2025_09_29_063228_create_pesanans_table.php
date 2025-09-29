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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id('PesananID');
            $table->unsignedBigInteger('KlienID');
            $table->unsignedBigInteger('PaketID');
            $table->dateTime('TanggalPesanan')->comment('Waktu pesanan dibuat');
            $table->enum('Status', ['Pending', 'Proses', 'Revisi', 'Selesai', 'Batal'])->comment('Status progres pesanan');
            $table->timestamps();
            
            $table->foreign('KlienID')->references('KlienID')->on('kliens')->onDelete('cascade');
            $table->foreign('PaketID')->references('PaketID')->on('pakets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
