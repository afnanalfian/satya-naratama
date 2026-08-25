@extends('layouts.app')

@section('title', $exam->title.' | Tryout Satya Naratama - Matematika, SKD, dll')
@section('description', 'Ikuti tryout '.$exam->title.' lengkap dengan pembahasan.')

@section('content')
<div class="min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- ================= HEADER ================= --}}
        <div class="mb-8">
            {{-- Breadcrumb --}}
            <nav class="flex mb-5" aria-label="Breadcrumb">
                <ol class="inline-flex items-center gap-1.5">
                    <li class="inline-flex items-center">
                        <a href="{{ $exam->backRoute() }}" class="inline-flex items-center text-sm font-medium text-neutral-700 hover:text-primary-700 dark:text-neutral-500 dark:hover:text-primary-200 transition-colors">
                            Daftar Ujian
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-neutral-500 dark:text-neutral-700" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1.5 text-sm text-neutral-700 dark:text-neutral-500">Detail Ujian</span>
                        </div>
                    </li>
                </ol>
            </nav>

            {{-- Title and Info --}}
            <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-5
                        pb-7 border-b border-neutral-200 dark:border-white/10">
                <div class="flex-1 min-w-0">
                    <div class="flex flex-wrap items-center gap-2 mb-3.5">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-semibold uppercase tracking-[0.1em]
                                     bg-primary-50 text-primary-700 ring-1 ring-inset ring-primary-600/15
                                     dark:bg-primary-500/15 dark:text-primary-200 dark:ring-primary-400/20">
                            {{ strtoupper($exam->test_type) }}
                        </span>

                        @if($exam->status === 'inactive')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                         bg-gold-50 text-gold-700 ring-1 ring-inset ring-gold-600/20
                                         dark:bg-gold-500/15 dark:text-gold-200 dark:ring-gold-400/20">
                                <span class="w-1.5 h-1.5 bg-gold-500 rounded-full mr-1.5"></span>
                                Belum Dimulai
                            </span>
                        @elseif($exam->status === 'active')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                         bg-primary-50 text-primary-700 ring-1 ring-inset ring-primary-600/20
                                         dark:bg-primary-500/15 dark:text-primary-200 dark:ring-primary-400/20">
                                <span class="w-1.5 h-1.5 bg-primary-500 rounded-full mr-1.5 animate-pulse"></span>
                                Berlangsung
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                         bg-neutral-100 text-neutral-800 ring-1 ring-inset ring-neutral-400/30
                                         dark:bg-white/10 dark:text-neutral-300 dark:ring-white/10">
                                <span class="w-1.5 h-1.5 bg-neutral-600 rounded-full mr-1.5"></span>
                                Selesai
                            </span>
                        @endif
                    </div>

                    <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold tracking-tight text-primary-900 dark:text-primary-50 mb-3">
                        {{ $exam->title }}
                    </h1>

                    @if($exam->exam_date)
                        <div class="flex flex-wrap items-center gap-x-5 gap-y-2 text-sm text-neutral-700 dark:text-neutral-500">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1.5 text-neutral-600 dark:text-neutral-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span class="font-medium text-neutral-900 dark:text-neutral-200">{{ $exam->exam_date->format('d M Y') }}</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1.5 text-neutral-600 dark:text-neutral-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="font-medium text-neutral-900 dark:text-neutral-200">{{ $exam->exam_date->format('H:i') }} WIB</span>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Action Buttons for Admin/Tentor --}}
                @role('admin|tentor')
                <div class="flex flex-wrap gap-2">
                    @if($exam->status === 'inactive')
                        <a href="{{ route('exams.edit', $exam) }}"
                           class="inline-flex items-center px-4 py-2.5 rounded-xl text-sm font-semibold
                                  bg-white dark:bg-white/5
                                  border border-neutral-300 dark:border-white/15
                                  text-neutral-800 dark:text-neutral-300
                                  shadow-sm hover:bg-neutral-50 dark:hover:bg-white/10 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit
                        </a>

                        <form method="POST" action="{{ route('exams.activate', $exam) }}" class="sweet-confirm"
                              data-message="Yakin ingin memulai ujian ini? Anda tidak dapat edit atau hapus jika telah mulai">
                            @csrf
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2.5 rounded-xl text-sm font-semibold
                                           bg-primary-600 text-white shadow-sm
                                           hover:bg-primary-700 active:bg-primary-800 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Launch
                            </button>
                        </form>

                    @elseif($exam->status === 'active')
                        <form method="POST" action="{{ route('exams.close', $exam) }}" class="sweet-confirm"
                              data-message="Yakin ingin menutup tryout?">
                            @csrf
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2.5 rounded-xl text-sm font-semibold
                                           bg-accent-600 text-white shadow-sm
                                           hover:bg-accent-700 active:bg-accent-800 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Tutup
                            </button>
                        </form>

                        <a href="{{ route('exams.results', $exam) }}"
                           class="inline-flex items-center px-4 py-2.5 rounded-xl text-sm font-semibold
                                  bg-white dark:bg-white/5
                                  border border-neutral-300 dark:border-white/15
                                  text-neutral-800 dark:text-neutral-300
                                  shadow-sm hover:bg-neutral-50 dark:hover:bg-white/10 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                            Hasil
                        </a>
                    @else
                        <a href="{{ route('exams.results', $exam) }}"
                           class="inline-flex items-center px-4 py-2.5 rounded-xl text-sm font-semibold
                                  bg-white dark:bg-white/5
                                  border border-neutral-300 dark:border-white/15
                                  text-neutral-800 dark:text-neutral-300
                                  shadow-sm hover:bg-neutral-50 dark:hover:bg-white/10 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Pembahasan
                        </a>
                    @endif

                    @if(in_array($exam->status, ['inactive', 'closed']))
                        <form method="POST" action="{{ route('exams.destroy', $exam) }}" class="sweet-confirm"
                              data-message="Yakin ingin menghapus exam ini? Data akan diarsipkan.">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2.5 rounded-xl text-sm font-semibold
                                           bg-red-50 text-red-700 border border-red-200
                                           hover:bg-red-100
                                           dark:bg-red-500/10 dark:text-red-300 dark:border-red-400/20 dark:hover:bg-red-500/20
                                           transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Hapus
                            </button>
                        </form>
                    @endif
                </div>
                @endrole
            </div>
        </div>

        {{-- ================= INFO CARDS ================= --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            {{-- Durasi --}}
            <div class="group relative overflow-hidden bg-white dark:bg-primary-950 rounded-2xl p-5
                        border border-neutral-200 dark:border-white/10 shadow-sm
                        hover:shadow-md hover:shadow-primary-900/5 transition-shadow">
                <span class="absolute inset-x-0 top-0 h-0.5 bg-brand-gradient opacity-0 group-hover:opacity-100 transition-opacity"></span>
                <div class="flex items-center">
                    <div class="w-11 h-11 rounded-xl bg-primary-50 dark:bg-primary-500/10
                                border border-primary-100 dark:border-primary-400/20
                                flex items-center justify-center mr-3.5">
                        <svg class="w-5 h-5 text-primary-600 dark:text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[11px] font-semibold uppercase tracking-[0.1em] text-neutral-700 dark:text-neutral-600">Durasi</p>
                        <p class="text-xl font-bold tracking-tight text-primary-900 dark:text-primary-50 truncate">{{ $exam->duration_minutes ?? '-' }} menit</p>
                    </div>
                </div>
            </div>

            {{-- Jumlah Soal --}}
            <div class="group relative overflow-hidden bg-white dark:bg-primary-950 rounded-2xl p-5
                        border border-neutral-200 dark:border-white/10 shadow-sm
                        hover:shadow-md hover:shadow-primary-900/5 transition-shadow">
                <span class="absolute inset-x-0 top-0 h-0.5 bg-brand-gradient opacity-0 group-hover:opacity-100 transition-opacity"></span>
                <div class="flex items-center">
                    <div class="w-11 h-11 rounded-xl bg-secondary-50 dark:bg-secondary-500/10
                                border border-secondary-200 dark:border-secondary-400/20
                                flex items-center justify-center mr-3.5">
                        <svg class="w-5 h-5 text-secondary-600 dark:text-secondary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[11px] font-semibold uppercase tracking-[0.1em] text-neutral-700 dark:text-neutral-600">Jumlah Soal</p>
                        <p class="text-xl font-bold tracking-tight text-primary-900 dark:text-primary-50 truncate">{{ $exam->questions->count() }} soal</p>
                    </div>
                </div>
            </div>

            {{-- Tanggal --}}
            <div class="group relative overflow-hidden bg-white dark:bg-primary-950 rounded-2xl p-5
                        border border-neutral-200 dark:border-white/10 shadow-sm
                        hover:shadow-md hover:shadow-primary-900/5 transition-shadow">
                <span class="absolute inset-x-0 top-0 h-0.5 bg-brand-gradient opacity-0 group-hover:opacity-100 transition-opacity"></span>
                <div class="flex items-center">
                    <div class="w-11 h-11 rounded-xl bg-accent-50 dark:bg-accent-500/10
                                border border-accent-200 dark:border-accent-400/20
                                flex items-center justify-center mr-3.5">
                        <svg class="w-5 h-5 text-accent-600 dark:text-accent-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[11px] font-semibold uppercase tracking-[0.1em] text-neutral-700 dark:text-neutral-600">Tanggal Ujian</p>
                        <p class="text-xl font-bold tracking-tight text-primary-900 dark:text-primary-50 truncate">{{ $exam->exam_date?->format('d M Y') ?? '-' }}</p>
                    </div>
                </div>
            </div>

            {{-- Jam --}}
            <div class="group relative overflow-hidden bg-white dark:bg-primary-950 rounded-2xl p-5
                        border border-neutral-200 dark:border-white/10 shadow-sm
                        hover:shadow-md hover:shadow-primary-900/5 transition-shadow">
                <span class="absolute inset-x-0 top-0 h-0.5 bg-brand-gradient opacity-0 group-hover:opacity-100 transition-opacity"></span>
                <div class="flex items-center">
                    <div class="w-11 h-11 rounded-xl bg-gold-50 dark:bg-gold-500/10
                                border border-gold-200 dark:border-gold-400/20
                                flex items-center justify-center mr-3.5">
                        <svg class="w-5 h-5 text-gold-600 dark:text-gold-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[11px] font-semibold uppercase tracking-[0.1em] text-neutral-700 dark:text-neutral-600">Jam Mulai</p>
                        <p class="text-xl font-bold tracking-tight text-primary-900 dark:text-primary-50 truncate">{{ $exam->exam_date?->format('H:i') ?? '-' }} WIB</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= MAIN CONTENT AREA ================= --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2">
                {{-- Prerequisite Info for Admin --}}
                @role('admin|tentor')
                    @if($exam->type === 'tryout')
                        <div class="mb-6" x-data="{ modalOpen: false }">
                            <div class="flex items-center justify-between mb-3.5">
                                <h3 class="flex items-center gap-2.5 text-base font-semibold text-primary-900 dark:text-primary-50">
                                    <span class="h-4 w-1 rounded-full bg-brand-gradient"></span>
                                    Atur Prerequisite
                                </h3>
                                <button @click="modalOpen = true"
                                        class="inline-flex items-center px-3.5 py-2 text-sm font-semibold
                                               bg-primary-600 text-white rounded-xl shadow-sm
                                               hover:bg-primary-700 transition-colors">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                    Atur Urutan
                                </button>
                            </div>

                            {{-- Modal --}}
                            <div x-show="modalOpen"
                                x-cloak
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0"
                                x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0"
                                class="fixed inset-0 z-50 overflow-y-auto"
                                aria-labelledby="modal-title"
                                role="dialog"
                                aria-modal="true">
                                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                    {{-- Background overlay --}}
                                    <div x-show="modalOpen"
                                        x-transition:enter="transition ease-out duration-200"
                                        x-transition:enter-start="opacity-0"
                                        x-transition:enter-end="opacity-100"
                                        x-transition:leave="transition ease-in duration-150"
                                        x-transition:leave-start="opacity-100"
                                        x-transition:leave-end="opacity-0"
                                        class="fixed inset-0 bg-primary-950/60 backdrop-blur-sm transition-opacity"
                                        @click="modalOpen = false">
                                    </div>

                                    {{-- Modal panel --}}
                                    <div x-show="modalOpen"
                                        x-transition:enter="transition ease-out duration-200"
                                        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                        x-transition:leave="transition ease-in duration-150"
                                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                        class="inline-block align-bottom bg-white dark:bg-primary-950
                                               border border-neutral-200 dark:border-white/10
                                               rounded-2xl text-left overflow-hidden
                                               shadow-2xl shadow-primary-950/25 transform transition-all
                                               sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                        <div class="h-1 w-full bg-brand-gradient"></div>
                                        <div class="px-5 pt-5 pb-5 sm:p-6">
                                            <div class="sm:flex sm:items-start">
                                                <div class="mt-1 text-center sm:mt-0 sm:text-left w-full">
                                                    <div class="flex justify-between items-center mb-5">
                                                        <h3 class="text-lg font-bold tracking-tight text-primary-900 dark:text-primary-50" id="modal-title">
                                                            Prerequisite Tryout
                                                        </h3>
                                                        <button @click="modalOpen = false" type="button"
                                                                class="w-9 h-9 rounded-xl flex items-center justify-center
                                                                       text-neutral-700 dark:text-neutral-400
                                                                       hover:bg-neutral-100 dark:hover:bg-white/10 transition">
                                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                            </svg>
                                                        </button>
                                                    </div>

                                                    <form method="POST" action="{{ route('exams.prerequisites.update', $exam) }}" class="mt-2">
                                                        @csrf
                                                        <div class="mb-5">
                                                            <label class="block text-xs font-semibold uppercase tracking-[0.08em] text-neutral-700 dark:text-neutral-500 mb-2">
                                                                Tryout yang harus diselesaikan
                                                            </label>
                                                            <select name="required_exam_ids[]" multiple
                                                                    class="w-full rounded-xl border border-neutral-300 dark:border-white/10
                                                                           bg-white dark:bg-white/5
                                                                           text-neutral-900 dark:text-neutral-100 p-3 text-sm
                                                                           focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition">
                                                                @foreach($allTryouts as $tryout)
                                                                    @if($tryout->id !== $exam->id)
                                                                        <option value="{{ $tryout->id }}"
                                                                                @selected($exam->prerequisites->contains($tryout->id))>
                                                                            {{ $tryout->title }}
                                                                        </option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                            <p class="text-xs text-neutral-700 dark:text-neutral-600 mt-2">
                                                                Tekan Ctrl untuk memilih multiple
                                                            </p>
                                                        </div>

                                                        <div class="flex gap-2.5">
                                                            <button type="submit"
                                                                    class="flex-1 bg-primary-600 text-white py-2.5 rounded-xl text-sm font-semibold
                                                                           shadow-sm hover:bg-primary-700 transition-colors">
                                                                Simpan Perubahan
                                                            </button>
                                                            <button type="button" @click="modalOpen = false"
                                                                    class="flex-1 border border-neutral-300 dark:border-white/15
                                                                           bg-white dark:bg-white/5
                                                                           text-neutral-800 dark:text-neutral-300 py-2.5 rounded-xl text-sm font-semibold
                                                                           hover:bg-neutral-50 dark:hover:bg-white/10 transition-colors">
                                                                Batal
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Prerequisite List --}}
                            @if($exam->prerequisites->isNotEmpty())
                                <div class="bg-white dark:bg-primary-950 rounded-2xl p-5
                                            border border-neutral-200 dark:border-white/10 shadow-sm">
                                    <p class="text-xs font-semibold uppercase tracking-[0.08em] text-neutral-700 dark:text-neutral-600 mb-2.5">
                                        Prerequisite yang ditetapkan
                                    </p>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($exam->prerequisites as $prereq)
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium
                                                         bg-primary-50 text-primary-700 ring-1 ring-inset ring-primary-600/15
                                                         dark:bg-primary-500/15 dark:text-primary-200 dark:ring-primary-400/20">
                                                <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                {{ $prereq->title }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div class="bg-neutral-50 dark:bg-white/[0.03] rounded-2xl p-5
                                            border border-neutral-200 dark:border-white/10">
                                    <p class="text-sm text-neutral-700 dark:text-neutral-500 italic">
                                        Tidak memiliki prerequisite (tryout independen)
                                    </p>
                                </div>
                            @endif
                        </div>
                    @endif
                @endrole

                {{-- Student Actions --}}
                @role('siswa')
                    @cannot('view', $exam)
                        {{-- No Access --}}
                        <div class="bg-white dark:bg-primary-950 rounded-2xl p-6
                                    border border-neutral-200 dark:border-white/10 shadow-sm">
                            <div class="text-center py-10">
                                <div class="w-16 h-16 mx-auto mb-5 rounded-2xl
                                            bg-neutral-50 dark:bg-white/5
                                            border border-neutral-200 dark:border-white/10
                                            flex items-center justify-center">
                                    <svg class="w-7 h-7 text-neutral-600 dark:text-neutral-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold tracking-tight text-primary-900 dark:text-primary-50 mb-2">Akses Dibatasi</h3>
                                <p class="text-sm text-neutral-700 dark:text-neutral-500 mb-6 max-w-sm mx-auto">Anda belum memiliki akses untuk mengikuti ujian ini.</p>
                                <a href="{{ route('browse.index') }}"
                                   class="inline-flex items-center px-5 py-2.5 bg-primary-600 text-white rounded-xl text-sm font-semibold
                                          shadow-sm hover:bg-primary-700 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                    </svg>
                                    Lakukan Pembelian
                                </a>
                            </div>
                        </div>
                    @else
                        {{-- Has Attempted --}}
                        @if($attempt && $attempt->is_submitted)
                            <div class="bg-white dark:bg-primary-950 rounded-2xl p-6
                                        border border-neutral-200 dark:border-white/10 shadow-sm mb-6">
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-5">
                                    <div>
                                        <p class="text-[11px] font-semibold uppercase tracking-[0.1em] text-neutral-700 dark:text-neutral-600 mb-1.5">Status Ujian</p>
                                        <div class="flex items-center">
                                            <div class="w-2.5 h-2.5 rounded-full bg-primary-500 mr-2"></div>
                                            <p class="text-lg font-bold tracking-tight text-primary-700 dark:text-primary-300">Telah Diselesaikan</p>
                                        </div>
                                    </div>

                                    <div class="bg-hero-gradient rounded-2xl px-6 py-4 text-right shadow-sm">
                                        <p class="text-[11px] font-semibold uppercase tracking-[0.1em] text-white/70 mb-0.5">Skor Anda</p>
                                        <p class="text-3xl font-bold tracking-tight text-white tabular-nums">{{ $attempt->score }}</p>
                                    </div>
                                </div>

                                <div class="mt-6 pt-6 border-t border-neutral-200 dark:border-white/10">
                                    <div class="flex flex-wrap gap-3">
                                        <a href="{{ route('exams.result.student', $exam) }}"
                                           class="inline-flex items-center px-4 py-2.5 bg-primary-600 text-white rounded-xl text-sm font-semibold
                                                  shadow-sm hover:bg-primary-700 transition-colors">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                            </svg>
                                            Lihat Hasil Lengkap
                                        </a>
                                    </div>
                                </div>
                            </div>

                        {{-- Hasn't Attempted --}}
                        @else
                            <div class="bg-white dark:bg-primary-950 rounded-2xl p-6
                                        border border-neutral-200 dark:border-white/10 shadow-sm">
                                @if($exam->status === 'active')
                                    @if($unmetPrerequisites->isNotEmpty())
                                        <div class="mb-2">
                                            <div class="flex items-center mb-5">
                                                <div class="w-11 h-11 rounded-xl bg-gold-50 dark:bg-gold-500/10
                                                            border border-gold-200 dark:border-gold-400/20
                                                            flex items-center justify-center mr-3.5">
                                                    <svg class="w-5 h-5 text-gold-600 dark:text-gold-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.794-.833-2.564 0L4.22 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <h3 class="font-bold tracking-tight text-primary-900 dark:text-primary-50">Prerequisite Belum Terpenuhi</h3>
                                                    <p class="text-sm text-neutral-700 dark:text-neutral-500">Anda harus menyelesaikan tryout berikut terlebih dahulu:</p>
                                                </div>
                                            </div>

                                            <div class="space-y-2">
                                                @foreach($unmetPrerequisites as $req)
                                                    <div class="flex items-center justify-between gap-3 p-3.5
                                                                bg-neutral-50 dark:bg-white/[0.03]
                                                                border border-neutral-200 dark:border-white/10
                                                                rounded-xl">
                                                        <div class="flex items-center min-w-0">
                                                            <svg class="w-4 h-4 text-neutral-600 dark:text-neutral-600 mr-2.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                                            </svg>
                                                            <span class="text-sm font-medium text-neutral-900 dark:text-neutral-200 truncate">{{ $req->title }}</span>
                                                        </div>
                                                        <span class="flex-shrink-0 text-xs px-2.5 py-1 rounded-full font-medium
                                                                     bg-accent-50 text-accent-700 ring-1 ring-inset ring-accent-600/20
                                                                     dark:bg-accent-500/15 dark:text-accent-200 dark:ring-accent-400/20">
                                                            Belum Selesai
                                                        </span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @elseif(!$attempt)
                                        <div class="text-center py-10">
                                            <div class="w-20 h-20 mx-auto mb-6 rounded-2xl
                                                        bg-primary-50 dark:bg-primary-500/10
                                                        border border-primary-100 dark:border-primary-400/20
                                                        flex items-center justify-center">
                                                <svg class="w-9 h-9 text-primary-600 dark:text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                            </div>
                                            <h3 class="text-xl font-bold tracking-tight text-primary-900 dark:text-primary-50 mb-3">Siap Mulai Ujian?</h3>
                                            <p class="text-sm text-neutral-700 dark:text-neutral-500 mb-7 max-w-md mx-auto leading-relaxed">
                                                Ujian ini berdurasi {{ $exam->duration_minutes }} menit dengan {{ $exam->questions->count() }} soal. Pastikan koneksi internet stabil sebelum memulai.
                                            </p>
                                            <form method="POST" action="{{ route('exams.start', $exam) }}" class="sweet-confirm"
                                                  data-message="Yakin ingin mengerjakan? Anda tidak dapat reset waktu maupun mengulang ujian jika mulai mengerjakan">
                                                @csrf
                                                <button type="submit"
                                                        class="inline-flex items-center px-7 py-3.5 bg-primary-600 text-white rounded-xl font-semibold
                                                               shadow-sm shadow-primary-900/20 hover:bg-primary-700 active:bg-primary-800 transition-colors">
                                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                                    </svg>
                                                    Mulai Ujian
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <div class="text-center py-10">
                                            <div class="w-20 h-20 mx-auto mb-6 rounded-2xl
                                                        bg-gold-50 dark:bg-gold-500/10
                                                        border border-gold-200 dark:border-gold-400/20
                                                        flex items-center justify-center">
                                                <svg class="w-9 h-9 text-gold-600 dark:text-gold-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                                </svg>
                                            </div>
                                            <h3 class="text-xl font-bold tracking-tight text-primary-900 dark:text-primary-50 mb-3">Ujian dalam Progres</h3>
                                            <p class="text-sm text-neutral-700 dark:text-neutral-500 mb-7">
                                                Anda memiliki ujian yang belum diselesaikan.
                                            </p>
                                            <a href="{{ route('exams.attempt', $exam) }}"
                                               class="inline-flex items-center px-7 py-3.5 bg-primary-600 text-white rounded-xl font-semibold
                                                      shadow-sm shadow-primary-900/20 hover:bg-primary-700 transition-colors">
                                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                Lanjutkan Ujian
                                            </a>
                                        </div>
                                    @endif
                                @else
                                    <div class="text-center py-10">
                                        <div class="w-16 h-16 mx-auto mb-5 rounded-2xl
                                                    bg-neutral-50 dark:bg-white/5
                                                    border border-neutral-200 dark:border-white/10
                                                    flex items-center justify-center">
                                            <svg class="w-7 h-7 text-neutral-600 dark:text-neutral-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <h3 class="text-lg font-bold tracking-tight text-primary-900 dark:text-primary-50 mb-2">Ujian Belum Tersedia</h3>
                                        <p class="text-sm text-neutral-700 dark:text-neutral-500">
                                            Ujian ini {{ $exam->status === 'inactive' ? 'belum dimulai' : 'telah selesai' }}.
                                        </p>
                                    </div>
                                @endif
                            </div>
                        @endif
                    @endcannot
                @endrole
            </div>

            {{-- ================= SIDEBAR ================= --}}
            <div class="space-y-6">
                {{-- Quick Stats --}}
                <div class="bg-white dark:bg-primary-950 rounded-2xl overflow-hidden
                            border border-neutral-200 dark:border-white/10 shadow-sm">
                    <div class="px-5 py-4 border-b border-neutral-200 dark:border-white/10
                                bg-neutral-50 dark:bg-white/[0.03]">
                        <h3 class="text-sm font-semibold text-primary-900 dark:text-primary-50">Informasi</h3>
                    </div>
                    <div class="p-5 space-y-1">
                        <div class="flex justify-between items-center py-2.5 border-b border-neutral-100 dark:border-white/5">
                            <span class="text-sm text-neutral-700 dark:text-neutral-500">Tipe Ujian</span>
                            <span class="text-sm font-semibold text-neutral-900 dark:text-neutral-200">{{ $exam->type === 'tryout' ? 'Tryout' : 'Latihan' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2.5 border-b border-neutral-100 dark:border-white/5">
                            <span class="text-sm text-neutral-700 dark:text-neutral-500">Kategori</span>
                            <span class="text-sm font-semibold text-neutral-900 dark:text-neutral-200">{{ strtoupper($exam->test_type) }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2.5">
                            <span class="text-sm text-neutral-700 dark:text-neutral-500">Status</span>
                            @if($exam->status === 'inactive')
                                <span class="text-xs px-2.5 py-1 rounded-full font-medium
                                             bg-gold-50 text-gold-700 ring-1 ring-inset ring-gold-600/20
                                             dark:bg-gold-500/15 dark:text-gold-200 dark:ring-gold-400/20">Belum Dimulai</span>
                            @elseif($exam->status === 'active')
                                <span class="text-xs px-2.5 py-1 rounded-full font-medium
                                             bg-primary-50 text-primary-700 ring-1 ring-inset ring-primary-600/20
                                             dark:bg-primary-500/15 dark:text-primary-200 dark:ring-primary-400/20">Berlangsung</span>
                            @else
                                <span class="text-xs px-2.5 py-1 rounded-full font-medium
                                             bg-neutral-100 text-neutral-800 ring-1 ring-inset ring-neutral-400/30
                                             dark:bg-white/10 dark:text-neutral-300 dark:ring-white/10">Selesai</span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Instructions --}}
                <div class="bg-white dark:bg-primary-950 rounded-2xl overflow-hidden
                            border border-neutral-200 dark:border-white/10 shadow-sm">
                    <div class="px-5 py-4 border-b border-neutral-200 dark:border-white/10
                                bg-neutral-50 dark:bg-white/[0.03]">
                        <h3 class="text-sm font-semibold text-primary-900 dark:text-primary-50">Petunjuk</h3>
                    </div>
                    <ul class="p-5 space-y-3 text-sm text-neutral-700 dark:text-neutral-400">
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-5 h-5 rounded-full bg-primary-50 dark:bg-primary-500/15
                                         flex items-center justify-center mt-0.5 mr-2.5">
                                <svg class="w-3 h-3 text-primary-600 dark:text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                </svg>
                            </span>
                            <span>Pastikan koneksi internet stabil</span>
                        </li>
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-5 h-5 rounded-full bg-primary-50 dark:bg-primary-500/15
                                         flex items-center justify-center mt-0.5 mr-2.5">
                                <svg class="w-3 h-3 text-primary-600 dark:text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                </svg>
                            </span>
                            <span>Waktu akan terus berjalan setelah mulai</span>
                        </li>
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-5 h-5 rounded-full bg-primary-50 dark:bg-primary-500/15
                                         flex items-center justify-center mt-0.5 mr-2.5">
                                <svg class="w-3 h-3 text-primary-600 dark:text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                </svg>
                            </span>
                            <span>Jawaban akan otomatis tersimpan</span>
                        </li>
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-5 h-5 rounded-full bg-primary-50 dark:bg-primary-500/15
                                         flex items-center justify-center mt-0.5 mr-2.5">
                                <svg class="w-3 h-3 text-primary-600 dark:text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                </svg>
                            </span>
                            <span>Review jawaban sebelum submit</span>
                        </li>
                    </ul>
                </div>

                {{-- Related Actions --}}
                <div class="relative overflow-hidden bg-hero-gradient rounded-2xl p-6 text-white shadow-sm">
                    <div class="absolute -right-8 -top-8 w-32 h-32 rounded-full bg-white/5"></div>
                    <div class="relative">
                        <h3 class="font-semibold mb-2">Butuh Bantuan?</h3>
                        <p class="text-sm text-white/70 mb-5 leading-relaxed">Jika mengalami kendala teknis, hubungi tim support kami.</p>
                        <a href="https://wa.me/6285141339645"
                           class="inline-flex items-center justify-center w-full px-4 py-2.5
                                  bg-white/15 hover:bg-white/25 backdrop-blur-sm
                                  border border-white/20
                                  text-white rounded-xl text-sm font-semibold transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            Hubungi Support
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
