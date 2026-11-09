<div>
    <x-page-header title="Pendaftaran Siswa" sub="Verifikasi pembayaran pendaftar untuk membuat akun siswa otomatis.">
        <x-slot:actions><a href="{{ route('admin.registrations.export', ['status' => $status]) }}" class="btn-soft"><x-icon name="download" class="h-4 w-4"/> Ekspor CSV</a></x-slot:actions>
    </x-page-header>
    <div class="mb-5 grid grid-cols-2 gap-3 md:grid-cols-5">
        @foreach(['all' => ['Semua', 'ink'], 'awaiting_verification' => ['Perlu verifikasi', 'garnet'], 'pending_payment' => ['Belum bayar', 'gold'], 'verified' => ['Terverifikasi', 'lagoon'], 'rejected' => ['Ditolak', 'ink']] as $k => [$l, $tone])
            <button wire:click="$set('status','{{ $k }}')" class="card p-4 text-left transition {{ $status === $k ? 'ring-2 ring-ink-900' : 'hover:bg-cream' }}">
                <p class="text-[11px] font-bold uppercase text-ink-400">{{ $l }}</p><p class="font-display text-2xl font-extrabold {{ $tone === 'garnet' ? 'text-garnet-600' : '' }}">{{ $stats[$k] }}</p>
            </button>
        @endforeach
    </div>
    <div class="mb-4 max-w-md"><x-search wire:model.live.debounce.400ms="search" placeholder="Cari nama, email, HP, sekolah…"/></div>
    <div class="table-wrap" wire:loading.class="opacity-60">
        <table class="table">
            <thead><tr><th>Pendaftar</th><th>Sekolah</th><th>Kampus</th><th>Domisili</th><th>Status</th><th>Daftar</th><th></th></tr></thead>
            <tbody>
            @forelse($registrations as $r)
                <tr wire:key="r{{ $r->id }}" class="{{ $r->isAwaitingVerification() ? 'bg-saffron-50/50' : '' }}">
                    <td><div class="flex items-center gap-3"><img src="{{ $r->avatar ? asset('storage/'.$r->avatar) : asset('img/user.png') }}" class="h-9 w-9 rounded-xl object-cover" alt=""><div><p class="font-bold">{{ $r->full_name }}</p><p class="text-xs text-ink-400">{{ $r->email }} · {{ $r->phone }}</p></div></div></td>
                    <td class="text-xs">{{ $r->school_origin }}<br><span class="text-ink-400">Kelas {{ $r->class }} · {{ $r->gender }}</span></td>
                    <td><span class="badge-ink">{{ $r->priority_university_1 }}</span></td>
                    <td class="text-xs text-ink-500">{{ $r->kelurahan?->name }}, {{ $r->kecamatan?->name }}</td>
                    <td><x-status-badge :status="$r->registration_status"/></td>
                    <td class="whitespace-nowrap text-xs text-ink-400">{{ $r->created_at->translatedFormat('d M Y') }}</td>
                    <td class="text-right"><a href="{{ route('admin.registrations.show', $r->id) }}" class="{{ $r->isAwaitingVerification() ? 'btn-primary' : 'btn-soft' }} btn-sm">{{ $r->isAwaitingVerification() ? 'Verifikasi' : 'Detail' }}</a></td>
                </tr>
            @empty
                <tr><td colspan="7" class="py-10 text-center text-ink-400">Tidak ada pendaftaran.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    {{ $registrations->links() }}
</div>
