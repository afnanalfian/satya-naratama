@extends('layouts.app')

@section('content')
@php
$testTypeLabels = [
    'tiu'       => 'TIU',
    'twk'       => 'TWK',
    'tkp'       => 'TKP',
    'tpa'       => 'TPA',
    'tbi'       => 'TBI',
    'mtk_stis'  => 'MTK STIS',
    'mtk_tka'   => 'MTK TKA',
    'general'   => 'GENERAL',
];
@endphp

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

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
                    Laporan
                </span>
            </div>

            <h1 class="text-2xl md:text-3xl font-bold tracking-tight text-primary-900 dark:text-primary-50">
                Hasil Ujian
            </h1>
            <div class="mt-2 flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-2">
                <p class="text-neutral-900 dark:text-neutral-200 font-medium">
                    {{ $displayTitle ?? $exam->title }}
                </p>
                @if (!empty($displaySubtitle))
                    <span class="hidden sm:inline text-neutral-500 dark:text-neutral-700">•</span>
                    <p class="text-neutral-700 dark:text-neutral-500">
                        {{ $displaySubtitle }}
                    </p>
                @endif
            </div>
        </div>
    </div>

    {{-- ================= STATISTIK UTAMA ================= --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-12">
        @php
            $stats = [
                ['label' => 'Peserta', 'value' => $totalParticipants, 'icon' => 'users'],
                ['label' => 'Rata-rata', 'value' => $averageScore, 'icon' => 'average'],
                ['label' => 'Tertinggi', 'value' => $maxScore, 'icon' => 'trophy'],
                ['label' => 'Terendah', 'value' => $minScore, 'icon' => 'chart'],
            ];
        @endphp

        @foreach ($stats as $stat)
            <div class="group relative overflow-hidden rounded-2xl
                        border border-neutral-200 dark:border-white/10
                        bg-white dark:bg-primary-950 p-5 shadow-sm
                        hover:shadow-md hover:shadow-primary-900/5 transition-shadow">
                <span class="absolute inset-x-0 top-0 h-0.5 bg-brand-gradient opacity-0 group-hover:opacity-100 transition-opacity"></span>
                <div class="flex items-center justify-between gap-3">
                    <div class="min-w-0">
                        <div class="text-[11px] font-semibold uppercase tracking-[0.1em] text-neutral-700 dark:text-neutral-600 mb-1.5">
                            {{ $stat['label'] }}
                        </div>
                        <div class="text-3xl font-bold tracking-tight tabular-nums text-primary-900 dark:text-primary-50">
                            {{ $stat['value'] }}
                        </div>
                    </div>
                    <div class="flex-shrink-0 w-11 h-11 rounded-xl flex items-center justify-center
                                bg-primary-50 dark:bg-primary-500/10
                                border border-primary-100 dark:border-primary-400/20">
                        @if($stat['icon'] === 'users')
                            <svg class="w-5 h-5 text-primary-600 dark:text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-8a5.5 5.5 0 11-11 0 5.5 5.5 0 0111 0z"/>
                            </svg>
                        @elseif($stat['icon'] === 'average')
                            <svg class="w-5 h-5 text-primary-600 dark:text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        @elseif($stat['icon'] === 'trophy')
                            <svg class="w-5 h-5 text-gold-600 dark:text-gold-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                        @else
                            <svg class="w-5 h-5 text-primary-600 dark:text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- ================= PERINGKAT PESERTA ================= --}}
    <div class="mb-14">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-5">
            <h2 class="flex items-center gap-2.5 text-lg font-bold tracking-tight text-primary-900 dark:text-primary-50">
                <span class="h-5 w-1 rounded-full bg-brand-gradient"></span>
                Peringkat Peserta
            </h2>

            <form method="GET" class="flex items-center gap-2.5">
                <label class="text-sm text-neutral-700 dark:text-neutral-500 whitespace-nowrap">Tampilkan:</label>
                <select name="rank_per_page"
                        onchange="this.form.submit()"
                        class="text-sm rounded-xl border border-neutral-300 dark:border-white/10
                            bg-white dark:bg-white/5 text-neutral-900 dark:text-neutral-100
                            px-3.5 py-2 shadow-sm
                            focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition">
                    @foreach ([10,20,30,50,100] as $n)
                        <option value="{{ $n }}" @selected($rankPerPage == $n)>
                            {{ $n }} per halaman
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        <div class="rounded-2xl border border-neutral-200 dark:border-white/10 overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-neutral-200 dark:divide-white/10">
                    <thead class="bg-neutral-50 dark:bg-white/[0.03]">
                        <tr>
                            <th scope="col" class="px-6 py-3.5 text-left text-[11px] font-semibold text-neutral-700 dark:text-neutral-500 uppercase tracking-[0.12em]">
                                Peringkat
                            </th>
                            <th scope="col" class="px-6 py-3.5 text-left text-[11px] font-semibold text-neutral-700 dark:text-neutral-500 uppercase tracking-[0.12em]">
                                Nama Peserta
                            </th>

                            @if ($exam->type === 'tryout' && $exam->test_type === 'skd')
                                <th scope="col" class="px-4 py-3.5 text-center text-[11px] font-semibold text-neutral-700 dark:text-neutral-500 uppercase tracking-[0.12em]">
                                    TWK
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-center text-[11px] font-semibold text-neutral-700 dark:text-neutral-500 uppercase tracking-[0.12em]">
                                    TIU
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-center text-[11px] font-semibold text-neutral-700 dark:text-neutral-500 uppercase tracking-[0.12em]">
                                    TKP
                                </th>
                            @endif
                            @if (!($exam->type === 'tryout' && $exam->test_type === 'skd'))
                                <th scope="col" class="px-4 py-3.5 text-center text-[11px] font-semibold text-neutral-700 dark:text-neutral-500 uppercase tracking-[0.12em]">
                                    Benar
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-center text-[11px] font-semibold text-neutral-700 dark:text-neutral-500 uppercase tracking-[0.12em]">
                                    Salah
                                </th>

                                @if ($exam->test_type === 'mtk_stis')
                                    <th scope="col" class="px-4 py-3.5 text-center text-[11px] font-semibold text-neutral-700 dark:text-neutral-500 uppercase tracking-[0.12em]">
                                        Kosong
                                    </th>
                                @endif
                            @endif
                            <th scope="col" class="px-6 py-3.5 text-center text-[11px] font-semibold text-neutral-700 dark:text-neutral-500 uppercase tracking-[0.12em]">
                                Total
                            </th>

                            @if ($exam->type === 'tryout')
                                <th scope="col" class="px-6 py-3.5 text-center text-[11px] font-semibold text-neutral-700 dark:text-neutral-500 uppercase tracking-[0.12em]">
                                    Status
                                </th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-primary-950 divide-y divide-neutral-200 dark:divide-white/10">
                        @forelse ($ranking as $attempt)
                            <tr class="hover:bg-primary-50/50 dark:hover:bg-white/[0.04] transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        @if ($attempt->rank <= 3)
                                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-xl text-sm tabular-nums
                                                {{ $attempt->rank === 1 ? 'bg-gold-100 text-gold-800 ring-1 ring-inset ring-gold-500/40 dark:bg-gold-500/20 dark:text-gold-200 dark:ring-gold-400/30' :
                                                ($attempt->rank === 2 ? 'bg-neutral-200 text-neutral-900 ring-1 ring-inset ring-neutral-400/40 dark:bg-white/15 dark:text-neutral-100 dark:ring-white/15' :
                                                'bg-accent-100 text-accent-800 ring-1 ring-inset ring-accent-500/30 dark:bg-accent-500/20 dark:text-accent-200 dark:ring-accent-400/30') }} font-bold">
                                                {{ $attempt->rank }}
                                            </span>
                                        @else
                                            <span class="text-neutral-700 dark:text-neutral-400 font-medium tabular-nums pl-1.5">
                                                #{{ $attempt->rank }}
                                            </span>
                                        @endif
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="text-sm font-semibold text-neutral-900 dark:text-neutral-100">
                                        {{ $attempt->user->name }}
                                    </div>
                                </td>

                                @if ($exam->type === 'tryout' && $exam->test_type === 'skd')
                                    <td class="px-4 py-4 text-center">
                                        <span class="text-sm font-semibold tabular-nums text-neutral-900 dark:text-neutral-100">
                                            {{ $attempt->score_twk ?? 0 }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        <span class="text-sm font-semibold tabular-nums text-neutral-900 dark:text-neutral-100">
                                            {{ $attempt->score_tiu ?? 0 }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        <span class="text-sm font-semibold tabular-nums text-neutral-900 dark:text-neutral-100">
                                            {{ $attempt->score_tkp ?? 0 }}
                                        </span>
                                    </td>
                                @endif
                                @if (!($exam->type === 'tryout' && $exam->test_type === 'skd'))
                                    <td class="px-4 py-4 text-center">
                                        <span class="inline-flex items-center justify-center min-w-[2rem] h-8 px-2 rounded-lg
                                                     bg-green-50 dark:bg-green-500/15
                                                     text-green-700 dark:text-green-300
                                                     ring-1 ring-inset ring-green-600/15 dark:ring-green-400/20
                                                     font-semibold text-sm tabular-nums">
                                            {{ $attempt->correct }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-4 text-center">
                                        <span class="inline-flex items-center justify-center min-w-[2rem] h-8 px-2 rounded-lg
                                                     bg-red-50 dark:bg-red-500/15
                                                     text-red-700 dark:text-red-300
                                                     ring-1 ring-inset ring-red-600/15 dark:ring-red-400/20
                                                     font-semibold text-sm tabular-nums">
                                            {{ $attempt->wrong }}
                                        </span>
                                    </td>

                                    @if ($exam->test_type === 'mtk_stis')
                                        <td class="px-4 py-4 text-center">
                                            <span class="inline-flex items-center justify-center min-w-[2rem] h-8 px-2 rounded-lg
                                                         bg-neutral-100 dark:bg-white/10
                                                         text-neutral-800 dark:text-neutral-300
                                                         font-semibold text-sm tabular-nums">
                                                {{ $attempt->empty }}
                                            </span>
                                        </td>
                                    @endif
                                @endif
                                <td class="px-6 py-4 text-center">
                                    <span class="text-lg font-bold tabular-nums text-primary-700 dark:text-primary-200">
                                        {{ $attempt->score }}
                                    </span>
                                </td>

                                @if ($exam->type === 'tryout')
                                    <td class="px-6 py-4 text-center">
                                        @if ($attempt->is_passed)
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold
                                                         bg-primary-50 text-primary-700 ring-1 ring-inset ring-primary-600/20
                                                         dark:bg-primary-500/15 dark:text-primary-200 dark:ring-primary-400/20">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                </svg>
                                                Lulus
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold
                                                         bg-red-50 text-red-700 ring-1 ring-inset ring-red-600/15
                                                         dark:bg-red-500/15 dark:text-red-300 dark:ring-red-400/20">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                                </svg>
                                                Tidak Lulus
                                            </span>
                                        @endif
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ $exam->type === 'tryout' ? 8 : 7 }}" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-16 h-16 rounded-2xl bg-neutral-50 dark:bg-white/5
                                                    border border-neutral-200 dark:border-white/10
                                                    flex items-center justify-center">
                                            <svg class="w-7 h-7 text-neutral-600 dark:text-neutral-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                        </div>
                                        <p class="text-base font-semibold text-primary-900 dark:text-primary-50">Belum ada data peserta</p>
                                        <p class="text-sm text-neutral-700 dark:text-neutral-500">Data akan muncul setelah peserta mengikuti ujian</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($ranking->hasPages())
            <div class="mt-6">
                {{ $ranking->withQueryString()->links() }}
            </div>
        @endif
    </div>

    {{-- ================= ANALISIS SOAL ================= --}}
    <div>
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-5">
            <h2 class="flex items-center gap-2.5 text-lg font-bold tracking-tight text-primary-900 dark:text-primary-50">
                <span class="h-5 w-1 rounded-full bg-brand-gradient"></span>
                Analisis Soal
            </h2>

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

        <div class="space-y-3">
            @foreach ($questions as $examQuestion)
                @php
                    $stat = $questionStats[$examQuestion->question_id] ?? [
                        'accuracy' => 0,
                        'correct' => 0,
                        'answered' => 0,
                        'total_participants' => $totalParticipants,
                        'is_tkp' => ($examQuestion->question?->test_type === 'tkp'),
                    ];

                    // Untuk TKP, akurasi dihitung dari bobot maksimum
                    if ($stat['is_tkp']) {
                        $accuracyColor = $stat['accuracy'] >= 70 ? 'text-green-600 dark:text-green-400' :
                                       ($stat['accuracy'] >= 40 ? 'text-gold-600 dark:text-gold-400' :
                                       'text-red-600 dark:text-red-400');
                    } else {
                        $accuracyColor = $stat['accuracy'] >= 70 ? 'text-green-600 dark:text-green-400' :
                                       ($stat['accuracy'] >= 40 ? 'text-gold-600 dark:text-gold-400' :
                                       'text-red-600 dark:text-red-400');
                    }
                @endphp

                <div class="rounded-2xl border border-neutral-200 dark:border-white/10
                            bg-white dark:bg-primary-950 p-5 shadow-sm
                            hover:border-neutral-300 dark:hover:border-white/20
                            hover:shadow-md hover:shadow-primary-900/5 transition-all">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-5">
                        <div class="flex-1 min-w-0">
                            <div class="flex flex-wrap items-center gap-2.5 mb-3">
                                <div class="font-bold text-base tracking-tight text-primary-900 dark:text-primary-50">
                                    Soal #{{ $loop->iteration + ($questions->firstItem() - 1) }}
                                </div>

                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-semibold uppercase tracking-[0.08em]
                                            bg-neutral-100 text-neutral-800
                                            dark:bg-white/10 dark:text-neutral-300">
                                    {{ $testTypeLabels[$examQuestion->question->test_type] ?? '-' }}
                                </span>

                                @if($stat['is_tkp'])
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-semibold
                                                bg-secondary-50 text-secondary-700 ring-1 ring-inset ring-secondary-600/20
                                                dark:bg-secondary-500/15 dark:text-secondary-200 dark:ring-secondary-400/20">
                                        TKP (Bobot)
                                    </span>
                                @endif
                            </div>

                            <div class="flex flex-wrap items-center gap-x-5 gap-y-2.5">
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-semibold uppercase tracking-[0.08em] text-neutral-700 dark:text-neutral-600">Akurasi</span>
                                    <span class="text-sm font-bold tabular-nums {{ $accuracyColor }}">
                                        {{ $stat['accuracy'] }}%
                                    </span>
                                    <div class="w-28 h-1.5 rounded-full bg-neutral-200 dark:bg-white/10 overflow-hidden">
                                        <div class="h-full rounded-full transition-all duration-500
                                            @if($stat['accuracy'] >= 70) bg-green-500
                                            @elseif($stat['accuracy'] >= 40) bg-gold-500
                                            @else bg-red-500 @endif"
                                            style="width: {{ $stat['accuracy'] }}%">
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-semibold uppercase tracking-[0.08em] text-neutral-700 dark:text-neutral-600">Jawaban Benar</span>
                                    <span class="text-sm font-semibold tabular-nums text-neutral-900 dark:text-neutral-100">
                                        {{ $stat['correct'] }} / {{ $stat['answered'] }}
                                    </span>
                                    @if($stat['is_tkp'])
                                        <span class="text-xs text-neutral-600 dark:text-neutral-600">
                                            (dari {{ $stat['total_participants'] }} peserta)
                                        </span>
                                    @endif
                                </div>
                                @if($stat['is_tkp'])
                                    <span class="text-xs text-neutral-600 dark:text-neutral-600 italic">
                                        Bobot maksimum dianggap benar
                                    </span>
                                @endif
                            </div>
                        </div>

                        <a href="{{ route('exams.questions.analysis', [$exam, $examQuestion]) }}"
                           class="inline-flex items-center justify-center gap-2 flex-shrink-0
                                  px-4 py-2.5 rounded-xl text-sm font-semibold
                                  bg-white dark:bg-white/5
                                  border border-neutral-300 dark:border-white/15
                                  text-neutral-800 dark:text-neutral-300
                                  shadow-sm
                                  hover:bg-primary-50 hover:border-primary-300 hover:text-primary-700
                                  dark:hover:bg-white/10 dark:hover:text-primary-200
                                  transition-all duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            Lihat Analisis
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        @if($questions->hasPages())
            <div class="mt-6">
                {{ $questions->withQueryString()->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
