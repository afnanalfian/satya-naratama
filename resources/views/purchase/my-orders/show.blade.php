@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    {{-- PAGE HEADER --}}
    <div class="flex items-center justify-between flex-wrap gap-4">
        <div>
            <h1 class="text-2xl font-semibold text-slate-800 dark:text-slate-100">
                Detail Pesanan
            </h1>
            <p class="text-sm text-slate-600 dark:text-slate-400">
                Order #{{ $order->order_code }}
            </p>
        </div>

        <a
            href="{{ route('my.orders.index') }}"
            class="text-sm font-medium text-primary hover:underline dark:text-azwara-lightest">
            ← Kembali
        </a>
    </div>

    {{-- ORDER SUMMARY --}}
    <div
        class="bg-white dark:bg-secondary/60
               border border-slate-200 dark:border-white/10
               rounded-xl p-6 space-y-4">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="text-sm text-slate-500">
                    Tanggal Pesanan
                </div>
                <div class="font-medium text-slate-800 dark:text-slate-100">
                    {{ $order->created_at->translatedFormat('d F Y, H:i') }}
                </div>
            </div>

            <div>
                <div class="text-sm text-slate-500">
                    Status
                </div>

                @php
                    $statusMap = [
                        'pending'  => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-500/10 dark:text-yellow-300',
                        'paid'     => 'bg-blue-100 text-blue-800 dark:bg-blue-500/10 dark:text-blue-300',
                        'verified' => 'bg-green-100 text-green-800 dark:bg-green-500/10 dark:text-green-300',
                        'rejected' => 'bg-red-100 text-red-800 dark:bg-red-500/10 dark:text-red-300',
                    ];
                @endphp

                <span
                    class="inline-flex text-xs font-medium px-2 py-1 rounded
                           {{ $statusMap[$order->status] ?? 'bg-slate-100 text-slate-600' }}">
                    {{ strtoupper($order->status) }}
                </span>
            </div>

            <div>
                <div class="text-sm text-slate-500">
                    Total Pembayaran
                </div>
                <div class="text-lg font-semibold text-slate-800 dark:text-slate-100">
                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                </div>
            </div>
            @if ($order->status === 'pending')
                <div
                    class="mt-3 text-sm text-red-600 dark:text-red-400"
                    data-expired-at="{{ $order->expires_at->timestamp }}">
                    Sisa waktu pembayaran:
                    <span id="countdown" class="font-medium"></span>
                </div>
            @endif
        </div>
    </div>

    {{-- ORDER ITEMS --}}
    <div
        class="bg-white dark:bg-secondary/60
            border border-slate-200 dark:border-white/10
            rounded-xl">

        <div class="px-6 py-4 border-b border-slate-200 dark:border-white/10">
            <h2 class="font-medium text-slate-800 dark:text-slate-100">
                Item yang Dibeli
            </h2>
        </div>

        <div class="divide-y divide-slate-200 dark:divide-white/10">

            {{-- LIST ITEMS --}}
            @foreach ($order->items as $item)
                <div class="px-6 py-4 flex items-start gap-4">
                    <div class="flex-1">
                        <div class="font-medium text-slate-800 dark:text-slate-100">
                            {{ $item->product->name }}
                        </div>

                        <div class="text-sm text-slate-600 dark:text-slate-400">
                            Tipe: {{ ucfirst($item->product->type) }}
                        </div>
                    </div>

                    <div class="text-right min-w-[120px]">
                        <div class="font-medium text-slate-800 dark:text-slate-100">
                            Rp {{ number_format($item->price, 0, ',', '.') }}
                        </div>
                        <div class="text-xs text-slate-500">
                            Qty {{ $item->qty }}
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- DISCOUNT INFO (PALING BAWAH) --}}
            @if ($order->discounts->isNotEmpty())
                @php
                    $totalDiscount = $order->discounts->sum('amount');
                @endphp

                <div
                    class="px-6 py-4
                        bg-slate-50 dark:bg-white/5
                        text-sm">

                    <div class="flex justify-between items-start gap-4">
                        <div class="text-slate-600 dark:text-slate-400">
                            Diskon
                            @if ($order->discounts->count() > 1)
                                ({{ $order->discounts->count() }})
                            @endif
                        </div>

                        <div class="text-right">
                            <div class="font-medium text-red-600 dark:text-red-400">
                                − Rp {{ number_format($totalDiscount, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>

                    <div class="mt-1 space-y-1 text-xs text-slate-500 dark:text-slate-400">
                        @foreach ($order->discounts as $od)
                            <div>
                                • {{ $od->discount->name }}
                                @if ($od->discount->code)
                                    <span class="italic">(Kode: {{ $od->discount->code }})</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>

    {{-- PAYMENT INFO --}}
    <div
        class="bg-white dark:bg-secondary/60
               border border-slate-200 dark:border-white/10
               rounded-xl p-6 space-y-3">

        <h2 class="font-medium text-slate-800 dark:text-slate-100">
            Informasi Pembayaran
        </h2>

        @if ($order->payment)
            <div class="text-sm text-slate-600 dark:text-slate-400 space-y-1">
                <div>
                    Metode: <span class="font-medium text-slate-800 dark:text-slate-100">
                        {{ strtoupper($order->payment->method) }}
                    </span>
                </div>

                <div>
                    Status Pembayaran:
                    <span class="font-medium text-slate-800 dark:text-slate-100">
                        {{ strtoupper($order->payment->status) }}
                    </span>
                </div>

                @if ($order->payment->paid_at)
                    <div>
                        Dibayar pada:
                        <span class="font-medium text-slate-800 dark:text-slate-100">
                            {{ $order->payment->paid_at->translatedFormat('d F Y, H:i') }}
                        </span>
                    </div>
                @endif
            </div>
        @else
            <div class="text-sm text-slate-500">
                Informasi pembayaran belum tersedia.
            </div>
        @endif
        @if ($order->status === 'verified')
        <div class="flex justify-end">
            <a
                href="{{ route('orders.invoice', $order) }}"
                class="inline-flex items-center gap-2
                    px-6 py-3 rounded-lg
                    bg-emerald-600 hover:bg-emerald-700
                    text-white font-medium transition">

                Download Invoice
            </a>
        </div>
    @endif
    </div>

    {{-- ACTION (OPTIONAL) --}}
    @if (
        in_array($order->status, ['pending', 'rejected']) &&
        in_array($order->payment->status, ['waiting', 'rejected'])
    )
        <div class="flex justify-end">
            <a
                href="{{ route('checkout.payment', $order) }}"
                class="inline-flex items-center justify-center
                    px-6 py-3 rounded-lg
                    bg-primary hover:bg-azwara-darker
                    text-white font-medium transition">
                {{ $order->payment->status === 'rejected'
                    ? 'Upload Ulang Pembayaran'
                    : 'Lanjutkan Pembayaran'
                }}
            </a>
        </div>
    @endif


</div>
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const el = document.querySelector('[data-expired-at]');
    if (!el) return;

    const expiredAt = parseInt(el.dataset.expiredAt) * 1000;
    const countdownEl = document.getElementById('countdown');

    const tick = () => {
        const now = Date.now();
        const diff = expiredAt - now;

        if (diff <= 0) {
            countdownEl.textContent = 'Waktu habis';
            location.reload();
            return;
        }

        const m = Math.floor(diff / 1000 / 60);
        const s = Math.floor(diff / 1000 % 60);

        countdownEl.textContent =
            `${m.toString().padStart(2, '0')}:${s.toString().padStart(2, '0')}`;
    };

    tick();
    setInterval(tick, 1000);
});
</script>
@endpush
