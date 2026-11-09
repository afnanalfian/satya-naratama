@php $rp = fn ($n) => 'Rp '.number_format((float) $n, 0, ',', '.'); $hour = now()->hour; $greet = $hour < 11 ? 'Selamat pagi' : ($hour < 15 ? 'Selamat siang' : ($hour < 18 ? 'Selamat sore' : 'Selamat malam')); @endphp
<div>
    <x-chartjs />
    {{-- Hero --}}
    <div class="card-ink mb-6 p-6 sm:p-8">
        <div class="absolute inset-0 bg-grid-ink [background-size:30px_30px]"></div>
        <div class="blob -right-16 -top-16 h-64 w-64 bg-garnet-600/50"></div>
        <div class="blob bottom-0 left-1/3 h-40 w-40 bg-saffron-500/30"></div>
        <div class="relative flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="text-sm font-semibold text-saffron-300">{{ $greet }}, {{ auth()->user()->name }} 👋</p>
                <h1 class="mt-1 font-display text-3xl font-extrabold">Ringkasan Satya Naratama</h1>
                <p class="mt-2 text-sm text-ink-300">{{ now()->translatedFormat('l, d F Y') }}</p>
            </div>
            <div class="grid grid-cols-2 gap-3 sm:grid-cols-3">
                <a href="{{ route('orders.index') }}" class="rounded-2xl bg-white/10 p-4 ring-1 ring-white/10 transition hover:bg-white/20">
                    <p class="text-[11px] font-bold uppercase text-ink-300">Pesanan menunggu</p><p class="font-display text-3xl font-extrabold text-saffron-400">{{ $stats['pending_orders'] }}</p></a>
                <a href="{{ route('admin.registrations.index') }}" class="rounded-2xl bg-white/10 p-4 ring-1 ring-white/10 transition hover:bg-white/20">
                    <p class="text-[11px] font-bold uppercase text-ink-300">Pendaftar baru</p><p class="font-display text-3xl font-extrabold text-garnet-400">{{ $stats['pending_regs'] }}</p></a>
                <div class="col-span-2 rounded-2xl bg-white/10 p-4 ring-1 ring-white/10 sm:col-span-1">
                    <p class="text-[11px] font-bold uppercase text-ink-300">Pendapatan bulan ini</p><p class="font-display text-xl font-extrabold text-lagoon-300">{{ $rp($stats['month_income']) }}</p></div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4 lg:grid-cols-4">
        <x-stat label="Siswa" :value="$stats['total_siswa']" icon="users" tone="garnet" :hint="$stats['active_siswa'].' aktif'" :href="route('siswa.index')"/>
        <x-stat label="Tentor" :value="$stats['total_tentor']" icon="teacher" tone="gold" :href="route('tentor.index')"/>
        <x-stat label="Kelas" :value="$stats['total_course']" icon="book" tone="lagoon" :hint="$stats['total_meeting'].' pertemuan'" :href="route('course.index')"/>
        <x-stat label="Ujian aktif" :value="$stats['active_exams']" icon="trophy" tone="ink" :hint="$stats['done_meeting'].' pertemuan selesai'" :href="route('tryouts.index')"/>
    </div>

    <div class="mt-6 grid gap-6 xl:grid-cols-3">
        {{-- Grafik penjualan --}}
        <div class="card card-pad xl:col-span-2">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <div>
                    <p class="section-title">Penjualan mingguan</p>
                    <p class="text-xs text-ink-400">{{ $weekLabel }} · total <b class="text-ink-800">{{ $rp($weekTotal) }}</b></p>
                </div>
                <div class="flex items-center gap-1">
                    <button wire:click="prevWeek" class="btn-soft btn-icon"><x-icon name="chevron-left" class="h-4 w-4"/></button>
                    <button wire:click="thisWeek" class="btn-soft btn-sm" @disabled($weekOffset === 0)>Minggu ini</button>
                    <button wire:click="nextWeek" class="btn-soft btn-icon"><x-icon name="chevron-right" class="h-4 w-4"/></button>
                </div>
            </div>
            <div class="mt-5 h-72" wire:ignore
                 x-data="chart({ type: 'bar', data: { labels: @js(array_map(fn ($d) => $d['day'].' '.$d['date'], $days)), datasets: [{ label: 'Penjualan', data: @js(array_column($days, 'total')), backgroundColor: (c) => { const g = c.chart.ctx.createLinearGradient(0,0,0,300); g.addColorStop(0,'#f13562'); g.addColorStop(1,'#f99c07'); return g; }, borderRadius: 12, maxBarThickness: 46 }] },
                     options: { maintainAspectRatio: false, plugins: { legend: { display: false }, tooltip: { callbacks: { label: (c) => window.rupiah(c.raw) } } }, scales: { y: { ticks: { callback: (v) => v >= 1e6 ? (v/1e6)+' jt' : (v >= 1e3 ? (v/1e3)+' rb' : v) } }, x: { grid: { display: false } } } } })"
                 x-on:sales-updated.window="c.data.labels = $event.detail.labels; c.data.datasets[0].data = $event.detail.data; c.update()">
                <canvas x-ref="canvas"></canvas>
            </div>
        </div>

        {{-- Pesanan menunggu --}}
        <div class="card card-pad">
            <div class="flex items-center justify-between"><p class="section-title">Perlu diverifikasi</p><a href="{{ route('orders.index', ['status' => 'paid']) }}" class="text-xs font-bold text-garnet-600">Semua →</a></div>
            <div class="mt-4 space-y-2">
                @forelse($pendingOrders as $o)
                    <a href="{{ route('orders.show', $o) }}" class="flex items-center gap-3 rounded-2xl p-2.5 transition hover:bg-cream">
                        <img src="{{ $o->user?->avatar_url ?? asset('img/user.png') }}" class="h-10 w-10 rounded-xl object-cover" alt="">
                        <div class="min-w-0 flex-1"><p class="truncate text-sm font-bold">{{ $o->user?->name ?? '—' }}</p><p class="text-xs text-ink-400">{{ $o->created_at->diffForHumans() }}</p></div>
                        <span class="text-sm font-extrabold">{{ $rp($o->total_amount) }}</span>
                    </a>
                @empty
                    <div class="rounded-2xl bg-lagoon-50 p-6 text-center text-sm font-semibold text-lagoon-700">Semua pesanan sudah diproses ✨</div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Jadwal minggu ini --}}
    <div class="card mt-6 card-pad">
        <div class="flex items-center justify-between"><p class="section-title">Pertemuan {{ $weekOffset === 0 ? 'minggu ini' : 'pada minggu terpilih' }}</p><a href="{{ route('schedule.index') }}" class="text-xs font-bold text-garnet-600">Kalender →</a></div>
        <div class="mt-4 grid gap-3 md:grid-cols-2">
            @forelse($meetingsThisWeek as $m)
                <a href="{{ route('meeting.show', $m) }}" class="flex items-center gap-4 rounded-2xl border border-ink-50 p-3 transition hover:border-ink-200 hover:bg-cream">
                    <div class="grid h-14 w-14 shrink-0 place-items-center rounded-2xl {{ $m->status === 'live' ? 'bg-garnet-600 text-white' : 'bg-ink-50 text-ink-800' }} text-center">
                        <div><p class="text-[10px] font-bold uppercase">{{ $m->scheduled_at->translatedFormat('D') }}</p><p class="font-display text-xl font-extrabold leading-none">{{ $m->scheduled_at->format('d') }}</p></div>
                    </div>
                    <div class="min-w-0 flex-1"><p class="truncate font-bold">{{ $m->title }}</p><p class="truncate text-xs text-ink-400">{{ $m->course?->name }} · {{ $m->scheduled_at->format('H:i') }}</p></div>
                    <x-status-badge :status="$m->status"/>
                </a>
            @empty
                <div class="md:col-span-2"><x-empty icon="calendar" title="Tidak ada pertemuan" text="Belum ada pertemuan yang dijadwalkan pada minggu ini."/></div>
            @endforelse
        </div>
    </div>

    {{-- Pintasan --}}
    <div class="mt-6 grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-6">
        @foreach([['attendance.hub','scan','Scan Presensi'],['course.create','plus','Kelas Baru'],['tryouts.index','trophy','Tryout'],['bank.category.index','stack','Bank Soal'],['reports.income','trend','Laporan'],['monitor.links','link','Link Ortu']] as [$r,$i,$l])
            <a href="{{ route($r) }}" class="card card-hover flex flex-col items-center gap-2 p-4 text-center">
                <span class="grid h-11 w-11 place-items-center rounded-2xl bg-ink-900 text-saffron-400"><x-icon :name="$i" class="h-5 w-5"/></span>
                <span class="text-xs font-bold">{{ $l }}</span>
            </a>
        @endforeach
    </div>
</div>
