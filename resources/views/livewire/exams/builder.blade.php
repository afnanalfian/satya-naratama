@php
    $typeName = ['tryout' => 'Tryout', 'quiz' => 'Kuis', 'post_test' => 'Post-Test', 'blind_test' => 'Blind Test'][$exam->type] ?? 'Ujian';
    $subLabels = ['tiu' => 'TIU', 'twk' => 'TWK', 'tkp' => 'TKP', 'mtk_stis' => 'MTK STIS', 'mtk_tka' => 'MTK TKA', 'tpa' => 'TPA', 'tbi' => 'TBI', 'general' => 'Umum'];
@endphp
<div>
    <x-katex/>
    <x-page-header :eyebrow="$typeName.' · '.strtoupper($exam->test_type)" :title="$exam->context_title" :sub="'Kode '.$exam->exam_code.' · '.$questions->total().' soal'" :back="$exam->backRoute()">
        <x-slot:actions>
            <x-status-badge :status="$exam->status" class="!text-xs"/>
            <a href="{{ route('exams.show', $exam) }}" class="btn-soft"><x-icon name="eye" class="h-4 w-4"/> Halaman ujian</a>
            @if($editable)<button wire:click="activate" class="btn-lagoon"><x-icon name="play" class="h-4 w-4"/> Siap diaktifkan</button>@endif
        </x-slot:actions>
    </x-page-header>

    @unless($editable)
        <div class="mb-6 flex gap-3 rounded-2xl bg-saffron-50 p-4 text-sm text-saffron-900 ring-1 ring-saffron-200"><x-icon name="lock" class="h-5 w-5 shrink-0"/> Ujian {{ $exam->status === 'active' ? 'sedang aktif' : 'sudah ditutup' }}. Info & susunan soal tidak dapat diubah, namun soal baru masih bisa ditambahkan.</div>
    @endunless

    <div class="grid gap-6 xl:grid-cols-5">
        <div class="space-y-6 xl:col-span-3">
            {{-- Info --}}
            <form wire:submit="saveInfo" class="card card-pad">
                <p class="section-title">Info ujian</p>
                <div class="mt-4 grid gap-4 sm:grid-cols-3">
                    <x-field label="Judul" name="title" class="sm:col-span-3"><input wire:model="title" class="input" @disabled(! $editable) placeholder="{{ $exam->context_title }}"></x-field>
                    <x-field label="Durasi (menit)" name="duration_minutes" required><input type="number" wire:model="duration_minutes" class="input" @disabled(! $editable)></x-field>
                    <x-field label="Tanggal & jam" name="exam_date" class="sm:col-span-2"><input type="datetime-local" wire:model="exam_date" class="input" @disabled(! $editable)></x-field>
                    @if($exam->type === 'tryout' && $passing)
                        @foreach($passing as $k => $v)
                            <x-field :label="'Passing grade '.strtoupper($k)" :name="'passing.'.$k"><input type="number" wire:model="passing.{{ $k }}" class="input" @disabled(! $editable)></x-field>
                        @endforeach
                    @endif
                </div>
                @if($editable)<div class="mt-4 flex justify-end"><button class="btn-ink btn-sm"><x-icon name="check" class="h-4 w-4"/> Simpan info</button></div>@endif
            </form>

            {{-- Soal terpilih --}}
            <div class="card overflow-hidden">
                <div class="flex flex-wrap items-center justify-between gap-2 border-b border-ink-50 p-4">
                    <p class="section-title">Soal dalam ujian</p>
                    <div class="flex flex-wrap gap-1">@foreach($bySubtest as $k => $n)<span class="badge-ink">{{ $subLabels[$k] ?? $k }} · {{ $n }}</span>@endforeach</div>
                </div>
                <div class="divide-y divide-ink-50">
                    @forelse($questions as $eq)
                        <div wire:key="eq{{ $eq->id }}" class="flex items-start gap-3 p-4">
                            <div class="flex flex-col items-center gap-1">
                                <span class="grid h-9 w-9 place-items-center rounded-xl bg-ink-900 text-sm font-extrabold text-white">{{ $eq->order }}</span>
                                @if($editable)
                                    <button wire:click="move({{ $eq->id }}, {{ $eq->order - 1 }})" class="text-ink-300 hover:text-ink-900" @disabled($eq->order <= 1)><x-icon name="chevron-up" class="h-4 w-4"/></button>
                                    <button wire:click="move({{ $eq->id }}, {{ $eq->order + 1 }})" class="text-ink-300 hover:text-ink-900"><x-icon name="chevron-down" class="h-4 w-4"/></button>
                                @endif
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="flex flex-wrap gap-1"><span class="badge-ink">{{ $subLabels[$eq->question?->test_type] ?? '' }}</span><span class="badge-gold">{{ $eq->question?->type }}</span><span class="text-[11px] text-ink-400">{{ $eq->question?->material?->name }}</span></div>
                                <div class="prose-soal mt-1.5 line-clamp-3 text-sm">{!! $eq->question?->question_text !!}</div>
                            </div>
                            @if($editable)
                                <div class="flex shrink-0 flex-col items-end gap-2" x-data="{ to: {{ $eq->order }} }">
                                    <button x-data @click="$confirm('Lepas soal ini dari ujian?', () => $wire.detach({{ $eq->question_id }}))" class="btn-icon btn-ghost hover:text-garnet-600"><x-icon name="x" class="h-4 w-4"/></button>
                                    <div class="flex items-center gap-1"><input type="number" x-model="to" min="1" class="input input-sm w-16 text-center"><button @click="$wire.move({{ $eq->id }}, to)" class="btn-soft btn-sm" title="Pindah ke nomor">⇅</button></div>
                                </div>
                            @endif
                        </div>
                    @empty
                        <x-empty icon="list" title="Belum ada soal" text="Pilih kategori & materi di panel kanan, centang soal, lalu tekan Tambahkan." class="!m-4 !border-0"/>
                    @endforelse
                </div>
                <div class="px-4 pb-4">{{ $questions->links() }}</div>
            </div>
        </div>

        {{-- Pemilih soal --}}
        <div class="xl:col-span-2">
            <div class="card overflow-hidden xl:sticky xl:top-4">
                <div class="bg-ink-900 p-4 text-white">
                    <p class="font-display font-bold">Ambil dari bank soal</p>
                    <p class="text-xs text-ink-300">Hanya soal bertipe {{ collect($exam->allowedQuestionTypes())->map(fn ($t) => $subLabels[$t] ?? $t)->join(', ') }} yang ditampilkan.</p>
                </div>
                <div class="space-y-3 p-4">
                    <select wire:change="selectCategory($event.target.value)" class="select"><option value="">Pilih kategori…</option>@foreach($categories as $c)<option value="{{ $c->id }}" @selected($categoryId === $c->id)>{{ $c->name }}</option>@endforeach</select>
                    @if($categoryId)
                        <div class="flex max-h-40 flex-wrap gap-1.5 overflow-y-auto">
                            @forelse($materials as $m)
                                <button wire:click="selectMaterial({{ $m->id }})" class="chip {{ $materialId === $m->id ? 'chip-active' : '' }}">{{ $m->name }} <span class="opacity-60">{{ $m->questions_count }}</span></button>
                            @empty
                                <p class="text-xs text-ink-400">Kategori ini belum punya materi.</p>
                            @endforelse
                        </div>
                    @endif
                    @if($available)
                        <div class="flex items-center gap-2">
                            <input wire:model.live.debounce.400ms="pickSearch" class="input input-sm" placeholder="Cari soal…">
                            <button wire:click="pickAll" class="btn-soft btn-sm shrink-0">Pilih semua ({{ $available->total() }})</button>
                        </div>
                        <div class="max-h-[50vh] space-y-2 overflow-y-auto pr-1">
                            @forelse($available as $q)
                                <label wire:key="pk{{ $q->id }}" class="flex cursor-pointer gap-3 rounded-2xl border-2 p-3 text-sm transition {{ in_array((string) $q->id, $picked) ? 'border-garnet-400 bg-garnet-50' : 'border-ink-100 hover:border-ink-200' }}">
                                    <input type="checkbox" wire:model.live="picked" value="{{ $q->id }}" class="checkbox mt-0.5">
                                    <span class="min-w-0 flex-1"><span class="prose-soal line-clamp-3 block">{!! $q->question_text !!}</span><span class="mt-1 block text-[11px] text-ink-400">#{{ $q->id }} · {{ $subLabels[$q->test_type] ?? $q->test_type }} · dipakai {{ $q->exam_questions_count }}×</span></span>
                                </label>
                            @empty
                                <p class="py-6 text-center text-sm text-ink-400">Semua soal di materi ini sudah dipakai / tidak sesuai jenis tes.</p>
                            @endforelse
                        </div>
                        {{ $available->links() }}
                        <button wire:click="attach" class="btn-primary w-full" @disabled(! count($picked))><x-icon name="plus" class="h-4 w-4"/> Tambahkan {{ count($picked) }} soal</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
