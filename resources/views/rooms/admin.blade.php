@extends('layouts.app')

@section('content')
    <div style="padding: 20px; max-width: 1200px; margin: 0 auto;">
        <h2 style="margin-bottom: 20px;">Адміністрування номерів</h2>

        <form method="GET" action="{{ route('rooms.admin') }}" style="display: flex; gap: 20px; margin-bottom: 30px; align-items: flex-end; background: #f8f9fa; padding: 15px; border-radius: 8px;">
            <div>
                <label for="room_number" style="display: block; margin-bottom: 5px; font-weight: bold;">Номер кімнати</label>
                <input type="text" id="room_number" name="room_number" value="{{ request('room_number') }}" placeholder="Пошук за номером" style="padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            </div>

            <div>
                <label for="type" style="display: block; margin-bottom: 5px; font-weight: bold;">Тип номеру</label>
                <select id="type" name="type" onchange="this.form.submit()" style="padding: 8px; border: 1px solid #ccc; border-radius: 4px; min-width: 150px;">
                    <option value="">Усі типи</option>
                    @foreach ($types as $type)
                        <option value="{{ $type }}" @selected(request('type') == $type)>
                            {{ $type }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="facility_id" style="display: block; margin-bottom: 5px; font-weight: bold;">Зручності</label>
                <select id="facility_id" name="facility_id" onchange="this.form.submit()" style="padding: 8px; border: 1px solid #ccc; border-radius: 4px; min-width: 150px;">
                    <option value="">Усі зручності</option>
                    @foreach ($facilities as $id => $name)
                        <option value="{{ $id }}" @selected(request('facility_id') == $id)>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <div style="display: flex; gap: 10px; align-items: center;">
                    <button type="submit" style="padding: 9px 20px; background: #2c3e50; color: white; border: none; border-radius: 4px; cursor: pointer; display: inline-flex; justify-content: center; align-items: center; height: 38px;">Знайти</button>
                    <a href="{{ route('rooms.admin') }}" style="padding: 0 20px; background: #e0e0e0; color: #333; text-decoration: none; border-radius: 4px; display: inline-flex; justify-content: center; align-items: center; height: 38px;">Скинути</a>
                </div>
            </div>
        </form>

        @php
            $roomSort = $currentSort === 'room_number' ? '-room_number' : 'room_number';
            $typeSort = $currentSort === 'type' ? '-type' : 'type';
            $priceSort = $currentSort === 'price' ? '-price' : 'price';
        @endphp

        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
            <thead style="background: #2c3e50; color: white;">
            <tr>
                <th style="padding: 12px; border: 1px solid #ddd; text-align: center;">ID</th>
                <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">
                    <a href="{{ route('rooms.admin', array_merge(request()->except('sort', 'page'), ['sort' => $roomSort])) }}" style="color: white; text-decoration: none;">
                        Номер кімнати
                        @if ($currentSort === 'room_number') ↑ @elseif ($currentSort === '-room_number') ↓ @endif
                    </a>
                </th>
                <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">
                    <a href="{{ route('rooms.admin', array_merge(request()->except('sort', 'page'), ['sort' => $typeSort])) }}" style="color: white; text-decoration: none;">
                        Тип
                        @if ($currentSort === 'type') ↑ @elseif ($currentSort === '-type') ↓ @endif
                    </a>
                </th>
                <th style="padding: 12px; border: 1px solid #ddd; text-align: center;">Місткість</th>
                <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Зручності</th>
                <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">
                    <a href="{{ route('rooms.admin', array_merge(request()->except('sort', 'page'), ['sort' => $priceSort])) }}" style="color: white; text-decoration: none;">
                        Ціна
                        @if ($currentSort === 'price') ↑ @elseif ($currentSort === '-price') ↓ @endif
                    </a>
                </th>
                <th style="padding: 12px; border: 1px solid #ddd; text-align: center;">Дії</th>
            </tr>
            </thead>
            <tbody>
            @foreach($rooms as $room)
                <tr style="background: #fff; border-bottom: 1px solid #ddd;">
                    <td style="padding: 12px; border: 1px solid #ddd; text-align: center;">{{ $room->id }}</td>
                    <td style="padding: 12px; border: 1px solid #ddd; font-weight: bold;">{{ $room->room_number }}</td>
                    <td style="padding: 12px; border: 1px solid #ddd;">{{ $room->type }}</td>
                    <td style="padding: 12px; border: 1px solid #ddd; text-align: center;">{{ $room->capacity }}</td>
                    <td style="padding: 12px; border: 1px solid #ddd;">
                        @forelse($room->facilities as $facility)
                            <span style="display: inline-block; background: #6c757d; color: white; padding: 3px 8px; border-radius: 12px; font-size: 12px; margin: 2px;">
                                {{ $facility->name }}
                            </span>
                        @empty
                            <span style="color: #999;">—</span>
                        @endforelse
                    </td>
                    <td style="padding: 12px; border: 1px solid #ddd;">{{ $room->price }} грн</td>
                    <td style="padding: 12px; border: 1px solid #ddd; text-align: center;">
                        <a href="{{ route('rooms.edit', $room) }}" style="color: #2980b9; text-decoration: none; font-weight: bold;">Редагувати</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div>
            {{ $rooms->links() }}
        </div>
    </div>
@endsection
