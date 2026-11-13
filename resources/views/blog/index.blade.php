@extends('layouts.app')
@section('title', 'Блог')
@section('content')
    <h1>Блог</h1>
    <nav class="blog-filters" style="margin-bottom: 20px; display: flex; flex-wrap: wrap; gap: 10px;">
        <a href="{{ route('blog.index') }}" style="padding: 5px 12px; background: #e2e8f0; border-radius: 4px; text-decoration: none; color: #333;">
            Усі записи
        </a>
        @foreach ($filters as $id => $name)
            <a href="{{ route('blog.index', ['filter' => $id]) }}" style="padding: 5px 12px; background: {{ request('filter') == $id ? '#2c3e50' : '#e2e8f0' }}; color: {{ request('filter') == $id ? '#fff' : '#333' }}; border-radius: 4px; text-decoration: none;">
                {{ $name }}
            </a>
        @endforeach
    </nav>
    <div class="blog-grid">
        @forelse ($blogs as $blog)
            @include('blog._item', ['blog' => $blog])
        @empty
            <p>Записів поки немає.</p>
        @endforelse
    </div>
    {{ $blogs->links() }}
@endsection
