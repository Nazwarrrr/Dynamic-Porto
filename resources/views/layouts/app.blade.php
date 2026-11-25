<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
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

    @if(!request()->is('admin*') && !request()->is('login'))
    <!-- Cyber Dev Boot Loader (Instant ~0.9s Snappy Intro) -->
    <div id="cyber-preloader" class="fixed inset-0 z-[9999] flex flex-col items-center justify-center bg-slate-950 font-mono text-cyan-300 transition-all duration-500 ease-out">
        <div class="relative flex flex-col items-center max-w-xs sm:max-w-sm px-6 text-center space-y-4">
            <!-- Glowing Monogram Card -->
            <div class="relative flex items-center justify-center w-16 h-16 rounded-2xl bg-slate-900 border border-cyan-400/30 shadow-[0_0_35px_rgba(34,211,238,0.25)]">
                <span class="text-xl font-bold tracking-widest text-cyan-300 font-mono">NMM</span>
                <span class="absolute -top-1 -right-1 flex h-3 w-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-cyan-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-teal-400"></span>
                </span>
            </div>

            <!-- Terminal Status Text -->
            <div class="space-y-1.5">
                <p id="boot-title" class="text-xs font-semibold uppercase tracking-wider text-slate-200">
                    Nazwar Makarim M.
                </p>
                <div class="flex items-center justify-center gap-2 text-[11px] text-cyan-400/90 font-mono">
                    <span class="inline-block w-1.5 h-1.5 rounded-full bg-cyan-400 animate-pulse"></span>
                    <span id="boot-status">&gt; BOOTING KERNEL...</span>
                </div>
            </div>

            <!-- Micro Progress Bar -->
            <div class="w-48 sm:w-56 h-1 rounded-full bg-slate-800/80 border border-cyan-400/20 overflow-hidden shadow-inner">
                <div id="boot-progress" class="h-full w-0 bg-gradient-to-r from-teal-400 via-cyan-300 to-emerald-400 transition-all duration-300 ease-out"></div>
            </div>

            <!-- Subtitle Version Tag -->
            <p class="text-[10px] text-slate-500 font-mono tracking-tight">
                SYS.VER 2.4.0 · XI RPL 2 · READY
            </p>
        </div>
    </div>

    <script>
        (function() {
            const preloader = document.getElementById('cyber-preloader');
            if (!preloader) return;

            // Jika user sudah pernah membuka web dalam sesi browser ini, langsung sembunyikan
            if (sessionStorage.getItem('nmm_visited')) {
                preloader.style.display = 'none';
                return;
            }

            const statusText = document.getElementById('boot-status');
            const progressBar = document.getElementById('boot-progress');

            // Timeline Animasi Cepat (~0.9 Detik Total)
            setTimeout(() => {
                if (progressBar) progressBar.style.width = '65%';
                if (statusText) statusText.textContent = '> LOADING IOT & WEB MODULES...';
            }, 220);

            setTimeout(() => {
                if (progressBar) progressBar.style.width = '100%';
                if (statusText) {
                    statusText.textContent = '> [OK] ACCESS GRANTED';
                    statusText.classList.add('text-emerald-400');
                }
            }, 550);

            setTimeout(() => {
                preloader.classList.add('opacity-0', 'scale-105', 'pointer-events-none');
                sessionStorage.setItem('nmm_visited', 'true');
                setTimeout(() => {
                    preloader.remove();
                }, 500);
            }, 880);
        })();
    </script>
    @endif

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
