<div>
    <h1 class="font-display text-3xl font-extrabold">Masuk ke akunmu</h1>
    <p class="mt-2 text-sm text-ink-500">Sekali masuk, kamu tetap login di perangkat ini sampai kamu sendiri yang keluar.</p>

    @if (session('status'))
        <div class="mt-6 rounded-2xl bg-lagoon-50 p-3 text-sm font-semibold text-lagoon-700">{{ session('status') }}</div>
    @endif

    <form wire:submit="login" class="mt-8 space-y-4">
        <x-field label="Email" name="email">
            <input wire:model="email" type="email" class="input" placeholder="nama@email.com" autocomplete="email" autofocus>
        </x-field>
        <x-field name="password">
            <div class="flex items-center justify-between">
                <label class="label">Password</label>
                <a href="{{ route('password.request') }}" class="mb-1.5 text-xs font-bold text-garnet-600 hover:underline">Lupa password?</a>
            </div>
            <div x-data="{ v: false }" class="relative">
                <input wire:model="password" :type="v ? 'text' : 'password'" class="input pr-11" placeholder="••••••••" autocomplete="current-password">
                <button type="button" @click="v=!v" class="absolute right-3 top-1/2 -translate-y-1/2 text-ink-400 hover:text-ink-700">
                    <x-icon name="eye" class="h-5 w-5" x-show="!v"/><x-icon name="eye-off" class="h-5 w-5" x-show="v" x-cloak/>
                </button>
            </div>
        </x-field>
        <button class="btn-primary btn-lg w-full" wire:loading.attr="disabled">
            <span wire:loading.remove wire:target="login">Masuk</span>
            <span wire:loading wire:target="login">Memeriksa…</span>
            <x-icon name="arrow-right" class="h-5 w-5"/>
        </button>
    </form>

    <div class="mt-8 grid gap-3 rounded-3xl border border-ink-100 bg-white p-5 text-sm">
        <p class="font-bold">Belum punya akun?</p>
        <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
            <a href="{{ route('daftar.form') }}" class="btn-gold">Daftar Bimbel</a>
            <a href="{{ route('register') }}" class="btn-soft">Akun Tryout/Umum</a>
        </div>
        <a href="{{ route('daftar.status.form') }}" class="text-center text-xs font-bold text-ink-500 hover:text-garnet-600">Sudah daftar bimbel? Cek status pendaftaran →</a>
    </div>
</div>
