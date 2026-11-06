<div style="margin-bottom: 15px;">
    <label for="category_id" style="display: block; margin-bottom: 5px; font-weight: bold;">Категорія</label>
    <select id="category_id" name="category_id" style="width: 100%; padding: 8px;">
        <option value="">— Без категорії —</option>
        @foreach ($categories as $id => $name)
            <option
                value="{{ $id }}"
                @selected(
                old('category_id', $blog->category_id ?? '') == $id
                )
            >
                {{ $name }}
            </option>
        @endforeach
    </select>
    @error('category_id')
    <p class="error" style="color: red; margin-top: 5px;">{{ $message }}</p>
    @enderror
</div>

<div style="margin-bottom: 15px;">
    <label for="filters" style="display: block; margin-bottom: 5px; font-weight: bold;">Мітки</label>
    <select id="filters" name="filters[]" multiple style="width: 100%; padding: 8px;">
        @foreach ($filters as $id => $name)
            <option
                value="{{ $id }}"
                @selected(
                in_array(
                $id,
                old('filters', $selected ?? [])
                )
                )
            >
                {{ $name }}
            </option>
        @endforeach
    </select>
    @error('filters')
    <p class="error" style="color: red; margin-top: 5px;">{{ $message }}</p>
    @enderror
</div>

<div style="margin-bottom: 15px;">
    <label for="title" style="display: block; margin-bottom: 5px; font-weight: bold;">Заголовок</label>
    <input
        type="text"
        id="title"
        name="title"
        value="{{ old('title', $blog->title ?? '') }}"
        style="width: 100%; padding: 8px;"
    >
    @error('title')
    <p class="error" style="color: red; margin-top: 5px;">{{ $message }}</p>
    @enderror
</div>

<div style="margin-bottom: 15px;">
    <label for="description" style="display: block; margin-bottom: 5px; font-weight: bold;">Короткий опис</label>
    <input
        type="text"
        id="description"
        name="description"
        value="{{ old('description', $blog->description ?? '') }}"
        style="width: 100%; padding: 8px;"
    >
    @error('description')
    <p class="error" style="color: red; margin-top: 5px;">{{ $message }}</p>
    @enderror
</div>

<div style="margin-bottom: 15px;">
    <label for="text" style="display: block; margin-bottom: 5px; font-weight: bold;">Текст запису</label>
    <textarea id="text" name="text" rows="5" style="width: 100%; padding: 8px;">{{ old('text', $blog->text ?? '') }}</textarea>
    @error('text')
    <p class="error" style="color: red; margin-top: 5px;">{{ $message }}</p>
    @enderror
</div>
