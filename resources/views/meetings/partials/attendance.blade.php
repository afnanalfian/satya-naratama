{{-- Ringkasan absensi pertemuan (admin & tentor) --}}
@php
    $c = $attendanceCounts ?? ['total' => 0, 'hadir' => 0, 'izin' => 0, 'sakit' => 0, 'alpa' => 0, 'unrecorded' => 0, 'pct' => 0];
@endphp
<div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 shadow-sm overflow-hidden">
    <div class="px-5 py-4 border-b border-primary-100 dark:border-primary-800/30 flex flex-wrap items-center justify-between gap-3">
        <div class="flex items-center gap-3">
            <div class="p-2 rounded-xl bg-primary-500/10 text-primary-600 dark:text-primary-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4h6v6H4zM14 4h6v6h-6zM4 14h6v6H4zM14 14h2v2h-2zM18 18h2v2h-2zM14 18h2M18 14h2"/>
                </svg>
            </div>
            <div>
                <h3 class="font-semibold text-primary-800 dark:text-primary-100">Absensi (Scan QR)</h3>
                <p class="text-xs text-secondary-500 dark:text-secondary-400">{{ $c['hadir'] }} dari {{ $c['total'] }} siswa hadir</p>
            </div>
        </div>
        <a href="{{ route('meeting.attendance.index', $meeting) }}"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium transition-all duration-200 hover:shadow-lg hover:shadow-primary-500/25 active:scale-[0.98]">
            @if($meeting->status === 'done')
                Lihat Absensi
            @else
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 9V5a2 2 0 012-2h4M15 3h4a2 2 0 012 2v4M21 15v4a2 2 0 01-2 2h-4M9 21H5a2 2 0 01-2-2v-4M7 12h10"/></svg>
                Buka Scanner
            @endif
        </a>
    </div>

    <div class="p-5">
        {{-- Progress --}}
        <div class="flex items-center justify-between text-xs mb-1.5">
            <span class="text-secondary-500 dark:text-secondary-400">Kehadiran</span>
            <span class="font-semibold text-primary-800 dark:text-primary-100">{{ rtrim(rtrim(number_format($c['pct'], 1, ',', '.'), '0'), ',') }}%</span>
        </div>
        <div class="h-2 rounded-full bg-primary-100 dark:bg-primary-800/40 overflow-hidden">
            <div class="h-full rounded-full bg-emerald-500" style="width: {{ min(100, $c['pct']) }}%"></div>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-5 gap-2 mt-4 text-center">
            @foreach([
                ['Hadir', $c['hadir'], 'text-emerald-600 dark:text-emerald-400'],
                ['Izin', $c['izin'], 'text-amber-600 dark:text-amber-400'],
                ['Sakit', $c['sakit'], 'text-amber-600 dark:text-amber-400'],
                ['Alpa', $c['alpa'], 'text-red-600 dark:text-red-400'],
                ['Belum', $c['unrecorded'], 'text-secondary-500 dark:text-secondary-400'],
            ] as [$label, $val, $cls])
                <div class="rounded-xl border border-primary-100 dark:border-primary-700/30 py-2.5">
                    <p class="text-lg font-bold {{ $cls }}">{{ $val }}</p>
                    <p class="text-[11px] uppercase tracking-wide text-secondary-500 dark:text-secondary-400">{{ $label }}</p>
                </div>
            @endforeach
        </div>
    </div>
</div>
