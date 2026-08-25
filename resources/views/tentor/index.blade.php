@extends('layouts.app')

@section('content')
<div class="py-6 md:py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Hero Section --}}
        <div class="relative overflow-hidden rounded-2xl md:rounded-3xl bg-white dark:bg-primary-900/40 border border-primary-100 dark:border-primary-800/30 p-6 md:p-8 mb-6 md:mb-8">
            <div class="absolute top-0 right-0 w-64 h-64 bg-primary-500/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/4"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-accent-500/5 rounded-full blur-3xl translate-y-1/2 -translate-x-1/4"></div>

            <div class="relative flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <div class="flex items-center gap-3">
                        <div class="p-2.5 rounded-xl bg-primary-500/10 text-primary-600 dark:bg-primary-400/10 dark:text-primary-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-xl md:text-2xl font-bold text-primary-900 dark:text-white tracking-tight">
                                Kelola Tentor
                            </h1>
                            <p class="text-sm text-secondary-500 dark:text-secondary-400 mt-0.5">
                                Total <span class="font-semibold text-primary-600 dark:text-primary-300">{{ $tentor->total() }}</span> tentor terdaftar
                            </p>
                        </div>
                    </div>
                </div>

                @role('admin')
                <a href="{{ route('tentor.create') }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-primary-600 hover:bg-primary-700 text-white font-medium transition-all duration-200 hover:shadow-lg hover:shadow-primary-500/25 active:scale-[0.98] self-start md:self-auto">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Tentor
                </a>
                @endrole
            </div>
        </div>

        {{-- Filter --}}
        <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 p-4 md:p-5 mb-6">
            <form method="GET" action="{{ route('tentor.index') }}" class="flex flex-col sm:flex-row gap-3">
                <div class="flex-1 relative">
                    <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" name="q" value="{{ $q ?? '' }}"
                           placeholder="Cari berdasarkan nama atau course yang diajar..."
                           class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-primary-50/50 dark:bg-primary-800/20 text-primary-800 dark:text-primary-100 placeholder-secondary-400 focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200">
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-primary-600 hover:bg-primary-700 text-white font-medium transition-all duration-200 hover:shadow-lg hover:shadow-primary-500/25 active:scale-[0.98]">
                        Cari
                    </button>
                </div>
            </form>
        </div>

        {{-- Grid --}}
        @if($tentor->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">
            @foreach ($tentor as $t)
                <a href="{{ route('tentor.show', $t->id) }}"
                   class="group bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 overflow-hidden hover:shadow-xl hover:shadow-primary-500/5 hover:-translate-y-1 transition-all duration-300">

                    {{-- Card Content --}}
                    <div class="p-5">
                        <div class="flex items-start gap-4">
                            <div class="relative">
                                <img src="{{ $t->user->avatar_url }}"
                                     class="w-14 h-14 rounded-full object-cover ring-2 ring-primary-200 dark:ring-primary-700/50 group-hover:ring-primary-400 transition-all">
                                <div class="absolute -bottom-0.5 -right-0.5 w-3.5 h-3.5 rounded-full {{ $t->user->is_active ? 'bg-emerald-500' : 'bg-red-500' }} border-2 border-white dark:border-primary-900"></div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="font-semibold text-primary-800 dark:text-primary-100 truncate group-hover:text-primary-600 dark:group-hover:text-primary-300 transition-colors">
                                    {{ $t->user->name }}
                                </h3>
                                <span class="inline-block text-xs px-2 py-0.5 rounded-full mt-1 font-medium
                                    {{ $t->user->is_active
                                        ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/20 dark:text-emerald-300'
                                        : 'bg-red-100 text-red-700 dark:bg-red-900/20 dark:text-red-300' }}">
                                    {{ $t->user->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </div>
                        </div>

                        {{-- Bio --}}
                        <p class="mt-3 text-sm text-secondary-600 dark:text-secondary-300 leading-relaxed line-clamp-2 min-h-[2.75rem]">
                            {{ $t->bio ?: 'Belum ada bio.' }}
                        </p>

                        {{-- Courses --}}
                        <div class="mt-3 pt-3 border-t border-primary-100 dark:border-primary-800/30">
                            <p class="text-xs text-secondary-500 dark:text-secondary-400">Mengajar</p>
                            <div class="flex flex-wrap gap-1.5 mt-1.5">
                                @forelse($t->courses as $course)
                                    <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-primary-100 text-primary-700 dark:bg-primary-800/30 dark:text-primary-300 border border-primary-200 dark:border-primary-700/30">
                                        {{ $course->name }}
                                    </span>
                                @empty
                                    <span class="text-xs text-secondary-400 dark:text-secondary-500">-</span>
                                @endforelse
                            </div>
                        </div>

                        <div class="mt-3 flex justify-end">
                            <span class="text-xs text-secondary-400 dark:text-secondary-500 group-hover:text-primary-500 dark:group-hover:text-primary-400 transition-colors flex items-center gap-1">
                                Detail
                                <svg class="w-3.5 h-3.5 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        @else
        <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 p-12 text-center">
            <div class="w-16 h-16 mx-auto rounded-full bg-primary-100 dark:bg-primary-800/30 flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
            <p class="text-base font-semibold text-primary-800 dark:text-primary-100">Belum ada tentor</p>
            <p class="text-sm text-secondary-500 dark:text-secondary-400 mt-1">Tambahkan tentor pertama Anda</p>
            @role('admin')
            <a href="{{ route('tentor.create') }}" class="inline-flex items-center gap-2 mt-4 px-5 py-2.5 rounded-xl bg-primary-600 hover:bg-primary-700 text-white font-medium transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Tentor
            </a>
            @endrole
        </div>
        @endif

        {{-- Pagination --}}
        @if($tentor->hasPages())
        <div class="mt-6">
            {{ $tentor->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
