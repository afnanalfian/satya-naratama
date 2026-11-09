@php $rp = fn ($n) => 'Rp '.number_format((float) $n, 0, ',', '.'); @endphp
<div>
    <x-page-header title="Diskon & Voucher" sub="Diskon tanpa kode tampil sebagai pilihan saat checkout; voucher harus diketik pembeli.">
        <x-slot:actions><a href="{{ route('discounts.create') }}" class="btn-primary"><x-icon name="plus" class="h-4 w-4"/> Diskon baru</a></x-slot:actions>
    </x-page-header>
    <div class="mb-5 flex flex-col gap-3 md:flex-row">
        <div class="flex-1"><x-search wire:model.live.debounce.400ms="q" placeholder="Cari nama / kode…"/></div>
        <div class="tabs">@foreach(['' => 'Semua', 'auto' => 'Diskon', 'voucher' => 'Voucher'] as $k => $l)<button wire:click="$set('kind','{{ $k }}')" class="tab {{ $kind === $k ? 'tab-active' : '' }}">{{ $l }}</button>@endforeach</div>
    </div>
    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
        @forelse($discounts as $d)
            <div wire:key="d{{ $d->id }}" class="card relative overflow-hidden p-5 {{ $d->is_active ? '' : 'opacity-70' }}">
                <div class="absolute -right-6 -top-6 grid h-20 w-20 place-items-center rounded-full bg-saffron-100 pl-2 pt-3 font-display text-lg font-extrabold text-saffron-800">{{ $d->type === 'percentage' ? rtrim(rtrim($d->value, '0'), '.').'%' : '' }}</div>
                <span class="{{ $d->code ? 'badge-dark' : 'badge-gold' }}">{{ $d->code ? 'Voucher' : 'Diskon otomatis' }}</span>
                <p class="mt-3 pr-14 font-display text-lg font-bold">{{ $d->name }}</p>
                @if($d->code)<p x-data class="mt-1 inline-flex cursor-pointer items-center gap-1 rounded-lg bg-cream px-2 py-1 font-mono text-sm font-bold" @click="$copy('{{ $d->code }}')">{{ $d->code }} <x-icon name="copy" class="h-3 w-3"/></p>@endif
                <p class="mt-2 text-sm text-ink-600">{{ $d->type === 'percentage' ? rtrim(rtrim($d->value, '0'), '.').'%' : $rp($d->value) }}{{ $d->max_discount ? ' · maks '.$rp($d->max_discount) : '' }}{{ $d->min_order_amount ? ' · min '.$rp($d->min_order_amount) : '' }}</p>
                <p class="mt-1 text-xs text-ink-400">Terpakai {{ $d->used ?? 0 }}{{ $d->quota ? '/'.$d->quota : '' }} · {{ $d->starts_at?->translatedFormat('d M') ?? '∞' }} – {{ $d->ends_at?->translatedFormat('d M Y') ?? '∞' }} · {{ $d->targets->count() ? $d->targets->count().' produk' : 'semua produk' }}</p>
                <div class="mt-4 flex items-center justify-between border-t border-ink-50 pt-3">
                    <x-toggle :on="$d->is_active" wire:click="toggle({{ $d->id }})"/>
                    <div class="flex gap-1">
                        <a href="{{ route('discounts.show', $d) }}" class="btn-icon btn-ghost"><x-icon name="eye" class="h-4 w-4"/></a>
                        <a href="{{ route('discounts.edit', $d) }}" class="btn-icon btn-ghost"><x-icon name="pencil" class="h-4 w-4"/></a>
                        <button x-data @click="$confirm('Hapus diskon {{ addslashes($d->name) }}?', () => $wire.remove({{ $d->id }}))" class="btn-icon btn-ghost hover:text-garnet-600"><x-icon name="trash" class="h-4 w-4"/></button>
                    </div>
                </div>
            </div>
        @empty
            <div class="md:col-span-2 xl:col-span-3"><x-empty icon="percent" title="Belum ada diskon"/></div>
        @endforelse
    </div>
    {{ $discounts->links() }}
</div>
