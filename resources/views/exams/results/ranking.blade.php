@extends('layouts.app')

@section('content')
<div class="min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- ================= HEADER ================= --}}
    <div class="mb-8 pb-6 border-b border-neutral-200 dark:border-white/10">
        {{-- Back Button --}}
        <a href="{{ route('exams.result.student', $exam) }}"
        class="group inline-flex items-center text-sm font-medium
               text-neutral-700 hover:text-primary-700
               dark:text-neutral-500 dark:hover:text-primary-200 transition-colors mb-5">
            <svg class="w-4 h-4 mr-2 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Hasil
        </a>

        {{-- Header Content --}}
        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-5">
            {{-- Title and Badges --}}
            <div class="flex-1 min-w-0">
                <div class="flex items-center gap-2.5 mb-2">
                    <span class="h-5 w-1 rounded-full bg-brand-gradient"></span>
                    <span class="text-[11px] font-semibold uppercase tracking-[0.14em] text-primary-600 dark:text-primary-300">
                        Leaderboard
                    </span>
                </div>

                <h1 class="text-2xl md:text-3xl font-bold tracking-tight text-primary-900 dark:text-primary-50 mb-3.5">
                    Peringkat Peserta
                </h1>
                <div class="flex flex-wrap items-center gap-2">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                 bg-neutral-100 text-neutral-800
                                 dark:bg-white/10 dark:text-neutral-300">
                        {{ $exam->context_title }}
                    </span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                 bg-primary-50 text-primary-700 ring-1 ring-inset ring-primary-600/15
                                 dark:bg-primary-500/15 dark:text-primary-200 dark:ring-primary-400/20">
                        {{ strtoupper($exam->test_type) }}
                    </span>

                    {{-- Badge untuk Blind Test atau Post Test --}}
                    @if(in_array($exam->type, ['blind_test', 'post_test']))
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                            {{ $exam->type === 'blind_test'
                                ? 'bg-accent-50 text-accent-700 ring-1 ring-inset ring-accent-600/20 dark:bg-accent-500/15 dark:text-accent-200 dark:ring-accent-400/20'
                                : 'bg-secondary-50 text-secondary-700 ring-1 ring-inset ring-secondary-600/20 dark:bg-secondary-500/15 dark:text-secondary-200 dark:ring-secondary-400/20' }}">
                            @if($exam->type === 'blind_test')
                                <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L6.59 6.59m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                </svg>
                                Blind Test
                            @else
                                <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                </svg>
                                Post Test
                            @endif
                        </span>
                    @endif
                </div>
            </div>

            {{-- Search Bar --}}
            <div class="w-full lg:w-auto">
                <form method="GET" action="{{ route('exams.ranking.student', $exam) }}" class="max-w-md lg:max-w-sm">
                    <div class="relative">
                        <input type="text"
                            name="search"
                            value="{{ $search }}"
                            placeholder="Cari nama peserta..."
                            class="w-full pl-10 pr-10 py-2.5 rounded-xl
                                   border border-neutral-300 dark:border-white/10
                                   bg-white dark:bg-white/5
                                   text-sm text-neutral-900 dark:text-neutral-100
                                   placeholder:text-neutral-600
                                   shadow-sm
                                   focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition">
                        <div class="absolute left-3.5 top-1/2 transform -translate-y-1/2">
                            <svg class="w-4 h-4 text-neutral-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        @if($search)
                            <a href="{{ route('exams.ranking.student', $exam) }}"
                            class="absolute right-3.5 top-1/2 transform -translate-y-1/2 text-neutral-600 hover:text-neutral-800 dark:hover:text-neutral-300 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </a>
                        @endif
                    </div>
                    @if($search)
                        <p class="text-sm text-neutral-700 dark:text-neutral-500 mt-2">
                            Hasil pencarian untuk "{{ $search }}"
                            <a href="{{ route('exams.ranking.student', $exam) }}" class="text-primary-600 dark:text-primary-300 font-medium hover:underline ml-2">
                                Tampilkan semua
                            </a>
                        </p>
                    @endif
                </form>
            </div>
        </div>
    </div>

        {{-- ================= TABEL RANKING ================= --}}
        <div class="bg-white dark:bg-primary-950 rounded-2xl shadow-sm overflow-hidden
                    border border-neutral-200 dark:border-white/10">
            {{-- Table Header --}}
            <div class="px-5 py-4 bg-neutral-50 dark:bg-white/[0.03] border-b border-neutral-200 dark:border-white/10">
                <div class="flex items-center justify-between gap-3">
                    <h2 class="text-base font-semibold text-primary-900 dark:text-primary-50">
                        Daftar Peringkat
                    </h2>
                    <span class="text-sm text-neutral-700 dark:text-neutral-500 tabular-nums">
                        Total: {{ $attempts->count() }} peserta
                    </span>
                </div>
            </div>

            {{-- Mobile Card View --}}
            <div class="sm:hidden">
                @forelse ($attempts as $attempt)
                    @php
                        $isMe = $attempt->id === $myAttemptId;
                    @endphp

                    <div class="p-4 border-b border-neutral-200 dark:border-white/10 {{ $isMe ? 'bg-primary-50/70 dark:bg-primary-500/10 ring-1 ring-inset ring-primary-500/20' : '' }}">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center gap-3 min-w-0">
                                @if ($attempt->rank <= 3)
                                    <div class="flex-shrink-0">
                                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-xl text-sm font-bold tabular-nums
                                            {{ $attempt->rank === 1 ? 'bg-gold-100 text-gold-800 ring-1 ring-inset ring-gold-500/40 dark:bg-gold-500/20 dark:text-gold-200' :
                                               ($attempt->rank === 2 ? 'bg-neutral-200 text-neutral-900 ring-1 ring-inset ring-neutral-400/40 dark:bg-white/15 dark:text-neutral-100' :
                                               'bg-accent-100 text-accent-800 ring-1 ring-inset ring-accent-500/30 dark:bg-accent-500/20 dark:text-accent-200') }}">
                                            {{ $attempt->rank }}
                                        </span>
                                    </div>
                                @else
                                    <div class="flex-shrink-0 w-8 h-8 flex items-center justify-center
                                                bg-neutral-100 dark:bg-white/10 rounded-xl">
                                        <span class="text-sm font-medium tabular-nums text-neutral-800 dark:text-neutral-300">
                                            {{ $attempt->rank }}
                                        </span>
                                    </div>
                                @endif

                                <div class="min-w-0">
                                    <div class="font-semibold truncate text-neutral-900 dark:text-neutral-100">
                                        {{ $attempt->user->name }}
                                    </div>
                                </div>
                            </div>

                            <div class="text-right flex-shrink-0">
                                <div class="text-[11px] font-semibold uppercase tracking-[0.1em] text-neutral-700 dark:text-neutral-600">Skor</div>
                                <div class="font-bold text-lg tabular-nums {{ $isMe ? 'text-primary-700 dark:text-primary-200' : 'text-neutral-900 dark:text-neutral-100' }}">
                                    {{ $attempt->score }}
                                </div>
                            </div>
                        </div>

                        {{-- Detail Skor --}}
                        <div class="grid grid-cols-2 gap-2 text-sm">
                            {{-- Untuk tipe selain SKD --}}
                            @if (!($exam->type === 'tryout' && $exam->test_type === 'skd'))
                                <div class="flex justify-between items-center px-2.5 py-2 bg-neutral-50 dark:bg-white/[0.04] rounded-lg">
                                    <span class="text-neutral-700 dark:text-neutral-500">Benar</span>
                                    <span class="font-semibold tabular-nums text-green-600 dark:text-green-400">{{ $attempt->correct }}</span>
                                </div>
                                <div class="flex justify-between items-center px-2.5 py-2 bg-neutral-50 dark:bg-white/[0.04] rounded-lg">
                                    <span class="text-neutral-700 dark:text-neutral-500">Salah</span>
                                    <span class="font-semibold tabular-nums text-red-600 dark:text-red-400">{{ $attempt->wrong }}</span>
                                </div>
                                @if ($exam->type === 'tryout' && $exam->test_type === 'mtk_stis')
                                    <div class="flex justify-between items-center px-2.5 py-2 bg-neutral-50 dark:bg-white/[0.04] rounded-lg">
                                        <span class="text-neutral-700 dark:text-neutral-500">Kosong</span>
                                        <span class="font-semibold tabular-nums text-neutral-800 dark:text-neutral-300">{{ $attempt->empty }}</span>
                                    </div>
                                @endif
                            @endif

                            {{-- Untuk tipe SKD --}}
                            @if ($exam->type === 'tryout' && $exam->test_type === 'skd')
                                <div class="flex justify-between items-center px-2.5 py-2 bg-neutral-50 dark:bg-white/[0.04] rounded-lg">
                                    <span class="text-neutral-700 dark:text-neutral-500">TWK</span>
                                    <span class="font-semibold tabular-nums text-neutral-900 dark:text-neutral-200">{{ $attempt->score_twk ?? 0 }}</span>
                                </div>
                                <div class="flex justify-between items-center px-2.5 py-2 bg-neutral-50 dark:bg-white/[0.04] rounded-lg">
                                    <span class="text-neutral-700 dark:text-neutral-500">TIU</span>
                                    <span class="font-semibold tabular-nums text-neutral-900 dark:text-neutral-200">{{ $attempt->score_tiu ?? 0 }}</span>
                                </div>
                                <div class="flex justify-between items-center px-2.5 py-2 bg-neutral-50 dark:bg-white/[0.04] rounded-lg">
                                    <span class="text-neutral-700 dark:text-neutral-500">TKP</span>
                                    <span class="font-semibold tabular-nums text-neutral-900 dark:text-neutral-200">{{ $attempt->score_tkp ?? 0 }}</span>
                                </div>
                            @endif

                            {{-- Status untuk tipe tertentu --}}
                            @if ($exam->type === 'tryout' && in_array($exam->test_type, ['skd', 'mtk_stis']))
                                <div class="col-span-2">
                                    <div class="flex justify-between items-center px-2.5 py-2 bg-neutral-50 dark:bg-white/[0.04] rounded-lg mt-1">
                                        <span class="text-neutral-700 dark:text-neutral-500">Status</span>
                                        <span class="font-semibold {{ $attempt->is_passed ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                            {{ $attempt->is_passed ? 'Lulus' : 'Belum Lulus' }}
                                        </span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="p-6 sm:p-8 text-center border-t border-neutral-200 dark:border-white/10">
                        <div class="mx-auto w-16 h-16 flex items-center justify-center rounded-2xl
                                    bg-neutral-50 dark:bg-white/5
                                    border border-neutral-200 dark:border-white/10 mb-4">
                            @if($search)
                                <svg class="w-7 h-7 text-neutral-600 dark:text-neutral-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            @else
                                <svg class="w-7 h-7 text-neutral-600 dark:text-neutral-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            @endif
                        </div>

                        @if($search)
                            <h3 class="text-base font-semibold text-primary-900 dark:text-primary-50 mb-2">Tidak ditemukan</h3>
                            <p class="text-sm text-neutral-700 dark:text-neutral-500 mb-4">Tidak ada peserta dengan nama "{{ $search }}"</p>
                            <a href="{{ route('exams.ranking.student', $exam) }}"
                            class="inline-flex items-center px-4 py-2 text-sm font-semibold text-primary-600 dark:text-primary-300 hover:text-primary-700 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                                Tampilkan semua peserta
                            </a>
                        @else
                            <h3 class="text-base font-semibold text-primary-900 dark:text-primary-50 mb-2">Belum ada data ranking</h3>
                            <p class="text-sm text-neutral-700 dark:text-neutral-500">Tidak ada peserta yang telah mengikuti ujian ini.</p>
                        @endif
                    </div>
                @endforelse
            </div>

            {{-- Desktop Table View --}}
            <div class="hidden sm:block">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-neutral-200 dark:divide-white/10">
                        <thead class="bg-neutral-50 dark:bg-white/[0.03]">
                            <tr>
                                <th scope="col" class="px-6 py-3.5 text-left text-[11px] font-semibold text-neutral-700 dark:text-neutral-500 uppercase tracking-[0.12em]">
                                    Peringkat
                                </th>
                                <th scope="col" class="px-6 py-3.5 text-left text-[11px] font-semibold text-neutral-700 dark:text-neutral-500 uppercase tracking-[0.12em]">
                                    Nama Peserta
                                </th>

                                {{-- BENAR / SALAH (NON SKD) --}}
                                @if (!($exam->type === 'tryout' && $exam->test_type === 'skd'))
                                    <th scope="col" class="px-3 py-3.5 text-center text-[11px] font-semibold text-neutral-700 dark:text-neutral-500 uppercase tracking-[0.12em]">
                                        Benar
                                    </th>
                                    <th scope="col" class="px-3 py-3.5 text-center text-[11px] font-semibold text-neutral-700 dark:text-neutral-500 uppercase tracking-[0.12em]">
                                        Salah
                                    </th>
                                    @if ($exam->type === 'tryout' && $exam->test_type === 'mtk_stis')
                                        <th scope="col" class="px-3 py-3.5 text-center text-[11px] font-semibold text-neutral-700 dark:text-neutral-500 uppercase tracking-[0.12em]">
                                            Kosong
                                        </th>
                                    @endif
                                @endif

                                {{-- SKD SUB SCORE --}}
                                @if ($exam->type === 'tryout' && $exam->test_type === 'skd')
                                    <th scope="col" class="px-3 py-3.5 text-center text-[11px] font-semibold text-neutral-700 dark:text-neutral-500 uppercase tracking-[0.12em]">
                                        TWK
                                    </th>
                                    <th scope="col" class="px-3 py-3.5 text-center text-[11px] font-semibold text-neutral-700 dark:text-neutral-500 uppercase tracking-[0.12em]">
                                        TIU
                                    </th>
                                    <th scope="col" class="px-3 py-3.5 text-center text-[11px] font-semibold text-neutral-700 dark:text-neutral-500 uppercase tracking-[0.12em]">
                                        TKP
                                    </th>
                                @endif

                                <th scope="col" class="px-6 py-3.5 text-center text-[11px] font-semibold text-neutral-700 dark:text-neutral-500 uppercase tracking-[0.12em]">
                                    Skor
                                </th>

                                @if ($exam->type === 'tryout' && in_array($exam->test_type, ['skd', 'mtk_stis']))
                                    <th scope="col" class="px-6 py-3.5 text-center text-[11px] font-semibold text-neutral-700 dark:text-neutral-500 uppercase tracking-[0.12em]">
                                        Status
                                    </th>
                                @endif
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-neutral-200 dark:divide-white/10">
                            @forelse ($attempts as $attempt)
                                @php
                                    $isMe = $attempt->id === $myAttemptId;
                                @endphp

                                <tr class="{{ $isMe ? 'bg-primary-50/70 dark:bg-primary-500/10' : 'hover:bg-neutral-50 dark:hover:bg-white/[0.04]' }} transition-colors duration-150">
                                    {{-- RANK --}}
                                    <td class="px-6 py-4 whitespace-nowrap relative">
                                        @if($isMe)
                                            <span class="absolute left-0 inset-y-0 w-1 bg-primary-500"></span>
                                        @endif
                                        <div class="flex items-center">
                                            @if ($attempt->rank <= 3)
                                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-xl text-sm font-bold tabular-nums
                                                    {{ $attempt->rank === 1 ? 'bg-gold-100 text-gold-800 ring-1 ring-inset ring-gold-500/40 dark:bg-gold-500/20 dark:text-gold-200 dark:ring-gold-400/30' :
                                                       ($attempt->rank === 2 ? 'bg-neutral-200 text-neutral-900 ring-1 ring-inset ring-neutral-400/40 dark:bg-white/15 dark:text-neutral-100 dark:ring-white/15' :
                                                       'bg-accent-100 text-accent-800 ring-1 ring-inset ring-accent-500/30 dark:bg-accent-500/20 dark:text-accent-200 dark:ring-accent-400/30') }}">
                                                    {{ $attempt->rank }}
                                                </span>
                                            @else
                                                <span class="text-sm font-medium tabular-nums pl-1.5 {{ $isMe ? 'text-primary-700 dark:text-primary-200' : 'text-neutral-700 dark:text-neutral-400' }}">
                                                    {{ $attempt->rank }}
                                                </span>
                                            @endif
                                        </div>
                                    </td>

                                    {{-- NAMA --}}
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <div>
                                                <div class="text-sm font-semibold {{ $isMe ? 'text-primary-700 dark:text-primary-200' : 'text-neutral-900 dark:text-neutral-100' }}">
                                                    {{ $attempt->user->name }}
                                                </div>
                                            </div>
                                            @if($isMe)
                                                <span class="text-[10px] font-bold uppercase tracking-[0.1em] px-2 py-0.5 rounded-full
                                                             bg-primary-600 text-white">Anda</span>
                                            @endif
                                        </div>
                                    </td>

                                    {{-- BENAR / SALAH (NON SKD) --}}
                                    @if (!($exam->type === 'tryout' && $exam->test_type === 'skd'))
                                        <td class="px-3 py-4 whitespace-nowrap text-center">
                                            <span class="inline-flex items-center justify-center min-w-[2rem] h-8 px-2 rounded-lg text-sm font-semibold tabular-nums
                                                         bg-green-50 dark:bg-green-500/15
                                                         text-green-700 dark:text-green-300
                                                         ring-1 ring-inset ring-green-600/15 dark:ring-green-400/20">
                                                {{ $attempt->correct }}
                                            </span>
                                        </td>

                                        <td class="px-3 py-4 whitespace-nowrap text-center">
                                            <span class="inline-flex items-center justify-center min-w-[2rem] h-8 px-2 rounded-lg text-sm font-semibold tabular-nums
                                                         bg-red-50 dark:bg-red-500/15
                                                         text-red-700 dark:text-red-300
                                                         ring-1 ring-inset ring-red-600/15 dark:ring-red-400/20">
                                                {{ $attempt->wrong }}
                                            </span>
                                        </td>

                                        @if ($exam->type === 'tryout' && $exam->test_type === 'mtk_stis')
                                            <td class="px-3 py-4 whitespace-nowrap text-center">
                                                <span class="inline-flex items-center justify-center min-w-[2rem] h-8 px-2 rounded-lg text-sm font-semibold tabular-nums
                                                             bg-neutral-100 dark:bg-white/10
                                                             text-neutral-800 dark:text-neutral-300">
                                                    {{ $attempt->empty }}
                                                </span>
                                            </td>
                                        @endif
                                    @endif

                                    {{-- SKD SUB SCORE --}}
                                    @if ($exam->type === 'tryout' && $exam->test_type === 'skd')
                                        <td class="px-3 py-4 whitespace-nowrap text-center">
                                            <span class="text-sm font-semibold tabular-nums {{ $isMe ? 'text-primary-700 dark:text-primary-200' : 'text-neutral-900 dark:text-neutral-100' }}">
                                                {{ $attempt->score_twk ?? 0 }}
                                            </span>
                                        </td>
                                        <td class="px-3 py-4 whitespace-nowrap text-center">
                                            <span class="text-sm font-semibold tabular-nums {{ $isMe ? 'text-primary-700 dark:text-primary-200' : 'text-neutral-900 dark:text-neutral-100' }}">
                                                {{ $attempt->score_tiu ?? 0 }}
                                            </span>
                                        </td>
                                        <td class="px-3 py-4 whitespace-nowrap text-center">
                                            <span class="text-sm font-semibold tabular-nums {{ $isMe ? 'text-primary-700 dark:text-primary-200' : 'text-neutral-900 dark:text-neutral-100' }}">
                                                {{ $attempt->score_tkp ?? 0 }}
                                            </span>
                                        </td>
                                    @endif

                                    {{-- TOTAL SCORE --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span class="inline-flex items-center justify-center px-4 py-2 rounded-xl text-base font-bold tabular-nums
                                                     {{ $isMe
                                                        ? 'bg-primary-600 text-white shadow-sm'
                                                        : 'bg-neutral-100 text-neutral-900 dark:bg-white/10 dark:text-neutral-100' }}">
                                            {{ $attempt->score }}
                                        </span>
                                    </td>

                                    {{-- STATUS --}}
                                    @if ($exam->type === 'tryout' && in_array($exam->test_type, ['skd', 'mtk_stis']))
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                                {{ $attempt->is_passed
                                                    ? 'bg-primary-50 text-primary-700 ring-1 ring-inset ring-primary-600/20 dark:bg-primary-500/15 dark:text-primary-200 dark:ring-primary-400/20'
                                                    : 'bg-red-50 text-red-700 ring-1 ring-inset ring-red-600/15 dark:bg-red-500/15 dark:text-red-300 dark:ring-red-400/20' }}">
                                                {{ $attempt->is_passed ? 'Lulus' : 'Belum Lulus' }}
                                            </span>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="px-6 py-16 text-center">
                                        <div class="mx-auto max-w-sm flex flex-col items-center gap-3">
                                            @if($search)
                                                <div class="w-16 h-16 rounded-2xl bg-neutral-50 dark:bg-white/5
                                                            border border-neutral-200 dark:border-white/10
                                                            flex items-center justify-center">
                                                    <svg class="h-7 w-7 text-neutral-600 dark:text-neutral-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                </div>
                                                <h3 class="text-base font-semibold text-primary-900 dark:text-primary-50">Tidak ditemukan</h3>
                                                <p class="text-sm text-neutral-700 dark:text-neutral-500">
                                                    Tidak ada peserta dengan nama "{{ $search }}"
                                                </p>
                                                <a href="{{ route('exams.ranking.student', $exam) }}"
                                                class="inline-flex items-center text-sm font-semibold text-primary-600 dark:text-primary-300 hover:underline transition-colors">
                                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                                    </svg>
                                                    Tampilkan semua
                                                </a>
                                            @else
                                                <div class="w-16 h-16 rounded-2xl bg-neutral-50 dark:bg-white/5
                                                            border border-neutral-200 dark:border-white/10
                                                            flex items-center justify-center">
                                                    <svg class="h-7 w-7 text-neutral-600 dark:text-neutral-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                    </svg>
                                                </div>
                                                <h3 class="text-base font-semibold text-primary-900 dark:text-primary-50">Belum ada data ranking</h3>
                                                <p class="text-sm text-neutral-700 dark:text-neutral-500">
                                                    Tidak ada peserta yang telah mengikuti ujian ini.
                                                </p>
                                            @endif
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
</div>
@endsection
