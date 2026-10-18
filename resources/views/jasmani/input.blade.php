@extends('layouts.app')

@section('title', 'Input Hasil · ' . $evaluation->title)

@php
    $rowsJson = $students->map(fn ($s) => [
        'id' => $s->id,
        'name' => $s->name,
        'full_name' => $s->studentRegistration?->full_name,
    ])->values();
@endphp

@section('content')
<div class="py-6 md:py-8" x-data="jasmaniInput()" >
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex flex-wrap items-center gap-2 text-sm mb-6">
            <a href="{{ route('jasmani.index') }}" class="text-secondary-500 hover:text-primary-600 dark:text-secondary-400 dark:hover:text-primary-300">Evaluasi Jasmani</a>
            <span class="text-secondary-300 dark:text-secondary-600">/</span>
            <a href="{{ route('jasmani.show', $evaluation) }}" class="text-secondary-500 hover:text-primary-600 dark:text-secondary-400 dark:hover:text-primary-300">{{ $evaluation->period_label }}</a>
            <span class="text-secondary-300 dark:text-secondary-600">/</span>
            <span class="text-primary-600 dark:text-primary-300 font-medium">Input Hasil</span>
        </nav>

        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-3 mb-5">
            <div>
                <h1 class="text-2xl font-bold text-primary-900 dark:text-white">Input Hasil · {{ $evaluation->period_label }}</h1>
                <p class="text-sm text-secondary-500 dark:text-secondary-400 mt-1">
                    Kosongkan baris siswa yang tidak ikut tes. Tekan <kbd class="px-1.5 py-0.5 rounded bg-primary-100 dark:bg-primary-800 text-xs">Enter</kbd> untuk pindah ke baris bawah.
                </p>
            </div>
            <button type="button" @click="showPaste = !showPaste"
                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-900/30 text-sm font-medium text-primary-700 dark:text-primary-200 hover:bg-primary-50 dark:hover:bg-primary-800/30">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                Tempel dari Excel
            </button>
        </div>

        {{-- Tempel dari Excel --}}
        <div x-show="showPaste" x-cloak x-transition class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 shadow-sm p-5 mb-6">
            <p class="text-sm text-primary-800 dark:text-primary-100 font-medium">Salin baris dari Excel/Google Sheets lalu tempel di bawah.</p>
            <p class="text-xs text-secondary-500 dark:text-secondary-400 mt-1">
                Format kolom: <code>NO · NAMA · LARI 12 menit · PULL UP/CHINNING · PUSH UP · SIT UP · SHUTTLE RUN</code> (kolom NO boleh tidak ada, baris judul diabaikan).
                Nama dicocokkan otomatis dengan data siswa.
            </p>
            <textarea x-model="pasteText" rows="6" placeholder="1	Muh. Irfan Setiawan	2407	0	15	38	19.5"
                      class="mt-3 w-full font-mono text-xs rounded-xl border-primary-200 dark:border-primary-700/50 bg-primary-50/40 dark:bg-primary-800/30 text-primary-800 dark:text-primary-100"></textarea>
            <div class="mt-3 flex flex-wrap items-center gap-3">
                <button type="button" @click="applyPaste()" class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium">Isi ke tabel</button>
                <p class="text-xs" x-show="pasteResult" :class="pasteUnmatched.length ? 'text-amber-700 dark:text-amber-300' : 'text-emerald-700 dark:text-emerald-300'" x-text="pasteResult"></p>
            </div>
            <ul x-show="pasteUnmatched.length" class="mt-2 text-xs text-amber-700 dark:text-amber-300 list-disc pl-5">
                <template x-for="n in pasteUnmatched"><li x-text="n"></li></template>
            </ul>
        </div>

        @if($errors->any())
            <div class="mb-5 p-3 rounded-xl bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800/40 text-sm text-red-700 dark:text-red-300">
                Periksa kembali isian: {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('jasmani.input.save', $evaluation) }}" id="jasmaniForm">
            @csrf
            @method('PUT')

            <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 shadow-sm overflow-hidden">
                <div class="px-4 py-3 border-b border-primary-100 dark:border-primary-800/30 flex flex-wrap items-center justify-between gap-3">
                    <input x-model="search" type="text" placeholder="Cari nama..." class="w-full sm:w-64 rounded-xl border-primary-200 dark:border-primary-700/50 bg-primary-50/50 dark:bg-primary-800/20 text-sm text-primary-800 dark:text-primary-100">
                    <p class="text-xs text-secondary-500 dark:text-secondary-400">{{ $students->count() }} siswa · terisi <span class="font-semibold" x-text="filledCount"></span></p>
                </div>
                <div class="overflow-x-auto max-h-[70vh]">
                    <table class="w-full text-sm">
                        <thead class="sticky top-0 z-10 bg-primary-50 dark:bg-primary-900 text-xs uppercase tracking-wide text-secondary-600 dark:text-secondary-300">
                            <tr>
                                <th class="px-3 py-3 text-left w-10">No</th>
                                <th class="px-3 py-3 text-left min-w-[200px]">Nama</th>
                                <th class="px-2 py-3 text-center">L/P</th>
                                <th class="px-2 py-3 text-center">Lari 12'<br><span class="normal-case font-normal">(meter)</span></th>
                                <th class="px-2 py-3 text-center">Pull Up /<br>Chinning</th>
                                <th class="px-2 py-3 text-center">Push Up</th>
                                <th class="px-2 py-3 text-center">Sit Up</th>
                                <th class="px-2 py-3 text-center">Shuttle Run<br><span class="normal-case font-normal">(detik)</span></th>
                                <th class="px-2 py-3 text-left min-w-[160px]">Catatan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-primary-100 dark:divide-primary-800/30">
                            @foreach($students as $i => $s)
                                @php
                                    $r = $existing->get($s->id);
                                    $g = $s->studentRegistration?->gender;
                                    $inputCls = 'w-20 rounded-lg border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-sm text-right tabular-nums text-primary-800 dark:text-primary-100 py-1.5 focus:ring-primary-500 focus:border-primary-500';
                                @endphp
                                <tr data-student="{{ $s->id }}" x-show="visible({{ $s->id }})" class="hover:bg-primary-50/40 dark:hover:bg-primary-800/10">
                                    <td class="px-3 py-2 text-secondary-500 tabular-nums">{{ $i + 1 }}</td>
                                    <td class="px-3 py-2">
                                        <p class="font-medium text-primary-800 dark:text-primary-100">{{ $s->name }}</p>
                                        @unless($s->is_active)<p class="text-[11px] text-red-500">nonaktif</p>@endunless
                                    </td>
                                    <td class="px-2 py-2 text-center">
                                        @if($g)
                                            <span class="text-xs font-semibold px-2 py-0.5 rounded-full {{ $g === 'L' ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300' : 'bg-orange-50 text-orange-700 dark:bg-orange-900/30 dark:text-orange-300' }}">{{ $g }}</span>
                                        @else
                                            <span class="text-xs text-secondary-400" title="Jenis kelamin belum diisi di data pendaftaran">?</span>
                                        @endif
                                    </td>
                                    @foreach(array_keys($items) as $col => $key)
                                        <td class="px-2 py-2 text-center">
                                            <input type="text" inputmode="decimal" name="results[{{ $s->id }}][{{ $key }}]"
                                                   value="{{ old("results.{$s->id}.{$key}", $r?->{$key} !== null ? ($key === 'shuttle_run_sec' ? rtrim(rtrim(number_format($r->{$key}, 2, '.', ''), '0'), '.') : $r->{$key}) : '') }}"
                                                   data-col="{{ $col }}" @keydown.enter.prevent="moveDown($event)" @input="countFilled()"
                                                   placeholder="{{ $key === 'pull_up_chinning' ? ($g === 'P' ? 'chin' : 'pull') : '' }}"
                                                   class="{{ $inputCls }}">
                                        </td>
                                    @endforeach
                                    <td class="px-2 py-2">
                                        <input type="text" name="results[{{ $s->id }}][notes]" maxlength="255" value="{{ old("results.{$s->id}.notes", $r?->notes) }}"
                                               placeholder="opsional" class="w-full rounded-lg border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-sm text-primary-800 dark:text-primary-100 py-1.5">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="sticky bottom-0 px-4 py-3 border-t border-primary-100 dark:border-primary-800/30 bg-white/95 dark:bg-primary-950/95 backdrop-blur flex flex-col-reverse sm:flex-row sm:justify-between gap-3">
                    <a href="{{ route('jasmani.show', $evaluation) }}" class="px-5 py-2.5 rounded-xl border border-primary-200 dark:border-primary-700/50 text-sm text-center text-secondary-600 dark:text-secondary-300">Batal</a>
                    <button class="px-6 py-2.5 rounded-xl bg-primary-600 hover:bg-primary-700 text-white text-sm font-semibold shadow-sm">Simpan Semua Hasil</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function jasmaniInput() {
    const students = @json($rowsJson);
    const norm = (s) => (s || '').toLowerCase().replace(/[^a-z0-9 ]/g, ' ').replace(/\s+/g, ' ').trim();
    const keys = @json(array_keys($items));

    return {
        search: '', showPaste: false, pasteText: '', pasteResult: '', pasteUnmatched: [], filledCount: 0,
        init() { this.countFilled(); },
        visible(id) {
            if (!this.search) return true;
            const s = students.find(x => x.id === id);
            return norm(s.name).includes(norm(this.search));
        },
        countFilled() {
            this.$nextTick(() => {
                let n = 0;
                document.querySelectorAll('#jasmaniForm tr[data-student]').forEach(tr => {
                    if ([...tr.querySelectorAll('input[data-col]')].some(i => i.value.trim() !== '')) n++;
                });
                this.filledCount = n;
            });
        },
        moveDown(e) {
            const col = e.target.dataset.col;
            let tr = e.target.closest('tr').nextElementSibling;
            while (tr && tr.style.display === 'none') tr = tr.nextElementSibling;
            tr?.querySelector(`input[data-col="${col}"]`)?.focus();
        },
        match(name) {
            const n = norm(name);
            if (!n) return null;
            let hit = students.find(s => norm(s.name) === n || norm(s.full_name) === n);
            if (hit) return hit;
            const cands = students.filter(s => norm(s.name).includes(n) || n.includes(norm(s.name)) || (s.full_name && (norm(s.full_name).includes(n) || n.includes(norm(s.full_name)))));
            return cands.length === 1 ? cands[0] : null;
        },
        applyPaste() {
            let ok = 0; this.pasteUnmatched = [];
            this.pasteText.split(/\r?\n/).forEach(line => {
                if (!line.trim()) return;
                let cells = line.split(/\t|;/).map(c => c.trim());
                if (cells.length < 3) cells = line.trim().split(/\s{2,}/);
                if (/^\d+\.?$/.test(cells[0])) cells.shift();      // kolom NO
                const name = cells.shift();
                if (!name || /^nama$/i.test(name)) return;        // baris judul
                const s = this.match(name);
                if (!s) { this.pasteUnmatched.push(name); return; }
                const tr = document.querySelector(`#jasmaniForm tr[data-student="${s.id}"]`);
                keys.forEach((k, i) => {
                    const v = (cells[i] ?? '').replace(',', '.');
                    const input = tr.querySelector(`input[name="results[${s.id}][${k}]"]`);
                    if (input && v !== '' && !isNaN(Number(v))) input.value = v;
                });
                tr.classList.add('bg-emerald-50', 'dark:bg-emerald-900/20');
                ok++;
            });
            this.pasteResult = `${ok} baris terisi` + (this.pasteUnmatched.length ? `, ${this.pasteUnmatched.length} nama tidak ditemukan:` : '. Periksa lalu klik Simpan.');
            this.countFilled();
        },
    };
}
</script>
@endpush
