@props(['cat' => null])
@if($cat)
    <span {{ $attributes->merge(['class' => ['red' => 'badge-garnet', 'amber' => 'badge-gold', 'emerald' => 'badge-lagoon'][$cat['tone']] ?? 'badge-ink']) }}>{{ $cat['label'] }}</span>
@else
    <span class="text-ink-300">–</span>
@endif
