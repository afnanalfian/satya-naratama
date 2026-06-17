@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto space-y-6" x-data="{ source: '{{ old('source', 'youtube') }}' }">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
                Tambah Rekaman Pembelajaran
            </h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Meeting:
                <span class="font-medium">{{ $meeting->title }}</span>
            </p>
        </div>

        {{-- Back --}}
        <a
            href="{{ route('meeting.show', $meeting) }}"
            class="inline-flex items-center gap-2
                   px-4 py-2 rounded-lg
                   bg-gray-200 dark:bg-gray-700
                   text-gray-800 dark:text-gray-200
                   hover:bg-gray-300 dark:hover:bg-gray-600">
            ← Kembali
        </a>
    </div>

    {{-- Card --}}
    <div
        class="bg-white/80 dark:bg-gray-800/80
               backdrop-blur
               rounded-2xl shadow-lg
               p-6 space-y-6">

        {{-- Info --}}
        <div class="space-y-1">
            <p class="text-sm text-gray-700 dark:text-gray-300">
                Pilih platform video rekaman yang akan digunakan.
            </p>
        </div>

        {{-- Form --}}
        <form
            action="{{ route('meetings.video.store', $meeting) }}"
            method="POST"
            class="space-y-6">

            @csrf

            {{-- Title --}}
            <div>
                <label
                    for="title"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Judul Video
                </label>

                <input
                    type="text"
                    name="title"
                    id="title"
                    value="{{ old('title', $meeting->title) }}"
                    required
                    class="block w-full rounded-lg
                           border-gray-300 dark:border-gray-600
                           dark:bg-gray-700 dark:text-gray-200
                           focus:ring-primary focus:border-primary">

                @error('title')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Platform Selector --}}
            <div>
                <label
                    for="source"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Platform Video
                </label>

                <select
                    name="source"
                    id="source"
                    x-model="source"
                    class="block w-full rounded-lg
                           border-gray-300 dark:border-gray-600
                           dark:bg-gray-700 dark:text-gray-200
                           focus:ring-primary focus:border-primary">

                    <option value="youtube">YouTube</option>
                    <option value="cdn">Bunny.net</option>
                </select>

                @error('source')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- =========================
                YOUTUBE MODE
            ========================== --}}
            <div x-show="source === 'youtube'" x-cloak>
                <label
                    for="youtube_video_id"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    YouTube Video ID
                </label>

                <input
                    type="text"
                    name="youtube_video_id"
                    id="youtube_video_id"
                    value="{{ old('youtube_video_id') }}"
                    placeholder="contoh: dQw4w9WgXcQ"
                    class="block w-full rounded-lg
                           border-gray-300 dark:border-gray-600
                           dark:bg-gray-700 dark:text-gray-200
                           focus:ring-primary focus:border-primary">

                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                    Contoh URL:
                    <code class="px-1 rounded bg-gray-100 dark:bg-gray-700">
                        https://www.youtube.com/watch?v=dQw4w9WgXcQ
                    </code>
                </p>

                @error('youtube_video_id')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- =========================
                BUNNY MODE
            ========================== --}}
            <div x-show="source === 'cdn'" x-cloak>
                <label
                    for="cdn_video_id"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Bunny Video ID
                </label>

                <input
                    type="text"
                    name="cdn_video_id"
                    id="cdn_video_id"
                    value="{{ old('cdn_video_id') }}"
                    placeholder="contoh: a1b2c3d4"
                    class="block w-full rounded-lg
                           border-gray-300 dark:border-gray-600
                           dark:bg-gray-700 dark:text-gray-200
                           focus:ring-primary focus:border-primary">

                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                    Video harus sudah di-upload di Bunny Video Library.
                </p>

                @error('cdn_video_id')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Actions --}}
            <div
                class="flex justify-end gap-3 pt-4
                       border-t border-gray-200 dark:border-gray-700">

                <a
                    href="{{ route('meeting.show', $meeting) }}"
                    class="px-4 py-2 rounded-lg
                           bg-gray-200 dark:bg-gray-700
                           text-gray-800 dark:text-gray-200
                           hover:bg-gray-300 dark:hover:bg-gray-600">
                    Batal
                </a>

                <button
                    type="submit"
                    class="px-6 py-2 rounded-lg
                           bg-primary text-white
                           hover:bg-primary/90">
                    Simpan Video
                </button>

            </div>

        </form>

    </div>
</div>

@endsection
