@if(count($chart['labels']))
<div class="h-64" x-data="chart({ type: 'line', data: { labels: @js($chart['labels']), datasets: [
    { label: 'Tinggi (cm)', data: @js($chart['height']), borderColor: '#5d4384', backgroundColor: '#5d4384', yAxisID: 'y', tension: .3 },
    { label: 'Berat (kg)', data: @js($chart['weight']), borderColor: '#0fb59e', backgroundColor: '#0fb59e', yAxisID: 'y1', tension: .3 },
    { label: 'IMT', data: @js($chart['bmi']), borderColor: '#f99c07', backgroundColor: '#f99c07', yAxisID: 'y1', borderDash: [5, 4], tension: .3 } ] },
    options: { maintainAspectRatio: false, scales: { y: { position: 'left' }, y1: { position: 'right', grid: { drawOnChartArea: false } } } } })"><canvas x-ref="canvas"></canvas></div>
@else
<x-empty icon="chart" title="Belum ada data" text="Grafik muncul setelah data bulanan diisi." class="!py-10"/>
@endif
