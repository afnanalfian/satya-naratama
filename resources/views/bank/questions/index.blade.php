@extends('layouts.app')

@section('content')

{{-- HEADER --}}
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-bold text-azwara-darker dark:text-azwara-lighter">
            Soal: {{ $material->name }}
        </h1>
        <p class="text-sm text-gray-600 dark:text-gray-300">Total Soal: {{ $questions->total() }}</p>
    </div>

    @role('admin|tentor')
        <a href="{{ route('bank.material.questions.create', $material) }}"
           class="px-4 py-2 bg-azwara-darker text-white rounded-xl hover:bg-azwara-medium transition">
            + Tambah Soal
        </a>
    @endrole
</div>
{{-- Tombol Kembali --}}
<div class="mb-4">
    <a href="{{ route('bank.category.materials.index', $material->category) }}"
        class="inline-flex items-center gap-2
                text-sm font-medium
                text-azwara-darkest dark:text-azwara-lighter
                hover:text-primary
                transition">

        {{-- Panah kiri --}}
        <svg xmlns="http://www.w3.org/2000/svg"
                class="w-4 h-4"
                fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M15 19l-7-7 7-7" />
        </svg>

        Kembali
    </a>
</div>

{{-- FILTERS --}}
<div class="mb-6 bg-azwara-lightest dark:bg-azwara-darker rounded-xl p-4 shadow-sm">
    <form method="GET" class="flex flex-wrap gap-3 items-end">

        {{-- Test Type --}}
        <div>
            <label class="block text-sm dark:text-azwara-lightest font-medium mb-1">
                Tipe Tes
            </label>
            <select name="test_type" class="rounded-lg border p-2 text-sm">
                <option value="">Semua Tes</option>
                <option value="general" {{ request('test_type') === 'general' ? 'selected' : '' }}>No Type</option>
                <option value="tiu" {{ request('test_type') === 'tiu' ? 'selected' : '' }}>TIU</option>
                <option value="twk" {{ request('test_type') === 'twk' ? 'selected' : '' }}>TWK</option>
                <option value="tkp" {{ request('test_type') === 'tkp' ? 'selected' : '' }}>TKP</option>
                <option value="tpa" {{ request('test_type') === 'tpa' ? 'selected' : '' }}>TPA</option>
                <option value="tbi" {{ request('test_type') === 'tbi' ? 'selected' : '' }}>TBI</option>
                <option value="mtk_stis" {{ request('test_type') === 'mtk_stis' ? 'selected' : '' }}>Matematika STIS</option>
                <option value="mtk_tka" {{ request('test_type') === 'mtk_tka' ? 'selected' : '' }}>Matematika TKA</option>
            </select>
        </div>

        {{-- Tipe Soal --}}
        <div>
            <label class="block text-sm dark:text-azwara-lightest font-medium mb-1">
                Tipe Soal
            </label>
            <select name="type" class="rounded-lg border p-2 text-sm">
                <option value="">Semua Tipe</option>
                <option value="mcq" {{ request('type') === 'mcq' ? 'selected' : '' }}>
                    Pilihan Ganda (1 Benar)
                </option>
                <option value="mcma" {{ request('type') === 'mcma' ? 'selected' : '' }}>
                    Pilihan Ganda (Banyak Benar)
                </option>
                <option value="truefalse" {{ request('type') === 'truefalse' ? 'selected' : '' }}>
                    Benar / Salah
                </option>
                <option value="short_answer" {{ request('type') === 'short_answer' ? 'selected' : '' }}>
                    Isian Singkat
                </option>
                <option value="compound" {{ request('type') === 'compound' ? 'selected' : '' }}>
                    Soal Kompleks
                </option>
            </select>
        </div>

        {{-- Search --}}
        <div>
            <label class="block text-sm dark:text-azwara-lightest font-medium mb-1">
                Pencarian
            </label>
            <input type="text"
                   name="q"
                   value="{{ request('q') }}"
                   placeholder="Cari soal..."
                   class="rounded-lg border p-2 text-sm">
        </div>
        <div>
            <label class="block text-sm dark:text-azwara-lightest font-medium mb-1">
                Tampilkan
            </label>
            <select name="per_page"
                    onchange="this.form.submit()"
                    class="rounded-lg border p-2 text-sm">
                @foreach([10,20,50,100] as $size)
                    <option value="{{ $size }}"
                        {{ request('per_page', 10) == $size ? 'selected' : '' }}>
                        {{ $size }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Actions --}}
        <div>
            <button type="submit"
                    class="px-4 py-2 bg-azwara-medium text-white rounded-lg hover:bg-azwara-dark">
                Filter
            </button>

            <a href="{{ route('bank.material.questions.index', $material) }}"
               class="px-4 py-2 dark:text-azwara-lighter bg-gray-200 dark:bg-gray-700 rounded-lg ml-2">
                Reset
            </a>
        </div>

    </form>
</div>

{{-- QUESTION LIST --}}
<div class="space-y-6">

@forelse ($questions as $index => $q)
    <div class="bg-azwara-lightest dark:bg-azwara-darker border border-gray-200 dark:border-azwara-darkest
                rounded-xl p-6 shadow-sm">

        {{-- HEADER --}}
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100">
                Soal {{ ($questions->currentPage() - 1) * $questions->perPage() + ($index + 1) }}
            </h2>

            <div class="flex items-center gap-2">
                <span class="px-3 py-1.5 text-sm rounded-lg dark:text-white dark:bg-azwara-light bg-primary/10 text-primary font-semibold">
                    {{ \App\Models\Question::TYPES[$q->type] ?? strtoupper($q->type) }}
                </span>

                @if($q->type === 'compound')
                <span class="text-xs text-gray-500 dark:text-gray-400">
                    ({{ $q->subItems->count() }} sub)
                </span>
                @endif
                {{-- USED COUNT --}}
                <span class="text-xs px-2 py-1 rounded-lg
                            bg-gray-100 dark:bg-white/10
                            text-gray-600 dark:text-gray-300">
                    Dipakai {{ $q->exam_questions_count }}x
                </span>
            </div>
        </div>

        {{-- QUESTION IMAGE --}}
        @if ($q->image)
            <div class="mb-4">
                <img
                    src="{{ asset('storage/' . $q->image) }}"
                    alt="Gambar Soal"
                    class="max-h-[320px] mx-auto rounded-xl shadow
                        object-contain bg-white dark:bg-gray-800 p-2">
            </div>
        @endif

        {{-- QUESTION TEXT --}}
        <div class="prose dark:prose-invert max-w-none leading-relaxed mb-4 text-gray-800 dark:text-gray-100">
            {!! $q->question_text !!}
        </div>
        {{-- OPTIONS (TKP) --}}
        @if ($q->test_type === 'tkp')
            @php
                $maxWeight = $q->options->max('weight');
            @endphp

            <div class="space-y-3 mb-4">
                @foreach ($q->options as $opt)

                    @php
                        $isBest = $opt->weight === $maxWeight;
                    @endphp

                    <div class="border rounded-lg px-4 py-3
                                flex items-start justify-between gap-3
                                transition
                                {{ $isBest
                                    ? 'bg-green-50 border-green-400 dark:bg-green-900/30'
                                    : 'hover:bg-gray-50 dark:hover:bg-gray-700'
                                }}">

                        {{-- KONTEN OPSI --}}
                        <div class="flex-1 text-gray-800 dark:text-gray-100 space-y-2">

                            {{-- LABEL + TEKS --}}
                            <div class="flex items-start gap-2">
                                <span class="font-semibold">
                                    {{ $opt->label }}.
                                </span>

                                <div class="prose dark:prose-invert max-w-none">
                                    {!! $opt->option_text !!}
                                </div>
                            </div>

                        </div>

                        {{-- BOBOT --}}
                        <div class="text-right min-w-[80px]">
                            <div class="text-lg font-bold
                                {{ $isBest
                                    ? 'text-green-700 dark:text-green-400'
                                    : 'text-gray-700 dark:text-gray-300'
                                }}">
                                {{ $opt->weight }}
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        @endif

        {{-- OPTIONS (MCQ & MCMA) --}}
        @if (in_array($q->type, ['mcq', 'mcma']) && $q->test_type !== 'tkp')
            <div class="space-y-3 mb-4">

            @foreach ($q->options as $opt)
                <div class="border rounded-lg px-4 py-3
                            flex items-start justify-between gap-3
                            hover:bg-gray-50 dark:hover:bg-gray-700 transition">

                    {{-- KONTEN OPSI --}}
                    <div class="flex-1 text-gray-800 dark:text-gray-100 space-y-2">

                        {{-- LABEL + TEKS (SATU BARIS) --}}
                        <div class="flex items-start gap-2">
                            <span class="font-semibold">
                                {{ $opt->label }}.
                            </span>

                            <div class="prose dark:prose-invert max-w-none">
                                {!! $opt->option_text !!}
                            </div>
                        </div>

                        {{-- GAMBAR (DI BAWAH TEKS) --}}
                        @if ($opt->image)
                            <img
                                src="{{ asset('storage/' . $opt->image) }}"
                                alt="Gambar Opsi"
                                class="max-h-[200px] rounded-lg object-contain">
                        @endif
                    </div>

                    {{-- INDIKATOR BENAR --}}
                    @if ($opt->is_correct)
                        <span class="text-green-600 font-bold text-sm mt-1">✔</span>
                    @endif
                </div>
            @endforeach

            </div>
        @endif


        {{-- TRUE / FALSE --}}
        @if ($q->type === 'truefalse')
            <div class="space-y-3 mb-4">

                @foreach ($q->options as $i => $opt)
                    <div class="border rounded-lg px-4 py-3
                                flex items-center justify-between">

                        <div class="text-base text-gray-800 dark:text-gray-100">
                            {!! $opt->option_text !!}
                        </div>

                        @if ($opt->is_correct)
                            <span class="text-green-600 font-bold text-sm">✔</span>
                        @endif

                    </div>
                @endforeach

            </div>
        @endif

        {{-- SHORT ANSWER --}}
        @if ($q->type === 'short_answer')
            <div class="mb-4">
                <div class="bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-700
                            rounded-lg p-4">
                    <h3 class="font-semibold text-blue-800 dark:text-blue-300 mb-2">
                        Jawaban Isian Singkat:
                    </h3>

                    @php
                        $correctOptions = $q->options->where('is_correct', true);
                    @endphp

                    @if($correctOptions->count() > 0)
                        @php
                            $primaryAnswer = $correctOptions->first();
                        @endphp

                        @if($primaryAnswer)
                            <p class="text-gray-800 dark:text-gray-100 font-medium">
                                Jawaban utama: <span class="text-green-600 dark:text-green-400">{{ $primaryAnswer->option_text }}</span>
                            </p>
                        @endif

                        @if($correctOptions->count() > 1)
                            <div class="mt-2">
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Semua kemungkinan jawaban:</p>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($correctOptions as $answer)
                                        <span class="px-2 py-1 bg-gray-100 dark:text-azwara-lighter dark:bg-gray-700 rounded text-sm">
                                            {{ $answer->option_text }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @else
                        <p class="text-gray-500 dark:text-gray-400">Belum ada jawaban</p>
                    @endif
                </div>
            </div>
        @endif

        {{-- COMPOUND --}}
        @if ($q->type === 'compound')
            <div class="space-y-4 mb-4">
                <div class="bg-purple-50 dark:bg-purple-900/30 border border-purple-200 dark:border-purple-700
                            rounded-lg p-4">
                    <h3 class="font-semibold text-purple-800 dark:text-purple-300 mb-3">
                        Sub Pertanyaan ({{ $q->subItems->count() }}):
                    </h3>

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
                                        <div class="mt-2 text-sm dark:text-azwara-lightest">
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
                                                        <span class="px-2 py-0.5 text-xs dark:text-white bg-gray-100 dark:bg-gray-700 rounded">
                                                            {{ $answer->answer_text }}
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
            </div>
        @endif


        {{-- TOGGLE PEMBAHASAN --}}
        <div x-data="{ open: false }">

            <button @click="open = !open"
                class="px-4 py-2 rounded-lg bg-azwara-medium text-white hover:bg-azwara-dark transition">

                <span x-show="!open">Lihat Pembahasan</span>
                <span x-show="open">Tutup Pembahasan</span>

            </button>

            <div x-show="open" x-collapse class="mt-4 border-t pt-4">

            @if($q->type === 'short_answer')
                <div class="mb-4">
                    <h3 class="font-semibold text-gray-900 dark:text-gray-100 mb-2">Jawaban Isian Singkat:</h3>
                    @php
                        $correctOptions = $q->options->where('is_correct', true);
                        $primaryAnswer = $correctOptions->first();
                    @endphp

                    @if($primaryAnswer)
                        <div class="bg-green-50 dark:bg-green-900/30 p-3 rounded-lg border border-green-200 dark:border-green-700">
                            <p class="text-gray-800 dark:text-gray-100 font-medium">{{ $primaryAnswer->option_text }}</p>
                            @if($correctOptions->count() > 1)
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                    <em>Jawaban lain juga diterima (case-insensitive, spasi diabaikan)</em>
                                </p>
                            @endif
                        </div>
                    @endif
                </div>
                @elseif($q->type === 'compound')
                    <div class="mb-4">
                        <h3 class="font-semibold text-gray-900 dark:text-gray-100 mb-2">Jawaban Sub Pertanyaan:</h3>
                        <div class="space-y-3">
                            @foreach($q->subItems->sortBy('order') as $subItem)
                                <div class="border rounded-lg p-3">
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="font-medium text-gray-800 dark:text-gray-100">{{ $subItem->label }}. {{ $subItem->prompt }}</span>
                                    </div>

                                    @if($subItem->type === 'truefalse')
                                        @php
                                            $correctAnswer = $subItem->answers->first();
                                        @endphp
                                        @if($correctAnswer)
                                            <div class="text-sm {{ $correctAnswer->boolean_answer ? 'text-green-600' : 'text-red-600' }}">
                                                Jawaban: <span class="font-semibold">{{ $correctAnswer->boolean_answer ? 'BENAR' : 'SALAH' }}</span>
                                            </div>
                                        @endif
                                    @elseif($subItem->type === 'short_answer')
                                        @php
                                            $primaryAnswer = $subItem->answers->where('is_primary', true)->first();
                                        @endphp
                                        @if($primaryAnswer)
                                            <div class="text-sm">
                                                Jawaban: <span class="font-semibold text-green-600">{{ $primaryAnswer->answer_text }}</span>
                                                @if($subItem->answers->count() > 1)
                                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                        <em>Jawaban lain juga diterima</em>
                                                    </p>
                                                @endif
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <h3 class="font-semibold text-gray-900 dark:text-gray-100 mb-2">Jawaban benar:</h3>
                    <ul class="list-disc ml-6 text-gray-900 dark:text-gray-100 mb-4">
                    @foreach ($q->options->where('is_correct', true) as $i => $opt)
                        <li>{!! $opt->option_text !!}</li>
                    @endforeach
                    </ul>
                @endif

                @if($q->explanation)
                    <h3 class="font-semibold text-gray-900 dark:text-gray-100 mb-2">Pembahasan:</h3>
                    <div class="prose dark:prose-invert max-w-none text-gray-800 dark:text-gray-100">
                        {!! $q->explanation !!}
                    </div>
                @else
                    <p class="text-gray-500 dark:text-gray-400 italic">Belum ada pembahasan</p>
                @endif

            </div>
        </div>


        {{-- ACTION BUTTONS --}}
        @role('admin|tentor')
        <div class="flex justify-end gap-3 mt-6 border-t pt-4">

            {{-- EDIT --}}
            <a href="{{ route('bank.question.edit', $q) }}"
                class="px-4 py-2 rounded-lg bg-azwara-medium/10
                    text-azwara-darker dark:text-azwara-lighter hover:bg-azwara-medium/20 transition">
                Edit
            </a>

            {{-- DELETE (SweetAlert) --}}
            <form method="POST"
                action="{{ route('bank.question.delete', $q) }}"
                class="sweet-confirm"
                data-message="Yakin ingin menghapus soal ini? Tindakan ini tidak dapat dibatalkan.">
                @csrf
                @method('DELETE')

                <button type="submit"
                    class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">
                    Hapus
                </button>
            </form>

        </div>
        @endrole

    </div>
@empty
    <div class="text-center py-10 text-gray-500 dark:text-gray-400">
        <p class="text-lg font-semibold">Belum ada soal</p>
        <p class="text-sm mt-1">
            Silakan tambahkan soal untuk materi ini.
        </p>
    </div>
@endforelse

</div>


{{-- PAGINATION --}}
<div class="mt-6">
    {{ $questions->links() }}
</div>


@endsection

@include('bank.questions.js.index')
