<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\RoomTranslation;

class RoomTranslationSeeder extends Seeder
{
    public function run(): void
    {
        $rooms = Room::all();
        $categories = [
            0 => ['uk_name' => 'Стандарт', 'en_name' => 'Standard Room', 'uk_desc' => 'Затишний базовий номер для комфортного відпочинку.', 'en_desc' => 'Cozy basic room for comfortable relaxation.'],
            1 => ['uk_name' => 'Напівлюкс', 'en_name' => 'Junior Suite', 'uk_desc' => 'Просторий номер з додатковими зручностями для гостей.', 'en_desc' => 'Spacious room with additional amenities for guests.'],
            2 => ['uk_name' => 'Люкс', 'en_name' => 'Deluxe Room', 'uk_desc' => 'Комфортабельний номер з чудовим краєвидом та сучасним інтер\'єром.', 'en_desc' => 'Comfortable room with a wonderful view and modern interior.'],
            3 => ['uk_name' => 'Президентський', 'en_name' => 'Presidential Suite', 'uk_desc' => 'Ексклюзивний номер з максимальним рівнем сервісу та площею.', 'en_desc' => 'Exclusive room with the highest level of service and area.'],
        ];

        foreach ($rooms as $index => $room) {
            $cat = $categories[$index % 4];

            RoomTranslation::updateOrCreate(
                ['room_id' => $room->id, 'locale' => 'uk'],
                [
                    'name' => $cat['uk_name'],
                    'description' => $cat['uk_desc']
                ]
            );

            RoomTranslation::updateOrCreate(
                ['room_id' => $room->id, 'locale' => 'en'],
                [
                    'name' => $cat['en_name'],
                    'description' => $cat['en_desc']
                ]
            );
        }
    }
}
