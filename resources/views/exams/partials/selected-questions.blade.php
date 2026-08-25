{{-- ================= SOAL TERPILIH ================= --}}
<div class="rounded-2xl p-6
            border border-azwara-light/30 dark:border-white/10 space-y-4">

    {{-- HEADER --}}
    <div class="flex flex-col gap-4
                md:flex-row md:items-center md:justify-between">

        {{-- LEFT: TITLE --}}
        <div>
            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                Soal Ujian
            </h2>
            <p class="text-xs text-gray-500 mt-1">
                Soal diurut mulai dari yang pertama ditambahkan, tapi dapat diurutkan ulang
            </p>
        </div>

        {{-- RIGHT: ACTIONS --}}
        <div class="flex flex-wrap items-center gap-3">

            {{-- PER PAGE SELECT --}}
            <form method="GET" class="flex items-center gap-2 text-sm">
                <label class="text-gray-600 dark:text-gray-300">
                    Tampilkan
                </label>

                <select
                    name="per_page"
                    onchange="this.form.submit()"
                    class="px-3 py-1.5 rounded-lg border
                        bg-white dark:bg-slate-800
                        text-gray-800 dark:text-gray-100
                        border-gray-300 dark:border-white/10 w-20">

                    @foreach ([10, 20, 30, 50, 100] as $size)
                        <option value="{{ $size }}"
                            @selected(request('per_page', 10) == $size)>
                            {{ $size }}
                        </option>
                    @endforeach
                </select>

                <span class="text-gray-600 dark:text-gray-300">
                    soal / halaman
                </span>
            </form>

            {{-- ADD QUESTION --}}
            @if($exam->status === 'inactive')
                <button
                    @click="openAddQuestion = true"
                    class="px-4 py-2 rounded-lg bg-primary text-white
                        hover:bg-primary/90 whitespace-nowrap">
                    Tambah Soal
                </button>
            @endif

        </div>
    </div>

    @if($exam->questions->isEmpty())
        <p class="text-gray-500 dark:text-gray-400">
            Belum ada soal dipilih.
        </p>
    @else

        {{-- ================= SORTABLE WRAPPER ================= --}}
        <div id="sortable-questions" class="space-y-6">
            @foreach ($questions as $i => $pq)
                @php $q = $pq->question; @endphp

                {{-- ================= ITEM ================= --}}
                <div
                    data-id="{{ $pq->id }}"
                    class="relative bg-azwara-lightest dark:bg-secondary
                           border border-gray-200 dark:border-white/10 dark:text-white
                           rounded-xl p-6 shadow-sm">

                    {{-- HEADER --}}
                    <div class="flex items-center justify-between mb-4">
                        <h3
                            data-question-number
                            class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                            Soal {{ $questions->firstItem() + $i }}
                        </h3>

                        <div class="flex items-center gap-3">
                            @php
                                $typeLabels = [
                                    'mcq' => 'Pilihan Ganda (1 Benar)',
                                    'mcma' => 'Pilihan Ganda (Banyak Benar)',
                                    'truefalse' => 'Benar / Salah',
                                    'short_answer' => 'Isian Singkat',
                                    'compound' => 'Soal Kompleks'
                                ];
                            @endphp

                            <span class="px-3 py-1.5 text-sm rounded-lg bg-primary/10 text-primary font-semibold">
                                {{ $typeLabels[$q->type] ?? strtoupper($q->type) }}
                            </span>

                            @if($q->type === 'compound')
                                <span class="text-sm text-gray-500 dark:text-gray-400">
                                    ({{ $q->subItems->count() }} sub)
                                </span>
                            @endif

                            @if($exam->status === 'inactive')
                                <form
                                    method="POST"
                                    action="{{ route('exams.questions.move', [$exam, $pq]) }}"
                                    class="flex items-center gap-2">
                                    @csrf

                                    <label class="text-sm text-gray-500">
                                        Pindah ke:
                                    </label>

                                    <input
                                        type="number"
                                        name="to_order"
                                        min="1"
                                        max="{{ $exam->questions()->count() }}"
                                        value="{{ $pq->order }}"
                                        class="w-20 px-2 py-1 border rounded text-sm">

                                    <button
                                        type="submit"
                                        class="text-xs px-2 py-1 bg-primary text-white rounded">
                                        OK
                                    </button>
                                </form>
                                <form method="POST"
                                    action="{{ route('ajax.exams.questions.detach', $exam) }}"
                                    class="sweet-confirm"
                                    data-message="Yakin ingin menghapus soal ini?">
                                    @csrf
                                    <input type="hidden" name="question_id" value="{{ $q->id }}">

                                    <button type="submit" class="text-red-600 text-sm">
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
                            class="max-h-[320px] mx-auto rounded-xl shadow
                                object-contain bg-azwara-lightest dark:bg-gray-800 p-2">
                    @endif

                    {{-- TEKS SOAL --}}
                    <div class="prose dark:prose-invert max-w-none mb-4">
                        {!! $q->question_text !!}
                    </div>

                    {{-- OPTIONS FOR MCQ/MCMA/TrueFalse --}}
                    @if (in_array($q->type, ['mcq', 'mcma', 'truefalse']))
                        <div class="space-y-3">
                            @foreach ($q->options as $opt)
                                <div class="border border-black rounded-lg px-4 py-3
                                            bg-azwara-lightest dark:bg-white/5
                                            text-gray-800 dark:text-gray-100">

                                    {{-- LABEL + TEKS (SATU BARIS) --}}
                                    <div class="flex items-start gap-2">

                                        @if ($q->type !== 'truefalse')
                                            <span class="font-semibold mt-1 shrink-0">
                                                {{ $opt->label }}.
                                            </span>
                                        @endif

                                        <div class="prose dark:prose-invert max-w-none">
                                            {!! $opt->option_text !!}
                                        </div>

                                        @if ($opt->is_correct)
                                            <span class="ml-2 text-green-600 font-bold">✓</span>
                                        @endif
                                    </div>

                                    {{-- GAMBAR OPSI (DI BAWAH TEKS) --}}
                                    @if ($opt->image)
                                        <div class="mt-3">
                                            <img
                                                src="{{ Storage::url($opt->image) }}"
                                                alt="Gambar opsi"
                                                class="max-h-48 rounded-lg border bg-white p-2 object-contain">
                                        </div>
                                    @endif

                                </div>
                            @endforeach
                        </div>
                    @endif

                    {{-- SHORT ANSWER PREVIEW --}}
                    @if ($q->type === 'short_answer')
                        <div class="bg-blue-50 dark:bg-blue-900/30 rounded-lg p-4 mb-4">
                            <h4 class="font-semibold text-blue-800 dark:text-blue-300 mb-2">
                                Isian Singkat:
                            </h4>

                            @php
                                $correctOptions = $q->options->where('is_correct', true);
                            @endphp

                            @if($correctOptions->count() > 0)
                                @php
                                    $primaryAnswer = $correctOptions->first();
                                @endphp

                                <p class="text-gray-800 dark:text-gray-100 font-medium">
                                    Jawaban utama: <span class="text-green-600 dark:text-green-400">{{ $primaryAnswer->option_text }}</span>
                                </p>

                                @if($correctOptions->count() > 1)
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Semua kemungkinan jawaban:</p>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($correctOptions as $option)
                                                <span class="px-2 py-1 bg-gray-100 dark:bg-gray-700 rounded text-sm">
                                                    {{ $option->option_text }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            @else
                                <p class="text-gray-500 dark:text-gray-400">Belum ada jawaban</p>
                            @endif
                        </div>
                    @endif

                    {{-- COMPOUND QUESTION PREVIEW --}}
                    @if ($q->type === 'compound')
                        <div class="bg-purple-50 dark:bg-purple-900/30 rounded-lg p-4 mb-4">
                            <h4 class="font-semibold text-purple-800 dark:text-purple-300 mb-3">
                                Sub Pertanyaan ({{ $q->subItems->count() }}):
                            </h4>

                            <div class="space-y-4">
                                @foreach($q->subItems->sortBy('order') as $subIndex => $subItem)
                                    <div class="border rounded-lg p-4 bg-white/50 dark:bg-gray-800/50">
                                        <div class="flex items-start justify-between mb-2">
                                            <div class="font-medium text-gray-800 dark:text-gray-100">
                                                <span class="text-sm text-gray-500 dark:text-gray-400">{{ $subItem->label }}.</span>
                                                <span class="ml-1">{{ $subItem->prompt }}</span>
                                            </div>
                                            <span class="text-xs px-2 py-1 rounded bg-gray-100 dark:bg-gray-700">
                                                {{ $subItem->type === 'truefalse' ? 'Benar/Salah' : 'Isian Singkat' }}
                                            </span>
                                        </div>

                                        {{-- Answers for sub item --}}
                                        @if($subItem->type === 'truefalse')
                                            @php
                                                $correctAnswer = $subItem->answers->first();
                                            @endphp
                                            @if($correctAnswer)
                                                <div class="mt-2 text-sm">
                                                    Jawaban:
                                                    <span class="font-semibold {{ $correctAnswer->boolean_answer ? 'text-green-600' : 'text-red-600' }}">
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
                                                    <p class="text-sm text-gray-800 dark:text-gray-100">
                                                        Jawaban utama: <span class="font-medium">{{ $primaryAnswer->answer_text }}</span>
                                                    </p>
                                                @endif

                                                @if($allAnswers->count() > 1)
                                                    <div class="mt-1">
                                                        <p class="text-xs text-gray-500 dark:text-gray-400">Semua kemungkinan:</p>
                                                        <div class="flex flex-wrap gap-1 mt-1">
                                                            @foreach($allAnswers as $answer)
                                                                <span class="px-2 py-0.5 text-xs bg-gray-100 dark:bg-gray-700 rounded">
                                                                    {{ $answer->answer_text }}
                                                                    @if($answer->is_primary)
                                                                        <span class="ml-1 text-green-600">✓</span>
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

                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-3">
                                <em>Catatan: Jika satu sub salah, seluruh soal dianggap salah.</em>
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
