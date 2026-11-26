@props(['project'])
@php
    $demoUrl = filled($project->demo_url) && $project->demo_url !== '#' ? $project->demo_url : null;
    $githubUrl = filled($project->github_url) && $project->github_url !== 'https://github.com' ? $project->github_url : null;
@endphp
<article {{ $attributes->merge(['class' => 'project-card group flex flex-col overflow-hidden rounded-2xl border border-line bg-surface shadow-sm transition-all duration-200 hover:-translate-y-1 hover:border-accent/45 hover:shadow-lg hover:shadow-accent/5']) }}
         data-category="{{ $project->category->slug }}">
    <a href="{{ route('projects.show', $project) }}" tabindex="-1" aria-hidden="true" class="relative block overflow-hidden">
        <x-project-cover :project="$project" class="aspect-[16/10] border-b border-line transition-transform duration-300 group-hover:scale-[1.02]" />
        <span class="absolute top-3 left-3 px-2.5 py-1 rounded-lg text-xs font-medium bg-surface/95 text-ink border border-line shadow-sm">
            {{ $project->category->name }}
        </span>
    </a>

    <div class="flex flex-1 flex-col gap-2.5 p-5">
        <h3 class="text-lg font-bold leading-snug text-ink group-hover:text-accent transition-colors">
            <a href="{{ route('projects.show', $project) }}">{{ $project->title }}</a>
        </h3>
        <p class="line-clamp-3 text-sm leading-relaxed text-muted">{{ $project->description }}</p>

        <div class="mt-auto pt-3 flex flex-wrap gap-1.5">
            @foreach(array_slice(explode(',', $project->tech_stack), 0, 4) as $tech)
                @if(trim($tech) !== '')
                    <span class="px-2.5 py-0.5 rounded-md text-xs font-mono bg-surface-subtle text-ink border border-line">
                        {{ trim($tech) }}
                    </span>
                @endif
            @endforeach
        </div>
    </div>

    <div class="flex divide-x divide-line border-t border-line bg-surface-subtle/40 text-sm">
        <a href="{{ route('projects.show', $project) }}" class="flex-1 px-5 py-3 font-semibold text-accent hover:bg-accent/5 transition-colors flex items-center justify-between">
            <span>Baca studi kasus</span>
            <span aria-hidden="true" class="transition-transform group-hover:translate-x-0.5">→</span>
        </a>
        @if($demoUrl)
            <a href="{{ $demoUrl }}" target="_blank" rel="noopener noreferrer" aria-label="Buka Live Demo {{ $project->title }}" class="px-4 py-3 font-medium text-muted hover:text-ink transition-colors">Demo ↗</a>
        @endif
        @if($githubUrl)
            <a href="{{ $githubUrl }}" target="_blank" rel="noopener noreferrer" aria-label="Buka GitHub {{ $project->title }}" class="px-4 py-3 font-medium text-muted hover:text-ink transition-colors">Kode ↗</a>
        @endif
    </div>
</article>
