{{-- Rapor siswa: presensi, tryout, jasmani, data fisik. Variabel dari StudentReportService::build() --}}
@php
    $reg = $student->studentRegistration;
    $sum = $attendance['summary'];
    $items = \App\Models\PhysicalEvaluation::ITEMS;
    $latestJ = $jasmani['latest']; $prevJ = $jasmani['previous'];
    $latestP = $physical['latest'];
@endphp
<x-chartjs />

{{-- Identitas --}}
<div class="card-ink p-6 sm:p-8">
    <div class="absolute inset-0 bg-grid-ink [background-size:30px_30px]"></div>
    <div class="blob -right-10 -top-10 h-56 w-56 bg-garnet-600/40"></div>
    <div class="relative flex flex-col gap-5 sm:flex-row sm:items-center">
        <img src="{{ $student->avatar_url }}" class="h-20 w-20 rounded-3xl object-cover ring-4 ring-white/10" alt="">
        <div class="flex-1">
            <p class="text-xs font-bold uppercase tracking-widest text-saffron-400">Rapor Perkembangan Siswa</p>
            <h2 class="mt-1 font-display text-2xl font-extrabold sm:text-3xl">{{ $student->display_name }}</h2>
            <p class="mt-1 text-sm text-ink-300">{{ $reg?->school_origin ?? '—' }} {{ $reg?->class ? '· Kelas '.$reg->class : '' }} {{ $reg?->priority_university_1 ? '· Target '.$reg->priority_university_1 : '' }}</p>
        </div>
        <div class="grid grid-cols-3 gap-2 text-center">
            <div class="rounded-2xl bg-white/10 px-3 py-2"><p class="font-display text-2xl font-extrabold">{{ $sum['overall']['pct'] !== null ? $sum['overall']['pct'].'%' : '–' }}</p><p class="text-[10px] font-bold uppercase text-ink-300">Hadir</p></div>
            <div class="rounded-2xl bg-white/10 px-3 py-2"><p class="font-display text-2xl font-extrabold">{{ $tryouts['rows']->count() }}</p><p class="text-[10px] font-bold uppercase text-ink-300">Tryout</p></div>
            <div class="rounded-2xl bg-white/10 px-3 py-2"><p class="font-display text-2xl font-extrabold">{{ $jasmani['results']->count() }}</p><p class="text-[10px] font-bold uppercase text-ink-300">Eval. fisik</p></div>
        </div>
    </div>
</div>

{{-- Presensi --}}
<section class="mt-6 grid gap-6 lg:grid-cols-3">
    <div class="card card-pad">
        <p class="section-title">Kehadiran</p>
        @foreach(['akademik' => ['Kelas Akademik', 'garnet'], 'jasmani' => ['Latihan Jasmani', 'gold']] as $t => [$lbl, $tone])
            @php $b = $sum[$t]; @endphp
            <div class="mt-4">
                <div class="flex items-end justify-between"><span class="text-sm font-bold">{{ $lbl }}</span><span class="font-display text-xl font-extrabold">{{ $b['pct'] !== null ? $b['pct'].'%' : '–' }}</span></div>
                <div class="mt-2 h-2.5 overflow-hidden rounded-full bg-ink-50"><div class="h-full rounded-full {{ $tone === 'garnet' ? 'bg-garnet-500' : 'bg-saffron-400' }}" style="width: {{ $b['pct'] ?? 0 }}%"></div></div>
                <p class="mt-1.5 text-xs text-ink-400">{{ $b['hadir'] }} hadir · {{ $b['izin'] }} izin · {{ $b['sakit'] }} sakit · {{ $b['alpa'] }} alpa dari {{ $b['done'] }} pertemuan</p>
            </div>
        @endforeach
    </div>
    <div class="card card-pad lg:col-span-2">
        <p class="section-title">Tren kehadiran mingguan</p>
        @if(count($attendance['weekly']['labels']))
            <div class="mt-4 h-56" x-data="chart({ type: 'line', data: { labels: @js($attendance['weekly']['labels']), datasets: [
                { label: 'Akademik', data: @js($attendance['weekly']['akademik']), borderColor: '#d81b4d', backgroundColor: 'rgba(216,27,77,.12)', fill: true, tension: .35, spanGaps: true },
                { label: 'Jasmani', data: @js($attendance['weekly']['jasmani']), borderColor: '#f99c07', backgroundColor: 'rgba(249,156,7,.12)', fill: true, tension: .35, spanGaps: true } ] },
                options: { maintainAspectRatio: false, scales: { y: { min: 0, max: 100, ticks: { callback: v => v + '%' } } } } })"><canvas x-ref="canvas"></canvas></div>
        @else
            <p class="mt-6 text-sm text-ink-400">Belum ada pertemuan selesai.</p>
        @endif
    </div>
</section>

@if($attendance['history']->count())
<div class="card mt-6 card-pad">
    <p class="section-title">Riwayat pertemuan terakhir</p>
    <div class="mt-4 grid gap-2 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($attendance['history'] as $h)
            <div class="flex items-center gap-3 rounded-2xl bg-cream p-3">
                <span class="grid h-10 w-10 shrink-0 place-items-center rounded-xl {{ $h->meeting->course?->type === 'jasmani' ? 'bg-saffron-100 text-saffron-700' : 'bg-ink-100 text-ink-700' }}"><x-icon :name="$h->meeting->course?->type === 'jasmani' ? 'run' : 'book'" class="h-5 w-5"/></span>
                <div class="min-w-0 flex-1"><p class="truncate text-sm font-bold">{{ $h->meeting->title }}</p><p class="text-xs text-ink-400">{{ $h->meeting->scheduled_at->translatedFormat('d M Y') }}{{ $h->time ? ' · '.$h->time->format('H:i') : '' }}{{ $h->late ? ' · terlambat' : '' }}</p></div>
                <x-status-badge :status="$h->status"/>
            </div>
        @endforeach
    </div>
</div>
@endif

{{-- Tryout --}}
<section class="mt-6 card card-pad">
    <div class="flex flex-wrap items-center justify-between gap-2">
        <p class="section-title">Hasil tryout</p>
        @if($tryouts['rows']->count())<span class="badge-lagoon">{{ $tryouts['passed'] }} lulus dari {{ $tryouts['rows']->count() }}</span>@endif
    </div>
    @if($tryouts['rows']->isEmpty())
        <p class="mt-4 text-sm text-ink-400">Belum mengikuti tryout.</p>
    @else
        <div class="mt-4 grid gap-4 md:grid-cols-2">
            @foreach($tryouts['series'] as $s)
                <div class="rounded-2xl bg-cream p-4">
                    <p class="text-xs font-bold uppercase tracking-wider text-ink-500">{{ $s['label'] }}</p>
                    <div class="mt-2 h-48" x-data="chart({ type: 'bar', data: { labels: @js($s['labels']), datasets: [
                        { label: 'Nilai', data: @js($s['scores']), backgroundColor: '#d81b4d', borderRadius: 8 },
                        { label: 'Rata-rata peserta', data: @js($s['avgs']), type: 'line', borderColor: '#f99c07', backgroundColor: '#f99c07', tension: .3 } ] },
                        options: { maintainAspectRatio: false } })"><canvas x-ref="canvas"></canvas></div>
                </div>
            @endforeach
        </div>
        <div class="table-wrap mt-4 !shadow-none">
            <table class="table">
                <thead><tr><th>Tryout</th><th>Jenis</th><th>Tanggal</th><th class="text-right">Nilai</th><th class="text-center">Peringkat</th><th>Status</th></tr></thead>
                <tbody>
                @foreach($tryouts['rows'] as $r)
                    <tr>
                        <td class="font-bold">{{ $r->title }}</td>
                        <td><span class="badge-ink">{{ $r->type_label }}</span></td>
                        <td class="whitespace-nowrap text-ink-500">{{ $r->date ? \Carbon\Carbon::parse($r->date)->translatedFormat('d M Y') : '–' }}</td>
                        <td class="text-right font-display text-lg font-extrabold">{{ rtrim(rtrim(number_format($r->score, 2, ',', '.'), '0'), ',') }}</td>
                        <td class="text-center text-ink-600">{{ $r->rank }}/{{ $r->participants }}</td>
                        <td>@if($r->is_passed === null)<span class="text-ink-300">–</span>@elseif($r->is_passed)<span class="badge-lagoon">Lulus</span>@else<span class="badge-garnet">Belum lulus</span>@endif</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
</section>

{{-- Jasmani --}}
<section class="mt-6 card card-pad">
    <p class="section-title">Evaluasi jasmani</p>
    @if(! $latestJ)
        <p class="mt-4 text-sm text-ink-400">Belum ada hasil evaluasi jasmani.</p>
    @else
        <p class="text-xs text-ink-400">Terakhir: {{ $latestJ->evaluation->title }} ({{ $latestJ->evaluation->period->translatedFormat('F Y') }})</p>
        <div class="mt-4 grid grid-cols-2 gap-3 sm:grid-cols-5">
            @foreach($items as $key => $it)
                @php
                    $v = $latestJ->{$key}; $pv = $prevJ?->{$key};
                    $delta = ($v !== null && $pv !== null) ? $v - $pv : null;
                    $good = $delta !== null && (($it['better'] === 'high' && $delta > 0) || ($it['better'] === 'low' && $delta < 0));
                @endphp
                <div class="rounded-2xl bg-cream p-4">
                    <p class="text-[11px] font-bold uppercase tracking-wider text-ink-400">{{ \App\Models\PhysicalEvaluation::itemLabel($key, $jasmani['gender']) }}</p>
                    <p class="mt-1 font-display text-2xl font-extrabold">{{ $v !== null ? rtrim(rtrim(number_format($v, 2, ',', '.'), '0'), ',') : '–' }} <span class="text-xs font-bold text-ink-400">{{ $it['unit'] }}</span></p>
                    @if($delta !== null && $delta != 0)
                        <p class="mt-1 text-xs font-bold {{ $good ? 'text-lagoon-600' : 'text-garnet-600' }}">{{ $delta > 0 ? '▲' : '▼' }} {{ rtrim(rtrim(number_format(abs($delta), 2, ',', '.'), '0'), ',') }} dari sebelumnya</p>
                    @endif
                </div>
            @endforeach
        </div>
        @if(count($jasmani['series']['labels']) > 1)
            <div class="mt-5 h-60" x-data="chart({ type: 'line', data: { labels: @js($jasmani['series']['labels']), datasets: [
                { label: 'Push up', data: @js($jasmani['series']['push_up']), borderColor: '#d81b4d', tension: .3 },
                { label: 'Sit up', data: @js($jasmani['series']['sit_up']), borderColor: '#f99c07', tension: .3 },
                { label: 'Pull up/Chinning', data: @js($jasmani['series']['pull_up_chinning']), borderColor: '#0fb59e', tension: .3 } ] },
                options: { maintainAspectRatio: false } })"><canvas x-ref="canvas"></canvas></div>
        @endif
    @endif
</section>

{{-- Data fisik --}}
<section class="mt-6 grid gap-6 lg:grid-cols-3">
    <div class="card card-pad">
        <p class="section-title">Data fisik terbaru</p>
        @if($latestP)
            <p class="text-xs text-ink-400">{{ $latestP->period->translatedFormat('F Y') }}</p>
            <div class="mt-4 grid grid-cols-2 gap-3">
                <div class="rounded-2xl bg-cream p-4"><p class="text-xs font-bold text-ink-400">Tinggi</p><p class="font-display text-2xl font-extrabold">{{ rtrim(rtrim(number_format($latestP->height_cm, 1, ',', '.'), '0'), ',') }} <span class="text-xs">cm</span></p></div>
                <div class="rounded-2xl bg-cream p-4"><p class="text-xs font-bold text-ink-400">Berat</p><p class="font-display text-2xl font-extrabold">{{ rtrim(rtrim(number_format($latestP->weight_kg, 1, ',', '.'), '0'), ',') }} <span class="text-xs">kg</span></p></div>
            </div>
            <div class="mt-3 flex items-center justify-between rounded-2xl bg-cream p-4"><span class="text-sm font-bold">IMT {{ $latestP->bmi }}</span><x-bmi-badge :cat="$latestP->bmi_category"/></div>
        @else
            <p class="mt-4 text-sm text-ink-400">Belum ada data fisik.</p>
        @endif
    </div>
    <div class="card card-pad lg:col-span-2">
        <p class="section-title">Perkembangan tinggi & berat</p>
        @if(count($physical['chart']['labels']) > 0)
            <div class="mt-4 h-56" x-data="chart({ type: 'line', data: { labels: @js($physical['chart']['labels']), datasets: [
                { label: 'Tinggi (cm)', data: @js($physical['chart']['height']), borderColor: '#5d4384', yAxisID: 'y', tension: .3 },
                { label: 'Berat (kg)', data: @js($physical['chart']['weight']), borderColor: '#0fb59e', yAxisID: 'y1', tension: .3 } ] },
                options: { maintainAspectRatio: false, scales: { y: { position: 'left' }, y1: { position: 'right', grid: { drawOnChartArea: false } } } } })"><canvas x-ref="canvas"></canvas></div>
        @else
            <p class="mt-6 text-sm text-ink-400">Grafik muncul setelah data bulanan diisi.</p>
        @endif
        @if($physical['health']->count())
            <div class="mt-4 space-y-2">
                @foreach($physical['health']->take(3) as $h)
                    <div class="rounded-2xl bg-garnet-50 p-3 text-sm text-garnet-900"><b>{{ $h->period->translatedFormat('F Y') }}:</b> {{ collect([$h->has_illness ? 'Sakit: '.$h->illness_notes : null, $h->has_injury ? 'Cedera: '.$h->injury_notes : null])->filter()->implode(' · ') }}</div>
                @endforeach
            </div>
        @endif
    </div>
</section>
