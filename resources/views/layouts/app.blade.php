<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name'))</title>
    <meta name="description" content="@yield('description', '')">

    {{-- اعمال تم تاریک قبل از رندر برای جلوگیری از پرش رنگ --}}
    <script>
        (function () {
            if (localStorage.getItem('theme') === 'dark') {
                document.documentElement.setAttribute('data-theme', 'dark');
            }
        })();
    </script>

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @stack('styles')
</head>
<body>
    <nav class="navbar">
        <a href="{{ route('home') }}" class="navbar-brand" style="display:flex; align-items:center; gap:10px;">
            <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}"
                 style="height:40px; width:40px; border-radius:8px; object-fit:cover;">
            <span>{{ config('app.name') }}</span>
        </a>

        <ul class="nav-links">
            <li><a href="{{ route('home') }}">خانه</a></li>
            <li><a href="{{ route('projects.index') }}">نمونه‌کارها</a></li>
            <li><a href="{{ route('blog.index') }}">بلاگ</a></li>
            <li><a href="{{ route('notes.index') }}">یادداشت‌ها</a></li>
        </ul>

        <div class="navbar-actions">
            <button class="theme-toggle-btn" id="themeToggle" aria-label="تغییر حالت">🌙</button>
            <button class="menu-toggle" id="menuToggle" aria-label="منو">☰</button>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer style="text-align:center; padding:20px; background:var(--nav-bg); border-top:1px solid var(--border-color); color:var(--text-color); font-size:0.85rem;">
        <p>&copy; {{ date('Y') }} {{ config('app.name') }} — ساخته‌شده با ❤️</p>
    </footer>

    <script src="{{ asset('assets/js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>