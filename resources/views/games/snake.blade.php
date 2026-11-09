<x-layouts.app title="Game Snake">
<div x-data="snakeGame()" x-init="init()" @keydown.window="key($event)" class="mx-auto max-w-xl">
    <x-page-header title="Game Snake 🐍" sub="Istirahat sejenak. Gunakan panah/WASD atau tombol di layar."/>
    <div class="card-ink p-4 sm:p-6">
        <div class="relative flex items-center justify-between text-sm font-bold">
            <span>Skor <span class="font-display text-xl text-saffron-400" x-text="score"></span></span>
            <span>Rekor <span class="font-display text-xl text-lagoon-300" x-text="best"></span></span>
        </div>
        <div class="relative mt-4">
            <canvas x-ref="c" width="400" height="400" class="aspect-square w-full rounded-2xl bg-ink-950 ring-1 ring-white/10"></canvas>
            <div x-show="!running" class="absolute inset-0 grid place-items-center rounded-2xl bg-ink-950/70 text-center">
                <div><p class="font-display text-2xl font-extrabold" x-text="dead ? 'Game over!' : 'Siap?'"></p><button @click="start()" class="btn-gold mt-4" x-text="dead ? 'Main lagi' : 'Mulai'"></button></div>
            </div>
        </div>
        <div class="relative mx-auto mt-4 grid w-48 grid-cols-3 gap-2 sm:hidden">
            <span></span><button @click="turn(0,-1)" class="btn bg-white/10 text-white">▲</button><span></span>
            <button @click="turn(-1,0)" class="btn bg-white/10 text-white">◀</button><button @click="turn(0,1)" class="btn bg-white/10 text-white">▼</button><button @click="turn(1,0)" class="btn bg-white/10 text-white">▶</button>
        </div>
    </div>
</div>
@push('scripts')
<script>
function snakeGame() {
    const N = 20;
    return {
        snake: [], dir: { x: 1, y: 0 }, next: { x: 1, y: 0 }, food: {}, score: 0, best: 0, running: false, dead: false, t: null, ctx: null,
        init() { this.ctx = this.$refs.c.getContext('2d'); try { this.best = +localStorage.getItem('sn-snake-best') || 0 } catch (e) {} this.reset(); this.draw(); },
        reset() { this.snake = [{ x: 8, y: 10 }, { x: 7, y: 10 }, { x: 6, y: 10 }]; this.dir = this.next = { x: 1, y: 0 }; this.score = 0; this.place(); },
        place() { do { this.food = { x: Math.floor(Math.random() * N), y: Math.floor(Math.random() * N) } } while (this.snake.some(s => s.x === this.food.x && s.y === this.food.y)) },
        start() { this.reset(); this.dead = false; this.running = true; clearInterval(this.t); this.t = setInterval(() => this.step(), 110); },
        turn(x, y) { if (this.dir.x === -x && this.dir.y === -y) return; this.next = { x, y }; },
        key(e) { const m = { ArrowUp: [0, -1], ArrowDown: [0, 1], ArrowLeft: [-1, 0], ArrowRight: [1, 0], w: [0, -1], s: [0, 1], a: [-1, 0], d: [1, 0] }[e.key]; if (m && this.running) { e.preventDefault(); this.turn(...m) } },
        step() {
            this.dir = this.next; const h = { x: this.snake[0].x + this.dir.x, y: this.snake[0].y + this.dir.y };
            if (h.x < 0 || h.y < 0 || h.x >= N || h.y >= N || this.snake.some(s => s.x === h.x && s.y === h.y)) return this.over();
            this.snake.unshift(h);
            if (h.x === this.food.x && h.y === this.food.y) { this.score++; this.place(); } else this.snake.pop();
            this.draw();
        },
        over() { clearInterval(this.t); this.running = false; this.dead = true; if (this.score > this.best) { this.best = this.score; try { localStorage.setItem('sn-snake-best', this.best) } catch (e) {} } },
        draw() {
            const c = this.ctx, S = 400 / N; c.clearRect(0, 0, 400, 400);
            c.fillStyle = '#f99c07'; c.beginPath(); c.arc(this.food.x * S + S / 2, this.food.y * S + S / 2, S / 2.4, 0, Math.PI * 2); c.fill();
            this.snake.forEach((s, i) => { c.fillStyle = i === 0 ? '#f13562' : (i % 2 ? '#d81b4d' : '#b5123f'); c.beginPath(); c.roundRect(s.x * S + 1, s.y * S + 1, S - 2, S - 2, 5); c.fill(); });
        },
    };
}
</script>
@endpush
</x-layouts.app>
