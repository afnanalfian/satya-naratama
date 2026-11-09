<div>
    <x-page-header eyebrow="Bank soal" :title="$category->name" sub="Daftar materi dalam kategori ini." :back="route('bank.category.index')">
        <x-slot:actions><button wire:click="new" class="btn-primary"><x-icon name="plus" class="h-4 w-4"/> Materi baru</button></x-slot:actions>
    </x-page-header>
    <div class="mb-5 max-w-md"><x-search wire:model.live.debounce.400ms="q" placeholder="Cari materi…"/></div>
    <div class="grid gap-3 md:grid-cols-2">
        @forelse($materials as $m)
            <div wire:key="m{{ $m->id }}" class="card flex items-center gap-4 p-4 card-hover">
                <span class="grid h-12 w-12 shrink-0 place-items-center rounded-2xl bg-ink-900 text-saffron-400"><x-icon name="folder" class="h-6 w-6"/></span>
                <a href="{{ route('bank.material.questions.index', $m) }}" class="min-w-0 flex-1">
                    <p class="truncate font-bold hover:text-garnet-600">{{ $m->name }}</p>
                    <p class="text-xs text-ink-400">{{ $m->questions_count }} soal</p>
                </a>
                <a href="{{ route('bank.material.questions.create', $m) }}" class="btn-soft btn-sm" title="Tambah soal"><x-icon name="plus" class="h-4 w-4"/> Soal</a>
                <button wire:click="edit({{ $m->id }})" class="btn-icon btn-ghost"><x-icon name="pencil" class="h-4 w-4"/></button>
                <button x-data @click="$confirm('Hapus materi {{ addslashes($m->name) }}?', () => $wire.remove({{ $m->id }}))" class="btn-icon btn-ghost hover:text-garnet-600"><x-icon name="trash" class="h-4 w-4"/></button>
            </div>
        @empty
            <div class="md:col-span-2"><x-empty icon="folder" title="Belum ada materi"/></div>
        @endforelse
    </div>
    {{ $materials->links() }}
    <x-modal name="material" :title="$editingId ? 'Ubah materi' : 'Materi baru'">
        <form wire:submit="save" class="space-y-4">
            <x-field label="Nama materi" name="name" required><input wire:model="name" class="input" placeholder="mis. Deret Angka"></x-field>
            <button class="btn-primary w-full">Simpan</button>
        </form>
    </x-modal>
</div>
