@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto space-y-8 px-4 sm:px-0">

    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-semibold text-slate-900 dark:text-white">
                #{{ $order->order_code }}
            </h1>
            <p class="text-sm text-slate-600 dark:text-slate-400">
                Detail transaksi pembelian
            </p>
        </div>

        @php
            $statusColor = [
                'pending'  => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-500/10 dark:text-yellow-300',
                'paid'     => 'bg-blue-100 text-blue-800 dark:bg-blue-500/10 dark:text-blue-300',
                'verified' => 'bg-green-100 text-green-800 dark:bg-green-500/10 dark:text-green-300',
                'rejected' => 'bg-red-100 text-red-800 dark:bg-red-500/10 dark:text-red-300',
                'expired'  => 'bg-slate-200 text-slate-700 dark:bg-white/10 dark:text-slate-300',
            ];
        @endphp

        <span class="inline-flex px-4 py-2 rounded-lg text-sm font-medium
            {{ $statusColor[$order->status] ?? '' }}">
            {{ strtoupper($order->status) }}
        </span>
    </div>
    {{-- Tombol Kembali --}}
    <div class="mb-4">
        <a href="{{ route('orders.index') }}"
            class="inline-flex items-center gap-2
                    text-sm font-medium
                    text-azwara-darkest dark:text-azwara-lighter
                    hover:text-primary
                    transition">

            {{-- Panah kiri --}}
            <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-4 h-4"
                    fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15 19l-7-7 7-7" />
            </svg>

            Kembali
        </a>
    </div>
    <div class="grid lg:grid-cols-3 gap-6">

        {{-- LEFT : ORDER ITEMS --}}
        <div class="lg:col-span-2 space-y-6">

            <div class="bg-white dark:bg-secondary/60
                        border border-slate-200 dark:border-white/10
                        rounded-xl">

                <div class="px-6 py-4 border-b border-slate-200 dark:border-white/10">
                    <h2 class="font-medium text-slate-800 dark:text-slate-100">
                        Item Pembelian
                    </h2>
                </div>

                <div class="divide-y divide-slate-200 dark:divide-white/10">

                    @foreach ($order->items as $item)
                        <div class="px-6 py-4 space-y-2">

                            {{-- PRODUCT --}}
                            <div class="flex flex-col sm:flex-row sm:justify-between gap-2">
                                <div>
                                    <div class="font-medium text-slate-800 dark:text-slate-100">
                                        {{ $item->product->name }}
                                    </div>

                                    <div class="text-sm text-slate-600 dark:text-slate-400">
                                        Tipe: {{ ucfirst($item->product->type) }}
                                    </div>
                                </div>

                                <div class="text-sm sm:text-right">
                                    <div class="font-medium text-slate-800 dark:text-azwara-lighter">
                                        Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </div>
                                    <div class="text-xs text-slate-500">
                                        Qty {{ $item->qty }}
                                    </div>
                                </div>
                            </div>

                            {{-- BONUSES --}}
                            @if ($item->product->bonuses->isNotEmpty())
                                <div class="text-xs text-slate-500 dark:text-slate-400">
                                    Bonus:
                                    @foreach ($item->product->bonuses as $bonus)
                                        <span class="inline-block mr-2">
                                            • {{ ucfirst($bonus->bonus_type) }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif

                        </div>
                    @endforeach

                    {{-- DISCOUNTS --}}
                    @if ($order->discounts->isNotEmpty())
                        @php
                            $totalDiscount = $order->discounts->sum('amount');
                        @endphp

                        <div class="px-6 py-4 bg-slate-50 dark:bg-white/5 text-sm">
                            <div class="flex justify-between">
                                <span class="text-slate-600 dark:text-slate-400">
                                    Diskon
                                </span>
                                <span class="font-medium text-red-600 dark:text-red-400">
                                    − Rp {{ number_format($totalDiscount, 0, ',', '.') }}
                                </span>
                            </div>

                            <div class="mt-1 space-y-1 text-xs text-slate-500 dark:text-slate-400">
                                @foreach ($order->discounts as $od)
                                    <div>
                                        • {{ $od->discount->name }}
                                        @if ($od->discount->code)
                                            ({{ $od->discount->code }})
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- TOTAL --}}
                    <div class="px-6 py-4 flex justify-between font-semibold dark:text-azwara-lightest">
                        <span>Total Dibayar</span>
                        <span class="text-primary dark:text-azwara-lightest">
                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                        </span>
                    </div>

                </div>
            </div>
        </div>

        {{-- RIGHT : PAYMENT --}}
        <div class="space-y-6">

            <div class="bg-white dark:bg-secondary/60
                        border border-slate-200 dark:border-white/10
                        rounded-xl p-6 space-y-3">

                <h2 class="font-medium text-slate-800 dark:text-slate-100">
                    Informasi Pembayaran
                </h2>

                {{-- @if ($order->payment)
                    <div class="text-sm text-slate-600 dark:text-slate-400 space-y-1">
                        <div>Metode: <strong>{{ strtoupper($order->payment->method) }}</strong></div>
                        <div>Status: <strong>{{ strtoupper($order->payment->status) }}</strong></div>

                        @if ($order->payment->verified_at)
                            <div>
                                Diverifikasi:
                                {{ $order->payment->verified_at->translatedFormat('d F Y H:i') }}
                            </div>
                        @endif
                    </div>

                    @if ($order->payment->proof_image)
                        <img
                            src="{{ asset('storage/' . $order->payment->proof_image) }}"
                            class="mt-3 rounded-lg border max-w-full"
                            alt="Bukti Pembayaran">
                    @endif
                @else
                    <div class="text-sm text-slate-500">
                        Belum ada data pembayaran.
                    </div>
                @endif --}}
                @if ($order->payment)
                    <div class="text-sm text-slate-600 dark:text-slate-400 space-y-1">
                        <div>Metode: <strong>{{ strtoupper($order->payment->method) }}</strong></div>
                        <div>Status: <strong>{{ strtoupper($order->payment->status) }}</strong></div>

                        @if ($order->payment->verified_at)
                            <div>
                                Diverifikasi:
                                {{ $order->payment->verified_at->translatedFormat('d F Y H:i') }}
                            </div>
                        @endif
                    </div>

                    @php
                        $proofs = [];

                        if (!empty($order->payment->proof_image)) {
                            $proofs[] = $order->payment->proof_image;
                        }

                        if (!empty($order->payment->proof_image_2)) {
                            $proofs[] = $order->payment->proof_image_2;
                        }

                        if (!empty($order->payment->proof_image_3)) {
                            $proofs[] = $order->payment->proof_image_3;
                        }
                    @endphp

                    @if (count($proofs))
                        <div class="mt-4 space-y-3">
                            <div class="text-sm font-medium text-slate-700 dark:text-slate-300">
                                Bukti Pembayaran
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @foreach ($proofs as $index => $proof)
                                    <div class="space-y-1">
                                        <div class="text-xs text-slate-500">
                                            Bukti {{ $index + 1 }}
                                        </div>

                                        <a href="{{ asset('storage/' . $proof) }}"
                                        target="_blank"
                                        class="block">
                                            <img
                                                src="{{ asset('storage/' . $proof) }}"
                                                class="rounded-lg border w-full object-contain hover:opacity-90 transition"
                                                alt="Bukti Pembayaran {{ $index + 1 }}">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @else
                    <div class="text-sm text-slate-500">
                        Belum ada data pembayaran.
                    </div>
                @endif

            </div>

            {{-- ACTION --}}
            @if ($order->status === 'paid')
                <div class="bg-white dark:bg-secondary/60
                            border border-slate-200 dark:border-white/10
                            rounded-xl p-6 space-y-3">

                    <form method="POST"
                            action="{{ route('orders.approve', $order) }}"
                            class="w-full sweet-confirm"
                            data-message="Yakin ingin verifikasi pembayaran order ini?">
                        @csrf
                        <button
                            class="w-full bg-green-600 hover:bg-green-700
                                   text-white py-3 rounded-lg font-medium">
                            Verifikasi Pembayaran
                        </button>
                    </form>

                    <form method="POST"
                            action="{{ route('orders.reject', $order) }}"
                            class="w-full sweet-confirm"
                            data-message="Yakin ingin menolak pembayaran order ini?">
                        @csrf
                        <button
                            class="w-full bg-red-600 hover:bg-red-700
                                   text-white py-3 rounded-lg font-medium">
                            Tolak Pembayaran
                        </button>
                    </form>
                </div>
            @endif
            @if ($order->status === 'verified')
                <a
                    href="{{ route('orders.invoice', $order) }}"
                    class="inline-flex px-4 py-2 rounded-lg
                        bg-emerald-600 hover:bg-emerald-700
                        text-white text-sm font-semibold">
                    Download Invoice
                </a>
            @endif
        </div>
    </div>
</div>
@endsection
