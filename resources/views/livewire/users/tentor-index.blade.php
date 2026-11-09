<div>
    <x-page-header title="Tentor & Pelatih" sub="Tim pengajar Satya Naratama.">
        <x-slot:actions>@if($isAdmin)<a href="{{ route('tentor.create') }}" class="btn-primary"><x-icon name="user-plus" class="h-4 w-4"/> Tambah tentor</a>@endif</x-slot:actions>
    </x-page-header>
    <div class="mb-5 max-w-md"><x-search wire:model.live.debounce.400ms="q" placeholder="Cari nama tentor / kelas…"/></div>
    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
        @forelse($tentor as $t)
            <div wire:key="t{{ $t->id }}" class="group card overflow-hidden card-hover {{ $t->user?->is_active ? '' : 'opacity-70' }}">
                <div class="relative h-24 bg-gradient-to-r from-ink-900 via-garnet-700 to-saffron-500"><div class="absolute inset-0 bg-grid-ink [background-size:22px_22px]"></div></div>
                <div class="-mt-12 px-5 pb-5">
                    <img src="{{ $t->user?->avatar_url ?? asset('img/user.png') }}" class="relative h-24 w-24 rounded-3xl object-cover ring-4 ring-white" alt="">
                    <a href="{{ route('tentor.show', $t->id) }}" class="mt-3 block font-display text-lg font-bold hover:text-garnet-600">{{ $t->user?->name }}</a>
                    <p class="line-clamp-2 min-h-[2.5rem] text-sm text-ink-500">{{ $t->bio ?: 'Tentor Satya Naratama' }}</p>
                    <div class="mt-3 flex flex-wrap gap-1">@forelse($t->courses->take(3) as $c)<span class="badge-ink">{{ \Illuminate\Support\Str::limit($c->name, 22) }}</span>@empty<span class="text-xs text-ink-300">Belum ada kelas</span>@endforelse @if($t->courses->count() > 3)<span class="badge-gold">+{{ $t->courses->count() - 3 }}</span>@endif</div>
                    @if($isAdmin)
                        <div class="mt-4 flex items-center justify-between border-t border-ink-50 pt-3">
                            <div class="flex items-center gap-2 text-xs font-bold"><x-toggle :on="(bool) $t->user?->is_active" wire:click="toggle({{ $t->id }})"/> {{ $t->user?->is_active ? 'Aktif' : 'Nonaktif' }}</div>
                            <div class="flex gap-1">
                                <a href="{{ route('tentor.edit', $t->id) }}" class="btn-icon btn-ghost" title="Ubah"><x-icon name="pencil" class="h-4 w-4"/></a>
                                <button x-data @click="$confirm('Hapus {{ addslashes($t->user?->name) }} dari tentor? Akun dikembalikan menjadi siswa.', () => $wire.remove({{ $t->id }}))" class="btn-icon btn-ghost hover:text-garnet-600" title="Hapus"><x-icon name="trash" class="h-4 w-4"/></button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="sm:col-span-2 lg:col-span-3"><x-empty icon="teacher" title="Belum ada tentor"/></div>
        @endforelse
    </div>
    {{ $tentor->links() }}
</div>
