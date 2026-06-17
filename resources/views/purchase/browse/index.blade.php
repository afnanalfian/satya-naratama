@extends('layouts.app')

@section('content')
<div class="min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- ================= HEADER ================= --}}
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-azwara-darkest dark:text-azwara-lighter mb-2">
                        Etalase Pembelajaran
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400">
                        Temukan materi dan tryout terbaik untuk persiapan ujian Anda
                    </p>
                </div>

                {{-- CART BUTTON --}}
                <a id="cart-icon" href="{{ route('cart.show') }}"
                   class="relative inline-flex items-center justify-center
                          w-12 h-12 rounded-xl
                          bg-white dark:bg-azwara-darkest
                          border border-azwara-lighter dark:border-azwara-medium
                          shadow-sm hover:shadow-md
                          transition-all duration-200
                          hover:scale-105">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-6 h-6 text-azwara-medium dark:text-azwara-light"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.5 7M7 13h10M9 21a1 1 0 100-2 1 1 0 000 2zm6 0a1 1 0 100-2 1 1 0 000 2z" />
                    </svg>

                    <span id="cart-count"
                          class="absolute -top-2 -right-2
                                 min-w-[1.5rem] h-6 px-1.5
                                 bg-gradient-to-r from-red-500 to-red-600 text-white text-xs font-bold
                                 rounded-full flex items-center justify-center
                                 shadow-sm">
                        {{ auth()->user()?->cart?->items()->sum('qty') ?? 0 }}
                    </span>
                </a>
            </div>
        </div>

        {{-- ================= EMPTY STATE ================= --}}
        @if($courses->isEmpty() && $tryouts->isEmpty())
            <div class="rounded-2xl border-2 border-dashed border-red-300 dark:border-red-700
                        bg-gradient-to-br from-red-50 to-white dark:from-red-900/20 dark:to-azwara-darkest
                        p-8 md:p-12 text-center my-12">

                <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-red-100 dark:bg-red-900/30 flex items-center justify-center">
                    <svg class="w-10 h-10 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>

                <h2 class="text-xl md:text-2xl font-bold text-red-700 dark:text-red-300 mb-3">
                    {{-- 🎉 Akses Lengkap Tersedia --}}
                    CLOSED
                </h2>

                <p class="text-gray-600 dark:text-gray-400 max-w-md mx-auto mb-6">
                    Tidak Tersedia / Telah Tutup
                </p>

                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    <a href="{{ route('dashboard.redirect') }}"
                       class="inline-flex items-center justify-center px-6 py-3 rounded-lg
                              bg-gradient-to-r from-red-600 to-red-700 text-white
                              font-semibold hover:from-red-700 hover:to-red-800
                              transition-all shadow-md hover:shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Ke Dashboard
                    </a>

                    <a href="{{ route('tryouts.index') }}"
                       class="inline-flex items-center justify-center px-6 py-3 rounded-lg
                              bg-white dark:bg-azwara-darkest border border-gray-300 dark:border-azwara-medium
                              text-gray-700 dark:text-gray-300 font-semibold
                              hover:bg-gray-50 dark:hover:bg-azwara-medium/20 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        Lihat Tryout
                    </a>
                </div>
            </div>
        @endif

        {{-- ================= COURSE PACKAGE ================= --}}
        @if($courses->isNotEmpty())
            <section class="mb-12">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-xl md:text-2xl font-bold text-azwara-darkest dark:text-azwara-lighter">
                            Paket Full Course
                        </h2>
                        <p class="text-gray-600 dark:text-gray-400 mt-1">
                            Kelas lengkap dengan pertemuan terstruktur
                        </p>
                    </div>

                    <div class="hidden md:block">
                        <span class="text-sm px-3 py-1.5 rounded-full bg-primary/10 text-primary dark:text-azwara-lighter font-medium">
                            {{ $courses->count() }} Paket Tersedia
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($courses as $course)
                        <div class="bg-white dark:bg-azwara-darkest rounded-xl border border-gray-200 dark:border-azwara-medium
                                    shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden">

                            <div class="p-6">
                                {{-- Course Header --}}
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex-1">
                                        <h3 class="text-lg font-bold text-azwara-darkest dark:text-azwara-lighter mb-1">
                                            {{ $course->name }}
                                        </h3>

                                        @if($course->description)
                                            <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2 mb-3">
                                                {{ $course->description }}
                                            </p>
                                        @endif
                                    </div>

                                    <div class="flex-shrink-0 ml-3">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                            </svg>
                                            Course
                                        </span>
                                    </div>
                                </div>

                                {{-- Price Range --}}
                                <div class="mb-5">
                                    @php
                                        $range = price_range_meeting($course);
                                    @endphp
                                    <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-azwara-darker rounded-lg">
                                        <div>
                                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Harga Pertemuan</p>
                                            <p class="text-lg font-bold text-primary dark:text-azwara-lighter">
                                                Rp {{ number_format($range['min'], 0, ',', '.') }}
                                                <span class="text-gray-500 dark:text-gray-400 mx-2">–</span>
                                                Rp {{ number_format($range['max'], 0, ',', '.') }}
                                            </p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Mulai dari</p>
                                            <p class="text-sm font-semibold text-green-600 dark:text-green-400">per pertemuan</p>
                                        </div>
                                    </div>
                                </div>

                                {{-- Action Button --}}
                                <a href="{{ route('browse.course', $course->id) }}"
                                   class="w-full inline-flex items-center justify-center px-4 py-3 rounded-lg
                                          bg-gradient-to-r from-azwara-medium to-primary text-white
                                          font-semibold hover:from-azwara-medium/90 hover:to-primary/90
                                          transition-all duration-200 shadow-sm hover:shadow-md">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Detail Pertemuan
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        {{-- ================= TRYOUT SECTION ================= --}}
        @if($tryouts->isNotEmpty())
            <section>
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-xl md:text-2xl font-bold text-azwara-darkest dark:text-azwara-lighter">
                            Tryout & Simulasi
                        </h2>
                        <p class="text-gray-600 dark:text-gray-400 mt-1">
                            Uji kemampuan dengan soal-soal terstandar
                        </p>
                    </div>

                    <div class="hidden md:block">
                        <span class="text-sm px-3 py-1.5 rounded-full bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-300 font-medium">
                            {{ $tryouts->count() }} Tryout Tersedia
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($tryouts as $t)
                        <div class="bg-white dark:bg-azwara-darkest rounded-xl border border-gray-200 dark:border-azwara-medium
                                    shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden">

                            <div class="p-6">
                                {{-- Tryout Header --}}
                                <div class="mb-4">
                                    <div class="flex items-start justify-between mb-3">
                                        <h3 class="text-lg font-bold text-azwara-darkest dark:text-azwara-lighter">
                                            {{ $t->product?->name ?? $t->title }}
                                        </h3>

                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-300">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                            </svg>
                                            Tryout
                                        </span>
                                    </div>

                                    @if($t->description)
                                        <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2">
                                            {{ $t->description }}
                                        </p>
                                    @endif
                                </div>

                                {{-- Price --}}
                                <div class="mb-5">
                                    <div class="flex items-center justify-between p-3 bg-amber-50 dark:bg-amber-900/10 rounded-lg">
                                        <div>
                                            <p class="text-sm text-amber-700 dark:text-amber-400 mb-1">Harga Tryout</p>
                                            <p class="text-xl font-bold text-amber-600 dark:text-amber-300">
                                                Rp {{ number_format(price_for_tryout($t), 0, ',', '.') }}
                                            </p>
                                        </div>
                                        {{-- <div class="text-right">
                                            <p class="text-xs text-amber-600/80 dark:text-amber-400/80">Sekali pembelian</p>
                                            <p class="text-sm font-semibold text-amber-700 dark:text-amber-400">Akses selamanya</p>
                                        </div> --}}
                                    </div>
                                </div>

                                {{-- Product & Cart Logic --}}
                                @if ($t->product)
                                    @php
                                        $productId = $t->product->id;
                                        $inCart    = in_array($productId, $cartProductIds);
                                        $locked    = in_array($t->id, $bonusTryoutIdsInCart);
                                    @endphp

                                    {{-- Action Button --}}
                                    @if ($locked)
                                        <button disabled
                                                class="w-full inline-flex items-center justify-center px-4 py-3 rounded-lg
                                                       bg-emerald-100 dark:bg-emerald-900/30 text-emerald-800 dark:text-emerald-300
                                                       font-semibold cursor-not-allowed">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            Termasuk dalam Full Course
                                        </button>

                                    @elseif ($inCart)
                                        <button disabled
                                                class="w-full inline-flex items-center justify-center px-4 py-3 rounded-lg
                                                       bg-gray-200 dark:bg-azwara-medium/50 text-gray-600 dark:text-gray-400
                                                       font-semibold cursor-not-allowed">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            Sudah di Keranjang
                                        </button>

                                    @else
                                        <button type="button"
                                                data-product-id="{{ $productId }}"
                                                class="add-to-cart-btn w-full inline-flex items-center justify-center px-4 py-3 rounded-lg
                                                       bg-gradient-to-r from-primary to-azwara-medium text-white
                                                       font-semibold hover:from-primary/90 hover:to-azwara-medium/90
                                                       transition-all duration-200 shadow-sm hover:shadow-md">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                            </svg>
                                            Tambah ke Keranjang
                                        </button>
                                    @endif
                                @else
                                    <div class="text-center p-3 bg-red-50 dark:bg-red-900/20 rounded-lg">
                                        <p class="text-sm text-red-600 dark:text-red-400 font-medium">
                                            Produk tidak tersedia untuk saat ini
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const cartCountEl = document.getElementById('cart-count');
    const cartIcon = document.getElementById('cart-icon');

    // Add to cart functionality
    document.addEventListener('click', async function (e) {
        const button = e.target.closest('.add-to-cart-btn');
        if (!button || button.disabled) return;

        e.preventDefault();
        const originalText = button.innerHTML;
        const productId = button.dataset.productId;

        // Disable button and show loading
        button.disabled = true;
        button.innerHTML = `
            <svg class="w-4 h-4 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
            </svg>
            Menambahkan...
        `;

        try {
            const res = await fetch(`/cart/add/${productId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                },
            });

            const data = await res.json();
            if (!res.ok) throw data;

            // Update cart count
            if (cartCountEl) {
                cartCountEl.textContent = data.cart_count;
                cartCountEl.classList.add('animate-pulse');
                setTimeout(() => cartCountEl.classList.remove('animate-pulse'), 500);
            }

            // Animate to cart
            if (cartIcon) {
                animateToCart(button, cartIcon);
            }

            // Update button state
            button.innerHTML = `
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Sudah di Keranjang
            `;
            button.classList.remove('from-primary', 'to-azwara-medium', 'hover:from-primary/90', 'hover:to-azwara-medium/90');
            button.classList.add('bg-gray-200', 'dark:bg-azwara-medium/50', 'text-gray-600', 'dark:text-gray-400', 'cursor-not-allowed');

            // Show success notification
            showNotification('success', 'Berhasil menambahkan ke keranjang!');

        } catch (err) {
            // Restore button
            button.disabled = false;
            button.innerHTML = originalText;

            // Show error notification
            showNotification('error', err.message || 'Gagal menambahkan ke keranjang');
            console.error('Add to cart error:', err);
        }
    });

    // Animation function
    function animateToCart(button, cartIcon) {
        const buttonRect = button.getBoundingClientRect();
        const cartRect = cartIcon.getBoundingClientRect();

        // Create animation element
        const anim = document.createElement('div');
        anim.innerHTML = `
            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.5 7M7 13h10M9 21a1 1 0 100-2 1 1 0 000 2zm6 0a1 1 0 100-2 1 1 0 000 2z"/>
            </svg>
        `;

        anim.style.position = 'fixed';
        anim.style.left = `${buttonRect.left + buttonRect.width / 2 - 12}px`;
        anim.style.top = `${buttonRect.top + buttonRect.height / 2 - 12}px`;
        anim.style.width = '24px';
        anim.style.height = '24px';
        anim.style.zIndex = '9999';
        anim.style.transition = 'all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55)';
        anim.style.pointerEvents = 'none';

        document.body.appendChild(anim);

        // Trigger animation
        requestAnimationFrame(() => {
            anim.style.left = `${cartRect.left + cartRect.width / 2 - 12}px`;
            anim.style.top = `${cartRect.top + cartRect.height / 2 - 12}px`;
            anim.style.transform = 'scale(0.5)';
            anim.style.opacity = '0';
        });

        // Cleanup
        setTimeout(() => anim.remove(), 600);
    }

    // Notification function
    function showNotification(type, message) {
        // Remove existing notifications
        document.querySelectorAll('.custom-notification').forEach(el => el.remove());

        const notification = document.createElement('div');
        notification.className = `
            custom-notification fixed top-6 right-6 z-[9999]
            px-4 py-3 rounded-xl shadow-lg text-white font-medium
            transform translate-y-2 opacity-0
            transition-all duration-300
            ${type === 'success'
                ? 'bg-gradient-to-r from-emerald-500 to-emerald-600'
                : 'bg-gradient-to-r from-red-500 to-red-600'}
        `;
        notification.textContent = message;

        document.body.appendChild(notification);

        // Animate in
        requestAnimationFrame(() => {
            notification.classList.remove('translate-y-2', 'opacity-0');
            notification.classList.add('translate-y-0', 'opacity-100');
        });

        // Auto remove
        setTimeout(() => {
            notification.classList.add('translate-y-2', 'opacity-0');
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }

    // Hover effects for cards
    document.querySelectorAll('.grid > div').forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-4px)';
        });

        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0)';
        });
    });
});
</script>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

.animate-pulse {
    animation: pulse 0.5s ease-in-out;
}
</style>
@endpush
