<x-toggle-section title="🎥 Rekaman Pembelajaran">

    @php
        $video = $meeting->video;
        $user = auth()->user();
        $isAdminOrTentor = $user && $user->hasAnyRole(['admin', 'tentor']);
    @endphp

    @if (!$video)
        <div class="mt-5 rounded-2xl border border-primary-200 dark:border-primary-700/30 bg-primary-50/30 dark:bg-primary-800/20 p-8 text-center">
            <div class="mx-auto max-w-sm">
                <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-primary-100 dark:bg-primary-800/40">
                    <svg class="h-7 w-7 text-primary-400 dark:text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="mb-2 text-base font-semibold text-primary-800 dark:text-primary-100">Belum Ada Rekaman</h3>
                <p class="mb-5 text-sm text-secondary-500 dark:text-secondary-400">Rekaman pembelajaran untuk pertemuan ini belum diunggah.</p>

                @if ($isAdminOrTentor)
                <a href="{{ route('meetings.video.create', $meeting) }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium transition-all duration-200 hover:shadow-lg hover:shadow-primary-500/25 active:scale-[0.98]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Video
                </a>
                @endif
            </div>
        </div>
    @else
        <div class="mt-5 space-y-4">
            {{-- Video Player Preview --}}
            <div class="rounded-xl border border-primary-100 dark:border-primary-700/30 bg-black/5 dark:bg-black/20 overflow-hidden">
                <div class="relative aspect-video bg-gray-900">
                    <iframe src="{{ $video->embed_url }}"
                            class="absolute inset-0 w-full h-full"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                    </iframe>
                </div>
                <div class="px-4 py-3 border-t border-primary-100 dark:border-primary-700/30 flex flex-wrap items-center justify-between gap-2">
                    <div>
                        <p class="text-sm font-medium text-primary-800 dark:text-primary-100">{{ $video->title }}</p>
                        <div class="flex items-center gap-3 mt-0.5 text-xs text-secondary-500 dark:text-secondary-400">
                            <span class="inline-flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ $video->created_at->translatedFormat('d F Y') }}
                            </span>
                            <span class="inline-flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                                </svg>
                                {{ ucfirst($video->platform) }}
                            </span>
                        </div>
                    </div>
                    <a href="{{ route('meetings.video.playback', $meeting) }}"
                       class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium transition-all duration-200 hover:shadow-lg hover:shadow-primary-500/25 active:scale-[0.98]">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                        Tonton
                    </a>
                </div>
            </div>

            {{-- Actions --}}
            @if ($isAdminOrTentor)
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('meetings.video.edit', $meeting) }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-primary-200 dark:border-primary-700/50 text-secondary-600 dark:text-secondary-300 hover:bg-primary-50 dark:hover:bg-primary-800/20 transition-all duration-200 text-sm font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit Video
                </a>

                <form method="POST" action="{{ route('meetings.video.destroy', $meeting) }}"
                      class="sweet-confirm" data-message="Yakin ingin menghapus rekaman video ini?">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-red-50 text-red-600 hover:bg-red-100 dark:bg-red-900/20 dark:text-red-400 dark:hover:bg-red-900/30 text-sm font-medium transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Hapus
                    </button>
                </form>
            </div>
            @endif
        </div>
    @endif

</x-toggle-section>
