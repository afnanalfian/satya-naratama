{{-- Grafik TB & BB (dua grafik terpisah, satuan berbeda). Butuh: $chart, $prefix --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="rounded-xl border border-primary-100 dark:border-primary-700/30 p-4">
        <p class="text-sm font-semibold text-primary-800 dark:text-primary-100">Tinggi Badan</p>
        <p class="text-[11px] text-secondary-500 dark:text-secondary-400">cm per bulan</p>
        <div class="h-48 mt-2"><canvas id="{{ $prefix }}-height" role="img" aria-label="Grafik tinggi badan"></canvas></div>
    </div>
    <div class="rounded-xl border border-primary-100 dark:border-primary-700/30 p-4">
        <p class="text-sm font-semibold text-primary-800 dark:text-primary-100">Berat Badan</p>
        <p class="text-[11px] text-secondary-500 dark:text-secondary-400">kg per bulan</p>
        <div class="h-48 mt-2"><canvas id="{{ $prefix }}-weight" role="img" aria-label="Grafik berat badan"></canvas></div>
    </div>
</div>
@push('scripts')
@include('partials.charts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const c = @json($chart);
    SNChart.render('{{ $prefix }}-height', { type: 'line', labels: c.labels, ySuffix: ' cm', datasets: [{ label: 'Tinggi', data: c.height, color: 'primary' }] });
    SNChart.render('{{ $prefix }}-weight', { type: 'line', labels: c.labels, ySuffix: ' kg', datasets: [{ label: 'Berat', data: c.weight, color: 'primary' }] });
});
</script>
@endpush
