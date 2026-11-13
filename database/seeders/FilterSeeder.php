<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Filter;

class FilterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            'PHP',
            'Laravel',
            'Бази даних',
            'Веброзробка',
            'JavaScript',
            'Новини',
        ];
        foreach ($names as $name) {
            Filter::firstOrCreate([
                'filter_name' => $name,
            ]);
        }
    }
}
