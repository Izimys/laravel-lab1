@extends('layouts.app')

@section('title', 'Користувачі системи')

@section('content')
    <style>
        .users-card {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            box-shadow: 0 4px 14px rgba(15, 23, 42, 0.06);
            overflow: hidden;
        }

        .users-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 24px;
            border-bottom: 1px solid #e2e8f0;
            background-color: #f8fafc;
        }

        .users-title {
            margin: 0;
            font-size: 20px;
            font-weight: 600;
            color: #1e293b;
        }

        .users-badge {
            background-color: #2c3e50;
            color: #ffffff;
            font-size: 13px;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 999px;
        }

        .users-table-wrap {
            overflow-x: auto;
        }

        .users-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 15px;
        }

        .users-table th,
        .users-table td {
            padding: 12px 20px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
            white-space: nowrap;
        }

        .users-table thead th {
            background-color: #f1f5f9;
            color: #334155;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .users-table tbody tr:nth-child(even) {
            background-color: #f8fafc;
        }

        .users-table tbody tr:hover {
            background-color: #eef2ff;
        }

        .users-table tbody tr:last-child td {
            border-bottom: none;
        }

        .user-num {
            color: #64748b;
            font-weight: 600;
            width: 60px;
        }

        .user-name {
            font-weight: 500;
            color: #0f172a;
        }

        .user-date {
            color: #475569;
        }
    </style>

    <div class="users-card">
        <div class="users-header">
            <h1 class="users-title">Користувачі системи</h1>
            <span class="users-badge">Всього: {{ $users->count() }}</span>
        </div>

        <div class="users-table-wrap">
            <table class="users-table">
                <thead>
                <tr>
                    <th class="user-num">№</th>
                    <th>Ім'я</th>
                    <th>Зареєстровано</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($users as $index => $user)
                    <tr>
                        <td class="user-num">{{ $index + 1 }}</td>
                        <td class="user-name">{{ $user->name }}</td>
                        <td class="user-date">{{ optional($user->created_at)->format('d.m.Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="text-align: center; color: #64748b; padding: 24px;">
                            Користувачів ще немає.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
