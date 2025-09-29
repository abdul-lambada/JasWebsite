<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Proyek;
use App\Models\Tim;
use Carbon\Carbon;

class ProyekTimSeeder extends Seeder
{
    public function run(): void
    {
        $proyekIDs = Proyek::pluck('ProyekID')->all();
        $timIDs = Tim::pluck('TimID')->all();

        if (empty($proyekIDs) || empty($timIDs)) {
            return;
        }

        foreach ($proyekIDs as $proyekID) {
            // Ambil 2-3 anggota tim unik untuk tiap proyek
            shuffle($timIDs);
            $selected = array_slice($timIDs, 0, rand(2, 3));

            foreach ($selected as $timID) {
                DB::table('proyek_tim')->insert([
                    'ProyekID' => $proyekID,
                    'TimID' => $timID,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}