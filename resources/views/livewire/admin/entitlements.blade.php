@php $tone = ['course' => 'badge-garnet', 'meeting' => 'badge-ink', 'tryout' => 'badge-gold', 'quiz' => 'badge-lagoon']; $lbl = ['course' => 'Kelas', 'meeting' => 'Pertemuan', 'tryout' => 'Tryout', 'quiz' => 'Kuis']; @endphp
<div>
    <x-page-header title="Hak Akses Siswa" sub="Akses diberikan otomatis saat pesanan diverifikasi. Admin juga bisa memberi/mencabut akses manual."/>
    <div class="mb-5 max-w-md"><x-search wire:model.live.debounce.400ms="q" placeholder="Cari nama / email siswa…"/></div>
    <div class="space-y-3">
        @forelse($users as $u)
            <div wire:key="u{{ $u->id }}" class="card flex flex-col gap-3 p-4 md:flex-row md:items-start">
                <div class="flex w-64 shrink-0 items-center gap-3"><img src="{{ $u->avatar_url }}" class="h-10 w-10 rounded-xl object-cover" alt=""><div class="min-w-0"><p class="truncate font-bold">{{ $u->name }}</p><p class="truncate text-xs text-ink-400">{{ $u->email }}</p></div></div>
                <div class="flex flex-1 flex-wrap gap-1.5">
                    @forelse($u->entitlements as $e)
                        <span class="{{ $tone[$e->entitlement_type] ?? 'badge-ink' }} !pr-1">{{ $lbl[$e->entitlement_type] ?? $e->entitlement_type }}{{ $e->entitlement_id ? ': '.\Illuminate\Support\Str::limit($names[$e->entitlement_type][$e->entitlement_id] ?? '#'.$e->entitlement_id, 28) : '' }}
                            <button x-data @click="$confirm('Cabut akses ini?', () => $wire.revoke({{ $e->id }}))" class="ml-0.5 grid h-4 w-4 place-items-center rounded-full hover:bg-black/10"><x-icon name="x" class="h-3 w-3"/></button></span>
                    @empty
                        <span class="text-xs text-ink-400">Belum memiliki akses</span>
                    @endforelse
                </div>
                <button wire:click="openGrant({{ $u->id }})" class="btn-soft btn-sm shrink-0"><x-icon name="plus" class="h-4 w-4"/> Beri akses</button>
            </div>
        @empty
            <x-empty icon="key" title="Siswa tidak ditemukan"/>
        @endforelse
    </div>
    {{ $users->links() }}
    <x-modal name="grant" title="Beri akses manual">
        <form wire:submit="grant" class="space-y-4">
            <x-field label="Jenis akses" name="grantType"><select wire:model.live="grantType" class="select">@foreach($lbl as $k => $l)<option value="{{ $k }}">{{ $l }}</option>@endforeach</select></x-field>
            @if($grantType !== 'quiz')
                <x-field label="Pilih item" name="grantId"><select wire:model="grantId" class="select"><option value="">—</option>@foreach($options[$grantType] ?? [] as $id => $n)<option value="{{ $id }}">{{ $n }}</option>@endforeach</select></x-field>
            @else
                <p class="text-sm text-ink-500">Akses semua kuis harian (global).</p>
            @endif
            <button class="btn-primary w-full">Berikan akses</button>
        </form>
    </x-modal>
</div>
