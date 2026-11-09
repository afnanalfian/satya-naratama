<x-layouts.app title="Data Fisik Siswa" :wide="true">
<x-chartjs/>
@php $prevMonth = $period->copy()->subMonth()->format('Y-m'); $nextMonth = $period->copy()->addMonth()->format('Y-m'); @endphp
<x-page-header title="Data Fisik Siswa" sub="Tinggi, berat, IMT & catatan kesehatan bulanan.">
    <x-slot:actions>
        <div class="flex items-center gap-1 rounded-2xl bg-white p-1 shadow-soft">
            <a href="{{ request()->fullUrlWithQuery(['month' => $prevMonth]) }}" class="btn-ghost btn-icon"><x-icon name="chevron-left" class="h-4 w-4"/></a>
            <span class="px-2 font-display font-bold">{{ $period->translatedFormat('F Y') }}</span>
            <a href="{{ request()->fullUrlWithQuery(['month' => $nextMonth]) }}" class="btn-ghost btn-icon"><x-icon name="chevron-right" class="h-4 w-4"/></a>
        </div>
    </x-slot:actions>
</x-page-header>
<div class="grid grid-cols-2 gap-4 lg:grid-cols-5">
    <x-stat label="Sudah mengisi" :value="$kpi['filled'].'/'.$kpi['total']" icon="clipboard" tone="lagoon"/>
    <x-stat label="Rata-rata tinggi" :value="$kpi['avg_height'] ? $kpi['avg_height'].' cm' : '–'" icon="ruler" tone="ink"/>
    <x-stat label="Rata-rata berat" :value="$kpi['avg_weight'] ? $kpi['avg_weight'].' kg' : '–'" icon="scale" tone="sky"/>
    <x-stat label="Rata-rata IMT" :value="$kpi['avg_bmi'] ?? '–'" icon="activity" tone="gold"/>
    <x-stat label="Sakit / cedera" :value="$kpi['illness'].' / '.$kpi['injury']" icon="heart" tone="garnet"/>
</div>
<div class="mt-6 grid gap-6 xl:grid-cols-3">
    <div class="card card-pad xl:col-span-2">
        <p class="section-title">Tren rata-rata 12 bulan</p>
        <div class="mt-4 h-60" x-data="chart({ type: 'line', data: { labels: @js($trend['labels']), datasets: [
            { label: 'Tinggi (cm)', data: @js($trend['height']), borderColor: '#5d4384', yAxisID: 'y', tension: .3, spanGaps: true },
            { label: 'Berat (kg)', data: @js($trend['weight']), borderColor: '#0fb59e', yAxisID: 'y1', tension: .3, spanGaps: true } ] },
            options: { maintainAspectRatio: false, scales: { y1: { position: 'right', grid: { drawOnChartArea: false } } } } })"><canvas x-ref="canvas"></canvas></div>
    </div>
    <div class="card card-pad">
        <p class="section-title">Sebaran IMT</p>
        @php $bmiLabels = ['kurus_berat' => 'Kurus berat', 'kurus' => 'Kurus', 'normal' => 'Normal', 'gemuk' => 'Gemuk', 'obesitas' => 'Obesitas']; $tot = max(1, array_sum($bmiBuckets)); @endphp
        <div class="mt-4 space-y-3">
            @foreach($bmiBuckets as $k => $n)
                <div><div class="flex justify-between text-sm"><span class="font-bold">{{ $bmiLabels[$k] }}</span><span>{{ $n }}</span></div>
                <div class="mt-1 h-2.5 overflow-hidden rounded-full bg-ink-50"><div class="h-full rounded-full {{ $k === 'normal' ? 'bg-lagoon-500' : (in_array($k, ['kurus', 'gemuk']) ? 'bg-saffron-400' : 'bg-garnet-500') }}" style="width: {{ $n / $tot * 100 }}%"></div></div></div>
            @endforeach
        </div>
    </div>
</div>
<form method="GET" class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-center">
    <input type="hidden" name="month" value="{{ $period->format('Y-m') }}">
    <input name="q" value="{{ $q }}" class="input sm:w-64" placeholder="Cari nama…">
    <div class="tabs">
        @foreach(['' => 'Semua', 'missing' => 'Belum mengisi', 'health' => 'Ada keluhan'] as $k => $l)<button name="filter" value="{{ $k }}" class="tab {{ ($filter ?? '') === $k ? 'tab-active' : '' }}">{{ $l }}</button>@endforeach
    </div>
</form>
<div class="table-wrap mt-4">
    <table class="table">
        <thead><tr><th>Siswa</th><th class="text-right">Tinggi</th><th class="text-right">Berat</th><th class="text-right">IMT</th><th>Kategori</th><th>Kesehatan</th><th></th></tr></thead>
        <tbody>
        @forelse($rows as $row)
            @php $r = $row['record']; $p = $row['previous']; @endphp
            <tr>
                <td><div class="flex items-center gap-3"><img src="{{ $row['student']->avatar_url }}" class="h-9 w-9 rounded-xl object-cover" alt=""><div><p class="font-bold">{{ $row['student']->name }}</p><p class="text-xs text-ink-400">{{ $row['student']->studentRegistration?->gender }} {{ $row['student']->studentRegistration?->class ? '· '.$row['student']->studentRegistration->class : '' }}</p></div></div></td>
                @if($r)
                    <td class="text-right">{{ $r->height_cm }} @if($p && $p->height_cm != $r->height_cm)<span class="text-[10px] font-bold {{ $r->height_cm > $p->height_cm ? 'text-lagoon-600' : 'text-garnet-600' }}">{{ $r->height_cm > $p->height_cm ? '▲' : '▼' }}</span>@endif</td>
                    <td class="text-right">{{ $r->weight_kg }} @if($p && $p->weight_kg != $r->weight_kg)<span class="text-[10px] font-bold text-ink-400">{{ $r->weight_kg > $p->weight_kg ? '▲' : '▼' }}</span>@endif</td>
                    <td class="text-right font-bold">{{ $r->bmi }}</td>
                    <td><x-bmi-badge :cat="$r->bmi_category"/></td>
                    <td class="max-w-xs text-xs">@if($r->hasHealthIssue())<span class="text-garnet-700">{{ collect([$r->has_illness ? 'Sakit: '.$r->illness_notes : null, $r->has_injury ? 'Cedera: '.$r->injury_notes : null])->filter()->join(' · ') }}</span>@else<span class="text-lagoon-600">Sehat</span>@endif</td>
                @else
                    <td colspan="5"><span class="badge-gold">Belum mengisi</span></td>
                @endif
                <td class="text-right"><a href="{{ route('physical.student', $row['student']) }}" class="btn-soft btn-sm">Riwayat</a></td>
            </tr>
        @empty
            <tr><td colspan="7" class="py-10 text-center text-ink-400">Tidak ada data.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
</x-layouts.app>
