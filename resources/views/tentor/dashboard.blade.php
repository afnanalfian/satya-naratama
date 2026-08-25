@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6 space-y-8 overflow-x-hidden">

    {{-- ================= HEADER ================= --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4
                bg-white/60 dark:bg-primary-950/40 backdrop-blur-sm
                rounded-2xl p-6 border border-primary-200/30 dark:border-primary-800/30">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-primary-800 dark:text-primary-100">
                Tentor Dashboard
            </h1>
            <p class="text-sm text-secondary-500 dark:text-secondary-400 mt-1 flex items-center gap-2">
                <span class="inline-block w-2 h-2 rounded-full bg-accent-500 animate-pulse"></span>
                Welcome back, {{ auth()->user()->name }}! Manage your teaching activities.
            </p>
        </div>
        <div class="flex items-center gap-3">
            <span class="px-4 py-2 bg-primary-100/50 dark:bg-primary-800/30
                         text-primary-700 dark:text-primary-300
                         rounded-xl text-sm font-medium
                         border border-primary-200/30 dark:border-primary-700/30
                         flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                {{ now()->format('d M Y') }}
            </span>
        </div>
    </div>

    {{-- ================= STATS CARDS ================= --}}
    @php
        $statsCards = [
            [
                'label' => 'Total Courses',
                'value' => $stats['total_courses'],
                'icon' => 'book',
                'color' => 'primary'
            ],
            [
                'label' => 'Total Meetings',
                'value' => $stats['total_meetings'],
                'icon' => 'calendar',
                'color' => 'secondary'
            ],
            [
                'label' => 'Live Now',
                'value' => $stats['live_meetings'],
                'icon' => 'live',
                'color' => 'accent'
            ],
            [
                'label' => 'Attendance This Week',
                'value' => $totalAttendance,
                'icon' => 'users',
                'color' => 'gold'
            ],
        ];
    @endphp

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
        @foreach($statsCards as $card)
        <div class="group bg-gradient-to-br from-white to-{{ $card['color'] }}-50/50
                    dark:from-primary-900/50 dark:to-primary-800/30
                    rounded-2xl p-6 border border-{{ $card['color'] }}-200/30 dark:border-primary-700/30
                    shadow-sm hover:shadow-xl hover:scale-[1.02]
                    transition-all duration-300 cursor-default">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-{{ $card['color'] }}-600 dark:text-{{ $card['color'] }}-400 font-medium">
                        {{ $card['label'] }}
                    </p>
                    <h3 class="text-2xl font-bold text-primary-800 dark:text-primary-100 mt-1">
                        {{ $card['value'] }}
                    </h3>
                </div>
                <div class="p-3 bg-{{ $card['color'] }}-100/50 dark:bg-primary-800/50 rounded-xl
                            group-hover:scale-110 transition-transform duration-300">
                    @if($card['icon'] == 'book')
                        <svg class="w-6 h-6 text-{{ $card['color'] }}-600 dark:text-{{ $card['color'] }}-400" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    @elseif($card['icon'] == 'calendar')
                        <svg class="w-6 h-6 text-{{ $card['color'] }}-600 dark:text-{{ $card['color'] }}-400" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    @elseif($card['icon'] == 'live')
                        <svg class="w-6 h-6 text-{{ $card['color'] }}-600 dark:text-{{ $card['color'] }}-400" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/>
                            <circle cx="12" cy="12" r="3" class="animate-pulse"/>
                        </svg>
                    @elseif($card['icon'] == 'users')
                        <svg class="w-6 h-6 text-{{ $card['color'] }}-600 dark:text-{{ $card['color'] }}-400" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    @endif
                </div>
            </div>
            <p class="text-xs text-secondary-500 dark:text-secondary-400 mt-3 flex items-center gap-1">
                <span class="inline-block w-1.5 h-1.5 rounded-full bg-{{ $card['color'] }}-500"></span>
                {{ $card['label'] }}
            </p>
        </div>
        @endforeach
    </div>

    {{-- ================= COURSES ================= --}}
    <div class="bg-white/80 dark:bg-primary-950/60 backdrop-blur-sm
                rounded-2xl p-6 border border-primary-200/30 dark:border-primary-800/30
                shadow-sm hover:shadow-xl transition-all duration-300">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-lg font-semibold text-primary-800 dark:text-primary-100 flex items-center gap-2">
                    <span class="inline-block w-2 h-2 rounded-full bg-primary-500"></span>
                    My Courses
                </h3>
                <p class="text-sm text-secondary-500 dark:text-secondary-400">Courses you're teaching</p>
            </div>
            <a href="{{ route('course.index') }}"
               class="text-sm text-primary-600 dark:text-primary-400 font-medium
                      hover:text-primary-700 dark:hover:text-primary-300
                      flex items-center gap-1 transition-colors">
                View all
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @forelse($coursesTaught as $course)
            <div onclick="window.location='{{ route('course.show',$course->slug) }}'"
                 class="group cursor-pointer rounded-2xl overflow-hidden
                        border border-primary-200/30 dark:border-primary-700/30
                        bg-white/50 dark:bg-primary-900/30
                        hover:shadow-xl hover:scale-[1.02]
                        transition-all duration-300">
                <div class="h-40 bg-gradient-to-br from-secondary-100 to-secondary-200/50
                            dark:from-secondary-800/50 dark:to-secondary-700/30
                            relative overflow-hidden">
                    @if($course->thumbnail)
                        <img src="{{ asset('storage/'.$course->thumbnail) }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @else
                        <div class="flex items-center justify-center h-full">
                            <svg class="w-16 h-16 text-secondary-400/50 dark:text-secondary-600/50" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                    @endif

                    {{-- Badge meetings --}}
                    <div class="absolute bottom-2 right-2 px-2 py-1 bg-primary-900/80 backdrop-blur-sm
                                rounded-lg text-white text-xs font-medium">
                        {{ $course->meetings_count }} meetings
                    </div>
                </div>
                <div class="p-4">
                    <p class="font-semibold text-primary-800 dark:text-primary-100 truncate group-hover:text-primary-600 dark:group-hover:text-primary-300 transition-colors">
                        {{ $course->name }}
                    </p>
                    <p class="text-xs text-secondary-500 dark:text-secondary-400 mt-1">
                        {{ $course->category ?? 'General' }}
                    </p>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <svg class="w-16 h-16 mx-auto text-secondary-300 dark:text-secondary-600 mb-3" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                <p class="text-secondary-500 dark:text-secondary-400">No courses assigned yet</p>
                <p class="text-xs text-secondary-400 dark:text-secondary-500 mt-1">Contact admin to get courses</p>
            </div>
            @endforelse
        </div>
    </div>

    {{-- ================= MAIN GRID ================= --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- MEETINGS THIS WEEK --}}
        <div class="bg-white/80 dark:bg-primary-950/60 backdrop-blur-sm
                    rounded-2xl p-6 border border-primary-200/30 dark:border-primary-800/30
                    shadow-sm hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-primary-800 dark:text-primary-100 flex items-center gap-2">
                    <span class="inline-block w-2 h-2 rounded-full bg-secondary-500"></span>
                    Meetings This Week
                </h3>
                <span class="text-sm bg-secondary-100/50 dark:bg-secondary-800/30
                             text-secondary-700 dark:text-secondary-300
                             px-3 py-1 rounded-lg font-medium">
                    {{ $weeklyMeetings->count() }} meetings
                </span>
            </div>

            <div class="space-y-3 max-h-96 overflow-y-auto pr-1
                        scrollbar-thin scrollbar-thumb-primary-400/30 dark:scrollbar-thumb-primary-600/30
                        scrollbar-track-transparent">
                @forelse($weeklyMeetings as $meeting)
                <div onclick="window.location='{{ route('meeting.show',$meeting) }}'"
                     class="group border border-primary-200/30 dark:border-primary-700/30
                            rounded-xl p-4
                            hover:bg-primary-50/50 dark:hover:bg-primary-800/30
                            hover:border-primary-300 dark:hover:border-primary-600
                            hover:shadow-md
                            transition-all duration-200 cursor-pointer">
                    <div class="flex items-start justify-between">
                        <div class="flex-1 min-w-0">
                            <p class="font-medium text-primary-800 dark:text-primary-100 group-hover:text-primary-600 dark:group-hover:text-primary-300 transition-colors truncate">
                                {{ $meeting->title }}
                            </p>
                            <p class="text-xs text-secondary-500 dark:text-secondary-400 mt-0.5 truncate">
                                {{ $meeting->course->name ?? '-' }}
                            </p>
                        </div>
                        @php
                            $statusColors = [
                                'live' => 'bg-accent-100 text-accent-800 dark:bg-accent-500/20 dark:text-accent-300',
                                'upcoming' => 'bg-primary-100 text-primary-800 dark:bg-primary-500/20 dark:text-primary-300',
                                'done' => 'bg-secondary-100 text-secondary-800 dark:bg-secondary-500/20 dark:text-secondary-300',
                                'cancelled' => 'bg-red-100 text-red-800 dark:bg-red-500/20 dark:text-red-300'
                            ];
                            $color = $statusColors[$meeting->status] ?? 'bg-secondary-100 text-secondary-800';
                        @endphp
                        <span class="ml-3 px-2.5 py-0.5 text-xs font-medium rounded-full {{ $color }} flex-shrink-0">
                            {{ ucfirst($meeting->status) }}
                        </span>
                    </div>
                    <div class="flex items-center gap-4 mt-2 text-xs text-secondary-500 dark:text-secondary-400">
                        <span class="flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $meeting->scheduled_at->format('d M H:i') }}
                        </span>
                        <span class="flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $meeting->scheduled_at->format('H:i') }}
                        </span>
                    </div>
                </div>
                @empty
                <div class="text-center py-12">
                    <svg class="w-16 h-16 mx-auto text-secondary-300 dark:text-secondary-600 mb-3" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-secondary-500 dark:text-secondary-400">No meetings scheduled this week</p>
                </div>
                @endforelse
            </div>
        </div>

        {{-- RIGHT SIDE --}}
        <div class="space-y-6">

            {{-- UPCOMING MEETINGS --}}
            <div class="bg-white/80 dark:bg-primary-950/60 backdrop-blur-sm
                        rounded-2xl p-6 border border-primary-200/30 dark:border-primary-800/30
                        shadow-sm hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-primary-800 dark:text-primary-100 flex items-center gap-2">
                        <span class="inline-block w-2 h-2 rounded-full bg-accent-500"></span>
                        Upcoming Meetings
                    </h3>
                    <span class="px-3 py-1 bg-accent-100/50 dark:bg-accent-800/30
                                 text-accent-700 dark:text-accent-300
                                 text-sm font-medium rounded-lg">
                        {{ $upcomingMeetings->count() }}
                    </span>
                </div>

                <div class="space-y-3 max-h-72 overflow-y-auto pr-1
                            scrollbar-thin scrollbar-thumb-primary-400/30 dark:scrollbar-thumb-primary-600/30
                            scrollbar-track-transparent">
                    @forelse($upcomingMeetings as $meeting)
                    <div class="group border border-primary-200/30 dark:border-primary-700/30
                                rounded-xl p-4
                                hover:bg-primary-50/50 dark:hover:bg-primary-800/30
                                transition-all duration-200">
                        <div class="flex items-center justify-between gap-3">
                            <div class="flex-1 min-w-0">
                                <p class="font-medium text-primary-800 dark:text-primary-100 group-hover:text-primary-600 dark:group-hover:text-primary-300 transition-colors truncate">
                                    {{ $meeting->title }}
                                </p>
                                <div class="flex items-center gap-3 mt-1 text-xs text-secondary-500 dark:text-secondary-400">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ $meeting->scheduled_at->format('d M H:i') }}
                                    </span>
                                    <span class="flex items-center gap-1 truncate">
                                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                        </svg>
                                        {{ $meeting->course->name ?? '-' }}
                                    </span>
                                </div>
                            </div>
                            <a href="{{ route('meeting.show',$meeting) }}"
                               class="px-4 py-2 bg-gradient-to-r from-primary-500 to-accent-500
                                      hover:from-primary-600 hover:to-accent-600
                                      text-white text-xs font-medium rounded-lg
                                      shadow-sm shadow-primary-500/20 hover:shadow-md hover:shadow-primary-500/30
                                      transition-all duration-200 flex-shrink-0">
                                View
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8">
                        <svg class="w-12 h-12 mx-auto text-secondary-300 dark:text-secondary-600 mb-2" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-secondary-500 dark:text-secondary-400">No upcoming meetings</p>
                        <p class="text-xs text-secondary-400 dark:text-secondary-500 mt-1">All caught up! 🎉</p>
                    </div>
                    @endforelse
                </div>
            </div>

            {{-- RECENT STUDENTS --}}
            <div class="bg-white/80 dark:bg-primary-950/60 backdrop-blur-sm
                        rounded-2xl p-6 border border-primary-200/30 dark:border-primary-800/30
                        shadow-sm hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-primary-800 dark:text-primary-100 flex items-center gap-2">
                        <span class="inline-block w-2 h-2 rounded-full bg-gold-500"></span>
                        Recent Students
                    </h3>
                    <span class="px-3 py-1 bg-gold-100/50 dark:bg-gold-800/30
                                 text-gold-700 dark:text-gold-300
                                 text-sm font-medium rounded-lg">
                        {{ $recentStudents->count() }}
                    </span>
                </div>

                <div class="space-y-3 max-h-72 overflow-y-auto pr-1
                            scrollbar-thin scrollbar-thumb-primary-400/30 dark:scrollbar-thumb-primary-600/30
                            scrollbar-track-transparent">
                    @forelse($recentStudents as $student)
                    <div class="group border border-primary-200/30 dark:border-primary-700/30
                                rounded-xl p-4
                                hover:bg-primary-50/50 dark:hover:bg-primary-800/30
                                transition-all duration-200">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary-100 to-accent-100
                                        dark:from-primary-800 dark:to-accent-800
                                        flex items-center justify-center flex-shrink-0
                                        group-hover:scale-110 transition-transform duration-300">
                                <span class="text-lg">👤</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-medium text-primary-800 dark:text-primary-100 group-hover:text-primary-600 dark:group-hover:text-primary-300 transition-colors truncate">
                                    {{ $student->name }}
                                </p>
                                <p class="text-xs text-secondary-500 dark:text-secondary-400 truncate">
                                    {{ $student->email }}
                                </p>
                                <p class="text-xs text-secondary-400 dark:text-secondary-500 mt-1 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ \Carbon\Carbon::parse($student->attended_at)->diffForHumans() }}
                                </p>
                            </div>
                            <div class="w-2 h-2 rounded-full bg-accent-500 animate-pulse flex-shrink-0"></div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8">
                        <svg class="w-12 h-12 mx-auto text-secondary-300 dark:text-secondary-600 mb-2" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <p class="text-secondary-500 dark:text-secondary-400">No attendance recorded yet</p>
                        <p class="text-xs text-secondary-400 dark:text-secondary-500 mt-1">Start teaching to see students!</p>
                    </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>

</div>
@endsection

@push('styles')
<style>
    /* Custom Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .group {
        animation: fadeInUp 0.5s ease-out forwards;
        opacity: 0;
    }

    .grid .group:nth-child(1) { animation-delay: 0.05s; }
    .grid .group:nth-child(2) { animation-delay: 0.10s; }
    .grid .group:nth-child(3) { animation-delay: 0.15s; }
    .grid .group:nth-child(4) { animation-delay: 0.20s; }

    /* Custom Scrollbar */
    .scrollbar-thin::-webkit-scrollbar {
        width: 4px;
    }

    .scrollbar-thin::-webkit-scrollbar-track {
        background: transparent;
    }

    .scrollbar-thin::-webkit-scrollbar-thumb {
        background: #418741;
        border-radius: 9999px;
    }

    .dark .scrollbar-thin::-webkit-scrollbar-thumb {
        background: #418741;
    }

    /* Live pulse animation */
    .animate-pulse {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }

    /* Course card hover */
    .course-card {
        transition: all 0.3s ease;
    }

    .course-card:hover {
        transform: translateY(-4px);
    }
</style>
@endpush
