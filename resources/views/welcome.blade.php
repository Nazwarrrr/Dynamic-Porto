<!DOCTYPE html>
<html lang="id" class="dark scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nazwar Makarim Mahardhika — Full-Stack Web & IoT Developer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
                        cyanGlow: '#92EEFF',
                        tealAccent: '#0D9488',
                    }
                }
            }
        }
    </script>
    <style>
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(15, 23, 42, 0.08);
        }
        .dark .glass {
            background: rgba(15, 23, 42, 0.55);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(146, 238, 255, 0.14);
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px) scale(1); }
            50% { transform: translateY(-20px) scale(1.05); }
        }
        .animate-float { animation: float 8s ease-in-out infinite; }
        .animate-float-delay { animation: float 10s ease-in-out 3s infinite; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 dark:bg-navy dark:text-slate-100 font-sans antialiased relative overflow-x-hidden transition-colors duration-300">

    <!-- Floating Ambient Glow Shapes -->
    <div class="fixed top-10 -left-24 w-96 h-96 bg-teal-500/20 dark:bg-tealAccent/20 rounded-full blur-3xl pointer-events-none animate-float"></div>
    <div class="fixed bottom-10 -right-24 w-[28rem] h-[28rem] bg-cyan-400/20 dark:bg-cyanGlow/15 rounded-full blur-3xl pointer-events-none animate-float-delay"></div>

    <!-- Floating Glass Navbar -->
    <header class="fixed top-4 inset-x-0 z-50 px-4">
        <nav class="max-w-5xl mx-auto glass rounded-2xl px-5 py-3 flex items-center justify-between shadow-lg shadow-slate-900/5 dark:shadow-black/30">
            <a href="{{ route('home') }}" class="font-mono font-bold text-lg tracking-tight flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-teal-500 dark:bg-cyanGlow animate-pulse"></span>
                <span>NMM<span class="text-teal-600 dark:text-cyanGlow">.dev</span></span>
            </a>

            <div class="hidden md:flex items-center gap-6 text-sm font-medium text-slate-600 dark:text-slate-300">
                <a href="#projects" class="hover:text-teal-600 dark:hover:text-cyanGlow transition">Projects</a>
                <a href="#github" class="hover:text-teal-600 dark:hover:text-cyanGlow transition">GitHub API</a>
                <a href="#skills" class="hover:text-teal-600 dark:hover:text-cyanGlow transition">Tech Stack</a>
                <a href="#contact" class="hover:text-teal-600 dark:hover:text-cyanGlow transition">Contact</a>
            </div>

            <div class="flex items-center gap-2.5">
                <button id="theme-toggle" aria-label="Toggle Theme" class="p-2 rounded-xl glass hover:border-teal-500/50 dark:hover:border-cyanGlow/50 transition">
                    <i data-lucide="sun" class="w-4 h-4 hidden dark:block text-cyanGlow"></i>
                    <i data-lucide="moon" class="w-4 h-4 block dark:hidden text-slate-700"></i>
                </button>
                @auth
                    <a href="{{ route('admin.projects.index') }}" class="px-3.5 py-2 rounded-xl text-xs font-mono font-semibold bg-teal-600 dark:bg-cyanGlow text-white dark:text-navy hover:opacity-90 transition">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-3.5 py-2 rounded-xl text-xs font-mono font-medium glass hover:border-teal-500/50 dark:hover:border-cyanGlow/50 transition flex items-center gap-1.5">
                        <i data-lucide="lock" class="w-3.5 h-3.5"></i> Admin
                    </a>
                @endauth
            </div>
        </nav>
    </header>

    <main class="max-w-5xl mx-auto px-4 pt-32 pb-20 space-y-24 relative z-10">

        <!-- Flash Notification -->
        @if(session('success'))
            <div class="glass border-emerald-500/40 text-emerald-700 dark:text-emerald-300 px-4 py-3 rounded-xl text-sm flex items-center gap-2">
                <i data-lucide="check-circle-2" class="w-4 h-4 shrink-0"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Hero Section -->
        <section class="space-y-6 pt-4">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full glass text-xs font-mono text-teal-700 dark:text-cyanGlow">
                <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                XI RPL 2 • SMKN 1 Garut • Open for PKL & Projects
            </div>

            <h1 class="text-4xl sm:text-6xl font-extrabold tracking-tight leading-tight">
                Nazwar Makarim <br class="hidden sm:block">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-600 to-cyan-500 dark:from-cyanGlow dark:to-teal-400">
                    Full-Stack Web & IoT Dev.
                </span>
            </h1>

            <p class="max-w-2xl text-base sm:text-lg text-slate-600 dark:text-slate-300 leading-relaxed">
                Membangun aplikasi web responsif, sistem manajemen berbasis Laravel & React, hingga prototipe perangkat cerdas berbasis mikrokontroler ESP32 untuk memecahkan masalah nyata.
            </p>

            <div class="flex flex-wrap items-center gap-3 pt-2">
                <a href="#projects" class="px-5 py-3 rounded-xl font-semibold text-sm bg-teal-600 dark:bg-cyanGlow text-white dark:text-navy shadow-lg shadow-teal-500/20 dark:shadow-cyanGlow/20 hover:opacity-90 transition flex items-center gap-2">
                    <i data-lucide="folder-git-2" class="w-4 h-4"></i> Lihat Proyek
                </a>
                <a href="{{ route('api.projects') }}" target="_blank" class="px-5 py-3 rounded-xl font-mono text-xs font-medium glass hover:border-teal-500/50 dark:hover:border-cyanGlow/50 transition flex items-center gap-2">
                    <i data-lucide="braces" class="w-4 h-4 text-teal-600 dark:text-cyanGlow"></i> GET /api/projects
                </a>
            </div>
        </section>

        <!-- Dynamic Projects Showcase -->
        <section id="projects" class="space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
                <div>
                    <p class="font-mono text-xs uppercase tracking-widest text-teal-600 dark:text-cyanGlow">01 // Featured Works</p>
                    <h2 class="text-2xl sm:text-3xl font-bold mt-1">Proyek Unggulan</h2>
                </div>

                <!-- Filter Kategori Dinamis dari Database -->
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('home') }}#projects" class="px-3 py-1.5 rounded-lg text-xs font-mono transition {{ !request('category') ? 'bg-teal-600 dark:bg-cyanGlow text-white dark:text-navy font-semibold' : 'glass hover:opacity-80' }}">
                        All
                    </a>
                    @foreach($categories as $cat)
                        <a href="{{ route('home', ['category' => $cat->slug]) }}#projects" class="px-3 py-1.5 rounded-lg text-xs font-mono transition {{ request('category') == $cat->slug ? 'bg-teal-600 dark:bg-cyanGlow text-white dark:text-navy font-semibold' : 'glass hover:opacity-80' }}">
                            {{ $cat->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
                @forelse($projects as $project)
                    <article class="glass rounded-2xl overflow-hidden flex flex-col justify-between group hover:-translate-y-1 transition duration-300">
                        <div>
                            @if($project->image)
                                <div class="h-44 overflow-hidden bg-slate-900">
                                    <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                </div>
                            @else
                                <div class="h-36 bg-gradient-to-br from-teal-600/20 via-slate-800/40 to-cyan-500/20 flex items-center justify-center border-b border-white/10">
                                    <i data-lucide="layers" class="w-10 h-10 text-teal-600 dark:text-cyanGlow opacity-75"></i>
                                </div>
                            @endif

                            <div class="p-5 space-y-3">
                                <span class="inline-block px-2.5 py-0.5 rounded-md text-[11px] font-mono bg-teal-500/10 dark:bg-cyanGlow/10 text-teal-700 dark:text-cyanGlow border border-teal-500/20 dark:border-cyanGlow/20">
                                    {{ $project->category->name }}
                                </span>
                                <h3 class="text-lg font-bold leading-snug">{{ $project->title }}</h3>
                                <p class="text-sm text-slate-600 dark:text-slate-300 line-clamp-3 leading-relaxed">
                                    {{ $project->description }}
                                </p>
                            </div>
                        </div>

                        <div class="p-5 pt-0 space-y-4">
                            <div class="flex flex-wrap gap-1.5">
                                @foreach(explode(',', $project->tech_stack) as $tech)
                                    <span class="px-2 py-0.5 rounded text-[11px] font-mono bg-slate-200/70 dark:bg-slate-800/80 text-slate-700 dark:text-slate-300">
                                        {{ trim($tech) }}
                                    </span>
                                @endforeach
                            </div>

                            <div class="flex items-center gap-3 pt-2 border-t border-slate-200/60 dark:border-white/10 text-xs font-mono">
                                @if($project->demo_url && $project->demo_url !== '#')
                                    <a href="{{ $project->demo_url }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-1 text-teal-600 dark:text-cyanGlow hover:underline">
                                        <i data-lucide="external-link" class="w-3.5 h-3.5"></i> Live Demo
                                    </a>
                                @endif
                                @if($project->github_url && $project->github_url !== 'https://github.com')
                                    <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-1 text-slate-600 dark:text-slate-300 hover:underline">
                                        <i data-lucide="git-branch" class="w-3.5 h-3.5"></i> Source
                                    </a>
                                @endif
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full glass rounded-2xl p-8 text-center text-sm text-slate-500 dark:text-slate-400">
                        Belum ada proyek pada kategori ini.
                    </div>
                @endforelse
            </div>
        </section>

        <!-- Level 6: Live External GitHub REST API Integration -->
        <section id="github" class="space-y-6">
            <div>
                <p class="font-mono text-xs uppercase tracking-widest text-teal-600 dark:text-cyanGlow">02 // External REST API Integration</p>
                <h2 class="text-2xl sm:text-3xl font-bold mt-1">Live GitHub Activity</h2>
            </div>

            @if($githubProfile)
                <div class="glass rounded-2xl p-6 space-y-6">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-5 border-b border-slate-200/60 dark:border-white/10">
                        <div class="flex items-center gap-4">
                            <img src="{{ $githubProfile['avatar_url'] }}" alt="GitHub Avatar" class="w-14 h-14 rounded-2xl border border-teal-500/40 dark:border-cyanGlow/40">
                            <div>
                                <h3 class="font-bold text-lg">{{ $githubProfile['name'] ?? $githubUsername }}</h3>
                                <p class="text-xs font-mono text-slate-500 dark:text-slate-400">{{ '@' . $githubProfile['login'] }} • {{$githubProfile['bio'] ?? 'Software & IoT Developer' }}</p>
                            </div>
                        </div>
                        <div class="flex gap-3 font-mono text-xs">
                            <div class="px-3.5 py-2 rounded-xl bg-slate-200/60 dark:bg-slate-800/70 text-center">
                                <span class="block text-base font-bold text-teal-600 dark:text-cyanGlow">{{ $githubProfile['public_repos'] }}</span>
                                <span class="text-slate-500 dark:text-slate-400">Repos</span>
                            </div>
                            <div class="px-3.5 py-2 rounded-xl bg-slate-200/60 dark:bg-slate-800/70 text-center">
                                <span class="block text-base font-bold text-teal-600 dark:text-cyanGlow">{{ $githubProfile['followers'] }}</span>
                                <span class="text-slate-500 dark:text-slate-400">Followers</span>
                            </div>
                        </div>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-4">
                        @forelse($githubRepos as $repo)
                            <a href="{{ $repo['html_url'] }}" target="_blank" class="p-4 rounded-xl bg-slate-100/70 dark:bg-slate-900/60 border border-slate-200/70 dark:border-white/5 hover:border-teal-500/40 dark:hover:border-cyanGlow/40 transition block space-y-2">
                                <div class="flex items-center justify-between">
                                    <span class="font-mono font-semibold text-sm text-teal-700 dark:text-cyanGlow flex items-center gap-1.5">
                                        <i data-lucide="book-marked" class="w-3.5 h-3.5"></i> {{ $repo['name'] }}
                                    </span>
                                    <span class="text-xs font-mono text-slate-500 flex items-center gap-1">
                                        <i data-lucide="star" class="w-3 h-3"></i>
                                        {{ $repo['stargazers_count'] ?? 0 }}
                                    </span>
                                </div>
                                <p class="text-xs leading-relaxed text-slate-600 dark:text-slate-400">
                                    {{ $repo['description'] ?? 'No description provided.' }}
                                </p>
                                @if($repo['language'] ?? false)
                                    <span class="inline-block text-[11px] font-mono text-teal-700 dark:text-cyanGlow">
                                        {{ $repo['language'] }}
                                    </span>
                                @endif
                            </a>
                        @empty
                            <p class="sm:col-span-2 text-sm text-slate-500 dark:text-slate-400">
                                Belum ada repository publik yang dapat ditampilkan.
                            </p>
                        @endforelse
                    </div>
                </div>
            @else
                <div class="glass rounded-2xl p-6 text-sm text-slate-600 dark:text-slate-300">
                    Aktivitas GitHub belum dapat dimuat. Silakan coba beberapa saat lagi.
                </div>
            @endif
        </section>

        <section id="skills" class="space-y-6">
            <div>
                <p class="font-mono text-xs uppercase tracking-widest text-teal-600 dark:text-cyanGlow">03 // Tools I Use</p>
                <h2 class="text-2xl sm:text-3xl font-bold mt-1">Tech Stack</h2>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach(['Laravel & PHP', 'React & JavaScript', 'Tailwind CSS', 'MySQL & Supabase', 'ESP32 & C++', 'Git & GitHub'] as $skill)
                    <div class="glass rounded-xl px-4 py-3 flex items-center gap-3">
                        <i data-lucide="code-2" class="w-4 h-4 text-teal-600 dark:text-cyanGlow"></i>
                        <span class="text-sm font-medium">{{ $skill }}</span>
                    </div>
                @endforeach
            </div>
        </section>

        <section id="contact" class="grid md:grid-cols-2 gap-6 items-start">
            <div class="space-y-3">
                <p class="font-mono text-xs uppercase tracking-widest text-teal-600 dark:text-cyanGlow">04 // Get in Touch</p>
                <h2 class="text-2xl sm:text-3xl font-bold">Punya ide proyek?</h2>
                <p class="text-sm leading-relaxed text-slate-600 dark:text-slate-300">
                    Kirim pesan melalui formulir ini untuk membahas kolaborasi, proyek, atau kesempatan PKL.
                </p>
            </div>

            <form action="{{ route('contact.store') }}" method="POST" class="glass rounded-2xl p-5 space-y-4">
                @csrf
                <div>
                    <label for="sender_name" class="block text-xs font-mono mb-1.5">Nama</label>
                    <input id="sender_name" name="sender_name" value="{{ old('sender_name') }}" required maxlength="100" autocomplete="name"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-100/70 dark:bg-slate-900/80 border border-slate-200 dark:border-white/10 text-sm">
                    @error('sender_name')
                        <p class="mt-1 text-xs text-rose-600 dark:text-rose-300">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="sender_email" class="block text-xs font-mono mb-1.5">Email</label>
                    <input id="sender_email" type="email" name="sender_email" value="{{ old('sender_email') }}" required maxlength="100" autocomplete="email"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-100/70 dark:bg-slate-900/80 border border-slate-200 dark:border-white/10 text-sm">
                    @error('sender_email')
                        <p class="mt-1 text-xs text-rose-600 dark:text-rose-300">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="message" class="block text-xs font-mono mb-1.5">Pesan</label>
                    <textarea id="message" name="message" rows="4" required maxlength="1000"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-100/70 dark:bg-slate-900/80 border border-slate-200 dark:border-white/10 text-sm">{{ old('message') }}</textarea>
                    @error('message')
                        <p class="mt-1 text-xs text-rose-600 dark:text-rose-300">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-teal-600 dark:bg-cyanGlow text-white dark:text-navy font-semibold text-sm hover:opacity-90 transition">
                    Kirim Pesan
                </button>
            </form>
        </section>

    </main>

    <footer class="max-w-5xl mx-auto px-4 pb-8 text-center text-xs text-slate-500 dark:text-slate-400">
        © {{ date('Y') }} Nazwar Makarim Mahardhika · Dibuat dengan Laravel
    </footer>

    <script>
        const themeToggle = document.getElementById('theme-toggle');
        const root = document.documentElement;

        if (localStorage.getItem('theme') === 'light') {
            root.classList.remove('dark');
        }

        themeToggle.addEventListener('click', () => {
            root.classList.toggle('dark');
            localStorage.setItem('theme', root.classList.contains('dark') ? 'dark' : 'light');
        });

        lucide.createIcons();
    </script>
</body>
</html>
