<x-layouts.app title="Bonus Produk">
<x-page-header title="Bonus Produk" sub="Tambahkan bonus tryout, kelas, atau akses kuis pada produk (umumnya paket kelas)."/>
<form method="GET" class="mb-5 max-w-md"><x-search name="q" :value="request('q')" placeholder="Cari produk lalu Enter…"/></form>
<div class="grid gap-4 md:grid-cols-2">
    @foreach($products as $p)
        @continue(request('q') && ! str_contains(mb_strtolower($p->name), mb_strtolower(request('q'))))
        <div class="card p-5">
            <div class="flex items-start justify-between gap-3">
                <div><span class="badge-ink">{{ $p->type }}</span><p class="mt-2 font-bold">{{ $p->name }}</p></div>
                <a href="{{ route('bonuses.edit', $p) }}" class="btn-soft btn-sm"><x-icon name="gift" class="h-4 w-4"/> Atur bonus</a>
            </div>
            <div class="mt-3 flex flex-wrap gap-2">
                @forelse($p->bonuses as $b)
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-lagoon-50 py-1 pl-3 pr-1 text-xs font-bold text-lagoon-800 ring-1 ring-lagoon-100">
                        {{ $b->bonus_type === 'tryout' ? 'Tryout: '.($b->tryout?->title ?? '-') : ($b->bonus_type === 'course' ? 'Kelas: '.($b->course?->name ?? '-') : 'Akses kuis') }}
                        <form method="POST" action="{{ route('bonuses.destroy', $b) }}" data-confirm="Hapus bonus ini?">@csrf @method('DELETE')<button class="grid h-5 w-5 place-items-center rounded-full hover:bg-lagoon-200"><x-icon name="x" class="h-3 w-3"/></button></form>
                    </span>
                @empty
                    <span class="text-xs text-ink-400">Belum ada bonus</span>
                @endforelse
            </div>
        </div>
    @endforeach
</div>
{{ $products->links() }}
</x-layouts.app>
