@extends('layouts.app')

@section('content')
<div class="min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- ================= BREADCRUMB ================= --}}
        <nav class="flex mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('browse.index') }}"
                       class="inline-flex items-center text-sm font-medium text-azwara-medium hover:text-azwara-darkest dark:hover:text-azwara-lighter transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Etalase Pembelajaran
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-sm text-gray-500 dark:text-gray-400">Detail Course</span>
                    </div>
                </li>
            </ol>
        </nav>

        {{-- ================= HEADER ================= --}}
        <div class="mb-8">
            <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-6">
                {{-- Course Info --}}
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            Full Course
                        </span>

                        @if($course->coursePackage)
                            @php
                                $owned = auth()->user()?->hasCourse($course->id);
                            @endphp
                            @if($owned)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-300">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Sudah Dimiliki
                                </span>
                            @endif
                        @endif
                    </div>

                    <h1 class="text-2xl md:text-3xl font-bold text-azwara-darkest dark:text-azwara-lighter mb-4">
                        {{ $course->name }}
                    </h1>

                    @if($course->description)
                        <div class="prose dark:prose-invert max-w-none">
                            <p class="text-gray-600 dark:text-gray-300">
                                {{ $course->description }}
                            </p>
                        </div>
                    @endif
                </div>

                {{-- Cart Button --}}
                <div class="flex-shrink-0">
                    <a href="{{ route('cart.show') }}"
                       id="cart-icon"
                       class="relative inline-flex items-center justify-center
                              w-14 h-14 rounded-xl
                              bg-white dark:bg-azwara-darkest
                              border border-azwara-lighter dark:border-azwara-medium
                              shadow-sm hover:shadow-md
                              transition-all duration-200
                              hover:scale-105">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-7 h-7 text-azwara-medium dark:text-azwara-light"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.5 7M7 13h10M9 21a1 1 0 100-2 1 1 0 000 2zm6 0a1 1 0 100-2 1 1 0 000 2z" />
                        </svg>

                        <span id="cart-count"
                              class="absolute -top-2 -right-2
                                     min-w-[1.75rem] h-7 px-1.5
                                     bg-gradient-to-r from-red-500 to-red-600 text-white text-sm font-bold
                                     rounded-full flex items-center justify-center
                                     shadow-sm">
                            {{ auth()->user()?->cart?->items()->sum('qty') ?? 0 }}
                        </span>
                    </a>
                </div>
            </div>
        </div>

        {{-- ================= FULL COURSE SECTION ================= --}}
        <div class="mb-12">
            <div class="bg-gradient-to-br from-blue-50 to-white dark:from-blue-900/10 dark:to-azwara-darkest
                        rounded-2xl border-2 border-blue-200 dark:border-blue-500/30 p-6 md:p-8">

                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    <div class="flex-1">
                        <h2 class="text-xl font-bold text-azwara-darkest dark:text-azwara-lighter mb-3">
                            Paket Full Course
                        </h2>

                        <div class="space-y-2">
                            <p class="text-gray-600 dark:text-gray-400">
                                Dapatkan akses ke semua pertemuan dengan harga spesial
                            </p>

                            <div class="flex items-baseline gap-2">
                                <span class="text-2xl md:text-3xl font-bold text-blue-600 dark:text-blue-400">
                                    Rp {{ number_format(price_for_course_package($course), 0, ',', '.') }}
                                </span>
                                <span class="text-sm text-gray-500 dark:text-gray-400">
                                    (Jauh lebih hemat)
                                    {{-- (Hemat hingga 30%) --}}
                                </span>
                            </div>
                        </div>
                    </div>

                    @if ($course->coursePackage)
                        @php
                            $productId = $course->coursePackage->product->id;
                            $inCart    = in_array($productId, $cartProductIds);
                            $owned     = auth()->user()?->hasCourse($course->id);
                        @endphp

                        <div class="flex-shrink-0 w-full md:w-auto">
                            @if ($owned)
                                <button disabled
                                        class="w-full md:w-auto inline-flex items-center justify-center px-8 py-3.5 rounded-xl
                                               bg-emerald-100 dark:bg-emerald-900/30 text-emerald-800 dark:text-emerald-300
                                               font-semibold cursor-not-allowed">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Sudah Dimiliki
                                </button>

                            @elseif ($inCart)
                                <button disabled
                                        class="w-full md:w-auto inline-flex items-center justify-center px-8 py-3.5 rounded-xl
                                               bg-gray-200 dark:bg-azwara-medium/50 text-gray-600 dark:text-gray-400
                                               font-semibold cursor-not-allowed">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Sudah di Keranjang
                                </button>

                            @else
                                <button type="button"
                                        data-product-id="{{ $productId }}"
                                        class="add-to-cart-btn w-full md:w-auto inline-flex items-center justify-center px-8 py-3.5 rounded-xl
                                               bg-gradient-to-r from-blue-600 to-blue-700 text-white
                                               font-semibold hover:from-blue-700 hover:to-blue-800
                                               transition-all duration-200 shadow-md hover:shadow-lg">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                    Beli Full Course
                                </button>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- ================= MEETINGS SECTION ================= --}}
        <section>
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-xl md:text-2xl font-bold text-azwara-darkest dark:text-azwara-lighter">
                        Daftar Pertemuan
                    </h2>
                    <p class="text-gray-600 dark:text-gray-400 mt-1">
                        Pilih pertemuan yang ingin Anda ikuti (jadwal dapat berubah menyesuaikan kesepakatan antara tentor dan siswa)
                    </p>
                </div>

                <div class="hidden md:block">
                    <span class="text-sm px-3 py-1.5 rounded-full bg-gray-100 dark:bg-azwara-medium/30 text-gray-700 dark:text-gray-300 font-medium">
                        {{ $meetings->count() }} Pertemuan
                    </span>
                </div>
            </div>

            @if($meetings->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($meetings as $m)
                        <div class="bg-white dark:bg-azwara-darkest rounded-xl border border-gray-200 dark:border-azwara-medium
                                    shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden">

                            <div class="p-6">
                                {{-- Meeting Header --}}
                                <div class="mb-4">
                                    <h3 class="text-lg font-bold text-azwara-darkest dark:text-azwara-lighter mb-3">
                                        {{ $m->title }}
                                    </h3>

                                    <div class="flex items-center text-sm text-gray-600 dark:text-gray-400 mb-4">
                                        <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span>{{ $m->scheduled_at->format('d M Y') }}</span>
                                        <span class="mx-2">•</span>
                                        <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span>{{ $m->scheduled_at->format('H:i') }} WIB</span>
                                    </div>
                                </div>

                                {{-- Price Info --}}
                                @if ($m->product && $m->product->is_active)
                                    @php
                                        $range = price_range_meeting($course);
                                    @endphp

                                    <div class="mb-6">
                                        <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-azwara-darker rounded-lg">
                                            <div>
                                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Harga Pertemuan</p>
                                                <p class="text-lg font-bold text-primary dark:text-azwara-lighter">
                                                    Rp {{ number_format($range['min'], 0, ',', '.') }}
                                                    <span class="text-gray-500 dark:text-gray-400 mx-1">–</span>
                                                    Rp {{ number_format($range['max'], 0, ',', '.') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Product & Cart Logic --}}
                                    @if ($m->product)
                                        @php
                                            $productId = $m->product->id;
                                            $inCart    = in_array($productId, $cartProductIds);
                                            $locked    = in_array($m->course_id, $courseIdsInCart);
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
                                                Termasuk Full Course
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
                                    @endif
                                @else
                                    <div class="text-center p-3 bg-red-50 dark:bg-red-900/20 rounded-lg">
                                        <p class="text-sm text-red-600 dark:text-red-400 font-medium">
                                            Pertemuan tidak tersedia
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gray-100 dark:bg-azwara-darker flex items-center justify-center">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">Belum ada pertemuan</h3>
                    <p class="text-gray-600 dark:text-gray-400">Pertemuan akan segera dijadwalkan.</p>
                </div>
            @endif
        </section>

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

    // Hover effects for meeting cards
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
@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

.animate-pulse {
    animation: pulse 0.5s ease-in-out;
}
</style>
@endpush
