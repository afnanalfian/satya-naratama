@extends('layouts.app')

@section('content')
<div class="min-h-screen py-8 bg-gradient-to-b from-primary-50/50 to-neutral-50 dark:from-primary-900/20 dark:to-neutral-900">
    <div class="max-w-2xl mx-auto px-4 sm:px-6">

        {{-- Back Button --}}
        <div class="mb-6">
            <a href="{{ route('profile.show') }}"
               class="inline-flex items-center gap-2 text-sm font-medium text-secondary-600 dark:text-secondary-300 hover:text-primary-600 dark:hover:text-primary-300 transition-colors group">
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Profil
            </a>
        </div>

        {{-- Danger Card --}}
        <div class="bg-white dark:bg-primary-900/30 backdrop-blur-sm rounded-3xl shadow-2xl dark:shadow-red-900/20 border border-red-200 dark:border-red-700/30 overflow-hidden transition-all">

            {{-- Header --}}
            <div class="px-6 sm:px-8 pt-8 pb-6 border-b border-red-100 dark:border-red-700/20">
                <div class="flex items-center gap-3">
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-red-100 text-red-600 dark:bg-red-900/40 dark:text-red-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </span>
                    <div>
                        <h1 class="text-2xl font-bold text-red-600 dark:text-red-400 font-display tracking-tight">
                            Hapus Akun
                        </h1>
                        <p class="text-sm text-secondary-500 dark:text-secondary-300 mt-0.5">
                            Tindakan ini bersifat permanen dan tidak dapat dibatalkan
                        </p>
                    </div>
                </div>
            </div>

            {{-- Content --}}
            <div class="px-6 sm:px-8 py-6">
                {{-- Warning --}}
                <div class="mb-6 p-4 rounded-2xl bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-700/30">
                    <div class="flex gap-3">
                        <svg class="w-5 h-5 text-red-500 dark:text-red-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-red-700 dark:text-red-300">
                                ⚠️ Perhatian: Tindakan Ini Serius
                            </p>
                            <ul class="mt-2 text-sm text-red-600 dark:text-red-400 space-y-1 list-disc list-inside">
                                <li>Semua sesi pembelian akan hangus</li>
                                <li>Akun masih dapat diaktifkan kembali dalam waktu <strong>10 hari</strong> dengan login ulang</li>
                                <li>Setelah 10 hari, data akan dihapus permanen</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('profile.destroy') }}" x-data="{ other: false }" class="space-y-6 sweet-confirm" data-message="Yakin ingin menghapus akun? Akun masih bisa diaktifkan kembali dalam 10 hari.">
                    @csrf

                    {{-- Reason --}}
                    <div>
                        <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                            Alasan Penghapusan <span class="text-accent-500">*</span>
                        </label>
                        <select name="reason_option" x-on:change="other = ($event.target.value === 'Lainnya')"
                                class="w-full px-4 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200">
                            <option value="">-- Pilih Alasan --</option>
                            <option value="Terlalu mahal">Terlalu mahal</option>
                            <option value="Tidak sesuai kebutuhan">Tidak sesuai kebutuhan</option>
                            <option value="Jarang digunakan">Jarang digunakan</option>
                            <option value="Pindah platform lain">Pindah platform lain</option>
                            <option value="Lainnya">Lainnya...</option>
                        </select>

                        <div x-show="other" x-transition class="mt-3">
                            <input type="text" name="reason_custom" placeholder="Tuliskan alasan Anda..."
                                   class="w-full px-4 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 placeholder-secondary-400 focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200">
                        </div>
                    </div>

                    {{-- Confirmation --}}
                    <div class="p-4 rounded-2xl bg-red-50 dark:bg-red-900/10 border border-red-200 dark:border-red-700/20">
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" required
                                   class="w-5 h-5 rounded border-red-300 dark:border-red-600 text-red-600 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-primary-900">
                            <span class="text-sm text-red-700 dark:text-red-300">
                                Saya memahami konsekuensi dan ingin menghapus akun ini
                            </span>
                        </label>
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                            class="w-full inline-flex items-center justify-center gap-3 px-6 py-4 rounded-2xl text-white font-semibold bg-red-600 hover:bg-red-700 hover:shadow-xl hover:shadow-red-500/30 hover:scale-[1.02] transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Hapus Akun Permanen
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
