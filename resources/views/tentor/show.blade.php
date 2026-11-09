<x-layouts.app :title="'Tentor · '.$teacher->user?->name">
<x-page-header :title="$teacher->user?->name ?? 'Tentor'" sub="Profil tentor" :back="route('tentor.index')">
    <x-slot:actions>
    @role('admin')
        <a href="{{ route('tentor.edit', $teacher->id) }}" class="btn-ink"><x-icon name="pencil" class="h-4 w-4"/> Ubah</a>
        <form method="POST" action="{{ route('tentor.remove', $teacher->id) }}" data-confirm="Hapus tentor ini? Akun dikembalikan menjadi siswa.">@csrf @method('DELETE')<button class="btn-danger"><x-icon name="trash" class="h-4 w-4"/> Hapus</button></form>
    @endrole
    </x-slot:actions>
</x-page-header>
<div class="grid gap-6 lg:grid-cols-3">
    <div class="card overflow-hidden text-center">
        <div class="relative h-28 bg-sunrise"></div>
        <img src="{{ $teacher->user?->avatar_url }}" class="relative mx-auto -mt-16 h-32 w-32 rounded-[2rem] object-cover ring-8 ring-white" alt="">
        <div class="p-6 pt-4">
            <p class="font-display text-xl font-bold">{{ $teacher->user?->name }}</p>
            <p class="text-sm text-ink-400">{{ $teacher->user?->email }}</p>
            <p class="mt-4 text-sm text-ink-600">{{ $teacher->bio ?: 'Belum ada bio.' }}</p>
            @if($teacher->user?->whatsapp_phone && auth()->user()->hasRole('admin'))<a href="https://wa.me/{{ $teacher->user->whatsapp_phone }}" class="btn-lagoon btn-sm mt-4" target="_blank"><x-icon name="whatsapp" class="h-4 w-4"/> WhatsApp</a>@endif
        </div>
    </div>
    <div class="card card-pad lg:col-span-2">
        <p class="section-title">Kelas yang diampu ({{ $teacher->courses->count() }})</p>
        <div class="mt-4 grid gap-3 sm:grid-cols-2">
            @forelse($teacher->courses as $c)
                <a href="{{ route('course.show', $c->slug) }}" class="flex items-center gap-3 rounded-2xl border border-ink-100 p-3 hover:bg-cream">
                    <span class="grid h-11 w-11 place-items-center rounded-xl {{ $c->type === 'jasmani' ? 'bg-saffron-100 text-saffron-700' : 'bg-ink-100 text-ink-700' }}"><x-icon :name="$c->type === 'jasmani' ? 'run' : 'book'" class="h-5 w-5"/></span>
                    <span class="flex-1 font-bold">{{ $c->name }}</span><x-icon name="chevron-right" class="h-4 w-4 text-ink-300"/>
                </a>
            @empty
                <p class="text-sm text-ink-400">Belum mengampu kelas.</p>
            @endforelse
        </div>
    </div>
</div>
</x-layouts.app>
