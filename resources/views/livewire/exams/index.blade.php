@php $isQuiz = $type === 'quiz'; $label = $isQuiz ? 'Kuis' : 'Tryout'; @endphp
<div>
    <div class="{{ $isQuiz ? 'bg-gradient-to-br from-lagoon-500 to-ink-900' : 'bg-sunrise' }} relative mb-6 overflow-hidden rounded-3xl p-6 text-white shadow-lift sm:p-8">
        <div class="absolute -right-10 -top-10 h-48 w-48 animate-spin-slow rounded-full border-[24px] border-white/15"></div>
        <div class="relative flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-widest text-white/80">{{ $isQuiz ? 'Latihan harian' : 'Simulasi CAT' }}</p>
                <h1 class="mt-1 font-display text-3xl font-extrabold sm:text-4xl">{{ $label }}</h1>
                <p class="mt-1 max-w-lg text-sm text-white/85">{{ $isQuiz ? 'Kuis singkat untuk mengasah materi setiap hari.' : 'Tryout berstandar CAT lengkap dengan peringkat & pembahasan.' }}</p>
            </div>
            @if($isStaff)<button x-data @click="$dispatch('open-modal', 'create-exam')" class="btn bg-white text-ink-900 hover:bg-cream"><x-icon name="plus" class="h-4 w-4"/> {{ $label }} baru</button>@endif
        </div>
    </div>

    <div class="mb-5 flex flex-col gap-3 md:flex-row">
        <div class="flex-1"><x-search wire:model.live.debounce.400ms="q" placeholder="Cari judul…"/></div>
        <input type="date" wire:model.live="date" class="input md:w-48">
        <div class="tabs">
            @foreach(['' => 'Semua', 'active' => 'Aktif', 'closed' => 'Ditutup'] + ($isStaff ? ['inactive' => 'Draft'] : []) as $k => $v)
                <button wire:click="$set('status','{{ $k }}')" class="tab {{ $status === $k ? 'tab-active' : '' }}">{{ $v }}</button>
            @endforeach
        </div>
    </div>

    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3" wire:loading.class="opacity-60">
        @forelse($exams as $e)
            @php $a = $myAttempts[$e->id] ?? null; @endphp
            <div wire:key="e{{ $e->id }}" class="card card-hover flex flex-col p-5">
                <div class="flex items-start justify-between gap-3">
                    <span class="grid h-12 w-12 place-items-center rounded-2xl {{ $isQuiz ? 'bg-lagoon-50 text-lagoon-700' : 'bg-garnet-50 text-garnet-600' }}"><x-icon :name="$isQuiz ? 'bolt' : 'trophy'" class="h-6 w-6"/></span>
                    <div class="flex flex-wrap justify-end gap-1"><span class="badge-ink">{{ $testTypes[$e->test_type] ?? strtoupper($e->test_type) }}</span><x-status-badge :status="$e->status"/></div>
                </div>
                <a href="{{ route('exams.show', $e) }}" class="mt-4 font-display text-lg font-bold leading-snug hover:text-garnet-600">{{ $e->title }}</a>
                <p class="mt-1 text-xs text-ink-400">{{ $e->exam_date?->translatedFormat('l, d M Y · H:i') }}</p>
                <div class="mt-3 flex flex-wrap gap-3 text-xs font-semibold text-ink-500">
                    <span class="flex items-center gap-1"><x-icon name="list" class="h-4 w-4"/>{{ $e->questions_count }} soal</span>
                    <span class="flex items-center gap-1"><x-icon name="clock" class="h-4 w-4"/>{{ $e->duration_minutes ?? '–' }} menit</span>
                    <span class="flex items-center gap-1"><x-icon name="users" class="h-4 w-4"/>{{ $e->submitted_count }} peserta</span>
                </div>
                <div class="mt-auto flex flex-wrap gap-2 pt-5">
                    @if($isStaff)
                        @if($e->status === 'inactive')
                            <a href="{{ route('exams.edit', $e) }}" class="btn-ink btn-sm"><x-icon name="pencil" class="h-4 w-4"/> Soal</a>
                            <button x-data @click="$confirm('Aktifkan {{ addslashes($e->title) }}? Siswa langsung bisa mengerjakan.', () => $wire.activate({{ $e->id }}), { danger: false, okText: 'Aktifkan' })" class="btn-lagoon btn-sm"><x-icon name="play" class="h-4 w-4"/> Aktifkan</button>
                        @elseif($e->status === 'active')
                            <button x-data @click="$confirm('Tutup ujian ini?', () => $wire.close({{ $e->id }}), { okText: 'Tutup' })" class="btn-danger btn-sm"><x-icon name="lock" class="h-4 w-4"/> Tutup</button>
                        @endif
                        <a href="{{ route('exams.results', $e) }}" class="btn-soft btn-sm"><x-icon name="chart" class="h-4 w-4"/> Hasil</a>
                        @if($e->status !== 'active' && ! $e->submitted_count)
                            <button x-data @click="$confirm('Hapus {{ addslashes($e->title) }}?', () => $wire.remove({{ $e->id }}))" class="btn-ghost btn-sm ml-auto hover:text-garnet-600"><x-icon name="trash" class="h-4 w-4"/></button>
                        @endif
                    @else
                        @if($a?->is_submitted)
                            <a href="{{ route('exams.result.student', $e) }}" class="btn-lagoon btn-sm flex-1">Nilai: {{ rtrim(rtrim(number_format($a->score, 2, ',', '.'), '0'), ',') }}</a>
                            <a href="{{ route('exams.ranking.student', $e) }}" class="btn-soft btn-sm"><x-icon name="medal" class="h-4 w-4"/></a>
                        @elseif($a)
                            <a href="{{ route('exams.attempt', $e) }}" class="btn-gold btn-sm flex-1"><x-icon name="play" class="h-4 w-4"/> Lanjutkan</a>
                        @elseif($e->status === 'active')
                            <a href="{{ route('exams.show', $e) }}" class="btn-primary btn-sm flex-1">Kerjakan <x-icon name="arrow-right" class="h-4 w-4"/></a>
                        @else
                            <span class="btn-soft btn-sm flex-1 opacity-60">Ditutup</span>
                        @endif
                    @endif
                </div>
            </div>
        @empty
            <div class="md:col-span-2 xl:col-span-3"><x-empty :icon="$isQuiz ? 'bolt' : 'trophy'" :title="'Belum ada '.strtolower($label)" :text="$isStaff ? 'Buat '.strtolower($label).' pertama lalu tambahkan soal dari bank soal.' : 'Nantikan '.strtolower($label).' berikutnya.'"/></div>
        @endforelse
    </div>
    {{ $exams->links() }}

    @if($isStaff)
    <x-modal name="create-exam" :title="$label.' baru'">
        <form wire:submit="create" class="space-y-4">
            <x-field label="Judul" name="title" required><input wire:model="title" class="input" placeholder="{{ $isQuiz ? 'mis. Kuis Harian TIU #12' : 'mis. Tryout SKD Akbar November' }}"></x-field>
            <x-field label="Jenis tes" name="test_type" required>
                <div class="grid grid-cols-3 gap-2">
                    @foreach($testTypes as $k => $l)
                        <label class="cursor-pointer rounded-xl border-2 px-2 py-2 text-center text-xs font-bold transition {{ $test_type === $k ? 'border-garnet-500 bg-garnet-50 text-garnet-700' : 'border-ink-100' }}"><input type="radio" wire:model.live="test_type" value="{{ $k }}" class="hidden">{{ $l }}</label>
                    @endforeach
                </div>
            </x-field>
            <x-field label="Tanggal & jam" name="exam_date" required><input type="datetime-local" wire:model="exam_date" class="input"></x-field>
            <button class="btn-primary w-full" wire:loading.attr="disabled">Buat & tambah soal <x-icon name="arrow-right" class="h-4 w-4"/></button>
        </form>
    </x-modal>
    @endif
</div>
