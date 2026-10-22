@extends('layouts.app')

@section('title', 'Номер ' . $room->room_number)

@section('content')
    <h1>Деталі номера: {{ $room->room_number }}</h1>

    <ul>
        <li><strong>Категорія:</strong> {{ $room->type }}</li>
        <li><strong>Ціна:</strong> {{ $room->price }} грн/доба</li>
        <li><strong>Місткість:</strong> {{ $room->capacity }} осіб</li>
        <li><strong>Статус:</strong> {{ $room->is_available ? 'Вільний' : 'Зайнятий' }}</li>
    </ul>

    <p>
        <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Повернутися до списку</a>
    </p>
@endsection
