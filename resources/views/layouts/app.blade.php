@php($isAdmin = request()->is('admin*', 'login'))
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('description', 'Portofolio Nazwar Makarim Mahardhika, siswa Rekayasa Perangkat Lunak SMKN 1 Garut. Aplikasi web dan perangkat IoT.')">
    <title>@yield('title', 'Nazwar Makarim Mahardhika — Web & IoT Developer')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,400..800&family=Instrument+Sans:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    <script>
        try {
            var t = localStorage.getItem('theme');
            document.documentElement.classList.toggle('dark', t ? t === 'dark' : matchMedia('(prefers-color-scheme: dark)').matches);
        } catch (e) {}
        window.toggleAppTheme = function () {
            var r = document.documentElement;
            r.classList.toggle('dark');
            try { localStorage.setItem('theme', r.classList.contains('dark') ? 'dark' : 'light'); } catch (e) {}
        };
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body id="top" class="flex min-h-screen flex-col bg-bg font-body text-ink antialiased">

@if($isAdmin)
    <div class="flex min-h-screen flex-col">@yield('content')</div>
@else
    <a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-[60] focus:rounded-sm focus:bg-ink focus:px-3 focus:py-2 focus:text-bg">Lewati ke konten</a>

    <header id="site-nav" class="fixed inset-x-0 top-0 z-50">
        <nav class="mx-auto flex h-16 max-w-6xl items-center justify-between px-5" aria-label="Utama">
            <a href="{{ route('home') }}" class="shrink-0 whitespace-nowrap font-display text-lg font-semibold tracking-tight">
                <span class="sm:hidden">Nazwar M.</span><span class="hidden sm:inline">Nazwar Makarim</span>
            </a>
            <div class="flex items-center gap-3 text-xs sm:gap-7 sm:text-sm">
                <a href="{{ route('home') }}#projects" class="ulink">Proyek</a>
                <a href="{{ route('home') }}#about" class="ulink">Tentang</a>
                <a href="{{ route('home') }}#contact" class="ulink">Kontak</a>
                @auth
                    <a href="{{ route('admin.projects.index') }}" class="ulink font-medium text-accent">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="ulink text-muted hover:text-ink">Admin</a>
                @endauth
                <button type="button" onclick="toggleAppTheme()" aria-label="Ganti tema" class="-mr-3 grid size-11 place-items-center rounded-full text-muted hover:text-ink">
                    <svg class="hidden size-5 dark:block" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" aria-hidden="true"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/></svg>
                    <svg class="size-5 dark:hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" aria-hidden="true"><path d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8z"/></svg>
                </button>
            </div>
        </nav>
    </header>

    <main id="main" class="flex-1">@yield('content')</main>

    <footer class="border-t border-line">
        <div class="mx-auto flex max-w-6xl flex-wrap items-center justify-between gap-3 px-5 py-8 text-sm text-muted">
            <p>© {{ date('Y') }} Nazwar Makarim Mahardhika</p>
            <div class="flex items-center gap-6">
                @auth
                    <a href="{{ route('admin.projects.index') }}" class="ulink text-accent">Panel Admin</a>
                @else
                    <a href="{{ route('login') }}" class="ulink">Masuk Admin</a>
                @endauth
                <a href="#top" class="ulink">Kembali ke atas</a>
            </div>
        </div>
    </footer>

    @if(session('success'))
        <div data-toast role="status" class="toast fixed bottom-6 left-1/2 z-50 w-[calc(100%-2.5rem)] max-w-md rounded-sm bg-ink px-5 py-3.5 text-sm text-bg shadow-lg">{{ session('success') }}</div>
    @endif
@endif

@stack('scripts')
</body>
</html>
