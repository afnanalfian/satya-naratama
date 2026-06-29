@extends('layouts.app')

@section('content')
<div class="w-full py-8 px-4 flex items-center justify-center">

    <div class="w-full max-w-2xl mx-auto p-6 sm:p-8 rounded-3xl shadow-xl bg-azwara-lightest dark:bg-azwara-darker border border-azwara-light/30">

        {{-- Header --}}
        <div class="text-center mb-6">
            <div class="flex items-center justify-center gap-3 mb-2">
                <span class="h-px w-8 bg-red-600/60"></span>
                <p class="text-xs font-semibold tracking-[0.2em] text-red-600 uppercase">Tolak Pendaftaran</p>
                <span class="h-px w-8 bg-red-600/60"></span>
            </div>
            <h2 class="text-2xl font-bold text-azwara-darker dark:text-white">
                {{ $registration->full_name }}
            </h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $registration->email }}</p>
        </div>

        {{-- Warning --}}
        <div class="bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-xl p-4 mb-6">
            <p class="text-sm text-red-800 dark:text-red-200">
                ⚠️ Penolakan akan mengirim email pemberitahuan ke siswa.
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
        </div>

        {{-- Form --}}
        <form action="{{ route('admin.registrations.reject', $registration->id) }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                    Alasan Penolakan <span class="text-red-500">*</span>
                </label>
                <textarea name="rejection_reason" required
                    rows="4"
                    placeholder="Jelaskan alasan penolakan pendaftaran ini..."
                    class="mt-1 w-full px-4 py-3 rounded-xl
                            bg-white dark:bg-gray-800
                            border-gray-300 dark:border-gray-700
                            text-gray-800 dark:text-white
                            focus:ring-primary focus:border-primary
                            @error('rejection_reason') border-red-500 @enderror"></textarea>
                @error('rejection_reason')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <button type="submit"
                    class="flex-1 py-3 rounded-xl font-bold text-white
                        bg-gradient-to-r from-red-600 to-red-700
                        hover:shadow-xl hover:scale-[1.01] transition-all duration-300">
                    ❌ Tolak Pendaftaran
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