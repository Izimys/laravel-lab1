<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Http\Requests\RoomRequest;
use App\Models\Facility;
use Illuminate\Support\Arr;
use App\Queries\RoomFilter;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $locale = $request->get('lang', 'uk');
        $rooms = Room::with(['translations' => function($query) use ($locale) {
            $query->where('locale', $locale);
        }])->paginate(5);
        return view('rooms.index', compact('rooms', 'locale'));
    }

    public function create()
    {
        return view('rooms.create', [
            'facilities' => \App\Models\Facility::pluck('name', 'id'),
        ]);
    }

    public function store(RoomRequest $request)
    {
        $data = $request->validated();
        $room = Room::create(
            Arr::except($data, ['facilities'])
        );
        $room->facilities()->sync($data['facilities'] ?? []);
        return redirect()->route('rooms.index');
    }

    public function show(Room $room)
    {
        $room->load('facilities');
        $room->loadCount('facilities');
        return view('rooms.show', compact('room'));
    }

    public function edit(Room $room)
    {
        $room->load('facilities');
        return view('rooms.edit', [
            'room' => $room,
            'facilities' => Facility::pluck('name', 'id'),
            'selected' => $room->facilities->pluck('id')->all(),
        ]);
    }

    public function update(RoomRequest $request, Room $room)
    {
        $data = $request->validated();
        $room->update(
            Arr::except($data, ['facilities'])
        );
        $room->facilities()->sync($data['facilities'] ?? []);
        return redirect()->route('rooms.index');
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('rooms.index');
    }

    public function admin(Request $request, RoomFilter $filter)
    {
        $input = $request->validate([
            'room_number' => ['nullable', 'string', 'max:50'],
            'type' => ['nullable', 'string', 'max:100'],
            'facility_id' => [
                'nullable',
                'integer',
                'exists:facilities,id',
            ],
            'sort' => ['nullable', 'string', 'max:30'],
        ]);

        $rooms = $filter->apply($input)
            ->paginate(10)
            ->withQueryString();

        $types = Room::select('type')->distinct()->pluck('type', 'type');

        return view('rooms.admin', [
            'rooms' => $rooms,
            'types' => $types,
            'facilities' => Facility::orderBy('name')->pluck('name', 'id'),
            'currentSort' => $input['sort'] ?? '-created',
        ]);
    }
}
