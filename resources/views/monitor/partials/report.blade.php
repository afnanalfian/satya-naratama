{{--
    Rapor perkembangan siswa (presensi, tryout, evaluasi jasmani, data fisik).
    Dipakai oleh link publik orang tua & halaman monitoring internal.
    Variabel: $student, $attendance, $tryouts, $jasmani, $physical
--}}
@php
    $num = fn ($v, $d = 1) => $v === null ? '–' : rtrim(rtrim(number_format($v, $d, ',', '.'), '0'), ',');
    $reg = $student->studentRegistration;
    $items = \App\Models\PhysicalEvaluation::ITEMS;
    $gender = $jasmani['gender'];
    $card = 'bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 shadow-sm';
@endphp

{{-- Profil --}}
<section class="{{ $card }} overflow-hidden">
    <div class="h-20 bg-gradient-to-r from-primary-600 to-primary-800"></div>
    <div class="px-5 pb-5 -mt-10 flex flex-col sm:flex-row sm:items-end gap-4">
        <img src="{{ $student->avatar_url }}" alt="" class="w-20 h-20 rounded-2xl object-cover ring-4 ring-white dark:ring-primary-900 shadow-md bg-white">
        <div class="flex-1 min-w-0">
            <h1 class="text-xl md:text-2xl font-bold text-primary-900 dark:text-white truncate">{{ $reg?->full_name ?: $student->name }}</h1>
            <p class="text-sm text-secondary-500 dark:text-secondary-400">
                {{ collect([$reg?->class ? 'Kelas ' . $reg->class : null, $reg?->school_origin, $reg?->priority_university_1 ? 'Target: ' . $reg->priority_university_1 : null])->filter()->join(' · ') }}
            </p>
        </div>
        <p class="text-xs text-secondary-400 dark:text-secondary-500">Diperbarui {{ now()->translatedFormat('d F Y, H:i') }} WIB</p>
    </div>
    <nav class="px-5 pb-4 flex flex-wrap gap-2 text-sm">
        @foreach(['presensi' => 'Presensi', 'tryout' => 'Tryout', 'jasmani' => 'Evaluasi Jasmani', 'fisik' => 'Data Fisik'] as $id => $label)
            <a href="#{{ $id }}" class="px-3 py-1.5 rounded-lg bg-primary-50 dark:bg-primary-800/30 text-primary-700 dark:text-primary-200 hover:bg-primary-100 dark:hover:bg-primary-800/60">{{ $label }}</a>
        @endforeach
    </nav>
</section>

{{-- ================= PRESENSI ================= --}}
<section id="presensi" class="scroll-mt-6 space-y-4">
    <h2 class="text-lg font-bold text-primary-900 dark:text-white">Presensi</h2>
    @include('attendance.partials.summary-tiles', ['summary' => $attendance['summary']])

    <div class="grid grid-cols-1 lg:grid-cols-5 gap-4">
        <div class="lg:col-span-3 {{ $card }} p-5">
            <h3 class="font-semibold text-primary-800 dark:text-primary-100">Kehadiran per Pekan</h3>
            <p class="text-xs text-secondary-500 dark:text-secondary-400 mb-3">% hadir dari pertemuan yang selesai pada pekan tsb</p>
            @if(count($attendance['weekly']['labels']))
                <div class="h-60"><canvas id="rep-weekly" role="img" aria-label="Grafik kehadiran per pekan"></canvas></div>
            @else
                <p class="py-10 text-center text-sm text-secondary-500 dark:text-secondary-400">Belum ada pertemuan yang selesai.</p>
            @endif
        </div>
        <div class="lg:col-span-2 {{ $card }} p-5">
            <h3 class="font-semibold text-primary-800 dark:text-primary-100">Pertemuan Terakhir</h3>
            <div class="max-h-72 overflow-y-auto pr-1">
                @include('attendance.partials.history-list', ['history' => $attendance['history']])
            </div>
        </div>
    </div>
</section>

{{-- ================= TRYOUT ================= --}}
<section id="tryout" class="scroll-mt-6 space-y-4">
    <h2 class="text-lg font-bold text-primary-900 dark:text-white">Tryout Akademik</h2>
    @if($tryouts['rows']->isEmpty())
        <div class="{{ $card }} p-8 text-center text-sm text-secondary-500 dark:text-secondary-400">Belum ada tryout yang dikerjakan.</div>
    @else
        @php $last = $tryouts['last']; @endphp
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="{{ $card }} p-4">
                <p class="text-xs text-secondary-500 dark:text-secondary-400">Tryout diikuti</p>
                <p class="text-2xl font-bold tabular-nums text-primary-900 dark:text-white">{{ $tryouts['rows']->count() }}</p>
            </div>
            <div class="{{ $card }} p-4">
                <p class="text-xs text-secondary-500 dark:text-secondary-400">Nilai terakhir</p>
                <p class="text-2xl font-bold tabular-nums text-primary-900 dark:text-white">{{ $num($last->score) }}</p>
                <p class="text-[11px] text-secondary-500 dark:text-secondary-400 truncate">{{ $last->title }}</p>
            </div>
            <div class="{{ $card }} p-4">
                <p class="text-xs text-secondary-500 dark:text-secondary-400">Peringkat terakhir</p>
                <p class="text-2xl font-bold tabular-nums text-primary-900 dark:text-white">{{ $last->rank }}<span class="text-sm text-secondary-400">/{{ $last->participants }}</span></p>
            </div>
            <div class="{{ $card }} p-4">
                <p class="text-xs text-secondary-500 dark:text-secondary-400">Memenuhi passing grade</p>
                <p class="text-2xl font-bold tabular-nums text-primary-900 dark:text-white">{{ $tryouts['passed'] }}<span class="text-sm text-secondary-400">/{{ $tryouts['rows']->count() }}</span></p>
            </div>
        </div>

        <div class="grid grid-cols-1 {{ count($tryouts['series']) > 1 ? 'lg:grid-cols-2' : '' }} gap-4">
            @foreach($tryouts['series'] as $i => $s)
                <div class="{{ $card }} p-5">
                    <div class="flex items-start justify-between gap-2 mb-3">
                        <div>
                            <h3 class="font-semibold text-primary-800 dark:text-primary-100">Perkembangan Nilai {{ $s['label'] }}</h3>
                            <p class="text-xs text-secondary-500 dark:text-secondary-400">Garis putus-putus = rata-rata seluruh peserta</p>
                        </div>
                    </div>
                    <div class="h-60"><canvas id="rep-tryout-{{ $i }}" role="img" aria-label="Grafik nilai tryout {{ $s['label'] }}"></canvas></div>
                </div>
            @endforeach
        </div>

        <div class="{{ $card }} overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-primary-50/60 dark:bg-primary-800/20 text-xs uppercase tracking-wide text-secondary-500 dark:text-secondary-400">
                        <tr>
                            <th class="px-4 py-3 text-left">Tryout</th>
                            <th class="px-3 py-3 text-right">Nilai</th>
                            <th class="px-3 py-3 text-right">Rata-rata</th>
                            <th class="px-3 py-3 text-center">Peringkat</th>
                            <th class="px-3 py-3 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-primary-100 dark:divide-primary-800/30">
                        @foreach($tryouts['rows'] as $r)
                            <tr>
                                <td class="px-4 py-3">
                                    <p class="font-medium text-primary-800 dark:text-primary-100">{{ $r->title }}</p>
                                    <p class="text-xs text-secondary-500 dark:text-secondary-400">{{ $r->type_label }} · {{ $r->date?->translatedFormat('d M Y') }}</p>
                                </td>
                                <td class="px-3 py-3 text-right font-semibold tabular-nums text-primary-900 dark:text-white">{{ $num($r->score, 2) }}</td>
                                <td class="px-3 py-3 text-right tabular-nums text-secondary-600 dark:text-secondary-300">{{ $num($r->avg) }}</td>
                                <td class="px-3 py-3 text-center tabular-nums text-primary-800 dark:text-primary-100">{{ $r->rank }}/{{ $r->participants }}</td>
                                <td class="px-3 py-3">
                                    @if($r->is_passed === null)
                                        <span class="text-xs text-secondary-400">–</span>
                                    @elseif($r->is_passed)
                                        <span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300">✓ Lulus PG</span>
                                    @else
                                        <span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300">✕ Belum lulus</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</section>

{{-- ================= EVALUASI JASMANI ================= --}}
<section id="jasmani" class="scroll-mt-6 space-y-4">
    <h2 class="text-lg font-bold text-primary-900 dark:text-white">Evaluasi Jasmani</h2>
    @if(! $jasmani['latest'])
        <div class="{{ $card }} p-8 text-center text-sm text-secondary-500 dark:text-secondary-400">Belum ada hasil evaluasi jasmani.</div>
    @else
        @php $lt = $jasmani['latest']; $pv = $jasmani['previous']; @endphp
        <p class="text-sm text-secondary-500 dark:text-secondary-400 -mt-2">
            Hasil terakhir: <strong class="text-primary-800 dark:text-primary-100">{{ $lt->evaluation->period_label }}</strong>
            @if($pv) · dibandingkan {{ $pv->evaluation->period_label }} @endif
        </p>
        <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-5 gap-4">
            @foreach($items as $key => $item)
                @php
                    $v = $lt->{$key}; $p = $pv?->{$key};
                    $delta = ($v !== null && $p !== null) ? $v - $p : null;
                    $improved = $delta ? ($item['better'] === 'low' ? $delta < 0 : $delta > 0) : null;
                @endphp
                <div class="{{ $card }} p-4">
                    <p class="text-xs font-medium text-secondary-500 dark:text-secondary-400">{{ \App\Models\PhysicalEvaluation::itemLabel($key, $gender) }}</p>
                    <p class="mt-1 text-2xl font-bold tabular-nums text-primary-900 dark:text-white">{{ $num($v, 2) }} <span class="text-sm font-medium text-secondary-500">{{ $item['unit'] }}</span></p>
                    @if($improved !== null)
                        <p class="text-xs font-semibold {{ $improved ? 'text-emerald-600 dark:text-emerald-400' : 'text-red-600 dark:text-red-400' }}">
                            {{ $delta > 0 ? '▲' : '▼' }} {{ $num(abs($delta), 2) }} {{ $improved ? 'membaik' : 'menurun' }}
                        </p>
                    @elseif($delta === 0.0 || $delta === 0)
                        <p class="text-xs text-secondary-500">tetap</p>
                    @endif
                    <div class="h-20 mt-2"><canvas id="rep-jas-{{ $key }}" role="img" aria-label="Tren {{ $item['label'] }}"></canvas></div>
                </div>
            @endforeach
        </div>
        <details class="{{ $card }} overflow-hidden">
            <summary class="px-5 py-3 cursor-pointer text-sm font-medium text-primary-700 dark:text-primary-200">Lihat semua hasil evaluasi</summary>
            <div class="overflow-x-auto border-t border-primary-100 dark:border-primary-800/30">
                <table class="w-full text-sm">
                    <thead class="bg-primary-50/60 dark:bg-primary-800/20 text-xs uppercase text-secondary-500 dark:text-secondary-400">
                        <tr>
                            <th class="px-4 py-2.5 text-left">Bulan</th>
                            @foreach($items as $key => $item)<th class="px-3 py-2.5 text-right">{{ \App\Models\PhysicalEvaluation::itemLabel($key, $gender) }}</th>@endforeach
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-primary-100 dark:divide-primary-800/30">
                        @foreach($jasmani['results'] as $r)
                            <tr>
                                <td class="px-4 py-2.5 font-medium text-primary-800 dark:text-primary-100">{{ $r->evaluation->period_label }}</td>
                                @foreach($items as $key => $item)<td class="px-3 py-2.5 text-right tabular-nums text-primary-800 dark:text-primary-100">{{ $num($r->{$key}, 2) }}</td>@endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </details>
    @endif
</section>

{{-- ================= DATA FISIK ================= --}}
<section id="fisik" class="scroll-mt-6 space-y-4">
    <h2 class="text-lg font-bold text-primary-900 dark:text-white">Data Fisik & Kesehatan</h2>
    @if(! $physical['latest'])
        <div class="{{ $card }} p-8 text-center text-sm text-secondary-500 dark:text-secondary-400">Belum ada data fisik bulanan.</div>
    @else
        @php $lp = $physical['latest']; $fp = $physical['first']; @endphp
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="{{ $card }} p-4">
                <p class="text-xs text-secondary-500 dark:text-secondary-400">Tinggi · {{ $lp->period_label }}</p>
                <p class="text-2xl font-bold tabular-nums text-primary-900 dark:text-white">{{ $num($lp->height_cm) }} <span class="text-sm">cm</span></p>
                @if($fp && $fp->id !== $lp->id)<p class="text-[11px] text-secondary-500">{{ $lp->height_cm - $fp->height_cm >= 0 ? '+' : '' }}{{ $num($lp->height_cm - $fp->height_cm) }} cm sejak {{ $fp->period_label }}</p>@endif
            </div>
            <div class="{{ $card }} p-4">
                <p class="text-xs text-secondary-500 dark:text-secondary-400">Berat · {{ $lp->period_label }}</p>
                <p class="text-2xl font-bold tabular-nums text-primary-900 dark:text-white">{{ $num($lp->weight_kg) }} <span class="text-sm">kg</span></p>
                @if($fp && $fp->id !== $lp->id)<p class="text-[11px] text-secondary-500">{{ $lp->weight_kg - $fp->weight_kg >= 0 ? '+' : '' }}{{ $num($lp->weight_kg - $fp->weight_kg) }} kg sejak {{ $fp->period_label }}</p>@endif
            </div>
            <div class="{{ $card }} p-4">
                <p class="text-xs text-secondary-500 dark:text-secondary-400">Indeks Massa Tubuh</p>
                <p class="text-2xl font-bold tabular-nums text-primary-900 dark:text-white">{{ $num($lp->bmi) }}</p>
                <p class="text-[11px] text-secondary-500">{{ $lp->bmi_category['label'] ?? '' }}</p>
            </div>
            <div class="{{ $card }} p-4">
                <p class="text-xs text-secondary-500 dark:text-secondary-400">Kondisi {{ $lp->period_label }}</p>
                <p class="text-lg font-bold {{ $lp->hasHealthIssue() ? 'text-red-600 dark:text-red-400' : 'text-emerald-600 dark:text-emerald-400' }}">
                    {{ $lp->hasHealthIssue() ? collect([$lp->has_illness ? 'Sakit' : null, $lp->has_injury ? 'Cedera' : null])->filter()->join(' & ') : 'Sehat' }}
                </p>
            </div>
        </div>

        <div class="{{ $card }} p-5">
            @include('physical.partials.charts', ['chart' => $physical['chart'], 'prefix' => 'rep-fis'])
        </div>

        <div class="{{ $card }} p-5">
            <h3 class="font-semibold text-primary-800 dark:text-primary-100 mb-2">Riwayat Penyakit & Cedera</h3>
            @forelse($physical['health'] as $h)
                <div class="flex gap-3 py-2.5 border-t first:border-t-0 border-primary-100 dark:border-primary-800/30">
                    <p class="w-24 shrink-0 text-sm font-medium text-primary-800 dark:text-primary-100">{{ $h->period_label }}</p>
                    <div class="text-sm space-y-0.5">
                        @if($h->has_illness)<p class="text-red-700 dark:text-red-300"><strong>Sakit:</strong> {{ $h->illness_notes }}</p>@endif
                        @if($h->has_injury)<p class="text-red-700 dark:text-red-300"><strong>Cedera:</strong> {{ $h->injury_notes }}</p>@endif
                    </div>
                </div>
            @empty
                <p class="text-sm text-emerald-600 dark:text-emerald-400">Tidak ada catatan penyakit maupun cedera.</p>
            @endforelse
        </div>
    @endif
</section>

@push('scripts')
@include('partials.charts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const w = @json($attendance['weekly']);
    SNChart.render('rep-weekly', {
        type: 'line', labels: w.labels, tooltipTitles: w.ranges, ySuffix: '%', yMin: 0, yMax: 100,
        datasets: [
            { label: 'Akademik', data: w.akademik, color: 'akademik' },
            { label: 'Jasmani', data: w.jasmani, color: 'jasmani' },
        ],
    });

    (@json($tryouts['series'])).forEach((s, i) => {
        SNChart.render('rep-tryout-' + i, {
            type: 'line', labels: s.labels, tooltipTitles: s.titles,
            datasets: [
                { label: 'Nilai', data: s.scores, color: 'primary' },
                { label: 'Rata-rata peserta', data: s.avgs, color: 'muted', dashed: true },
            ],
        });
    });

    const js = @json($jasmani['series']);
    const items = @json($items);
    Object.keys(items).forEach((k) => {
        const el = document.getElementById('rep-jas-' + k);
        if (!el) return;
        SNChart.render(el, {
            type: 'line', labels: js.labels, legend: false, sparkline: true,
            ySuffix: ' ' + (items[k].unit === 'detik' ? 's' : items[k].unit),
            datasets: [{ label: items[k].label, data: js[k], color: 'jasmani' }],
        });
    });
});
</script>
@endpush
