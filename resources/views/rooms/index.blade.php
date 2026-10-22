@extends('layouts.app')

@section('title', 'Номери готелю')

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
    </style>

    <h1>Номери готелю</h1>

    <p>
        <a href="{{ route('rooms.create') }}" class="btn btn-primary">
            Додати новий номер
        </a>
    </p>

    <table class="hotel-table">
        <thead>
        <tr>
            <th>#</th>
            <th>Номер кімнати</th>
            <th>Категорія</th>
            <th>Ціна (грн/доба)</th>
            <th>Місткість (осіб)</th>
            <th>Статус</th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($rooms as $room)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <a href="{{ route('rooms.show', $room) }}" class="action-link">
                        {{ $room->room_number }}
                    </a>
                </td>
                <td>{{ $room->type }}</td>
                <td>{{ $room->price }}</td>
                <td>{{ $room->capacity }}</td>
                <td>
                    @if($room->is_available)
                        <span class="status-free">Вільний</span>
                    @else
                        <span class="status-busy">Зайнятий</span>
                    @endif
                </td>
                <td>
                    <div style="display: flex; gap: 10px; align-items: center;">
                        <a href="{{ route('rooms.edit', $room) }}" class="action-link">Редагувати</a>
                        <form action="{{ route('rooms.destroy', $room) }}" method="POST" onsubmit="return confirm('Ви впевнені, що хочете видалити цей номер?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; border: none; color: #e74c3c; cursor: pointer; font-weight: bold; text-decoration: none; padding: 0;">Видалити</button>
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
