@php
    $tone = ['meeting' => 'bg-ink-900 text-white', 'jasmani' => 'bg-saffron-400 text-ink-900', 'tryout' => 'bg-garnet-600 text-white', 'quiz' => 'bg-lagoon-500 text-white'];
    $label = ['meeting' => 'Kelas', 'jasmani' => 'Jasmani', 'tryout' => 'Tryout', 'quiz' => 'Kuis'];
@endphp
<div>
    <x-page-header title="Jadwal" sub="Kelas, latihan jasmani, kuis & tryout dalam satu kalender."/>
    <div class="grid gap-6 xl:grid-cols-3">
        <div class="card overflow-hidden xl:col-span-2">
            <div class="flex items-center justify-between gap-3 bg-ink-900 px-5 py-4 text-white">
                <button wire:click="shift(-1)" class="rounded-xl p-2 hover:bg-white/10"><x-icon name="chevron-left"/></button>
                <div class="text-center"><p class="font-display text-xl font-extrabold">{{ $start->translatedFormat('F Y') }}</p><button wire:click="today" class="text-xs font-bold text-saffron-300 hover:text-white">Hari ini</button></div>
                <button wire:click="shift(1)" class="rounded-xl p-2 hover:bg-white/10"><x-icon name="chevron-right"/></button>
            </div>
            <div class="grid grid-cols-7 border-b border-ink-50 bg-cream text-center text-[11px] font-extrabold uppercase tracking-wider text-ink-400">
                @foreach(['Sen','Sel','Rab','Kam','Jum','Sab','Min'] as $d)<div class="py-2">{{ $d }}</div>@endforeach
            </div>
            <div class="grid grid-cols-7" wire:loading.class="opacity-60">
                @foreach($days as $d)
                    @php $key = $d->toDateString(); $list = $items[$key] ?? collect(); $in = $d->month === $start->month; @endphp
                    <button wire:click="pick('{{ $key }}')" class="group relative min-h-[64px] border-b border-r border-ink-50 p-1.5 text-left transition sm:min-h-[100px] sm:p-2 {{ $in ? 'bg-white hover:bg-cream' : 'bg-ink-50/40 text-ink-300' }} {{ $selected === $key ? '!bg-saffron-50 ring-2 ring-inset ring-saffron-400' : '' }}">
                        <span class="grid h-7 w-7 place-items-center rounded-full text-xs font-bold {{ $d->isToday() ? 'bg-garnet-600 text-white' : '' }}">{{ $d->day }}</span>
                        <div class="mt-1 hidden space-y-1 sm:block">
                            @foreach($list->take(3) as $it)<div class="truncate rounded-md px-1.5 py-0.5 text-[10px] font-bold {{ $tone[$it['type']] }}">{{ $it['time']->format('H:i') }} {{ $it['title'] }}</div>@endforeach
                            @if($list->count() > 3)<div class="text-[10px] font-bold text-ink-400">+{{ $list->count() - 3 }} lagi</div>@endif
                        </div>
                        <div class="mt-1 flex flex-wrap gap-0.5 sm:hidden">@foreach($list->take(4) as $it)<span class="dot {{ explode(' ', $tone[$it['type']])[0] }}"></span>@endforeach</div>
                    </button>
                @endforeach
            </div>
            <div class="flex flex-wrap gap-3 px-5 py-3 text-xs font-semibold text-ink-500">
                @foreach($label as $k => $l)<span class="flex items-center gap-1.5"><span class="dot {{ explode(' ', $tone[$k])[0] }}"></span>{{ $l }}</span>@endforeach
            </div>
        </div>
        <div class="card card-pad h-fit">
            <p class="section-title">{{ $selected ? \Carbon\Carbon::parse($selected)->translatedFormat('l, d F Y') : 'Agenda bulan ini' }}</p>
            <div class="mt-4 space-y-2">
                @forelse($agenda as $it)
                    <a href="{{ $it['url'] }}" class="flex items-start gap-3 rounded-2xl border border-ink-50 p-3 transition hover:bg-cream">
                        <span class="mt-0.5 rounded-lg px-2 py-1 text-[10px] font-extrabold uppercase {{ $tone[$it['type']] }}">{{ $label[$it['type']] }}</span>
                        <span class="min-w-0 flex-1"><span class="block truncate text-sm font-bold">{{ $it['title'] }}</span><span class="block text-xs text-ink-400">{{ $selected ? '' : $it['time']->translatedFormat('d M').' · ' }}{{ $it['time']->format('H:i') }} {{ $it['sub'] ? '· '.$it['sub'] : '' }}</span></span>
                        <x-status-badge :status="$it['status']"/>
                    </a>
                @empty
                    <x-empty icon="calendar" title="Tidak ada agenda" class="!py-8"/>
                @endforelse
            </div>
        </div>
    </div>
</div>
