@extends('layouts.app')
@section('title', 'Бронювання номера')
@section('content')
    <h1 style="color: #B8860B;">Бронювання номера</h1>
    <p>Залиште заявку, і наші менеджери зв'яжуться з вами для підтвердження.</p>

    <div style="background: white; padding: 30px; margin-top: 20px;">
        <form method="POST" action="{{ route('booking.store') }}">
            @csrf

            <div style="margin-bottom: 20px;">
                <label><b>Доступні категорії номерів:</b></label><br>
                @foreach($roomTypes as $room)
                    <label style="display: block; margin-top: 8px; cursor: pointer;">
                        <input type="radio" name="room_type" value="{{ $room }}" {{ old('room_type') == $room ? 'checked' : '' }}>
                        {{ $room }}
                    </label>
                @endforeach
                @error('room_type')
                <span style="color: red; font-size: 14px;">{{ $message }}</span>
                @enderror
            </div>

            <div style="margin-bottom: 15px;">
                <label for="name"><b>Ваше ім'я:</b></label><br>
                <input type="text" id="name" name="name" value="{{ old('name') }}" style="width: 100%; padding: 8px; margin-top: 5px;">
                @error('name')
                <span style="color: red; font-size: 14px;">{{ $message }}</span>
                @enderror
            </div>

            <div style="margin-bottom: 15px;">
                <label for="email"><b>Ваш Email:</b></label><br>
                <input type="text" id="email" name="email" value="{{ old('email') }}" style="width: 100%; padding: 8px; margin-top: 5px;">
                @error('email')
                <span style="color: red; font-size: 14px;">{{ $message }}</span>
                @enderror
            </div>

            <div style="margin-bottom: 15px; display: flex; gap: 20px;">
                <div style="flex: 1;">
                    <label for="check_in"><b>Дата заїзду:</b></label><br>
                    <input type="date" id="check_in" name="check_in" value="{{ old('check_in') }}" style="width: 100%; padding: 8px; margin-top: 5px;">
                    @error('check_in')
                    <span style="color: red; font-size: 14px;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="flex: 1;">
                    <label for="check_out"><b>Дата виїзду:</b></label><br>
                    <input type="date" id="check_out" name="check_out" value="{{ old('check_out') }}" style="width: 100%; padding: 8px; margin-top: 5px;">
                    @error('check_out')
                    <span style="color: red; font-size: 14px;">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div style="margin-bottom: 15px;">
                <label for="message"><b>Інформація (побажання, кількість осіб тощо):</b></label><br>
                <textarea id="message" name="message" rows="4" style="width: 100%; padding: 8px; margin-top: 5px; resize: none;">{{ old('message') }}</textarea>
                @error('message')
                <span style="color: red; font-size: 14px;">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" style="background-color: #2c3e50; color: white; border: none; padding: 10px 20px; font-size: 16px; cursor: pointer;">Надіслати заявку</button>
        </form>
    </div>
@endsection
