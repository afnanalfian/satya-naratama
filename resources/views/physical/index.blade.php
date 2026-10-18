@extends('layouts.app')

@section('title', 'Monitoring Data Fisik')

@php
    $num = fn ($v) => $v === null ? '–' : rtrim(rtrim(number_format($v, 1, ',', '.'), '0'), ',');
    $bmiLabels = ['kurus_berat' => 'Kurus berat', 'kurus' => 'Kurus', 'normal' => 'Normal', 'gemuk' => 'Gemuk', 'obesitas' => 'Obesitas'];
    $q2 = fn ($extra) => route('physical.index', array_merge(array_filter(['month' => $period->format('Y-m'), 'q' => $q ?: null, 'filter' => $filter]), $extra));
@endphp

@section('content')
<div class="py-6 md:py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-3 mb-6">
            <div>
                <h1 class="text-2xl font-bold text-primary-900 dark:text-white">Monitoring Data Fisik</h1>
                <p class="text-sm text-secondary-500 dark:text-secondary-400 mt-1">Tinggi, berat, penyakit & cedera bulanan yang diisi siswa.</p>
            </div>
            <form method="GET" class="flex items-center gap-2">
                <a href="{{ $q2(['month' => $period->copy()->subMonth()->format('Y-m')]) }}" class="p-2.5 rounded-xl border border-primary-200 dark:border-primary-700/50 text-secondary-600 dark:text-secondary-300 hover:bg-primary-50 dark:hover:bg-primary-800/30" title="Bulan sebelumnya">‹</a>
                <input type="month" name="month" value="{{ $period->format('Y-m') }}" onchange="this.form.submit()"
                       class="rounded-xl border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-sm text-primary-800 dark:text-primary-100">
                <a href="{{ $q2(['month' => $period->copy()->addMonth()->format('Y-m')]) }}" class="p-2.5 rounded-xl border border-primary-200 dark:border-primary-700/50 text-secondary-600 dark:text-secondary-300 hover:bg-primary-50 dark:hover:bg-primary-800/30" title="Bulan berikutnya">›</a>
            </form>
        </div>

        {{-- KPI --}}
        @php $fillPct = $kpi['total'] ? round($kpi['filled'] / $kpi['total'] * 100) : 0; @endphp
        <div class="grid grid-cols-2 lg:grid-cols-5 gap-4 mb-6">
            <div class="col-span-2 lg:col-span-1 bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 p-5 shadow-sm">
                <p class="text-xs font-medium text-secondary-500 dark:text-secondary-400">Sudah mengisi · {{ $period->translatedFormat('F Y') }}</p>
                <p class="mt-2 text-3xl font-bold tabular-nums text-primary-900 dark:text-white">{{ $kpi['filled'] }}<span class="text-base text-secondary-400">/{{ $kpi['total'] }}</span></p>
                <div class="mt-2 h-1.5 rounded-full bg-primary-100 dark:bg-primary-800/40 overflow-hidden"><div class="h-full bg-primary-500 rounded-full" style="width: {{ $fillPct }}%"></div></div>
            </div>
            <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 p-5 shadow-sm">
                <p class="text-xs font-medium text-secondary-500 dark:text-secondary-400">Rata-rata TB</p>
                <p class="mt-2 text-3xl font-bold tabular-nums text-primary-900 dark:text-white">{{ $num($kpi['avg_height']) }} <span class="text-sm">cm</span></p>
            </div>
            <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 p-5 shadow-sm">
                <p class="text-xs font-medium text-secondary-500 dark:text-secondary-400">Rata-rata BB</p>
                <p class="mt-2 text-3xl font-bold tabular-nums text-primary-900 dark:text-white">{{ $num($kpi['avg_weight']) }} <span class="text-sm">kg</span></p>
            </div>
            <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 p-5 shadow-sm">
                <p class="text-xs font-medium text-secondary-500 dark:text-secondary-400">Rata-rata IMT</p>
                <p class="mt-2 text-3xl font-bold tabular-nums text-primary-900 dark:text-white">{{ $num($kpi['avg_bmi']) }}</p>
            </div>
            <a href="{{ $q2(['filter' => 'health']) }}" class="bg-white dark:bg-primary-900/30 rounded-2xl border p-5 shadow-sm hover:shadow-md transition {{ $kpi['illness'] + $kpi['injury'] ? 'border-red-200 dark:border-red-800/40' : 'border-primary-100 dark:border-primary-800/30' }}">
                <p class="text-xs font-medium text-secondary-500 dark:text-secondary-400">Sakit · Cedera</p>
                <p class="mt-2 text-3xl font-bold tabular-nums {{ $kpi['illness'] + $kpi['injury'] ? 'text-red-600 dark:text-red-400' : 'text-primary-900 dark:text-white' }}">{{ $kpi['illness'] }} · {{ $kpi['injury'] }}</p>
                <p class="text-xs text-secondary-500 dark:text-secondary-400">klik untuk melihat</p>
            </a>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-6">
            <div class="xl:col-span-2 bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 p-5 shadow-sm">
                <h2 class="font-semibold text-primary-800 dark:text-primary-100">Tren Rata-rata 12 Bulan</h2>
                <p class="text-xs text-secondary-500 dark:text-secondary-400 mb-3">Rata-rata seluruh siswa aktif yang mengisi pada bulan tsb</p>
                @include('physical.partials.charts', ['chart' => $trend, 'prefix' => 'trend'])
            </div>
            <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 p-5 shadow-sm">
                <h2 class="font-semibold text-primary-800 dark:text-primary-100">Sebaran IMT</h2>
                <p class="text-xs text-secondary-500 dark:text-secondary-400 mb-4">{{ $period->translatedFormat('F Y') }} · kategori Kemenkes</p>
                @php $maxB = max(1, max($bmiBuckets)); @endphp
                <div class="space-y-3">
                    @foreach($bmiBuckets as $k => $n)
                        <div>
                            <div class="flex justify-between text-xs mb-1"><span class="text-secondary-600 dark:text-secondary-300">{{ $bmiLabels[$k] }}</span><span class="font-semibold tabular-nums text-primary-800 dark:text-primary-100">{{ $n }}</span></div>
                            <div class="h-2.5 rounded-full bg-primary-50 dark:bg-primary-800/30 overflow-hidden">
                                <div class="h-full rounded-full {{ $k === 'normal' ? 'bg-emerald-500' : (in_array($k, ['kurus', 'gemuk']) ? 'bg-amber-500' : 'bg-red-500') }}" style="width: {{ $n / $maxB * 100 }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Tabel --}}
        <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 shadow-sm overflow-hidden">
            <div class="px-5 py-4 border-b border-primary-100 dark:border-primary-800/30 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                <div class="flex flex-wrap gap-1.5">
                    @foreach(['' => 'Semua', 'missing' => 'Belum mengisi', 'health' => 'Sakit / cedera'] as $f => $label)
                        <a href="{{ $q2(['filter' => $f ?: null]) }}" class="px-3 py-1.5 rounded-lg text-xs font-medium {{ ($filter ?? '') === $f ? 'bg-primary-600 text-white' : 'bg-primary-50 dark:bg-primary-800/30 text-secondary-600 dark:text-secondary-300' }}">{{ $label }}</a>
                    @endforeach
                </div>
                <form method="GET" class="flex gap-2">
                    <input type="hidden" name="month" value="{{ $period->format('Y-m') }}">
                    @if($filter)<input type="hidden" name="filter" value="{{ $filter }}">@endif
                    <input type="text" name="q" value="{{ $q }}" placeholder="Cari nama..." class="rounded-xl border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-sm text-primary-800 dark:text-primary-100">
                </form>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-primary-50/60 dark:bg-primary-800/20 text-xs uppercase tracking-wide text-secondary-500 dark:text-secondary-400">
                        <tr>
                            <th class="px-5 py-3 text-left">Siswa</th>
                            <th class="px-3 py-3 text-right">TB (cm)</th>
                            <th class="px-3 py-3 text-right">BB (kg)</th>
                            <th class="px-3 py-3 text-left">IMT</th>
                            <th class="px-3 py-3 text-left">Kesehatan</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-primary-100 dark:divide-primary-800/30">
                        @forelse($rows as $row)
                            @php $r = $row['record']; $p = $row['previous']; @endphp
                            <tr class="align-top hover:bg-primary-50/40 dark:hover:bg-primary-800/10">
                                <td class="px-5 py-3">
                                    <a href="{{ route('physical.student', $row['student']) }}" class="font-medium text-primary-800 dark:text-primary-100 hover:underline">{{ $row['student']->name }}</a>
                                    <p class="text-xs text-secondary-500 dark:text-secondary-400">{{ $row['student']->studentRegistration?->gender === 'P' ? 'Putri' : 'Putra' }}</p>
                                </td>
                                @if($r)
                                    <td class="px-3 py-3 text-right tabular-nums text-primary-800 dark:text-primary-100">{{ $num($r->height_cm) }}
                                        @if($p && $r->height_cm != $p->height_cm)<span class="block text-[10px] text-secondary-500">{{ $r->height_cm > $p->height_cm ? '+' : '' }}{{ $num($r->height_cm - $p->height_cm) }}</span>@endif
                                    </td>
                                    <td class="px-3 py-3 text-right tabular-nums text-primary-800 dark:text-primary-100">{{ $num($r->weight_kg) }}
                                        @if($p && $r->weight_kg != $p->weight_kg)<span class="block text-[10px] text-secondary-500">{{ $r->weight_kg > $p->weight_kg ? '+' : '' }}{{ $num($r->weight_kg - $p->weight_kg) }}</span>@endif
                                    </td>
                                    <td class="px-3 py-3">@include('physical.partials.bmi-badge', ['bmi' => $r->bmi])</td>
                                    <td class="px-3 py-3 text-xs">
                                        @if($r->has_illness)<p class="text-red-700 dark:text-red-300"><strong>Sakit:</strong> {{ $r->illness_notes }}</p>@endif
                                        @if($r->has_injury)<p class="text-red-700 dark:text-red-300"><strong>Cedera:</strong> {{ $r->injury_notes }}</p>@endif
                                        @unless($r->hasHealthIssue())<span class="text-emerald-600 dark:text-emerald-400">Sehat</span>@endunless
                                    </td>
                                @else
                                    <td colspan="4" class="px-3 py-3 text-xs text-amber-700 dark:text-amber-300">Belum mengisi data bulan ini</td>
                                @endif
                                <td class="px-4 py-3 text-right"><a href="{{ route('physical.student', $row['student']) }}" class="text-xs font-medium text-primary-600 dark:text-primary-300 hover:underline">Riwayat</a></td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="px-5 py-12 text-center text-secondary-500 dark:text-secondary-400">Tidak ada data.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
