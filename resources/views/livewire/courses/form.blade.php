<div class="mx-auto max-w-4xl">
    <x-page-header :title="$course ? 'Ubah Kelas' : 'Kelas Baru'" :back="$course ? route('course.show', $course->slug) : route('course.index')"/>
    <form wire:submit="save" class="grid gap-6 lg:grid-cols-5">
        <div class="card card-pad space-y-4 lg:col-span-3">
            <x-field label="Jenis kelas" name="type" required>
                <div class="grid grid-cols-2 gap-2">
                    @foreach(['akademik' => ['book', 'Akademik', 'Materi, video, post-test'], 'jasmani' => ['run', 'Jasmani', 'Latihan fisik & presensi']] as $k => [$ic, $l, $d])
                        <label class="flex cursor-pointer items-start gap-3 rounded-2xl border-2 p-3 transition {{ $type === $k ? 'border-garnet-500 bg-garnet-50' : 'border-ink-100 hover:border-ink-200' }}">
                            <input type="radio" wire:model.live="type" value="{{ $k }}" class="hidden">
                            <span class="grid h-10 w-10 shrink-0 place-items-center rounded-xl {{ $type === $k ? 'bg-garnet-600 text-white' : 'bg-ink-50 text-ink-500' }}"><x-icon :name="$ic" class="h-5 w-5"/></span>
                            <span><span class="block text-sm font-bold">{{ $l }}</span><span class="text-xs text-ink-400">{{ $d }}</span></span>
                        </label>
                    @endforeach
                </div>
            </x-field>
            <x-field label="Nama kelas" name="name" required><input wire:model.live.debounce.400ms="name" class="input" placeholder="mis. Kelas Intensif AKPOL 2026"></x-field>
            <x-field label="Slug (URL)" name="slug" required hint="Otomatis dari nama, bisa diubah."><div class="flex items-center rounded-2xl border border-ink-200 bg-ink-50 pl-3 text-xs text-ink-400 focus-within:ring-4 focus-within:ring-garnet-100">/course/<input wire:model.blur="slug" class="flex-1 border-0 bg-transparent px-1 py-2.5 text-sm text-ink-900 focus:ring-0"></div></x-field>
            <x-field label="Deskripsi" name="description" required><textarea wire:model="description" rows="5" class="textarea" maxlength="1000"></textarea></x-field>
            <label class="flex items-center justify-between rounded-2xl bg-cream p-4">
                <span><span class="block text-sm font-bold">Kelas gratis</span><span class="text-xs text-ink-400">Semua pertemuan bisa diakses tanpa membeli.</span></span>
                <x-toggle :on="$is_free" wire:click="$toggle('is_free')"/>
            </label>
        </div>
        <div class="space-y-4 lg:col-span-2">
            <div class="card card-pad">
                <p class="label">Thumbnail</p>
                <label class="block cursor-pointer overflow-hidden rounded-2xl border-2 border-dashed border-ink-200 hover:border-garnet-400">
                    @if($thumbnail && method_exists($thumbnail, 'temporaryUrl'))
                        <img src="{{ $thumbnail->temporaryUrl() }}" class="aspect-video w-full object-cover" alt="">
                    @elseif($course?->thumbnail)
                        <img src="{{ asset('storage/'.$course->thumbnail) }}" class="aspect-video w-full object-cover" alt="">
                    @else
                        <div class="grid aspect-video place-items-center bg-cream text-center"><div><x-icon name="image" class="mx-auto h-8 w-8 text-ink-300"/><p class="mt-1 text-xs font-bold text-ink-400">Pilih gambar 16:9</p></div></div>
                    @endif
                    <input type="file" wire:model="thumbnail" accept="image/*" class="hidden">
                </label>
                <p wire:loading wire:target="thumbnail" class="mt-2 text-xs font-bold text-garnet-600">Mengunggah…</p>
                @error('thumbnail')<p class="error">{{ $message }}</p>@enderror
            </div>
            <button class="btn-primary w-full" wire:loading.attr="disabled"><x-icon name="check" class="h-4 w-4"/> {{ $course ? 'Simpan perubahan' : 'Buat kelas' }}</button>
        </div>
    </form>
    @if($course)
        <form method="POST" action="{{ route('course.delete', $course->slug) }}" data-confirm="Hapus kelas {{ $course->name }} beserta SEMUA pertemuan, materi, video & post-test-nya?" class="mt-6 flex justify-end">
            @csrf @method('DELETE')<button class="btn-danger"><x-icon name="trash" class="h-4 w-4"/> Hapus kelas</button>
        </form>
    @endif
</div>
