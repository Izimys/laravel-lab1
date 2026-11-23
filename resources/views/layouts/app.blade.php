<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Готель')</title>
    <style>
        /* налаштування шрифту та фону */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f4f7f6;
            color: #333;
        }

        /* темна панель навігації */
        header {
            background-color: #2c3e50;
            padding: 15px 20px;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin-right: 15px;
            font-size: 16px;
        }

        nav a:hover {
            text-decoration: underline;
        }

        nav form {
            display: inline;
            margin: 0;
        }

        nav button {
            background-color: transparent;
            border: 1px solid rgba(255, 255, 255, 0.65);
            color: #ffffff;
            padding: 5px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            white-space: nowrap;
        }

        nav button:hover {
            background-color: rgba(255, 255, 255, 0.15);
        }

        nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .nav-left,
        .nav-right {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .nav-right {
            margin-left: auto;
        }

        .nav-user {
            color: #e2e8f0;
            font-size: 15px;
            font-weight: 600;
            white-space: nowrap;
        }

        /* центральний блок */
        main {
            padding: 30px 20px;
            max-width: 800px;
            margin: 0 auto;
            min-height: 65vh;
        }

        /* футер знизу */
        footer {
            background-color: #dde1e3;
            text-align: center;
            padding: 15px;
        }
        .blog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px;
            margin: 24px 0;
        }
        .blog-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            background-color: #fff; /* Білий фон картки для контрасту */
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .blog-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
        }
        .blog-card-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }
        .blog-card-body {
            padding: 16px;
        }
        .blog-category {
            font-size: 13px;
            color: #2563eb;
        }
        .blog-meta {
            font-size: 13px;
            color: #666;
        }
    </style>

    @vite([
    'resources/css/app.css',
    'resources/js/app.js'
    ])

</head>
<body>
<header>
    <nav>
        <div class="nav-left">
            <a href="{{ url('/') }}">Головна</a>
            <a href="{{ url('/rooms') }}">Номери</a>
            <a href="{{ url('/booking') }}">Бронювання</a>
            <a href="{{ url('/contact') }}">Контакти</a>
            <a href="{{ url('/about') }}">Про застосунок</a>
            <a href="{{ route('country.index') }}">Країни</a>
            <a href="{{ url('/blog') }}">Блог</a>

            @auth
                <a href="{{ route('stats.pages') }}">Статистика</a>
                <a href="{{ route('rooms.admin') }}">Адміністрування номерів</a>
                <a href="{{ route('blog.admin') }}">Керування блогом</a>
                <a href="{{ route('users.index') }}">Користувачі</a>
            @endauth
        </div>

        <div class="nav-right">
            @auth
                <span class="nav-user">{{ auth()->user()->name }}</span>
                <a href="{{ route('profile.edit') }}">Мій профіль</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Вийти</button>
                </form>
            @endauth

            @guest
                <a href="{{ route('login') }}">Увійти</a>
                <a href="{{ route('register') }}">Реєстрація</a>
            @endguest
        </div>
    </nav>
</header>
<main>
    @yield('content')
</main>
<footer>
    <p>Готель "Luxury⭐" &copy; {{ date('Y') }}</p>
    <p>Виконав: Швець Б. С., група РС-31</p>
</footer>
</body>
</html>
