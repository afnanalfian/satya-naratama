@extends('layouts.app')

@section('content')
<div x-data="{ openAddQuestion: false }" class="max-w-6xl mx-auto space-y-8">

    {{-- ================= HEADER ================= --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-azwara-darker dark:text-azwara-lighter">
                Edit Exam
            </h1>

            <p class="text-gray-600 dark:text-gray-300">
                {{ ucfirst($exam->type) }}
            </p>
        </div>

        @php
            $statusColor = match($exam->status) {
                'inactive' => 'bg-gray-400',
                'active'   => 'bg-green-600',
                'closed'   => 'bg-red-600',
            };
        @endphp

        <span
            class="inline-flex w-fit items-center
                px-3 py-1 text-sm rounded-full
                text-white {{ $statusColor }}">
            {{ ucfirst($exam->status) }}
        </span>
    </div>

    {{-- ================= FORM ================= --}}
    <div class="bg-azwara-lightest dark:bg-secondary/80
                rounded-2xl p-6
                border border-azwara-light/30 dark:border-white/10">

        <form method="POST"
            action="{{ route('exams.update', $exam) }}"
            class="space-y-6">

            @csrf
            @method('PUT')
            {{-- ================= TITLE (QUIZ / TRYOUT) ================= --}}
            @if(in_array($exam->type, ['quiz', 'tryout']))
                <div>
                    <label class="block text-sm font-medium mb-1 dark:text-azwara-lightest">
                        Judul
                    </label>

                    <input type="text"
                        name="title"
                        value="{{ old('title', $exam->title) }}"
                        class="w-full rounded-lg
                                border-gray-300 dark:border-white/10
                                bg-white dark:bg-secondary
                                dark:text-white
                                focus:ring-primary focus:border-primary"
                        @disabled($exam->status !== 'inactive')>
                </div>
            @endif

            {{-- ================= TEST TYPE (READ ONLY) ================= --}}
            <div>
                <label class="block text-sm font-medium mb-1 dark:text-azwara-lightest">
                    Tipe Tes
                </label>

                <div
                    class="w-full sm:w-64 rounded-lg
                        px-3 py-2
                        bg-gray-100 dark:bg-white/5
                        border border-gray-300 dark:border-white/10
                        text-gray-700 dark:text-gray-200
                        cursor-not-allowed">

                    {{ strtoupper($exam->test_type) }}
                </div>

                <p class="text-xs text-gray-500 mt-1">
                    Tipe tes tidak dapat diubah setelah ujian dibuat.
                </p>
            </div>
            
            {{-- ================= TANGGAL & JAM (QUIZ / TRYOUT) ================= --}}
            @if(in_array($exam->type, ['quiz', 'tryout']))
                <div>
                    <label class="block text-sm font-medium mb-1 dark:text-azwara-lightest">
                        Tanggal & Jam Mulai
                    </label>

                    <input type="datetime-local"
                        name="exam_date"
                        value="{{ old(
                                'exam_date',
                                optional($exam->exam_date)->format('Y-m-d\TH:i')
                        ) }}"
                        class="w-full rounded-lg
                                border-gray-300 dark:border-white/10
                                bg-white dark:bg-secondary
                                dark:text-white
                                focus:ring-primary focus:border-primary"
                        @disabled($exam->status !== 'inactive')>
                </div>
            @endif

            {{-- ================= DURASI (SEMUA TIPE) ================= --}}
            <div>
                <label class="block text-sm font-medium mb-1 dark:text-azwara-lightest">
                    Durasi Ujian (menit)
                </label>

                <input type="number"
                    name="duration_minutes"
                    min="1"
                    value="{{ old('duration_minutes', $exam->duration_minutes) }}"
                    class="w-full sm:w-64 rounded-lg
                            border-gray-300 dark:border-white/10
                            bg-white dark:bg-secondary
                            dark:text-white
                            focus:ring-primary focus:border-primary"
                    @disabled($exam->status !== 'inactive')>
            </div>

            {{-- ================= ACTION ================= --}}
            @if($exam->status === 'inactive')
                <div class="pt-4">
                    <button type="submit"
                            class="px-6 py-2 rounded-lg
                                bg-primary text-white
                                hover:bg-primary/90 transition">
                        💾 Simpan Perubahan
                    </button>
                </div>
            @else
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Exam sudah aktif / ditutup, data tidak dapat diubah.
                </p>
            @endif

        </form>
    </div>

    @include('exams.partials.selected-questions')

    {{-- ================= ACTION ================= --}}
    <div class="flex flex-wrap gap-3">

        @if($exam->status === 'inactive')
            <form method="POST"
                  action="{{ route('exams.activate', $exam) }}"
                  class="sweet-confirm"
                  data-message="Yakin ingin memulai post test?">
                @csrf
                <button class="px-5 py-2 rounded-lg bg-green-600 text-white hover:bg-green-700">
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
                <button class="px-5 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">
                    Tutup Ujian
                </button>
            </form>
        @endif

        <a href="{{ $exam->backRoute() }}"
        class="px-4 py-2 rounded-lg
                text-gray-600 dark:text-gray-300
                hover:bg-gray-100 dark:hover:bg-white/5">
            ← Kembali
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
