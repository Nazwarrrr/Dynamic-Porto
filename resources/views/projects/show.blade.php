@extends('layouts.app')

@section('title', $project->title . ' — Studi Kasus | Nazwar Makarim M.')

@section('content')

    <header class="sticky top-0 z-40 border-b border-line bg-bg/90 backdrop-blur-md">
        <nav class="max-w-4xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-between gap-4">
            <a href="{{ route('home') }}#projects" class="inline-flex items-center gap-2 text-sm font-medium text-muted hover:text-ink transition-colors min-h-[44px]">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                <span>Kembali ke Portofolio</span>
            </a>

            <div class="flex items-center gap-3">
                <button type="button" @click="toggleTheme()" aria-label="Ganti Tema" class="inline-flex items-center justify-center w-11 h-11 rounded-xl border border-line bg-surface text-ink hover:border-muted/50 transition-colors">
                    <i data-lucide="sun" class="w-4 h-4 hidden dark:block"></i>
                    <i data-lucide="moon" class="w-4 h-4 block dark:hidden"></i>
                </button>
                <a href="{{ route('home') }}#contact" class="inline-flex items-center px-4 py-2.5 rounded-xl text-sm font-semibold bg-accent text-accent-fg hover:opacity-90 transition-opacity min-h-[44px]">
                    Diskusi Proyek
                </a>
            </div>
        </nav>
    </header>

    <main class="max-w-4xl mx-auto w-full px-4 sm:px-6 py-10 sm:py-14 space-y-10 flex-1">

        <!-- Breadcrumbs & Title -->
        <div class="space-y-4">
            <nav aria-label="Breadcrumb" class="flex flex-wrap items-center gap-2 text-sm text-muted">
                <a href="{{ route('home') }}" class="hover:text-ink transition-colors">Beranda</a>
                <span>/</span>
                <a href="{{ route('home') }}#projects" class="hover:text-ink transition-colors">Proyek</a>
                <span>/</span>
                <span class="text-accent font-medium">{{ $project->category->name }}</span>
            </nav>

            <div class="space-y-2.5">
                <span class="inline-block px-3 py-1 rounded-lg text-xs font-medium bg-accent/10 text-accent border border-accent/20">
                    {{ $project->category->name }}
                </span>
                <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-ink leading-tight">
                    {{ $project->title }}
                </h1>
                <p class="text-sm text-muted">
                    Ditambahkan {{ $project->created_at->format('d F Y') }} · Nazwar Makarim Mahardhika
                </p>
            </div>
        </div>

        <!-- Project Hero Media & Action Bar -->
        <div class="rounded-2xl overflow-hidden border border-line bg-surface">
            <x-project-cover :project="$project" class="aspect-[16/9] w-full" />

            <div class="p-5 sm:p-6 bg-bg/50 border-t border-line flex flex-wrap items-center justify-between gap-4">
                <div class="flex flex-wrap gap-2 items-center">
                    <span class="text-xs font-medium text-muted mr-1">Teknologi:</span>
                    @foreach(explode(',', $project->tech_stack) as $tech)
                        <span class="px-2.5 py-1 rounded-md text-xs font-mono bg-surface text-ink border border-line">
                            {{ trim($tech) }}
                        </span>
                    @endforeach
                </div>

                <div class="flex flex-wrap items-center gap-3">
                    @if($project->demo_url && $project->demo_url !== '#')
                        <a href="{{ $project->demo_url }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl text-sm font-semibold bg-accent text-accent-fg hover:opacity-90 transition-opacity min-h-[44px]">
                            <i data-lucide="external-link" class="w-4 h-4"></i>
                            <span>Buka Live Demo</span>
                        </a>
                    @endif

                    @if($project->github_url && $project->github_url !== 'https://github.com')
                        <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl text-sm font-medium border border-line bg-surface text-ink hover:border-muted/50 transition-colors min-h-[44px]">
                            <svg class="w-4 h-4 fill-current shrink-0" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"></path>
                            </svg>
                            <span>Source Code</span>
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Case Study Narrative -->
        <section class="rounded-2xl border border-line bg-surface p-6 sm:p-8 space-y-8">
            <div class="space-y-4">
                <h2 class="text-xl font-bold flex items-center gap-2 text-ink">
                    <i data-lucide="file-text" class="w-5 h-5 text-accent"></i>
                    <span>Deskripsi & Ruang Lingkup Proyek</span>
                </h2>
                <div class="text-base leading-relaxed text-muted whitespace-pre-line">
                    {{ $project->description }}
                </div>
            </div>

            <div class="p-5 sm:p-6 rounded-xl bg-bg border border-line space-y-4">
                <h3 class="text-sm font-semibold text-ink">Detail proyek</h3>
                <div class="grid sm:grid-cols-3 gap-4 text-sm">
                    <div>
                        <span class="text-xs text-muted block mb-1">Kategori</span>
                        <span class="font-medium text-ink">{{ $project->category->name }}</span>
                    </div>
                    <div>
                        <span class="text-xs text-muted block mb-1">Pengembang</span>
                        <span class="font-medium text-ink">Nazwar Makarim M. (XI RPL 2)</span>
                    </div>
                    <div>
                        <span class="text-xs text-muted block mb-1">Endpoint JSON</span>
                        <a href="{{ route('api.projects') }}" target="_blank" class="font-mono text-xs text-accent hover:underline">/api/projects</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Bottom CTA -->
        <div class="rounded-2xl border border-line bg-surface p-6 sm:p-8 flex flex-col sm:flex-row items-center justify-between gap-6">
            <div class="space-y-1 text-center sm:text-left">
                <h3 class="text-lg font-bold text-ink">Tertarik dengan proyek ini?</h3>
                <p class="text-sm text-muted">Mari diskusikan detail teknis atau peluang kerja sama.</p>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('home') }}#projects" class="px-4 py-2.5 rounded-xl border border-line bg-bg text-sm font-medium text-ink hover:border-muted/50 transition-colors min-h-[44px] inline-flex items-center">
                    ← Semua Proyek
                </a>
                <a href="{{ route('home') }}#contact" class="px-5 py-2.5 rounded-xl bg-accent text-accent-fg text-sm font-semibold hover:opacity-90 transition-opacity min-h-[44px] inline-flex items-center">
                    Hubungi Saya
                </a>
            </div>
        </div>

    </main>

    <footer class="max-w-4xl mx-auto w-full px-4 sm:px-6 pb-10 pt-6 text-center text-sm text-muted border-t border-line">
        © {{ date('Y') }} Nazwar Makarim Mahardhika · XI RPL 2 SMKN 1 Garut
    </footer>

@endsection
