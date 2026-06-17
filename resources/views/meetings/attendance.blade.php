@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto space-y-6">

        {{-- =====================
        HEADER
        ====================== --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                        <svg class="inline-block w-6 h-6 mr-2 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Absensi Pertemuan
                    </h1>

                    <div class="mt-2 space-y-1">
                        <p class="text-lg font-medium text-gray-700 dark:text-gray-300">
                            {{ $meeting->title }}
                        </p>

                        @if ($meeting->course)
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            <span class="font-medium">Kelas:</span> {{ $meeting->course->name }}
                        </p>
                        @endif

                        @if ($meeting->scheduled_at)
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            <svg class="inline-block w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            {{ $meeting->scheduled_at->translatedFormat('l, d F Y • H:i') }} WITA
                        </p>
                        @endif

                        {{-- ELIGIBILITY INFO --}}
                        <div class="flex items-center gap-2 mt-2">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Hanya siswa dengan akses
                            </span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    {{-- STATISTICS --}}
                    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg px-4 py-3">
                        <div class="text-sm font-medium text-blue-800 dark:text-blue-300">Siswa Eligible</div>
                        <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">
                            {{ number_format($eligibleStudents->total()) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- =====================
        SEARCH & FILTER
        ====================== --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
            <form method="GET" action="{{ route('meeting.attendance.index', $meeting) }}"
                  class="flex flex-col md:flex-row gap-4">

                <div class="flex-1">
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text"
                               name="search"
                               value="{{ $search }}"
                               placeholder="Cari nama siswa dengan akses..."
                               class="w-full pl-10 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg
                                      bg-white dark:bg-gray-700 text-gray-900 dark:text-white
                                      focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <div class="flex gap-2">
                    <button type="submit"
                            class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg
                                   transition-colors flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Cari
                    </button>

                    @if($search)
                    <a href="{{ route('meeting.attendance.index', $meeting) }}"
                       class="px-6 py-3 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600
                              text-gray-700 dark:text-gray-300 font-medium rounded-lg transition-colors
                              flex items-center gap-2">
                        Reset
                    </a>
                    @endif
                </div>
            </form>

            {{-- QUICK STATS --}}
            <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm font-medium text-green-800 dark:text-green-300">Hadir</div>
                            <div class="text-2xl font-bold text-green-600 dark:text-green-400">
                                {{ $presentCount }}
                            </div>
                        </div>
                        <div class="h-12 w-12 bg-green-100 dark:bg-green-800 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm font-medium text-red-800 dark:text-red-300">Tidak Hadir</div>
                            <div class="text-2xl font-bold text-red-600 dark:text-red-400">
                                {{ $absentCount }}
                            </div>
                        </div>
                        <div class="h-12 w-12 bg-red-100 dark:bg-red-800 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm font-medium text-blue-800 dark:text-blue-300">Total Eligible</div>
                            <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">
                                {{ number_format($eligibleStudents->total()) }}
                            </div>
                        </div>
                        <div class="h-12 w-12 bg-blue-100 dark:bg-blue-800 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-8a8.5 8.5 0 11-17 0 8.5 8.5 0 0117 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- =====================
        FORM ABSENSI
        ====================== --}}
        <form method="POST" action="{{ route('meeting.attendance.store', $meeting) }}"
              class="space-y-4 bg-white dark:bg-gray-800 p-6 rounded-xl border border-gray-200 dark:border-gray-700">

            @csrf

            {{-- ACTION BAR --}}
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4 p-4 bg-gray-50 dark:bg-gray-900 rounded-lg">
                <div class="text-sm text-gray-600 dark:text-gray-400">
                    Menampilkan <span class="font-semibold">{{ $eligibleStudents->count() }}</span> dari
                    <span class="font-semibold">{{ $eligibleStudents->total() }}</span> siswa dengan akses
                </div>

                <div class="flex items-center gap-3">
                    <button type="button"
                            onclick="checkAll()"
                            class="px-4 py-2 text-sm font-medium text-blue-600 dark:text-blue-400
                                   hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-lg transition-colors">
                        <svg class="inline-block w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Tandai Semua Hadir
                    </button>

                    <button type="button"
                            onclick="uncheckAll()"
                            class="px-4 py-2 text-sm font-medium text-red-600 dark:text-red-400
                                   hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition-colors">
                        <svg class="inline-block w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Tandai Semua Tidak Hadir
                    </button>
                </div>
            </div>

            {{-- LIST SISWA DENGAN ELIGIBILITY INFO --}}
            <div class="space-y-3">
                @forelse ($eligibleStudents as $student)
                    @php
                        $attendance = $attendances[$student->id] ?? null;
                    @endphp

                    <div class="flex items-center gap-4 p-4 rounded-lg border border-gray-200 dark:border-gray-700
                                hover:bg-gray-50 dark:hover:bg-gray-900/50 transition-colors">

                        {{-- CHECKBOX --}}
                        <div class="flex-shrink-0">
                            <input type="checkbox"
                                   name="attendances[{{ $student->id }}]"
                                   value="1"
                                   id="student_{{ $student->id }}"
                                   @checked(optional($attendance)->is_present)
                                   class="h-5 w-5 rounded border-gray-300 text-blue-600
                                          focus:ring-blue-500 dark:border-gray-600">
                        </div>

                        {{-- STUDENT INFO --}}
                        <label for="student_{{ $student->id }}" class="flex-1 cursor-pointer">
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-2">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2">
                                        <p class="font-medium text-gray-900 dark:text-white">
                                            {{ $student->name }}
                                        </p>

                                        {{-- ELIGIBILITY BADGE --}}
                                        @php
                                            $hasCourseAccess = $student->entitlements()
                                                ->where('entitlement_type', 'course')
                                                ->where('entitlement_id', $meeting->course_id)
                                                ->exists();

                                            $hasMeetingAccess = $student->entitlements()
                                                ->where('entitlement_type', 'meeting')
                                                ->where('entitlement_id', $meeting->id)
                                                ->exists();
                                        @endphp

                                        @if($hasMeetingAccess)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300">
                                                Meeting Satuan
                                            </span>
                                        @elseif($hasCourseAccess)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-300">
                                                Course Access
                                            </span>
                                        @endif

                                        @if(optional($attendance)->is_present)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                                Hadir
                                            </span>
                                        @endif
                                    </div>

                                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                        {{ $student->email }}
                                        @if($student->phone)
                                            • {{ $student->phone }}
                                        @endif
                                    </p>
                                </div>

                                <div class="flex items-center gap-3">
                                    @if($attendance)
                                        <span class="text-sm text-gray-500 dark:text-gray-400">
                                            Diisi: {{ optional($attendance->marked_at)->format('d/m/Y H:i') }}
                                        </span>
                                    @endif

                                    <div class="flex items-center gap-2">
                                        <span class="text-sm font-medium {{ optional($attendance)->is_present ? 'text-green-600' : 'text-red-600' }}">
                                            {{ optional($attendance)->is_present ? '✓ Hadir' : '✗ Tidak Hadir' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </label>
                    </div>
                @empty
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-8a8.5 8.5 0 11-17 0 8.5 8.5 0 0117 0z" />
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">
                            @if($search)
                                Tidak ditemukan siswa dengan akses dan nama "{{ $search }}"
                            @else
                                Tidak ada siswa yang memiliki akses ke meeting ini
                            @endif
                        </h3>
                        <p class="mt-2 text-gray-500 dark:text-gray-400">
                            @if($search)
                                Coba dengan kata kunci lain
                            @else
                                Siswa harus memiliki akses course atau membeli meeting ini
                            @endif
                        </p>
                    </div>
                @endforelse
            </div>

            {{-- PAGINATION --}}
            @if($eligibleStudents->hasPages())
                <div class="pt-6 border-t border-gray-200 dark:border-gray-700">
                    {{ $eligibleStudents->withQueryString()->links() }}
                </div>
            @endif

            {{-- ACTION BUTTONS --}}
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4 pt-6 border-t border-gray-200 dark:border-gray-700">

                <div class="text-sm text-gray-600 dark:text-gray-400">
                    <div class="flex items-center gap-2">
                        <div class="h-3 w-3 rounded-full bg-green-500"></div>
                        <span>Hadir: {{ $presentCount }} siswa</span>
                    </div>
                    <div class="flex items-center gap-2 mt-1">
                        <div class="h-3 w-3 rounded-full bg-red-500"></div>
                        <span>Tidak Hadir: {{ $absentCount }} siswa</span>
                    </div>
                    <div class="flex items-center gap-2 mt-1">
                        <div class="h-3 w-3 rounded-full bg-blue-500"></div>
                        <span>Total Eligible: {{ $eligibleStudents->total() }} siswa</span>
                    </div>
                </div>

                <div class="flex gap-3">
                    <a href="{{ route('meeting.show', $meeting) }}"
                       class="px-6 py-3 rounded-lg border border-gray-300 dark:border-gray-600
                              text-gray-700 dark:text-gray-300 font-medium
                              hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali
                    </a>

                    <button type="submit"
                            class="px-6 py-3 rounded-lg bg-blue-600 hover:bg-blue-700
                                   text-white font-medium transition-colors flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan Absensi
                    </button>
                </div>
            </div>
        </form>

        {{-- INFO BOX --}}
        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-6">
            <div class="flex items-start gap-3">
                <div class="flex-shrink-0">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <h4 class="font-medium text-blue-800 dark:text-blue-300">Informasi Akses</h4>
                    <p class="text-sm text-blue-700 dark:text-blue-400 mt-1">
                        Hanya siswa yang memiliki akses ke course <strong>{{ $meeting->course->name ?? 'ini' }}</strong>
                        atau membeli meeting <strong>{{ $meeting->title }}</strong> secara satuan yang dapat diabsen.
                    </p>
                    <div class="mt-3 flex gap-3">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-300">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Course Access
                        </span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Meeting Satuan
                        </span>
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
