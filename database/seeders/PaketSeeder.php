<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Paket;

class PaketSeeder extends Seeder
{
    public function run(): void
    {
        $pakets = [
            [
                'NamaPaket' => 'Paket Dasar',
                'Deskripsi' => 'Website profil sederhana dengan hingga 5 halaman, responsif dan SEO dasar.',
                'HargaDasar' => 2500000,
                'EstimasiWaktu' => '2 minggu',
                'IsPopuler' => false,
            ],
            [
                'NamaPaket' => 'Paket Profesional',
                'Deskripsi' => 'Website bisnis lengkap, integrasi formulir, blog, dan optimasi performa.',
                'HargaDasar' => 5500000,
                'EstimasiWaktu' => '3 minggu',
                'IsPopuler' => true,
            ],
            [
                'NamaPaket' => 'Paket E‑Commerce',
                'Deskripsi' => 'Toko online dengan manajemen produk, pembayaran, dan dashboard admin.',
                'HargaDasar' => 9500000,
                'EstimasiWaktu' => '4–5 minggu',
                'IsPopuler' => true,
            ],
            [
                'NamaPaket' => 'Paket Custom',
                'Deskripsi' => 'Solusi kustom sesuai kebutuhan: integrasi API, fitur unik, atau sistem internal.',
                'HargaDasar' => 15000000,
                'EstimasiWaktu' => '6–8 minggu',
                'IsPopuler' => false,
            ],
        ];

        foreach ($pakets as $p) {
            Paket::create($p);
        }
    }
}