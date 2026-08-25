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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl md:text-2xl font-bold text-primary-900 dark:text-white tracking-tight">
                            Laporan Kehadiran
                        </h1>
                        <p class="text-sm text-secondary-500 dark:text-secondary-400 mt-0.5">
                            Persentase kehadiran siswa per course
                        </p>
                    </div>
                </div>

                @if($selectedCourseId && $attendanceData->isNotEmpty())
                <div class="flex items-center gap-2 text-sm">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-emerald-100 text-emerald-700 dark:bg-emerald-900/20 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800/30">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        {{ $attendanceData->where('percentage', '>=', 80)->count() }} di atas 80%
                    </span>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-red-100 text-red-700 dark:bg-red-900/20 dark:text-red-300 border border-red-200 dark:border-red-800/30">
                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                        {{ $attendanceData->where('percentage', '<', 50)->count() }} di bawah 50%
                    </span>
                </div>
                @endif
            </div>
        </div>

        {{-- Filter --}}
        <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 p-5 md:p-6 mb-6 shadow-sm">
            <form method="GET" action="{{ route('reports.course-attendance') }}" class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1">
                    <label for="course_id" class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                        Pilih Course
                    </label>
                    <select name="course_id" id="course_id"
                            class="w-full px-4 py-2.5 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-primary-50/50 dark:bg-primary-800/20 text-primary-800 dark:text-primary-100 focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200 appearance-none">
                        <option value="">-- Pilih Course --</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}"
                                    {{ $selectedCourseId == $course->id ? 'selected' : '' }}>
                                {{ $course->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit"
                            class="px-6 py-2.5 rounded-xl bg-primary-600 hover:bg-primary-700 text-white font-medium transition-all duration-200 hover:shadow-lg hover:shadow-primary-500/25 active:scale-[0.98]">
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                            </svg>
                            Tampilkan
                        </span>
                    </button>
                </div>
            </form>
        </div>

        {{-- Main Content --}}
        @if($selectedCourseId)
            <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 overflow-hidden shadow-sm">

                {{-- Course Header --}}
                <div class="px-6 py-5 border-b border-primary-100 dark:border-primary-800/30 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div>
                        <h3 class="text-lg font-bold text-primary-800 dark:text-primary-100">
                            {{ $courses->find($selectedCourseId)->name ?? 'Course' }}
                        </h3>
                        <p class="text-sm text-secondary-500 dark:text-secondary-400">
                            {{ $attendanceData->count() }} siswa terdaftar
                            @if($attendanceData->isNotEmpty())
                                • {{ $attendanceData->first()['total_done_meetings'] ?? 0 }} pertemuan selesai
                            @endif
                        </p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-medium bg-primary-100 text-primary-700 dark:bg-primary-800/30 dark:text-primary-300">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                            Diurutkan dari kehadiran tertinggi
                        </span>
                    </div>
                </div>

                {{-- Table --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-primary-50/80 dark:bg-primary-800/20 border-b border-primary-100 dark:border-primary-800/30">
                                <th class="text-left py-3.5 px-4 text-xs font-semibold text-secondary-600 dark:text-secondary-400 uppercase tracking-wider w-12">No</th>
                                <th class="text-left py-3.5 px-4 text-xs font-semibold text-secondary-600 dark:text-secondary-400 uppercase tracking-wider">Siswa</th>
                                <th class="text-left py-3.5 px-4 text-xs font-semibold text-secondary-600 dark:text-secondary-400 uppercase tracking-wider hidden md:table-cell">Email</th>
                                <th class="text-center py-3.5 px-4 text-xs font-semibold text-secondary-600 dark:text-secondary-400 uppercase tracking-wider">Kehadiran</th>
                                <th class="text-center py-3.5 px-4 text-xs font-semibold text-secondary-600 dark:text-secondary-400 uppercase tracking-wider">Persentase</th>
                                <th class="text-left py-3.5 px-4 text-xs font-semibold text-secondary-600 dark:text-secondary-400 uppercase tracking-wider w-32">Progress</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-primary-100 dark:divide-primary-800/30">
                            @forelse($attendanceData as $index => $data)
                                @php
                                    $student = $data['student'];
                                    $attended = $data['attended_count'];
                                    $total = $data['total_done_meetings'];
                                    $percentage = $data['percentage'];
                                    $isPerfect = $percentage === 100;
                                    $isGood = $percentage >= 80 && $percentage < 100;
                                    $isMedium = $percentage >= 60 && $percentage < 80;
                                    $isLow = $percentage >= 40 && $percentage < 60;
                                    $isDanger = $percentage !== null && $percentage < 40;

                                    $colorClass = match(true) {
                                        $isPerfect => 'text-emerald-600 dark:text-emerald-400',
                                        $isGood => 'text-primary-600 dark:text-primary-400',
                                        $isMedium => 'text-gold-600 dark:text-gold-400',
                                        $isLow => 'text-amber-600 dark:text-amber-400',
                                        $isDanger => 'text-red-600 dark:text-red-400',
                                        default => 'text-secondary-400 dark:text-secondary-500'
                                    };

                                    $bgClass = match(true) {
                                        $isPerfect => 'bg-emerald-500',
                                        $isGood => 'bg-primary-500',
                                        $isMedium => 'bg-gold-500',
                                        $isLow => 'bg-amber-500',
                                        $isDanger => 'bg-red-500',
                                        default => 'bg-secondary-300 dark:bg-secondary-600'
                                    };

                                    $badgeClass = match(true) {
                                        $isPerfect => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/20 dark:text-emerald-300 border-emerald-200 dark:border-emerald-800/30',
                                        $isGood => 'bg-primary-100 text-primary-700 dark:bg-primary-800/30 dark:text-primary-300 border-primary-200 dark:border-primary-700/30',
                                        $isMedium => 'bg-gold-100 text-gold-700 dark:bg-gold-900/20 dark:text-gold-300 border-gold-200 dark:border-gold-800/30',
                                        $isLow => 'bg-amber-100 text-amber-700 dark:bg-amber-900/20 dark:text-amber-300 border-amber-200 dark:border-amber-800/30',
                                        $isDanger => 'bg-red-100 text-red-700 dark:bg-red-900/20 dark:text-red-300 border-red-200 dark:border-red-800/30',
                                        default => 'bg-secondary-100 text-secondary-600 dark:bg-secondary-900/20 dark:text-secondary-300 border-secondary-200 dark:border-secondary-800/30'
                                    };
                                @endphp
                                <tr class="hover:bg-primary-50/50 dark:hover:bg-primary-800/20 transition-colors group">
                                    <td class="py-3.5 px-4 text-sm text-secondary-500 dark:text-secondary-400 text-center">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="py-3.5 px-4">
                                        <div class="flex items-center gap-3">
                                            <img src="{{ $student->avatar_url }}"
                                                 class="w-8 h-8 rounded-full object-cover ring-2 ring-primary-200 dark:ring-primary-700/50 group-hover:ring-primary-400 transition-all">
                                            <div>
                                                <div class="font-medium text-primary-800 dark:text-primary-100">
                                                    {{ $student->name }}
                                                </div>
                                                <div class="text-xs text-secondary-500 dark:text-secondary-400 md:hidden">
                                                    {{ $student->email }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3.5 px-4 text-secondary-600 dark:text-secondary-300 hidden md:table-cell">
                                        {{ $student->email }}
                                    </td>
                                    <td class="py-3.5 px-4 text-center">
                                        <span class="text-sm font-medium {{ $colorClass }}">
                                            {{ $attended }}/{{ $total }}
                                        </span>
                                    </td>
                                    <td class="py-3.5 px-4 text-center">
                                        @if($percentage !== null)
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium {{ $badgeClass }} border">
                                                {{ $percentage }}%
                                            </span>
                                        @else
                                            <span class="text-sm text-secondary-400 dark:text-secondary-500">-</span>
                                        @endif
                                    </td>
                                    <td class="py-3.5 px-4">
                                        @if($percentage !== null)
                                            <div class="flex items-center gap-3">
                                                <div class="flex-1 min-w-[60px] bg-primary-100 dark:bg-primary-800/30 rounded-full h-2.5 overflow-hidden">
                                                    <div class="h-full rounded-full transition-all duration-1000 {{ $bgClass }}"
                                                         style="width: {{ min($percentage, 100) }}%;">
                                                    </div>
                                                </div>
                                                <span class="text-[10px] font-medium text-secondary-500 dark:text-secondary-400 w-8 text-right">
                                                    {{ min($percentage, 100) }}%
                                                </span>
                                            </div>
                                        @else
                                            <span class="text-xs text-secondary-400 dark:text-secondary-500">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-12 text-center">
                                        <div class="flex flex-col items-center gap-3">
                                            <div class="w-16 h-16 rounded-full bg-primary-100 dark:bg-primary-800/30 flex items-center justify-center">
                                                <svg class="w-8 h-8 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                                </svg>
                                            </div>
                                            <p class="text-base font-semibold text-primary-800 dark:text-primary-100">Tidak Ada Data Kehadiran</p>
                                            <p class="text-sm text-secondary-500 dark:text-secondary-400">Pastikan sudah ada meeting yang selesai (done)</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Summary Stats --}}
                @if($attendanceData->isNotEmpty() && $attendanceData->first()['total_done_meetings'] > 0)
                    <div class="border-t border-primary-100 dark:border-primary-800/30 px-6 py-5 bg-primary-50/30 dark:bg-primary-900/10">
                        <h4 class="text-sm font-semibold text-primary-700 dark:text-primary-300 mb-4 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                            Statistik Kehadiran
                        </h4>
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                            <div class="bg-white dark:bg-primary-800/20 rounded-xl p-4 border border-primary-100 dark:border-primary-700/30">
                                <p class="text-xs text-secondary-500 dark:text-secondary-400 uppercase tracking-wider">Rata-rata</p>
                                <p class="text-2xl font-bold text-primary-800 dark:text-primary-100 mt-1">
                                    {{ round($attendanceData->avg('percentage'), 1) }}%
                                </p>
                            </div>
                            <div class="bg-white dark:bg-primary-800/20 rounded-xl p-4 border border-primary-100 dark:border-primary-700/30">
                                <p class="text-xs text-secondary-500 dark:text-secondary-400 uppercase tracking-wider">Hadir 100%</p>
                                <p class="text-2xl font-bold text-emerald-600 dark:text-emerald-400 mt-1">
                                    {{ $attendanceData->where('percentage', 100)->count() }}
                                </p>
                            </div>
                            <div class="bg-white dark:bg-primary-800/20 rounded-xl p-4 border border-primary-100 dark:border-primary-700/30">
                                <p class="text-xs text-secondary-500 dark:text-secondary-400 uppercase tracking-wider">≥ 80%</p>
                                <p class="text-2xl font-bold text-primary-600 dark:text-primary-400 mt-1">
                                    {{ $attendanceData->where('percentage', '>=', 80)->count() }}
                                </p>
                            </div>
                            <div class="bg-white dark:bg-primary-800/20 rounded-xl p-4 border border-primary-100 dark:border-primary-700/30">
                                <p class="text-xs text-secondary-500 dark:text-secondary-400 uppercase tracking-wider">&lt; 50%</p>
                                <p class="text-2xl font-bold text-red-600 dark:text-red-400 mt-1">
                                    {{ $attendanceData->where('percentage', '<', 50)->count() }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @else
            {{-- Empty State --}}
            <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 p-12 text-center shadow-sm">
                <div class="flex flex-col items-center">
                    <div class="w-20 h-20 rounded-full bg-primary-100 dark:bg-primary-800/30 flex items-center justify-center mb-4">
                        <svg class="w-10 h-10 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-primary-800 dark:text-primary-100 mb-2">
                        Pilih Course untuk Melihat Laporan
                    </h3>
                    <p class="text-sm text-secondary-500 dark:text-secondary-400 max-w-md">
                        Pilih course dari dropdown di atas untuk melihat persentase kehadiran siswa pada course tersebut.
                    </p>
                    <div class="mt-6 flex items-center gap-2 text-xs text-secondary-400 dark:text-secondary-500">
                        <span class="inline-block w-2 h-2 rounded-full bg-emerald-500"></span>
                        Baik (≥80%)
                        <span class="w-px h-4 bg-primary-200 dark:bg-primary-700 mx-2"></span>
                        <span class="inline-block w-2 h-2 rounded-full bg-gold-500"></span>
                        Sedang (60-79%)
                        <span class="w-px h-4 bg-primary-200 dark:bg-primary-700 mx-2"></span>
                        <span class="inline-block w-2 h-2 rounded-full bg-red-500"></span>
                        Kurang (&lt;40%)
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@push('styles')
<style>
    .overflow-x-auto::-webkit-scrollbar {
        height: 6px;
    }
    .overflow-x-auto::-webkit-scrollbar-track {
        @apply bg-primary-100 dark:bg-primary-800/30 rounded-full;
    }
    .overflow-x-auto::-webkit-scrollbar-thumb {
        @apply bg-primary-300 dark:bg-primary-600 rounded-full;
    }
    .overflow-x-auto::-webkit-scrollbar-thumb:hover {
        @apply bg-primary-400 dark:bg-primary-500;
    }
</style>
@endpush
