<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Klien;
use Faker\Factory as Faker;

class KlienSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $jenis = ['Perusahaan', 'Individu', 'Lembaga'];

        foreach (range(1, 20) as $i) {
            Klien::create([
                'Nama' => $faker->name(),
                'Email' => $faker->unique()->safeEmail(),
                'NoTelepon' => $faker->phoneNumber(),
                'JenisKlien' => $faker->randomElement($jenis),
                'TanggalRegistrasi' => $faker->dateTimeBetween('-2 years', 'now'),
            ]);
        }
    }
}