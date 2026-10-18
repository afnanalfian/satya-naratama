@extends('layouts.app')

@section('title', 'Kehadiran · ' . $student->name)

@php $fmt = fn ($v) => $v === null ? '–' : rtrim(rtrim(number_format($v, 1, ',', '.'), '0'), ',') . '%'; @endphp

@section('content')
<div class="py-6 md:py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <nav class="flex items-center gap-2 text-sm mb-6">
            <a href="{{ route('attendance.index') }}" class="text-secondary-500 hover:text-primary-600 dark:text-secondary-400 dark:hover:text-primary-300">Rekap Absensi</a>
            <span class="text-secondary-300 dark:text-secondary-600">/</span>
            <span class="text-primary-600 dark:text-primary-300 font-medium">{{ $student->name }}</span>
        </nav>

        <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 p-5 shadow-sm mb-6 flex flex-col sm:flex-row sm:items-center gap-4">
            <img src="{{ $student->avatar_url }}" class="w-16 h-16 rounded-full object-cover ring-4 ring-primary-50 dark:ring-primary-800" alt="">
            <div class="flex-1 min-w-0">
                <h1 class="text-xl font-bold text-primary-900 dark:text-white truncate">{{ $student->name }}</h1>
                <p class="text-sm text-secondary-500 dark:text-secondary-400">
                    {{ $student->studentRegistration?->class ? 'Kelas ' . $student->studentRegistration->class . ' · ' : '' }}{{ $student->studentRegistration?->school_origin }}
                    @unless($student->is_active) · <span class="text-red-600">Nonaktif</span>@endunless
                </p>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('monitor.student', $student) }}" class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium">Rapor Lengkap</a>
                <a href="{{ route('siswa.show', $student->id) }}" class="px-4 py-2 rounded-xl border border-primary-200 dark:border-primary-700/50 text-sm font-medium text-secondary-700 dark:text-secondary-200 hover:bg-primary-50 dark:hover:bg-primary-800/30">Profil</a>
            </div>
        </div>

        <form method="GET" class="flex flex-wrap items-end gap-3 mb-6">
            <label class="block">
                <span class="text-xs font-medium text-secondary-500 dark:text-secondary-400">Dari</span>
                <input type="date" name="from" value="{{ $filters['from']?->toDateString() }}" class="mt-1 rounded-xl border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-sm text-primary-800 dark:text-primary-100">
            </label>
            <label class="block">
                <span class="text-xs font-medium text-secondary-500 dark:text-secondary-400">Sampai</span>
                <input type="date" name="to" value="{{ $filters['to']?->toDateString() }}" class="mt-1 rounded-xl border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-sm text-primary-800 dark:text-primary-100">
            </label>
            <button class="px-4 py-2.5 rounded-xl bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium">Terapkan</button>
        </form>

        @include('attendance.partials.summary-tiles', ['summary' => $summary])

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 mt-6">
            <div class="lg:col-span-3 space-y-6">
                <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 p-5 shadow-sm">
                    <h2 class="font-semibold text-primary-800 dark:text-primary-100">Kehadiran per Pekan</h2>
                    <p class="text-xs text-secondary-500 dark:text-secondary-400 mb-3">% hadir dari pertemuan selesai pada pekan tsb</p>
                    @if(count($weekly['labels']))
                        <div class="h-64"><canvas id="studentWeekly" role="img" aria-label="Grafik kehadiran siswa per pekan"></canvas></div>
                    @else
                        <p class="py-12 text-center text-sm text-secondary-500 dark:text-secondary-400">Belum ada data.</p>
                    @endif
                </div>

                <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b border-primary-100 dark:border-primary-800/30"><h2 class="font-semibold text-primary-800 dark:text-primary-100">Per Course</h2></div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-primary-50/60 dark:bg-primary-800/20 text-xs uppercase text-secondary-500 dark:text-secondary-400">
                                <tr><th class="px-5 py-2.5 text-left">Course</th><th class="px-3 py-2.5 text-left">Kehadiran</th><th class="px-2 py-2.5">I</th><th class="px-2 py-2.5">S</th><th class="px-2 py-2.5">A</th></tr>
                            </thead>
                            <tbody class="divide-y divide-primary-100 dark:divide-primary-800/30">
                                @forelse($perCourse as $c)
                                    <tr>
                                        <td class="px-5 py-3">
                                            <p class="font-medium text-primary-800 dark:text-primary-100">{{ $c['course']?->name }}</p>
                                            <x-course-type-badge :type="$c['course']?->type" size="xs" class="mt-1" />
                                        </td>
                                        <td class="px-3 py-3">@include('attendance.partials.pct', ['b' => $c])</td>
                                        <td class="px-2 py-3 text-center tabular-nums">{{ $c['izin'] }}</td>
                                        <td class="px-2 py-3 text-center tabular-nums">{{ $c['sakit'] }}</td>
                                        <td class="px-2 py-3 text-center tabular-nums {{ $c['alpa'] ? 'text-red-600 dark:text-red-400 font-semibold' : '' }}">{{ $c['alpa'] }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="px-5 py-8 text-center text-secondary-500 dark:text-secondary-400">Belum ada data.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 shadow-sm p-5">
                <h2 class="font-semibold text-primary-800 dark:text-primary-100 mb-1">Riwayat Pertemuan</h2>
                <p class="text-xs text-secondary-500 dark:text-secondary-400">{{ $history->count() }} pertemuan selesai</p>
                <div class="max-h-[640px] overflow-y-auto pr-1">
                    @include('attendance.partials.history-list', ['history' => $history])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@include('partials.charts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const w = @json($weekly);
    SNChart.render('studentWeekly', {
        type: 'line', labels: w.labels, tooltipTitles: w.ranges, ySuffix: '%', yMin: 0, yMax: 100,
        datasets: [
            { label: 'Akademik', data: w.akademik, color: 'akademik' },
            { label: 'Jasmani', data: w.jasmani, color: 'jasmani' },
        ],
    });
});
</script>
@endpush
