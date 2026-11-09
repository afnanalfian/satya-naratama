<x-layouts.app title="Kartu QR Siswa" :wide="true">
@push('head')<script src="{{ asset('vendor/qrcodejs/qrcode.min.js') }}"></script>@endpush
<div x-data="{ sel: [], all: @js($students->pluck('id')), toggleAll() { this.sel = this.sel.length === this.all.length ? [] : [...this.all] } }">
    <x-page-header title="Kartu QR Siswa" :sub="$students->count().' siswa aktif · cetak kartu untuk presensi.'">
        <x-slot:actions>
            <button @click="toggleAll()" class="btn-soft" x-text="sel.length === all.length ? 'Batal pilih' : 'Pilih semua'"></button>
            <a :href="'{{ route('attendance.qr-cards') }}?print=1&ids=' + sel.join(',')" target="_blank" class="btn-primary"><x-icon name="printer" class="h-4 w-4"/> Cetak <span x-text="sel.length ? '(' + sel.length + ')' : 'semua'"></span></a>
        </x-slot:actions>
    </x-page-header>
    <form method="GET" class="mb-5 max-w-md"><x-search name="q" :value="$q" placeholder="Cari nama siswa lalu Enter…"/></form>
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @forelse($students as $s)
            <div class="card relative p-4" :class="sel.includes({{ $s->id }}) && 'ring-2 ring-garnet-500'">
                <label class="absolute left-3 top-3"><input type="checkbox" value="{{ $s->id }}" x-model.number="sel" class="checkbox"></label>
                <div class="mx-auto w-fit rounded-2xl bg-white p-2 ring-1 ring-ink-100"><div x-data x-init="new QRCode($el, { text: @js($s->qr_payload), width: 140, height: 140 })"></div></div>
                <p class="mt-3 truncate text-center font-bold">{{ $s->display_name }}</p>
                <p class="text-center text-xs text-ink-400">{{ $s->studentRegistration?->class ? 'Kelas '.$s->studentRegistration->class : '—' }}</p>
                <form method="POST" action="{{ route('attendance.qr-regenerate', $s) }}" data-confirm="Buat ulang QR {{ $s->name }}? Kartu lama tidak berlaku." class="mt-3">@csrf<button class="btn-ghost btn-sm w-full"><x-icon name="refresh" class="h-4 w-4"/> Buat ulang</button></form>
            </div>
        @empty
            <div class="col-span-full"><x-empty icon="qr" title="Tidak ada siswa"/></div>
        @endforelse
    </div>
</div>
</x-layouts.app>
