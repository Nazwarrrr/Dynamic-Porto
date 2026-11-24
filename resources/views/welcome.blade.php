@extends('layouts.app')

@section('title', 'Nazwar Makarim Mahardhika — Full-Stack Web & IoT Developer | XI RPL 2 SMKN 1 Garut')

@section('content')

    <!-- Sticky Glass Navbar with Scroll-Spy & Mobile Menu -->
    <header x-data="{ scrolled: window.pageYOffset > 20 }" @scroll.window="scrolled = window.pageYOffset > 20" class="sticky top-0 z-50 border-b border-transparent px-4 transition-all duration-300">
        <nav :class="scrolled ? 'bg-slate-950/90 dark:bg-slate-950/90 backdrop-blur-xl shadow-lg shadow-black/20 border-white/15' : 'bg-transparent border-transparent'" class="max-w-6xl mx-auto rounded-b-2xl border px-5 py-3.5 flex items-center justify-between transition-all duration-300">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="font-mono font-bold text-lg tracking-tight flex items-center gap-2 group">
                <span class="w-2.5 h-2.5 rounded-full bg-teal-500 dark:bg-cyanGlow animate-pulse"></span>
                <span>NMM<span class="text-teal-600 dark:text-cyanGlow group-hover:underline">.dev</span></span>
            </a>

            <!-- Desktop Nav Links (with Scroll-Spy classes) -->
            <div class="hidden lg:flex items-center gap-4 xl:gap-6 text-xs xl:text-sm font-medium text-slate-600 dark:text-slate-300" id="desktop-nav-links">
                <a href="#projects" class="nav-link hover:text-teal-600 dark:hover:text-cyanGlow transition">Proyek</a>
                <a href="#skills" class="nav-link hover:text-teal-600 dark:hover:text-cyanGlow transition">Tech Stack</a>
                <a href="#experience" class="nav-link hover:text-teal-600 dark:hover:text-cyanGlow transition">Rekam Jejak</a>
                <a href="#github" class="nav-link hover:text-teal-600 dark:hover:text-cyanGlow transition">GitHub API</a>
                <a href="#contact" class="nav-link hover:text-teal-600 dark:hover:text-cyanGlow transition">Kontak</a>
            </div>

            <!-- Action Controls (Theme Toggle, Admin Portal, Mobile Hamburger) -->
            <div class="flex items-center gap-2.5">
                <!-- Theme Toggle Button -->
                <button type="button" @click="toggleTheme()" aria-label="Ganti Tema" class="p-2 rounded-xl glass hover:border-teal-500/50 dark:hover:border-cyanGlow/50 transition-colors duration-300">
                    <i data-lucide="sun" class="w-4 h-4 hidden dark:block text-cyanGlow"></i>
                    <i data-lucide="moon" class="w-4 h-4 block dark:hidden text-slate-700"></i>
                </button>

                @auth
                    <a href="{{ route('admin.projects.index') }}" class="px-3.5 py-2 rounded-xl text-xs font-mono font-semibold bg-teal-600 dark:bg-cyanGlow text-white dark:text-navy hover:opacity-90 transition shadow-sm">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" title="Admin Login" aria-label="Admin Login" class="p-2 rounded-xl glass hover:border-teal-500/50 dark:hover:border-cyanGlow/50 transition flex items-center justify-center">
                        <i data-lucide="lock" class="w-4 h-4 text-teal-600 dark:text-cyanGlow"></i>
                    </a>
                @endauth

                <!-- Hamburger Button (Mobile Only) -->
                <button type="button" id="mobile-menu-btn" aria-label="Buka Menu" aria-expanded="false" class="lg:hidden p-2 rounded-xl glass hover:border-teal-500/50 dark:hover:border-cyanGlow/50 transition">
                    <i data-lucide="menu" id="hamburger-icon" class="w-5 h-5"></i>
                    <i data-lucide="x" id="close-icon" class="w-5 h-5 hidden"></i>
                </button>
            </div>
        </nav>

        <!-- Mobile Nav Menu Dropdown -->
        <div id="mobile-menu" class="hidden lg:hidden max-w-6xl mx-auto mt-2 glass rounded-2xl p-4 shadow-xl border border-teal-500/20 dark:border-cyanGlow/20 flex-col gap-3 font-mono text-sm">
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

    <main class="max-w-6xl mx-auto px-4 pt-8 pb-20 space-y-24">

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
        <section class="relative isolate pt-16 pb-24 lg:pt-24 lg:pb-32 reveal">
            <div class="pointer-events-none absolute -top-20 -left-20 -z-10 h-80 w-80 rounded-full bg-[#0D9488] blur-3xl opacity-20" aria-hidden="true"></div>
            <div class="grid lg:grid-cols-12 gap-12 items-center">
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
                        <button type="button" @click="cvModalOpen = true" class="px-5 py-3 rounded-xl font-medium text-sm glass hover:border-teal-500/50 dark:hover:border-cyanGlow/50 hover:scale-[1.02] transition flex items-center gap-2">
                            <i data-lucide="file-text" class="w-4 h-4 text-teal-600 dark:text-cyanGlow"></i> Ringkasan CV
                        </button>
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
                    <div class="w-full max-w-sm glass rounded-3xl p-6 relative overflow-hidden border border-teal-500/25 dark:border-cyanGlow/25 shadow-2xl space-y-4">
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

                        <!-- Mini Terminal Window -->
                        <div class="overflow-hidden rounded-xl border border-white/10 bg-slate-950/90 font-mono text-[11px] text-slate-300 shadow-[0_12px_30px_-18px_rgba(34,211,238,0.65)]">
                            <div class="flex items-center gap-1.5 border-b border-white/10 bg-slate-900/80 px-3 py-2">
                                <span class="h-2 w-2 rounded-full bg-rose-400"></span>
                                <span class="h-2 w-2 rounded-full bg-amber-300"></span>
                                <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
                                <span class="ml-2 truncate text-[10px] text-slate-400">nazwar@smkn1garut:~/portfolio</span>
                            </div>
                            <div class="space-y-1 p-3">
                                <p class="text-slate-500">// Terminal snippet</p>
                                <p><span class="text-teal-400">$</span> agy status --dev <span class="text-cyanGlow">nazwar</span> <span class="animate-pulse text-cyanGlow" aria-hidden="true">▍</span></p>
                                <p class="text-emerald-400">✓ Ready to build web apps & IoT</p>
                            </div>
                        </div>
                        <div class="relative z-10 inline-flex items-center gap-2 rounded-full border border-cyan-400/20 bg-cyan-400/5 px-3 py-1.5 font-mono text-[10px] text-cyan-800 dark:text-cyan-200">
                            <span class="h-1.5 w-1.5 animate-pulse rounded-full bg-emerald-400"></span>
                            Stack: Laravel 12 + ESP32
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ================= PROJECTS SHOWCASE SECTION ================= -->
        <section id="projects" x-data="{ activeFilter: 'all', get visibleCount() { return Array.from(this.$refs.projectGrid.querySelectorAll('.project-card')).filter((card) => this.activeFilter === 'all' || card.dataset.category === this.activeFilter).length; } }" class="scroll-mt-24 space-y-6 reveal">
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
                <div class="no-scrollbar flex flex-nowrap gap-2 overflow-x-auto pb-2 sm:flex-wrap sm:overflow-visible sm:pb-0" id="project-filter-buttons">
                    <button type="button" @click="activeFilter = 'all'" :aria-pressed="activeFilter === 'all'" :class="activeFilter === 'all' ? 'font-semibold bg-teal-600 dark:bg-cyanGlow text-white dark:text-navy shadow-sm' : 'glass hover:border-teal-500/50 dark:hover:border-cyanGlow/50'" class="filter-btn shrink-0 px-3.5 py-1.5 rounded-xl text-xs font-mono transition">
                        All ({{ $projects->count() }})
                    </button>
                    @foreach($categories->filter(fn ($category) => $projects->contains('category_id', $category->id)) as $cat)
                        <button type="button" @click="activeFilter = '{{ $cat->slug }}'" :aria-pressed="activeFilter === '{{ $cat->slug }}'" :class="activeFilter === '{{ $cat->slug }}' ? 'font-semibold bg-teal-600 dark:bg-cyanGlow text-white dark:text-navy shadow-sm' : 'glass hover:border-teal-500/50 dark:hover:border-cyanGlow/50'" class="filter-btn shrink-0 px-3.5 py-1.5 rounded-xl text-xs font-mono transition">
                            {{ $cat->name }}
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Project Cards Grid -->
            <div x-ref="projectGrid" class="grid md:grid-cols-2 lg:grid-cols-3 gap-5" id="projects-grid">
                @forelse($projects as $project)
                    <article x-cloak x-show="activeFilter === 'all' || activeFilter === $el.dataset.category" x-transition:enter="transition ease-out duration-[250ms]" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-[250ms]" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="project-card reveal-item glass-card h-full rounded-2xl overflow-hidden flex flex-col justify-between group transition-all duration-300 ease-out hover:-translate-y-1.5 hover:border-cyan-400/40 hover:shadow-[0_12px_30px_-10px_rgba(34,211,238,0.18)]" data-category="{{ $project->category->slug }}">
                        <div>
                            <!-- Thumbnail / Graphic Banner -->
                            <div class="relative aspect-video overflow-hidden bg-slate-950">
                                @if($project->image)
                                    <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="project-placeholder absolute inset-0 flex items-center justify-center">
                                        <i data-lucide="terminal" class="h-10 w-10 text-cyan-200/75 transition-transform duration-300 group-hover:scale-105"></i>
                                    </div>
                                @endif
                                <span class="absolute top-3 left-3 px-2.5 py-1 rounded-md text-[11px] font-mono bg-slate-950/85 backdrop-blur-md border {{ str_contains($project->category->slug, 'iot') || str_contains($project->category->slug, 'robot') ? 'border-emerald-400/30 bg-amber-500/10 text-emerald-300' : 'border-cyan-400/30 text-cyan-300' }}">
                                    {{ $project->category->name }}
                                </span>
                            </div>

                            <div class="flex-1 p-5 space-y-3">
                                <h3 class="text-lg font-bold leading-snug group-hover:text-teal-600 dark:group-hover:text-cyanGlow transition">
                                    <a href="{{ route('projects.show', $project) }}">{{ $project->title }}</a>
                                </h3>
                                <p class="min-h-[4.5rem] text-sm text-slate-600 dark:text-slate-300 line-clamp-3 leading-relaxed">
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
                                        <a href="{{ $project->demo_url }}" target="_blank" rel="noopener noreferrer" aria-label="Buka Live Demo {{ $project->title }}" title="Live Demo" class="inline-flex items-center gap-1 text-slate-500 transition hover:text-cyan-600 dark:text-slate-400 dark:hover:text-cyan-300">
                                            <i data-lucide="external-link" class="h-3.5 w-3.5"></i>
                                            <span>Live</span>
                                        </a>
                                    @endif
                                    @if($project->github_url && $project->github_url !== 'https://github.com')
                                        <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer" aria-label="Buka GitHub {{ $project->title }}" title="GitHub Repository" class="inline-flex items-center gap-1 text-slate-500 transition hover:text-cyan-600 dark:text-slate-400 dark:hover:text-cyan-300">
                                            <svg class="github-mark h-3.5 w-3.5 shrink-0 fill-current" viewBox="0 0 24 24" aria-hidden="true">
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
            @if($projects->isNotEmpty())
                <div x-cloak x-show="visibleCount === 0" class="glass rounded-2xl p-10 text-center text-sm text-slate-500 dark:text-slate-400">
                    Tidak ada proyek yang sesuai dengan kategori yang dipilih.
                </div>
            @endif
        </section>

        <!-- ================= TECH STACK SECTION ================= -->
        <section id="skills" class="scroll-mt-24 space-y-6 reveal">
            <div>
                <p class="font-mono text-xs uppercase tracking-widest text-teal-600 dark:text-cyanGlow flex items-center gap-1.5">
                    <i data-lucide="cpu" class="w-3.5 h-3.5"></i> 02 // Tools & Technologies
                </p>
                <h2 class="text-2xl sm:text-3xl font-bold mt-1">Tech Stack & Spesialisasi</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-5">
                <!-- Group 1: Backend & Core -->
                <div class="reveal-item glass-card md:col-span-7 rounded-2xl p-6 transition-all duration-300 ease-out hover:-translate-y-1.5 hover:border-cyan-400/40 hover:shadow-[0_12px_30px_-10px_rgba(34,211,238,0.18)]">
                    <div class="grid h-full gap-6 lg:grid-cols-[1fr_0.9fr] lg:items-center">
                        <div class="space-y-4">
                            <div class="flex items-center gap-3">
                                <div class="flex h-10 w-10 items-center justify-center rounded-xl border border-rose-500/20 bg-rose-500/10 text-rose-500">
                                    <i data-lucide="server" class="h-5 w-5"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-base">Backend & Server</h3>
                                    <p class="font-mono text-[10px] text-slate-500 dark:text-slate-400">API · MVC · Eloquent ORM</p>
                                </div>
                            </div>
                            <p class="text-xs leading-relaxed text-slate-500 dark:text-slate-400">
                                Arsitektur aplikasi, REST API, dan integrasi middleware untuk akses yang terstruktur.
                            </p>
                            <div class="flex flex-wrap gap-2">
                                <span class="inline-flex items-center gap-1.5 rounded-full border border-rose-400/20 bg-rose-400/5 px-2.5 py-1 font-mono text-[10px] text-rose-700 dark:text-rose-200"><span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>Laravel 12 · Daily use</span>
                                <span class="inline-flex items-center gap-1.5 rounded-full border border-sky-400/20 bg-sky-400/5 px-2.5 py-1 font-mono text-[10px] text-sky-700 dark:text-sky-200"><span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>PHP 8.4 · Core runtime</span>
                                <span class="rounded-full bg-slate-200/60 px-2.5 py-1 font-mono text-[10px] dark:bg-slate-800/80">Composer</span>
                            </div>
                        </div>
                        <div class="overflow-hidden rounded-xl border border-white/10 bg-slate-950/95 font-mono text-[10px] shadow-inner">
                            <div class="flex items-center gap-1.5 border-b border-white/10 bg-slate-900 px-3 py-2 text-slate-500">
                                <span class="h-1.5 w-1.5 rounded-full bg-rose-400"></span><span class="h-1.5 w-1.5 rounded-full bg-amber-300"></span><span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                                <span class="ml-1">routes/api.php</span>
                            </div>
                            <div class="space-y-2 p-4 leading-relaxed text-slate-300">
                                <p><span class="text-fuchsia-300">Route</span>::get(</p>
                                <p class="pl-3 text-emerald-300">'/api/projects'</p>
                                <p class="pl-3 text-slate-500">// JSON response</p>
                                <p class="pl-3 text-cyan-200">fn () =&gt; Project::latest()-&gt;get()</p>
                                <p>);</p>
                                <div class="mt-3 flex items-center gap-2 border-t border-white/10 pt-3 text-emerald-300"><i data-lucide="arrow-right" class="h-3 w-3"></i><span>200 OK · application/json</span></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Group 2: IoT & Embedded Systems -->
                <div class="reveal-item glass-card md:col-span-5 rounded-2xl p-6 transition-all duration-300 ease-out hover:-translate-y-1.5 hover:border-cyan-400/40 hover:shadow-[0_12px_30px_-10px_rgba(34,211,238,0.18)]">
                    <div class="flex h-full flex-col justify-between gap-5">
                        <div class="flex items-start justify-between gap-3">
                            <div class="space-y-3">
                                <div class="flex h-10 w-10 items-center justify-center rounded-xl border border-emerald-500/20 bg-emerald-500/10 text-emerald-500">
                                    <i data-lucide="circuit-board" class="h-5 w-5"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-base">IoT & Robotika</h3>
                                    <p class="mt-1 text-xs leading-relaxed text-slate-500 dark:text-slate-400">Sistem embedded, sensor, dan aktuator.</p>
                                </div>
                            </div>
                            <span class="shrink-0 rounded-full border border-emerald-400/20 bg-emerald-400/5 px-2.5 py-1 font-mono text-[10px] text-emerald-700 dark:text-emerald-300">Telemetry preview</span>
                        </div>
                        <div class="rounded-xl border border-emerald-400/15 bg-slate-950/70 p-4">
                            <div class="flex items-center justify-between gap-3">
                                <div>
                                    <p class="font-mono text-sm font-semibold text-slate-100">ESP32</p>
                                    <p class="mt-1 font-mono text-[10px] text-slate-500">240MHz · Dual-Core</p>
                                </div>
                                <div class="flex h-10 w-10 items-center justify-center rounded-full border border-cyan-300/20 bg-cyan-300/5 text-cyan-300">
                                    <i data-lucide="cpu" class="h-5 w-5"></i>
                                </div>
                            </div>
                            <div class="mt-4 grid grid-cols-2 gap-2 font-mono text-[10px]">
                                <div class="flex items-center justify-between rounded-lg bg-white/5 px-2.5 py-2 text-slate-300"><span>Ultrasonic</span><span class="flex items-center gap-1 text-emerald-300"><span class="h-1.5 w-1.5 animate-pulse rounded-full bg-emerald-400"></span>Sample</span></div>
                                <div class="flex items-center justify-between rounded-lg bg-white/5 px-2.5 py-2 text-slate-300"><span>Temperature</span><span class="flex items-center gap-1 text-emerald-300"><span class="h-1.5 w-1.5 animate-pulse rounded-full bg-emerald-400"></span>Sample</span></div>
                            </div>
                            <div class="mt-3 flex h-5 items-end gap-1" aria-hidden="true">
                                <span class="h-2 w-1 rounded-full bg-emerald-400/50"></span><span class="h-4 w-1 rounded-full bg-emerald-400/80"></span><span class="h-3 w-1 rounded-full bg-cyan-300/70"></span><span class="h-5 w-1 animate-pulse rounded-full bg-cyan-300"></span><span class="h-2 w-1 rounded-full bg-emerald-400/50"></span><span class="h-4 w-1 rounded-full bg-cyan-300/80"></span><span class="h-3 w-1 rounded-full bg-emerald-400/70"></span>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-1.5">
                            <span class="rounded bg-slate-200/60 px-2 py-0.5 font-mono text-[11px] dark:bg-slate-800/80">C / C++</span>
                            <span class="rounded bg-slate-200/60 px-2 py-0.5 font-mono text-[11px] dark:bg-slate-800/80">Arduino IDE</span>
                            <span class="rounded bg-slate-200/60 px-2 py-0.5 font-mono text-[11px] dark:bg-slate-800/80">OLED</span>
                        </div>
                    </div>
                </div>

                <!-- Group 3: Database & DevOps -->
                <div class="reveal-item glass-card md:col-span-5 rounded-2xl p-6 transition-all duration-300 ease-out hover:-translate-y-1.5 hover:border-cyan-400/40 hover:shadow-[0_12px_30px_-10px_rgba(34,211,238,0.18)]">
                    <div class="flex h-full flex-col justify-between gap-5">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl border border-amber-500/20 bg-amber-500/10 text-amber-500">
                                <i data-lucide="database" class="h-5 w-5"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-base">Basis Data & Tools</h3>
                                <p class="font-mono text-[10px] text-slate-500 dark:text-slate-400">Schema · Version control · Deploy</p>
                            </div>
                        </div>
                        <div class="rounded-xl border border-white/10 bg-slate-950/80 p-4 font-mono text-[10px]">
                            <div class="flex items-center justify-between gap-3">
                                <span class="rounded-md border border-cyan-400/20 bg-cyan-400/5 px-2 py-1 text-cyan-200">projects</span>
                                <span class="flex-1 border-t border-dashed border-slate-600"></span>
                                <span class="text-amber-300">1 — N</span>
                                <span class="flex-1 border-t border-dashed border-slate-600"></span>
                                <span class="rounded-md border border-emerald-400/20 bg-emerald-400/5 px-2 py-1 text-emerald-200">tags</span>
                            </div>
                            <div class="mt-3 flex items-center gap-2 text-slate-500"><i data-lucide="git-branch" class="h-3 w-3 text-emerald-300"></i><span class="text-emerald-300">main</span><span>•</span><span>deployed</span><span class="ml-auto h-1.5 w-1.5 rounded-full bg-emerald-400"></span></div>
                        </div>
                        <div class="flex flex-wrap gap-1.5">
                            <span class="rounded bg-slate-200/60 px-2 py-0.5 font-mono text-[11px] dark:bg-slate-800/80">MySQL</span>
                            <span class="rounded bg-slate-200/60 px-2 py-0.5 font-mono text-[11px] dark:bg-slate-800/80">Supabase</span>
                            <span class="rounded bg-slate-200/60 px-2 py-0.5 font-mono text-[11px] dark:bg-slate-800/80">Git & GitHub</span>
                        </div>
                    </div>
                </div>

                <!-- Group 4: Frontend & UI -->
                <div class="reveal-item glass-card md:col-span-7 rounded-2xl p-6 transition-all duration-300 ease-out hover:-translate-y-1.5 hover:border-cyan-400/40 hover:shadow-[0_12px_30px_-10px_rgba(34,211,238,0.18)]">
                    <div class="grid h-full gap-6 lg:grid-cols-[1fr_0.9fr] lg:items-center">
                        <div class="space-y-4">
                            <div class="flex items-center gap-3">
                                <div class="flex h-10 w-10 items-center justify-center rounded-xl border border-sky-500/20 bg-sky-500/10 text-sky-500">
                                    <i data-lucide="layout" class="h-5 w-5"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-base">Frontend & Desain</h3>
                                    <p class="font-mono text-[10px] text-slate-500 dark:text-slate-400">React · Tailwind CSS · JavaScript ES6</p>
                                </div>
                            </div>
                            <p class="text-xs leading-relaxed text-slate-500 dark:text-slate-400">Komponen interaktif dan antarmuka responsif dengan pendekatan mobile-first.</p>
                            <div class="flex flex-wrap gap-1.5">
                                <span class="rounded bg-slate-200/60 px-2 py-0.5 font-mono text-[11px] dark:bg-slate-800/80">React</span>
                                <span class="rounded bg-slate-200/60 px-2 py-0.5 font-mono text-[11px] dark:bg-slate-800/80">Tailwind CSS</span>
                                <span class="rounded bg-slate-200/60 px-2 py-0.5 font-mono text-[11px] dark:bg-slate-800/80">JavaScript ES6</span>
                            </div>
                        </div>
                        <div x-data="{ previewEnabled: true }" class="rounded-xl border border-sky-400/15 bg-slate-950/80 p-4">
                            <div class="mb-4 flex items-center justify-between font-mono text-[10px] text-slate-500">
                                <span>component-preview</span>
                                <span class="text-emerald-300">● live</span>
                            </div>
                            <div class="rounded-lg border border-white/10 bg-slate-900/80 p-4">
                                <p class="mb-3 text-xs font-semibold text-slate-100">Responsive UI</p>
                                <button type="button" @click="previewEnabled = !previewEnabled" :aria-pressed="previewEnabled" class="flex w-full items-center justify-between rounded-lg bg-sky-500/10 px-3 py-2 text-xs text-sky-100 transition hover:bg-sky-500/20">
                                    <span>Interactive component</span>
                                    <span :class="previewEnabled ? 'bg-emerald-400' : 'bg-slate-500'" class="relative h-4 w-7 rounded-full transition-colors"><span :class="previewEnabled ? 'translate-x-3' : 'translate-x-0.5'" class="absolute left-0.5 top-0.5 h-3 w-3 rounded-full bg-white transition-transform"></span></span>
                                </button>
                                <div class="mt-4 flex items-center justify-between gap-2 font-mono text-[9px]">
                                    <span class="rounded bg-white/5 px-2 py-1 text-slate-400">sm · 640</span><span class="rounded bg-sky-400/15 px-2 py-1 text-sky-200">md · 768</span><span class="rounded bg-white/5 px-2 py-1 text-slate-400">lg · 1024</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ================= TIMELINE / EXPERIENCE SECTION ================= -->
        <section id="experience" class="scroll-mt-24 space-y-6 reveal">
            <div>
                <p class="font-mono text-xs uppercase tracking-widest text-teal-600 dark:text-cyanGlow flex items-center gap-1.5">
                    <i data-lucide="award" class="w-3.5 h-3.5"></i> 03 // Journey & Milestone
                </p>
                <h2 class="text-2xl sm:text-3xl font-bold mt-1">Rekam Jejak & Pendidikan</h2>
            </div>

            <div class="relative border-l-2 border-teal-500/30 dark:border-cyanGlow/25 ml-3 sm:ml-4 pl-6 sm:pl-8 space-y-8">
                <!-- Timeline Item 1 -->
                <div class="relative group reveal-item">
                    <div class="absolute -left-[31px] sm:-left-[39px] top-1.5 w-4 h-4 rounded-full bg-teal-500 dark:bg-cyanGlow border-4 border-slate-50 dark:border-navy"></div>
                    <div class="absolute -left-[31px] sm:-left-[39px] top-1.5 w-4 h-4 rounded-full bg-cyan-300/70 animate-ping" aria-hidden="true"></div>
                    <div class="glass-card rounded-2xl p-5 space-y-2 ring-1 ring-cyan-400/20 shadow-[0_0_30px_-16px_rgba(34,211,238,0.65)]">
                        <div class="flex flex-wrap items-center justify-between gap-2">
                            <h3 class="font-bold text-base text-slate-900 dark:text-white">SMKN 1 Garut — Pengembangan Perangkat Lunak & Gim (PPLG)</h3>
                            <span class="px-2.5 py-0.5 rounded-full bg-teal-500/10 text-teal-700 dark:text-cyanGlow font-mono text-xs">2024 — Sekarang (Kelas XI RPL 2)</span>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                            Mendalami rekayasa perangkat lunak berorientasi objek, perancangan basis data relasional, pengujian kode (<em class="text-cyan-300 not-italic font-medium">Unit & Feature Testing</em>), serta prototipe IoT untuk kebutuhan tugas akhir & persiapan Praktik Kerja Lapangan (PKL).
                        </p>
                    </div>
                </div>

                <!-- Timeline Item 2 -->
                <div class="relative group reveal-item">
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
                <div class="relative group reveal-item">
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
                <div class="relative group reveal-item">
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
        <section id="github" class="relative isolate scroll-mt-24 space-y-6 reveal">
            <div class="pointer-events-none absolute -inset-x-16 -inset-y-12 -z-10 rounded-[3rem] bg-[#92EEFF] blur-3xl opacity-20" aria-hidden="true"></div>
            <div>
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <p class="font-mono text-xs uppercase tracking-widest text-teal-600 dark:text-cyanGlow flex items-center gap-1.5">
                        <i data-lucide="git-pull-request" class="w-3.5 h-3.5"></i> 04 // External REST API Integration
                    </p>
                    <a href="{{ route('api.projects') }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 rounded-full border border-cyan-500/20 bg-cyan-500/5 px-3 py-1 font-mono text-[10px] text-teal-700 transition hover:border-cyan-400/50 dark:text-cyanGlow">
                        <i data-lucide="braces" class="h-3 w-3"></i> API JSON
                    </a>
                </div>
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
                <div class="glass rounded-2xl p-6 space-y-6 transition-all duration-300 ease-out hover:-translate-y-1.5 hover:border-cyan-400/40 hover:shadow-[0_12px_30px_-10px_rgba(34,211,238,0.18)]">
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
                            <a href="{{ $repo['html_url'] }}" target="_blank" rel="noopener noreferrer" class="reveal-item p-4 rounded-xl bg-slate-100/70 dark:bg-slate-900/60 border border-slate-200/70 dark:border-white/5 transition-all duration-300 ease-out hover:-translate-y-1.5 hover:border-cyan-400/40 hover:shadow-[0_12px_30px_-10px_rgba(34,211,238,0.18)] block space-y-2 group">
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
        <section id="contact" class="scroll-mt-24 grid lg:grid-cols-12 gap-8 items-start reveal">
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

                    <div class="glass-card rounded-xl p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-2 transition-all duration-300 ease-out hover:-translate-y-1 hover:border-cyan-400/40">
                        <div class="flex min-w-0 items-center gap-3.5">
                            <div class="w-9 h-9 rounded-lg bg-teal-500/10 text-teal-600 dark:text-cyanGlow flex items-center justify-center shrink-0">
                                <i data-lucide="mail" class="w-4 h-4"></i>
                            </div>
                            <a href="mailto:nazwarmakarim818@gmail.com" class="min-w-0 flex-1">
                                <span class="text-slate-400 block text-[11px]">Email Resmi</span>
                                <span class="font-semibold text-slate-800 dark:text-slate-200 break-all">nazwarmakarim818@gmail.com</span>
                            </a>
                        </div>
                        <button type="button" data-copy-value="nazwarmakarim818@gmail.com" data-copy-label="email" aria-label="Salin email" title="Copy" class="copy-contact shrink-0 self-end sm:self-auto inline-flex items-center gap-1 rounded-lg border border-slate-300/70 px-2 py-1.5 text-[10px] font-mono text-slate-600 transition hover:border-cyan-400/50 hover:text-cyan-700 dark:border-white/10 dark:text-slate-300 dark:hover:text-cyanGlow">
                            <i data-lucide="copy" class="copy-icon h-3.5 w-3.5"></i>
                            <i data-lucide="check" class="copy-success-icon hidden h-3.5 w-3.5 text-emerald-500"></i>
                            <span>Copy</span>
                        </button>
                    </div>

                    <div class="glass-card rounded-xl p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-2 transition-all duration-300 ease-out hover:-translate-y-1 hover:border-emerald-400/40">
                        <div class="flex min-w-0 items-center gap-3.5">
                            <div class="w-9 h-9 rounded-lg bg-emerald-500/10 text-emerald-500 flex items-center justify-center shrink-0">
                                <i data-lucide="phone" class="w-4 h-4"></i>
                            </div>
                            <a href="https://wa.me/6289509306601?text=Halo%20Nazwar,%20saya%20tertarik%20dengan%20portofolio%20Anda" target="_blank" rel="noopener noreferrer" class="min-w-0 flex-1">
                                <span class="text-slate-400 block text-[11px]">WhatsApp Langsung</span>
                                <span class="font-semibold text-emerald-600 dark:text-emerald-400">+62 895-0930-6601</span>
                            </a>
                        </div>
                        <button type="button" data-copy-value="+62 895-0930-6601" data-copy-label="nomor WhatsApp" aria-label="Salin nomor WhatsApp" title="Copy" class="copy-contact shrink-0 self-end sm:self-auto inline-flex items-center gap-1 rounded-lg border border-slate-300/70 px-2 py-1.5 text-[10px] font-mono text-slate-600 transition hover:border-emerald-400/50 hover:text-emerald-700 dark:border-white/10 dark:text-slate-300 dark:hover:text-emerald-300">
                            <i data-lucide="copy" class="copy-icon h-3.5 w-3.5"></i>
                            <i data-lucide="check" class="copy-success-icon hidden h-3.5 w-3.5 text-emerald-500"></i>
                            <span>Copy</span>
                        </button>
                    </div>
                </div>
                <p id="copy-feedback" class="min-h-4 text-[11px] text-rose-600 dark:text-rose-300" role="status" aria-live="polite"></p>
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
    <div id="cv-modal" x-cloak x-show="cvModalOpen" x-effect="document.body.classList.toggle('overflow-hidden', cvModalOpen)" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click.self="cvModalOpen = false" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 p-4 backdrop-blur-sm">
        <div x-show="cvModalOpen" role="dialog" aria-modal="true" aria-labelledby="cv-modal-title" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="glass rounded-3xl max-w-xl w-full p-6 sm:p-8 space-y-6 border border-teal-500/30 dark:border-cyanGlow/30 shadow-2xl relative max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between pb-4 border-b border-slate-200 dark:border-white/10">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-teal-500/10 text-teal-600 dark:text-cyanGlow flex items-center justify-center">
                        <i data-lucide="file-badge" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h3 id="cv-modal-title" class="font-bold text-lg">Curriculum Vitae Ringkas</h3>
                        <p class="text-xs font-mono text-slate-500">Nazwar Makarim Mahardhika</p>
                    </div>
                </div>
                <button type="button" @click="cvModalOpen = false" class="p-2 rounded-xl glass hover:opacity-80">
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
                <button type="button" @click="cvModalOpen = false" class="px-4 py-2 rounded-xl bg-teal-600 dark:bg-cyanGlow text-white dark:text-navy text-xs font-mono font-bold hover:opacity-90">
                    Tutup
                </button>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const hamburgerIcon = document.getElementById('hamburger-icon');
    const closeIcon = document.getElementById('close-icon');

    const closeMobileMenu = () => {
        mobileMenu?.classList.add('hidden');
        mobileMenu?.classList.remove('flex');
        hamburgerIcon?.classList.remove('hidden');
        closeIcon?.classList.add('hidden');
        mobileMenuBtn?.setAttribute('aria-expanded', 'false');
    };

    if (mobileMenuBtn && mobileMenu && hamburgerIcon && closeIcon) {
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
            mobileMenuBtn.setAttribute('aria-expanded', String(isHidden));
        });

        document.querySelectorAll('.mobile-nav-link').forEach(link => link.addEventListener('click', closeMobileMenu));
    }

    const navLinks = document.querySelectorAll('.nav-link, .mobile-nav-link');
    const navSections = document.querySelectorAll('main section[id]');
    const setActiveNavLink = (sectionId) => {
        navLinks.forEach(link => {
            const isActive = link.getAttribute('href') === `#${sectionId}`;
            link.classList.toggle('text-teal-600', isActive);
            link.classList.toggle('dark:text-cyanGlow', isActive);
            link.classList.toggle('font-semibold', isActive);
            if (isActive) {
                link.setAttribute('aria-current', 'location');
            } else {
                link.removeAttribute('aria-current');
            }
        });
    };

    if ('IntersectionObserver' in window) {
        const navObserver = new IntersectionObserver(entries => {
            const activeEntries = entries.filter(entry => entry.isIntersecting).sort((a, b) => a.boundingClientRect.top - b.boundingClientRect.top);
            if (activeEntries.length > 0) {
                setActiveNavLink(activeEntries[0].target.id);
            }
        }, { rootMargin: '-20% 0px -65% 0px' });

        navSections.forEach(section => navObserver.observe(section));
    }

    const copyFeedback = document.getElementById('copy-feedback');
    const copyTimers = new WeakMap();
    document.querySelectorAll('.copy-contact').forEach(button => {
        button.addEventListener('click', async () => {
            const value = button.dataset.copyValue;
            const label = button.dataset.copyLabel;

            try {
                if (navigator.clipboard && window.isSecureContext) {
                    await navigator.clipboard.writeText(value);
                } else {
                    const temporaryField = document.createElement('textarea');
                    temporaryField.value = value;
                    temporaryField.setAttribute('readonly', '');
                    temporaryField.style.position = 'fixed';
                    temporaryField.style.opacity = '0';
                    document.body.append(temporaryField);
                    temporaryField.select();
                    const copied = document.execCommand('copy');
                    temporaryField.remove();
                    if (!copied) {
                        throw new Error('Browser menolak akses clipboard.');
                    }
                }

                if (copyTimers.has(button)) {
                    clearTimeout(copyTimers.get(button));
                }
                button.querySelector('.copy-icon')?.classList.add('hidden');
                button.querySelector('.copy-success-icon')?.classList.remove('hidden');
                button.setAttribute('aria-label', `${label} berhasil disalin`);
                button.title = 'Disalin';
                if (copyFeedback) {
                    copyFeedback.textContent = '';
                }
                copyTimers.set(button, setTimeout(() => {
                    button.querySelector('.copy-icon')?.classList.remove('hidden');
                    button.querySelector('.copy-success-icon')?.classList.add('hidden');
                    button.setAttribute('aria-label', `Salin ${label}`);
                    button.title = 'Copy';
                }, 2000));
            } catch (error) {
                if (copyFeedback) {
                    copyFeedback.textContent = `Gagal menyalin ${label}. Periksa izin clipboard browser Anda.`;
                }
                console.error('Unable to copy portfolio contact information.', error);
            }
        });
    });

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
</script>
@endpush
