<x-layouts.app title="Dashboard Tentor">
@php $hour = now()->hour; $greet = $hour < 11 ? 'Selamat pagi' : ($hour < 15 ? 'Selamat siang' : ($hour < 18 ? 'Selamat sore' : 'Selamat malam')); @endphp
<div class="card-ink mb-6 p-6 sm:p-8">
    <div class="absolute inset-0 bg-grid-ink [background-size:30px_30px]"></div>
    <div class="blob -right-10 -top-10 h-56 w-56 bg-garnet-600/50"></div>
    <div class="relative flex flex-col gap-5 md:flex-row md:items-center md:justify-between">
        <div>
            <p class="text-sm font-semibold text-saffron-300">{{ $greet }}, Kak {{ auth()->user()->name }} 👋</p>
            <h1 class="mt-1 font-display text-3xl font-extrabold">Siap mengajar hari ini?</h1>
            <p class="mt-2 text-sm text-ink-300">{{ $totalAttendance }} kehadiran tercatat pada pertemuan minggu ini.</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('attendance.hub') }}" class="btn-gold"><x-icon name="scan" class="h-4 w-4"/> Scan presensi</a>
            <a href="{{ route('course.index') }}" class="btn bg-white/10 text-white hover:bg-white/20"><x-icon name="book" class="h-4 w-4"/> Kelas</a>
        </div>
    </div>
</div>
<div class="grid grid-cols-2 gap-4 lg:grid-cols-4">
    <x-stat label="Kelas diampu" :value="$stats['total_courses']" icon="book" tone="garnet"/>
    <x-stat label="Pertemuan dibuat" :value="$stats['total_meetings']" icon="calendar" tone="gold"/>
    <x-stat label="Sedang live" :value="$stats['live_meetings']" icon="video" tone="sky"/>
    <x-stat label="Selesai" :value="$stats['done_meetings']" icon="check-circle" tone="lagoon"/>
</div>
<div class="mt-6 grid gap-6 lg:grid-cols-3">
    <div class="card card-pad lg:col-span-2">
        <p class="section-title">Pertemuan minggu ini</p>
        <div class="mt-4 space-y-2">
            @forelse($weeklyMeetings as $m)
                <a href="{{ route('meeting.show', $m) }}" class="flex items-center gap-4 rounded-2xl border border-ink-50 p-3 hover:bg-cream">
                    <div class="grid h-12 w-12 shrink-0 place-items-center rounded-2xl {{ $m->status === 'live' ? 'bg-garnet-600 text-white' : 'bg-ink-50' }} text-center"><div><p class="text-[10px] font-bold uppercase">{{ $m->scheduled_at->translatedFormat('D') }}</p><p class="font-display text-lg font-extrabold leading-none">{{ $m->scheduled_at->format('d') }}</p></div></div>
                    <div class="min-w-0 flex-1"><p class="truncate font-bold">{{ $m->title }}</p><p class="text-xs text-ink-400">{{ $m->course?->name }} · {{ $m->scheduled_at->format('H:i') }}</p></div>
                    <x-status-badge :status="$m->status"/>
                </a>
            @empty
                <x-empty icon="calendar" title="Tidak ada pertemuan minggu ini"/>
            @endforelse
        </div>
    </div>
    <div class="space-y-6">
        <div class="card card-pad">
            <p class="section-title">7 hari ke depan</p>
            <div class="mt-3 space-y-2">
                @forelse($upcomingMeetings as $m)
                    <a href="{{ route('meeting.show', $m) }}" class="block rounded-2xl bg-cream p-3 hover:bg-saffron-50"><p class="truncate text-sm font-bold">{{ $m->title }}</p><p class="text-xs text-ink-400">{{ $m->scheduled_at->translatedFormat('l, d M · H:i') }}</p></a>
                @empty
                    <p class="text-sm text-ink-400">Belum ada jadwal.</p>
                @endforelse
            </div>
        </div>
        <div class="card card-pad">
            <p class="section-title">Kehadiran terbaru</p>
            <div class="mt-3 space-y-2">
                @forelse($recentStudents as $s)
                    <div class="flex items-center justify-between gap-2 text-sm"><span class="truncate font-semibold">{{ $s->name }}</span><span class="shrink-0 text-xs text-ink-400">{{ \Carbon\Carbon::parse($s->attended_at)->diffForHumans() }}</span></div>
                @empty
                    <p class="text-sm text-ink-400">Belum ada data.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@if($coursesTaught->count())
<div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
    @foreach($coursesTaught as $c)
        <a href="{{ route('course.show', $c->slug) }}" class="card card-hover p-5"><x-course-type-badge :type="$c->type"/><p class="mt-3 font-display font-bold">{{ $c->name }}</p><p class="text-xs text-ink-400">{{ $c->meetings_count }} pertemuan oleh Anda</p></a>
    @endforeach
</div>
@endif
</x-layouts.app>
