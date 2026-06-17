@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    {{-- PAGE HEADER --}}
    <div>
        <h1 class="text-2xl font-semibold text-slate-800 dark:text-slate-100">
            Pesanan Saya
        </h1>
        <p class="text-sm text-slate-600 dark:text-slate-400">
            Riwayat transaksi dan status pembayaran Anda
        </p>
    </div>

    {{-- EMPTY STATE --}}
    @if ($orders->isEmpty())
        <div
            class="bg-azwara-lightest dark:bg-secondary/60
                   border border-slate-200 dark:border-white/10
                   rounded-xl p-8 text-center">

            <div class="text-slate-500 dark:text-slate-400">
                Anda belum memiliki pesanan.
            </div>
        </div>
    @else

    {{-- ORDER LIST --}}
    <div class="space-y-4">
        @foreach ($orders as $order)

            <div
                class="bg-azwara-lightest dark:bg-secondary/60
                       border border-slate-200 dark:border-white/10
                       rounded-xl p-5
                       flex flex-col sm:flex-row sm:items-center
                       gap-4">

                {{-- LEFT --}}
                <div class="flex-1 space-y-1">
                    <div class="flex items-center gap-3 flex-wrap">
                        <span class="font-medium text-slate-800 dark:text-slate-100">
                            {{ $order->order_code }}
                        </span>

                        {{-- STATUS BADGE --}}
                        @php
                            $statusMap = [
                                'pending'  => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-500/10 dark:text-yellow-300',
                                'paid'     => 'bg-blue-100 text-blue-800 dark:bg-blue-500/10 dark:text-blue-300',
                                'verified' => 'bg-green-100 text-green-800 dark:bg-green-500/10 dark:text-green-300',
                                'rejected' => 'bg-red-100 text-red-800 dark:bg-red-500/10 dark:text-red-300',
                            ];
                        @endphp

                        <span
                            class="text-xs font-medium px-2 py-1 rounded
                                   {{ $statusMap[$order->status] ?? 'bg-slate-100 text-slate-600' }}">
                            {{ strtoupper($order->status) }}
                        </span>
                    </div>

                    <div class="text-sm text-slate-600 dark:text-slate-400">
                        {{ $order->created_at->translatedFormat('d F Y, H:i') }}
                    </div>
                </div>

                {{-- RIGHT --}}
                <div class="flex items-center justify-between sm:justify-end gap-4">

                    <div class="text-right">
                        <div class="text-xs text-slate-500">
                            Total
                        </div>
                        <div class="font-semibold text-slate-800 dark:text-slate-100">
                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                        </div>
                    </div>

                    <a
                        href="{{ route('my.orders.show', $order) }}"
                        class="inline-flex items-center justify-center
                               px-4 py-2 rounded-lg
                               border border-primary
                               text-primary font-medium
                               hover:bg-primary hover:text-white
                               transition">
                        Detail
                    </a>
                </div>

            </div>

        @endforeach
    </div>

    {{-- PAGINATION --}}
    <div>
        {{ $orders->links() }}
    </div>

    @endif

</div>
@endsection
