{{-- Form soal (dipakai create & edit). Field mengikuti QuestionController. --}}
@php
    $q = $question ?? null;
    $rules = ['general' => ['mcq', 'mcma', 'truefalse', 'short_answer', 'compound'], 'tiu' => ['mcq'], 'twk' => ['mcq'], 'mtk_stis' => ['mcq'], 'tkp' => ['mcq'], 'tpa' => ['mcq'], 'tbi' => ['mcq'], 'mtk_tka' => ['mcq', 'mcma', 'truefalse', 'compound']];
    $testLabels = ['general' => 'Umum', 'tiu' => 'TIU', 'twk' => 'TWK', 'tkp' => 'TKP', 'mtk_stis' => 'MTK STIS', 'mtk_tka' => 'MTK TKA', 'tpa' => 'TPA', 'tbi' => 'TBI'];
    $typeLabels = ['mcq' => 'Pilihan ganda', 'mcma' => 'Pilihan ganda kompleks', 'truefalse' => 'Benar / Salah', 'short_answer' => 'Isian singkat', 'compound' => 'Majemuk (sub-soal)'];
    $opts = $q ? $q->options->sortBy('order')->values()->map(fn ($o) => ['id' => $o->id, 'text' => $o->option_text, 'image' => $o->image ? asset('storage/'.$o->image) : null, 'correct' => (bool) $o->is_correct, 'weight' => $o->weight ?? ''])->all() : [];
    $initType = old('type', $q?->type ?? 'mcq');
    if (! $opts || in_array($initType, ['truefalse', 'short_answer'])) {
        $mcqOpts = collect(range(0, 4))->map(fn ($i) => ['id' => null, 'text' => '', 'image' => null, 'correct' => $i === 0, 'weight' => 5 - $i])->all();
    }
    $state = [
        'testType' => old('test_type', $q?->test_type ?? 'general'),
        'type' => $initType,
        'locked' => (bool) $q,
        'rules' => $rules,
        'options' => in_array($initType, ['mcq', 'mcma']) && $opts ? $opts : ($mcqOpts ?? $opts),
        'tfCorrect' => $q && $q->type === 'truefalse' ? ($q->options->firstWhere('is_correct', true)?->order == 2 ? 0 : 1) : 1,
        'shorts' => $q && $q->type === 'short_answer' ? $q->options->map(fn ($o) => ['id' => $o->id, 'text' => $o->option_text])->values()->all() : [['id' => null, 'text' => '']],
        'subs' => $q && $q->type === 'compound' ? $q->subItems->sortBy('order')->values()->map(fn ($s) => [
            'id' => $s->id, 'label' => $s->label, 'type' => $s->type, 'prompt' => $s->prompt,
            'bool' => (bool) optional($s->answers->first())->boolean_answer,
            'answers' => $s->type === 'short_answer' ? $s->answers->map(fn ($a) => ['id' => $a->id, 'text' => $a->answer_text])->values()->all() : [['id' => null, 'text' => '']],
            'primary' => max(0, $s->answers->search(fn ($a) => $a->is_primary) ?: 0),
        ])->all() : [['id' => null, 'label' => 'A', 'type' => 'truefalse', 'prompt' => '', 'bool' => true, 'answers' => [['id' => null, 'text' => '']], 'primary' => 0]],
        'text' => old('question_text', $q?->question_text ?? ''),
        'explanation' => old('explanation', $q?->explanation ?? ''),
    ];
@endphp
@push('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mathquill/0.10.1/mathquill.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mathquill/0.10.1/mathquill.min.js"></script>
@endpush
<x-katex/>

<div x-data="questionForm(@js($state))" x-init="init()" class="grid gap-6 xl:grid-cols-5">
    <div class="space-y-6 xl:col-span-3">
        {{-- Jenis --}}
        <div class="card card-pad">
            <div class="grid gap-4 sm:grid-cols-2">
                <x-field label="Jenis tes" name="test_type">
                    <select name="test_type" x-model="testType" @change="fixType()" class="select" :disabled="locked">
                        @foreach($testLabels as $k => $l)<option value="{{ $k }}">{{ $l }}</option>@endforeach
                    </select>
                    <template x-if="locked"><input type="hidden" name="test_type" :value="testType"></template>
                </x-field>
                <x-field label="Tipe soal" name="type">
                    <select name="type" x-model="type" class="select">
                        @foreach($typeLabels as $k => $l)<option value="{{ $k }}" x-show="rules[testType].includes('{{ $k }}')">{{ $l }}</option>@endforeach
                    </select>
                </x-field>
            </div>
            <p x-show="testType === 'tkp'" class="mt-3 rounded-2xl bg-saffron-50 p-3 text-xs font-semibold text-saffron-900">Soal TKP tidak memiliki satu jawaban benar — setiap opsi diberi bobot 1–5.</p>
        </div>

        {{-- Pertanyaan --}}
        <div class="card card-pad">
            <div class="mb-2 flex flex-wrap items-center justify-between gap-2">
                <label class="label !mb-0">Pertanyaan</label>
                <div class="flex flex-wrap gap-1">
                    <button type="button" @click="wrap('text', '<b>', '</b>')" class="btn-soft btn-sm font-bold">B</button>
                    <button type="button" @click="wrap('text', '<i>', '</i>')" class="btn-soft btn-sm italic">I</button>
                    <button type="button" @click="wrap('text', '<u>', '</u>')" class="btn-soft btn-sm underline">U</button>
                    <button type="button" @click="wrap('text', '<br>', '')" class="btn-soft btn-sm">↵</button>
                    <button type="button" @click="openMath('text')" class="btn-ink btn-sm"><x-icon name="math" class="h-4 w-4"/> Rumus</button>
                </div>
            </div>
            <textarea name="question_text" x-ref="text" x-model="text" rows="6" class="textarea font-mono text-[13px]" required placeholder="Tulis soal… gunakan \( ... \) untuk rumus"></textarea>
            @error('question_text')<p class="error">{{ $message }}</p>@enderror
            <div class="mt-4">
                <label class="label">Gambar soal (opsional)</label>
                @if($q?->image)<img src="{{ asset('storage/'.$q->image) }}" class="mb-2 max-h-40 rounded-xl" alt="">@endif
                <input type="file" name="question_image" accept="image/*" class="file">
            </div>
        </div>

        {{-- Opsi --}}
        <div class="card card-pad" x-show="['mcq','mcma'].includes(type)">
            <div class="flex items-center justify-between"><p class="section-title">Pilihan jawaban</p><button type="button" @click="options.push({ id: null, text: '', image: null, correct: false, weight: 1 })" class="btn-soft btn-sm"><x-icon name="plus" class="h-4 w-4"/> Opsi</button></div>
            <p class="hint" x-text="testType === 'tkp' ? 'Isi bobot 1–5 untuk setiap opsi.' : (type === 'mcma' ? 'Centang semua jawaban yang benar.' : 'Pilih satu jawaban benar.')"></p>
            <div class="mt-4 space-y-3">
                <template x-for="(o, i) in options" :key="i">
                    <div class="rounded-2xl border-2 p-3 transition" :class="testType !== 'tkp' && o.correct ? 'border-lagoon-400 bg-lagoon-50/50' : 'border-ink-100'">
                        <input type="hidden" :name="`options[${i}][id]`" :value="o.id ?? ''">
                        <div class="flex items-start gap-3">
                            <span class="mt-1 grid h-8 w-8 shrink-0 place-items-center rounded-xl bg-ink-900 text-sm font-extrabold text-white" x-text="String.fromCharCode(65 + i)"></span>
                            <div class="flex-1 space-y-2">
                                <textarea :name="`options[${i}][text]`" x-model="o.text" :id="'opt' + i" rows="2" class="textarea !min-h-[56px] font-mono text-[13px]" placeholder="Teks opsi"></textarea>
                                <div class="flex flex-wrap items-center gap-3 text-xs">
                                    <template x-if="testType === 'tkp'"><label class="flex items-center gap-2 font-bold">Bobot <input type="number" min="0" max="5" :name="`options[${i}][weight]`" x-model="o.weight" class="input input-sm w-16"></label></template>
                                    <template x-if="testType !== 'tkp' && type === 'mcq'"><label class="flex items-center gap-1.5 font-bold text-lagoon-700"><input type="radio" name="correct" :value="i" :checked="o.correct" @change="options.forEach((x, k) => x.correct = k === i)" class="radio"> Jawaban benar</label></template>
                                    <template x-if="testType !== 'tkp' && type === 'mcma'"><label class="flex items-center gap-1.5 font-bold text-lagoon-700"><input type="checkbox" name="correct[]" :value="i" x-model="o.correct" class="checkbox"> Benar</label></template>
                                    <button type="button" @click="openMath('opt' + i, i)" class="font-bold text-ink-500 hover:text-garnet-600">∑ Rumus</button>
                                    <label class="cursor-pointer font-bold text-ink-500 hover:text-garnet-600">🖼 Gambar<input type="file" :name="`options[${i}][image]`" accept="image/*" class="hidden" @change="o.image = URL.createObjectURL($event.target.files[0])"></label>
                                    <button type="button" x-show="options.length > 2" @click="options.splice(i, 1)" class="ml-auto font-bold text-garnet-600">Hapus</button>
                                </div>
                                <img x-show="o.image" :src="o.image" class="max-h-24 rounded-lg" alt="">
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        {{-- Benar / Salah --}}
        <div class="card card-pad" x-show="type === 'truefalse'">
            <p class="section-title">Kunci jawaban</p>
            <div class="mt-3 grid grid-cols-2 gap-3">
                <label class="cursor-pointer rounded-2xl border-2 p-4 text-center font-bold" :class="tfCorrect == 1 ? 'border-lagoon-500 bg-lagoon-50 text-lagoon-700' : 'border-ink-100'"><input type="radio" name="truefalse_correct" value="1" x-model="tfCorrect" class="hidden" :disabled="type !== 'truefalse'">✓ Benar</label>
                <label class="cursor-pointer rounded-2xl border-2 p-4 text-center font-bold" :class="tfCorrect == 0 ? 'border-garnet-500 bg-garnet-50 text-garnet-700' : 'border-ink-100'"><input type="radio" name="truefalse_correct" value="0" x-model="tfCorrect" class="hidden" :disabled="type !== 'truefalse'">✕ Salah</label>
            </div>
        </div>

        {{-- Isian --}}
        <div class="card card-pad" x-show="type === 'short_answer'">
            <div class="flex items-center justify-between"><p class="section-title">Jawaban yang diterima</p><button type="button" @click="shorts.push({ id: null, text: '' })" class="btn-soft btn-sm"><x-icon name="plus" class="h-4 w-4"/></button></div>
            <p class="hint">Huruf besar/kecil & spasi berlebih diabaikan saat penilaian.</p>
            <div class="mt-3 space-y-2">
                <template x-for="(s, i) in shorts" :key="i">
                    <div class="flex gap-2">
                        <input type="hidden" :name="`short_answers[${i}][id]`" :value="s.id ?? ''" :disabled="type !== 'short_answer'">
                        <input :name="`short_answers[${i}][text]`" x-model="s.text" class="input" placeholder="Jawaban" :disabled="type !== 'short_answer'">
                        <button type="button" x-show="shorts.length > 1" @click="shorts.splice(i, 1)" class="btn-danger btn-icon"><x-icon name="x" class="h-4 w-4"/></button>
                    </div>
                </template>
            </div>
        </div>

        {{-- Majemuk --}}
        <div class="card card-pad" x-show="type === 'compound'">
            <div class="flex items-center justify-between"><p class="section-title">Sub-soal</p><button type="button" @click="subs.push({ id: null, label: String.fromCharCode(65 + subs.length), type: 'truefalse', prompt: '', bool: true, answers: [{ id: null, text: '' }], primary: 0 })" class="btn-soft btn-sm"><x-icon name="plus" class="h-4 w-4"/> Sub-soal</button></div>
            <div class="mt-4 space-y-3">
                <template x-for="(s, i) in subs" :key="i">
                    <div class="rounded-2xl border border-ink-100 p-4" x-bind:class="type !== 'compound' && 'hidden'">
                        <input type="hidden" :name="`sub_items[${i}][id]`" :value="s.id ?? ''" :disabled="type !== 'compound'">
                        <div class="flex gap-2">
                            <input :name="`sub_items[${i}][label]`" x-model="s.label" class="input input-sm w-14 text-center font-bold" :disabled="type !== 'compound'">
                            <select :name="`sub_items[${i}][type]`" x-model="s.type" class="select input-sm w-44" :disabled="type !== 'compound'"><option value="truefalse">Benar/Salah</option><option value="short_answer">Isian singkat</option></select>
                            <button type="button" x-show="subs.length > 1" @click="subs.splice(i, 1)" class="btn-danger btn-icon ml-auto"><x-icon name="trash" class="h-4 w-4"/></button>
                        </div>
                        <textarea :name="`sub_items[${i}][prompt]`" x-model="s.prompt" rows="2" class="textarea mt-2 !min-h-[56px]" placeholder="Pernyataan / pertanyaan sub-soal" :disabled="type !== 'compound'"></textarea>
                        <div x-show="s.type === 'truefalse'" class="mt-2 flex gap-4 text-sm font-bold">
                            <label class="flex items-center gap-1.5"><input type="radio" :name="`sub_items[${i}][boolean_answer]`" value="1" :checked="s.bool" @change="s.bool = true" class="radio" :disabled="type !== 'compound' || s.type !== 'truefalse'"> Benar</label>
                            <label class="flex items-center gap-1.5"><input type="radio" :name="`sub_items[${i}][boolean_answer]`" value="0" :checked="!s.bool" @change="s.bool = false" class="radio" :disabled="type !== 'compound' || s.type !== 'truefalse'"> Salah</label>
                        </div>
                        <div x-show="s.type === 'short_answer'" class="mt-2 space-y-2">
                            <template x-for="(a, j) in s.answers" :key="j">
                                <div class="flex items-center gap-2">
                                    <input type="radio" :name="`sub_items[${i}][primary_index]`" :value="j" :checked="s.primary == j" @change="s.primary = j" class="radio" title="Jawaban utama" :disabled="type !== 'compound' || s.type !== 'short_answer'">
                                    <input type="hidden" :name="`sub_items[${i}][answers][${j}][id]`" :value="a.id ?? ''" :disabled="type !== 'compound' || s.type !== 'short_answer'">
                                    <input :name="`sub_items[${i}][answers][${j}][text]`" x-model="a.text" class="input input-sm" placeholder="Jawaban diterima" :disabled="type !== 'compound' || s.type !== 'short_answer'">
                                    <button type="button" x-show="s.answers.length > 1" @click="s.answers.splice(j, 1)" class="text-garnet-600"><x-icon name="x" class="h-4 w-4"/></button>
                                </div>
                            </template>
                            <button type="button" @click="s.answers.push({ id: null, text: '' })" class="text-xs font-bold text-garnet-600">+ alternatif jawaban</button>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        {{-- Pembahasan --}}
        <div class="card card-pad">
            <div class="mb-2 flex items-center justify-between"><label class="label !mb-0">Pembahasan (opsional)</label><button type="button" @click="openMath('explanation')" class="btn-ink btn-sm"><x-icon name="math" class="h-4 w-4"/> Rumus</button></div>
            <textarea name="explanation" x-ref="explanation" x-model="explanation" rows="5" class="textarea font-mono text-[13px]"></textarea>
        </div>
    </div>

    {{-- Pratinjau --}}
    <div class="xl:col-span-2">
        <div class="card overflow-hidden xl:sticky xl:top-4">
            <div class="flex items-center justify-between bg-ink-900 px-5 py-3 text-white"><p class="font-display font-bold">Pratinjau siswa</p><span class="badge bg-white/10 text-saffron-300" x-text="testType.toUpperCase()"></span></div>
            <div class="space-y-4 p-5">
                <div class="prose-soal" x-ref="pv" x-html="text || '<span class=&quot;text-ink-300&quot;>Belum ada isi…</span>'" x-effect="text; $nextTick(() => window.renderMath($refs.pv))"></div>
                <div x-show="['mcq','mcma'].includes(type)" class="space-y-2" x-ref="pvo" x-effect="JSON.stringify(options); $nextTick(() => window.renderMath($refs.pvo))">
                    <template x-for="(o, i) in options" :key="'p' + i">
                        <div class="flex gap-3 rounded-2xl border border-ink-100 p-3 text-sm" :class="testType !== 'tkp' && o.correct && 'border-lagoon-400 bg-lagoon-50'">
                            <span class="font-extrabold" x-text="String.fromCharCode(65 + i) + '.'"></span>
                            <div class="flex-1"><div class="prose-soal" x-html="o.text"></div><img x-show="o.image" :src="o.image" class="mt-1 max-h-20 rounded" alt=""></div>
                            <span x-show="testType === 'tkp'" class="badge-gold" x-text="'bobot ' + (o.weight || 0)"></span>
                        </div>
                    </template>
                </div>
                <div x-show="explanation" class="rounded-2xl bg-cream p-4"><p class="text-xs font-bold uppercase text-ink-400">Pembahasan</p><div class="prose-soal mt-1 text-sm" x-ref="pve" x-html="explanation" x-effect="explanation; $nextTick(() => window.renderMath($refs.pve))"></div></div>
            </div>
        </div>
    </div>

    {{-- Modal MathQuill --}}
    <div x-show="math.open" x-cloak class="fixed inset-0 z-[85] grid place-items-center p-4" @keydown.escape.window="math.open = false">
        <div class="absolute inset-0 bg-ink-950/60 backdrop-blur-sm" @click="math.open = false"></div>
        <div class="relative w-full max-w-xl rounded-3xl bg-white p-6 shadow-lift">
            <p class="font-display text-lg font-bold">Sisipkan rumus</p>
            <p class="text-xs text-ink-400">Ketik seperti biasa: <code>1/2</code> jadi pecahan, <code>^</code> pangkat, <code>sqrt</code> akar, <code>\pi</code>, <code>\times</code>.</p>
            <div class="mt-4 flex flex-wrap gap-1">
                @foreach(['\\frac{}{}' => 'a/b', 'x^{}' => 'xⁿ', 'x_{}' => 'xₙ', '\\sqrt{}' => '√', '\\sqrt[]{}' => 'ⁿ√', '\\times' => '×', '\\div' => '÷', '\\pm' => '±', '\\le' => '≤', '\\ge' => '≥', '\\neq' => '≠', '\\pi' => 'π', '\\degree' => '°', '\\infty' => '∞', '\\sum' => 'Σ', '\\int' => '∫', '\\log' => 'log', '\\sin' => 'sin', '\\cos' => 'cos', '\\tan' => 'tan'] as $cmd => $lbl)
                    <button type="button" @click="mqWrite(@js($cmd))" class="btn-soft btn-sm min-w-[2.5rem]">{{ $lbl }}</button>
                @endforeach
            </div>
            <div class="mt-3 rounded-2xl border-2 border-ink-200 p-3 text-xl" x-ref="mq"></div>
            <p class="mt-2 font-mono text-xs text-ink-400" x-text="'LaTeX: ' + math.latex"></p>
            <div class="mt-5 grid grid-cols-2 gap-2"><button type="button" class="btn-soft" @click="math.open = false">Batal</button><button type="button" class="btn-primary" @click="insertMath()">Sisipkan</button></div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function questionForm(s) {
    return {
        ...s, math: { open: false, target: null, latex: '' }, mq: null,
        init() {},
        fixType() { if (!this.rules[this.testType].includes(this.type)) this.type = this.rules[this.testType][0]; },
        el(target) { return target.startsWith('opt') ? document.getElementById(target) : this.$refs[target]; },
        wrap(target, a, b) {
            const t = this.el(target), st = t.selectionStart, en = t.selectionEnd, v = t.value;
            t.value = v.slice(0, st) + a + v.slice(st, en) + b + v.slice(en);
            t.dispatchEvent(new Event('input')); t.focus(); t.selectionStart = t.selectionEnd = en + a.length + b.length;
        },
        openMath(target) {
            this.math.target = target; this.math.open = true; this.math.latex = '';
            this.$nextTick(() => {
                if (!window.MathQuill) { window.toast('warning', 'Editor rumus belum termuat. Anda tetap bisa mengetik LaTeX di antara \\( dan \\).'); this.math.open = false; return; }
                if (!this.mq) { const MQ = MathQuill.getInterface(2); this.mq = MQ.MathField(this.$refs.mq, { spaceBehavesLikeTab: true, handlers: { edit: () => this.math.latex = this.mq.latex() } }); }
                this.mq.latex(''); this.mq.focus();
            });
        },
        mqWrite(cmd) { if (!this.mq) return; cmd.includes('{') ? this.mq.write(cmd) : this.mq.cmd(cmd); this.mq.focus(); this.math.latex = this.mq.latex(); },
        insertMath() {
            const latex = this.mq?.latex()?.trim(); this.math.open = false; if (!latex) return;
            const t = this.el(this.math.target), pos = t.selectionStart ?? t.value.length, ins = ` \\(${latex}\\) `;
            t.value = t.value.slice(0, pos) + ins + t.value.slice(pos); t.dispatchEvent(new Event('input'));
        },
    };
}
</script>
@endpush
