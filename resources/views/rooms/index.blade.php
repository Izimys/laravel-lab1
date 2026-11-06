@extends('layouts.app')

@section('title', ($locale ?? 'uk') === 'en' ? 'Hotel Rooms' : 'Номери готелю')

@section('content')
    <style>
        .hotel-table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 16px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            background-color: white;
        }
        .hotel-table thead tr {
            background-color: #2c3e50;
            color: #ffffff;
            text-align: left;
        }
        .hotel-table th, .hotel-table td {
            padding: 15px 20px;
            border-bottom: 1px solid #dddddd;
        }
        .hotel-table tbody tr:nth-of-type(even) {
            background-color: #fbfbfb;
        }
        .hotel-table tbody tr:hover {
            background-color: #f1f1f1;
            transition: 0.3s ease;
        }
        .status-free {
            color: #27ae60;
            font-weight: bold;
        }
        .status-busy {
            color: #e74c3c;
            font-weight: bold;
        }
        .action-link {
            text-decoration: none;
            color: #3498db;
            font-weight: bold;
        }
        .action-link:hover {
            text-decoration: underline;
        }
        .lang-switcher {
            margin-bottom: 15px;
            font-size: 14px;
        }
        .lang-switcher a {
            text-decoration: none;
            color: #2c3e50;
            font-weight: bold;
            margin-right: 5px;
        }
        .lang-switcher a.active {
            color: #3498db;
            text-decoration: underline;
        }
    </style>

    <h1>{{ ($locale ?? 'uk') === 'en' ? 'Hotel Rooms' : 'Номери готелю' }}</h1>

    <div class="lang-switcher">
        <span>Мова / Language:</span>
        <a href="{{ request()->fullUrlWithQuery(['lang' => 'uk']) }}" class="{{ ($locale ?? 'uk') === 'uk' ? 'active' : '' }}">UA</a> |
        <a href="{{ request()->fullUrlWithQuery(['lang' => 'en']) }}" class="{{ ($locale ?? 'uk') === 'en' ? 'active' : '' }}">EN</a>
    </div>

    <p>
        <a href="{{ route('rooms.create', ['lang' => $locale ?? 'uk']) }}" class="btn btn-primary">
            {{ ($locale ?? 'uk') === 'en' ? 'Add new room' : 'Додати новий номер' }}
        </a>
    </p>

    <table class="hotel-table">
        <thead>
        <tr>
            <th>#</th>
            <th>{{ ($locale ?? 'uk') === 'en' ? 'Room Number' : 'Номер кімнати' }}</th>
            <th>{{ ($locale ?? 'uk') === 'en' ? 'Category' : 'Категорія' }}</th>
            <th>{{ ($locale ?? 'uk') === 'en' ? 'Price (UAH/day)' : 'Ціна (грн/доба)' }}</th>
            <th>{{ ($locale ?? 'uk') === 'en' ? 'Capacity (persons)' : 'Місткість (осіб)' }}</th>
            <th>{{ ($locale ?? 'uk') === 'en' ? 'Status' : 'Статус' }}</th>
            <th>{{ ($locale ?? 'uk') === 'en' ? 'Actions' : 'Дії' }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($rooms as $index => $room)
            @php
                $translation = $room->translations->where('locale', $locale ?? 'uk')->first()
                            ?? $room->translations->where('locale', 'uk')->first();
            @endphp
            <tr>
                <td>{{ $rooms->firstItem() + $index }}</td>
                <td>
                    <a href="{{ route('rooms.show', ['room' => $room, 'lang' => $locale ?? 'uk']) }}" class="action-link">
                        {{ $room->room_number }}
                    </a>
                </td>
                <td>{{ $translation?->name ?? $room->type }}</td>
                <td>{{ $room->price }}</td>
                <td>{{ $room->capacity }}</td>
                <td>
                    @if($room->is_available)
                        <span class="status-free">{{ ($locale ?? 'uk') === 'en' ? 'Available' : 'Вільний' }}</span>
                    @else
                        <span class="status-busy">{{ ($locale ?? 'uk') === 'en' ? 'Occupied' : 'Зайнятий' }}</span>
                    @endif
                </td>
                <td>
                    <div style="display: flex; gap: 10px; align-items: center;">
                        <a href="{{ route('rooms.edit', ['room' => $room, 'lang' => $locale ?? 'uk']) }}" class="action-link">{{ ($locale ?? 'uk') === 'en' ? 'Edit' : 'Редагувати' }}</a>
                        <form action="{{ route('rooms.destroy', ['room' => $room, 'lang' => $locale ?? 'uk']) }}" method="POST" onsubmit="return confirm('{{ ($locale ?? 'uk') === 'en' ? 'Are you sure you want to delete this room?' : 'Ви впевнені, що хочете видалити цей номер?' }}');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; border: none; color: #e74c3c; cursor: pointer; font-weight: bold; text-decoration: none; padding: 0;">{{ ($locale ?? 'uk') === 'en' ? 'Delete' : 'Видалити' }}</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div style="margin-top: 20px;">
        {{ $rooms->links() }}
    </div>
@endsection
