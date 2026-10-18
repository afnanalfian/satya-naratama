{{-- Dua kartu persentase: Akademik & Jasmani. Butuh: $summary --}}
@php
    $threshold = config('attendance.warning_threshold', 75);
    $fmtPct = fn ($v) => $v === null ? '–' : rtrim(rtrim(number_format($v, 1, ',', '.'), '0'), ',') . '%';
@endphp
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    @foreach(['akademik' => ['Akademik', 'bg-[#2a6fdb] dark:bg-[#4a8ae6]'], 'jasmani' => ['Jasmani', 'bg-[#c2570f] dark:bg-[#d96a26]']] as $type => [$label, $dot])
        @php $b = $summary[$type]; @endphp
        <div class="rounded-2xl border border-primary-100 dark:border-primary-800/30 bg-white dark:bg-primary-900/30 p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <p class="flex items-center gap-2 text-sm font-semibold text-primary-800 dark:text-primary-100">
                    <span class="w-2.5 h-2.5 rounded-full {{ $dot }}"></span> Kehadiran {{ $label }}
                </p>
                @if($b['pct'] !== null && $b['pct'] < $threshold)
                    <span class="text-[11px] font-semibold px-2 py-0.5 rounded-full bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300">Di bawah {{ $threshold }}%</span>
                @endif
            </div>
            <p class="mt-2 text-4xl font-bold tabular-nums text-primary-900 dark:text-white">{{ $fmtPct($b['pct']) }}</p>
            <p class="text-xs text-secondary-500 dark:text-secondary-400 mt-1">
                @if($b['done'])
                    Hadir {{ $b['hadir'] }} dari {{ $b['done'] }} pertemuan selesai
                @else
                    Belum ada pertemuan {{ strtolower($label) }} yang selesai
                @endif
            </p>
            @if($b['done'])
                <div class="mt-3 flex h-2 rounded-full overflow-hidden gap-[2px] bg-primary-50 dark:bg-primary-800/30">
                    @foreach(['hadir' => 'bg-emerald-500', 'izin' => 'bg-amber-400', 'sakit' => 'bg-sky-500', 'alpa' => 'bg-red-500'] as $k => $cls)
                        @if($b[$k] > 0)<div class="{{ $cls }}" style="width: {{ $b[$k] / $b['done'] * 100 }}%"></div>@endif
                    @endforeach
                </div>
                <div class="mt-2 flex flex-wrap gap-x-4 gap-y-1 text-xs text-secondary-600 dark:text-secondary-300">
                    <span class="inline-flex items-center gap-1"><span class="w-2 h-2 rounded-sm bg-emerald-500"></span>Hadir {{ $b['hadir'] }}</span>
                    <span class="inline-flex items-center gap-1"><span class="w-2 h-2 rounded-sm bg-amber-400"></span>Izin {{ $b['izin'] }}</span>
                    <span class="inline-flex items-center gap-1"><span class="w-2 h-2 rounded-sm bg-sky-500"></span>Sakit {{ $b['sakit'] }}</span>
                    <span class="inline-flex items-center gap-1"><span class="w-2 h-2 rounded-sm bg-red-500"></span>Alpa {{ $b['alpa'] }}</span>
                </div>
            @endif
        </div>
    @endforeach
</div>
