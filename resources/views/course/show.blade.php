<x-layouts.app :title="$course->name">
@php $isStaff = auth()->user()->hasAnyRole(['admin', 'tentor']); $meetings = $course->meetings->sortBy('scheduled_at')->values(); @endphp
<div class="card-ink mb-6 overflow-hidden">
    @if($course->thumbnail)<img src="{{ asset('storage/'.$course->thumbnail) }}" class="absolute inset-0 h-full w-full object-cover opacity-25" alt="">@endif
    <div class="absolute inset-0 bg-gradient-to-r from-ink-950 via-ink-900/90 to-ink-900/40"></div>
    <div class="relative p-6 sm:p-8">
        <a href="{{ route('course.index') }}" class="inline-flex items-center gap-1 text-xs font-bold text-ink-300 hover:text-white"><x-icon name="arrow-left" class="h-4 w-4"/> Semua kelas</a>
        <div class="mt-3 flex flex-wrap gap-2"><x-course-type-badge :type="$course->type" class="!bg-white"/>@if($course->is_free)<span class="badge bg-lagoon-500 text-white">Gratis</span>@endif</div>
        <h1 class="mt-3 font-display text-3xl font-extrabold sm:text-4xl">{{ $course->name }}</h1>
        <p class="mt-2 max-w-2xl text-sm text-ink-200">{{ $course->description }}</p>
        <div class="mt-6 flex flex-wrap items-center gap-4">
            <div class="flex items-center gap-2">
                <div class="flex -space-x-2">@foreach($course->teachers->take(5) as $t)<img src="{{ $t->user?->avatar_url }}" class="h-9 w-9 rounded-full object-cover ring-2 ring-ink-900" title="{{ $t->user?->name }}" alt="">@endforeach</div>
                <span class="text-xs text-ink-300">{{ $course->teachers->pluck('user.name')->filter()->join(', ') ?: 'Belum ada tentor' }}</span>
            </div>
            <span class="text-xs font-bold text-saffron-300">{{ $meetings->count() }} pertemuan · {{ $meetings->where('status', 'done')->count() }} selesai</span>
        </div>
        @if($isStaff)
            <div class="mt-6 flex flex-wrap gap-2">
                <a href="{{ route('meeting.create', $course) }}" class="btn-gold"><x-icon name="plus" class="h-4 w-4"/> Tambah pertemuan</a>
                @role('admin')<a href="{{ route('course.edit', $course->slug) }}" class="btn bg-white/10 text-white hover:bg-white/20"><x-icon name="pencil" class="h-4 w-4"/> Ubah kelas</a>@endrole
            </div>
        @endif
    </div>
</div>

<div x-data="{ q: '', st: '' }">
    <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <p class="section-title">Daftar pertemuan</p>
        <div class="flex gap-2">
            <div class="w-56"><x-search x-model="q" placeholder="Cari pertemuan…"/></div>
            <select x-model="st" class="select w-auto"><option value="">Semua</option><option value="live">Live</option><option value="upcoming">Akan datang</option><option value="done">Selesai</option></select>
        </div>
    </div>
    <div class="space-y-3">
        @forelse($meetings as $i => $m)
            <a href="{{ route('meeting.show', $m) }}" x-show="(!q || @js(mb_strtolower($m->title)).includes(q.toLowerCase())) && (!st || st === '{{ $m->status }}')"
               class="card card-hover flex items-center gap-4 p-4 {{ $m->status === 'live' ? 'ring-2 ring-garnet-400' : '' }}">
                <span class="grid h-12 w-12 shrink-0 place-items-center rounded-2xl font-display text-lg font-extrabold {{ $m->status === 'done' ? 'bg-lagoon-50 text-lagoon-700' : ($m->status === 'live' ? 'bg-garnet-600 text-white' : 'bg-ink-50 text-ink-700') }}">{{ $i + 1 }}</span>
                <div class="min-w-0 flex-1">
                    <p class="truncate font-bold">{{ $m->title }}</p>
                    <p class="text-xs text-ink-400">{{ $m->scheduled_at?->translatedFormat('l, d M Y · H:i') }} @if($m->is_free)<span class="badge-lagoon ml-1">Gratis</span>@endif</p>
                </div>
                <x-status-badge :status="$m->status"/>
                <x-icon name="chevron-right" class="hidden h-5 w-5 text-ink-300 sm:block"/>
            </a>
        @empty
            <x-empty icon="calendar" title="Belum ada pertemuan" :text="$isStaff ? 'Tambahkan pertemuan pertama untuk kelas ini.' : 'Pertemuan akan segera dijadwalkan.'"/>
        @endforelse
    </div>
</div>
</x-layouts.app>
