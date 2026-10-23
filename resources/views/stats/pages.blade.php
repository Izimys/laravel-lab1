@extends('layouts.app')
@section('title', 'Статистика відвідувань')
@section('content')
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 15px; font-family: sans-serif; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #f4f4f4; border-bottom: 2px solid #ccc; }
        tr:hover { background-color: #f9f9f9; }
        p a { margin-right: 15px; text-decoration: none; color: #0056b3; font-weight: bold; }
        p a:hover { text-decoration: underline; color: #d9534f; }
    </style>
    <h1>Статистика відвідувань</h1>
    <p>
        <a href="{{ route('stats.pages', ['type' => 'page']) }}">
            За сторінками
        </a>
        <a href="{{ route('stats.pages', ['type' => 'ip']) }}">
            За IP-адресами
        </a>
        <a href="{{ route('stats.pages', ['type' => 'user_agent']) }}">
            За браузерами
        </a>
    </p>
    <table>
        <thead>
        <tr>
            <th>{{ $type === 'page' ? 'Сторінка' : ($type === 'ip' ? 'IP-адреса' : 'Браузер') }}</th>
            <th>Звернень</th>
            <th>Останній візит</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($rows as $row)
            <tr>
                <td>
                    <a href="{{ route('stats.detail', [
 'type' => $type,
'item' => $row->{$type},
 ]) }}">
                        {{ $row->{$type} ?: 'Невідомо' }}
                    </a>
                </td>
                <td>{{ $row->hits }}</td>
                <td>{{ $row->last_visit }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3">
                    Даних ще немає.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection
