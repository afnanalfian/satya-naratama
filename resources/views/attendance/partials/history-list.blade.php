{{-- Daftar riwayat kehadiran. Butuh: $history (koleksi dari AttendanceService::studentHistory) --}}
@php
    $badge = [
        'hadir' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300',
        'izin'  => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-300',
        'sakit' => 'bg-sky-100 text-sky-700 dark:bg-sky-900/30 dark:text-sky-300',
        'alpa'  => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300',
    ];
@endphp
<ul class="divide-y divide-primary-100 dark:divide-primary-800/30">
    @forelse($history as $h)
        <li class="flex items-center gap-3 py-3">
            <div class="w-12 shrink-0 text-center">
                <p class="text-[10px] uppercase text-secondary-500 dark:text-secondary-400">{{ $h->meeting->scheduled_at->translatedFormat('M') }}</p>
                <p class="text-base font-bold leading-none text-primary-800 dark:text-primary-100">{{ $h->meeting->scheduled_at->format('d') }}</p>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-primary-800 dark:text-primary-100 truncate">{{ $h->meeting->title }}</p>
                <p class="text-xs text-secondary-500 dark:text-secondary-400 truncate">
                    <span class="{{ $h->meeting->course?->type === 'jasmani' ? 'text-[#c2570f] dark:text-[#d96a26]' : 'text-[#2a6fdb] dark:text-[#4a8ae6]' }} font-medium">{{ ucfirst($h->meeting->course?->type ?? 'akademik') }}</span>
                    · {{ $h->meeting->course?->name }}
                    @if($h->note) · <em>{{ $h->note }}</em>@endif
                </p>
            </div>
            <div class="text-right shrink-0">
                <span class="text-xs font-semibold px-2.5 py-1 rounded-full {{ $badge[$h->status] ?? $badge['alpa'] }}">{{ $h->label }}</span>
                @if($h->status === 'hadir' && $h->time)
                    <p class="text-[11px] text-secondary-500 dark:text-secondary-400 mt-1 tabular-nums">{{ $h->time->format('H:i') }}{{ $h->late ? ' · terlambat' : '' }}</p>
                @endif
            </div>
        </li>
    @empty
        <li class="py-10 text-center text-sm text-secondary-500 dark:text-secondary-400">Belum ada pertemuan yang selesai.</li>
    @endforelse
</ul>
