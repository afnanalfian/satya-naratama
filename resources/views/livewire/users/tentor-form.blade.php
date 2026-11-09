<div class="mx-auto max-w-3xl">
    <x-page-header :title="$teacher ? 'Ubah Tentor' : 'Tambah Tentor'" :sub="$teacher ? $teacher->user?->name : 'Pilih akun siswa aktif untuk dijadikan tentor.'" :back="route('tentor.index')"/>
    <form wire:submit="save" class="space-y-6">
        @unless($teacher)
            <div class="card card-pad">
                <p class="section-title">1 · Pilih akun</p>
                @if($selectedUser)
                    <div class="mt-4 flex items-center gap-3 rounded-2xl bg-lagoon-50 p-3 ring-1 ring-lagoon-100">
                        <img src="{{ $selectedUser->avatar_url }}" class="h-11 w-11 rounded-xl object-cover" alt="">
                        <div class="flex-1"><p class="font-bold">{{ $selectedUser->name }}</p><p class="text-xs text-ink-500">{{ $selectedUser->email }}</p></div>
                        <button type="button" wire:click="$set('user_id','')" class="btn-soft btn-sm">Ganti</button>
                    </div>
                @else
                    <div class="mt-4"><x-search wire:model.live.debounce.300ms="search" placeholder="Cari nama/email siswa…"/></div>
                    <div class="mt-3 grid max-h-72 gap-2 overflow-y-auto sm:grid-cols-2">
                        @forelse($users as $u)
                            <button type="button" wire:key="u{{ $u->id }}" wire:click="$set('user_id', {{ $u->id }})" class="flex items-center gap-3 rounded-2xl border border-ink-100 p-2.5 text-left hover:border-garnet-300 hover:bg-garnet-50">
                                <img src="{{ $u->avatar_url }}" class="h-9 w-9 rounded-xl object-cover" alt=""><span class="min-w-0"><span class="block truncate text-sm font-bold">{{ $u->name }}</span><span class="block truncate text-xs text-ink-400">{{ $u->email }}</span></span>
                            </button>
                        @empty
                            <p class="text-sm text-ink-400">Tidak ada akun cocok.</p>
                        @endforelse
                    </div>
                @endif
                @error('user_id')<p class="error">{{ $message }}</p>@enderror
            </div>
        @endunless
        <div class="card card-pad">
            <p class="section-title">{{ $teacher ? '' : '2 · ' }}Profil & kelas yang diampu</p>
            <x-field label="Bio singkat" name="bio" class="mt-4"><textarea wire:model="bio" class="textarea" placeholder="mis. Alumni AKPOL 2018, pelatih jasmani…"></textarea></x-field>
            <p class="label mt-5">Kelas</p>
            <div class="grid gap-2 sm:grid-cols-2">
                @foreach($courses as $c)
                    <label wire:key="c{{ $c->id }}" class="flex cursor-pointer items-center gap-3 rounded-2xl border-2 px-3 py-2.5 text-sm font-semibold transition {{ in_array((string) $c->id, $course_ids) ? 'border-ink-900 bg-ink-50' : 'border-ink-100 hover:border-ink-200' }}">
                        <input type="checkbox" wire:model.live="course_ids" value="{{ $c->id }}" class="checkbox"> <span class="flex-1">{{ $c->name }}</span> <x-course-type-badge :type="$c->type"/>
                    </label>
                @endforeach
            </div>
        </div>
        <div class="flex justify-end gap-2"><a href="{{ route('tentor.index') }}" class="btn-soft">Batal</a><button class="btn-primary"><x-icon name="check" class="h-4 w-4"/> Simpan</button></div>
    </form>
</div>
