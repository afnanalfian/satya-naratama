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

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

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
                Hasil Ujian
            </h1>
            <div class="mt-2 flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-2">
                <p class="text-gray-700 dark:text-gray-300 font-medium">
                    {{ $displayTitle ?? $exam->title }}
                </p>
                @if (!empty($displaySubtitle))
                    <span class="hidden sm:inline text-gray-500 dark:text-gray-400">•</span>
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ $displaySubtitle }}
                    </p>
                @endif
            </div>
        </div>
    </div>

    {{-- ================= STATISTIK UTAMA ================= --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
        @php
            $stats = [
                ['label' => 'Peserta', 'value' => $totalParticipants, 'icon' => 'users'],
                ['label' => 'Rata-rata', 'value' => $averageScore, 'icon' => 'average'],
                ['label' => 'Tertinggi', 'value' => $maxScore, 'icon' => 'trophy'],
                ['label' => 'Terendah', 'value' => $minScore, 'icon' => 'chart'],
            ];
        @endphp

        @foreach ($stats as $stat)
            <div class="rounded-xl border border-azwara-lighter dark:border-azwara-darker
                        bg-azwara-lightest dark:bg-azwara-darker p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-1">
                            {{ $stat['label'] }}
                        </div>
                        <div class="text-2xl font-bold text-azwara-darkest dark:text-white">
                            {{ $stat['value'] }}
                        </div>
                    </div>
                    <div class="p-2 bg-azwara-light dark:bg-azwara-medium rounded-lg">
                        @if($stat['icon'] === 'users')
                            <svg class="w-6 h-6 text-azwara-lightest dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-8a5.5 5.5 0 11-11 0 5.5 5.5 0 0111 0z"/>
                            </svg>
                        @elseif($stat['icon'] === 'average')
                            <svg class="w-6 h-6 text-azwara-lightest dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        @elseif($stat['icon'] === 'trophy')
                            <svg class="w-6 h-6 text-azwara-lightest dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                        @else
                            <svg class="w-6 h-6 text-azwara-lightest dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- ================= PERINGKAT PESERTA ================= --}}
    <div class="mb-12">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
            <h2 class="text-xl font-bold text-azwara-darkest dark:text-white">
                Peringkat Peserta
            </h2>

            <form method="GET" class="flex items-center gap-3">
                <label class="text-sm text-gray-600 dark:text-gray-400">Tampilkan:</label>
                <select name="rank_per_page"
                        onchange="this.form.submit()"
                        class="text-sm rounded-lg border border-azwara-lighter dark:border-azwara-medium
                            bg-azwara-lightest dark:bg-azwara-darker text-gray-700 dark:text-gray-200
                            px-3 py-2 focus:outline-none focus:ring-2 focus:ring-azwara-light focus:border-transparent">
                    @foreach ([10,20,30,50,100] as $n)
                        <option value="{{ $n }}" @selected($rankPerPage == $n)>
                            {{ $n }} per halaman
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        <div class="rounded-xl border border-azwara-lighter dark:border-azwara-darker overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-azwara-lighter dark:divide-azwara-medium">
                    <thead class="bg-azwara-darker dark:bg-azwara-darkest">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-white dark:text-gray-300 uppercase tracking-wider">
                                Peringkat
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-white dark:text-gray-300 uppercase tracking-wider">
                                Nama Peserta
                            </th>

                            @if ($exam->type === 'tryout' && $exam->test_type === 'skd')
                                <th scope="col" class="px-4 py-3 text-center text-xs font-semibold text-white dark:text-gray-300 uppercase tracking-wider">
                                    TWK
                                </th>
                                <th scope="col" class="px-4 py-3 text-center text-xs font-semibold text-white dark:text-gray-300 uppercase tracking-wider">
                                    TIU
                                </th>
                                <th scope="col" class="px-4 py-3 text-center text-xs font-semibold text-white dark:text-gray-300 uppercase tracking-wider">
                                    TKP
                                </th>
                            @endif
                            @if (!($exam->type === 'tryout' && $exam->test_type === 'skd'))
                                <th scope="col" class="px-4 py-3 text-center text-xs font-semibold text-white dark:text-gray-300 uppercase tracking-wider">
                                    Benar
                                </th>
                                <th scope="col" class="px-4 py-3 text-center text-xs font-semibold text-white dark:text-gray-300 uppercase tracking-wider">
                                    Salah
                                </th>

                                @if ($exam->test_type === 'mtk_stis')
                                    <th scope="col" class="px-4 py-3 text-center text-xs font-semibold text-white dark:text-gray-300 uppercase tracking-wider">
                                        Kosong
                                    </th>
                                @endif
                            @endif
                            <th scope="col" class="px-6 py-3 text-center text-xs font-semibold text-white dark:text-gray-300 uppercase tracking-wider">
                                Total
                            </th>

                            @if ($exam->type === 'tryout')
                                <th scope="col" class="px-6 py-3 text-center text-xs font-semibold text-white dark:text-gray-300 uppercase tracking-wider">
                                    Status
                                </th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="bg-azwara-lightest dark:bg-azwara-darker divide-y divide-azwara-lighter dark:divide-azwara-medium">
                        @forelse ($ranking as $attempt)
                            <tr class="hover:bg-azwara-lightest/50 dark:hover:bg-azwara-medium/20 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        @if ($attempt->rank <= 3)
                                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full
                                                {{ $attempt->rank === 1 ? 'bg-gradient-to-br from-yellow-400 to-yellow-600 text-black' :
                                                ($attempt->rank === 2 ? 'bg-gradient-to-br from-gray-300 to-gray-400 text-black' :
                                                'bg-gradient-to-br from-amber-600 to-amber-800 text-white') }} font-bold">
                                                {{ $attempt->rank }}
                                            </span>
                                        @else
                                            <span class="text-gray-700 dark:text-gray-300 font-medium">
                                                #{{ $attempt->rank }}
                                            </span>
                                        @endif
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $attempt->user->name }}
                                    </div>
                                </td>

                                @if ($exam->type === 'tryout' && $exam->test_type === 'skd')
                                    <td class="px-4 py-4 text-center">
                                        <span class="text-sm font-semibold text-gray-900 dark:text-white">
                                            {{ $attempt->score_twk ?? 0 }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        <span class="text-sm font-semibold text-gray-900 dark:text-white">
                                            {{ $attempt->score_tiu ?? 0 }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        <span class="text-sm font-semibold text-gray-900 dark:text-white">
                                            {{ $attempt->score_tkp ?? 0 }}
                                        </span>
                                    </td>
                                @endif
                                @if (!($exam->type === 'tryout' && $exam->test_type === 'skd'))
                                    <td class="px-4 py-4 text-center">
                                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300 font-semibold text-sm">
                                            {{ $attempt->correct }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-4 text-center">
                                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300 font-semibold text-sm">
                                            {{ $attempt->wrong }}
                                        </span>
                                    </td>

                                    @if ($exam->test_type === 'mtk_stis')
                                        <td class="px-4 py-4 text-center">
                                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 font-semibold text-sm">
                                                {{ $attempt->empty }}
                                            </span>
                                        </td>
                                    @endif
                                @endif
                                <td class="px-6 py-4 text-center">
                                    <span class="text-lg font-bold text-azwara-medium dark:text-white">
                                        {{ $attempt->score }}
                                    </span>
                                </td>

                                @if ($exam->type === 'tryout')
                                    <td class="px-6 py-4 text-center">
                                        @if ($attempt->is_passed)
                                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                </svg>
                                                Lulus
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300">
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
                                <td colspan="{{ $exam->type === 'tryout' ? 8 : 7 }}" class="px-6 py-8 text-center">
                                    <div class="text-gray-500 dark:text-gray-400">
                                        <svg class="w-12 h-12 mx-auto mb-3 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        <p class="text-lg font-medium">Belum ada data peserta</p>
                                        <p class="text-sm mt-1">Data akan muncul setelah peserta mengikuti ujian</p>
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
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
            <h2 class="text-xl font-bold text-azwara-darkest dark:text-white">
                Analisis Soal
            </h2>

            <form method="GET" class="flex items-center gap-3">
                <label class="text-sm text-gray-600 dark:text-gray-400">Tampilkan:</label>
                <select name="per_page"
                        onchange="this.form.submit()"
                        class="text-sm rounded-lg border border-azwara-lighter dark:border-azwara-medium
                               bg-azwara-lightest dark:bg-azwara-darker text-gray-700 dark:text-gray-200
                               px-3 py-2 focus:outline-none focus:ring-2 focus:ring-azwara-light focus:border-transparent">
                    @foreach ([10,20,30,50,100] as $n)
                        <option value="{{ $n }}" @selected($perPage == $n)>
                            {{ $n }} per halaman
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        <div class="space-y-4">
            @foreach ($questions as $examQuestion)
                @php
                    $stat = $questionStats[$examQuestion->question_id] ?? [
                        'accuracy' => 0,
                        'correct' => 0,
                        'answered' => 0,
                    ];
                    $accuracyColor = $stat['accuracy'] >= 70 ? 'text-green-600 dark:text-green-400' :
                                   ($stat['accuracy'] >= 40 ? 'text-yellow-600 dark:text-yellow-400' :
                                   'text-red-600 dark:text-red-400');
                @endphp

                <div class="rounded-xl border border-azwara-lighter dark:border-azwara-darker
                            bg-azwara-lightest dark:bg-azwara-darker p-5 hover:shadow-md transition-shadow">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="flex-1">
                            <div class="flex flex-wrap items-center gap-3 mb-2">
                                <div class="font-bold text-lg text-azwara-darkest dark:text-white">
                                    Soal #{{ $loop->iteration + ($questions->firstItem() - 1) }}
                                </div>

                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                            bg-azwara-lighter text-azwara-medium
                                            dark:bg-azwara-medium dark:text-white">
                                    {{ $testTypeLabels[$examQuestion->question->test_type] ?? '-' }}
                                </span>
                            </div>

                            <div class="flex flex-wrap items-center gap-4">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                                    </svg>
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Akurasi:</span>
                                    <span class="text-sm font-bold {{ $accuracyColor }}">
                                        {{ $stat['accuracy'] }}%
                                    </span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Jawaban Benar:</span>
                                    <span class="text-sm font-semibold text-gray-900 dark:text-white">
                                        {{ $stat['correct'] }} / {{ $stat['answered'] }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('exams.questions.analysis', [$exam, $examQuestion]) }}"
                           class="inline-flex items-center justify-center gap-2
                                  px-4 py-2.5 rounded-lg text-sm font-semibold
                                  bg-gradient-to-r from-azwara-medium to-azwara-light text-white
                                  hover:from-azwara-light hover:to-azwara-medium
                                  transition-all duration-200 shadow-sm hover:shadow">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
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
