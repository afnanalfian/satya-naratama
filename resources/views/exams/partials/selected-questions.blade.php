{{-- ================= SOAL TERPILIH ================= --}}
<div class="rounded-2xl overflow-hidden
            bg-white dark:bg-primary-950
            border border-neutral-200 dark:border-white/10
            shadow-sm">

    {{-- HEADER --}}
    <div class="flex flex-col gap-4 px-6 py-5
                md:flex-row md:items-center md:justify-between
                border-b border-neutral-200 dark:border-white/10
                bg-neutral-50 dark:bg-white/[0.03]">

        {{-- LEFT: TITLE --}}
        <div>
            <h2 class="text-base font-semibold text-primary-900 dark:text-primary-50">
                Soal Ujian
            </h2>
            <p class="text-xs text-neutral-700 dark:text-neutral-600 mt-0.5">
                Soal diurut mulai dari yang pertama ditambahkan, tapi dapat diurutkan ulang
            </p>
        </div>

        {{-- RIGHT: ACTIONS --}}
        <div class="flex flex-wrap items-center gap-3">

            {{-- PER PAGE SELECT --}}
            <form method="GET" class="flex items-center gap-2 text-sm">
                <label class="text-neutral-700 dark:text-neutral-500 whitespace-nowrap">
                    Tampilkan
                </label>

                <select
                    name="per_page"
                    onchange="this.form.submit()"
                    class="px-3 py-2 rounded-lg w-20 text-sm
                        border border-neutral-300 dark:border-white/10
                        bg-white dark:bg-white/5
                        text-neutral-900 dark:text-neutral-100
                        shadow-sm
                        focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20
                        transition">

                    @foreach ([10, 20, 30, 50, 100] as $size)
                        <option value="{{ $size }}"
                            @selected(request('per_page', 10) == $size)>
                            {{ $size }}
                        </option>
                    @endforeach
                </select>

                <span class="text-neutral-700 dark:text-neutral-500 whitespace-nowrap">
                    soal / halaman
                </span>
            </form>

            {{-- ADD QUESTION --}}
            @if($exam->status === 'inactive')
                <button
                    @click="openAddQuestion = true"
                    class="inline-flex items-center gap-2
                        px-4 py-2.5 rounded-xl bg-primary-600 text-white text-sm font-semibold
                        shadow-sm hover:bg-primary-700 active:bg-primary-800
                        focus:outline-none focus:ring-2 focus:ring-primary-500/40
                        whitespace-nowrap transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14m-7-7h14"/>
                    </svg>
                    Tambah Soal
                </button>
            @endif

        </div>
    </div>

    <div class="p-6 space-y-4">

    @if($exam->questions->isEmpty())
        <div class="flex flex-col items-center gap-3 py-16 text-center">
            <div class="w-16 h-16 rounded-2xl
                        bg-neutral-50 dark:bg-white/5
                        border border-neutral-200 dark:border-white/10
                        flex items-center justify-center
                        text-neutral-600 dark:text-neutral-600">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <p class="text-base font-semibold text-primary-900 dark:text-primary-50">
                Belum ada soal dipilih.
            </p>
            <p class="text-sm text-neutral-700 dark:text-neutral-500">
                Tambahkan soal dari bank soal untuk mulai menyusun ujian
            </p>
        </div>
    @else

        {{-- ================= SORTABLE WRAPPER ================= --}}
        <div id="sortable-questions" class="space-y-5">
            @foreach ($questions as $i => $pq)
                @php $q = $pq->question; @endphp

                {{-- ================= ITEM ================= --}}
                <div
                    data-id="{{ $pq->id }}"
                    class="relative bg-white dark:bg-white/[0.03]
                           border border-neutral-200 dark:border-white/10
                           text-neutral-900 dark:text-neutral-100
                           rounded-2xl p-6 shadow-sm
                           hover:border-neutral-300 dark:hover:border-white/20
                           transition-colors">

                    {{-- HEADER --}}
                    <div class="flex flex-wrap items-center justify-between gap-3 mb-5
                                pb-4 border-b border-neutral-200 dark:border-white/10">
                        <h3
                            data-question-number
                            class="flex items-center gap-2.5 text-base font-bold tracking-tight text-primary-900 dark:text-primary-50">
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg
                                         bg-primary-50 dark:bg-primary-500/15
                                         text-primary-700 dark:text-primary-200
                                         text-sm font-bold tabular-nums
                                         ring-1 ring-inset ring-primary-600/15 dark:ring-primary-400/20">
                                {{ $questions->firstItem() + $i }}
                            </span>
                            Soal {{ $questions->firstItem() + $i }}
                        </h3>

                        <div class="flex flex-wrap items-center gap-3">
                            @php
                                $typeLabels = [
                                    'mcq' => 'Pilihan Ganda (1 Benar)',
                                    'mcma' => 'Pilihan Ganda (Banyak Benar)',
                                    'truefalse' => 'Benar / Salah',
                                    'short_answer' => 'Isian Singkat',
                                    'compound' => 'Soal Kompleks'
                                ];
                            @endphp

                            <span class="px-3 py-1.5 text-xs font-semibold rounded-lg
                                         bg-primary-50 dark:bg-primary-500/15
                                         text-primary-700 dark:text-primary-200
                                         ring-1 ring-inset ring-primary-600/15 dark:ring-primary-400/20">
                                {{ $typeLabels[$q->type] ?? strtoupper($q->type) }}
                            </span>

                            @if($q->type === 'compound')
                                <span class="text-xs text-neutral-700 dark:text-neutral-500">
                                    ({{ $q->subItems->count() }} sub)
                                </span>
                            @endif

                            @if($exam->status === 'inactive')
                                <form
                                    method="POST"
                                    action="{{ route('exams.questions.move', [$exam, $pq]) }}"
                                    class="flex items-center gap-2">
                                    @csrf

                                    <label class="text-xs text-neutral-700 dark:text-neutral-500 whitespace-nowrap">
                                        Pindah ke:
                                    </label>

                                    <input
                                        type="number"
                                        name="to_order"
                                        min="1"
                                        max="{{ $exam->questions()->count() }}"
                                        value="{{ $pq->order }}"
                                        class="w-16 px-2.5 py-1.5 rounded-lg text-sm tabular-nums
                                               border border-neutral-300 dark:border-white/10
                                               bg-white dark:bg-white/5
                                               text-neutral-900 dark:text-neutral-100
                                               focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20
                                               transition">

                                    <button
                                        type="submit"
                                        class="px-2.5 py-1.5 text-xs font-semibold rounded-lg
                                               bg-primary-600 text-white
                                               hover:bg-primary-700 transition">
                                        OK
                                    </button>
                                </form>

                                <form method="POST"
                                    action="{{ route('ajax.exams.questions.detach', $exam) }}"
                                    class="sweet-confirm"
                                    data-message="Yakin ingin menghapus soal ini?">
                                    @csrf
                                    <input type="hidden" name="question_id" value="{{ $q->id }}">

                                    <button type="submit"
                                        class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg
                                               text-xs font-semibold
                                               text-red-600 dark:text-red-400
                                               hover:bg-red-50 dark:hover:bg-red-500/10
                                               transition">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>

                    {{-- GAMBAR SOAL --}}
                    @if ($q->image)
                        <img
                            src="{{ Storage::url($q->image) }}"
                            alt="Gambar Soal"
                            class="max-h-[320px] mx-auto rounded-xl mb-4
                                object-contain
                                bg-neutral-50 dark:bg-white/5
                                border border-neutral-200 dark:border-white/10 p-2">
                    @endif

                    {{-- TEKS SOAL --}}
                    <div class="prose prose-sm dark:prose-invert max-w-none mb-5">
                        {!! $q->question_text !!}
                    </div>

                    {{-- OPTIONS FOR MCQ/MCMA/TrueFalse --}}
                    @if (in_array($q->type, ['mcq', 'mcma', 'truefalse']))
                        <div class="space-y-2.5">
                            @foreach ($q->options as $opt)
                                <div class="rounded-xl px-4 py-3 border transition-colors
                                            {{ $opt->is_correct
                                                ? 'border-primary-300 dark:border-primary-400/30 bg-primary-50/60 dark:bg-primary-500/10'
                                                : 'border-neutral-200 dark:border-white/10 bg-neutral-50/60 dark:bg-white/[0.03]' }}
                                            text-neutral-800 dark:text-neutral-200">

                                    {{-- LABEL + TEKS (SATU BARIS) --}}
                                    <div class="flex items-start gap-2.5">

                                        @if ($q->type !== 'truefalse')
                                            <span class="inline-flex items-center justify-center flex-shrink-0
                                                         w-6 h-6 rounded-md text-xs font-bold
                                                         {{ $opt->is_correct
                                                            ? 'bg-primary-100 text-primary-700 dark:bg-primary-500/25 dark:text-primary-200'
                                                            : 'bg-neutral-200/70 text-neutral-800 dark:bg-white/10 dark:text-neutral-300' }}">
                                                {{ $opt->label }}
                                            </span>
                                        @endif

                                        <div class="prose prose-sm dark:prose-invert max-w-none flex-1">
                                            {!! $opt->option_text !!}
                                        </div>

                                        @if ($opt->is_correct)
                                            <span class="ml-2 flex-shrink-0 inline-flex items-center justify-center
                                                         w-5 h-5 rounded-full bg-primary-600 text-white">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                                </svg>
                                            </span>
                                        @endif
                                    </div>

                                    {{-- GAMBAR OPSI (DI BAWAH TEKS) --}}
                                    @if ($opt->image)
                                        <div class="mt-3">
                                            <img
                                                src="{{ Storage::url($opt->image) }}"
                                                alt="Gambar opsi"
                                                class="max-h-48 rounded-lg object-contain p-2
                                                       bg-white dark:bg-white/5
                                                       border border-neutral-200 dark:border-white/10">
                                        </div>
                                    @endif

                                </div>
                            @endforeach
                        </div>
                    @endif

                    {{-- SHORT ANSWER PREVIEW --}}
                    @if ($q->type === 'short_answer')
                        <div class="rounded-xl p-5 mb-4
                                    bg-secondary-50 dark:bg-secondary-500/10
                                    border border-secondary-200 dark:border-secondary-400/20">
                            <h4 class="text-xs font-semibold uppercase tracking-[0.1em] mb-3
                                       text-secondary-700 dark:text-secondary-200">
                                Isian Singkat
                            </h4>

                            @php
                                $correctOptions = $q->options->where('is_correct', true);
                            @endphp

                            @if($correctOptions->count() > 0)
                                @php
                                    $primaryAnswer = $correctOptions->first();
                                @endphp

                                <p class="text-sm text-neutral-800 dark:text-neutral-200 font-medium">
                                    Jawaban utama:
                                    <span class="font-semibold text-primary-700 dark:text-primary-300">{{ $primaryAnswer->option_text }}</span>
                                </p>

                                @if($correctOptions->count() > 1)
                                    <div class="mt-3">
                                        <p class="text-xs text-neutral-700 dark:text-neutral-500 mb-1.5">Semua kemungkinan jawaban:</p>
                                        <div class="flex flex-wrap gap-1.5">
                                            @foreach($correctOptions as $option)
                                                <span class="px-2.5 py-1 rounded-md text-xs
                                                             bg-white dark:bg-white/10
                                                             border border-neutral-200 dark:border-white/10
                                                             text-neutral-800 dark:text-neutral-300">
                                                    {{ $option->option_text }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            @else
                                <p class="text-sm text-neutral-700 dark:text-neutral-500">Belum ada jawaban</p>
                            @endif
                        </div>
                    @endif

                    {{-- COMPOUND QUESTION PREVIEW --}}
                    @if ($q->type === 'compound')
                        <div class="rounded-xl p-5 mb-4
                                    bg-accent-50/60 dark:bg-accent-500/10
                                    border border-accent-200 dark:border-accent-400/20">
                            <h4 class="text-xs font-semibold uppercase tracking-[0.1em] mb-4
                                       text-accent-700 dark:text-accent-200">
                                Sub Pertanyaan ({{ $q->subItems->count() }})
                            </h4>

                            <div class="space-y-3">
                                @foreach($q->subItems->sortBy('order') as $subIndex => $subItem)
                                    <div class="rounded-xl p-4
                                                bg-white dark:bg-white/5
                                                border border-neutral-200 dark:border-white/10">
                                        <div class="flex items-start justify-between gap-3 mb-2">
                                            <div class="font-medium text-sm text-neutral-900 dark:text-neutral-100">
                                                <span class="text-neutral-700 dark:text-neutral-500">{{ $subItem->label }}.</span>
                                                <span class="ml-1">{{ $subItem->prompt }}</span>
                                            </div>
                                            <span class="flex-shrink-0 text-[11px] px-2 py-1 rounded-md
                                                         bg-neutral-100 dark:bg-white/10
                                                         text-neutral-800 dark:text-neutral-300">
                                                {{ $subItem->type === 'truefalse' ? 'Benar/Salah' : 'Isian Singkat' }}
                                            </span>
                                        </div>

                                        {{-- Answers for sub item --}}
                                        @if($subItem->type === 'truefalse')
                                            @php
                                                $correctAnswer = $subItem->answers->first();
                                            @endphp
                                            @if($correctAnswer)
                                                <div class="mt-2 text-sm text-neutral-700 dark:text-neutral-400">
                                                    Jawaban:
                                                    <span class="font-semibold {{ $correctAnswer->boolean_answer ? 'text-primary-700 dark:text-primary-300' : 'text-red-600 dark:text-red-400' }}">
                                                        {{ $correctAnswer->boolean_answer ? 'BENAR' : 'SALAH' }}
                                                    </span>
                                                </div>
                                            @endif
                                        @elseif($subItem->type === 'short_answer')
                                            @php
                                                $primaryAnswer = $subItem->answers->where('is_primary', true)->first();
                                                $allAnswers = $subItem->answers;
                                            @endphp
                                            <div class="mt-2">
                                                @if($primaryAnswer)
                                                    <p class="text-sm text-neutral-800 dark:text-neutral-200">
                                                        Jawaban utama: <span class="font-semibold">{{ $primaryAnswer->answer_text }}</span>
                                                    </p>
                                                @endif

                                                @if($allAnswers->count() > 1)
                                                    <div class="mt-2">
                                                        <p class="text-xs text-neutral-700 dark:text-neutral-500">Semua kemungkinan:</p>
                                                        <div class="flex flex-wrap gap-1.5 mt-1.5">
                                                            @foreach($allAnswers as $answer)
                                                                <span class="inline-flex items-center gap-1 px-2 py-1 text-xs rounded-md
                                                                             bg-neutral-100 dark:bg-white/10
                                                                             text-neutral-800 dark:text-neutral-300">
                                                                    {{ $answer->answer_text }}
                                                                    @if($answer->is_primary)
                                                                        <span class="text-primary-600 dark:text-primary-400">✓</span>
                                                                    @endif
                                                                </span>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>

                            <p class="text-xs text-neutral-700 dark:text-neutral-500 mt-4 italic">
                                Catatan: Jika satu sub salah, seluruh soal dianggap salah.
                            </p>
                        </div>
                    @endif

                </div>
            @endforeach
        </div>
    @endif
    <div class="mt-6">
        {{ $questions->links() }}
    </div>

    </div>
</div>
