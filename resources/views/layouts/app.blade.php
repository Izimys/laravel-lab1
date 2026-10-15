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
    </style>
</head>
<body>
<header>
    <nav>
        <a href="{{ url('/') }}">Головна</a>
        <a href="{{ url('/rooms') }}">Номери</a>
        <a href="{{ url('/booking') }}">Бронювання</a>
        <a href="{{ url('/contact') }}">Контакти</a>
        <a href="{{ url('/about') }}">Про застосунок</a>
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
