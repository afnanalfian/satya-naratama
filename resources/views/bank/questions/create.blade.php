@extends('layouts.app')

@section('content')
<div class="py-6 md:py-8">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Navigation --}}
        <nav class="flex items-center gap-2 text-sm mb-6">
            <a href="{{ route('bank.category.index') }}"
               class="text-secondary-500 hover:text-primary-600 dark:text-secondary-400 dark:hover:text-primary-300 transition-colors group">
                <span class="inline-flex items-center gap-1.5">
                    <svg class="w-4 h-4 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Kategori
                </span>
            </a>
            <span class="text-secondary-300 dark:text-secondary-600">/</span>
            <a href="{{ route('bank.category.materials.index', $material->category) }}"
               class="text-secondary-500 hover:text-primary-600 dark:text-secondary-400 dark:hover:text-primary-300 transition-colors group">
                {{ $material->category->name }}
            </a>
            <span class="text-secondary-300 dark:text-secondary-600">/</span>
            <a href="{{ route('bank.material.questions.index', $material) }}"
               class="text-secondary-500 hover:text-primary-600 dark:text-secondary-400 dark:hover:text-primary-300 transition-colors group">
                {{ $material->name }}
            </a>
            <span class="text-secondary-300 dark:text-secondary-600">/</span>
            <span class="text-primary-600 dark:text-primary-300 font-medium">Tambah Soal</span>
        </nav>

        {{-- Header --}}
        <div class="relative overflow-hidden rounded-2xl bg-white dark:bg-primary-900/40 border border-primary-100 dark:border-primary-800/30 p-6 md:p-8 mb-6">
            <div class="absolute top-0 right-0 w-64 h-64 bg-primary-500/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/4"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-accent-500/5 rounded-full blur-3xl translate-y-1/2 -translate-x-1/4"></div>

            <div class="relative flex items-center gap-4">
                <div class="p-3 rounded-xl bg-primary-500/10 text-primary-600 dark:bg-primary-400/10 dark:text-primary-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl md:text-2xl font-bold text-primary-900 dark:text-white tracking-tight">
                        Tambah Soal
                    </h1>
                    <p class="text-sm text-secondary-500 dark:text-secondary-400">
                        {{ $material->name }} • {{ $material->category->name }}
                    </p>
                </div>
            </div>
        </div>

        {{-- Form --}}
        <form method="POST" action="{{ route('bank.material.questions.store', $material) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Test Type --}}
            <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 p-6 shadow-sm">
                <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                    Jenis Tes <span class="text-accent-500">*</span>
                </label>
                <select id="test-type" name="test_type"
                        class="w-full px-4 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200 appearance-none">
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

            {{-- Question Type --}}
            <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 p-6 shadow-sm">
                <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                    Tipe Soal <span class="text-accent-500">*</span>
                </label>
                <select id="question-type" name="type"
                        class="w-full px-4 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200 appearance-none">
                    <option value="">-- Pilih Tipe --</option>
                    <option value="mcq">Pilihan Ganda (1 Benar)</option>
                    <option value="mcma">Pilihan Ganda (Banyak Benar)</option>
                    <option value="truefalse">Benar / Salah</option>
                    <option value="short_answer">Isian Singkat</option>
                    <option value="compound">Soal Kompleks</option>
                </select>
            </div>

            {{-- Question Text --}}
            <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 p-6 shadow-sm">
                <h2 class="text-lg font-bold text-primary-800 dark:text-primary-100 mb-4">Soal</h2>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                            Teks Soal <span class="text-accent-500">*</span>
                        </label>
                        <textarea id="question-text" name="question_text" rows="4"
                                  class="w-full px-4 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 placeholder-secondary-400 focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200"
                                  placeholder="Tulis soal di sini..."></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                            Gambar Soal
                        </label>
                        <input type="file" name="question_image" accept="image/*"
                               class="w-full text-sm text-secondary-500 dark:text-secondary-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-medium file:bg-primary-50 file:text-primary-700 dark:file:bg-primary-800/50 dark:file:text-primary-300 hover:file:bg-primary-100 dark:hover:file:bg-primary-700/50 transition-all duration-200">
                    </div>

                    <div>
                        <button type="button"
                                class="btn-open-math inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium transition-all duration-200 hover:shadow-lg hover:shadow-primary-500/25 active:scale-[0.98]"
                                data-target="question-text">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            Sisipkan Rumus
                        </button>
                    </div>
                </div>

                {{-- Preview --}}
                <div class="mt-4">
                    <p class="text-sm font-medium text-secondary-500 dark:text-secondary-400 mb-2">Preview Soal</p>
                    <div id="question-preview"
                         class="prose dark:prose-invert max-w-none p-4 rounded-xl bg-primary-50/50 dark:bg-primary-800/20 border border-primary-100 dark:border-primary-700/30 min-h-[60px]">
                        <span class="text-secondary-400 dark:text-secondary-500">Belum ada isi...</span>
                    </div>
                </div>
            </div>

            {{-- Options Section --}}
            <div id="options-section" class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 p-6 shadow-sm hidden">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-bold text-primary-800 dark:text-primary-100">Opsi Jawaban</h2>
                    <span class="text-xs text-secondary-500 dark:text-secondary-400">Tandai opsi yang benar</span>
                </div>
                <div id="options-wrapper" class="space-y-4"></div>
                <button type="button" id="add-option"
                        class="mt-4 inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium transition-all duration-200 hover:shadow-lg hover:shadow-primary-500/25 active:scale-[0.98]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Opsi
                </button>
            </div>

            {{-- Short Answer Section --}}
            <div id="short-answer-section" class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 p-6 shadow-sm hidden">
                <h2 class="text-lg font-bold text-primary-800 dark:text-primary-100 mb-2">Jawaban Isian Singkat</h2>
                <p class="text-sm text-secondary-500 dark:text-secondary-400 mb-4">
                    Tambahkan semua kemungkinan jawaban yang benar (non-case-sensitive, spasi diabaikan).
                </p>
                <div id="short-answers-wrapper" class="space-y-3">
                    <div class="short-answer-item flex items-center gap-3 p-3 rounded-xl border border-primary-200 dark:border-primary-700/30 bg-primary-50/30 dark:bg-primary-800/20">
                        <input type="text" name="short_answers[0][text]"
                               class="flex-1 px-4 py-2.5 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 placeholder-secondary-400 focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200"
                               placeholder="Masukkan jawaban...">
                        <button type="button" class="remove-short-answer text-red-500 hidden">
                            Hapus
                        </button>
                    </div>
                </div>
                <button type="button" id="add-short-answer"
                        class="mt-4 inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium transition-all duration-200 hover:shadow-lg hover:shadow-primary-500/25 active:scale-[0.98]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Jawaban
                </button>
            </div>

            {{-- Compound Section --}}
            <div id="compound-section" class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 p-6 shadow-sm hidden">
                <h2 class="text-lg font-bold text-primary-800 dark:text-primary-100 mb-2">Sub Pertanyaan (Kompleks)</h2>
                <p class="text-sm text-secondary-500 dark:text-secondary-400 mb-4">
                    Tambahkan sub pertanyaan. Jika satu sub salah, seluruh soal dianggap salah.
                </p>
                <div id="compound-items-wrapper" class="space-y-6"></div>
                <button type="button" id="add-compound-item"
                        class="mt-4 inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium transition-all duration-200 hover:shadow-lg hover:shadow-primary-500/25 active:scale-[0.98]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Sub Pertanyaan
                </button>
            </div>

            {{-- Explanation --}}
            <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 p-6 shadow-sm">
                <h2 class="text-lg font-bold text-primary-800 dark:text-primary-100 mb-4">Pembahasan</h2>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                            Teks Pembahasan
                        </label>
                        <textarea id="explanation-text" name="explanation" rows="4"
                                  class="w-full px-4 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 placeholder-secondary-400 focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200"
                                  placeholder="Tulis pembahasan jawaban di sini (opsional)..."></textarea>
                    </div>

                    <div>
                        <button type="button"
                                class="btn-open-math inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium transition-all duration-200 hover:shadow-lg hover:shadow-primary-500/25 active:scale-[0.98]"
                                data-target="explanation-text">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            Sisipkan Rumus
                        </button>
                    </div>
                </div>

                {{-- Preview --}}
                <div class="mt-4">
                    <p class="text-sm font-medium text-secondary-500 dark:text-secondary-400 mb-2">Preview Pembahasan</p>
                    <div id="explanation-preview"
                         class="prose dark:prose-invert max-w-none p-4 rounded-xl bg-primary-50/50 dark:bg-primary-800/20 border border-primary-100 dark:border-primary-700/30 min-h-[60px]">
                        <span class="text-secondary-400 dark:text-secondary-500">Belum ada isi...</span>
                    </div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex flex-col sm:flex-row gap-3 justify-end">
                <button type="submit"
                        form="cancel-form"
                        class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl border border-red-200 dark:border-red-700/50 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-all duration-200 font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Batal
                </button>

                <button type="submit"
                        class="inline-flex items-center justify-center gap-2 px-8 py-3 rounded-xl bg-primary-600 hover:bg-primary-700 text-white font-medium transition-all duration-200 hover:shadow-lg hover:shadow-primary-500/25 active:scale-[0.98]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Soal
                </button>
            </div>
        </form>

        {{-- Cancel Form --}}
        <form id="cancel-form" method="GET" action="{{ url()->previous() }}"
              class="sweet-confirm" data-message="Yakin ingin batal? Semua data soal yang anda buat akan hilang">
        </form>

        {{-- Math Modal --}}
        <div id="math-modal" class="fixed inset-0 z-50 hidden bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
            <div class="w-full max-w-xl bg-white dark:bg-primary-900/95 rounded-2xl border border-primary-200 dark:border-primary-700/50 shadow-2xl p-6 space-y-4">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-bold text-primary-800 dark:text-primary-100 flex items-center gap-2">
                        <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        Editor Rumus
                    </h3>
                    <button id="close-math-modal" class="text-secondary-400 hover:text-red-500 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <div id="math-editor"
                     class="border rounded-xl p-4 min-h-[80px] text-lg bg-white dark:bg-primary-800/30 border-primary-200 dark:border-primary-700/50 focus-within:ring-2 focus-within:ring-primary-500/30 transition-all duration-200">
                </div>

                <div class="flex flex-wrap items-center justify-between gap-3 pt-2 border-t border-primary-100 dark:border-primary-700/30">
                    <div class="flex gap-2">
                        <button id="btn-confirm-math" type="button"
                                class="px-5 py-2 rounded-xl bg-primary-600 hover:bg-primary-700 text-white font-medium transition-all duration-200 hover:shadow-lg hover:shadow-primary-500/25 active:scale-[0.98]">
                            Tambahkan
                        </button>
                        <button id="btn-cancel-math" type="button"
                                class="px-5 py-2 rounded-xl border border-primary-200 dark:border-primary-700/50 text-secondary-600 dark:text-secondary-400 hover:bg-primary-50 dark:hover:bg-primary-800/20 transition-all duration-200">
                            Batal
                        </button>
                    </div>
                    <button id="btn-open-docs" type="button"
                            class="text-sm text-secondary-500 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-300 transition-colors underline">
                        📘 Dokumentasi
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.partials.math_documentation')
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mathquill/0.10.1/mathquill.min.css">
@endpush

@include('bank.questions.js.create')
