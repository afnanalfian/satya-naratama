@extends('layouts.app')

@section('content')
<div class="min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- ================= HEADER ================= --}}
        <div class="mb-8">
            <nav class="flex mb-4" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('checkout.review') }}"
                           class="inline-flex items-center text-sm font-medium text-azwara-medium hover:text-azwara-darkest dark:hover:text-azwara-lighter transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Checkout
                        </a>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm text-gray-500 dark:text-gray-400">Upload Syarat</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-azwara-darkest dark:text-azwara-lighter mb-3">
                    Upload Bukti Syarat Tryout
                </h1>
                <p class="text-gray-600 dark:text-gray-400">
                    Lengkapi syarat berikut untuk mendapatkan akses tryout. Waktu tersisa:
                    <span class="font-semibold text-amber-600 dark:text-amber-400" id="countdown-timer"></span>
                </p>
            </div>
        </div>

        {{-- ================= ORDER INFO CARD ================= --}}
        <div class="bg-white dark:bg-azwara-darkest rounded-xl border border-gray-200 dark:border-azwara-medium
                    shadow-lg overflow-hidden mb-8">

            <div class="px-6 py-4 bg-gradient-to-r from-blue-50 to-white dark:from-blue-900/10 dark:to-azwara-darkest
                        border-b border-blue-100 dark:border-blue-500/20">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h2 class="font-bold text-lg text-azwara-darkest dark:text-azwara-lighter">
                            Order #{{ $order->order_code }}
                        </h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                            {{ $order->items->count() }} item • {{ $order->created_at->format('d M Y') }}
                        </p>
                    </div>

                    <div class="flex items-center gap-3">
                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium
                                     bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-300">
                            <svg class="w-3 h-3 mr-1.5 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Menunggu Syarat
                        </span>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Total Amount --}}
                    <div class="p-4 rounded-lg bg-gray-50 dark:bg-azwara-darker">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                                <svg class="w-5 h-5 text-primary dark:text-azwara-lighter" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Total Pembayaran</p>
                                <p class="text-xl font-bold text-primary dark:text-azwara-lighter">
                                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Deadline --}}
                    <div class="p-4 rounded-lg bg-amber-50 dark:bg-amber-900/10 border border-amber-200 dark:border-amber-500/20">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-10 h-10 rounded-lg bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center">
                                <svg class="w-5 h-5 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-amber-700 dark:text-amber-400">Batas Waktu</p>
                                <p class="text-lg font-bold text-amber-700 dark:text-amber-300" id="deadline-time">
                                    {{ $order->expires_at->format('d M Y, H:i') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= PAYMENT METHOD ================= --}}
        <div class="bg-white dark:bg-azwara-darkest rounded-xl border border-gray-200 dark:border-azwara-medium
                    shadow-lg overflow-hidden mb-8">

            <div class="px-6 py-4 bg-gradient-to-r from-green-50 to-white dark:from-green-900/10 dark:to-azwara-darkest
                       border-b border-green-100 dark:border-green-500/20">
                 <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-lg text-green-800 dark:text-green-300">Pembayaran via QRIS</h2>
                        <p class="text-sm text-green-600/80 dark:text-green-400/80">Scan QR Code untuk melakukan pembayaran</p>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                    {{-- QRIS Image --}}
                    <div class="flex flex-col items-center">
                        @if ($qrisImage)
                            <div class="mb-4 p-4 bg-white dark:bg-azwara-darker rounded-xl border border-gray-200 dark:border-azwara-medium shadow-sm">
                                <img src="{{ asset('storage/' . $qrisImage) }}"
                                     alt="QRIS Code"
                                     class="max-w-[280px] rounded-lg"
                                     loading="lazy">
                            </div>
                            <div class="text-center">
                                <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Scan QR Code</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Gunakan aplikasi mobile banking atau e-wallet</p>
                            </div>
                        @else
                            <div class="w-full p-8 text-center border-2 border-dashed border-gray-300 dark:border-azwara-medium rounded-xl">
                                <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <p class="text-gray-500 dark:text-gray-400">QRIS belum tersedia</p>
                            </div>
                        @endif
                    </div>

                    {{-- Instructions --}}
                    <div>
                        <div class="bg-gradient-to-br from-blue-50 to-white dark:from-blue-900/10 dark:to-azwara-darkest
                                    rounded-xl p-5 border border-blue-200 dark:border-blue-500/30 mb-4">
                            <h3 class="font-semibold text-blue-800 dark:text-blue-300 mb-3 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Petunjuk Pembayaran
                            </h3>
                            <div class="prose dark:prose-invert max-w-none text-sm text-gray-700 dark:text-gray-300">
                                {!! nl2br(e($instruction)) !!}
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-emerald-50 to-white dark:from-emerald-900/10 dark:to-azwara-darkest
                                    rounded-xl p-5 border border-emerald-200 dark:border-emerald-500/30">
                            <h3 class="font-semibold text-emerald-800 dark:text-emerald-300 mb-3 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Pastikan Anda Telah:
                            </h3>
                            <ul class="space-y-2 text-sm text-gray-700 dark:text-gray-300">
                                <li class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span>Melakukan pembayaran sesuai nominal</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span>Menyimpan bukti pembayaran</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span>Mengikuti syarat tryout di bawah</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= UPLOAD SYARAT ================= --}}
        <div class="bg-white dark:bg-azwara-darkest rounded-xl border border-gray-200 dark:border-azwara-medium
                    shadow-lg overflow-hidden mb-8">

            <div class="px-6 py-4 bg-gradient-to-r from-purple-50 to-white dark:from-purple-900/10 dark:to-azwara-darkest
                        border-b border-purple-100 dark:border-purple-500/20">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-lg text-purple-800 dark:text-purple-300">Upload Bukti Pembayaran</h2>
                        <p class="text-sm text-purple-600/80 dark:text-purple-400/80">Silakan upload bukti setelah melakukan pembayaran sesuai nominal.</p>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('checkout.uploadProof', $order) }}" enctype="multipart/form-data" id="upload-form">
                @csrf

                <div class="p-6 space-y-8">
                    {{-- Syarat 1 (Wajib) --}}
                    <div class="bg-white dark:bg-azwara-darker rounded-xl border-2 border-blue-200 dark:border-blue-500/30 p-5">
                        {{-- <div class="flex items-start justify-between mb-4">
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center flex-shrink-0">
                                    <span class="text-sm font-bold text-blue-700 dark:text-blue-400">1</span>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-blue-800 dark:text-blue-300 mb-1">
                                        Follow Instagram Azwara Learning
                                        <span class="text-red-500 ml-1">*</span>
                                    </h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        Screenshot - Follow akun instagram @azwara_learning
                                    </p>
                                </div>
                            </div>
                            <span class="text-xs px-2 py-1 rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300 font-medium">
                                Wajib
                            </span>
                        </div> --}}

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Upload Bukti Pembayaran
                            </label>
                            <div class="relative">
                                <input type="file"
                                       name="proof_image"
                                       required
                                       accept="image/*,.pdf"
                                       class="w-full px-4 py-3 rounded-lg border-2 border-dashed border-gray-300 dark:border-azwara-medium
                                              bg-white dark:bg-azwara-darkest
                                              text-gray-900 dark:text-gray-100
                                              file:mr-4 file:py-2 file:px-4
                                              file:rounded-lg file:border-0
                                              file:bg-gradient-to-r file:from-blue-600 file:to-blue-700 file:text-white
                                              hover:file:from-blue-700 hover:file:to-blue-800
                                              transition-colors cursor-pointer">
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                                Format: JPG, PNG, atau PDF (maks. 5MB)
                            </p>
                        </div>
                    </div>

                    {{-- Syarat 2 (Wajib) --}}
                    {{-- <div class="bg-white dark:bg-azwara-darker rounded-xl border-2 border-green-200 dark:border-green-500/30 p-5">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-lg bg-green-100 dark:bg-green-900/30 flex items-center justify-center flex-shrink-0">
                                    <span class="text-sm font-bold text-green-700 dark:text-green-400">2</span>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-green-800 dark:text-green-300 mb-1">
                                        Repost Postingan Tryout ke Story
                                        <span class="text-red-500 ml-1">*</span>
                                    </h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        Screenshoot - Repost postingan Tryout ke story instagram
                                    </p>
                                </div>
                            </div>
                            <span class="text-xs px-2 py-1 rounded-full bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300 font-medium">
                                Wajib
                            </span>
                        </div>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Upload Bukti Screenshot
                            </label>
                            <div class="relative">
                                <input type="file"
                                       name="proof_images[]"
                                       required
                                       accept="image/*,.pdf"
                                       class="w-full px-4 py-3 rounded-lg border-2 border-dashed border-gray-300 dark:border-azwara-medium
                                              bg-white dark:bg-azwara-darkest
                                              text-gray-900 dark:text-gray-100
                                              file:mr-4 file:py-2 file:px-4
                                              file:rounded-lg file:border-0
                                              file:bg-gradient-to-r file:from-green-600 file:to-green-700 file:text-white
                                              hover:file:from-green-700 hover:file:to-green-800
                                              transition-colors cursor-pointer">
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                                Format: JPG, PNG, atau PDF (maks. 5MB)
                            </p>
                        </div>
                    </div> --}}

                    {{-- Syarat 3 (Wajib) --}}
                    {{-- <div class="bg-white dark:bg-azwara-darker rounded-xl border-2 border-purple-200 dark:border-purple-500/30 p-5">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-lg bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center flex-shrink-0">
                                    <span class="text-sm font-bold text-purple-700 dark:text-purple-400">3</span>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-purple-800 dark:text-purple-300 mb-1">
                                        Mention 5 Teman di Komentar
                                        <span class="text-red-500 ml-1">*</span>
                                    </h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        Screenshoot - Mention 5 teman di kolom komentar postingan
                                    </p>
                                </div>
                            </div>
                            <span class="text-xs px-2 py-1 rounded-full bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300 font-medium">
                                Wajib
                            </span>
                        </div>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Upload Bukti Screenshot
                            </label>
                            <div class="relative">
                                <input type="file"
                                       name="proof_images[]"
                                       required
                                       accept="image/*,.pdf"
                                       class="w-full px-4 py-3 rounded-lg border-2 border-dashed border-gray-300 dark:border-azwara-medium
                                              bg-white dark:bg-azwara-darkest
                                              text-gray-900 dark:text-gray-100
                                              file:mr-4 file:py-2 file:px-4
                                              file:rounded-lg file:border-0
                                              file:bg-gradient-to-r file:from-purple-600 file:to-purple-700 file:text-white
                                              hover:file:from-purple-700 hover:file:to-purple-800
                                              transition-colors cursor-pointer">
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                                Format: JPG, PNG, atau PDF (maks. 5MB)
                            </p>
                        </div>
                    </div> --}}

                    {{-- Error Display --}}
                    @error('proof_image')
                        <div class="p-4 rounded-lg bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-500/30">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.794-.833-2.564 0L4.22 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                </svg>
                                <span class="font-medium text-red-700 dark:text-red-400">{{ $message }}</span>
                            </div>
                        </div>
                    @enderror

                    {{-- @error('proof_images.*')
                        <div class="p-4 rounded-lg bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-500/30">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.794-.833-2.564 0L4.22 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                </svg>
                                <span class="font-medium text-red-700 dark:text-red-400">{{ $message }}</span>
                            </div>
                        </div>
                    @enderror --}}

                    {{-- Submit Button --}}
                    <div class="pt-6 border-t border-gray-200 dark:border-azwara-medium">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div class="text-sm text-gray-600 dark:text-gray-400">
                                <p>Pastikan upload bukti pembayaran yang sesuai.</p>
                            </div>

                            <button type="submit"
                                    id="submit-btn"
                                    class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-3.5 rounded-lg
                                           bg-gradient-to-r from-primary to-azwara-medium text-white
                                           font-bold hover:from-primary/90 hover:to-azwara-medium/90
                                           transition-all duration-200 shadow-lg hover:shadow-xl
                                           disabled:opacity-50 disabled:cursor-not-allowed">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/>
                                </svg>
                                Upload Bukti Pembayaran
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Countdown Timer
    const countdownElement = document.getElementById('countdown-timer');
    const deadlineTime = document.getElementById('deadline-time').textContent;
    const deadline = new Date(deadlineTime).getTime();

    function updateCountdown() {
        const now = new Date().getTime();
        const distance = deadline - now;

        if (distance < 0) {
            countdownElement.textContent = "Waktu habis!";
            countdownElement.classList.remove('text-amber-600', 'dark:text-amber-400');
            countdownElement.classList.add('text-red-600', 'dark:text-red-400');
            return;
        }

        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        countdownElement.textContent = `${hours} jam ${minutes} menit ${seconds} detik`;

        // Warning colors
        if (distance < 3600000) { // Less than 1 hour
            countdownElement.classList.remove('text-amber-600', 'dark:text-amber-400');
            countdownElement.classList.add('text-red-600', 'dark:text-red-400');
        }
    }

    // Update every second
    updateCountdown();
    setInterval(updateCountdown, 1000);

    // File upload preview and validation
    const fileInputs = document.querySelectorAll('input[type="file"]');
    const submitBtn = document.getElementById('submit-btn');

    fileInputs.forEach(input => {
        input.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                // File size validation (5MB)
                const maxSize = 5 * 1024 * 1024; // 5MB in bytes
                if (file.size > maxSize) {
                    alert('Ukuran file terlalu besar. Maksimal 5MB.');
                    this.value = '';
                    return;
                }

                // File type validation
                const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'application/pdf'];
                if (!allowedTypes.includes(file.type)) {
                    alert('Format file tidak didukung. Gunakan JPG, PNG, atau PDF.');
                    this.value = '';
                    return;
                }

                // Update UI feedback
                const parentDiv = this.closest('.relative');
                if (parentDiv) {
                    // Add success indicator
                    const existingIndicator = parentDiv.querySelector('.file-success');
                    if (existingIndicator) existingIndicator.remove();

                    const indicator = document.createElement('div');
                    indicator.className = 'file-success absolute right-3 top-1/2 transform -translate-y-1/2';
                    indicator.innerHTML = `
                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    `;
                    parentDiv.appendChild(indicator);

                    // Change border color
                    this.classList.remove('border-gray-300', 'dark:border-azwara-medium');
                    this.classList.add('border-green-500', 'dark:border-green-500');
                }
            }
        });
    });

    // Form submission
    const form = document.getElementById('upload-form');
    form.addEventListener('submit', function(e) {
        // Validate all required files
        const requiredInputs = this.querySelectorAll('input[type="file"][required]');
        let allValid = true;

        requiredInputs.forEach(input => {
            if (!input.files || input.files.length === 0) {
                allValid = false;
                // Highlight empty inputs
                input.classList.add('border-red-500', 'dark:border-red-500');
                input.classList.remove('border-gray-300', 'dark:border-azwara-medium', 'border-green-500', 'dark:border-green-500');
            }
        });

        if (!allValid) {
            e.preventDefault();
            alert('Silakan lengkapi semua syarat wajib sebelum mengupload.');
            return;
        }

        // Show loading state
        submitBtn.disabled = true;
        submitBtn.innerHTML = `
            <svg class="w-5 h-5 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
            </svg>
            Mengupload...
        `;
    });

    // Add hover effects to cards
    const requirementCards = document.querySelectorAll('.bg-white.rounded-xl');
    requirementCards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-2px)';
            card.style.transition = 'transform 0.2s ease';
        });

        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0)';
        });
    });
});
</script>
@endpush
