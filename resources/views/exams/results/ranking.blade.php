<x-layouts.app :title="'Peringkat · '.$exam->context_title">
@php $fmt = fn ($v) => rtrim(rtrim(number_format((float) $v, 2, ',', '.'), '0'), ','); $isSkd = $exam->type === 'tryout' && $exam->test_type === 'skd'; $top = $attempts->take(3); @endphp
<x-page-header eyebrow="Peringkat" :title="$exam->context_title" :sub="$totalParticipants.' peserta'" :back="route('exams.show', $exam)"/>
@if($myRank)
<div class="card-ink mb-6 flex items-center gap-5 p-5">
    <div class="grid h-16 w-16 place-items-center rounded-2xl bg-saffron-400 font-display text-2xl font-extrabold text-ink-900">#{{ $myRank }}</div>
    <div><p class="text-sm text-ink-300">Peringkatmu</p><p class="font-display text-xl font-bold">{{ $myRank }} dari {{ $totalParticipants }} peserta</p></div>
</div>
@endif
@if($top->count() && ! $search)
<div class="mb-6 grid grid-cols-3 items-end gap-3">
    @foreach([1, 0, 2] as $idx)
        @php $t = $top[$idx] ?? null; @endphp
        <div class="text-center">
            @if($t)
                <img src="{{ $t->user->avatar_url }}" class="mx-auto h-14 w-14 rounded-2xl object-cover ring-4 {{ $idx === 0 ? 'ring-saffron-400 h-16 w-16' : 'ring-ink-100' }}" alt="">
                <p class="mt-2 truncate text-sm font-bold">{{ $t->user->name }}</p>
                <div class="mt-2 rounded-t-2xl {{ $idx === 0 ? 'h-28 bg-sunrise' : ($idx === 1 ? 'h-20 bg-ink-700' : 'h-14 bg-saffron-600') }} grid place-items-center text-white">
                    <div><p class="font-display text-2xl font-extrabold">{{ $idx + 1 }}</p><p class="text-xs font-bold">{{ $fmt($t->score) }}</p></div>
                </div>
            @endif
        </div>
    @endforeach
</div>
@endif
<form method="GET" class="mb-4 max-w-md"><x-search name="search" :value="$search" placeholder="Cari nama peserta…"/></form>
<div class="table-wrap">
    <table class="table">
        <thead><tr><th>#</th><th>Peserta</th>@if($isSkd)<th class="text-center">TWK</th><th class="text-center">TIU</th><th class="text-center">TKP</th>@endif<th class="text-center">Benar</th><th class="text-center">Salah</th><th class="text-right">Nilai</th>@if($exam->type === 'tryout')<th>Status</th>@endif</tr></thead>
        <tbody>
        @forelse($attempts as $a)
            <tr class="{{ $a->id === $myAttemptId ? '!bg-saffron-50 font-bold' : '' }}">
                <td><span class="grid h-8 w-8 place-items-center rounded-lg {{ $a->rank <= 3 ? 'bg-saffron-400 text-ink-900' : 'bg-ink-50' }} font-extrabold">{{ $a->rank }}</span></td>
                <td><div class="flex items-center gap-2"><img src="{{ $a->user->avatar_url }}" class="h-8 w-8 rounded-lg object-cover" alt=""><span>{{ $a->user->name }}{{ $a->id === $myAttemptId ? ' (kamu)' : '' }}</span></div></td>
                @if($isSkd)<td class="text-center">{{ $a->score_twk }}</td><td class="text-center">{{ $a->score_tiu }}</td><td class="text-center">{{ $a->score_tkp }}</td>@endif
                <td class="text-center text-lagoon-600">{{ $a->correct }}</td><td class="text-center text-garnet-600">{{ $a->wrong }}</td>
                <td class="text-right font-display text-lg font-extrabold">{{ $fmt($a->score) }}</td>
                @if($exam->type === 'tryout')<td>@if($a->is_passed === null)–@elseif($a->is_passed)<span class="badge-lagoon">Lulus</span>@else<span class="badge-garnet">Belum</span>@endif</td>@endif
            </tr>
        @empty
            <tr><td colspan="9" class="py-10 text-center text-ink-400">Belum ada peserta.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
</x-layouts.app>
