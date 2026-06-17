@extends('layouts.exam')

@section('content')
<div class="h-full flex flex-col bg-azwara-lightest dark:bg-azwara-darker">

    {{-- ================= HEADER / TIMER ================= --}}
    <div class="px-4 py-3 bg-azwara-darkest text-white">
        <div class="flex items-center justify-between">
            {{-- Left: Exam Info --}}
            <div class="flex-1">
                <div class="text-sm text-azwara-lighter/80">
                    {{ $exam->title }}
                </div>
                @if($exam->type === 'tryout' && $exam->test_type === 'skd')
                    <div class="text-xs text-azwara-lighter/60 mt-1">
                        TIU: 35 | TWK: 30 | TKP: 45
                    </div>
                @endif
            </div>

            {{-- Center: Timer --}}
            <div class="flex-1 text-center">
                <div class="flex items-center justify-center gap-3">
                    <div class="w-3 h-3 rounded-full bg-red-500 animate-pulse"></div>
                    <div class="text-sm font-medium">Sisa Waktu:</div>
                    <div id="timer"
                         data-remaining="{{ $attempt->remainingSeconds() }}"
                         class="font-bold text-lg font-mono bg-white/10 px-3 py-1 rounded-lg min-w-[80px]">
                    </div>
                    <div class="w-3 h-3 rounded-full bg-red-500 animate-pulse"></div>
                </div>
            </div>

            {{-- Right: Actions --}}
            <div class="flex-1 flex justify-end items-center gap-3">
                {{-- Fullscreen Button --}}
                <button id="fullscreenBtn"
                        class="p-2 rounded-lg bg-white/10 hover:bg-white/20 transition-colors"
                        title="Toggle Fullscreen">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
                    </svg>
                </button>

                {{-- Toggle Sidebar (Mobile) --}}
                <button id="toggleSidebar"
                        class="md:hidden p-2 rounded-lg bg-white/10 hover:bg-white/20 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- ================= MAIN CONTENT ================= --}}
    <div class="flex flex-1 overflow-hidden">
        {{-- ================= QUESTION AREA ================= --}}
        <main class="flex-1 overflow-y-auto p-4 md:p-6">
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

                    {{-- Question Header --}}
                    <div class="mb-6 pb-4 border-b border-azwara-lighter dark:border-azwara-medium">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-3">
                            <div>
                                <h2 class="text-xl font-bold text-azwara-darkest dark:text-azwara-lighter">
                                    Soal {{ $i + 1 }}
                                </h2>
                                @if($exam->type === 'tryout' && $exam->test_type === 'skd' && $question->test_type)
                                    <div class="mt-1">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                            {{ $question->test_type === 'tiu' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300' :
                                               ($question->test_type === 'twk' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300' :
                                               'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300') }}">
                                            @if($question->test_type === 'tiu')
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                                </svg>
                                            @elseif($question->test_type === 'twk')
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                                </svg>
                                            @else
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                                </svg>
                                            @endif
                                            {{ strtoupper($question->test_type) }}
                                        </span>
                                    </div>
                                @endif
                            </div>

                            <div class="flex items-center gap-2">
                                <span class="text-sm text-gray-600 dark:text-gray-400">
                                    {{ $i + 1 }} / {{ $questions->count() }}
                                </span>
                                <span class="text-xs px-2 py-1 rounded-full bg-azwara-lighter/50 dark:bg-azwara-medium/30">
                                    {{ strtoupper($question->type) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Question Content --}}
                    <div class="mb-8">
                        <div class="prose dark:prose-invert max-w-none text-gray-800 dark:text-gray-200">
                            {!! $question->question_text !!}
                        </div>

                        @if($question->image)
                            <div class="mt-6">
                                <div class="inline-flex items-center px-3 py-1.5 rounded-lg bg-gray-100 dark:bg-azwara-medium/30 text-gray-700 dark:text-gray-300 text-sm mb-3">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    Gambar Soal
                                </div>
                                <div class="flex justify-center">
                                    <img src="{{ asset('storage/'.$question->image) }}"
                                         class="max-w-full md:max-w-lg max-h-80 object-contain rounded-lg shadow-lg"
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
                            <div class="space-y-3">
                                @foreach($question->options as $option)
                                    <div class="option-button group relative">
                                        <input type="{{ $question->type === 'mcma' ? 'checkbox' : 'radio' }}"
                                               name="question_{{ $question->id }}[]"
                                               value="{{ $option->id }}"
                                               id="option_{{ $option->id }}"
                                               class="sr-only"
                                               @checked(in_array($option->id, $answer?->selected_ids ?? []))>
                                        <label for="option_{{ $option->id }}"
                                               class="flex items-start gap-4 p-4 rounded-xl border-2 border-gray-200 dark:border-azwara-medium bg-white dark:bg-azwara-darkest cursor-pointer transition-all duration-200 hover:border-azwara-medium dark:hover:border-azwara-light hover:shadow-md">
                                            {{-- Option Indicator --}}
                                            <div class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-lg border-2 border-gray-300 dark:border-azwara-medium group-has-[input:checked]:border-primary group-has-[input:checked]:bg-primary text-gray-700 dark:text-gray-300 group-has-[input:checked]:text-white transition-all">
                                                @if($question->type === 'truefalse')
                                                    {{ $option->label === 'true' ? 'B' : 'S' }}
                                                @else
                                                    {{ $option->label }}
                                                @endif
                                            </div>

                                            {{-- Option Content --}}
                                            <div class="flex-1">

                                                <div class="prose dark:prose-invert max-w-none text-sm text-gray-700 dark:text-gray-300">
                                                    {!! $option->option_text !!}
                                                </div>

                                                @if($option->image)
                                                    <div class="mt-3">
                                                        <img src="{{ asset('storage/'.$option->image) }}"
                                                             class="max-w-[200px] rounded-lg shadow-sm"
                                                             alt="Gambar Opsi"
                                                             loading="lazy">
                                                    </div>
                                                @endif
                                            </div>

                                            {{-- Check Indicator --}}
                                            <div class="flex-shrink-0 w-6 h-6 flex items-center justify-center rounded-full border-2 border-gray-300 dark:border-azwara-medium group-has-[input:checked]:border-primary group-has-[input:checked]:bg-primary transition-all">
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
                            <div class="bg-gradient-to-br from-azwara-lighter/30 to-white dark:from-azwara-medium/20 dark:to-azwara-darkest rounded-xl p-5 border border-azwara-lighter dark:border-azwara-medium">
                                <div class="flex items-center mb-4">
                                    <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center mr-3">
                                        <svg class="w-5 h-5 text-primary dark:text-azwara-lighter" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-azwara-darkest dark:text-azwara-lighter">Jawaban Singkat</h4>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Tulis jawaban Anda di bawah</p>
                                    </div>
                                </div>
                                <textarea name="short_answer_{{ $question->id }}"
                                          class="short-answer-input w-full p-4 rounded-lg border-2 border-azwara-lighter dark:border-azwara-medium bg-white dark:bg-azwara-darker text-gray-800 dark:text-gray-100 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-colors"
                                          rows="4"
                                          placeholder="Ketik jawaban Anda di sini...">{{ $answer?->short_answer_value ?? '' }}</textarea>
                            </div>
                        @endif

                        {{-- COMPOUND --}}
                        @if($question->type === 'compound')
                            <div class="bg-gradient-to-br from-purple-50 to-white dark:from-purple-900/10 dark:to-azwara-darkest rounded-xl p-5 border border-purple-200 dark:border-purple-500/30">
                                <div class="flex items-center mb-6">
                                    <div class="w-10 h-10 rounded-lg bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center mr-3">
                                        <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-purple-800 dark:text-purple-300">Soal Gabungan</h4>
                                        <p class="text-sm text-purple-600/80 dark:text-purple-400/80">Jawab semua pertanyaan di bawah</p>
                                    </div>
                                </div>

                                <div class="space-y-5">
                                    @foreach($question->subItems->sortBy('order') as $subIndex => $subItem)
                                        @php
                                            $subAnswer = $answer?->getCompoundAnswerBySubId($subItem->id);
                                        @endphp

                                        <div class="bg-white dark:bg-azwara-darker rounded-xl p-5 border border-gray-200 dark:border-azwara-medium shadow-sm">
                                            <div class="flex items-start justify-between mb-4">
                                                <div>
                                                    <div class="flex items-center gap-2 mb-2">
                                                        <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Sub-soal {{ $subIndex + 1 }}</span>
                                                        <span class="text-xs px-2 py-1 rounded-full bg-gray-100 dark:bg-azwara-medium/30 text-gray-700 dark:text-gray-300">
                                                            {{ $subItem->type === 'truefalse' ? 'BENAR/SALAH' : 'ISIAN SINGKAT' }}
                                                        </span>
                                                    </div>
                                                    <h5 class="font-medium text-gray-800 dark:text-gray-200">{{ $subItem->prompt }}</h5>
                                                </div>
                                            </div>

                                            @if($subItem->type === 'truefalse')
                                                <div class="flex gap-3">
                                                    <button type="button"
                                                            data-sub-id="{{ $subItem->id }}"
                                                            class="truefalse-btn flex-1 p-3 rounded-lg border-2 border-gray-200 dark:border-azwara-medium bg-white dark:bg-azwara-darker text-gray-700 dark:text-gray-300 hover:border-green-500 dark:hover:border-green-500 transition-all {{ $subAnswer && ($subAnswer['boolean'] ?? false) ? 'border-green-500 bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-300' : '' }}">
                                                        <div class="flex items-center justify-center gap-2">
                                                            <div class="w-6 h-6 rounded-full border-2 border-gray-300 dark:border-azwara-medium {{ $subAnswer && ($subAnswer['boolean'] ?? false) ? 'border-green-500 bg-green-500' : '' }}"></div>
                                                            <span>Benar</span>
                                                        </div>
                                                    </button>
                                                    <button type="button"
                                                            data-sub-id="{{ $subItem->id }}"
                                                            class="truefalse-btn flex-1 p-3 rounded-lg border-2 border-gray-200 dark:border-azwara-medium bg-white dark:bg-azwara-darker text-gray-700 dark:text-gray-300 hover:border-red-500 dark:hover:border-red-500 transition-all {{ $subAnswer && !($subAnswer['boolean'] ?? true) ? 'border-red-500 bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-300' : '' }}">
                                                        <div class="flex items-center justify-center gap-2">
                                                            <div class="w-6 h-6 rounded-full border-2 border-gray-300 dark:border-azwara-medium {{ $subAnswer && !($subAnswer['boolean'] ?? true) ? 'border-red-500 bg-red-500' : '' }}"></div>
                                                            <span>Salah</span>
                                                        </div>
                                                    </button>
                                                </div>
                                            @elseif($subItem->type === 'short_answer')
                                                <div>
                                                    <textarea name="compound_{{ $question->id }}_sub_{{ $subItem->id }}"
                                                              data-sub-id="{{ $subItem->id }}"
                                                              class="compound-short-answer w-full p-4 rounded-lg border-2 border-gray-200 dark:border-azwara-medium bg-white dark:bg-azwara-darker text-gray-800 dark:text-gray-100 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-colors"
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
            @endforeach
        </main>

        {{-- ================= RIGHT SIDEBAR (NAVIGATION) ================= --}}
        <aside id="sidebar"
               class="fixed md:relative inset-y-0 right-0 z-40
                      w-64 md:w-72
                      bg-white dark:bg-azwara-darkest
                      border-l border-azwara-lighter dark:border-azwara-medium
                      transform translate-x-full md:translate-x-0
                      transition-transform duration-200
                      overflow-y-auto p-4 shadow-lg">

            {{-- Sidebar Header --}}
            <div class="mb-6 pb-4 border-b border-azwara-lighter dark:border-azwara-medium">
                <div class="flex items-center justify-between">
                    <h3 class="font-bold text-azwara-darkest dark:text-azwara-lighter">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        Navigasi Soal
                    </h3>
                    <button id="closeSidebar"
                            class="md:hidden p-1 rounded-lg hover:bg-gray-100 dark:hover:bg-azwara-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                    Klik nomor untuk berpindah soal
                </p>
            </div>

            {{-- Question Navigation Grid --}}
            <div class="grid grid-cols-5 md:grid-cols-4 gap-2">
                @foreach($questions as $i => $eq)
                    @php
                        $question = $eq->question;
                        $answer = $attempt->answers->where('question_id', $question->id)->first();
                        $answered = $answer && !$answer->isEmpty;
                    @endphp

                    <button type="button"
                            class="nav-btn relative w-full aspect-square rounded-lg flex items-center justify-center
                                   font-semibold text-sm transition-all duration-200
                                   {{ $answered
                                        ? 'bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300 border-2 border-green-300 dark:border-green-700'
                                        : 'bg-gray-100 dark:bg-azwara-medium/30 text-gray-700 dark:text-gray-300 border-2 border-gray-200 dark:border-azwara-medium' }}
                                   hover:scale-105 hover:shadow-md active:scale-95"
                            data-index="{{ $i }}"
                            data-question-type="{{ $question->type }}">
                        {{ $i + 1 }}
                    </button>
                @endforeach
            </div>

            {{-- Status Summary --}}
            <div class="mt-6 pt-4 border-t border-azwara-lighter dark:border-azwara-medium">
                <h4 class="font-semibold text-azwara-darkest dark:text-azwara-lighter mb-3">Status Pengerjaan</h4>
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 rounded-full bg-green-500"></div>
                            <span class="text-sm">Terjawab</span>
                        </div>
                        <span id="answeredCount" class="font-semibold">0</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 rounded-full bg-gray-400"></div>
                            <span class="text-sm">Belum Dijawab</span>
                        </div>
                        <span id="unansweredCount" class="font-semibold">{{ $questions->count() }}</span>
                    </div>
                </div>
            </div>
        </aside>

        {{-- Mobile Overlay --}}
        <div id="sidebarOverlay"
             class="fixed inset-0 bg-black/60 z-30 hidden md:hidden"
             onclick="hideSidebar()"></div>
    </div>

    {{-- ================= FOOTER NAVIGATION ================= --}}
    <div class="px-4 py-3 bg-white dark:bg-azwara-darkest border-t border-azwara-lighter dark:border-azwara-medium">
        <div class="flex justify-between items-center">
            <button id="prevBtn"
                    class="flex items-center gap-2 px-5 py-2.5 rounded-lg bg-gray-100 dark:bg-azwara-medium/30 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-azwara-medium/50 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
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
                            class="flex items-center gap-2 px-6 py-2.5 rounded-lg bg-gradient-to-r from-red-600 to-red-700 text-white hover:from-red-700 hover:to-red-800 transition-all shadow-md hover:shadow-lg">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Submit Jawaban
                    </button>
                </form>

                <button id="nextBtn"
                        class="flex items-center gap-2 px-5 py-2.5 rounded-lg bg-gradient-to-r from-primary to-azwara-medium text-white hover:from-primary/90 hover:to-azwara-medium/90 transition-all shadow-md hover:shadow-lg">
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

@include('exams.js.attempt')
