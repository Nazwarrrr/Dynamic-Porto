@extends('layouts.app')

@section('title', 'Masuk Admin — Nazwar Makarim M.')

@section('content')

    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md rounded-2xl border border-line bg-surface p-8 space-y-6 shadow-sm">
            <div class="space-y-2 text-center">
                <div class="w-12 h-12 rounded-xl bg-accent/10 border border-accent/20 flex items-center justify-center mx-auto text-accent">
                    <i data-lucide="shield-check" class="w-6 h-6"></i>
                </div>
                <h1 class="text-2xl font-bold text-ink">Admin Portal</h1>
                <p class="text-sm text-muted">Masuk sebagai admin</p>
            </div>

            @if($errors->any())
                <div class="p-3.5 rounded-xl bg-rose-500/10 border border-rose-500/30 text-rose-600 dark:text-rose-400 text-sm flex items-center gap-2">
                    <i data-lucide="alert-circle" class="w-4 h-4 shrink-0"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-ink mb-1.5">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="username" required
                        class="w-full px-4 py-2.5 rounded-xl bg-bg border border-line text-sm text-ink focus:outline-none focus:border-accent transition-colors">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-ink mb-1.5">Kata Sandi</label>
                    <input id="password" type="password" name="password" autocomplete="current-password" required placeholder="••••••••"
                        class="w-full px-4 py-2.5 rounded-xl bg-bg border border-line text-sm text-ink focus:outline-none focus:border-accent transition-colors">
                </div>
                <button type="submit" class="w-full py-3 rounded-xl bg-accent text-accent-fg font-semibold text-sm hover:opacity-90 transition-opacity flex items-center justify-center gap-2 min-h-[44px]">
                    <i data-lucide="log-in" class="w-4 h-4"></i>
                    <span>Masuk ke Dashboard</span>
                </button>
            </form>

            <div class="text-center pt-3 border-t border-line">
                <a href="{{ route('home') }}" class="text-sm text-muted hover:text-accent transition-colors inline-flex items-center gap-1.5 min-h-[44px]">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    <span>Kembali ke Portofolio</span>
                </a>
            </div>
        </div>
    </div>

@endsection
