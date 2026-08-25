@extends('layouts.app')

@section('content')
<div class="py-6 md:py-8">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Navigation --}}
        <nav class="flex items-center gap-2 text-sm mb-6">
            <a href="{{ route('siswa.index') }}" class="text-secondary-500 hover:text-primary-600 dark:text-secondary-400 dark:hover:text-primary-300 transition-colors">Siswa</a>
            <span class="text-secondary-300 dark:text-secondary-600">/</span>
            <span class="text-primary-600 dark:text-primary-300 font-medium">{{ $user->name }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Left Column: Profile Card --}}
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 overflow-hidden shadow-sm sticky top-6">

                    {{-- Cover --}}
                    <div class="h-20 bg-gradient-to-r from-primary-600 to-primary-500 dark:from-primary-700 dark:to-primary-600"></div>

                    {{-- Avatar --}}
                    <div class="px-6 pb-6">
                        <div class="flex flex-col items-center -mt-10">
                            <div class="relative">
                                <img src="{{ $user->avatar_url }}"
                                     class="w-24 h-24 rounded-full object-cover ring-4 ring-white dark:ring-primary-900 shadow-lg">
                                <div class="absolute -bottom-0.5 -right-0.5 w-4 h-4 rounded-full {{ $user->is_active ? 'bg-emerald-500' : 'bg-red-500' }} border-2 border-white dark:border-primary-900"></div>
                            </div>

                            <h2 class="mt-3 text-xl font-bold text-primary-800 dark:text-primary-100 text-center">{{ $user->name }}</h2>

                            <div class="flex items-center gap-2 mt-1">
                                <span class="text-sm text-secondary-500 dark:text-secondary-400">{{ $user->email }}</span>
                            </div>

                            @if($user->phone)
                                <p class="text-sm text-secondary-400 dark:text-secondary-500 mt-0.5">{{ $user->phone }}</p>
                            @endif

                            <div class="mt-3">
                                @if($user->is_active)
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 dark:bg-emerald-900/20 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800/30">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700 dark:bg-red-900/20 dark:text-red-300 border border-red-200 dark:border-red-800/30">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                        Nonaktif
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- Divider --}}
                        <div class="border-t border-primary-100 dark:border-primary-800/30 my-4"></div>

                        {{-- Quick Info --}}
                        <div class="space-y-2.5 text-sm">
                            <div class="flex justify-between">
                                <span class="text-secondary-500 dark:text-secondary-400">Provinsi</span>
                                <span class="font-medium text-primary-800 dark:text-primary-100">{{ $user->province->name ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-secondary-500 dark:text-secondary-400">Kab/Kota</span>
                                <span class="font-medium text-primary-800 dark:text-primary-100">{{ $user->regency->name ?? '-' }}</span>
                            </div>
                            @if($user->studentRegistration)
                                <div class="flex justify-between">
                                    <span class="text-secondary-500 dark:text-secondary-400">Kelas</span>
                                    <span class="font-medium text-primary-800 dark:text-primary-100">{{ $user->studentRegistration->class }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-secondary-500 dark:text-secondary-400">Asal Sekolah</span>
                                    <span class="font-medium text-primary-800 dark:text-primary-100 truncate max-w-[140px]">{{ $user->studentRegistration->school_origin }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Column: Main Content --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Actions Bar --}}
                @role('admin')
                <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 p-4 shadow-sm">
                    <div class="flex flex-wrap items-center gap-3">
                        <a href="{{ route('admin.students.edit', $user->id) }}"
                           class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium transition-all duration-200 hover:shadow-lg hover:shadow-primary-500/25 active:scale-[0.98]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit Data
                        </a>

                        <a href="https://wa.me/{{ $user->whatsapp_phone }}" target="_blank"
                           class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium transition-all duration-200 hover:shadow-lg hover:shadow-emerald-500/25 active:scale-[0.98]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21l1.65-3.3A8.99 8.99 0 1121 12a9 9 0 01-9 9H3z"/>
                            </svg>
                            WhatsApp
                        </a>

                        <div class="flex-1"></div>

                        <form method="POST" action="{{ route('siswa.toggle', $user->id) }}" class="sweet-confirm" data-message="{{ $user->is_active ? 'Yakin ingin menonaktifkan akun siswa ini?' : 'Yakin ingin mengaktifkan kembali akun siswa ini?' }}">
                            @csrf
                            <button class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 hover:shadow-lg active:scale-[0.98] {{ $user->is_active ? 'bg-red-100 text-red-700 hover:bg-red-200 dark:bg-red-900/20 dark:text-red-300 dark:hover:bg-red-900/30' : 'bg-emerald-100 text-emerald-700 hover:bg-emerald-200 dark:bg-emerald-900/20 dark:text-emerald-300 dark:hover:bg-emerald-900/30' }}">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                                </svg>
                                {{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                            </button>
                        </form>

                        <form method="POST" action="{{ route('siswa.destroy', $user->id) }}" class="sweet-confirm" data-message="Yakin ingin menghapus siswa ini? Data tidak dapat dikembalikan.">
                            @csrf
                            @method('DELETE')
                            <button class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-secondary-100 text-secondary-700 hover:bg-secondary-200 dark:bg-secondary-900/20 dark:text-secondary-300 dark:hover:bg-secondary-900/30 text-sm font-medium transition-all duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
                @endrole

                {{-- Data Pendaftaran --}}
                @if($user->studentRegistration)
                <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 overflow-hidden shadow-sm">
                    <div class="px-6 py-4 border-b border-primary-100 dark:border-primary-800/30">
                        <h3 class="text-base font-semibold text-primary-800 dark:text-primary-100 flex items-center gap-2">
                            <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Data Pendaftaran
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                            <div>
                                <p class="text-xs text-secondary-400 dark:text-secondary-500 uppercase tracking-wider">Nama Lengkap</p>
                                <p class="font-medium text-primary-800 dark:text-primary-100 mt-0.5">{{ $user->studentRegistration->full_name }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-secondary-400 dark:text-secondary-500 uppercase tracking-wider">Nama Panggilan</p>
                                <p class="font-medium text-primary-800 dark:text-primary-100 mt-0.5">{{ $user->studentRegistration->nickname ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-secondary-400 dark:text-secondary-500 uppercase tracking-wider">Tanggal Lahir</p>
                                <p class="font-medium text-primary-800 dark:text-primary-100 mt-0.5">{{ $user->studentRegistration->birth_date->format('d M Y') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-secondary-400 dark:text-secondary-500 uppercase tracking-wider">Jenis Kelamin</p>
                                <p class="font-medium text-primary-800 dark:text-primary-100 mt-0.5">{{ $user->studentRegistration->gender_label }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-secondary-400 dark:text-secondary-500 uppercase tracking-wider">Kecamatan</p>
                                <p class="font-medium text-primary-800 dark:text-primary-100 mt-0.5">{{ $user->studentRegistration->kecamatan->name ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-secondary-400 dark:text-secondary-500 uppercase tracking-wider">Kelurahan/Desa</p>
                                <p class="font-medium text-primary-800 dark:text-primary-100 mt-0.5">{{ $user->studentRegistration->kelurahan->name ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-secondary-400 dark:text-secondary-500 uppercase tracking-wider">Tinggi Badan</p>
                                <p class="font-medium text-primary-800 dark:text-primary-100 mt-0.5">{{ $user->studentRegistration->height_cm ? $user->studentRegistration->height_cm . ' cm' : '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-secondary-400 dark:text-secondary-500 uppercase tracking-wider">Berat Badan</p>
                                <p class="font-medium text-primary-800 dark:text-primary-100 mt-0.5">{{ $user->studentRegistration->weight_kg ? $user->studentRegistration->weight_kg . ' kg' : '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-secondary-400 dark:text-secondary-500 uppercase tracking-wider">Ukuran Baju</p>
                                <p class="font-medium text-primary-800 dark:text-primary-100 mt-0.5">{{ $user->studentRegistration->shirt_size_label ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Kampus & Orangtua --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 overflow-hidden shadow-sm">
                        <div class="px-6 py-4 border-b border-primary-100 dark:border-primary-800/30">
                            <h3 class="text-sm font-semibold text-primary-800 dark:text-primary-100 flex items-center gap-2">
                                <svg class="w-5 h-5 text-gold-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                Kampus Impian
                            </h3>
                        </div>
                        <div class="p-6 space-y-3 text-sm">
                            <div>
                                <p class="text-xs text-secondary-400 dark:text-secondary-500 uppercase tracking-wider">Prioritas 1</p>
                                <p class="font-medium text-primary-800 dark:text-primary-100 mt-0.5">{{ $user->studentRegistration->priority_university_1 }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-secondary-400 dark:text-secondary-500 uppercase tracking-wider">Prioritas 2</p>
                                <p class="font-medium text-primary-800 dark:text-primary-100 mt-0.5">{{ $user->studentRegistration->priority_university_2 ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 overflow-hidden shadow-sm">
                        <div class="px-6 py-4 border-b border-primary-100 dark:border-primary-800/30">
                            <h3 class="text-sm font-semibold text-primary-800 dark:text-primary-100 flex items-center gap-2">
                                <svg class="w-5 h-5 text-secondary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                Data Orangtua
                            </h3>
                        </div>
                        <div class="p-6 space-y-3 text-sm">
                            <div>
                                <p class="text-xs text-secondary-400 dark:text-secondary-500 uppercase tracking-wider">Nama</p>
                                <p class="font-medium text-primary-800 dark:text-primary-100 mt-0.5">{{ $user->studentRegistration->parent_name }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-secondary-400 dark:text-secondary-500 uppercase tracking-wider">Pekerjaan</p>
                                <p class="font-medium text-primary-800 dark:text-primary-100 mt-0.5">{{ $user->studentRegistration->parent_occupation ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-secondary-400 dark:text-secondary-500 uppercase tracking-wider">No. Telepon</p>
                                <p class="font-medium text-primary-800 dark:text-primary-100 mt-0.5">{{ $user->studentRegistration->parent_phone }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
