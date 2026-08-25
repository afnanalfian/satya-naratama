@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- ================= HEADER ================= --}}
    <div class="mb-8 pb-6 border-b border-neutral-200 dark:border-white/10">
        <a href="{{ $backUrl }}"
           class="group inline-flex items-center gap-2 text-sm font-medium
                  text-neutral-700 hover:text-primary-700
                  dark:text-neutral-500 dark:hover:text-primary-200 transition-colors mb-5">
            <svg class="w-4 h-4 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>

        <div>
            <div class="flex items-center gap-2.5 mb-2">
                <span class="h-5 w-1 rounded-full bg-brand-gradient"></span>
                <span class="text-[11px] font-semibold uppercase tracking-[0.14em] text-primary-600 dark:text-primary-300">
                    Rapor Ujian
                </span>
            </div>

            <h1 class="text-2xl md:text-3xl font-bold tracking-tight text-primary-900 dark:text-primary-50">
                Hasil Ujian Anda
            </h1>
            <div class="mt-2 flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-2">
                <p class="text-neutral-900 dark:text-neutral-200 font-medium">
                    {{ $displayTitle }}
                </p>
                @if ($displaySubtitle)
                    <span class="hidden sm:inline text-neutral-500 dark:text-neutral-700">•</span>
                    <p class="text-neutral-700 dark:text-neutral-500">
                        {{ $displaySubtitle }}
                    </p>
                @endif
            </div>
        </div>
    </div>

    {{-- ================= STATISTIK UTAMA ================= --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4 mb-10">
        @php
            $stats = [
                [
                    'label' => 'Benar',
                    'value' => $summary['correct'],
                    'icon' => 'check',
                    'color' => 'text-green-600 dark:text-green-400',
                    'bg' => 'bg-green-50 dark:bg-green-500/15 border border-green-200 dark:border-green-400/20'
                ],
                [
                    'label' => 'Salah',
                    'value' => $summary['wrong'],
                    'icon' => 'x',
                    'color' => 'text-red-600 dark:text-red-400',
                    'bg' => 'bg-red-50 dark:bg-red-500/15 border border-red-200 dark:border-red-400/20'
                ],
            ];

            if ($exam->type === 'tryout' && $exam->test_type === 'mtk_stis') {
                $stats[] = [
                    'label' => 'Kosong',
                    'value' => $summary['empty'],
                    'icon' => 'dash',
                    'color' => 'text-neutral-800 dark:text-neutral-400',
                    'bg' => 'bg-neutral-100 dark:bg-white/10 border border-neutral-200 dark:border-white/10'
                ];
            }

            $stats = array_merge($stats, [
                [
                    'label' => 'Skor Total',
                    'value' => $attempt->score,
                    'icon' => 'star',
                    'color' => 'text-primary-700 dark:text-primary-200',
                    'bg' => 'bg-primary-50 dark:bg-primary-500/15 border border-primary-100 dark:border-primary-400/20'
                ],
                [
                    'label' => 'Durasi',
                    'value' => gmdate('H:i:s', $attempt->work_duration_seconds),
                    'icon' => 'clock',
                    'color' => 'text-secondary-700 dark:text-secondary-200',
                    'bg' => 'bg-secondary-50 dark:bg-secondary-500/15 border border-secondary-200 dark:border-secondary-400/20'
                ],
            ]);

            if ($exam->type === 'tryout' && in_array($exam->test_type, ['skd', 'mtk_stis'])) {
                $stats[] = [
                    'label' => 'Status',
                    'value' => $attempt->is_passed ? 'Lulus' : 'Belum Lulus',
                    'icon' => $attempt->is_passed ? 'trophy' : 'alert',
                    'color' => $attempt->is_passed ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400',
                    'bg' => $attempt->is_passed
                        ? 'bg-green-50 dark:bg-green-500/15 border border-green-200 dark:border-green-400/20'
                        : 'bg-red-50 dark:bg-red-500/15 border border-red-200 dark:border-red-400/20'
                ];
            }
        @endphp

        @foreach ($stats as $stat)
            <div class="rounded-2xl border border-neutral-200 dark:border-white/10
                        bg-white dark:bg-primary-950 p-4 shadow-sm
                        hover:shadow-md hover:shadow-primary-900/5 transition-shadow">
                <div class="flex items-center gap-3">
                    <div class="flex-shrink-0 w-10 h-10 rounded-xl flex items-center justify-center {{ $stat['bg'] }}">
                        @if($stat['icon'] === 'check')
                            <svg class="w-5 h-5 {{ $stat['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M5 13l4 4L19 7"/>
                            </svg>
                        @elseif($stat['icon'] === 'x')
                            <svg class="w-5 h-5 {{ $stat['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        @elseif($stat['icon'] === 'dash')
                            <svg class="w-5 h-5 {{ $stat['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M20 12H4"/>
                            </svg>
                        @elseif($stat['icon'] === 'star')
                            <svg class="w-5 h-5 {{ $stat['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                        @elseif($stat['icon'] === 'clock')
                            <svg class="w-5 h-5 {{ $stat['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        @elseif($stat['icon'] === 'trophy')
                            <svg class="w-5 h-5 {{ $stat['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                            </svg>
                        @elseif($stat['icon'] === 'alert')
                            <svg class="w-5 h-5 {{ $stat['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                            </svg>
                        @endif
                    </div>
                    <div class="min-w-0">
                        <div class="text-[11px] font-semibold uppercase tracking-[0.1em] text-neutral-700 dark:text-neutral-600">
                            {{ $stat['label'] }}
                        </div>
                        <div class="text-lg font-bold tabular-nums truncate {{ $stat['color'] }}">
                            {{ $stat['value'] }}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- ================= RINGKASAN SKD ================= --}}
    @if ($skdSummary)
    <div class="mb-10">
        <div class="flex items-center gap-3 mb-5">
            <h2 class="flex items-center gap-2.5 text-lg font-bold tracking-tight text-primary-900 dark:text-primary-50">
                <span class="h-5 w-1 rounded-full bg-brand-gradient"></span>
                Ringkasan SKD
            </h2>
        </div>

        <div class="rounded-2xl border border-neutral-200 dark:border-white/10 overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-neutral-200 dark:divide-white/10">
                    <thead class="bg-neutral-50 dark:bg-white/[0.03]">
                        <tr>
                            <th class="px-6 py-3.5 text-left text-[11px] font-semibold text-neutral-700 dark:text-neutral-500 uppercase tracking-[0.12em]">
                                Komponen
                            </th>
                            <th class="px-6 py-3.5 text-center text-[11px] font-semibold text-neutral-700 dark:text-neutral-500 uppercase tracking-[0.12em]">
                                TIU
                            </th>
                            <th class="px-6 py-3.5 text-center text-[11px] font-semibold text-neutral-700 dark:text-neutral-500 uppercase tracking-[0.12em]">
                                TWK
                            </th>
                            <th class="px-6 py-3.5 text-center text-[11px] font-semibold text-neutral-700 dark:text-neutral-500 uppercase tracking-[0.12em]">
                                TKP
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-primary-950 divide-y divide-neutral-200 dark:divide-white/10">
                        {{-- BENAR --}}
                        <tr class="hover:bg-neutral-50 dark:hover:bg-white/[0.04] transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-2 h-2 rounded-full bg-green-500"></div>
                                    <span class="text-sm text-neutral-800 dark:text-neutral-300">Benar</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-sm font-semibold tabular-nums text-green-600 dark:text-green-400">
                                    {{ $skdSummary['tiu']['correct'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-sm font-semibold tabular-nums text-green-600 dark:text-green-400">
                                    {{ $skdSummary['twk']['correct'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-sm font-semibold tabular-nums text-green-600 dark:text-green-400">
                                    {{ $skdSummary['tkp']['correct'] }}
                                </span>
                            </td>
                        </tr>

                        {{-- SALAH --}}
                        <tr class="hover:bg-neutral-50 dark:hover:bg-white/[0.04] transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-2 h-2 rounded-full bg-red-500"></div>
                                    <span class="text-sm text-neutral-800 dark:text-neutral-300">Salah</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-sm font-semibold tabular-nums text-red-600 dark:text-red-400">
                                    {{ $skdSummary['tiu']['wrong'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-sm font-semibold tabular-nums text-red-600 dark:text-red-400">
                                    {{ $skdSummary['twk']['wrong'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-sm font-semibold tabular-nums text-red-600 dark:text-red-400">
                                    {{ $skdSummary['tkp']['wrong'] }}
                                </span>
                            </td>
                        </tr>

                        {{-- KOSONG (TAMBAHAN) --}}
                        <tr class="hover:bg-neutral-50 dark:hover:bg-white/[0.04] transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-2 h-2 rounded-full bg-neutral-500"></div>
                                    <span class="text-sm text-neutral-800 dark:text-neutral-300">Kosong</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-sm font-semibold tabular-nums text-neutral-700 dark:text-neutral-500">
                                    {{ $skdSummary['tiu']['empty'] ?? 0 }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-sm font-semibold tabular-nums text-neutral-700 dark:text-neutral-500">
                                    {{ $skdSummary['twk']['empty'] ?? 0 }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-sm font-semibold tabular-nums text-neutral-700 dark:text-neutral-500">
                                    {{ $skdSummary['tkp']['empty'] ?? 0 }}
                                </span>
                            </td>
                        </tr>

                        {{-- SKOR --}}
                        <tr class="bg-primary-50/50 dark:bg-primary-500/10">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-2 h-2 rounded-full bg-primary-500"></div>
                                    <span class="text-sm font-semibold text-primary-900 dark:text-primary-100">Skor</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-lg font-bold tabular-nums text-primary-900 dark:text-primary-50">
                                    {{ $skdSummary['tiu']['score'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-lg font-bold tabular-nums text-primary-900 dark:text-primary-50">
                                    {{ $skdSummary['twk']['score'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-lg font-bold tabular-nums text-primary-900 dark:text-primary-50">
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
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8
                pb-6 border-b border-neutral-200 dark:border-white/10">
        <a href="{{ route('exams.ranking.student', $exam) }}"
           class="inline-flex items-center justify-center gap-2
                  px-5 py-2.5 rounded-xl text-sm font-semibold
                  bg-primary-600 text-white
                  shadow-sm hover:bg-primary-700 active:bg-primary-800
                  focus:outline-none focus:ring-2 focus:ring-primary-500/40
                  transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
            </svg>
            Lihat Peringkat
        </a>

        <form method="GET" class="flex items-center gap-2.5">
            <label class="text-sm text-neutral-700 dark:text-neutral-500 whitespace-nowrap">Tampilkan:</label>
            <select name="per_page"
                    onchange="this.form.submit()"
                    class="text-sm rounded-xl border border-neutral-300 dark:border-white/10
                           bg-white dark:bg-white/5 text-neutral-900 dark:text-neutral-100
                           px-3.5 py-2 shadow-sm
                           focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition">
                @foreach ([10,20,30,50,100] as $n)
                    <option value="{{ $n }}" @selected($perPage == $n)>
                        {{ $n }} per halaman
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    {{-- ================= SOAL & PEMBAHASAN ================= --}}
    <div class="space-y-5">
        @foreach ($questions as $examQuestion)
            @php
                $question = $examQuestion->question;
                $answer   = $attempt->answers->firstWhere('question_id', $question->id);
                $selected = $answer?->selected_ids ?? [];
                $questionNumber = $loop->iteration + ($questions->firstItem() - 1);

                // Variabel untuk TKP
                $isTkp = ($question->test_type === 'tkp');
                $selectedWeight = 0;
                $maxWeight = 0;

                if ($isTkp) {
                    $maxWeight = $question->options->max('weight') ?? 0;
                    if ($answer && !empty($selected)) {
                        $selectedWeight = $question->options
                            ->whereIn('id', $selected)
                            ->sum('weight');
                    }
                }
            @endphp

            <div class="rounded-2xl border border-neutral-200 dark:border-white/10
                        bg-white dark:bg-primary-950 p-6 shadow-sm
                        hover:border-neutral-300 dark:hover:border-white/20 transition-colors">

                {{-- HEADER SOAL --}}
                <div class="flex flex-wrap items-center justify-between gap-3 mb-5
                            pb-4 border-b border-neutral-200 dark:border-white/10">

                    {{-- KIRI: NOMOR SOAL --}}
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl
                                    bg-primary-50 dark:bg-primary-500/15
                                    ring-1 ring-inset ring-primary-600/15 dark:ring-primary-400/20
                                    flex items-center justify-center">
                            <span class="font-bold text-sm tabular-nums text-primary-700 dark:text-primary-200">
                                {{ $questionNumber }}
                            </span>
                        </div>

                        <span class="text-base font-bold tracking-tight text-primary-900 dark:text-primary-50">
                            Soal {{ $questionNumber }}
                        </span>

                        @if($isTkp)
                            <span class="text-[11px] font-semibold px-2.5 py-0.5 rounded-full
                                         bg-secondary-50 text-secondary-700 ring-1 ring-inset ring-secondary-600/20
                                         dark:bg-secondary-500/15 dark:text-secondary-200 dark:ring-secondary-400/20">
                                TKP
                            </span>
                        @endif
                    </div>

                    {{-- KANAN: STATUS SOAL --}}
                    <div class="text-sm">
                        @if($isTkp)
                            {{-- TKP: Tampilkan bobot --}}
                            @if (!$answer || $answer->isEmpty)
                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold
                                            bg-neutral-100 text-neutral-800
                                            dark:bg-white/10 dark:text-neutral-300">
                                    Kosong
                                </span>
                            @else
                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold tabular-nums
                                    {{ $selectedWeight === $maxWeight && $maxWeight > 0
                                        ? 'bg-green-50 text-green-700 ring-1 ring-inset ring-green-600/20 dark:bg-green-500/15 dark:text-green-300'
                                        : ($selectedWeight > 0
                                            ? 'bg-gold-50 text-gold-700 ring-1 ring-inset ring-gold-600/20 dark:bg-gold-500/15 dark:text-gold-200'
                                            : 'bg-red-50 text-red-700 ring-1 ring-inset ring-red-600/15 dark:bg-red-500/15 dark:text-red-300'
                                        )
                                    }}">
                                    Bobot {{ $selectedWeight }} / {{ $maxWeight }}
                                </span>
                            @endif
                        @else
                            {{-- Non-TKP: Tampilkan benar/salah --}}
                            @if ($answer && !$answer->isEmpty)
                                @if (in_array($question->options->where('is_correct', true)->first()->id ?? null, $selected))
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold
                                                bg-green-50 text-green-700 ring-1 ring-inset ring-green-600/20
                                                dark:bg-green-500/15 dark:text-green-300 dark:ring-green-400/20">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Benar
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold
                                                bg-red-50 text-red-700 ring-1 ring-inset ring-red-600/15
                                                dark:bg-red-500/15 dark:text-red-300 dark:ring-red-400/20">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                        Salah
                                    </span>
                                @endif
                            @else
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold
                                            bg-neutral-100 text-neutral-800
                                            dark:bg-white/10 dark:text-neutral-300">
                                    Kosong
                                </span>
                            @endif
                        @endif
                    </div>
                </div>

                {{-- KONTEN SOAL --}}
                <div class="mb-6 space-y-4">
                    @if ($question->image)
                        <div class="border border-neutral-200 dark:border-white/10 rounded-xl overflow-hidden bg-white">
                            <img src="{{ asset('storage/'.$question->image) }}"
                                 class="w-full h-auto max-w-2xl mx-auto"
                                 alt="Gambar soal {{ $questionNumber }}">
                        </div>
                    @endif

                    @if ($question->question_text)
                        <div class="prose prose-sm dark:prose-invert max-w-none text-neutral-800 dark:text-neutral-200">
                            {!! $question->question_text !!}
                        </div>
                    @endif

                    {{-- Informasi tambahan untuk TKP --}}
                    {{-- @if($isTkp)
                        <div class="text-xs text-neutral-700 dark:text-neutral-500 italic bg-secondary-50 dark:bg-secondary-500/10 p-3 rounded-xl">
                            Pilih jawaban yang paling sesuai. Setiap pilihan memiliki bobot nilai berbeda.
                        </div>
                    @endif --}}
                </div>

                {{-- PILIHAN JAWABAN --}}
                <div class="space-y-2.5 mb-6">
                    @foreach ($question->options as $option)
                        @php
                            $isChosen = in_array($option->id, $selected ?? []);
                            $hasImage = !empty($option->image);
                            $optionWeight = $option->weight ?? 0;

                            // Untuk TKP
                            $isBestTkp = $isTkp && $optionWeight === $maxWeight && $maxWeight > 0;

                            // Untuk non-TKP
                            $isCorrect = !$isTkp && $option->is_correct;

                            // Tentukan warna border dan background
                            if ($isTkp) {
                                if ($isChosen && $optionWeight === $maxWeight && $maxWeight > 0) {
                                    $borderClass = 'border-green-400 dark:border-green-500/40 bg-green-50 dark:bg-green-500/10 ring-1 ring-green-500/20';
                                    $labelClass = 'bg-green-100 text-green-700 dark:bg-green-500/25 dark:text-green-300 border border-green-300 dark:border-green-500/30';
                                } elseif ($isChosen && $optionWeight > 0) {
                                    $borderClass = 'border-gold-400 dark:border-gold-500/40 bg-gold-50 dark:bg-gold-500/10 ring-1 ring-gold-500/20';
                                    $labelClass = 'bg-gold-100 text-gold-700 dark:bg-gold-500/25 dark:text-gold-200 border border-gold-300 dark:border-gold-500/30';
                                } elseif ($isChosen) {
                                    $borderClass = 'border-red-400 dark:border-red-500/40 bg-red-50 dark:bg-red-500/10 ring-1 ring-red-500/20';
                                    $labelClass = 'bg-red-100 text-red-700 dark:bg-red-500/25 dark:text-red-300 border border-red-300 dark:border-red-500/30';
                                } elseif ($optionWeight === $maxWeight && $maxWeight > 0) {
                                    $borderClass = 'border-green-200 dark:border-green-500/25 bg-green-50/50 dark:bg-green-500/[0.06]';
                                    $labelClass = 'bg-green-50 text-green-700 dark:bg-green-500/15 dark:text-green-400 border border-green-200 dark:border-green-500/25';
                                } else {
                                    $borderClass = 'border-neutral-200 dark:border-white/10 bg-white dark:bg-white/[0.03]';
                                    $labelClass = 'bg-neutral-100 text-neutral-800 dark:bg-white/10 dark:text-neutral-300 border border-neutral-200 dark:border-white/10';
                                }
                            } else {
                                if ($isCorrect && $isChosen) {
                                    $borderClass = 'border-green-400 dark:border-green-500/40 bg-green-50 dark:bg-green-500/10 ring-1 ring-green-500/20';
                                    $labelClass = 'bg-green-100 text-green-700 dark:bg-green-500/25 dark:text-green-300 border border-green-300 dark:border-green-500/30';
                                } elseif ($isCorrect) {
                                    $borderClass = 'border-green-200 dark:border-green-500/25 bg-green-50/50 dark:bg-green-500/[0.06]';
                                    $labelClass = 'bg-green-50 text-green-700 dark:bg-green-500/15 dark:text-green-400 border border-green-200 dark:border-green-500/25';
                                } elseif ($isChosen) {
                                    $borderClass = 'border-red-400 dark:border-red-500/40 bg-red-50 dark:bg-red-500/10 ring-1 ring-red-500/20';
                                    $labelClass = 'bg-red-100 text-red-700 dark:bg-red-500/25 dark:text-red-300 border border-red-300 dark:border-red-500/30';
                                } else {
                                    $borderClass = 'border-neutral-200 dark:border-white/10 bg-white dark:bg-white/[0.03]';
                                    $labelClass = 'bg-neutral-100 text-neutral-800 dark:bg-white/10 dark:text-neutral-300 border border-neutral-200 dark:border-white/10';
                                }
                            }
                        @endphp

                        <div class="rounded-xl border p-4 transition-all duration-200 {{ $borderClass }}">
                            <div class="flex flex-col md:flex-row md:items-start gap-4">

                                {{-- LABEL OPSI --}}
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 rounded-lg flex items-center justify-center font-bold text-sm {{ $labelClass }}">
                                        {{ $option->label }}
                                    </div>
                                </div>

                                {{-- KONTEN OPSI --}}
                                <div class="flex-1 min-w-0">

                                    @if ($hasImage)
                                        <div class="mb-3 border border-neutral-200 dark:border-white/10 rounded-xl overflow-hidden max-w-xs bg-white">
                                            <img src="{{ asset('storage/'.$option->image) }}"
                                                class="w-full h-auto"
                                                alt="Gambar opsi {{ $option->label }}">
                                        </div>
                                    @endif

                                    @if ($option->option_text)
                                        <div class="text-sm text-neutral-800 dark:text-neutral-200 mb-2">
                                            {!! $option->option_text !!}
                                        </div>
                                    @endif

                                    {{-- STATUS OPSI --}}
                                    <div class="flex flex-wrap items-center gap-2 mt-3">

                                        @if($isTkp)
                                            {{-- TKP: Tampilkan bobot --}}
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-semibold tabular-nums
                                                {{ $optionWeight === $maxWeight && $maxWeight > 0
                                                    ? 'bg-green-50 text-green-700 ring-1 ring-inset ring-green-600/20 dark:bg-green-500/15 dark:text-green-300'
                                                    : 'bg-neutral-100 text-neutral-800 dark:bg-white/10 dark:text-neutral-300'
                                                }}">
                                                Bobot: {{ $optionWeight }}
                                                @if($optionWeight === $maxWeight && $maxWeight > 0)
                                                    <span class="text-gold-600 dark:text-gold-400">★</span> Maksimal
                                                @endif
                                            </span>

                                            @if ($isChosen)
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-semibold
                                                             bg-secondary-50 text-secondary-700 ring-1 ring-inset ring-secondary-600/20
                                                             dark:bg-secondary-500/15 dark:text-secondary-200">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                    </svg>
                                                    Pilihan Anda
                                                </span>
                                            @endif
                                        @else
                                            {{-- Non-TKP --}}
                                            @if ($isCorrect)
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-semibold
                                                             bg-green-50 text-green-700 ring-1 ring-inset ring-green-600/20
                                                             dark:bg-green-500/15 dark:text-green-300">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                                    </svg>
                                                    Jawaban Benar
                                                </span>
                                            @endif

                                            @if ($isChosen)
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-semibold
                                                             bg-secondary-50 text-secondary-700 ring-1 ring-inset ring-secondary-600/20
                                                             dark:bg-secondary-500/15 dark:text-secondary-200">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                    </svg>
                                                    Jawaban Anda
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
                    <div x-data="{ open: false }" class="border-t border-neutral-200 dark:border-white/10 pt-5">
                        <button @click="open = !open"
                                class="w-full flex items-center justify-between text-left focus:outline-none group">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl flex items-center justify-center
                                            bg-gold-50 dark:bg-gold-500/10
                                            border border-gold-200 dark:border-gold-400/20">
                                    <svg class="w-4 h-4 text-gold-600 dark:text-gold-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <span class="font-semibold text-primary-900 dark:text-primary-50 group-hover:text-primary-700 dark:group-hover:text-primary-200 transition-colors">
                                    Pembahasan Soal
                                </span>
                            </div>
                            <svg class="w-5 h-5 text-neutral-600 dark:text-neutral-500 transform transition-transform duration-200"
                                 :class="{ 'rotate-180': open }"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div x-show="open" x-collapse
                             class="mt-4 prose prose-sm dark:prose-invert max-w-none text-neutral-800 dark:text-neutral-200">
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
