@extends('layouts.app')

@section('title', $project->title . ' — Studi Kasus Portofolio | Nazwar Makarim M.')

@section('content')

    <!-- Floating Top Bar -->
    <header class="fixed top-3 inset-x-0 z-50 px-4">
        <nav class="max-w-4xl mx-auto glass rounded-2xl px-5 py-3.5 flex items-center justify-between shadow-lg shadow-slate-900/5 dark:shadow-black/40">
            <a href="{{ route('home') }}#projects" class="text-xs sm:text-sm font-mono text-slate-600 dark:text-slate-300 hover:text-teal-600 dark:hover:text-cyanGlow transition flex items-center gap-1.5 font-medium">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                <span>Kembali ke Portofolio</span>
            </a>

            <div class="flex items-center gap-2.5">
                <button type="button" onclick="toggleAppTheme()" aria-label="Ganti Tema" class="p-2 rounded-xl glass hover:border-teal-500/50 dark:hover:border-cyanGlow/50 transition">
                    <i data-lucide="sun" class="w-4 h-4 hidden dark:block text-cyanGlow"></i>
                    <i data-lucide="moon" class="w-4 h-4 block dark:hidden text-slate-700"></i>
                </button>
                <a href="{{ route('home') }}#contact" class="px-3.5 py-1.5 rounded-xl text-xs font-mono font-semibold bg-teal-600 dark:bg-cyanGlow text-white dark:text-navy hover:opacity-90 transition shadow-sm">
                    Diskusi Proyek
                </a>
            </div>
        </nav>
    </header>

    <main class="max-w-4xl mx-auto px-4 pt-28 pb-20 space-y-10">

        <!-- Breadcrumbs & Meta -->
        <div class="space-y-4 reveal">
            <div class="flex flex-wrap items-center gap-2 text-xs font-mono text-slate-500 dark:text-slate-400">
                <a href="{{ route('home') }}" class="hover:underline">Home</a>
                <span>/</span>
                <a href="{{ route('home') }}#projects" class="hover:underline">Proyek</a>
                <span>/</span>
                <span class="text-teal-600 dark:text-cyanGlow">{{ $project->category->name }}</span>
            </div>

            <div class="space-y-2">
                <span class="inline-block px-3 py-1 rounded-md text-xs font-mono bg-teal-500/10 dark:bg-cyanGlow/10 text-teal-700 dark:text-cyanGlow border border-teal-500/20 dark:border-cyanGlow/20">
                    {{ $project->category->name }}
                </span>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight">
                    {{ $project->title }}
                </h1>
                <p class="text-xs font-mono text-slate-500">
                    Ditambahkan pada {{ $project->created_at->format('d F Y') }} • Nazwar Makarim Mahardhika
                </p>
            </div>
        </div>

        <!-- Project Hero Media -->
        <div class="glass-card rounded-3xl overflow-hidden reveal shadow-2xl border border-teal-500/20 dark:border-cyanGlow/20">
            @if($project->image)
                <div class="w-full max-h-[460px] overflow-hidden bg-slate-900 flex items-center justify-center">
                    <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
                </div>
            @else
                <div class="w-full h-64 sm:h-80 bg-gradient-to-br from-teal-900/40 via-slate-900 to-cyan-950/40 flex flex-col items-center justify-center p-6 text-center space-y-3">
                    <div class="w-16 h-16 rounded-2xl bg-teal-500/10 border border-teal-500/20 flex items-center justify-center text-teal-400 dark:text-cyanGlow">
                        <i data-lucide="layers" class="w-8 h-8"></i>
                    </div>
                    <p class="text-xs font-mono text-slate-400">Pratinjau visual belum diunggah untuk proyek ini.</p>
                </div>
            @endif

            <!-- Quick Action Links Bar -->
            <div class="p-6 bg-slate-100/50 dark:bg-slate-900/60 border-t border-slate-200/60 dark:border-white/10 flex flex-wrap items-center justify-between gap-4">
                <div class="flex flex-wrap gap-1.5 items-center">
                    <span class="text-xs font-mono text-slate-400 mr-2">Teknologi:</span>
                    @foreach(explode(',', $project->tech_stack) as $tech)
                        <span class="px-2.5 py-1 rounded text-xs font-mono bg-slate-200/80 dark:bg-slate-800 text-slate-800 dark:text-slate-200 border border-slate-300/50 dark:border-white/5">
                            {{ trim($tech) }}
                        </span>
                    @endforeach
                </div>

                <div class="flex items-center gap-3">
                    @if($project->demo_url && $project->demo_url !== '#')
                        <a href="{{ $project->demo_url }}" target="_blank" rel="noopener noreferrer" class="px-4 py-2 rounded-xl text-xs font-mono font-semibold bg-teal-600 dark:bg-cyanGlow text-white dark:text-navy hover:opacity-90 transition flex items-center gap-1.5 shadow-sm">
                            <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                            <span>Buka Live Demo</span>
                        </a>
                    @endif

                    @if($project->github_url && $project->github_url !== 'https://github.com')
                        <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer" class="px-4 py-2 rounded-xl text-xs font-mono font-medium glass hover:border-teal-500/50 dark:hover:border-cyanGlow/50 transition flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 fill-current shrink-0" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"></path>
                            </svg>
                            <span>Source Code</span>
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Case Study Details & Narrative -->
        <section class="glass rounded-3xl p-6 sm:p-10 space-y-8 reveal">
            <div class="space-y-4">
                <h2 class="text-xl sm:text-2xl font-bold flex items-center gap-2 text-slate-900 dark:text-white">
                    <i data-lucide="file-text" class="w-5 h-5 text-teal-600 dark:text-cyanGlow"></i>
                    <span>Deskripsi & Ruang Lingkup Proyek</span>
                </h2>
                <div class="text-sm sm:text-base leading-relaxed text-slate-700 dark:text-slate-300 whitespace-pre-line space-y-4 font-sans">
                    {{ $project->description }}
                </div>
            </div>

            <!-- Technical Summary Box -->
            <div class="p-6 rounded-2xl bg-slate-100/70 dark:bg-slate-900/70 border border-slate-200 dark:border-white/10 space-y-3 font-mono text-xs">
                <p class="text-teal-600 dark:text-cyanGlow font-bold uppercase tracking-wider text-[11px]">// INFORMASI ARSITEKTUR SISTEM</p>
                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <span class="text-slate-400 block text-[10px]">KATEGORI PROYEK</span>
                        <span class="font-semibold text-slate-800 dark:text-slate-200 text-sm">{{ $project->category->name }}</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[10px]">PENGEMBANG</span>
                        <span class="font-semibold text-slate-800 dark:text-slate-200 text-sm">Nazwar Makarim M. (XI RPL 2)</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[10px]">ENDPOINT API DATA</span>
                        <a href="{{ route('api.projects') }}" target="_blank" class="text-teal-600 dark:text-cyanGlow hover:underline">/api/projects</a>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[10px]">STATUS IMPLEMENTASI</span>
                        <span class="text-emerald-500 font-semibold">Terdokumentasi & Terverifikasi</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Bottom CTA -->
        <div class="glass-card rounded-2xl p-6 sm:p-8 flex flex-col sm:flex-row items-center justify-between gap-6 reveal">
            <div class="space-y-1 text-center sm:text-left">
                <h3 class="text-lg font-bold">Tertarik dengan studi kasus ini?</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400">Mari diskusikan implementasi teknis atau kolaborasi proyek serupa.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}#projects" class="px-4 py-2.5 rounded-xl glass text-xs font-mono font-medium hover:border-teal-500/50 dark:hover:border-cyanGlow/50 transition">
                    ← Semua Proyek
                </a>
                <a href="{{ route('home') }}#contact" class="px-5 py-2.5 rounded-xl bg-teal-600 dark:bg-cyanGlow text-white dark:text-navy text-xs font-mono font-bold hover:opacity-90 transition">
                    Hubungi Saya
                </a>
            </div>
        </div>

    </main>

    <footer class="max-w-4xl mx-auto px-4 pb-12 text-center text-xs font-mono text-slate-500 dark:text-slate-400 border-t border-slate-200/50 dark:border-white/5 pt-6">
        © {{ date('Y') }} Nazwar Makarim Mahardhika · Siswa XI RPL 2 SMKN 1 Garut
    </footer>

@endsection
