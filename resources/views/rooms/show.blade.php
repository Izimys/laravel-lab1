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

    <div style="margin-top: 20px; margin-bottom: 20px;">
        <h4>{{ $locale === 'en' ? 'Facilities (Total: ' : 'Зручності в номері (Усього: ' }}{{ $room->facilities_count }})</h4>
        @php
            $facilityTranslations = [
                'Кондиціонер' => 'Air Conditioner',
                'Міні-бар' => 'Minibar',
                'Балкон' => 'Balcony',
                'Сейф' => 'Safe box',
                'Wi-Fi' => 'Wi-Fi'
            ];
        @endphp
        @if($room->facilities->isNotEmpty())
            <div style="display: flex; gap: 10px; flex-wrap: wrap; margin-top: 10px;">
                @foreach($room->facilities as $facility)
                    <span style="background: #2c3e50; color: white; padding: 5px 12px; border-radius: 4px; font-size: 14px;">
                        {{ $locale === 'en' ? ($facilityTranslations[$facility->name] ?? $facility->name) : $facility->name }}
                    </span>
                @endforeach
            </div>
        @else
            <p style="color: #777;">{{ $locale === 'en' ? 'No facilities added yet.' : 'Зручностей поки не додано.' }}</p>
        @endif
    </div>
    <p>
    <div style="display: flex; gap: 15px; margin-top: 30px;">
        <a href="{{ route('rooms.index', ['lang' => $locale]) }}" style="background: #e2e8f0; color: #333; padding: 8px 15px; text-decoration: none; border-radius: 4px; border: 1px solid #ccc; font-weight: 500;">
            {{ $locale === 'en' ? 'Back to list' : 'Повернутися до списку' }}
        </a>

        <a href="{{ route('rooms.edit', $room) }}" style="background: #2c3e50; color: white; padding: 8px 15px; text-decoration: none; border-radius: 4px; font-weight: 500;">
            {{ $locale === 'en' ? 'Edit Room' : 'Редагувати номер' }}
        </a>
    </div>
    </p>
@endsection
