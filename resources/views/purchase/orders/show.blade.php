<x-layouts.app :title="'Pesanan '.$order->order_code">
@php $rp = fn ($n) => 'Rp '.number_format((float) $n, 0, ',', '.'); $disc = $order->discounts()->sum('amount'); @endphp
<x-page-header :title="'Pesanan '.$order->order_code" :sub="$order->created_at->translatedFormat('d F Y, H:i').' · kedaluwarsa '.$order->expires_at?->translatedFormat('d M H:i')" :back="route('orders.index')">
    <x-slot:actions>
        <x-status-badge :status="$order->status" class="!text-xs"/>
        @if($order->status === 'paid')
            <form method="POST" action="{{ route('orders.reject', $order) }}" data-confirm="Tolak pembayaran ini?">@csrf<button class="btn-danger">Tolak</button></form>
            <form method="POST" action="{{ route('orders.approve', $order) }}" data-confirm="Setujui pembayaran & berikan akses?" data-danger="0" data-ok="Setujui">@csrf<button class="btn-lagoon"><x-icon name="check" class="h-4 w-4"/> Setujui</button></form>
        @endif
        @if($order->status === 'verified')<a href="{{ route('orders.invoice', $order) }}" class="btn-soft"><x-icon name="download" class="h-4 w-4"/> Invoice</a>@endif
        @if($order->status !== 'verified')<form method="POST" action="{{ route('orders.destroy', $order) }}" data-confirm="Hapus pesanan?">@csrf @method('DELETE')<button class="btn-ghost btn-icon hover:text-garnet-600"><x-icon name="trash" class="h-4 w-4"/></button></form>@endif
    </x-slot:actions>
</x-page-header>
<div class="grid gap-6 lg:grid-cols-3">
    <div class="space-y-6 lg:col-span-2">
        <div class="card card-pad">
            <p class="section-title">Pembeli</p>
            <div class="mt-3 flex items-center gap-3"><img src="{{ $order->user?->avatar_url }}" class="h-12 w-12 rounded-2xl object-cover" alt=""><div class="flex-1"><p class="font-bold">{{ $order->user?->name }}</p><p class="text-xs text-ink-400">{{ $order->user?->email }} · {{ $order->user?->phone }}</p></div>@if($order->user?->whatsapp_phone)<a href="https://wa.me/{{ $order->user->whatsapp_phone }}" target="_blank" class="btn-lagoon btn-sm"><x-icon name="whatsapp" class="h-4 w-4"/></a>@endif</div>
        </div>
        <div class="card card-pad">
            <p class="section-title">Item</p>
            <div class="mt-3 divide-y divide-ink-50">@foreach($order->items as $it)<div class="flex items-center justify-between py-3"><div><span class="badge-ink">{{ $it->product?->type }}</span><p class="mt-1 font-bold">{{ $it->product?->name }}</p><p class="text-xs text-ink-400">{{ $it->qty }} × {{ $rp($it->price) }}</p></div><p class="font-bold">{{ $rp($it->price * $it->qty) }}</p></div>@endforeach</div>
            <div class="divider my-3"></div>
            <dl class="space-y-1 text-sm"><div class="flex justify-between"><dt>Subtotal</dt><dd>{{ $rp($order->total_amount) }}</dd></div>@if($disc)<div class="flex justify-between text-lagoon-700"><dt>Diskon</dt><dd>− {{ $rp($disc) }}</dd></div>@endif<div class="flex justify-between pt-1 text-base font-extrabold"><dt>Total</dt><dd class="text-garnet-600">{{ $rp(max(0, $order->total_amount - $disc)) }}</dd></div></dl>
        </div>
    </div>
    <div class="card card-pad">
        <p class="section-title">Pembayaran</p>
        <dl class="mt-3 space-y-2 text-sm">
            <div class="flex justify-between"><dt class="text-ink-500">Status</dt><dd><x-status-badge :status="$order->payment?->status === 'waiting' ? 'pending' : $order->payment?->status"/></dd></div>
            <div class="flex justify-between"><dt class="text-ink-500">Dibayar</dt><dd>{{ $order->payment?->paid_at?->translatedFormat('d M Y H:i') ?? '—' }}</dd></div>
            <div class="flex justify-between"><dt class="text-ink-500">Diverifikasi</dt><dd>{{ $order->payment?->verified_at?->translatedFormat('d M Y H:i') ?? '—' }}</dd></div>
            <div class="flex justify-between"><dt class="text-ink-500">Oleh</dt><dd>{{ $order->payment?->verifier?->name ?? '—' }}</dd></div>
        </dl>
        @foreach(['proof_image', 'proof_image_2', 'proof_image_3'] as $f)
            @if($order->payment?->{$f})<a href="{{ asset('storage/'.$order->payment->{$f}) }}" target="_blank"><img src="{{ asset('storage/'.$order->payment->{$f}) }}" class="mt-4 w-full rounded-2xl object-contain ring-1 ring-ink-100" alt="Bukti"></a>@endif
        @endforeach
    </div>
</div>
</x-layouts.app>
