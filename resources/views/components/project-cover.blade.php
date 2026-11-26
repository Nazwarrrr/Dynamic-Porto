@props(['project'])
<div {{ $attributes->merge(['class' => 'relative overflow-hidden bg-bg']) }}>
    <div class="project-placeholder absolute inset-0 grid place-items-center font-mono text-3xl font-semibold text-muted/45 select-none" aria-hidden="true">
        {{ Str::of($project->title)->before(' —')->substr(0, 2)->upper() }}
    </div>
    @if($project->image)
        <img src="{{ asset('storage/'.$project->image) }}"
             alt="Tangkapan layar {{ $project->title }}"
             loading="lazy" decoding="async" onerror="this.remove()"
             class="relative size-full object-cover">
    @endif
</div>
