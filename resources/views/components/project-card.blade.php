@props(['project'])
@php
    $demoUrl = filled($project->demo_url) && $project->demo_url !== '#' ? $project->demo_url : null;
    $githubUrl = filled($project->github_url) && $project->github_url !== 'https://github.com' ? $project->github_url : null;
@endphp
<article {{ $attributes->merge(['class' => 'project-card flex flex-col overflow-hidden rounded-xl border border-line bg-surface transition-colors hover:border-muted/40']) }}
         data-category="{{ $project->category->slug }}">
    <a href="{{ route('projects.show', $project) }}" tabindex="-1" aria-hidden="true" class="block">
        <x-project-cover :project="$project" class="aspect-[16/10] border-b border-line" />
    </a>

    <div class="flex flex-1 flex-col gap-2 p-5">
        <p class="text-xs font-medium text-muted">{{ $project->category->name }}</p>
        <h3 class="text-lg font-semibold leading-snug text-ink">
            <a href="{{ route('projects.show', $project) }}" class="underline-offset-4 hover:underline">{{ $project->title }}</a>
        </h3>
        <p class="line-clamp-3 text-sm leading-relaxed text-muted">{{ $project->description }}</p>
        <p class="mt-auto pt-3 font-mono text-xs text-muted">
            {{ collect(explode(',', $project->tech_stack))->map(fn ($t) => trim($t))->filter()->implode(' · ') }}
        </p>
    </div>

    <div class="flex divide-x divide-line border-t border-line text-sm">
        <a href="{{ route('projects.show', $project) }}" class="flex-1 px-5 py-3 font-medium text-accent hover:bg-accent/5 transition-colors">Baca studi kasus</a>
        @if($demoUrl)
            <a href="{{ $demoUrl }}" target="_blank" rel="noopener noreferrer" aria-label="Buka Live Demo {{ $project->title }}" class="px-5 py-3 text-muted hover:text-ink transition-colors">Demo ↗</a>
        @endif
        @if($githubUrl)
            <a href="{{ $githubUrl }}" target="_blank" rel="noopener noreferrer" aria-label="Buka GitHub {{ $project->title }}" class="px-5 py-3 text-muted hover:text-ink transition-colors">Kode ↗</a>
        @endif
    </div>
</article>
