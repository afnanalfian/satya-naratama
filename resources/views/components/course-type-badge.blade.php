@props(['type' => 'akademik', 'size' => 'sm'])
@php
    $isJasmani = $type === 'jasmani';
    $sizeClass = $size === 'xs' ? 'px-2 py-0.5 text-[10px]' : 'px-2.5 py-1 text-xs';
@endphp
<span {{ $attributes->merge(['class' => "inline-flex items-center gap-1 rounded-full font-semibold border $sizeClass " . ($isJasmani
        ? 'bg-orange-50 text-orange-700 border-orange-200 dark:bg-orange-900/20 dark:text-orange-300 dark:border-orange-800/40'
        : 'bg-blue-50 text-blue-700 border-blue-200 dark:bg-blue-900/20 dark:text-blue-300 dark:border-blue-800/40')]) }}>
    @if($isJasmani)
        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 4a2 2 0 11-4 0 2 2 0 014 0zM7 21l3-7 3 3v4m-6-9l3-3 4 2 3 3"/></svg>
        Jasmani
    @else
        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
        Akademik
    @endif
</span>
