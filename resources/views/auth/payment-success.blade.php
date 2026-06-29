@extends('layouts.guest')

@section('title', 'Pendaftaran Berhasil – Satya Naratama')
@section('content')

<div class="w-full py-12 sm:py-20 px-4 flex items-center justify-center">

    <div
        class="w-full max-w-2xl mx-auto
            p-6 sm:p-8
            rounded-3xl shadow-xl
            bg-azwara-lightest dark:bg-azwara-darker
            border border-azwara-light/30
            transition-colors text-center">

        {{-- Icon --}}
        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-green-100 dark:bg-green-900/30 mb-6">
            <svg class="w-10 h-10 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>

        {{-- Title --}}
        <h2 class="text-2xl font-extrabold text-azwara-darker dark:text-white mb-2">
            Pendaftaran Berhasil! 🎉
        </h2>
        <p class="text-gray-600 dark:text-gray-400 mb-6">
            Pembayaran Anda sedang direview oleh admin
        </p>

        {{-- Info --}}
        <div class="bg-primary/5 dark:bg-primary/10 rounded-xl p-4 mb-6 border border-primary/20 text-left">
            <div class="flex justify-between items-center py-2 border-b border-gray-200 dark:border-gray-700">
                <span class="text-sm text-gray-600 dark:text-gray-400">Nama</span>
                <span class="text-sm font-medium text-azwara-darker dark:text-white">{{ $registration->full_name }}</span>
            </div>
            <div class="flex justify-between items-center py-2 border-b border-gray-200 dark:border-gray-700">
                <span class="text-sm text-gray-600 dark:text-gray-400">Email</span>
                <span class="text-sm font-medium text-azwara-darker dark:text-white">{{ $registration->email }}</span>
            </div>
            <div class="flex justify-between items-center py-2">
                <span class="text-sm text-gray-600 dark:text-gray-400">Status</span>
                <span class="text-sm font-medium text-yellow-600 dark:text-yellow-400">
                    ⏳ Menunggu Verifikasi
                </span>
            </div>
        </div>

        {{-- Info Proses --}}
        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-4 mb-6 text-left">
            <p class="text-sm text-blue-800 dark:text-blue-200 font-medium mb-1">
                📋 Yang Perlu Dilakukan Selanjutnya:
            </p>
            <ul class="text-sm text-blue-700 dark:text-blue-300 space-y-1 list-disc list-inside">
                <li>Admin akan memverifikasi pembayaran Anda</li>
                <li>Proses verifikasi membutuhkan waktu 1x24 jam</li>
                <li>Anda akan mendapat notifikasi via email</li>
                <li>Jika sudah diverifikasi, akun Anda akan aktif</li>
            </ul>
        </div>

        {{-- Actions --}}
        <div class="flex flex-col sm:flex-row gap-3">
            <a href="{{ route('daftar.status.form') }}"
               class="flex-1 py-3 rounded-xl font-bold text-center
                    bg-gradient-to-r from-primary to-azwara-medium
                    text-white
                    hover:shadow-xl hover:scale-[1.01] transition-all duration-300">
                Cek Status Pendaftaran
            </a>
            
            <a href="https://wa.me/6282154734819?text=Halo%20Admin%2C%20saya%20{{ $registration->full_name }}%20ingin%20konfirmasi%20pembayaran%20pendaftaran"
               target="_blank"
               class="flex-1 py-3 rounded-xl font-medium text-center
                    border-2 border-primary/30
                    text-primary
                    hover:bg-primary/5
                    transition-all duration-300">
                <svg class="inline-block w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                </svg>
                Chat Admin
            </a>
        </div>

        <p class="text-sm text-gray-500 dark:text-gray-400 mt-6">
            <a href="{{ route('home') }}" class="hover:underline">
                ← Kembali ke Beranda
            </a>
        </p>

    </div>
</div>

@endsection