@php
    $typeLabels = ['mcq' => 'PG', 'mcma' => 'PG Kompleks', 'truefalse' => 'B/S', 'short_answer' => 'Isian', 'compound' => 'Majemuk'];
    $testLabels = ['general' => 'Umum', 'tiu' => 'TIU', 'twk' => 'TWK', 'tkp' => 'TKP', 'mtk_stis' => 'MTK STIS', 'mtk_tka' => 'MTK TKA', 'tpa' => 'TPA', 'tbi' => 'TBI'];
@endphp
<div>
    <x-katex/>
    <x-page-header eyebrow="Bank soal" :title="$material->name" :sub="($material->category?->name ?? '').' · '.$questions->total().' soal'" :back="$material->category ? route('bank.category.materials.index', $material->category) : route('bank.category.index')">
        <x-slot:actions><a href="{{ route('bank.material.questions.create', $material) }}" class="btn-primary"><x-icon name="plus" class="h-4 w-4"/> Soal baru</a></x-slot:actions>
    </x-page-header>
    <div class="mb-5 flex flex-col gap-3 md:flex-row">
        <div class="flex-1"><x-search wire:model.live.debounce.400ms="q" placeholder="Cari isi soal…"/></div>
        <select wire:model.live="test_type" class="select md:w-40"><option value="">Semua tes</option>@foreach($testLabels as $k => $l)<option value="{{ $k }}">{{ $l }}</option>@endforeach</select>
        <select wire:model.live="type" class="select md:w-44"><option value="">Semua tipe</option>@foreach($typeLabels as $k => $l)<option value="{{ $k }}">{{ $l }}</option>@endforeach</select>
        <select wire:model.live="perPage" class="select md:w-24"><option>10</option><option>20</option><option>50</option><option>100</option></select>
    </div>
    <div class="space-y-3">
        @forelse($questions as $i => $qq)
            <div wire:key="q{{ $qq->id }}" class="card overflow-hidden" x-data="{ o: false }">
                <div class="flex items-start gap-4 p-4">
                    <span class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-ink-900 font-display text-sm font-extrabold text-white">{{ $questions->firstItem() + $i }}</span>
                    <div class="min-w-0 flex-1 cursor-pointer" @click="o = !o; $nextTick(() => window.renderMath($el.parentElement.parentElement))">
                        <div class="flex flex-wrap gap-1.5"><span class="badge-ink">{{ $testLabels[$qq->test_type] ?? $qq->test_type }}</span><span class="badge-gold">{{ $typeLabels[$qq->type] ?? $qq->type }}</span>@if($qq->exam_questions_count)<span class="badge-lagoon">dipakai {{ $qq->exam_questions_count }} ujian</span>@endif @if($qq->image)<span class="badge-sky">gambar</span>@endif</div>
                        <div class="prose-soal mt-2 text-sm" :class="!o && 'line-clamp-2'">{!! $qq->question_text !!}</div>
                    </div>
                    <div class="flex shrink-0 gap-1">
                        <a href="{{ route('bank.question.edit', $qq) }}" class="btn-icon btn-ghost" title="Ubah"><x-icon name="pencil" class="h-4 w-4"/></a>
                        <button x-data @click="$confirm('Hapus soal #{{ $qq->id }}?', () => $wire.remove({{ $qq->id }}))" class="btn-icon btn-ghost hover:text-garnet-600" title="Hapus"><x-icon name="trash" class="h-4 w-4"/></button>
                    </div>
                </div>
                <div x-show="o" x-collapse class="border-t border-ink-50 bg-cream/60 p-4 pl-[4.5rem] text-sm">
                    @if($qq->image)<img src="{{ asset('storage/'.$qq->image) }}" class="mb-3 max-h-48 rounded-xl" alt="">@endif
                    @if(in_array($qq->type, ['mcq', 'mcma', 'truefalse']))
                        <div class="space-y-1.5">
                            @foreach($qq->options->sortBy('order') as $k => $op)
                                <div class="flex gap-2 rounded-xl px-3 py-2 {{ $op->is_correct ? 'bg-lagoon-100 font-semibold text-lagoon-900' : 'bg-white' }}">
                                    <b>{{ chr(65 + $loop->index) }}.</b><div class="prose-soal flex-1">{!! $op->option_text !!}</div>
                                    @if($qq->test_type === 'tkp')<span class="badge-gold">{{ $op->weight }}</span>@elseif($op->is_correct)<x-icon name="check" class="h-4 w-4"/>@endif
                                </div>
                            @endforeach
                        </div>
                    @elseif($qq->type === 'short_answer')
                        <p><b>Jawaban:</b> {{ $qq->options->pluck('option_text')->join(' / ') }}</p>
                    @elseif($qq->type === 'compound')
                        @foreach($qq->subItems->sortBy('order') as $s)
                            <p class="py-1"><b>{{ $s->label }}.</b> {{ $s->prompt }} → <span class="font-bold text-lagoon-700">{{ $s->type === 'truefalse' ? ($s->answers->first()?->boolean_answer ? 'Benar' : 'Salah') : $s->answers->pluck('answer_text')->join(' / ') }}</span></p>
                        @endforeach
                    @endif
                    @if($qq->explanation)<div class="mt-3 rounded-xl bg-white p-3"><p class="text-xs font-bold uppercase text-ink-400">Pembahasan</p><div class="prose-soal mt-1">{!! $qq->explanation !!}</div></div>@endif
                </div>
            </div>
        @empty
            <x-empty icon="question" title="Belum ada soal"><a href="{{ route('bank.material.questions.create', $material) }}" class="btn-primary">Tambah soal</a></x-empty>
        @endforelse
    </div>
    {{ $questions->links() }}
</div>
