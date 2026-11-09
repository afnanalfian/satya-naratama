<div>
@if ($paginator->hasPages())
<nav class="mt-6 flex flex-wrap items-center justify-between gap-3" role="navigation">
    <p class="text-xs font-semibold text-ink-400">Menampilkan {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }} dari {{ $paginator->total() }}</p>
    <div class="flex flex-wrap items-center gap-1">
        <button type="button" class="btn-soft btn-sm" @disabled($paginator->onFirstPage()) wire:click="previousPage('{{ $paginator->getPageName() }}')"><x-icon name="chevron-left" class="h-4 w-4"/></button>
        @foreach ($elements as $element)
            @if (is_string($element))<span class="px-2 text-ink-300">…</span>@endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    <button type="button" wire:key="p-{{ $paginator->getPageName() }}-{{ $page }}" wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')"
                        class="btn btn-sm {{ $page == $paginator->currentPage() ? 'bg-ink-900 text-white' : 'btn-ghost' }}">{{ $page }}</button>
                @endforeach
            @endif
        @endforeach
        <button type="button" class="btn-soft btn-sm" @disabled(! $paginator->hasMorePages()) wire:click="nextPage('{{ $paginator->getPageName() }}')"><x-icon name="chevron-right" class="h-4 w-4"/></button>
    </div>
</nav>
@endif
</div>
