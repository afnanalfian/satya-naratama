<x-layouts.app :title="'Data Fisik · '.$student->name">
<x-chartjs/>
<x-page-header :title="$student->display_name" sub="Riwayat data fisik bulanan" :back="route('physical.index')">
    <x-slot:actions><a href="{{ route('monitor.student', $student) }}" class="btn-soft"><x-icon name="chart" class="h-4 w-4"/> Rapor</a></x-slot:actions>
</x-page-header>
<div class="grid gap-6 lg:grid-cols-5">
    <div class="space-y-6 lg:col-span-3">
        <div class="card card-pad"><p class="section-title mb-4">Grafik</p>@include('physical.partials.chart')</div>
        <div class="table-wrap">
            <table class="table">
                <thead><tr><th>Bulan</th><th class="text-right">Tinggi</th><th class="text-right">Berat</th><th class="text-right">IMT</th><th>Kesehatan</th><th>Diisi</th>@role('admin')<th></th>@endrole</tr></thead>
                <tbody>
                @forelse($records->reverse() as $r)
                    <tr>
                        <td class="font-bold">{{ $r->period->translatedFormat('M Y') }}</td><td class="text-right">{{ $r->height_cm }}</td><td class="text-right">{{ $r->weight_kg }}</td>
                        <td class="text-right"><span class="font-bold">{{ $r->bmi }}</span> <x-bmi-badge :cat="$r->bmi_category"/></td>
                        <td class="max-w-xs text-xs">{{ $r->hasHealthIssue() ? collect([$r->has_illness ? 'Sakit: '.$r->illness_notes : null, $r->has_injury ? 'Cedera: '.$r->injury_notes : null])->filter()->join(' · ') : 'Sehat' }}</td>
                        <td class="text-xs text-ink-400">{{ $r->editor?->name }}</td>
                        @role('admin')<td><form method="POST" action="{{ route('physical.destroy', $r) }}" data-confirm="Hapus data {{ $r->period->translatedFormat('F Y') }}?">@csrf @method('DELETE')<button class="btn-icon btn-ghost hover:text-garnet-600"><x-icon name="trash" class="h-4 w-4"/></button></form></td>@endrole
                    </tr>
                @empty
                    <tr><td colspan="7" class="py-8 text-center text-ink-400">Belum ada data.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @role('admin')
    <div class="lg:col-span-2">
        <div class="card card-pad"><p class="section-title mb-4">Isi / ubah data bulan tertentu</p>
            @include('physical.partials.form', ['action' => route('physical.student.store', $student), 'record' => null, 'withPeriod' => true])
        </div>
    </div>
    @endrole
</div>
</x-layouts.app>
