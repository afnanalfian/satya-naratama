@props(['icon' => 'inbox', 'title' => 'Belum ada data', 'text' => null])
<div {{ $attributes->merge(['class' => 'flex flex-col items-center justify-center rounded-3xl border-2 border-dashed border-ink-100 bg-white/60 px-6 py-14 text-center']) }}>
    <div class="relative mb-4">
        <div class="absolute inset-0 animate-spin-slow rounded-3xl bg-sunrise opacity-20 blur-md"></div>
        <div class="relative grid h-16 w-16 place-items-center rounded-3xl bg-ink-900 text-saffron-400 shadow-lift"><x-icon :name="$icon" class="h-8 w-8"/></div>
    </div>
    <p class="font-display text-lg font-bold">{{ $title }}</p>
    @if($text)<p class="mt-1 max-w-sm text-sm text-ink-500">{{ $text }}</p>@endif
    @if(trim($slot))<div class="mt-5">{{ $slot }}</div>@endif
</div>
