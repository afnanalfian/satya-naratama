<x-layouts.app :title="'Presensi · '.$student->name">
<x-chartjs/>
<x-page-header :title="$student->display_name" sub="Detail kehadiran siswa" :back="route('attendance.index')">
    <x-slot:actions>
        <form method="GET" class="flex items-center gap-2">
            <input type="date" name="from" value="{{ $filters['from']?->toDateString() }}" class="input input-sm">
            <input type="date" name="to" value="{{ $filters['to']?->toDateString() }}" class="input input-sm">
            <button class="btn-ink btn-sm">Filter</button>
        </form>
        <a href="{{ route('monitor.student', $student) }}" class="btn-soft btn-sm"><x-icon name="chart" class="h-4 w-4"/> Rapor</a>
    </x-slot:actions>
</x-page-header>
<div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
    @foreach(['overall' => ['Total kehadiran', 'ink', 'check-circle'], 'akademik' => ['Akademik', 'garnet', 'book'], 'jasmani' => ['Jasmani', 'gold', 'run']] as $k => [$l, $tone, $ic])
        @php $b = $summary[$k]; @endphp
        <x-stat :label="$l" :value="$b['pct'] !== null ? $b['pct'].'%' : '–'" :icon="$ic" :tone="$tone" :hint="$b['hadir'].' hadir · '.$b['izin'].' izin · '.$b['sakit'].' sakit · '.$b['alpa'].' alpa dari '.$b['done']"/>
    @endforeach
</div>
<div class="mt-6 grid gap-6 xl:grid-cols-3">
    <div class="card card-pad xl:col-span-2">
        <p class="section-title">Tren mingguan</p>
        @if(count($weekly['labels']))
            <div class="mt-4 h-64" x-data="chart({ type: 'line', data: { labels: @js($weekly['labels']), datasets: [
                { label: 'Akademik', data: @js($weekly['akademik']), borderColor: '#d81b4d', tension: .35, spanGaps: true },
                { label: 'Jasmani', data: @js($weekly['jasmani']), borderColor: '#f99c07', tension: .35, spanGaps: true } ] },
                options: { maintainAspectRatio: false, scales: { y: { min: 0, max: 100 } } } })"><canvas x-ref="canvas"></canvas></div>
        @else
            <p class="mt-4 text-sm text-ink-400">Belum ada data.</p>
        @endif
    </div>
    <div class="card card-pad">
        <p class="section-title">Per kelas</p>
        <div class="mt-4 space-y-3">
            @forelse($perCourse as $c)
                <div>
                    <div class="flex justify-between text-sm"><span class="truncate font-bold">{{ $c['course']?->name }}</span><span class="font-extrabold">{{ $c['pct'] ?? '–' }}%</span></div>
                    <div class="mt-1 h-2 overflow-hidden rounded-full bg-ink-50"><div class="h-full rounded-full {{ $c['course']?->type === 'jasmani' ? 'bg-saffron-400' : 'bg-garnet-500' }}" style="width: {{ $c['pct'] ?? 0 }}%"></div></div>
                    <p class="mt-0.5 text-[11px] text-ink-400">{{ $c['hadir'] }}/{{ $c['done'] }} hadir</p>
                </div>
            @empty
                <p class="text-sm text-ink-400">Belum ada data.</p>
            @endforelse
        </div>
    </div>
</div>
<div class="table-wrap mt-6">
    <table class="table">
        <thead><tr><th>Tanggal</th><th>Pertemuan</th><th>Kelas</th><th>Status</th><th>Waktu</th><th>Metode</th><th>Catatan</th></tr></thead>
        <tbody>
        @forelse($history as $h)
            <tr>
                <td class="whitespace-nowrap text-ink-500">{{ $h->meeting->scheduled_at->translatedFormat('d M Y') }}</td>
                <td><a href="{{ route('meeting.show', $h->meeting) }}" class="font-bold hover:text-garnet-600">{{ $h->meeting->title }}</a></td>
                <td class="text-ink-500">{{ $h->meeting->course?->name }}</td>
                <td><x-status-badge :status="$h->status"/></td>
                <td class="text-ink-500">{{ $h->time?->format('H:i') ?? '–' }} @if($h->late)<span class="badge-gold">terlambat</span>@endif</td>
                <td class="text-ink-500">{{ $h->method ? ($h->method === 'scan' ? 'Scan QR' : 'Manual') : '–' }}</td>
                <td class="text-ink-500">{{ $h->note ?: '–' }}</td>
            </tr>
        @empty
            <tr><td colspan="7" class="py-10 text-center text-ink-400">Belum ada pertemuan selesai.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
</x-layouts.app>
