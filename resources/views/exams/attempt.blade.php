@extends('layouts.exam')

@section('content')
<div class="h-full flex flex-col bg-neutral-50 dark:bg-primary-950">

    {{-- ================= HEADER / TIMER ================= --}}
    {{-- FIX: header berada DI LUAR container sidebar/overlay (lihat catatan
         di elemen <aside> & overlay di bawah). Karena sidebar & overlay
         sekarang di-posisikan `absolute` relatif ke container konten
         (bukan `fixed` ke seluruh viewport), keduanya SECARA STRUKTURAL
         tidak mungkin lagi menutupi header ini, apapun z-index-nya. Tombol
         toggle & fullscreen jadi selalu bisa di-tap. --}}
    <div class="px-4 py-3 bg-hero-gradient text-white shadow-lg shadow-primary-950/20 relative z-20">
        <div class="flex items-center justify-between gap-4">
            {{-- Left: Exam Info --}}
            <div class="flex-1 min-w-0">
                <div class="text-sm font-semibold truncate text-white">
                    {{ $exam->title }}
                </div>
                @if($exam->type === 'tryout' && $exam->test_type === 'skd')
                    <div class="text-[11px] tracking-wide text-white/60 mt-0.5">
                        TIU: 35 &nbsp;·&nbsp; TWK: 30 &nbsp;·&nbsp; TKP: 45
                    </div>
                @endif
            </div>

            {{-- Center: Timer --}}
            <div class="flex-1 flex justify-center">
                <div class="inline-flex items-center gap-3
                            bg-white/10 backdrop-blur-sm
                            border border-white/15
                            rounded-2xl pl-3.5 pr-2 py-1.5">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
                    </span>

                    <div class="hidden sm:block text-[11px] font-semibold uppercase tracking-[0.1em] text-white/70">
                        Sisa Waktu
                    </div>

                    <div id="timer"
                         data-remaining="{{ $attempt->remainingSeconds() }}"
                         class="font-bold text-lg font-mono tabular-nums text-white
                                bg-white/10 px-3 py-0.5 rounded-xl min-w-[84px] text-center">
                    </div>
                </div>
            </div>

            {{-- Right: Actions --}}
            <div class="flex-1 flex justify-end items-center gap-2">
                {{-- Fullscreen Button --}}
                <button id="fullscreenBtn"
                        type="button"
                        class="p-2.5 rounded-xl bg-white/10 hover:bg-white/20 border border-white/15 transition-colors"
                        title="Toggle Fullscreen">
                    <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
                    </svg>
                </button>

                {{-- Toggle Sidebar (Mobile) --}}
                <button id="toggleSidebar"
                        type="button"
                        class="md:hidden p-2.5 rounded-xl bg-white/10 hover:bg-white/20 border border-white/15 transition-colors"
                        aria-label="Toggle navigasi soal"
                        aria-expanded="false"
                        aria-controls="sidebar">
                    <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- ================= MAIN CONTENT ================= --}}
    {{-- `relative` di sini jadi anchor posisi untuk <aside id="sidebar">
         dan #sidebarOverlay (keduanya `absolute` di mobile). Div ini
         terletak di BAWAH header, jadi sidebar & overlay tidak akan
         pernah menutupi header di atasnya. --}}
    <div class="flex flex-1 overflow-hidden relative">
        {{-- ================= QUESTION AREA ================= --}}
        <main class="flex-1 overflow-y-auto p-4 md:p-8" id="mainContent">
            <div class="max-w-3xl mx-auto">
            @foreach($questions as $i => $eq)
                @php
                    $question = $eq->question;
                    $answer = $attempt->answers->where('question_id', $question->id)->first();
                    $selectedOptions = $answer?->selected_ids ?? [];
                @endphp

                <div class="question-slide {{ $i === 0 ? '' : 'hidden' }}"
                     data-index="{{ $i }}"
                     data-question-id="{{ $question->id }}"
                     data-question-type="{{ $question->type }}">

                    <div class="bg-white dark:bg-primary-900/40 rounded-2xl
                                border border-neutral-200 dark:border-white/10
                                shadow-sm p-5 md:p-7">

                    {{-- Question Header --}}
                    <div class="mb-6 pb-5 border-b border-neutral-200 dark:border-white/10">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                            <div>
                                <h2 class="flex items-center gap-2.5 text-lg font-bold tracking-tight text-primary-900 dark:text-primary-50">
                                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg
                                                 bg-primary-50 dark:bg-primary-500/15
                                                 text-primary-700 dark:text-primary-200
                                                 text-sm font-bold tabular-nums
                                                 ring-1 ring-inset ring-primary-600/15 dark:ring-primary-400/20">
                                        {{ $i + 1 }}
                                    </span>
                                    Soal {{ $i + 1 }}
                                </h2>
                                @if($exam->type === 'tryout' && $exam->test_type === 'skd' && $question->test_type)
                                    <div class="mt-2.5">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-semibold uppercase tracking-[0.08em]
                                            {{ $question->test_type === 'tiu' ? 'bg-secondary-50 text-secondary-700 ring-1 ring-inset ring-secondary-600/20 dark:bg-secondary-500/15 dark:text-secondary-200 dark:ring-secondary-400/20' :
                                               ($question->test_type === 'twk' ? 'bg-primary-50 text-primary-700 ring-1 ring-inset ring-primary-600/20 dark:bg-primary-500/15 dark:text-primary-200 dark:ring-primary-400/20' :
                                               'bg-accent-50 text-accent-700 ring-1 ring-inset ring-accent-600/20 dark:bg-accent-500/15 dark:text-accent-200 dark:ring-accent-400/20') }}">
                                            @if($question->test_type === 'tiu')
                                                <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                                </svg>
                                            @elseif($question->test_type === 'twk')
                                                <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                                </svg>
                                            @else
                                                <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                                </svg>
                                            @endif
                                            {{ strtoupper($question->test_type) }}
                                        </span>
                                    </div>
                                @endif
                            </div>

                            <div class="flex items-center gap-2">
                                <span class="text-sm font-medium text-neutral-700 dark:text-neutral-500 tabular-nums">
                                    {{ $i + 1 }} / {{ $questions->count() }}
                                </span>
                                <span class="text-[11px] px-2.5 py-1 rounded-full font-semibold uppercase tracking-wide
                                             bg-neutral-100 dark:bg-white/10
                                             text-neutral-800 dark:text-neutral-300">
                                    {{ strtoupper($question->type) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Question Content --}}
                    <div class="mb-8">
                        <div class="prose dark:prose-invert max-w-none text-neutral-800 dark:text-neutral-200 leading-relaxed">
                            {!! $question->question_text !!}
                        </div>

                        @if($question->image)
                            <div class="mt-6">
                                <div class="inline-flex items-center px-3 py-1.5 rounded-lg
                                            bg-neutral-100 dark:bg-white/10
                                            text-neutral-800 dark:text-neutral-300 text-xs font-medium mb-3">
                                    <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    Gambar Soal
                                </div>
                                <div class="flex justify-center">
                                    <img src="{{ asset('storage/'.$question->image) }}"
                                         class="max-w-full md:max-w-lg max-h-80 object-contain rounded-xl
                                                border border-neutral-200 dark:border-white/10 bg-white p-2"
                                         alt="Gambar Soal"
                                         loading="lazy">
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- ANSWER OPTIONS --}}
                    <div class="answer-section">
                        {{-- MCQ, MCMA, TrueFalse --}}
                        @if(in_array($question->type, ['mcq', 'mcma', 'truefalse']))
                            <div class="space-y-2.5">
                                @foreach($question->options as $option)
                                    <div class="option-button group relative">
                                        <input type="{{ $question->type === 'mcma' ? 'checkbox' : 'radio' }}"
                                               name="question_{{ $question->id }}[]"
                                               value="{{ $option->id }}"
                                               id="option_{{ $option->id }}"
                                               class="sr-only"
                                               @checked(in_array($option->id, $answer?->selected_ids ?? []))>
                                        <label for="option_{{ $option->id }}"
                                               class="flex items-start gap-4 p-4 rounded-xl border
                                                      border-neutral-200 dark:border-white/10
                                                      bg-white dark:bg-white/[0.03]
                                                      cursor-pointer transition-all duration-200
                                                      hover:border-primary-300 dark:hover:border-primary-400/40
                                                      hover:bg-primary-50/40 dark:hover:bg-white/[0.06]
                                                      group-has-[input:checked]:border-primary-500
                                                      group-has-[input:checked]:bg-primary-50/70
                                                      dark:group-has-[input:checked]:bg-primary-500/10
                                                      group-has-[input:checked]:ring-1
                                                      group-has-[input:checked]:ring-primary-500/30
                                                      group-has-[input:checked]:shadow-sm">
                                            {{-- Option Indicator --}}
                                            <div class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-lg
                                                        border border-neutral-300 dark:border-white/15
                                                        bg-neutral-50 dark:bg-white/5
                                                        text-sm font-bold
                                                        text-neutral-800 dark:text-neutral-300
                                                        group-has-[input:checked]:border-primary-600
                                                        group-has-[input:checked]:bg-primary-600
                                                        group-has-[input:checked]:text-white transition-all">
                                                @if($question->type === 'truefalse')
                                                    {{ $option->label === 'true' ? 'B' : 'S' }}
                                                @else
                                                    {{ $option->label }}
                                                @endif
                                            </div>

                                            {{-- Option Content --}}
                                            <div class="flex-1 min-w-0 pt-0.5">

                                                <div class="prose prose-sm dark:prose-invert max-w-none text-neutral-800 dark:text-neutral-300">
                                                    {!! $option->option_text !!}
                                                </div>

                                                @if($option->image)
                                                    <div class="mt-3">
                                                        <img src="{{ asset('storage/'.$option->image) }}"
                                                             class="max-w-[200px] rounded-lg border border-neutral-200 dark:border-white/10 bg-white p-1.5"
                                                             alt="Gambar Opsi"
                                                             loading="lazy">
                                                    </div>
                                                @endif
                                            </div>

                                            {{-- Check Indicator --}}
                                            <div class="flex-shrink-0 w-6 h-6 flex items-center justify-center rounded-full
                                                        border border-neutral-300 dark:border-white/15
                                                        group-has-[input:checked]:border-primary-600
                                                        group-has-[input:checked]:bg-primary-600 transition-all">
                                                <svg class="w-3 h-3 text-white opacity-0 group-has-[input:checked]:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                                </svg>
                                            </div>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        {{-- SHORT ANSWER --}}
                        @if($question->type === 'short_answer')
                            <div class="rounded-2xl p-5
                                        bg-neutral-50 dark:bg-white/[0.03]
                                        border border-neutral-200 dark:border-white/10">
                                <div class="flex items-center mb-4">
                                    <div class="w-10 h-10 rounded-xl
                                                bg-primary-50 dark:bg-primary-500/10
                                                border border-primary-100 dark:border-primary-400/20
                                                flex items-center justify-center mr-3.5">
                                        <svg class="w-5 h-5 text-primary-600 dark:text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-primary-900 dark:text-primary-50">Jawaban Singkat</h4>
                                        <p class="text-xs text-neutral-700 dark:text-neutral-500">Tulis jawaban Anda di bawah</p>
                                    </div>
                                </div>
                                <textarea name="short_answer_{{ $question->id }}"
                                          class="short-answer-input w-full p-4 rounded-xl
                                                 border border-neutral-300 dark:border-white/10
                                                 bg-white dark:bg-white/5
                                                 text-neutral-900 dark:text-neutral-100
                                                 placeholder:text-neutral-600
                                                 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20
                                                 transition-colors"
                                          rows="4"
                                          placeholder="Ketik jawaban Anda di sini...">{{ $answer?->short_answer_value ?? '' }}</textarea>
                            </div>
                        @endif

                        {{-- COMPOUND --}}
                        @if($question->type === 'compound')
                            <div class="rounded-2xl p-5
                                        bg-accent-50/50 dark:bg-accent-500/[0.07]
                                        border border-accent-200 dark:border-accent-400/20">
                                <div class="flex items-center mb-6">
                                    <div class="w-10 h-10 rounded-xl
                                                bg-accent-100/70 dark:bg-accent-500/15
                                                border border-accent-200 dark:border-accent-400/20
                                                flex items-center justify-center mr-3.5">
                                        <svg class="w-5 h-5 text-accent-600 dark:text-accent-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-accent-800 dark:text-accent-200">Soal Gabungan</h4>
                                        <p class="text-xs text-accent-700/80 dark:text-accent-300/70">Jawab semua pertanyaan di bawah</p>
                                    </div>
                                </div>

                                <div class="space-y-4">
                                    @foreach($question->subItems->sortBy('order') as $subIndex => $subItem)
                                        @php
                                            $subAnswer = $answer?->getCompoundAnswerBySubId($subItem->id);
                                        @endphp

                                        <div class="bg-white dark:bg-primary-950 rounded-xl p-5
                                                    border border-neutral-200 dark:border-white/10 shadow-sm">
                                            <div class="flex items-start justify-between mb-4">
                                                <div>
                                                    <div class="flex items-center gap-2 mb-2">
                                                        <span class="text-xs font-semibold uppercase tracking-[0.08em] text-neutral-700 dark:text-neutral-500">Sub-soal {{ $subIndex + 1 }}</span>
                                                        <span class="text-[11px] px-2 py-0.5 rounded-full font-medium
                                                                     bg-neutral-100 dark:bg-white/10
                                                                     text-neutral-800 dark:text-neutral-300">
                                                            {{ $subItem->type === 'truefalse' ? 'BENAR/SALAH' : 'ISIAN SINGKAT' }}
                                                        </span>
                                                    </div>
                                                    <h5 class="font-medium text-neutral-900 dark:text-neutral-200">{{ $subItem->prompt }}</h5>
                                                </div>
                                            </div>

                                            @if($subItem->type === 'truefalse')
                                                <div class="flex gap-3">
                                                    <button type="button"
                                                            data-sub-id="{{ $subItem->id }}"
                                                            class="truefalse-btn flex-1 p-3 rounded-xl border-2 border-gray-200 dark:border-white/15 bg-white dark:bg-white/5 text-neutral-800 dark:text-neutral-300 font-medium hover:border-green-500 dark:hover:border-green-500 transition-all {{ $subAnswer && ($subAnswer['boolean'] ?? false) ? 'border-green-500 bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-300' : '' }}">
                                                        <div class="flex items-center justify-center gap-2">
                                                            <div class="w-5 h-5 rounded-full border-2 border-gray-300 dark:border-white/20 {{ $subAnswer && ($subAnswer['boolean'] ?? false) ? 'border-green-500 bg-green-500' : '' }}"></div>
                                                            <span>Benar</span>
                                                        </div>
                                                    </button>
                                                    <button type="button"
                                                            data-sub-id="{{ $subItem->id }}"
                                                            class="truefalse-btn flex-1 p-3 rounded-xl border-2 border-gray-200 dark:border-white/15 bg-white dark:bg-white/5 text-neutral-800 dark:text-neutral-300 font-medium hover:border-red-500 dark:hover:border-red-500 transition-all {{ $subAnswer && !($subAnswer['boolean'] ?? true) ? 'border-red-500 bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-300' : '' }}">
                                                        <div class="flex items-center justify-center gap-2">
                                                            <div class="w-5 h-5 rounded-full border-2 border-gray-300 dark:border-white/20 {{ $subAnswer && !($subAnswer['boolean'] ?? true) ? 'border-red-500 bg-red-500' : '' }}"></div>
                                                            <span>Salah</span>
                                                        </div>
                                                    </button>
                                                </div>
                                            @elseif($subItem->type === 'short_answer')
                                                <div>
                                                    <textarea name="compound_{{ $question->id }}_sub_{{ $subItem->id }}"
                                                              data-sub-id="{{ $subItem->id }}"
                                                              class="compound-short-answer w-full p-4 rounded-xl
                                                                     border border-neutral-300 dark:border-white/10
                                                                     bg-white dark:bg-white/5
                                                                     text-neutral-900 dark:text-neutral-100
                                                                     placeholder:text-neutral-600
                                                                     focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20
                                                                     transition-colors"
                                                              rows="3"
                                                              placeholder="Jawaban...">{{ $subAnswer['value'] ?? '' }}</textarea>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    </div>
                </div>
            @endforeach
            </div>
        </main>

        {{-- ================= RIGHT SIDEBAR (NAVIGATION) ================= --}}
        {{-- FIX (2 lapis):
             1. Hapus utility transform Tailwind (transform translate-x-full
                md:translate-x-0 transition-transform duration-300
                ease-in-out md:!transform-none) supaya TIDAK ada dua sistem
                CSS yang berebut mengatur `transform` di elemen yang sama.
                Show/hide sekarang 100% dikendalikan oleh SATU sumber: class
                `.open` di stylesheet bawah (@push('styles')).
             2. `absolute` (bukan `fixed`) di mobile: parent-nya adalah
                <div class="flex flex-1 ... relative"> yang terletak di
                BAWAH header. Karena itu, sidebar (walau `inset-y-0`) hanya
                akan memenuhi tinggi container tersebut -- TIDAK PERNAH
                menutupi header di atasnya, apapun z-index-nya. Ini
                menghilangkan akar masalah "toggle ketutup panel sendiri". --}}
        <aside id="sidebar"
               class="absolute md:relative inset-y-0 right-0 z-40
                      w-64 md:w-72
                      bg-white dark:bg-primary-950
                      border-l border-neutral-200 dark:border-white/10
                      overflow-y-auto p-5 shadow-xl md:shadow-none"
               aria-hidden="true">

            {{-- Sidebar Header --}}
            <div class="mb-5 pb-4 border-b border-neutral-200 dark:border-white/10">
                <div class="flex items-center justify-between">
                    <h3 class="flex items-center gap-2 font-bold tracking-tight text-primary-900 dark:text-primary-50">
                        <svg class="w-4 h-4 text-primary-600 dark:text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        Navigasi Soal
                    </h3>
                    <button id="closeSidebar"
                            type="button"
                            aria-label="Tutup navigasi soal"
                            class="md:hidden p-1.5 rounded-lg text-neutral-700 dark:text-neutral-400 hover:bg-neutral-100 dark:hover:bg-white/10 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <p class="text-xs text-neutral-700 dark:text-neutral-500 mt-2">
                    Klik nomor untuk berpindah soal
                </p>
            </div>

            {{-- Question Navigation Grid --}}
            <div class="grid grid-cols-5 md:grid-cols-4 gap-2" id="navGrid">
                @foreach($questions as $i => $eq)
                    @php
                        $question = $eq->question;
                        $answer = $attempt->answers->where('question_id', $question->id)->first();
                        $answered = $answer && !$answer->isEmpty;
                    @endphp

                    {{-- FIX: `data-answered` jadi satu-satunya sumber kebenaran
                         status terjawab (dipakai juga oleh JS), bukan cuma
                         nebak dari kombinasi class Tailwind yang panjang. --}}
                    <button type="button"
                            class="nav-btn relative w-full aspect-square rounded-xl flex items-center justify-center
                                   font-semibold text-sm tabular-nums transition-all duration-200
                                   {{ $answered
                                        ? 'bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300 border-2 border-green-300 dark:border-green-700'
                                        : 'bg-gray-100 dark:bg-white/10 text-gray-700 dark:text-gray-300 border-2 border-gray-200 dark:border-white/15' }}
                                   hover:scale-105 hover:shadow-md active:scale-95"
                            data-index="{{ $i }}"
                            data-question-id="{{ $question->id }}"
                            data-question-type="{{ $question->type }}"
                            data-answered="{{ $answered ? 'true' : 'false' }}">
                        {{ $i + 1 }}
                    </button>
                @endforeach
            </div>

            {{-- Status Summary --}}
            <div class="mt-6 pt-5 border-t border-neutral-200 dark:border-white/10">
                <h4 class="text-xs font-semibold uppercase tracking-[0.1em] text-neutral-700 dark:text-neutral-500 mb-3.5">Status Pengerjaan</h4>
                <div class="space-y-2.5">
                    <div class="flex items-center justify-between px-3 py-2 rounded-lg
                                bg-neutral-50 dark:bg-white/[0.03]
                                border border-neutral-200 dark:border-white/10">
                        <div class="flex items-center gap-2">
                            <div class="w-2.5 h-2.5 rounded-full bg-green-500"></div>
                            <span class="text-sm text-neutral-800 dark:text-neutral-300">Terjawab</span>
                        </div>
                        <span id="answeredCount" class="font-bold tabular-nums text-neutral-900 dark:text-neutral-100">0</span>
                    </div>
                    <div class="flex items-center justify-between px-3 py-2 rounded-lg
                                bg-neutral-50 dark:bg-white/[0.03]
                                border border-neutral-200 dark:border-white/10">
                        <div class="flex items-center gap-2">
                            <div class="w-2.5 h-2.5 rounded-full bg-neutral-500"></div>
                            <span class="text-sm text-neutral-800 dark:text-neutral-300">Belum Dijawab</span>
                        </div>
                        <span id="unansweredCount" class="font-bold tabular-nums text-neutral-900 dark:text-neutral-100">{{ $questions->count() }}</span>
                    </div>
                </div>
            </div>
        </aside>

        {{-- Mobile Overlay --}}
        {{-- FIX: `absolute` (bukan `fixed`) -- ikut terkurung di container
             yang sama dengan sidebar, jadi backdrop ini hanya menggelapkan
             area konten (main + sidebar), tidak pernah menutupi header
             ataupun footer navigasi. --}}
        <div id="sidebarOverlay"
             class="absolute inset-0 bg-primary-950/60 backdrop-blur-sm z-30 hidden md:hidden"
             aria-hidden="true"></div>
    </div>

    {{-- ================= FOOTER NAVIGATION ================= --}}
    <div class="px-4 py-3 bg-white dark:bg-primary-950 border-t border-neutral-200 dark:border-white/10">
        <div class="flex justify-between items-center gap-3 max-w-5xl mx-auto">
            <button id="prevBtn"
                    type="button"
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-semibold
                           bg-white dark:bg-white/5
                           border border-neutral-300 dark:border-white/15
                           text-neutral-800 dark:text-neutral-300
                           hover:bg-neutral-50 dark:hover:bg-white/10 transition-colors
                           disabled:opacity-40 disabled:cursor-not-allowed">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Sebelumnya
            </button>

            <div class="flex items-center gap-3">
                {{-- Submit Button (only show on last question) --}}
                <form id="auto-submit-form"
                      method="POST"
                      action="{{ route('exams.submit', $attempt->exam) }}"
                      class="sweet-confirm hidden"
                      data-message="Yakin ingin mengakhiri ujian? Pastikan semua jawaban sudah diperiksa.">
                    @csrf
                    <button type="submit"
                            class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-sm font-semibold
                                   bg-accent-gradient text-white
                                   shadow-sm shadow-accent-900/20 hover:opacity-90 active:opacity-100
                                   transition-opacity">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Submit Jawaban
                    </button>
                </form>

                <button id="nextBtn"
                        type="button"
                        class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-sm font-semibold
                               bg-brand-gradient text-white
                               shadow-sm shadow-primary-900/20 hover:opacity-90 active:opacity-100
                               transition-opacity">
                    Selanjutnya
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* =====================================================
       SIDEBAR - SATU-SATUNYA SUMBER YANG MENGATUR TRANSFORM
       (tidak lagi bentrok dengan utility class Tailwind di
       elemen <aside>, karena class transform sudah dihapus
       dari markup dan digantikan sepenuhnya oleh block ini)

       PENTING: `position: absolute` (bukan `fixed`) di mobile.
       Parent-nya (div.flex.flex-1.relative) ada di BAWAH header,
       jadi sidebar & overlay ini hanya memenuhi area konten dan
       TIDAK PERNAH bisa menutupi header/tombol toggle, apapun
       z-index-nya. Ini yang menghilangkan bug "toggle ketutup
       panelnya sendiri" di HP.
    ===================================================== */
    @media (max-width: 767px) {
        #sidebar {
            position: absolute !important;
            top: 0 !important;
            right: 0 !important;
            bottom: 0 !important;
            z-index: 40 !important;
            transform: translateX(100%);
            transition: transform 0.3s ease-in-out;
            box-shadow: -4px 0 20px rgba(0, 0, 0, 0.2);
            will-change: transform;
        }

        #sidebar.open {
            transform: translateX(0) !important;
        }

        #sidebarOverlay {
            position: absolute !important;
            transition: opacity 0.2s ease-in-out;
            opacity: 0;
            pointer-events: none;
        }

        #sidebarOverlay.active {
            display: block !important;
            opacity: 1;
            pointer-events: auto;
        }
    }

    @media (min-width: 768px) {
        #sidebar {
            position: relative !important;
            transform: none !important;
            box-shadow: none !important;
        }

        #sidebarOverlay {
            display: none !important;
        }
    }

    /* Kunci scroll body saat sidebar mobile terbuka, tanpa mengubah
       posisi scroll yang sedang berjalan (aman untuk iOS Safari). */
    body.sidebar-lock {
        overflow: hidden;
        touch-action: none;
    }
</style>
@endpush

@include('exams.js.attempt')
