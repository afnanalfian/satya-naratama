@extends('layouts.app')

@section('content')
<div class="py-6 md:py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

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
            <span class="text-primary-600 dark:text-primary-300 font-medium">Tambah Video</span>
        </nav>

        {{-- Main Card --}}
        <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 overflow-hidden shadow-sm" x-data="{ source: '{{ old('source', 'youtube') }}' }">

            {{-- Header --}}
            <div class="px-6 py-5 border-b border-primary-100 dark:border-primary-800/30">
                <div class="flex items-center gap-3">
                    <div class="p-2.5 rounded-xl bg-primary-500/10 text-primary-600 dark:bg-primary-400/10 dark:text-primary-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-primary-800 dark:text-primary-100">Tambah Rekaman Pembelajaran</h1>
                        <p class="text-sm text-secondary-500 dark:text-secondary-400">
                            Meeting: <span class="font-medium text-primary-600 dark:text-primary-300">{{ $meeting->title }}</span>
                        </p>
                    </div>
                </div>
            </div>

            {{-- Form --}}
            <form action="{{ route('meetings.video.store', $meeting) }}" method="POST" class="p-6 space-y-6">
                @csrf

                {{-- Title --}}
                <div>
                    <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                        Judul Video <span class="text-accent-500">*</span>
                    </label>
                    <input type="text" name="title" id="title" value="{{ old('title', $meeting->title) }}" required
                           placeholder="Masukkan judul video"
                           class="w-full px-4 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 placeholder-secondary-400 focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200">
                    @error('title')
                        <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Platform Selector --}}
                <div>
                    <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                        Platform Video <span class="text-accent-500">*</span>
                    </label>
                    <select name="source" id="source" x-model="source"
                            class="w-full px-4 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200 appearance-none">
                        <option value="youtube">YouTube</option>
                        <option value="cdn">Bunny.net</option>
                    </select>
                    @error('source')
                        <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- YouTube Mode --}}
                <div x-show="source === 'youtube'" x-cloak>
                    <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                        YouTube Video ID <span class="text-accent-500">*</span>
                    </label>
                    <input type="text" name="youtube_video_id" id="youtube_video_id"
                           value="{{ old('youtube_video_id') }}"
                           placeholder="contoh: dQw4w9WgXcQ"
                           class="w-full px-4 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 placeholder-secondary-400 focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200">
                    <p class="mt-1.5 text-xs text-secondary-500 dark:text-secondary-400">
                        Contoh URL: <code class="px-1.5 py-0.5 rounded bg-primary-100 dark:bg-primary-800/40 text-primary-700 dark:text-primary-300">https://www.youtube.com/watch?v=dQw4w9WgXcQ</code>
                    </p>
                    @error('youtube_video_id')
                        <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Bunny Mode --}}
                <div x-show="source === 'cdn'" x-cloak>
                    <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                        Bunny Video ID <span class="text-accent-500">*</span>
                    </label>
                    <input type="text" name="cdn_video_id" id="cdn_video_id"
                           value="{{ old('cdn_video_id') }}"
                           placeholder="contoh: a1b2c3d4"
                           class="w-full px-4 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 placeholder-secondary-400 focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200">
                    <p class="mt-1.5 text-xs text-secondary-500 dark:text-secondary-400">
                        Video harus sudah di-upload di Bunny Video Library.
                    </p>
                    @error('cdn_video_id')
                        <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Actions --}}
                <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-primary-100 dark:border-primary-800/30">
                    <button type="submit"
                            class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-primary-600 hover:bg-primary-700 text-white font-medium transition-all duration-200 hover:shadow-lg hover:shadow-primary-500/25 active:scale-[0.98]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Video
                    </button>
                    <a href="{{ route('meeting.show', $meeting) }}"
                       class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 text-secondary-600 dark:text-secondary-400 hover:bg-primary-50 dark:hover:bg-primary-800/20 transition-all duration-200">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
