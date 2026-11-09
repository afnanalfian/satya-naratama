@if ($paginator->hasPages())
<nav class="mt-6 flex flex-wrap items-center justify-between gap-3" role="navigation">
    <p class="text-xs font-semibold text-ink-400">Menampilkan {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }} dari {{ $paginator->total() }}</p>
    <div class="flex flex-wrap items-center gap-1">
        @if ($paginator->onFirstPage())
            <span class="btn-soft btn-sm opacity-40"><x-icon name="chevron-left" class="h-4 w-4"/></span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="btn-soft btn-sm"><x-icon name="chevron-left" class="h-4 w-4"/></a>
        @endif
        @foreach ($elements as $element)
            @if (is_string($element))<span class="px-2 text-ink-300">…</span>@endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="btn-sm btn bg-ink-900 text-white">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="btn-sm btn-ghost btn">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="btn-soft btn-sm"><x-icon name="chevron-right" class="h-4 w-4"/></a>
        @else
            <span class="btn-soft btn-sm opacity-40"><x-icon name="chevron-right" class="h-4 w-4"/></span>
        @endif
    </div>
</nav>
@endif
