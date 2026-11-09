<x-layouts.app :title="'Hasil · '.$displayTitle">
<x-katex/>
@php
    $fmt = fn ($v) => rtrim(rtrim(number_format((float) $v, 2, ',', '.'), '0'), ',');
    $answers = $attempt->answers->keyBy('question_id');
    $total = $summary['correct'] + $summary['wrong'] + $summary['empty'];
    $pct = $total ? round($summary['correct'] / $total * 100) : 0;
    $msg = match (true) { $pct >= 90 => 'Luar biasa! Pertahankan konsistensimu 🏆', $pct >= 75 => 'Hebat! Sedikit lagi menuju sempurna 💪', $pct >= 50 => 'Bagus! Pelajari pembahasan untuk naik level 📈', default => 'Jangan menyerah — setiap latihan membuatmu lebih kuat 🔥' };
@endphp
<x-page-header :eyebrow="$displaySubtitle ?? 'Hasil ujian'" :title="$displayTitle" :back="$backUrl">
    <x-slot:actions>@if(in_array($exam->type, ['tryout', 'quiz']))<a href="{{ route('exams.ranking.student', $exam) }}" class="btn-ink"><x-icon name="medal" class="h-4 w-4"/> Peringkat</a>@endif</x-slot:actions>
</x-page-header>

<div class="grid gap-6 lg:grid-cols-3">
    <div class="card-sunrise p-6 text-center">
        <p class="text-xs font-bold uppercase tracking-widest text-white/80">Nilai kamu</p>
        <p class="mt-2 font-display text-6xl font-extrabold">{{ $fmt($attempt->score) }}</p>
        @if($attempt->is_passed !== null)<span class="mt-3 inline-flex rounded-full px-3 py-1 text-xs font-extrabold {{ $attempt->is_passed ? 'bg-white text-lagoon-700' : 'bg-ink-950/40 text-white' }}">{{ $attempt->is_passed ? '✓ LULUS PASSING GRADE' : 'BELUM LULUS PASSING GRADE' }}</span>@endif
        <p class="mt-4 text-sm text-white/90">{{ $msg }}</p>
        <p class="mt-2 text-xs text-white/70">Dikumpulkan {{ $attempt->submitted_at?->translatedFormat('d M Y, H:i') }} · durasi {{ gmdate('H:i:s', $attempt->work_duration_seconds) }}</p>
    </div>
    <div class="card card-pad lg:col-span-2">
        <div class="grid grid-cols-3 gap-3 text-center">
            <div class="rounded-2xl bg-lagoon-50 p-4"><p class="font-display text-3xl font-extrabold text-lagoon-700">{{ $summary['correct'] }}</p><p class="text-xs font-bold text-lagoon-700">Benar</p></div>
            <div class="rounded-2xl bg-garnet-50 p-4"><p class="font-display text-3xl font-extrabold text-garnet-700">{{ $summary['wrong'] }}</p><p class="text-xs font-bold text-garnet-700">Salah</p></div>
            <div class="rounded-2xl bg-ink-50 p-4"><p class="font-display text-3xl font-extrabold text-ink-600">{{ $summary['empty'] }}</p><p class="text-xs font-bold text-ink-500">Kosong</p></div>
        </div>
        <div class="mt-4 flex h-3 overflow-hidden rounded-full bg-ink-50">
            @if($total)<div class="bg-lagoon-500" style="width: {{ $summary['correct'] / $total * 100 }}%"></div><div class="bg-garnet-500" style="width: {{ $summary['wrong'] / $total * 100 }}%"></div>@endif
        </div>
        @if($skdSummary)
            @php $rules = $exam->passing_rules ?? []; @endphp
            <div class="mt-5 grid gap-3 sm:grid-cols-3">
                @foreach(['twk' => 'TWK', 'tiu' => 'TIU', 'tkp' => 'TKP'] as $k => $l)
                    @php $s = $skdSummary[$k]; $pass = isset($rules[$k]) ? $s['score'] >= $rules[$k] : null; @endphp
                    <div class="rounded-2xl border-2 p-4 {{ $pass === null ? 'border-ink-100' : ($pass ? 'border-lagoon-300 bg-lagoon-50/50' : 'border-garnet-200 bg-garnet-50/50') }}">
                        <div class="flex items-center justify-between"><p class="font-display font-extrabold">{{ $l }}</p>@if($pass !== null)<span class="{{ $pass ? 'badge-lagoon' : 'badge-garnet' }}">{{ $pass ? 'Lulus' : 'Belum' }}</span>@endif</div>
                        <p class="mt-1 font-display text-3xl font-extrabold">{{ $s['score'] }}<span class="text-sm text-ink-400">{{ isset($rules[$k]) ? ' / min '.$rules[$k] : '' }}</span></p>
                        <p class="text-xs text-ink-500">{{ $s['correct'] }} benar · {{ $s['wrong'] - $s['empty'] }} salah · {{ $s['empty'] }} kosong</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

{{-- Pembahasan --}}
<div class="mt-8" x-data="{ f: 'all' }">
    <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
        <p class="section-title">Pembahasan soal</p>
        <div class="tabs">@foreach(['all' => 'Semua', 'correct' => 'Benar', 'wrong' => 'Salah', 'empty' => 'Kosong'] as $k => $l)<button @click="f='{{ $k }}'" class="tab" :class="f==='{{ $k }}' && 'tab-active'">{{ $l }}</button>@endforeach</div>
    </div>
    <div class="space-y-4">
        @foreach($questions as $eq)
            @php
                $q = $eq->question; $a = $answers->get($q->id); $isTkp = $q->test_type === 'tkp';
                $sel = $a?->selected_ids ?? [];
                $empty = ! $a || $a->is_empty;
                $state = $empty ? 'empty' : ($isTkp ? (($q->options->whereIn('id', $sel)->sum('weight') >= $q->options->max('weight')) ? 'correct' : 'wrong') : ($a->is_correct ? 'correct' : 'wrong'));
            @endphp
            <div x-show="f === 'all' || f === '{{ $state }}'" class="card overflow-hidden" x-data="{ o: false }">
                <button @click="o = !o; $nextTick(() => window.renderMath($el.parentElement))" class="flex w-full items-start gap-4 p-4 text-left">
                    <span class="grid h-10 w-10 shrink-0 place-items-center rounded-xl font-extrabold text-white {{ ['correct' => 'bg-lagoon-500', 'wrong' => 'bg-garnet-500', 'empty' => 'bg-ink-300'][$state] }}">{{ $eq->order }}</span>
                    <div class="prose-soal min-w-0 flex-1 text-sm" :class="!o && 'line-clamp-2'">{!! $q->question_text !!}</div>
                    <x-icon name="chevron-down" class="h-5 w-5 shrink-0 text-ink-300 transition" ::class="o && 'rotate-180'"/>
                </button>
                <div x-show="o" x-collapse class="border-t border-ink-50 bg-cream/50 p-5">
                    @if($q->image)<img src="{{ asset('storage/'.$q->image) }}" class="mb-4 max-h-64 rounded-xl" alt="">@endif
                    @if(in_array($q->type, ['mcq', 'mcma', 'truefalse']))
                        <div class="space-y-2">
                            @foreach($q->options->sortBy('order') as $op)
                                @php $chosen = in_array($op->id, $sel); @endphp
                                <div class="flex items-start gap-3 rounded-2xl border-2 p-3 text-sm {{ $isTkp ? ($chosen ? 'border-saffron-400 bg-saffron-50' : 'border-transparent bg-white') : ($op->is_correct ? 'border-lagoon-400 bg-lagoon-50' : ($chosen ? 'border-garnet-400 bg-garnet-50' : 'border-transparent bg-white')) }}">
                                    <b>{{ chr(65 + $loop->index) }}.</b><div class="prose-soal flex-1">{!! $op->option_text !!}@if($op->image)<img src="{{ asset('storage/'.$op->image) }}" class="mt-1 max-h-32 rounded" alt="">@endif</div>
                                    @if($isTkp)<span class="badge-gold">bobot {{ $op->weight }}</span>@endif
                                    @if($chosen)<span class="badge-dark">Jawabanmu</span>@endif
                                    @if(! $isTkp && $op->is_correct)<x-icon name="check-circle" class="h-5 w-5 text-lagoon-600"/>@endif
                                </div>
                            @endforeach
                        </div>
                    @elseif($q->type === 'short_answer')
                        <p class="text-sm"><b>Jawabanmu:</b> {{ $a?->short_answer_value ?? '—' }}</p>
                        <p class="text-sm text-lagoon-700"><b>Kunci:</b> {{ $q->options->pluck('option_text')->join(' / ') }}</p>
                    @elseif($q->type === 'compound')
                        @foreach($q->subItems->sortBy('order') as $s)
                            @php $ua = $a?->getCompoundAnswerBySubId($s->id); @endphp
                            <p class="py-1 text-sm"><b>{{ $s->label }}.</b> {{ $s->prompt }}<br>
                                <span class="text-ink-500">Jawabanmu: {{ $ua ? ($s->type === 'truefalse' ? (($ua['boolean'] ?? false) ? 'Benar' : 'Salah') : ($ua['value'] ?? '')) : '—' }}</span> ·
                                <span class="font-bold text-lagoon-700">Kunci: {{ $s->type === 'truefalse' ? ($s->answers->first()?->boolean_answer ? 'Benar' : 'Salah') : $s->answers->pluck('answer_text')->join(' / ') }}</span></p>
                        @endforeach
                    @endif
                    @if($q->explanation)<div class="mt-4 rounded-2xl bg-white p-4 ring-1 ring-ink-100"><p class="text-xs font-bold uppercase tracking-wider text-garnet-600">Pembahasan</p><div class="prose-soal mt-2 text-sm">{!! $q->explanation !!}</div></div>@endif
                </div>
            </div>
        @endforeach
    </div>
    {{ $questions->links() }}
</div>
</x-layouts.app>
