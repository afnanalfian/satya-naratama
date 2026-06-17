@extends('layouts.app')

@section('title', $course->name.' | Course Azwara Learning')
@section('description', Str::limit($course->description, 155))
@section('content')
<div class="space-y-8 max-w-6xl mx-auto">

    {{-- COURSE TITLE --}}
    <div>
        <h1 class="text-3xl font-extrabold
                   text-azwara-darker dark:text-azwara-lighter">
            {{ $course->name }}
        </h1>
    </div>

    {{-- COURSE HEADER --}}
    <div class="rounded-2xl p-6
                border border-azwara-light/30 dark:border-white/10
                backdrop-blur">

        <div class="flex flex-col lg:flex-row
                    lg:items-center lg:justify-between
                    gap-6">

            {{-- LEFT --}}
            <div class="space-y-2">
                <h2 class="text-2xl font-bold
                           text-azwara-darker dark:text-azwara-lighter">
                    {{ $course->title }}
                </h2>

                <div class="text-sm text-gray-600 dark:text-gray-300">
                    Tentor:
                    @foreach ($course->teachers as $teacher)
                        <span class="font-medium">
                            {{ $teacher->user->name }}
                        </span>{{ !$loop->last ? ',' : '' }}
                    @endforeach
                </div>

                <div class="text-sm text-gray-500 dark:text-gray-400">
                    Total Pertemuan:
                    <span class="font-semibold text-gray-700 dark:text-gray-200">
                        {{ $course->meetings->count() }}
                    </span>
                </div>
            </div>

            {{-- RIGHT --}}
            <div class="flex flex-col sm:flex-row sm:items-center gap-3 w-full lg:w-auto">

                <input
                    id="meeting-search"
                    type="text"
                    placeholder="Cari pertemuan..."
                    class="w-full sm:w-64 rounded-xl
                           border-gray-300 dark:border-white/10
                           bg-azwara-lightest dark:bg-secondary
                           text-sm dark:text-white
                           focus:ring-primary focus:border-primary">

                @hasanyrole('admin|tentor')
                <a href="{{ route('meeting.create', $course) }}"
                   class="inline-flex justify-center items-center gap-2
                          px-4 py-2 rounded-xl
                          bg-primary text-white
                          text-sm font-medium
                          hover:bg-primary/90 transition">
                    + Tambah Pertemuan
                </a>
                @endhasanyrole
            </div>
        </div>
    </div>

    @php
        $lockIcon = '
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
            fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M16 11V7a4 4 0 00-8 0v4
                    M5 11h14
                    a2 2 0 012 2v6
                    a2 2 0 01-2 2H5
                    a2 2 0 01-2-2v-6
                    a2 2 0 012-2z" />
        </svg>';
    @endphp

    {{-- MEETING LIST --}}
    <div id="meeting-list" class="grid gap-4">

        @forelse ($course->meetings as $index => $meeting)

            @php
                $canAccessMeeting = auth()->check()
                    && auth()->user()->can('view', $meeting);

                $statusColor = match ($meeting->status) {
                    'upcoming' => 'bg-blue-100 text-blue-700 dark:bg-blue-500/20 dark:text-blue-300',
                    'live'     => 'bg-green-100 text-green-700 dark:bg-green-500/20 dark:text-green-300',
                    'done'     => 'bg-gray-200 text-gray-700 dark:bg-gray-500/20 dark:text-gray-300',
                    default    => 'bg-gray-100 text-gray-600 dark:bg-gray-500/10 dark:text-gray-400',
                };
            @endphp

            <div
                @if($canAccessMeeting)
                    onclick="window.location='{{ route('meeting.show', $meeting) }}'"
                @else
                    onclick="showLockedMeetingToast()"
                @endif
                class="meeting-card group cursor-pointer
                       rounded-xl p-5
                       bg-azwara-lightest dark:bg-secondary/70
                       border border-azwara-light/30 dark:border-white/10
                       transition
                       hover:shadow-lg hover:-translate-y-0.5
                       {{ ! $canAccessMeeting ? 'opacity-80 hover:shadow-none hover:translate-y-0' : '' }}">

                <div class="flex flex-col sm:flex-row
                            sm:items-center sm:justify-between
                            gap-4">

                    {{-- LEFT --}}
                    <div class="space-y-1">
                        <div class="text-xs text-gray-500 dark:text-gray-400">
                            Pertemuan {{ $index + 1 }}
                        </div>

                        <h3 class="meeting-title text-3xl font-semibold
                                   text-azwara-darker dark:text-azwara-lighter">
                            {{ $meeting->title }}
                        </h3>

                        @if ($meeting->scheduled_at)
                            <div class="text-sm text-gray-600 dark:text-gray-300">
                                {{ $meeting->scheduled_at
                                    ->timezone('Asia/Jakarta')
                                    ->translatedFormat('l, d F Y • H:i') }} WIB
                            </div>
                        @endif
                    </div>

                    {{-- RIGHT --}}
                    @if ($canAccessMeeting)
                        <span class="self-start sm:self-center
                                     px-3 py-1 rounded-full
                                     text-md font-semibold {{ $statusColor }}">
                            {{ ucfirst($meeting->status) }}
                        </span>
                    @else
                        <span class="self-start sm:self-center
                                     flex items-center gap-2
                                     px-3 py-1 rounded-full
                                     text-sm font-semibold
                                     bg-gray-200 text-gray-600
                                     dark:bg-gray-500/20 dark:text-gray-300">
                            {!! $lockIcon !!}
                            Terkunci
                        </span>
                    @endif
                </div>
            </div>

        @empty
            <div class="text-center py-12
                        text-gray-500 dark:text-gray-400">
                Belum ada pertemuan untuk course ini.
            </div>
        @endforelse
    </div>

</div>
@endsection

@push('scripts')
<script>
    const searchInput = document.getElementById('meeting-search');
    const cards = document.querySelectorAll('.meeting-card');

    searchInput?.addEventListener('input', function () {
        const keyword = this.value.toLowerCase();

        cards.forEach(card => {
            const title = card.querySelector('.meeting-title')
                              .innerText.toLowerCase();

            card.classList.toggle('hidden', !title.includes(keyword));
        });
    });

    function showLockedMeetingToast() {
        if (window.toast) {
            toast('error', 'Anda belum punya hak akses untuk meeting ini, silakan lakukan pembelian terlebih dahulu');
        } else {
            alert('Anda belum punya hak akses untuk meeting ini. Silakan lakukan pembelian terlebih dahulu');
        }
    }
</script>
@endpush
