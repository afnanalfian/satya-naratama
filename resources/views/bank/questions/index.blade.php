@extends('layouts.app')

@section('content')
<div class="py-6 md:py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Navigation --}}
        <nav class="flex items-center gap-2 text-sm mb-6">
            <a href="{{ route('bank.category.index') }}"
               class="text-secondary-500 hover:text-primary-600 dark:text-secondary-400 dark:hover:text-primary-300 transition-colors group">
                <span class="inline-flex items-center gap-1.5">
                    <svg class="w-4 h-4 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Kategori
                </span>
            </a>
            <span class="text-secondary-300 dark:text-secondary-600">/</span>
            <a href="{{ route('bank.category.materials.index', $material->category) }}"
               class="text-secondary-500 hover:text-primary-600 dark:text-secondary-400 dark:hover:text-primary-300 transition-colors group">
                {{ $material->category->name }}
            </a>
            <span class="text-secondary-300 dark:text-secondary-600">/</span>
            <a href="{{ route('bank.material.questions.index', $material) }}"
               class="text-primary-600 dark:text-primary-300 font-medium">
                {{ $material->name }}
            </a>
        </nav>

        {{-- Header --}}
        <div class="relative overflow-hidden rounded-2xl md:rounded-3xl bg-white dark:bg-primary-900/40 border border-primary-100 dark:border-primary-800/30 p-6 md:p-8 mb-6 md:mb-8">
            <div class="absolute top-0 right-0 w-64 h-64 bg-primary-500/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/4"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-accent-500/5 rounded-full blur-3xl translate-y-1/2 -translate-x-1/4"></div>

            <div class="relative flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="p-3 rounded-xl bg-primary-500/10 text-primary-600 dark:bg-primary-400/10 dark:text-primary-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl md:text-2xl font-bold text-primary-900 dark:text-white tracking-tight">
                            {{ $material->name }}
                        </h1>
                        <p class="text-sm text-secondary-500 dark:text-secondary-400 mt-0.5">
                            {{ $questions->total() }} soal • {{ $material->category->name }}
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-primary-100 text-primary-700 dark:bg-primary-800/30 dark:text-primary-300 border border-primary-200 dark:border-primary-700/30">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Total: {{ $questions->total() }}
                    </span>
                    @role('admin|tentor')
                    <a href="{{ route('bank.material.questions.create', $material) }}"
                       class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-secondary-600 hover:bg-secondary-700 text-white font-medium transition-all duration-200 hover:shadow-xl hover:shadow-secondary-500/30 hover:scale-[1.02]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Tambah Soal
                    </a>
                    @endrole
                </div>
            </div>
        </div>

        {{-- Filters --}}
        <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 p-4 md:p-5 mb-6 shadow-sm">
            <form method="GET" class="flex flex-wrap gap-3 items-end">
                {{-- Test Type --}}
                <div>
                    <label class="block text-xs font-medium text-secondary-500 dark:text-secondary-400 mb-1">
                        Tipe Tes
                    </label>
                    <select name="test_type"
                            class="px-3 py-2 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-100 text-sm focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200 appearance-none">
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

                {{-- Question Type --}}
                <div>
                    <label class="block text-xs font-medium text-secondary-500 dark:text-secondary-400 mb-1">
                        Tipe Soal
                    </label>
                    <select name="type"
                            class="px-3 py-2 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-100 text-sm focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200 appearance-none">
                        <option value="">Semua Tipe</option>
                        <option value="mcq" {{ request('type') === 'mcq' ? 'selected' : '' }}>Pilihan Ganda (1 Benar)</option>
                        <option value="mcma" {{ request('type') === 'mcma' ? 'selected' : '' }}>Pilihan Ganda (Banyak Benar)</option>
                        <option value="truefalse" {{ request('type') === 'truefalse' ? 'selected' : '' }}>Benar / Salah</option>
                        <option value="short_answer" {{ request('type') === 'short_answer' ? 'selected' : '' }}>Isian Singkat</option>
                        <option value="compound" {{ request('type') === 'compound' ? 'selected' : '' }}>Soal Kompleks</option>
                    </select>
                </div>

                {{-- Search --}}
                <div class="flex-1 min-w-[150px]">
                    <label class="block text-xs font-medium text-secondary-500 dark:text-secondary-400 mb-1">
                        Pencarian
                    </label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" name="q" value="{{ request('q') }}"
                               placeholder="Cari soal..."
                               class="w-full pl-9 pr-4 py-2 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-100 placeholder-secondary-400 text-sm focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200">
                    </div>
                </div>

                {{-- Per Page --}}
                <div>
                    <label class="block text-xs font-medium text-secondary-500 dark:text-secondary-400 mb-1">
                        Tampilkan
                    </label>
                    <select name="per_page" onchange="this.form.submit()"
                            class="px-3 py-2 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-100 text-sm focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200 appearance-none">
                        @foreach([10,20,50,100] as $size)
                            <option value="{{ $size }}" {{ request('per_page', 10) == $size ? 'selected' : '' }}>
                                {{ $size }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Actions --}}
                <div class="flex gap-2">
                    <button type="submit"
                            class="px-5 py-2 rounded-xl bg-primary-600 hover:bg-primary-700 text-white font-medium text-sm transition-all duration-200 hover:shadow-lg hover:shadow-primary-500/25 active:scale-[0.98]">
                        Filter
                    </button>
                    <a href="{{ route('bank.material.questions.index', $material) }}"
                       class="px-5 py-2 rounded-xl border border-primary-200 dark:border-primary-700/50 text-secondary-600 dark:text-secondary-400 hover:bg-primary-50 dark:hover:bg-primary-800/20 transition-all duration-200 text-sm font-medium">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        {{-- Question List --}}
        @if($questions->count() > 0)
        <div class="space-y-4">
            @foreach ($questions as $index => $q)
            <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-200">

                {{-- Question Header --}}
                <div class="px-6 py-4 border-b border-primary-100 dark:border-primary-800/30 bg-primary-50/30 dark:bg-primary-900/20 flex flex-wrap items-center justify-between gap-3">
                    <div class="flex items-center gap-3">
                        <span class="text-sm font-semibold text-primary-700 dark:text-primary-300">
                            Soal {{ ($questions->currentPage() - 1) * $questions->perPage() + ($index + 1) }}
                        </span>
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-100 text-primary-700 dark:bg-primary-800/30 dark:text-primary-300 border border-primary-200 dark:border-primary-700/30">
                            {{ \App\Models\Question::TYPES[$q->type] ?? strtoupper($q->type) }}
                        </span>
                        @if($q->type === 'compound')
                        <span class="text-xs text-secondary-500 dark:text-secondary-400">
                            ({{ $q->subItems->count() }} sub)
                        </span>
                        @endif
                        @if($q->test_type && $q->test_type !== 'general')
                        <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-secondary-100 text-secondary-700 dark:bg-secondary-800/30 dark:text-secondary-300 border border-secondary-200 dark:border-secondary-700/30">
                            {{ strtoupper($q->test_type) }}
                        </span>
                        @endif
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-xs px-2.5 py-1 rounded-lg bg-secondary-100 dark:bg-secondary-800/30 text-secondary-600 dark:text-secondary-300">
                            Dipakai {{ $q->exam_questions_count }}x
                        </span>
                    </div>
                </div>

                {{-- Question Body --}}
                <div class="px-6 py-5">
                    {{-- Question Image --}}
                    @if ($q->image)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $q->image) }}" alt="Gambar Soal"
                             class="max-h-[320px] mx-auto rounded-xl shadow-sm object-contain bg-primary-50/50 dark:bg-primary-800/20 p-2">
                    </div>
                    @endif

                    {{-- Question Text --}}
                    <div class="prose dark:prose-invert max-w-none leading-relaxed mb-4 text-primary-800 dark:text-primary-100">
                        {!! $q->question_text !!}
                    </div>

                    {{-- TKP Options --}}
                    @if ($q->test_type === 'tkp')
                        @php $maxWeight = $q->options->max('weight'); @endphp
                        <div class="space-y-2 mb-4">
                            @foreach ($q->options as $opt)
                                @php $isBest = $opt->weight === $maxWeight; @endphp
                                <div class="rounded-xl border px-4 py-3 flex items-start justify-between gap-3 transition
                                            {{ $isBest ? 'bg-emerald-50 border-emerald-400 dark:bg-emerald-900/30 dark:border-emerald-700/50' : 'hover:bg-primary-50 dark:hover:bg-primary-800/20 border-primary-200 dark:border-primary-700/30' }}">
                                    <div class="flex-1 text-primary-800 dark:text-primary-100 space-y-2">
                                        <div class="flex items-start gap-2">
                                            <span class="font-semibold">{{ $opt->label }}.</span>
                                            <div class="prose dark:prose-invert max-w-none">{!! $opt->option_text !!}</div>
                                        </div>
                                    </div>
                                    <div class="text-right min-w-[60px]">
                                        <div class="text-lg font-bold {{ $isBest ? 'text-emerald-700 dark:text-emerald-400' : 'text-secondary-700 dark:text-secondary-300' }}">
                                            {{ $opt->weight }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    {{-- MCQ & MCMA Options --}}
                    @if (in_array($q->type, ['mcq', 'mcma']) && $q->test_type !== 'tkp')
                        <div class="space-y-2 mb-4">
                            @foreach ($q->options as $opt)
                                <div class="rounded-xl border border-primary-200 dark:border-primary-700/30 px-4 py-3 flex items-start justify-between gap-3 hover:bg-primary-50 dark:hover:bg-primary-800/20 transition">
                                    <div class="flex-1 text-primary-800 dark:text-primary-100 space-y-2">
                                        <div class="flex items-start gap-2">
                                            <span class="font-semibold">{{ $opt->label }}.</span>
                                            <div class="prose dark:prose-invert max-w-none">{!! $opt->option_text !!}</div>
                                        </div>
                                        @if ($opt->image)
                                            <img src="{{ asset('storage/' . $opt->image) }}" alt="Gambar Opsi" class="max-h-[200px] rounded-lg object-contain">
                                        @endif
                                    </div>
                                    @if ($opt->is_correct)
                                        <span class="text-emerald-600 font-bold text-sm mt-1">✔</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif

                    {{-- True/False --}}
                    @if ($q->type === 'truefalse')
                        <div class="space-y-2 mb-4">
                            @foreach ($q->options as $opt)
                                <div class="rounded-xl border border-primary-200 dark:border-primary-700/30 px-4 py-3 flex items-center justify-between hover:bg-primary-50 dark:hover:bg-primary-800/20 transition">
                                    <div class="text-base text-primary-800 dark:text-primary-100">{!! $opt->option_text !!}</div>
                                    @if ($opt->is_correct)
                                        <span class="text-emerald-600 font-bold text-sm">✔</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif

                    {{-- Short Answer --}}
                    @if ($q->type === 'short_answer')
                        @php $correctOptions = $q->options->where('is_correct', true); @endphp
                        <div class="mb-4 rounded-xl bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800/30 p-4">
                            <h3 class="font-semibold text-blue-800 dark:text-blue-300 mb-2">Jawaban Isian Singkat:</h3>
                            @if($correctOptions->count() > 0)
                                @php $primaryAnswer = $correctOptions->first(); @endphp
                                @if($primaryAnswer)
                                    <p class="text-primary-800 dark:text-primary-100 font-medium">
                                        Jawaban utama: <span class="text-emerald-600 dark:text-emerald-400">{{ $primaryAnswer->option_text }}</span>
                                    </p>
                                @endif
                                @if($correctOptions->count() > 1)
                                    <div class="mt-2">
                                        <p class="text-sm text-secondary-600 dark:text-secondary-400 mb-1">Semua kemungkinan jawaban:</p>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($correctOptions as $answer)
                                                <span class="px-2 py-1 bg-primary-100 dark:bg-primary-800/30 text-primary-700 dark:text-primary-300 rounded text-sm">
                                                    {{ $answer->option_text }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            @else
                                <p class="text-secondary-500 dark:text-secondary-400">Belum ada jawaban</p>
                            @endif
                        </div>
                    @endif

                    {{-- Compound --}}
                    @if ($q->type === 'compound')
                        <div class="space-y-4 mb-4">
                            <div class="rounded-xl bg-purple-50 dark:bg-purple-900/20 border border-purple-200 dark:border-purple-800/30 p-4">
                                <h3 class="font-semibold text-purple-800 dark:text-purple-300 mb-3">
                                    Sub Pertanyaan ({{ $q->subItems->count() }}):
                                </h3>
                                <div class="space-y-3">
                                    @foreach($q->subItems->sortBy('order') as $subIndex => $subItem)
                                        <div class="rounded-lg border border-purple-200 dark:border-purple-800/30 p-4 bg-white/50 dark:bg-primary-800/20">
                                            <div class="flex items-start justify-between mb-2">
                                                <div class="font-medium text-primary-800 dark:text-primary-100">
                                                    <span class="text-sm text-secondary-500 dark:text-secondary-400">{{ $subItem->label }}.</span>
                                                    <span class="ml-1">{{ $subItem->prompt }}</span>
                                                </div>
                                                <span class="text-xs px-2 py-0.5 rounded bg-primary-100 dark:bg-primary-800/30 text-primary-700 dark:text-primary-300">
                                                    {{ $subItem->type === 'truefalse' ? 'Benar/Salah' : 'Isian Singkat' }}
                                                </span>
                                            </div>
                                            @if($subItem->type === 'truefalse')
                                                @php $correctAnswer = $subItem->answers->first(); @endphp
                                                @if($correctAnswer)
                                                    <div class="mt-2 text-sm">
                                                        Jawaban: <span class="font-semibold {{ $correctAnswer->boolean_answer ? 'text-emerald-600' : 'text-red-600' }}">
                                                            {{ $correctAnswer->boolean_answer ? 'BENAR' : 'SALAH' }}
                                                        </span>
                                                    </div>
                                                @endif
                                            @elseif($subItem->type === 'short_answer')
                                                @php $primaryAnswer = $subItem->answers->where('is_primary', true)->first(); @endphp
                                                <div class="mt-2">
                                                    @if($primaryAnswer)
                                                        <p class="text-sm text-primary-800 dark:text-primary-100">
                                                            Jawaban utama: <span class="font-medium text-emerald-600 dark:text-emerald-400">{{ $primaryAnswer->answer_text }}</span>
                                                        </p>
                                                    @endif
                                                    @if($subItem->answers->count() > 1)
                                                        <div class="mt-1">
                                                            <p class="text-xs text-secondary-500 dark:text-secondary-400">Semua kemungkinan:</p>
                                                            <div class="flex flex-wrap gap-1 mt-1">
                                                                @foreach($subItem->answers as $answer)
                                                                    <span class="px-2 py-0.5 text-xs bg-primary-100 dark:bg-primary-800/30 text-primary-700 dark:text-primary-300 rounded">
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
                                <p class="text-sm text-secondary-600 dark:text-secondary-400 mt-3 italic">
                                    Catatan: Jika satu sub salah, seluruh soal dianggap salah.
                                </p>
                            </div>
                        </div>
                    @endif

                    {{-- Toggle Explanation --}}
                    <div x-data="{ open: false }" class="mt-4">
                        <button @click="open = !open"
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium transition-all duration-200 hover:shadow-lg hover:shadow-primary-500/25 active:scale-[0.98]">
                            <span x-show="!open">Lihat Pembahasan</span>
                            <span x-show="open">Tutup Pembahasan</span>
                            <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div x-show="open" x-collapse class="mt-4 border-t border-primary-100 dark:border-primary-800/30 pt-4">
                            @if($q->type === 'short_answer')
                                <div class="mb-4">
                                    <h3 class="font-semibold text-primary-800 dark:text-primary-100 mb-2">Jawaban Isian Singkat:</h3>
                                    @php $correctOptions = $q->options->where('is_correct', true); @endphp
                                    @php $primaryAnswer = $correctOptions->first(); @endphp
                                    @if($primaryAnswer)
                                        <div class="rounded-xl bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800/30 p-3">
                                            <p class="text-primary-800 dark:text-primary-100 font-medium">{{ $primaryAnswer->option_text }}</p>
                                            @if($correctOptions->count() > 1)
                                                <p class="text-sm text-secondary-600 dark:text-secondary-400 mt-1 italic">Jawaban lain juga diterima (case-insensitive, spasi diabaikan)</p>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            @elseif($q->type === 'compound')
                                <div class="mb-4">
                                    <h3 class="font-semibold text-primary-800 dark:text-primary-100 mb-2">Jawaban Sub Pertanyaan:</h3>
                                    <div class="space-y-2">
                                        @foreach($q->subItems->sortBy('order') as $subItem)
                                            <div class="rounded-lg border border-primary-200 dark:border-primary-700/30 p-3">
                                                <div class="flex items-center justify-between mb-1">
                                                    <span class="font-medium text-primary-800 dark:text-primary-100">{{ $subItem->label }}. {{ $subItem->prompt }}</span>
                                                </div>
                                                @if($subItem->type === 'truefalse')
                                                    @php $correctAnswer = $subItem->answers->first(); @endphp
                                                    @if($correctAnswer)
                                                        <div class="text-sm {{ $correctAnswer->boolean_answer ? 'text-emerald-600' : 'text-red-600' }}">
                                                            Jawaban: <span class="font-semibold">{{ $correctAnswer->boolean_answer ? 'BENAR' : 'SALAH' }}</span>
                                                        </div>
                                                    @endif
                                                @elseif($subItem->type === 'short_answer')
                                                    @php $primaryAnswer = $subItem->answers->where('is_primary', true)->first(); @endphp
                                                    @if($primaryAnswer)
                                                        <div class="text-sm">
                                                            Jawaban: <span class="font-semibold text-emerald-600">{{ $primaryAnswer->answer_text }}</span>
                                                            @if($subItem->answers->count() > 1)
                                                                <p class="text-xs text-secondary-500 dark:text-secondary-400 mt-1 italic">Jawaban lain juga diterima</p>
                                                            @endif
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <h3 class="font-semibold text-primary-800 dark:text-primary-100 mb-2">Jawaban benar:</h3>
                                <ul class="list-disc ml-6 text-primary-800 dark:text-primary-100 mb-4">
                                    @foreach ($q->options->where('is_correct', true) as $i => $opt)
                                        <li>{!! $opt->option_text !!}</li>
                                    @endforeach
                                </ul>
                            @endif

                            @if($q->explanation)
                                <h3 class="font-semibold text-primary-800 dark:text-primary-100 mb-2">Pembahasan:</h3>
                                <div class="prose dark:prose-invert max-w-none text-primary-800 dark:text-primary-100">
                                    {!! $q->explanation !!}
                                </div>
                            @else
                                <p class="text-secondary-500 dark:text-secondary-400 italic">Belum ada pembahasan</p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Actions --}}
                @role('admin|tentor')
                <div class="px-6 py-4 border-t border-primary-100 dark:border-primary-800/30 bg-primary-50/30 dark:bg-primary-900/20 flex justify-end gap-2">
                    <a href="{{ route('bank.question.edit', $q) }}"
                       class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-medium text-primary-700 dark:text-primary-300 hover:bg-primary-100/50 dark:hover:bg-primary-800/50 transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit
                    </a>
                    <form method="POST" action="{{ route('bank.question.delete', $q) }}"
                          class="sweet-confirm" data-message="Yakin ingin menghapus soal ini? Tindakan ini tidak dapat dibatalkan.">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-medium text-red-600 dark:text-red-400 hover:bg-red-50/50 dark:hover:bg-red-900/20 transition-all duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Hapus
                        </button>
                    </form>
                </div>
                @endrole
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($questions->hasPages())
        <div class="mt-6">
            {{ $questions->links() }}
        </div>
        @endif
        @else
        {{-- Empty State --}}
        <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 p-12 text-center shadow-sm">
            <div class="flex flex-col items-center">
                <div class="w-20 h-20 rounded-full bg-primary-100 dark:bg-primary-800/30 flex items-center justify-center mb-4">
                    <svg class="w-10 h-10 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-primary-800 dark:text-primary-100 mb-2">
                    @if(request('q') || request('type') || request('test_type'))
                        Tidak ditemukan soal
                    @else
                        Belum Ada Soal
                    @endif
                </h3>
                <p class="text-sm text-secondary-500 dark:text-secondary-400 max-w-md">
                    @if(request('q') || request('type') || request('test_type'))
                        Coba dengan filter yang berbeda
                    @else
                        Tambahkan soal pertama untuk materi <strong>{{ $material->name }}</strong>
                    @endif
                </p>
                @role('admin|tentor')
                @if(!request('q') && !request('type') && !request('test_type'))
                <a href="{{ route('bank.material.questions.create', $material) }}"
                   class="inline-flex items-center gap-2 mt-4 px-5 py-2.5 rounded-xl bg-primary-600 hover:bg-primary-700 text-white font-medium transition-all duration-200 hover:shadow-lg hover:shadow-primary-500/25 active:scale-[0.98]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Soal
                </a>
                @endif
                @endrole
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@include('bank.questions.js.index')
