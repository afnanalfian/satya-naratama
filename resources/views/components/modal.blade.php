@props(['name', 'title' => null, 'max' => 'max-w-lg', 'show' => false])
{{-- Buka: $dispatch('open-modal', 'nama')  · Tutup: $dispatch('close-modal', 'nama') --}}
<div x-data="{ show: @js((bool) $show) }"
     x-on:open-modal.window="if ($event.detail === '{{ $name }}' || $event.detail?.name === '{{ $name }}') show = true"
     x-on:close-modal.window="if ($event.detail === '{{ $name }}' || $event.detail?.name === '{{ $name }}' || $event.detail === '*') show = false"
     x-on:keydown.escape.window="show = false"
     x-show="show" x-cloak class="fixed inset-0 z-[80] overflow-y-auto" {{ $attributes }}>
    <div x-show="show" x-transition.opacity class="fixed inset-0 bg-ink-950/60 backdrop-blur-sm" @click="show = false"></div>
    <div class="relative flex min-h-full items-end justify-center p-0 sm:items-center sm:p-4">
        <div x-show="show" x-transition:enter="transition duration-300" x-transition:enter-start="translate-y-8 opacity-0 sm:scale-95"
             class="relative w-full {{ $max }} rounded-t-3xl bg-white shadow-lift sm:rounded-3xl">
            @if($title)
                <div class="flex items-center justify-between border-b border-ink-50 px-6 py-4">
                    <h3 class="font-display text-lg font-bold">{{ $title }}</h3>
                    <button type="button" @click="show=false" class="btn-icon btn-ghost"><x-icon name="x"/></button>
                </div>
            @endif
            <div class="p-6">{{ $slot }}</div>
        </div>
    </div>
</div>
