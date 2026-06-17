<x-toggle-section title="📚 Materi">

    @if(!$meeting->material)
        {{-- No Material State --}}
        <div class="mt-5 space-y-6">
            <div class="rounded-xl border border-gray-200 bg-gray-50 p-8 text-center dark:border-gray-700 dark:bg-gray-800/50">
                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-700">
                    <svg class="h-8 w-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Belum Ada Materi</h3>
                <p class="mb-6 text-sm text-gray-600 dark:text-gray-300 max-w-md mx-auto">
                    Materi pembelajaran untuk pertemuan ini belum diunggah. Unggah file PDF untuk memulai.
                </p>

                @role('admin|tentor')
                <form method="POST"
                      action="{{ route('meeting.material.store', $meeting) }}"
                      enctype="multipart/form-data"
                      class="mx-auto max-w-md space-y-4">
                    @csrf

                    <div class="relative">
                        <input type="file"
                               name="material"
                               id="material-upload"
                               accept="application/pdf"
                               required
                               class="peer absolute inset-0 z-10 w-full cursor-pointer opacity-0">
                        <label for="material-upload"
                               class="flex cursor-pointer items-center justify-between rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 transition-colors hover:bg-gray-50 peer-hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                            <span class="flex items-center gap-2">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                Pilih File PDF
                            </span>
                            <span class="text-xs text-gray-500 dark:text-gray-400">Max: 10MB</span>
                        </label>
                    </div>

                    <button type="submit"
                            class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-3 text-sm font-medium text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                        </svg>
                        Upload Materi
                    </button>
                </form>
                @endrole
            </div>
        </div>
    @else
        {{-- Material Preview & Actions --}}
        <div class="mt-5 space-y-6">
            {{-- Mobile View --}}
            <div class="sm:hidden rounded-xl border border-gray-200 bg-white p-4 dark:border-gray-700 dark:bg-gray-800">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-red-100 dark:bg-red-900/30">
                            <svg class="h-5 w-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-900 dark:text-white">Materi PDF</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Klik untuk membuka</p>
                        </div>
                    </div>
                    <a href="{{ asset('storage/'.$meeting->material->file_path) }}"
                       target="_blank"
                       class="inline-flex items-center gap-1 rounded-lg bg-blue-600 px-3 py-2 text-xs font-medium text-white transition-colors hover:bg-blue-700">
                        <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                        Buka
                    </a>
                </div>
            </div>

            {{-- Desktop Preview --}}
            <div class="hidden sm:block overflow-hidden rounded-xl border border-gray-200 dark:border-gray-700">
                <div class="border-b border-gray-200 bg-gray-50 px-4 py-3 dark:border-gray-700 dark:bg-gray-800">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">Pratinjau Materi</span>
                        </div>
                        <a href="{{ asset('storage/'.$meeting->material->file_path) }}"
                           target="_blank"
                           class="inline-flex items-center gap-1 rounded-lg bg-gray-200 px-3 py-1.5 text-xs font-medium text-gray-700 transition-colors hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Download
                        </a>
                    </div>
                </div>
                <iframe src="{{ asset('storage/'.$meeting->material->file_path) }}"
                        class="h-[500px] w-full"
                        title="Materi PDF - {{ $meeting->title }}">
                </iframe>
            </div>

            {{-- Actions --}}
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                {{-- Open File Button (Mobile) --}}
                <a href="{{ asset('storage/'.$meeting->material->file_path) }}"
                   target="_blank"
                   class="inline-flex items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 sm:hidden dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                    Buka File PDF
                </a>

                {{-- Admin/Tentor Actions --}}
                @role('admin|tentor')
                <div class="flex flex-col gap-3 sm:flex-row">
                    {{-- Replace Material Form --}}
                    <form method="POST"
                          action="{{ route('meeting.material.store', $meeting) }}"
                          enctype="multipart/form-data"
                          class="flex flex-col gap-3 sm:flex-row">
                        @csrf

                        <div class="relative flex-1">
                            <input type="file"
                                   name="material"
                                   id="replace-material"
                                   accept="application/pdf"
                                   required
                                   class="peer absolute inset-0 z-10 w-full cursor-pointer opacity-0">
                            <label for="replace-material"
                                   class="flex cursor-pointer items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 peer-hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L4 8m4-4v12" />
                                </svg>
                                Ganti File
                            </label>
                        </div>

                        <button type="submit"
                                class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M5 13l4 4L19 7" />
                            </svg>
                            Upload
                        </button>
                    </form>

                    {{-- Delete Form --}}
                    <form method="POST"
                          action="{{ route('meeting.material.destroy', $meeting) }}"
                          class="sweet-confirm"
                          data-message="Yakin ingin menghapus materi ini?">
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
                @endrole
            </div>
        </div>
    @endif

</x-toggle-section>
