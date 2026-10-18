{{-- Status kehadiran siswa yang sedang login --}}
@php
    $st = $myAttendance?->status;
    $tone = match($st) {
        'hadir' => 'border-emerald-200 bg-emerald-50 text-emerald-800 dark:border-emerald-800/40 dark:bg-emerald-900/20 dark:text-emerald-200',
        'izin', 'sakit' => 'border-amber-200 bg-amber-50 text-amber-800 dark:border-amber-800/40 dark:bg-amber-900/20 dark:text-amber-200',
        'alpa' => 'border-red-200 bg-red-50 text-red-800 dark:border-red-800/40 dark:bg-red-900/20 dark:text-red-200',
        default => 'border-primary-200 bg-white text-primary-800 dark:border-primary-700/40 dark:bg-primary-900/30 dark:text-primary-100',
    };
@endphp
<div class="mt-6 rounded-2xl border px-5 py-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 {{ $tone }}">
    <div class="flex items-center gap-3">
        <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 4h6v6H4zM14 4h6v6h-6zM4 14h6v6H4zM14 14h2v2h-2zM18 18h2v2h-2zM14 18h2M18 14h2"/>
        </svg>
        <div>
            <p class="text-sm font-semibold">
                @if($st)
                    Kehadiran Anda: {{ $myAttendance->status_label }}
                    @if($st === 'hadir' && $myAttendance->marked_at)
                        · {{ $myAttendance->marked_at->format('H:i') }} WIB
                        @if($myAttendance->is_late) <span class="font-normal">(terlambat)</span> @endif
                    @endif
                @elseif($meeting->status === 'done')
                    Kehadiran Anda belum tercatat pada pertemuan ini
                @else
                    Tunjukkan QR Anda ke tentor untuk absensi
                @endif
            </p>
            @if($myAttendance?->note)
                <p class="text-xs opacity-80 mt-0.5">{{ $myAttendance->note }}</p>
            @endif
        </div>
    </div>
    @if($st !== 'hadir' && $meeting->status !== 'done')
        <a href="{{ route('attendance.my-qr') }}"
           class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium transition">
            Buka QR Saya
        </a>
    @endif
</div>
