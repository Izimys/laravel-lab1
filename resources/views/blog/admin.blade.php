@extends('layouts.app')
@section('title', 'Адміністрування блогу')
@section('content')
    <style>
        .admin-table { width: 100%; border-collapse: collapse; margin-top: 15px; background: #fff; }
        .admin-table th, .admin-table td { border: 1px solid #cbd5e1; padding: 10px; text-align: left; }
        .admin-table th { background-color: #f8fafc; font-weight: bold; }
        .tag { display: inline-block; background: #2c3e50; color: #fff; padding: 3px 8px; border-radius: 4px; font-size: 12px; margin: 2px 2px 0 0; }
        .actions-group { display: flex; gap: 10px; align-items: center; }
        .filter-form { display: flex; gap: 15px; flex-wrap: wrap; margin-bottom: 20px; align-items: flex-end; background: #f8fafc; padding: 15px; border-radius: 8px; border: 1px solid #e2e8f0; }
        .filter-form label { display: block; font-size: 12px; font-weight: bold; margin-bottom: 5px; color: #475569; }
        .filter-form input, .filter-form select { padding: 8px; border: 1px solid #cbd5e1; border-radius: 4px; font-size: 14px; min-width: 150px; }
        .btn-primary { background: #2c3e50; color: white; padding: 9px 15px; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; font-size: 14px; }
        .btn-secondary { display: inline-block; padding: 9px 15px; text-decoration: none; color: #475569; background: #e2e8f0; border-radius: 4px; font-size: 14px; }
    </style>

    <h1>Адміністрування блогу</h1>
    <p style="margin-bottom: 20px;">
        <a href="{{ route('blog.create') }}" class="btn-primary">
            Додати запис
        </a>
    </p>

    <form method="GET" action="{{ route('blog.admin') }}" class="filter-form">
        <div>
            <label for="title">Заголовок</label>
            <input type="text" id="title" name="title" value="{{ request('title') }}" placeholder="Пошук за заголовком">
        </div>

        <div>
            <label for="categoryName">Назва категорії</label>
            <input type="text" id="categoryName" name="categoryName" value="{{ request('categoryName') }}" placeholder="Назва категорії">
        </div>

        <div>
            <label for="category_id">Категорія</label>
            <select id="category_id" name="category_id" onchange="this.form.submit()">
                <option value="">Усі категорії</option>
                @foreach ($categories as $id => $name)
                    <option value="{{ $id }}" @selected(request('category_id') == $id)>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="filter_id">Мітка</label>
            <select id="filter_id" name="filter_id" onchange="this.form.submit()">
                <option value="">Усі мітки</option>
                @foreach ($filters as $id => $name)
                    <option value="{{ $id }}" @selected(request('filter_id') == $id)>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>

        <input type="hidden" name="sort" value="{{ request('sort') }}">

        <div style="display: flex; gap: 10px;">
            <button type="submit" class="btn-primary">Знайти</button>
            <a href="{{ route('blog.admin') }}" class="btn-secondary">Скинути</a>
        </div>
    </form>

    <table class="admin-table">
        <thead>
        <tr>
            <th>№</th>
            @php
                $currentSort = request('sort');
                $titleSort = $currentSort === 'title' ? '-title' : 'title';
                $catSort = $currentSort === 'categoryName' ? '-categoryName' : 'categoryName';
                $dateSort = $currentSort === 'created' ? '-created' : 'created';
            @endphp
            <th>
                <a href="{{ route('blog.admin', array_merge(request()->except('sort', 'page'), ['sort' => $titleSort])) }}" style="color: inherit; text-decoration: none;">
                    Заголовок
                    @if ($currentSort === 'title') ↑ @elseif ($currentSort === '-title') ↓ @endif
                </a>
            </th>
            <th>
                <a href="{{ route('blog.admin', array_merge(request()->except('sort', 'page'), ['sort' => $catSort])) }}" style="color: inherit; text-decoration: none;">
                    Категорія
                    @if ($currentSort === 'categoryName') ↑ @elseif ($currentSort === '-categoryName') ↓ @endif
                </a>
            </th>
            <th>Мітки</th>
            <th>
                <a href="{{ route('blog.admin', array_merge(request()->except('sort', 'page'), ['sort' => $dateSort])) }}" style="color: inherit; text-decoration: none;">
                    Дата
                    @if ($currentSort === 'created') ↑ @elseif ($currentSort === '-created') ↓ @endif
                </a>
            </th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($blogs as $i => $blog)
            <tr>
                <td>{{ $blogs->firstItem() + $i }}</td>
                <td>
                    <a href="{{ route('blog.show', $blog) }}" style="color: #2c3e50; text-decoration: none; font-weight: 500;">
                        {{ $blog->title }}
                    </a>
                </td>
                <td>
                    {{ $blog->category?->category_name ?? '—' }}
                </td>
                <td>
                    @forelse ($blog->filters as $filter)
                        <span class="tag">
                            {{ $filter->filter_name }}
                        </span>
                    @empty
                        —
                    @endforelse
                </td>
                <td>
                    {{ $blog->dt_created->format('d.m.Y') }}
                </td>
                <td>
                    <div class="actions-group">
                        <a href="{{ route('blog.edit', $blog) }}" style="text-decoration: none; color: #0369a1;">
                            Редагувати
                        </a>
                        <form method="POST" action="{{ route('blog.destroy', $blog) }}" style="margin: 0;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; border: none; color: #b91c1c; cursor: pointer; padding: 0;">Видалити</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" style="text-align: center; color: #64748b;">Записів немає.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $blogs->links() }}
    </div>
@endsection
