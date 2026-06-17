@extends('layouts.app')

@section('content')
<div class="min-h-screen">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- ================= HEADER ================= --}}
        <div class="mb-8">
            <nav class="flex mb-4" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('cart.show') }}"
                           class="inline-flex items-center text-sm font-medium text-azwara-medium hover:text-azwara-darkest dark:hover:text-azwara-lighter transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.5 7M7 13h10M9 21a1 1 0 100-2 1 1 0 000 2zm6 0a1 1 0 100-2 1 1 0 000 2z"/>
                            </svg>
                            Keranjang
                        </a>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm text-gray-500 dark:text-gray-400">Checkout</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-azwara-darkest dark:text-azwara-lighter mb-2">
                    Checkout Pembelian
                </h1>
                <p class="text-gray-600 dark:text-gray-400">
                    Periksa kembali detail pembelian Anda sebelum melanjutkan ke pembayaran
                </p>
            </div>
        </div>

        <form method="POST" action="{{ route('checkout.process') }}" id="checkout-form" class="space-y-8">
            @csrf

            {{-- ================= PURCHASE DETAILS ================= --}}
            <div class="bg-white dark:bg-azwara-darkest rounded-xl border border-gray-200 dark:border-azwara-medium shadow-sm overflow-hidden">

                <div class="px-6 py-4 bg-gradient-to-r from-azwara-lightest to-white dark:from-azwara-darker dark:to-azwara-darkest border-b border-azwara-lighter dark:border-azwara-medium">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                            <svg class="w-5 h-5 text-primary dark:text-azwara-lighter" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="font-bold text-lg text-azwara-darkest dark:text-azwara-lighter">Detail Pembelian</h2>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $cart->items->count() }} item dalam keranjang</p>
                        </div>
                    </div>
                </div>

                <div class="divide-y divide-gray-100 dark:divide-azwara-medium">
                    @foreach ($cart->items as $item)
                        <div class="px-6 py-5">
                            <div class="flex flex-col md:flex-row md:items-start gap-4">
                                {{-- Product Info --}}
                                <div class="flex-1">
                                    <div class="flex items-start gap-4">
                                        {{-- Product Icon --}}
                                        <div class="flex-shrink-0 w-12 h-12 rounded-lg flex items-center justify-center
                                                    {{ $item->product->type === 'course_package' ? 'bg-blue-100 dark:bg-blue-900/30' :
                                                       ($item->product->type === 'addon' ? 'bg-purple-100 dark:bg-purple-900/30' :
                                                       'bg-green-100 dark:bg-green-900/30') }}">
                                            @if($item->product->type === 'course_package')
                                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                                </svg>
                                            @elseif($item->product->type === 'addon')
                                                <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                                </svg>
                                            @else
                                                <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                            @endif
                                        </div>

                                        <div class="flex-1 min-w-0">
                                            <h3 class="font-bold text-gray-900 dark:text-white mb-1 truncate">
                                                {{ $item->product->name }}
                                            </h3>

                                            <div class="flex flex-wrap items-center gap-2 mb-3">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                    {{ $item->product->type === 'course_package' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300' :
                                                       ($item->product->type === 'addon' ? 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300' :
                                                       'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300') }}">
                                                    {{ ucfirst(str_replace('_', ' ', $item->product->type)) }}
                                                </span>

                                                <span class="text-sm text-gray-600 dark:text-gray-400">
                                                    Qty: {{ $item->qty }}
                                                </span>
                                            </div>

                                            {{-- Bonuses --}}
                                            @if ($item->product->bonuses->isNotEmpty())
                                                <div class="mt-3">
                                                    <p class="text-sm font-medium text-emerald-700 dark:text-emerald-400 mb-2">
                                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/>
                                                        </svg>
                                                        Bonus yang didapat:
                                                    </p>
                                                    <div class="flex flex-wrap gap-2">
                                                        @foreach ($item->product->bonuses as $bonus)
                                                            @if ($bonus->bonus_type === 'tryout')
                                                                <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-medium bg-emerald-100 dark:bg-emerald-900/30 text-emerald-800 dark:text-emerald-300">
                                                                    <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                                                    </svg>
                                                                    Tryout: {{ $bonus->tryout?->title ?? 'Tryout' }}
                                                                </span>
                                                            @elseif ($bonus->bonus_type === 'course')
                                                                <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300">
                                                                    <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                                                    </svg>
                                                                    Course: {{ $bonus->course?->name ?? 'Course' }}
                                                                </span>
                                                            @elseif ($bonus->bonus_type === 'quiz')
                                                                <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-medium bg-purple-100 dark:bg-purple-900/30 text-purple-800 dark:text-purple-300">
                                                                    <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                                    </svg>
                                                                    Semua Quiz
                                                                </span>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                {{-- Price --}}
                                <div class="md:text-right">
                                    <div class="text-lg font-bold text-azwara-darkest dark:text-azwara-lighter">
                                        Rp {{ number_format($item->price_snapshot * $item->qty, 0, ',', '.') }}
                                    </div>
                                    @if($item->qty > 1)
                                        <div class="text-sm text-gray-600 dark:text-gray-400">
                                            @ Rp {{ number_format($item->price_snapshot, 0, ',', '.') }} / item
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- ================= DISCOUNT SECTION ================= --}}
            <div class="bg-white dark:bg-azwara-darkest rounded-xl border border-gray-200 dark:border-azwara-medium shadow-sm overflow-hidden">

                <div class="px-6 py-4 bg-gradient-to-r from-amber-50 to-white dark:from-amber-900/10 dark:to-azwara-darkest border-b border-amber-200 dark:border-amber-500/30">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center">
                            <svg class="w-5 h-5 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="font-bold text-lg text-amber-800 dark:text-amber-300">Diskon & Voucher</h2>
                            <p class="text-sm text-amber-600/80 dark:text-amber-400/80">Pilih salah satu metode diskon (opsional)</p>
                        </div>
                    </div>
                </div>

                <div class="p-6 space-y-6">
                    {{-- Voucher Code --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Kode Voucher
                        </label>
                        <div class="relative">
                            <input type="text"
                                   name="voucher_code"
                                   placeholder="Masukkan kode voucher"
                                   class="w-full pl-4 pr-10 py-3 rounded-lg border-2 border-gray-200 dark:border-azwara-medium
                                          bg-white dark:bg-azwara-darker
                                          text-gray-900 dark:text-gray-100
                                          focus:ring-2 focus:ring-primary focus:border-transparent
                                          transition-colors">
                            <div class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                                </svg>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                            Kosongkan jika memilih diskon dari daftar
                        </p>
                    </div>

                    {{-- Divider --}}
                    <div class="flex items-center">
                        <div class="flex-1 h-px bg-gray-200 dark:bg-azwara-medium"></div>
                        <span class="px-3 text-sm text-gray-500 dark:text-gray-400">ATAU</span>
                        <div class="flex-1 h-px bg-gray-200 dark:bg-azwara-medium"></div>
                    </div>

                    {{-- Discount List --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Pilih Diskon
                        </label>
                        <select name="discount_id"
                                class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 dark:border-azwara-medium
                                       bg-white dark:bg-azwara-darker
                                       text-gray-900 dark:text-gray-100
                                       focus:ring-2 focus:ring-primary focus:border-transparent
                                       transition-colors">
                            <option value="">-- Tidak menggunakan diskon --</option>

                            @foreach ($availableDiscounts as $discount)
                                <option value="{{ $discount->id }}"
                                        @disabled(!$discount->is_currently_active)
                                        class="{{ !$discount->is_currently_active ? 'text-gray-400' : '' }}">
                                    {{ $discount->name }}
                                    @if($discount->type === 'percentage')
                                        ({{ $discount->value }}%)
                                    @else
                                        (Rp {{ number_format($discount->value, 0, ',', '.') }})
                                    @endif
                                    @if(!$discount->is_currently_active)
                                        - Tidak tersedia
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Apply Button --}}
                    <div>
                        <button type="button"
                                id="apply-discount"
                                class="w-full md:w-auto inline-flex items-center justify-center px-6 py-3 rounded-lg
                                       bg-gradient-to-r from-amber-500 to-amber-600 text-white
                                       font-semibold hover:from-amber-600 hover:to-amber-700
                                       transition-all duration-200 shadow-md hover:shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Terapkan Diskon
                        </button>

                        <div id="discount-info"
                             class="mt-3 p-3 rounded-lg bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-500/30 hidden">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="text-sm font-medium text-emerald-700 dark:text-emerald-300" id="discount-message"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ================= ORDER SUMMARY ================= --}}
            @php
                $subtotal = $cart->items->sum(fn ($i) => $i->price_snapshot * $i->qty);
            @endphp

            <div class="bg-white dark:bg-azwara-darkest rounded-xl border border-gray-200 dark:border-azwara-medium shadow-sm overflow-hidden">

                <div class="px-6 py-4 bg-gradient-to-r from-emerald-50 to-white dark:from-emerald-900/10 dark:to-azwara-darkest border-b border-emerald-200 dark:border-emerald-500/30">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center">
                            <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="font-bold text-lg text-emerald-800 dark:text-emerald-300">Ringkasan Pesanan</h2>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <div class="space-y-4">
                        {{-- Subtotal --}}
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-600 dark:text-gray-400">Subtotal</span>
                            <span class="font-medium text-gray-900 dark:text-white">
                                Rp {{ number_format($subtotal, 0, ',', '.') }}
                            </span>
                        </div>

                        {{-- Discount Row --}}
                        <div id="discount-row" class="hidden">
                            <div class="flex justify-between items-center py-2 border-t border-gray-100 dark:border-azwara-medium pt-4">
                                <div class="flex items-center gap-2">
                                    <span class="text-emerald-600 dark:text-emerald-400">Diskon</span>
                                    <span id="discount-type" class="text-xs px-2 py-0.5 rounded bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300"></span>
                                </div>
                                <span id="discount-amount" class="font-medium text-emerald-600 dark:text-emerald-400"></span>
                            </div>
                        </div>

                        {{-- Total --}}
                        <div class="flex justify-between items-center py-4 border-t border-gray-200 dark:border-azwara-medium mt-4">
                            <span class="text-lg font-bold text-azwara-darkest dark:text-azwara-lighter">Total Pembayaran</span>
                            <div class="text-right">
                                <div id="total-amount" class="text-2xl md:text-3xl font-bold text-primary dark:text-azwara-lighter">
                                    Rp {{ number_format($subtotal, 0, ',', '.') }}
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Jumlah yang wajib dibayarkan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ================= ACTIONS ================= --}}
            <div class="sticky bottom-0 bg-white/80 dark:bg-azwara-darker/80 backdrop-blur-sm py-4 -mx-4 sm:-mx-6 lg:-mx-8 px-4 sm:px-6 lg:px-8 mt-8">
                <div class="max-w-5xl mx-auto">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div class="text-sm text-gray-600 dark:text-gray-400">
                            <p>Dengan melanjutkan, Anda menyetujui <a href="#" class="text-primary hover:underline">Syarat & Ketentuan</a></p>
                        </div>

                        <button type="submit"
                                class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-3.5 rounded-lg
                                       bg-gradient-to-r from-primary to-azwara-medium text-white
                                       font-bold hover:from-primary/90 hover:to-azwara-medium/90
                                       transition-all duration-200 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                            Lanjut ke Pembayaran
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const applyBtn = document.getElementById('apply-discount');
    const discountInfo = document.getElementById('discount-info');
    const discountMessage = document.getElementById('discount-message');
    const discountRow = document.getElementById('discount-row');
    const discountAmount = document.getElementById('discount-amount');
    const discountType = document.getElementById('discount-type');
    const totalAmount = document.getElementById('total-amount');
    const subtotal = {{ $subtotal }};

    let currentDiscount = null;

    applyBtn.addEventListener('click', async function() {
        const voucher = document.querySelector('[name="voucher_code"]').value.trim();
        const discountId = document.querySelector('[name="discount_id"]').value;

        // Validate selection
        if (voucher && discountId) {
            showAlert('error', 'Silakan pilih salah satu: kode voucher ATAU diskon dari daftar');
            return;
        }

        if (!voucher && !discountId) {
            showAlert('error', 'Silakan masukkan kode voucher atau pilih diskon');
            return;
        }

        // Show loading
        const originalText = applyBtn.innerHTML;
        applyBtn.disabled = true;
        applyBtn.innerHTML = `
            <svg class="w-5 h-5 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
            </svg>
            Memproses...
        `;

        try {
            const response = await fetch("{{ route('checkout.preview-discount') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    voucher_code: voucher || null,
                    discount_id: discountId || null
                })
            });

            const data = await response.json();

            if (!data.success) {
                throw new Error(data.message);
            }

            // Update UI
            currentDiscount = data.data;
            updateDiscountDisplay();
            showAlert('success', data.message || 'Diskon berhasil diterapkan!');

        } catch (error) {
            showAlert('error', error.message);
            resetDiscountDisplay();
        } finally {
            applyBtn.disabled = false;
            applyBtn.innerHTML = originalText;
        }
    });

    function updateDiscountDisplay() {
        if (!currentDiscount) return;

        // Show discount info
        discountRow.classList.remove('hidden');
        discountInfo.classList.remove('hidden');

        // Update discount amount
        const discountValue = currentDiscount.discount_amount.toLocaleString('id-ID');
        discountAmount.textContent = `- Rp ${discountValue}`;

        // Update discount type
        if (currentDiscount.type === 'percentage') {
            discountType.textContent = `${currentDiscount.value}%`;
        } else {
            discountType.textContent = 'Nominal';
        }

        // Update message
        discountMessage.textContent = `Anda hemat Rp ${discountValue} dengan diskon ini`;

        // Update total
        const finalTotal = currentDiscount.final_total.toLocaleString('id-ID');
        totalAmount.textContent = `Rp ${finalTotal}`;

        // Add animation
        totalAmount.classList.add('animate-pulse');
        setTimeout(() => totalAmount.classList.remove('animate-pulse'), 500);
    }

    function resetDiscountDisplay() {
        discountRow.classList.add('hidden');
        discountInfo.classList.add('hidden');
        currentDiscount = null;

        // Reset to original subtotal
        const originalTotal = subtotal.toLocaleString('id-ID');
        totalAmount.textContent = `Rp ${originalTotal}`;
    }

    function showAlert(type, message) {
        // Remove existing alerts
        document.querySelectorAll('.alert-message').forEach(el => el.remove());

        const alert = document.createElement('div');
        alert.className = `
            alert-message fixed top-6 right-6 z-[9999]
            px-4 py-3 rounded-xl shadow-lg font-medium
            transform translate-y-2 opacity-0
            transition-all duration-300
            ${type === 'success'
                ? 'bg-gradient-to-r from-emerald-500 to-emerald-600 text-white'
                : 'bg-gradient-to-r from-red-500 to-red-600 text-white'}
        `;
        alert.textContent = message;

        document.body.appendChild(alert);

        // Animate in
        requestAnimationFrame(() => {
            alert.classList.remove('translate-y-2', 'opacity-0');
            alert.classList.add('translate-y-0', 'opacity-100');
        });

        // Auto remove
        setTimeout(() => {
            alert.classList.add('translate-y-2', 'opacity-0');
            setTimeout(() => alert.remove(), 300);
        }, 3000);
    }

    // Clear discount when inputs change
    document.querySelectorAll('[name="voucher_code"], [name="discount_id"]').forEach(input => {
        input.addEventListener('change', resetDiscountDisplay);
    });
});
</script>
@endpush
