@extends('layouts.app')

@section('title', (request('lang', 'uk') === 'en' ? 'Room ' : 'Номер ') . $room->room_number)

@section('content')
    @php
        $locale = request('lang', 'uk');
        $translation = $room->translations->where('locale', $locale)->first()
                    ?? $room->translations->where('locale', 'uk')->first();
    @endphp

    <h1>{{ $locale === 'en' ? 'Room Details:' : 'Деталі номера:' }} {{ $room->room_number }}</h1>

    <div style="margin-bottom: 20px; font-weight: bold;">
        <a href="{{ request()->fullUrlWithQuery(['lang' => 'uk']) }}" style="text-decoration: {{ $locale === 'uk' ? 'underline' : 'none' }}; color: #2c3e50;">UA</a> |
        <a href="{{ request()->fullUrlWithQuery(['lang' => 'en']) }}" style="text-decoration: {{ $locale === 'en' ? 'underline' : 'none' }}; color: #2c3e50;">EN</a>
    </div>

    <ul>
        <li><strong>{{ $locale === 'en' ? 'Category:' : 'Категорія:' }}</strong> {{ $translation?->name ?? $room->type }}</li>
        <li><strong>{{ $locale === 'en' ? 'Description:' : 'Опис:' }}</strong> {{ $translation?->description ?? ($locale === 'en' ? 'No description' : 'Опис відсутній') }}</li>
        <li><strong>{{ $locale === 'en' ? 'Price:' : 'Ціна:' }}</strong> {{ $room->price }} {{ $locale === 'en' ? 'UAH/night' : 'грн/доба' }}</li>
        <li><strong>{{ $locale === 'en' ? 'Capacity:' : 'Місткість:' }}</strong> {{ $room->capacity }} {{ $locale === 'en' ? 'persons' : 'осіб' }}</li>
        <li><strong>{{ $locale === 'en' ? 'Status:' : 'Статус:' }}</strong> {{ $room->is_available ? ($locale === 'en' ? 'Available' : 'Вільний') : ($locale === 'en' ? 'Occupied' : 'Зайнятий') }}</li>
    </ul>

    <p>
        <a href="{{ route('rooms.index', ['lang' => $locale]) }}" class="btn btn-secondary">{{ $locale === 'en' ? 'Back to list' : 'Повернутися до списку' }}</a>
    </p>
@endsection
