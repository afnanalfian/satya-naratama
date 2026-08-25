@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6 space-y-8 overflow-x-hidden">

    {{-- ================= HEADER ================= --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4
                bg-white/60 dark:bg-primary-950/40 backdrop-blur-sm
                rounded-2xl p-6 border border-primary-200/30 dark:border-primary-800/30">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-primary-800 dark:text-primary-100">
                Student Dashboard
            </h1>
            <p class="text-sm text-secondary-500 dark:text-secondary-400 mt-1 flex items-center gap-2">
                <span class="inline-block w-2 h-2 rounded-full bg-accent-500 animate-pulse"></span>
                Welcome back, {{ auth()->user()->name }}! Here's your learning overview.
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
        $cards = [
            [
                'label' => 'My Courses',
                'value' => $stats['total_course'],
                'icon' => 'book',
                'color' => 'primary'
            ],
            [
                'label' => 'Total Meetings',
                'value' => $stats['done_meeting'].'/'.$stats['total_meeting'],
                'icon' => 'calendar',
                'color' => 'secondary'
            ],
            [
                'label' => "Today's Quiz",
                'value' => $todayQuizzes->count(),
                'icon' => 'clipboard',
                'color' => 'accent'
            ],
            [
                'label' => 'Active Assignments',
                'value' => $stats['active_quiz'],
                'icon' => 'pencil',
                'color' => 'gold'
            ],
        ];
    @endphp

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
        @foreach($cards as $card)
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
                    @elseif($card['icon'] == 'clipboard')
                        <svg class="w-6 h-6 text-{{ $card['color'] }}-600 dark:text-{{ $card['color'] }}-400" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                    @elseif($card['icon'] == 'pencil')
                        <svg class="w-6 h-6 text-{{ $card['color'] }}-600 dark:text-{{ $card['color'] }}-400" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
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

    {{-- ================= MY COURSES ================= --}}
    <div class="bg-white/80 dark:bg-primary-950/60 backdrop-blur-sm
                rounded-2xl p-6 border border-primary-200/30 dark:border-primary-800/30
                shadow-sm hover:shadow-xl transition-all duration-300">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-lg font-semibold text-primary-800 dark:text-primary-100 flex items-center gap-2">
                    <span class="inline-block w-2 h-2 rounded-full bg-primary-500"></span>
                    My Courses
                </h3>
                <p class="text-sm text-secondary-500 dark:text-secondary-400">Continue your learning journey</p>
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
            @forelse($myCourses as $course)
            <div onclick="window.location='{{ route('course.show',$course->slug) }}'"
                 class="group cursor-pointer rounded-2xl overflow-hidden
                        border border-primary-200/30 dark:border-primary-700/30
                        bg-white/50 dark:bg-primary-900/30
                        hover:shadow-xl hover:scale-[1.02]
                        transition-all duration-300">
                <div class="h-40 bg-gradient-to-br from-primary-100 to-primary-200/50
                            dark:from-primary-800/50 dark:to-primary-700/30
                            relative overflow-hidden">
                    @if($course->thumbnail)
                        <img src="{{ asset('storage/'.$course->thumbnail) }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @else
                        <div class="flex items-center justify-center h-full">
                            <svg class="w-16 h-16 text-primary-400/50 dark:text-primary-600/50" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                    @endif

                    {{-- Badge progress --}}
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
                <p class="text-secondary-500 dark:text-secondary-400">No courses enrolled yet</p>
                <a href="{{ route('course.index') }}" class="text-sm text-primary-600 dark:text-primary-400 font-medium hover:underline mt-2 inline-block">
                    Browse courses →
                </a>
            </div>
            @endforelse
        </div>
    </div>

    {{-- ================= CONTENT GRID ================= --}}
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
                            <p class="text-xs text-secondary-500 dark:text-secondary-400 mt-0.5">
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

            {{-- TODAY'S QUIZ --}}
            <div class="bg-white/80 dark:bg-primary-950/60 backdrop-blur-sm
                        rounded-2xl p-6 border border-primary-200/30 dark:border-primary-800/30
                        shadow-sm hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-primary-800 dark:text-primary-100 flex items-center gap-2">
                        <span class="inline-block w-2 h-2 rounded-full bg-accent-500"></span>
                        Today's Quiz
                    </h3>
                    <span class="text-sm bg-accent-100/50 dark:bg-accent-800/30
                                 text-accent-700 dark:text-accent-300
                                 px-3 py-1 rounded-lg font-medium">
                        {{ $todayQuizzes->count() }} quiz
                    </span>
                </div>

                <div class="space-y-3">
                    @forelse($todayQuizzes as $quiz)
                    <div class="group border border-primary-200/30 dark:border-primary-700/30
                                rounded-xl p-4
                                hover:bg-primary-50/50 dark:hover:bg-primary-800/30
                                transition-all duration-200">
                        <div class="flex items-center justify-between">
                            <div class="flex-1 min-w-0">
                                <p class="font-medium text-primary-800 dark:text-primary-100 group-hover:text-primary-600 dark:group-hover:text-primary-300 transition-colors truncate">
                                    {{ $quiz->title }}
                                </p>
                                <div class="flex items-center gap-3 mt-1 text-xs text-secondary-500 dark:text-secondary-400">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $quiz->exam_date->format('H:i') }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $quiz->duration_minutes }} min
                                    </span>
                                </div>
                            </div>
                            <a href="{{ route('exams.show',$quiz) }}"
                               class="ml-3 px-4 py-2 bg-gradient-to-r from-primary-500 to-accent-500
                                      hover:from-primary-600 hover:to-accent-600
                                      text-white text-sm font-medium rounded-lg
                                      shadow-sm shadow-primary-500/20 hover:shadow-md hover:shadow-primary-500/30
                                      transition-all duration-200 flex-shrink-0">
                                Start
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8">
                        <svg class="w-12 h-12 mx-auto text-secondary-300 dark:text-secondary-600 mb-2" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-secondary-500 dark:text-secondary-400">No quizzes scheduled today</p>
                        <p class="text-xs text-secondary-400 dark:text-secondary-500 mt-1">Enjoy your day! 🎉</p>
                    </div>
                    @endforelse
                </div>
            </div>

            {{-- UPCOMING TRYOUTS --}}
            <div class="bg-white/80 dark:bg-primary-950/60 backdrop-blur-sm
                        rounded-2xl p-6 border border-primary-200/30 dark:border-primary-800/30
                        shadow-sm hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-primary-800 dark:text-primary-100 flex items-center gap-2">
                        <span class="inline-block w-2 h-2 rounded-full bg-gold-500"></span>
                        Upcoming Tryouts
                    </h3>
                    <a href="{{ route('tryouts.index') }}"
                       class="text-sm text-primary-600 dark:text-primary-400 font-medium
                              hover:text-primary-700 dark:hover:text-primary-300
                              flex items-center gap-1 transition-colors">
                        View all
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>

                <div class="space-y-3">
                    @forelse($upcomingTryouts as $tryout)
                    <div class="group border border-primary-200/30 dark:border-primary-700/30
                                rounded-xl p-4
                                hover:bg-primary-50/50 dark:hover:bg-primary-800/30
                                hover:border-primary-300 dark:hover:border-primary-600
                                transition-all duration-200">
                        <div class="flex items-start justify-between">
                            <div class="flex-1 min-w-0">
                                <p class="font-medium text-primary-800 dark:text-primary-100 group-hover:text-primary-600 dark:group-hover:text-primary-300 transition-colors truncate">
                                    {{ $tryout->title }}
                                </p>
                                <div class="flex items-center gap-3 mt-1 text-xs text-secondary-500 dark:text-secondary-400">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ $tryout->exam_date->format('d M Y') }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $tryout->duration_minutes }} min
                                    </span>
                                </div>
                            </div>
                            <div class="ml-3 px-2.5 py-1 bg-gold-100/50 dark:bg-gold-500/20
                                        text-gold-700 dark:text-gold-300 text-xs font-medium rounded-lg flex-shrink-0">
                                {{ $tryout->exam_date->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8">
                        <svg class="w-12 h-12 mx-auto text-secondary-300 dark:text-secondary-600 mb-2" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-secondary-500 dark:text-secondary-400">No upcoming tryouts</p>
                        <p class="text-xs text-secondary-400 dark:text-secondary-500 mt-1">Check back later!</p>
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

    /* Course card hover */
    .course-card {
        transition: all 0.3s ease;
    }

    .course-card:hover {
        transform: translateY(-4px);
    }

    /* Meeting item pulse for live status */
    .status-live {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.7; }
    }
</style>
@endpush
