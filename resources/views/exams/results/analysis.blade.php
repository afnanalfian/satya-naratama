@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    {{-- ================= HEADER ================= --}}
    <div class="mb-8">
        <a href="{{ route('exams.results', $exam) }}"
           class="inline-flex items-center gap-2 text-sm font-medium text-azwara-medium hover:text-azwara-light dark:text-azwara-lighter dark:hover:text-white transition-colors mb-4">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Hasil Ujian
        </a>

        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-azwara-darkest dark:text-white">
                Analisis Soal
            </h1>
            <div class="mt-2 flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-2">
                <p class="text-gray-700 dark:text-gray-300 font-medium">
                    {{ $exam->title }}
                </p>
                <span class="hidden sm:inline text-gray-500 dark:text-gray-400">•</span>
                <p class="text-gray-600 dark:text-gray-400">
                    Soal #{{ $examQuestion->order ?? '-' }}
                </p>
                @if($isTkp ?? false)
                    <span class="text-xs font-medium px-2 py-0.5 rounded-full bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400">
                        TKP (Bobot)
                    </span>
                @endif
            </div>
        </div>
    </div>

    {{-- ================= RINGKASAN STATISTIK ================= --}}
    @php
        $total = $summary['correct'] + $summary['wrong'] + $summary['empty'];
        $accuracy = $total > 0
            ? round(($summary['correct'] / $total) * 100, 2)
            : 0;
        $accuracyColor = $accuracy >= 70 ? 'text-green-600 dark:text-green-400' :
                        ($accuracy >= 40 ? 'text-yellow-600 dark:text-yellow-400' :
                        'text-red-600 dark:text-red-400');
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
        @php
            $stats = [
                ['label' => 'Total Peserta', 'value' => $total, 'icon' => 'users'],
                ['label' => 'Jawaban Benar', 'value' => $summary['correct'], 'icon' => 'check', 'color' => 'text-green-600 dark:text-green-400'],
                ['label' => 'Jawaban Salah', 'value' => $summary['wrong'], 'icon' => 'x', 'color' => 'text-red-600 dark:text-red-400'],
                ['label' => 'Akurasi', 'value' => $accuracy.'%', 'icon' => 'target', 'color' => $accuracyColor],
            ];
        @endphp

        @foreach ($stats as $stat)
            <div class="rounded-xl border border-azwara-lighter dark:border-azwara-darker
                        bg-white dark:bg-azwara-darker p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-1">
                            {{ $stat['label'] }}
                        </div>
                        <div class="text-2xl font-bold {{ $stat['color'] ?? 'text-azwara-darkest dark:text-white' }}">
                            {{ $stat['value'] }}
                        </div>
                    </div>
                    <div class="p-2 bg-azwara-lightest dark:bg-azwara-medium rounded-lg">
                        @if($stat['icon'] === 'users')
                            <svg class="w-6 h-6 text-azwara-medium dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-8a5.5 5.5 0 11-11 0 5.5 5.5 0 0111 0z"/>
                            </svg>
                        @elseif($stat['icon'] === 'check')
                            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"/>
                            </svg>
                        @elseif($stat['icon'] === 'x')
                            <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        @else
                            <svg class="w-6 h-6 text-azwara-medium dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- ================= DETAIL SOAL ================= --}}
    <div class="rounded-xl border border-azwara-lighter dark:border-azwara-darker
                bg-white dark:bg-azwara-darker p-6 mb-8">
        <div class="flex items-center gap-3 mb-5">
            <div class="p-2 bg-azwara-lightest dark:bg-azwara-medium rounded-lg">
                <svg class="w-5 h-5 text-azwara-medium dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <h2 class="text-xl font-bold text-azwara-darkest dark:text-white">
                Soal
            </h2>
            @if($isTkp ?? false)
                <span class="text-xs font-medium px-2 py-0.5 rounded-full bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400">
                    TKP (Bobot)
                </span>
            @endif
        </div>

        <div class="prose prose-sm dark:prose-invert max-w-none mb-5 tex2jax_process">
            {!! $question->question_text !!}
        </div>

        @if ($question->image)
            <div class="mt-4 border border-azwara-lighter dark:border-azwara-medium rounded-lg overflow-hidden">
                <img src="{{ asset('storage/'.$question->image) }}"
                     class="w-full h-auto max-w-2xl mx-auto"
                     alt="Gambar soal">
            </div>
        @endif

        @if($isTkp ?? false)
            <div class="mt-4 text-xs text-gray-500 dark:text-gray-400 italic bg-blue-50 dark:bg-blue-900/10 p-3 rounded-lg">
                💡 Soal TKP menggunakan sistem bobot. Jawaban dengan bobot maksimum dianggap benar.
            </div>
        @endif
    </div>

    {{-- ================= ANALISIS OPSI ================= --}}
    <div class="space-y-4 mb-10">
        <div class="flex items-center gap-3 mb-4">
            <div class="p-2 bg-azwara-lightest dark:bg-azwara-medium rounded-lg">
                <svg class="w-5 h-5 text-azwara-medium dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2
                            M9 5a2 2 0 002 2h2a2 2 0 002-2
                            M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <h2 class="text-xl font-bold text-azwara-darkest dark:text-white">
                Analisis Pilihan Jawaban
            </h2>
        </div>

        @php
            $maxWeight = $question->options->max('weight') ?? 0;
        @endphp

        @foreach ($question->options as $option)
            @php
                $stat = $optionStats[$option->id] ?? ['count'=>0,'percentage'=>0];

                // ===== WARNA BAR PERSENTASE =====
                $percentageColor = $stat['percentage'] > 50
                    ? 'bg-green-500'
                    : ($stat['percentage'] > 25 ? 'bg-yellow-500' : 'bg-red-500');

                // ===== KHUSUS TKP =====
                $isTkpQuestion = $isTkp ?? false;
                $isMaxWeight = $isTkpQuestion && $option->weight === $maxWeight && $maxWeight > 0;
                $optionWeight = $option->weight ?? 0;
            @endphp

            <div class="rounded-xl border p-5 transition-all duration-200
                {{ $isTkpQuestion 
                    ? ($isMaxWeight 
                        ? 'border-green-400 bg-gradient-to-r from-green-50 to-white dark:from-green-900/20 dark:to-azwara-darker shadow-sm'
                        : 'border-azwara-lighter dark:border-azwara-darker bg-white dark:bg-azwara-darker')
                    : ($option->is_correct 
                        ? 'border-green-400 bg-gradient-to-r from-green-50 to-white dark:from-green-900/20 dark:to-azwara-darker shadow-sm'
                        : 'border-azwara-lighter dark:border-azwara-darker bg-white dark:bg-azwara-darker')
                }}">

                <div class="flex flex-col md:flex-row md:items-start gap-4">

                    {{-- LABEL OPSI --}}
                    <div class="flex-shrink-0">
                        <div class="flex items-center gap-3 flex-wrap">
                            <div class="w-10 h-10 rounded-lg flex items-center justify-center font-bold
                                {{ $isTkpQuestion 
                                    ? ($isMaxWeight 
                                        ? 'bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-300'
                                        : 'bg-azwara-lightest dark:bg-azwara-medium text-azwara-medium dark:text-white')
                                    : ($option->is_correct 
                                        ? 'bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-300'
                                        : 'bg-azwara-lightest dark:bg-azwara-medium text-azwara-medium dark:text-white')
                                }}">
                                {{ $option->label }}
                            </div>

                            {{-- BADGE STATUS --}}
                            @if ($isTkpQuestion)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                    {{ $isMaxWeight
                                        ? 'bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-300'
                                        : 'bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300'
                                    }}">
                                    Bobot {{ $optionWeight }}
                                    @if ($isMaxWeight)
                                        ⭐ (Maksimal)
                                    @endif
                                </span>
                            @else
                                @if ($option->is_correct)
                                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold
                                                bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-300">
                                        ✔ Jawaban Benar
                                    </span>
                                @endif
                            @endif
                        </div>
                    </div>

                    {{-- KONTEN OPSI --}}
                    <div class="flex-1">
                        <div class="text-gray-800 dark:text-gray-200 mb-3 tex2jax_process">
                            {!! $option->option_text !!}
                        </div>

                        @if ($option->image)
                            <div class="mt-3 mb-4 border border-azwara-lighter dark:border-azwara-medium rounded-lg overflow-hidden max-w-xs">
                                <img src="{{ asset('storage/'.$option->image) }}"
                                    class="w-full h-auto"
                                    alt="Gambar opsi {{ $option->label }}">
                            </div>
                        @endif

                        {{-- STATISTIK PEMILIHAN --}}
                        <div class="mt-4">
                            <div class="flex items-center justify-between mb-2">
                                <div class="text-sm text-gray-600 dark:text-gray-400">
                                    <span class="font-medium">{{ $stat['count'] }}</span>
                                    dari {{ $totalAnswered }} peserta
                                </div>
                                <div class="text-sm font-semibold text-azwara-darkest dark:text-white">
                                    {{ $stat['percentage'] }}%
                                </div>
                            </div>

                            <div class="h-2 bg-azwara-lighter dark:bg-azwara-medium rounded-full overflow-hidden">
                                <div class="h-full {{ $percentageColor }} rounded-full transition-all duration-500"
                                    style="width: {{ min($stat['percentage'], 100) }}%">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- ================= PEMBAHASAN ================= --}}
    @if ($question->explanation)
        <div x-data="{ open: false }"
             class="rounded-xl border border-azwara-lighter dark:border-azwara-darker
                    bg-white dark:bg-azwara-darker p-6 mb-10">
            <button @click="open = !open"
                    class="w-full flex items-center justify-between text-left focus:outline-none">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-azwara-lightest dark:bg-azwara-medium rounded-lg">
                        <svg class="w-5 h-5 text-azwara-medium dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-azwara-darkest dark:text-white">
                        Pembahasan
                    </h3>
                </div>
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400 transform transition-transform duration-200"
                     :class="{ 'rotate-180': open }"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <div x-show="open" x-collapse
                 class="mt-6 pt-6 border-t border-azwara-lighter dark:border-azwara-medium">
                <div class="prose prose-sm dark:prose-invert max-w-none tex2jax_process">
                    {!! $question->explanation !!}
                </div>
            </div>
        </div>
    @endif

    {{-- ================= STATUS JAWABAN PESERTA ================= --}}
    <div>
        <div class="flex items-center gap-3 mb-6">
            <div class="p-2 bg-azwara-lightest dark:bg-azwara-medium rounded-lg">
                <svg class="w-5 h-5 text-azwara-medium dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-8a5.5 5.5 0 11-11 0 5.5 5.5 0 0111 0z"/>
                </svg>
            </div>
            <h2 class="text-xl font-bold text-azwara-darkest dark:text-white">
                Status Jawaban Peserta
            </h2>
        </div>

        <div class="rounded-xl border border-azwara-lighter dark:border-azwara-darker overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-azwara-lighter dark:divide-azwara-medium">
                    <thead class="bg-azwara-lightest dark:bg-azwara-darkest">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">
                                Nama Peserta
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">
                                Jawaban
                            </th>
                            <th scope="col" class="px-6 py-4 text-center text-sm font-semibold text-gray-700 dark:text-gray-300">
                                Status Jawaban
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-azwara-darker divide-y divide-azwara-lighter dark:divide-azwara-medium">
                        @forelse ($attemptRows as $row)
                            <tr class="hover:bg-azwara-lightest/50 dark:hover:bg-azwara-medium/20 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $row['user']->name }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @if($row['status'] === 'empty')
                                        <span class="text-gray-400 dark:text-gray-500 text-sm">Tidak menjawab</span>
                                    @else
                                        <div class="flex flex-wrap items-center gap-2">
                                            @foreach($row['selected_options'] as $index => $option)
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-medium
                                                    {{ ($isTkp ?? false) 
                                                        ? ($option->weight === $row['max_weight'] && $row['max_weight'] > 0 
                                                            ? 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400'
                                                            : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300')
                                                        : ($option->is_correct 
                                                            ? 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400'
                                                            : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300')
                                                    }}">
                                                    {{ $option->label }}
                                                    @if($isTkp ?? false)
                                                        <span class="text-xs opacity-75">({{ $option->weight }})</span>
                                                    @endif
                                                </span>
                                            @endforeach
                                            @if($isTkp ?? false)
                                                <span class="text-xs text-gray-400 dark:text-gray-500 ml-1">
                                                    Bobot: {{ $row['selected_weight'] }}/{{ $row['max_weight'] }}
                                                </span>
                                            @endif
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-semibold {{ $row['status_color'] }}">
                                        {{ $row['status_icon'] }} {{ $row['status_label'] }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-8 text-center">
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
    </div>

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