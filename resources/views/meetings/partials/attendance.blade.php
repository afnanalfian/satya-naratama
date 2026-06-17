<x-toggle-section title="📝 Absensi">

    @if($meeting->attendances->isEmpty())
        {{-- No Attendance State --}}
        <div class="mt-5 rounded-xl border border-gray-200 bg-gray-50 p-6 text-center dark:border-gray-700 dark:bg-gray-800/50">
            <div class="mx-auto max-w-md">
                <div class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-700">
                    <svg class="h-6 w-6 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <h3 class="mb-2 text-sm font-semibold text-gray-900 dark:text-white">Belum Ada Absensi</h3>
                <p class="mb-4 text-sm text-gray-600 dark:text-gray-300">
                    Absensi belum dibuat untuk pertemuan ini. Buat absensi untuk mencatat kehadiran siswa.
                </p>
                <a href="{{ route('meeting.attendance.index', $meeting) }}"
                   class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Buat Absensi
                </a>
            </div>
        </div>
    @else
        @php
            $hadir = $meeting->attendances->where('is_present', true);
            $total = $meeting->attendances->count();
            $percentage = $total > 0 ? round(($hadir->count() / $total) * 100) : 0;
        @endphp

        {{-- Attendance Summary --}}
        <div class="mt-5 space-y-6">
            {{-- Stats Card --}}
            <div class="rounded-xl border border-gray-200 bg-white p-4 dark:border-gray-700 dark:bg-gray-800 sm:p-6">
                <div class="mb-4">
                    <h3 class="text-sm font-medium text-gray-900 dark:text-white">Ringkasan Kehadiran</h3>
                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                    {{-- Present Count --}}
                    <div class="rounded-lg border border-gray-100 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-900">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-medium text-gray-500 dark:text-gray-400">HADIR</p>
                                <p class="mt-1 text-2xl font-bold text-gray-900 dark:text-white">{{ $hadir->count() }}</p>
                            </div>
                            <div class="rounded-full bg-green-100 p-2 dark:bg-green-900/30">
                                <svg class="h-5 w-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- Total Students --}}
                    <div class="rounded-lg border border-gray-100 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-900">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-medium text-gray-500 dark:text-gray-400">TOTAL SISWA</p>
                                <p class="mt-1 text-2xl font-bold text-gray-900 dark:text-white">{{ $total }}</p>
                            </div>
                            <div class="rounded-full bg-blue-100 p-2 dark:bg-blue-900/30">
                                <svg class="h-5 w-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5 0c-.828 0-1.5.672-1.5 1.5s.672 1.5 1.5 1.5 1.5-.672 1.5-1.5-.672-1.5-1.5-1.5z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- Percentage --}}
                    <div class="rounded-lg border border-gray-100 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-900">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-medium text-gray-500 dark:text-gray-400">PERSENTASE</p>
                                <p class="mt-1 text-2xl font-bold text-gray-900 dark:text-white">{{ $percentage }}%</p>
                            </div>
                            <div class="rounded-full bg-purple-100 p-2 dark:bg-purple-900/30">
                                <svg class="h-5 w-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Attendance List --}}
            <div class="rounded-xl border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800">
                <div class="border-b border-gray-200 px-4 py-3 dark:border-gray-700 sm:px-6">
                    <h3 class="text-sm font-medium text-gray-900 dark:text-white">Daftar Siswa Hadir</h3>
                </div>

                @if($hadir->isEmpty())
                    <div class="p-8 text-center">
                        <div class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-700">
                            <svg class="h-6 w-6 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-300">Belum ada siswa yang hadir</p>
                    </div>
                @else
                    <div class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($hadir as $att)
                            <div class="flex items-center justify-between px-4 py-3 transition-colors hover:bg-gray-50 dark:hover:bg-gray-700/50 sm:px-6">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-full bg-green-100 text-xs font-medium text-green-800 dark:bg-green-900/30 dark:text-green-300">
                                        {{ substr($att->user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $att->user->name }}</p>
                                        @if($att->check_in_time)
                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                Hadir pada {{ \Carbon\Carbon::parse($att->check_in_time)->format('H:i') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="inline-flex items-center gap-1 rounded-full bg-green-100 px-2 py-1 text-xs font-medium text-green-800 dark:bg-green-900/30 dark:text-green-300">
                                        <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                        Hadir
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Action Button --}}
            <div class="flex justify-end">
                <a href="{{ route('meeting.attendance.index', $meeting) }}"
                   class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600 dark:focus:ring-offset-gray-900">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Kelola Absensi
                </a>
            </div>
        </div>
    @endif

</x-toggle-section>
