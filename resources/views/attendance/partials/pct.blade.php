{{-- Bar persentase kehadiran. Butuh: $b (bucket: done, hadir, pct), opsional $threshold --}}
@php
    $threshold = $threshold ?? config('attendance.warning_threshold', 75);
    $pct = $b['pct'];
    $bar = $pct === null ? 'bg-primary-200' : ($pct >= $threshold ? 'bg-emerald-500' : ($pct >= $threshold - 20 ? 'bg-amber-500' : 'bg-red-500'));
@endphp
@if($pct === null)
    <span class="text-xs text-secondary-400 dark:text-secondary-500">Belum ada pertemuan</span>
@else
    <div class="min-w-[120px]">
        <div class="flex items-baseline justify-between gap-2">
            <span class="text-sm font-semibold tabular-nums {{ $pct < $threshold ? 'text-red-600 dark:text-red-400' : 'text-primary-800 dark:text-primary-100' }}">
                {{ rtrim(rtrim(number_format($pct, 1, ',', ''), '0'), ',') }}%
            </span>
            <span class="text-[11px] text-secondary-500 dark:text-secondary-400 tabular-nums">{{ $b['hadir'] }}/{{ $b['done'] }}</span>
        </div>
        <div class="mt-1 h-1.5 rounded-full bg-primary-100 dark:bg-primary-800/40 overflow-hidden">
            <div class="h-full rounded-full {{ $bar }}" style="width: {{ min(100, $pct) }}%"></div>
        </div>
    </div>
@endif
