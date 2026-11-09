@props(['title', 'sub' => null, 'eyebrow' => null, 'back' => null])
<div {{ $attributes->merge(['class' => 'mb-6 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between']) }}>
    <div class="min-w-0">
        @if($back)
            <a href="{{ $back }}" class="mb-2 inline-flex items-center gap-1 text-xs font-bold text-ink-400 hover:text-garnet-600"><x-icon name="arrow-left" class="h-4 w-4"/> Kembali</a>
        @endif
        @if($eyebrow)<p class="eyebrow">{{ $eyebrow }}</p>@endif
        <h1 class="page-title">{{ $title }}</h1>
        @if($sub)<p class="page-sub">{{ $sub }}</p>@endif
    </div>
    @isset($actions)
        <div class="flex flex-wrap items-center gap-2">{{ $actions }}</div>
    @endisset
</div>
