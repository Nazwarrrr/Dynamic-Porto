@props(['project'])
<div {{ $attributes->merge(['class' => 'relative overflow-hidden bg-surface', 'style' => 'view-transition-name: cover-'.$project->id]) }}>
    <div class="pattern absolute inset-0 grid place-items-center p-6 text-center" aria-hidden="true">
        <span class="font-display text-[clamp(1.5rem,4vw,3rem)] font-semibold tracking-tight text-muted/60">{{ Str::of($project->title)->before(' —') }}</span>
    </div>
    @if($project->image)
        <img src="{{ asset('storage/'.$project->image) }}" alt="Tangkapan layar {{ $project->title }}"
             loading="lazy" decoding="async" onerror="this.remove()"
             class="relative size-full object-cover transition-transform duration-700 ease-out group-hover:scale-[1.03]">
    @endif
</div>
