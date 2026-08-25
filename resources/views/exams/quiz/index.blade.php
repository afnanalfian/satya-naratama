@extends('layouts.app')

@section('content')
<div x-data="{ open: false }" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">

    {{-- ================= HEADER ================= --}}
    <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between
                pb-6 border-b border-neutral-200 dark:border-white/10">

        {{-- Title --}}
        <div>
            <div class="flex items-center gap-2.5 mb-2">
                <span class="h-5 w-1 rounded-full bg-brand-gradient"></span>
                <span class="text-[11px] font-semibold uppercase tracking-[0.14em] text-primary-600 dark:text-primary-300">
                    Bank Ujian
                </span>
            </div>

            <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-primary-900 dark:text-primary-50">
                Daftar Quiz
            </h1>

            <p class="mt-1.5 text-sm text-neutral-700 dark:text-neutral-500">
                Kelola dan pantau seluruh quiz yang tersedia
            </p>
        </div>

        {{-- Action + Search --}}
        <form method="GET"
            action="{{ route('exams.index') }}"
            class="flex flex-col gap-2.5 w-full sm:flex-row sm:w-auto sm:items-center">

            {{-- Search Judul --}}
            <div class="relative w-full sm:w-72">
                <svg class="pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-neutral-600 dark:text-neutral-600"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-5.2-5.2m2.2-5.3a7.5 7.5 0 11-15 0 7.5 7.5 0 0115 0z"/>
                </svg>

                <input
                    type="text"
                    name="q"
                    value="{{ request('q') }}"
                    placeholder="Cari judul quiz"
                    class="w-full pl-10 pr-4 py-2.5
                        rounded-xl
                        border border-neutral-300 dark:border-white/10
                        bg-white dark:bg-white/5
                        text-sm text-neutral-900 dark:text-neutral-100
                        placeholder:text-neutral-600 dark:placeholder:text-neutral-600
                        shadow-sm
                        focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20
                        transition"
                >
            </div>

            {{-- Filter Tanggal --}}
            {{-- <input
                type="date"
                name="date"
                value="{{ request('date') }}"
                class="w-full sm:w-44
                    rounded-xl
                    border border-neutral-300 dark:border-white/10
                    bg-white dark:bg-white/5
                    px-4 py-2.5 text-sm text-neutral-900 dark:text-neutral-100
                    focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20"
            > --}}

            {{-- Button Cari --}}
            <button
                type="submit"
                class="px-5 py-2.5 rounded-xl
                    bg-primary-600 text-white text-sm font-semibold
                    shadow-sm hover:bg-primary-700 active:bg-primary-800
                    focus:outline-none focus:ring-2 focus:ring-primary-500/40 focus:ring-offset-2 dark:focus:ring-offset-primary-950
                    transition">
                Cari
            </button>

            {{-- Tambah Quiz --}}
            @role('admin')
            <button
                type="button"
                @click="open = true"
                class="inline-flex items-center justify-center gap-2
                    px-5 py-2.5 rounded-xl
                    border border-primary-600/30 dark:border-primary-400/30
                    bg-primary-50 dark:bg-primary-500/10
                    text-primary-700 dark:text-primary-200 text-sm font-semibold
                    hover:bg-primary-100 dark:hover:bg-primary-500/20
                    focus:outline-none focus:ring-2 focus:ring-primary-500/30
                    transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14m-7-7h14"/>
                </svg>
                Tambah Quiz
            </button>
            @endrole
        </form>
    </div>

    {{-- Table Card --}}
    <div
        class="bg-white dark:bg-primary-950
               border border-neutral-200 dark:border-white/10
               rounded-2xl
               shadow-sm
               overflow-hidden">

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">

                {{-- Head --}}
                <thead
                    class="bg-neutral-50 dark:bg-white/[0.03]
                           border-b border-neutral-200 dark:border-white/10">
                    <tr>
                        <th class="px-6 py-4 text-left text-[11px] font-semibold uppercase tracking-[0.12em] text-neutral-700 dark:text-neutral-500">
                            Quiz
                        </th>
                        <th class="px-6 py-4 text-center text-[11px] font-semibold uppercase tracking-[0.12em] text-neutral-700 dark:text-neutral-500">
                            Status
                        </th>
                        <th class="px-6 py-4 text-left text-[11px] font-semibold uppercase tracking-[0.12em] text-neutral-700 dark:text-neutral-500 hidden sm:table-cell">
                            Tanggal
                        </th>
                    </tr>
                </thead>

                {{-- Body --}}
                <tbody class="divide-y divide-neutral-200 dark:divide-white/10">
                    @forelse($exams as $exam)
                        <tr
                            onclick="window.location='{{ route('exams.show', $exam) }}'"
                            class="group cursor-pointer
                                   hover:bg-primary-50/60 dark:hover:bg-white/[0.04]
                                   transition-colors">

                            {{-- Quiz --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3.5">
                                    <div class="hidden sm:flex flex-shrink-0 w-9 h-9 rounded-xl
                                                bg-primary-50 dark:bg-primary-500/10
                                                border border-primary-100 dark:border-primary-400/20
                                                items-center justify-center
                                                text-primary-600 dark:text-primary-300
                                                group-hover:bg-primary-100 dark:group-hover:bg-primary-500/20
                                                transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                        </svg>
                                    </div>

                                    <div class="flex flex-col min-w-0">
                                        <div class="font-semibold text-neutral-900 dark:text-neutral-100 truncate
                                                    group-hover:text-primary-700 dark:group-hover:text-primary-200
                                                    transition-colors">
                                            {{ $exam->title }}
                                        </div>

                                        {{-- tanggal versi mobile --}}
                                        <div class="text-xs text-neutral-700 dark:text-neutral-600 sm:hidden mt-0.5">
                                            {{ $exam->exam_date->format('d M Y H:i') }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            {{-- Status --}}
                            <td class="px-6 py-4 text-center">
                                @php
                                    $statusStyle = match($exam->status) {
                                        'active'   => 'bg-primary-50 text-primary-700 ring-primary-600/20 dark:bg-primary-500/15 dark:text-primary-200 dark:ring-primary-400/20',
                                        'inactive' => 'bg-gold-50 text-gold-700 ring-gold-600/20 dark:bg-gold-500/15 dark:text-gold-200 dark:ring-gold-400/20',
                                        default    => 'bg-neutral-100 text-neutral-800 ring-neutral-400/30 dark:bg-white/10 dark:text-neutral-300 dark:ring-white/10',
                                    };
                                @endphp

                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium
                                           ring-1 ring-inset {{ $statusStyle }}">
                                    <span class="w-1.5 h-1.5 rounded-full bg-current opacity-70"></span>
                                    {{ ucfirst($exam->status) }}
                                </span>
                            </td>

                            {{-- Tanggal --}}
                            <td
                                class="px-6 py-4 text-neutral-700 dark:text-neutral-400
                                       hidden sm:table-cell tabular-nums">
                                {{ $exam->exam_date->format('d M Y H:i') }}
                            </td>
                        </tr>
                    @empty
                        {{-- Empty State --}}
                        <tr>
                            <td colspan="3" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <div
                                        class="w-16 h-16 rounded-2xl
                                               bg-neutral-50 dark:bg-white/5
                                               border border-neutral-200 dark:border-white/10
                                               flex items-center justify-center
                                               text-neutral-600 dark:text-neutral-600">
                                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>

                                    <p class="text-base font-semibold text-primary-900 dark:text-primary-50">
                                        Belum Ada Quiz
                                    </p>

                                    <p class="text-sm text-neutral-700 dark:text-neutral-500 max-w-xs">
                                        Data quiz akan muncul setelah tersedia
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div>
        {{ $exams->links() }}
    </div>

@include('exams.partials._create-modal', ['type' => 'quiz'])
</div>

@endsection
