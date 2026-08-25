@extends('layouts.app')

@section('content')
<div class="min-h-screen py-8 bg-gradient-to-b from-primary-50/50 to-neutral-50 dark:from-primary-900/20 dark:to-neutral-900">
    <div class="max-w-5xl mx-auto px-4 sm:px-6">

        {{-- Page Header --}}
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-2">
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-brand-gradient text-white shadow-lg shadow-primary-500/30">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </span>
                <div>
                    <h1 class="text-3xl font-bold text-primary-800 dark:text-primary-100 font-display tracking-tight">
                        Profil Saya
                    </h1>
                    <p class="text-sm text-secondary-500 dark:text-secondary-300 mt-0.5">
                        Kelola informasi akun dan data pribadi Anda
                    </p>
                </div>
            </div>
        </div>

        {{-- Main Card --}}
        <div class="bg-white dark:bg-primary-900/30 backdrop-blur-sm rounded-3xl shadow-2xl dark:shadow-primary-900/30 border border-primary-200/50 dark:border-primary-700/30 overflow-hidden transition-all hover:shadow-primary-500/10">

            {{-- Header with Cover --}}
            <div class="relative h-24 sm:h-32 bg-brand-gradient">
                <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmZmZmYiIGZpbGwtb3BhY2l0eT0iMC4wNSI+PHBhdGggZD0iTTM2IDM0djItSDI0di0yaDEyek0zNiAyNHYySDI0di0yaDEyeiIvPjwvZz48L2c+PC9zdmc+')] opacity-20"></div>
            </div>

            {{-- Profile Section --}}
            <div class="px-6 sm:px-8 pb-8">
                {{-- Avatar & Identity --}}
                <div class="flex flex-col sm:flex-row items-center gap-6 -mt-14 sm:-mt-16 relative z-10">
                    {{-- Avatar --}}
                    <div class="relative group">
                        <div class="absolute inset-0 rounded-full bg-brand-gradient blur-md opacity-40 group-hover:opacity-60 transition-opacity duration-300"></div>
                        <img src="{{ auth()->user()->avatar_url }}"
                            alt="Avatar"
                            class="relative w-24 h-24 sm:w-28 sm:h-28 rounded-full object-cover border-4 border-white dark:border-primary-700 shadow-xl group-hover:scale-105 transition-transform duration-300" />
                        <div class="absolute bottom-0 right-0 w-6 h-6 bg-emerald-500 rounded-full border-2 border-white dark:border-primary-800 shadow-lg"></div>
                    </div>

                    {{-- Identity --}}
                    <div class="text-center sm:text-left flex-1">
                        <h2 class="text-xl sm:text-2xl font-bold text-primary-800 dark:text-primary-50 font-display">
                            {{ auth()->user()->name }}
                        </h2>
                        <div class="flex flex-col sm:flex-row items-center gap-2 sm:gap-4 mt-1">
                            <p class="text-sm text-secondary-500 dark:text-secondary-300 flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                {{ auth()->user()->email }}
                            </p>
                            @if(auth()->user()->hasRole('siswa'))
                            <span class="inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full text-xs font-medium bg-gold-100 text-gold-700 dark:bg-gold-900/40 dark:text-gold-300 border border-gold-200 dark:border-gold-700/30">
                                <span class="w-1.5 h-1.5 rounded-full bg-gold-500 animate-pulse"></span>
                                Siswa
                            </span>
                            @endif
                        </div>
                    </div>

                    {{-- Edit Quick Action --}}
                    <a href="{{ route('profile.edit') }}"
                       class="shrink-0 inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-medium text-white bg-brand-gradient hover:shadow-lg hover:shadow-primary-500/30 hover:scale-105 transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit Profil
                    </a>
                </div>

                {{-- Quick Stats --}}
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mt-6 pt-6 border-t border-primary-100 dark:border-primary-700/30">
                    <div class="text-center">
                        <p class="text-2xl font-bold text-primary-700 dark:text-primary-300">{{ auth()->user()->studentRegistration ? '✓' : '-' }}</p>
                        <p class="text-xs text-secondary-500 dark:text-secondary-400">Status</p>
                    </div>
                    <div class="text-center">
                        <p class="text-2xl font-bold text-primary-700 dark:text-primary-300">{{ auth()->user()->studentRegistration->class ?? '-' }}</p>
                        <p class="text-xs text-secondary-500 dark:text-secondary-400">Kelas</p>
                    </div>
                    <div class="text-center">
                        <p class="text-2xl font-bold text-primary-700 dark:text-primary-300">{{ auth()->user()->studentRegistration->school_origin ?? '-' }}</p>
                        <p class="text-xs text-secondary-500 dark:text-secondary-400">Asal Sekolah</p>
                    </div>
                    <div class="text-center">
                        <p class="text-2xl font-bold text-primary-700 dark:text-primary-300">{{ auth()->user()->studentRegistration->kecamatan->name ?? '-' }}</p>
                        <p class="text-xs text-secondary-500 dark:text-secondary-400">Kecamatan</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Student Registration Data --}}
        @php
            $registration = auth()->user()->studentRegistration;
        @endphp

        @if($registration)
        <div class="mt-8">
            <div class="flex items-center gap-3 mb-5">
                <span class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-accent-100 text-accent-600 dark:bg-accent-900/40 dark:text-accent-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </span>
                <h3 class="text-xl font-bold text-primary-800 dark:text-primary-100 font-display">
                    Data Pendaftaran
                </h3>
                <span class="ml-auto text-xs px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-700/30">
                    Terverifikasi
                </span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                {{-- Personal Info --}}
                <div class="bg-white dark:bg-primary-900/30 rounded-2xl p-5 border border-primary-100 dark:border-primary-700/30 shadow-sm hover:shadow-md transition-all duration-200">
                    <p class="text-xs uppercase tracking-wider text-secondary-400 dark:text-secondary-400 font-medium mb-1">Nama Lengkap</p>
                    <p class="font-semibold text-primary-800 dark:text-primary-50">{{ $registration->full_name }}</p>
                </div>
                <div class="bg-white dark:bg-primary-900/30 rounded-2xl p-5 border border-primary-100 dark:border-primary-700/30 shadow-sm hover:shadow-md transition-all duration-200">
                    <p class="text-xs uppercase tracking-wider text-secondary-400 dark:text-secondary-400 font-medium mb-1">Nama Panggilan</p>
                    <p class="font-semibold text-primary-800 dark:text-primary-50">{{ $registration->nickname ?? '-' }}</p>
                </div>
                <div class="bg-white dark:bg-primary-900/30 rounded-2xl p-5 border border-primary-100 dark:border-primary-700/30 shadow-sm hover:shadow-md transition-all duration-200">
                    <p class="text-xs uppercase tracking-wider text-secondary-400 dark:text-secondary-400 font-medium mb-1">Tanggal Lahir</p>
                    <p class="font-semibold text-primary-800 dark:text-primary-50">{{ $registration->birth_date->format('d M Y') }}</p>
                </div>
                <div class="bg-white dark:bg-primary-900/30 rounded-2xl p-5 border border-primary-100 dark:border-primary-700/30 shadow-sm hover:shadow-md transition-all duration-200">
                    <p class="text-xs uppercase tracking-wider text-secondary-400 dark:text-secondary-400 font-medium mb-1">Jenis Kelamin</p>
                    <p class="font-semibold text-primary-800 dark:text-primary-50">
                        <span class="inline-flex items-center gap-1.5">
                            {{ $registration->gender_label }}
                            @if($registration->gender == 'L')
                            <span class="text-blue-500">♂</span>
                            @else
                            <span class="text-pink-500">♀</span>
                            @endif
                        </span>
                    </p>
                </div>
                <div class="bg-white dark:bg-primary-900/30 rounded-2xl p-5 border border-primary-100 dark:border-primary-700/30 shadow-sm hover:shadow-md transition-all duration-200">
                    <p class="text-xs uppercase tracking-wider text-secondary-400 dark:text-secondary-400 font-medium mb-1">Asal Sekolah</p>
                    <p class="font-semibold text-primary-800 dark:text-primary-50">{{ $registration->school_origin }}</p>
                </div>
                <div class="bg-white dark:bg-primary-900/30 rounded-2xl p-5 border border-primary-100 dark:border-primary-700/30 shadow-sm hover:shadow-md transition-all duration-200">
                    <p class="text-xs uppercase tracking-wider text-secondary-400 dark:text-secondary-400 font-medium mb-1">Kelas</p>
                    <p class="font-semibold text-primary-800 dark:text-primary-50">{{ $registration->class }}</p>
                </div>
                <div class="bg-white dark:bg-primary-900/30 rounded-2xl p-5 border border-primary-100 dark:border-primary-700/30 shadow-sm hover:shadow-md transition-all duration-200">
                    <p class="text-xs uppercase tracking-wider text-secondary-400 dark:text-secondary-400 font-medium mb-1">Kecamatan</p>
                    <p class="font-semibold text-primary-800 dark:text-primary-50">{{ $registration->kecamatan->name ?? '-' }}</p>
                </div>
                <div class="bg-white dark:bg-primary-900/30 rounded-2xl p-5 border border-primary-100 dark:border-primary-700/30 shadow-sm hover:shadow-md transition-all duration-200">
                    <p class="text-xs uppercase tracking-wider text-secondary-400 dark:text-secondary-400 font-medium mb-1">Kelurahan/Desa</p>
                    <p class="font-semibold text-primary-800 dark:text-primary-50">{{ $registration->kelurahan->name ?? '-' }}</p>
                </div>
                <div class="bg-white dark:bg-primary-900/30 rounded-2xl p-5 border border-primary-100 dark:border-primary-700/30 shadow-sm hover:shadow-md transition-all duration-200">
                    <p class="text-xs uppercase tracking-wider text-secondary-400 dark:text-secondary-400 font-medium mb-1">Tinggi Badan</p>
                    <p class="font-semibold text-primary-800 dark:text-primary-50">{{ $registration->height_cm ? $registration->height_cm . ' cm' : '-' }}</p>
                </div>
                <div class="bg-white dark:bg-primary-900/30 rounded-2xl p-5 border border-primary-100 dark:border-primary-700/30 shadow-sm hover:shadow-md transition-all duration-200">
                    <p class="text-xs uppercase tracking-wider text-secondary-400 dark:text-secondary-400 font-medium mb-1">Berat Badan</p>
                    <p class="font-semibold text-primary-800 dark:text-primary-50">{{ $registration->weight_kg ? $registration->weight_kg . ' kg' : '-' }}</p>
                </div>
                <div class="bg-white dark:bg-primary-900/30 rounded-2xl p-5 border border-primary-100 dark:border-primary-700/30 shadow-sm hover:shadow-md transition-all duration-200">
                    <p class="text-xs uppercase tracking-wider text-secondary-400 dark:text-secondary-400 font-medium mb-1">Ukuran Baju</p>
                    <p class="font-semibold text-primary-800 dark:text-primary-50">{{ $registration->shirt_size_label ?? '-' }}</p>
                </div>
            </div>

            {{-- University & Parent Section --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mt-4">
                <div class="bg-white dark:bg-primary-900/30 rounded-2xl p-5 border border-primary-100 dark:border-primary-700/30">
                    <h4 class="text-sm font-semibold text-primary-700 dark:text-primary-300 mb-3 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        Kampus Impian
                    </h4>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-secondary-600 dark:text-secondary-400">Prioritas 1</span>
                            <span class="font-medium text-primary-800 dark:text-primary-50">{{ $registration->priority_university_1 }}</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-secondary-600 dark:text-secondary-400">Prioritas 2</span>
                            <span class="font-medium text-primary-800 dark:text-primary-50">{{ $registration->priority_university_2 ?? '-' }}</span>
                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-primary-900/30 rounded-2xl p-5 border border-primary-100 dark:border-primary-700/30">
                    <h4 class="text-sm font-semibold text-primary-700 dark:text-primary-300 mb-3 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        Data Orangtua
                    </h4>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-secondary-600 dark:text-secondary-400">Nama</span>
                            <span class="font-medium text-primary-800 dark:text-primary-50">{{ $registration->parent_name }}</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-secondary-600 dark:text-secondary-400">Pekerjaan</span>
                            <span class="font-medium text-primary-800 dark:text-primary-50">{{ $registration->parent_occupation ?? '-' }}</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-secondary-600 dark:text-secondary-400">No. Telepon</span>
                            <span class="font-medium text-primary-800 dark:text-primary-50">{{ $registration->parent_phone }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        {{-- Actions Section --}}
        <div class="mt-8 grid grid-cols-1 sm:grid-cols-3 gap-4">
            <a href="{{ route('profile.edit') }}"
               class="group flex items-center justify-center gap-3 px-6 py-4 rounded-2xl text-white bg-brand-gradient hover:shadow-xl hover:shadow-primary-500/30 hover:scale-[1.02] transition-all duration-200 font-medium">
                <svg class="w-5 h-5 group-hover:rotate-12 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Profil
            </a>

            <a href="{{ route('profile.password') }}"
               class="group flex items-center justify-center gap-3 px-6 py-4 rounded-2xl text-white bg-secondary-600 hover:bg-secondary-700 hover:shadow-xl hover:shadow-secondary-500/20 hover:scale-[1.02] transition-all duration-200 font-medium">
                <svg class="w-5 h-5 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                </svg>
                Ganti Password
            </a>

            <a href="{{ route('profile.delete') }}"
               class="group flex items-center justify-center gap-3 px-6 py-4 rounded-2xl text-red-700 dark:text-red-300 bg-red-50 dark:bg-red-950/30 hover:bg-red-100 dark:hover:bg-red-950/50 hover:shadow-xl hover:shadow-red-500/20 hover:scale-[1.02] transition-all duration-200 font-medium border border-red-200 dark:border-red-700/30">
                <svg class="w-5 h-5 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                Hapus Akun
            </a>
        </div>
    </div>
</div>
@endsection
