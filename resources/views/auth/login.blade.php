@extends('layouts.app')

@section('title', 'Masuk Admin — Nazwar Makarim')

@section('content')

<header class="border-b border-line bg-bg">
    <nav class="mx-auto flex h-16 max-w-6xl items-center justify-between px-5">
        <a href="{{ route('home') }}" class="font-display text-lg font-semibold tracking-tight">Nazwar Makarim</a>
        <div class="flex items-center gap-6 text-sm">
            <a href="{{ route('home') }}" class="ulink text-muted hover:text-ink">Kembali ke portofolio</a>
            <button type="button" onclick="toggleAppTheme()" aria-label="Ganti tema" class="-mr-3 grid size-11 place-items-center rounded-full text-muted hover:text-ink">
                <svg class="hidden size-5 dark:block" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" aria-hidden="true"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/></svg>
                <svg class="size-5 dark:hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" aria-hidden="true"><path d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8z"/></svg>
            </button>
        </div>
    </nav>
</header>

<main class="flex flex-1 items-center justify-center px-5 py-16">
    <div class="w-full max-w-md space-y-8 rounded-sm border border-line bg-surface p-8 sm:p-10">
        <div>
            <p class="text-sm font-medium text-accent">Panel Admin</p>
            <h1 class="mt-2 font-display text-3xl font-semibold tracking-tight">Masuk untuk mengelola portofolio.</h1>
        </div>

        @if($errors->any())
            <p role="alert" class="rounded-sm border border-red-500/30 bg-red-500/10 px-4 py-3 text-sm text-red-700 dark:text-red-300">
                {{ $errors->first() }}
            </p>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="email" class="text-sm text-muted">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="username" required class="field">
            </div>
            <div>
                <label for="password" class="text-sm text-muted">Kata sandi</label>
                <input id="password" type="password" name="password" autocomplete="current-password" required placeholder="••••••••" class="field">
            </div>
            <div class="pt-2">
                <button type="submit" class="btn w-full justify-center">Masuk</button>
            </div>
        </form>
    </div>
</main>

@endsection
