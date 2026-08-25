@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- ================= HEADER ================= --}}
    <div class="mb-8 pb-6 border-b border-neutral-200 dark:border-white/10">
        <a href="{{ route('exams.results', $exam) }}"
           class="group inline-flex items-center gap-2 text-sm font-medium
                  text-neutral-700 hover:text-primary-700
                  dark:text-neutral-500 dark:hover:text-primary-200 transition-colors mb-5">
            <svg class="w-4 h-4 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Hasil Ujian
        </a>

        <div>
            <div class="flex items-center gap-2.5 mb-2">
                <span class="h-5 w-1 rounded-full bg-brand-gradient"></span>
                <span class="text-[11px] font-semibold uppercase tracking-[0.14em] text-primary-600 dark:text-primary-300">
                    Statistik Butir Soal
                </span>
            </div>

            <h1 class="text-2xl md:text-3xl font-bold tracking-tight text-primary-900 dark:text-primary-50">
                Analisis Soal
            </h1>
            <div class="mt-2 flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-2">
                <p class="text-neutral-900 dark:text-neutral-200 font-medium">
                    {{ $exam->title }}
                </p>
                <span class="hidden sm:inline text-neutral-500 dark:text-neutral-700">•</span>
                <p class="text-neutral-700 dark:text-neutral-500">
                    Soal #{{ $examQuestion->order ?? '-' }}
                </p>
                @if($isTkp ?? false)
                    <span class="w-fit text-[11px] font-semibold px-2.5 py-0.5 rounded-full
                                 bg-secondary-50 text-secondary-700 ring-1 ring-inset ring-secondary-600/20
                                 dark:bg-secondary-500/15 dark:text-secondary-200 dark:ring-secondary-400/20">
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
                        ($accuracy >= 40 ? 'text-gold-600 dark:text-gold-400' :
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
                        <div class="text-3xl font-bold tracking-tight tabular-nums {{ $stat['color'] ?? 'text-primary-900 dark:text-primary-50' }}">
                            {{ $stat['value'] }}
                        </div>
                    </div>
                    <div class="flex-shrink-0 w-11 h-11 rounded-xl flex items-center justify-center
                                bg-neutral-50 dark:bg-white/5
                                border border-neutral-200 dark:border-white/10">
                        @if($stat['icon'] === 'users')
                            <svg class="w-5 h-5 text-primary-600 dark:text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-8a5.5 5.5 0 11-11 0 5.5 5.5 0 0111 0z"/>
                            </svg>
                        @elseif($stat['icon'] === 'check')
                            <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"/>
                            </svg>
                        @elseif($stat['icon'] === 'x')
                            <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        @else
                            <svg class="w-5 h-5 text-primary-600 dark:text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- ================= DETAIL SOAL ================= --}}
    <div class="rounded-2xl border border-neutral-200 dark:border-white/10
                bg-white dark:bg-primary-950 overflow-hidden shadow-sm mb-8">
        <div class="flex flex-wrap items-center gap-3 px-6 py-4
                    border-b border-neutral-200 dark:border-white/10
                    bg-neutral-50 dark:bg-white/[0.03]">
            <h2 class="flex items-center gap-2.5 text-base font-semibold text-primary-900 dark:text-primary-50">
                <span class="h-4 w-1 rounded-full bg-brand-gradient"></span>
                Soal
            </h2>
            @if($isTkp ?? false)
                <span class="text-[11px] font-semibold px-2.5 py-0.5 rounded-full
                             bg-secondary-50 text-secondary-700 ring-1 ring-inset ring-secondary-600/20
                             dark:bg-secondary-500/15 dark:text-secondary-200 dark:ring-secondary-400/20">
                    TKP (Bobot)
                </span>
            @endif
        </div>

        <div class="p-6">
            <div class="prose prose-sm dark:prose-invert max-w-none tex2jax_process">
                {!! $question->question_text !!}
            </div>

            @if ($question->image)
                <div class="mt-5 border border-neutral-200 dark:border-white/10 rounded-xl overflow-hidden bg-white">
                    <img src="{{ asset('storage/'.$question->image) }}"
                         class="w-full h-auto max-w-2xl mx-auto"
                         alt="Gambar soal">
                </div>
            @endif

            @if($isTkp ?? false)
                <div class="mt-5 text-xs italic
                            text-secondary-700 dark:text-secondary-200
                            bg-secondary-50 dark:bg-secondary-500/10
                            border border-secondary-200 dark:border-secondary-400/20
                            p-3.5 rounded-xl">
                    Soal TKP menggunakan sistem bobot. Jawaban dengan bobot maksimum dianggap benar.
                </div>
            @endif
        </div>
    </div>

    {{-- ================= ANALISIS OPSI ================= --}}
    <div class="space-y-3 mb-10">
        <div class="flex items-center gap-3 mb-5">
            <h2 class="flex items-center gap-2.5 text-lg font-bold tracking-tight text-primary-900 dark:text-primary-50">
                <span class="h-5 w-1 rounded-full bg-brand-gradient"></span>
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
                    : ($stat['percentage'] > 25 ? 'bg-gold-500' : 'bg-red-500');

                // ===== KHUSUS TKP =====
                $isTkpQuestion = $isTkp ?? false;
                $isMaxWeight = $isTkpQuestion && $option->weight === $maxWeight && $maxWeight > 0;
                $optionWeight = $option->weight ?? 0;
            @endphp

            <div class="rounded-2xl border p-5 shadow-sm transition-all duration-200
                {{ $isTkpQuestion
                    ? ($isMaxWeight
                        ? 'border-green-300 dark:border-green-500/30 bg-green-50/50 dark:bg-green-500/10'
                        : 'border-neutral-200 dark:border-white/10 bg-white dark:bg-primary-950')
                    : ($option->is_correct
                        ? 'border-green-300 dark:border-green-500/30 bg-green-50/50 dark:bg-green-500/10'
                        : 'border-neutral-200 dark:border-white/10 bg-white dark:bg-primary-950')
                }}">

                <div class="flex flex-col md:flex-row md:items-start gap-4">

                    {{-- LABEL OPSI --}}
                    <div class="flex-shrink-0">
                        <div class="flex items-center gap-3 flex-wrap">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center font-bold
                                {{ $isTkpQuestion
                                    ? ($isMaxWeight
                                        ? 'bg-green-100 dark:bg-green-500/20 text-green-700 dark:text-green-300 ring-1 ring-inset ring-green-600/20'
                                        : 'bg-neutral-100 dark:bg-white/10 text-neutral-800 dark:text-neutral-300')
                                    : ($option->is_correct
                                        ? 'bg-green-100 dark:bg-green-500/20 text-green-700 dark:text-green-300 ring-1 ring-inset ring-green-600/20'
                                        : 'bg-neutral-100 dark:bg-white/10 text-neutral-800 dark:text-neutral-300')
                                }}">
                                {{ $option->label }}
                            </div>

                            {{-- BADGE STATUS --}}
                            @if ($isTkpQuestion)
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold
                                    {{ $isMaxWeight
                                        ? 'bg-green-50 text-green-700 ring-1 ring-inset ring-green-600/20 dark:bg-green-500/15 dark:text-green-300 dark:ring-green-400/20'
                                        : 'bg-neutral-100 text-neutral-800 dark:bg-white/10 dark:text-neutral-300'
                                    }}">
                                    Bobot {{ $optionWeight }}
                                    @if ($isMaxWeight)
                                        <span class="text-gold-600 dark:text-gold-400">★</span> (Maksimal)
                                    @endif
                                </span>
                            @else
                                @if ($option->is_correct)
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold
                                                bg-green-50 text-green-700 ring-1 ring-inset ring-green-600/20
                                                dark:bg-green-500/15 dark:text-green-300 dark:ring-green-400/20">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Jawaban Benar
                                    </span>
                                @endif
                            @endif
                        </div>
                    </div>

                    {{-- KONTEN OPSI --}}
                    <div class="flex-1 min-w-0">
                        <div class="text-neutral-800 dark:text-neutral-200 mb-3 tex2jax_process">
                            {!! $option->option_text !!}
                        </div>

                        @if ($option->image)
                            <div class="mt-3 mb-4 border border-neutral-200 dark:border-white/10 rounded-xl overflow-hidden max-w-xs bg-white">
                                <img src="{{ asset('storage/'.$option->image) }}"
                                    class="w-full h-auto"
                                    alt="Gambar opsi {{ $option->label }}">
                            </div>
                        @endif

                        {{-- STATISTIK PEMILIHAN --}}
                        <div class="mt-4">
                            <div class="flex items-center justify-between mb-2">
                                <div class="text-sm text-neutral-700 dark:text-neutral-500">
                                    <span class="font-semibold text-neutral-900 dark:text-neutral-200 tabular-nums">{{ $stat['count'] }}</span>
                                    dari {{ $totalAnswered }} peserta
                                </div>
                                <div class="text-sm font-bold tabular-nums text-primary-900 dark:text-primary-50">
                                    {{ $stat['percentage'] }}%
                                </div>
                            </div>

                            <div class="h-2 bg-neutral-200 dark:bg-white/10 rounded-full overflow-hidden">
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
             class="rounded-2xl border border-neutral-200 dark:border-white/10
                    bg-white dark:bg-primary-950 p-6 mb-10 shadow-sm">
            <button @click="open = !open"
                    class="w-full flex items-center justify-between text-left focus:outline-none group">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center
                                bg-gold-50 dark:bg-gold-500/10
                                border border-gold-200 dark:border-gold-400/20">
                        <svg class="w-5 h-5 text-gold-600 dark:text-gold-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-semibold text-primary-900 dark:text-primary-50 group-hover:text-primary-700 dark:group-hover:text-primary-200 transition-colors">
                        Pembahasan
                    </h3>
                </div>
                <svg class="w-5 h-5 text-neutral-600 dark:text-neutral-500 transform transition-transform duration-200"
                     :class="{ 'rotate-180': open }"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <div x-show="open" x-collapse
                 class="mt-6 pt-6 border-t border-neutral-200 dark:border-white/10">
                <div class="prose prose-sm dark:prose-invert max-w-none tex2jax_process">
                    {!! $question->explanation !!}
                </div>
            </div>
        </div>
    @endif

    {{-- ================= STATUS JAWABAN PESERTA ================= --}}
    <div>
        <div class="flex items-center gap-3 mb-5">
            <h2 class="flex items-center gap-2.5 text-lg font-bold tracking-tight text-primary-900 dark:text-primary-50">
                <span class="h-5 w-1 rounded-full bg-brand-gradient"></span>
                Status Jawaban Peserta
            </h2>
        </div>

        <div class="rounded-2xl border border-neutral-200 dark:border-white/10 overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-neutral-200 dark:divide-white/10">
                    <thead class="bg-neutral-50 dark:bg-white/[0.03]">
                        <tr>
                            <th scope="col" class="px-6 py-3.5 text-left text-[11px] font-semibold text-neutral-700 dark:text-neutral-500 uppercase tracking-[0.12em]">
                                Nama Peserta
                            </th>
                            <th scope="col" class="px-6 py-3.5 text-left text-[11px] font-semibold text-neutral-700 dark:text-neutral-500 uppercase tracking-[0.12em]">
                                Jawaban
                            </th>
                            <th scope="col" class="px-6 py-3.5 text-center text-[11px] font-semibold text-neutral-700 dark:text-neutral-500 uppercase tracking-[0.12em]">
                                Status Jawaban
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-primary-950 divide-y divide-neutral-200 dark:divide-white/10">
                        @forelse ($attemptRows as $row)
                            <tr class="hover:bg-neutral-50 dark:hover:bg-white/[0.04] transition-colors">
                                <td class="px-6 py-4">
                                    <div class="text-sm font-semibold text-neutral-900 dark:text-neutral-100">
                                        {{ $row['user']->name }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @if($row['status'] === 'empty')
                                        <span class="text-neutral-600 dark:text-neutral-600 text-sm italic">Tidak menjawab</span>
                                    @else
                                        <div class="flex flex-wrap items-center gap-2">
                                            @foreach($row['selected_options'] as $index => $option)
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-semibold
                                                    {{ ($isTkp ?? false)
                                                        ? ($option->weight === $row['max_weight'] && $row['max_weight'] > 0
                                                            ? 'bg-green-50 dark:bg-green-500/15 text-green-700 dark:text-green-300 ring-1 ring-inset ring-green-600/15'
                                                            : 'bg-neutral-100 dark:bg-white/10 text-neutral-800 dark:text-neutral-300')
                                                        : ($option->is_correct
                                                            ? 'bg-green-50 dark:bg-green-500/15 text-green-700 dark:text-green-300 ring-1 ring-inset ring-green-600/15'
                                                            : 'bg-neutral-100 dark:bg-white/10 text-neutral-800 dark:text-neutral-300')
                                                    }}">
                                                    {{ $option->label }}
                                                    @if($isTkp ?? false)
                                                        <span class="text-xs opacity-70">({{ $option->weight }})</span>
                                                    @endif
                                                </span>
                                            @endforeach
                                            @if($isTkp ?? false)
                                                <span class="text-xs text-neutral-600 dark:text-neutral-600 ml-1 tabular-nums">
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
                                <td colspan="3" class="px-6 py-16 text-center">
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
