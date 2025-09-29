<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('testimonis', function (Blueprint $table) {
            $table->string('Nama', 100)->nullable()->after('ProyekID');
            $table->string('Jabatan', 100)->nullable()->after('Nama');
            $table->unsignedTinyInteger('Rating')->nullable()->after('Jabatan');
            $table->text('Isi')->nullable()->after('Rating');
        });
    }

    public function down(): void
    {
        Schema::table('testimonis', function (Blueprint $table) {
            $table->dropColumn(['Nama', 'Jabatan', 'Rating', 'Isi']);
        });
    }
};