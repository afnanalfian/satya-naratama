<x-toggle-section title="📝 Absensi">

    @if($meeting->attendances->isEmpty())
        <div class="mt-5 rounded-2xl border border-primary-200 dark:border-primary-700/30 bg-primary-50/30 dark:bg-primary-800/20 p-8 text-center">
            <div class="mx-auto max-w-sm">
                <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-primary-100 dark:bg-primary-800/40">
                    <svg class="h-7 w-7 text-primary-400 dark:text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <h3 class="mb-2 text-base font-semibold text-primary-800 dark:text-primary-100">Belum Ada Absensi</h3>
                <p class="mb-5 text-sm text-secondary-500 dark:text-secondary-400">Absensi belum dibuat untuk pertemuan ini.</p>
                <a href="{{ route('meeting.attendance.index', $meeting) }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium transition-all duration-200 hover:shadow-lg hover:shadow-primary-500/25 active:scale-[0.98]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Buat Absensi
                </a>
            </div>
        </div>
    @else
        @php
            $hadir = $meeting->attendances->where('is_present', true);
            $total = $meeting->attendances->count();
            $percentage = $total > 0 ? round(($hadir->count() / $total) * 100) : 0;
        @endphp

        <div class="mt-5 space-y-5">
            {{-- Stats --}}
            <div class="grid grid-cols-3 gap-3">
                <div class="rounded-xl border border-primary-100 dark:border-primary-700/30 bg-white dark:bg-primary-800/20 p-4">
                    <p class="text-xs text-secondary-500 dark:text-secondary-400 uppercase tracking-wider">Hadir</p>
                    <p class="mt-1 text-2xl font-bold text-emerald-600 dark:text-emerald-400">{{ $hadir->count() }}</p>
                </div>
                <div class="rounded-xl border border-primary-100 dark:border-primary-700/30 bg-white dark:bg-primary-800/20 p-4">
                    <p class="text-xs text-secondary-500 dark:text-secondary-400 uppercase tracking-wider">Total Siswa</p>
                    <p class="mt-1 text-2xl font-bold text-primary-600 dark:text-primary-400">{{ $total }}</p>
                </div>
                <div class="rounded-xl border border-primary-100 dark:border-primary-700/30 bg-white dark:bg-primary-800/20 p-4">
                    <p class="text-xs text-secondary-500 dark:text-secondary-400 uppercase tracking-wider">Persentase</p>
                    <p class="mt-1 text-2xl font-bold text-gold-600 dark:text-gold-400">{{ $percentage }}%</p>
                </div>
            </div>

            {{-- List --}}
            @if($hadir->isNotEmpty())
            <div class="rounded-xl border border-primary-100 dark:border-primary-700/30 bg-white dark:bg-primary-800/20 overflow-hidden">
                <div class="border-b border-primary-100 dark:border-primary-700/30 px-4 py-3">
                    <h4 class="text-sm font-medium text-primary-700 dark:text-primary-300">Siswa Hadir</h4>
                </div>
                <div class="divide-y divide-primary-100 dark:divide-primary-700/30 max-h-48 overflow-y-auto">
                    @foreach($hadir as $att)
                    <div class="flex items-center justify-between px-4 py-2.5 hover:bg-primary-50/50 dark:hover:bg-primary-800/20 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="flex h-8 w-8 items-center justify-center rounded-full bg-emerald-100 text-xs font-medium text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300">
                                {{ substr($att->user->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="text-sm font-medium text-primary-800 dark:text-primary-100">{{ $att->user->name }}</p>
                                @if($att->check_in_time)
                                    <p class="text-xs text-secondary-500 dark:text-secondary-400">Hadir {{ \Carbon\Carbon::parse($att->check_in_time)->format('H:i') }}</p>
                                @endif
                            </div>
                        </div>
                        <span class="inline-flex items-center gap-1 rounded-full bg-emerald-100 px-2 py-0.5 text-xs font-medium text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300">
                            <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            Hadir
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>
            @else
            <div class="rounded-xl border border-primary-100 dark:border-primary-700/30 bg-white dark:bg-primary-800/20 p-6 text-center">
                <p class="text-sm text-secondary-500 dark:text-secondary-400">Belum ada siswa yang hadir</p>
            </div>
            @endif

            {{-- Action --}}
            <div class="flex justify-end">
                <a href="{{ route('meeting.attendance.index', $meeting) }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-primary-200 dark:border-primary-700/50 text-secondary-600 dark:text-secondary-300 hover:bg-primary-50 dark:hover:bg-primary-800/20 transition-all duration-200 text-sm font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Kelola Absensi
                </a>
            </div>
        </div>
    @endif

</x-toggle-section>
