<x-layouts.app :title="'Hasil · '.$displayTitle" :wide="true">
<x-katex/>
@php $fmt = fn ($v) => $v === null ? '–' : rtrim(rtrim(number_format((float) $v, 2, ',', '.'), '0'), ','); $isSkd = $exam->type === 'tryout' && $exam->test_type === 'skd'; @endphp
<x-page-header :eyebrow="$displaySubtitle ?? 'Hasil ujian'" :title="$displayTitle" :sub="'Kode '.$exam->exam_code" :back="$backUrl"/>
<div class="grid grid-cols-2 gap-4 lg:grid-cols-4">
    <x-stat label="Peserta" :value="$totalParticipants" icon="users" tone="ink"/>
    <x-stat label="Rata-rata" :value="$fmt($averageScore)" icon="chart" tone="sky"/>
    <x-stat label="Tertinggi" :value="$fmt($maxScore)" icon="trophy" tone="lagoon"/>
    <x-stat label="Terendah" :value="$fmt($minScore)" icon="trend" tone="garnet"/>
</div>
<div class="mt-6 grid gap-6 2xl:grid-cols-5">
    <div class="2xl:col-span-3">
        <div class="mb-3 flex items-center justify-between"><p class="section-title">Peringkat peserta</p></div>
        <div class="table-wrap">
            <table class="table">
                <thead><tr><th>#</th><th>Peserta</th>@if($isSkd)<th class="text-center">TWK</th><th class="text-center">TIU</th><th class="text-center">TKP</th>@endif<th class="text-center">B</th><th class="text-center">S</th>@if($exam->test_type === 'mtk_stis')<th class="text-center">K</th>@endif<th class="text-right">Nilai</th><th>Status</th><th>Waktu</th></tr></thead>
                <tbody>
                @forelse($ranking as $a)
                    <tr>
                        <td><span class="grid h-8 w-8 place-items-center rounded-lg {{ $a->rank <= 3 ? 'bg-saffron-400' : 'bg-ink-50' }} font-extrabold">{{ $a->rank }}</span></td>
                        <td><a href="{{ $a->user ? route('monitor.student', $a->user) : '#' }}" class="font-bold hover:text-garnet-600">{{ $a->user?->name }}</a></td>
                        @if($isSkd)<td class="text-center">{{ $a->score_twk }}</td><td class="text-center">{{ $a->score_tiu }}</td><td class="text-center">{{ $a->score_tkp }}</td>@endif
                        <td class="text-center text-lagoon-600">{{ $a->correct }}</td><td class="text-center text-garnet-600">{{ $a->wrong }}</td>
                        @if($exam->test_type === 'mtk_stis')<td class="text-center text-ink-400">{{ $a->empty }}</td>@endif
                        <td class="text-right font-display text-lg font-extrabold">{{ $fmt($a->score) }}</td>
                        <td>@if($a->is_passed === null)<span class="text-ink-300">–</span>@elseif($a->is_passed)<span class="badge-lagoon">Lulus</span>@else<span class="badge-garnet">Belum</span>@endif</td>
                        <td class="whitespace-nowrap text-xs text-ink-400">{{ gmdate('H:i:s', $a->work_duration_seconds) }}</td>
                    </tr>
                @empty
                    <tr><td colspan="11" class="py-10 text-center text-ink-400">Belum ada peserta yang mengumpulkan.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        {{ $ranking->links() }}
    </div>
    <div class="2xl:col-span-2">
        <p class="section-title mb-3">Analisis per soal</p>
        <div class="space-y-2">
            @foreach($questions as $eq)
                @php $st = $questionStats[$eq->question_id] ?? null; $acc = $st['accuracy'] ?? 0; @endphp
                <a href="{{ route('exams.questions.analysis', [$exam, $eq]) }}" class="card flex items-center gap-3 p-3 transition hover:bg-cream">
                    <span class="grid h-9 w-9 shrink-0 place-items-center rounded-xl bg-ink-900 text-xs font-extrabold text-white">{{ $eq->order }}</span>
                    <div class="min-w-0 flex-1">
                        <div class="prose-soal line-clamp-1 text-sm">{!! strip_tags($eq->question?->question_text) !!}</div>
                        <div class="mt-1.5 h-1.5 overflow-hidden rounded-full bg-ink-50"><div class="h-full rounded-full {{ $acc >= 70 ? 'bg-lagoon-500' : ($acc >= 40 ? 'bg-saffron-400' : 'bg-garnet-500') }}" style="width: {{ $acc }}%"></div></div>
                    </div>
                    <span class="w-14 text-right text-sm font-extrabold">{{ $acc }}%</span>
                </a>
            @endforeach
        </div>
        {{ $questions->links() }}
        <p class="mt-2 text-xs text-ink-400">Persentase = peserta menjawab benar / peserta yang menjawab. Soal TKP dihitung benar bila memilih bobot tertinggi.</p>
    </div>
</div>
</x-layouts.app>
