@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-4 space-y-6 overflow-x-hidden">

    {{-- HEADER --}}
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-white">
                Tentor Dashboard
            </h1>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Welcome back, {{ auth()->user()->name }}! Manage your teaching activities.
            </p>
        </div>
        <span class="px-4 py-2 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-300 rounded-lg text-sm font-medium">
            {{ now()->format('d M Y') }}
        </span>
    </div>

    {{-- STATS --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        @php
            $statsCards = [
                ['label'=>'Total Courses','value'=>$stats['total_courses'],'icon'=>'📚'],
                ['label'=>'Total Meetings','value'=>$stats['total_meetings'],'icon'=>'🎯'],
                ['label'=>'Live Now','value'=>$stats['live_meetings'],'icon'=>'🔴'],
                ['label'=>'Attendance This Week','value'=>$totalAttendance,'icon'=>'👥'],
            ];
        @endphp

        @foreach($statsCards as $card)
        <div class="rounded-xl p-4 border bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-500">{{ $card['label'] }}</p>
                    <p class="text-xl font-bold text-gray-800 dark:text-white">{{ $card['value'] }}</p>
                </div>
                <div class="text-2xl">{{ $card['icon'] }}</div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- COURSES --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-4 border dark:border-gray-700">
        <div class="flex justify-between items-center mb-4">
            <h3 class="font-semibold text-gray-800 dark:text-white">Courses</h3>
            <a href="{{ route('course.index') }}" class="text-sm text-blue-600">View all</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @forelse($coursesTaught as $course)
            <div onclick="window.location='{{ route('course.show',$course->slug) }}'"
                 class="cursor-pointer rounded-xl border p-3 dark:border-gray-700 hover:border-purple-400 transition">
                <div class="h-32 rounded-lg bg-gray-200 dark:bg-gray-700 mb-2 overflow-hidden">
                    @if($course->thumbnail)
                        <img src="{{ asset('storage/'.$course->thumbnail) }}"  class="w-full h-full object-cover">
                    @else
                        <div class="flex items-center justify-center h-full text-3xl">📘</div>
                    @endif
                </div>
                <p class="font-medium text-gray-800 dark:text-white truncate">{{ $course->name }}</p>
                <p class="text-xs text-gray-500">{{ $course->meetings_count }} meetings</p>
            </div>
            @empty
            <div class="col-span-full text-center py-6 text-gray-500">
                No courses assigned
            </div>
            @endforelse
        </div>
    </div>

    {{-- MAIN GRID --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- MEETINGS THIS WEEK --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-4 border dark:border-gray-700">
            <h3 class="font-semibold mb-4 text-gray-800 dark:text-white">
                Meetings This Week
            </h3>

            <div class="space-y-3">
                @forelse($weeklyMeetings as $meeting)
                <div onclick="window.location='{{ route('meeting.show',$meeting) }}'"
                     class="border rounded-lg p-3 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/30 cursor-pointer transition">
                    <p class="font-medium text-gray-800 dark:text-white truncate">{{ $meeting->title }}</p>
                    <p class="text-xs text-gray-500 truncate">{{ $meeting->course->name ?? '-' }}</p>
                    <div class="flex justify-between text-xs text-gray-500 mt-2">
                        <span>{{ ucfirst($meeting->status) }}</span>
                        <span>{{ $meeting->scheduled_at->format('d M H:i') }}</span>
                    </div>
                </div>
                @empty
                <div class="text-center text-gray-500 py-6">No meetings this week</div>
                @endforelse
            </div>
        </div>

        {{-- RIGHT SIDE --}}
        <div class="space-y-6">

            {{-- UPCOMING MEETINGS --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-4 border dark:border-gray-700">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-semibold text-gray-800 dark:text-white">Upcoming Meetings</h3>
                    <span class="text-xs px-2 py-1 bg-blue-100 dark:bg-blue-500/20 text-blue-700 dark:text-blue-300 rounded-full">
                        {{ $upcomingMeetings->count() }}
                    </span>
                </div>

                <div class="space-y-3">
                    @forelse($upcomingMeetings as $meeting)
                    <div class="border rounded-lg p-3 dark:border-gray-700 flex justify-between items-center">
                        <div class="min-w-0">
                            <p class="font-medium text-gray-800 dark:text-white truncate">{{ $meeting->title }}</p>
                            <p class="text-xs text-gray-500 truncate">
                                {{ $meeting->course->name ?? '-' }} • {{ $meeting->scheduled_at->format('d M H:i') }}
                            </p>
                        </div>
                        <a href="{{ route('meeting.show',$meeting) }}"
                           class="text-xs px-3 py-1 bg-blue-600 text-white rounded-lg">
                            View
                        </a>
                    </div>
                    @empty
                    <div class="text-center text-gray-500 py-4">No upcoming meetings</div>
                    @endforelse
                </div>
            </div>

            {{-- RECENT STUDENTS --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-4 border dark:border-gray-700">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-semibold text-gray-800 dark:text-white">Recent Students</h3>
                    <span class="text-xs px-2 py-1 bg-purple-100 dark:bg-purple-500/20 text-purple-700 dark:text-purple-300 rounded-full">
                        {{ $recentStudents->count() }}
                    </span>
                </div>

                <div class="space-y-3">
                    @forelse($recentStudents as $student)
                    <div class="border rounded-lg p-3 dark:border-gray-700 flex gap-3">
                        <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                            👤
                        </div>
                        <div class="min-w-0">
                            <p class="font-medium text-gray-800 dark:text-white truncate">{{ $student->name }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ $student->email }}</p>
                            <p class="text-xs text-gray-400 mt-1">
                                {{ \Carbon\Carbon::parse($student->attended_at)->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                    @empty
                    <div class="text-center text-gray-500 py-4">No attendance yet</div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>

</div>
@endsection
