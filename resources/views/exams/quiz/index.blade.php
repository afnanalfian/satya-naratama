{{-- exams/quiz/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div x-data="{ open: false }" class="space-y-8">

    {{-- Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-3xl font-bold tracking-tight text-neutral-900 dark:text-white">
                Daftar Quiz
            </h1>
            <p class="mt-1 text-sm text-neutral-500 dark:text-neutral-400">
                Kelola dan akses semua quiz yang tersedia
            </p>
        </div>

        {{-- Action + Search --}}
        <form method="GET"
            action="{{ route('exams.index') }}"
            class="flex flex-col gap-2 w-full sm:flex-row sm:w-auto">

            <div class="relative">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-neutral-400 dark:text-neutral-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input
                    type="text"
                    name="q"
                    value="{{ request('q') }}"
                    placeholder="Cari judul quiz..."
                    class="w-full sm:w-64 pl-10 pr-4 py-2.5 rounded-xl
                        border border-neutral-200 dark:border-neutral-700
                        bg-white dark:bg-neutral-900
                        text-sm text-neutral-900 dark:text-white
                        placeholder:text-neutral-400 dark:placeholder:text-neutral-500
                        focus:ring-2 focus:ring-primary/20 focus:border-primary
                        transition-all duration-200"
                >
            </div>

            <button
                type="submit"
                class="px-6 py-2.5 rounded-xl
                    bg-primary text-white text-sm font-medium
                    hover:bg-primary-600 active:scale-[0.98]
                    transition-all duration-200 shadow-sm hover:shadow-md">
                Cari
            </button>

            @role('admin')
            <button
                type="button"
                @click="open = true"
                class="px-6 py-2.5 rounded-xl
                    border-2 border-primary text-primary dark:border-primary-400 dark:text-primary-400
                    text-sm font-medium
                    hover:bg-primary hover:text-white dark:hover:bg-primary dark:hover:text-white
                    transition-all duration-200">
                + Tambah Quiz
            </button>
            @endrole
        </form>
    </div>

    {{-- Table Card --}}
    <div
        class="bg-white dark:bg-neutral-900
               border border-neutral-200 dark:border-neutral-700
               rounded-2xl
               shadow-sm
               overflow-hidden">

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">

                {{-- Head --}}
                <thead class="bg-neutral-50 dark:bg-neutral-800/50 border-b border-neutral-200 dark:border-neutral-700">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold text-neutral-700 dark:text-neutral-300">
                            Quiz
                        </th>
                        <th class="px-6 py-4 text-center font-semibold text-neutral-700 dark:text-neutral-300">
                            Status
                        </th>
                        <th class="px-6 py-4 text-left font-semibold text-neutral-700 dark:text-neutral-300 hidden sm:table-cell">
                            Tanggal
                        </th>
                    </tr>
                </thead>

                {{-- Body --}}
                <tbody class="divide-y divide-neutral-100 dark:divide-neutral-800">
                    @forelse($exams as $exam)
                        <tr
                            onclick="window.location='{{ route('exams.show', $exam) }}'"
                            class="cursor-pointer
                                   hover:bg-neutral-50 dark:hover:bg-neutral-800/50
                                   transition-colors duration-150">

                            {{-- Quiz --}}
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <div class="font-medium text-neutral-900 dark:text-white">
                                        {{ $exam->title }}
                                    </div>
                                    <div class="text-xs text-neutral-500 dark:text-neutral-400 sm:hidden">
                                        {{ $exam->exam_date->format('d M Y H:i') }}
                                    </div>
                                </div>
                            </td>

                            {{-- Status --}}
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                    @if($exam->status === 'active')
                                        bg-green-50 text-green-700 dark:bg-green-900/20 dark:text-green-400
                                        ring-1 ring-green-600/20 dark:ring-green-400/20
                                    @elseif($exam->status === 'inactive')
                                        bg-yellow-50 text-yellow-700 dark:bg-yellow-900/20 dark:text-yellow-400
                                        ring-1 ring-yellow-600/20 dark:ring-yellow-400/20
                                    @else
                                        bg-neutral-50 text-neutral-600 dark:bg-neutral-800 dark:text-neutral-400
                                        ring-1 ring-neutral-600/20 dark:ring-neutral-400/20
                                    @endif
                                ">
                                    <span class="w-1.5 h-1.5 rounded-full mr-1.5
                                        @if($exam->status === 'active') bg-green-500
                                        @elseif($exam->status === 'inactive') bg-yellow-500
                                        @else bg-neutral-400 @endif
                                    "></span>
                                    {{ ucfirst($exam->status) }}
                                </span>
                            </td>

                            {{-- Tanggal --}}
                            <td class="px-6 py-4 text-neutral-500 dark:text-neutral-400 hidden sm:table-cell">
                                {{ $exam->exam_date->format('d M Y H:i') }}
                            </td>
                        </tr>
                    @empty
                        {{-- Empty State --}}
                        <tr>
                            <td colspan="3" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-16 h-16 rounded-full bg-neutral-100 dark:bg-neutral-800 flex items-center justify-center">
                                        <svg class="w-8 h-8 text-neutral-400 dark:text-neutral-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>
                                    <p class="text-base font-medium text-neutral-900 dark:text-white">
                                        Belum Ada Quiz
                                    </p>
                                    <p class="text-sm text-neutral-500 dark:text-neutral-400">
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
    <div class="pt-2">
        {{ $exams->links() }}
    </div>

@include('exams.partials._create-modal', ['type' => 'quiz'])
</div>

@endsection
