@extends('layouts.app')

@section('content')
<div class="py-6 md:py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Navigation --}}
        <nav class="flex items-center gap-2 text-sm mb-6">
            <a href="{{ route('tentor.index') }}" class="text-secondary-500 hover:text-primary-600 dark:text-secondary-400 dark:hover:text-primary-300 transition-colors">Tentor</a>
            <span class="text-secondary-300 dark:text-secondary-600">/</span>
            <span class="text-primary-600 dark:text-primary-300 font-medium">{{ $teacher->user->name }}</span>
        </nav>

        {{-- Profile Card --}}
        <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 overflow-hidden shadow-sm">

            {{-- Cover --}}
            <div class="h-24 bg-gradient-to-r from-primary-600 to-primary-500 dark:from-primary-700 dark:to-primary-600"></div>

            {{-- Profile Header --}}
            <div class="px-6 pb-6">
                <div class="flex flex-col md:flex-row md:items-end gap-4 -mt-12">
                    <div class="relative">
                        <img src="{{ $teacher->user->avatar_url }}"
                             class="w-24 h-24 rounded-full object-cover ring-4 ring-white dark:ring-primary-900 shadow-lg">
                        <div class="absolute -bottom-0.5 -right-0.5 w-4 h-4 rounded-full {{ $teacher->user->is_active ? 'bg-emerald-500' : 'bg-red-500' }} border-2 border-white dark:border-primary-900"></div>
                    </div>

                    <div class="flex-1 min-w-0">
                        <div class="flex flex-wrap items-center gap-3">
                            <h1 class="text-2xl font-bold text-primary-800 dark:text-primary-100">{{ $teacher->user->name }}</h1>
                            @if($teacher->user->is_active)
                                <span class="inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700 dark:bg-emerald-900/20 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800/30">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-700 dark:bg-red-900/20 dark:text-red-300 border border-red-200 dark:border-red-800/30">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                    Nonaktif
                                </span>
                            @endif
                        </div>
                        @role('admin')
                        <p class="text-sm text-secondary-500 dark:text-secondary-400">{{ $teacher->user->email }}</p>
                        <p class="text-sm text-secondary-400 dark:text-secondary-500">{{ $teacher->user->phone ?? '-' }}</p>
                        @endrole
                    </div>

                    @role('admin')
                    <div class="flex flex-wrap items-center gap-2">
                        <a href="https://wa.me/{{ $teacher->user->whatsapp_phone }}" target="_blank"
                           class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium transition-all duration-200 hover:shadow-lg hover:shadow-emerald-500/25 active:scale-[0.98]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21l1.65-3.3A8.99 8.99 0 1121 12a9 9 0 01-9 9H3z"/>
                            </svg>
                            WA
                        </a>
                        <a href="{{ route('tentor.edit', $teacher->id) }}"
                           class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium transition-all duration-200 hover:shadow-lg hover:shadow-primary-500/25 active:scale-[0.98]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit
                        </a>
                    </div>
                    @endrole
                </div>
            </div>
        </div>

        {{-- Detail Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">

            {{-- Left: Informasi --}}
            <div class="md:col-span-2 space-y-6">
                {{-- Bio --}}
                <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 overflow-hidden shadow-sm">
                    <div class="px-6 py-4 border-b border-primary-100 dark:border-primary-800/30">
                        <h3 class="text-sm font-semibold text-primary-800 dark:text-primary-100 flex items-center gap-2">
                            <svg class="w-5 h-5 text-accent-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Bio
                        </h3>
                    </div>
                    <div class="p-6">
                        <p class="text-sm text-primary-800 dark:text-primary-100 leading-relaxed whitespace-pre-line">
                            {{ $teacher->bio ?: 'Belum ada bio.' }}
                        </p>
                    </div>
                </div>

                {{-- Courses --}}
                <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 overflow-hidden shadow-sm">
                    <div class="px-6 py-4 border-b border-primary-100 dark:border-primary-800/30">
                        <h3 class="text-sm font-semibold text-primary-800 dark:text-primary-100 flex items-center gap-2">
                            <svg class="w-5 h-5 text-gold-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            Course yang Diajarkan
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="flex flex-wrap gap-2">
                            @forelse($teacher->courses as $c)
                                <span class="px-3 py-1.5 rounded-xl text-sm font-medium bg-primary-100 text-primary-700 dark:bg-primary-800/30 dark:text-primary-300 border border-primary-200 dark:border-primary-700/30">
                                    {{ $c->name }}
                                </span>
                            @empty
                                <p class="text-sm text-secondary-500 dark:text-secondary-400">Tidak ada course yang diajarkan.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right: Sidebar --}}
            <div class="space-y-6">
                {{-- Location --}}
                <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 overflow-hidden shadow-sm">
                    <div class="px-6 py-4 border-b border-primary-100 dark:border-primary-800/30">
                        <h3 class="text-sm font-semibold text-primary-800 dark:text-primary-100 flex items-center gap-2">
                            <svg class="w-5 h-5 text-secondary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Lokasi
                        </h3>
                    </div>
                    <div class="p-6 space-y-3 text-sm">
                        <div>
                            <p class="text-xs text-secondary-400 dark:text-secondary-500 uppercase tracking-wider">Provinsi</p>
                            <p class="font-medium text-primary-800 dark:text-primary-100 mt-0.5">{{ $teacher->user->province->name ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-secondary-400 dark:text-secondary-500 uppercase tracking-wider">Kab / Kota</p>
                            <p class="font-medium text-primary-800 dark:text-primary-100 mt-0.5">{{ $teacher->user->regency->name ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Danger Actions --}}
                @role('admin')
                <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-red-200 dark:border-red-800/30 overflow-hidden shadow-sm">
                    <div class="p-4 space-y-2">
                        <form method="POST" action="{{ route('tentor.toggle', $teacher->id) }}"
                              class="sweet-confirm" data-message="Yakin ingin mengubah status tentor ini?">
                            @csrf
                            <button class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 hover:shadow-lg active:scale-[0.98] {{ $teacher->user->is_active ? 'bg-red-100 text-red-700 hover:bg-red-200 dark:bg-red-900/20 dark:text-red-300 dark:hover:bg-red-900/30' : 'bg-emerald-100 text-emerald-700 hover:bg-emerald-200 dark:bg-emerald-900/20 dark:text-emerald-300 dark:hover:bg-emerald-900/30' }}">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                                </svg>
                                {{ $teacher->user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                            </button>
                        </form>

                        <form method="POST" action="{{ route('tentor.remove', $teacher->id) }}"
                              class="sweet-confirm" data-message="Yakin ingin menghapus tentor ini? Data tidak akan bisa dikembalikan.">
                            @csrf
                            @method('DELETE')
                            <button class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-secondary-100 text-secondary-700 hover:bg-secondary-200 dark:bg-secondary-900/20 dark:text-secondary-300 dark:hover:bg-secondary-900/30 text-sm font-medium transition-all duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Hapus Tentor
                            </button>
                        </form>
                    </div>
                </div>
                @endrole
            </div>
        </div>
    </div>
</div>
@endsection
