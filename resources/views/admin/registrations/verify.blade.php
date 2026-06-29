@extends('layouts.app')

@section('content')
<div class="w-full py-8 px-4 flex items-center justify-center">

    <div class="w-full max-w-2xl mx-auto p-6 sm:p-8 rounded-3xl shadow-xl bg-azwara-lightest dark:bg-azwara-darker border border-azwara-light/30">

        {{-- Header --}}
        <div class="text-center mb-6">
            <div class="flex items-center justify-center gap-3 mb-2">
                <span class="h-px w-8 bg-green-600/60"></span>
                <p class="text-xs font-semibold tracking-[0.2em] text-green-600 uppercase">Verifikasi Pendaftaran</p>
                <span class="h-px w-8 bg-green-600/60"></span>
            </div>
            <h2 class="text-2xl font-bold text-azwara-darker dark:text-white">
                {{ $registration->full_name }}
            </h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $registration->email }}</p>
        </div>

        {{-- Info --}}
        <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-xl p-4 mb-6">
            <p class="text-sm text-yellow-800 dark:text-yellow-200">
                ⚠️ Verifikasi akan membuat akun siswa dan mengaktifkannya.
            </p>
        </div>

        {{-- Ringkasan --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl p-4 mb-6 border border-gray-200 dark:border-gray-700 space-y-2 text-sm">
            <div class="flex justify-between">
                <span class="text-gray-500 dark:text-gray-400">Nama</span>
                <span class="font-medium">{{ $registration->full_name }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500 dark:text-gray-400">Email</span>
                <span class="font-medium">{{ $registration->email }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500 dark:text-gray-400">No WhatsApp</span>
                <span class="font-medium">{{ $registration->phone }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500 dark:text-gray-400">Biaya</span>
                <span class="font-bold text-azwara-darker dark:text-white">
                    Rp {{ number_format($registration->registration_fee, 0, ',', '.') }}
                </span>
            </div>
            @if($registration->payment_proof)
                <div class="flex justify-between">
                    <span class="text-gray-500 dark:text-gray-400">Bukti Pembayaran</span>
                    <a href="{{ route('admin.registrations.download-proof', $registration->id) }}"
                       class="text-primary hover:underline font-medium">
                        📎 Download Bukti
                    </a>
                </div>
            @endif
        </div>

        {{-- Form --}}
        <form action="{{ route('admin.registrations.verify', $registration->id) }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                    Catatan Verifikasi (Opsional)
                </label>
                <textarea name="verification_notes"
                    rows="3"
                    placeholder="Tambahkan catatan jika diperlukan..."
                    class="mt-1 w-full px-4 py-3 rounded-xl
                            bg-white dark:bg-gray-800
                            border-gray-300 dark:border-gray-700
                            text-gray-800 dark:text-white
                            focus:ring-primary focus:border-primary"></textarea>
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <button type="submit"
                    class="flex-1 py-3 rounded-xl font-bold text-white
                        bg-gradient-to-r from-green-600 to-green-700
                        hover:shadow-xl hover:scale-[1.01] transition-all duration-300">
                    ✅ Verifikasi & Buat Akun
                </button>

                <a href="{{ route('admin.registrations.show', $registration->id) }}"
                   class="flex-1 py-3 rounded-xl font-medium text-center
                        border-2 border-gray-300 dark:border-gray-700
                        text-gray-600 dark:text-gray-400
                        hover:bg-gray-100 dark:hover:bg-gray-800
                        transition-all duration-300">
                    Batal
                </a>
            </div>
        </form>

    </div>
</div>
@endsection