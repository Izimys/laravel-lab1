@extends('layouts.app')
@section('title', 'Керування мітками')
@section('content')

    <style>
        .bootstrap-duallistbox-container {
            display: flex;
            gap: 20px;
            max-width: 100%;
            align-items: stretch;
        }
        .bootstrap-duallistbox-container .box1,
        .bootstrap-duallistbox-container .box2 {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
        }
        .bootstrap-duallistbox-container select {
            width: 100%;
            height: 190px;
            margin-top: 5px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .bootstrap-duallistbox-container .buttons {
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 5px;
            width: 40px;
        }
        .bootstrap-duallistbox-container .buttons button {
            padding: 5px;
            background-color: #2c3e50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .bootstrap-duallistbox-container .buttons button:hover {
            background-color: #1a252f;
        }
        .filter {
            margin-bottom: 5px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
            box-sizing: border-box;
        }
    </style>

    <h1>Мітки: {{ $blog->title }}</h1>

    <form method="POST" action="{{ route('blog.tags.store', $blog) }}" style="margin-top: 20px;">
        @csrf
        <label for="duallist" style="display:block; margin-bottom: 15px; font-weight: bold; font-size: 18px;">
            Оберіть мітки запису
        </label>

        <select id="duallist" name="filters[]" multiple>
            @foreach ($filters as $id => $name)
                <option
                    value="{{ $id }}"
                    @selected(in_array($id, old('filters', $selected)))
                >
                    {{ $name }}
                </option>
            @endforeach
        </select>

        <button type="submit" style="margin-top: 25px; padding: 10px 20px; background-color: #2c3e50; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px;">
            Зберегти мітки
        </button>
    </form>

@endsection
