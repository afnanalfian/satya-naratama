@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    {{-- ================= HEADER ================= --}}
    <div class="mb-8">
        <a href="{{ $backUrl }}"
           class="inline-flex items-center gap-2 text-sm font-medium text-azwara-medium hover:text-azwara-light dark:text-azwara-lighter dark:hover:text-white transition-colors mb-4">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>

        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-azwara-darkest dark:text-white">
                Hasil Ujian Anda
            </h1>
            <div class="mt-2 flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-2">
                <p class="text-gray-700 dark:text-gray-300 font-medium">
                    {{ $displayTitle }}
                </p>
                @if ($displaySubtitle)
                    <span class="hidden sm:inline text-gray-500 dark:text-gray-400">•</span>
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ $displaySubtitle }}
                    </p>
                @endif
            </div>
        </div>
    </div>

    {{-- ================= STATISTIK UTAMA ================= --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4 mb-8">
        @php
            $stats = [
                [
                    'label' => 'Benar',
                    'value' => $summary['correct'],
                    'icon' => 'check',
                    'color' => 'text-green-600 dark:text-green-400',
                    'bg' => 'bg-green-100 dark:bg-green-900/20'
                ],
                [
                    'label' => 'Salah',
                    'value' => $summary['wrong'],
                    'icon' => 'x',
                    'color' => 'text-red-600 dark:text-red-400',
                    'bg' => 'bg-red-100 dark:bg-red-900/20'
                ],
            ];

            if ($exam->type === 'tryout' && $exam->test_type === 'mtk_stis') {
                $stats[] = [
                    'label' => 'Kosong',
                    'value' => $summary['empty'],
                    'icon' => 'dash',
                    'color' => 'text-gray-600 dark:text-gray-400',
                    'bg' => 'bg-gray-100 dark:bg-gray-800'
                ];
            }

            $stats = array_merge($stats, [
                [
                    'label' => 'Skor Total',
                    'value' => $attempt->score,
                    'icon' => 'star',
                    'color' => 'text-azwara-medium dark:text-white',
                    'bg' => 'bg-azwara-lightest dark:bg-azwara-medium'
                ],
                [
                    'label' => 'Durasi',
                    'value' => gmdate('H:i:s', $attempt->work_duration_seconds),
                    'icon' => 'clock',
                    'color' => 'text-azwara-medium dark:text-white',
                    'bg' => 'bg-azwara-lightest dark:bg-azwara-medium'
                ],
            ]);

            if ($exam->type === 'tryout' && in_array($exam->test_type, ['skd', 'mtk_stis'])) {
                $stats[] = [
                    'label' => 'Status',
                    'value' => $attempt->is_passed ? 'Lulus' : 'Belum Lulus',
                    'icon' => $attempt->is_passed ? 'trophy' : 'alert',
                    'color' => $attempt->is_passed ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400',
                    'bg' => $attempt->is_passed ? 'bg-green-100 dark:bg-green-900/20' : 'bg-red-100 dark:bg-red-900/20'
                ];
            }
        @endphp

        @foreach ($stats as $stat)
            <div class="rounded-xl border border-azwara-lighter dark:border-azwara-darker
                        bg-white dark:bg-azwara-darker p-4 shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="p-2 rounded-lg {{ $stat['bg'] }}">
                        @if($stat['icon'] === 'check')
                            <svg class="w-5 h-5 {{ $stat['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"/>
                            </svg>
                        @elseif($stat['icon'] === 'x')
                            <svg class="w-5 h-5 {{ $stat['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        @elseif($stat['icon'] === 'dash')
                            <svg class="w-5 h-5 {{ $stat['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 12H4"/>
                            </svg>
                        @elseif($stat['icon'] === 'star')
                            <svg class="w-5 h-5 {{ $stat['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                        @elseif($stat['icon'] === 'clock')
                            <svg class="w-5 h-5 {{ $stat['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        @elseif($stat['icon'] === 'trophy')
                            <svg class="w-5 h-5 {{ $stat['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                            </svg>
                        @elseif($stat['icon'] === 'alert')
                            <svg class="w-5 h-5 {{ $stat['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                            </svg>
                        @endif
                    </div>
                    <div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">
                            {{ $stat['label'] }}
                        </div>
                        <div class="text-lg font-bold {{ $stat['color'] }}">
                            {{ $stat['value'] }}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- ================= RINGKASAN SKD ================= --}}
    @if ($skdSummary)
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-4">
            <div class="p-2 bg-azwara-lightest dark:bg-azwara-medium rounded-lg">
                <svg class="w-5 h-5 text-azwara-medium dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <h2 class="text-xl font-bold text-azwara-darkest dark:text-white">
                Ringkasan SKD
            </h2>
        </div>

        <div class="rounded-xl border border-azwara-lighter dark:border-azwara-darker overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-azwara-lighter dark:divide-azwara-medium">
                    <thead class="bg-azwara-lightest dark:bg-azwara-darkest">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">
                                Komponen
                            </th>
                            <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700 dark:text-gray-300">
                                TIU
                            </th>
                            <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700 dark:text-gray-300">
                                TWK
                            </th>
                            <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700 dark:text-gray-300">
                                TKP
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-azwara-darker divide-y divide-azwara-lighter dark:divide-azwara-medium">
                        {{-- BENAR --}}
                        <tr class="hover:bg-azwara-lightest/50 dark:hover:bg-azwara-medium/20">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 rounded-full bg-green-500"></div>
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Benar</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-sm font-semibold text-green-600 dark:text-green-400">
                                    {{ $skdSummary['tiu']['correct'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-sm font-semibold text-green-600 dark:text-green-400">
                                    {{ $skdSummary['twk']['correct'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-sm font-semibold text-green-600 dark:text-green-400">
                                    {{ $skdSummary['tkp']['correct'] }}
                                </span>
                            </td>
                        </tr>

                        {{-- SALAH --}}
                        <tr class="hover:bg-azwara-lightest/50 dark:hover:bg-azwara-medium/20">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 rounded-full bg-red-500"></div>
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Salah</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-sm font-semibold text-red-600 dark:text-red-400">
                                    {{ $skdSummary['tiu']['wrong'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-sm font-semibold text-red-600 dark:text-red-400">
                                    {{ $skdSummary['twk']['wrong'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-sm font-semibold text-red-600 dark:text-red-400">
                                    {{ $skdSummary['tkp']['wrong'] }}
                                </span>
                            </td>
                        </tr>

                        {{-- SCORE --}}
                        <tr class="bg-azwara-lightest/30 dark:bg-azwara-medium/10 hover:bg-azwara-lightest/50 dark:hover:bg-azwara-medium/20">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 rounded-full bg-azwara-medium dark:bg-white"></div>
                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Skor</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-lg font-bold text-azwara-darkest dark:text-white">
                                    {{ $skdSummary['tiu']['score'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-lg font-bold text-azwara-darkest dark:text-white">
                                    {{ $skdSummary['twk']['score'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-lg font-bold text-azwara-darkest dark:text-white">
                                    {{ $skdSummary['tkp']['score'] }}
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif

    {{-- ================= ACTION & FILTER ================= --}}
    {{-- <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <a href="{{ route('exams.ranking.student', $exam) }}"
           class="inline-flex items-center justify-center gap-2
                  px-5 py-2.5 rounded-lg text-sm font-semibold
                  bg-gradient-to-r from-azwara-medium to-azwara-light text-white
                  hover:from-azwara-light hover:to-azwara-medium
                  transition-all duration-200 shadow-sm hover:shadow">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
            </svg>
            Lihat Peringkat
        </a>

        <form method="GET" class="flex items-center gap-3">
            <label class="text-sm text-gray-600 dark:text-gray-400">Tampilkan:</label>
            <select name="per_page"
                    onchange="this.form.submit()"
                    class="text-sm rounded-lg border border-azwara-lighter dark:border-azwara-medium
                           bg-white dark:bg-azwara-darker text-gray-700 dark:text-gray-200
                           px-3 py-2 focus:outline-none focus:ring-2 focus:ring-azwara-light focus:border-transparent">
                @foreach ([10,20,30,50,100] as $n)
                    <option value="{{ $n }}" @selected($perPage == $n)>
                        {{ $n }} per halaman
                    </option>
                @endforeach
            </select>
        </form>
    </div> --}}

    {{-- ================= SOAL & PEMBAHASAN ================= --}}
    <div class="space-y-6">
        @foreach ($questions as $examQuestion)
            @php
                $question = $examQuestion->question;
                $answer   = $attempt->answers->firstWhere('question_id', $question->id);
                $selected = $answer?->selected_ids ?? [];
                $questionNumber = $loop->iteration + ($questions->firstItem() - 1);
            @endphp

            <div class="rounded-xl border border-azwara-lighter dark:border-azwara-darker
                        bg-white dark:bg-azwara-darker p-6 hover:shadow-sm transition-shadow">

                {{-- HEADER SOAL --}}
                <div class="flex items-center justify-between mb-5">

                    {{-- KIRI: NOMOR SOAL --}}
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-azwara-lightest dark:bg-azwara-medium
                                    flex items-center justify-center">
                            <span class="font-bold text-azwara-medium dark:text-white">
                                {{ $questionNumber }}
                            </span>
                        </div>

                        <span class="text-base font-semibold text-azwara-darkest dark:text-white">
                            Soal {{ $questionNumber }}
                        </span>
                    </div>

                    {{-- KANAN: STATUS SOAL --}}
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        @if ($question->test_type === 'tkp')
                            @php
                                $selectedWeight = $question->options
                                    ->whereIn('id', $selected)
                                    ->sum('weight');

                                $maxWeight = $question->options->max('weight');
                            @endphp

                            @if (!$answer)
                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold
                                            bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300">
                                    Kosong
                                </span>
                            @else
                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold
                                    {{ $selectedWeight === $maxWeight
                                        ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300'
                                        : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300'
                                    }}">
                                    Bobot {{ $selectedWeight }} / {{ $maxWeight }}
                                </span>
                            @endif
                        @else
                            @if ($answer)
                                @if (in_array($question->options->where('is_correct', true)->first()->id ?? null, $selected))
                                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold
                                                bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300">
                                        ✔ Benar
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold
                                                bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300">
                                        ✖ Salah
                                    </span>
                                @endif
                            @else
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold
                                            bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300">
                                    Kosong
                                </span>
                            @endif
                        @endif
                    </div>
                </div>

                {{-- KONTEN SOAL --}}
                <div class="mb-6 space-y-4">
                    @if ($question->image)
                        <div class="border border-azwara-lighter dark:border-azwara-medium rounded-lg overflow-hidden">
                            <img src="{{ asset('storage/'.$question->image) }}"
                                 class="w-full h-auto max-w-2xl mx-auto"
                                 alt="Gambar soal {{ $questionNumber }}">
                        </div>
                    @endif

                    @if ($question->question_text)
                        <div class="prose prose-sm dark:prose-invert max-w-none dark:text-white">
                            {!! $question->question_text !!}
                        </div>
                    @endif
                </div>

                {{-- PILIHAN JAWABAN --}}
                <div class="space-y-3 mb-6">
                    @php
                        $maxWeight = $question->test_type === 'tkp'
                            ? $question->options->max('weight')
                            : null;
                    @endphp

                    @foreach ($question->options as $option)
                        @php
                            $isChosen = in_array($option->id, $selected ?? []);
                            $hasImage = !empty($option->image);

                            // NON TKP
                            $isCorrect = $question->test_type !== 'tkp' && $option->is_correct;

                            // TKP
                            $isBestTkp = $question->test_type === 'tkp' && $option->weight === $maxWeight;
                        @endphp

                        <div class="rounded-lg border p-4 transition-all duration-200
                            @if ($question->test_type === 'tkp')
                                {{ $isBestTkp
                                    ? 'border-green-400 bg-green-50 dark:bg-green-900/30'
                                    : ($isChosen
                                        ? 'border-yellow-400 bg-yellow-50 dark:bg-yellow-900/30'
                                        : 'border-azwara-lighter dark:border-azwara-darker bg-white dark:bg-azwara-darker'
                                    )
                                }}
                            @else
                                {{ $isCorrect
                                    ? 'border-green-400 bg-gradient-to-r from-green-50 to-white dark:from-green-900/20 dark:to-azwara-darker shadow-sm'
                                    : ($isChosen
                                        ? 'border-red-400 bg-gradient-to-r from-red-50 to-white dark:from-red-900/20 dark:to-azwara-darker shadow-sm'
                                        : 'border-azwara-lighter dark:border-azwara-darker bg-white dark:bg-azwara-darker hover:border-azwara-light dark:hover:border-azwara-light'
                                    )
                                }}
                            @endif
                        ">

                            <div class="flex flex-col md:flex-row md:items-start gap-4">

                                {{-- LABEL OPSI --}}
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 rounded-lg flex items-center justify-center font-bold text-sm
                                        @if ($question->test_type === 'tkp')
                                            {{ $isBestTkp
                                                ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300 border border-green-300'
                                                : ($isChosen
                                                    ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300 border border-yellow-300'
                                                    : 'bg-azwara-lightest dark:bg-azwara-medium text-azwara-medium dark:text-white border border-azwara-lighter'
                                                )
                                            }}
                                        @else
                                            {{ $isCorrect
                                                ? 'bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-300 border border-green-300 dark:border-green-700'
                                                : ($isChosen
                                                    ? 'bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-300 border border-red-300 dark:border-red-700'
                                                    : 'bg-azwara-lightest dark:bg-azwara-medium text-azwara-medium dark:text-white border border-azwara-lighter dark:border-azwara-medium'
                                                )
                                            }}
                                        @endif
                                    ">
                                        {{ $option->label }}
                                    </div>
                                </div>

                                {{-- KONTEN OPSI --}}
                                <div class="flex-1">

                                    @if ($hasImage)
                                        <div class="mb-3 border border-azwara-lighter dark:border-azwara-medium rounded-lg overflow-hidden max-w-xs">
                                            <img src="{{ asset('storage/'.$option->image) }}"
                                                class="w-full h-auto"
                                                alt="Gambar opsi {{ $option->label }}">
                                        </div>
                                    @endif

                                    @if ($option->option_text)
                                        <div class="text-gray-800 dark:text-gray-200 mb-2">
                                            {!! $option->option_text !!}
                                        </div>
                                    @endif

                                    {{-- STATUS OPSI --}}
                                    <div class="flex flex-wrap items-center gap-3 mt-3">

                                        {{-- NON TKP --}}
                                        @if ($question->test_type !== 'tkp')
                                            @if ($isCorrect)
                                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-300">
                                                    ✔ Jawaban Benar
                                                </span>
                                            @endif

                                            @if ($isChosen)
                                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-300">
                                                    👤 Jawaban Anda
                                                </span>
                                            @endif
                                        @endif

                                        {{-- TKP --}}
                                        @if ($question->test_type === 'tkp')
                                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold
                                                {{ $isBestTkp
                                                    ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300'
                                                    : 'bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-300'
                                                }}">
                                                Bobot: {{ $option->weight }}
                                            </span>

                                            @if ($isChosen)
                                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-300">
                                                    👤 Pilihan Anda
                                                </span>
                                            @endif
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- PEMBAHASAN --}}
                @if ($question->explanation)
                    <div x-data="{ open: false }" class="border-t border-azwara-lighter dark:border-azwara-medium pt-5">
                        <button @click="open = !open"
                                class="w-full flex items-center justify-between text-left focus:outline-none">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-azwara-lightest dark:bg-azwara-medium rounded-lg">
                                    <svg class="w-5 h-5 text-azwara-medium dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <span class="font-medium text-azwara-darkest dark:text-white">
                                    Pembahasan Soal
                                </span>
                            </div>
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400 transform transition-transform duration-200"
                                 :class="{ 'rotate-180': open }"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div x-show="open" x-collapse
                             class="mt-4 prose prose-sm dark:prose-invert max-w-none dark:text-white">
                            {!! $question->explanation !!}
                        </div>
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    {{-- PAGINATION --}}
    @if($questions->hasPages())
        <div class="mt-8">
            {{ $questions->withQueryString()->links() }}
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
window.MathJax = {
    tex: {
        inlineMath: [['\\(', '\\)']],
        displayMath: [['\\[', '\\]']]
    },
    options: {
        skipHtmlTags: ['script', 'noscript', 'style', 'textarea', 'pre'],
        ignoreHtmlClass: 'tex2jax_ignore',
        processHtmlClass: 'tex2jax_process'
    }
};
</script>

<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    if (window.MathJax && MathJax.typeset) {
        MathJax.typeset();
    }

    // Re-render MathJax when accordion opens
    document.addEventListener('alpine:init', () => {
        Alpine.data('mathJaxRenderer', () => ({
            renderMath() {
                if (window.MathJax && MathJax.typesetPromise) {
                    MathJax.typesetPromise();
                }
            }
        }));
    });
});
</script>
@endpush
