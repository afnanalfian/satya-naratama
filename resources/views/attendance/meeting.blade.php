@extends('layouts.app')

@section('title', 'Absensi · ' . $meeting->title)

@section('content')
<div class="py-6 md:py-8" x-data="attendancePage()" x-init="init()">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Breadcrumb --}}
        <nav class="flex flex-wrap items-center gap-2 text-sm mb-6">
            <a href="{{ route('attendance.hub') }}" class="text-secondary-500 hover:text-primary-600 dark:text-secondary-400 dark:hover:text-primary-300">Scan Absensi</a>
            <span class="text-secondary-300 dark:text-secondary-600">/</span>
            <a href="{{ route('meeting.show', $meeting) }}" class="text-secondary-500 hover:text-primary-600 dark:text-secondary-400 dark:hover:text-primary-300">{{ $meeting->title }}</a>
            <span class="text-secondary-300 dark:text-secondary-600">/</span>
            <span class="text-primary-600 dark:text-primary-300 font-medium">Absensi</span>
        </nav>

        {{-- Header --}}
        <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 p-5 md:p-6 mb-6 shadow-sm">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div class="min-w-0">
                    <div class="flex flex-wrap items-center gap-2 mb-1">
                        <x-course-type-badge :type="$meeting->course?->type" size="xs" />
                        <span class="text-xs font-semibold px-2 py-0.5 rounded-full"
                              :class="meetingStatus === 'live' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300'
                                    : (meetingStatus === 'done' ? 'bg-secondary-100 text-secondary-700 dark:bg-secondary-900/30 dark:text-secondary-300'
                                    : 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300')"
                              x-text="{live: '● Live', done: 'Selesai', upcoming: 'Akan datang'}[meetingStatus]"></span>
                    </div>
                    <h1 class="text-xl md:text-2xl font-bold text-primary-800 dark:text-primary-100 truncate">{{ $meeting->title }}</h1>
                    <p class="text-sm text-secondary-500 dark:text-secondary-400 mt-1">
                        {{ $meeting->course?->name }} · {{ $meeting->scheduled_at?->translatedFormat('l, d F Y · H:i') }} WIB
                    </p>
                </div>

                @if($isAdmin && $meeting->status !== 'done')
                    <form method="POST" action="{{ route('meeting.attendance.complete', $meeting) }}" class="sweet-confirm"
                          data-message="Tandai pertemuan ini selesai? Pertemuan selesai masuk ke perhitungan persentase kehadiran.">
                        @csrf
                        <button class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-primary-200 dark:border-primary-700/50 text-sm font-medium text-primary-700 dark:text-primary-200 hover:bg-primary-50 dark:hover:bg-primary-800/30 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            Tandai Pertemuan Selesai
                        </button>
                    </form>
                @endif
            </div>

            {{-- Counters --}}
            <div class="grid grid-cols-3 sm:grid-cols-6 gap-2 mt-5">
                <template x-for="tile in tiles" :key="tile.key">
                    <div class="rounded-xl border border-primary-100 dark:border-primary-700/30 px-3 py-2.5">
                        <p class="text-[11px] uppercase tracking-wide text-secondary-500 dark:text-secondary-400" x-text="tile.label"></p>
                        <p class="text-xl font-bold" :class="tile.cls" x-text="tile.value"></p>
                    </div>
                </template>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

            {{-- ================= SCANNER ================= --}}
            <div class="lg:col-span-2 space-y-4">
                <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 shadow-sm overflow-hidden lg:sticky lg:top-4">
                    <div class="px-5 py-4 border-b border-primary-100 dark:border-primary-800/30 flex items-center justify-between">
                        <h2 class="font-semibold text-primary-800 dark:text-primary-100">Scan QR Siswa</h2>
                        <span x-show="scanning" class="inline-flex items-center gap-1.5 text-xs font-medium text-emerald-600 dark:text-emerald-400">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> Kamera aktif
                        </span>
                    </div>

                    @if($canScan)
                        <div class="p-5 space-y-4">
                            <div class="relative rounded-xl overflow-hidden bg-primary-950 min-h-[280px] flex items-center">
                                <div id="qr-reader" class="w-full"></div>
                                <div x-show="!scanning" class="absolute inset-0 flex flex-col items-center justify-center text-center p-6 text-primary-100">
                                    <svg class="w-14 h-14 opacity-70 mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 9V5a2 2 0 012-2h4M15 3h4a2 2 0 012 2v4M21 15v4a2 2 0 01-2 2h-4M9 21H5a2 2 0 01-2-2v-4M7 12h10"/></svg>
                                    <p class="text-sm opacity-80" x-text="cameraError || 'Arahkan kamera ke QR code pada kartu / HP siswa.'"></p>
                                </div>
                                {{-- Flash hasil --}}
                                <div x-show="flash" x-transition.opacity
                                     class="absolute inset-0 flex items-center justify-center pointer-events-none"
                                     :class="flash === 'ok' ? 'bg-emerald-500/35' : (flash === 'dup' ? 'bg-amber-400/35' : 'bg-red-500/35')"></div>
                            </div>

                            <div class="flex gap-2">
                                <button type="button" @click="scanning ? stopCamera() : startCamera()"
                                        class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold text-white transition"
                                        :class="scanning ? 'bg-red-600 hover:bg-red-700' : 'bg-primary-600 hover:bg-primary-700'">
                                    <span x-text="scanning ? 'Hentikan Kamera' : 'Mulai Scan'"></span>
                                </button>
                                <button type="button" x-show="cameras.length > 1" @click="switchCamera()"
                                        class="px-3 py-2.5 rounded-xl border border-primary-200 dark:border-primary-700/50 text-secondary-600 dark:text-secondary-300 hover:bg-primary-50 dark:hover:bg-primary-800/30" title="Ganti kamera">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h5M20 20v-5h-5M5.6 15a7 7 0 0012.3 2.3M18.4 9A7 7 0 006.1 6.7"/></svg>
                                </button>
                            </div>

                            {{-- Input kode (scanner USB / ketik manual kode kartu) --}}
                            <form @submit.prevent="submitCode(codeInput); codeInput=''" class="flex gap-2">
                                <input x-model="codeInput" x-ref="codeInput" type="text" autocomplete="off"
                                       placeholder="Atau ketik / tembak kode QR (scanner USB)"
                                       class="flex-1 px-3.5 py-2.5 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-sm text-primary-800 dark:text-primary-100 placeholder-secondary-400 focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500">
                                <button class="px-4 py-2.5 rounded-xl bg-secondary-600 hover:bg-secondary-700 text-white text-sm font-medium">Kirim</button>
                            </form>

                            {{-- Hasil scan terakhir --}}
                            <template x-if="last">
                                <div class="rounded-xl border p-3.5 flex items-center gap-3"
                                     :class="last.ok ? (last.code === 'duplicate'
                                            ? 'border-amber-200 bg-amber-50 dark:border-amber-800/40 dark:bg-amber-900/20'
                                            : 'border-emerald-200 bg-emerald-50 dark:border-emerald-800/40 dark:bg-emerald-900/20')
                                            : 'border-red-200 bg-red-50 dark:border-red-800/40 dark:bg-red-900/20'">
                                    <img x-show="last.student" :src="last.student?.avatar" class="w-11 h-11 rounded-full object-cover ring-2 ring-white dark:ring-primary-900" alt="">
                                    <div class="min-w-0">
                                        <p class="text-sm font-semibold text-primary-900 dark:text-primary-50 truncate" x-text="last.student?.name || 'Gagal'"></p>
                                        <p class="text-xs text-secondary-600 dark:text-secondary-300" x-text="last.message"></p>
                                    </div>
                                </div>
                            </template>

                            {{-- Log scan sesi ini --}}
                            <div x-show="log.length" class="border-t border-primary-100 dark:border-primary-800/30 pt-3">
                                <p class="text-xs font-semibold uppercase tracking-wide text-secondary-500 dark:text-secondary-400 mb-2">Scan sesi ini</p>
                                <ul class="space-y-1.5 max-h-48 overflow-y-auto text-sm">
                                    <template x-for="(item, i) in log" :key="i">
                                        <li class="flex items-center justify-between gap-2">
                                            <span class="truncate text-primary-800 dark:text-primary-100" x-text="item.name"></span>
                                            <span class="shrink-0 text-xs tabular-nums"
                                                  :class="item.ok ? 'text-emerald-600 dark:text-emerald-400' : 'text-red-600 dark:text-red-400'"
                                                  x-text="item.time"></span>
                                        </li>
                                    </template>
                                </ul>
                            </div>

                            <p class="text-[11px] text-secondary-400 dark:text-secondary-500 leading-relaxed">
                                Kamera membutuhkan koneksi HTTPS. Siswa yang sudah hadir tidak akan tercatat dua kali.
                                Scan lewat {{ config('attendance.late_tolerance_minutes') }} menit dari jadwal ditandai <em>terlambat</em>.
                            </p>
                        </div>
                    @else
                        <div class="p-6 text-center">
                            <svg class="w-12 h-12 mx-auto text-secondary-300 dark:text-secondary-600 mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            <p class="text-sm text-secondary-600 dark:text-secondary-300">{{ $scanReason }}</p>
                            @if($isAdmin)
                                <p class="text-xs text-secondary-500 dark:text-secondary-400 mt-2">Sebagai admin, Anda bisa mengubah status tiap siswa di daftar sebelah.</p>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            {{-- ================= DAFTAR SISWA ================= --}}
            <div class="lg:col-span-3">
                <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 shadow-sm overflow-hidden">
                    <div class="p-4 border-b border-primary-100 dark:border-primary-800/30 space-y-3">
                        <div class="flex flex-col sm:flex-row gap-3">
                            <div class="relative flex-1">
                                <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                                <input x-model="search" type="text" placeholder="Cari nama siswa..."
                                       class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-primary-50/50 dark:bg-primary-800/20 text-sm text-primary-800 dark:text-primary-100 placeholder-secondary-400 focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500">
                            </div>
                            @if($isAdmin)
                                <form method="POST" action="{{ route('meeting.attendance.bulk', $meeting) }}" class="flex gap-2 sweet-confirm"
                                      data-message="Tandai semua siswa yang BELUM tercatat dengan status terpilih?">
                                    @csrf
                                    <select name="status" class="rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-sm text-primary-800 dark:text-primary-100 py-2.5">
                                        <option value="alpa">Sisa → Alpa</option>
                                        <option value="hadir">Sisa → Hadir</option>
                                    </select>
                                    <button class="px-3.5 py-2.5 rounded-xl border border-primary-200 dark:border-primary-700/50 text-sm font-medium text-secondary-700 dark:text-secondary-200 hover:bg-primary-50 dark:hover:bg-primary-800/30 whitespace-nowrap">Terapkan</button>
                                </form>
                            @endif
                        </div>
                        <div class="flex flex-wrap gap-1.5">
                            <template x-for="f in filterTabs" :key="f.key">
                                <button type="button" @click="filter = f.key"
                                        class="px-3 py-1.5 rounded-lg text-xs font-medium transition"
                                        :class="filter === f.key ? 'bg-primary-600 text-white' : 'bg-primary-50 dark:bg-primary-800/30 text-secondary-600 dark:text-secondary-300 hover:bg-primary-100 dark:hover:bg-primary-800/50'">
                                    <span x-text="f.label"></span>
                                    <span class="ml-1 opacity-75" x-text="countFor(f.key)"></span>
                                </button>
                            </template>
                        </div>
                    </div>

                    <ul class="divide-y divide-primary-100 dark:divide-primary-800/30">
                        <template x-for="row in filteredRows" :key="row.id">
                            <li class="px-4 py-3 flex flex-col sm:flex-row sm:items-center gap-3 transition-colors"
                                :class="row.id === highlightId ? 'bg-emerald-50 dark:bg-emerald-900/20' : ''">
                                <div class="flex items-center gap-3 flex-1 min-w-0">
                                    <img :src="row.avatar" class="w-9 h-9 rounded-full object-cover shrink-0" alt="">
                                    <div class="min-w-0">
                                        <p class="text-sm font-medium text-primary-800 dark:text-primary-100 truncate" x-text="row.name"></p>
                                        <p class="text-xs text-secondary-500 dark:text-secondary-400">
                                            <span x-text="row.class ? 'Kelas ' + row.class : ''"></span>
                                            <template x-if="row.time">
                                                <span>
                                                    <span x-show="row.class"> · </span>
                                                    <span class="tabular-nums" x-text="row.time"></span>
                                                    <span x-show="row.method === 'scan'" title="Scan QR"> · QR</span>
                                                    <span x-show="row.method === 'manual'" title="Input manual admin"> · manual</span>
                                                </span>
                                            </template>
                                        </p>
                                        <p x-show="row.note" class="text-xs italic text-secondary-500 dark:text-secondary-400 truncate" x-text="row.note"></p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-2 sm:justify-end">
                                    <span x-show="row.late" class="text-[11px] font-semibold px-2 py-0.5 rounded-full bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-300">Terlambat</span>
                                    <span class="text-xs font-semibold px-2.5 py-1 rounded-full inline-flex items-center gap-1" :class="statusClass(row.status)">
                                        <span x-text="statusIcon(row.status)"></span>
                                        <span x-text="statusLabel(row.status)"></span>
                                    </span>

                                    @if($isAdmin)
                                        <div class="relative" x-data="{ open: false }">
                                            <button type="button" @click="open = !open; editTime = row.time || ''; editNote = row.note || ''"
                                                    class="p-2 rounded-lg text-secondary-500 hover:bg-primary-50 dark:hover:bg-primary-800/30" title="Ubah manual">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            </button>
                                            <div x-show="open" x-cloak @click.outside="open = false" x-transition
                                                 class="absolute right-0 z-30 mt-2 w-64 rounded-xl border border-primary-100 dark:border-primary-700/50 bg-white dark:bg-primary-900 shadow-xl p-3 space-y-2.5">
                                                <p class="text-xs font-semibold text-secondary-500 dark:text-secondary-400 uppercase tracking-wide">Absensi manual</p>
                                                <div class="grid grid-cols-2 gap-1.5">
                                                    @foreach($statuses as $key => $label)
                                                        <button type="button" @click="saveManual(row, '{{ $key }}'); open = false"
                                                                class="px-2 py-1.5 rounded-lg text-xs font-semibold border border-primary-100 dark:border-primary-700/50 hover:bg-primary-50 dark:hover:bg-primary-800/40 text-primary-800 dark:text-primary-100">
                                                            {{ $label }}
                                                        </button>
                                                    @endforeach
                                                </div>
                                                <label class="block">
                                                    <span class="text-[11px] text-secondary-500 dark:text-secondary-400">Jam hadir (opsional)</span>
                                                    <input type="time" x-model="editTime" class="mt-0.5 w-full rounded-lg border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-sm py-1.5 text-primary-800 dark:text-primary-100">
                                                </label>
                                                <label class="block">
                                                    <span class="text-[11px] text-secondary-500 dark:text-secondary-400">Keterangan (opsional)</span>
                                                    <input type="text" x-model="editNote" maxlength="255" placeholder="mis. surat izin orang tua" class="mt-0.5 w-full rounded-lg border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-sm py-1.5 text-primary-800 dark:text-primary-100">
                                                </label>
                                                <button type="button" x-show="row.status" @click="saveManual(row, 'reset'); open = false"
                                                        class="w-full text-xs text-red-600 dark:text-red-400 hover:underline pt-1">Hapus catatan absensi</button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </li>
                        </template>
                        <li x-show="filteredRows.length === 0" class="px-4 py-12 text-center text-sm text-secondary-500 dark:text-secondary-400">
                            Tidak ada siswa pada filter ini.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@include('partials.js-toast')
@if($canScan)
<script src="{{ asset('vendor/html5-qrcode/html5-qrcode.min.js') }}"></script>
@endif
<script>
function attendancePage() {
    return {
        rows: @json($rows),
        counts: @json($counts),
        meetingStatus: @json($meeting->status),
        urls: {
            scan: @json(route('meeting.attendance.scan', $meeting)),
            feed: @json(route('meeting.attendance.feed', $meeting)),
            manual: @json(route('meeting.attendance.manual', $meeting)),
        },
        csrf: document.querySelector('meta[name="csrf-token"]').content,
        search: '', filter: 'all', codeInput: '',
        scanning: false, scanner: null, cameras: [], cameraIndex: 0, cameraError: '',
        busy: false, lastCode: null, lastCodeAt: 0,
        last: null, log: [], flash: null, highlightId: null,
        editTime: '', editNote: '',

        init() {
            setInterval(() => { if (!document.hidden) this.refresh(); }, 8000);
            this.$nextTick(() => this.$refs.codeInput?.focus());
        },

        get tiles() {
            const c = this.counts;
            return [
                { key: 'total', label: 'Peserta', value: c.total, cls: 'text-primary-800 dark:text-primary-100' },
                { key: 'hadir', label: 'Hadir', value: c.hadir, cls: 'text-emerald-600 dark:text-emerald-400' },
                { key: 'izin', label: 'Izin', value: c.izin, cls: 'text-amber-600 dark:text-amber-400' },
                { key: 'sakit', label: 'Sakit', value: c.sakit, cls: 'text-amber-600 dark:text-amber-400' },
                { key: 'alpa', label: 'Alpa', value: c.alpa, cls: 'text-red-600 dark:text-red-400' },
                { key: 'pct', label: 'Kehadiran', value: (c.pct ?? 0).toLocaleString('id-ID') + '%', cls: 'text-primary-700 dark:text-primary-200' },
            ];
        },
        filterTabs: [
            { key: 'all', label: 'Semua' }, { key: 'hadir', label: 'Hadir' }, { key: 'none', label: 'Belum' },
            { key: 'izin', label: 'Izin' }, { key: 'sakit', label: 'Sakit' }, { key: 'alpa', label: 'Alpa' },
        ],
        countFor(key) {
            if (key === 'all') return this.rows.length;
            if (key === 'none') return this.rows.filter(r => !r.status).length;
            return this.rows.filter(r => r.status === key).length;
        },
        get filteredRows() {
            const q = this.search.trim().toLowerCase();
            return this.rows.filter(r => {
                if (q && !r.name.toLowerCase().includes(q)) return false;
                if (this.filter === 'all') return true;
                if (this.filter === 'none') return !r.status;
                return r.status === this.filter;
            });
        },
        statusLabel(s) { return { hadir: 'Hadir', izin: 'Izin', sakit: 'Sakit', alpa: 'Alpa' }[s] || 'Belum'; },
        statusIcon(s) { return { hadir: '✓', izin: '•', sakit: '+', alpa: '✕' }[s] || '–'; },
        statusClass(s) {
            return {
                hadir: 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300',
                izin: 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-300',
                sakit: 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-300',
                alpa: 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300',
            }[s] || 'bg-primary-50 text-secondary-500 dark:bg-primary-800/30 dark:text-secondary-400';
        },

        applyAttendance(a) {
            const row = this.rows.find(r => r.id === a.user_id);
            if (!row) return;
            Object.assign(row, { status: a.status, time: a.time ?? null, late: !!a.late, method: a.method ?? null, note: a.note ?? null });
        },

        async post(url, body) {
            const res = await fetch(url, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': this.csrf },
                body: JSON.stringify(body),
            });
            let data = {};
            try { data = await res.json(); } catch (e) {}
            if (res.status === 419) data.message = 'Sesi habis, muat ulang halaman.';
            return { res, data };
        },

        /* ---------- SCAN ---------- */
        async submitCode(code) {
            code = (code || '').trim();
            if (!code || this.busy) return;
            const now = Date.now();
            // QR yang sama masih di depan kamera -> abaikan selama 8 detik
            if (code === this.lastCode && now - this.lastCodeAt < 8000) return;
            this.lastCode = code; this.lastCodeAt = now; this.busy = true;

            try {
                const { data } = await this.post(this.urls.scan, { code });
                this.last = data;
                if (data.counts) this.counts = data.counts;
                if (data.meeting_status) this.meetingStatus = data.meeting_status;
                if (data.attendance) {
                    this.applyAttendance(data.attendance);
                    this.highlightId = data.attendance.user_id;
                    setTimeout(() => this.highlightId = null, 2500);
                }
                const kind = data.ok ? (data.code === 'duplicate' ? 'dup' : 'ok') : 'err';
                this.feedback(kind);
                this.log.unshift({
                    name: data.student?.name || data.message || 'QR tidak dikenal',
                    time: data.ok ? (data.code === 'duplicate' ? 'sudah' : (data.attendance?.time || '')) : 'gagal',
                    ok: data.ok,
                });
                this.log = this.log.slice(0, 30);
            } catch (e) {
                this.last = { ok: false, message: 'Koneksi bermasalah, coba lagi.' };
                this.feedback('err');
            } finally {
                this.busy = false;
            }
        },

        feedback(kind) {
            this.flash = kind;
            setTimeout(() => this.flash = null, 450);
            try {
                if (navigator.vibrate) navigator.vibrate(kind === 'ok' ? 80 : [60, 60, 60]);
                const ctx = this._audio || (this._audio = new (window.AudioContext || window.webkitAudioContext)());
                const o = ctx.createOscillator(), g = ctx.createGain();
                o.frequency.value = kind === 'ok' ? 880 : (kind === 'dup' ? 520 : 220);
                g.gain.value = 0.08; o.connect(g); g.connect(ctx.destination);
                o.start(); o.stop(ctx.currentTime + (kind === 'ok' ? 0.12 : 0.25));
            } catch (e) {}
        },

        async startCamera() {
            if (typeof Html5Qrcode === 'undefined') { this.cameraError = 'Library scanner gagal dimuat.'; return; }
            this.cameraError = '';
            try {
                if (!this.cameras.length) {
                    this.cameras = await Html5Qrcode.getCameras();
                    const back = this.cameras.findIndex(c => /back|rear|belakang|environment/i.test(c.label));
                    this.cameraIndex = back >= 0 ? back : this.cameras.length - 1;
                }
                if (!this.cameras.length) { this.cameraError = 'Kamera tidak ditemukan.'; return; }
                this.scanner = this.scanner || new Html5Qrcode('qr-reader', { verbose: false });
                await this.scanner.start(
                    this.cameras[this.cameraIndex].id,
                    { fps: 12, qrbox: (w, h) => { const s = Math.floor(Math.min(w, h) * 0.7); return { width: s, height: s }; } },
                    (text) => this.submitCode(text),
                    () => {}
                );
                this.scanning = true;
            } catch (e) {
                this.cameraError = 'Tidak bisa membuka kamera. Pastikan izin kamera diberikan dan situs memakai HTTPS.';
                this.scanning = false;
            }
        },
        async stopCamera() {
            try { await this.scanner?.stop(); } catch (e) {}
            this.scanning = false;
        },
        async switchCamera() {
            if (this.cameras.length < 2) return;
            await this.stopCamera();
            this.cameraIndex = (this.cameraIndex + 1) % this.cameras.length;
            await this.startCamera();
        },

        /* ---------- SINKRON ---------- */
        async refresh() {
            try {
                const res = await fetch(this.urls.feed, { headers: { 'Accept': 'application/json' } });
                if (!res.ok) return;
                const data = await res.json();
                this.counts = data.counts;
                this.meetingStatus = data.meeting_status;
                const map = {};
                data.records.forEach(r => map[r.user_id] = r);
                this.rows.forEach(row => {
                    const r = map[row.id];
                    if (r) this.applyAttendance(r);
                    else Object.assign(row, { status: null, time: null, late: false, method: null, note: null });
                });
            } catch (e) {}
        },

        /* ---------- MANUAL (ADMIN) ---------- */
        async saveManual(row, status) {
            const { res, data } = await this.post(this.urls.manual, {
                user_id: row.id, status, time: this.editTime || null, note: this.editNote || null,
            });
            if (res.ok) {
                this.applyAttendance(data.attendance);
                this.counts = data.counts;
                snToast('success', data.message);
            } else {
                const msg = data.message || 'Gagal menyimpan';
                snToast('error', msg);
            }
        },
    };
}
</script>
@endpush
