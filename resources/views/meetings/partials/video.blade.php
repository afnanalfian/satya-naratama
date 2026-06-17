<x-toggle-section title="🎥 Rekaman Pembelajaran">

    @php
        $video = $meeting->video;
        $user  = auth()->user();
        $isAdminOrTentor = $user && $user->hasAnyRole(['admin', 'tentor']);
    @endphp

    {{-- No Video State --}}
    @if (!$video)
        <div class="mt-5 space-y-6">
            <div class="rounded-xl border border-gray-200 bg-gray-50 p-8 text-center dark:border-gray-700 dark:bg-gray-800/50">
                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-700">
                    <svg class="h-8 w-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Belum Ada Rekaman</h3>
                <p class="mb-6 text-sm text-gray-600 dark:text-gray-300 max-w-md mx-auto">
                    Rekaman pembelajaran untuk pertemuan ini belum diunggah. Tambahkan video untuk siswa dapat mengulang materi.
                </p>

                @if ($isAdminOrTentor)
                <a href="{{ route('meetings.video.create', $meeting) }}"
                   class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-3 text-sm font-medium text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Video
                </a>
                @endif
            </div>
        </div>

    {{-- Video Available --}}
    @else
        <div class="mt-5 space-y-6">
            {{-- Video Preview --}}
            <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800">
                {{-- Thumbnail/Preview Area --}}
                <div class="relative aspect-video bg-gray-900">
                    @if ($video->thumbnail)
                        <img src="{{ $video->thumbnail }}"
                             alt="Thumbnail video {{ $video->title }}"
                             loading="lazy"
                             class="h-full w-full object-cover">
                    @else
                        <div class="flex h-full w-full items-center justify-center bg-gray-800">
                            <div class="text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                                <p class="mt-2 text-sm text-gray-400">Thumbnail tidak tersedia</p>
                            </div>
                        </div>
                    @endif

                    {{-- Play Button Overlay --}}
                    <a href="{{ route('meetings.video.playback', $meeting) }}"
                       class="absolute inset-0 flex items-center justify-center bg-black/20 transition-colors hover:bg-black/30">
                        <div class="flex h-16 w-16 items-center justify-center rounded-full bg-white/90 shadow-lg transition-transform hover:scale-105">
                            <svg class="h-8 w-8 text-gray-900" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z" />
                            </svg>
                        </div>
                    </a>
                </div>

                {{-- Video Info --}}
                <div class="border-t border-gray-200 p-4 dark:border-gray-700 sm:p-6">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $video->title }}</h3>
                        <div class="mt-2 flex flex-wrap items-center gap-4">
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ $video->created_at->translatedFormat('d F Y') }}
                            </span>
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                                </svg>
                                {{ ucfirst($video->platform) }}
                            </span>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                        {{-- Watch Button --}}
                        <a href="{{ route('meetings.video.playback', $meeting) }}"
                           class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z" />
                            </svg>
                            Tonton Rekaman
                        </a>

                        {{-- Admin/Tentor Actions --}}
                        @if ($isAdminOrTentor)
                        <div class="flex flex-col gap-3 sm:flex-row">
                            {{-- Edit Button --}}
                            <a href="{{ route('meetings.video.edit', $meeting) }}"
                               class="inline-flex items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit Video
                            </a>

                            {{-- Delete Form --}}
                            <form method="POST"
                                  action="{{ route('meetings.video.destroy', $meeting) }}"
                                  class="sweet-confirm"
                                  data-message="Yakin ingin menghapus rekaman video ini? Tindakan ini tidak dapat dibatalkan.">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center justify-center gap-2 rounded-lg bg-red-600 px-4 py-2.5 text-sm font-medium text-white transition-colors hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Additional Info (Optional) --}}
            @if($video->description || $video->duration)
            <div class="rounded-xl border border-gray-200 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-800/50">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    @if($video->description)
                    <div>
                        <h4 class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-300">{{ $video->description }}</p>
                    </div>
                    @endif

                    @if($video->duration)
                    <div>
                        <h4 class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Informasi Video</h4>
                        <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Durasi: {{ $video->duration }}</span>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
    @endif

</x-toggle-section>
