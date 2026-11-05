<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name'))</title>
    <meta name="description" content="@yield('description', '')">
</head>
<body>
    <header>
        <nav>
            <a href="{{ route('home') }}">{{ config('app.name') }}</a>
            <a href="{{ route('projects.index') }}">نمونه‌کارها</a>
            <a href="{{ route('blog.index') }}">بلاگ</a>
            <a href="{{ route('notes.index') }}">یادداشت‌ها</a>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} {{ config('app.name') }}</p>
    </footer>
</body>
</html>