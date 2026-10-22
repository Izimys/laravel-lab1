<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rooms')->insert([
            ['room_number' => '101', 'type' => 'Стандартний', 'price' => 1500, 'capacity' => 2, 'is_available' => true],
            ['room_number' => '102', 'type' => 'Стандартний', 'price' => 1500, 'capacity' => 2, 'is_available' => false],
            ['room_number' => '201', 'type' => 'Напівлюкс', 'price' => 2500, 'capacity' => 3, 'is_available' => true],
            ['room_number' => '301', 'type' => 'Люкс', 'price' => 4500, 'capacity' => 2, 'is_available' => true],
            ['room_number' => '401', 'type' => 'Президентський', 'price' => 10000, 'capacity' => 4, 'is_available' => true],
        ]);
    }
}
