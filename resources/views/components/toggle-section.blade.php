@props(['title'])

<div
    x-data="{ open: false }"
    class="rounded-xl
           bg-azwara-lightest dark:bg-secondary/70
           border border-azwara-light/30 dark:border-white/10">

    <button
        @click="open = !open"
        class="w-full px-6 py-4
               flex items-center justify-between
               text-left
               hover:bg-azwara-lighter
               dark:hover:bg-white/5
               transition">

        <span class="font-semibold text-azwara-darker dark:text-azwara-lighter">
            {{ $title }}
        </span>

        <span
            class="text-xl font-bold text-azwara-medium"
            x-text="open ? '−' : '+'">
        </span>
    </button>

    <div x-show="open" x-collapse class="px-6 pb-6">
        {{ $slot }}
    </div>
</div>
