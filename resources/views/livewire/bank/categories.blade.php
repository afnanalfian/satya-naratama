<div>
    <x-page-header eyebrow="Bank soal" title="Kategori Soal" sub="Kelompokkan soal per kategori → materi → soal.">
        <x-slot:actions><button wire:click="new" class="btn-primary"><x-icon name="plus" class="h-4 w-4"/> Kategori baru</button></x-slot:actions>
    </x-page-header>
    <div class="mb-5 max-w-md"><x-search wire:model.live.debounce.400ms="q" placeholder="Cari kategori…"/></div>
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @forelse($categories as $i => $c)
            @php $grad = ['from-garnet-500 to-saffron-400', 'from-ink-700 to-ink-950', 'from-lagoon-500 to-ink-800', 'from-saffron-400 to-garnet-600'][$i % 4]; @endphp
            <div wire:key="c{{ $c->id }}" class="group card overflow-hidden card-hover">
                <a href="{{ route('bank.category.materials.index', $c) }}" class="relative block h-28 bg-gradient-to-br {{ $grad }}">
                    @if($c->thumbnail)<img src="{{ asset('storage/'.$c->thumbnail) }}" class="h-full w-full object-cover opacity-70 mix-blend-overlay" alt="">@endif
                    <span class="absolute bottom-3 left-4 font-display text-xl font-extrabold text-white drop-shadow">{{ $c->name }}</span>
                </a>
                <div class="p-4">
                    <p class="line-clamp-2 min-h-[2.5rem] text-sm text-ink-500">{{ $c->description ?: 'Tanpa deskripsi' }}</p>
                    <div class="mt-3 flex items-center justify-between">
                        <div class="flex gap-2 text-xs font-bold text-ink-500"><span class="badge-ink">{{ $c->materials_count }} materi</span><span class="badge-gold">{{ $qCounts[$c->id] ?? 0 }} soal</span></div>
                        <div class="flex gap-1">
                            <button wire:click="edit({{ $c->id }})" class="btn-icon btn-ghost"><x-icon name="pencil" class="h-4 w-4"/></button>
                            <button x-data @click="$confirm('Hapus kategori {{ addslashes($c->name) }}?', () => $wire.remove({{ $c->id }}))" class="btn-icon btn-ghost hover:text-garnet-600"><x-icon name="trash" class="h-4 w-4"/></button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full"><x-empty icon="stack" title="Belum ada kategori" text="Mulai dengan membuat kategori, misalnya TIU, TWK, TKP, Matematika."/></div>
        @endforelse
    </div>
    {{ $categories->links() }}

    <x-modal name="category" :title="$editingId ? 'Ubah kategori' : 'Kategori baru'">
        <form wire:submit="save" class="space-y-4">
            <x-field label="Nama" name="name" required><input wire:model="name" class="input"></x-field>
            <x-field label="Deskripsi" name="description"><textarea wire:model="description" class="textarea"></textarea></x-field>
            <x-field label="Gambar (opsional)" name="thumbnail"><input type="file" wire:model="thumbnail" accept="image/*" class="file"></x-field>
            <button class="btn-primary w-full" wire:loading.attr="disabled" wire:target="save,thumbnail">Simpan</button>
        </form>
    </x-modal>
</div>
