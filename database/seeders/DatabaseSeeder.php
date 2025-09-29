<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Jangan seed tabel users sesuai permintaan.

        $this->call([
            KlienSeeder::class,
            PaketSeeder::class,
            TimSeeder::class,
            PesananSeeder::class,
            ProyekSeeder::class,
            ProyekTimSeeder::class,
            TestimoniSeeder::class,
            ArtikelBlogSeeder::class,
        ]);
    }
}
