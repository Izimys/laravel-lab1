<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    public function run(): void
    {
        $facilities = ['Wi-Fi', 'Кондиціонер', 'Міні-бар', 'Сейф', 'Балкон'];

        foreach ($facilities as $facility) {
            Facility::firstOrCreate(['name' => $facility]);
        }
    }
}
