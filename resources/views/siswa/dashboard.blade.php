<x-layouts.app title="Dashboard">
@php $u = auth()->user(); $hour = now()->hour; $greet = $hour < 11 ? 'Selamat pagi' : ($hour < 15 ? 'Selamat siang' : ($hour < 18 ? 'Selamat sore' : 'Selamat malam')); $live = $weeklyMeetings->firstWhere('status', 'live'); @endphp
<div class="grid gap-6">
    <div class="card-sunrise p-6 sm:p-8">
        <div class="absolute -right-12 -top-12 h-56 w-56 animate-spin-slow rounded-full border-[28px] border-white/15"></div>
        <div class="relative">
            <p class="text-sm font-semibold text-white/85">{{ $greet }} 👋</p>
            <h1 class="mt-1 font-display text-3xl font-extrabold sm:text-4xl">{{ \Illuminate\Support\Str::of($u->display_name)->explode(' ')->first() }}, siap latihan hari ini?</h1>
            <p class="mt-2 max-w-lg text-sm text-white/85">Konsisten sedikit setiap hari lebih baik daripada banyak sekali-sekali. Cek jadwal & kuis harianmu di bawah.</p>
            <div class="mt-6 flex flex-wrap gap-2">
                @if($live)
                    <a href="{{ route('meeting.show', $live) }}" class="btn bg-white text-garnet-700 hover:bg-cream"><span class="relative flex h-2 w-2"><span class="absolute h-2 w-2 animate-ping rounded-full bg-garnet-500"></span><span class="h-2 w-2 rounded-full bg-garnet-600"></span></span> Kelas sedang live</a>
                @endif
                <a href="{{ route('attendance.my-qr') }}" class="btn bg-ink-950/90 text-white hover:bg-ink-950"><x-icon name="qr" class="h-4 w-4"/> QR Presensi</a>
                <a href="{{ route('tryouts.index') }}" class="btn bg-white/15 text-white ring-1 ring-white/30 hover:bg-white/25"><x-icon name="trophy" class="h-4 w-4"/> Tryout</a>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-2 gap-4 lg:grid-cols-4">
        <x-stat label="Kelas" :value="$stats['total_course']" icon="book" tone="garnet"/>
        <x-stat label="Pertemuan" :value="$stats['total_meeting']" icon="calendar" tone="gold"/>
        <x-stat label="Selesai" :value="$stats['done_meeting']" icon="check-circle" tone="lagoon"/>
        <x-stat label="Ujian berjalan" :value="$stats['active_quiz']" icon="clock" tone="ink"/>
    </div>
</div>

@if($recentAssignments->count())
<div class="mt-6 rounded-3xl bg-saffron-50 p-5 ring-1 ring-saffron-200">
    <p class="flex items-center gap-2 font-bold text-saffron-900"><x-icon name="alert" class="h-5 w-5"/> Ujian yang belum kamu selesaikan</p>
    <div class="mt-3 flex flex-wrap gap-2">
        @foreach($recentAssignments as $e)<a href="{{ route('exams.show', $e) }}" class="btn-white btn-sm">{{ $e->title }} <x-icon name="arrow-right" class="h-3 w-3"/></a>@endforeach
    </div>
</div>
@endif

<div class="mt-6 grid gap-6 lg:grid-cols-3">
    <div class="card card-pad lg:col-span-2">
        <div class="flex items-center justify-between"><p class="section-title">Jadwal minggu ini</p><a href="{{ route('schedule.index') }}" class="text-xs font-bold text-garnet-600">Kalender →</a></div>
        <div class="mt-4 space-y-2">
            @forelse($weeklyMeetings as $m)
                <a href="{{ route('meeting.show', $m) }}" class="flex items-center gap-4 rounded-2xl border border-ink-50 p-3 transition hover:bg-cream">
                    <div class="grid h-14 w-14 shrink-0 place-items-center rounded-2xl text-center {{ $m->status === 'live' ? 'bg-garnet-600 text-white' : 'bg-ink-900 text-white' }}">
                        <div><p class="text-[10px] font-bold uppercase text-saffron-300">{{ $m->scheduled_at->translatedFormat('D') }}</p><p class="font-display text-xl font-extrabold leading-none">{{ $m->scheduled_at->format('d') }}</p></div>
                    </div>
                    <div class="min-w-0 flex-1"><p class="truncate font-bold">{{ $m->title }}</p><p class="text-xs text-ink-400">{{ $m->course?->name }} · {{ $m->scheduled_at->format('H:i') }}</p></div>
                    <x-status-badge :status="$m->status"/>
                </a>
            @empty
                <x-empty icon="calendar" title="Belum ada jadwal minggu ini" text="Jadwal kelas yang kamu ikuti akan muncul di sini."/>
            @endforelse
        </div>
    </div>
    <div class="space-y-6">
        <div class="card card-pad">
            <p class="section-title">Kuis hari ini</p>
            <div class="mt-3 space-y-2">
                @forelse($todayQuizzes as $q)
                    <a href="{{ route('exams.show', $q) }}" class="flex items-center gap-3 rounded-2xl bg-cream p-3 hover:bg-saffron-50"><span class="grid h-9 w-9 place-items-center rounded-xl bg-saffron-400 text-ink-900"><x-icon name="bolt" class="h-4 w-4"/></span><span class="flex-1 truncate text-sm font-bold">{{ $q->title }}</span><x-icon name="chevron-right" class="h-4 w-4 text-ink-400"/></a>
                @empty
                    <p class="text-sm text-ink-400">Tidak ada kuis hari ini.</p>
                @endforelse
            </div>
        </div>
        <div class="card card-pad">
            <p class="section-title">Tryout terdekat</p>
            <div class="mt-3 space-y-2">
                @forelse($upcomingTryouts as $t)
                    <a href="{{ route('exams.show', $t) }}" class="flex items-center gap-3 rounded-2xl bg-cream p-3 hover:bg-garnet-50"><span class="grid h-9 w-9 place-items-center rounded-xl bg-garnet-600 text-white"><x-icon name="trophy" class="h-4 w-4"/></span><span class="min-w-0 flex-1"><span class="block truncate text-sm font-bold">{{ $t->title }}</span><span class="text-xs text-ink-400">{{ $t->exam_date?->translatedFormat('d M Y') }}</span></span></a>
                @empty
                    <p class="text-sm text-ink-400">Belum ada tryout terjadwal.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

@if($myCourses->count())
<div class="mt-6">
    <p class="section-title mb-4">Kelas saya</p>
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        @foreach($myCourses as $c)
            <a href="{{ route('course.show', $c->slug) }}" class="group card overflow-hidden card-hover">
                <div class="aspect-video overflow-hidden bg-sunrise">@if($c->thumbnail)<img src="{{ asset('storage/'.$c->thumbnail) }}" class="h-full w-full object-cover transition group-hover:scale-105" alt="">@endif</div>
                <div class="p-4"><p class="truncate font-bold">{{ $c->name }}</p><p class="text-xs text-ink-400">{{ $c->meetings_count }} pertemuan</p></div>
            </a>
        @endforeach
    </div>
</div>
@endif
</x-layouts.app>
