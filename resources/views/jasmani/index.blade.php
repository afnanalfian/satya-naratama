<x-layouts.app title="Evaluasi Jasmani">
<x-chartjs/>
<x-page-header title="Evaluasi Jasmani" :sub="'Tes bulanan untuk '.$studentCount.' siswa aktif.'">
    <x-slot:actions><a href="{{ route('jasmani.create') }}" class="btn-primary"><x-icon name="plus" class="h-4 w-4"/> Evaluasi baru</a></x-slot:actions>
</x-page-header>
@if(count($trend['labels']) > 1)
<div class="card mb-6 card-pad" x-data="{ item: 'run_12min_m' }">
    <div class="flex flex-wrap items-center justify-between gap-3">
        <p class="section-title">Tren rata-rata per item</p>
        <div class="tabs">@foreach($items as $k => $it)<button @click="item='{{ $k }}'; $dispatch('jas-item', '{{ $k }}')" class="tab" :class="item==='{{ $k }}' && 'tab-active'">{{ $it['short'] }}</button>@endforeach</div>
    </div>
    <div class="mt-4 h-64" x-data="chart({ type: 'line', data: { labels: @js($trend['labels']), datasets: [
        { label: 'Putra', data: @js($trend['run_12min_m']['L']), borderColor: '#5d4384', backgroundColor: '#5d4384', tension: .3, spanGaps: true },
        { label: 'Putri', data: @js($trend['run_12min_m']['P']), borderColor: '#d81b4d', backgroundColor: '#d81b4d', tension: .3, spanGaps: true } ] }, options: { maintainAspectRatio: false } })"
        x-on:jas-item.window="const t = @js(collect($items)->keys()->mapWithKeys(fn ($k) => [$k => $trend[$k]])); c.data.datasets[0].data = t[$event.detail].L; c.data.datasets[1].data = t[$event.detail].P; c.update()">
        <canvas x-ref="canvas"></canvas>
    </div>
</div>
@endif
<div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
    @forelse($evaluations as $e)
        @php $n = $e->results->count(); @endphp
        <a href="{{ route('jasmani.show', $e) }}" class="card card-hover p-5">
            <div class="flex items-start justify-between gap-3">
                <div class="grid h-14 w-14 shrink-0 place-items-center rounded-2xl bg-sunrise text-center text-white"><div><p class="text-[10px] font-bold uppercase">{{ $e->period->translatedFormat('M') }}</p><p class="font-display text-lg font-extrabold leading-none">{{ $e->period->format('y') }}</p></div></div>
                <span class="badge {{ $n >= $studentCount && $studentCount ? 'badge-lagoon' : 'badge-gold' }}">{{ $n }}/{{ $studentCount }} siswa</span>
            </div>
            <p class="mt-4 font-display text-lg font-bold">{{ $e->title }}</p>
            <p class="text-xs text-ink-400">{{ $e->held_on?->translatedFormat('l, d M Y') }} {{ $e->location ? '· '.$e->location : '' }}</p>
            <div class="mt-3 h-2 overflow-hidden rounded-full bg-ink-50"><div class="h-full rounded-full bg-lagoon-500" style="width: {{ $studentCount ? min(100, $n / $studentCount * 100) : 0 }}%"></div></div>
            <p class="mt-2 text-[11px] text-ink-400">Dibuat oleh {{ $e->creator?->name ?? '—' }}</p>
        </a>
    @empty
        <div class="md:col-span-2 xl:col-span-3"><x-empty icon="run" title="Belum ada evaluasi" text="Buat evaluasi bulanan pertama lalu input hasil tes siswa."><a href="{{ route('jasmani.create') }}" class="btn-primary">Buat evaluasi</a></x-empty></div>
    @endforelse
</div>
</x-layouts.app>
