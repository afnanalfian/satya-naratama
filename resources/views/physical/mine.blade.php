@extends('layouts.app')

@section('title', 'Data Fisik Saya')

@section('content')
<div class="py-6 md:py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-primary-900 dark:text-white">Data Fisik Bulanan</h1>
            <p class="text-sm text-secondary-500 dark:text-secondary-400 mt-1">Isi tinggi badan, berat badan, serta kondisi kesehatan Anda setiap bulan.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
            <div class="lg:col-span-2">
                <form method="POST" action="{{ route('physical.mine.store') }}" class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 shadow-sm p-5 space-y-4 lg:sticky lg:top-4">
                    @csrf
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-secondary-500 dark:text-secondary-400">Bulan ini</p>
                            <h2 class="text-lg font-bold text-primary-900 dark:text-white">{{ $period->translatedFormat('F Y') }}</h2>
                        </div>
                        @if($current)
                            <span class="text-[11px] font-semibold px-2 py-1 rounded-full bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300">✓ Sudah diisi</span>
                        @else
                            <span class="text-[11px] font-semibold px-2 py-1 rounded-full bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-300">Belum diisi</span>
                        @endif
                    </div>

                    @if($errors->any())
                        <div class="p-3 rounded-xl bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800/40 text-sm text-red-700 dark:text-red-300">
                            <ul class="list-disc pl-5">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                        </div>
                    @endif

                    @include('physical.partials.form-fields', ['record' => $current ?? ($previous ? new \App\Models\StudentPhysicalRecord(['height_cm' => $previous->height_cm, 'weight_kg' => $previous->weight_kg]) : null)])

                    @if(!$current && $previous)
                        <p class="text-xs text-secondary-500 dark:text-secondary-400">Angka diisi otomatis dari {{ $previous->period_label }} — perbarui sesuai pengukuran terbaru.</p>
                    @endif
                    @if($current?->editor && $current->updated_by !== auth()->id())
                        <p class="text-xs text-secondary-500 dark:text-secondary-400">Terakhir diperbarui oleh {{ $current->editor->name }}.</p>
                    @endif

                    <button class="w-full px-5 py-3 rounded-xl bg-primary-600 hover:bg-primary-700 text-white font-semibold">
                        {{ $current ? 'Perbarui Data' : 'Simpan Data' }}
                    </button>
                </form>
            </div>

            <div class="lg:col-span-3 space-y-6">
                @if($records->isNotEmpty())
                    @php $latest = $records->last(); @endphp
                    <div class="grid grid-cols-3 gap-3">
                        <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 p-4 shadow-sm">
                            <p class="text-xs text-secondary-500 dark:text-secondary-400">Tinggi terakhir</p>
                            <p class="text-2xl font-bold tabular-nums text-primary-900 dark:text-white">{{ rtrim(rtrim(number_format($latest->height_cm, 1, ',', ''), '0'), ',') }} <span class="text-sm font-medium">cm</span></p>
                        </div>
                        <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 p-4 shadow-sm">
                            <p class="text-xs text-secondary-500 dark:text-secondary-400">Berat terakhir</p>
                            <p class="text-2xl font-bold tabular-nums text-primary-900 dark:text-white">{{ rtrim(rtrim(number_format($latest->weight_kg, 1, ',', ''), '0'), ',') }} <span class="text-sm font-medium">kg</span></p>
                        </div>
                        <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 p-4 shadow-sm">
                            <p class="text-xs text-secondary-500 dark:text-secondary-400">IMT</p>
                            <p class="text-2xl font-bold tabular-nums text-primary-900 dark:text-white">{{ number_format($latest->bmi, 1, ',', '') }}</p>
                            <p class="text-xs text-secondary-500 dark:text-secondary-400">{{ $latest->bmi_category['label'] ?? '' }}</p>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 p-5 shadow-sm">
                        <h2 class="font-semibold text-primary-800 dark:text-primary-100 mb-3">Perkembangan</h2>
                        @include('physical.partials.charts', ['chart' => $chart, 'prefix' => 'mine'])
                    </div>
                @endif

                <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b border-primary-100 dark:border-primary-800/30"><h2 class="font-semibold text-primary-800 dark:text-primary-100">Riwayat</h2></div>
                    @include('physical.partials.history-table', ['records' => $records])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
