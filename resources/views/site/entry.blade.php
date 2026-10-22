@extends('layouts.app')
@section('title', 'Форма введення даних')
@section('content')
    <h1>Форма введення даних</h1>
    <form method="POST" action="{{ route('entry.store') }}">
        @csrf
        <div>
            <label for="name">Ім'я</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}">
            @error('name')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="email">Email</label>
            <input type="text" id="email" name="email" value="{{ old('email') }}">
            @error('email')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit">Надіслати</button>
    </form>
@endsection
