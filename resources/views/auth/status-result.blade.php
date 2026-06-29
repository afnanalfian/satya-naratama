@extends('layouts.guest')

@section('title', 'Hasil Cek Status – Satya Naratama')
@section('content')

<div class="w-full py-12 sm:py-20 px-4 flex items-center justify-center">

    <div
        class="w-full max-w-2xl mx-auto
            p-6 sm:p-8
            rounded-3xl shadow-xl
            bg-azwara-lightest dark:bg-azwara-darker
            border border-azwara-light/30
            transition-colors">

        {{-- Back Button --}}
        <a href="{{ route('daftar.status.form') }}"
           class="inline-flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 hover:text-primary transition-colors mb-4">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>

        {{-- Title --}}
        <div class="text-center mb-6">
            <div class="flex items-center justify-center gap-3 mb-2">
                <span class="h-px w-8 bg-primary/60"></span>
                <p class="text-xs font-semibold tracking-[0.2em] text-primary uppercase">Status Pendaftaran</p>
                <span class="h-px w-8 bg-primary/60"></span>
            </div>
            <h2 class="text-2xl font-extrabold text-azwara-darker dark:text-white">
                {{ $registration->full_name }}
            </h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                {{ $registration->email }}
            </p>
        </div>

        {{-- Status Card --}}
        <div class="rounded-xl p-6 mb-6 border
            @if($registration->isVerified())
                bg-green-50 dark:bg-green-900/20 border-green-200 dark:border-green-800
            @elseif($registration->isRejected())
                bg-red-50 dark:bg-red-900/20 border-red-200 dark:border-red-800
            @elseif($registration->isAwaitingVerification())
                bg-yellow-50 dark:bg-yellow-900/20 border-yellow-200 dark:border-yellow-800
            @elseif($registration->canMakePayment())
                bg-blue-50 dark:bg-blue-900/20 border-blue-200 dark:border-blue-800
            @else
                bg-gray-50 dark:bg-gray-900/20 border-gray-200 dark:border-gray-800
            @endif
        ">

            {{-- Status Icon & Label --}}
            <div class="text-center mb-4">
                @if($registration->isVerified())
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-green-100 dark:bg-green-900/30 mb-3">
                        <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-green-700 dark:text-green-400">
                        ✅ Pendaftaran Diterima!
                    </h3>
                    <p class="text-sm text-green-600 dark:text-green-300 mt-1">
                        Akun Anda sudah aktif. Silakan login.
                    </p>
                @elseif($registration->isRejected())
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-red-100 dark:bg-red-900/30 mb-3">
                        <svg class="w-8 h-8 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-red-700 dark:text-red-400">
                        ❌ Pendaftaran Ditolak
                    </h3>
                    @if($registration->rejection_reason)
                        <p class="text-sm text-red-600 dark:text-red-300 mt-1">
                            Alasan: {{ $registration->rejection_reason }}
                        </p>
                    @endif
                @elseif($registration->isAwaitingVerification())
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-yellow-100 dark:bg-yellow-900/30 mb-3">
                        <svg class="w-8 h-8 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-yellow-700 dark:text-yellow-400">
                        ⏳ Menunggu Verifikasi
                    </h3>
                    <p class="text-sm text-yellow-600 dark:text-yellow-300 mt-1">
                        Pembayaran Anda sedang diverifikasi oleh admin.
                    </p>
                @elseif($registration->canMakePayment())
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-100 dark:bg-blue-900/30 mb-3">
                        <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v1m0 9c-1.657 0-3-.895-3-2s1.343-2 3-2 3-.895 3-2-1.343-2-3-2"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-blue-700 dark:text-blue-400">
                        💳 Menunggu Pembayaran
                    </h3>
                    <p class="text-sm text-blue-600 dark:text-blue-300 mt-1">
                        Silakan lakukan pembayaran sebelum {{ $registration->payment_expires_at->format('d M Y H:i') }}
                    </p>
                    @if($registration->isExpired())
                        <p class="text-sm text-red-600 dark:text-red-400 mt-1 font-medium">
                            ⚠️ Waktu pembayaran telah habis!
                        </p>
                    @endif
                @else
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-800 mb-3">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-600 dark:text-gray-400">
                        Status Tidak Diketahui
                    </h3>
                @endif
            </div>

            {{-- Detail Info --}}
            <div class="space-y-2 text-sm border-t border-gray-200 dark:border-gray-700 pt-4">
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">Tanggal Daftar</span>
                    <span class="font-medium text-azwara-darker dark:text-white">
                        {{ $registration->created_at->format('d M Y H:i') }}
                    </span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">Status Pembayaran</span>
                    <span class="font-medium
                        @if($registration->payment_status == 'verified') text-green-600
                        @elseif($registration->payment_status == 'rejected') text-red-600
                        @elseif($registration->payment_status == 'paid') text-yellow-600
                        @elseif($registration->payment_status == 'expired') text-red-600
                        @else text-blue-600 @endif">
                        {{ $registration->payment_status_label }}
                    </span>
                </div>
                @if($registration->payment_expires_at)
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Batas Bayar</span>
                        <span class="font-medium text-azwara-darker dark:text-white">
                            {{ $registration->payment_expires_at->format('d M Y H:i') }}
                        </span>
                    </div>
                @endif
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex flex-col sm:flex-row gap-3">
            @if($registration->canMakePayment())
                <a href="{{ route('daftar.payment', $registration->id) }}"
                   class="flex-1 py-3 rounded-xl font-bold text-center
                        bg-gradient-to-r from-primary to-azwara-medium
                        text-white
                        hover:shadow-xl hover:scale-[1.01] transition-all duration-300">
                    Bayar Sekarang 💳
                </a>
            @endif

            @if($registration->isVerified())
                <a href="{{ route('login') }}"
                   class="flex-1 py-3 rounded-xl font-bold text-center
                        bg-gradient-to-r from-primary to-azwara-medium
                        text-white
                        hover:shadow-xl hover:scale-[1.01] transition-all duration-300">
                    Login Sekarang 🔑
                </a>
            @endif

            <a href="https://wa.me/6282154734819?text=Halo%20Admin%2C%20saya%20{{ $registration->full_name }}%20ingin%20bertanya%20tentang%20pendaftaran%20saya"
               target="_blank"
               class="py-3 px-4 rounded-xl font-medium text-center
                    border-2 border-primary/30
                    text-primary
                    hover:bg-primary/5
                    transition-all duration-300
                    @if($registration->canMakePayment() || $registration->isVerified()) flex-1 @endif">
                <svg class="inline-block w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                </svg>
                Chat Admin
            </a>
        </div>

        <p class="text-sm text-center text-gray-500 dark:text-gray-400 mt-4">
            <a href="{{ route('home') }}" class="hover:underline">
                ← Kembali ke Beranda
            </a>
        </p>

    </div>
</div>

@endsection