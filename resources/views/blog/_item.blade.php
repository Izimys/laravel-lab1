<article class="blog-card">
    <a href="{{ route('blog.show', $blog) }}">
        <img
            src="{{ asset('images/blog-placeholder.jpg') }}"
            alt="{{ $blog->title }}"
            class="blog-card-image"
        >
    </a>
    <div class="blog-card-body">
        <span class="blog-category">
            {{ $blog->category?->category_name ?? 'Без категорії' }}
        </span>
        <h2>
            <a href="{{ route('blog.show', $blog) }}">
                {{ $blog->title }}
            </a>
        </h2>
        <p class="blog-meta">
            Автор: {{ $blog->author?->name ?? 'Редакція' }} &middot;
            {{ $blog->dt_created->format('d.m.Y') }}
        </p>
        <p>
            {{ Str::limit($blog->description, 120) }}
        </p>
        <a href="{{ route('blog.show', $blog) }}">Читати далі</a>
    </div>
</article>
