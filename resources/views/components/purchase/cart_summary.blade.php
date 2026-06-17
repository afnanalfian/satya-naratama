{{-- resources/views/components/purchase/cart_summary.blade.php --}}
@props([
    'cart',
    'showAction' => true,
])

@php
    $userHasQuiz = \App\Models\UserEntitlement::where('user_id', auth()->id())
        ->where('entitlement_type', 'quiz')
        ->exists();

    $quizAddonProduct = \App\Models\Product::where('type', 'addon')
        ->where('is_active', true)
        ->first();

    $addonAvailable = !is_null($quizAddonProduct);

    $cartHasCourse = $cart->items->contains(fn ($i) =>
        $i->product->type === 'course_package'
    );

    $cartHasAddon = $cart->items->contains(fn ($i) =>
        $i->product->type === 'addon'
    );

    $subtotal = $cart->items->sum(fn($i) => $i->price_snapshot * $i->qty);
@endphp

<div class="bg-white dark:bg-azwara-darkest rounded-xl border border-gray-200 dark:border-azwara-medium
            shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden">

    <div class="p-6">
        {{-- Header --}}
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                <svg class="w-5 h-5 text-primary dark:text-azwara-lighter" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-azwara-darkest dark:text-azwara-lighter">
                    Ringkasan Pembelian
                </h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    {{ $cart->items->count() }} item
                </p>
            </div>
        </div>

        @if($cart->items->isEmpty())
            <div class="text-center py-6">
                <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                </svg>
                <p class="text-gray-500 dark:text-gray-400">
                    Keranjang masih kosong
                </p>
            </div>
        @else
            {{-- Items List --}}
            <div class="space-y-4 mb-6 max-h-64 overflow-y-auto pr-2">
                @foreach($cart->items as $item)
                    <div class="flex items-center justify-between gap-3 p-3 rounded-lg bg-gray-50 dark:bg-azwara-darker">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-100 truncate">
                                {{ $item->product->name }}
                            </p>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="text-xs px-2 py-0.5 rounded bg-white dark:bg-azwara-medium text-gray-700 dark:text-gray-300">
                                    {{ $item->qty }}x
                                </span>
                                <span class="text-xs text-gray-500 dark:text-gray-400">
                                    @ Rp {{ number_format($item->price_snapshot, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                        <div class="text-sm font-semibold text-gray-900 dark:text-white whitespace-nowrap">
                            Rp {{ number_format($item->price_snapshot * $item->qty, 0, ',', '.') }}
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Addon Section --}}
            @if ($addonAvailable && !$userHasQuiz && !$cartHasCourse)
                <div class="mb-6">
                    <div class="p-4 bg-gradient-to-r from-purple-50 to-white dark:from-purple-900/10 dark:to-azwara-darkest
                                rounded-xl border border-purple-200 dark:border-purple-500/30">
                        <div class="flex items-start gap-3 mb-3">
                            <div class="w-8 h-8 rounded-lg bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-purple-800 dark:text-purple-300 text-sm">
                                    Tambah Akses Quiz
                                </h4>
                                <p class="text-xs text-purple-600/80 dark:text-purple-400/80 mt-1">
                                    Dapatkan akses ke semua quiz dengan tambahan Rp10.000
                                </p>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('cart.add-addon') }}" class="addon-form">
                            @csrf
                            <button type="submit"
                                    @disabled($cartHasAddon)
                                    class="w-full inline-flex items-center justify-center px-4 py-2.5 rounded-lg text-sm font-medium
                                           {{ $cartHasAddon
                                                ? 'bg-gray-100 dark:bg-azwara-medium/30 text-gray-500 dark:text-gray-400 cursor-not-allowed'
                                                : 'bg-purple-600 hover:bg-purple-700 text-white shadow-sm hover:shadow' }}
                                           transition-all duration-200">
                                @if($cartHasAddon)
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Addon Quiz Sudah Ditambahkan
                                @else
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                    + Tambah Addon Quiz (Rp10.000)
                                @endif
                            </button>
                        </form>
                    </div>
                </div>
            @endif

            {{-- Total Section --}}
            <div class="pt-6 border-t border-gray-200 dark:border-azwara-medium">
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Subtotal</span>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                            Rp {{ number_format($subtotal, 0, ',', '.') }}
                        </span>
                    </div>

                    {{-- Addon Price if exists --}}
                    @if($cartHasAddon)
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-purple-600 dark:text-purple-400">Addon Quiz</span>
                            <span class="text-sm font-medium text-purple-600 dark:text-purple-400">
                                + Rp 10.000
                            </span>
                        </div>
                    @endif

                    <div class="flex items-center justify-between pt-3 border-t border-gray-200 dark:border-azwara-medium">
                        <span class="text-base font-semibold text-azwara-darkest dark:text-azwara-lighter">Total</span>
                        <span class="text-xl font-bold text-primary dark:text-azwara-lighter">
                            Rp {{ number_format($cartHasAddon ? $subtotal + 10000 : $subtotal, 0, ',', '.') }}
                        </span>
                    </div>
                </div>

                {{-- Checkout Button --}}
                @if($showAction)
                    <div class="mt-8">
                        <a href="{{ route('checkout.review') }}"
                           class="w-full inline-flex items-center justify-center px-6 py-3.5 rounded-lg
                                  bg-gradient-to-r from-primary to-azwara-medium text-white
                                  font-bold hover:from-primary/90 hover:to-azwara-medium/90
                                  transition-all duration-200 shadow-md hover:shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                            Lanjut ke Checkout
                        </a>

                        <p class="text-xs text-gray-500 dark:text-gray-400 text-center mt-3">
                            Dengan melanjutkan, Anda menyetujui Syarat & Ketentuan kami
                        </p>
                    </div>
                @endif
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const addonForms = document.querySelectorAll('.addon-form');

    addonForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const button = this.querySelector('button[type="submit"]');
            if (button.disabled) {
                e.preventDefault();
                return;
            }

            const originalText = button.innerHTML;
            button.disabled = true;
            button.innerHTML = `
                <svg class="w-4 h-4 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
                Menambahkan...
            `;

            this.submit();
        });
    });
});
</script>
@endpush
