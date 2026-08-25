@extends('layouts.app')

@section('content')
<div x-data="{ openAddQuestion: false }" class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">

    {{-- ================= HEADER ================= --}}
    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4
                pb-6 border-b border-neutral-200 dark:border-white/10">
        <div>
            <div class="flex items-center gap-2.5 mb-2">
                <span class="h-5 w-1 rounded-full bg-brand-gradient"></span>
                <span class="text-[11px] font-semibold uppercase tracking-[0.14em] text-primary-600 dark:text-primary-300">
                    {{ ucfirst($exam->type) }}
                </span>
            </div>

            <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-primary-900 dark:text-primary-50">
                Edit Exam
            </h1>

            <p class="mt-1.5 text-sm text-neutral-700 dark:text-neutral-500">
                Atur detail ujian dan susunan soal sebelum diluncurkan
            </p>
        </div>

        @php
            $statusColor = match($exam->status) {
                'inactive' => 'bg-gold-50 text-gold-700 ring-gold-600/20 dark:bg-gold-500/15 dark:text-gold-200 dark:ring-gold-400/20',
                'active'   => 'bg-primary-50 text-primary-700 ring-primary-600/20 dark:bg-primary-500/15 dark:text-primary-200 dark:ring-primary-400/20',
                'closed'   => 'bg-neutral-100 text-neutral-800 ring-neutral-400/30 dark:bg-white/10 dark:text-neutral-300 dark:ring-white/10',
            };
        @endphp

        <span
            class="inline-flex w-fit items-center gap-2
                px-3.5 py-1.5 text-sm font-medium rounded-full
                ring-1 ring-inset {{ $statusColor }}">
            <span class="w-1.5 h-1.5 rounded-full bg-current opacity-70"></span>
            {{ ucfirst($exam->status) }}
        </span>
    </div>

    {{-- ================= FORM ================= --}}
    <div class="bg-white dark:bg-primary-950
                rounded-2xl overflow-hidden
                border border-neutral-200 dark:border-white/10
                shadow-sm">

        <div class="px-6 py-4 border-b border-neutral-200 dark:border-white/10
                    bg-neutral-50 dark:bg-white/[0.03]">
            <h2 class="text-base font-semibold text-primary-900 dark:text-primary-50">
                Detail Ujian
            </h2>
            <p class="text-xs text-neutral-700 dark:text-neutral-600 mt-0.5">
                Informasi dasar yang tampil ke peserta
            </p>
        </div>

        <form method="POST"
            action="{{ route('exams.update', $exam) }}"
            class="p-6 space-y-6">

            @csrf
            @method('PUT')
            {{-- ================= TITLE (QUIZ / TRYOUT) ================= --}}
            @if(in_array($exam->type, ['quiz', 'tryout']))
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-[0.08em] mb-1.5
                                  text-neutral-700 dark:text-neutral-500">
                        Judul
                    </label>

                    <input type="text"
                        name="title"
                        value="{{ old('title', $exam->title) }}"
                        class="w-full rounded-xl
                                border border-neutral-300 dark:border-white/10
                                bg-white dark:bg-white/5
                                px-3.5 py-2.5 text-sm
                                text-neutral-900 dark:text-neutral-100
                                shadow-sm
                                disabled:bg-neutral-100 dark:disabled:bg-white/[0.03]
                                disabled:text-neutral-700 disabled:cursor-not-allowed
                                focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20
                                transition"
                        @disabled($exam->status !== 'inactive')>
                </div>
            @endif

            {{-- ================= TEST TYPE (READ ONLY) ================= --}}
            <div>
                <label class="block text-xs font-semibold uppercase tracking-[0.08em] mb-1.5
                              text-neutral-700 dark:text-neutral-500">
                    Tipe Tes
                </label>

                <div
                    class="w-full sm:w-64 rounded-xl
                        px-3.5 py-2.5
                        bg-neutral-100 dark:bg-white/[0.04]
                        border border-neutral-300 dark:border-white/10
                        text-sm font-semibold tracking-wide
                        text-neutral-800 dark:text-neutral-300
                        cursor-not-allowed
                        flex items-center gap-2">

                    <svg class="w-4 h-4 text-neutral-600 dark:text-neutral-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    {{ strtoupper($exam->test_type) }}
                </div>

                <p class="text-xs text-neutral-700 dark:text-neutral-600 mt-1.5">
                    Tipe tes tidak dapat diubah setelah ujian dibuat.
                </p>
            </div>

            {{-- ================= TANGGAL & JAM (QUIZ / TRYOUT) ================= --}}
            @if(in_array($exam->type, ['quiz', 'tryout']))
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-[0.08em] mb-1.5
                                  text-neutral-700 dark:text-neutral-500">
                        Tanggal & Jam Mulai
                    </label>

                    <input type="datetime-local"
                        name="exam_date"
                        value="{{ old(
                                'exam_date',
                                optional($exam->exam_date)->format('Y-m-d\TH:i')
                        ) }}"
                        class="w-full rounded-xl
                                border border-neutral-300 dark:border-white/10
                                bg-white dark:bg-white/5
                                px-3.5 py-2.5 text-sm
                                text-neutral-900 dark:text-neutral-100
                                shadow-sm
                                disabled:bg-neutral-100 dark:disabled:bg-white/[0.03]
                                disabled:text-neutral-700 disabled:cursor-not-allowed
                                focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20
                                transition"
                        @disabled($exam->status !== 'inactive')>
                </div>
            @endif

            {{-- ================= DURASI (SEMUA TIPE) ================= --}}
            <div>
                <label class="block text-xs font-semibold uppercase tracking-[0.08em] mb-1.5
                              text-neutral-700 dark:text-neutral-500">
                    Durasi Ujian (menit)
                </label>

                <input type="number"
                    name="duration_minutes"
                    min="1"
                    value="{{ old('duration_minutes', $exam->duration_minutes) }}"
                    class="w-full sm:w-64 rounded-xl
                            border border-neutral-300 dark:border-white/10
                            bg-white dark:bg-white/5
                            px-3.5 py-2.5 text-sm tabular-nums
                            text-neutral-900 dark:text-neutral-100
                            shadow-sm
                            disabled:bg-neutral-100 dark:disabled:bg-white/[0.03]
                            disabled:text-neutral-700 disabled:cursor-not-allowed
                            focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20
                            transition"
                    @disabled($exam->status !== 'inactive')>
            </div>

            {{-- ================= ACTION ================= --}}
            @if($exam->status === 'inactive')
                <div class="pt-5 border-t border-neutral-200 dark:border-white/10">
                    <button type="submit"
                            class="inline-flex items-center gap-2
                                px-5 py-2.5 rounded-xl
                                bg-primary-600 text-white text-sm font-semibold
                                shadow-sm hover:bg-primary-700 active:bg-primary-800
                                focus:outline-none focus:ring-2 focus:ring-primary-500/40
                                transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            @else
                <div class="pt-5 border-t border-neutral-200 dark:border-white/10">
                    <p class="inline-flex items-start gap-2.5 text-sm
                              text-neutral-700 dark:text-neutral-500
                              bg-neutral-50 dark:bg-white/[0.03]
                              border border-neutral-200 dark:border-white/10
                              rounded-xl px-4 py-3">
                        <svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-gold-600 dark:text-gold-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Exam sudah aktif / ditutup, data tidak dapat diubah.
                    </p>
                </div>
            @endif

        </form>
    </div>

    @include('exams.partials.selected-questions')

    {{-- ================= ACTION ================= --}}
    <div class="flex flex-wrap items-center gap-3
                pt-6 border-t border-neutral-200 dark:border-white/10">

        @if($exam->status === 'inactive')
            <form method="POST"
                  action="{{ route('exams.activate', $exam) }}"
                  class="sweet-confirm"
                  data-message="Yakin ingin memulai post test?">
                @csrf
                <button class="inline-flex items-center gap-2
                               px-5 py-2.5 rounded-xl
                               bg-primary-600 text-white text-sm font-semibold
                               shadow-sm hover:bg-primary-700 active:bg-primary-800
                               focus:outline-none focus:ring-2 focus:ring-primary-500/40
                               transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Launch Ujian
                </button>
            </form>
        @endif

        @if($exam->status === 'active')
            <form method="POST"
                  action="{{ route('exams.close', $exam) }}"
                  class="sweet-confirm"
                  data-message="Yakin ingin menutup post test?">
                @csrf
                <button class="inline-flex items-center gap-2
                               px-5 py-2.5 rounded-xl
                               bg-accent-600 text-white text-sm font-semibold
                               shadow-sm hover:bg-accent-700 active:bg-accent-800
                               focus:outline-none focus:ring-2 focus:ring-accent-500/40
                               transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Tutup Ujian
                </button>
            </form>
        @endif

        <a href="{{ $exam->backRoute() }}"
        class="inline-flex items-center gap-2
                px-4 py-2.5 rounded-xl text-sm font-semibold
                text-neutral-800 dark:text-neutral-300
                border border-neutral-300 dark:border-white/15
                bg-white dark:bg-white/5
                hover:bg-neutral-50 dark:hover:bg-white/10
                focus:outline-none focus:ring-2 focus:ring-neutral-400/30
                transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>

@include('exams.partials.add-question-modal')
</div>
@endsection
@push('scripts')
<script>
window.MathJax = {
    tex: {
        inlineMath: [['\\(', '\\)']]
    }
};
</script>

<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    if (window.MathJax) {
        MathJax.typesetPromise();
    }
});
</script>

@endpush
