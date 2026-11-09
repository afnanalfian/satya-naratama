<x-layouts.app title="Menunggu Verifikasi">
<div class="mx-auto max-w-xl py-6 text-center">
    @if($order->status === 'verified')
        <div class="mx-auto grid h-24 w-24 place-items-center rounded-full bg-lagoon-500 text-white shadow-lift"><x-icon name="check" class="h-12 w-12" stroke="2.5"/></div>
        <h1 class="mt-6 font-display text-3xl font-extrabold">Pembayaran terverifikasi 🎉</h1>
        <p class="mt-2 text-ink-500">Akses produkmu sudah aktif. Selamat belajar!</p>
        <div class="mt-6 flex justify-center gap-2"><a href="{{ route('dashboard.redirect') }}" class="btn-primary">Ke dashboard</a><a href="{{ route('orders.invoice', $order) }}" class="btn-soft"><x-icon name="download" class="h-4 w-4"/> Invoice</a></div>
    @elseif(in_array($order->status, ['rejected', 'expired']))
        <div class="mx-auto grid h-24 w-24 place-items-center rounded-full bg-garnet-600 text-white shadow-lift"><x-icon name="x" class="h-12 w-12" stroke="2.5"/></div>
        <h1 class="mt-6 font-display text-3xl font-extrabold">Pesanan {{ $order->status === 'expired' ? 'kedaluwarsa' : 'ditolak' }}</h1>
        <p class="mt-2 text-ink-500">Silakan buat pesanan baru atau hubungi admin bila ada kendala.</p>
        <div class="mt-6 flex justify-center gap-2"><a href="{{ route('browse.index') }}" class="btn-primary">Belanja lagi</a><a href="https://wa.me/{{ config('satya.admin_wa') }}" target="_blank" class="btn-lagoon"><x-icon name="whatsapp" class="h-4 w-4"/> Admin</a></div>
    @else
        <div class="relative mx-auto h-24 w-24"><div class="absolute inset-0 animate-ping rounded-full bg-saffron-300/50"></div><div class="relative grid h-24 w-24 place-items-center rounded-full bg-saffron-400 text-ink-900 shadow-lift"><x-icon name="clock" class="h-12 w-12"/></div></div>
        <h1 class="mt-6 font-display text-3xl font-extrabold">Bukti pembayaran diterima</h1>
        <p class="mt-2 text-ink-500">Admin sedang memverifikasi pesanan <b class="font-mono">{{ $order->order_code }}</b>. Kamu akan menerima notifikasi setelah disetujui.</p>
        <div class="mt-6 flex justify-center gap-2"><a href="{{ route('my.orders.show', $order) }}" class="btn-ink">Detail pesanan</a><a href="https://wa.me/{{ config('satya.admin_wa') }}?text={{ urlencode('Halo Admin, mohon verifikasi pesanan '.$order->order_code) }}" target="_blank" class="btn-lagoon"><x-icon name="whatsapp" class="h-4 w-4"/> Hubungi admin</a></div>
    @endif
</div>
</x-layouts.app>
