{{-- exams/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div x-data="{ openAddQuestion: false }" class="max-w-7xl mx-auto space-y-8 py-6">

    {{-- ================= HEADER ================= --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="flex items-center gap-3 mb-1">
                <h1 class="text-3xl font-bold tracking-tight text-neutral-900 dark:text-white">
                    Edit Ujian
                </h1>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                    @if($exam->status === 'inactive')
                        bg-yellow-50 text-yellow-700 dark:bg-yellow-900/20 dark:text-yellow-400
                        ring-1 ring-yellow-600/20
                    @elseif($exam->status === 'active')
                        bg-green-50 text-green-700 dark:bg-green-900/20 dark:text-green-400
                        ring-1 ring-green-600/20
                    @else
                        bg-neutral-50 text-neutral-600 dark:bg-neutral-800 dark:text-neutral-400
                        ring-1 ring-neutral-600/20
                    @endif
                ">
                    <span class="w-1.5 h-1.5 rounded-full mr-1.5
                        @if($exam->status === 'active') bg-green-500
                        @elseif($exam->status === 'inactive') bg-yellow-500
                        @else bg-neutral-400 @endif
                    "></span>
                    {{ ucfirst($exam->status) }}
                </span>
            </div>
            <p class="text-sm text-neutral-500 dark:text-neutral-400">
                {{ ucfirst($exam->type) }} • {{ strtoupper($exam->test_type) }}
            </p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ $exam->backRoute() }}"
               class="inline-flex items-center px-4 py-2.5 rounded-xl text-sm font-medium
                      bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-700
                      text-neutral-700 dark:text-neutral-300
                      hover:bg-neutral-50 dark:hover:bg-neutral-800
                      transition-all duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </div>

    {{-- ================= FORM ================= --}}
    <div class="bg-white dark:bg-neutral-900
                rounded-2xl p-6
                border border-neutral-200 dark:border-neutral-700
                shadow-sm">

        <form method="POST"
            action="{{ route('exams.update', $exam) }}"
            class="space-y-6">

            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- ================= TITLE ================= --}}
                @if(in_array($exam->type, ['quiz', 'tryout']))
                    <div>
                        <label class="block text-sm font-medium mb-1.5 text-neutral-700 dark:text-neutral-300">
                            Judul Ujian
                        </label>
                        <input type="text"
                            name="title"
                            value="{{ old('title', $exam->title) }}"
                            class="w-full rounded-xl
                                    border border-neutral-200 dark:border-neutral-700
                                    bg-white dark:bg-neutral-900
                                    px-4 py-2.5 text-sm
                                    text-neutral-900 dark:text-white
                                    placeholder:text-neutral-400 dark:placeholder:text-neutral-500
                                    focus:ring-2 focus:ring-primary/20 focus:border-primary
                                    transition-all duration-200
                                    @disabled($exam->status !== 'inactive')
                                    @if($exam->status !== 'inactive') opacity-60 cursor-not-allowed @endif">
                    </div>
                @endif

                {{-- ================= TEST TYPE (READ ONLY) ================= --}}
                <div>
                    <label class="block text-sm font-medium mb-1.5 text-neutral-700 dark:text-neutral-300">
                        Tipe Tes
                    </label>
                    <div class="w-full rounded-xl
                                px-4 py-2.5 text-sm
                                bg-neutral-100 dark:bg-neutral-800
                                border border-neutral-200 dark:border-neutral-700
                                text-neutral-700 dark:text-neutral-300
                                cursor-not-allowed">
                        {{ strtoupper($exam->test_type) }}
                    </div>
                    <p class="text-xs text-neutral-500 dark:text-neutral-400 mt-1.5">
                        Tipe tes tidak dapat diubah setelah ujian dibuat.
                    </p>
                </div>

                {{-- ================= TANGGAL & JAM ================= --}}
                @if(in_array($exam->type, ['quiz', 'tryout']))
                    <div>
                        <label class="block text-sm font-medium mb-1.5 text-neutral-700 dark:text-neutral-300">
                            Tanggal & Jam Mulai
                        </label>
                        <input type="datetime-local"
                            name="exam_date"
                            value="{{ old('exam_date', optional($exam->exam_date)->format('Y-m-d\TH:i')) }}"
                            class="w-full rounded-xl
                                    border border-neutral-200 dark:border-neutral-700
                                    bg-white dark:bg-neutral-900
                                    px-4 py-2.5 text-sm
                                    text-neutral-900 dark:text-white
                                    focus:ring-2 focus:ring-primary/20 focus:border-primary
                                    transition-all duration-200
                                    @disabled($exam->status !== 'inactive')
                                    @if($exam->status !== 'inactive') opacity-60 cursor-not-allowed @endif">
                    </div>
                @endif

                {{-- ================= DURASI ================= --}}
                <div>
                    <label class="block text-sm font-medium mb-1.5 text-neutral-700 dark:text-neutral-300">
                        Durasi Ujian (menit)
                    </label>
                    <input type="number"
                        name="duration_minutes"
                        min="1"
                        value="{{ old('duration_minutes', $exam->duration_minutes) }}"
                        class="w-full rounded-xl
                                border border-neutral-200 dark:border-neutral-700
                                bg-white dark:bg-neutral-900
                                px-4 py-2.5 text-sm
                                text-neutral-900 dark:text-white
                                focus:ring-2 focus:ring-primary/20 focus:border-primary
                                transition-all duration-200
                                @disabled($exam->status !== 'inactive')
                                @if($exam->status !== 'inactive') opacity-60 cursor-not-allowed @endif">
                </div>
            </div>

            {{-- ================= ACTION ================= --}}
            @if($exam->status === 'inactive')
                <div class="pt-4 border-t border-neutral-200 dark:border-neutral-700">
                    <button type="submit"
                            class="px-6 py-2.5 rounded-xl
                                bg-primary text-white text-sm font-medium
                                hover:bg-primary-600
                                active:scale-[0.98]
                                transition-all duration-200
                                shadow-sm hover:shadow-md">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            @else
                <div class="pt-4 border-t border-neutral-200 dark:border-neutral-700">
                    <p class="text-sm text-neutral-500 dark:text-neutral-400">
                        <svg class="w-4 h-4 inline mr-2 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Exam sudah aktif / ditutup, data tidak dapat diubah.
                    </p>
                </div>
            @endif

        </form>
    </div>

    {{-- ================= SOAL TERPILIH ================= --}}
    @include('exams.partials.selected-questions')

    {{-- ================= ACTION BUTTONS ================= --}}
    <div class="flex flex-wrap gap-3 pt-2">

        @if($exam->status === 'inactive')
            <form method="POST"
                  action="{{ route('exams.activate', $exam) }}"
                  class="sweet-confirm"
                  data-message="Yakin ingin memulai ujian ini?">
                @csrf
                <button class="inline-flex items-center px-5 py-2.5 rounded-xl
                               bg-green-600 text-white text-sm font-medium
                               hover:bg-green-700
                               active:scale-[0.98]
                               transition-all duration-200
                               shadow-sm hover:shadow-md">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Launch Ujian
                </button>
            </form>
        @endif

        @if($exam->status === 'active')
            <form method="POST"
                  action="{{ route('exams.close', $exam) }}"
                  class="sweet-confirm"
                  data-message="Yakin ingin menutup ujian ini?">
                @csrf
                <button class="inline-flex items-center px-5 py-2.5 rounded-xl
                               bg-red-600 text-white text-sm font-medium
                               hover:bg-red-700
                               active:scale-[0.98]
                               transition-all duration-200
                               shadow-sm hover:shadow-md">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Tutup Ujian
                </button>
            </form>
        @endif

        @if(in_array($exam->status, ['inactive', 'closed']))
            <form method="POST"
                  action="{{ route('exams.destroy', $exam) }}"
                  class="sweet-confirm"
                  data-message="Yakin ingin menghapus exam ini? Data akan diarsipkan.">
                @csrf
                @method('DELETE')
                <button class="inline-flex items-center px-5 py-2.5 rounded-xl
                               text-sm font-medium
                               text-red-600 hover:bg-red-50
                               dark:text-red-400 dark:hover:bg-red-900/20
                               transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Hapus
                </button>
            </form>
        @endif
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
