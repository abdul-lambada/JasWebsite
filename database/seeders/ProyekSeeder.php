<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Proyek;
use App\Models\Pesanan;
use Faker\Factory as Faker;

class ProyekSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $pesanans = Pesanan::all();
        if ($pesanans->isEmpty()) {
            return;
        }

        foreach ($pesanans as $pesanan) {
            // Hanya sebagian pesanan yang menjadi proyek
            if (!$faker->boolean(70)) {
                continue;
            }

            Proyek::create([
                'PesananID' => $pesanan->PesananID,
                'NamaProyek' => 'Proyek ' . $faker->company(),
                'URLGambar' => 'https://via.placeholder.com/800x600?text=Proyek',
                'URLWebsite' => $faker->url(),
            ]);
        }
    }
}