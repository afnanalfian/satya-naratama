@extends('layouts.app')

@section('content')
<form method="POST"
      action="{{ route('bank.material.questions.store', $material) }}"
      enctype="multipart/form-data"
      class="max-w-5xl mx-auto space-y-6">

    @csrf

    {{-- HEADER --}}
    <div class="bg-azwara-lightest dark:bg-azwara-darker rounded-xl shadow p-6">
        <h1 class="text-2xl font-bold text-secondary dark:text-azwara-lighter">
            Tambah Soal – {{ $material->name }}
        </h1>
        <p class="text-gray-600 dark:text-gray-300 mt-1">
            Buat soal dengan teks, gambar, dan rumus matematika.
        </p>
    </div>

    {{-- TEST TYPE --}}
    <div class="bg-azwara-lightest dark:bg-azwara-darker rounded-xl shadow p-6 space-y-2">
        <label class="font-semibold dark:text-azwara-lighter">Jenis Tes</label>
        <select id="test-type" name="test_type"
                class="w-full rounded-lg border p-2">
            <option value="general">General</option>
            <option value="tiu">TIU</option>
            <option value="twk">TWK</option>
            <option value="tkp">TKP</option>
            <option value="tpa">TPA</option>
            <option value="tbi">TBI</option>
            <option value="mtk_stis">MTK STIS</option>
            <option value="mtk_tka">MTK TKA</option>
        </select>
    </div>

    {{-- TIPE SOAL --}}
    <div class="bg-azwara-lightest text-secondary dark:bg-azwara-darker dark:text-azwara-lighter rounded-xl shadow p-6 space-y-2">
        <label class="font-semibold">Tipe Soal</label>
        <select id="question-type" name="type"
                class="w-full rounded-lg border p-2
                       bg-azwara-lightest dark:bg-secondary/40
                       text-slate-800 dark:text-white">
            <option value="">-- Pilih Tipe --</option>
            <option value="mcq">Pilihan Ganda (1 Benar)</option>
            <option value="mcma">Pilihan Ganda (Banyak Benar)</option>
            <option value="truefalse">Benar / Salah</option>
            <option value="short_answer">Isian Singkat</option>
            <option value="compound">Soal Kompleks</option>
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
                  placeholder="Tulis soal di sini..."></textarea>

        <input type="file" name="question_image" class="text-sm">

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
                <span class="opacity-50">Belum ada isi...</span>
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
            <div class="short-answer-item flex items-center gap-3 p-3 border rounded-lg">
                <input type="text" name="short_answers[0][text]"
                       class="flex-1 rounded-lg border p-2 bg-azwara-lightest dark:bg-secondary/30 text-slate-800 dark:text-white"
                       placeholder="Masukkan jawaban...">
                <button type="button" class="remove-short-answer text-red-500 hidden">
                    Hapus
                </button>
            </div>
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
                placeholder="Tulis pembahasan jawaban di sini (opsional)..."></textarea>

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
                <span class="opacity-50">Belum ada isi...</span>
            </div>
        </div>
    </div>

    {{-- SUBMIT --}}
    <div class="flex justify-end gap-3">

        {{-- BATAL --}}
        <button type="submit"
                form="cancel-form"
                class="px-6 py-2 rounded-lg
                     bg-red-400  hover:bg-red-700
                    text-black hover:text-white">
            Batal
        </button>

        {{-- SIMPAN --}}
        <button type="submit"
                class="px-6 py-2 bg-green-400 text-black rounded-lg hover:bg-green-700 hover:text-white">
            Simpan Soal
        </button>

    </div>

</form>

{{-- FORM BATAL --}}
<form id="cancel-form"
      method="GET"
      action="{{ url()->previous() }}"
      class="sweet-confirm"
      data-message="Yakin ingin batal? Semua data soal yang anda buat akan hilang">
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
    const typeSelect = document.getElementById('question-type');

    if (!testTypeSelect || !typeSelect) return;

    const allowed = {
        general: ['mcq','mcma','truefalse','short_answer','compound'],
        tiu: ['mcq'],
        twk: ['mcq'],
        mtk_stis: ['mcq'],
        tkp: ['mcq'],
        tpa: ['mcq'],
        tbi: ['mcq'],
        mtk_tka: ['mcq','mcma','truefalse','compound']
    };

    function filterQuestionTypes() {
        const testType = testTypeSelect.value;

        [...typeSelect.options].forEach(opt => {
            if (!opt.value) return;
            opt.hidden = !allowed[testType]?.includes(opt.value);
        });

        if (!allowed[testType]?.includes(typeSelect.value)) {
            typeSelect.value = '';
        }
    }

    // trigger saat ganti test type
    testTypeSelect.addEventListener('change', filterQuestionTypes);

    // trigger saat halaman pertama kali load
    filterQuestionTypes();
});
</script>
</div>

@include('layouts.partials.math_documentation')
@endsection

@push('styles')
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/mathquill/0.10.1/mathquill.min.css">
@endpush

@include('bank.questions.js.create')
