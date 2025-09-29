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
        Schema::create('proyek_tim', function (Blueprint $table) {
            $table->unsignedBigInteger('ProyekID')->comment('ID Proyek');
            $table->unsignedBigInteger('TimID')->comment('ID Anggota Tim');
            $table->primary(['ProyekID', 'TimID']);
            $table->timestamps();
            
            $table->foreign('ProyekID')->references('ProyekID')->on('proyeks')->onDelete('cascade');
            $table->foreign('TimID')->references('TimID')->on('tims')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyek_tim');
    }
};
