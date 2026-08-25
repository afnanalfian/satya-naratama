<x-toggle-section title="📚 Materi">

    @if(!$meeting->material)
        <div class="mt-5 rounded-2xl border border-primary-200 dark:border-primary-700/30 bg-primary-50/30 dark:bg-primary-800/20 p-8 text-center">
            <div class="mx-auto max-w-sm">
                <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-primary-100 dark:bg-primary-800/40">
                    <svg class="h-7 w-7 text-primary-400 dark:text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h3 class="mb-2 text-base font-semibold text-primary-800 dark:text-primary-100">Belum Ada Materi</h3>
                <p class="mb-5 text-sm text-secondary-500 dark:text-secondary-400 max-w-xs mx-auto">Materi pembelajaran untuk pertemuan ini belum diunggah.</p>

                @role('admin|tentor')
                <form method="POST" action="{{ route('meeting.material.store', $meeting) }}" enctype="multipart/form-data" class="space-y-3">
                    @csrf
                    <div class="flex flex-col sm:flex-row items-center gap-3 justify-center">
                        <div class="relative w-full sm:w-auto">
                            <input type="file" name="material" id="material-upload" accept="application/pdf" required
                                   class="peer absolute inset-0 z-10 w-full cursor-pointer opacity-0">
                            <label for="material-upload"
                                   class="flex cursor-pointer items-center gap-2 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 px-4 py-2.5 text-sm text-secondary-600 dark:text-secondary-300 transition-colors hover:bg-primary-50 dark:hover:bg-primary-800/20 peer-hover:bg-primary-50 dark:peer-hover:bg-primary-800/20">
                                <svg class="h-4 w-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                </svg>
                                <span>Pilih File PDF</span>
                                <span class="text-xs text-secondary-400">(max 10MB)</span>
                            </label>
                        </div>
                        <button type="submit"
                                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium transition-all duration-200 hover:shadow-lg hover:shadow-primary-500/25 active:scale-[0.98]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/>
                            </svg>
                            Upload
                        </button>
                    </div>
                </form>
                @endrole
            </div>
        </div>
    @else
        <div class="mt-5 space-y-4">
            {{-- Preview --}}
            <div class="rounded-xl border border-primary-100 dark:border-primary-700/30 bg-white dark:bg-primary-800/20 overflow-hidden">
                <div class="border-b border-primary-100 dark:border-primary-700/30 px-4 py-3 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span class="text-sm font-medium text-primary-700 dark:text-primary-300">Materi PDF</span>
                    </div>
                    <a href="{{ asset('storage/'.$meeting->material->file_path) }}"
                       target="_blank"
                       class="inline-flex items-center gap-1.5 text-sm font-medium text-primary-600 hover:text-primary-700 dark:text-primary-400 dark:hover:text-primary-300 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        Download
                    </a>
                </div>
                <div class="p-2">
                    <iframe src="{{ asset('storage/'.$meeting->material->file_path) }}"
                            class="w-full h-[300px] sm:h-[400px] rounded-lg"
                            title="Materi PDF - {{ $meeting->title }}">
                    </iframe>
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ asset('storage/'.$meeting->material->file_path) }}"
                   target="_blank"
                   class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-primary-200 dark:border-primary-700/50 text-secondary-600 dark:text-secondary-300 hover:bg-primary-50 dark:hover:bg-primary-800/20 transition-all duration-200 text-sm font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    Buka File PDF
                </a>

                @role('admin|tentor')
                <div class="flex flex-wrap gap-2">
                    <form method="POST" action="{{ route('meeting.material.store', $meeting) }}" enctype="multipart/form-data" class="inline-flex">
                        @csrf
                        <div class="relative">
                            <input type="file" name="material" id="replace-material" accept="application/pdf" required
                                   class="peer absolute inset-0 z-10 w-full cursor-pointer opacity-0">
                            <label for="replace-material"
                                   class="inline-flex cursor-pointer items-center gap-2 px-4 py-2.5 rounded-xl border border-primary-200 dark:border-primary-700/50 text-secondary-600 dark:text-secondary-300 hover:bg-primary-50 dark:hover:bg-primary-800/20 transition-all duration-200 text-sm font-medium peer-hover:bg-primary-50 dark:peer-hover:bg-primary-800/20">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L4 8m4-4v12"/>
                                </svg>
                                Ganti File
                            </label>
                        </div>
                        <button type="submit"
                                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium transition-all duration-200 hover:shadow-lg hover:shadow-primary-500/25 active:scale-[0.98]">
                            Upload
                        </button>
                    </form>

                    <form method="POST" action="{{ route('meeting.material.destroy', $meeting) }}"
                          class="sweet-confirm" data-message="Yakin ingin menghapus materi ini?">
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
                @endrole
            </div>
        </div>
    @endif

</x-toggle-section>
