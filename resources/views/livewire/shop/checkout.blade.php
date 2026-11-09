@php $rp = fn ($n) => 'Rp '.number_format((float) $n, 0, ',', '.'); $discountAmt = $preview['discount_amount'] ?? 0; $final = $preview['final_total'] ?? $subtotal; @endphp
<div>
    <x-page-header title="Checkout" sub="Periksa pesanan, pilih diskon, lalu lanjut bayar." :back="route('cart.show')"/>
    <div class="grid gap-6 lg:grid-cols-3">
        <div class="space-y-6 lg:col-span-2">
            <div class="card card-pad">
                <p class="section-title">Pesanan</p>
                <div class="mt-4 divide-y divide-ink-50">
                    @foreach($cart?->items ?? [] as $item)
                        <div class="flex items-center justify-between gap-3 py-3 text-sm"><div><p class="font-bold">{{ $item->product?->name }}</p><p class="text-xs text-ink-400">{{ $item->qty }} × {{ $rp($item->price_snapshot) }}</p></div><p class="font-bold">{{ $rp($item->price_snapshot * $item->qty) }}</p></div>
                    @endforeach
                </div>
            </div>
            @if($availableDiscounts->count())
                <div class="card card-pad">
                    <p class="section-title">Diskon tersedia</p>
                    <div class="mt-4 grid gap-3 sm:grid-cols-2">
                        @foreach($availableDiscounts as $d)
                            <button wire:click="pickDiscount({{ $d->id }})" class="relative overflow-hidden rounded-2xl border-2 border-dashed p-4 text-left transition {{ $discountId === $d->id ? 'border-garnet-500 bg-garnet-50' : 'border-ink-200 hover:border-garnet-300' }}">
                                <span class="absolute -right-3 -top-3 grid h-12 w-12 place-items-center rounded-full bg-saffron-400 text-ink-900"><x-icon name="percent" class="h-5 w-5"/></span>
                                <p class="pr-8 font-bold">{{ $d->name }}</p>
                                <p class="text-xs text-ink-500">{{ $d->type === 'percentage' ? rtrim(rtrim($d->value, '0'), '.').'%' : $rp($d->value) }}{{ $d->max_discount ? ' · maks '.$rp($d->max_discount) : '' }}{{ $d->min_order_amount ? ' · min '.$rp($d->min_order_amount) : '' }}</p>
                                @if($d->ends_at)<p class="mt-1 text-[11px] text-ink-400">s.d. {{ $d->ends_at->translatedFormat('d M Y') }}</p>@endif
                            </button>
                        @endforeach
                    </div>
                </div>
            @endif
            <div class="card card-pad">
                <p class="section-title">Kode voucher</p>
                @if($voucherApplied)
                    <div class="mt-3 flex items-center justify-between rounded-2xl bg-lagoon-50 p-3"><span class="font-mono font-bold text-lagoon-800">{{ strtoupper($voucher) }}</span><button wire:click="clearVoucher" class="text-xs font-bold text-garnet-600">Hapus</button></div>
                @else
                    <form wire:submit="applyVoucher" class="mt-3 flex gap-2"><input wire:model="voucher" class="input font-mono uppercase" placeholder="MASUKKAN KODE"><button class="btn-ink shrink-0">Pakai</button></form>
                    @error('voucher')<p class="error">{{ $message }}</p>@enderror
                @endif
                @if($previewError)<p class="mt-2 text-sm font-semibold text-garnet-600">{{ $previewError }}</p>@endif
            </div>
        </div>
        <div>
            <div class="card card-pad lg:sticky lg:top-4">
                <p class="section-title">Total pembayaran</p>
                <dl class="mt-4 space-y-2 text-sm">
                    <div class="flex justify-between"><dt class="text-ink-500">Subtotal</dt><dd class="font-semibold">{{ $rp($subtotal) }}</dd></div>
                    @if($discountAmt > 0)<div class="flex justify-between text-lagoon-700"><dt>{{ $preview['label'] ?? 'Diskon' }}</dt><dd class="font-bold">− {{ $rp($discountAmt) }}</dd></div>@endif
                </dl>
                <div class="divider my-4"></div>
                <div class="flex items-end justify-between"><span class="font-bold">Total</span><span class="font-display text-3xl font-extrabold text-garnet-600">{{ $rp($final) }}</span></div>
                <button wire:click="process" wire:loading.attr="disabled" class="btn-primary btn-lg mt-5 w-full"><span wire:loading.remove wire:target="process">Buat pesanan & bayar</span><span wire:loading wire:target="process">Memproses…</span></button>
                <p class="mt-3 text-center text-xs text-ink-400">Selesaikan pembayaran dalam 2 jam setelah pesanan dibuat.</p>
            </div>
        </div>
    </div>
</div>
