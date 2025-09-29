<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimoni;
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

            Testimoni::create([
                'KlienID' => $pesanan->KlienID,
                'ProyekID' => $proyek->ProyekID,
                'Nama' => $faker->name(),
                'Jabatan' => $faker->jobTitle(),
                'Rating' => $faker->numberBetween(3, 5),
                'Isi' => $faker->realText(160),
                'IsiTestimoni' => $faker->realText(160),
                'TanggalDiberikan' => $faker->dateTimeBetween($pesanan->TanggalPesanan, 'now'),
            ]);
        }
    }
}