@extends('layouts.app')

@section('title', $meeting->title.' | Live Class')
@section('description', 'Live class '.$meeting->title)
@section('content')
<div class="max-w-6xl mx-auto space-y-6">

    {{-- TOP ACTION BAR --}}
    @role('admin|tentor')
        <div class="flex justify-start">

            @if ($meeting->status === 'upcoming')
                <form method="POST"
                    action="{{ route('meeting.start', $meeting) }}"
                    class="sweet-confirm"
                    data-message="Mulai pertemuan sekarang?">
                    @csrf
                    <button
                        class="px-6 py-3 rounded-xl
                            text-base font-semibold
                            bg-green-600 text-white
                            hover:bg-green-700
                            shadow-md
                            transition">
                        Mulai Pertemuan
                    </button>
                </form>

            @elseif ($meeting->status === 'live')
                <form method="POST"
                    action="{{ route('meeting.finish', $meeting) }}"
                    class="sweet-confirm"
                    data-message="Selesaikan pertemuan ini?">
                    @csrf
                    <button
                        class="px-6 py-3 rounded-xl
                            text-base font-semibold
                            bg-red-600 text-white
                            hover:bg-red-700
                            shadow-md
                            transition">
                        Selesaikan Pertemuan
                    </button>
                </form>
            @endif

        </div>
    @endrole

    {{-- INFO MEETING --}}
    @include('meetings.partials.info')

    {{-- ABSENSI --}}
    @role('admin|tentor')
        @include('meetings.partials.attendance')
    @endrole

    @include('meetings.partials.material')
    @include('meetings.partials.video')
    @include('meetings.partials.meetingExam')

    {{-- ================================================= --}}
    {{-- MODAL : CREATE BLIND / POST TEST --}}
    {{-- ================================================= --}}
    <div id="meetingExamModal"
        class="fixed inset-0 z-50 hidden items-center justify-center
                bg-black/40 backdrop-blur-sm px-4">

        <div class="w-full max-w-sm rounded-2xl
                    bg-white dark:bg-azwara-darker
                    p-6 shadow-xl">

            <h3 class="text-lg font-bold mb-4
                    text-gray-900 dark:text-white">
                Buat Evaluasi
            </h3>

            <form method="POST"
                action="{{ route('meetings.exam.store', $meeting) }}"
                class="space-y-4">
                @csrf

                {{-- TYPE --}}
                <div>
                    <label class="text-sm font-medium
                                text-gray-700 dark:text-gray-300">
                        Jenis Evaluasi
                    </label>
                    <select name="type"
                            required
                            class="mt-1 w-full rounded-xl
                                border-gray-300 dark:border-white/10
                                bg-white dark:bg-secondary
                                text-gray-900 dark:text-white
                                focus:ring-primary focus:border-primary">
                        <option value="">-- Pilih --</option>
                        <option value="blind_test">Blind Test</option>
                        <option value="post_test">Post Test</option>
                    </select>
                </div>

                {{-- TEST TYPE --}}
                <div>
                    <label class="text-sm font-medium
                                text-gray-700 dark:text-gray-300">
                        Tipe Tes
                    </label>
                    <select name="test_type"
                            required
                            class="mt-1 w-full rounded-xl
                                border-gray-300 dark:border-white/10
                                bg-white dark:bg-secondary
                                text-gray-900 dark:text-white
                                focus:ring-primary focus:border-primary">
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
                <div class="flex justify-end gap-3 pt-4">
                    <button type="button"
                            onclick="closeMeetingExamModal()"
                            class="px-4 py-2 rounded-xl
                                bg-gray-200 dark:bg-gray-700
                                text-gray-800 dark:text-gray-200
                                hover:opacity-90">
                        Batal
                    </button>

                    <button type="submit"
                            class="px-5 py-2 rounded-xl
                                bg-primary text-white
                                font-semibold hover:bg-primary/90">
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

            modal.querySelector('select[name="type"]').value = type;
        }

        function closeMeetingExamModal() {
            const modal = document.getElementById('meetingExamModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>

</div>

@endsection
