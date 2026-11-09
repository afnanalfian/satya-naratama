<div class="mx-auto max-w-3xl px-4 py-12 sm:px-6">
    <div class="text-center">
        <div class="mx-auto grid h-16 w-16 place-items-center rounded-3xl bg-ink-900 text-saffron-400 shadow-lift"><x-icon name="search" class="h-8 w-8"/></div>
        <h1 class="mt-5 font-display text-3xl font-extrabold sm:text-4xl">Cek status pendaftaran</h1>
        <p class="mt-2 text-sm text-ink-500">Masukkan email yang kamu gunakan saat mendaftar bimbel.</p>
    </div>

    @if(! $registration)
        <form wire:submit="check" class="card mx-auto mt-8 max-w-lg p-5 sm:p-6">
            <x-field label="Email pendaftaran" name="email"><input wire:model="email" type="email" class="input" placeholder="nama@email.com" autofocus></x-field>
            <button class="btn-primary mt-4 w-full" wire:loading.attr="disabled"><span wire:loading.remove wire:target="check">Cek status</span><span wire:loading wire:target="check">Mencari…</span></button>
            <p class="mt-4 text-center text-sm text-ink-500">Belum mendaftar? <a href="{{ route('daftar.form') }}" class="link">Daftar sekarang</a></p>
        </form>
    @else
        @php
            $r = $registration;
            $stages = [
                ['Formulir dikirim', true],
                ['Pembayaran diunggah', in_array($r->payment_status, ['paid', 'verified'])],
                ['Diverifikasi admin', $r->isVerified()],
                ['Akun aktif', $r->isVerified() && $r->user_id],
            ];
        @endphp
        <div class="card mt-8 overflow-hidden">
            <div class="bg-ink-900 p-6 text-white">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <div class="flex items-center gap-3">
                        <img src="{{ $r->avatar ? asset('storage/'.$r->avatar) : asset('img/user.png') }}" class="h-14 w-14 rounded-2xl object-cover ring-2 ring-white/20" alt="">
                        <div><p class="font-display text-xl font-bold">{{ $r->full_name }}</p><p class="text-xs text-ink-300">{{ $r->email }} · #{{ str_pad($r->id, 6, '0', STR_PAD_LEFT) }}</p></div>
                    </div>
                    <x-status-badge :status="$r->registration_status" class="!text-xs"/>
                </div>
                <ol class="mt-6 grid grid-cols-4 gap-2">
                    @foreach($stages as $i => [$label, $done])
                        <li class="text-center">
                            <div class="mx-auto grid h-9 w-9 place-items-center rounded-full {{ $done ? 'bg-lagoon-500' : 'bg-white/10 text-ink-300' }}">@if($done)<x-icon name="check" class="h-4 w-4" stroke="3"/>@else{{ $i + 1 }}@endif</div>
                            <p class="mt-2 text-[11px] font-semibold leading-tight {{ $done ? 'text-white' : 'text-ink-400' }}">{{ $label }}</p>
                        </li>
                    @endforeach
                </ol>
            </div>
            <div class="space-y-4 p-6">
                @if($r->canMakePayment())
                    <div class="rounded-2xl bg-saffron-50 p-4 text-sm text-saffron-900 ring-1 ring-saffron-200"><b>Menunggu pembayaran.</b> Selesaikan pembayaran Rp {{ number_format($r->registration_fee, 0, ',', '.') }} lalu unggah buktinya.</div>
                    <a href="{{ route('daftar.payment', $r->id) }}" class="btn-primary w-full">Lanjutkan pembayaran <x-icon name="arrow-right" class="h-4 w-4"/></a>
                @elseif($r->isAwaitingVerification())
                    <div class="rounded-2xl bg-sky-50 p-4 text-sm text-sky-900 ring-1 ring-sky-100"><b>Bukti pembayaran diterima.</b> Admin sedang memverifikasi. Kamu akan menerima email saat akun aktif.</div>
                @elseif($r->isVerified())
                    <div class="rounded-2xl bg-lagoon-50 p-4 text-sm text-lagoon-900 ring-1 ring-lagoon-100"><b>Selamat! 🎉</b> Pendaftaran terverifikasi. Masuk menggunakan email & password yang kamu buat saat mendaftar.</div>
                    <a href="{{ route('login') }}" class="btn-ink w-full">Masuk sekarang <x-icon name="login" class="h-4 w-4"/></a>
                @elseif($r->isRejected())
                    <div class="rounded-2xl bg-garnet-50 p-4 text-sm text-garnet-900 ring-1 ring-garnet-100"><b>Pendaftaran ditolak.</b> {{ $r->rejection_reason ?: 'Silakan hubungi admin untuk informasi lebih lanjut.' }}</div>
                @endif

                <dl class="grid gap-3 rounded-2xl bg-cream p-4 text-sm sm:grid-cols-2">
                    <div><dt class="text-xs text-ink-400">Sekolah</dt><dd class="font-bold">{{ $r->school_origin }} · {{ $r->class }}</dd></div>
                    <div><dt class="text-xs text-ink-400">Domisili</dt><dd class="font-bold">{{ $r->full_address }}</dd></div>
                    <div><dt class="text-xs text-ink-400">Kampus impian</dt><dd class="font-bold">{{ $r->priority_university_1 }}{{ $r->priority_university_2 ? ' / '.$r->priority_university_2 : '' }}</dd></div>
                    <div><dt class="text-xs text-ink-400">Status pembayaran</dt><dd class="font-bold">{{ $r->payment_status_label }}</dd></div>
                    <div><dt class="text-xs text-ink-400">Tanggal daftar</dt><dd class="font-bold">{{ $r->created_at->translatedFormat('d F Y, H:i') }}</dd></div>
                </dl>
                <div class="flex flex-col gap-2 sm:flex-row">
                    <a href="https://wa.me/{{ config('satya.admin_wa') }}?text={{ urlencode('Halo Admin, saya '.$r->full_name.' ingin bertanya tentang pendaftaran saya') }}" target="_blank" class="btn-lagoon flex-1"><x-icon name="whatsapp" class="h-4 w-4"/> Hubungi admin</a>
                    <button wire:click="resetForm" class="btn-soft flex-1">Cek email lain</button>
                </div>
            </div>
        </div>
    @endif
</div>
