<div>
    <div class="mb-6 grid h-14 w-14 place-items-center rounded-2xl bg-saffron-100 text-saffron-700"><x-icon name="key" class="h-7 w-7"/></div>
    <h1 class="font-display text-3xl font-extrabold">Lupa password?</h1>
    <p class="mt-2 text-sm text-ink-500">Masukkan email akunmu. Kami kirimkan tautan untuk membuat password baru.</p>

    @if($sent)
        <div class="mt-8 rounded-3xl bg-lagoon-50 p-5 ring-1 ring-lagoon-100">
            <p class="font-bold text-lagoon-800">Tautan terkirim! 📬</p>
            <p class="mt-1 text-sm text-lagoon-700">Cek kotak masuk (dan folder spam) email <b>{{ $email }}</b>. Tautan berlaku 60 menit.</p>
        </div>
    @else
        <form wire:submit="send" class="mt-8 space-y-4">
            <x-field label="Email" name="email"><input wire:model="email" type="email" class="input" placeholder="nama@email.com" autofocus></x-field>
            <button class="btn-primary btn-lg w-full" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="send">Kirim tautan reset</span><span wire:loading wire:target="send">Mengirim…</span>
            </button>
        </form>
    @endif
    <a href="{{ route('login') }}" class="mt-6 inline-flex items-center gap-1 text-sm font-bold text-ink-500 hover:text-garnet-600"><x-icon name="arrow-left" class="h-4 w-4"/> Kembali ke halaman masuk</a>
</div>
