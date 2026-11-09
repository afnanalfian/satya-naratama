@php
    $rp = fn ($n) => 'Rp '.number_format((float) $n, 0, ',', '.');
    $typeMeta = ['course_package' => ['Paket kelas', 'book', 'bg-garnet-50 text-garnet-600'], 'meeting' => ['Pertemuan', 'calendar', 'bg-ink-50 text-ink-700'], 'tryout' => ['Tryout', 'trophy', 'bg-saffron-50 text-saffron-700'], 'addon' => ['Akses kuis', 'bolt', 'bg-lagoon-50 text-lagoon-700']];
@endphp
<div>
    <x-page-header title="Keranjang" :sub="$cart->items->count().' item'" :back="route('browse.index')"/>
    <div class="grid gap-6 lg:grid-cols-3">
        <div class="space-y-3 lg:col-span-2">
            @forelse($cart->items as $item)
                @php $p = $item->product; [$label, $icon, $tone] = $typeMeta[$p?->type] ?? ['Produk', 'bag', 'bg-ink-50']; $ctx = $p?->productable?->productable; @endphp
                <div wire:key="i{{ $item->id }}" class="card flex flex-col gap-4 p-4 sm:flex-row sm:items-center">
                    <span class="grid h-14 w-14 shrink-0 place-items-center rounded-2xl {{ $tone }}"><x-icon :name="$icon" class="h-7 w-7"/></span>
                    <div class="min-w-0 flex-1">
                        <span class="badge-ink">{{ $label }}</span>
                        <p class="mt-1 font-bold">{{ $p?->name }}</p>
                        @if($p?->type === 'meeting' && $ctx)<p class="text-xs text-ink-400">{{ $ctx->course?->name }} · {{ $ctx->scheduled_at?->translatedFormat('d M Y') }}</p>@endif
                        @if($p?->bonuses?->count())<p class="mt-1 text-xs font-semibold text-lagoon-700">🎁 Bonus: {{ $p->bonuses->map(fn ($b) => $b->tryout?->title ?? $b->course?->name)->filter()->join(', ') }}</p>@endif
                    </div>
                    <div class="flex items-center gap-4 sm:flex-col sm:items-end sm:gap-1">
                        <p class="font-display text-xl font-extrabold">{{ $rp($item->price_snapshot * $item->qty) }}</p>
                        @if($item->qty > 1)<p class="text-xs text-ink-400">{{ $item->qty }} × {{ $rp($item->price_snapshot) }}</p>@endif
                        <button x-data @click="$confirm('Hapus {{ addslashes($p?->name) }} dari keranjang?', () => $wire.remove({{ $item->id }}))" class="ml-auto text-xs font-bold text-garnet-600 hover:underline sm:ml-0">Hapus</button>
                    </div>
                </div>
            @empty
                <x-empty icon="cart" title="Keranjangmu masih kosong" text="Yuk pilih paket kelas atau tryout untuk mulai belajar."><a href="{{ route('browse.index') }}" class="btn-primary">Mulai belanja</a></x-empty>
            @endforelse

            @if($canAddon && $cart->items->count())
                <div class="flex items-center gap-4 rounded-3xl bg-lagoon-50 p-4 ring-1 ring-lagoon-100">
                    <span class="grid h-12 w-12 place-items-center rounded-2xl bg-lagoon-500 text-white"><x-icon name="bolt" class="h-6 w-6"/></span>
                    <div class="flex-1"><p class="font-bold text-lagoon-900">Tambah akses kuis harian?</p><p class="text-xs text-lagoon-700">Latihan singkat setiap hari untuk semua materi.</p></div>
                    <button wire:click="addAddon" class="btn-lagoon btn-sm">Tambah</button>
                </div>
            @endif
        </div>
        @if($cart->items->count())
        <div>
            <div class="card card-pad lg:sticky lg:top-4">
                <p class="section-title">Ringkasan</p>
                <dl class="mt-4 space-y-2 text-sm">
                    @foreach($cart->items as $item)<div class="flex justify-between gap-3"><dt class="truncate text-ink-500">{{ $item->product?->name }}</dt><dd class="shrink-0 font-semibold">{{ $rp($item->price_snapshot * $item->qty) }}</dd></div>@endforeach
                </dl>
                <div class="divider my-4"></div>
                <div class="flex items-end justify-between"><span class="font-bold">Subtotal</span><span class="font-display text-2xl font-extrabold text-garnet-600">{{ $rp($subtotal) }}</span></div>
                <p class="mt-1 text-xs text-ink-400">Diskon & voucher bisa dipakai di langkah berikutnya.</p>
                <a href="{{ route('checkout.review') }}" class="btn-primary btn-lg mt-5 w-full">Lanjut checkout <x-icon name="arrow-right" class="h-5 w-5"/></a>
            </div>
        </div>
        @endif
    </div>
</div>
