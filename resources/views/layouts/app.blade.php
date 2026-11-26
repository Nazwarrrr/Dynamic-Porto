<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Portofolio Nazwar Makarim Mahardhika — Siswa XI RPL SMKN 1 Garut | Pengembangan Web & Perangkat IoT.">
    <title>@yield('title', 'Nazwar Makarim Mahardhika — Web & IoT Developer')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script>
        try {
            const t = localStorage.getItem('theme');
            document.documentElement.classList.toggle('dark',
                t ? t === 'dark' : matchMedia('(prefers-color-scheme: dark)').matches);
        } catch (e) {}
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body x-data="{ cvModalOpen: false, toggleTheme() { const root = document.documentElement; root.classList.toggle('dark'); try { localStorage.setItem('theme', root.classList.contains('dark') ? 'dark' : 'light'); } catch (error) {} } }" @keydown.escape.window="cvModalOpen = false" class="bg-bg text-ink font-sans antialiased min-h-screen transition-colors duration-200">

    <div class="relative flex flex-col min-h-screen">
        @yield('content')
    </div>

    @stack('scripts')
</body>
</html>
