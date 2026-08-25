@extends('layouts.app')

@section('title', $meeting->title.' | Live Class')
@section('description', 'Live class '.$meeting->title)

@section('content')
<div class="py-6 md:py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Top Action Bar --}}
        @role('admin|tentor')
            <div class="mb-6">
                <div class="flex flex-wrap gap-3">
                    @if ($meeting->status === 'upcoming')
                        <form method="POST" action="{{ route('meeting.start', $meeting) }}"
                              class="sweet-confirm" data-message="Mulai pertemuan sekarang?">
                            @csrf
                            <button class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold transition-all duration-200 hover:shadow-lg hover:shadow-emerald-500/25 active:scale-[0.98]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Mulai Pertemuan
                            </button>
                        </form>
                    @elseif ($meeting->status === 'live')
                        <form method="POST" action="{{ route('meeting.finish', $meeting) }}"
                              class="sweet-confirm" data-message="Selesaikan pertemuan ini?">
                            @csrf
                            <button class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-red-600 hover:bg-red-700 text-white font-semibold transition-all duration-200 hover:shadow-lg hover:shadow-red-500/25 active:scale-[0.98]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 10a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z"/>
                                </svg>
                                Selesaikan Pertemuan
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @endrole

        {{-- Info Meeting --}}
        @include('meetings.partials.info')

        {{-- Content Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">

            {{-- Left: Main Content --}}
            <div class="lg:col-span-2 space-y-6">
                {{-- Absensi --}}
                @role('admin|tentor')
                    @include('meetings.partials.attendance')
                @endrole

                {{-- Materi --}}
                @include('meetings.partials.material')

                {{-- Video --}}
                @include('meetings.partials.video')
            </div>

            {{-- Right: Sidebar --}}
            <div class="lg:col-span-1 space-y-6">
                {{-- Meeting Exam --}}
                @include('meetings.partials.meetingExam')
            </div>
        </div>

        {{-- ================================================= --}}
        {{-- MODAL : CREATE BLIND / POST TEST --}}
        {{-- ================================================= --}}
        <div id="meetingExamModal"
             class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm px-4">
            <div class="w-full max-w-md rounded-2xl bg-white dark:bg-primary-900/95 p-6 shadow-2xl border border-primary-200 dark:border-primary-700/50">
                <div class="flex items-center gap-3 mb-6">
                    <div class="p-2.5 rounded-xl bg-primary-100 dark:bg-primary-800/40 text-primary-600 dark:text-primary-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-primary-800 dark:text-primary-100">Buat Evaluasi</h3>
                </div>

                <form method="POST" action="{{ route('meetings.exam.store', $meeting) }}" class="space-y-5">
                    @csrf

                    {{-- TYPE --}}
                    <div>
                        <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                            Jenis Evaluasi <span class="text-accent-500">*</span>
                        </label>
                        <select name="type" required
                                class="w-full px-4 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200 appearance-none">
                            <option value="">-- Pilih --</option>
                            <option value="blind_test">Blind Test</option>
                            <option value="post_test">Post Test</option>
                        </select>
                    </div>

                    {{-- TEST TYPE --}}
                    <div>
                        <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                            Tipe Tes <span class="text-accent-500">*</span>
                        </label>
                        <select name="test_type" required
                                class="w-full px-4 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200 appearance-none">
                            <option value="">-- Pilih Tipe Tes --</option>
                            <option value="skd">SKD</option>
                            <option value="tpa">TPA</option>
                            <option value="tbi">TBI</option>
                            <option value="mtk_stis">Matematika STIS</option>
                            <option value="mtk_tka">Matematika TKA</option>
                            <option value="general">General</option>
                        </select>
                    </div>

                    {{-- ACTION --}}
                    <div class="flex justify-end gap-3 pt-4 border-t border-primary-100 dark:border-primary-700/30">
                        <button type="button" onclick="closeMeetingExamModal()"
                                class="px-5 py-2.5 rounded-xl border border-primary-200 dark:border-primary-700/50 text-secondary-600 dark:text-secondary-400 hover:bg-primary-50 dark:hover:bg-primary-800/20 transition-all duration-200">
                            Batal
                        </button>
                        <button type="submit"
                                class="px-6 py-2.5 rounded-xl bg-primary-600 hover:bg-primary-700 text-white font-semibold transition-all duration-200 hover:shadow-lg hover:shadow-primary-500/25 active:scale-[0.98]">
                            Buat
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            function openBlindTestModal() {
                openMeetingExamModal('blind_test');
            }

            function openPostTestModal() {
                openMeetingExamModal('post_test');
            }

            function openMeetingExamModal(type) {
                const modal = document.getElementById('meetingExamModal');
                modal.classList.remove('hidden');
                modal.classList.add('flex');

                const typeSelect = modal.querySelector('select[name="type"]');
                if (typeSelect) {
                    typeSelect.value = type;
                }
            }

            function closeMeetingExamModal() {
                const modal = document.getElementById('meetingExamModal');
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }

            // Close modal on backdrop click
            document.getElementById('meetingExamModal')?.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeMeetingExamModal();
                }
            });
        </script>
    </div>
</div>
@endsection
