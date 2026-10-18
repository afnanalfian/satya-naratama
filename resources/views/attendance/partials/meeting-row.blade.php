{{-- Satu baris pertemuan di hub scan. Butuh: $m, $counts, $isAdmin --}}
@php
    $c = $counts[$m->id] ?? null;
    $isPast = $m->scheduled_at && $m->scheduled_at->lt(now()->startOfDay());
@endphp
<a href="{{ route('meeting.attendance.index', $m) }}"
   class="group flex flex-col sm:flex-row sm:items-center gap-3 px-5 py-4 hover:bg-primary-50/40 dark:hover:bg-primary-800/20 transition">
    <div class="flex items-center gap-4 flex-1 min-w-0">
        <div class="w-14 shrink-0 text-center rounded-xl border border-primary-100 dark:border-primary-700/40 py-1.5">
            <p class="text-[10px] uppercase text-secondary-500 dark:text-secondary-400">{{ $m->scheduled_at?->translatedFormat('M') }}</p>
            <p class="text-lg font-bold leading-none text-primary-800 dark:text-primary-100">{{ $m->scheduled_at?->format('d') }}</p>
            <p class="text-[10px] text-secondary-500 dark:text-secondary-400 mt-0.5">{{ $m->scheduled_at?->format('H:i') }}</p>
        </div>
        <div class="min-w-0">
            <div class="flex flex-wrap items-center gap-1.5 mb-0.5">
                <x-course-type-badge :type="$m->course?->type" size="xs" />
                @if($m->status === 'live')
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300">● LIVE</span>
                @elseif($m->status === 'done')
                    <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-secondary-100 text-secondary-700 dark:bg-secondary-900/30 dark:text-secondary-300">Selesai</span>
                @elseif($isPast)
                    <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300">Belum diselesaikan</span>
                @endif
            </div>
            <p class="font-semibold text-primary-800 dark:text-primary-100 truncate group-hover:text-primary-600 dark:group-hover:text-primary-300">{{ $m->title }}</p>
            <p class="text-xs text-secondary-500 dark:text-secondary-400 truncate">{{ $m->course?->name }}</p>
        </div>
    </div>
    @if($c)
        <div class="flex items-center gap-4 sm:w-56 shrink-0">
            <div class="flex-1">
                <div class="flex justify-between text-xs mb-1">
                    <span class="text-secondary-500 dark:text-secondary-400">{{ $c['hadir'] }}/{{ $c['total'] }} hadir</span>
                    <span class="font-semibold text-primary-800 dark:text-primary-100">{{ rtrim(rtrim(number_format($c['pct'], 1, ',', ''), '0'), ',') }}%</span>
                </div>
                <div class="h-1.5 rounded-full bg-primary-100 dark:bg-primary-800/40 overflow-hidden">
                    <div class="h-full bg-emerald-500 rounded-full" style="width: {{ min(100, $c['pct']) }}%"></div>
                </div>
            </div>
            <svg class="w-4 h-4 text-secondary-400 group-hover:text-primary-500 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </div>
    @endif
</a>
