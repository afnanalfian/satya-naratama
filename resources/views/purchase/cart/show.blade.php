{{-- resources/views/purchase/cart/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- ================= HEADER ================= --}}
        <div class="mb-8">
            <nav class="flex mb-4" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('browse.index') }}"
                           class="inline-flex items-center text-sm font-medium text-azwara-medium hover:text-azwara-darkest dark:hover:text-azwara-lighter transition-colors">
                            Etalase
                        </a>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm text-gray-500 dark:text-gray-400">Keranjang</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-azwara-darkest dark:text-azwara-lighter mb-2">
                    Keranjang Belanja
                </h1>
                <p class="text-gray-600 dark:text-gray-400">
                    Periksa kembali item sebelum checkout
                </p>
            </div>
        </div>

        {{-- ================= MAIN CONTENT ================= --}}
        <div class="grid lg:grid-cols-3 gap-6 lg:gap-8">
            {{-- ================= CART ITEMS ================= --}}
            <div class="lg:col-span-2 space-y-4">
                @forelse($cart->items as $item)
                    <div class="bg-white dark:bg-azwara-darkest rounded-xl border border-gray-200 dark:border-azwara-medium
                                shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden">

                        <div class="p-5">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                {{-- Product Info --}}
                                <div class="flex-1">
                                    <div class="flex items-start gap-3">
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

                                        <div class="flex-1">
                                            <h3 class="font-bold text-gray-900 dark:text-white mb-1">
                                                {{ $item->product->name }}
                                            </h3>
                                            <div class="flex flex-wrap items-center gap-2">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                    {{ $item->product->type === 'course_package' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300' :
                                                       ($item->product->type === 'addon' ? 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300' :
                                                       'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300') }}">
                                                    {{ ucfirst(str_replace('_', ' ', $item->product->type)) }}
                                                </span>

                                                <span class="text-sm text-gray-500 dark:text-gray-400">
                                                    Qty: {{ $item->qty }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Price & Actions --}}
                                <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                                    {{-- Price --}}
                                    <div class="text-right">
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Harga</p>
                                        <p class="text-lg font-bold text-azwara-darkest dark:text-azwara-lighter">
                                            Rp {{ number_format($item->price_snapshot * $item->qty, 0, ',', '.') }}
                                        </p>
                                        @if($item->qty > 1)
                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                @ Rp {{ number_format($item->price_snapshot, 0, ',', '.') }} / item
                                            </p>
                                        @endif
                                    </div>

                                    {{-- Remove Button --}}
                                    <form method="POST" action="{{ route('cart.remove', $item) }}" class="remove-item-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                                onclick="confirmRemove(this)"
                                                class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-medium
                                                       bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-400
                                                       hover:bg-red-100 dark:hover:bg-red-900/30 transition-colors">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    {{-- Empty Cart State --}}
                    <div class="bg-white dark:bg-azwara-darkest rounded-xl border-2 border-dashed border-gray-300 dark:border-azwara-medium
                                p-10 text-center">
                        <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-gray-100 dark:bg-azwara-darker flex items-center justify-center">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.5 7M7 13h10M9 21a1 1 0 100-2 1 1 0 000 2zm6 0a1 1 0 100-2 1 1 0 000 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">Keranjang Kosong</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-6">Belum ada item di keranjang belanja Anda.</p>
                        <a href="{{ route('browse.index') }}"
                           class="inline-flex items-center px-6 py-3 rounded-lg
                                  bg-gradient-to-r from-primary to-azwara-medium text-white
                                  font-semibold hover:from-primary/90 hover:to-azwara-medium/90
                                  transition-all shadow-md hover:shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/>
                            </svg>
                            Mulai Belanja
                        </a>
                    </div>
                @endforelse
            </div>

            {{-- ================= CART SUMMARY ================= --}}
            <div class="lg:sticky lg:top-8">
                @include('components.purchase.cart_summary', [
                    'cart' => $cart,
                    'showAction' => true,
                ])
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function confirmRemove(button) {
    if (confirm('Yakin ingin menghapus item ini dari keranjang?')) {
        button.closest('.remove-item-form').submit();
    }
}

// Add animation for item removal
document.addEventListener('DOMContentLoaded', function() {
    const removeForms = document.querySelectorAll('.remove-item-form');

    removeForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const item = this.closest('.bg-white, .dark\\:bg-azwara-darkest');
            if (item) {
                item.style.transition = 'all 0.3s ease';
                item.style.opacity = '0';
                item.style.transform = 'translateX(-100%)';

                setTimeout(() => {
                    this.submit();
                }, 300);

                e.preventDefault();
            }
        });
    });
});
</script>
@endpush
