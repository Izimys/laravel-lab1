@extends('layouts.app')
@section('title', 'Дані прийнято')
@section('content')
    <h1>Дані прийнято</h1>
    <p>Ви ввели такі дані: </p>
    <ul>
        <li><strong>Ім'я: </strong>{{ $name }}</li>
        <li><strong>Email:</strong>{{ $email }}</li>
    </ul>
    <p>
        <a href="{{ route('entry.form') }}">Повернутися до форми</a>
    </p>
@endsection
