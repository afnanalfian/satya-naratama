{{-- exams/partials/selected-questions.blade.php --}}
{{-- ================= SOAL TERPILIH ================= --}}
<div class="bg-white dark:bg-neutral-900
            rounded-2xl p-6
            border border-neutral-200 dark:border-neutral-700
            shadow-sm
            space-y-5">

    {{-- HEADER --}}
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <h2 class="text-lg font-semibold text-neutral-900 dark:text-white">
                Soal Ujian
            </h2>
            <p class="text-xs text-neutral-500 dark:text-neutral-400 mt-0.5">
                {{ $exam->questions->count() }} soal terpilih • diurutkan berdasarkan urutan
            </p>
        </div>

        {{-- RIGHT: ACTIONS --}}
        <div class="flex flex-wrap items-center gap-3">
            {{-- PER PAGE SELECT --}}
            <form method="GET" class="flex items-center gap-2 text-sm">
                <label class="text-neutral-600 dark:text-neutral-400">
                    Tampilkan
                </label>

                <select
                    name="per_page"
                    onchange="this.form.submit()"
                    class="px-3 py-1.5 rounded-xl border
                        bg-white dark:bg-neutral-900
                        text-neutral-900 dark:text-white
                        border-neutral-200 dark:border-neutral-700
                        focus:ring-2 focus:ring-primary/20 focus:border-primary
                        transition-all duration-200
                        w-20">

                    @foreach ([10, 20, 30, 50, 100] as $size)
                        <option value="{{ $size }}"
                            @selected(request('per_page', 10) == $size)>
                            {{ $size }}
                        </option>
                    @endforeach
                </select>

                <span class="text-neutral-600 dark:text-neutral-400">
                    soal / halaman
                </span>
            </form>

            {{-- ADD QUESTION --}}
            @if($exam->status === 'inactive')
                <button
                    @click="openAddQuestion = true"
                    class="inline-flex items-center px-4 py-2 rounded-xl
                        bg-primary text-white text-sm font-medium
                        hover:bg-primary-600
                        active:scale-[0.98]
                        transition-all duration-200
                        shadow-sm hover:shadow-md">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Tambah Soal
                </button>
            @endif
        </div>
    </div>

    @if($exam->questions->isEmpty())
        <div class="text-center py-12">
            <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-neutral-100 dark:bg-neutral-800 flex items-center justify-center">
                <svg class="w-8 h-8 text-neutral-400 dark:text-neutral-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <p class="text-neutral-600 dark:text-neutral-400">
                Belum ada soal dipilih.
            </p>
            @if($exam->status === 'inactive')
                <p class="text-sm text-neutral-500 dark:text-neutral-500 mt-1">
                    Klik "Tambah Soal" untuk memilih soal dari bank soal
                </p>
            @endif
        </div>
    @else

        {{-- ================= SORTABLE WRAPPER ================= --}}
        <div id="sortable-questions" class="space-y-4">
            @foreach ($questions as $i => $pq)
                @php $q = $pq->question; @endphp

                {{-- ================= ITEM ================= --}}
                <div
                    data-id="{{ $pq->id }}"
                    class="relative bg-neutral-50 dark:bg-neutral-800/50
                           border border-neutral-200 dark:border-neutral-700
                           rounded-xl p-5
                           hover:border-neutral-300 dark:hover:border-neutral-600
                           transition-colors duration-200">

                    {{-- HEADER --}}
                    <div class="flex flex-wrap items-start justify-between gap-3 mb-4">
                        <div class="flex items-center gap-3">
                            <span class="flex items-center justify-center w-8 h-8 rounded-full
                                bg-primary/10 text-primary dark:bg-primary/20 dark:text-primary-300
                                text-sm font-bold">
                                {{ $questions->firstItem() + $i }}
                            </span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                bg-primary/10 text-primary dark:bg-primary/20 dark:text-primary-300">
                                {{ $typeLabels[$q->type] ?? strtoupper($q->type) }}
                            </span>
                            @if($q->type === 'compound')
                                <span class="text-xs text-neutral-500 dark:text-neutral-400">
                                    ({{ $q->subItems->count() }} sub)
                                </span>
                            @endif
                        </div>

                        <div class="flex items-center gap-2">
                            @if($exam->status === 'inactive')
                                <form
                                    method="POST"
                                    action="{{ route('exams.questions.move', [$exam, $pq]) }}"
                                    class="flex items-center gap-2">
                                    @csrf
                                    <label class="text-xs text-neutral-500 dark:text-neutral-400">
                                        Pindah ke:
                                    </label>
                                    <input
                                        type="number"
                                        name="to_order"
                                        min="1"
                                        max="{{ $exam->questions()->count() }}"
                                        value="{{ $pq->order }}"
                                        class="w-16 px-2 py-1 rounded-lg border
                                            border-neutral-200 dark:border-neutral-700
                                            bg-white dark:bg-neutral-900
                                            text-sm text-neutral-900 dark:text-white
                                            focus:ring-2 focus:ring-primary/20 focus:border-primary">
                                    <button
                                        type="submit"
                                        class="px-2 py-1 text-xs font-medium
                                            bg-primary text-white rounded-lg
                                            hover:bg-primary-600
                                            transition-colors duration-200">
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
                                        class="p-1.5 rounded-lg text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors duration-200"
                                        title="Hapus soal">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>

                    {{-- GAMBAR SOAL --}}
                    @if ($q->image)
                        <div class="mb-4">
                            <img
                                src="{{ Storage::url($q->image) }}"
                                alt="Gambar Soal"
                                class="max-h-[320px] mx-auto rounded-xl shadow-sm
                                    object-contain bg-white dark:bg-neutral-900 p-3 border border-neutral-200 dark:border-neutral-700">
                        </div>
                    @endif

                    {{-- TEKS SOAL --}}
                    <div class="prose prose-sm dark:prose-invert max-w-none mb-4">
                        {!! $q->question_text !!}
                    </div>

                    {{-- OPTIONS FOR MCQ/MCMA/TrueFalse --}}
                    @if (in_array($q->type, ['mcq', 'mcma', 'truefalse']))
                        <div class="space-y-2">
                            @foreach ($q->options as $opt)
                                <div class="flex items-start gap-3 p-3 rounded-xl
                                            bg-white dark:bg-neutral-900
                                            border border-neutral-200 dark:border-neutral-700
                                            text-neutral-800 dark:text-neutral-200">
                                    @if ($q->type !== 'truefalse')
                                        <span class="font-semibold text-sm mt-0.5 shrink-0 text-neutral-500 dark:text-neutral-400">
                                            {{ $opt->label }}.
                                        </span>
                                    @endif

                                    <div class="flex-1 prose prose-sm dark:prose-invert max-w-none">
                                        {!! $opt->option_text !!}
                                    </div>

                                    @if ($opt->is_correct)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">
                                            ✓ Benar
                                        </span>
                                    @endif
                                </div>

                                {{-- GAMBAR OPSI --}}
                                @if ($opt->image)
                                    <div class="ml-8 mt-1">
                                        <img
                                            src="{{ Storage::url($opt->image) }}"
                                            alt="Gambar opsi"
                                            class="max-h-40 rounded-lg border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 p-2 object-contain">
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif

                    {{-- SHORT ANSWER PREVIEW --}}
                    @if ($q->type === 'short_answer')
                        <div class="bg-blue-50 dark:bg-blue-900/20 rounded-xl p-4 border border-blue-200 dark:border-blue-800">
                            <h4 class="text-sm font-semibold text-blue-800 dark:text-blue-300 mb-2 flex items-center">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Isian Singkat
                            </h4>

                            @php
                                $correctOptions = $q->options->where('is_correct', true);
                            @endphp

                            @if($correctOptions->count() > 0)
                                @php
                                    $primaryAnswer = $correctOptions->first();
                                @endphp
                                <p class="text-sm text-neutral-800 dark:text-neutral-200">
                                    Jawaban utama: <span class="font-semibold text-green-600 dark:text-green-400">{{ $primaryAnswer->option_text }}</span>
                                </p>

                                @if($correctOptions->count() > 1)
                                    <div class="mt-2">
                                        <p class="text-xs text-neutral-500 dark:text-neutral-400 mb-1">Semua kemungkinan jawaban:</p>
                                        <div class="flex flex-wrap gap-1.5">
                                            @foreach($correctOptions as $option)
                                                <span class="px-2.5 py-1 text-xs bg-white dark:bg-neutral-800 border border-neutral-200 dark:border-neutral-700 rounded-lg">
                                                    {{ $option->option_text }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            @else
                                <p class="text-sm text-neutral-500 dark:text-neutral-400">Belum ada jawaban</p>
                            @endif
                        </div>
                    @endif

                    {{-- COMPOUND QUESTION PREVIEW --}}
                    @if ($q->type === 'compound')
                        <div class="bg-purple-50 dark:bg-purple-900/20 rounded-xl p-4 border border-purple-200 dark:border-purple-800">
                            <h4 class="text-sm font-semibold text-purple-800 dark:text-purple-300 mb-3 flex items-center">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                                Sub Pertanyaan ({{ $q->subItems->count() }})
                            </h4>

                            <div class="space-y-3">
                                @foreach($q->subItems->sortBy('order') as $subIndex => $subItem)
                                    <div class="bg-white dark:bg-neutral-900 rounded-lg p-3 border border-purple-100 dark:border-purple-900/30">
                                        <div class="flex items-start justify-between mb-2">
                                            <div class="text-sm font-medium text-neutral-800 dark:text-neutral-200">
                                                <span class="text-neutral-500 dark:text-neutral-400">{{ $subItem->label }}.</span>
                                                <span class="ml-1">{{ $subItem->prompt }}</span>
                                            </div>
                                            <span class="text-xs px-2 py-0.5 rounded-full bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-400">
                                                {{ $subItem->type === 'truefalse' ? 'Benar/Salah' : 'Isian Singkat' }}
                                            </span>
                                        </div>

                                        {{-- Answers for sub item --}}
                                        @if($subItem->type === 'truefalse')
                                            @php
                                                $correctAnswer = $subItem->answers->first();
                                            @endphp
                                            @if($correctAnswer)
                                                <div class="text-sm">
                                                    <span class="text-neutral-500 dark:text-neutral-400">Jawaban:</span>
                                                    <span class="font-semibold {{ $correctAnswer->boolean_answer ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                                        {{ $correctAnswer->boolean_answer ? 'BENAR' : 'SALAH' }}
                                                    </span>
                                                </div>
                                            @endif
                                        @elseif($subItem->type === 'short_answer')
                                            @php
                                                $primaryAnswer = $subItem->answers->where('is_primary', true)->first();
                                                $allAnswers = $subItem->answers;
                                            @endphp
                                            <div>
                                                @if($primaryAnswer)
                                                    <p class="text-sm text-neutral-700 dark:text-neutral-300">
                                                        Jawaban utama: <span class="font-semibold text-green-600 dark:text-green-400">{{ $primaryAnswer->answer_text }}</span>
                                                    </p>
                                                @endif

                                                @if($allAnswers->count() > 1)
                                                    <div class="mt-1">
                                                        <p class="text-xs text-neutral-500 dark:text-neutral-400">Semua kemungkinan:</p>
                                                        <div class="flex flex-wrap gap-1 mt-1">
                                                            @foreach($allAnswers as $answer)
                                                                <span class="px-2 py-0.5 text-xs bg-neutral-100 dark:bg-neutral-800 rounded">
                                                                    {{ $answer->answer_text }}
                                                                    @if($answer->is_primary)
                                                                        <span class="ml-0.5 text-green-600 dark:text-green-400">✓</span>
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

                            <p class="text-xs text-neutral-500 dark:text-neutral-400 mt-3">
                                <svg class="w-3.5 h-3.5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Jika satu sub salah, seluruh soal dianggap salah.
                            </p>
                        </div>
                    @endif

                </div>
            @endforeach
        </div>
    @endif

    {{-- PAGINATION --}}
    @if($questions->hasPages())
        <div class="pt-4 border-t border-neutral-200 dark:border-neutral-700">
            {{ $questions->links() }}
        </div>
    @endif
</div>

@php
$typeLabels = [
    'mcq' => 'Pilihan Ganda (1 Benar)',
    'mcma' => 'Pilihan Ganda (Banyak Benar)',
    'truefalse' => 'Benar / Salah',
    'short_answer' => 'Isian Singkat',
    'compound' => 'Soal Kompleks'
];
@endphp
