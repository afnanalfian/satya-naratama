<div>
    <x-page-header title="Data Siswa" :sub="$counts['all'].' siswa terdaftar · '.$counts['active'].' aktif'">
        <x-slot:actions>
            @role('admin')<a href="{{ route('admin.registrations.index') }}" class="btn-soft"><x-icon name="inbox" class="h-4 w-4"/> Pendaftaran</a>@endrole
            <a href="{{ route('attendance.qr-cards') }}" class="btn-ink"><x-icon name="qr" class="h-4 w-4"/> Kartu QR</a>
        </x-slot:actions>
    </x-page-header>

    <div class="mb-5 flex flex-col gap-3 md:flex-row md:items-center">
        <div class="flex-1"><x-search wire:model.live.debounce.400ms="q" placeholder="Cari nama, email, HP, sekolah, wilayah…"/></div>
        <div class="tabs">
            @foreach(['' => 'Semua', 'active' => 'Aktif', 'inactive' => 'Nonaktif'] as $k => $v)
                <button wire:click="$set('status','{{ $k }}')" class="tab {{ $status === $k ? 'tab-active' : '' }}">{{ $v }}</button>
            @endforeach
        </div>
        <div class="tabs">
            <button wire:click="$set('view','grid')" class="tab {{ $view === 'grid' ? 'tab-active' : '' }}"><x-icon name="grid" class="h-4 w-4"/></button>
            <button wire:click="$set('view','table')" class="tab {{ $view === 'table' ? 'tab-active' : '' }}"><x-icon name="list" class="h-4 w-4"/></button>
        </div>
    </div>

    <div wire:loading.class="opacity-60" class="transition">
    @if($siswa->isEmpty())
        <x-empty icon="users" title="Siswa tidak ditemukan" text="Coba kata kunci lain."/>
    @elseif($view === 'grid')
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach($siswa as $s)
                <div wire:key="s{{ $s->id }}" class="card card-hover relative p-5 {{ $s->is_active ? '' : 'opacity-70' }}">
                    <div class="flex items-start gap-3">
                        <img src="{{ $s->avatar_url }}" class="h-14 w-14 rounded-2xl object-cover" alt="">
                        <div class="min-w-0 flex-1">
                            <a href="{{ route('siswa.show', $s->id) }}" class="block truncate font-bold hover:text-garnet-600">{{ $s->display_name }}</a>
                            <p class="truncate text-xs text-ink-400">{{ $s->email }}</p>
                            <div class="mt-1.5 flex flex-wrap gap-1">
                                @if($s->studentRegistration?->class)<span class="badge-ink">Kelas {{ $s->studentRegistration->class }}</span>@endif
                                @if($s->studentRegistration?->gender)<span class="badge-gold">{{ $s->studentRegistration->gender }}</span>@endif
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 truncate text-xs text-ink-500"><x-icon name="map" class="inline h-3.5 w-3.5"/> {{ $s->regency?->name ?? $s->studentRegistration?->school_origin ?? '—' }}</p>
                    <div class="mt-4 flex items-center justify-between border-t border-ink-50 pt-3">
                        <div class="flex items-center gap-2 text-xs font-bold {{ $s->is_active ? 'text-lagoon-600' : 'text-ink-400' }}">
                            <x-toggle :on="$s->is_active" wire:click="toggle({{ $s->id }})"/> {{ $s->is_active ? 'Aktif' : 'Nonaktif' }}
                        </div>
                        <div class="flex gap-1">
                            @if($s->whatsapp_phone)<a href="https://wa.me/{{ $s->whatsapp_phone }}" target="_blank" class="btn-icon btn-ghost text-lagoon-600" title="WhatsApp"><x-icon name="whatsapp" class="h-4 w-4"/></a>@endif
                            <a href="{{ route('monitor.student', $s) }}" class="btn-icon btn-ghost" title="Rapor"><x-icon name="chart" class="h-4 w-4"/></a>
                            <a href="{{ route('siswa.show', $s->id) }}" class="btn-icon btn-ghost" title="Detail"><x-icon name="eye" class="h-4 w-4"/></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="table-wrap">
            <table class="table">
                <thead><tr><th>Siswa</th><th>Kontak</th><th>Sekolah</th><th>Wilayah</th><th>Status</th><th></th></tr></thead>
                <tbody>
                @foreach($siswa as $s)
                    <tr wire:key="t{{ $s->id }}">
                        <td><div class="flex items-center gap-3"><img src="{{ $s->avatar_url }}" class="h-9 w-9 rounded-xl object-cover" alt=""><div><a href="{{ route('siswa.show', $s->id) }}" class="font-bold hover:text-garnet-600">{{ $s->display_name }}</a><p class="text-xs text-ink-400">{{ $s->email }}</p></div></div></td>
                        <td class="text-ink-600">{{ $s->phone ?: '—' }}</td>
                        <td class="text-ink-600">{{ $s->studentRegistration?->school_origin ?? '—' }} {{ $s->studentRegistration?->class ? '· '.$s->studentRegistration->class : '' }}</td>
                        <td class="text-ink-600">{{ $s->regency?->name ?? '—' }}</td>
                        <td><x-toggle :on="$s->is_active" wire:click="toggle({{ $s->id }})"/></td>
                        <td class="text-right"><a href="{{ route('siswa.show', $s->id) }}" class="btn-soft btn-sm">Detail</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
    </div>
    <div class="mt-2 flex items-center justify-between gap-3">
        <select wire:model.live="perPage" class="select input-sm w-auto"><option value="12">12</option><option value="24">24</option><option value="48">48</option><option value="96">96</option></select>
        <div class="flex-1">{{ $siswa->links() }}</div>
    </div>
</div>
