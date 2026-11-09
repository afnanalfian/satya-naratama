@props(['label', 'value', 'icon' => 'chart', 'tone' => 'garnet', 'hint' => null, 'href' => null])
@php
    $tones = ['garnet' => 'bg-garnet-50 text-garnet-600', 'gold' => 'bg-saffron-50 text-saffron-600', 'lagoon' => 'bg-lagoon-50 text-lagoon-600', 'ink' => 'bg-ink-50 text-ink-600', 'sky' => 'bg-sky-50 text-sky-600'];
    $bars = ['garnet' => 'bg-garnet-500', 'gold' => 'bg-saffron-400', 'lagoon' => 'bg-lagoon-500', 'ink' => 'bg-ink-500', 'sky' => 'bg-sky-500'];
    $tag = $href ? 'a' : 'div';
@endphp
<{{ $tag }} @if($href) href="{{ $href }}" @endif {{ $attributes->merge(['class' => 'stat '.($href ? 'card-hover block' : '')]) }}>
    <span class="absolute inset-x-0 top-0 h-1 {{ $bars[$tone] ?? $bars['garnet'] }}"></span>
    <span class="stat-icon {{ $tones[$tone] ?? $tones['garnet'] }}"><x-icon :name="$icon" class="h-5 w-5"/></span>
    <p class="stat-label pr-12 leading-tight">{{ $label }}</p>
    <p class="stat-value">{{ $value }}</p>
    @if($hint)<p class="mt-1 text-xs font-semibold text-ink-400">{{ $hint }}</p>@endif
    {{ $slot }}
</{{ $tag }}>
