@php $rp = fn ($n) => 'Rp '.number_format((float) $n, 0, ',', '.'); @endphp
<div>
    <x-page-header title="Pesanan" :sub="($counts['paid'] ?? 0).' menunggu verifikasi'"/>
    <div class="mb-5 flex flex-col gap-3 lg:flex-row">
        <div class="flex-1"><x-search wire:model.live.debounce.400ms="q" placeholder="Cari kode pesanan, nama, email…"/></div>
        <div class="tabs">
            @foreach(['' => 'Semua', 'paid' => 'Perlu verifikasi', 'pending' => 'Belum bayar', 'verified' => 'Terverifikasi', 'rejected' => 'Ditolak', 'expired' => 'Kedaluwarsa'] as $k => $l)
                <button wire:click="$set('status','{{ $k }}')" class="tab {{ $status === $k ? 'tab-active' : '' }}">{{ $l }} @if($k && ($counts[$k] ?? 0))<span class="ml-1 rounded-full bg-ink-100 px-1.5 text-[10px]">{{ $counts[$k] }}</span>@endif</button>
            @endforeach
        </div>
    </div>
    <div class="table-wrap" wire:loading.class="opacity-60">
        <table class="table">
            <thead><tr><th>Pesanan</th><th>Pembeli</th><th>Item</th><th class="text-right">Total</th><th>Status</th><th>Tanggal</th><th></th></tr></thead>
            <tbody>
            @forelse($orders as $o)
                <tr wire:key="o{{ $o->id }}" class="{{ $o->status === 'paid' ? 'bg-saffron-50/40' : '' }}">
                    <td><a href="{{ route('orders.show', $o) }}" class="font-mono text-xs font-bold hover:text-garnet-600">{{ $o->order_code }}</a></td>
                    <td><div class="flex items-center gap-2"><img src="{{ $o->user?->avatar_url }}" class="h-8 w-8 rounded-lg object-cover" alt=""><div><p class="font-bold">{{ $o->user?->name }}</p><p class="text-xs text-ink-400">{{ $o->user?->email }}</p></div></div></td>
                    <td class="max-w-xs truncate text-xs text-ink-500">{{ $o->items->pluck('product.name')->filter()->join(', ') }}</td>
                    <td class="text-right font-bold">{{ $rp(max(0, $o->total_amount - $o->discounts->sum('amount'))) }}</td>
                    <td><x-status-badge :status="$o->status"/></td>
                    <td class="whitespace-nowrap text-xs text-ink-400">{{ $o->created_at->translatedFormat('d M Y H:i') }}</td>
                    <td class="whitespace-nowrap text-right">
                        @if($o->status === 'paid')<button wire:click="preview({{ $o->id }})" class="btn-primary btn-sm">Verifikasi</button>@else<a href="{{ route('orders.show', $o) }}" class="btn-soft btn-sm">Detail</a>@endif
                        @if(! in_array($o->status, ['verified']))<button x-data @click="$confirm('Hapus pesanan {{ $o->order_code }}?', () => $wire.remove({{ $o->id }}))" class="btn-icon btn-ghost hover:text-garnet-600"><x-icon name="trash" class="h-4 w-4"/></button>@endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="py-12 text-center text-ink-400">Tidak ada pesanan.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    {{ $orders->links() }}

    <x-modal name="order-preview" title="Verifikasi pembayaran" max="max-w-2xl">
        @if($previewOrder)
            @php $p = $previewOrder; $total = max(0, $p->total_amount - $p->discounts->sum('amount')); @endphp
            <div class="grid gap-5 sm:grid-cols-2">
                <div>
                    @if($p->payment?->proof_image)
                        <a href="{{ asset('storage/'.$p->payment->proof_image) }}" target="_blank"><img src="{{ asset('storage/'.$p->payment->proof_image) }}" class="max-h-96 w-full rounded-2xl object-contain ring-1 ring-ink-100" alt="Bukti"></a>
                    @else
                        <div class="grid h-48 place-items-center rounded-2xl bg-cream text-sm text-ink-400">Tidak ada bukti</div>
                    @endif
                </div>
                <div class="space-y-3 text-sm">
                    <p class="font-mono font-bold">{{ $p->order_code }}</p>
                    <p><b>{{ $p->user?->name }}</b><br><span class="text-ink-400">{{ $p->user?->email }}</span></p>
                    <div class="divide-y divide-ink-50 rounded-2xl bg-cream p-3">@foreach($p->items as $it)<div class="flex justify-between py-1"><span>{{ $it->product?->name }}</span><b>{{ $rp($it->price * $it->qty) }}</b></div>@endforeach</div>
                    <div class="flex justify-between text-base"><span class="font-bold">Total</span><span class="font-display text-2xl font-extrabold text-garnet-600">{{ $rp($total) }}</span></div>
                    <p class="text-xs text-ink-400">Dibayar {{ $p->payment?->paid_at?->translatedFormat('d M Y H:i') }}</p>
                    <div class="grid grid-cols-2 gap-2 pt-2">
                        <button x-data @click="$confirm('Tolak pembayaran ini?', () => $wire.reject({{ $p->id }}))" class="btn-danger">Tolak</button>
                        <button wire:click="approve({{ $p->id }})" wire:loading.attr="disabled" class="btn-lagoon"><x-icon name="check" class="h-4 w-4"/> Setujui</button>
                    </div>
                </div>
            </div>
        @endif
    </x-modal>
</div>
