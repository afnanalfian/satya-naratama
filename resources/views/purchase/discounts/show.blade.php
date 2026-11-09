<x-layouts.app :title="$discount->name">
@php $rp = fn ($n) => 'Rp '.number_format((float) $n, 0, ',', '.'); $orders = \App\Models\OrderDiscount::with('order.user')->where('discount_id', $discount->id)->latest()->limit(50)->get(); @endphp
<x-page-header :title="$discount->name" :sub="$discount->code ? 'Voucher '.$discount->code : 'Diskon otomatis'" :back="route('discounts.index')">
    <x-slot:actions><a href="{{ route('discounts.edit', $discount) }}" class="btn-ink"><x-icon name="pencil" class="h-4 w-4"/> Ubah</a></x-slot:actions>
</x-page-header>
<div class="grid grid-cols-2 gap-4 lg:grid-cols-4">
    <x-stat label="Nilai" :value="$discount->type === 'percentage' ? rtrim(rtrim($discount->value, '0'), '.').'%' : $rp($discount->value)" icon="percent" tone="gold"/>
    <x-stat label="Terpakai" :value="($discount->used ?? 0).($discount->quota ? '/'.$discount->quota : '')" icon="ticket" tone="garnet"/>
    <x-stat label="Total potongan" :value="$rp($orders->sum('amount'))" icon="cash" tone="lagoon"/>
    <x-stat label="Status" :value="$discount->is_active ? 'Aktif' : 'Nonaktif'" icon="power" tone="ink"/>
</div>
<div class="mt-6 grid gap-6 lg:grid-cols-2">
    <div class="card card-pad"><p class="section-title">Produk</p><div class="mt-3 flex flex-wrap gap-2">@forelse($discount->targets as $p)<span class="badge-ink">{{ $p->name }}</span>@empty<span class="text-sm text-ink-400">Semua produk</span>@endforelse</div></div>
    <div class="table-wrap"><table class="table"><thead><tr><th>Pesanan</th><th>Pembeli</th><th class="text-right">Potongan</th></tr></thead><tbody>
        @forelse($orders as $od)<tr><td class="font-mono text-xs">{{ $od->order?->order_code }}</td><td>{{ $od->order?->user?->name }}</td><td class="text-right font-bold">{{ $rp($od->amount) }}</td></tr>@empty<tr><td colspan="3" class="py-8 text-center text-ink-400">Belum dipakai.</td></tr>@endforelse
    </tbody></table></div>
</div>
</x-layouts.app>
