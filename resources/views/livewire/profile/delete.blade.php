<div class="mx-auto max-w-xl">
    <x-page-header title="Nonaktifkan Akun" :back="route('profile.show')"/>
    <div class="card overflow-hidden">
        <div class="bg-garnet-600 p-6 text-white">
            <x-icon name="alert" class="h-8 w-8"/>
            <p class="mt-3 font-display text-xl font-bold">Yakin ingin pergi? 😢</p>
            <p class="mt-1 text-sm text-white/85">Akun akan dinonaktifkan. Kamu masih bisa mengaktifkannya kembali dengan login dalam <b>10 hari</b>. Setelah itu data akan dihapus permanen.</p>
        </div>
        <form wire:submit="deactivate" class="space-y-3 p-6">
            <p class="label">Mengapa kamu menonaktifkan akun?</p>
            @foreach($reasons as $r)
                <label class="flex cursor-pointer items-center gap-3 rounded-2xl border-2 px-4 py-3 text-sm font-semibold transition {{ $reason_option === $r ? 'border-garnet-500 bg-garnet-50' : 'border-ink-100 hover:border-ink-200' }}">
                    <input type="radio" wire:model.live="reason_option" value="{{ $r }}" class="radio"> {{ $r }}
                </label>
            @endforeach
            @error('reason_option')<p class="error">{{ $message }}</p>@enderror
            @if($reason_option === 'Lainnya')
                <x-field name="reason_custom"><textarea wire:model="reason_custom" class="textarea" placeholder="Ceritakan alasanmu…"></textarea></x-field>
            @endif
            <div class="flex gap-2 pt-3">
                <a href="{{ route('profile.show') }}" class="btn-soft flex-1">Batal</a>
                <button type="button" x-data @click="$confirm('Nonaktifkan akun sekarang?', () => $wire.deactivate(), { okText: 'Nonaktifkan' })" class="btn-primary flex-1">Nonaktifkan akun</button>
            </div>
        </form>
    </div>
</div>
