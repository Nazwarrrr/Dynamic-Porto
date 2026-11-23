@extends('layouts.app')

@section('title', 'Admin Portal Login — NMM.dev')

@section('content')

    <div class="min-h-screen flex items-center justify-center p-4 relative overflow-hidden">
        <div class="w-full max-w-md glass rounded-3xl p-8 space-y-6 relative z-10 shadow-2xl border border-teal-500/20 dark:border-cyanGlow/20">
            <!-- Header Icon & Title -->
            <div class="space-y-2 text-center">
                <div class="w-14 h-14 rounded-2xl bg-teal-500/10 border border-teal-500/30 dark:border-cyanGlow/30 flex items-center justify-center mx-auto text-teal-600 dark:text-cyanGlow shadow-neon">
                    <i data-lucide="shield-check" class="w-7 h-7"></i>
                </div>
                <h1 class="text-2xl font-bold">Admin Portal</h1>
                <p class="text-xs font-mono text-slate-500 dark:text-slate-400">Area Terproteksi Middleware Auth</p>
            </div>

            <!-- Error Notification -->
            @if($errors->any())
                <div class="p-3.5 rounded-xl bg-rose-500/10 border border-rose-500/30 text-rose-400 text-xs font-mono flex items-center gap-2">
                    <i data-lucide="alert-circle" class="w-4 h-4 shrink-0"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <!-- Login Form -->
            <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-mono mb-1.5 font-medium">Email Administrator</label>
                    <input type="email" name="email" value="{{ old('email', 'admin@nazwar.dev') }}" autocomplete="username" required
                        class="w-full px-4 py-2.5 rounded-xl bg-slate-100/70 dark:bg-slate-900/80 border border-slate-200 dark:border-white/10 text-sm focus:outline-none focus:border-teal-500 dark:focus:border-cyanGlow transition">
                </div>
                <div>
                    <label class="block text-xs font-mono mb-1.5 font-medium">Kata Sandi</label>
                    <input type="password" name="password" autocomplete="current-password" required placeholder="••••••••"
                        class="w-full px-4 py-2.5 rounded-xl bg-slate-100/70 dark:bg-slate-900/80 border border-slate-200 dark:border-white/10 text-sm focus:outline-none focus:border-teal-500 dark:focus:border-cyanGlow transition">
                </div>
                <button type="submit" class="w-full py-3 rounded-xl bg-teal-600 dark:bg-cyanGlow text-white dark:text-navy font-bold text-sm hover:opacity-90 hover:scale-[1.01] transition shadow-md flex items-center justify-center gap-2">
                    <i data-lucide="log-in" class="w-4 h-4"></i>
                    <span>Masuk ke Dashboard</span>
                </button>
            </form>

            <div class="text-center pt-2 border-t border-slate-200/60 dark:border-white/5">
                <a href="{{ route('home') }}" class="text-xs font-mono text-slate-500 hover:text-teal-600 dark:hover:text-cyanGlow transition inline-flex items-center gap-1.5">
                    <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
                    <span>Kembali ke Portofolio</span>
                </a>
            </div>
        </div>
    </div>

@endsection
