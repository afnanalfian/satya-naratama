<x-layouts.public title="Bukti Pembayaran Terkirim">
    <div class="mx-auto max-w-xl px-4 py-16 text-center sm:px-6">
        <div class="relative mx-auto h-24 w-24">
            <div class="absolute inset-0 animate-ping rounded-full bg-lagoon-300/40"></div>
            <div class="relative grid h-24 w-24 place-items-center rounded-full bg-lagoon-500 text-white shadow-lift"><x-icon name="check" class="h-12 w-12" stroke="2.5"/></div>
        </div>
        <h1 class="mt-8 font-display text-3xl font-extrabold sm:text-4xl">Terima kasih, {{ $registration->nickname ?: \Illuminate\Support\Str::of($registration->full_name)->explode(' ')->first() }}! 🎉</h1>
        <p class="mt-3 text-ink-500">Bukti pembayaranmu sudah kami terima. Admin akan memverifikasi dalam 1×24 jam, lalu akun belajarmu langsung aktif dan info dikirim ke <b class="text-ink-800">{{ $registration->email }}</b>.</p>
        <div class="card mt-8 p-5 text-left text-sm">
            <div class="flex justify-between py-1.5"><span class="text-ink-400">Kode pendaftaran</span><b>#{{ str_pad($registration->id, 6, '0', STR_PAD_LEFT) }}</b></div>
            <div class="flex justify-between py-1.5"><span class="text-ink-400">Nominal</span><b>Rp {{ number_format($registration->registration_fee, 0, ',', '.') }}</b></div>
            <div class="flex justify-between py-1.5"><span class="text-ink-400">Status</span><x-status-badge :status="$registration->registration_status"/></div>
        </div>
        <div class="mt-6 flex flex-col gap-2 sm:flex-row">
            <a href="https://wa.me/{{ config('satya.admin_wa') }}?text={{ urlencode('Halo Admin, saya '.$registration->full_name.' ingin konfirmasi pembayaran pendaftaran') }}" target="_blank" class="btn-lagoon flex-1"><x-icon name="whatsapp" class="h-4 w-4"/> Konfirmasi via WhatsApp</a>
            <a href="{{ route('daftar.status.form') }}" class="btn-soft flex-1">Cek status</a>
        </div>
    </div>
</x-layouts.public>
