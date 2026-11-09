<x-layouts.app title="Laporan Pendapatan">
<x-chartjs/>
@php
    $rp = fn ($n) => 'Rp '.number_format((float) $n, 0, ',', '.');
    $byDay = $payments->groupBy(fn ($p) => $p->verified_at->format('Y-m-d'))->map(fn ($g) => $g->sum(fn ($p) => $p->order?->total_amount));
    $labels = []; $vals = [];
    for ($d = $startDate->copy(); $d->lte($endDate); $d->addDay()) { $labels[] = $d->format('d'); $vals[] = (float) ($byDay[$d->toDateString()] ?? 0); }
@endphp
<x-page-header title="Laporan Pendapatan" :sub="$startDate->translatedFormat('F Y')">
    <x-slot:actions>
        <form method="GET" class="flex gap-2"><select name="month" class="select" onchange="this.form.submit()">@foreach($months as $k => $l)<option value="{{ $k }}" @selected($k === $selectedMonth)>{{ $l }}</option>@endforeach</select></form>
        <a href="{{ route('reports.income.export', ['month' => $selectedMonth]) }}" class="btn-primary"><x-icon name="download" class="h-4 w-4"/> PDF</a>
    </x-slot:actions>
</x-page-header>
<div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
    <x-stat label="Total pendapatan" :value="$rp($totalIncome)" icon="wallet" tone="lagoon"/>
    <x-stat label="Transaksi" :value="$payments->count()" icon="receipt" tone="ink"/>
    <x-stat label="Rata-rata / transaksi" :value="$rp($payments->count() ? $totalIncome / $payments->count() : 0)" icon="chart" tone="gold"/>
</div>
<div class="card mt-6 card-pad">
    <p class="section-title">Pendapatan harian</p>
    <div class="mt-4 h-64" x-data="chart({ type: 'bar', data: { labels: @js($labels), datasets: [{ label: 'Pendapatan', data: @js($vals), backgroundColor: '#0fb59e', borderRadius: 6 }] }, options: { maintainAspectRatio: false, plugins: { legend: { display: false }, tooltip: { callbacks: { label: (c) => window.rupiah(c.raw) } } }, scales: { x: { grid: { display: false } } } } })"><canvas x-ref="canvas"></canvas></div>
</div>
<div class="table-wrap mt-6">
    <table class="table">
        <thead><tr><th>Diverifikasi</th><th>Pesanan</th><th>Pembeli</th><th>Metode</th><th class="text-right">Nominal</th></tr></thead>
        <tbody>
        @forelse($payments as $p)
            <tr><td class="whitespace-nowrap text-ink-500">{{ $p->verified_at->translatedFormat('d M Y H:i') }}</td><td>@if($p->order)<a href="{{ route('orders.show', $p->order) }}" class="font-mono text-xs font-bold hover:text-garnet-600">{{ $p->order->order_code }}</a>@endif</td><td class="font-bold">{{ $p->order?->user?->name }}</td><td><span class="badge-ink">{{ $p->method === 'manual_qris' ? 'QRIS' : $p->method }}</span></td><td class="text-right font-bold">{{ $rp($p->order?->total_amount) }}</td></tr>
        @empty
            <tr><td colspan="5" class="py-10 text-center text-ink-400">Tidak ada pendapatan pada bulan ini.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
</x-layouts.app>
