@extends('layouts.app')

@section('content')
<div class="py-6 md:py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Navigation --}}
        <nav class="flex items-center gap-2 text-sm mb-6">
            <a href="{{ route('meeting.show', $meeting) }}"
               class="text-secondary-500 hover:text-primary-600 dark:text-secondary-400 dark:hover:text-primary-300 transition-colors group">
                <span class="inline-flex items-center gap-1.5">
                    <svg class="w-4 h-4 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    {{ $meeting->title }}
                </span>
            </a>
            <span class="text-secondary-300 dark:text-secondary-600">/</span>
            <span class="text-primary-600 dark:text-primary-300 font-medium">Rekaman</span>
        </nav>

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
            <div>
                <h1 class="text-xl md:text-2xl font-bold text-primary-800 dark:text-primary-100">
                    {{ $meeting->title }}
                </h1>
                <p class="text-sm text-secondary-500 dark:text-secondary-400">Rekaman Pembelajaran</p>
            </div>
            <a href="{{ route('meeting.show', $meeting) }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl border border-primary-200 dark:border-primary-700/50 text-secondary-600 dark:text-secondary-300 hover:bg-primary-50 dark:hover:bg-primary-800/20 transition-all duration-200 font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Meeting
            </a>
        </div>

        {{-- Video Player --}}
        <div class="bg-black rounded-2xl overflow-hidden shadow-2xl border border-primary-200 dark:border-primary-700/50">
            <div class="relative w-full aspect-video">
                <iframe src="{{ $video->embed_url }}"
                        class="absolute inset-0 w-full h-full"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                </iframe>
            </div>
        </div>

        {{-- Video Info --}}
        <div class="mt-6 bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 p-6 shadow-sm">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h3 class="text-lg font-semibold text-primary-800 dark:text-primary-100">{{ $video->title }}</h3>
                    <div class="flex flex-wrap items-center gap-x-4 gap-y-1.5 mt-1.5 text-sm text-secondary-500 dark:text-secondary-400">
                        <span class="inline-flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $video->created_at->translatedFormat('l, d F Y') }}
                        </span>
                        <span class="inline-flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                            </svg>
                            {{ ucfirst($video->platform) }}
                        </span>
                        @if($video->duration)
                        <span class="inline-flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $video->duration }}
                        </span>
                        @endif
                    </div>
                </div>

                @if($video->description)
                <span class="text-xs text-secondary-500 dark:text-secondary-400 max-w-sm text-right">
                    {{ $video->description }}
                </span>
                @endif
            </div>

            {{-- Description (if not shown above) --}}
            @if($video->description)
            <div class="mt-4 pt-4 border-t border-primary-100 dark:border-primary-800/30">
                <p class="text-sm text-secondary-600 dark:text-secondary-300">{{ $video->description }}</p>
            </div>
            @endif
        </div>

        {{-- Related / Actions --}}
        <div class="mt-6 flex flex-wrap gap-3">
            <a href="{{ route('meeting.show', $meeting) }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-primary-600 hover:bg-primary-700 text-white font-medium transition-all duration-200 hover:shadow-lg hover:shadow-primary-500/25 active:scale-[0.98]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Meeting
            </a>

            @if($video->source === 'youtube')
            <a href="https://www.youtube.com/watch?v={{ $video->youtube_video_id }}" target="_blank"
               class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl border border-red-200 dark:border-red-700/50 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-all duration-200 font-medium">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                </svg>
                Buka di YouTube
            </a>
            @endif
        </div>
    </div>
</div>
@endsection
