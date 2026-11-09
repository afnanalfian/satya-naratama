<x-layouts.app :title="$meeting->title">
@php
    $u = auth()->user();
    $isStaff = $u->hasAnyRole(['admin', 'tentor']);
    $isAdmin = $u->hasRole('admin');
    $jasmani = $meeting->isJasmani();
    $testTypes = ['general' => 'Umum', 'skd' => 'SKD (TWK/TIU/TKP)', 'mtk_stis' => 'Matematika STIS', 'mtk_tka' => 'Matematika TKA', 'tpa' => 'TPA', 'tbi' => 'Bahasa Inggris (TBI)'];
    $c = $attendanceCounts;
@endphp

{{-- Header --}}
<div class="card-ink mb-6 p-6 sm:p-8">
    <div class="absolute inset-0 bg-grid-ink [background-size:30px_30px]"></div>
    <div class="blob -right-10 -top-10 h-56 w-56 {{ $meeting->status === 'live' ? 'bg-garnet-500/60' : 'bg-saffron-500/30' }}"></div>
    <div class="relative">
        <a href="{{ route('course.show', $meeting->course->slug) }}" class="inline-flex items-center gap-1 text-xs font-bold text-ink-300 hover:text-white"><x-icon name="arrow-left" class="h-4 w-4"/> {{ $meeting->course->name }}</a>
        <div class="mt-3 flex flex-wrap items-center gap-2">
            <x-status-badge :status="$meeting->status"/>
            <x-course-type-badge :type="$meeting->course->type" class="!bg-white"/>
            @if($meeting->is_free)<span class="badge bg-lagoon-500 text-white">Gratis</span>@endif
        </div>
        <h1 class="mt-3 font-display text-3xl font-extrabold sm:text-4xl">{{ $meeting->title }}</h1>
        <p class="mt-2 flex flex-wrap items-center gap-4 text-sm text-ink-200">
            <span class="flex items-center gap-1.5"><x-icon name="calendar" class="h-4 w-4 text-saffron-400"/>{{ $meeting->scheduled_at?->translatedFormat('l, d F Y') }}</span>
            <span class="flex items-center gap-1.5"><x-icon name="clock" class="h-4 w-4 text-saffron-400"/>{{ $meeting->scheduled_at?->format('H:i') }}</span>
            @if($meeting->creator)<span class="flex items-center gap-1.5"><x-icon name="user" class="h-4 w-4 text-saffron-400"/>{{ $meeting->creator->name }}</span>@endif
        </p>
        <div class="mt-6 flex flex-wrap gap-2">
            @if($meeting->zoom_link && $meeting->status === 'live')
                <a href="{{ route('meeting.joinZoom', $meeting) }}" target="_blank" class="btn-primary"><x-icon name="zoom" class="h-4 w-4"/> Gabung Zoom</a>
            @elseif($meeting->zoom_link && $isStaff)
                <a href="{{ route('meeting.joinZoom', $meeting) }}" target="_blank" class="btn bg-white/10 text-white hover:bg-white/20"><x-icon name="zoom" class="h-4 w-4"/> Buka Zoom</a>
            @endif
            @if($isStaff)
                @if($meeting->status === 'upcoming')
                    <form method="POST" action="{{ route('meeting.start', $meeting) }}" data-confirm="Mulai pertemuan sekarang? Status akan menjadi LIVE." data-danger="0" data-ok="Mulai">@csrf<button class="btn-gold"><x-icon name="play" class="h-4 w-4"/> Mulai pertemuan</button></form>
                @elseif($meeting->status === 'live')
                    <form method="POST" action="{{ route('meeting.finish', $meeting) }}" data-confirm="Selesaikan pertemuan ini?" data-ok="Selesaikan">@csrf<button class="btn-lagoon"><x-icon name="check-circle" class="h-4 w-4"/> Selesaikan</button></form>
                @endif
                <a href="{{ route('meeting.attendance.index', $meeting) }}" class="btn bg-white text-ink-900 hover:bg-cream"><x-icon name="scan" class="h-4 w-4"/> Presensi</a>
                <a href="{{ route('meeting.edit', $meeting) }}" class="btn bg-white/10 text-white hover:bg-white/20"><x-icon name="pencil" class="h-4 w-4"/> Ubah</a>
            @endif
        </div>
    </div>
</div>

<div class="grid gap-6 lg:grid-cols-3">
    <div class="space-y-6 lg:col-span-2">
        @unless($jasmani)
            {{-- Video --}}
            <div class="card card-pad">
                <div class="flex items-center justify-between gap-2">
                    <p class="section-title flex items-center gap-2"><x-icon name="video" class="h-5 w-5 text-garnet-600"/> Video pembelajaran</p>
                    @if($isStaff)
                        @if($meeting->video)<a href="{{ route('meetings.video.edit', $meeting) }}" class="btn-soft btn-sm"><x-icon name="pencil" class="h-4 w-4"/> Ubah</a>
                        @else<a href="{{ route('meetings.video.create', $meeting) }}" class="btn-ink btn-sm"><x-icon name="plus" class="h-4 w-4"/> Tambah video</a>@endif
                    @endif
                </div>
                @if($meeting->video && $meeting->video->is_ready)
                    <a href="{{ route('meetings.video.playback', $meeting) }}" class="group relative mt-4 block aspect-video overflow-hidden rounded-2xl bg-ink-900">
                        @if($meeting->video->thumbnail)<img src="{{ $meeting->video->thumbnail }}" class="h-full w-full object-cover opacity-80 transition group-hover:scale-105" alt="">@endif
                        <span class="absolute inset-0 grid place-items-center"><span class="grid h-16 w-16 place-items-center rounded-full bg-garnet-600 text-white shadow-glow transition group-hover:scale-110"><x-icon name="play" class="ml-1 h-7 w-7"/></span></span>
                        <span class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-ink-950/90 p-4 font-bold text-white">{{ $meeting->video->title }}</span>
                    </a>
                @else
                    <p class="mt-4 rounded-2xl bg-cream p-5 text-center text-sm text-ink-400">Video belum tersedia.</p>
                @endif
            </div>

            {{-- Materi --}}
            <div class="card card-pad">
                <p class="section-title flex items-center gap-2"><x-icon name="doc" class="h-5 w-5 text-saffron-600"/> Materi PDF</p>
                @if($meeting->material)
                    <div class="mt-4 flex flex-wrap items-center gap-3 rounded-2xl bg-cream p-4">
                        <span class="grid h-12 w-12 place-items-center rounded-xl bg-garnet-600 text-xs font-extrabold text-white">PDF</span>
                        <div class="min-w-0 flex-1"><p class="truncate font-bold">{{ $meeting->material->original_name }}</p><p class="text-xs text-ink-400">Diunggah {{ $meeting->material->created_at?->diffForHumans() }}</p></div>
                        <a href="{{ asset('storage/'.$meeting->material->file_path) }}" target="_blank" class="btn-ink btn-sm"><x-icon name="eye" class="h-4 w-4"/> Buka</a>
                        @if($isStaff)
                            <form method="POST" action="{{ route('meeting.material.destroy', $meeting) }}" data-confirm="Hapus materi ini?">@csrf @method('DELETE')<button class="btn-danger btn-sm"><x-icon name="trash" class="h-4 w-4"/></button></form>
                        @endif
                    </div>
                @elseif(! $isStaff)
                    <p class="mt-4 rounded-2xl bg-cream p-5 text-center text-sm text-ink-400">Materi belum diunggah.</p>
                @endif
                @if($isStaff)
                    <form method="POST" action="{{ route('meeting.material.store', $meeting) }}" enctype="multipart/form-data" class="mt-4 flex flex-col gap-2 sm:flex-row sm:items-center" x-data="{ f: '' }">@csrf
                        <label class="flex flex-1 cursor-pointer items-center gap-3 rounded-2xl border-2 border-dashed border-ink-200 px-4 py-3 text-sm hover:border-garnet-400">
                            <x-icon name="upload" class="h-5 w-5 text-ink-400"/><span class="truncate" x-text="f || '{{ $meeting->material ? 'Ganti materi (PDF, maks 10 MB)' : 'Pilih file PDF (maks 10 MB)' }}'"></span>
                            <input type="file" name="material" accept="application/pdf" class="hidden" required @change="f = $event.target.files[0]?.name">
                        </label>
                        <button class="btn-primary" :disabled="!f">Unggah</button>
                    </form>
                @endif
            </div>

            {{-- Blind test & post test --}}
            <div class="card card-pad">
                <p class="section-title flex items-center gap-2"><x-icon name="clipboard" class="h-5 w-5 text-lagoon-600"/> Blind test & post-test</p>
                <div class="mt-4 grid gap-3 sm:grid-cols-2">
                    @foreach(['blind_test' => [$blindTest, $blindAttempt, 'Blind Test', 'Tes awal sebelum materi'], 'post_test' => [$postTest, $postAttempt, 'Post-Test', 'Evaluasi setelah materi']] as $type => [$exam, $attempt, $label, $desc])
                        <div class="rounded-2xl border border-ink-100 p-4">
                            <div class="flex items-center justify-between"><p class="font-bold">{{ $label }}</p>@if($exam)<x-status-badge :status="$exam->status"/>@endif</div>
                            <p class="text-xs text-ink-400">{{ $desc }}</p>
                            @if($exam)
                                <p class="mt-2 text-xs font-semibold text-ink-500">{{ $exam->questions->count() }} soal · {{ $exam->duration_minutes ?? '–' }} menit</p>
                                <div class="mt-3 flex flex-wrap gap-2">
                                    @if($isStaff)
                                        <a href="{{ route('exams.edit', $exam) }}" class="btn-ink btn-sm"><x-icon name="pencil" class="h-4 w-4"/> Kelola soal</a>
                                        <a href="{{ route('exams.results', $exam) }}" class="btn-soft btn-sm">Hasil ({{ $exam->attempts->where('is_submitted', true)->count() }})</a>
                                    @elseif($attempt && $attempt->is_submitted)
                                        <a href="{{ route('exams.result.student', $exam) }}" class="btn-lagoon btn-sm">Lihat nilai: {{ rtrim(rtrim(number_format($attempt->score, 2, ',', '.'), '0'), ',') }}</a>
                                    @elseif($exam->status === 'active')
                                        <a href="{{ route('exams.show', $exam) }}" class="btn-primary btn-sm">{{ $attempt ? 'Lanjutkan' : 'Kerjakan' }} <x-icon name="arrow-right" class="h-4 w-4"/></a>
                                    @else
                                        <span class="text-xs font-bold text-ink-400">Belum dibuka</span>
                                    @endif
                                </div>
                            @elseif($isStaff)
                                <form method="POST" action="{{ route('meetings.exam.store', $meeting) }}" class="mt-3 flex gap-2">@csrf
                                    <input type="hidden" name="type" value="{{ $type }}">
                                    <select name="test_type" class="select input-sm">@foreach($testTypes as $k => $l)<option value="{{ $k }}">{{ $l }}</option>@endforeach</select>
                                    <button class="btn-ink btn-sm shrink-0"><x-icon name="plus" class="h-4 w-4"/> Buat</button>
                                </form>
                            @else
                                <p class="mt-3 text-xs text-ink-400">Belum tersedia.</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="card-sunrise p-6">
                <x-icon name="run" class="h-8 w-8"/>
                <p class="mt-3 font-display text-xl font-bold">Sesi latihan jasmani</p>
                <p class="mt-1 text-sm text-white/85">Datang tepat waktu dengan pakaian olahraga. Presensi dilakukan dengan memindai QR kartu siswa.</p>
                @role('siswa')<a href="{{ route('attendance.my-qr') }}" class="btn mt-4 bg-white text-garnet-700 hover:bg-cream"><x-icon name="qr" class="h-4 w-4"/> Tampilkan QR saya</a>@endrole
            </div>
        @endunless
    </div>

    {{-- Sidebar presensi --}}
    <div class="space-y-6">
        @if($isStaff)
            <div class="card card-pad">
                <div class="flex items-center justify-between"><p class="section-title">Presensi</p><span class="font-display text-2xl font-extrabold text-lagoon-600">{{ $c['pct'] }}%</span></div>
                <div class="mt-3 h-3 overflow-hidden rounded-full bg-ink-50">
                    @php $t = max(1, $c['total']); @endphp
                    <div class="flex h-full"><div class="bg-lagoon-500" style="width: {{ $c['hadir'] / $t * 100 }}%"></div><div class="bg-sky-400" style="width: {{ $c['izin'] / $t * 100 }}%"></div><div class="bg-saffron-400" style="width: {{ $c['sakit'] / $t * 100 }}%"></div><div class="bg-garnet-500" style="width: {{ $c['alpa'] / $t * 100 }}%"></div></div>
                </div>
                <dl class="mt-4 grid grid-cols-2 gap-2 text-sm">
                    @foreach(['hadir' => 'Hadir', 'izin' => 'Izin', 'sakit' => 'Sakit', 'alpa' => 'Alpa', 'unrecorded' => 'Belum tercatat', 'total' => 'Total siswa'] as $k => $l)
                        <div class="rounded-xl bg-cream px-3 py-2"><dt class="text-[11px] font-bold text-ink-400">{{ $l }}</dt><dd class="font-display text-lg font-extrabold">{{ $c[$k] }}</dd></div>
                    @endforeach
                </dl>
                <a href="{{ route('meeting.attendance.index', $meeting) }}" class="btn-ink mt-4 w-full"><x-icon name="scan" class="h-4 w-4"/> Buka scanner & daftar hadir</a>
            </div>
            @if($meeting->attendances->count())
                <div class="card card-pad">
                    <p class="section-title">Tercatat ({{ $meeting->attendances->count() }})</p>
                    <div class="mt-3 max-h-80 space-y-2 overflow-y-auto">
                        @foreach($meeting->attendances->sortByDesc('marked_at') as $a)
                            <div class="flex items-center gap-2 text-sm"><img src="{{ $a->user?->avatar_url }}" class="h-7 w-7 rounded-lg object-cover" alt=""><span class="flex-1 truncate font-semibold">{{ $a->user?->name }}</span><x-status-badge :status="$a->status"/></div>
                        @endforeach
                    </div>
                </div>
            @endif
        @else
            <div class="card card-pad text-center">
                <p class="section-title">Kehadiranmu</p>
                @if($myAttendance)
                    <div class="mx-auto mt-4 grid h-20 w-20 place-items-center rounded-3xl {{ $myAttendance->status === 'hadir' ? 'bg-lagoon-500' : 'bg-saffron-400' }} text-white"><x-icon name="{{ $myAttendance->status === 'hadir' ? 'check' : 'info' }}" class="h-10 w-10" stroke="2.5"/></div>
                    <p class="mt-3 font-display text-xl font-bold">{{ $myAttendance->status_label }}</p>
                    <p class="text-xs text-ink-400">{{ $myAttendance->marked_at?->translatedFormat('d M Y, H:i') }}{{ $myAttendance->is_late ? ' · terlambat' : '' }}</p>
                @else
                    <p class="mt-3 text-sm text-ink-400">{{ $meeting->status === 'done' ? 'Tidak tercatat hadir.' : 'Belum tercatat. Tunjukkan QR-mu ke tentor saat pertemuan.' }}</p>
                    @if($meeting->status !== 'done')<a href="{{ route('attendance.my-qr') }}" class="btn-ink mt-4 w-full"><x-icon name="qr" class="h-4 w-4"/> QR saya</a>@endif
                @endif
            </div>
        @endif
    </div>
</div>
</x-layouts.app>
