<x-layouts.app title="Data Fisik Bulanan">
<x-chartjs/>
<x-page-header title="Data Fisik Bulanan" sub="Perbarui tinggi & berat badan setiap bulan agar pelatih bisa memantau perkembanganmu."/>
<div class="grid gap-6 lg:grid-cols-5">
    <div class="lg:col-span-2">
        <div class="card overflow-hidden">
            <div class="{{ $current ? 'bg-lagoon-500' : 'bg-sunrise' }} p-5 text-white">
                <p class="text-xs font-bold uppercase tracking-widest text-white/80">Periode</p>
                <p class="font-display text-2xl font-extrabold">{{ $period->translatedFormat('F Y') }}</p>
                <p class="mt-1 text-sm text-white/85">{{ $current ? 'Sudah diisi — kamu masih bisa memperbaruinya.' : 'Belum diisi bulan ini.' }}</p>
            </div>
            <div class="p-5">
                @if($previous)<p class="mb-4 rounded-2xl bg-cream p-3 text-xs text-ink-500">Bulan lalu ({{ $previous->period->translatedFormat('F') }}): <b>{{ $previous->height_cm }} cm · {{ $previous->weight_kg }} kg</b></p>@endif
                @include('physical.partials.form', ['action' => route('physical.mine.store'), 'record' => $current, 'withPeriod' => false])
            </div>
        </div>
    </div>
    <div class="space-y-6 lg:col-span-3">
        <div class="card card-pad"><p class="section-title mb-4">Grafik perkembangan</p>@include('physical.partials.chart')</div>
        <div class="table-wrap">
            <table class="table">
                <thead><tr><th>Bulan</th><th class="text-right">Tinggi</th><th class="text-right">Berat</th><th class="text-right">IMT</th><th>Kategori</th><th>Kesehatan</th></tr></thead>
                <tbody>
                @forelse($records->reverse() as $r)
                    <tr><td class="font-bold">{{ $r->period->translatedFormat('M Y') }}</td><td class="text-right">{{ $r->height_cm }} cm</td><td class="text-right">{{ $r->weight_kg }} kg</td><td class="text-right font-bold">{{ $r->bmi ?? '–' }}</td><td><x-bmi-badge :cat="$r->bmi_category"/></td>
                        <td class="text-xs">{{ $r->hasHealthIssue() ? collect([$r->has_illness ? 'Sakit' : null, $r->has_injury ? 'Cedera' : null])->filter()->join(', ') : 'Sehat' }}</td></tr>
                @empty
                    <tr><td colspan="6" class="py-8 text-center text-ink-400">Belum ada data.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</x-layouts.app>
