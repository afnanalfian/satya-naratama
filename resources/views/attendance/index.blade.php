<x-layouts.app title="Rekap Presensi" :wide="true">
<x-chartjs/>
@php
    $f = $filters;
    $pctTone = fn ($p) => $p === null ? 'text-ink-300' : ($p >= $threshold ? 'text-lagoon-600' : ($p >= $threshold - 15 ? 'text-saffron-600' : 'text-garnet-600'));
    $qs = array_filter(['type' => $f['type'], 'course_id' => $f['course_id'], 'from' => $f['from']?->toDateString(), 'to' => $f['to']?->toDateString()]);
@endphp
<x-page-header title="Rekap Presensi" sub="Persentase kehadiran dihitung dari pertemuan berstatus selesai.">
    <x-slot:actions>
        <a href="{{ route('attendance.export', request()->query()) }}" class="btn-soft"><x-icon name="download" class="h-4 w-4"/> Ekspor CSV</a>
        <a href="{{ route('attendance.hub') }}" class="btn-ink"><x-icon name="scan" class="h-4 w-4"/> Scan presensi</a>
    </x-slot:actions>
</x-page-header>

<form method="GET" class="card mb-6 grid gap-3 p-4 sm:grid-cols-2 lg:grid-cols-6">
    <select name="type" class="select"><option value="">Semua jenis</option><option value="akademik" @selected($f['type'] === 'akademik')>Akademik</option><option value="jasmani" @selected($f['type'] === 'jasmani')>Jasmani</option></select>
    <select name="course_id" class="select lg:col-span-2"><option value="">Semua kelas</option>@foreach($courses as $c)<option value="{{ $c->id }}" @selected($f['course_id'] == $c->id)>{{ $c->name }} ({{ $c->type }})</option>@endforeach</select>
    <input type="date" name="from" value="{{ $f['from']?->toDateString() }}" class="input" title="Dari">
    <input type="date" name="to" value="{{ $f['to']?->toDateString() }}" class="input" title="Sampai">
    <div class="flex gap-2"><button class="btn-ink flex-1"><x-icon name="filter" class="h-4 w-4"/> Terapkan</button>@if(count($qs))<a href="{{ route('attendance.index') }}" class="btn-soft btn-icon" title="Reset"><x-icon name="x" class="h-4 w-4"/></a>@endif</div>
</form>

<div class="grid grid-cols-2 gap-4 lg:grid-cols-5">
    <x-stat label="Siswa aktif" :value="$studentCount" icon="users" tone="ink"/>
    <x-stat label="Pertemuan selesai" :value="$done->count()" icon="calendar" tone="sky" :hint="($doneByType['akademik'] ?? 0).' akademik · '.($doneByType['jasmani'] ?? 0).' jasmani'"/>
    <x-stat label="Rata-rata akademik" :value="$averages['akademik'] !== null ? $averages['akademik'].'%' : '–'" icon="book" tone="garnet"/>
    <x-stat label="Rata-rata jasmani" :value="$averages['jasmani'] !== null ? $averages['jasmani'].'%' : '–'" icon="run" tone="gold"/>
    <x-stat label="Di bawah {{ $threshold }}%" :value="$lowAttendance" icon="alert" tone="garnet" hint="perlu perhatian"/>
</div>

@if($unfinishedPast->count())
<div class="mt-6 rounded-3xl bg-saffron-50 p-5 ring-1 ring-saffron-200">
    <p class="flex items-center gap-2 font-bold text-saffron-900"><x-icon name="alert" class="h-5 w-5"/> {{ $unfinishedPast->count() }} pertemuan lampau belum ditandai selesai (tidak dihitung)</p>
    <div class="mt-3 flex flex-wrap gap-2">@foreach($unfinishedPast as $m)<a href="{{ route('meeting.attendance.index', $m) }}" class="btn-white btn-sm">{{ $m->scheduled_at->translatedFormat('d M') }} · {{ \Illuminate\Support\Str::limit($m->title, 28) }}</a>@endforeach</div>
</div>
@endif

<div class="mt-6 grid gap-6 xl:grid-cols-3">
    <div class="card card-pad xl:col-span-2">
        <p class="section-title">Tren kehadiran mingguan</p>
        @if(count($weekly['labels']))
            <div class="mt-4 h-72" x-data="chart({ type: 'line', data: { labels: @js($weekly['labels']), datasets: [
                { label: 'Akademik', data: @js($weekly['akademik']), borderColor: '#d81b4d', backgroundColor: 'rgba(216,27,77,.1)', fill: true, tension: .35, spanGaps: true },
                { label: 'Jasmani', data: @js($weekly['jasmani']), borderColor: '#f99c07', backgroundColor: 'rgba(249,156,7,.1)', fill: true, tension: .35, spanGaps: true } ] },
                options: { maintainAspectRatio: false, plugins: { tooltip: { callbacks: { title: (i) => @js($weekly['ranges'])[i[0].dataIndex] } } }, scales: { y: { min: 0, max: 100, ticks: { callback: v => v + '%' } } } } })"><canvas x-ref="canvas"></canvas></div>
        @else
            <x-empty icon="chart" title="Belum ada data" class="mt-4 !py-10"/>
        @endif
    </div>
    <div class="card card-pad">
        <p class="section-title">Komposisi status</p>
        @if(array_sum($composition))
            <div class="mx-auto mt-4 h-60 max-w-xs" x-data="chart({ type: 'doughnut', data: { labels: ['Hadir','Izin','Sakit','Alpa'], datasets: [{ data: @js(array_values($composition)), backgroundColor: ['#0fb59e','#0ea5e9','#ffbe20','#d81b4d'], borderWidth: 0 }] }, options: { maintainAspectRatio: false, cutout: '68%', plugins: { legend: { position: 'bottom' } } } })"><canvas x-ref="canvas"></canvas></div>
        @else
            <x-empty icon="pie" title="Belum ada data" class="mt-4 !py-10"/>
        @endif
    </div>
</div>

@if(count($perMeeting))
<div class="card mt-6 card-pad">
    <p class="section-title">Kehadiran per pertemuan (24 terakhir)</p>
    <div class="mt-4 h-64" x-data="chart({ type: 'bar', data: { labels: @js(array_column($perMeeting, 'date')), datasets: [{ label: 'Hadir %', data: @js(array_column($perMeeting, 'pct')), backgroundColor: @js(array_map(fn ($p) => $p['type'] === 'jasmani' ? '#ffbe20' : '#d81b4d', $perMeeting)), borderRadius: 8 }] },
        options: { maintainAspectRatio: false, plugins: { legend: { display: false }, tooltip: { callbacks: { title: (i) => @js(array_column($perMeeting, 'title'))[i[0].dataIndex], afterLabel: (i) => @js(array_map(fn ($p) => $p['hadir'].'/'.$p['total'].' · '.$p['course'], $perMeeting))[i.dataIndex] } } }, scales: { y: { min: 0, max: 100 } } } })"><canvas x-ref="canvas"></canvas></div>
</div>
@endif

{{-- Tabel siswa --}}
<div class="card mt-6 overflow-hidden">
    <form method="GET" class="flex flex-col gap-3 border-b border-ink-50 p-4 sm:flex-row sm:items-center">
        @foreach($qs as $k => $v)<input type="hidden" name="{{ $k }}" value="{{ $v }}">@endforeach
        <p class="section-title flex-1">Rekap per siswa</p>
        <input name="q" value="{{ $f['q'] }}" class="input input-sm sm:w-56" placeholder="Cari nama…">
        <select name="sort" class="select input-sm sm:w-48" onchange="this.form.submit()">
            @foreach(['name' => 'Urut nama', 'overall' => 'Total terendah', 'akademik' => 'Akademik terendah', 'jasmani' => 'Jasmani terendah'] as $k => $l)<option value="{{ $k }}" @selected($f['sort'] === $k)>{{ $l }}</option>@endforeach
        </select>
    </form>
    <div class="overflow-x-auto">
        <table class="table">
            <thead><tr><th>Siswa</th><th class="text-center">Akademik</th><th class="text-center">Jasmani</th><th class="text-center">Total</th><th class="text-center">H / I / S / A</th><th>Terakhir hadir</th><th></th></tr></thead>
            <tbody>
            @forelse($rows as $r)
                <tr>
                    <td><div class="flex items-center gap-3"><img src="{{ $r['student']->avatar_url }}" class="h-9 w-9 rounded-xl object-cover" alt=""><div><p class="font-bold">{{ $r['student']->name }}</p><p class="text-xs text-ink-400">{{ $r['student']->studentRegistration?->class ? 'Kelas '.$r['student']->studentRegistration->class : '' }}</p></div></div></td>
                    @foreach(['akademik', 'jasmani', 'overall'] as $t)
                        <td class="text-center"><span class="font-display text-lg font-extrabold {{ $pctTone($r[$t]['pct']) }}">{{ $r[$t]['pct'] !== null ? $r[$t]['pct'].'%' : '–' }}</span><p class="text-[11px] text-ink-400">{{ $r[$t]['hadir'] }}/{{ $r[$t]['done'] }}</p></td>
                    @endforeach
                    <td class="whitespace-nowrap text-center text-xs font-bold"><span class="text-lagoon-600">{{ $r['overall']['hadir'] }}</span> / <span class="text-sky-600">{{ $r['overall']['izin'] }}</span> / <span class="text-saffron-600">{{ $r['overall']['sakit'] }}</span> / <span class="text-garnet-600">{{ $r['overall']['alpa'] }}</span></td>
                    <td class="whitespace-nowrap text-xs text-ink-500">{{ $r['last_present_at'] ? \Carbon\Carbon::parse($r['last_present_at'])->translatedFormat('d M Y') : '—' }}</td>
                    <td class="text-right"><a href="{{ route('attendance.student', array_merge(['user' => $r['student']->id], $qs)) }}" class="btn-soft btn-sm">Detail</a></td>
                </tr>
            @empty
                <tr><td colspan="7" class="py-10 text-center text-ink-400">Tidak ada data.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Matriks per kelas --}}
@if($matrix !== null && $done->count())
<div class="card mt-6 overflow-hidden">
    <p class="section-title p-4">Matriks kehadiran kelas</p>
    <div class="overflow-x-auto">
        <table class="table text-xs">
            <thead><tr><th class="sticky left-0 bg-white">Siswa</th>@foreach($done as $m)<th class="text-center" title="{{ $m->title }}">{{ $m->scheduled_at->format('d/m') }}</th>@endforeach</tr></thead>
            <tbody>
            @foreach($rows as $r)
                <tr>
                    <td class="sticky left-0 whitespace-nowrap bg-white font-bold">{{ $r['student']->name }}</td>
                    @foreach($done as $m)
                        @php $st = $matrix[$r['student']->id][$m->id]->status ?? 'alpa'; @endphp
                        <td class="text-center"><span class="inline-grid h-6 w-6 place-items-center rounded-md text-[10px] font-extrabold {{ ['hadir' => 'bg-lagoon-500 text-white', 'izin' => 'bg-sky-500 text-white', 'sakit' => 'bg-saffron-400 text-ink-900', 'alpa' => 'bg-garnet-100 text-garnet-700'][$st] ?? '' }}">{{ strtoupper(substr($st, 0, 1)) }}</span></td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
</x-layouts.app>
