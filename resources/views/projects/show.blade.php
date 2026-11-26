@extends('layouts.app')

@section('title', $project->title.' — Studi Kasus | Nazwar Makarim')
@section('description', Str::limit($project->summary ?? $project->description, 155))

@section('content')
@php
    $stack = collect(explode(',', $project->tech_stack))->map(fn ($t) => trim($t))->implode(', ');
@endphp

<article class="mx-auto max-w-4xl px-5 pb-24 pt-32">
    <a href="{{ route('home') }}#projects" class="ulink py-2 text-sm text-muted hover:text-ink">Semua proyek</a>

    <p class="mt-10 text-muted">{{ $project->category->name }}@if($project->year), {{ $project->year }}@endif</p>
    <h1 class="mt-3 font-display text-[clamp(2.25rem,6vw,4.5rem)] font-semibold leading-none tracking-[-0.03em]">{{ $project->title }}</h1>
    @if($project->summary)
        <p class="mt-6 max-w-2xl text-xl leading-relaxed text-muted">{{ $project->summary }}</p>
    @endif

    <x-project-cover :project="$project" class="mt-12 aspect-video rounded-sm" />

    <dl class="mt-10 grid gap-6 border-y border-line py-6 text-sm sm:grid-cols-3">
        @if($project->role)
            <div><dt class="text-muted">Peran</dt><dd class="mt-1 font-medium">{{ $project->role }}</dd></div>
        @endif
        <div class="{{ $project->role ? 'sm:col-span-2' : 'sm:col-span-3' }}"><dt class="text-muted">Teknologi</dt><dd class="mt-1 font-medium">{{ $stack }}</dd></div>
    </dl>

    @foreach(['problem' => 'Masalah', 'description' => 'Solusi', 'outcome' => 'Hasil'] as $field => $label)
        @if($project->$field)
            <section class="mt-12 grid gap-4 lg:grid-cols-12">
                <h2 class="font-display text-2xl font-semibold tracking-tight lg:col-span-4">{{ $label }}</h2>
                <p class="whitespace-pre-line text-lg leading-relaxed text-muted lg:col-span-8">{{ $project->$field }}</p>
            </section>
        @endif
    @endforeach

    <div class="mt-16 flex flex-wrap items-center gap-x-8 gap-y-4 border-t border-line pt-8">
        @if($project->demo_url)<a href="{{ $project->demo_url }}" target="_blank" rel="noopener noreferrer" class="btn">Buka demo</a>@endif
        @if($project->github_url)<a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer" class="ulink py-2 font-medium">Lihat kode</a>@endif
        <a href="{{ route('home') }}#contact" class="ulink py-2 font-medium">Diskusikan proyek ini</a>
    </div>
</article>

@endsection
