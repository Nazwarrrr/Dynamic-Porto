@extends('layouts.app')

@section('title', 'Nazwar Makarim Mahardhika — Full-Stack Web & IoT Developer | XI RPL 2 SMKN 1 Garut')

@section('content')

    <!-- Floating Glass Navbar with Scroll-Spy & Mobile Menu -->
    <header class="fixed top-3 inset-x-0 z-50 px-4">
        <nav class="max-w-6xl mx-auto glass rounded-2xl px-5 py-3.5 flex items-center justify-between shadow-lg shadow-slate-900/5 dark:shadow-black/40">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="font-mono font-bold text-lg tracking-tight flex items-center gap-2 group">
                <span class="w-2.5 h-2.5 rounded-full bg-teal-500 dark:bg-cyanGlow animate-pulse"></span>
                <span>NMM<span class="text-teal-600 dark:text-cyanGlow group-hover:underline">.dev</span></span>
            </a>

            <!-- Desktop Nav Links (with Scroll-Spy classes) -->
            <div class="hidden md:flex items-center gap-6 text-sm font-medium text-slate-600 dark:text-slate-300" id="desktop-nav-links">
                <a href="#projects" class="nav-link hover:text-teal-600 dark:hover:text-cyanGlow transition">Proyek</a>
                <a href="#skills" class="nav-link hover:text-teal-600 dark:hover:text-cyanGlow transition">Tech Stack</a>
                <a href="#experience" class="nav-link hover:text-teal-600 dark:hover:text-cyanGlow transition">Rekam Jejak</a>
                <a href="#github" class="nav-link hover:text-teal-600 dark:hover:text-cyanGlow transition">GitHub API</a>
                <a href="#contact" class="nav-link hover:text-teal-600 dark:hover:text-cyanGlow transition">Kontak</a>
            </div>

            <!-- Action Controls (Theme Toggle, Admin Portal, Mobile Hamburger) -->
            <div class="flex items-center gap-2.5">
                <!-- Theme Toggle Button -->
                <button type="button" onclick="toggleAppTheme()" aria-label="Ganti Tema" class="p-2 rounded-xl glass hover:border-teal-500/50 dark:hover:border-cyanGlow/50 transition">
                    <i data-lucide="sun" class="w-4 h-4 hidden dark:block text-cyanGlow"></i>
                    <i data-lucide="moon" class="w-4 h-4 block dark:hidden text-slate-700"></i>
                </button>

                @auth
                    <a href="{{ route('admin.projects.index') }}" class="px-3.5 py-2 rounded-xl text-xs font-mono font-semibold bg-teal-600 dark:bg-cyanGlow text-white dark:text-navy hover:opacity-90 transition shadow-sm">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-3 py-2 rounded-xl text-xs font-mono font-medium glass hover:border-teal-500/50 dark:hover:border-cyanGlow/50 transition flex items-center gap-1.5">
                        <i data-lucide="lock" class="w-3.5 h-3.5 text-teal-600 dark:text-cyanGlow"></i> <span class="hidden sm:inline">Admin</span>
                    </a>
                @endauth

                <!-- Hamburger Button (Mobile Only) -->
                <button type="button" id="mobile-menu-btn" aria-label="Buka Menu" class="md:hidden p-2 rounded-xl glass hover:border-teal-500/50 dark:hover:border-cyanGlow/50 transition">
                    <i data-lucide="menu" id="hamburger-icon" class="w-5 h-5"></i>
                    <i data-lucide="x" id="close-icon" class="w-5 h-5 hidden"></i>
                </button>
            </div>
        </nav>

        <!-- Mobile Nav Menu Dropdown -->
        <div id="mobile-menu" class="hidden md:hidden max-w-6xl mx-auto mt-2 glass rounded-2xl p-4 shadow-xl border border-teal-500/20 dark:border-cyanGlow/20 flex-col gap-3 font-mono text-sm">
            <a href="#projects" class="mobile-nav-link py-2 px-3 rounded-lg hover:bg-teal-500/10 dark:hover:bg-cyanGlow/10 transition flex items-center gap-2">
                <i data-lucide="folder-git-2" class="w-4 h-4 text-teal-600 dark:text-cyanGlow"></i> Proyek
            </a>
            <a href="#skills" class="mobile-nav-link py-2 px-3 rounded-lg hover:bg-teal-500/10 dark:hover:bg-cyanGlow/10 transition flex items-center gap-2">
                <i data-lucide="cpu" class="w-4 h-4 text-teal-600 dark:text-cyanGlow"></i> Tech Stack
            </a>
            <a href="#experience" class="mobile-nav-link py-2 px-3 rounded-lg hover:bg-teal-500/10 dark:hover:bg-cyanGlow/10 transition flex items-center gap-2">
                <i data-lucide="award" class="w-4 h-4 text-teal-600 dark:text-cyanGlow"></i> Rekam Jejak
            </a>
            <a href="#github" class="mobile-nav-link py-2 px-3 rounded-lg hover:bg-teal-500/10 dark:hover:bg-cyanGlow/10 transition flex items-center gap-2">
                <i data-lucide="git-branch" class="w-4 h-4 text-teal-600 dark:text-cyanGlow"></i> GitHub API
            </a>
            <a href="#contact" class="mobile-nav-link py-2 px-3 rounded-lg hover:bg-teal-500/10 dark:hover:bg-cyanGlow/10 transition flex items-center gap-2">
                <i data-lucide="mail" class="w-4 h-4 text-teal-600 dark:text-cyanGlow"></i> Kontak
            </a>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-4 pt-28 pb-20 space-y-24">

        <!-- Flash Message Notification -->
        @if(session('success'))
            <div class="glass border-emerald-500/40 text-emerald-700 dark:text-emerald-300 px-5 py-3.5 rounded-2xl text-sm flex items-center justify-between shadow-lg">
                <div class="flex items-center gap-3">
                    <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-500 shrink-0"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-xs font-mono text-emerald-600 hover:underline">Tutup</button>
            </div>
        @endif

        <!-- ================= HERO SECTION ================= -->
        <section class="pt-6 reveal">
            <div class="grid lg:grid-cols-12 gap-8 items-center">
                <!-- Left Column: Copy & CTAs -->
                <div class="lg:col-span-7 space-y-6">
                    <!-- Status Pill -->
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full glass text-xs font-mono text-teal-700 dark:text-cyanGlow border border-teal-500/30 dark:border-cyanGlow/30">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-ping"></span>
                        <span class="w-2 h-2 rounded-full bg-emerald-500 -ml-3.5"></span>
                        <span>XI RPL 2 • SMKN 1 Garut • Open for PKL & Projects</span>
                    </div>

                    <!-- Main Headline -->
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-tight">
                        Nazwar Makarim <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-600 via-cyan-500 to-sky-400 dark:from-cyanGlow dark:via-teal-300 dark:to-cyan-400">
                            Full-Stack Web & IoT Dev.
                        </span>
                    </h1>

                    <!-- Bio Subhead -->
                    <p class="text-base sm:text-lg text-slate-600 dark:text-slate-300 leading-relaxed max-w-xl">
                        Membangun aplikasi web berperforma tinggi dengan <strong class="text-slate-900 dark:text-white font-semibold">Laravel & React</strong>, perancangan arsitektur database relasional, hingga rekayasa perangkat cerdas terintegrasi berbasis mikrokontroler <strong class="text-slate-900 dark:text-white font-semibold">ESP32 & Sensor IoT</strong>.
                    </p>

                    <!-- Primary Actions -->
                    <div class="flex flex-wrap items-center gap-3 pt-2">
                        <a href="#projects" class="px-5 py-3 rounded-xl font-semibold text-sm bg-teal-600 dark:bg-cyanGlow text-white dark:text-navy shadow-lg shadow-teal-500/20 dark:shadow-cyanGlow/25 hover:opacity-90 hover:scale-[1.02] transition flex items-center gap-2">
                            <i data-lucide="folder-git-2" class="w-4 h-4"></i> Lihat Proyek
                        </a>
                        <button type="button" onclick="openCvModal()" class="px-5 py-3 rounded-xl font-medium text-sm glass hover:border-teal-500/50 dark:hover:border-cyanGlow/50 hover:scale-[1.02] transition flex items-center gap-2">
                            <i data-lucide="file-text" class="w-4 h-4 text-teal-600 dark:text-cyanGlow"></i> Ringkasan CV
                        </button>
                        <a href="{{ route('api.projects') }}" target="_blank" class="px-4 py-3 rounded-xl font-mono text-xs glass hover:border-teal-500/50 dark:hover:border-cyanGlow/50 transition flex items-center gap-2 text-slate-600 dark:text-slate-400">
                            <i data-lucide="braces" class="w-3.5 h-3.5 text-teal-600 dark:text-cyanGlow"></i> API JSON
                        </a>
                    </div>

                    <!-- Direct Social Media & Instant Channels -->
                    <div class="pt-3 flex items-center gap-3">
                        <span class="text-xs font-mono text-slate-400">Hubungi langsung:</span>
                        <div class="flex items-center gap-2">
                            <a href="https://github.com/{{ $githubUsername }}" target="_blank" rel="noopener noreferrer" aria-label="GitHub Profile" class="p-2 sm:px-3 sm:py-2 rounded-xl glass hover:border-teal-500/50 dark:hover:border-cyanGlow/50 text-slate-700 dark:text-slate-300 hover:text-teal-600 dark:hover:text-cyanGlow transition flex items-center gap-1.5 text-xs font-mono font-medium">
                                <svg class="w-4 h-4 fill-current shrink-0" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"></path>
                                </svg>
                                <span>GitHub</span>
                            </a>
                            <a href="mailto:nazwarmakarim818@gmail.com" aria-label="Email Nazwar" class="p-2 sm:px-3 sm:py-2 rounded-xl glass hover:border-teal-500/50 dark:hover:border-cyanGlow/50 text-slate-700 dark:text-slate-300 hover:text-teal-600 dark:hover:text-cyanGlow transition flex items-center gap-1.5 text-xs font-mono font-medium">
                                <i data-lucide="mail" class="w-4 h-4"></i>
                                <span class="hidden sm:inline">Email</span>
                            </a>
                            <a href="https://wa.me/6289509306601?text=Halo%20Nazwar,%20saya%20tertarik%20dengan%20portofolio%20Anda" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp Nazwar" class="p-2 sm:px-3 sm:py-2 rounded-xl glass hover:border-teal-500/50 dark:hover:border-cyanGlow/50 text-emerald-600 dark:text-emerald-400 transition flex items-center gap-1.5 text-xs font-mono font-medium">
                                <i data-lucide="message-square" class="w-4 h-4"></i> <span>WhatsApp</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Interactive Profile Card with Cyber Glow Frame -->
                <div class="lg:col-span-5 flex justify-center">
                    <div class="w-full max-w-sm glass rounded-3xl p-6 relative overflow-hidden border border-teal-500/25 dark:border-cyanGlow/25 shadow-2xl">
                        <!-- Decorative Header Gradient -->
                        <div class="absolute -top-16 -right-16 w-44 h-44 bg-teal-500/20 dark:bg-cyanGlow/25 rounded-full blur-2xl"></div>

                        <div class="flex items-start justify-between relative z-10 pb-5 border-b border-slate-200/60 dark:border-white/10">
                            <div class="flex items-center gap-3.5">
                                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-teal-500 to-cyan-400 p-0.5 shadow-neon">
                                    <div class="w-full h-full bg-[#0B1120] rounded-[14px] flex items-center justify-center font-mono font-bold text-lg text-cyanGlow">
                                        NM
                                    </div>
                                </div>
                                <div>
                                    <h2 class="font-bold text-base">Nazwar Makarim M.</h2>
                                    <p class="text-xs font-mono text-teal-600 dark:text-cyanGlow">SMKN 1 Garut — PPLG</p>
                                </div>
                            </div>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 text-[10px] font-mono">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span> Active
                            </span>
                        </div>

                        <!-- Highlights Specs -->
                        <div class="py-4 space-y-3 relative z-10 text-xs font-mono">
                            <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-100/60 dark:bg-slate-900/60">
                                <span class="text-slate-500 dark:text-slate-400">Spesialisasi</span>
                                <span class="font-semibold text-slate-800 dark:text-slate-200">Full-Stack & Hardware IoT</span>
                            </div>
                            <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-100/60 dark:bg-slate-900/60">
                                <span class="text-slate-500 dark:text-slate-400">Basis Kota</span>
                                <span class="font-semibold text-slate-800 dark:text-slate-200">Garut, Jawa Barat</span>
                            </div>
                            <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-100/60 dark:bg-slate-900/60">
                                <span class="text-slate-500 dark:text-slate-400">Status Akademik</span>
                                <span class="font-semibold text-emerald-600 dark:text-emerald-400">Siap Penempatan PKL</span>
                            </div>
                        </div>

                        <!-- Mini Code Snippet Badge -->
                        <div class="p-3 rounded-xl bg-slate-900 border border-white/5 font-mono text-[11px] text-slate-300 space-y-1">
                            <p class="text-slate-500">// Terminal snippet</p>
                            <p><span class="text-teal-400">$</span> agy status --dev <span class="text-cyanGlow">nazwar</span></p>
                            <p class="text-emerald-400">✓ Ready to build web apps & IoT</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ================= PROJECTS SHOWCASE SECTION ================= -->
        <section id="projects" class="space-y-6 reveal">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
                <div>
                    <p class="font-mono text-xs uppercase tracking-widest text-teal-600 dark:text-cyanGlow flex items-center gap-1.5">
                        <i data-lucide="layers" class="w-3.5 h-3.5"></i> 01 // Portfolio Showcase
                    </p>
                    <h2 class="text-2xl sm:text-3xl font-bold mt-1">Proyek & Karya Unggulan</h2>
                    <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-1">
                        Filter interaktif di sisi browser tanpa jeda muat ulang halaman.
                    </p>
                </div>

                <!-- Client-Side Instant Category Filter Buttons -->
                <div class="flex flex-wrap gap-2" id="project-filter-buttons">
                    <button type="button" data-filter="all" class="filter-btn px-3.5 py-1.5 rounded-xl text-xs font-mono transition font-semibold bg-teal-600 dark:bg-cyanGlow text-white dark:text-navy shadow-sm">
                        All ({{ $projects->count() }})
                    </button>
                    @foreach($categories as $cat)
                        <button type="button" data-filter="{{ $cat->slug }}" class="filter-btn px-3.5 py-1.5 rounded-xl text-xs font-mono transition glass hover:border-teal-500/50 dark:hover:border-cyanGlow/50">
                            {{ $cat->name }}
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Project Cards Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5" id="projects-grid">
                @forelse($projects as $project)
                    <article class="project-card glass-card rounded-2xl overflow-hidden flex flex-col justify-between group transition-all duration-300" data-category="{{ $project->category->slug }}">
                        <div>
                            <!-- Thumbnail / Graphic Banner -->
                            @if($project->image)
                                <div class="h-48 overflow-hidden bg-slate-900 relative">
                                    <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                    <span class="absolute top-3 left-3 px-2.5 py-1 rounded-md text-[11px] font-mono bg-slate-900/80 backdrop-blur-md text-teal-300 dark:text-cyanGlow border border-white/10">
                                        {{ $project->category->name }}
                                    </span>
                                </div>
                            @else
                                <div class="h-40 bg-gradient-to-br from-teal-900/40 via-slate-900/60 to-cyan-900/30 flex flex-col items-center justify-center p-4 relative border-b border-white/5">
                                    <i data-lucide="terminal" class="w-10 h-10 text-teal-600 dark:text-cyanGlow opacity-75 group-hover:scale-110 transition duration-300"></i>
                                    <span class="absolute top-3 left-3 px-2.5 py-1 rounded-md text-[11px] font-mono bg-slate-900/80 backdrop-blur-md text-teal-300 dark:text-cyanGlow border border-white/10">
                                        {{ $project->category->name }}
                                    </span>
                                </div>
                            @endif

                            <div class="p-5 space-y-3">
                                <h3 class="text-lg font-bold leading-snug group-hover:text-teal-600 dark:group-hover:text-cyanGlow transition">
                                    <a href="{{ route('projects.show', $project) }}">{{ $project->title }}</a>
                                </h3>
                                <p class="text-sm text-slate-600 dark:text-slate-300 line-clamp-3 leading-relaxed">
                                    {{ $project->description }}
                                </p>
                            </div>
                        </div>

                        <div class="p-5 pt-0 space-y-4">
                            <!-- Tech Stack Pills -->
                            <div class="flex flex-wrap gap-1.5">
                                @foreach(explode(',', $project->tech_stack) as $tech)
                                    <span class="px-2 py-0.5 rounded text-[11px] font-mono bg-slate-200/70 dark:bg-slate-800/80 text-slate-700 dark:text-slate-300">
                                        {{ trim($tech) }}
                                    </span>
                                @endforeach
                            </div>

                            <!-- Actions Row -->
                            <div class="flex items-center justify-between pt-3 border-t border-slate-200/60 dark:border-white/10 text-xs font-mono">
                                <a href="{{ route('projects.show', $project) }}" class="flex items-center gap-1 font-semibold text-teal-600 dark:text-cyanGlow hover:underline">
                                    <span>Studi Kasus</span> <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                                </a>

                                <div class="flex items-center gap-3">
                                    @if($project->demo_url && $project->demo_url !== '#')
                                        <a href="{{ $project->demo_url }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-1 text-slate-600 dark:text-slate-300 hover:text-teal-600 dark:hover:text-cyanGlow transition">
                                            <i data-lucide="external-link" class="w-3.5 h-3.5"></i> Live
                                        </a>
                                    @endif
                                    @if($project->github_url && $project->github_url !== 'https://github.com')
                                        <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-1 text-slate-600 dark:text-slate-300 hover:text-teal-600 dark:hover:text-cyanGlow transition">
                                            <svg class="w-3.5 h-3.5 fill-current shrink-0" viewBox="0 0 24 24" aria-hidden="true">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"></path>
                                            </svg>
                                            <span>Repo</span>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full glass rounded-2xl p-10 text-center text-sm text-slate-500 dark:text-slate-400">
                        Belum ada proyek yang terdaftar di basis data.
                    </div>
                @endforelse
            </div>

            <!-- Empty State for Filter -->
            <div id="no-projects-filtered" class="hidden glass rounded-2xl p-10 text-center text-sm text-slate-500 dark:text-slate-400">
                Tidak ada proyek yang sesuai dengan kategori yang dipilih.
            </div>
        </section>

        <!-- ================= TECH STACK SECTION ================= -->
        <section id="skills" class="space-y-6 reveal">
            <div>
                <p class="font-mono text-xs uppercase tracking-widest text-teal-600 dark:text-cyanGlow flex items-center gap-1.5">
                    <i data-lucide="cpu" class="w-3.5 h-3.5"></i> 02 // Tools & Technologies
                </p>
                <h2 class="text-2xl sm:text-3xl font-bold mt-1">Tech Stack & Spesialisasi</h2>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Group 1: Backend & Core -->
                <div class="glass-card rounded-2xl p-5 space-y-3">
                    <div class="w-10 h-10 rounded-xl bg-rose-500/10 border border-rose-500/20 flex items-center justify-center text-rose-500">
                        <i data-lucide="server" class="w-5 h-5"></i>
                    </div>
                    <h3 class="font-bold text-base">Backend & Server</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                        Arsitektur MVC, Eloquent ORM, REST API, dan integrasi middleware auth.
                    </p>
                    <div class="flex flex-wrap gap-1.5 pt-2">
                        <span class="px-2 py-0.5 rounded text-[11px] font-mono bg-slate-200/60 dark:bg-slate-800/80">Laravel 12</span>
                        <span class="px-2 py-0.5 rounded text-[11px] font-mono bg-slate-200/60 dark:bg-slate-800/80">PHP 8.4</span>
                        <span class="px-2 py-0.5 rounded text-[11px] font-mono bg-slate-200/60 dark:bg-slate-800/80">Composer</span>
                    </div>
                </div>

                <!-- Group 2: Frontend & UI -->
                <div class="glass-card rounded-2xl p-5 space-y-3">
                    <div class="w-10 h-10 rounded-xl bg-sky-500/10 border border-sky-500/20 flex items-center justify-center text-sky-500">
                        <i data-lucide="layout" class="w-5 h-5"></i>
                    </div>
                    <h3 class="font-bold text-base">Frontend & Desain</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                        Komponen interaktif, single-page state, dan antarmuka responsif mobile-first.
                    </p>
                    <div class="flex flex-wrap gap-1.5 pt-2">
                        <span class="px-2 py-0.5 rounded text-[11px] font-mono bg-slate-200/60 dark:bg-slate-800/80">React</span>
                        <span class="px-2 py-0.5 rounded text-[11px] font-mono bg-slate-200/60 dark:bg-slate-800/80">Tailwind CSS</span>
                        <span class="px-2 py-0.5 rounded text-[11px] font-mono bg-slate-200/60 dark:bg-slate-800/80">JavaScript ES6</span>
                    </div>
                </div>

                <!-- Group 3: IoT & Embedded Systems -->
                <div class="glass-card rounded-2xl p-5 space-y-3">
                    <div class="w-10 h-10 rounded-xl bg-teal-500/10 border border-teal-500/20 flex items-center justify-center text-teal-500">
                        <i data-lucide="circuit-board" class="w-5 h-5"></i>
                    </div>
                    <h3 class="font-bold text-base">IoT & Robotika</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                        Pemrograman mikrokontroler, pembacaan sensor ultrasonik/suhu, dan aktuator.
                    </p>
                    <div class="flex flex-wrap gap-1.5 pt-2">
                        <span class="px-2 py-0.5 rounded text-[11px] font-mono bg-slate-200/60 dark:bg-slate-800/80">ESP32</span>
                        <span class="px-2 py-0.5 rounded text-[11px] font-mono bg-slate-200/60 dark:bg-slate-800/80">C / C++</span>
                        <span class="px-2 py-0.5 rounded text-[11px] font-mono bg-slate-200/60 dark:bg-slate-800/80">Arduino IDE</span>
                    </div>
                </div>

                <!-- Group 4: Database & DevOps -->
                <div class="glass-card rounded-2xl p-5 space-y-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-500">
                        <i data-lucide="database" class="w-5 h-5"></i>
                    </div>
                    <h3 class="font-bold text-base">Basis Data & Tools</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                        Desain skema tabel, indexing, Git workflow kolaboratif, dan cloud deployment.
                    </p>
                    <div class="flex flex-wrap gap-1.5 pt-2">
                        <span class="px-2 py-0.5 rounded text-[11px] font-mono bg-slate-200/60 dark:bg-slate-800/80">MySQL</span>
                        <span class="px-2 py-0.5 rounded text-[11px] font-mono bg-slate-200/60 dark:bg-slate-800/80">Supabase</span>
                        <span class="px-2 py-0.5 rounded text-[11px] font-mono bg-slate-200/60 dark:bg-slate-800/80">Git & GitHub</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- ================= TIMELINE / EXPERIENCE SECTION ================= -->
        <section id="experience" class="space-y-6 reveal">
            <div>
                <p class="font-mono text-xs uppercase tracking-widest text-teal-600 dark:text-cyanGlow flex items-center gap-1.5">
                    <i data-lucide="award" class="w-3.5 h-3.5"></i> 03 // Journey & Milestone
                </p>
                <h2 class="text-2xl sm:text-3xl font-bold mt-1">Rekam Jejak & Pendidikan</h2>
            </div>

            <div class="relative border-l-2 border-teal-500/30 dark:border-cyanGlow/25 ml-3 sm:ml-4 pl-6 sm:pl-8 space-y-8">
                <!-- Timeline Item 1 -->
                <div class="relative group">
                    <div class="absolute -left-[31px] sm:-left-[39px] top-1.5 w-4 h-4 rounded-full bg-teal-500 dark:bg-cyanGlow border-4 border-slate-50 dark:border-navy"></div>
                    <div class="glass-card rounded-2xl p-5 space-y-2">
                        <div class="flex flex-wrap items-center justify-between gap-2">
                            <h3 class="font-bold text-base text-slate-900 dark:text-white">SMKN 1 Garut — Pengembangan Perangkat Lunak & Gim (PPLG)</h3>
                            <span class="px-2.5 py-0.5 rounded-full bg-teal-500/10 text-teal-700 dark:text-cyanGlow font-mono text-xs">2024 — Sekarang (Kelas XI RPL 2)</span>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                            Mendalami rekayasa perangkat lunak berorientasi objek, perancangan basis data relasional, pengujian kode (*Unit & Feature Testing*), serta prototipe IoT untuk kebutuhan tugas akhir & persiapan Praktik Kerja Lapangan (PKL).
                        </p>
                    </div>
                </div>

                <!-- Timeline Item 2 -->
                <div class="relative group">
                    <div class="absolute -left-[31px] sm:-left-[39px] top-1.5 w-4 h-4 rounded-full bg-teal-500 dark:bg-cyanGlow border-4 border-slate-50 dark:border-navy"></div>
                    <div class="glass-card rounded-2xl p-5 space-y-2">
                        <div class="flex flex-wrap items-center justify-between gap-2">
                            <h3 class="font-bold text-base text-slate-900 dark:text-white">Pelatihan LKS Cyber Security (Capture The Flag)</h3>
                            <span class="px-2.5 py-0.5 rounded-full bg-slate-200/70 dark:bg-slate-800/80 font-mono text-xs">Kompetisi Kejuruan</span>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                            Mempelajari dasar analisis kerentanan web, keamanan jaringan, kriptografi praktis, dan pengujian penetrasi sistem menggunakan lingkungan Linux untuk simulasi Lomba Kompetensi Siswa (LKS).
                        </p>
                    </div>
                </div>

                <!-- Timeline Item 3 -->
                <div class="relative group">
                    <div class="absolute -left-[31px] sm:-left-[39px] top-1.5 w-4 h-4 rounded-full bg-teal-500 dark:bg-cyanGlow border-4 border-slate-50 dark:border-navy"></div>
                    <div class="glass-card rounded-2xl p-5 space-y-2">
                        <div class="flex flex-wrap items-center justify-between gap-2">
                            <h3 class="font-bold text-base text-slate-900 dark:text-white">Mentor Pemrograman & Robotika Komunitas Sekolah</h3>
                            <span class="px-2.5 py-0.5 rounded-full bg-slate-200/70 dark:bg-slate-800/80 font-mono text-xs">Aktivitas Kolaboratif</span>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                            Membimbing rekan siswa dalam memecahkan masalah logika pemrograman dasar, algoritma percabangan/perulangan, serta perakitan sirkuit sensor mikrokontroler.
                        </p>
                    </div>
                </div>

                <!-- Timeline Item 4 -->
                <div class="relative group">
                    <div class="absolute -left-[31px] sm:-left-[39px] top-1.5 w-4 h-4 rounded-full bg-teal-500 dark:bg-cyanGlow border-4 border-slate-50 dark:border-navy"></div>
                    <div class="glass-card rounded-2xl p-5 space-y-2">
                        <div class="flex flex-wrap items-center justify-between gap-2">
                            <h3 class="font-bold text-base text-slate-900 dark:text-white">Coding Camp & Bootcamp Pengembangan Web (Online)</h3>
                            <span class="px-2.5 py-0.5 rounded-full bg-slate-200/70 dark:bg-slate-800/80 font-mono text-xs">Sertifikasi & Proyek Mandiri</span>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                            Menyelesaikan modul pemrograman web modern, penerapan REST API, git version control, dan penyusunan antarmuka pengguna interaktif.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ================= LIVE GITHUB API SECTION ================= -->
        <section id="github" class="space-y-6 reveal">
            <div>
                <p class="font-mono text-xs uppercase tracking-widest text-teal-600 dark:text-cyanGlow flex items-center gap-1.5">
                    <i data-lucide="git-pull-request" class="w-3.5 h-3.5"></i> 04 // External REST API Integration
                </p>
                <h2 class="text-2xl sm:text-3xl font-bold mt-1 flex items-center gap-2.5">
                    <svg class="w-7 h-7 fill-current text-teal-600 dark:text-cyanGlow shrink-0" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"></path>
                    </svg>
                    <span>Aktivitas GitHub Real-Time</span>
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-1">
                    Data diambil via HTTP Client dengan mekanisme <strong class="font-mono text-teal-600 dark:text-cyanGlow">Cache::remember</strong> (30 Menit) untuk proteksi rate limiting.
                </p>
            </div>

            @if($githubProfile)
                <div class="glass rounded-2xl p-6 space-y-6">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-5 border-b border-slate-200/60 dark:border-white/10">
                        <div class="flex items-center gap-4">
                            <img src="{{ $githubProfile['avatar_url'] ?? 'https://avatars.githubusercontent.com/u/583231?v=4' }}" alt="GitHub Avatar" class="w-14 h-14 rounded-2xl border border-teal-500/40 dark:border-cyanGlow/40 object-cover bg-slate-900" onerror="this.onerror=null; this.src='https://avatars.githubusercontent.com/u/583231?v=4';">
                            <div>
                                <h3 class="font-bold text-lg">{{ $githubProfile['name'] ?? $githubUsername }}</h3>
                                <p class="text-xs font-mono text-slate-500 dark:text-slate-400">{{ '@' . $githubProfile['login'] }} • {{ $githubProfile['bio'] ?? 'Software & IoT Developer' }}</p>
                            </div>
                        </div>
                        <div class="flex gap-3 font-mono text-xs">
                            <div class="px-4 py-2.5 rounded-xl bg-slate-200/60 dark:bg-slate-800/70 text-center">
                                <span class="block text-base font-bold text-teal-600 dark:text-cyanGlow">{{ $githubProfile['public_repos'] }}</span>
                                <span class="text-slate-500 dark:text-slate-400">Repos</span>
                            </div>
                            <div class="px-4 py-2.5 rounded-xl bg-slate-200/60 dark:bg-slate-800/70 text-center">
                                <span class="block text-base font-bold text-teal-600 dark:text-cyanGlow">{{ $githubProfile['followers'] }}</span>
                                <span class="text-slate-500 dark:text-slate-400">Followers</span>
                            </div>
                        </div>
                    </div>

                    <!-- Repositories Grid -->
                    <div class="grid sm:grid-cols-2 gap-4">
                        @forelse($githubRepos as $repo)
                            <a href="{{ $repo['html_url'] }}" target="_blank" rel="noopener noreferrer" class="p-4 rounded-xl bg-slate-100/70 dark:bg-slate-900/60 border border-slate-200/70 dark:border-white/5 hover:border-teal-500/40 dark:hover:border-cyanGlow/40 transition block space-y-2 group">
                                <div class="flex items-center justify-between">
                                    <span class="font-mono font-semibold text-sm text-teal-700 dark:text-cyanGlow flex items-center gap-1.5 group-hover:underline">
                                        <i data-lucide="book-marked" class="w-3.5 h-3.5"></i> {{ $repo['name'] }}
                                    </span>
                                    <span class="text-xs font-mono text-slate-500 flex items-center gap-1">
                                        <i data-lucide="star" class="w-3 h-3 text-amber-400"></i>
                                        {{ $repo['stargazers_count'] ?? 0 }}
                                    </span>
                                </div>
                                <p class="text-xs leading-relaxed text-slate-600 dark:text-slate-400 line-clamp-2">
                                    {{ $repo['description'] ?? 'Repositori publik tanpa deskripsi tambahan.' }}
                                </p>
                                @if($repo['language'] ?? false)
                                    <span class="inline-block text-[11px] font-mono text-teal-700 dark:text-cyanGlow">
                                        ● {{ $repo['language'] }}
                                    </span>
                                @endif
                            </a>
                        @empty
                            <p class="sm:col-span-2 text-sm text-slate-500 dark:text-slate-400 text-center py-4">
                                Belum ada repositori publik yang dapat ditampilkan.
                            </p>
                        @endforelse
                    </div>
                </div>
            @else
                <div class="glass rounded-2xl p-6 text-sm text-slate-600 dark:text-slate-300 flex items-center gap-3">
                    <svg class="w-6 h-6 fill-current text-teal-600 dark:text-cyanGlow shrink-0" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"></path>
                    </svg>
                    <span>Aktivitas GitHub belum dapat dimuat. Silakan coba beberapa saat lagi.</span>
                </div>
            @endif
        </section>

        <!-- ================= CONTACT SECTION ================= -->
        <section id="contact" class="grid lg:grid-cols-12 gap-8 items-start reveal">
            <!-- Left Info Cards -->
            <div class="lg:col-span-5 space-y-6">
                <div>
                    <p class="font-mono text-xs uppercase tracking-widest text-teal-600 dark:text-cyanGlow flex items-center gap-1.5">
                        <i data-lucide="send" class="w-3.5 h-3.5"></i> 05 // Get in Touch
                    </p>
                    <h2 class="text-2xl sm:text-3xl font-bold mt-1">Mari Berkolaborasi!</h2>
                    <p class="text-sm leading-relaxed text-slate-600 dark:text-slate-300 mt-2">
                        Terbuka untuk kesempatan PKL (Praktik Kerja Lapangan), kerja sama proyek web/IoT, atau sekadar berdiskusi seputar pemrograman.
                    </p>
                </div>

                <!-- Direct Details Grid -->
                <div class="space-y-3 font-mono text-xs">
                    <div class="glass-card rounded-xl p-4 flex items-center gap-3.5">
                        <div class="w-9 h-9 rounded-lg bg-teal-500/10 text-teal-600 dark:text-cyanGlow flex items-center justify-center shrink-0">
                            <i data-lucide="map-pin" class="w-4 h-4"></i>
                        </div>
                        <div>
                            <span class="text-slate-400 block text-[11px]">Lokasi</span>
                            <span class="font-semibold text-slate-800 dark:text-slate-200">Garut, Jawa Barat, Indonesia</span>
                        </div>
                    </div>

                    <a href="mailto:contact@nazwar.dev" class="glass-card rounded-xl p-4 flex items-center gap-3.5 block hover:border-teal-500/50 dark:hover:border-cyanGlow/50 transition">
                        <div class="w-9 h-9 rounded-lg bg-teal-500/10 text-teal-600 dark:text-cyanGlow flex items-center justify-center shrink-0">
                            <i data-lucide="mail" class="w-4 h-4"></i>
                        </div>
                        <div>
                            <span class="text-slate-400 block text-[11px]">Email Resmi</span>
                            <span class="font-semibold text-slate-800 dark:text-slate-200">contact@nazwar.dev</span>
                        </div>
                    </a>

                    <a href="https://wa.me/6281234567890?text=Halo%20Nazwar,%20saya%20tertarik%20dengan%20portofolio%20Anda" target="_blank" rel="noopener noreferrer" class="glass-card rounded-xl p-4 flex items-center gap-3.5 block hover:border-emerald-500/50 transition">
                        <div class="w-9 h-9 rounded-lg bg-emerald-500/10 text-emerald-500 flex items-center justify-center shrink-0">
                            <i data-lucide="phone" class="w-4 h-4"></i>
                        </div>
                        <div>
                            <span class="text-slate-400 block text-[11px]">WhatsApp Langsung</span>
                            <span class="font-semibold text-emerald-600 dark:text-emerald-400">+62 812-3456-7890</span>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Right: Interactive Form with Anti-Spam & Loading State -->
            <div class="lg:col-span-7">
                <form action="{{ route('contact.store') }}" method="POST" id="contact-form" class="glass rounded-2xl p-6 sm:p-8 space-y-4 shadow-xl border border-teal-500/20 dark:border-cyanGlow/20">
                    @csrf
                    <div>
                        <label for="sender_name" class="block text-xs font-mono mb-1.5 font-medium">Nama Lengkap *</label>
                        <input id="sender_name" name="sender_name" value="{{ old('sender_name') }}" required maxlength="100" autocomplete="name" placeholder="Misal: Bapak/Ibu HRD atau Rekan Pengembang"
                            class="w-full px-4 py-2.5 rounded-xl bg-slate-100/70 dark:bg-slate-900/80 border border-slate-200 dark:border-white/10 text-sm focus:outline-none focus:border-teal-500 dark:focus:border-cyanGlow transition">
                        @error('sender_name')
                            <p class="mt-1 text-xs text-rose-600 dark:text-rose-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="sender_email" class="block text-xs font-mono mb-1.5 font-medium">Alamat Email *</label>
                        <input id="sender_email" type="email" name="sender_email" value="{{ old('sender_email') }}" required maxlength="100" autocomplete="email" placeholder="nama@perusahaan.com"
                            class="w-full px-4 py-2.5 rounded-xl bg-slate-100/70 dark:bg-slate-900/80 border border-slate-200 dark:border-white/10 text-sm focus:outline-none focus:border-teal-500 dark:focus:border-cyanGlow transition">
                        @error('sender_email')
                            <p class="mt-1 text-xs text-rose-600 dark:text-rose-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="message" class="block text-xs font-mono mb-1.5 font-medium">Pesan / Diskusi Proyek *</label>
                        <textarea id="message" name="message" rows="4" required maxlength="1000" placeholder="Tuliskan tawaran PKL, ide proyek, atau pertanyaan Anda di sini..."
                            class="w-full px-4 py-2.5 rounded-xl bg-slate-100/70 dark:bg-slate-900/80 border border-slate-200 dark:border-white/10 text-sm focus:outline-none focus:border-teal-500 dark:focus:border-cyanGlow transition">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="mt-1 text-xs text-rose-600 dark:text-rose-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" id="contact-submit-btn" class="w-full sm:w-auto px-6 py-3 rounded-xl bg-teal-600 dark:bg-cyanGlow text-white dark:text-navy font-semibold text-sm hover:opacity-90 hover:scale-[1.01] transition shadow-md flex items-center justify-center gap-2">
                        <i data-lucide="send" class="w-4 h-4"></i>
                        <span>Kirim Pesan Sekarang</span>
                    </button>
                </form>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer class="max-w-6xl mx-auto px-4 pb-12 pt-6 text-center text-xs font-mono text-slate-500 dark:text-slate-400 border-t border-slate-200/50 dark:border-white/5 space-y-2">
        <p>© {{ date('Y') }} Nazwar Makarim Mahardhika · PPLG SMKN 1 Garut</p>
        <p class="text-[11px] text-slate-400 dark:text-slate-500">Dibangun dengan arsitektur Laravel 12 & Tailwind CSS · Dilindungi Middleware Auth & Rate Limiting</p>
    </footer>

    <!-- ================= CV MODAL ================= -->
    <div id="cv-modal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm hidden items-center justify-center p-4">
        <div class="glass rounded-3xl max-w-xl w-full p-6 sm:p-8 space-y-6 border border-teal-500/30 dark:border-cyanGlow/30 shadow-2xl relative max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between pb-4 border-b border-slate-200 dark:border-white/10">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-teal-500/10 text-teal-600 dark:text-cyanGlow flex items-center justify-center">
                        <i data-lucide="file-badge" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg">Curriculum Vitae Ringkas</h3>
                        <p class="text-xs font-mono text-slate-500">Nazwar Makarim Mahardhika</p>
                    </div>
                </div>
                <button type="button" onclick="closeCvModal()" class="p-2 rounded-xl glass hover:opacity-80">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>

            <!-- CV Details -->
            <div class="space-y-4 text-xs font-mono leading-relaxed">
                <div class="p-4 rounded-xl bg-slate-100/70 dark:bg-slate-900/70 space-y-1">
                    <p class="text-teal-600 dark:text-cyanGlow font-bold uppercase tracking-wider text-[11px]">Profil Singkat</p>
                    <p class="text-slate-700 dark:text-slate-300 font-sans">
                        Siswa aktif kelas XI Rekayasa Perangkat Lunak SMKN 1 Garut dengan ketertarikan tinggi pada arsitektur web modern (Laravel, React) dan komputasi fisik (IoT berbasis ESP32). Berorientasi pada penulisan kode bersih, terstruktur, dan teruji.
                    </p>
                </div>

                <div class="grid sm:grid-cols-2 gap-3">
                    <div class="p-3.5 rounded-xl bg-slate-100/70 dark:bg-slate-900/70 space-y-1">
                        <span class="text-slate-400 block text-[10px]">PENDIDIKAN</span>
                        <p class="font-semibold text-slate-800 dark:text-slate-200 font-sans">SMKN 1 Garut</p>
                        <p class="text-[11px] text-slate-500">PPLG (2024 — Sekarang)</p>
                    </div>
                    <div class="p-3.5 rounded-xl bg-slate-100/70 dark:bg-slate-900/70 space-y-1">
                        <span class="text-slate-400 block text-[10px]">KESIAPAN PKL</span>
                        <p class="font-semibold text-emerald-600 dark:text-emerald-400 font-sans">Tersedia untuk PKL</p>
                        <p class="text-[11px] text-slate-500">Tahun Ajaran 2026/2027</p>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <span class="text-slate-400 block text-[10px]">KEAHLIAN UTAMA</span>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="px-2 py-0.5 rounded bg-teal-500/10 text-teal-600 dark:text-cyanGlow">Laravel MVC</span>
                        <span class="px-2 py-0.5 rounded bg-teal-500/10 text-teal-600 dark:text-cyanGlow">React.js</span>
                        <span class="px-2 py-0.5 rounded bg-teal-500/10 text-teal-600 dark:text-cyanGlow">Tailwind CSS</span>
                        <span class="px-2 py-0.5 rounded bg-teal-500/10 text-teal-600 dark:text-cyanGlow">MySQL & Supabase</span>
                        <span class="px-2 py-0.5 rounded bg-teal-500/10 text-teal-600 dark:text-cyanGlow">ESP32 & C++</span>
                        <span class="px-2 py-0.5 rounded bg-teal-500/10 text-teal-600 dark:text-cyanGlow">Git & GitHub</span>
                    </div>
                </div>
            </div>

            <!-- Footer Action Buttons -->
            <div class="flex items-center justify-end gap-3 pt-3 border-t border-slate-200 dark:border-white/10">
                <button type="button" onclick="window.print()" class="px-4 py-2 rounded-xl glass text-xs font-mono font-medium hover:opacity-90 flex items-center gap-1.5">
                    <i data-lucide="printer" class="w-3.5 h-3.5"></i> Cetak / Simpan PDF
                </button>
                <button type="button" onclick="closeCvModal()" class="px-4 py-2 rounded-xl bg-teal-600 dark:bg-cyanGlow text-white dark:text-navy text-xs font-mono font-bold hover:opacity-90">
                    Tutup
                </button>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    // 1. Mobile Menu Toggle
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const hamburgerIcon = document.getElementById('hamburger-icon');
    const closeIcon = document.getElementById('close-icon');

    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', () => {
            const isHidden = mobileMenu.classList.contains('hidden');
            if (isHidden) {
                mobileMenu.classList.remove('hidden');
                mobileMenu.classList.add('flex');
                hamburgerIcon.classList.add('hidden');
                closeIcon.classList.remove('hidden');
            } else {
                mobileMenu.classList.add('hidden');
                mobileMenu.classList.remove('flex');
                hamburgerIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
            }
        });

        // Close mobile menu on clicking any link
        document.querySelectorAll('.mobile-nav-link').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
                mobileMenu.classList.remove('flex');
                hamburgerIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
            });
        });
    }

    // 2. Client-Side Instant Project Filtering (No Page Reload)
    const filterButtons = document.querySelectorAll('#project-filter-buttons .filter-btn');
    const projectCards = document.querySelectorAll('#projects-grid .project-card');
    const noProjectsFiltered = document.getElementById('no-projects-filtered');

    filterButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const filter = btn.getAttribute('data-filter');

            // Update button active state styling
            filterButtons.forEach(b => {
                b.className = 'filter-btn px-3.5 py-1.5 rounded-xl text-xs font-mono transition glass hover:border-teal-500/50 dark:hover:border-cyanGlow/50';
            });
            btn.className = 'filter-btn px-3.5 py-1.5 rounded-xl text-xs font-mono transition font-semibold bg-teal-600 dark:bg-cyanGlow text-white dark:text-navy shadow-sm';

            // Filter project cards with smooth fade
            let visibleCount = 0;
            projectCards.forEach(card => {
                const category = card.getAttribute('data-category');
                if (filter === 'all' || category === filter) {
                    card.style.display = 'flex';
                    card.classList.remove('opacity-0', 'scale-95');
                    card.classList.add('opacity-100', 'scale-100');
                    visibleCount++;
                } else {
                    card.classList.remove('opacity-100', 'scale-100');
                    card.classList.add('opacity-0', 'scale-95');
                    card.style.display = 'none';
                }
            });

            if (noProjectsFiltered) {
                if (visibleCount === 0) {
                    noProjectsFiltered.classList.remove('hidden');
                } else {
                    noProjectsFiltered.classList.add('hidden');
                }
            }
        });
    });

    // 3. Scroll-Spy for Desktop Nav Links
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('#desktop-nav-links .nav-link');

    window.addEventListener('scroll', () => {
        let currentSection = '';
        const scrollPosition = window.scrollY + 140;

        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;
            if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                currentSection = section.getAttribute('id');
            }
        });

        navLinks.forEach(link => {
            link.classList.remove('text-teal-600', 'dark:text-cyanGlow', 'font-semibold');
            if (link.getAttribute('href') === `#${currentSection}`) {
                link.classList.add('text-teal-600', 'dark:text-cyanGlow', 'font-semibold');
            }
        });
    });

    // 4. Contact Form Submission Spinner State
    const contactForm = document.getElementById('contact-form');
    const contactSubmitBtn = document.getElementById('contact-submit-btn');

    if (contactForm && contactSubmitBtn) {
        contactForm.addEventListener('submit', () => {
            contactSubmitBtn.disabled = true;
            contactSubmitBtn.classList.add('opacity-75', 'cursor-not-allowed');
            contactSubmitBtn.innerHTML = `
                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span>Mengirimkan Pesan...</span>
            `;
        });
    }

    // 5. CV Modal Handlers
    const cvModal = document.getElementById('cv-modal');
    function openCvModal() {
        if (cvModal) {
            cvModal.classList.remove('hidden');
            cvModal.classList.add('flex');
        }
    }
    function closeCvModal() {
        if (cvModal) {
            cvModal.classList.add('hidden');
            cvModal.classList.remove('flex');
        }
    }
    if (cvModal) {
        cvModal.addEventListener('click', (e) => {
            if (e.target === cvModal) closeCvModal();
        });
    }
</script>
@endpush
