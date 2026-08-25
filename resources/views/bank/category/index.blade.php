@extends('layouts.app')

@section('content')
<div class="py-6 md:py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="relative overflow-hidden rounded-2xl md:rounded-3xl bg-white dark:bg-primary-900/40 border border-primary-100 dark:border-primary-800/30 p-6 md:p-8 mb-6 md:mb-8">
            <div class="absolute top-0 right-0 w-64 h-64 bg-primary-500/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/4"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-accent-500/5 rounded-full blur-3xl translate-y-1/2 -translate-x-1/4"></div>

            <div class="relative flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="p-3 rounded-xl bg-primary-500/10 text-primary-600 dark:bg-primary-400/10 dark:text-primary-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl md:text-2xl font-bold text-primary-900 dark:text-white tracking-tight">
                            Kategori Bank Soal
                        </h1>
                        <p class="text-sm text-secondary-500 dark:text-secondary-400 mt-0.5">
                            Kelola kategori mata pelajaran untuk bank soal
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-2 text-sm">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-primary-100 text-primary-700 dark:bg-primary-800/30 dark:text-primary-300 border border-primary-200 dark:border-primary-700/30">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                        </svg>
                        Total: {{ $categories->total() }}
                    </span>
                </div>
            </div>
        </div>

        {{-- Filter & Search --}}
        <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 p-4 md:p-5 mb-6 shadow-sm">
            <div class="flex flex-col sm:flex-row gap-3">
                <form method="GET" action="{{ route('bank.category.index') }}" class="flex-1 flex gap-2">
                    <div class="flex-1 relative">
                        <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" name="q" placeholder="Cari kategori..."
                               value="{{ request('q') }}"
                               class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-primary-50/50 dark:bg-primary-800/20 text-primary-800 dark:text-primary-100 placeholder-secondary-400 focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200">
                    </div>
                    <button type="submit"
                            class="px-5 py-2.5 rounded-xl bg-primary-600 hover:bg-primary-700 text-white font-medium transition-all duration-200 hover:shadow-lg hover:shadow-primary-500/25 active:scale-[0.98]">
                        Cari
                    </button>
                </form>

                @role('admin')
                <a href="{{ route('bank.category.create') }}"
                   class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-secondary-600 hover:bg-secondary-700 text-white font-medium transition-all duration-200 hover:shadow-xl hover:shadow-secondary-500/30 hover:scale-[1.02]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Kategori
                </a>
                @endrole
            </div>
        </div>

        {{-- Grid --}}
        @if($categories->count() > 0)
        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($categories as $cat)
                <div class="group bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 overflow-hidden shadow-sm hover:shadow-xl hover:shadow-primary-500/5 hover:-translate-y-1 transition-all duration-300">

                    {{-- Card Content --}}
                    <div class="p-5">
                        {{-- Icon & Badge --}}
                        <div class="flex items-start justify-between mb-3">
                            <div class="p-2.5 rounded-xl bg-primary-100 dark:bg-primary-800/40 text-primary-600 dark:text-primary-300 group-hover:bg-primary-200 dark:group-hover:bg-primary-700/40 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-100 text-primary-700 dark:bg-primary-800/30 dark:text-primary-300 border border-primary-200 dark:border-primary-700/30">
                                {{ $cat->materials->count() }} materi
                            </span>
                        </div>

                        {{-- Title --}}
                        <a href="{{ route('bank.category.materials.index', $cat) }}" class="block">
                            <h3 class="text-lg font-bold text-primary-800 dark:text-primary-100 group-hover:text-primary-600 dark:group-hover:text-primary-300 transition-colors">
                                {{ $cat->name }}
                            </h3>
                        </a>

                        {{-- Description --}}
                        <p class="mt-2 text-sm text-secondary-600 dark:text-secondary-300 leading-relaxed line-clamp-3 min-h-[3.5rem]">
                            {{ $cat->description ?? 'Tidak ada deskripsi.' }}
                        </p>

                        {{-- Footer --}}
                        <div class="mt-4 pt-4 border-t border-primary-100 dark:border-primary-800/30 flex items-center justify-between">
                            <a href="{{ route('bank.category.materials.index', $cat) }}"
                               class="inline-flex items-center gap-1.5 text-sm font-medium text-primary-600 hover:text-primary-700 dark:text-primary-400 dark:hover:text-primary-300 transition-colors">
                                Lihat Materi
                                <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>

                            @role('admin')
                            <div class="flex items-center gap-1.5">
                                <a href="{{ route('bank.category.edit', $cat) }}"
                                   class="p-2 rounded-lg text-secondary-400 hover:text-primary-600 hover:bg-primary-50 dark:hover:bg-primary-800/30 transition-all duration-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form method="POST" action="{{ route('bank.category.delete', $cat) }}"
                                      class="sweet-confirm" data-message="Yakin ingin menghapus kategori ini? Semua materi dan soal di dalamnya akan ikut terhapus secara permanen.">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="p-2 rounded-lg text-secondary-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 transition-all duration-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                            @endrole
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($categories->hasPages())
        <div class="mt-6">
            {{ $categories->links() }}
        </div>
        @endif
        @else
        {{-- Empty State --}}
        <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 p-12 text-center shadow-sm">
            <div class="flex flex-col items-center">
                <div class="w-20 h-20 rounded-full bg-primary-100 dark:bg-primary-800/30 flex items-center justify-center mb-4">
                    <svg class="w-10 h-10 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-primary-800 dark:text-primary-100 mb-2">
                    @if(request('q'))
                        Tidak ditemukan kategori "{{ request('q') }}"
                    @else
                        Belum Ada Kategori
                    @endif
                </h3>
                <p class="text-sm text-secondary-500 dark:text-secondary-400 max-w-md">
                    @if(request('q'))
                        Coba dengan kata kunci lain
                    @else
                        Tambahkan kategori bank soal untuk memulai mengelola materi dan soal.
                    @endif
                </p>
                @role('admin')
                @if(!request('q'))
                <a href="{{ route('bank.category.create') }}"
                   class="inline-flex items-center gap-2 mt-4 px-5 py-2.5 rounded-xl bg-primary-600 hover:bg-primary-700 text-white font-medium transition-all duration-200 hover:shadow-lg hover:shadow-primary-500/25 active:scale-[0.98]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Kategori
                </a>
                @endif
                @endrole
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
