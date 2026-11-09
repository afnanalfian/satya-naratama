<x-layouts.app title="Game Matematika">
<div x-data="mathGame()" class="mx-auto max-w-2xl">
    <x-page-header title="Game Matematika ⚡" sub="Latih hitung cepat untuk tes TIU & numerik. Jawab sebanyak mungkin dalam 60 detik!"/>
    <div class="card-ink p-6 sm:p-8">
        <div class="absolute inset-0 bg-grid-ink [background-size:28px_28px]"></div>
        <div class="relative">
            <div class="flex items-center justify-between gap-3 text-sm font-bold">
                <div class="flex gap-2">
                    <template x-for="l in ['mudah','sedang','sulit']"><button @click="!running && (level = l)" class="rounded-xl px-3 py-1.5 capitalize" :class="level === l ? 'bg-saffron-400 text-ink-900' : 'bg-white/10 text-ink-200'" x-text="l"></button></template>
                </div>
                <span class="rounded-xl bg-white/10 px-3 py-1.5">🏆 <span x-text="best[level] || 0"></span></span>
            </div>
            <div class="mt-6 grid grid-cols-3 gap-3 text-center">
                <div class="rounded-2xl bg-white/10 p-3"><p class="text-[11px] font-bold uppercase text-ink-300">Waktu</p><p class="font-display text-3xl font-extrabold" :class="time <= 10 && running ? 'text-garnet-400' : ''" x-text="time"></p></div>
                <div class="rounded-2xl bg-white/10 p-3"><p class="text-[11px] font-bold uppercase text-ink-300">Skor</p><p class="font-display text-3xl font-extrabold text-saffron-400" x-text="score"></p></div>
                <div class="rounded-2xl bg-white/10 p-3"><p class="text-[11px] font-bold uppercase text-ink-300">Combo</p><p class="font-display text-3xl font-extrabold text-lagoon-300" x-text="'x' + combo"></p></div>
            </div>
            <div class="mt-8 text-center">
                <template x-if="!running && !over"><div><p class="text-ink-300">Pilih level lalu mulai.</p><button @click="start()" class="btn-gold btn-lg mt-5">Mulai main</button></div></template>
                <template x-if="running">
                    <div>
                        <p class="font-display text-5xl font-extrabold sm:text-6xl" :class="flash" x-text="q.text + ' = ?'"></p>
                        <form @submit.prevent="answer()" class="mx-auto mt-6 flex max-w-xs gap-2">
                            <input x-ref="ans" x-model="input" inputmode="numeric" autocomplete="off" class="input !bg-white text-center font-display text-2xl font-bold" placeholder="?">
                            <button class="btn-primary">OK</button>
                        </form>
                        <button @click="skip()" class="mt-3 text-xs font-bold text-ink-300 hover:text-white">Lewati</button>
                    </div>
                </template>
                <template x-if="over"><div><p class="font-display text-4xl font-extrabold">Skor: <span class="text-saffron-400" x-text="score"></span></p><p class="mt-2 text-ink-300" x-text="correct + ' benar · ' + wrong + ' salah'"></p><p x-show="newBest" class="mt-2 font-bold text-lagoon-300">🎉 Rekor baru!</p><button @click="start()" class="btn-gold btn-lg mt-6">Main lagi</button></div></template>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
function mathGame() {
    const read = () => { try { return JSON.parse(localStorage.getItem('sn-math-best') || '{}') } catch (e) { return {} } };
    return {
        level: 'mudah', running: false, over: false, time: 60, score: 0, combo: 1, correct: 0, wrong: 0, input: '', q: {}, best: read(), newBest: false, flash: '', t: null,
        rnd(a, b) { return Math.floor(Math.random() * (b - a + 1)) + a },
        make() {
            const L = { mudah: [1, 20, ['+', '-']], sedang: [2, 50, ['+', '-', '×']], sulit: [3, 99, ['+', '-', '×', '÷']] }[this.level];
            const op = L[2][this.rnd(0, L[2].length - 1)]; let a = this.rnd(L[0], L[1]), b = this.rnd(L[0], L[1]), ans;
            if (op === '×') { a = this.rnd(2, this.level === 'sulit' ? 25 : 12); b = this.rnd(2, 12); ans = a * b; }
            else if (op === '÷') { b = this.rnd(2, 12); ans = this.rnd(2, 15); a = b * ans; }
            else if (op === '-') { if (b > a) [a, b] = [b, a]; ans = a - b; } else ans = a + b;
            this.q = { text: `${a} ${op} ${b}`, ans };
        },
        start() {
            Object.assign(this, { running: true, over: false, time: 60, score: 0, combo: 1, correct: 0, wrong: 0, input: '', newBest: false });
            this.make(); this.$nextTick(() => this.$refs.ans?.focus());
            clearInterval(this.t); this.t = setInterval(() => { if (--this.time <= 0) this.end() }, 1000);
        },
        answer() {
            if (this.input === '') return;
            if (parseInt(this.input) === this.q.ans) { this.correct++; this.score += 10 * this.combo; this.combo = Math.min(this.combo + 1, 5); this.flash = 'text-lagoon-300'; }
            else { this.wrong++; this.combo = 1; this.flash = 'text-garnet-400'; }
            setTimeout(() => this.flash = '', 250); this.input = ''; this.make(); this.$nextTick(() => this.$refs.ans?.focus());
        },
        skip() { this.combo = 1; this.make(); },
        end() {
            clearInterval(this.t); this.running = false; this.over = true;
            if (this.score > (this.best[this.level] || 0)) { this.best[this.level] = this.score; this.newBest = true; try { localStorage.setItem('sn-math-best', JSON.stringify(this.best)) } catch (e) {} }
        },
    };
}
</script>
@endpush
</x-layouts.app>
