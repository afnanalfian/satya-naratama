@extends('layouts.app')

@section('title', 'Evaluasi Jasmani')

@php $num = fn ($v, $d = 1) => $v === null ? '–' : rtrim(rtrim(number_format($v, $d, ',', '.'), '0'), ','); @endphp

@section('content')
<div class="py-6 md:py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-3 mb-6">
            <div>
                <h1 class="text-2xl font-bold text-primary-900 dark:text-white">Evaluasi Jasmani</h1>
                <p class="text-sm text-secondary-500 dark:text-secondary-400 mt-1">
                    Tes bulanan: lari 12 menit, pull up (putra) / chinning (putri), push up, sit up, dan shuttle run.
                </p>
            </div>
            <a href="{{ route('jasmani.create') }}"
               class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-primary-600 hover:bg-primary-700 text-white text-sm font-semibold shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                Buat Evaluasi Bulan Ini
            </a>
        </div>

        {{-- Tren rata-rata --}}
        @if($evaluations->count())
        <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 p-5 shadow-sm mb-6">
            <div class="flex flex-wrap items-start justify-between gap-3 mb-4">
                <div>
                    <h2 class="font-semibold text-primary-800 dark:text-primary-100">Tren Rata-rata per Item</h2>
                    <p class="text-xs text-secondary-500 dark:text-secondary-400">Rata-rata putra dan putri dipisah karena standar tesnya berbeda</p>
                </div>
                <div class="flex items-center gap-4 text-xs text-secondary-600 dark:text-secondary-300">
                    <span class="inline-flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-[#2a6fdb] dark:bg-[#4a8ae6]"></span>Putra</span>
                    <span class="inline-flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-[#c2570f] dark:bg-[#d96a26]"></span>Putri</span>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-5 gap-4">
                @foreach($items as $key => $item)
                    <div class="rounded-xl border border-primary-100 dark:border-primary-700/30 p-3">
                        <p class="text-sm font-semibold text-primary-800 dark:text-primary-100">{{ $item['label'] }}</p>
                        <p class="text-[11px] text-secondary-500 dark:text-secondary-400">{{ $item['unit'] }} · {{ $item['better'] === 'low' ? 'makin kecil makin baik' : 'makin besar makin baik' }}</p>
                        <div class="h-36 mt-2"><canvas id="trend-{{ $key }}" role="img" aria-label="Tren {{ $item['label'] }}"></canvas></div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Daftar evaluasi --}}
        <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 shadow-sm overflow-hidden">
            <div class="px-5 py-4 border-b border-primary-100 dark:border-primary-800/30">
                <h2 class="font-semibold text-primary-800 dark:text-primary-100">Riwayat Evaluasi</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-primary-50/60 dark:bg-primary-800/20 text-xs uppercase tracking-wide text-secondary-500 dark:text-secondary-400">
                        <tr>
                            <th class="px-5 py-3 text-left">Periode</th>
                            <th class="px-4 py-3 text-left">Peserta</th>
                            @foreach($items as $item)
                                <th class="px-3 py-3 text-right whitespace-nowrap">{{ $item['short'] }} <span class="normal-case font-normal">({{ $item['unit'] }})</span></th>
                            @endforeach
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-primary-100 dark:divide-primary-800/30">
                        @forelse($evaluations as $e)
                            @php $st = $e->itemStats(); @endphp
                            <tr class="hover:bg-primary-50/40 dark:hover:bg-primary-800/10">
                                <td class="px-5 py-3">
                                    <a href="{{ route('jasmani.show', $e) }}" class="font-semibold text-primary-800 dark:text-primary-100 hover:underline">{{ $e->period_label }}</a>
                                    <p class="text-xs text-secondary-500 dark:text-secondary-400">{{ $e->title }} · {{ $e->held_on->translatedFormat('d M Y') }}</p>
                                </td>
                                <td class="px-4 py-3 tabular-nums text-secondary-700 dark:text-secondary-200">{{ $e->results->count() }} <span class="text-secondary-400 text-xs">siswa</span></td>
                                @foreach($items as $key => $item)
                                    <td class="px-3 py-3 text-right tabular-nums text-primary-800 dark:text-primary-100 whitespace-nowrap">
                                        <span title="Rata-rata putra · putri">{{ $num($st[$key]['by_gender']['L']) }} <span class="text-secondary-400">·</span> {{ $num($st[$key]['by_gender']['P']) }}</span>
                                    </td>
                                @endforeach
                                <td class="px-4 py-3 text-right whitespace-nowrap">
                                    <a href="{{ route('jasmani.input', $e) }}" class="text-xs font-medium text-primary-600 dark:text-primary-300 hover:underline mr-3">Input</a>
                                    <a href="{{ route('jasmani.show', $e) }}" class="text-xs font-medium text-primary-600 dark:text-primary-300 hover:underline">Lihat</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="{{ count($items) + 3 }}" class="px-5 py-14 text-center text-secondary-500 dark:text-secondary-400">
                                Belum ada evaluasi. Klik <strong>Buat Evaluasi Bulan Ini</strong> untuk memulai.
                            </td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($evaluations->count())
                <p class="px-5 py-3 text-[11px] text-secondary-500 dark:text-secondary-400 border-t border-primary-100 dark:border-primary-800/30">Nilai pada tabel: rata-rata putra · rata-rata putri.</p>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
@include('partials.charts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const trend = @json($trend);
    const items = @json($items);
    Object.keys(items).forEach((key) => {
        SNChart.render('trend-' + key, {
            type: 'line', labels: trend.labels, legend: false,
            ySuffix: ' ' + items[key].unit.replace('detik', 's'),
            datasets: [
                { label: key === 'pull_up_chinning' ? 'Pull up (putra)' : 'Putra', data: trend[key].L, color: 'male' },
                { label: key === 'pull_up_chinning' ? 'Chinning (putri)' : 'Putri', data: trend[key].P, color: 'female' },
            ],
        });
    });
});
</script>
@endpush
