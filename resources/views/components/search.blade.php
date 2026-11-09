@props(['placeholder' => 'Cari…'])
<div class="relative">
    <x-icon name="search" class="pointer-events-none absolute left-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-ink-300"/>
    <input type="search" placeholder="{{ $placeholder }}" {{ $attributes->merge(['class' => 'input pl-10']) }}>
</div>
