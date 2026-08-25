@extends('layouts.app')

@section('content')
<div class="py-6 md:py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Navigation --}}
        <nav class="flex items-center gap-2 text-sm mb-6">
            <a href="{{ route('meeting.show', $meeting) }}"
               class="text-secondary-500 hover:text-primary-600 dark:text-secondary-400 dark:hover:text-primary-300 transition-colors group">
                <span class="inline-flex items-center gap-1.5">
                    <svg class="w-4 h-4 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    {{ $meeting->title }}
                </span>
            </a>
            <span class="text-secondary-300 dark:text-secondary-600">/</span>
            <span class="text-primary-600 dark:text-primary-300 font-medium">Absensi</span>
        </nav>

        {{-- Header Card --}}
        <div class="relative overflow-hidden rounded-2xl bg-white dark:bg-primary-900/40 border border-primary-100 dark:border-primary-800/30 p-6 md:p-8 mb-6">
            <div class="absolute top-0 right-0 w-64 h-64 bg-primary-500/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/4"></div>

            <div class="relative flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <div class="flex items-center gap-3">
                        <div class="p-2.5 rounded-xl bg-primary-500/10 text-primary-600 dark:bg-primary-400/10 dark:text-primary-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold text-primary-800 dark:text-primary-100">Absensi Pertemuan</h1>
                            <p class="text-sm text-secondary-500 dark:text-secondary-400">{{ $meeting->title }}</p>
                        </div>
                    </div>
                    <div class="mt-2 flex flex-wrap items-center gap-x-4 gap-y-1 text-sm text-secondary-500 dark:text-secondary-400">
                        <span class="inline-flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $meeting->scheduled_at->translatedFormat('l, d F Y • H:i') }} WIB
                        </span>
                        @if($meeting->course)
                        <span class="inline-flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            {{ $meeting->course->name }}
                        </span>
                        @endif
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <div class="rounded-xl bg-primary-50 dark:bg-primary-800/20 border border-primary-100 dark:border-primary-700/30 px-4 py-2.5">
                        <p class="text-xs text-secondary-500 dark:text-secondary-400">Total Eligible</p>
                        <p class="text-xl font-bold text-primary-700 dark:text-primary-300">{{ number_format($eligibleStudents->total()) }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Stats & Search --}}
        <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 p-5 mb-6 shadow-sm">
            {{-- Stats Grid --}}
            <div class="grid grid-cols-3 gap-3 mb-5">
                <div class="rounded-xl bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800/30 p-3.5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-emerald-700 dark:text-emerald-300 font-medium">Hadir</p>
                            <p class="text-2xl font-bold text-emerald-600 dark:text-emerald-400">{{ $presentCount }}</p>
                        </div>
                        <div class="h-10 w-10 rounded-full bg-emerald-100 dark:bg-emerald-800/30 flex items-center justify-center">
                            <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="rounded-xl bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800/30 p-3.5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-red-700 dark:text-red-300 font-medium">Tidak Hadir</p>
                            <p class="text-2xl font-bold text-red-600 dark:text-red-400">{{ $absentCount }}</p>
                        </div>
                        <div class="h-10 w-10 rounded-full bg-red-100 dark:bg-red-800/30 flex items-center justify-center">
                            <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="rounded-xl bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800/30 p-3.5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-blue-700 dark:text-blue-300 font-medium">Total Eligible</p>
                            <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ number_format($eligibleStudents->total()) }}</p>
                        </div>
                        <div class="h-10 w-10 rounded-full bg-blue-100 dark:bg-blue-800/30 flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5 0c-.828 0-1.5.672-1.5 1.5s.672 1.5 1.5 1.5 1.5-.672 1.5-1.5-.672-1.5-1.5-1.5z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Search --}}
            <form method="GET" action="{{ route('meeting.attendance.index', $meeting) }}"
                  class="flex flex-col sm:flex-row gap-3">
                <div class="flex-1 relative">
                    <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" name="search" value="{{ $search }}"
                           placeholder="Cari nama siswa dengan akses..."
                           class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-primary-50/50 dark:bg-primary-800/20 text-primary-800 dark:text-primary-100 placeholder-secondary-400 focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200">
                </div>
                <div class="flex gap-2">
                    <button type="submit"
                            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-primary-600 hover:bg-primary-700 text-white font-medium transition-all duration-200 hover:shadow-lg hover:shadow-primary-500/25 active:scale-[0.98]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Cari
                    </button>
                    @if($search)
                    <a href="{{ route('meeting.attendance.index', $meeting) }}"
                       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl border border-primary-200 dark:border-primary-700/50 text-secondary-600 dark:text-secondary-300 hover:bg-primary-50 dark:hover:bg-primary-800/20 transition-all duration-200">
                        Reset
                    </a>
                    @endif
                </div>
            </form>
        </div>

        {{-- Attendance Form --}}
        <form method="POST" action="{{ route('meeting.attendance.store', $meeting) }}"
              class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 overflow-hidden shadow-sm">
            @csrf

            {{-- Action Bar --}}
            <div class="flex flex-wrap items-center justify-between gap-3 p-4 bg-primary-50/50 dark:bg-primary-800/20 border-b border-primary-100 dark:border-primary-800/30">
                <div class="text-sm text-secondary-600 dark:text-secondary-400">
                    Menampilkan <span class="font-semibold text-primary-700 dark:text-primary-300">{{ $eligibleStudents->count() }}</span> dari
                    <span class="font-semibold text-primary-700 dark:text-primary-300">{{ $eligibleStudents->total() }}</span> siswa dengan akses
                </div>
                <div class="flex flex-wrap items-center gap-2">
                    <button type="button" onclick="checkAll()"
                            class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-sm font-medium text-emerald-600 hover:bg-emerald-50 dark:text-emerald-400 dark:hover:bg-emerald-900/20 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Tandai Semua Hadir
                    </button>
                    <button type="button" onclick="uncheckAll()"
                            class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-sm font-medium text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-900/20 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Tandai Semua Tidak Hadir
                    </button>
                </div>
            </div>

            {{-- Student List --}}
            <div class="divide-y divide-primary-100 dark:divide-primary-800/30">
                @forelse ($eligibleStudents as $student)
                    @php
                        $attendance = $attendances[$student->id] ?? null;
                        $hasCourseAccess = $student->entitlements()
                            ->where('entitlement_type', 'course')
                            ->where('entitlement_id', $meeting->course_id)
                            ->exists();
                        $hasMeetingAccess = $student->entitlements()
                            ->where('entitlement_type', 'meeting')
                            ->where('entitlement_id', $meeting->id)
                            ->exists();
                    @endphp

                    <div class="flex items-center gap-4 px-4 py-3 hover:bg-primary-50/50 dark:hover:bg-primary-800/20 transition-colors group">
                        {{-- Checkbox --}}
                        <div class="flex-shrink-0">
                            <input type="checkbox" name="attendances[{{ $student->id }}]" value="1"
                                   id="student_{{ $student->id }}"
                                   @checked(optional($attendance)->is_present)
                                   class="h-5 w-5 rounded border-primary-300 dark:border-primary-600 text-primary-600 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-primary-900 transition-all">
                        </div>

                        {{-- Student Info --}}
                        <label for="student_{{ $student->id }}" class="flex-1 cursor-pointer min-w-0">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                                <div class="flex items-center gap-3 min-w-0">
                                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-primary-100 text-sm font-medium text-primary-700 dark:bg-primary-800/40 dark:text-primary-300">
                                        {{ substr($student->name, 0, 1) }}
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-sm font-medium text-primary-800 dark:text-primary-100 truncate">
                                            {{ $student->name }}
                                        </p>
                                        <p class="text-xs text-secondary-500 dark:text-secondary-400 truncate">
                                            {{ $student->email }}
                                        </p>
                                    </div>
                                </div>

                                <div class="flex flex-wrap items-center gap-2 ml-12 sm:ml-0">
                                    {{-- Access Badge --}}
                                    @if($hasMeetingAccess)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-300 border border-purple-200 dark:border-purple-800/30">
                                            Meeting Satuan
                                        </span>
                                    @elseif($hasCourseAccess)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-300 border border-indigo-200 dark:border-indigo-800/30">
                                            Course Access
                                        </span>
                                    @endif

                                    {{-- Status --}}
                                    @if(optional($attendance)->is_present)
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800/30">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            Hadir
                                        </span>
                                    @elseif($attendance)
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300 border border-red-200 dark:border-red-800/30">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                            Tidak Hadir
                                        </span>
                                    @endif

                                    @if($attendance && $attendance->marked_at)
                                        <span class="text-[10px] text-secondary-400 dark:text-secondary-500">
                                            {{ optional($attendance->marked_at)->format('d/m/Y H:i') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </label>
                    </div>
                @empty
                    <div class="py-12 text-center">
                        <div class="w-16 h-16 mx-auto rounded-full bg-primary-100 dark:bg-primary-800/30 flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5 0c-.828 0-1.5.672-1.5 1.5s.672 1.5 1.5 1.5 1.5-.672 1.5-1.5-.672-1.5-1.5-1.5z"/>
                            </svg>
                        </div>
                        <p class="text-base font-semibold text-primary-800 dark:text-primary-100">
                            @if($search)
                                Tidak ditemukan siswa "{{ $search }}"
                            @else
                                Tidak ada siswa dengan akses
                            @endif
                        </p>
                        <p class="text-sm text-secondary-500 dark:text-secondary-400 mt-1">
                            @if($search)
                                Coba dengan kata kunci lain
                            @else
                                Siswa harus memiliki akses course atau membeli meeting ini
                            @endif
                        </p>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if($eligibleStudents->hasPages())
                <div class="border-t border-primary-100 dark:border-primary-800/30 px-4 py-4">
                    {{ $eligibleStudents->withQueryString()->links() }}
                </div>
            @endif

            {{-- Submit Actions --}}
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4 p-4 bg-primary-50/50 dark:bg-primary-800/20 border-t border-primary-100 dark:border-primary-800/30">
                <div class="grid grid-cols-3 gap-3 text-sm">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
                        <span class="text-secondary-600 dark:text-secondary-300">Hadir: {{ $presentCount }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-red-500"></span>
                        <span class="text-secondary-600 dark:text-secondary-300">Tidak: {{ $absentCount }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-blue-500"></span>
                        <span class="text-secondary-600 dark:text-secondary-300">Total: {{ $eligibleStudents->total() }}</span>
                    </div>
                </div>

                <div class="flex gap-3">
                    <a href="{{ route('meeting.show', $meeting) }}"
                       class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl border border-primary-200 dark:border-primary-700/50 text-secondary-600 dark:text-secondary-300 hover:bg-primary-50 dark:hover:bg-primary-800/20 transition-all duration-200 font-medium">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali
                    </a>
                    <button type="submit"
                            class="inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-xl bg-primary-600 hover:bg-primary-700 text-white font-medium transition-all duration-200 hover:shadow-lg hover:shadow-primary-500/25 active:scale-[0.98]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Absensi
                    </button>
                </div>
            </div>
        </form>

        {{-- Info Box --}}
        <div class="mt-6 rounded-2xl bg-blue-50 dark:bg-blue-900/10 border border-blue-200 dark:border-blue-800/30 p-5">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <h4 class="font-medium text-blue-800 dark:text-blue-300 text-sm">Informasi Akses</h4>
                    <p class="text-sm text-blue-700 dark:text-blue-400 mt-1">
                        Hanya siswa yang memiliki akses ke course <strong>{{ $meeting->course->name ?? 'ini' }}</strong>
                        atau membeli meeting <strong>{{ $meeting->title }}</strong> secara satuan yang dapat diabsen.
                    </p>
                    <div class="mt-2 flex flex-wrap gap-2">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900/30 dark:text-indigo-300 border border-indigo-200 dark:border-indigo-800/30">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Course Access
                        </span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300 border border-purple-200 dark:border-purple-800/30">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Meeting Satuan
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Check all students
    function checkAll() {
        document.querySelectorAll('input[name^="attendances["]').forEach(checkbox => {
            checkbox.checked = true;
        });
    }

    // Uncheck all students
    function uncheckAll() {
        document.querySelectorAll('input[name^="attendances["]').forEach(checkbox => {
            checkbox.checked = false;
        });
    }

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Ctrl + Shift + H untuk check all
        if (e.ctrlKey && e.shiftKey && e.key === 'H') {
            e.preventDefault();
            checkAll();
        }
        // Ctrl + Shift + T untuk uncheck all
        if (e.ctrlKey && e.shiftKey && e.key === 'T') {
            e.preventDefault();
            uncheckAll();
        }
    });
</script>
@endpush
