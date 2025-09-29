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
        Schema::create('pakets', function (Blueprint $table) {
            $table->id('PaketID');
            $table->string('NamaPaket', 50)->comment('Nama paket layanan');
            $table->text('Deskripsi')->comment('Deskripsi detail paket');
            $table->decimal('HargaDasar', 12, 2)->comment('Harga awal paket');
            $table->string('EstimasiWaktu', 50)->comment('Perkiraan durasi pengerjaan');
            $table->boolean('IsPopuler')->default(false)->comment('Apakah paket ini populer?');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pakets');
    }
};
