<x-layouts.app title="Scan Presensi">
<x-page-header title="Scan Presensi" sub="Pilih pertemuan untuk membuka scanner QR & daftar hadir."/>
@php
    $card = function ($m) use ($counts) { return $counts[$m->id] ?? null; };
@endphp
<p class="section-title mb-3">Hari ini & sedang live</p>
<div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
    @forelse($today as $m)
        @php $c = $counts[$m->id] ?? null; @endphp
        <a href="{{ route('meeting.attendance.index', $m) }}" class="card card-hover relative overflow-hidden p-5 {{ $m->status === 'live' ? 'ring-2 ring-garnet-400' : '' }}">
            @if($m->status === 'live')<span class="absolute right-4 top-4 flex h-3 w-3"><span class="absolute h-3 w-3 animate-ping rounded-full bg-garnet-400"></span><span class="h-3 w-3 rounded-full bg-garnet-600"></span></span>@endif
            <div class="flex items-center gap-2"><x-course-type-badge :type="$m->course?->type"/><x-status-badge :status="$m->status"/></div>
            <p class="mt-3 font-display text-lg font-bold">{{ $m->title }}</p>
            <p class="text-xs text-ink-400">{{ $m->course?->name }} · {{ $m->scheduled_at?->format('H:i') }}</p>
            @if($c)
                <div class="mt-4 flex items-end justify-between"><span class="text-xs font-bold text-ink-500">{{ $c['hadir'] }}/{{ $c['total'] }} hadir</span><span class="font-display text-2xl font-extrabold text-lagoon-600">{{ $c['pct'] }}%</span></div>
                <div class="mt-1.5 h-2 overflow-hidden rounded-full bg-ink-50"><div class="h-full rounded-full bg-lagoon-500" style="width: {{ $c['pct'] }}%"></div></div>
            @endif
            <span class="btn-ink btn-sm mt-4 w-full"><x-icon name="scan" class="h-4 w-4"/> Buka scanner</span>
        </a>
    @empty
        <div class="md:col-span-2 xl:col-span-3"><x-empty icon="calendar" title="Tidak ada pertemuan hari ini" text="Pertemuan yang dijadwalkan hari ini atau sedang live akan muncul di sini."/></div>
    @endforelse
</div>

@if($upcoming->count())
<p class="section-title mb-3 mt-8">Akan datang</p>
<div class="grid gap-3 md:grid-cols-2 xl:grid-cols-3">
    @foreach($upcoming as $m)
        <a href="{{ route('meeting.attendance.index', $m) }}" class="card flex items-center gap-3 p-4 hover:bg-cream">
            <div class="grid h-12 w-12 place-items-center rounded-2xl bg-ink-50 text-center"><div><p class="text-[10px] font-bold uppercase">{{ $m->scheduled_at->translatedFormat('M') }}</p><p class="font-display text-lg font-extrabold leading-none">{{ $m->scheduled_at->format('d') }}</p></div></div>
            <div class="min-w-0 flex-1"><p class="truncate font-bold">{{ $m->title }}</p><p class="text-xs text-ink-400">{{ $m->course?->name }}</p></div>
        </a>
    @endforeach
</div>
@endif

@if($isAdmin && $past)
<p class="section-title mb-3 mt-8">Pertemuan sebelumnya (koreksi presensi)</p>
<div class="table-wrap">
    <table class="table">
        <thead><tr><th>Tanggal</th><th>Pertemuan</th><th>Kelas</th><th>Status</th><th class="text-right">Kehadiran</th><th></th></tr></thead>
        <tbody>
        @foreach($past as $m)
            @php $c = $counts[$m->id] ?? null; @endphp
            <tr>
                <td class="whitespace-nowrap text-ink-500">{{ $m->scheduled_at?->translatedFormat('d M Y') }}</td>
                <td class="font-bold">{{ $m->title }}</td>
                <td class="text-ink-500">{{ $m->course?->name }}</td>
                <td><x-status-badge :status="$m->status"/></td>
                <td class="text-right font-bold">{{ $c ? $c['hadir'].'/'.$c['total'].' · '.$c['pct'].'%' : '–' }}</td>
                <td class="text-right"><a href="{{ route('meeting.attendance.index', $m) }}" class="btn-soft btn-sm">Buka</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
{{ $past->links() }}
@endif
</x-layouts.app>
