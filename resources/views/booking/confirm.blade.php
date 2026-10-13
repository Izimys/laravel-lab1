@extends('layouts.app')
@section('title', 'Заявку прийнято')
@section('content')
    <div style="background: white; padding: 30px; margin-top: 20px; text-align: center;">
        <h1 style="color: #B8860B;">Заявку успішно надіслано!</h1>
        <p>Дякуємо, <b>{{ $name }}</b>. Ми отримали ваше звернення.</p>
        <p>Найближчим часом ми відправимо підтвердження на вашу електронну адресу: <b>{{ $email }}</b>.</p>

        <div style="background: #f4f7f6; padding: 15px; margin: 20px 0; text-align: left;">
            <b>Ваші побажання:</b><br>
            {{ $message }}
        </div>

        <a href="{{ url('/') }}" style="display: inline-block; background-color: #B8860B; color: white; padding: 10px 20px; text-decoration: none;">Повернутися на головну</a>
    </div>
@endsection
