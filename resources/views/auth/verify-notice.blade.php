<x-layouts.auth title="Verifikasi Email">
    <div class="mb-6 grid h-16 w-16 place-items-center rounded-3xl bg-sunrise text-white shadow-glow"><x-icon name="mail" class="h-8 w-8"/></div>
    <h1 class="font-display text-3xl font-extrabold">Cek email kamu ✉️</h1>
    <p class="mt-3 text-sm leading-relaxed text-ink-500">Kami sudah mengirim tautan verifikasi ke <b class="text-ink-800">{{ auth()->user()->email }}</b>. Klik tautan tersebut untuk mengaktifkan akun. Tidak ketemu? Periksa folder <i>Spam/Promosi</i>.</p>
    @if (session('status') === 'verification-link-sent' || session('status'))
        <div class="mt-5 rounded-2xl bg-lagoon-50 p-3 text-sm font-semibold text-lagoon-700">Tautan verifikasi baru sudah dikirim.</div>
    @endif
    <div class="mt-8 flex flex-col gap-3 sm:flex-row">
        <form method="POST" action="{{ route('verification.send') }}" class="flex-1">@csrf<button class="btn-primary w-full">Kirim ulang tautan</button></form>
        <form method="POST" action="{{ route('logout') }}">@csrf<button class="btn-soft w-full">Keluar</button></form>
    </div>
</x-layouts.auth>
