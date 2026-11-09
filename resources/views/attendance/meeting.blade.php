<x-layouts.app :title="'Presensi · '.$meeting->title" :wide="true">
@push('head')<script src="{{ asset('vendor/html5-qrcode/html5-qrcode.min.js') }}"></script>@endpush
<div x-data="attendancePage(@js([
        'rows' => $rows, 'counts' => $counts, 'canScan' => $canScan, 'isAdmin' => $isAdmin, 'statuses' => $statuses,
        'scanUrl' => route('meeting.attendance.scan', $meeting), 'feedUrl' => route('meeting.attendance.feed', $meeting), 'manualUrl' => route('meeting.attendance.manual', $meeting),
        'status' => $meeting->status,
    ]))" x-init="init()">
    <x-page-header :title="'Presensi: '.$meeting->title" :sub="$meeting->course?->name.' · '.$meeting->scheduled_at?->translatedFormat('l, d M Y H:i')" :back="route('meeting.show', $meeting)">
        <x-slot:actions>
            <x-status-badge :status="$meeting->status" class="!text-xs"/>
            @if($isAdmin)
                <form method="POST" action="{{ route('meeting.attendance.bulk', $meeting) }}" data-confirm="Tandai semua siswa yang belum tercatat sebagai ALPA?" class="flex">@csrf<input type="hidden" name="status" value="alpa"><button class="btn-soft btn-sm">Sisa → Alpa</button></form>
                @if($meeting->status !== 'done')
                    <form method="POST" action="{{ route('meeting.attendance.complete', $meeting) }}" data-confirm="Tandai pertemuan selesai? Data masuk perhitungan persentase." data-ok="Selesai">@csrf<button class="btn-lagoon btn-sm"><x-icon name="check-circle" class="h-4 w-4"/> Tandai selesai</button></form>
                @endif
            @endif
        </x-slot:actions>
    </x-page-header>

    <div class="grid gap-6 xl:grid-cols-5">
        {{-- Scanner --}}
        <div class="space-y-4 xl:col-span-2">
            <div class="card overflow-hidden">
                <div class="relative aspect-square bg-ink-950 sm:aspect-video xl:aspect-square">
                    <div id="qr-reader" class="h-full w-full [&_video]:!h-full [&_video]:!w-full [&_video]:object-cover"></div>
                    <div x-show="!camOn" class="absolute inset-0 grid place-items-center text-center text-white">
                        <div class="px-6">
                            <span class="mx-auto grid h-16 w-16 place-items-center rounded-3xl bg-white/10"><x-icon name="scan" class="h-8 w-8 text-saffron-400"/></span>
                            <p class="mt-4 font-display text-lg font-bold">Scanner QR presensi</p>
                            @if($canScan)
                                <p class="mt-1 text-sm text-ink-300">Gunakan kamera HP/laptop, atau scanner USB pada kolom di bawah.</p>
                                <button @click="startCam()" class="btn-gold mt-5"><x-icon name="video" class="h-4 w-4"/> Nyalakan kamera</button>
                            @else
                                <p class="mt-2 text-sm text-garnet-300">{{ $scanReason }}</p>
                            @endif
                        </div>
                    </div>
                    <div x-show="last" x-transition class="absolute inset-x-3 bottom-3 rounded-2xl p-3 text-sm font-bold shadow-lift"
                         :class="last?.ok ? (last.code === 'duplicate' ? 'bg-saffron-400 text-ink-900' : 'bg-lagoon-500 text-white') : 'bg-garnet-600 text-white'">
                        <div class="flex items-center gap-3"><img x-show="last?.student" :src="last?.student?.avatar" class="h-10 w-10 rounded-xl object-cover" alt=""><span x-text="last?.message"></span></div>
                    </div>
                </div>
                <div class="flex items-center gap-2 p-3">
                    <form @submit.prevent="submitCode(code); code=''" class="flex flex-1 gap-2">
                        <input x-model="code" x-ref="code" class="input" placeholder="Ketik / scan kode QR (SN-…)" @disabled(! $canScan)>
                        <button class="btn-ink" @disabled(! $canScan)>Catat</button>
                    </form>
                    <button x-show="camOn" @click="stopCam()" class="btn-danger btn-icon" title="Matikan kamera"><x-icon name="x" class="h-5 w-5"/></button>
                </div>
            </div>
            <div class="grid grid-cols-3 gap-3">
                <div class="stat !p-4"><p class="stat-label">Hadir</p><p class="font-display text-3xl font-extrabold text-lagoon-600" x-text="counts.hadir"></p></div>
                <div class="stat !p-4"><p class="stat-label">Izin/Sakit</p><p class="font-display text-3xl font-extrabold text-sky-600" x-text="counts.izin + counts.sakit"></p></div>
                <div class="stat !p-4"><p class="stat-label">Belum</p><p class="font-display text-3xl font-extrabold text-ink-400" x-text="counts.unrecorded"></p></div>
            </div>
            <div class="card p-4">
                <div class="flex justify-between text-xs font-bold"><span>Kehadiran</span><span x-text="counts.pct + '%'"></span></div>
                <div class="mt-2 h-3 overflow-hidden rounded-full bg-ink-50"><div class="h-full rounded-full bg-sunrise transition-all duration-500" :style="'width:' + counts.pct + '%'"></div></div>
            </div>
        </div>

        {{-- Roster --}}
        <div class="card xl:col-span-3">
            <div class="flex flex-col gap-3 border-b border-ink-50 p-4 sm:flex-row sm:items-center">
                <p class="section-title flex-1">Daftar siswa (<span x-text="rows.length"></span>)</p>
                <input x-model="q" class="input input-sm sm:w-56" placeholder="Cari nama…">
                <select x-model="filter" class="select input-sm sm:w-40"><option value="">Semua</option><option value="none">Belum tercatat</option>@foreach($statuses as $k => $l)<option value="{{ $k }}">{{ $l }}</option>@endforeach</select>
            </div>
            <div class="max-h-[70vh] divide-y divide-ink-50 overflow-y-auto">
                <template x-for="r in filtered" :key="r.id">
                    <div class="flex flex-wrap items-center gap-3 px-4 py-3" :class="flashId === r.id ? 'bg-lagoon-50' : ''">
                        <img :src="r.avatar" class="h-10 w-10 rounded-xl object-cover" alt="">
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-sm font-bold" x-text="r.name"></p>
                            <p class="text-xs text-ink-400"><span x-text="r.class ? 'Kelas ' + r.class : ''"></span><span x-show="r.time" x-text="' · ' + r.time"></span><span x-show="r.late" class="font-bold text-saffron-600"> · terlambat</span><span x-show="r.method" x-text="' · ' + (r.method === 'scan' ? 'scan' : 'manual')"></span></p>
                        </div>
                        <template x-if="!isAdmin">
                            <span class="badge" :class="badge(r.status)" x-text="r.status ? statuses[r.status] : 'Belum'"></span>
                        </template>
                        <template x-if="isAdmin">
                            <div class="flex flex-wrap gap-1">
                                <template x-for="(label, key) in statuses" :key="key">
                                    <button @click="setStatus(r, key)" class="rounded-lg px-2.5 py-1 text-[11px] font-extrabold transition" :class="r.status === key ? badgeSolid(key) : 'bg-ink-50 text-ink-500 hover:bg-ink-100'" x-text="label"></button>
                                </template>
                                <button x-show="r.status" @click="setStatus(r, 'reset')" class="rounded-lg px-2 py-1 text-[11px] font-bold text-ink-400 hover:text-garnet-600" title="Hapus catatan">✕</button>
                            </div>
                        </template>
                    </div>
                </template>
                <div x-show="!filtered.length" class="p-10 text-center text-sm text-ink-400">Tidak ada siswa.</div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function attendancePage(cfg) {
    return {
        ...cfg, q: '', filter: '', code: '', camOn: false, cam: null, last: null, flashId: null, busy: false, lastCode: '', lastAt: 0,
        get filtered() {
            const q = this.q.toLowerCase();
            return this.rows.filter(r => (!q || r.name.toLowerCase().includes(q)) && (!this.filter || (this.filter === 'none' ? !r.status : r.status === this.filter)));
        },
        init() { setInterval(() => this.refresh(), 6000); this.$nextTick(() => this.$refs.code?.focus()); },
        badge(s) { return { hadir: 'badge-lagoon', izin: 'badge-sky', sakit: 'badge-gold', alpa: 'badge-garnet' }[s] || 'badge-ink'; },
        badgeSolid(s) { return { hadir: 'bg-lagoon-500 text-white', izin: 'bg-sky-500 text-white', sakit: 'bg-saffron-400 text-ink-900', alpa: 'bg-garnet-600 text-white' }[s]; },
        apply(a) { const r = this.rows.find(x => x.id === a.user_id); if (!r) return; Object.assign(r, { status: a.status, time: a.time ?? null, late: !!a.late, method: a.method ?? null, note: a.note ?? null }); this.flashId = r.id; setTimeout(() => this.flashId = null, 1500); },
        async post(url, body) {
            const res = await fetch(url, { method: 'POST', headers: { 'Content-Type': 'application/json', Accept: 'application/json', 'X-CSRF-TOKEN': window.csrf() }, body: JSON.stringify(body) });
            if (res.status === 419) { await window.refreshCsrf(); return this.post(url, body); }
            return [res.ok, await res.json().catch(() => ({ ok: false, message: 'Kesalahan server' }))];
        },
        async submitCode(code) {
            code = (code || '').trim(); if (!code || this.busy) return;
            if (code === this.lastCode && Date.now() - this.lastAt < 3000) return;
            this.lastCode = code; this.lastAt = Date.now(); this.busy = true;
            const [ok, d] = await this.post(this.scanUrl, { code });
            this.busy = false; this.last = d; clearTimeout(this._t); this._t = setTimeout(() => this.last = null, 3500);
            if (d.attendance) this.apply(d.attendance); if (d.counts) this.counts = d.counts;
            try { navigator.vibrate && navigator.vibrate(d.ok ? 80 : [60, 60, 60]); } catch (e) {}
        },
        async setStatus(r, status) {
            const [ok, d] = await this.post(this.manualUrl, { user_id: r.id, status });
            if (!ok) return window.toast('error', d.message || 'Gagal menyimpan');
            this.apply(d.attendance); this.counts = d.counts; window.toast('success', d.message);
        },
        async refresh() {
            if (document.hidden) return;
            try { const d = await (await fetch(this.feedUrl, { headers: { Accept: 'application/json' } })).json(); this.counts = d.counts; d.records.forEach(a => { const r = this.rows.find(x => x.id === a.user_id); if (r && (r.status !== a.status || r.time !== a.time)) Object.assign(r, { status: a.status, time: a.time, late: a.late, method: a.method }); }); } catch (e) {}
        },
        async startCam() {
            if (!window.Html5Qrcode) return window.toast('error', 'Library scanner gagal dimuat');
            this.cam = new Html5Qrcode('qr-reader');
            try { await this.cam.start({ facingMode: 'environment' }, { fps: 10, qrbox: { width: 240, height: 240 } }, (txt) => this.submitCode(txt)); this.camOn = true; }
            catch (e) { window.toast('error', 'Kamera tidak bisa diakses. Izinkan akses kamera di browser.'); }
        },
        async stopCam() { try { await this.cam?.stop(); } catch (e) {} this.camOn = false; },
    };
}
</script>
@endpush
</x-layouts.app>
