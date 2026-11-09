@php $types = ['course_package' => ['Paket kelas', 'book'], 'meeting' => ['Pertemuan', 'calendar'], 'tryout' => ['Tryout', 'trophy'], 'addon' => ['Addon kuis', 'bolt']]; @endphp
<div>
    <x-page-header title="Produk" sub="Produk dibuat otomatis untuk setiap kelas, pertemuan & tryout baru. Atur aktif/nonaktif di sini.">
        <x-slot:actions><a href="{{ route('products.create') }}" class="btn-primary"><x-icon name="plus" class="h-4 w-4"/> Produk baru</a></x-slot:actions>
    </x-page-header>
    <div class="mb-5 flex flex-col gap-3 md:flex-row">
        <div class="flex-1"><x-search wire:model.live.debounce.400ms="q" placeholder="Cari produk…"/></div>
        <div class="tabs">
            <button wire:click="$set('type','')" class="tab {{ $type === '' ? 'tab-active' : '' }}">Semua</button>
            @foreach($types as $k => [$l])<button wire:click="$set('type','{{ $k }}')" class="tab {{ $type === $k ? 'tab-active' : '' }}">{{ $l }} <span class="opacity-50">{{ $counts[$k] ?? 0 }}</span></button>@endforeach
        </div>
    </div>
    <div class="table-wrap">
        <table class="table">
            <thead><tr><th>Produk</th><th>Jenis</th><th>Terhubung ke</th><th>Bonus</th><th>Aktif</th><th></th></tr></thead>
            <tbody>
            @forelse($products as $p)
                @php $m = $p->productable?->productable; @endphp
                <tr wire:key="p{{ $p->id }}">
                    <td class="font-bold">{{ $p->name }}@if($p->description)<p class="line-clamp-1 text-xs font-normal text-ink-400">{{ $p->description }}</p>@endif</td>
                    <td><span class="badge-ink"><x-icon :name="$types[$p->type][1] ?? 'bag'" class="h-3 w-3"/> {{ $types[$p->type][0] ?? $p->type }}</span></td>
                    <td class="text-xs text-ink-500">{{ $m?->name ?? $m?->title ?? ($p->type === 'addon' ? 'Global' : '—') }}</td>
                    <td>@if($p->type === 'course_package')<a href="{{ route('bonuses.edit', $p) }}" class="text-xs font-bold text-garnet-600 hover:underline">{{ $p->bonuses->count() }} bonus</a>@else<span class="text-ink-300">–</span>@endif</td>
                    <td><x-toggle :on="$p->is_active" wire:click="toggle({{ $p->id }})"/></td>
                    <td class="whitespace-nowrap text-right">
                        <a href="{{ route('products.edit', $p) }}" class="btn-icon btn-ghost"><x-icon name="pencil" class="h-4 w-4"/></a>
                        <button x-data @click="$confirm('Hapus produk {{ addslashes($p->name) }}?', () => $wire.remove({{ $p->id }}))" class="btn-icon btn-ghost hover:text-garnet-600"><x-icon name="trash" class="h-4 w-4"/></button>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="py-10 text-center text-ink-400">Belum ada produk.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    {{ $products->links() }}
</div>
