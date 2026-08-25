@extends('layouts.app')

@section('title', 'Course Online Matematika & SKD | Satya Naratama')
@section('description', 'Kumpulan berbagai subjek termasuk CPNS dan sekolah kedinasan dengan materi terstruktur, video, dan latihan soal.')

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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl md:text-2xl font-bold text-primary-900 dark:text-white tracking-tight">
                            Daftar Course
                        </h1>
                        <p class="text-sm text-secondary-500 dark:text-secondary-400 mt-0.5">
                            {{ $courses->total() }} course tersedia
                        </p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row items-center gap-3 w-full sm:w-auto">
                    <form method="GET" action="{{ route('course.index') }}" class="flex w-full sm:w-auto gap-2">
                        <div class="relative flex-1 sm:flex-none">
                            <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <input type="text" name="q" placeholder="Cari course..." value="{{ $q ?? '' }}"
                                   class="w-full sm:w-64 pl-10 pr-4 py-2.5 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-100 placeholder-secondary-400 focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200">
                        </div>
                        <button type="submit"
                                class="px-5 py-2.5 rounded-xl bg-primary-600 hover:bg-primary-700 text-white font-medium transition-all duration-200 hover:shadow-lg hover:shadow-primary-500/25 active:scale-[0.98]">
                            Cari
                        </button>
                    </form>

                    @role('admin')
                    <a href="{{ route('course.create') }}"
                       class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-secondary-600 hover:bg-secondary-700 text-white font-medium transition-all duration-200 hover:shadow-xl hover:shadow-secondary-500/30 hover:scale-[1.02] whitespace-nowrap">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Tambah Course
                    </a>
                    @endrole
                </div>
            </div>
        </div>

        {{-- Course Grid --}}
        @if($courses->count() > 0)
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($courses as $course)
            @php
                $user = auth()->user();
                $badgeText = 'Course';
                $badgeClass = 'bg-primary-500 text-white';

                if ($user && $user->hasRole('siswa')) {
                    if ($course->is_free) {
                        $badgeText = 'FREE';
                        $badgeClass = 'bg-emerald-500 text-white';
                    } else {
                        $totalMeetings = $course->meetings->count();
                        if ($user->hasCourse($course->id)) {
                            $badgeText = 'Full Access';
                            $badgeClass = 'bg-emerald-600 text-white';
                        } else {
                            $ownedMeetingIds = $user->ownedMeetingIds();
                            $ownedCount = $course->meetings->whereIn('id', $ownedMeetingIds)->count();
                            if ($ownedCount === 0) {
                                $badgeText = 'Terkunci';
                                $badgeClass = 'bg-secondary-500 text-white';
                            } elseif ($ownedCount >= $totalMeetings) {
                                $badgeText = 'Full Access';
                                $badgeClass = 'bg-emerald-600 text-white';
                            } else {
                                $badgeText = "{$ownedCount}/{$totalMeetings}";
                                $badgeClass = 'bg-blue-500 text-white';
                            }
                        }
                    }
                }
            @endphp
            <div class="group bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 overflow-hidden shadow-sm hover:shadow-xl hover:shadow-primary-500/5 hover:-translate-y-1 transition-all duration-300 flex flex-col">

                <a href="{{ route('course.show', $course->slug) }}" class="block flex-1">
                    {{-- Header with Gradient --}}
                    <div class="relative h-32 bg-gradient-to-br from-primary-500/20 to-accent-500/20 dark:from-primary-800/40 dark:to-accent-800/40 overflow-hidden">
                        {{-- Decorative Pattern --}}
                        <div class="absolute inset-0 opacity-10">
                            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                                <pattern id="grid-{{ $loop->index }}" width="20" height="20" patternUnits="userSpaceOnUse">
                                    <circle cx="10" cy="10" r="1" fill="currentColor" class="text-primary-500"/>
                                </pattern>
                                <rect width="100" height="100" fill="url(#grid-{{ $loop->index }})"/>
                            </svg>
                        </div>

                        {{-- Course Icon --}}
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="w-20 h-20 rounded-2xl bg-white/90 dark:bg-primary-900/90 shadow-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-10 h-10 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                        </div>

                        {{-- Badges --}}
                        <span class="absolute left-3 top-3 text-xs font-medium px-3 py-1 rounded-lg shadow-lg {{ $badgeClass }} backdrop-blur-sm">
                            {{ $badgeText }}
                        </span>

                        <span class="absolute right-3 bottom-3 text-xs font-medium px-3 py-1 rounded-lg bg-primary-900/80 backdrop-blur-sm text-white shadow-lg flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $course->meetings_count ?? $course->meetings->count() }}
                        </span>
                    </div>

                    {{-- Body --}}
                    <div class="p-5 flex-1">
                        <h3 class="text-lg font-bold text-primary-800 dark:text-primary-100 group-hover:text-primary-600 dark:group-hover:text-primary-300 transition-colors line-clamp-1">
                            {{ $course->name }}
                        </h3>

                        <p class="mt-2 text-sm text-secondary-600 dark:text-secondary-400 line-clamp-2 leading-relaxed">
                            {{ Str::limit($course->description ?? 'Tidak ada deskripsi', 100) }}
                        </p>

                        {{-- Teachers --}}
                        <div class="mt-3 flex items-center gap-2">
                            <svg class="w-4 h-4 text-secondary-400 dark:text-secondary-500 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <p class="text-xs text-secondary-500 dark:text-secondary-400 truncate">
                                <span class="font-medium text-secondary-700 dark:text-secondary-300">Tentor:</span>
                                {{ $course->teachers->isNotEmpty() ? $course->teachers->map(fn($t) => $t->user->name ?? '-')->join(', ') : '-' }}
                            </p>
                        </div>

                        {{-- Category --}}
                        @if($course->category)
                        <div class="mt-3 flex flex-wrap gap-1.5">
                            <span class="px-2.5 py-0.5 text-[10px] font-medium bg-primary-100/50 dark:bg-primary-800/30 text-primary-700 dark:text-primary-300 rounded-full border border-primary-200/30 dark:border-primary-700/30">
                                {{ $course->category }}
                            </span>
                        </div>
                        @endif
                    </div>
                </a>

                {{-- Footer Actions (Admin Only) --}}
                @role('admin')
                <div class="flex items-center justify-between gap-3 px-5 py-3 border-t border-primary-100 dark:border-primary-800/30 bg-primary-50/30 dark:bg-primary-900/20">
                    <a href="{{ route('course.edit', $course->slug) }}"
                       class="px-4 py-1.5 rounded-lg text-sm font-medium text-primary-700 dark:text-primary-300 hover:bg-primary-100/50 dark:hover:bg-primary-800/50 transition-all duration-200 flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                        </svg>
                        Edit
                    </a>

                    <form method="POST" action="{{ route('course.delete', $course->slug) }}"
                          class="sweet-confirm" data-message="Yakin ingin menghapus course ini? Semua meeting dan datanya akan hilang secara permanen.">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="px-4 py-1.5 rounded-lg text-sm font-medium text-red-600 dark:text-red-400 hover:bg-red-50/50 dark:hover:bg-red-900/20 transition-all duration-200 flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Hapus
                        </button>
                    </form>
                </div>
                @endrole
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($courses->hasPages())
        <div class="mt-6">
            {{ $courses->links() }}
        </div>
        @endif
        @else
        {{-- Empty State --}}
        <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 p-12 text-center shadow-sm">
            <div class="flex flex-col items-center">
                <div class="w-20 h-20 rounded-full bg-primary-100 dark:bg-primary-800/30 flex items-center justify-center mb-4">
                    <svg class="w-10 h-10 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-primary-800 dark:text-primary-100 mb-2">
                    @if(request('q'))
                        Tidak ditemukan course "{{ request('q') }}"
                    @else
                        Belum Ada Course
                    @endif
                </h3>
                <p class="text-sm text-secondary-500 dark:text-secondary-400 max-w-md">
                    @if(request('q'))
                        Coba dengan kata kunci lain
                    @else
                        @role('admin')
                        Klik tombol <strong class="text-primary-600 dark:text-primary-400">"Tambah Course"</strong> untuk menambahkan course baru.
                        @else
                        Belum ada course yang tersedia saat ini.
                        @endrole
                    @endif
                </p>
                @role('admin')
                @if(!request('q'))
                <a href="{{ route('course.create') }}"
                   class="inline-flex items-center gap-2 mt-4 px-5 py-2.5 rounded-xl bg-primary-600 hover:bg-primary-700 text-white font-medium transition-all duration-200 hover:shadow-lg hover:shadow-primary-500/25 active:scale-[0.98]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Course
                </a>
                @endif
                @endrole
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
