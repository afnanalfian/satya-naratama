<x-toggle-section title="🧪 Evaluasi">
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

    <div class="mt-5 space-y-4">
        {{-- Blind Test --}}
        <div class="rounded-xl border border-primary-100 dark:border-primary-700/30 bg-white dark:bg-primary-800/20 p-4">
            <div class="flex items-center gap-3 mb-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-900/30">
                    <svg class="h-4 w-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-primary-800 dark:text-primary-100">Blind Test</h4>
                    <p class="text-xs text-secondary-500 dark:text-secondary-400">Tes sebelum materi</p>
                </div>
            </div>

            @if(!$blindExam)
                <p class="text-sm text-secondary-500 dark:text-secondary-400 mb-3">Ujian belum tersedia.</p>
                @role('admin|tentor')
                <button type="button" onclick="openBlindTestModal()"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium transition-all duration-200 hover:shadow-lg hover:shadow-blue-500/25 active:scale-[0.98]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Buat Blind Test
                </button>
                @endrole
            @else
                <div class="flex items-center gap-4 text-sm mb-3">
                    <div>
                        <span class="text-xs text-secondary-500 dark:text-secondary-400">Durasi</span>
                        <p class="font-semibold text-primary-800 dark:text-primary-100">{{ $blindExam->duration_minutes ?? 0 }} menit</p>
                    </div>
                    <div>
                        <span class="text-xs text-secondary-500 dark:text-secondary-400">Soal</span>
                        <p class="font-semibold text-primary-800 dark:text-primary-100">{{ $blindExam->questions->count() }}</p>
                    </div>
                    <div>
                        <span class="text-xs text-secondary-500 dark:text-secondary-400">Status</span>
                        <p class="font-semibold">
                            @if($blindExam->status === 'active')
                                <span class="text-emerald-600 dark:text-emerald-400">Aktif</span>
                            @else
                                <span class="text-secondary-400">Draft</span>
                            @endif
                        </p>
                    </div>
                </div>

                @role('admin|tentor')
                <div class="flex flex-wrap gap-2">
                    @if($blindExam->status === 'inactive')
                        <a href="{{ route('exams.edit', $blindExam) }}"
                           class="inline-flex items-center gap-2 px-3 py-2 rounded-xl border border-primary-200 dark:border-primary-700/50 text-secondary-600 dark:text-secondary-300 hover:bg-primary-50 dark:hover:bg-primary-800/20 text-sm font-medium transition-all duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit
                        </a>
                        <form method="POST" action="{{ route('exams.activate', $blindExam) }}">
                            @csrf
                            <button type="submit"
                                    class="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium transition-all duration-200 hover:shadow-lg hover:shadow-emerald-500/25 active:scale-[0.98]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Launch
                            </button>
                        </form>
                    @else
                        <a href="{{ route('exams.results', $blindExam) }}"
                           class="inline-flex items-center gap-2 px-3 py-2 rounded-xl border border-primary-200 dark:border-primary-700/50 text-secondary-600 dark:text-secondary-300 hover:bg-primary-50 dark:hover:bg-primary-800/20 text-sm font-medium transition-all duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                            Hasil
                        </a>
                    @endif
                </div>
                @endrole

                @role('siswa')
                @if($blindAttempt && $blindAttempt->is_submitted)
                    <div class="rounded-lg bg-emerald-50 dark:bg-emerald-900/20 p-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-emerald-800 dark:text-emerald-300">Skor Anda</span>
                            <span class="text-xl font-bold text-emerald-900 dark:text-emerald-100">{{ $blindAttempt->score }}</span>
                        </div>
                    </div>
                    <a href="{{ route('exams.result.student', $blindExam) }}"
                       class="inline-flex w-full items-center justify-center gap-2 px-4 py-2 rounded-xl border border-primary-200 dark:border-primary-700/50 text-secondary-600 dark:text-secondary-300 hover:bg-primary-50 dark:hover:bg-primary-800/20 text-sm font-medium transition-all duration-200">
                        Lihat Pembahasan
                    </a>
                @elseif($blindExam->status === 'active')
                    @if(!$blindAttempt)
                        <form method="POST" action="{{ route('exams.start', $blindExam) }}">
                            @csrf
                            <button type="submit"
                                    class="inline-flex w-full items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium transition-all duration-200 hover:shadow-lg hover:shadow-blue-500/25 active:scale-[0.98]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Mulai Ujian
                            </button>
                        </form>
                    @else
                        <a href="{{ route('exams.attempt', $blindExam) }}"
                           class="inline-flex w-full items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium transition-all duration-200 hover:shadow-lg hover:shadow-blue-500/25 active:scale-[0.98]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"/>
                            </svg>
                            Lanjutkan
                        </a>
                    @endif
                @endif
                @endrole
            @endif
        </div>

        {{-- Post Test --}}
        <div class="rounded-xl border border-primary-100 dark:border-primary-700/30 bg-white dark:bg-primary-800/20 p-4">
            <div class="flex items-center gap-3 mb-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-purple-100 dark:bg-purple-900/30">
                    <svg class="h-4 w-4 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-primary-800 dark:text-primary-100">Post Test</h4>
                    <p class="text-xs text-secondary-500 dark:text-secondary-400">Tes setelah materi</p>
                </div>
            </div>

            @if(!$postExam)
                <p class="text-sm text-secondary-500 dark:text-secondary-400 mb-3">Ujian belum tersedia.</p>
                @role('admin|tentor')
                <button type="button" onclick="openPostTestModal()"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium transition-all duration-200 hover:shadow-lg hover:shadow-purple-500/25 active:scale-[0.98]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Buat Post Test
                </button>
                @endrole
            @else
                <div class="flex items-center gap-4 text-sm mb-3">
                    <div>
                        <span class="text-xs text-secondary-500 dark:text-secondary-400">Durasi</span>
                        <p class="font-semibold text-primary-800 dark:text-primary-100">{{ $postExam->duration_minutes ?? 0 }} menit</p>
                    </div>
                    <div>
                        <span class="text-xs text-secondary-500 dark:text-secondary-400">Soal</span>
                        <p class="font-semibold text-primary-800 dark:text-primary-100">{{ $postExam->questions->count() }}</p>
                    </div>
                    <div>
                        <span class="text-xs text-secondary-500 dark:text-secondary-400">Status</span>
                        <p class="font-semibold">
                            @if($postExam->status === 'active')
                                <span class="text-emerald-600 dark:text-emerald-400">Aktif</span>
                            @else
                                <span class="text-secondary-400">Draft</span>
                            @endif
                        </p>
                    </div>
                </div>

                @role('admin|tentor')
                <div class="flex flex-wrap gap-2">
                    @if($postExam->status === 'inactive')
                        <a href="{{ route('exams.edit', $postExam) }}"
                           class="inline-flex items-center gap-2 px-3 py-2 rounded-xl border border-primary-200 dark:border-primary-700/50 text-secondary-600 dark:text-secondary-300 hover:bg-primary-50 dark:hover:bg-primary-800/20 text-sm font-medium transition-all duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit
                        </a>
                        <form method="POST" action="{{ route('exams.activate', $postExam) }}">
                            @csrf
                            <button type="submit"
                                    class="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium transition-all duration-200 hover:shadow-lg hover:shadow-emerald-500/25 active:scale-[0.98]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Launch
                            </button>
                        </form>
                    @else
                        <a href="{{ route('exams.results', $postExam) }}"
                           class="inline-flex items-center gap-2 px-3 py-2 rounded-xl border border-primary-200 dark:border-primary-700/50 text-secondary-600 dark:text-secondary-300 hover:bg-primary-50 dark:hover:bg-primary-800/20 text-sm font-medium transition-all duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                            Hasil
                        </a>
                    @endif
                </div>
                @endrole

                @role('siswa')
                @if($postAttempt && $postAttempt->is_submitted)
                    <div class="rounded-lg bg-emerald-50 dark:bg-emerald-900/20 p-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-emerald-800 dark:text-emerald-300">Skor Anda</span>
                            <span class="text-xl font-bold text-emerald-900 dark:text-emerald-100">{{ $postAttempt->score }}</span>
                        </div>
                    </div>
                    <a href="{{ route('exams.result.student', $postExam) }}"
                       class="inline-flex w-full items-center justify-center gap-2 px-4 py-2 rounded-xl border border-primary-200 dark:border-primary-700/50 text-secondary-600 dark:text-secondary-300 hover:bg-primary-50 dark:hover:bg-primary-800/20 text-sm font-medium transition-all duration-200">
                        Lihat Pembahasan
                    </a>
                @elseif($postExam->status === 'active')
                    @if(!$postAttempt)
                        <form method="POST" action="{{ route('exams.start', $postExam) }}">
                            @csrf
                            <button type="submit"
                                    class="inline-flex w-full items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium transition-all duration-200 hover:shadow-lg hover:shadow-purple-500/25 active:scale-[0.98]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Mulai Ujian
                            </button>
                        </form>
                    @else
                        <a href="{{ route('exams.attempt', $postExam) }}"
                           class="inline-flex w-full items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium transition-all duration-200 hover:shadow-lg hover:shadow-purple-500/25 active:scale-[0.98]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"/>
                            </svg>
                            Lanjutkan
                        </a>
                    @endif
                @endif
                @endrole
            @endif
        </div>
    </div>
</x-toggle-section>
