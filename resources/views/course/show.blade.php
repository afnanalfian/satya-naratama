@extends('layouts.app')

@section('title', $course->name.' | Course Satya Naratama')
@section('description', Str::limit($course->description, 155))

@section('content')
<div class="py-6 md:py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Navigation --}}
        <nav class="flex items-center gap-2 text-sm mb-6">
            <a href="{{ route('course.index') }}"
               class="text-secondary-500 hover:text-primary-600 dark:text-secondary-400 dark:hover:text-primary-300 transition-colors group">
                <span class="inline-flex items-center gap-1.5">
                    <svg class="w-4 h-4 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Daftar Course
                </span>
            </a>
            <span class="text-secondary-300 dark:text-secondary-600">/</span>
            <span class="text-primary-600 dark:text-primary-300 font-medium">{{ $course->name }}</span>
        </nav>

        {{-- Course Header --}}
        <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 overflow-hidden shadow-sm">
            <div class="px-6 py-6 md:p-8 bg-gradient-to-r from-primary-500/10 to-accent-500/10 dark:from-primary-800/30 dark:to-accent-800/30 border-b border-primary-100 dark:border-primary-800/30">
                <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-6">

                    {{-- Left --}}
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="p-2.5 rounded-xl bg-primary-100/50 dark:bg-primary-800/50">
                                <svg class="w-6 h-6 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <h1 class="text-2xl md:text-3xl font-bold text-primary-800 dark:text-primary-100 truncate">
                                {{ $course->name }}
                            </h1>
                            @if($course->is_free)
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800/30 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                                GRATIS
                            </span>
                            @endif
                        </div>

                        <p class="text-sm text-secondary-600 dark:text-secondary-400 leading-relaxed">
                            {{ $course->description }}
                        </p>

                        <div class="flex flex-wrap items-center gap-4 mt-4">
                            {{-- Teachers --}}
                            <div class="flex items-center gap-2 text-sm text-secondary-600 dark:text-secondary-400">
                                <svg class="w-4 h-4 text-secondary-400 dark:text-secondary-500" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span class="font-medium text-primary-700 dark:text-primary-300">Tentor:</span>
                                @forelse($course->teachers as $teacher)
                                    <span class="px-2.5 py-0.5 bg-primary-100/50 dark:bg-primary-800/30 rounded-lg text-xs">
                                        {{ $teacher->user->name }}
                                    </span>
                                @empty
                                    <span class="text-secondary-400 dark:text-secondary-500">-</span>
                                @endforelse
                            </div>

                            {{-- Meetings Count --}}
                            <div class="flex items-center gap-2 text-sm text-secondary-600 dark:text-secondary-400">
                                <svg class="w-4 h-4 text-secondary-400 dark:text-secondary-500" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span class="font-medium text-primary-700 dark:text-primary-300">{{ $course->meetings->count() }}</span>
                                <span>Pertemuan</span>
                            </div>

                            {{-- Category --}}
                            @if($course->category)
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-100/50 dark:bg-primary-800/30 text-primary-700 dark:text-primary-300 border border-primary-200/30 dark:border-primary-700/30">
                                {{ $course->category }}
                            </span>
                            @endif
                        </div>
                    </div>

                    {{-- Right: Actions --}}
                    <div class="flex flex-col sm:flex-row items-center gap-3 w-full lg:w-auto flex-shrink-0">
                        <div class="relative w-full sm:w-64">
                            <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <input id="meeting-search" type="text" placeholder="Cari pertemuan..."
                                   class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-100 placeholder-secondary-400 focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200 text-sm">
                        </div>

                        @hasanyrole('admin|tentor')
                        <a href="{{ route('meeting.create', $course) }}"
                           class="w-full sm:w-auto px-5 py-2.5 rounded-xl bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium transition-all duration-200 hover:shadow-lg hover:shadow-primary-500/25 active:scale-[0.98] flex items-center justify-center gap-2 whitespace-nowrap">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                            </svg>
                            Tambah Pertemuan
                        </a>
                        @endhasanyrole
                    </div>
                </div>
            </div>
        </div>

        {{-- Meeting List --}}
        <div class="mt-6 bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 overflow-hidden shadow-sm">
            {{-- Header --}}
            <div class="px-6 py-4 border-b border-primary-100 dark:border-primary-800/30 bg-primary-50/30 dark:bg-primary-900/20 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="inline-block w-2 h-2 rounded-full bg-accent-500"></span>
                    <h2 class="text-lg font-semibold text-primary-800 dark:text-primary-100">Daftar Pertemuan</h2>
                    <span class="px-2.5 py-0.5 bg-primary-100/50 dark:bg-primary-800/30 text-primary-700 dark:text-primary-300 text-xs font-medium rounded-full">
                        {{ $course->meetings->count() }}
                    </span>
                </div>
                <div class="text-xs text-secondary-500 dark:text-secondary-400">
                    {{ $course->meetings->where('status', 'live')->count() }} Live
                </div>
            </div>

            {{-- Meetings --}}
            <div id="meeting-list" class="divide-y divide-primary-100 dark:divide-primary-800/30">
                @php
                    $lockIcon = '<svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 11h14a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2z"/></svg>';
                @endphp

                @forelse ($course->meetings as $index => $meeting)
                    @php
                        $canAccess = auth()->check() && auth()->user()->can('view', $meeting);
                        $statusColor = match($meeting->status) {
                            'upcoming' => 'bg-blue-100 text-blue-700 dark:bg-blue-500/20 dark:text-blue-300',
                            'live' => 'bg-accent-100 text-accent-700 dark:bg-accent-500/20 dark:text-accent-300',
                            'done' => 'bg-secondary-200 text-secondary-700 dark:bg-secondary-500/20 dark:text-secondary-300',
                            default => 'bg-secondary-100 text-secondary-600 dark:bg-secondary-500/10 dark:text-secondary-400',
                        };
                        $statusDot = match($meeting->status) {
                            'upcoming' => 'bg-blue-500',
                            'live' => 'bg-accent-500 animate-pulse',
                            'done' => 'bg-secondary-400',
                            default => 'bg-secondary-300',
                        };
                    @endphp

                    <div onclick="{{ $canAccess ? "window.location='" . route('meeting.show', $meeting) . "'" : 'showLockedMeetingToast()' }}"
                         class="meeting-card group px-6 py-4 transition-all duration-200 hover:bg-primary-50/30 dark:hover:bg-primary-800/20 {{ !$canAccess ? 'opacity-75' : 'cursor-pointer' }} {{ $canAccess ? 'hover:pl-8' : '' }}">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                            {{-- Left --}}
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-3">
                                    <span class="text-xs font-medium text-secondary-400 dark:text-secondary-500 bg-primary-50/50 dark:bg-primary-800/30 px-2.5 py-0.5 rounded-lg flex-shrink-0">
                                        #{{ $index + 1 }}
                                    </span>
                                    <h3 class="meeting-title text-base font-semibold text-primary-800 dark:text-primary-100 truncate group-hover:text-primary-600 dark:group-hover:text-primary-300 transition-colors">
                                        {{ $meeting->title }}
                                    </h3>
                                </div>
                                @if($meeting->scheduled_at)
                                <div class="flex items-center gap-3 mt-1 text-xs text-secondary-500 dark:text-secondary-400">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ $meeting->scheduled_at->timezone('Asia/Jakarta')->translatedFormat('l, d F Y') }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $meeting->scheduled_at->timezone('Asia/Jakarta')->format('H:i') }} WIB
                                    </span>
                                </div>
                                @endif
                            </div>

                            {{-- Right --}}
                            <div class="flex items-center gap-3 flex-shrink-0">
                                @if($canAccess)
                                    <span class="px-3 py-1 rounded-full text-xs font-medium {{ $statusColor }} flex items-center gap-1.5">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $statusDot }}"></span>
                                        {{ ucfirst($meeting->status) }}
                                    </span>
                                    <svg class="w-4 h-4 text-secondary-400 group-hover:text-primary-500 dark:group-hover:text-primary-400 transition-colors" fill="none" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                    </svg>
                                @else
                                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-secondary-200 text-secondary-600 dark:bg-secondary-500/20 dark:text-secondary-300 flex items-center gap-1.5">
                                        {!! $lockIcon !!}
                                        Terkunci
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-16">
                        <svg class="w-16 h-16 mx-auto text-secondary-300 dark:text-secondary-600 mb-4" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="text-secondary-500 dark:text-secondary-400 font-medium">Belum ada pertemuan</p>
                        <p class="text-sm text-secondary-400 dark:text-secondary-500 mt-1">
                            @hasanyrole('admin|tentor')
                            Klik tombol <strong class="text-primary-600 dark:text-primary-400">"Tambah Pertemuan"</strong> untuk membuat pertemuan baru.
                            @else
                            Course ini belum memiliki pertemuan. Silahkan cek kembali nanti.
                            @endhasanyrole
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const searchInput = document.getElementById('meeting-search');
    const cards = document.querySelectorAll('.meeting-card');

    searchInput?.addEventListener('input', function() {
        const keyword = this.value.toLowerCase().trim();
        cards.forEach(card => {
            const title = card.querySelector('.meeting-title')?.innerText.toLowerCase() || '';
            card.classList.toggle('hidden', keyword !== '' && !title.includes(keyword));
        });
    });

    function showLockedMeetingToast() {
        const message = 'Anda belum punya hak akses untuk meeting ini. Silakan lakukan pembelian terlebih dahulu.';
        if (window.toast) {
            toast('error', message);
        } else {
            alert(message);
        }
    }
</script>
@endpush

@push('styles')
<style>
    .meeting-card.hidden { display: none; }
    .animate-pulse { animation: pulse 2s infinite; }
    @keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.5; } }
</style>
@endpush
