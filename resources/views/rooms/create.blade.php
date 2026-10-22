@extends('layouts.app')

@section('title', 'Додати новий номер')

@section('content')
    <div style="max-width: 500px; margin: 0 auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <h2>Додати новий номер</h2>

        @if ($errors->any())
            <div style="color: red; margin-bottom: 15px; padding: 10px; border: 1px solid red; border-radius: 5px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('rooms.store') }}" method="POST">
            @csrf

            <div style="margin-bottom: 15px;">
                <label style="font-weight: bold;">Номер кімнати:</label><br>
                <input type="text" name="room_number" value="{{ old('room_number') }}" style="width: 100%; padding: 8px; box-sizing: border-box;" required>
            </div>

            <div style="margin-bottom: 15px;">
                <label style="font-weight: bold;">Категорія:</label><br>
                <input type="text" name="type" value="{{ old('type') }}" style="width: 100%; padding: 8px; box-sizing: border-box;" required>
            </div>

            <div style="margin-bottom: 15px;">
                <label style="font-weight: bold;">Ціна (грн):</label><br>
                <input type="number" name="price" value="{{ old('price') }}" style="width: 100%; padding: 8px; box-sizing: border-box;" required>
            </div>

            <div style="margin-bottom: 15px;">
                <label style="font-weight: bold;">Місткість (осіб):</label><br>
                <input type="number" name="capacity" value="{{ old('capacity') }}" style="width: 100%; padding: 8px; box-sizing: border-box;" required>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="font-weight: bold;">Статус:</label><br>
                <select name="is_available" style="width: 100%; padding: 8px; box-sizing: border-box;">
                    <option value="1">Вільний</option>
                    <option value="0">Зайнятий</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary" style="padding: 10px 20px; cursor: pointer;">Зберегти номер</button>
            <a href="{{ route('rooms.index') }}" style="margin-left: 15px; color: #7f8c8d; text-decoration: none;">Скасувати</a>
        </form>
    </div>
@endsection
