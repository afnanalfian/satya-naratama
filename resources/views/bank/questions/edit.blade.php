@extends('layouts.app')

@section('content')
@php
    $question = $question ?? null;
    $material = $question ? $question->material : $material;
@endphp

<form method="POST"
      action="{{ $question ? route('bank.question.update', $question) : route('bank.material.questions.store', $material) }}"
      enctype="multipart/form-data"
      class="max-w-5xl mx-auto space-y-6">
    @csrf
    @if($question) @method('PUT') @endif

    {{-- HEADER --}}
    <div class="bg-azwara-lightest dark:bg-azwara-darker rounded-xl shadow p-6">
        <h1 class="text-2xl font-bold text-secondary dark:text-azwara-lighter">
            {{ $question ? 'Edit' : 'Tambah' }} Soal – {{ $material->name }}
        </h1>
        <p class="text-gray-600 dark:text-gray-300 mt-1">
            {{ $question ? 'Edit' : 'Buat' }} soal dengan teks, gambar, dan rumus matematika.
        </p>
    </div>

    {{-- =========================
    | TIPE TEST (EDIT)
    ========================= --}}
    <div class="bg-azwara-lightest dark:bg-azwara-darker rounded-xl p-4 shadow-sm">
        <label class="block text-sm font-semibold mb-1">
            Tipe Test
        </label>

        <select id="test-type"
                class="w-full rounded-lg border p-2
                    bg-azwara-lightest dark:bg-secondary/40
                    cursor-not-allowed opacity-80"
                disabled>
            <option value="general" {{ $question->test_type === 'general' ? 'selected' : '' }}>General</option>
            <option value="tiu" {{ $question->test_type === 'tiu' ? 'selected' : '' }}>TIU</option>
            <option value="twk" {{ $question->test_type === 'twk' ? 'selected' : '' }}>TWK</option>
            <option value="mtk_stis" {{ $question->test_type === 'mtk_stis' ? 'selected' : '' }}>MTK STIS</option>
            <option value="tkp" {{ $question->test_type === 'tkp' ? 'selected' : '' }}>TKP</option>
            <option value="tpa" {{ $question->test_type === 'tpa' ? 'selected' : '' }}>TPA</option>
            <option value="tbi" {{ $question->test_type === 'tbi' ? 'selected' : '' }}>TBI</option>
            <option value="mtk_tka" {{ $question->test_type === 'mtk_tka' ? 'selected' : '' }}>MTK TKA</option>
        </select>

        {{-- kirim value ke backend --}}
        <input type="hidden" name="test_type" value="{{ $question->test_type }}">

        <p class="text-xs text-gray-500 mt-1">
            Tipe test tidak dapat diubah saat edit soal.
        </p>
    </div>

    {{-- TIPE SOAL --}}
    <div class="bg-azwara-lightest text-secondary dark:bg-azwara-darker dark:text-azwara-lighter rounded-xl shadow p-6 space-y-2">
        <label class="font-semibold">Tipe Soal</label>
        <select id="question-type" name="type"
                class="w-full rounded-lg border p-2
                       bg-azwara-lightest dark:bg-secondary/40
                       text-slate-800 dark:text-white">
            <option value="">-- Pilih Tipe --</option>
            <option value="mcq" {{ old('type', $question->type ?? '') == 'mcq' ? 'selected' : '' }}>Pilihan Ganda (1 Benar)</option>
            <option value="mcma" {{ old('type', $question->type ?? '') == 'mcma' ? 'selected' : '' }}>Pilihan Ganda (Banyak Benar)</option>
            <option value="truefalse" {{ old('type', $question->type ?? '') == 'truefalse' ? 'selected' : '' }}>Benar / Salah</option>
            <option value="short_answer" {{ old('type', $question->type ?? '') == 'short_answer' ? 'selected' : '' }}>Isian Singkat</option>
            <option value="compound" {{ old('type', $question->type ?? '') == 'compound' ? 'selected' : '' }}>Soal Kompleks</option>
        </select>
    </div>

    {{-- SOAL --}}
    <div class="bg-azwara-lightest text-secondary dark:bg-azwara-darker dark:text-azwara-lighter rounded-xl shadow p-6 space-y-4">
        <h2 class="text-lg font-semibold">Soal</h2>

        <textarea id="question-text"
                  name="question_text"
                  rows="4"
                  class="w-full rounded-lg border p-3
                         bg-azwara-lightest dark:bg-secondary/30
                         text-slate-800 dark:text-white"
                  placeholder="Tulis soal di sini...">{{ old('question_text', $question->question_text ?? '') }}</textarea>

        <div class="space-y-2">
            <input type="file" name="question_image" class="text-sm">
            @if($question && $question->image)
                <div class="text-sm text-gray-600 dark:text-gray-300">
                    Gambar saat ini: {{ basename($question->image) }}
                </div>
            @endif
        </div>

        <button type="button"
                class="btn-open-math px-4 py-2 bg-secondary text-white dark:bg-azwara-lighter dark:text-secondary rounded-lg"
                data-target="question-text">
            + Sisipkan Rumus
        </button>
        <div class="mt-4">
            <div class="text-sm font-semibold mb-1 opacity-70">
                Preview Soal
            </div>

            <div id="question-preview"
                class="prose dark:prose-invert
                        max-w-none
                        p-4 rounded-lg
                        bg-slate-50 dark:bg-secondary/30
                        border border-slate-200 dark:border-white/10">
                @if($question && $question->question_text)
                    {!! $question->question_text !!}
                @else
                    <span class="opacity-50">Belum ada isi...</span>
                @endif
            </div>
        </div>
    </div>

    {{-- OPSI JAWABAN --}}
    <div id="options-section" class="bg-azwara-lightest text-secondary dark:bg-azwara-darker dark:text-azwara-lighter rounded-xl shadow p-6 space-y-4 hidden">
        <h2 class="text-lg font-semibold">Opsi Jawaban</h2>

        <div id="options-wrapper" class="space-y-4"></div>

        <button type="button" id="add-option"
                class="px-3 py-1 rounded bg-primary text-white">
            + Tambah Opsi
        </button>
    </div>

    {{-- SHORT ANSWER SECTION --}}
    <div id="short-answer-section" class="bg-azwara-lightest text-secondary dark:bg-azwara-darker dark:text-azwara-lighter rounded-xl shadow p-6 space-y-4 hidden">
        <h2 class="text-lg font-semibold">Jawaban Isian Singkat</h2>
        <p class="text-sm text-gray-600 dark:text-gray-300">
            Tambahkan semua kemungkinan jawaban yang benar (non-case-sensitive, spasi diabaikan).
        </p>

        <div id="short-answers-wrapper" class="space-y-3">
            <!-- Short answers will be added here dynamically -->
        </div>

        <button type="button" id="add-short-answer" class="px-3 py-1 rounded bg-primary text-white">
            + Tambah Jawaban
        </button>
    </div>

    {{-- COMPOUND SECTION --}}
    <div id="compound-section" class="bg-azwara-lightest text-secondary dark:bg-azwara-darker dark:text-azwara-lighter rounded-xl shadow p-6 space-y-4 hidden">
        <h2 class="text-lg font-semibold">Sub Pertanyaan (Kompleks)</h2>
        <p class="text-sm text-gray-600 dark:text-gray-300">
            Tambahkan sub pertanyaan. Jika satu sub salah, seluruh soal dianggap salah.
        </p>

        <div id="compound-items-wrapper" class="space-y-6">
            <!-- Sub items will be added here -->
        </div>

        <button type="button" id="add-compound-item" class="px-3 py-2 rounded bg-primary text-white">
            + Tambah Sub Pertanyaan
        </button>
    </div>

    {{-- PEMBAHASAN / EXPLANATION --}}
    <div class="bg-azwara-lightest text-secondary dark:bg-azwara-darker dark:text-azwara-lighter rounded-xl shadow p-6 space-y-4">
        <h2 class="text-lg font-semibold">Pembahasan</h2>

        <textarea id="explanation-text"
                name="explanation"
                rows="4"
                class="w-full rounded-lg border p-3
                        bg-azwara-lightest dark:bg-secondary/30
                        text-slate-800 dark:text-white"
                placeholder="Tulis pembahasan jawaban di sini (opsional)...">{{ old('explanation', $question->explanation ?? '') }}</textarea>

        <button type="button"
                class="btn-open-math px-4 py-2 bg-secondary text-white dark:bg-azwara-lighter dark:text-secondary rounded-lg"
                data-target="explanation-text">
            + Sisipkan Rumus
        </button>

        <div class="mt-4">
            <div class="text-sm font-semibold mb-1 opacity-70">
                Preview Pembahasan
            </div>

            <div id="explanation-preview"
                class="prose dark:prose-invert
                        max-w-none
                        p-4 rounded-lg
                        bg-slate-50 dark:bg-secondary/30
                        border border-slate-200 dark:border-white/10">
                @if($question && $question->explanation)
                    {!! $question->explanation !!}
                @else
                    <span class="opacity-50">Belum ada isi...</span>
                @endif
            </div>
        </div>
    </div>

    {{-- SUBMIT --}}
    <div class="flex justify-end gap-3">
        {{-- BATAL --}}
        <a href="{{ url()->previous() }}"
           class="px-6 py-2 rounded-lg bg-red-400 hover:bg-red-700 text-black hover:text-white">
            Batal
        </a>

        {{-- SIMPAN --}}
        <button type="submit"
                class="px-6 py-2 bg-green-400 text-black rounded-lg hover:bg-green-700 hover:text-white">
            {{ $question ? 'Update Soal' : 'Simpan Soal' }}
        </button>
    </div>
</form>

{{-- MATH MODAL --}}
<div id="math-modal"
     class="fixed inset-0 z-50 hidden
            bg-black/40">

    <div class="absolute bottom-6 left-1/2 -translate-x-1/2
                w-full max-w-xl
                bg-azwara-lightest dark:bg-secondary/90
                border border-slate-200 dark:border-white/10
                rounded-2xl shadow-xl
                p-5 space-y-4
                transition-all">

        <div class="flex justify-between items-center">
            <h3 class="font-semibold text-lg dark:text-white">
                ∑ Editor Rumus
            </h3>

            <button id="close-math-modal"
                    class="text-slate-500 hover:text-red-500">
                ✕
            </button>
        </div>

        <div id="math-editor"
             class="border rounded-lg p-3 min-h-[70px] text-lg
                    bg-azwara-lightest text-slate-800
                    dark:bg-secondary/30 dark:text-white
                    border-slate-300 dark:border-white/20
                    focus-within:ring-2 focus-within:ring-primary/40">
        </div>

        <div class="flex justify-between pt-2">
            <div class="flex gap-2">
                <button id="btn-confirm-math"
                        type="button"
                        class="px-4 py-1.5 rounded-lg
                               bg-primary text-white
                               hover:bg-azwara-darker">
                    Tambahkan
                </button>

                <button id="btn-cancel-math"
                        type="button"
                        class="px-4 py-1.5 rounded-lg
                               bg-slate-200 text-slate-700
                               dark:bg-white/10 dark:text-white">
                    Batal
                </button>
            </div>

            <button id="btn-open-docs"
                    type="button"
                    class="text-sm dark:text-white underline opacity-80">
                📘 Dokumentasi
            </button>
        </div>
    </div>
<script>
document.addEventListener('DOMContentLoaded', () => {

    const testTypeSelect = document.getElementById('test-type');
    const typeSelect     = document.getElementById('question-type');
    const optionsWrapper = document.getElementById('options-wrapper');

    /* =========================
     | RULE TIPE TEST
     ========================= */
    const allowedTypes = {
        general: ['mcq','mcma','truefalse','short_answer','compound'],
        tiu: ['mcq'],
        twk: ['mcq'],
        mtk_stis: ['mcq'],
        tkp: ['mcq'],
        mtk_tka: ['mcq','mcma','truefalse','compound'],
    };

    function filterQuestionTypes() {
        const testType = testTypeSelect.value;

        [...typeSelect.options].forEach(opt => {
            if (!opt.value) return;
            opt.hidden = !allowedTypes[testType].includes(opt.value);
        });

        if (!allowedTypes[testType].includes(typeSelect.value)) {
            typeSelect.value = '';
        }

        toggleOptionMode();
    }

    /* =========================
     | MODE OPSI (TKP / NORMAL)
     ========================= */
    function toggleOptionMode() {
        const isTkp = testTypeSelect.value === 'tkp';

        // hide radio/checkbox
        optionsWrapper.querySelectorAll('input[type=radio], input[type=checkbox]')
            .forEach(el => el.style.display = isTkp ? 'none' : '');

        // toggle weight
        optionsWrapper.querySelectorAll('.input-weight')
            .forEach(el => el.style.display = isTkp ? 'block' : 'none');
    }

    /* =========================
     | EVENTS
     ========================= */
    filterQuestionTypes();
    toggleOptionMode();

    typeSelect.addEventListener('change', toggleOptionMode);
});
</script>
</div>

@include('layouts.partials.math_documentation')
@endsection

@include('bank.questions.js.edit')
