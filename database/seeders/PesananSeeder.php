<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pesanan;
use App\Models\Klien;
use App\Models\Paket;
use Faker\Factory as Faker;

class PesananSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $klienIDs = Klien::pluck('KlienID')->all();
        $paketIDs = Paket::pluck('PaketID')->all();

        if (empty($klienIDs) || empty($paketIDs)) {
            return; // Pastikan ada klien dan paket terlebih dahulu
        }

        $statusList = ['Pending', 'Proses', 'Revisi', 'Selesai', 'Batal'];

        foreach (range(1, 30) as $i) {
            Pesanan::create([
                'KlienID' => $faker->randomElement($klienIDs),
                'PaketID' => $faker->randomElement($paketIDs),
                'TanggalPesanan' => $faker->dateTimeBetween('-18 months', 'now'),
                'Status' => $faker->randomElement($statusList),
            ]);
        }
    }
}