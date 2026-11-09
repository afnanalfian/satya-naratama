<x-layouts.app :title="'Pesanan '.$order->order_code">
@php $rp = fn ($n) => 'Rp '.number_format((float) $n, 0, ',', '.'); $disc = $order->discounts->sum('amount'); @endphp
<x-page-header :title="'Pesanan '.$order->order_code" :sub="$order->created_at->translatedFormat('d F Y, H:i')" :back="route('my.orders.index')">
    <x-slot:actions>
        <x-status-badge :status="$order->status" class="!text-xs"/>
        @if($order->status === 'pending')<a href="{{ route('checkout.payment', $order) }}" class="btn-primary">Bayar sekarang</a>@endif
        @if($order->status === 'verified')<a href="{{ route('orders.invoice', $order) }}" class="btn-soft"><x-icon name="download" class="h-4 w-4"/> Invoice PDF</a>@endif
    </x-slot:actions>
</x-page-header>
<div class="grid gap-6 lg:grid-cols-3">
    <div class="card card-pad lg:col-span-2">
        <p class="section-title">Item</p>
        <div class="mt-3 divide-y divide-ink-50">
            @foreach($order->items as $it)<div class="flex items-center justify-between py-3"><div><p class="font-bold">{{ $it->product?->name }}</p><p class="text-xs text-ink-400">{{ $it->qty }} × {{ $rp($it->price) }}</p></div><p class="font-bold">{{ $rp($it->price * $it->qty) }}</p></div>@endforeach
        </div>
        <div class="divider my-3"></div>
        <dl class="space-y-1 text-sm">
            <div class="flex justify-between"><dt class="text-ink-500">Subtotal</dt><dd>{{ $rp($order->total_amount) }}</dd></div>
            @foreach($order->discounts as $d)<div class="flex justify-between text-lagoon-700"><dt>{{ $d->discount?->name ?? 'Diskon' }}</dt><dd>− {{ $rp($d->amount) }}</dd></div>@endforeach
            <div class="flex justify-between pt-2 text-base font-extrabold"><dt>Total</dt><dd class="text-garnet-600">{{ $rp(max(0, $order->total_amount - $disc)) }}</dd></div>
        </dl>
    </div>
    <div class="card card-pad">
        <p class="section-title">Pembayaran</p>
        <dl class="mt-3 space-y-2 text-sm">
            <div class="flex justify-between"><dt class="text-ink-500">Metode</dt><dd class="font-bold">QRIS</dd></div>
            <div class="flex justify-between"><dt class="text-ink-500">Dibayar</dt><dd class="font-bold">{{ $order->payment?->paid_at?->translatedFormat('d M Y H:i') ?? '—' }}</dd></div>
            <div class="flex justify-between"><dt class="text-ink-500">Diverifikasi</dt><dd class="font-bold">{{ $order->payment?->verified_at?->translatedFormat('d M Y H:i') ?? '—' }}</dd></div>
        </dl>
        @if($order->payment?->proof_image)<a href="{{ asset('storage/'.$order->payment->proof_image) }}" target="_blank"><img src="{{ asset('storage/'.$order->payment->proof_image) }}" class="mt-4 max-h-64 w-full rounded-2xl object-contain ring-1 ring-ink-100" alt="Bukti"></a>@endif
    </div>
</div>
</x-layouts.app>
