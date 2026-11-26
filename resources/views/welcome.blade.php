@extends('layouts.app')

@section('title', 'Nazwar Makarim Mahardhika — Web & IoT Developer')

@section('content')

    <!-- Sticky Navbar -->
    <header x-data="{ scrolled: window.pageYOffset > 20 }" @scroll.window="scrolled = window.pageYOffset > 20" class="sticky top-0 z-40 border-b transition-colors duration-200" :class="scrolled ? 'border-line bg-bg/95 backdrop-blur-md' : 'border-transparent bg-bg'">
        <nav class="max-w-6xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-between gap-4">
            <a href="{{ route('home') }}" class="font-mono font-bold text-base tracking-tight text-ink flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-accent"></span>
                <span>NMM<span class="text-accent">.dev</span></span>
            </a>

            <div class="hidden lg:flex items-center gap-6 text-sm font-medium text-muted" id="desktop-nav-links">
                <a href="#projects" class="nav-link hover:text-ink transition-colors py-2">Proyek</a>
                <a href="#skills" class="nav-link hover:text-ink transition-colors py-2">Keahlian</a>
                <a href="#experience" class="nav-link hover:text-ink transition-colors py-2">Pengalaman</a>
                <a href="#github" class="nav-link hover:text-ink transition-colors py-2">GitHub</a>
                <a href="#contact" class="nav-link hover:text-ink transition-colors py-2">Kontak</a>
            </div>

            <div class="flex items-center gap-2.5">
                <button type="button" @click="toggleTheme()" aria-label="Ganti Tema" class="inline-flex items-center justify-center w-11 h-11 rounded-xl border border-line bg-surface text-ink hover:border-muted/50 transition-colors">
                    <i data-lucide="sun" class="w-4 h-4 hidden dark:block"></i>
                    <i data-lucide="moon" class="w-4 h-4 block dark:hidden"></i>
                </button>

                @auth
                    <a href="{{ route('admin.projects.index') }}" class="inline-flex items-center px-4 py-2.5 rounded-xl text-sm font-semibold bg-accent text-accent-fg hover:opacity-90 transition-opacity min-h-[44px]">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" title="Admin Login" aria-label="Admin Login" class="inline-flex items-center justify-center w-11 h-11 rounded-xl border border-line bg-surface text-ink hover:border-muted/50 transition-colors">
                        <i data-lucide="lock" class="w-4 h-4"></i>
                    </a>
                @endauth

                <button type="button" id="mobile-menu-btn" aria-label="Buka Menu" aria-expanded="false" class="lg:hidden inline-flex items-center justify-center w-11 h-11 rounded-xl border border-line bg-surface text-ink hover:border-muted/50 transition-colors">
                    <i data-lucide="menu" id="hamburger-icon" class="w-5 h-5"></i>
                    <i data-lucide="x" id="close-icon" class="w-5 h-5 hidden"></i>
                </button>
            </div>
        </nav>

        <div id="mobile-menu" class="hidden lg:hidden border-t border-line bg-surface px-4 py-4 flex-col gap-1 text-sm font-medium">
            <a href="#projects" class="mobile-nav-link px-3 py-2.5 rounded-lg text-muted hover:text-ink hover:bg-bg transition-colors">Proyek</a>
            <a href="#skills" class="mobile-nav-link px-3 py-2.5 rounded-lg text-muted hover:text-ink hover:bg-bg transition-colors">Keahlian</a>
            <a href="#experience" class="mobile-nav-link px-3 py-2.5 rounded-lg text-muted hover:text-ink hover:bg-bg transition-colors">Pengalaman</a>
            <a href="#github" class="mobile-nav-link px-3 py-2.5 rounded-lg text-muted hover:text-ink hover:bg-bg transition-colors">GitHub</a>
            <a href="#contact" class="mobile-nav-link px-3 py-2.5 rounded-lg text-muted hover:text-ink hover:bg-bg transition-colors">Kontak</a>
        </div>
    </header>

    <main class="max-w-6xl mx-auto w-full px-4 sm:px-6 pt-8 pb-20 space-y-24 flex-1">

        @if(session('success'))
            <div class="rounded-xl border border-emerald-500/30 bg-emerald-500/10 text-emerald-800 dark:text-emerald-300 px-5 py-3.5 text-sm flex items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <i data-lucide="check-circle-2" class="w-5 h-5 shrink-0"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-xs font-medium underline underline-offset-2 shrink-0 min-h-[44px] px-2">Tutup</button>
            </div>
        @endif

        <!-- ================= HERO SECTION ================= -->
        <section class="pt-8 pb-10 lg:pt-14 lg:pb-16">
            <div class="grid lg:grid-cols-12 gap-10 lg:gap-12 items-center">
                <div class="lg:col-span-7 space-y-6">
                    <p class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full border border-line bg-surface text-xs font-medium text-muted">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 shrink-0" aria-hidden="true"></span>
                        <span>XI RPL 2 · SMKN 1 Garut · Terbuka untuk PKL &amp; Proyek</span>
                    </p>

                    <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-ink leading-[1.15]">
                        Nazwar Makarim.<br>
                        <span class="text-accent">Saya membuat aplikasi web dan perangkat IoT.</span>
                    </h1>

                    <p class="text-base sm:text-lg text-muted leading-relaxed max-w-xl">
                        Siswa Rekayasa Perangkat Lunak yang berfokus membangun aplikasi web dengan <strong class="text-ink font-semibold">Laravel &amp; React</strong>, merancang basis data relasional, serta merakit prototipe mikrokontroler <strong class="text-ink font-semibold">ESP32</strong>.
                    </p>

                    <div class="flex flex-wrap items-center gap-3 pt-1">
                        <a href="#projects" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl font-semibold text-sm bg-accent text-accent-fg hover:opacity-90 transition-opacity min-h-[44px]">
                            <i data-lucide="folder-git-2" class="w-4 h-4"></i>
                            <span>Lihat Proyek</span>
                        </a>
                        <button type="button" @click="cvModalOpen = true" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl font-medium text-sm border border-line bg-surface text-ink hover:border-muted/50 transition-colors min-h-[44px]">
                            <i data-lucide="file-text" class="w-4 h-4 text-accent"></i>
                            <span>Ringkasan CV</span>
                        </button>
                    </div>

                    <div class="pt-2 flex flex-wrap items-center gap-2.5">
                        <span class="text-xs font-medium text-muted mr-1">Kontak cepat:</span>
                        <a href="https://github.com/{{ $githubUsername }}" target="_blank" rel="noopener noreferrer" aria-label="GitHub Profile" class="inline-flex items-center gap-1.5 px-3.5 py-2.5 rounded-xl border border-line bg-surface text-sm font-medium text-ink hover:border-muted/50 transition-colors min-h-[44px]">
                            <svg class="w-4 h-4 fill-current shrink-0" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"></path>
                            </svg>
                            <span>GitHub</span>
                        </a>
                        <a href="mailto:nazwarmakarim818@gmail.com" aria-label="Email Nazwar" class="inline-flex items-center gap-1.5 px-3.5 py-2.5 rounded-xl border border-line bg-surface text-sm font-medium text-ink hover:border-muted/50 transition-colors min-h-[44px]">
                            <i data-lucide="mail" class="w-4 h-4"></i>
                            <span>Email</span>
                        </a>
                        <a href="https://wa.me/6289509306601?text=Halo%20Nazwar,%20saya%20tertarik%20dengan%20portofolio%20Anda" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp Nazwar" class="inline-flex items-center gap-1.5 px-3.5 py-2.5 rounded-xl border border-line bg-surface text-sm font-medium text-ink hover:border-muted/50 transition-colors min-h-[44px]">
                            <i data-lucide="message-square" class="w-4 h-4 text-emerald-600 dark:text-emerald-400"></i>
                            <span>WhatsApp</span>
                        </a>
                    </div>
                </div>

                <!-- Right Column: Clean Profile Summary Card -->
                <div class="lg:col-span-5">
                    <div class="rounded-2xl border border-line bg-surface p-6 space-y-5">
                        <div class="flex items-center gap-4 pb-5 border-b border-line">
                            <div class="w-14 h-14 rounded-xl bg-accent/10 border border-accent/20 flex items-center justify-center font-mono font-bold text-lg text-accent shrink-0">
                                NM
                            </div>
                            <div>
                                <h2 class="font-bold text-base text-ink">Nazwar Makarim Mahardhika</h2>
                                <p class="text-sm text-muted">SMKN 1 Garut · XI RPL 2</p>
                            </div>
                        </div>

                        <dl class="space-y-3 text-sm">
                            <div class="flex items-center justify-between gap-4 py-1.5 border-b border-line/60">
                                <dt class="text-muted">Fokus Utama</dt>
                                <dd class="font-medium text-ink text-right">Web Development &amp; IoT</dd>
                            </div>
                            <div class="flex items-center justify-between gap-4 py-1.5 border-b border-line/60">
                                <dt class="text-muted">Stack Inti</dt>
                                <dd class="font-mono text-xs text-ink text-right">Laravel, React, MySQL, ESP32</dd>
                            </div>
                            <div class="flex items-center justify-between gap-4 py-1.5 border-b border-line/60">
                                <dt class="text-muted">Domisili</dt>
                                <dd class="font-medium text-ink text-right">Garut, Jawa Barat</dd>
                            </div>
                            <div class="flex items-center justify-between gap-4 py-1.5">
                                <dt class="text-muted">Proyek Tersimpan</dt>
                                <dd class="font-mono text-sm font-semibold text-accent text-right">{{ $projects->count() }} Karya</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </section>

        <!-- ================= PROJECTS SECTION ================= -->
        <section id="projects" x-data="{ activeFilter: '{{ request('category', 'all') }}', get visibleCount() { return Array.from(this.$refs.projectGrid.querySelectorAll('.project-card')).filter((card) => this.activeFilter === 'all' || card.dataset.category === this.activeFilter).length; } }" class="scroll-mt-24 space-y-6">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div>
                    <h2 class="text-2xl sm:text-3xl font-bold text-ink">Proyek Pilihan</h2>
                    <p class="text-sm text-muted mt-1">Kumpulan aplikasi web dan prototipe perangkat keras yang pernah saya bangun.</p>
                </div>

                <div class="no-scrollbar flex flex-nowrap gap-2 overflow-x-auto pb-1 sm:flex-wrap sm:overflow-visible sm:pb-0" id="project-filter-buttons">
                    <button type="button" @click="activeFilter = 'all'" :aria-pressed="activeFilter === 'all'" :class="activeFilter === 'all' ? 'bg-accent text-accent-fg font-semibold border-accent' : 'bg-surface text-muted border-line hover:text-ink'" class="filter-btn shrink-0 px-4 py-2 rounded-xl border text-sm transition-colors min-h-[44px]">
                        Semua ({{ $projects->count() }})
                    </button>
                    @foreach($categories->filter(fn ($category) => $projects->contains('category_id', $category->id)) as $cat)
                        <button type="button" @click="activeFilter = '{{ $cat->slug }}'" :aria-pressed="activeFilter === '{{ $cat->slug }}'" :class="activeFilter === '{{ $cat->slug }}' ? 'bg-accent text-accent-fg font-semibold border-accent' : 'bg-surface text-muted border-line hover:text-ink'" class="filter-btn shrink-0 px-4 py-2 rounded-xl border text-sm transition-colors min-h-[44px]">
                            {{ $cat->name }}
                        </button>
                    @endforeach
                </div>
            </div>

            <div x-ref="projectGrid" class="grid md:grid-cols-2 lg:grid-cols-3 gap-6" id="projects-grid">
                @forelse($projects as $project)
                    <x-project-card
                        :project="$project"
                        x-cloak
                        x-show="activeFilter === 'all' || activeFilter === $el.dataset.category"
                        x-transition.opacity.duration.200ms
                    />
                @empty
                    <div class="col-span-full rounded-2xl border border-line bg-surface p-12 text-center space-y-2">
                        <p class="text-base font-medium text-ink">Belum ada proyek yang ditampilkan.</p>
                        <p class="text-sm text-muted">Tambahkan proyek melalui panel admin untuk menampilkannya di sini.</p>
                    </div>
                @endforelse
            </div>

            <div x-cloak x-show="visibleCount === 0 && {{ $projects->count() }} > 0" class="rounded-2xl border border-line bg-surface p-8 text-center">
                <p class="text-sm text-muted">Belum ada proyek dalam kategori ini.</p>
            </div>
        </section>

        <!-- ================= SKILLS SECTION ================= -->
        <section id="skills" class="scroll-mt-24 space-y-6">
            <div>
                <h2 class="text-2xl sm:text-3xl font-bold text-ink">Keahlian &amp; Teknologi</h2>
                <p class="text-sm text-muted mt-1">Teknologi yang rutin saya gunakan dalam proyek sekolah maupun eksplorasi mandiri.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="rounded-2xl border border-line bg-surface p-6 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-accent/10 text-accent border border-accent/20">
                            <i data-lucide="server" class="h-5 w-5"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-base text-ink">Backend &amp; API</h3>
                            <p class="text-xs text-muted">Arsitektur MVC, Eloquent ORM, dan REST API</p>
                        </div>
                    </div>
                    <p class="text-sm leading-relaxed text-muted">
                        Merancang logika bisnis, autentikasi session, validasi input, dan penyajian endpoint JSON dengan struktur kode yang teruji.
                    </p>
                    <div class="flex flex-wrap gap-2">
                        <span class="rounded-lg bg-bg border border-line px-3 py-1 font-mono text-xs text-ink">PHP 8.4</span>
                        <span class="rounded-lg bg-bg border border-line px-3 py-1 font-mono text-xs text-ink">Laravel</span>
                        <span class="rounded-lg bg-bg border border-line px-3 py-1 font-mono text-xs text-ink">REST API</span>
                        <span class="rounded-lg bg-bg border border-line px-3 py-1 font-mono text-xs text-ink">Composer</span>
                    </div>
                </div>

                <div class="rounded-2xl border border-line bg-surface p-6 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-accent/10 text-accent border border-accent/20">
                            <i data-lucide="circuit-board" class="h-5 w-5"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-base text-ink">IoT &amp; Perangkat Embedded</h3>
                            <p class="text-xs text-muted">Mikrokontroler, sensor, dan aktuator</p>
                        </div>
                    </div>
                    <p class="text-sm leading-relaxed text-muted">
                        Mengembangkan prototipe perangkat bantu berbasis ESP32 menggunakan sensor ultrasonik, layar OLED, dan integrasi aplikasi pendamping.
                    </p>
                    <div class="flex flex-wrap gap-2">
                        <span class="rounded-lg bg-bg border border-line px-3 py-1 font-mono text-xs text-ink">ESP32</span>
                        <span class="rounded-lg bg-bg border border-line px-3 py-1 font-mono text-xs text-ink">C / C++</span>
                        <span class="rounded-lg bg-bg border border-line px-3 py-1 font-mono text-xs text-ink">Arduino IDE</span>
                        <span class="rounded-lg bg-bg border border-line px-3 py-1 font-mono text-xs text-ink">OLED &amp; Sensor</span>
                    </div>
                </div>

                <div class="rounded-2xl border border-line bg-surface p-6 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-accent/10 text-accent border border-accent/20">
                            <i data-lucide="database" class="h-5 w-5"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-base text-ink">Basis Data &amp; Deployment</h3>
                            <p class="text-xs text-muted">Skema relasional, container, dan hosting</p>
                        </div>
                    </div>
                    <p class="text-sm leading-relaxed text-muted">
                        Merancang skema database terstruktur dengan migrasi dan seeder, serta membungkus aplikasi ke dalam container Docker untuk deployment.
                    </p>
                    <div class="flex flex-wrap gap-2">
                        <span class="rounded-lg bg-bg border border-line px-3 py-1 font-mono text-xs text-ink">MySQL</span>
                        <span class="rounded-lg bg-bg border border-line px-3 py-1 font-mono text-xs text-ink">SQLite</span>
                        <span class="rounded-lg bg-bg border border-line px-3 py-1 font-mono text-xs text-ink">Docker</span>
                        <span class="rounded-lg bg-bg border border-line px-3 py-1 font-mono text-xs text-ink">Git &amp; GitHub</span>
                    </div>
                </div>

                <div class="rounded-2xl border border-line bg-surface p-6 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-accent/10 text-accent border border-accent/20">
                            <i data-lucide="layout" class="h-5 w-5"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-base text-ink">Antarmuka Web</h3>
                            <p class="text-xs text-muted">Responsif, ringan, dan mudah diakses</p>
                        </div>
                    </div>
                    <p class="text-sm leading-relaxed text-muted">
                        Menyusun antarmuka web modern dengan Blade templating, komponen UI responsif, dan interaktivitas ringan di browser.
                    </p>
                    <div class="flex flex-wrap gap-2">
                        <span class="rounded-lg bg-bg border border-line px-3 py-1 font-mono text-xs text-ink">Tailwind CSS</span>
                        <span class="rounded-lg bg-bg border border-line px-3 py-1 font-mono text-xs text-ink">React</span>
                        <span class="rounded-lg bg-bg border border-line px-3 py-1 font-mono text-xs text-ink">Alpine.js</span>
                        <span class="rounded-lg bg-bg border border-line px-3 py-1 font-mono text-xs text-ink">Vite</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- ================= EXPERIENCE SECTION ================= -->
        <section id="experience" class="scroll-mt-24 space-y-6">
            <div>
                <h2 class="text-2xl sm:text-3xl font-bold text-ink">Pendidikan &amp; Pengalaman</h2>
                <p class="text-sm text-muted mt-1">Riwayat pendidikan, pelatihan kejuruan, dan aktivitas pengembangan diri.</p>
            </div>

            <div class="relative border-l-2 border-line ml-3 pl-6 sm:pl-8 space-y-6">
                <div class="relative">
                    <span class="absolute -left-[31px] sm:-left-[39px] top-1.5 w-3.5 h-3.5 rounded-full bg-accent border-4 border-bg" aria-hidden="true"></span>
                    <div class="rounded-2xl border border-line bg-surface p-5 space-y-2">
                        <div class="flex flex-wrap items-center justify-between gap-2">
                            <h3 class="font-bold text-base text-ink">SMKN 1 Garut — Rekayasa Perangkat Lunak (XI RPL 2)</h3>
                            <span class="px-2.5 py-1 rounded-md bg-accent/10 text-accent font-mono text-xs">2024 — Sekarang</span>
                        </div>
                        <p class="text-sm text-muted leading-relaxed">
                            Mendalami rekayasa perangkat lunak berorientasi objek, perancangan basis data relasional, pengujian otomatis (Unit &amp; Feature Testing), serta prototipe IoT untuk persiapan Praktik Kerja Lapangan (PKL).
                        </p>
                    </div>
                </div>

                <div class="relative">
                    <span class="absolute -left-[31px] sm:-left-[39px] top-1.5 w-3.5 h-3.5 rounded-full bg-muted/50 border-4 border-bg" aria-hidden="true"></span>
                    <div class="rounded-2xl border border-line bg-surface p-5 space-y-2">
                        <div class="flex flex-wrap items-center justify-between gap-2">
                            <h3 class="font-bold text-base text-ink">Pelatihan LKS Cyber Security (Capture The Flag)</h3>
                            <span class="px-2.5 py-1 rounded-md bg-bg border border-line text-muted text-xs">Kompetisi Kejuruan</span>
                        </div>
                        <p class="text-sm text-muted leading-relaxed">
                            Mempelajari dasar analisis kerentanan web, keamanan jaringan, kriptografi praktis, dan pengujian penetrasi sistem menggunakan lingkungan Linux.
                        </p>
                    </div>
                </div>

                <div class="relative">
                    <span class="absolute -left-[31px] sm:-left-[39px] top-1.5 w-3.5 h-3.5 rounded-full bg-muted/50 border-4 border-bg" aria-hidden="true"></span>
                    <div class="rounded-2xl border border-line bg-surface p-5 space-y-2">
                        <div class="flex flex-wrap items-center justify-between gap-2">
                            <h3 class="font-bold text-base text-ink">Mentor Pemrograman &amp; Robotika Komunitas Sekolah</h3>
                            <span class="px-2.5 py-1 rounded-md bg-bg border border-line text-muted text-xs">Aktivitas Kolaboratif</span>
                        </div>
                        <p class="text-sm text-muted leading-relaxed">
                            Membimbing rekan siswa dalam memecahkan logika pemrograman dasar, algoritma, serta perakitan sirkuit sensor mikrokontroler.
                        </p>
                    </div>
                </div>

                <div class="relative">
                    <span class="absolute -left-[31px] sm:-left-[39px] top-1.5 w-3.5 h-3.5 rounded-full bg-muted/50 border-4 border-bg" aria-hidden="true"></span>
                    <div class="rounded-2xl border border-line bg-surface p-5 space-y-2">
                        <div class="flex flex-wrap items-center justify-between gap-2">
                            <h3 class="font-bold text-base text-ink">Bootcamp Pengembangan Web</h3>
                            <span class="px-2.5 py-1 rounded-md bg-bg border border-line text-muted text-xs">Proyek Mandiri</span>
                        </div>
                        <p class="text-sm text-muted leading-relaxed">
                            Menyelesaikan modul pemrograman web modern, integrasi REST API, version control dengan Git, dan perancangan antarmuka web.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ================= GITHUB SECTION ================= -->
        <section id="github" class="scroll-mt-24 space-y-6">
            <div class="flex flex-wrap items-end justify-between gap-4">
                <div>
                    <h2 class="text-2xl sm:text-3xl font-bold text-ink flex items-center gap-2.5">
                        <svg class="w-7 h-7 fill-current text-accent shrink-0" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"></path>
                        </svg>
                        <span>Aktivitas GitHub</span>
                    </h2>
                    <p class="text-sm text-muted mt-1">Repositori publik terbaru yang diambil langsung dari akun GitHub saya.</p>
                </div>

                <a href="{{ route('api.projects') }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 rounded-xl border border-line bg-surface px-3.5 py-2 font-mono text-xs text-muted hover:text-ink transition-colors min-h-[44px]">
                    <i data-lucide="braces" class="h-3.5 w-3.5 text-accent"></i>
                    <span>API JSON</span>
                </a>
            </div>

            @if($githubProfile)
                <div class="rounded-2xl border border-line bg-surface p-6 space-y-6">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-5 border-b border-line">
                        <div class="flex items-center gap-4">
                            <img src="{{ $githubProfile['avatar_url'] ?? 'https://avatars.githubusercontent.com/u/583231?v=4' }}" alt="GitHub Avatar {{ $githubProfile['login'] }}" width="56" height="56" loading="lazy" class="w-14 h-14 rounded-xl border border-line object-cover bg-bg" onerror="this.style.display='none'">
                            <div>
                                <h3 class="font-bold text-lg text-ink">{{ $githubProfile['name'] ?? $githubUsername }}</h3>
                                <p class="text-xs font-mono text-muted">{{ '@' . $githubProfile['login'] }} · {{ $githubProfile['bio'] ?? 'Web & IoT Developer' }}</p>
                            </div>
                        </div>
                        <div class="flex gap-3 text-xs">
                            <div class="px-4 py-2 rounded-xl bg-bg border border-line text-center">
                                <span class="block text-base font-bold font-mono text-accent">{{ $githubProfile['public_repos'] }}</span>
                                <span class="text-muted">Repos</span>
                            </div>
                            <div class="px-4 py-2 rounded-xl bg-bg border border-line text-center">
                                <span class="block text-base font-bold font-mono text-accent">{{ $githubProfile['followers'] }}</span>
                                <span class="text-muted">Followers</span>
                            </div>
                        </div>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-4">
                        @forelse($githubRepos as $repo)
                            <a href="{{ $repo['html_url'] }}" target="_blank" rel="noopener noreferrer" class="p-4 rounded-xl bg-bg border border-line hover:border-muted/50 transition-colors block space-y-2 group">
                                <div class="flex items-center justify-between gap-2">
                                    <span class="font-mono font-semibold text-sm text-ink flex items-center gap-1.5 group-hover:text-accent transition-colors truncate">
                                        <i data-lucide="book-marked" class="w-4 h-4 shrink-0 text-accent"></i>
                                        <span class="truncate">{{ $repo['name'] }}</span>
                                    </span>
                                    <span class="text-xs font-mono text-muted flex items-center gap-1 shrink-0">
                                        <i data-lucide="star" class="w-3.5 h-3.5 text-amber-500"></i>
                                        {{ $repo['stargazers_count'] ?? 0 }}
                                    </span>
                                </div>
                                <p class="text-sm leading-relaxed text-muted line-clamp-2">
                                    {{ $repo['description'] ?? 'Repositori publik tanpa deskripsi tambahan.' }}
                                </p>
                                @if($repo['language'] ?? false)
                                    <span class="inline-block text-xs font-mono text-accent">
                                        ● {{ $repo['language'] }}
                                    </span>
                                @endif
                            </a>
                        @empty
                            <p class="sm:col-span-2 text-sm text-muted text-center py-4">
                                Belum ada repositori publik yang dapat ditampilkan.
                            </p>
                        @endforelse
                    </div>
                </div>
            @else
                <div class="rounded-2xl border border-line bg-surface p-6 text-sm text-muted flex items-center gap-3">
                    <svg class="w-6 h-6 fill-current text-accent shrink-0" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"></path>
                    </svg>
                    <span>Aktivitas GitHub belum dapat dimuat. Silakan coba beberapa saat lagi.</span>
                </div>
            @endif
        </section>

        <!-- ================= CONTACT SECTION ================= -->
        <section id="contact" class="scroll-mt-24 grid lg:grid-cols-12 gap-8 items-start">
            <div class="lg:col-span-5 space-y-6">
                <div>
                    <h2 class="text-2xl sm:text-3xl font-bold text-ink">Mari Berdiskusi</h2>
                    <p class="text-sm text-muted mt-2 leading-relaxed">
                        Terbuka untuk peluang Praktik Kerja Lapangan (PKL), proyek pengembangan web, atau kolaborasi perangkat IoT.
                    </p>
                </div>

                <div class="space-y-3">
                    <div class="rounded-xl border border-line bg-surface p-4 flex items-center justify-between gap-3">
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="w-10 h-10 rounded-lg bg-accent/10 text-accent flex items-center justify-center shrink-0">
                                <i data-lucide="mail" class="w-4 h-4"></i>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs text-muted">Email</p>
                                <a href="mailto:nazwarmakarim818@gmail.com" class="text-sm font-medium text-ink hover:text-accent truncate block">nazwarmakarim818@gmail.com</a>
                            </div>
                        </div>
                        <button type="button" data-copy-value="nazwarmakarim818@gmail.com" data-copy-label="email" aria-label="Salin email" title="Copy" class="copy-contact shrink-0 inline-flex items-center justify-center w-11 h-11 rounded-lg border border-line bg-bg text-muted hover:text-ink transition-colors">
                            <i data-lucide="copy" class="copy-icon w-4 h-4"></i>
                            <i data-lucide="check" class="copy-success-icon hidden w-4 h-4 text-emerald-500"></i>
                        </button>
                    </div>

                    <div class="rounded-xl border border-line bg-surface p-4 flex items-center justify-between gap-3">
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="w-10 h-10 rounded-lg bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0">
                                <i data-lucide="phone" class="w-4 h-4"></i>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs text-muted">WhatsApp</p>
                                <a href="https://wa.me/6289509306601?text=Halo%20Nazwar,%20saya%20tertarik%20dengan%20portofolio%20Anda" target="_blank" rel="noopener noreferrer" class="text-sm font-medium text-ink hover:text-accent truncate block">+62 895-0930-6601</a>
                            </div>
                        </div>
                        <button type="button" data-copy-value="+62 895-0930-6601" data-copy-label="nomor WhatsApp" aria-label="Salin nomor WhatsApp" title="Copy" class="copy-contact shrink-0 inline-flex items-center justify-center w-11 h-11 rounded-lg border border-line bg-bg text-muted hover:text-ink transition-colors">
                            <i data-lucide="copy" class="copy-icon w-4 h-4"></i>
                            <i data-lucide="check" class="copy-success-icon hidden w-4 h-4 text-emerald-500"></i>
                        </button>
                    </div>
                </div>

                <p id="copy-feedback" class="min-h-4 text-xs text-rose-600 dark:text-rose-400" role="status" aria-live="polite"></p>
            </div>

            <div class="lg:col-span-7">
                <form action="{{ route('contact.store') }}" method="POST" id="contact-form" class="rounded-2xl border border-line bg-surface p-6 sm:p-8 space-y-4">
                    @csrf
                    <!-- Honeypot anti-spam -->
                    <input type="text" name="website" class="hidden" tabindex="-1" autocomplete="off" aria-hidden="true">

                    @if($errors->any())
                        <div class="p-3.5 rounded-xl bg-rose-500/10 border border-rose-500/30 text-rose-600 dark:text-rose-400 text-sm space-y-1">
                            @foreach($errors->all() as $error)
                                <p>• {{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label for="sender_name" class="block text-sm font-medium text-ink mb-1.5">Nama Lengkap</label>
                            <input id="sender_name" name="sender_name" value="{{ old('sender_name') }}" required maxlength="100" autocomplete="name" placeholder="Nama Anda"
                                class="w-full px-4 py-2.5 rounded-xl bg-bg border border-line text-sm text-ink focus:outline-none focus:border-accent transition-colors">
                        </div>
                        <div>
                            <label for="sender_email" class="block text-sm font-medium text-ink mb-1.5">Alamat Email</label>
                            <input id="sender_email" type="email" name="sender_email" value="{{ old('sender_email') }}" required maxlength="100" autocomplete="email" placeholder="nama@perusahaan.com"
                                class="w-full px-4 py-2.5 rounded-xl bg-bg border border-line text-sm text-ink focus:outline-none focus:border-accent transition-colors">
                        </div>
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-ink mb-1.5">Pesan</label>
                        <textarea id="message" name="message" rows="4" required maxlength="1000" placeholder="Tuliskan tawaran PKL, ide proyek, atau pertanyaan Anda..."
                            class="w-full px-4 py-2.5 rounded-xl bg-bg border border-line text-sm text-ink focus:outline-none focus:border-accent transition-colors resize-none">{{ old('message') }}</textarea>
                    </div>

                    <button type="submit" id="contact-submit-btn" class="w-full sm:w-auto px-6 py-3 rounded-xl bg-accent text-accent-fg font-semibold text-sm hover:opacity-90 transition-opacity inline-flex items-center justify-center gap-2 min-h-[44px]">
                        <i data-lucide="send" class="w-4 h-4"></i>
                        <span>Kirim Pesan</span>
                    </button>
                </form>
            </div>
        </section>

    </main>

    <footer class="max-w-6xl mx-auto w-full px-4 sm:px-6 pb-10 pt-6 text-center text-sm text-muted border-t border-line">
        © {{ date('Y') }} Nazwar Makarim Mahardhika · XI RPL 2 SMKN 1 Garut
    </footer>

    <!-- CV Summary Modal -->
    <div id="cv-modal" x-cloak x-show="cvModalOpen" x-effect="document.body.classList.toggle('overflow-hidden', cvModalOpen)" x-transition.opacity.duration.200ms @click.self="cvModalOpen = false" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 p-4 backdrop-blur-sm">
        <div x-show="cvModalOpen" role="dialog" aria-modal="true" aria-labelledby="cv-modal-title" class="rounded-2xl border border-line bg-surface max-w-xl w-full p-6 sm:p-8 space-y-6 shadow-xl relative max-h-[90vh] overflow-y-auto">
            <div class="flex items-start justify-between gap-4 pb-4 border-b border-line">
                <div>
                    <h3 id="cv-modal-title" class="font-bold text-lg text-ink">Ringkasan Curriculum Vitae</h3>
                    <p class="text-sm text-muted">Nazwar Makarim Mahardhika · XI RPL 2 SMKN 1 Garut</p>
                </div>
                <button type="button" @click="cvModalOpen = false" aria-label="Tutup modal CV" class="inline-flex items-center justify-center w-11 h-11 rounded-xl border border-line bg-bg text-muted hover:text-ink transition-colors">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>

            <div class="space-y-4 text-sm text-muted leading-relaxed">
                <div>
                    <h4 class="font-semibold text-ink mb-1">Profil Singkat</h4>
                    <p>Siswa SMK jurusan Rekayasa Perangkat Lunak dengan pengalaman membangun aplikasi web full-stack (Laravel, React, MySQL) dan prototipe perangkat IoT berbasis ESP32.</p>
                </div>
                <div>
                    <h4 class="font-semibold text-ink mb-1">Keahlian Teknis</h4>
                    <p class="font-mono text-xs text-ink">PHP 8.4 · Laravel · MySQL · Tailwind CSS · React · Alpine.js · Docker · Git · ESP32 (C/C++)</p>
                </div>
                <div>
                    <h4 class="font-semibold text-ink mb-1">Kontak</h4>
                    <p>Email: nazwarmakarim818@gmail.com · WhatsApp: +62 895-0930-6601</p>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-line">
                <button type="button" onclick="window.print()" class="px-4 py-2.5 rounded-xl border border-line bg-bg text-sm font-medium text-ink hover:border-muted/50 inline-flex items-center gap-1.5 min-h-[44px]">
                    <i data-lucide="printer" class="w-4 h-4"></i>
                    <span>Cetak</span>
                </button>
                <button type="button" @click="cvModalOpen = false" class="px-5 py-2.5 rounded-xl bg-accent text-accent-fg text-sm font-semibold hover:opacity-90 min-h-[44px]">
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
                closeMobileMenu();
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
            link.classList.toggle('text-accent', isActive);
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
            }
        });
    });

    const contactForm = document.getElementById('contact-form');
    const contactSubmitBtn = document.getElementById('contact-submit-btn');

    if (contactForm && contactSubmitBtn) {
        contactForm.addEventListener('submit', () => {
            contactSubmitBtn.disabled = true;
            contactSubmitBtn.classList.add('opacity-75', 'cursor-not-allowed');
            contactSubmitBtn.innerHTML = '<span>Mengirim...</span>';
        });
    }
</script>
@endpush
