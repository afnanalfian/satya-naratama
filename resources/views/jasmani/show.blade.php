<x-layouts.app :title="$evaluation->title" :wide="true">
@php $fmt = fn ($v) => $v === null ? '–' : rtrim(rtrim(number_format((float) $v, 2, ',', '.'), '0'), ','); @endphp
<x-page-header :title="$evaluation->title" :sub="$evaluation->period->translatedFormat('F Y').' · '.$evaluation->held_on?->translatedFormat('d M Y').($evaluation->location ? ' · '.$evaluation->location : '')" :back="route('jasmani.index')">
    <x-slot:actions>
        <a href="{{ route('jasmani.input', $evaluation) }}" class="btn-primary"><x-icon name="pencil" class="h-4 w-4"/> Input hasil</a>
        <a href="{{ route('jasmani.export', $evaluation) }}" class="btn-soft"><x-icon name="download" class="h-4 w-4"/> CSV</a>
        <a href="{{ route('jasmani.edit', $evaluation) }}" class="btn-soft btn-icon" title="Ubah"><x-icon name="cog" class="h-4 w-4"/></a>
        @role('admin')<form method="POST" action="{{ route('jasmani.destroy', $evaluation) }}" data-confirm="Hapus evaluasi beserta semua hasilnya?">@csrf @method('DELETE')<button class="btn-danger btn-icon"><x-icon name="trash" class="h-4 w-4"/></button></form>@endrole
    </x-slot:actions>
</x-page-header>

<div class="grid grid-cols-2 gap-4 md:grid-cols-3 xl:grid-cols-5">
    @foreach($items as $k => $it)
        @php $st = $stats[$k]; @endphp
        <div class="stat">
            <p class="stat-label">{{ $it['label'] }}</p>
            <p class="stat-value">{{ $fmt($st['avg']) }} <span class="text-xs text-ink-400">{{ $it['unit'] }}</span></p>
            <p class="mt-1 text-xs text-ink-400">Terbaik <b class="text-lagoon-600">{{ $fmt($st['best']) }}</b> · L {{ $fmt($st['by_gender']['L']) }} · P {{ $fmt($st['by_gender']['P']) }}</p>
        </div>
    @endforeach
</div>

@if($missing->count())
<div class="mt-6 rounded-3xl bg-saffron-50 p-4 text-sm ring-1 ring-saffron-200">
    <p class="font-bold text-saffron-900">{{ $missing->count() }} siswa aktif belum punya hasil:</p>
    <p class="mt-1 text-saffron-800">{{ $missing->pluck('name')->join(', ') }}</p>
</div>
@endif

<div class="mt-6 flex flex-wrap items-center gap-2">
    <div class="tabs">
        @foreach(['' => 'Semua', 'L' => 'Putra', 'P' => 'Putri'] as $k => $l)<a href="{{ request()->fullUrlWithQuery(['gender' => $k ?: null]) }}" class="tab {{ $gender === ($k ?: null) ? 'tab-active' : '' }}">{{ $l }}</a>@endforeach
    </div>
    <div class="tabs">
        <a href="{{ request()->fullUrlWithQuery(['sort' => null]) }}" class="tab {{ ! $sort ? 'tab-active' : '' }}">Nama</a>
        @foreach($items as $k => $it)<a href="{{ request()->fullUrlWithQuery(['sort' => $k]) }}" class="tab {{ $sort === $k ? 'tab-active' : '' }}">{{ $it['short'] }}</a>@endforeach
    </div>
</div>

<div class="table-wrap mt-4">
    <table class="table">
        <thead><tr><th>#</th><th>Siswa</th><th>L/P</th>@foreach($items as $k => $it)<th class="text-center">{{ $it['short'] }}</th>@endforeach<th>Catatan</th></tr></thead>
        <tbody>
        @forelse($results as $i => $r)
            @php $prev = $prevByUser->get($r->user_id); @endphp
            <tr>
                <td class="text-ink-400">{{ $i + 1 }}</td>
                <td class="whitespace-nowrap font-bold"><a href="{{ $r->user ? route('monitor.student', $r->user) : '#' }}" class="hover:text-garnet-600">{{ $r->user?->name ?? '—' }}</a></td>
                <td><span class="badge {{ $r->gender === 'P' ? 'badge-garnet' : 'badge-ink' }}">{{ $r->gender ?? '?' }}</span></td>
                @foreach($items as $k => $it)
                    @php $v = $r->{$k}; $pv = $prev?->{$k}; $d = ($v !== null && $pv !== null) ? $v - $pv : null; $good = $d !== null && (($it['better'] === 'high' && $d > 0) || ($it['better'] === 'low' && $d < 0)); @endphp
                    <td class="text-center {{ $sort === $k && $v === $stats[$k]['best'] ? 'bg-lagoon-50' : '' }}">
                        <span class="font-bold">{{ $fmt($v) }}</span>
                        @if($d !== null && $d != 0)<span class="block text-[10px] font-bold {{ $good ? 'text-lagoon-600' : 'text-garnet-600' }}">{{ $d > 0 ? '▲' : '▼' }}{{ $fmt(abs($d)) }}</span>@endif
                    </td>
                @endforeach
                <td class="text-xs text-ink-500">{{ $r->notes }}</td>
            </tr>
        @empty
            <tr><td colspan="9" class="py-10 text-center text-ink-400">Belum ada hasil. <a href="{{ route('jasmani.input', $evaluation) }}" class="link">Input sekarang</a></td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@if($previous)<p class="mt-3 text-xs text-ink-400">▲▼ dibandingkan dengan {{ $previous->title }} ({{ $previous->period->translatedFormat('F Y') }}).</p>@endif
@if($evaluation->notes)<div class="card mt-6 card-pad text-sm"><p class="section-title">Catatan</p><p class="mt-2 text-ink-600">{{ $evaluation->notes }}</p></div>@endif
</x-layouts.app>
