<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Proyek;
use App\Models\Pesanan;
use Faker\Factory as Faker;

class TestimoniSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $proyeks = Proyek::all();
        if ($proyeks->isEmpty()) {
            return;
        }

        foreach ($proyeks as $proyek) {
            // Tidak semua proyek punya testimoni
            if (!$faker->boolean(60)) {
                continue;
            }

            $pesanan = Pesanan::find($proyek->PesananID);
            if (!$pesanan) {
                continue;
            }

            DB::table('testimonis')->insert([
                'KlienID' => $pesanan->KlienID,
                'ProyekID' => $proyek->ProyekID,
                'IsiTestimoni' => $faker->realText(160),
                'TanggalDiberikan' => $faker->dateTimeBetween($pesanan->TanggalPesanan, 'now'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}