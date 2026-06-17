@extends('layouts.app')

@section('content')
<div class="min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- ================= HEADER ================= --}}
        <div class="text-center mb-10">
            <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                <svg class="w-10 h-10 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
            </div>

            <h1 class="text-3xl md:text-4xl font-bold text-azwara-darkest dark:text-azwara-lighter mb-3">
                Menunggu Verifikasi Pembayaran
            </h1>
            <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                Pembayaran Anda sedang diproses dan menunggu verifikasi dari tim kami.
            </p>
        </div>

        {{-- ================= STATUS CARD ================= --}}
        <div class="bg-white dark:bg-azwara-darkest rounded-2xl border border-gray-200 dark:border-azwara-medium
                    shadow-xl overflow-hidden mb-8">

            {{-- Status Header --}}
            <div class="px-6 py-8 bg-gradient-to-r from-blue-50 to-white dark:from-blue-900/10 dark:to-azwara-darkest
                        border-b border-blue-100 dark:border-blue-500/20">
                <div class="flex flex-col items-center text-center">
                    {{-- Animated Status Badge --}}
                    <div class="inline-flex items-center gap-3 px-5 py-3 rounded-full
                                bg-gradient-to-r from-blue-500 to-blue-600 text-white
                                shadow-lg mb-4 animate-pulse">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="font-semibold">Status: Menunggu Verifikasi</span>
                    </div>

                    <h2 class="text-xl font-bold text-azwara-darkest dark:text-azwara-lighter mb-2">
                        Pembayaran Diterima
                    </h2>
                    <p class="text-gray-600 dark:text-gray-400">
                        Terima kasih telah melakukan pembayaran.
                    </p>
                </div>
            </div>

            {{-- Status Content --}}
            <div class="p-6 md:p-8">
                <div class="space-y-6">
                    {{-- Order Information --}}
                    <div class="flex items-start gap-4 p-4 rounded-xl bg-gray-50 dark:bg-azwara-darker">
                        <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-primary dark:text-azwara-lighter" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-800 dark:text-gray-100 mb-1">Informasi Order</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-3">
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Nomor Order</p>
                                    <p class="font-mono font-bold text-lg text-primary dark:text-azwara-lighter">
                                        {{ $order->order_code }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Tanggal Order</p>
                                    <p class="font-medium text-gray-800 dark:text-gray-100">
                                        {{ $order->created_at->format('d M Y, H:i') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Verification Timeline --}}
                    <div class="p-4 rounded-xl bg-gradient-to-r from-emerald-50 to-white dark:from-emerald-900/10 dark:to-azwara-darkest
                                border border-emerald-200 dark:border-emerald-500/30">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-lg bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-semibold text-emerald-800 dark:text-emerald-300 mb-2">Proses Verifikasi</h3>
                                <div class="space-y-3">
                                    <div class="flex items-center gap-3">
                                        <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                                        <p class="text-sm text-gray-700 dark:text-gray-300">
                                            Bukti pembayaran Anda telah berhasil diunggah.
                                        </p>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                                        <p class="text-sm text-gray-700 dark:text-gray-300">
                                            Admin akan memverifikasi pembayaran Anda dalam waktu maksimal
                                            <span class="font-bold text-emerald-600 dark:text-emerald-400">1 × 24 jam</span>.
                                        </p>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                                        <p class="text-sm text-gray-700 dark:text-gray-300">
                                            Setelah terverifikasi, akses ke produk akan otomatis aktif.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Next Steps --}}
                    <div class="p-4 rounded-xl bg-gradient-to-r from-amber-50 to-white dark:from-amber-900/10 dark:to-azwara-darkest
                                border border-amber-200 dark:border-amber-500/30">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-lg bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-semibold text-amber-800 dark:text-amber-300 mb-2">Langkah Selanjutnya</h3>
                                <div class="space-y-3">
                                    <div class="flex items-start gap-3">
                                        <div class="w-2 h-2 rounded-full bg-amber-500 mt-2"></div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Pantau Status Order</p>
                                            <p class="text-xs text-gray-600 dark:text-gray-400">
                                                Anda dapat memantau status order di halaman Riwayat Order.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-3">
                                        <div class="w-2 h-2 rounded-full bg-amber-500 mt-2"></div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Notifikasi Email</p>
                                            <p class="text-xs text-gray-600 dark:text-gray-400">
                                                Anda akan menerima email pemberitahuan ketika pembayaran telah diverifikasi.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-3">
                                        <div class="w-2 h-2 rounded-full bg-amber-500 mt-2"></div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Butuh Bantuan?</p>
                                            <p class="text-xs text-gray-600 dark:text-gray-400">
                                                Hubungi <a href="https://wa.me/6285141339645" class="text-primary hover:underline">WhatsApp Admin Azwara</a> jika ada pertanyaan.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= ACTIONS ================= --}}
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('my.orders.index') }}"
               class="inline-flex items-center justify-center px-8 py-3.5 rounded-lg
                      bg-gradient-to-r from-primary to-azwara-medium text-white
                      font-semibold hover:from-primary/90 hover:to-azwara-medium/90
                      transition-all duration-200 shadow-lg hover:shadow-xl">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                Lihat Riwayat Order
            </a>

            <a href="{{ route('dashboard.redirect') }}"
               class="inline-flex items-center justify-center px-8 py-3.5 rounded-lg
                      bg-white dark:bg-azwara-darkest border-2 border-gray-300 dark:border-azwara-medium
                      text-gray-700 dark:text-gray-300 font-semibold
                      hover:bg-gray-50 dark:hover:bg-azwara-medium/20 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Kembali ke Dashboard
            </a>
        </div>

        {{-- ================= FOOTER NOTE =================
        <div class="mt-12 text-center">
            <div class="inline-flex items-center px-4 py-2 rounded-full bg-gray-100 dark:bg-azwara-darker">
                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                <span class="text-sm text-gray-600 dark:text-gray-400">
                    Masih ada pertanyaan? Hubungi <a href="mailto:support@azwaralearning.com" class="text-primary hover:underline font-medium">Tim Support</a>
                </span>
            </div>
        </div> --}}
    </div>
</div>
@endsection

@push('scripts')
<script>
// Add some interactive animations
document.addEventListener('DOMContentLoaded', function() {
    // Animate status badge
    const statusBadge = document.querySelector('.animate-pulse');
    if (statusBadge) {
        let isPulsing = true;

        // Stop pulsing after 5 seconds
        setTimeout(() => {
            statusBadge.classList.remove('animate-pulse');
            isPulsing = false;
        }, 5000);

        // Restart pulsing on hover
        statusBadge.addEventListener('mouseenter', () => {
            if (!isPulsing) {
                statusBadge.classList.add('animate-pulse');
            }
        });

        statusBadge.addEventListener('mouseleave', () => {
            if (!isPulsing) {
                setTimeout(() => {
                    statusBadge.classList.remove('animate-pulse');
                }, 2000);
            }
        });
    }

    // Add hover effects to cards
    const cards = document.querySelectorAll('.rounded-xl');
    cards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-2px)';
            card.style.transition = 'transform 0.3s ease';
        });

        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0)';
        });
    });
});
</script>
@endpush
