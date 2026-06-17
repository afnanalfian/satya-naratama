<div class="rounded-xl border border-gray-200 bg-azwara-lightest p-6 shadow-sm dark:border-gray-700 dark:bg-azwara-darker">
    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
        {{-- Left Content --}}
        <div class="min-w-0 flex-1">
            <div class="flex items-start justify-between gap-4 lg:items-center">
                <div>
                    <h1 class="text-xl font-bold text-gray-900 dark:text-white sm:text-2xl">
                        {{ $meeting->title }}
                    </h1>
                    <div class="mt-1 flex flex-col gap-2 sm:flex-row sm:items-center sm:gap-4">
                        <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300">
                            <svg class="h-4 w-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>{{ $meeting->scheduled_at->translatedFormat('l, d F Y') }}</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300">
                            <svg class="h-4 w-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ $meeting->scheduled_at->format('H:i') }} WIB</span>
                        </div>
                    </div>
                </div>

                {{-- Status Badge Mobile --}}
                <div class="block lg:hidden">
                    <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1.5 text-xs font-semibold
                        @if($meeting->status === 'live')
                            bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300
                        @elseif($meeting->status === 'upcoming')
                            bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300
                        @else
                            bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-300
                        @endif">
                        @if($meeting->status === 'live')
                            <svg class="h-2 w-2 animate-pulse" fill="currentColor" viewBox="0 0 8 8">
                                <circle cx="4" cy="4" r="4" />
                            </svg>
                        @endif
                        {{ ucfirst($meeting->status) }}
                    </span>
                </div>
            </div>

            {{-- Status Badge Desktop --}}
            <div class="mt-3 hidden lg:block">
                <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1.5 text-xs font-semibold
                    @if($meeting->status === 'live')
                        bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300
                    @elseif($meeting->status === 'upcoming')
                        bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300
                    @else
                        bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-300
                    @endif">
                    @if($meeting->status === 'live')
                        <svg class="h-2 w-2 animate-pulse" fill="currentColor" viewBox="0 0 8 8">
                            <circle cx="4" cy="4" r="4" />
                        </svg>
                    @endif
                    {{ ucfirst($meeting->status) }}
                </span>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex flex-col gap-2 sm:flex-row lg:w-auto lg:flex-col lg:gap-2 xl:flex-row xl:gap-2">
            {{-- Admin Edit Button --}}
            @role('admin')
            <a href="{{ route('meeting.edit', $meeting) }}"
               class="inline-flex items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600 dark:focus:ring-offset-gray-900">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Edit
            </a>
            @endrole

            {{-- Zoom Button --}}
            @if($meeting->status !== 'done')
                @if($meeting->zoom_link)
                <a href="{{ route('meeting.joinZoom', $meeting) }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="inline-flex items-center justify-center gap-2 rounded-lg bg-green-600 px-4 py-2.5 text-sm font-medium text-white transition-colors hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                    </svg>
                    Join Zoom
                </a>
                @else
                <button disabled
                        class="inline-flex items-center justify-center gap-2 rounded-lg bg-gray-300 px-4 py-2.5 text-sm font-medium text-gray-500 cursor-not-allowed dark:bg-gray-700 dark:text-gray-400">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    Belum Ada Link
                </button>
                @endif
            @endif

            {{-- Admin Delete Button --}}
            @role('admin')
            <form method="POST"
                  action="{{ route('meeting.destroy', $meeting) }}"
                  class="sweet-confirm"
                  data-message="Yakin ingin menghapus pertemuan ini?">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-red-600 px-4 py-2.5 text-sm font-medium text-white transition-colors hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900 sm:w-auto">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Hapus
                </button>
            </form>
            @endrole
        </div>
    </div>
</div>
