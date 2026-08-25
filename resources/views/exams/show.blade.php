{{-- exams/show.blade.php --}}
@extends('layouts.app')

@section('title', $exam->title.' | Tryout Satya Naratama - Matematika, SKD, dll')
@section('description', 'Ikuti tryout '.$exam->title.' lengkap dengan pembahasan.')

@section('content')
<div class="min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- ================= HEADER ================= --}}
        <div class="mb-10">
            {{-- Breadcrumb --}}
            <nav class="flex mb-5" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2">
                    <li>
                        <a href="{{ $exam->backRoute() }}" class="text-sm text-neutral-500 dark:text-neutral-400 hover:text-primary dark:hover:text-primary-400 transition-colors">
                            Daftar Ujian
                        </a>
                    </li>
                    <li>
                        <svg class="w-4 h-4 text-neutral-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </li>
                    <li>
                        <span class="text-sm font-medium text-neutral-900 dark:text-white">Detail Ujian</span>
                    </li>
                </ol>
            </nav>

            {{-- Title and Info --}}
            <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-6">
                <div class="flex-1">
                    <div class="flex flex-wrap items-center gap-2 mb-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-primary/10 text-primary dark:bg-primary/20 dark:text-primary-300 ring-1 ring-primary/20 dark:ring-primary/30">
                            {{ strtoupper($exam->test_type) }}
                        </span>

                        @if($exam->status === 'inactive')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-50 text-yellow-700 dark:bg-yellow-900/20 dark:text-yellow-400 ring-1 ring-yellow-600/20">
                                <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full mr-1.5"></span>
                                Belum Dimulai
                            </span>
                        @elseif($exam->status === 'active')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-50 text-green-700 dark:bg-green-900/20 dark:text-green-400 ring-1 ring-green-600/20">
                                <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
                                Berlangsung
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-neutral-50 text-neutral-600 dark:bg-neutral-800 dark:text-neutral-400 ring-1 ring-neutral-600/20">
                                <span class="w-1.5 h-1.5 bg-neutral-500 rounded-full mr-1.5"></span>
                                Selesai
                            </span>
                        @endif
                    </div>

                    <h1 class="text-3xl md:text-4xl font-bold tracking-tight text-neutral-900 dark:text-white mb-4">
                        {{ $exam->title }}
                    </h1>

                    @if($exam->exam_date)
                        <div class="flex flex-wrap items-center gap-5 text-sm text-neutral-600 dark:text-neutral-400">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span class="font-medium text-neutral-900 dark:text-white">{{ $exam->exam_date->format('d M Y') }}</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="font-medium text-neutral-900 dark:text-white">{{ $exam->exam_date->format('H:i') }} WIB</span>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Action Buttons for Admin/Tentor --}}
                @role('admin|tentor')
                <div class="flex flex-wrap gap-2">
                    @if($exam->status === 'inactive')
                        <a href="{{ route('exams.edit', $exam) }}"
                           class="inline-flex items-center px-4 py-2.5 rounded-xl text-sm font-medium bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-700 text-neutral-700 dark:text-neutral-300 hover:bg-neutral-50 dark:hover:bg-neutral-800 transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit
                        </a>

                        <form method="POST" action="{{ route('exams.activate', $exam) }}" class="sweet-confirm"
                              data-message="Yakin ingin memulai ujian ini? Anda tidak dapat edit atau hapus jika telah mulai">
                            @csrf
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2.5 rounded-xl text-sm font-medium bg-primary text-white hover:bg-primary-600 active:scale-[0.98] transition-all duration-200 shadow-sm hover:shadow-md">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Launch
                            </button>
                        </form>

                    @elseif($exam->status === 'active')
                        <form method="POST" action="{{ route('exams.close', $exam) }}" class="sweet-confirm"
                              data-message="Yakin ingin menutup tryout?">
                            @csrf
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2.5 rounded-xl text-sm font-medium bg-red-600 text-white hover:bg-red-700 active:scale-[0.98] transition-all duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Tutup
                            </button>
                        </form>

                        <a href="{{ route('exams.results', $exam) }}"
                           class="inline-flex items-center px-4 py-2.5 rounded-xl text-sm font-medium bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-700 text-neutral-700 dark:text-neutral-300 hover:bg-neutral-50 dark:hover:bg-neutral-800 transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                            Hasil
                        </a>
                    @else
                        <a href="{{ route('exams.results', $exam) }}"
                           class="inline-flex items-center px-4 py-2.5 rounded-xl text-sm font-medium bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-700 text-neutral-700 dark:text-neutral-300 hover:bg-neutral-50 dark:hover:bg-neutral-800 transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
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
                                    class="inline-flex items-center px-4 py-2.5 rounded-xl text-sm font-medium text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-900/20 transition-all duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
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
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
            {{-- Durasi --}}
            <div class="bg-white dark:bg-neutral-900 rounded-2xl p-5 border border-neutral-200 dark:border-neutral-700 shadow-sm hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center">
                    <div class="w-11 h-11 rounded-xl bg-primary/10 dark:bg-primary/20 flex items-center justify-center mr-4">
                        <svg class="w-5 h-5 text-primary dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">Durasi</p>
                        <p class="text-xl font-bold text-neutral-900 dark:text-white">{{ $exam->duration_minutes ?? '-' }} menit</p>
                    </div>
                </div>
            </div>

            {{-- Jumlah Soal --}}
            <div class="bg-white dark:bg-neutral-900 rounded-2xl p-5 border border-neutral-200 dark:border-neutral-700 shadow-sm hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center">
                    <div class="w-11 h-11 rounded-xl bg-emerald-50 dark:bg-emerald-900/20 flex items-center justify-center mr-4">
                        <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">Jumlah Soal</p>
                        <p class="text-xl font-bold text-neutral-900 dark:text-white">{{ $exam->questions->count() }} soal</p>
                    </div>
                </div>
            </div>

            {{-- Tanggal --}}
            <div class="bg-white dark:bg-neutral-900 rounded-2xl p-5 border border-neutral-200 dark:border-neutral-700 shadow-sm hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center">
                    <div class="w-11 h-11 rounded-xl bg-purple-50 dark:bg-purple-900/20 flex items-center justify-center mr-4">
                        <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">Tanggal Ujian</p>
                        <p class="text-xl font-bold text-neutral-900 dark:text-white">{{ $exam->exam_date?->format('d M Y') ?? '-' }}</p>
                    </div>
                </div>
            </div>

            {{-- Jam --}}
            <div class="bg-white dark:bg-neutral-900 rounded-2xl p-5 border border-neutral-200 dark:border-neutral-700 shadow-sm hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center">
                    <div class="w-11 h-11 rounded-xl bg-amber-50 dark:bg-amber-900/20 flex items-center justify-center mr-4">
                        <svg class="w-5 h-5 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">Jam Mulai</p>
                        <p class="text-xl font-bold text-neutral-900 dark:text-white">{{ $exam->exam_date?->format('H:i') ?? '-' }} WIB</p>
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
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-base font-semibold text-neutral-900 dark:text-white">Atur Prerequisite</h3>
                                <button @click="modalOpen = true"
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium bg-primary text-white rounded-xl hover:bg-primary-600 active:scale-[0.98] transition-all duration-200 shadow-sm hover:shadow-md">
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
                                    <div x-show="modalOpen"
                                        x-transition:enter="transition ease-out duration-200"
                                        x-transition:enter-start="opacity-0"
                                        x-transition:enter-end="opacity-100"
                                        x-transition:leave="transition ease-in duration-150"
                                        x-transition:leave-start="opacity-100"
                                        x-transition:leave-end="opacity-0"
                                        class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity"
                                        @click="modalOpen = false">
                                    </div>

                                    <div x-show="modalOpen"
                                        x-transition:enter="transition ease-out duration-200"
                                        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                        x-transition:leave="transition ease-in duration-150"
                                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                        class="inline-block align-bottom bg-white dark:bg-neutral-900 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                        <div class="px-6 pt-6 pb-5">
                                            <div class="flex items-center justify-between mb-4">
                                                <h3 class="text-lg font-semibold text-neutral-900 dark:text-white" id="modal-title">
                                                    Prerequisite Tryout
                                                </h3>
                                                <button @click="modalOpen = false" type="button" class="p-2 rounded-lg hover:bg-neutral-100 dark:hover:bg-neutral-800 transition-colors">
                                                    <svg class="h-5 w-5 text-neutral-400 dark:text-neutral-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>

                                            <form method="POST" action="{{ route('exams.prerequisites.update', $exam) }}">
                                                @csrf
                                                <div class="mb-5">
                                                    <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                                                        Tryout yang harus diselesaikan
                                                    </label>
                                                    <select name="required_exam_ids[]" multiple
                                                            class="w-full rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 text-neutral-900 dark:text-white p-3 text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-200">
                                                        @foreach($allTryouts as $tryout)
                                                            @if($tryout->id !== $exam->id)
                                                                <option value="{{ $tryout->id }}"
                                                                        @selected($exam->prerequisites->contains($tryout->id))>
                                                                    {{ $tryout->title }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    <p class="text-xs text-neutral-500 dark:text-neutral-400 mt-2">
                                                        Tekan Ctrl/Cmd untuk memilih multiple
                                                    </p>
                                                </div>

                                                <div class="flex gap-3">
                                                    <button type="submit"
                                                            class="flex-1 bg-primary text-white py-2.5 rounded-xl font-medium hover:bg-primary-600 active:scale-[0.98] transition-all duration-200">
                                                        Simpan Perubahan
                                                    </button>
                                                    <button type="button" @click="modalOpen = false"
                                                            class="flex-1 border border-neutral-200 dark:border-neutral-700 text-neutral-700 dark:text-neutral-300 py-2.5 rounded-xl font-medium hover:bg-neutral-50 dark:hover:bg-neutral-800 transition-all duration-200">
                                                        Batal
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Prerequisite List --}}
                            @if($exam->prerequisites->isNotEmpty())
                                <div class="bg-neutral-50 dark:bg-neutral-800/50 rounded-xl p-4 border border-neutral-200 dark:border-neutral-700">
                                    <p class="text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">Prerequisite yang ditetapkan:</p>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($exam->prerequisites as $prereq)
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-primary/10 text-primary dark:bg-primary/20 dark:text-primary-300">
                                                <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                {{ $prereq->title }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div class="bg-neutral-50 dark:bg-neutral-800/50 rounded-xl p-4 border border-neutral-200 dark:border-neutral-700">
                                    <p class="text-sm text-neutral-500 dark:text-neutral-400 italic">
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
                        <div class="bg-white dark:bg-neutral-900 rounded-2xl p-8 border border-neutral-200 dark:border-neutral-700 shadow-sm">
                            <div class="text-center py-6">
                                <div class="w-20 h-20 mx-auto mb-5 rounded-2xl bg-neutral-100 dark:bg-neutral-800 flex items-center justify-center">
                                    <svg class="w-10 h-10 text-neutral-400 dark:text-neutral-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-neutral-900 dark:text-white mb-2">Akses Dibatasi</h3>
                                <p class="text-neutral-600 dark:text-neutral-400 mb-6">Anda belum memiliki akses untuk mengikuti ujian ini.</p>
                                <a href="{{ route('browse.index') }}"
                                   class="inline-flex items-center px-6 py-3 bg-primary text-white rounded-xl font-medium hover:bg-primary-600 active:scale-[0.98] transition-all duration-200 shadow-sm hover:shadow-md">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                    </svg>
                                    Lakukan Pembelian
                                </a>
                            </div>
                        </div>
                    @else
                        {{-- Has Attempted --}}
                        @if($attempt && $attempt->is_submitted)
                            <div class="bg-white dark:bg-neutral-900 rounded-2xl p-6 border border-neutral-200 dark:border-neutral-700 shadow-sm mb-6">
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                    <div>
                                        <p class="text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider mb-1">Status Ujian</p>
                                        <div class="flex items-center">
                                            <div class="w-2.5 h-2.5 rounded-full bg-green-500 mr-2.5"></div>
                                            <p class="text-base font-semibold text-green-600 dark:text-green-400">Telah Diselesaikan</p>
                                        </div>
                                    </div>

                                    <div class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl px-6 py-3">
                                        <p class="text-xs text-white/80 mb-0.5">Skor Anda</p>
                                        <p class="text-2xl font-bold text-white">{{ $attempt->score }}</p>
                                    </div>
                                </div>

                                <div class="mt-6 pt-6 border-t border-neutral-200 dark:border-neutral-700">
                                    <a href="{{ route('exams.result.student', $exam) }}"
                                       class="inline-flex items-center px-5 py-2.5 bg-primary text-white rounded-xl font-medium hover:bg-primary-600 active:scale-[0.98] transition-all duration-200 shadow-sm hover:shadow-md">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                        </svg>
                                        Lihat Hasil Lengkap
                                    </a>
                                </div>
                            </div>

                        {{-- Hasn't Attempted --}}
                        @else
                            <div class="bg-white dark:bg-neutral-900 rounded-2xl p-8 border border-neutral-200 dark:border-neutral-700 shadow-sm">
                                @if($exam->status === 'active')
                                    @if($unmetPrerequisites->isNotEmpty())
                                        <div class="mb-6">
                                            <div class="flex items-center mb-4">
                                                <div class="w-11 h-11 rounded-xl bg-yellow-50 dark:bg-yellow-900/20 flex items-center justify-center mr-4">
                                                    <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.794-.833-2.564 0L4.22 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <h3 class="font-semibold text-neutral-900 dark:text-white">Prerequisite Belum Terpenuhi</h3>
                                                    <p class="text-sm text-neutral-600 dark:text-neutral-400">Anda harus menyelesaikan tryout berikut terlebih dahulu:</p>
                                                </div>
                                            </div>

                                            <div class="space-y-2">
                                                @foreach($unmetPrerequisites as $req)
                                                    <div class="flex items-center justify-between p-3 bg-neutral-50 dark:bg-neutral-800/50 rounded-xl">
                                                        <div class="flex items-center">
                                                            <svg class="w-4 h-4 text-neutral-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                                            </svg>
                                                            <span class="font-medium text-neutral-700 dark:text-neutral-300">{{ $req->title }}</span>
                                                        </div>
                                                        <span class="text-xs px-2.5 py-1 bg-red-50 text-red-700 dark:bg-red-900/20 dark:text-red-400 rounded-full ring-1 ring-red-600/20">
                                                            Belum Selesai
                                                        </span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @elseif(!$attempt)
                                        <div class="text-center py-4">
                                            <div class="w-24 h-24 mx-auto mb-6 rounded-2xl bg-primary/10 dark:bg-primary/20 flex items-center justify-center">
                                                <svg class="w-12 h-12 text-primary dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                            </div>
                                            <h3 class="text-xl font-bold text-neutral-900 dark:text-white mb-3">Siap Mulai Ujian?</h3>
                                            <p class="text-neutral-600 dark:text-neutral-400 mb-6 max-w-md mx-auto">
                                                Ujian ini berdurasi {{ $exam->duration_minutes }} menit dengan {{ $exam->questions->count() }} soal. Pastikan koneksi internet stabil sebelum memulai.
                                            </p>
                                            <form method="POST" action="{{ route('exams.start', $exam) }}" class="sweet-confirm"
                                                  data-message="Yakin ingin mengerjakan? Anda tidak dapat reset waktu maupun mengulang ujian jika mulai mengerjakan">
                                                @csrf
                                                <button type="submit"
                                                        class="inline-flex items-center px-8 py-3.5 bg-primary text-white rounded-2xl font-semibold hover:bg-primary-600 active:scale-[0.98] transition-all duration-200 shadow-lg hover:shadow-xl text-lg">
                                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                                    </svg>
                                                    Mulai Ujian
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <div class="text-center py-4">
                                            <div class="w-20 h-20 mx-auto mb-5 rounded-2xl bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center">
                                                <svg class="w-10 h-10 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                                </svg>
                                            </div>
                                            <h3 class="text-lg font-semibold text-neutral-900 dark:text-white mb-2">Ujian dalam Progres</h3>
                                            <p class="text-neutral-600 dark:text-neutral-400 mb-6">
                                                Anda memiliki ujian yang belum diselesaikan.
                                            </p>
                                            <a href="{{ route('exams.attempt', $exam) }}"
                                               class="inline-flex items-center px-6 py-3 bg-primary text-white rounded-xl font-medium hover:bg-primary-600 active:scale-[0.98] transition-all duration-200 shadow-sm hover:shadow-md">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                Lanjutkan Ujian
                                            </a>
                                        </div>
                                    @endif
                                @else
                                    <div class="text-center py-6">
                                        <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-neutral-100 dark:bg-neutral-800 flex items-center justify-center">
                                            <svg class="w-8 h-8 text-neutral-400 dark:text-neutral-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <h3 class="text-lg font-semibold text-neutral-900 dark:text-white mb-2">Ujian Belum Tersedia</h3>
                                        <p class="text-neutral-600 dark:text-neutral-400">
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
                <div class="bg-white dark:bg-neutral-900 rounded-2xl p-5 border border-neutral-200 dark:border-neutral-700 shadow-sm">
                    <h3 class="text-sm font-semibold text-neutral-900 dark:text-white mb-4">Informasi</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center py-2 border-b border-neutral-100 dark:border-neutral-800">
                            <span class="text-sm text-neutral-500 dark:text-neutral-400">Tipe Ujian</span>
                            <span class="text-sm font-medium text-neutral-900 dark:text-white">{{ $exam->type === 'tryout' ? 'Tryout' : 'Latihan' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-neutral-100 dark:border-neutral-800">
                            <span class="text-sm text-neutral-500 dark:text-neutral-400">Kategori</span>
                            <span class="text-sm font-medium text-neutral-900 dark:text-white">{{ strtoupper($exam->test_type) }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-sm text-neutral-500 dark:text-neutral-400">Status</span>
                            @if($exam->status === 'inactive')
                                <span class="text-xs px-2.5 py-1 bg-yellow-50 text-yellow-700 dark:bg-yellow-900/20 dark:text-yellow-400 rounded-full ring-1 ring-yellow-600/20">Belum Dimulai</span>
                            @elseif($exam->status === 'active')
                                <span class="text-xs px-2.5 py-1 bg-green-50 text-green-700 dark:bg-green-900/20 dark:text-green-400 rounded-full ring-1 ring-green-600/20">Berlangsung</span>
                            @else
                                <span class="text-xs px-2.5 py-1 bg-neutral-50 text-neutral-600 dark:bg-neutral-800 dark:text-neutral-400 rounded-full ring-1 ring-neutral-600/20">Selesai</span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Instructions --}}
                <div class="bg-white dark:bg-neutral-900 rounded-2xl p-5 border border-neutral-200 dark:border-neutral-700 shadow-sm">
                    <h3 class="text-sm font-semibold text-neutral-900 dark:text-white mb-4">Petunjuk</h3>
                    <ul class="space-y-2.5 text-sm text-neutral-600 dark:text-neutral-400">
                        <li class="flex items-start">
                            <svg class="w-4 h-4 text-primary mt-0.5 mr-2.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>Pastikan koneksi internet stabil</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-4 h-4 text-primary mt-0.5 mr-2.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>Waktu akan terus berjalan setelah mulai</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-4 h-4 text-primary mt-0.5 mr-2.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>Jawaban akan otomatis tersimpan</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-4 h-4 text-primary mt-0.5 mr-2.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>Review jawaban sebelum submit</span>
                        </li>
                    </ul>
                </div>

                {{-- Related Actions --}}
                <div class="bg-gradient-to-br from-primary to-primary-700 rounded-2xl p-5 text-white">
                    <h3 class="font-semibold mb-2">Butuh Bantuan?</h3>
                    <p class="text-sm text-white/80 mb-4">Jika mengalami kendala teknis, hubungi tim support kami.</p>
                    <a href="https://wa.me/6285141339645"
                       class="inline-flex items-center justify-center w-full px-4 py-2.5 bg-white/20 hover:bg-white/30 text-white rounded-xl font-medium transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Hubungi Support
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
