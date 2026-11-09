<x-layouts.app title="QR Presensi Saya">
@push('head')<script src="{{ asset('vendor/qrcodejs/qrcode.min.js') }}"></script>@endpush
<div class="grid gap-6 lg:grid-cols-5">
    <div class="lg:col-span-2" x-data="{ bright: false }">
        <div class="relative overflow-hidden rounded-[2rem] bg-ink-950 p-6 text-white shadow-lift">
            <div class="absolute inset-0 bg-grid-ink [background-size:24px_24px]"></div>
            <div class="blob -right-10 -top-10 h-40 w-40 bg-garnet-600/60"></div>
            <div class="relative">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('img/logo.png') }}" class="h-10 w-10 rounded-xl bg-white p-1" alt="">
                    <div><p class="font-display font-extrabold">Satya<span class="text-saffron-400">Naratama</span></p><p class="text-[11px] text-ink-300">Kartu Presensi Siswa</p></div>
                </div>
                <div class="mx-auto mt-6 w-fit rounded-3xl bg-white p-4 shadow-glow-gold" :class="bright && 'scale-105'">
                    <div x-data x-init="new QRCode($el, { text: @js($user->qr_payload), width: 220, height: 220, correctLevel: QRCode.CorrectLevel.M })"></div>
                </div>
                <div class="mt-5 flex items-center gap-3">
                    <img src="{{ $user->avatar_url }}" class="h-12 w-12 rounded-2xl object-cover ring-2 ring-white/20" alt="">
                    <div><p class="font-bold">{{ $user->display_name }}</p><p class="text-xs text-ink-300">{{ $user->studentRegistration?->school_origin }} {{ $user->studentRegistration?->class ? '· '.$user->studentRegistration->class : '' }}</p></div>
                </div>
                <p class="mt-4 rounded-xl bg-white/5 px-3 py-2 text-center font-mono text-xs tracking-wider text-ink-300">{{ $user->qr_payload }}</p>
            </div>
        </div>
        <p class="mt-3 text-center text-xs text-ink-400">Tunjukkan QR ini ke tentor saat pertemuan. Naikkan kecerahan layar agar mudah dipindai. Jangan bagikan ke orang lain.</p>
    </div>
    <div class="space-y-6 lg:col-span-3">
        <div class="grid grid-cols-3 gap-3">
            @foreach(['overall' => ['Total', 'ink'], 'akademik' => ['Akademik', 'garnet'], 'jasmani' => ['Jasmani', 'gold']] as $k => [$l, $tone])
                <x-stat :label="$l" :value="$summary[$k]['pct'] !== null ? $summary[$k]['pct'].'%' : '–'" icon="check-circle" :tone="$tone" :hint="$summary[$k]['hadir'].'/'.$summary[$k]['done'].' hadir'"/>
            @endforeach
        </div>
        <div class="card card-pad">
            <p class="section-title">Riwayat terakhir</p>
            <div class="mt-4 space-y-2">
                @forelse($history as $h)
                    <div class="flex items-center gap-3 rounded-2xl bg-cream p-3">
                        <span class="grid h-10 w-10 place-items-center rounded-xl {{ $h->meeting->course?->type === 'jasmani' ? 'bg-saffron-100 text-saffron-700' : 'bg-ink-100 text-ink-700' }}"><x-icon :name="$h->meeting->course?->type === 'jasmani' ? 'run' : 'book'" class="h-5 w-5"/></span>
                        <div class="min-w-0 flex-1"><p class="truncate text-sm font-bold">{{ $h->meeting->title }}</p><p class="text-xs text-ink-400">{{ $h->meeting->scheduled_at->translatedFormat('d M Y') }}{{ $h->time ? ' · '.$h->time->format('H:i') : '' }}{{ $h->late ? ' · terlambat' : '' }}</p></div>
                        <x-status-badge :status="$h->status"/>
                    </div>
                @empty
                    <p class="text-sm text-ink-400">Belum ada pertemuan selesai.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
</x-layouts.app>
