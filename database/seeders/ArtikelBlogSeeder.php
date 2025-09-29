<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ArtikelBlog;
use App\Models\Tim;
use Faker\Factory as Faker;

class ArtikelBlogSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $penulisIDs = Tim::pluck('TimID')->all();
        if (empty($penulisIDs)) {
            return;
        }

        foreach (range(1, 12) as $i) {
            $judul = ucfirst($faker->words($faker->numberBetween(3, 6), true));
            $konten = '<p>' . $faker->paragraph(4) . '</p>'
                . '<h3>' . ucfirst($faker->words(3, true)) . '</h3>'
                . '<p>' . $faker->paragraph(5) . '</p>';

            ArtikelBlog::create([
                'PenulisID' => $faker->randomElement($penulisIDs),
                'Judul' => $judul,
                'Konten' => $konten,
                'TanggalPublikasi' => $faker->dateTimeBetween('-12 months', 'now'),
            ]);
        }
    }
}