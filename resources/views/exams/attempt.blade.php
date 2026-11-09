@php
    $answers = $attempt->answers()->get()->keyBy('question_id');
    $sub = ['tiu' => 'TIU', 'twk' => 'TWK', 'tkp' => 'TKP', 'mtk_stis' => 'MTK', 'mtk_tka' => 'MTK', 'tpa' => 'TPA', 'tbi' => 'TBI', 'general' => ''];
    $payload = $questions->map(function ($eq) use ($answers, $sub) {
        $q = $eq->question; $a = $answers->get($q->id);
        $ans = null;
        if ($a) {
            $ans = match ($q->type) {
                'mcq', 'mcma', 'truefalse' => array_map('intval', $a->selected_ids),
                'short_answer' => $a->short_answer_value,
                'compound' => collect($a->compound_answers)->mapWithKeys(fn ($c) => [$c['sub_id'] => $c['type'] === 'truefalse' ? (bool) ($c['boolean'] ?? false) : ($c['value'] ?? '')])->all(),
                default => null,
            };
        }
        return [
            'id' => $q->id, 'type' => $q->type, 'sub' => $sub[$q->test_type] ?? '',
            'html' => $q->question_text, 'image' => $q->image ? asset('storage/'.$q->image) : null,
            'options' => $q->options->sortBy('order')->values()->map(fn ($o) => ['id' => $o->id, 'html' => $o->option_text, 'image' => $o->image ? asset('storage/'.$o->image) : null])->all(),
            'subs' => $q->subItems->map(fn ($s) => ['id' => $s->id, 'label' => $s->label, 'type' => $s->type, 'prompt' => $s->prompt])->values()->all(),
            'answer' => $ans,
        ];
    })->values();
@endphp
<x-layouts.exam :title="$exam->context_title">
<div x-data="examEngine(@js([
        'questions' => $payload, 'remaining' => $attempt->remainingSeconds(), 'key' => 'sn-exam-'.$attempt->id,
        'saveUrl' => route('exams.answer.save', $exam), 'syncUrl' => route('exams.time.sync', $exam), 'resultUrl' => route('exams.result.student', $exam),
    ]))" x-init="init()" @keydown.window="key($event)" class="flex h-full flex-col" :style="'--fs:' + zoom + 'px'">

    {{-- Topbar --}}
    <header class="flex shrink-0 items-center gap-3 border-b border-ink-100 bg-white px-3 py-2.5 sm:px-5">
        <img src="{{ asset('img/logo.png') }}" class="h-9 w-9 object-contain" alt="">
        <div class="min-w-0 flex-1">
            <p class="truncate font-display text-sm font-bold sm:text-base">{{ $exam->context_title }}</p>
            <p class="text-[11px] text-ink-400"><span x-text="answeredCount"></span>/<span x-text="questions.length"></span> terjawab · <span :class="pending.length ? 'text-saffron-600 font-bold' : 'text-lagoon-600'" x-text="pending.length ? pending.length + ' menunggu sinkron' : (offline ? 'offline' : 'tersimpan')"></span></p>
        </div>
        <div class="flex items-center gap-2 rounded-2xl px-3 py-2 font-mono text-lg font-bold tabular-nums sm:text-xl" :class="remaining <= 300 ? 'bg-garnet-600 text-white animate-pulse' : 'bg-ink-900 text-white'">
            <x-icon name="clock" class="h-5 w-5"/><span x-text="clock"></span>
        </div>
        <div class="hidden items-center gap-1 sm:flex">
            <button @click="zoom = Math.max(13, zoom - 1)" class="btn-icon btn-ghost" title="Perkecil">A−</button>
            <button @click="zoom = Math.min(24, zoom + 1)" class="btn-icon btn-ghost" title="Perbesar">A+</button>
            <button @click="full()" class="btn-icon btn-ghost" title="Layar penuh"><x-icon name="expand" class="h-5 w-5"/></button>
        </div>
        <button @click="nav = !nav" class="btn-icon btn-soft lg:hidden"><x-icon name="grid" class="h-5 w-5"/></button>
    </header>

    <div class="flex min-h-0 flex-1">
        {{-- Soal --}}
        <main class="scrollbar-thin min-w-0 flex-1 overflow-y-auto">
            <div class="mx-auto max-w-3xl px-4 py-6 sm:px-6">
                <template x-if="q">
                    <div>
                        <div class="mb-4 flex items-center gap-2">
                            <span class="grid h-11 w-11 place-items-center rounded-2xl bg-ink-900 font-display text-lg font-extrabold text-white" x-text="i + 1"></span>
                            <span x-show="q.sub" class="badge-gold" x-text="q.sub"></span>
                            <span class="badge-ink" x-text="{ mcq: 'Pilih satu', mcma: 'Pilih semua yang benar', truefalse: 'Benar / Salah', short_answer: 'Isian singkat', compound: 'Majemuk' }[q.type]"></span>
                            <button @click="toggleFlag()" class="ml-auto btn-sm btn" :class="flags.includes(q.id) ? 'bg-saffron-400 text-ink-900' : 'btn-soft'"><x-icon name="flag" class="h-4 w-4"/> <span x-text="flags.includes(q.id) ? 'Ragu-ragu' : 'Tandai ragu'"></span></button>
                        </div>
                        <div class="card p-5 sm:p-7" x-ref="qbox" x-effect="i; $nextTick(() => window.renderMath($refs.qbox))">
                            <div class="prose-soal" style="font-size: var(--fs)" x-html="q.html"></div>
                            <img x-show="q.image" :src="q.image" class="mt-3 max-h-80 rounded-2xl" alt="">

                            {{-- Pilihan --}}
                            <div x-show="['mcq','mcma','truefalse'].includes(q.type)" class="mt-6 space-y-2.5">
                                <template x-for="(o, k) in q.options" :key="o.id">
                                    <button type="button" @click="choose(o.id)" class="flex w-full items-start gap-3 rounded-2xl border-2 p-3.5 text-left transition"
                                            :class="isChosen(o.id) ? 'border-garnet-500 bg-garnet-50 shadow-glow/20' : 'border-ink-100 hover:border-ink-300 hover:bg-cream'">
                                        <span class="grid h-8 w-8 shrink-0 place-items-center rounded-xl text-sm font-extrabold" :class="isChosen(o.id) ? 'bg-garnet-600 text-white' : 'bg-ink-50 text-ink-700'" x-text="q.type === 'truefalse' ? (k === 0 ? '✓' : '✕') : String.fromCharCode(65 + k)"></span>
                                        <span class="min-w-0 flex-1 pt-1"><span class="prose-soal block" style="font-size: var(--fs)" x-html="o.html"></span><img x-show="o.image" :src="o.image" class="mt-2 max-h-40 rounded-xl" alt=""></span>
                                    </button>
                                </template>
                            </div>

                            {{-- Isian --}}
                            <div x-show="q.type === 'short_answer'" class="mt-6">
                                <input :value="q.answer ?? ''" @input.debounce.700ms="setShort($event.target.value)" class="input text-lg" placeholder="Ketik jawabanmu…">
                                <p class="hint">Jawaban tersimpan otomatis setelah berhenti mengetik.</p>
                            </div>

                            {{-- Majemuk --}}
                            <div x-show="q.type === 'compound'" class="mt-6 space-y-3">
                                <template x-for="s in q.subs" :key="s.id">
                                    <div class="rounded-2xl border border-ink-100 p-4">
                                        <p class="text-sm" style="font-size: var(--fs)"><b x-text="s.label + '.'"></b> <span x-text="s.prompt"></span></p>
                                        <div x-show="s.type === 'truefalse'" class="mt-3 grid grid-cols-2 gap-2">
                                            <button type="button" @click="setSub(s, true)" class="rounded-xl border-2 py-2.5 font-bold" :class="subVal(s) === true ? 'border-lagoon-500 bg-lagoon-50 text-lagoon-700' : 'border-ink-100'">Benar</button>
                                            <button type="button" @click="setSub(s, false)" class="rounded-xl border-2 py-2.5 font-bold" :class="subVal(s) === false ? 'border-garnet-500 bg-garnet-50 text-garnet-700' : 'border-ink-100'">Salah</button>
                                        </div>
                                        <input x-show="s.type === 'short_answer'" :value="subVal(s) ?? ''" @input.debounce.700ms="setSub(s, $event.target.value)" class="input mt-3" placeholder="Jawaban">
                                    </div>
                                </template>
                            </div>
                        </div>

                        <div class="mt-5 flex items-center justify-between gap-3">
                            <button @click="go(i - 1)" class="btn-soft" :disabled="i === 0"><x-icon name="arrow-left" class="h-4 w-4"/> Sebelumnya</button>
                            <button x-show="i < questions.length - 1" @click="go(i + 1)" class="btn-ink">Berikutnya <x-icon name="arrow-right" class="h-4 w-4"/></button>
                            <button x-show="i === questions.length - 1" @click="askSubmit()" class="btn-primary">Selesai & kumpulkan <x-icon name="send" class="h-4 w-4"/></button>
                        </div>
                        <p class="mt-4 hidden text-center text-[11px] text-ink-400 sm:block">Pintasan: ← → pindah soal · A–E pilih jawaban · R tandai ragu</p>
                    </div>
                </template>
            </div>
        </main>

        {{-- Navigasi --}}
        <aside class="fixed inset-y-0 right-0 z-40 w-80 translate-x-full overflow-y-auto border-l border-ink-100 bg-white p-5 shadow-lift transition lg:static lg:z-auto lg:translate-x-0 lg:shadow-none" :class="nav && '!translate-x-0'">
            <div class="flex items-center justify-between lg:hidden"><p class="font-display font-bold">Navigasi soal</p><button @click="nav=false" class="btn-icon btn-ghost"><x-icon name="x"/></button></div>
            <div class="mt-2 grid grid-cols-3 gap-2 text-center text-[11px] font-bold lg:mt-0">
                <div class="rounded-xl bg-lagoon-50 py-2 text-lagoon-700"><span class="block font-display text-lg" x-text="answeredCount"></span>Terjawab</div>
                <div class="rounded-xl bg-saffron-50 py-2 text-saffron-700"><span class="block font-display text-lg" x-text="flags.length"></span>Ragu</div>
                <div class="rounded-xl bg-ink-50 py-2 text-ink-600"><span class="block font-display text-lg" x-text="questions.length - answeredCount"></span>Kosong</div>
            </div>
            <div class="mt-4 grid grid-cols-6 gap-1.5">
                <template x-for="(qq, k) in questions" :key="qq.id">
                    <button @click="go(k); nav = false" class="relative aspect-square rounded-lg text-xs font-extrabold transition"
                            :class="[k === i ? 'ring-2 ring-ink-900 ring-offset-1' : '', flags.includes(qq.id) ? 'bg-saffron-400 text-ink-900' : (answered(qq) ? 'bg-lagoon-500 text-white' : 'bg-ink-50 text-ink-500 hover:bg-ink-100')]"
                            x-text="k + 1"></button>
                </template>
            </div>
            <button @click="askSubmit()" class="btn-primary mt-6 w-full"><x-icon name="send" class="h-4 w-4"/> Kumpulkan</button>
            <p class="mt-3 text-center text-[11px] text-ink-400">Ujian otomatis dikumpulkan saat waktu habis.</p>
        </aside>
    </div>

    <form x-ref="submitForm" method="POST" action="{{ route('exams.submit', $exam) }}" class="hidden">@csrf</form>

    <div x-show="submitting" x-cloak class="fixed inset-0 z-[99] grid place-items-center bg-ink-950/80 text-white backdrop-blur">
        <div class="text-center"><div class="mx-auto h-14 w-14 animate-spin rounded-full border-4 border-white/20 border-t-saffron-400"></div><p class="mt-4 font-display text-xl font-bold" x-text="submitMsg"></p></div>
    </div>
</div>

@push('scripts')
<script>
function examEngine(cfg) {
    return {
        ...cfg, i: 0, nav: false, zoom: 16, flags: [], pending: [], offline: !navigator.onLine, submitting: false, submitMsg: 'Mengumpulkan jawaban…', tick: null, endsAt: 0,
        get q() { return this.questions[this.i]; },
        get clock() { const s = Math.max(0, this.remaining), h = Math.floor(s / 3600), m = Math.floor(s % 3600 / 60), x = s % 60; return (h ? h + ':' : '') + String(m).padStart(2, '0') + ':' + String(x).padStart(2, '0'); },
        get answeredCount() { return this.questions.filter(q => this.answered(q)).length; },
        store(k, v) { try { v === undefined ? JSON.parse(localStorage.getItem(this.key + k) || 'null') : localStorage.setItem(this.key + k, JSON.stringify(v)); } catch (e) { return null; } },
        load(k) { try { return JSON.parse(localStorage.getItem(this.key + k) || 'null'); } catch (e) { return null; } },
        init() {
            this.flags = this.load('-flags') || [];
            this.pending = this.load('-pending') || [];
            const pos = this.load('-pos'); if (pos !== null && pos < this.questions.length) this.i = pos;
            // terapkan jawaban offline yang belum tersinkron
            this.pending.forEach(p => { const q = this.questions.find(x => x.id === p.question_id); if (q) q.answer = p._answer; });
            this.endsAt = Date.now() + this.remaining * 1000;
            this.tick = setInterval(() => { this.remaining = Math.round((this.endsAt - Date.now()) / 1000); if (this.remaining <= 0) this.timeUp(); }, 500);
            setInterval(() => this.sync(), 60000);
            setInterval(() => this.flush(), 5000);
            window.addEventListener('online', () => { this.offline = false; this.flush(); });
            window.addEventListener('offline', () => this.offline = true);
            window.addEventListener('beforeunload', (e) => { if (this.pending.length && !this.submitting) { e.preventDefault(); e.returnValue = ''; } });
            this.flush();
        },
        go(k) { if (k < 0 || k >= this.questions.length) return; this.i = k; this.store('-pos', k); document.querySelector('main')?.scrollTo({ top: 0, behavior: 'smooth' }); },
        answered(q) { const a = q.answer; if (a === null || a === undefined) return false; if (Array.isArray(a)) return a.length > 0; if (typeof a === 'object') return Object.values(a).some(v => v !== '' && v !== null); return String(a).trim() !== ''; },
        isChosen(id) { return Array.isArray(this.q.answer) && this.q.answer.includes(id); },
        choose(id) {
            const q = this.q;
            if (q.type === 'mcma') { const a = Array.isArray(q.answer) ? [...q.answer] : []; const k = a.indexOf(id); k >= 0 ? a.splice(k, 1) : a.push(id); q.answer = a; if (!a.length) return; }
            else q.answer = [id];
            this.queue(q);
        },
        setShort(v) { this.q.answer = v; if (v.trim()) this.queue(this.q); },
        subVal(s) { return (this.q.answer || {})[s.id]; },
        setSub(s, v) { const a = { ...(this.q.answer || {}) }; a[s.id] = v; this.q.answer = a; this.queue(this.q); },
        toggleFlag() { const k = this.flags.indexOf(this.q.id); k >= 0 ? this.flags.splice(k, 1) : this.flags.push(this.q.id); this.store('-flags', this.flags); },
        body(q) {
            const b = { question_id: q.id };
            if (['mcq', 'mcma', 'truefalse'].includes(q.type)) b.selected_options = q.answer;
            else if (q.type === 'short_answer') b.short_answer_value = q.answer;
            else if (q.type === 'compound') b.compound_answers = q.subs.filter(s => (q.answer || {})[s.id] !== undefined && (q.answer || {})[s.id] !== '').map(s => s.type === 'truefalse' ? { sub_id: s.id, type: 'truefalse', boolean: !!q.answer[s.id] } : { sub_id: s.id, type: 'short_answer', value: q.answer[s.id] });
            return b;
        },
        queue(q) {
            this.pending = this.pending.filter(p => p.question_id !== q.id);
            this.pending.push({ ...this.body(q), _answer: q.answer });
            this.store('-pending', this.pending);
            this.flush();
        },
        async flush() {
            if (this._busy || !this.pending.length || !navigator.onLine) return;
            this._busy = true;
            try {
                while (this.pending.length) {
                    const p = this.pending[0]; const { _answer, ...body } = p;
                    const res = await fetch(this.saveUrl, { method: 'POST', headers: { 'Content-Type': 'application/json', Accept: 'application/json', 'X-CSRF-TOKEN': window.csrf() }, body: JSON.stringify(body) });
                    if (res.status === 419) { await window.refreshCsrf(); continue; }
                    if (res.status === 403) { const d = await res.json().catch(() => ({})); if (d.expired) return this.timeUp(); }
                    if (!res.ok && res.status >= 500) throw new Error('server');
                    this.pending.shift(); this.store('-pending', this.pending);
                }
            } catch (e) { this.offline = !navigator.onLine; }
            finally { this._busy = false; }
        },
        async sync() {
            try { const r = await fetch(this.syncUrl, { headers: { Accept: 'application/json' } }); if (r.ok) { const d = await r.json(); this.endsAt = Date.now() + d.remaining_seconds * 1000; } else if (r.status === 404) location.href = this.resultUrl; } catch (e) {}
        },
        key(e) {
            if (['INPUT', 'TEXTAREA'].includes(e.target.tagName)) return;
            if (e.key === 'ArrowRight') this.go(this.i + 1);
            else if (e.key === 'ArrowLeft') this.go(this.i - 1);
            else if (e.key.toLowerCase() === 'r') this.toggleFlag();
            else { const k = 'abcde'.indexOf(e.key.toLowerCase()); if (k >= 0 && this.q.options[k] && ['mcq', 'mcma', 'truefalse'].includes(this.q.type)) this.choose(this.q.options[k].id); }
        },
        full() { document.fullscreenElement ? document.exitFullscreen() : document.documentElement.requestFullscreen?.(); },
        askSubmit() {
            const empty = this.questions.length - this.answeredCount;
            const msg = (empty ? `Masih ada ${empty} soal kosong. ` : '') + (this.flags.length ? `${this.flags.length} soal ditandai ragu. ` : '') + 'Kumpulkan sekarang? Jawaban tidak bisa diubah lagi.';
            Alpine.store('confirm').ask(msg, { okText: 'Kumpulkan', danger: false, title: 'Kumpulkan ujian' }).then(ok => ok && this.submit());
        },
        async submit() {
            this.submitting = true;
            const t0 = Date.now(); while (this.pending.length && Date.now() - t0 < 8000) { await this.flush(); if (this.pending.length) await new Promise(r => setTimeout(r, 800)); }
            try { ['-flags', '-pending', '-pos'].forEach(k => localStorage.removeItem(this.key + k)); } catch (e) {}
            this.$refs.submitForm.querySelector('[name=_token]').value = window.csrf();
            this.$refs.submitForm.submit();
        },
        timeUp() { if (this.submitting) return; clearInterval(this.tick); this.remaining = 0; this.submitMsg = 'Waktu habis — mengumpulkan jawaban…'; this.submit(); },
    };
}
</script>
@endpush
</x-layouts.exam>
