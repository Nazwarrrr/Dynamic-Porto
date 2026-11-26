@props(['project', 'lead' => false])
@php
    $summary = $project->summary ?? Str::limit($project->description, $lead ? 220 : 130);
    $stack = collect(explode(',', $project->tech_stack))->map(fn ($t) => trim($t))->implode(', ');
@endphp
<article class="group {{ $lead ? 'grid gap-8 lg:grid-cols-12 lg:items-end' : '' }}">
    <a href="{{ route('projects.show', $project) }}" tabindex="-1" aria-hidden="true"
       class="block overflow-hidden rounded-sm {{ $lead ? 'lg:col-span-8' : '' }}">
        <x-project-cover :project="$project" class="{{ $lead ? 'aspect-[16/10]' : 'aspect-[4/3]' }}" />
    </a>
    <div class="mt-5 {{ $lead ? 'lg:col-span-4 lg:mt-0' : '' }}">
        <p class="text-sm text-muted">{{ $project->category->name }}@if($project->year), {{ $project->year }}@endif</p>
        <h3 class="mt-2 font-display font-semibold leading-tight tracking-tight {{ $lead ? 'text-3xl sm:text-4xl' : 'text-2xl' }}">
            <a href="{{ route('projects.show', $project) }}" class="ulink">{{ $project->title }}</a>
        </h3>
        <p class="mt-3 max-w-prose leading-relaxed text-muted">{{ $summary }}</p>
        <p class="mt-3 text-sm text-muted">{{ $stack }}</p>
        <div class="mt-4 flex flex-wrap gap-x-6 gap-y-1 text-sm font-medium">
            <a href="{{ route('projects.show', $project) }}" class="ulink py-1 text-accent">Baca studi kasus</a>
            @if(filled($project->demo_url) && $project->demo_url !== '#')
                <a href="{{ $project->demo_url }}" target="_blank" rel="noopener noreferrer" aria-label="Buka Live Demo {{ $project->title }}" class="ulink py-1">Demo ↗</a>
            @endif
            @if(filled($project->github_url) && rtrim($project->github_url, '/') !== 'https://github.com')
                <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer" aria-label="Buka GitHub {{ $project->title }}" class="ulink py-1">Kode ↗</a>
            @endif
        </div>
    </div>
</article>
