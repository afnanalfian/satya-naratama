@extends('layouts.app')

@section('title', 'Rekap Absensi')

@php
    $fmt = fn ($v) => $v === null ? '–' : rtrim(rtrim(number_format($v, 1, ',', '.'), '0'), ',') . '%';
    $query = array_filter([
        'type' => $filters['type'], 'course_id' => $filters['course_id'],
        'from' => $filters['from']?->toDateString(), 'to' => $filters['to']?->toDateString(),
        'q' => $filters['q'] ?: null,
    ]);
    $compTotal = array_sum($composition) ?: 1;
@endphp

@section('content')
<div class="py-6 md:py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-3 mb-5">
            <div>
                <h1 class="text-2xl font-bold text-primary-900 dark:text-white">Manajemen Absensi</h1>
                <p class="text-sm text-secondary-500 dark:text-secondary-400 mt-1">
                    Persentase = jumlah hadir ÷ jumlah pertemuan yang <strong>sudah selesai</strong>, dihitung terpisah untuk akademik dan jasmani.
                </p>
            </div>
            <a href="{{ route('attendance.export', $query) }}"
               class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-900/30 text-sm font-medium text-primary-700 dark:text-primary-200 hover:bg-primary-50 dark:hover:bg-primary-800/30">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                Export Excel (CSV)
            </a>
        </div>

        @include('attendance.partials.nav')

        {{-- Filter --}}
        <form method="GET" class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 p-4 shadow-sm mb-6 grid grid-cols-2 md:grid-cols-6 gap-3 items-end">
            <label class="block">
                <span class="text-xs font-medium text-secondary-500 dark:text-secondary-400">Jenis</span>
                <select name="type" class="mt-1 w-full rounded-xl border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-sm text-primary-800 dark:text-primary-100">
                    <option value="">Semua</option>
                    <option value="akademik" @selected($filters['type'] === 'akademik')>Akademik</option>
                    <option value="jasmani" @selected($filters['type'] === 'jasmani')>Jasmani</option>
                </select>
            </label>
            <label class="block col-span-2 md:col-span-1">
                <span class="text-xs font-medium text-secondary-500 dark:text-secondary-400">Course</span>
                <select name="course_id" class="mt-1 w-full rounded-xl border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-sm text-primary-800 dark:text-primary-100">
                    <option value="">Semua course</option>
                    @foreach($courses as $c)
                        <option value="{{ $c->id }}" @selected($filters['course_id'] == $c->id)>[{{ ucfirst($c->type) }}] {{ $c->name }}</option>
                    @endforeach
                </select>
            </label>
            <label class="block">
                <span class="text-xs font-medium text-secondary-500 dark:text-secondary-400">Dari</span>
                <input type="date" name="from" value="{{ $filters['from']?->toDateString() }}" class="mt-1 w-full rounded-xl border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-sm text-primary-800 dark:text-primary-100">
            </label>
            <label class="block">
                <span class="text-xs font-medium text-secondary-500 dark:text-secondary-400">Sampai</span>
                <input type="date" name="to" value="{{ $filters['to']?->toDateString() }}" class="mt-1 w-full rounded-xl border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-sm text-primary-800 dark:text-primary-100">
            </label>
            <label class="block">
                <span class="text-xs font-medium text-secondary-500 dark:text-secondary-400">Nama siswa</span>
                <input type="text" name="q" value="{{ $filters['q'] }}" placeholder="Cari..." class="mt-1 w-full rounded-xl border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-sm text-primary-800 dark:text-primary-100">
            </label>
            <div class="flex gap-2 col-span-2 md:col-span-1">
                <button class="flex-1 px-4 py-2.5 rounded-xl bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium">Terapkan</button>
                @if($query)
                    <a href="{{ route('attendance.index') }}" class="px-3 py-2.5 rounded-xl border border-primary-200 dark:border-primary-700/50 text-sm text-secondary-600 dark:text-secondary-300">Reset</a>
                @endif
            </div>
        </form>

        {{-- Peringatan pertemuan lampau belum diselesaikan --}}
        @role('admin')
        @if($unfinishedPast->isNotEmpty())
            <div class="rounded-2xl border border-amber-200 bg-amber-50 dark:border-amber-800/40 dark:bg-amber-900/20 p-4 mb-6">
                <p class="text-sm font-semibold text-amber-800 dark:text-amber-200">
                    {{ $unfinishedPast->count() }}{{ $unfinishedPast->count() >= 10 ? '+' : '' }} pertemuan lampau belum ditandai selesai — belum masuk perhitungan persentase.
                </p>
                <div class="mt-2 flex flex-wrap gap-2">
                    @foreach($unfinishedPast as $m)
                        <a href="{{ route('meeting.attendance.index', $m) }}" class="text-xs px-2.5 py-1 rounded-lg bg-white/70 dark:bg-primary-900/40 border border-amber-200 dark:border-amber-800/40 text-amber-800 dark:text-amber-200 hover:underline">
                            {{ $m->scheduled_at?->translatedFormat('d M') }} · {{ \Illuminate\Support\Str::limit($m->title, 28) }}
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
        @endrole

        {{-- KPI --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 p-5 shadow-sm">
                <div class="flex items-center gap-2 text-xs font-medium text-secondary-500 dark:text-secondary-400"><span class="w-2.5 h-2.5 rounded-full bg-[#2a6fdb] dark:bg-[#4a8ae6]"></span> Kehadiran Akademik</div>
                <p class="mt-2 text-3xl font-bold text-primary-900 dark:text-white tabular-nums">{{ $fmt($averages['akademik']) }}</p>
                <p class="text-xs text-secondary-500 dark:text-secondary-400 mt-1">rata-rata siswa · {{ $doneByType['akademik'] ?? 0 }} pertemuan selesai</p>
            </div>
            <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 p-5 shadow-sm">
                <div class="flex items-center gap-2 text-xs font-medium text-secondary-500 dark:text-secondary-400"><span class="w-2.5 h-2.5 rounded-full bg-[#c2570f] dark:bg-[#d96a26]"></span> Kehadiran Jasmani</div>
                <p class="mt-2 text-3xl font-bold text-primary-900 dark:text-white tabular-nums">{{ $fmt($averages['jasmani']) }}</p>
                <p class="text-xs text-secondary-500 dark:text-secondary-400 mt-1">rata-rata siswa · {{ $doneByType['jasmani'] ?? 0 }} pertemuan selesai</p>
            </div>
            <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 p-5 shadow-sm">
                <p class="text-xs font-medium text-secondary-500 dark:text-secondary-400">Siswa Aktif</p>
                <p class="mt-2 text-3xl font-bold text-primary-900 dark:text-white tabular-nums">{{ $studentCount }}</p>
                <p class="text-xs text-secondary-500 dark:text-secondary-400 mt-1">peserta absensi</p>
            </div>
            <div class="bg-white dark:bg-primary-900/30 rounded-2xl border p-5 shadow-sm {{ $lowAttendance ? 'border-red-200 dark:border-red-800/40' : 'border-primary-100 dark:border-primary-800/30' }}">
                <p class="text-xs font-medium text-secondary-500 dark:text-secondary-400">Perlu Perhatian</p>
                <p class="mt-2 text-3xl font-bold tabular-nums {{ $lowAttendance ? 'text-red-600 dark:text-red-400' : 'text-primary-900 dark:text-white' }}">{{ $lowAttendance }}</p>
                <p class="text-xs text-secondary-500 dark:text-secondary-400 mt-1">siswa kehadiran &lt; {{ $threshold }}%</p>
            </div>
        </div>

        {{-- Grafik --}}
        <div class="grid grid-cols-1 xl:grid-cols-5 gap-6 mb-6">
            <div class="xl:col-span-3 bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 p-5 shadow-sm">
                <div class="flex items-start justify-between gap-3 mb-3">
                    <div>
                        <h2 class="font-semibold text-primary-800 dark:text-primary-100">Kehadiran per Pekan</h2>
                        <p class="text-xs text-secondary-500 dark:text-secondary-400">% siswa hadir dari pertemuan selesai pada pekan tsb (Senin–Minggu)</p>
                    </div>
                </div>
                @if(count($weekly['labels']))
                    <div class="h-72"><canvas id="weeklyChart" role="img" aria-label="Grafik kehadiran per pekan akademik dan jasmani"></canvas></div>
                    <details class="mt-3 text-xs">
                        <summary class="cursor-pointer text-secondary-500 dark:text-secondary-400">Lihat data tabel</summary>
                        <div class="overflow-x-auto mt-2">
                            <table class="w-full text-left">
                                <thead class="text-secondary-500 dark:text-secondary-400"><tr><th class="py-1 pr-3">Pekan</th><th class="py-1 pr-3">Akademik</th><th class="py-1">Jasmani</th></tr></thead>
                                <tbody class="text-primary-800 dark:text-primary-100">
                                    @foreach($weekly['ranges'] as $i => $range)
                                        <tr class="border-t border-primary-100 dark:border-primary-800/30">
                                            <td class="py-1 pr-3">{{ $range }}</td>
                                            <td class="py-1 pr-3 tabular-nums">{{ $fmt($weekly['akademik'][$i]) }}</td>
                                            <td class="py-1 tabular-nums">{{ $fmt($weekly['jasmani'][$i]) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </details>
                @else
                    <div class="h-72 flex items-center justify-center text-sm text-secondary-500 dark:text-secondary-400">Belum ada pertemuan selesai pada filter ini.</div>
                @endif
            </div>

            <div class="xl:col-span-2 bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 p-5 shadow-sm">
                <h2 class="font-semibold text-primary-800 dark:text-primary-100">Komposisi Status</h2>
                <p class="text-xs text-secondary-500 dark:text-secondary-400 mb-4">Seluruh slot pertemuan selesai × siswa</p>
                <div class="flex h-4 rounded-full overflow-hidden gap-[2px] bg-primary-50 dark:bg-primary-800/30">
                    @foreach(['hadir' => 'bg-emerald-500', 'izin' => 'bg-amber-400', 'sakit' => 'bg-sky-500', 'alpa' => 'bg-red-500'] as $k => $cls)
                        @if($composition[$k] > 0)
                            <div class="{{ $cls }}" style="width: {{ $composition[$k] / $compTotal * 100 }}%" title="{{ ucfirst($k) }}: {{ $composition[$k] }}"></div>
                        @endif
                    @endforeach
                </div>
                <dl class="grid grid-cols-2 gap-3 mt-5">
                    @foreach(['hadir' => ['Hadir', 'bg-emerald-500'], 'izin' => ['Izin', 'bg-amber-400'], 'sakit' => ['Sakit', 'bg-sky-500'], 'alpa' => ['Alpa', 'bg-red-500']] as $k => [$label, $cls])
                        <div class="rounded-xl border border-primary-100 dark:border-primary-700/30 p-3">
                            <dt class="flex items-center gap-2 text-xs text-secondary-500 dark:text-secondary-400"><span class="w-2.5 h-2.5 rounded-sm {{ $cls }}"></span>{{ $label }}</dt>
                            <dd class="mt-1 text-lg font-bold text-primary-900 dark:text-white tabular-nums">{{ number_format($composition[$k], 0, ',', '.') }}
                                <span class="text-xs font-medium text-secondary-500 dark:text-secondary-400">{{ $fmt($composition[$k] / $compTotal * 100) }}</span>
                            </dd>
                        </div>
                    @endforeach
                </dl>
            </div>
        </div>

        @if(count($perMeeting))
        <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 p-5 shadow-sm mb-6">
            <h2 class="font-semibold text-primary-800 dark:text-primary-100">Kehadiran per Pertemuan</h2>
            <div class="flex flex-wrap items-center justify-between gap-2 mb-3">
                <p class="text-xs text-secondary-500 dark:text-secondary-400">{{ count($perMeeting) }} pertemuan selesai terakhir</p>
                <div class="flex items-center gap-4 text-xs text-secondary-600 dark:text-secondary-300">
                    <span class="inline-flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-[#2a6fdb] dark:bg-[#4a8ae6]"></span>Akademik</span>
                    <span class="inline-flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-[#c2570f] dark:bg-[#d96a26]"></span>Jasmani</span>
                </div>
            </div>
            <div class="h-64"><canvas id="perMeetingChart" role="img" aria-label="Persentase kehadiran per pertemuan"></canvas></div>
        </div>
        @endif

        {{-- Tabel siswa --}}
        @php
            $sortLink = fn ($key) => route('attendance.index', array_merge($query, ['sort' => $key]));
            $sortCls = fn ($key) => $filters['sort'] === $key ? 'text-primary-700 dark:text-primary-200' : '';
        @endphp
        <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 shadow-sm overflow-hidden mb-6">
            <div class="px-5 py-4 border-b border-primary-100 dark:border-primary-800/30 flex flex-wrap items-center justify-between gap-2">
                <h2 class="font-semibold text-primary-800 dark:text-primary-100">Rekap per Siswa</h2>
                <p class="text-xs text-secondary-500 dark:text-secondary-400">Klik judul kolom untuk mengurutkan (terendah di atas)</p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-primary-50/60 dark:bg-primary-800/20 text-xs uppercase tracking-wide text-secondary-500 dark:text-secondary-400">
                        <tr>
                            <th class="px-5 py-3 text-left font-semibold"><a href="{{ $sortLink('name') }}" class="{{ $sortCls('name') }}">Siswa</a></th>
                            <th class="px-4 py-3 text-left font-semibold"><a href="{{ $sortLink('akademik') }}" class="{{ $sortCls('akademik') }}">Akademik ↕</a></th>
                            <th class="px-4 py-3 text-left font-semibold"><a href="{{ $sortLink('jasmani') }}" class="{{ $sortCls('jasmani') }}">Jasmani ↕</a></th>
                            <th class="px-3 py-3 text-center font-semibold">Izin</th>
                            <th class="px-3 py-3 text-center font-semibold">Sakit</th>
                            <th class="px-3 py-3 text-center font-semibold">Alpa</th>
                            <th class="px-4 py-3 text-left font-semibold">Terakhir hadir</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-primary-100 dark:divide-primary-800/30">
                        @forelse($rows as $r)
                            <tr class="hover:bg-primary-50/40 dark:hover:bg-primary-800/10">
                                <td class="px-5 py-3">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $r['student']->avatar_url }}" class="w-8 h-8 rounded-full object-cover" alt="">
                                        <div class="min-w-0">
                                            <a href="{{ route('attendance.student', $r['student']) }}" class="font-medium text-primary-800 dark:text-primary-100 hover:underline">{{ $r['student']->name }}</a>
                                            <p class="text-xs text-secondary-500 dark:text-secondary-400">{{ $r['student']->studentRegistration?->class ? 'Kelas ' . $r['student']->studentRegistration->class : '' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">@include('attendance.partials.pct', ['b' => $r['akademik']])</td>
                                <td class="px-4 py-3">@include('attendance.partials.pct', ['b' => $r['jasmani']])</td>
                                <td class="px-3 py-3 text-center tabular-nums text-secondary-600 dark:text-secondary-300">{{ $r['overall']['izin'] }}</td>
                                <td class="px-3 py-3 text-center tabular-nums text-secondary-600 dark:text-secondary-300">{{ $r['overall']['sakit'] }}</td>
                                <td class="px-3 py-3 text-center tabular-nums {{ $r['overall']['alpa'] ? 'text-red-600 dark:text-red-400 font-semibold' : 'text-secondary-600 dark:text-secondary-300' }}">{{ $r['overall']['alpa'] }}</td>
                                <td class="px-4 py-3 text-xs text-secondary-500 dark:text-secondary-400 whitespace-nowrap">{{ $r['last_present_at'] ? \Carbon\Carbon::parse($r['last_present_at'])->translatedFormat('d M Y, H:i') : '–' }}</td>
                                <td class="px-4 py-3 text-right whitespace-nowrap">
                                    <a href="{{ route('attendance.student', $r['student']) }}" class="text-xs font-medium text-primary-600 dark:text-primary-300 hover:underline">Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="8" class="px-5 py-12 text-center text-secondary-500 dark:text-secondary-400">Tidak ada siswa.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Matriks kehadiran per course --}}
        @if($matrix !== null && $done->isNotEmpty())
            <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-primary-100 dark:border-primary-800/30 flex flex-wrap items-center justify-between gap-2">
                    <h2 class="font-semibold text-primary-800 dark:text-primary-100">Matriks Kehadiran</h2>
                    <div class="flex flex-wrap gap-3 text-xs text-secondary-500 dark:text-secondary-400">
                        <span class="inline-flex items-center gap-1"><span class="w-4 h-4 rounded bg-emerald-500 text-white text-[10px] font-bold flex items-center justify-center">H</span>Hadir</span>
                        <span class="inline-flex items-center gap-1"><span class="w-4 h-4 rounded bg-amber-400 text-white text-[10px] font-bold flex items-center justify-center">I</span>Izin</span>
                        <span class="inline-flex items-center gap-1"><span class="w-4 h-4 rounded bg-sky-500 text-white text-[10px] font-bold flex items-center justify-center">S</span>Sakit</span>
                        <span class="inline-flex items-center gap-1"><span class="w-4 h-4 rounded bg-red-500 text-white text-[10px] font-bold flex items-center justify-center">A</span>Alpa</span>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="text-xs">
                        <thead>
                            <tr class="text-secondary-500 dark:text-secondary-400">
                                <th class="sticky left-0 bg-white dark:bg-primary-950 px-4 py-2 text-left font-semibold min-w-[180px]">Siswa</th>
                                @foreach($done as $i => $m)
                                    <th class="px-1 py-2 font-medium text-center" title="{{ $m->title }} — {{ $m->scheduled_at->translatedFormat('d M Y') }}">
                                        <a href="{{ route('meeting.attendance.index', $m) }}" class="hover:underline">P{{ $i + 1 }}<br><span class="font-normal">{{ $m->scheduled_at->format('d/m') }}</span></a>
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-primary-100 dark:divide-primary-800/30">
                            @foreach($rows as $r)
                                <tr>
                                    <td class="sticky left-0 bg-white dark:bg-primary-950 px-4 py-1.5 text-primary-800 dark:text-primary-100 whitespace-nowrap">{{ $r['student']->name }}</td>
                                    @foreach($done as $m)
                                        @php
                                            $rec = $matrix->get($r['student']->id)?->get($m->id);
                                            $st = $rec?->status ?? 'alpa';
                                            [$letter, $cls] = match($st) {
                                                'hadir' => ['H', 'bg-emerald-500'], 'izin' => ['I', 'bg-amber-400'],
                                                'sakit' => ['S', 'bg-sky-500'], default => ['A', 'bg-red-500'],
                                            };
                                        @endphp
                                        <td class="px-1 py-1.5 text-center">
                                            <span class="inline-flex w-6 h-6 rounded-md {{ $cls }} text-white font-bold items-center justify-center"
                                                  title="{{ ucfirst($st) }}{{ $rec?->marked_at && $st === 'hadir' ? ' · ' . $rec->marked_at->format('H:i') : '' }}">{{ $letter }}</span>
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
@include('partials.charts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const weekly = @json($weekly);
    const datasets = [];
    @if($filters['type'] !== 'jasmani')
        datasets.push({ label: 'Akademik', data: weekly.akademik, color: 'akademik' });
    @endif
    @if($filters['type'] !== 'akademik')
        datasets.push({ label: 'Jasmani', data: weekly.jasmani, color: 'jasmani' });
    @endif
    SNChart.render('weeklyChart', {
        type: 'line', labels: weekly.labels, tooltipTitles: weekly.ranges,
        datasets, ySuffix: '%', yMin: 0, yMax: 100,
    });

    const per = @json($perMeeting);
    SNChart.render('perMeetingChart', {
        type: 'bar',
        labels: per.map(m => m.date),
        tooltipTitles: per.map(m => m.title + ' (' + m.course + ')'),
        tooltipExtra: (ctx) => '(' + per[ctx.dataIndex].hadir + '/' + per[ctx.dataIndex].total + ' siswa)',
        datasets: [{ label: 'Kehadiran', data: per.map(m => m.pct), colors: per.map(m => m.type) }],
        ySuffix: '%', yMin: 0, yMax: 100,
    });
});
</script>
@endpush
