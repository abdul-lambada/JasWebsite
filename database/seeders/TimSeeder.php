<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tim;
use Faker\Factory as Faker;

class TimSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $jabatans = [
            'Web Developer', 'UI/UX Designer', 'Backend Engineer', 'Frontend Engineer', 'Project Manager',
            'QA Engineer', 'DevOps Engineer', 'Content Writer'
        ];

        foreach (range(1, 12) as $i) {
            Tim::create([
                'Nama' => $faker->name(),
                'Jabatan' => $faker->randomElement($jabatans),
                // Kosongkan agar fallback gambar default AdminLTE digunakan di view
                'URLFoto' => '',
                'LinkLinkedin' => 'https://www.linkedin.com/in/' . strtolower(str_replace(' ', '-', $faker->unique()->userName())),
                'Keahlian' => implode(', ', $faker->randomElements([
                    'Laravel', 'React', 'Vue', 'MySQL', 'PostgreSQL', 'Tailwind', 'Docker', 'Kubernetes', 'CI/CD', 'Microservices'
                ], $faker->numberBetween(3, 6))),
            ]);
        }
    }
}