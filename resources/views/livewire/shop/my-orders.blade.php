@php $rp = fn ($n) => 'Rp '.number_format((float) $n, 0, ',', '.'); @endphp
<div>
    <x-page-header title="Pesanan Saya" sub="Riwayat pembelian & status pembayaran.">
        <x-slot:actions><a href="{{ route('browse.index') }}" class="btn-primary"><x-icon name="bag" class="h-4 w-4"/> Belanja lagi</a></x-slot:actions>
    </x-page-header>
    <div class="tabs mb-5">
        @foreach(['' => 'Semua', 'pending' => 'Belum bayar', 'paid' => 'Menunggu verifikasi', 'verified' => 'Selesai', 'expired' => 'Kedaluwarsa', 'rejected' => 'Ditolak'] as $k => $l)
            <button wire:click="$set('status','{{ $k }}')" class="tab {{ $status === $k ? 'tab-active' : '' }}">{{ $l }}</button>
        @endforeach
    </div>
    <div class="space-y-3">
        @forelse($orders as $o)
            @php $total = max(0, $o->total_amount - $o->discounts->sum('amount')); @endphp
            <a wire:key="o{{ $o->id }}" href="{{ $o->status === 'pending' ? route('checkout.payment', $o) : route('my.orders.show', $o) }}" class="card card-hover flex flex-col gap-3 p-4 sm:flex-row sm:items-center">
                <span class="grid h-12 w-12 shrink-0 place-items-center rounded-2xl bg-ink-900 text-saffron-400"><x-icon name="receipt" class="h-6 w-6"/></span>
                <div class="min-w-0 flex-1">
                    <p class="font-mono text-sm font-bold">{{ $o->order_code }}</p>
                    <p class="truncate text-sm text-ink-600">{{ $o->items->pluck('product.name')->filter()->join(', ') }}</p>
                    <p class="text-xs text-ink-400">{{ $o->created_at->translatedFormat('d M Y, H:i') }}</p>
                </div>
                <div class="flex items-center justify-between gap-3 sm:flex-col sm:items-end">
                    <p class="font-display text-xl font-extrabold">{{ $rp($total) }}</p>
                    <x-status-badge :status="$o->status"/>
                </div>
            </a>
        @empty
            <x-empty icon="receipt" title="Belum ada pesanan"><a href="{{ route('browse.index') }}" class="btn-primary">Lihat paket</a></x-empty>
        @endforelse
    </div>
    {{ $orders->links() }}
</div>
