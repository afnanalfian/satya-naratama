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

<div class="space-y-8">

    {{-- HEADER --}}
    <div class="rounded-xl border border-azwara-lighter bg-white px-6 py-5 dark:border-gray-700 dark:bg-gray-800">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-azwara-lighter/30 dark:bg-azwara-darker">
                    <svg class="h-6 w-6 text-azwara-medium dark:text-azwara-lighter" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-azwara-darker dark:text-white">Jadwal Akademik</h1>
                    <div class="mt-1 flex items-center gap-3">
                        <span class="text-lg font-semibold text-azwara-medium dark:text-gray-300">
                            {{ $current->translatedFormat('F Y') }}
                        </span>
                        @if($current->isCurrentMonth())
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900/30 dark:text-green-300">
                            <svg class="h-2 w-2" fill="currentColor" viewBox="0 0 8 8">
                                <circle cx="4" cy="4" r="4" />
                            </svg>
                            Bulan Ini
                        </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('schedule.index', ['month' => $prev->month, 'year' => $prev->year]) }}"
                   class="inline-flex items-center gap-2 rounded-lg border border-azwara-lighter bg-white px-4 py-2.5 text-sm font-medium text-azwara-medium transition-colors hover:bg-azwara-lightest dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    {{ $prev->translatedFormat('M') }}
                </a>

                <a href="{{ route('schedule.index', ['month' => now()->month, 'year' => now()->year]) }}"
                   class="inline-flex items-center gap-2 rounded-lg bg-azwara-medium px-4 py-2.5 text-sm font-medium text-white transition-colors hover:bg-azwara-light focus:outline-none focus:ring-2 focus:ring-azwara-medium focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Hari Ini
                </a>

                <a href="{{ route('schedule.index', ['month' => $next->month, 'year' => $next->year]) }}"
                   class="inline-flex items-center gap-2 rounded-lg border border-azwara-lighter bg-white px-4 py-2.5 text-sm font-medium text-azwara-medium transition-colors hover:bg-azwara-lightest dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                    {{ $next->translatedFormat('M') }}
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    {{-- CALENDAR --}}
    <div class="overflow-hidden rounded-xl border border-azwara-lighter bg-white dark:border-gray-700 dark:bg-gray-800">
        {{-- Day Headers --}}
        <div class="grid grid-cols-7 border-b border-azwara-lighter dark:border-gray-700">
            @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $day)
                <div class="px-4 py-3 text-center">
                    <div class="text-sm font-semibold text-azwara-darker dark:text-white">{{ $day }}</div>
                    <div class="mt-1 text-xs text-azwara-medium dark:text-gray-400">{{ substr($day, 0, 3) }}</div>
                </div>
            @endforeach
        </div>

        {{-- Calendar Grid --}}
        <div class="grid grid-cols-7 divide-x divide-y divide-azwara-lighter dark:divide-gray-700">
            @for ($date = $start->copy(); $date <= $end; $date->addDay())
                @php
                    $dateKey = $date->format('Y-m-d');
                    $isCurrentMonth = $date->month === $current->month;
                    $isToday = $date->isToday();
                    $isWeekend = $date->isWeekend();
                    $events = $items[$dateKey] ?? [];
                    $eventCount = count($events);
                @endphp

                <div class="min-h-[140px] p-3 {{ !$isCurrentMonth ? 'bg-azwara-lightest/30 dark:bg-gray-900/30' : '' }} {{ $isWeekend ? 'bg-azwara-lightest/50 dark:bg-gray-900/20' : '' }}">
                    {{-- Date Header --}}
                    <div class="mb-2 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="text-sm font-medium {{ $isToday ? 'flex h-7 w-7 items-center justify-center rounded-full bg-azwara-medium text-white' : 'text-azwara-darker dark:text-white' }}">
                                {{ $date->day }}
                            </span>
                            @if($isToday)
                                <span class="text-xs font-medium text-azwara-medium dark:text-azwara-lighter">Hari Ini</span>
                            @endif
                        </div>

                        @if($eventCount > 0)
                            <span class="rounded-full bg-azwara-lightest px-2 py-0.5 text-xs font-medium text-azwara-medium dark:bg-gray-700 dark:text-gray-300">
                                {{ $eventCount }} {{ $eventCount === 1 ? 'jadwal' : 'jadwal' }}
                            </span>
                        @endif
                    </div>

                    {{-- Events List --}}
                    <div class="space-y-1.5">
                        @foreach ($events as $item)
                            @php
                                if ($item['type'] === 'meeting') {
                                    $courseId = $item['course_id'];
                                    if (! isset($courseColors[$courseId])) {
                                        $courseColors[$courseId] = $palette[count($courseColors) % count($palette)];
                                    }
                                    $bgClass = $courseColors[$courseId];
                                    $icon = '<svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>';
                                } else {
                                    $bgClass = 'bg-gradient-to-r from-red-500 to-red-600';
                                    $icon = '<svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>';
                                }
                            @endphp

                            <a href="{{ $item['url'] }}"
                               class="group flex items-center gap-2 rounded-lg p-2 text-xs transition-colors hover:opacity-90 {{ $bgClass }}">
                                <div class="flex h-5 w-5 items-center justify-center rounded bg-white/20">
                                    {!! $icon !!}
                                </div>
                                <div class="flex-1 overflow-hidden">
                                    <div class="truncate font-semibold text-white">{{ $item['title'] }}</div>
                                    <div class="flex items-center gap-1 text-white/90">
                                        <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>{{ $item['time']->format('H:i') }}</span>
                                        <span class="ml-1 text-[10px] uppercase tracking-wider opacity-80">
                                            {{ $item['type'] === 'meeting' ? 'KELAS' : 'TRYOUT' }}
                                        </span>
                                    </div>
                                </div>
                                <svg class="h-3 w-3 text-white/70 opacity-0 transition-opacity group-hover:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        @endforeach

                        {{-- Empty State --}}
                        @if($eventCount === 0)
                            <div class="flex h-16 items-center justify-center rounded-lg border border-dashed border-azwara-lighter dark:border-gray-600">
                                <span class="text-xs text-azwara-medium dark:text-gray-400">Tidak ada jadwal</span>
                            </div>
                        @endif
                    </div>
                </div>
            @endfor
        </div>
    </div>

    {{-- LEGEND --}}
    <div class="rounded-xl border border-azwara-lighter bg-white p-5 dark:border-gray-700 dark:bg-gray-800">
        <h3 class="mb-4 text-sm font-semibold text-azwara-darker dark:text-white">Legenda Jadwal</h3>
        <div class="flex flex-wrap gap-4">
            <div class="flex items-center gap-2">
                <div class="h-3 w-3 rounded-full bg-blue-500"></div>
                <span class="text-xs text-azwara-medium dark:text-gray-300">Meeting Kelas</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="h-3 w-3 rounded-full bg-gradient-to-r from-red-500 to-red-600"></div>
                <span class="text-xs text-azwara-medium dark:text-gray-300">Sesi Tryout</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="h-7 w-7 rounded-full border-2 border-azwara-medium"></div>
                <span class="text-xs text-azwara-medium dark:text-gray-300">Hari Ini</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="h-3 w-3 rounded bg-azwara-lightest dark:bg-gray-700"></div>
                <span class="text-xs text-azwara-medium dark:text-gray-300">Akhir Pekan</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="h-3 w-3 rounded bg-azwara-lightest/50 dark:bg-gray-900"></div>
                <span class="text-xs text-azwara-medium dark:text-gray-300">Bulan Lain</span>
            </div>
        </div>
    </div>

</div>
@endsection
