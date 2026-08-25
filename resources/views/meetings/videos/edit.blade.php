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
            <span class="text-primary-600 dark:text-primary-300 font-medium">Edit Video</span>
        </nav>

        {{-- Main Card --}}
        <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 overflow-hidden shadow-sm" x-data="{ source: '{{ old('source', $video->source) }}' }">

            {{-- Header --}}
            <div class="px-6 py-5 border-b border-primary-100 dark:border-primary-800/30">
                <div class="flex items-center gap-3">
                    <div class="p-2.5 rounded-xl bg-primary-500/10 text-primary-600 dark:bg-primary-400/10 dark:text-primary-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-primary-800 dark:text-primary-100">Edit Rekaman Pembelajaran</h1>
                        <p class="text-sm text-secondary-500 dark:text-secondary-400">
                            Meeting: <span class="font-medium text-primary-600 dark:text-primary-300">{{ $meeting->title }}</span>
                        </p>
                    </div>
                </div>
            </div>

            {{-- Preview --}}
            <div class="px-6 py-4 border-b border-primary-100 dark:border-primary-800/30 bg-primary-50/30 dark:bg-primary-800/20">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-primary-700 dark:text-primary-300">Preview Video</p>
                        <p class="text-xs text-secondary-500 dark:text-secondary-400">
                            Platform: <span x-text="source === 'cdn' ? 'Bunny.net' : 'YouTube'"></span>
                        </p>
                    </div>
                    <div class="w-32 aspect-video rounded-lg overflow-hidden bg-primary-200 dark:bg-primary-700/50">
                        <img src="{{ $video->thumbnail }}" alt="Thumbnail video"
                             class="w-full h-full object-cover">
                    </div>
                </div>
            </div>

            {{-- Form --}}
            <form action="{{ route('meetings.video.update', $meeting) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                {{-- Title --}}
                <div>
                    <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                        Judul Video <span class="text-accent-500">*</span>
                    </label>
                    <input type="text" name="title" value="{{ old('title', $video->title) }}" required
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
                    <input type="text" name="youtube_video_id" value="{{ old('youtube_video_id', $video->youtube_video_id) }}"
                           placeholder="contoh: dQw4w9WgXcQ"
                           class="w-full px-4 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 placeholder-secondary-400 focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200">
                    @error('youtube_video_id')
                        <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Bunny Mode --}}
                <div x-show="source === 'cdn'" x-cloak>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                            Bunny Video Library ID
                        </label>
                        <input type="text" value="{{ config('services.bunny.library_id') }}" disabled
                               class="w-full px-4 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-primary-50 dark:bg-primary-800/20 text-secondary-500 dark:text-secondary-400 cursor-not-allowed">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                            Bunny Video ID <span class="text-accent-500">*</span>
                        </label>
                        <input type="text" name="cdn_video_id" value="{{ old('cdn_video_id', $video->cdn_video_id) }}"
                               placeholder="contoh: a1b2c3d4"
                               class="w-full px-4 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 placeholder-secondary-400 focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200">
                        @error('cdn_video_id')
                            <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4 pt-4 border-t border-primary-100 dark:border-primary-800/30">
                    {{-- Delete --}}
                    <form action="{{ route('meetings.video.destroy', $meeting) }}" method="POST"
                          class="sweet-confirm" data-message="Yakin ingin menghapus video ini?">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-red-600 hover:bg-red-700 text-white font-medium transition-all duration-200 hover:shadow-lg hover:shadow-red-500/25 active:scale-[0.98]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Hapus Video
                        </button>
                    </form>

                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('meeting.show', $meeting) }}"
                           class="inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-xl border border-primary-200 dark:border-primary-700/50 text-secondary-600 dark:text-secondary-300 hover:bg-primary-50 dark:hover:bg-primary-800/20 transition-all duration-200 font-medium">
                            Batal
                        </a>
                        <button type="submit"
                                class="inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-xl bg-primary-600 hover:bg-primary-700 text-white font-medium transition-all duration-200 hover:shadow-lg hover:shadow-primary-500/25 active:scale-[0.98]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
