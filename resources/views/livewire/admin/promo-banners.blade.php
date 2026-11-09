@php $types = ['modal' => 'Modal tengah', 'popup' => 'Popup pojok', 'banner' => 'Banner bawah']; @endphp
<div>
    <x-page-header title="Promo & Banner" sub="Tampil di halaman depan sesuai prioritas & jadwal (promo aktif dengan prioritas tertinggi yang ditampilkan).">
        <x-slot:actions><a href="{{ route('promo-banners.create') }}" class="btn-primary"><x-icon name="plus" class="h-4 w-4"/> Promo baru</a></x-slot:actions>
    </x-page-header>
    <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
        @forelse($promos as $p)
            <div wire:key="p{{ $p->id }}" class="card overflow-hidden {{ $p->isCurrentlyActive() ? 'ring-2 ring-lagoon-400' : '' }}">
                <div class="relative aspect-video bg-ink-100"><img src="{{ $p->image_url }}" class="h-full w-full object-cover" alt="">
                    <div class="absolute left-3 top-3 flex gap-1"><span class="badge bg-white text-ink-800">{{ $types[$p->type] ?? $p->type }}</span><span class="badge bg-ink-900 text-white">P{{ $p->priority }}</span></div>
                    @if($p->isCurrentlyActive())<span class="absolute right-3 top-3 badge bg-lagoon-500 text-white">Tayang</span>@endif
                </div>
                <div class="p-4">
                    <p class="font-bold">{{ $p->title }}</p>
                    <p class="text-xs text-ink-400">{{ $p->starts_at?->translatedFormat('d M') ?? 'Sekarang' }} – {{ $p->ends_at?->translatedFormat('d M Y') ?? 'seterusnya' }} · muncul {{ $p->display_delay }} dtk · {{ $p->formatted_duration }} {{ $p->show_on_landing ? '' : '· tidak di landing' }}</p>
                    <div class="mt-3 flex items-center justify-between border-t border-ink-50 pt-3">
                        <x-toggle :on="$p->is_active" wire:click="toggle({{ $p->id }})"/>
                        <div class="flex gap-1"><a href="{{ route('promo-banners.edit', $p) }}" class="btn-icon btn-ghost"><x-icon name="pencil" class="h-4 w-4"/></a><button x-data @click="$confirm('Hapus promo ini?', () => $wire.remove({{ $p->id }}))" class="btn-icon btn-ghost hover:text-garnet-600"><x-icon name="trash" class="h-4 w-4"/></button></div>
                    </div>
                </div>
            </div>
        @empty
            <div class="md:col-span-2 xl:col-span-3"><x-empty icon="megaphone" title="Belum ada promo"/></div>
        @endforelse
    </div>
    {{ $promos->links() }}
</div>
