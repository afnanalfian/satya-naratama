@extends('layouts.app')

@section('content')
<div class="py-6 md:py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Hero Section / Page Header --}}
        <div class="relative overflow-hidden rounded-2xl md:rounded-3xl bg-white dark:bg-primary-900/40 border border-primary-100 dark:border-primary-800/30 p-6 md:p-8 mb-6 md:mb-8">
            <div class="absolute top-0 right-0 w-64 h-64 bg-primary-500/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/4"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-accent-500/5 rounded-full blur-3xl translate-y-1/2 -translate-x-1/4"></div>

            <div class="relative flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <div class="flex items-center gap-3">
                        <div class="p-2.5 rounded-xl bg-primary-500/10 text-primary-600 dark:bg-primary-400/10 dark:text-primary-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-xl md:text-2xl font-bold text-primary-900 dark:text-white tracking-tight">
                                Kelola Siswa
                            </h1>
                            <p class="text-sm text-secondary-500 dark:text-secondary-400 mt-0.5">
                                Total <span class="font-semibold text-primary-600 dark:text-primary-300">{{ $siswa->total() }}</span> siswa terdaftar
                            </p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-2 text-sm text-secondary-500 dark:text-secondary-400">
                    <span class="inline-flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        Aktif: {{ $siswa->where('is_active', true)->count() }}
                    </span>
                    <span class="w-px h-4 bg-primary-200 dark:bg-primary-700"></span>
                    <span class="inline-flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-secondary-400"></span>
                        Nonaktif: {{ $siswa->where('is_active', false)->count() }}
                    </span>
                </div>
            </div>
        </div>

        {{-- Filter & Search Bar --}}
        <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 p-4 md:p-5 mb-6">
            <form method="GET" action="{{ route('siswa.index') }}" class="flex flex-col sm:flex-row gap-3">
                <div class="flex-1 relative">
                    <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input
                        type="text"
                        name="q"
                        value="{{ $q ?? '' }}"
                        placeholder="Cari berdasarkan nama, email, atau nomor telepon..."
                        class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-primary-50/50 dark:bg-primary-800/20 text-primary-800 dark:text-primary-100 placeholder-secondary-400 focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200"
                    >
                </div>
                <div class="flex gap-2">
                    <select
                        name="per_page"
                        onchange="this.form.submit()"
                        class="px-4 py-2.5 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-primary-50/50 dark:bg-primary-800/20 text-primary-800 dark:text-primary-100 focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200 appearance-none cursor-pointer"
                    >
                        @foreach([10,20,30,50,100] as $size)
                            <option value="{{ $size }}" {{ $perPage == $size ? 'selected' : '' }}>
                                {{ $size }} per halaman
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-primary-600 hover:bg-primary-700 text-white font-medium transition-all duration-200 hover:shadow-lg hover:shadow-primary-500/25 active:scale-[0.98]">
                        Cari
                    </button>
                </div>
            </form>
        </div>

        {{-- Table --}}
        <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 overflow-hidden shadow-sm">

            {{-- Mobile Card View --}}
            <div class="block md:hidden divide-y divide-primary-100 dark:divide-primary-800/30">
                @forelse($siswa as $u)
                    <div onclick="window.location='{{ route('siswa.show', $u->id) }}'" class="p-4 hover:bg-primary-50/50 dark:hover:bg-primary-800/20 transition-colors cursor-pointer">
                        <div class="flex items-center gap-3">
                            <div class="relative">
                                <img src="{{ $u->avatar_url }}" class="w-12 h-12 rounded-full object-cover ring-2 ring-primary-200 dark:ring-primary-700/50">
                                <div class="absolute -bottom-0.5 -right-0.5 w-3 h-3 rounded-full {{ $u->is_active ? 'bg-emerald-500' : 'bg-red-500' }} border-2 border-white dark:border-primary-900"></div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-primary-800 dark:text-primary-100 truncate">{{ $u->name }}</p>
                                <p class="text-xs text-secondary-500 dark:text-secondary-400 truncate">{{ $u->email }}</p>
                                <p class="text-xs text-secondary-400 dark:text-secondary-500 mt-0.5">{{ $u->phone ?? 'No HP tidak tersedia' }}</p>
                            </div>
                            <div>
                                @if($u->is_active)
                                    <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300">Aktif</span>
                                @else
                                    <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300">Nonaktif</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center">
                        <div class="w-16 h-16 mx-auto rounded-full bg-primary-100 dark:bg-primary-800/30 flex items-center justify-center mb-3">
                            <svg class="w-8 h-8 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                        <p class="text-base font-semibold text-primary-800 dark:text-primary-100">Belum ada siswa</p>
                        <p class="text-sm text-secondary-500 dark:text-secondary-400 mt-1">Data siswa akan muncul setelah terdaftar</p>
                    </div>
                @endforelse
            </div>

            {{-- Desktop Table View --}}
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-primary-50/80 dark:bg-primary-800/20 border-b border-primary-100 dark:border-primary-800/30">
                            <th class="px-6 py-3.5 text-left text-xs font-semibold text-secondary-600 dark:text-secondary-400 uppercase tracking-wider">Siswa</th>
                            <th class="px-6 py-3.5 text-left text-xs font-semibold text-secondary-600 dark:text-secondary-400 uppercase tracking-wider">Kontak</th>
                            <th class="px-6 py-3.5 text-left text-xs font-semibold text-secondary-600 dark:text-secondary-400 uppercase tracking-wider hidden lg:table-cell">Lokasi</th>
                            <th class="px-6 py-3.5 text-center text-xs font-semibold text-secondary-600 dark:text-secondary-400 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3.5 text-right text-xs font-semibold text-secondary-600 dark:text-secondary-400 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-primary-100 dark:divide-primary-800/30">
                        @forelse($siswa as $u)
                            <tr class="hover:bg-primary-50/50 dark:hover:bg-primary-800/20 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $u->avatar_url }}" class="w-10 h-10 rounded-full object-cover ring-2 ring-primary-200 dark:ring-primary-700/50 group-hover:ring-primary-400 transition-all">
                                        <div>
                                            <p class="font-medium text-primary-800 dark:text-primary-100">{{ $u->name }}</p>
                                            <p class="text-xs text-secondary-500 dark:text-secondary-400">{{ $u->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-secondary-600 dark:text-secondary-300">
                                    {{ $u->phone ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-secondary-600 dark:text-secondary-300 hidden lg:table-cell">
                                    {{ $u->regency->name ?? $u->province->name ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($u->is_active)
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 dark:bg-emerald-900/20 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800/30">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            Aktif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-50 text-red-700 dark:bg-red-900/20 dark:text-red-300 border border-red-200 dark:border-red-800/30">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                            Nonaktif
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('siswa.show', $u->id) }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-primary-600 hover:text-primary-700 dark:text-primary-400 dark:hover:text-primary-300 transition-colors">
                                        Detail
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="w-16 h-16 mx-auto rounded-full bg-primary-100 dark:bg-primary-800/30 flex items-center justify-center mb-3">
                                        <svg class="w-8 h-8 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                        </svg>
                                    </div>
                                    <p class="text-base font-semibold text-primary-800 dark:text-primary-100">Belum ada siswa</p>
                                    <p class="text-sm text-secondary-500 dark:text-secondary-400 mt-1">Data siswa akan muncul setelah terdaftar</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($siswa->hasPages())
                <div class="border-t border-primary-100 dark:border-primary-800/30 px-6 py-4">
                    {{ $siswa->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
