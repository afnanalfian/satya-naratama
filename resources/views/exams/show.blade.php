<x-layouts.app :title="$exam->context_title">
@php
    $u = auth()->user(); $isStaff = $u->hasAnyRole(['admin', 'tentor']);
    $typeName = ['tryout' => 'Tryout', 'quiz' => 'Kuis', 'post_test' => 'Post-Test', 'blind_test' => 'Blind Test'][$exam->type] ?? 'Ujian';
    $submitted = $exam->attempts->where('is_submitted', true);
    $testLabels = ['skd' => 'SKD (TWK · TIU · TKP)', 'mtk_stis' => 'Matematika STIS', 'mtk_tka' => 'Matematika TKA', 'tpa' => 'TPA', 'tbi' => 'Bahasa Inggris', 'general' => 'Umum'];
@endphp
<div class="grid gap-6 lg:grid-cols-3">
    <div class="space-y-6 lg:col-span-2">
        <div class="card-ink p-6 sm:p-8">
            <div class="absolute inset-0 bg-grid-ink [background-size:30px_30px]"></div>
            <div class="blob -right-10 -top-10 h-56 w-56 bg-garnet-600/50"></div>
            <div class="relative">
                <a href="{{ $exam->backRoute() }}" class="inline-flex items-center gap-1 text-xs font-bold text-ink-300 hover:text-white"><x-icon name="arrow-left" class="h-4 w-4"/> Kembali</a>
                <div class="mt-3 flex flex-wrap gap-2"><span class="badge bg-saffron-400 text-ink-900">{{ $typeName }}</span><span class="badge bg-white/10 text-white">{{ $testLabels[$exam->test_type] ?? strtoupper($exam->test_type) }}</span><x-status-badge :status="$exam->status"/></div>
                <h1 class="mt-3 font-display text-3xl font-extrabold">{{ $exam->context_title }}</h1>
                <div class="mt-6 grid grid-cols-3 gap-3 text-center">
                    <div class="rounded-2xl bg-white/10 p-3"><p class="font-display text-2xl font-extrabold">{{ $exam->questions->count() }}</p><p class="text-[11px] font-bold uppercase text-ink-300">Soal</p></div>
                    <div class="rounded-2xl bg-white/10 p-3"><p class="font-display text-2xl font-extrabold">{{ $exam->duration_minutes ?? '–' }}</p><p class="text-[11px] font-bold uppercase text-ink-300">Menit</p></div>
                    <div class="rounded-2xl bg-white/10 p-3"><p class="font-display text-2xl font-extrabold">{{ $submitted->count() }}</p><p class="text-[11px] font-bold uppercase text-ink-300">Peserta</p></div>
                </div>
                @if($exam->exam_date)<p class="mt-4 flex items-center gap-2 text-sm text-ink-200"><x-icon name="calendar" class="h-4 w-4 text-saffron-400"/>{{ $exam->exam_date->translatedFormat('l, d F Y · H:i') }}</p>@endif
            </div>
        </div>

        {{-- Area siswa --}}
        @role('siswa')
            <div class="card card-pad">
                @if($attempt && $attempt->is_submitted)
                    <div class="flex flex-col items-center gap-4 text-center sm:flex-row sm:text-left">
                        <div class="grid h-24 w-24 shrink-0 place-items-center rounded-[2rem] bg-sunrise text-white shadow-glow"><div><p class="font-display text-3xl font-extrabold leading-none">{{ rtrim(rtrim(number_format($attempt->score, 2, ',', '.'), '0'), ',') }}</p><p class="text-[10px] font-bold uppercase">nilai</p></div></div>
                        <div class="flex-1">
                            <p class="font-display text-xl font-bold">Kamu sudah menyelesaikan ujian ini 🎉</p>
                            <p class="text-sm text-ink-500">{{ $attempt->correct_count }} benar · {{ $attempt->wrong_count }} salah · dikumpulkan {{ $attempt->submitted_at?->translatedFormat('d M Y H:i') }}</p>
                            @if($attempt->is_passed !== null)<span class="mt-2 inline-flex {{ $attempt->is_passed ? 'badge-lagoon' : 'badge-garnet' }}">{{ $attempt->is_passed ? 'Lulus passing grade' : 'Belum lulus passing grade' }}</span>@endif
                        </div>
                        <div class="flex flex-col gap-2"><a href="{{ route('exams.result.student', $exam) }}" class="btn-primary">Hasil & pembahasan</a><a href="{{ route('exams.ranking.student', $exam) }}" class="btn-soft"><x-icon name="medal" class="h-4 w-4"/> Peringkat</a></div>
                    </div>
                @elseif($exam->status !== 'active')
                    <x-empty icon="lock" :title="$exam->status === 'inactive' ? 'Ujian belum dibuka' : 'Ujian telah ditutup'" text="Pantau notifikasi untuk informasi selanjutnya." class="!border-0 !py-6"/>
                @elseif($blockedByPrerequisite)
                    <p class="section-title">Selesaikan tryout ini dulu</p>
                    <p class="text-sm text-ink-500">Tryout ini terkunci sampai kamu menyelesaikan:</p>
                    <div class="mt-4 space-y-2">@foreach($unmetPrerequisites as $req)<a href="{{ route('exams.show', $req) }}" class="flex items-center justify-between rounded-2xl bg-cream p-3 hover:bg-saffron-50"><span class="font-bold">{{ $req->title }}</span><span class="badge-garnet">Belum selesai</span></a>@endforeach</div>
                @elseif($attempt)
                    <div class="flex flex-col items-center gap-4 sm:flex-row">
                        <span class="grid h-16 w-16 place-items-center rounded-3xl bg-saffron-100 text-saffron-700"><x-icon name="clock" class="h-8 w-8"/></span>
                        <div class="flex-1 text-center sm:text-left"><p class="font-display text-xl font-bold">Ujian sedang berjalan</p><p class="text-sm text-ink-500">Sisa waktu: <b>{{ gmdate($attempt->remainingSeconds() >= 3600 ? 'H:i:s' : 'i:s', $attempt->remainingSeconds()) }}</b>. Waktu tetap berjalan walau halaman ditutup.</p></div>
                        <a href="{{ route('exams.attempt', $exam) }}" class="btn-gold btn-lg"><x-icon name="play" class="h-5 w-5"/> Lanjutkan</a>
                    </div>
                @else
                    <p class="section-title">Siap mengerjakan?</p>
                    <ul class="mt-3 space-y-2 text-sm text-ink-600">
                        <li class="flex gap-2"><x-icon name="clock" class="h-5 w-5 shrink-0 text-garnet-600"/> Durasi {{ $exam->duration_minutes }} menit untuk {{ $exam->questions->count() }} soal. Waktu dihitung server sejak tombol Mulai ditekan.</li>
                        <li class="flex gap-2"><x-icon name="check-circle" class="h-5 w-5 shrink-0 text-lagoon-600"/> Jawaban tersimpan otomatis. Jika koneksi putus, buka lagi halaman ini untuk melanjutkan.</li>
                        <li class="flex gap-2"><x-icon name="alert" class="h-5 w-5 shrink-0 text-saffron-600"/> Ujian hanya bisa dikerjakan satu kali dan otomatis dikumpulkan saat waktu habis.</li>
                    </ul>
                    <form method="POST" action="{{ route('exams.start', $exam) }}" data-confirm="Mulai sekarang? Waktu tidak bisa dihentikan dan ujian tidak bisa diulang." data-danger="0" data-ok="Mulai ujian" class="mt-6">@csrf
                        <button class="btn-primary btn-lg w-full sm:w-auto"><x-icon name="play" class="h-5 w-5"/> Mulai ujian</button>
                    </form>
                @endif
            </div>
        @endrole

        {{-- Area staf --}}
        @if($isStaff)
            <div class="card card-pad">
                <p class="section-title">Kelola</p>
                <div class="mt-4 flex flex-wrap gap-2">
                    @if($exam->status === 'inactive')
                        <a href="{{ route('exams.edit', $exam) }}" class="btn-ink"><x-icon name="pencil" class="h-4 w-4"/> Susun soal</a>
                        <form method="POST" action="{{ route('exams.activate', $exam) }}" data-confirm="Aktifkan ujian? Siswa langsung bisa mengerjakan & menerima notifikasi." data-danger="0" data-ok="Aktifkan">@csrf<button class="btn-lagoon" @disabled(! $exam->duration_minutes || ! $exam->questions->count())><x-icon name="play" class="h-4 w-4"/> Aktifkan</button></form>
                    @elseif($exam->status === 'active')
                        <a href="{{ route('exams.edit', $exam) }}" class="btn-soft"><x-icon name="plus" class="h-4 w-4"/> Tambah soal</a>
                        <form method="POST" action="{{ route('exams.close', $exam) }}" data-confirm="Tutup ujian? Siswa tidak bisa memulai lagi." data-ok="Tutup">@csrf<button class="btn-danger"><x-icon name="lock" class="h-4 w-4"/> Tutup ujian</button></form>
                    @endif
                    <a href="{{ route('exams.results', $exam) }}" class="btn-soft"><x-icon name="chart" class="h-4 w-4"/> Hasil & analisis</a>
                    @if($exam->status !== 'active' && ! $exam->attempts->count())
                        <form method="POST" action="{{ route('exams.destroy', $exam) }}" data-confirm="Hapus ujian ini?">@csrf @method('DELETE')<button class="btn-ghost hover:text-garnet-600"><x-icon name="trash" class="h-4 w-4"/> Hapus</button></form>
                    @endif
                </div>
                @if(! $exam->duration_minutes)<p class="mt-3 text-xs font-semibold text-saffron-700">⚠ Durasi belum diisi — atur di halaman susun soal.</p>@endif
            </div>
            @if($exam->type === 'tryout')
                <form method="POST" action="{{ route('exams.prerequisites.update', $exam) }}" class="card card-pad" x-data="{ q: '' }">@csrf
                    <p class="section-title">Prasyarat tryout</p>
                    <p class="text-sm text-ink-500">Siswa wajib menyelesaikan tryout berikut sebelum bisa memulai tryout ini.</p>
                    <input x-model="q" class="input input-sm mt-3" placeholder="Cari tryout…">
                    <div class="mt-3 grid max-h-64 gap-2 overflow-y-auto sm:grid-cols-2">
                        @foreach($allTryouts as $t)
                            <label x-show="!q || @js(mb_strtolower($t->title)).includes(q.toLowerCase())" class="flex cursor-pointer items-center gap-2 rounded-xl border border-ink-100 px-3 py-2 text-sm hover:bg-cream"><input type="checkbox" name="required_exam_ids[]" value="{{ $t->id }}" class="checkbox" @checked($exam->prerequisites->contains('id', $t->id))> <span class="truncate">{{ $t->title }}</span></label>
                        @endforeach
                    </div>
                    <button class="btn-ink btn-sm mt-4">Simpan prasyarat</button>
                </form>
            @endif
        @endif
    </div>

    <div class="space-y-6">
        @if($exam->type === 'tryout' && $exam->passing_rules)
            <div class="card card-pad">
                <p class="section-title">Passing grade</p>
                <div class="mt-3 space-y-2">@foreach($exam->passing_rules as $k => $v)<div class="flex items-center justify-between rounded-xl bg-cream px-3 py-2 text-sm"><span class="font-bold uppercase">{{ $k === 'score' ? 'Nilai minimal' : $k }}</span><span class="font-display text-lg font-extrabold">{{ $v }}</span></div>@endforeach</div>
            </div>
        @endif
        @if($exam->prerequisites->isNotEmpty())
            <div class="card card-pad"><p class="section-title">Prasyarat</p><div class="mt-3 space-y-1.5">@foreach($exam->prerequisites as $p)<a href="{{ route('exams.show', $p) }}" class="block truncate rounded-xl bg-cream px-3 py-2 text-sm font-semibold hover:bg-saffron-50">{{ $p->title }}</a>@endforeach</div></div>
        @endif
        @if($submitted->count())
            <div class="card card-pad">
                <p class="section-title">Statistik</p>
                <dl class="mt-3 grid grid-cols-3 gap-2 text-center">
                    <div class="rounded-xl bg-cream p-2"><dt class="text-[10px] font-bold uppercase text-ink-400">Rata-rata</dt><dd class="font-display text-lg font-extrabold">{{ round($submitted->avg('score'), 1) }}</dd></div>
                    <div class="rounded-xl bg-lagoon-50 p-2"><dt class="text-[10px] font-bold uppercase text-ink-400">Tertinggi</dt><dd class="font-display text-lg font-extrabold text-lagoon-700">{{ round($submitted->max('score'), 1) }}</dd></div>
                    <div class="rounded-xl bg-garnet-50 p-2"><dt class="text-[10px] font-bold uppercase text-ink-400">Terendah</dt><dd class="font-display text-lg font-extrabold text-garnet-700">{{ round($submitted->min('score'), 1) }}</dd></div>
                </dl>
                @role('siswa')<a href="{{ route('exams.ranking.student', $exam) }}" class="btn-soft btn-sm mt-4 w-full"><x-icon name="medal" class="h-4 w-4"/> Lihat peringkat</a>@endrole
            </div>
        @endif
    </div>
</div>
</x-layouts.app>
