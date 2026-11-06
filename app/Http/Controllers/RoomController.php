<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Http\Requests\RoomRequest;
use App\Models\Facility;
use Illuminate\Support\Arr;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $locale = $request->get('lang', 'uk');
        $rooms = Room::with(['translations' => function($query) use ($locale) {
            $query->where('locale', $locale);
        }])->paginate(5);
        return view('rooms.index', compact('rooms', 'locale'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('rooms.create', [
            'facilities' => \App\Models\Facility::pluck('name', 'id'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoomRequest $request)
    {
        $data = $request->validated();
        $room = Room::create(
            Arr::except($data, ['facilities'])
        );
        $room->facilities()->sync($data['facilities'] ?? []);
        return redirect()->route('rooms.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        $room->load('facilities');
        $room->loadCount('facilities');
        return view('rooms.show', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        $room->load('facilities');
        return view('rooms.edit', [
            'room' => $room,
            'facilities' => Facility::pluck('name', 'id'),
            'selected' => $room->facilities->pluck('id')->all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoomRequest $request, Room $room)
    {
        $data = $request->validated();
        $room->update(
            Arr::except($data, ['facilities'])
        );
        $room->facilities()->sync($data['facilities'] ?? []);
        return redirect()->route('rooms.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('rooms.index');
    }
}
