<?php

namespace App\Queries;

use App\Models\Room;
use Illuminate\Database\Eloquent\Builder;

class RoomFilter
{
    private const SORTABLE = [
        'room_number' => 'rooms.room_number',
        'type' => 'rooms.type',
        'price' => 'rooms.price',
        'created' => 'rooms.created_at',
    ];

    public function apply(array $input): Builder
    {
        $query = Room::query()
            ->with(['facilities'])
            ->select('rooms.*');

        $query->when(
            $input['room_number'] ?? null,
            fn (Builder $q, $value) => $q->where('rooms.room_number', 'like', "%{$value}%")
        );

        $query->when(
            $input['type'] ?? null,
            fn (Builder $q, $value) => $q->where('rooms.type', $value)
        );

        $query->when(
            $input['facility_id'] ?? null,
            fn (Builder $q, $value) => $q->whereHas('facilities', function ($q) use ($value) {
                $q->where('facilities.id', $value);
            })
        );

        $sort = $input['sort'] ?? '-created';
        $direction = str_starts_with($sort, '-') ? 'desc' : 'asc';
        $sortColumn = ltrim($sort, '-');

        if (array_key_exists($sortColumn, self::SORTABLE)) {
            $query->orderBy(self::SORTABLE[$sortColumn], $direction);
        }

        return $query;
    }
}
