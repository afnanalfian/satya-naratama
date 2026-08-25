@extends('layouts.app')

@section('content')
<div class="min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    {{-- ================= HEADER ================= --}}
    <div class="mb-8">
        {{-- Back Button --}}
        <a href="{{ route('exams.result.student', $exam) }}"
        class="inline-flex items-center text-sm text-azwara-medium hover:text-azwara-darkest dark:hover:text-azwara-lightest transition-colors mb-6 group">
            <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Hasil
        </a>

        {{-- Header Content --}}
        <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4 mb-6">
            {{-- Title and Badges --}}
            <div class="flex-1">
                <h1 class="text-2xl md:text-3xl font-bold text-azwara-darkest dark:text-azwara-lightest mb-3">
                    Peringkat Peserta
                </h1>
                <div class="flex flex-wrap items-center gap-2">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-azwara-lighter/50 dark:bg-azwara-medium/30 text-azwara-darkest dark:text-azwara-lightest">
                        {{ $exam->context_title }}
                    </span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-primary/10 text-primary dark:text-azwara-lighter">
                        {{ strtoupper($exam->test_type) }}
                    </span>

                    {{-- Badge untuk Blind Test atau Post Test --}}
                    @if(in_array($exam->type, ['blind_test', 'post_test']))
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                            {{ $exam->type === 'blind_test'
                                ? 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300'
                                : 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300' }}">
                            @if($exam->type === 'blind_test')
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L6.59 6.59m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                </svg>
                                Blind Test
                            @else
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
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
                            class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-azwara-lighter dark:border-azwara-medium bg-white dark:bg-azwara-darkest text-azwara-darkest dark:text-azwara-lightest focus:ring-2 focus:ring-primary focus:border-transparent">
                        <div class="absolute left-3 top-1/2 transform -translate-y-1/2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        @if($search)
                            <a href="{{ route('exams.ranking.student', $exam) }}"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </a>
                        @endif
                    </div>
                    @if($search)
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                            Hasil pencarian untuk "{{ $search }}"
                            <a href="{{ route('exams.ranking.student', $exam) }}" class="text-primary hover:underline ml-2">
                                Tampilkan semua
                            </a>
                        </p>
                    @endif
                </form>
            </div>
        </div>
    </div>

        {{-- ================= TABEL RANKING ================= --}}
        <div class="bg-white dark:bg-azwara-darkest rounded-xl shadow-sm overflow-hidden border border-azwara-lighter dark:border-azwara-medium">
            {{-- Table Header --}}
            <div class="px-4 py-3 bg-azwara-lightest dark:bg-azwara-darker border-b border-azwara-lighter dark:border-azwara-medium">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-azwara-darkest dark:text-azwara-lightest">
                        Daftar Peringkat
                    </h2>
                    <span class="text-sm text-gray-600 dark:text-gray-400">
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

                    <div class="p-4 border-b border-azwara-lighter dark:border-azwara-medium {{ $isMe ? 'bg-azwara-lighter/30 dark:bg-primary/10' : '' }}">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center gap-3">
                                @if ($attempt->rank <= 3)
                                    <div class="flex-shrink-0">
                                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full text-sm font-bold
                                            {{ $attempt->rank === 1 ? 'bg-yellow-400 text-black' :
                                               ($attempt->rank === 2 ? 'bg-gray-300 text-black' :
                                               'bg-amber-600 text-white') }}">
                                            {{ $attempt->rank }}
                                        </span>
                                    </div>
                                @else
                                    <div class="flex-shrink-0 w-8 h-8 flex items-center justify-center bg-gray-100 dark:bg-azwara-medium rounded-full">
                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                            {{ $attempt->rank }}
                                        </span>
                                    </div>
                                @endif

                                <div>
                                    <div class="font-semibold text-azwara-darkest dark:text-azwara-lightest">
                                        {{ $attempt->user->name }}
                                    </div>
                                </div>
                            </div>

                            <div class="text-right">
                                <div class="text-sm text-gray-600 dark:text-gray-400">Skor</div>
                                <div class="font-bold text-lg {{ $isMe ? 'text-primary dark:text-azwara-lighter' : 'text-azwara-darkest dark:text-azwara-lightest' }}">
                                    {{ $attempt->score }}
                                </div>
                            </div>
                        </div>

                        {{-- Detail Skor --}}
                        <div class="grid grid-cols-2 gap-3 text-sm">
                            {{-- Untuk tipe selain SKD --}}
                            @if (!($exam->type === 'tryout' && $exam->test_type === 'skd'))
                                <div class="flex justify-between items-center p-2 bg-gray-50 dark:bg-azwara-darker rounded">
                                    <span class="text-gray-600 dark:text-gray-400">Benar</span>
                                    <span class="font-medium text-green-600 dark:text-green-400">{{ $attempt->correct }}</span>
                                </div>
                                <div class="flex justify-between items-center p-2 bg-gray-50 dark:bg-azwara-darker rounded">
                                    <span class="text-gray-600 dark:text-gray-400">Salah</span>
                                    <span class="font-medium text-red-600 dark:text-red-400">{{ $attempt->wrong }}</span>
                                </div>
                                @if ($exam->type === 'tryout' && $exam->test_type === 'mtk_stis')
                                    <div class="flex justify-between items-center p-2 bg-gray-50 dark:bg-azwara-darker rounded">
                                        <span class="text-gray-600 dark:text-gray-400">Kosong</span>
                                        <span class="font-medium text-gray-600 dark:text-gray-300">{{ $attempt->empty }}</span>
                                    </div>
                                @endif
                            @endif

                            {{-- Untuk tipe SKD --}}
                            @if ($exam->type === 'tryout' && $exam->test_type === 'skd')
                                <div class="flex justify-between items-center p-2 bg-gray-50 dark:bg-azwara-darker rounded">
                                    <span class="text-gray-600 dark:text-gray-400">TWK</span>
                                    <span class="font-medium">{{ $attempt->score_twk ?? 0 }}</span>
                                </div>
                                <div class="flex justify-between items-center p-2 bg-gray-50 dark:bg-azwara-darker rounded">
                                    <span class="text-gray-600 dark:text-gray-400">TIU</span>
                                    <span class="font-medium">{{ $attempt->score_tiu ?? 0 }}</span>
                                </div>
                                <div class="flex justify-between items-center p-2 bg-gray-50 dark:bg-azwara-darker rounded">
                                    <span class="text-gray-600 dark:text-gray-400">TKP</span>
                                    <span class="font-medium">{{ $attempt->score_tkp ?? 0 }}</span>
                                </div>
                            @endif

                            {{-- Status untuk tipe tertentu --}}
                            @if ($exam->type === 'tryout' && in_array($exam->test_type, ['skd', 'mtk_stis']))
                                <div class="col-span-2">
                                    <div class="flex justify-between items-center p-2 bg-gray-50 dark:bg-azwara-darker rounded mt-1">
                                        <span class="text-gray-600 dark:text-gray-400">Status</span>
                                        <span class="{{ $attempt->is_passed ? 'text-green-600 dark:text-green-400 font-medium' : 'text-red-600 dark:text-red-400 font-medium' }}">
                                            {{ $attempt->is_passed ? 'Lulus' : 'Belum Lulus' }}
                                        </span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="p-6 sm:p-8 text-center border-t border-azwara-lighter dark:border-azwara-medium">
                        <div class="mx-auto w-16 h-16 flex items-center justify-center rounded-full bg-azwara-lightest dark:bg-azwara-darker mb-4">
                            @if($search)
                                <svg class="w-8 h-8 text-azwara-medium" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            @else
                                <svg class="w-8 h-8 text-azwara-medium" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            @endif
                        </div>

                        @if($search)
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">Tidak ditemukan</h3>
                            <p class="text-gray-600 dark:text-gray-400 mb-4">Tidak ada peserta dengan nama "{{ $search }}"</p>
                            <a href="{{ route('exams.ranking.student', $exam) }}"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-primary hover:text-primary/80 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                                Tampilkan semua peserta
                            </a>
                        @else
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">Belum ada data ranking</h3>
                            <p class="text-gray-600 dark:text-gray-400">Tidak ada peserta yang telah mengikuti ujian ini.</p>
                        @endif
                    </div>
                @endforelse
            </div>

            {{-- Desktop Table View --}}
            <div class="hidden sm:block">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-azwara-lighter dark:divide-azwara-medium">
                        <thead class="bg-azwara-lightest dark:bg-azwara-darker">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    Peringkat
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    Nama Peserta
                                </th>

                                {{-- BENAR / SALAH (NON SKD) --}}
                                @if (!($exam->type === 'tryout' && $exam->test_type === 'skd'))
                                    <th scope="col" class="px-3 py-3 text-center text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        Benar
                                    </th>
                                    <th scope="col" class="px-3 py-3 text-center text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        Salah
                                    </th>
                                    @if ($exam->type === 'tryout' && $exam->test_type === 'mtk_stis')
                                        <th scope="col" class="px-3 py-3 text-center text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                            Kosong
                                        </th>
                                    @endif
                                @endif

                                {{-- SKD SUB SCORE --}}
                                @if ($exam->type === 'tryout' && $exam->test_type === 'skd')
                                    <th scope="col" class="px-3 py-3 text-center text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        TWK
                                    </th>
                                    <th scope="col" class="px-3 py-3 text-center text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        TIU
                                    </th>
                                    <th scope="col" class="px-3 py-3 text-center text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        TKP
                                    </th>
                                @endif

                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    Skor
                                </th>

                                @if ($exam->type === 'tryout' && in_array($exam->test_type, ['skd', 'mtk_stis']))
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        Status
                                    </th>
                                @endif
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-azwara-lighter dark:divide-azwara-medium">
                            @forelse ($attempts as $attempt)
                                @php
                                    $isMe = $attempt->id === $myAttemptId;
                                @endphp

                                <tr class="{{ $isMe ? 'bg-gradient-to-r from-primary/10 to-azwara-lighter/20 dark:from-primary/20 dark:to-azwara-medium/10' : 'hover:bg-gray-50 dark:hover:bg-azwara-medium/10' }} transition-colors duration-150">
                                    {{-- RANK --}}
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            @if ($attempt->rank <= 3)
                                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full text-sm font-bold
                                                    {{ $attempt->rank === 1 ? 'bg-yellow-400 text-black' :
                                                       ($attempt->rank === 2 ? 'bg-gray-300 text-black' :
                                                       'bg-amber-600 text-white') }}">
                                                    {{ $attempt->rank }}
                                                </span>
                                            @else
                                                <span class="text-sm font-medium {{ $isMe ? 'text-primary dark:text-azwara-lighter' : 'text-gray-700 dark:text-gray-300' }}">
                                                    {{ $attempt->rank }}
                                                </span>
                                            @endif
                                        </div>
                                    </td>

                                    {{-- NAMA --}}
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div>
                                                <div class="text-sm font-semibold {{ $isMe ? 'text-primary dark:text-azwara-lighter' : 'text-azwara-darkest dark:text-azwara-lightest' }}">
                                                    {{ $attempt->user->name }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- BENAR / SALAH (NON SKD) --}}
                                    @if (!($exam->type === 'tryout' && $exam->test_type === 'skd'))
                                        <td class="px-3 py-4 whitespace-nowrap text-center">
                                            <span class="inline-flex items-center justify-center w-8 h-8 rounded text-sm font-medium bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300">
                                                {{ $attempt->correct }}
                                            </span>
                                        </td>

                                        <td class="px-3 py-4 whitespace-nowrap text-center">
                                            <span class="inline-flex items-center justify-center w-8 h-8 rounded text-sm font-medium bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300">
                                                {{ $attempt->wrong }}
                                            </span>
                                        </td>

                                        @if ($exam->type === 'tryout' && $exam->test_type === 'mtk_stis')
                                            <td class="px-3 py-4 whitespace-nowrap text-center">
                                                <span class="inline-flex items-center justify-center w-8 h-8 rounded text-sm font-medium bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-300">
                                                    {{ $attempt->empty }}
                                                </span>
                                            </td>
                                        @endif
                                    @endif

                                    {{-- SKD SUB SCORE --}}
                                    @if ($exam->type === 'tryout' && $exam->test_type === 'skd')
                                        <td class="px-3 py-4 whitespace-nowrap text-center">
                                            <span class="text-sm font-medium {{ $isMe ? 'text-primary dark:text-azwara-lighter' : 'text-gray-900 dark:text-gray-100' }}">
                                                {{ $attempt->score_twk ?? 0 }}
                                            </span>
                                        </td>
                                        <td class="px-3 py-4 whitespace-nowrap text-center">
                                            <span class="text-sm font-medium {{ $isMe ? 'text-primary dark:text-azwara-lighter' : 'text-gray-900 dark:text-gray-100' }}">
                                                {{ $attempt->score_tiu ?? 0 }}
                                            </span>
                                        </td>
                                        <td class="px-3 py-4 whitespace-nowrap text-center">
                                            <span class="text-sm font-medium {{ $isMe ? 'text-primary dark:text-azwara-lighter' : 'text-gray-900 dark:text-gray-100' }}">
                                                {{ $attempt->score_tkp ?? 0 }}
                                            </span>
                                        </td>
                                    @endif

                                    {{-- TOTAL SCORE --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span class="inline-flex items-center justify-center px-4 py-2 rounded-lg text-base font-bold {{ $isMe ? 'bg-primary text-white' : 'bg-azwara-medium/10 text-azwara-darkest dark:text-azwara-lightest' }}">
                                            {{ $attempt->score }}
                                        </span>
                                    </td>

                                    {{-- STATUS --}}
                                    @if ($exam->type === 'tryout' && in_array($exam->test_type, ['skd', 'mtk_stis']))
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                                {{ $attempt->is_passed ? 'bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300' :
                                                   'bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300' }}">
                                                {{ $attempt->is_passed ? 'Lulus' : 'Belum Lulus' }}
                                            </span>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="px-6 py-12 text-center">
                                        <div class="mx-auto max-w-sm">
                                            @if($search)
                                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">Tidak ditemukan</h3>
                                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400 mb-4">
                                                    Tidak ada peserta dengan nama "{{ $search }}"
                                                </p>
                                                <a href="{{ route('exams.ranking.student', $exam) }}"
                                                class="inline-flex items-center text-sm text-primary hover:text-primary/80 hover:underline transition-colors">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                                    </svg>
                                                    Tampilkan semua
                                                </a>
                                            @else
                                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                                <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">Belum ada data ranking</h3>
                                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
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
