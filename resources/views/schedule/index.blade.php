@extends('layouts.app')

@section('content')
@php
    use Carbon\Carbon;

    $current = Carbon::create($year, $month, 1);
    $start   = $current->copy()->startOfWeek(Carbon::MONDAY);
    $end     = $current->copy()->endOfMonth()->endOfWeek(Carbon::SUNDAY);

    $prev = $current->copy()->subMonth();
    $next = $current->copy()->addMonth();

    $courseColors = [];
    $palette = [
        'bg-blue-500',
        'bg-green-500',
        'bg-purple-500',
        'bg-pink-500',
        'bg-indigo-500',
        'bg-teal-500',
        'bg-orange-500',
        'bg-red-500',
        'bg-amber-500',
        'bg-cyan-500',
    ];
@endphp

<div class="py-6 md:py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="relative overflow-hidden rounded-2xl md:rounded-3xl bg-white dark:bg-primary-900/40 border border-primary-100 dark:border-primary-800/30 p-6 md:p-8 mb-6 md:mb-8">
            <div class="absolute top-0 right-0 w-64 h-64 bg-primary-500/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/4"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-accent-500/5 rounded-full blur-3xl translate-y-1/2 -translate-x-1/4"></div>

            <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="p-3 rounded-xl bg-primary-500/10 text-primary-600 dark:bg-primary-400/10 dark:text-primary-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl md:text-2xl font-bold text-primary-900 dark:text-white tracking-tight">Jadwal Akademik</h1>
                        <div class="flex items-center gap-3 mt-0.5">
                            <span class="text-base md:text-lg font-semibold text-primary-600 dark:text-primary-300">
                                {{ $current->translatedFormat('F Y') }}
                            </span>
                            @if($current->isCurrentMonth())
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700 dark:bg-emerald-900/20 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800/30">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                Bulan Ini
                            </span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Navigation --}}
                <div class="flex flex-wrap items-center gap-2">
                    <a href="{{ route('schedule.index', ['month' => $prev->month, 'year' => $prev->year]) }}"
                       class="inline-flex items-center gap-1.5 px-3.5 py-2.5 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/20 text-sm font-medium text-secondary-600 dark:text-secondary-300 hover:bg-primary-50 dark:hover:bg-primary-800/30 hover:border-primary-300 dark:hover:border-primary-600 transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        <span class="hidden sm:inline">{{ $prev->translatedFormat('M') }}</span>
                        <span class="sm:hidden">‹</span>
                    </a>

                    <a href="{{ route('schedule.index', ['month' => now()->month, 'year' => now()->year]) }}"
                       class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium transition-all duration-200 hover:shadow-lg hover:shadow-primary-500/25 active:scale-[0.98]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Hari Ini
                    </a>

                    <a href="{{ route('schedule.index', ['month' => $next->month, 'year' => $next->year]) }}"
                       class="inline-flex items-center gap-1.5 px-3.5 py-2.5 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/20 text-sm font-medium text-secondary-600 dark:text-secondary-300 hover:bg-primary-50 dark:hover:bg-primary-800/30 hover:border-primary-300 dark:hover:border-primary-600 transition-all duration-200">
                        <span class="hidden sm:inline">{{ $next->translatedFormat('M') }}</span>
                        <span class="sm:hidden">›</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        {{-- Calendar --}}
        <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 overflow-hidden shadow-sm">

            {{-- Day Headers --}}
            <div class="grid grid-cols-7 border-b border-primary-100 dark:border-primary-800/30">
                @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $day)
                    <div class="px-2 py-3 text-center">
                        <div class="text-xs sm:text-sm font-semibold text-primary-700 dark:text-primary-200">{{ $day }}</div>
                        <div class="mt-0.5 text-[10px] sm:text-xs text-secondary-400 dark:text-secondary-500">{{ substr($day, 0, 3) }}</div>
                    </div>
                @endforeach
            </div>

            {{-- Calendar Grid --}}
            <div class="grid grid-cols-7 divide-x divide-y divide-primary-100 dark:divide-primary-800/30">
                @for ($date = $start->copy(); $date <= $end; $date->addDay())
                    @php
                        $dateKey = $date->format('Y-m-d');
                        $isCurrentMonth = $date->month === $current->month;
                        $isToday = $date->isToday();
                        $isWeekend = $date->isWeekend();
                        $events = $items[$dateKey] ?? [];
                        $eventCount = count($events);
                    @endphp

                    <div class="min-h-[120px] sm:min-h-[140px] p-1.5 sm:p-2.5 md:p-3 {{ !$isCurrentMonth ? 'bg-primary-50/30 dark:bg-primary-900/20' : '' }} {{ $isWeekend ? 'bg-primary-50/50 dark:bg-primary-900/10' : '' }}">

                        {{-- Date --}}
                        <div class="mb-1.5 sm:mb-2 flex items-center justify-between">
                            <div class="flex items-center gap-1 sm:gap-2">
                                <span class="text-xs sm:text-sm font-medium {{ $isToday ? 'flex h-6 w-6 sm:h-7 sm:w-7 items-center justify-center rounded-full bg-primary-600 text-white' : 'text-primary-800 dark:text-primary-100' }}">
                                    {{ $date->day }}
                                </span>
                                @if($isToday)
                                    <span class="hidden sm:inline text-[10px] font-medium text-primary-600 dark:text-primary-300">Hari Ini</span>
                                @endif
                            </div>

                            @if($eventCount > 0)
                                <span class="rounded-full bg-primary-100 dark:bg-primary-800/40 px-1.5 sm:px-2 py-0.5 text-[9px] sm:text-xs font-medium text-primary-600 dark:text-primary-300">
                                    {{ $eventCount }}
                                </span>
                            @endif
                        </div>

                        {{-- Events --}}
                        <div class="space-y-1 sm:space-y-1.5">
                            @foreach ($events as $item)
                                @php
                                    if ($item['type'] === 'meeting') {
                                        $courseId = $item['course_id'];
                                        if (! isset($courseColors[$courseId])) {
                                            $courseColors[$courseId] = $palette[count($courseColors) % count($palette)];
                                        }
                                        $bgClass = $courseColors[$courseId];
                                        $icon = '<svg class="h-2.5 w-2.5 sm:h-3 sm:w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>';
                                    } else {
                                        $bgClass = 'bg-gradient-to-r from-accent-500 to-accent-600';
                                        $icon = '<svg class="h-2.5 w-2.5 sm:h-3 sm:w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>';
                                    }
                                @endphp

                                <a href="{{ $item['url'] }}"
                                   class="group flex items-center gap-1.5 rounded-lg p-1.5 sm:p-2 text-[10px] sm:text-xs transition-all hover:opacity-90 hover:scale-[1.02] {{ $bgClass }}">
                                    <div class="flex h-4 w-4 sm:h-5 sm:w-5 shrink-0 items-center justify-center rounded bg-white/20">
                                        {!! $icon !!}
                                    </div>
                                    <div class="flex-1 min-w-0 overflow-hidden">
                                        <div class="truncate font-semibold text-white">{{ $item['title'] }}</div>
                                        <div class="flex items-center gap-1 text-white/90">
                                            <svg class="h-2 w-2 sm:h-2.5 sm:w-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            <span class="text-[9px] sm:text-[10px]">{{ $item['time']->format('H:i') }}</span>
                                            <span class="hidden sm:inline text-[8px] sm:text-[9px] uppercase tracking-wider opacity-80 ml-0.5">
                                                {{ $item['type'] === 'meeting' ? 'KELAS' : 'TRYOUT' }}
                                            </span>
                                        </div>
                                    </div>
                                    <svg class="h-2.5 w-2.5 sm:h-3 sm:w-3 text-white/70 opacity-0 transition-opacity group-hover:opacity-100 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            @endforeach

                            {{-- Empty State --}}
                            @if($eventCount === 0)
                                <div class="flex h-12 sm:h-16 items-center justify-center rounded-lg border border-dashed border-primary-200 dark:border-primary-700/30">
                                    <span class="text-[9px] sm:text-xs text-secondary-400 dark:text-secondary-500">Tidak ada</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @endfor
            </div>
        </div>

        {{-- Legend --}}
        <div class="mt-6 bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 p-5 shadow-sm">
            <h3 class="text-sm font-semibold text-primary-800 dark:text-primary-100 mb-3">Legenda Jadwal</h3>
            <div class="flex flex-wrap gap-3 sm:gap-4">
                <div class="flex items-center gap-2">
                    <div class="h-3 w-3 rounded-full bg-blue-500"></div>
                    <span class="text-xs text-secondary-600 dark:text-secondary-300">Meeting Kelas</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="h-3 w-3 rounded-full bg-accent-500"></div>
                    <span class="text-xs text-secondary-600 dark:text-secondary-300">Sesi Tryout</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="h-6 w-6 rounded-full border-2 border-primary-600"></div>
                    <span class="text-xs text-secondary-600 dark:text-secondary-300">Hari Ini</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="h-3 w-3 rounded bg-primary-50 dark:bg-primary-900/20"></div>
                    <span class="text-xs text-secondary-600 dark:text-secondary-300">Akhir Pekan</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="h-3 w-3 rounded bg-primary-50/30 dark:bg-primary-900/10"></div>
                    <span class="text-xs text-secondary-600 dark:text-secondary-300">Bulan Lain</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="h-3 w-3 rounded-full bg-primary-100 dark:bg-primary-800/40 flex items-center justify-center text-[8px] font-bold text-primary-600 dark:text-primary-300">1</div>
                    <span class="text-xs text-secondary-600 dark:text-secondary-300">Jumlah Jadwal</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
