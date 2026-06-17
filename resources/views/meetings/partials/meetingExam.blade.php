<x-toggle-section title="🧪 Evaluasi (Blind Test & Post Test)">
    @php
        $blindExam = $meeting->exams->firstWhere('type', 'blind_test');
        $postExam  = $meeting->exams->firstWhere('type', 'post_test');

        $blindAttempt = auth()->check() && auth()->user()->hasRole('siswa') && $blindExam
            ? $blindExam->attempts->firstWhere('user_id', auth()->id())
            : null;

        $postAttempt = auth()->check() && auth()->user()->hasRole('siswa') && $postExam
            ? $postExam->attempts->firstWhere('user_id', auth()->id())
            : null;
    @endphp

    <div class="mt-6 grid grid-cols-1 gap-4 sm:gap-6 lg:grid-cols-2">
        {{-- Blind Test Card --}}
        <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm transition-all duration-200 hover:shadow-md dark:border-gray-700 dark:bg-gray-800 dark:hover:border-gray-600 sm:p-6">
            <div class="mb-4 flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-900/30">
                    <svg class="h-5 w-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Blind Test</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Tes sebelum materi</p>
                </div>
            </div>

            @if(!$blindExam)
                <div class="space-y-4">
                    <p class="text-sm text-gray-600 dark:text-gray-300">
                        Ujian belum tersedia untuk mengukur pengetahuan awal sebelum pembelajaran.
                    </p>
                    @role('admin|tentor')
                    <button
                        type="button"
                        onclick="openBlindTestModal()"
                        class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Buat Blind Test
                    </button>
                    @endrole
                </div>
            @else
                <div class="mb-6 grid grid-cols-2 gap-4">
                    <div class="rounded-lg border border-gray-100 bg-gray-50 p-3 dark:border-gray-700 dark:bg-gray-900">
                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400">DURASI</p>
                        <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">
                            {{ $blindExam->duration_minutes ?? '0' }} <span class="text-sm font-normal text-gray-500 dark:text-gray-400">menit</span>
                        </p>
                    </div>
                    <div class="rounded-lg border border-gray-100 bg-gray-50 p-3 dark:border-gray-700 dark:bg-gray-900">
                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400">SOAL</p>
                        <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">
                            {{ $blindExam->questions->count() }}
                        </p>
                    </div>
                </div>

                {{-- Admin/Tentor Actions --}}
                @role('admin|tentor')
                <div class="space-y-3">
                    @if($blindExam->status === 'inactive')
                        <div class="flex flex-col gap-2 sm:flex-row">
                            <a href="{{ route('exams.edit', $blindExam) }}"
                               class="inline-flex flex-1 items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit Ujian
                            </a>
                            <form method="POST" action="{{ route('exams.activate', $blindExam) }}" class="flex-1">
                                @csrf
                                <button type="submit"
                                        class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-green-600 px-4 py-2.5 text-sm font-medium text-white transition-colors hover:bg-green-700">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Launch
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('exams.results', $blindExam) }}"
                           class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-gray-100 px-4 py-2.5 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            Hasil & Analisis
                        </a>
                    @endif
                </div>
                @endrole

                {{-- Siswa Actions --}}
                @role('siswa')
                <div class="space-y-4">
                    @if($blindAttempt && $blindAttempt->is_submitted)
                        <div class="rounded-lg border border-green-100 bg-green-50 p-4 dark:border-green-900/30 dark:bg-green-900/20">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-green-800 dark:text-green-300">Skor Anda</p>
                                    <p class="mt-1 text-2xl font-bold text-green-900 dark:text-green-100">{{ $blindAttempt->score }}</p>
                                </div>
                                <div class="rounded-full bg-green-100 p-2 dark:bg-green-800/30">
                                    <svg class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('exams.result.student', $blindExam) }}"
                           class="inline-flex w-full items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            Lihat Pembahasan
                        </a>
                    @elseif($blindExam->status === 'active')
                        <div class="space-y-3">
                            @if(!$blindAttempt)
                                <form method="POST" action="{{ route('exams.start', $blindExam) }}">
                                    @csrf
                                    <button type="submit"
                                            class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white transition-colors hover:bg-blue-700">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Mulai Ujian
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('exams.attempt', $blindExam) }}"
                                   class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white transition-colors hover:bg-blue-700">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                                    </svg>
                                    Lanjutkan Ujian
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
                @endrole
            @endif
        </div>

        {{-- Post Test Card --}}
        <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm transition-all duration-200 hover:shadow-md dark:border-gray-700 dark:bg-gray-800 dark:hover:border-gray-600 sm:p-6">
            <div class="mb-4 flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-purple-100 dark:bg-purple-900/30">
                    <svg class="h-5 w-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Post Test</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Tes setelah materi</p>
                </div>
            </div>

            @if(!$postExam)
                <div class="space-y-4">
                    <p class="text-sm text-gray-600 dark:text-gray-300">
                        Ujian belum tersedia untuk mengukur pemahaman setelah pembelajaran.
                    </p>
                    @role('admin|tentor')
                    <button
                        type="button"
                        onclick="openPostTestModal()"
                        class="inline-flex items-center gap-2 rounded-lg bg-purple-600 px-4 py-2.5 text-sm font-medium text-white transition-colors hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Buat Post Test
                    </button>
                    @endrole
                </div>
            @else
                <div class="mb-6 grid grid-cols-2 gap-4">
                    <div class="rounded-lg border border-gray-100 bg-gray-50 p-3 dark:border-gray-700 dark:bg-gray-900">
                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400">DURASI</p>
                        <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">
                            {{ $postExam->duration_minutes ?? '0' }} <span class="text-sm font-normal text-gray-500 dark:text-gray-400">menit</span>
                        </p>
                    </div>
                    <div class="rounded-lg border border-gray-100 bg-gray-50 p-3 dark:border-gray-700 dark:bg-gray-900">
                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400">SOAL</p>
                        <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">
                            {{ $postExam->questions->count() }}
                        </p>
                    </div>
                </div>

                {{-- Admin/Tentor Actions --}}
                @role('admin|tentor')
                <div class="space-y-3">
                    @if($postExam->status === 'inactive')
                        <div class="flex flex-col gap-2 sm:flex-row">
                            <a href="{{ route('exams.edit', $postExam) }}"
                               class="inline-flex flex-1 items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit Ujian
                            </a>
                            <form method="POST" action="{{ route('exams.activate', $postExam) }}" class="flex-1">
                                @csrf
                                <button type="submit"
                                        class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-green-600 px-4 py-2.5 text-sm font-medium text-white transition-colors hover:bg-green-700">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Launch
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('exams.results', $postExam) }}"
                           class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-gray-100 px-4 py-2.5 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            Hasil & Analisis
                        </a>
                    @endif
                </div>
                @endrole

                {{-- Siswa Actions --}}
                @role('siswa')
                <div class="space-y-4">
                    @if($postAttempt && $postAttempt->is_submitted)
                        <div class="rounded-lg border border-green-100 bg-green-50 p-4 dark:border-green-900/30 dark:bg-green-900/20">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-green-800 dark:text-green-300">Skor Anda</p>
                                    <p class="mt-1 text-2xl font-bold text-green-900 dark:text-green-100">{{ $postAttempt->score }}</p>
                                </div>
                                <div class="rounded-full bg-green-100 p-2 dark:bg-green-800/30">
                                    <svg class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('exams.result.student', $postExam) }}"
                           class="inline-flex w-full items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            Lihat Pembahasan
                        </a>
                    @elseif($postExam->status === 'active')
                        <div class="space-y-3">
                            @if(!$postAttempt)
                                <form method="POST" action="{{ route('exams.start', $postExam) }}">
                                    @csrf
                                    <button type="submit"
                                            class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-purple-600 px-4 py-2.5 text-sm font-medium text-white transition-colors hover:bg-purple-700">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Mulai Ujian
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('exams.attempt', $postExam) }}"
                                   class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-purple-600 px-4 py-2.5 text-sm font-medium text-white transition-colors hover:bg-purple-700">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                                    </svg>
                                    Lanjutkan Ujian
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
                @endrole
            @endif
        </div>
    </div>
</x-toggle-section>
