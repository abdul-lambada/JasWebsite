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
        Schema::create('testimonis', function (Blueprint $table) {
            $table->id('TestimoniID');
            $table->unsignedBigInteger('KlienID');
            $table->unsignedBigInteger('ProyekID');
            $table->text('IsiTestimoni')->comment('Teks ulasan dari klien');
            $table->dateTime('TanggalDiberikan')->comment('Waktu testimoni diberikan');
            $table->timestamps();
            
            $table->foreign('KlienID')->references('KlienID')->on('kliens')->onDelete('cascade');
            $table->foreign('ProyekID')->references('ProyekID')->on('proyeks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonis');
    }
};
