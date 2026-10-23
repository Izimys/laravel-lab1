@extends('layouts.app')
@section('title', 'Детальна статистика')
@section('content')
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 15px; font-family: sans-serif; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #f4f4f4; border-bottom: 2px solid #ccc; }
        tr:hover { background-color: #f9f9f9; }
    </style>
    <h1>Детальна статистика</h1>
    <p>
        Фільтр:
        <strong>{{ $type }}</strong>
        =
        <strong>{{ $item }}</strong>
    </p>
    <table>
        <thead>
        <tr>
            <th>Сторінка</th>
            <th>IP</th>
            <th>Браузер</th>
            <th>Статус</th>
            <th>Дата і час</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($rows as $row)
            <tr>
                <td>{{ $row->page }}</td>
                <td>{{ $row->ip }}</td>
                <td>{{ $row->user_agent }}</td>
                <td>{{ $row->status }}</td>
                <td>
                    {{ $row->visited_at->format('d.m.Y H:i:s') }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $rows->links() }}
@endsection
