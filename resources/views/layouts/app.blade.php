<!DOCTYPE html>
<html lang="id" class="dark scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Portofolio Resmi Nazwar Makarim Mahardhika — Siswa XI RPL 2 SMKN 1 Garut | Full-Stack Web, Mobile & IoT Developer. Siap untuk PKL & Proyek.">
    <title>@yield('title', 'Nazwar Makarim Mahardhika — Full-Stack Web & IoT Developer')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Instant Theme Evaluator to prevent layout flicker -->
    <script>
        try {
            document.documentElement.classList.toggle('dark', localStorage.getItem('theme') !== 'light');
        } catch (error) {
            document.documentElement.classList.add('dark');
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body x-data="{ cvModalOpen: false, toggleTheme() { const root = document.documentElement; root.classList.toggle('dark'); try { localStorage.setItem('theme', root.classList.contains('dark') ? 'dark' : 'light'); } catch (error) { console.warn('Theme preference could not be saved.', error); } } }" @keydown.escape.window="cvModalOpen = false" class="bg-slate-50 text-slate-800 dark:bg-slate-950 dark:text-slate-100 font-sans antialiased relative overflow-x-hidden min-h-screen transition-colors duration-300">

    <div class="dot-grid fixed inset-0 pointer-events-none opacity-40 dark:opacity-30 z-0" aria-hidden="true"></div>
    <div class="fixed top-8 -left-28 w-96 h-96 bg-teal-500/15 dark:bg-tealAccent/20 rounded-full blur-3xl pointer-events-none animate-float z-0" aria-hidden="true"></div>
    <div class="fixed bottom-10 -right-28 w-[30rem] h-[30rem] bg-cyan-400/15 dark:bg-cyanGlow/15 rounded-full blur-3xl pointer-events-none animate-float-delay z-0" aria-hidden="true"></div>

    <!-- Main Content Yield -->
    <div class="relative z-10 flex flex-col min-h-screen">
        @yield('content')
    </div>

    @stack('scripts')
</body>
</html>
