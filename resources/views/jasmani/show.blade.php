@extends('layouts.app')

@section('title', $evaluation->title)

@php
    $num = fn ($v, $d = 2) => $v === null ? '–' : rtrim(rtrim(number_format($v, $d, ',', '.'), '0'), ',');
    $q = fn ($extra) => route('jasmani.show', array_merge(['evaluation' => $evaluation], array_filter(array_merge(['gender' => $gender, 'sort' => $sort], $extra))));
@endphp

@section('content')
<div class="py-6 md:py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-sm mb-6">
            <a href="{{ route('jasmani.index') }}" class="text-secondary-500 hover:text-primary-600 dark:text-secondary-400 dark:hover:text-primary-300">Evaluasi Jasmani</a>
            <span class="text-secondary-300 dark:text-secondary-600">/</span>
            <span class="text-primary-600 dark:text-primary-300 font-medium">{{ $evaluation->period_label }}</span>
        </nav>

        {{-- Header --}}
        <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 p-5 md:p-6 shadow-sm mb-6 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-[#c2570f] dark:text-[#d96a26]">Evaluasi Jasmani · {{ $evaluation->period_label }}</p>
                <h1 class="text-xl md:text-2xl font-bold text-primary-900 dark:text-white mt-1">{{ $evaluation->title }}</h1>
                <p class="text-sm text-secondary-500 dark:text-secondary-400 mt-1">
                    {{ $evaluation->held_on->translatedFormat('l, d F Y') }}{{ $evaluation->location ? ' · ' . $evaluation->location : '' }}
                    · {{ $evaluation->results->count() }} peserta
                </p>
                @if($evaluation->notes)<p class="text-sm text-secondary-600 dark:text-secondary-300 mt-2">{{ $evaluation->notes }}</p>@endif
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('jasmani.input', $evaluation) }}" class="px-4 py-2.5 rounded-xl bg-primary-600 hover:bg-primary-700 text-white text-sm font-semibold">Input / Ubah Hasil</a>
                <a href="{{ route('jasmani.export', $evaluation) }}" class="px-4 py-2.5 rounded-xl border border-primary-200 dark:border-primary-700/50 text-sm font-medium text-primary-700 dark:text-primary-200 hover:bg-primary-50 dark:hover:bg-primary-800/30">Export CSV</a>
                <a href="{{ route('jasmani.edit', $evaluation) }}" class="px-4 py-2.5 rounded-xl border border-primary-200 dark:border-primary-700/50 text-sm font-medium text-primary-700 dark:text-primary-200 hover:bg-primary-50 dark:hover:bg-primary-800/30">Ubah Info</a>
                @role('admin')
                <form method="POST" action="{{ route('jasmani.destroy', $evaluation) }}" class="sweet-confirm" data-message="Hapus evaluasi ini beserta seluruh hasilnya?">
                    @csrf @method('DELETE')
                    <button class="px-4 py-2.5 rounded-xl bg-red-50 text-red-600 hover:bg-red-100 dark:bg-red-900/20 dark:text-red-400 text-sm font-medium">Hapus</button>
                </form>
                @endrole
            </div>
        </div>

        {{-- Statistik per item --}}
        <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-5 gap-4 mb-6">
            @foreach($items as $key => $item)
                @php $st = $stats[$key]; @endphp
                <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 p-4 shadow-sm">
                    <p class="text-sm font-semibold text-primary-800 dark:text-primary-100">{{ $item['label'] }}</p>
                    <p class="text-[11px] text-secondary-500 dark:text-secondary-400">{{ $item['unit'] }} · {{ $st['count'] }} data</p>
                    <div class="mt-3 grid grid-cols-2 gap-2">
                        <div>
                            <p class="text-[11px] text-secondary-500 dark:text-secondary-400 flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-[#2a6fdb] dark:bg-[#4a8ae6]"></span>{{ $key === 'pull_up_chinning' ? 'Pull up' : 'Putra' }}</p>
                            <p class="text-lg font-bold tabular-nums text-primary-900 dark:text-white">{{ $num($st['by_gender']['L'], 1) }}</p>
                        </div>
                        <div>
                            <p class="text-[11px] text-secondary-500 dark:text-secondary-400 flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-[#c2570f] dark:bg-[#d96a26]"></span>{{ $key === 'pull_up_chinning' ? 'Chinning' : 'Putri' }}</p>
                            <p class="text-lg font-bold tabular-nums text-primary-900 dark:text-white">{{ $num($st['by_gender']['P'], 1) }}</p>
                        </div>
                    </div>
                    @if($key !== 'pull_up_chinning')
                        <p class="text-[11px] text-secondary-500 dark:text-secondary-400 mt-2">Terbaik: <span class="font-semibold text-primary-800 dark:text-primary-100 tabular-nums">{{ $num($st['best']) }}</span></p>
                    @endif
                </div>
            @endforeach
        </div>

        {{-- Grafik peringkat item terpilih --}}
        @if($sort && $results->whereNotNull($sort)->count())
            <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 p-5 shadow-sm mb-6">
                <h2 class="font-semibold text-primary-800 dark:text-primary-100">Peringkat {{ $items[$sort]['label'] }}</h2>
                <div class="flex flex-wrap items-center justify-between gap-2 mb-3">
                    <p class="text-xs text-secondary-500 dark:text-secondary-400">{{ $items[$sort]['better'] === 'low' ? 'Waktu tercepat di atas' : 'Nilai tertinggi di atas' }}{{ $gender ? ' · ' . ($gender === 'L' ? 'putra' : 'putri') : '' }}</p>
                    <div class="flex items-center gap-4 text-xs text-secondary-600 dark:text-secondary-300">
                        <span class="inline-flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-[#2a6fdb] dark:bg-[#4a8ae6]"></span>Putra</span>
                        <span class="inline-flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-[#c2570f] dark:bg-[#d96a26]"></span>Putri</span>
                    </div>
                </div>
                <div style="height: {{ max(160, $results->whereNotNull($sort)->count() * 26 + 40) }}px"><canvas id="rankChart"></canvas></div>
            </div>
        @endif

        {{-- Tabel hasil --}}
        <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 shadow-sm overflow-hidden mb-6">
            <div class="px-5 py-4 border-b border-primary-100 dark:border-primary-800/30 flex flex-wrap items-center justify-between gap-3">
                <div>
                    <h2 class="font-semibold text-primary-800 dark:text-primary-100">Hasil per Siswa</h2>
                    <p class="text-xs text-secondary-500 dark:text-secondary-400">
                        Klik judul kolom untuk mengurutkan.
                        @if($previous) Tanda ▲▼ = perubahan dibanding {{ $previous->period_label }} (hijau = membaik). @endif
                    </p>
                </div>
                <div class="flex gap-1.5">
                    @foreach(['' => 'Semua', 'L' => 'Putra', 'P' => 'Putri'] as $g => $label)
                        <a href="{{ $q(['gender' => $g ?: null]) }}" class="px-3 py-1.5 rounded-lg text-xs font-medium {{ ($gender ?? '') === $g ? 'bg-primary-600 text-white' : 'bg-primary-50 dark:bg-primary-800/30 text-secondary-600 dark:text-secondary-300' }}">{{ $label }}</a>
                    @endforeach
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-primary-50/60 dark:bg-primary-800/20 text-xs uppercase tracking-wide text-secondary-500 dark:text-secondary-400">
                        <tr>
                            <th class="px-4 py-3 text-left w-10">No</th>
                            <th class="px-4 py-3 text-left"><a href="{{ $q(['sort' => null]) }}">Nama</a></th>
                            <th class="px-2 py-3 text-center">L/P</th>
                            @foreach($items as $key => $item)
                                <th class="px-3 py-3 text-right whitespace-nowrap">
                                    <a href="{{ $q(['sort' => $key]) }}" class="{{ $sort === $key ? 'text-primary-700 dark:text-primary-200 underline' : '' }}">{{ $item['short'] }}</a>
                                    <span class="block normal-case font-normal">({{ $item['unit'] }})</span>
                                </th>
                            @endforeach
                            <th class="px-4 py-3 text-left">Catatan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-primary-100 dark:divide-primary-800/30">
                        @forelse($results as $i => $r)
                            @php $prev = $prevByUser->get($r->user_id); @endphp
                            <tr class="hover:bg-primary-50/40 dark:hover:bg-primary-800/10">
                                <td class="px-4 py-2.5 text-secondary-500 tabular-nums">{{ $i + 1 }}</td>
                                <td class="px-4 py-2.5">
                                    <a href="{{ route('monitor.student', $r->user_id) }}" class="font-medium text-primary-800 dark:text-primary-100 hover:underline">{{ $r->user?->name }}</a>
                                </td>
                                <td class="px-2 py-2.5 text-center text-xs font-semibold {{ $r->gender === 'P' ? 'text-[#c2570f] dark:text-[#d96a26]' : 'text-[#2a6fdb] dark:text-[#4a8ae6]' }}">{{ $r->gender ?? '?' }}</td>
                                @foreach($items as $key => $item)
                                    @php
                                        $v = $r->{$key}; $pv = $prev?->{$key};
                                        $delta = ($v !== null && $pv !== null) ? $v - $pv : null;
                                        $improved = $delta !== null && $delta != 0 ? ($item['better'] === 'low' ? $delta < 0 : $delta > 0) : null;
                                    @endphp
                                    <td class="px-3 py-2.5 text-right tabular-nums text-primary-800 dark:text-primary-100 whitespace-nowrap">
                                        {{ $num($v) }}
                                        @if($key === 'pull_up_chinning' && $v !== null)<span class="text-[10px] text-secondary-400">{{ $r->gender === 'P' ? 'chin' : 'pull' }}</span>@endif
                                        @if($improved !== null)
                                            <span class="block text-[10px] font-semibold {{ $improved ? 'text-emerald-600 dark:text-emerald-400' : 'text-red-600 dark:text-red-400' }}">
                                                {{ $delta > 0 ? '▲' : '▼' }} {{ $num(abs($delta)) }}
                                            </span>
                                        @endif
                                    </td>
                                @endforeach
                                <td class="px-4 py-2.5 text-xs text-secondary-500 dark:text-secondary-400">{{ $r->notes }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="{{ count($items) + 4 }}" class="px-5 py-12 text-center text-secondary-500 dark:text-secondary-400">
                                Belum ada hasil. <a href="{{ route('jasmani.input', $evaluation) }}" class="text-primary-600 dark:text-primary-300 underline">Input hasil sekarang</a>.
                            </td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($missing->isNotEmpty())
            <div class="rounded-2xl border border-amber-200 bg-amber-50 dark:border-amber-800/40 dark:bg-amber-900/20 p-4">
                <p class="text-sm font-semibold text-amber-800 dark:text-amber-200">{{ $missing->count() }} siswa aktif belum memiliki hasil pada evaluasi ini</p>
                <p class="text-xs text-amber-700 dark:text-amber-300 mt-1">{{ $missing->pluck('name')->join(', ') }}</p>
            </div>
        @endif
    </div>
</div>
@endsection

@if($sort && $results->whereNotNull($sort)->count())
@push('scripts')
@include('partials.charts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const rows = @json($results->whereNotNull($sort)->values()->map(fn ($r) => ['name' => $r->user?->name, 'v' => $r->{$sort}, 'g' => $r->gender]));
    SNChart.render('rankChart', {
        type: 'bar', horizontal: true, labels: rows.map(r => r.name),
        ySuffix: ' {{ $items[$sort]['unit'] === 'detik' ? 's' : $items[$sort]['unit'] }}',
        datasets: [{ label: @json($items[$sort]['label']), data: rows.map(r => r.v), colors: rows.map(r => r.g === 'P' ? 'female' : 'male') }],
    });
});
</script>
@endpush
@endif
