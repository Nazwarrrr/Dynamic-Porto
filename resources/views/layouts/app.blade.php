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

    <!-- Tailwind CSS (CDN with Custom Config) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        mono: ['"JetBrains Mono"', 'monospace'],
                    },
                    colors: {
                        navy: '#0B1120',
                        navyLight: '#111827',
                        cyanGlow: '#92EEFF',
                        tealAccent: '#0D9488',
                    },
                    boxShadow: {
                        'neon': '0 0 25px -5px rgba(146, 238, 255, 0.25)',
                        'neon-teal': '0 0 25px -5px rgba(13, 148, 136, 0.3)',
                    }
                }
            }
        }
    </script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Instant Theme Evaluator to prevent layout flicker -->
    <script>
        if (localStorage.getItem('theme') === 'light') {
            document.documentElement.classList.remove('dark');
        } else {
            document.documentElement.classList.add('dark');
        }
    </script>

    <style>
        /* Glassmorphism Styles */
        .glass {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(15, 23, 42, 0.08);
        }
        .dark .glass {
            background: rgba(15, 23, 42, 0.65);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(146, 238, 255, 0.12);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(15, 23, 42, 0.06);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .dark .glass-card {
            background: rgba(15, 23, 42, 0.55);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(146, 238, 255, 0.08);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .glass-card:hover {
            border-color: rgba(146, 238, 255, 0.35);
            transform: translateY(-3px);
            box-shadow: 0 12px 30px -10px rgba(0, 0, 0, 0.2);
        }
        .dark .glass-card:hover {
            box-shadow: 0 12px 35px -10px rgba(146, 238, 255, 0.15);
        }

        /* Ambient floating animations */
        @keyframes float {
            0%, 100% { transform: translateY(0px) scale(1); }
            50% { transform: translateY(-18px) scale(1.03); }
        }
        .animate-float { animation: float 9s ease-in-out infinite; }
        .animate-float-delay { animation: float 11s ease-in-out 3s infinite; }

        /* Scroll Reveal Utility */
        .reveal {
            opacity: 0;
            transform: translateY(22px);
            transition: opacity 0.7s cubic-bezier(0.16, 1, 0.3, 1), transform 0.7s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }
        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: rgba(146, 238, 255, 0.2);
            border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(146, 238, 255, 0.4);
        }
    </style>
    @stack('styles')
</head>
<body class="bg-slate-50 text-slate-800 dark:bg-navy dark:text-slate-100 font-sans antialiased relative overflow-x-hidden min-h-screen transition-colors duration-300">

    <!-- Ambient Glowing Shapes in Background -->
    <div class="fixed top-8 -left-28 w-96 h-96 bg-teal-500/15 dark:bg-tealAccent/20 rounded-full blur-3xl pointer-events-none animate-float z-0"></div>
    <div class="fixed bottom-10 -right-28 w-[30rem] h-[30rem] bg-cyan-400/15 dark:bg-cyanGlow/15 rounded-full blur-3xl pointer-events-none animate-float-delay z-0"></div>

    <!-- Main Content Yield -->
    <div class="relative z-10 flex flex-col min-h-screen">
        @yield('content')
    </div>

    <!-- Theme Toggle Helper & Lucide Init -->
    <script>
        function toggleAppTheme() {
            const root = document.documentElement;
            root.classList.toggle('dark');
            const isDark = root.classList.contains('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        }

        // Global Event for Lucide & Reveal Observer
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }

            // Scroll Reveal Observer
            const reveals = document.querySelectorAll('.reveal');
            if ('IntersectionObserver' in window && reveals.length > 0) {
                const revealObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('active');
                            observer.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.1,
                    rootMargin: '0px 0px -40px 0px'
                });

                reveals.forEach(el => revealObserver.observe(el));
            } else {
                reveals.forEach(el => el.classList.add('active'));
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
