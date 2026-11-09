<x-layouts.app title="Analisis Soal">
<x-katex/>
<x-chartjs/>
@php $total = max(1, array_sum($summary) - $summary['answered']); @endphp
<x-page-header eyebrow="Analisis soal" :title="'Soal nomor '.$examQuestion->order" :sub="$exam->context_title" :back="route('exams.results', $exam)"/>
<div class="grid gap-6 lg:grid-cols-3">
    <div class="space-y-6 lg:col-span-2">
        <div class="card card-pad">
            <div class="prose-soal">{!! $question->question_text !!}</div>
            @if($question->image)<img src="{{ asset('storage/'.$question->image) }}" class="mt-3 max-h-64 rounded-xl" alt="">@endif
            <div class="mt-5 space-y-2">
                @foreach($question->options->sortBy('order') as $op)
                    @php $s = $optionStats[$op->id] ?? ['count' => 0, 'percentage' => 0]; @endphp
                    <div class="relative overflow-hidden rounded-2xl border-2 p-3 {{ ! $isTkp && $op->is_correct ? 'border-lagoon-400' : 'border-ink-100' }}">
                        <div class="absolute inset-y-0 left-0 {{ ! $isTkp && $op->is_correct ? 'bg-lagoon-100' : 'bg-ink-50' }}" style="width: {{ $s['percentage'] }}%"></div>
                        <div class="relative flex items-start gap-3 text-sm"><b>{{ chr(65 + $loop->index) }}.</b><div class="prose-soal flex-1">{!! $op->option_text !!}</div>@if($isTkp)<span class="badge-gold">bobot {{ $op->weight }}</span>@endif<span class="font-extrabold">{{ $s['count'] }} · {{ $s['percentage'] }}%</span></div>
                    </div>
                @endforeach
            </div>
            @if($question->explanation)<div class="mt-5 rounded-2xl bg-cream p-4"><p class="text-xs font-bold uppercase text-garnet-600">Pembahasan</p><div class="prose-soal mt-1 text-sm">{!! $question->explanation !!}</div></div>@endif
        </div>
        <div class="table-wrap">
            <table class="table">
                <thead><tr><th>Peserta</th><th>Jawaban</th><th>Status</th></tr></thead>
                <tbody>
                @foreach($attemptRows as $r)
                    <tr>
                        <td class="font-bold">{{ $r['user']?->name }}</td>
                        <td>{{ $r['selected_labels'] ? implode(', ', $r['selected_labels']) : '—' }}</td>
                        <td><span class="{{ ['correct' => 'badge-lagoon', 'wrong' => 'badge-garnet', 'empty' => 'badge-ink'][$r['status']] }}">{{ $r['status_label'] }}</span></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card card-pad h-fit">
        <p class="section-title">Ringkasan</p>
        <div class="mx-auto mt-4 h-56 max-w-xs" x-data="chart({ type: 'doughnut', data: { labels: ['Benar','Salah','Kosong'], datasets: [{ data: [{{ $summary['correct'] }}, {{ $summary['wrong'] }}, {{ $summary['empty'] }}], backgroundColor: ['#0fb59e', '#d81b4d', '#d8cce8'], borderWidth: 0 }] }, options: { maintainAspectRatio: false, cutout: '65%', plugins: { legend: { position: 'bottom' } } } })"><canvas x-ref="canvas"></canvas></div>
        <dl class="mt-4 grid grid-cols-3 gap-2 text-center text-sm">
            <div class="rounded-xl bg-lagoon-50 p-2"><dt class="text-[10px] font-bold uppercase">Benar</dt><dd class="font-display text-xl font-extrabold">{{ $summary['correct'] }}</dd></div>
            <div class="rounded-xl bg-garnet-50 p-2"><dt class="text-[10px] font-bold uppercase">Salah</dt><dd class="font-display text-xl font-extrabold">{{ $summary['wrong'] }}</dd></div>
            <div class="rounded-xl bg-ink-50 p-2"><dt class="text-[10px] font-bold uppercase">Kosong</dt><dd class="font-display text-xl font-extrabold">{{ $summary['empty'] }}</dd></div>
        </dl>
        <a href="{{ route('bank.question.edit', $question) }}" class="btn-soft mt-5 w-full"><x-icon name="pencil" class="h-4 w-4"/> Ubah soal / kunci</a>
    </div>
</div>
</x-layouts.app>
